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
    $result = GetQuery("select * from m_companytype where type_id ='$KODE'");
    while ($row = $result->fetch(PDO::FETCH_ASSOC))
    {
        $COMPANYTYPE_NAME    = $row["type_name"];
        $STATUS              = $row["status"];
    }

    if(isset($_POST["simpan"]))
    {
        $COMPANYTYPE_NAME    = $_POST["COMPANYTYPE_NAME"];
        $STATUS              = $_POST["STATUS"];

        UpdateData(
        "m_companytype",
        "type_name = '$COMPANYTYPE_NAME', status = '$STATUS', modified_date = '$DINO', modified_by = '$ID_USER1'",
        "type_id = '$KODE'");

        InsertData(
        "users_log",
        "log_id, description, ip_adress, user_id, created_date, created_by, module, trans_type",
        "'', 'Edit Company Type - $KODE', '$IP_ADDRESS','$ID_USER1','$DINO','$ID_USER1','Master','Edit'");
        ?>
        <script>alert('Company Type has been updated! Thank you! ');</script>
        <script>document.location.href='m_companytype';</script>
        <?php
        die(0); 
        
    }
}

//BARU
if(isset($_POST["simpan"]))
{
    $COMPANYTYPE_CODE    = createKode("m_companytype","type_id","CT",4);
    $COMPANYTYPE_NAME    = $_POST["COMPANYTYPE_NAME"];

    InsertData(
    "m_companytype",
    "type_id, type_name, created_date, created_by",
    "'$COMPANYTYPE_CODE','$COMPANYTYPE_NAME', '$DINO', '$ID_USER1'");

    InsertData(
        "users_log",
        "log_id, description, ip_adress, user_id, created_date, created_by, module, trans_type",
        "'', 'Tambah Company Type - $COMPANYTYPE_CODE', '$IP_ADDRESS','$ID_USER1','$DINO','$ID_USER1','Master','Tambah'");

    ?>
    <script>alert('Company Type has been added! Thank you! ');</script>
    <script>document.location.href='m_companytype';</script>
    <?php
    die(0);
}
?>