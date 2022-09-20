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
    $result    = GetData1("*","m_cards","id = '$ID'");
    while ($row = $result->fetch(PDO::FETCH_ASSOC))
    {
        $CARD_NO     = $row["card_no"];
        $STATUS      = $row["status"];
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
    "m_cards",
    "status='$STATUS'",
    "id='$ID'");
    
    ?><script>document.location.href='rfid';</script><?php
    die(0);
}
?>