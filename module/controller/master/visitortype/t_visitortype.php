<?php
$DINO             = date('Y-m-d H:i:s');
$ID_USER1         = $_SESSION["LOGINIDUS_VISITOR"];
$IP_ADDRESS       = $_SESSION["IP_ADDRESS_VISITOR"];
$NAMA_USER        = $_SESSION["LOGINNAMAUS_VISITOR"];
$PC_NAME          = gethostbyaddr($IP_ADDRESS);

//EDIT
if(isset($_GET["KODE"]))
{
    $KODE   = $_GET["KODE"];
    $result = GetQuery("select * from m_visitortype where visitortype_id ='$KODE'");
    while ($row = $result->fetch(PDO::FETCH_ASSOC))
    {
        $VISITORTYPE_NAME = $row["visitortype_name"];
        $STATUS           = $row["status"];
    }

    if(isset($_POST["simpan"]))
    {
        $VISITORTYPE_NAME = $_POST["VISITORTYPE_NAME"];
        $STATUS           = $_POST["STATUS"];

        UpdateData(
        "m_visitortype",
        "visitortype_name = '$VISITORTYPE_NAME', status = '$STATUS', modified_date = '$DINO', modified_by = '$ID_USER1'",
        "visitortype_id = '$KODE'");

        InsertData(
        "users_log",
        "log_id, description, ip_adress, user_id, created_date, created_by, module, trans_type",
        "'', 'Edit Visitor Type - $KODE', '$IP_ADDRESS','$ID_USER1','$DINO','$ID_USER1','Master','Edit'");
        ?>
        <script>alert('Visitor Type has been updated! Thank you! ');</script>
        <script>document.location.href='m_visitortype';</script>
        <?php
        die(0); 
        
    }
}

//BARU
if(isset($_POST["simpan"]))
{
    $VISITORTYPE_CODE = createKode("m_visitortype","visitortype_id","VIS",4);
    $VISITORTYPE_NAME = $_POST["VISITORTYPE_NAME"];

    InsertData(
    "m_visitortype",
    "visitortype_id, visitortype_name, created_date, created_by",
    "'$VISITORTYPE_CODE', '$VISITORTYPE_NAME', '$DINO', '$ID_USER1'");

    InsertData(
        "users_log",
        "log_id, description, ip_adress, user_id, created_date, created_by, module, trans_type",
        "'', 'Tambah Visitor Type - $VISITORTYPE_CODE', '$IP_ADDRESS','$ID_USER1','$DINO','$ID_USER1','Master','Tambah'");

    ?>
    <script>alert('Visitor Type has been added! Thank you! ');</script>
    <script>document.location.href='m_visitortype';</script>
    <?php
    die(0);
}
?>