<?php
require_once ("module/model/koneksi/koneksi.php");
$ai   = kodeAuto("temp_vms_pic","id");
$uniqcode = $_SESSION["UNIQCODE_VISITOR"];

$nama_file = $uniqcode.'.jpg';
$direktori = 'temp_vms_doc/';
$target    = $direktori.$nama_file;

move_uploaded_file($_FILES['webcam']['tmp_name'], $target);
InsertData("temp_vms_doc","name","'$uniqcode'");

?>