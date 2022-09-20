<?php
include "assets/phpqrcode/qrlib.php";

$DINO       = date("Y-m-d H:i:s");
$DATE       = date("Ymd");
$TIME       = date("H:i:s");
$TIMES      = date("His");
$T          = date("y");
$Z          = date("Y");
$X          = date("m");
$V          = date("d");
$ID_USER1   = $_SESSION["LOGINIDUS_VISITOR"];
$NAMA_USER  = $_SESSION["LOGINNAMAUS_VISITOR"];
$IP_ADDRESS = $_SESSION["IP_ADDRESS_VISITOR"];
$PC_NAME    = $_SESSION["PC_NAME_VISITOR"];

$CARD_NO    = "";
$CARD_NO_HK = "";
$KODE_TAMU  = "";

//------------------------------------------- CHECKIN PRODUCTION AREA-----------------------------------------------
if(isset($_POST["simpan"]))
{
    $CARD_NO    = $_POST["CARD_NO"];
    $CARD_NO_HK = $_POST["CARD_NO_HK"];
    $KODE_TAMU  = $_POST["KODE_TAMU"];
    
    // Update table t_vms
    UpdateData(
    "t_vms",
    "checkin_hk_date='$DINO', checkin_hk_by='$ID_USER1', card_no_hk='$CARD_NO_HK', state='2'",
    "vms_id = '$KODE_TAMU'");

    //update status card yang dipakai
    UpdateData(
    "m_card",
    "status='1'",
    "card_no = '$CARD_NO_HK'");

    //insert userlog
    InsertData(
    "users_log",
    "description, ip_adress, user_id, created_date, created_by, module, trans_type",
    "'Kode = $KODE_TAMU','$IP_ADDRESS','$ID_USER1','$DINO','$ID_USER1','VMS','Checkin Production'");
            
    ?>
    <script>alert('Checkin Successfully!');</script>
    <script>document.location.href='vmsp'</script>
    <?php
    die(0);   
}

//----------------------------------------- CHECKOUT PRODUCTION AREA -------------------------------------------------
if(isset($_POST["simpan2"]))
{
    $KODE_TAMU = $_POST["KODE_TAMU"];
    $CARD_NO   = $_POST["CARD_NO"];

    UpdateData(
    "t_vms",
    "checkout_hk_date='$DINO', checkout_hk_by='$ID_USER1', state='1'",
    "vms_id = '$KODE_TAMU'");

    //Release status card yang dipakai
    UpdateData(
    "m_card",
    "status='0'",
    "card_no = '$CARD_NO'");

    InsertData(
    "users_log",
    "description, ip_adress, user_id, created_date, created_by, module, trans_type",
    "'Kode = $KODE_TAMU','$IP_ADDRESS','$ID_USER1','$DINO','$ID_USER1','VMS','Checkout Production'");
    ?>
    <script>alert('Checkout Successfully!');</script>
    <script>document.location.href='vmsp';</script>
    <?php
    die(0);
}
?>