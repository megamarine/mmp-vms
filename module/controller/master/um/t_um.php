<?php
$DINO       = date('Y-m-d H:i:s');
$ID_USER1   = $_SESSION["LOGINIDUS_VISITOR"];
$IP_ADDRESS = $_SESSION["IP_ADDRESS_VISITOR"];
$NAMA_USER  = $_SESSION["LOGINNAMAUS_VISITOR"];
$PC_NAME    = gethostbyaddr($IP_ADDRESS);

$UM_CODE    = "";
$UM_DESC    = "";
$STATUS     = "";

//EDIT
if(isset($_GET["KODE"]))
{
    $KODE  = $_GET["KODE"];
    $result     = GetQuery("select * from m_um where um_id ='$KODE'");
    while ($row = $result->fetch(PDO::FETCH_ASSOC))
    {
        $UM_DESC = $row["um_desc"];
        $STATUS  = $row["status"];
    }

    if(isset($_POST["simpan"]))
    {
        $UM_DESC = $_POST["UM_DESC"];
        $STATUS  = $_POST["STATUS"];

        UpdateData(
        "m_um",
        "um_desc = '$UM_DESC', status = '$STATUS', modified_date = '$DINO', modified_by = '$ID_USER1'",
        "um_id = '$KODE'");

        InsertData(
        "users_log",
        "log_id, description, ip_adress, user_id, created_date, created_by, module, trans_type",
        "'', 'Edit Unit Measurement - $KODE', '$IP_ADDRESS','$ID_USER1','$DINO','$ID_USER1','Master','Edit'");
        ?>
        <script>alert('Unit Measurement has been updated! Thank you! ');</script>
        <script>document.location.href='m_um';</script>
        <?php
        die(0); 
        
    }
}

//BARU
if(isset($_POST["simpan"]))
{
    $UM_CODE = createKode("m_um","um_id","UM",4);
    $UM_DESC = $_POST["UM_DESC"];

    InsertData(
    "m_um",
    "um_id, um_desc, created_date, created_by",
    "'$UM_CODE', '$UM_DESC', '$DINO', '$ID_USER1'");

    InsertData(
        "users_log",
        "log_id, description, ip_adress, user_id, created_date, created_by, module, trans_type",
        "'', 'Tambah Unit Measurement - $UM_CODE', '$IP_ADDRESS','$ID_USER1','$DINO','$ID_USER1','Master','Tambah'");

    ?>
    <script>alert('Unit Measurement has been added! Thank you! ');</script>
    <script>document.location.href='m_um';</script>
    <?php
    die(0);
}
?>