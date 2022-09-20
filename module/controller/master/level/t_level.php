<?php
$DINO       = date('Y-m-d H:i:s');
$ID_USER1   = $_SESSION["LOGINIDUS_VISITOR"];
$IP_ADDRESS = $_SESSION["IP_ADDRESS_VISITOR"];
$NAMA_USER  = $_SESSION["LOGINNAMAUS_VISITOR"];
$PC_NAME    = gethostbyaddr($IP_ADDRESS);

//EDIT
if(isset($_GET["KODE"]))
{
    $KODE  = $_GET["KODE"];
    $result     = GetQuery("select * from m_level where level_id ='$KODE'");
    while ($row = $result->fetch(PDO::FETCH_ASSOC))
    {
        $LEVEL_NAME = $row["level_name"];
        $STATUS     = $row["status"];
    }

    if(isset($_POST["simpan"]))
    {
        $LEVEL_NAME = $_POST["LEVEL_NAME"];
        $STATUS     = $_POST["STATUS"];

        UpdateData(
        "m_level",
        "level_name = '$LEVEL_NAME', status = '$STATUS', modified_date = '$DINO', modified_by = '$ID_USER1'",
        "level_id = '$KODE'");

        InsertData(
        "users_log",
        "log_id, description, ip_adress, user_id, created_date, created_by, module, trans_type",
        "'', 'Edit Level - $KODE', '$IP_ADDRESS','$ID_USER1','$DINO','$ID_USER1','Master','Edit'");
        ?>
        <script>alert('Level has been updated! Thank you! ');</script>
        <script>document.location.href='m_level';</script>
        <?php
        die(0); 
    }
}

//BARU
if(isset($_POST["simpan"]))
{
    $LEVEL_CODE = createKode("m_level","level_id","LV",4);
    $LEVEL_NAME = $_POST["LEVEL_NAME"];

    InsertData(
    "m_level",
    "level_id, level_name, created_date, created_by",
    "'$LEVEL_CODE', '$LEVEL_NAME', '$DINO', '$ID_USER1'");

    InsertData(
        "users_log",
        "log_id, description, ip_adress, user_id, created_date, created_by, module, trans_type",
        "'', 'Tambah Level - $LEVEL_CODE', '$IP_ADDRESS','$ID_USER1','$DINO','$ID_USER1','Master','Tambah'");

    ?>
    <script>alert('Level has been added! Thank you! ');</script>
    <script>document.location.href='m_level';</script>
    <?php
    die(0);
}
?>