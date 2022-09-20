<?php
$DINO         = date('Y-m-d H:i:s');
$ID_USER1     = $_SESSION["LOGINIDUS_VISITOR"];
$IP_ADDRESS   = $_SESSION["IP_ADDRESS_VISITOR"];
$NAMA_USER    = $_SESSION["LOGINNAMAUS_VISITOR"];
$PC_NAME      = gethostbyaddr($IP_ADDRESS);

//EDIT
if(isset($_GET["KODE"]))
{
    $KODE  = $_GET["KODE"];
    $result     = GetQuery("select * from m_purpose where purpose_id ='$KODE'");
    while ($row = $result->fetch(PDO::FETCH_ASSOC))
    {
        $PURPOSE_NAME = $row["purpose_desc"];
        $STATUS       = $row["status"];
    }

    if(isset($_POST["simpan"]))
    {
        $PURPOSE_NAME = $_POST["PURPOSE_NAME"];
        $STATUS       = $_POST["STATUS"];

        UpdateData(
        "m_purpose",
        "purpose_desc = '$PURPOSE_NAME', status = '$STATUS', modified_date = '$DINO', modified_by = '$ID_USER1'",
        "purpose_id = '$KODE'");

        InsertData(
        "users_log",
        "log_id, description, ip_adress, user_id, created_date, created_by, module, trans_type",
        "'', 'Edit Purpose - $KODE', '$IP_ADDRESS','$ID_USER1','$DINO','$ID_USER1','Master','Edit'");
        ?>
        <script>alert('Purpose has been updated! Thank you! ');</script>
        <script>document.location.href='m_purpose';</script>
        <?php
        die(0); 
        
    }
}

//BARU
if(isset($_POST["simpan"]))
{
    $PURPOSE_CODE = createKode("m_purpose","purpose_id","PRP",4);
    $PURPOSE_NAME = $_POST["PURPOSE_NAME"];

    InsertData(
    "m_purpose",
    "purpose_id, purpose_desc, created_date, created_by",
    "'$PURPOSE_CODE', '$PURPOSE_NAME', '$DINO', '$ID_USER1'");

    InsertData(
        "users_log",
        "log_id, description, ip_adress, user_id, created_date, created_by, module, trans_type",
        "'', 'Tambah Purpose - $PURPOSE_CODE', '$IP_ADDRESS','$ID_USER1','$DINO','$ID_USER1','Master','Tambah'");

    ?>
    <script>alert('Purpose has been added! Thank you! ');</script>
    <script>document.location.href='m_purpose';</script>
    <?php
    die(0);
}
?>