<?php
require_once ("module/model/koneksi/koneksi.php");

$DINO 			 = date('Y-m-d H:i:s');
$AKSES 			 = $_SESSION["LOGINAKS_VISITOR"];
$NAMA_USER 		 = $_SESSION["LOGINNAMAUS_VISITOR"];
$ID_USER1   	 = $_SESSION["LOGINIDUS_VISITOR"];
$IP_ADDRESS 	 = $_SESSION["IP_ADDRESS_VISITOR"];
$PC_NAME    	 = gethostbyaddr($IP_ADDRESS);
$ai_users_log 	 = kodeAuto("users_log","log_id");

InsertData(
    "users_log",
    "log_id,description, ip_adress, user_id, created_date, created_by, module, trans_type",
    "'$ai_users_log','User logout','$IP_ADDRESS','$ID_USER1','$DINO','$NAMA_USER','VMS','Logout' ");

unset($_SESSION["IP_ADDRESS_VISITOR"]);
unset($_SESSION["PC_NAME_VISITOR"]);
unset($_SESSION["LOGINIDUS_VISITOR"]);
unset($_SESSION["LOGINNAMAUS_VISITOR"]);
unset($_SESSION["LOGINPER_VISITOR"]);
unset($_SESSION["LOGINMAIL_VISITOR"]);
unset($_SESSION["LOGINAKS_VISITOR"]);
unset($_SESSION["UNIQCODE_VISITOR"]);

?><script>alert('Logout Successfully!');</script><?php
?><script>document.location.href='index.php';</script><?php
?>