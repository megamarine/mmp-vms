<?php
require_once ("module/model/koneksi/koneksi.php");

if(!isset($_SESSION["LOGINIDUS_VISITOR"]))
{
    ?><script>alert('Silahkan login dahulu');</script><?php
    ?><script>document.location.href='index';</script><?php
    die(0);
}

// ---------------------------------------------------------------------------------------------------------------------------------
$KODE_USER  = $_SESSION["LOGINIDUS_VISITOR"];

$create_mkey = "";
$read_mkey   = "";
$delete_mkey = "";
$update_mkey = "";
$query      = getQuery("select * from m_usermodule where kode_user = '$KODE_USER' and id_module = '9' and xread = '1'");
$cek = $query->rowCount();
if($cek == 0)
{
    ?> 
        <script>alert("Access Denied");window.history.back();</script>
    <?php
}
else
{
    while ($roww = $query->fetch(PDO::FETCH_ASSOC)) 
    {
        $create_mkey = $roww["xcreate"];
        $read_mkey   = $roww["xread"];
        $update_mkey = $roww["xupdate"];
        $delete_mkey= $roww["xdelete"];
    }
}
// ---------------------------------------------------------------------------------------------------------------------------------
?>
<!DOCTYPE html>
<html class="backend">
    <head>
        <?php include "module/model/head/head.php"; ?>
    </head>
    <body>
        <header id="header" class="navbar">
            <?php include "module/model/header/header.php"; ?>
        </header>
        <?php include "module/model/sidebar/sidebar.php"; ?>
        <section id="main" role="main">
            <div class="container-fluid">
                <?php include "module/view/master/key/v_key.php"; ?>
            </div>
            <a href="#" class="totop animation" data-toggle="waypoints totop" data-showanim="bounceIn" data-hideanim="bounceOut" data-offset="50%"><i class="ico-angle-up"></i></a>
        </section>
        <?php include "module/model/footer/footer.php"; ?>
        <script type="text/javascript" src="assets/javascript/vendor.js"></script>
        <script type="text/javascript" src="assets/javascript/core.js"></script>
        <script type="text/javascript" src="assets/javascript/backend/app.js"></script>
        <script type="text/javascript" src="assets/javascript/pace.min.js"></script>
        <script type="text/javascript" src="assets/plugins/datatables/js/jquery.dataTables.js"></script>
        <script type="text/javascript" src="assets/plugins/datatables/tabletools/js/dataTables.tableTools.js"></script>
        <script type="text/javascript" src="assets/plugins/datatables/js/datatables-bs3.js"></script>
        <script type="text/javascript" src="assets/javascript/backend/tables/datatable.js"></script>
    </body>
</html>