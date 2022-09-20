<?php
$DINO       = date('Y-m-d H:i:s');
$ID_USER1   = $_SESSION["LOGINIDUS_VISITOR"];
$IP_ADDRESS = $_SESSION["IP_ADDRESS_VISITOR"];
$NAMA_USER  = $_SESSION["LOGINNAMAUS_VISITOR"];
$PC_NAME    = gethostbyaddr($IP_ADDRESS);

$ROOMS_KEY  = "";
$LOCATION   = "";
$STATUS     = "";

//EDIT
if(isset($_GET["KODE"]))
{
    $KODE  = $_GET["KODE"];
    $result     = GetQuery("select * from m_key where key_id ='$KODE'");
    while ($row = $result->fetch(PDO::FETCH_ASSOC))
    {
        $ROOMS_KEY = $row["nama_ruangan"];
        $LOCATION  = $row["key_location"];
        $STATUS    = $row["status"];
    }

    if(isset($_POST["simpan"]))
    {
        $ROOMS_KEY = $_POST["ROOMS_KEY"];
        $LOCATION  = $_POST["LOCATION"];
        $STATUS    = $_POST["STATUS"];

        UpdateData(
        "m_key",
        "nama_ruangan = '$ROOMS_KEY', key_location = '$LOCATION', status = '$STATUS', modified_date = '$DINO', modified_by = '$ID_USER1'",
        "key_id = '$KODE'");

        InsertData(
        "users_log",
        "log_id, description, ip_adress, user_id, created_date, created_by, module, trans_type",
        "'', 'Edit Key - $KODE', '$IP_ADDRESS','$ID_USER1','$DINO','$ID_USER1','Master','Edit'");
        ?>
        <script>alert('Key has been updated! Thank you! ');</script>
        <script>document.location.href='m_key';</script>
        <?php
        die(0); 
        
    }
}

//BARU
if(isset($_POST["simpan"]))
{
    $ROOMS_KEY = $_POST["ROOMS_KEY"];
    $LOCATION  = $_POST["LOCATION"];

    InsertData(
    "m_key",
    "nama_ruangan, key_location, created_date, created_by",
    "'$ROOMS_KEY', '$LOCATION', '$DINO', '$ID_USER1'");

    InsertData(
        "users_log",
        "log_id, description, ip_adress, user_id, created_date, created_by, module, trans_type",
        "'', 'Tambah Key - $ROOMS_KEY', '$IP_ADDRESS','$ID_USER1','$DINO','$ID_USER1','Master','Tambah'");

    ?>
    <script>alert('Key has been added! Thank you! ');</script>
    <script>document.location.href='m_key';</script>
    <?php
    die(0);
}
?>