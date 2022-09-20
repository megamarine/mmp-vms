<?php
$NAMA_USER      = $_SESSION["LOGINNAMAUS_VISITOR"];
$KODE_USER      = $_SESSION["LOGINIDUS_VISITOR"];
$PASSWORD       = "";

$DINO           = date('Y-m-d H:i:s');
$ID_USER1       = $_SESSION["LOGINIDUS_VISITOR"];
$IP_ADDRESS     = $_SESSION["IP_ADDRESS_VISITOR"];

$ai_users_log   = kodeAuto("users_log","log_id");
$options        = ['cost' => 12,];

if(isset($_POST["simpan"]))
{
    $NAMA_USER  = $_POST["NAMA_USER"];
    $PASS       = $_POST["PASSWORD"];
    $PASSWORD   = password_hash($_POST['PASSWORD'], PASSWORD_BCRYPT, $options);

    InsertData(
    "users_log",
    "log_id, description, ip_adress, user_id, created_date, created_by, module, trans_type",
    "'$ai_users_log','desc','$IP_ADDRESS','".$_SESSION["LOGINIDUS_VISITOR"]."','$DINO','".$_SESSION["LOGINIDUS_VISITOR"]."','VMS','Edit Profile'");

    UpdateData(
    "users",
    "username='$NAMA_USER',password='$PASSWORD'",
    "id='$KODE_USER'");

    UpdateData(
    "roles_users",
    "last_update='$DINO'",
    "user_id='$KODE_USER'");

    ?>
    <script>alert('Edit Profile Successfully!');</script>
    <script>document.location.href='menuutama.php';</script>
    <?php
    die(0);
}
?>