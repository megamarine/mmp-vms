<?php
require_once ("module/model/koneksi/koneksi.php");
if(!isset($_SESSION["LOGINIDUS_VISITOR"]))
{
    ?><script>alert('Silahkan login dahulu');</script><?php
    ?><script>document.location.href='index';</script><?php
    die(0);
}

$CARD_NO      = "";
$STATUS       = "";
$DINO         = date('Y-m-d H:i:s');
$ID_USER1     = $_SESSION["LOGINIDUS_VISITOR"];
$IP_ADDRESS   = $_SESSION["IP_ADDRESS_VISITOR"];
$PC_NAME      = gethostbyaddr($IP_ADDRESS);
$options      = [
                    'cost' => 12,
                ];

if(isset($_GET["ID"]))
{
    $ID        = $_GET["ID"];
    $result    = GetData1("*","m_key","key_id = '$ID'");
    while ($row = $result->fetch(PDO::FETCH_ASSOC))
    {
        $KEY_ID      = $row["key_id"];
        $STATUS      = $row["key_status"];
    }

    if($STATUS == "1")
    {
        $STATUS = "0";
    }
    else if($STATUS == "0")
    {
        $STATUS = "1";
    }

    UpdateData(
    "m_key",
    "key_status='$STATUS'",
    "key_id='$ID'");
    
    ?><script>document.location.href='key';</script><?php
    die(0);
}
?>