<?php
require_once ("module/model/koneksi/koneksi.php");

if(!isset($_SESSION["LOGINIDUS_VISITOR"]))
{
    ?><script>alert('Silahkan login dahulu');</script><?php
    ?><script>document.location.href='index';</script><?php
    die(0);
}
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
                <?php include "module/view/laporan/v_laporan_transaksi.php"; ?>
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
    </body>
</html>