<?php
$DINO           = date("Y-m-d H:i:s");
$Z              = date("Y");
$X              = date("m");
$TRANS_ID       = createKode("t_pms","pms_id","PMS"."-$Z$X-",4);
$ID_USER1       = $_SESSION["LOGINIDUS_VISITOR"];
$NAMA_USER      = $_SESSION["LOGINNAMAUS_VISITOR"];
$IP_ADDRESS     = $_SESSION["IP_ADDRESS_VISITOR"];
$PC_NAME        = $_SESSION["PC_NAME_VISITOR"];
$JENIS_PAKET    = "";
$PENGIRIM       = "";
$KEPADA         = "";
$PENERIMA       = "";
$PENGANTAR      = "";

//------------------------------------------- PACKAGE PROCESS -----------------------------------------------
if(isset($_GET["TRANS_ID"]))
{
    $TRANS_ID   = $_GET["TRANS_ID"];

    $stmt = GetQuery("select package_for from t_pms where pms_id='$TRANS_ID'");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
    {
        $KEPADA = $row["package_for"];
    }

    
    if(isset($_POST["simpan"]))
    {
        $PENERIMA   = $_POST["PENERIMA"];
        $PENGANTAR  = $_POST["PENGANTAR"];

        UpdateData(
        "t_pms",
        "receiver ='$PENERIMA', deliver='$PENGANTAR', status='0', date_received='$DINO', modified_date='$DINO', modified_by='$ID_USER1'",
        "pms_id = '$TRANS_ID'");
            
        InsertData(
        "users_log",
        "description, ip_adress, user_id, created_date, created_by, module, trans_type",
        "'Kode = $TRANS_ID','$IP_ADDRESS','$ID_USER1','$DINO','$ID_USER1','PMS','Trans Complete'");
        ?>
        <script>alert('Successfully Saved!');</script>
        <script>document.location.href='pms';</script>
        <?php
        die(0);
    }
}

//------------------------------------------- PACKAGE IN -----------------------------------------------
if(isset($_POST["simpan"]))
{
    $JENIS_PAKET    = $_POST["JENIS_PAKET"];
    $PENGIRIM       = $_POST["PENGIRIM"];
    $KEPADA         = $_POST["KEPADA"];

    InsertData(
    "t_pms",
    "pms_id, date_trans, package_type, package_from, package_for, status, created_by, created_date",
    "'$TRANS_ID','$DINO','$JENIS_PAKET','$PENGIRIM','$KEPADA','1','$ID_USER1','$DINO'");

    InsertData(
    "users_log",
    "description, ip_adress, user_id, created_date, created_by, module, trans_type",
    "'Kode = $TRANS_ID','$IP_ADDRESS','$ID_USER1','$DINO','$ID_USER1','PMS','New Trans'");
    ?>
    <script>alert('Successfully Added!');</script>
    <script>document.location.href='pms';</script>
    <?php
    die(0);
}
?>