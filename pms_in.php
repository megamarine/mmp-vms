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
$query      = getQuery("select * from m_usermodule where kode_user = '$KODE_USER' and id_module = '15' and xcreate = '1'");
$cek = $query->rowCount();
if($cek == 0)
{
    ?> 
        <script>alert("Access Denied");window.history.back();</script>
    <?php
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
                <?php include "module/view/pms/v_pms_in.php"; ?>
            </div>
            <a href="#" class="totop animation" data-toggle="waypoints totop" data-showanim="bounceIn" data-hideanim="bounceOut" data-offset="50%"><i class="ico-angle-up"></i></a>
        </section>
        <?php include "module/model/footer/footer.php"; ?>
        <script type="text/javascript" src="assets/javascript/vendor.js"></script>
        <script type="text/javascript" src="assets/javascript/core.js"></script>
        <script type="text/javascript" src="assets/javascript/backend/app.js"></script>
        <script type="text/javascript" src="assets/javascript/pace.min.js"></script>
        <script type="text/javascript" src="assets/plugins/selectize/js/selectize.js"></script>
        <script type="text/javascript" src="assets/plugins/jquery-ui/js/jquery-ui.js"></script>
        <script type="text/javascript" src="assets/plugins/jquery-ui/js/addon/timepicker/jquery-ui-timepicker.js"></script>
        <script type="text/javascript" src="assets/javascript/pace.min.js"></script>
        <script type="text/javascript" src="assets/plugins/selectize/js/selectize.js"></script>
        <script type="text/javascript" src="assets/plugins/parsley/js/parsley.js"></script>
        <script src="assets/stylesheet/modal/jquery.dataTables.min.js"></script> 
        <script src="assets/stylesheet/modal/dataTables.bootstrap4.min.js"></script>
    </body>
</html>