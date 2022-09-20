<?php
$DINO           = date("Y-m-d H:i:s");
$DATE           = date("Ymd");
$TIME           = date("H:i:s");
$TIMES          = date("His");
$T              = date("y");
$Z              = date("Y");
$X              = date("m");
$V              = date("d");
$NOMOR_RFID     = "";
$NOMOR_RFID_HK  = "";  
$ID_USER1       = $_SESSION["LOGINIDUS_VISITOR"];
$NAMA_USER      = $_SESSION["LOGINNAMAUS_VISITOR"];
$IP_ADDRESS     = $_SESSION["IP_ADDRESS_VISITOR"];
$PC_NAME        = $_SESSION["PC_NAME_VISITOR"];

//------------------------------------------- CHECKIN HK --------------------------------------------------------------
if(isset($_POST["simpan"]))
{
    $NO_RFID   = $_POST["NO_RFID"];
    $stmt      = GetQuery("select * from vims_reg where rfid_no = '$NO_RFID' and state='1'");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
    {
        $KODE_TAMU      = $row["vm_no"];
    }

    $NOMOR_RFID         = $_POST["NO_RFID"];
    $NOMOR_RFID_HK      = $_POST["NO_RFID_HK"];
    $ai_users_log       = kodeAuto("users_log","log_id");


    UpdateData(
    "m_cards",
    "status=1",
    "card_no = '$NOMOR_RFID_HK'");

    UpdateData(
    "vims_reg",
    "rfid_no_hk='$NOMOR_RFID_HK', state='2', checkin_hk = '$DINO'",
    "vm_no = '$KODE_TAMU'");

    InsertData(
    "users_log",
    "log_id, description, ip_adress, user_id, created_date, created_by, module, trans_type",
    "'$ai_users_log','Kode = $KODE_TAMU','$IP_ADDRESS','$NAMA_USER','$DINO','$NAMA_USER','VMS','Checkin HK'");
    ?>
    <script>alert('Checkin-Production Successfully!');</script>
    <script>document.location.href='transaksi_checkin_hk.php';</script><?php
    die(0);
}

//------------------------------------------- CHECKOUT ---------------------------------------------------------------------
if(isset($_POST["simpan2"]))
{
    $NOMOR_RFID_HK  = $_POST["NO_RFID_HK"];
    $ai_users_log   = kodeAuto("users_log","log_id");

    $stmt1          = GetQuery("select * from vims_reg where rfid_no_hk = '$NOMOR_RFID_HK' and state='2'");
    while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC))
    {
        $NO_KARTU   = $row1["rfid_no_hk"];
        $KODE_TAMU  = $row1["vm_no"];

        UpdateData(
        "m_cards",
        "status=0",
        "card_no = '$NO_KARTU'");
    }

    UpdateData(
    "vims_reg",
    "checkout_hk='$DINO', state=1",
    "vm_no = '$KODE_TAMU'");

    InsertData(
    "users_log",
    "log_id, description, ip_adress, user_id, created_date, created_by, module, trans_type",
    "'$ai_users_log','Kode = $KODE_TAMU','$IP_ADDRESS','$NAMA_USER','$DINO','$NAMA_USER','VMS','Checkout HK'");
    ?>
    <script>alert('Checkout-Production Successfully!');</script>
    <script>document.location.href='transaksi_checkout_hk.php';</script><?php
    die(0);
}
?>