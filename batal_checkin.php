<?php
    require_once ("module/model/koneksi/koneksi.php");
    $UNIQCODE = $_SESSION["UNIQCODE_VISITOR"];
     //hapus data di database
     $UNIQCODE = $_SESSION["UNIQCODE_VISITOR"];
     GetQuery("delete from temp_vms_pic where name='$UNIQCODE'");
     GetQuery("delete from temp_vms_doc where name='$UNIQCODE'");

     //hapus file di dalam direktori temp_vms_pic
     $folder = 'temp_vms_pic/';
     $file = $UNIQCODE.".jpg";
     $filename = $folder.$file;
     unlink($filename);

     //hapus file di dalam direktori temp_vms_doc
     $folder2 = 'temp_vms_doc/';
     $file2 = $UNIQCODE.".jpg";
     $filename2 = $folder2.$file2;
     unlink($filename2);
?>
<script>document.location.href='vmso.php';</script>
<?php die(0); ?>