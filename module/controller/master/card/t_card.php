<?php
$DINO        = date('Y-m-d H:i:s');
$ID_USER1    = $_SESSION["LOGINIDUS_VISITOR"];
$IP_ADDRESS  = $_SESSION["IP_ADDRESS_VISITOR"];
$NAMA_USER   = $_SESSION["LOGINNAMAUS_VISITOR"];
$PC_NAME     = gethostbyaddr($IP_ADDRESS);

$CARD_NUMBER = "";
$STATUS      = "";

//EDIT
if(isset($_GET["KODE"]))
{
    $KODE  = $_GET["KODE"];
    $result     = GetQuery("select * from m_card where card_id ='$KODE'");
    while ($row = $result->fetch(PDO::FETCH_ASSOC))
    {
        $CARD_NUMBER = $row["card_no"];
        $STATUS      = $row["status"];
    }

    if(isset($_POST["simpan"]))
    {
        $CARD_NUMBER = $_POST["CARD_NUMBER"];
        $STATUS      = $_POST["STATUS"];

        UpdateData(
        "m_card",
        "card_no = '$CARD_NUMBER', status = '$STATUS', modified_date = '$DINO', modified_by = '$ID_USER1'",
        "card_id = '$KODE'");

        InsertData(
        "users_log",
        "log_id, description, ip_adress, user_id, created_date, created_by, module, trans_type",
        "'', 'Edit Card - $KODE', '$IP_ADDRESS','$ID_USER1','$DINO','$ID_USER1','Master','Edit'");
        ?>
        <script>alert('Card has been updated! Thank you! ');</script>
        <script>document.location.href='m_card';</script>
        <?php
        die(0); 
        
    }
}

//BARU
if(isset($_POST["simpan"]))
{
    $CARD_NUMBER = $_POST["CARD_NUMBER"];

    InsertData(
    "m_card",
    "card_no, created_date, created_by",
    "'$CARD_NUMBER', '$DINO', '$ID_USER1'");

    InsertData(
        "users_log",
        "log_id, description, ip_adress, user_id, created_date, created_by, module, trans_type",
        "'', 'Tambah Card - $CARD_NUMBER', '$IP_ADDRESS','$ID_USER1','$DINO','$ID_USER1','Master','Tambah'");

    ?>
    <script>alert('Card has been added! Thank you! ');</script>
    <script>document.location.href='m_card';</script>
    <?php
    die(0);
}
?>