<?php 
require_once("module/model/koneksi/koneksi.php");

if(!isset($_SESSION["LOGINIDUS_VISITOR"]))
{
    ?><script>alert('Silahkan login dahulu');</script><?php
    ?><script>document.location.href='index.php';</script><?php
    die(0);
}

$KODE_USER  = $_SESSION["LOGINIDUS_VISITOR"];
$query      = getQuery("select * from m_usermodule where kode_user = '$KODE_USER' and id_module = '9' and xdelete = '1'");
$cek = $query->rowCount();
if($cek == 0)
{
    ?> 
        <script>alert("Access Denied");window.history.back();</script>
    <?php
}
else
{
    if(isset($_GET["KODE"]))
    {
        $KODE            = $_GET["KODE"];
        $DINO            = date('Y-m-d H:i:s');
        $IP_ADDRESS      = $_SESSION["IP_ADDRESS_VISITOR"];
        $ID_USER1        = $_SESSION["LOGINIDUS_VISITOR"];
        $PC_NAME         = $_SESSION["PC_NAME_VISITOR"];

        DeleteData(
            "m_key",
            "key_id = '$KODE'");

        InsertData(
            "users_log",
            "log_id, description, ip_adress, user_id, created_date, created_by, module, trans_type",
            "'', 'Hapus Key - $KODE', '$IP_ADDRESS','$ID_USER1','$DINO','$ID_USER1','Master','Hapus'");

        ?>
        <script>alert('Key has been deleted! Thank you! ');</script>
        <script>document.location.href='m_key.php';</script>
        <?php
        die(0);
    }
}
?>