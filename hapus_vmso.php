<?php 
require_once("module/model/koneksi/koneksi.php");

if(!isset($_SESSION["LOGINIDUS_VISITOR"]))
{
    ?><script>alert('Silahkan login dahulu');</script><?php
    ?><script>document.location.href='index.php';</script><?php
    die(0);
}

$KODE_USER  = $_SESSION["LOGINIDUS_VISITOR"];
$query      = getQuery("select * from m_usermodule where kode_user = '$KODE_USER' and id_module = '14' and xdelete = '1'");
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

        $query = getQuery("select card_no, card_no_hk from t_vms where vms_id = '$KODE'");
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) 
        {
            $card_no     = $row["card_no"];
            $card_no_hk  = $row["card_no_hk"];
        }

        // Update status di table t_vms
        UpdateData(
            "t_vms",
            "status_hapus = '1', modified_date = '$DINO', modified_by = '$ID_USER1'",
            "vms_id = '$KODE'");
        
        // Release card di table m_card
        UpdateData(
            "m_card",
            "status ='0'",
            "card_no = '$card_no' or '$card_no_hk'");

        InsertData(
            "users_log",
            "log_id, description, ip_adress, user_id, created_date, created_by, module, trans_type",
            "'', 'Kode = $KODE', '$IP_ADDRESS','$ID_USER1','$DINO','$ID_USER1','VMS','Hapus'");
        ?>
        <script>alert('VMS Trans has been deleted! Thank you! ');</script>
        <script>document.location.href='vmso.php';</script>
        <?php
        die(0);
    }
}
?>