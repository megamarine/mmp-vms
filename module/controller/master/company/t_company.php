<?php
$DINO            = date('Y-m-d H:i:s');
$ID_USER1        = $_SESSION["LOGINIDUS_VISITOR"];
$IP_ADDRESS      = $_SESSION["IP_ADDRESS_VISITOR"];
$NAMA_USER       = $_SESSION["LOGINNAMAUS_VISITOR"];
$PC_NAME         = gethostbyaddr($IP_ADDRESS);

//EDIT
if(isset($_GET["KODE"]))
{
    $KODE   = $_GET["KODE"];
    $result = GetQuery("select * from m_company where company_id ='$KODE'");
    while ($row = $result->fetch(PDO::FETCH_ASSOC))
    {
        $COMPANY_NAME    = $row["company_name"];
        $COMPANY_TYPE    = $row["company_type"];
        $COMPANY_ADDRESS = $row["company_address"];
        $COMPANY_PHONE   = $row["company_phone"];
        $COMPANY_EMAIL   = $row["company_email"];
        $STATUS          = $row["status"];
    }

    if(isset($_POST["simpan"]))
    {
        $COMPANY_NAME    = $_POST["COMPANY_NAME"];
        $COMPANY_TYPE    = $_POST["COMPANY_TYPE"];
        $COMPANY_ADDRESS = $_POST["COMPANY_ADDRESS"];
        $COMPANY_PHONE   = $_POST["COMPANY_PHONE"];
        $COMPANY_EMAIL   = $_POST["COMPANY_EMAIL"];
        $STATUS          = $_POST["STATUS"];

        UpdateData(
        "m_company",
        "company_name = '$COMPANY_NAME', company_type = '$COMPANY_TYPE', company_address = '$COMPANY_ADDRESS', company_phone = '$COMPANY_PHONE', company_email = '$COMPANY_EMAIL', status = '$STATUS', modified_date = '$DINO', modified_by = '$ID_USER1'",
        "company_id = '$KODE'");

        InsertData(
        "users_log",
        "log_id, description, ip_adress, user_id, created_date, created_by, module, trans_type",
        "'', 'Edit Company - $KODE', '$IP_ADDRESS','$ID_USER1','$DINO','$ID_USER1','Master','Edit'");
        ?>
        <script>alert('Company has been updated! Thank you! ');</script>
        <script>document.location.href='m_company';</script>
        <?php
        die(0); 
        
    }
}

//BARU
if(isset($_POST["simpan"]))
{
    $COMPANY_CODE    = createKode("m_company","company_id","C",4);
    $COMPANY_NAME    = $_POST["COMPANY_NAME"];
    $COMPANY_TYPE    = $_POST["COMPANY_TYPE"];
    $COMPANY_ADDRESS = $_POST["COMPANY_ADDRESS"];
    $COMPANY_PHONE   = $_POST["COMPANY_PHONE"];
    $COMPANY_EMAIL   = $_POST["COMPANY_EMAIL"];

    InsertData(
    "m_company",
    "company_id, company_name, company_type, company_address, company_phone, company_email, created_date, created_by",
    "'$COMPANY_CODE','$COMPANY_NAME','$COMPANY_TYPE','$COMPANY_ADDRESS', '$COMPANY_PHONE', '$COMPANY_EMAIL', '$DINO', '$ID_USER1'");

    InsertData(
        "users_log",
        "log_id, description, ip_adress, user_id, created_date, created_by, module, trans_type",
        "'', 'Tambah Company - $COMPANY_CODE', '$IP_ADDRESS','$ID_USER1','$DINO','$ID_USER1','Master','Tambah'");

    ?>
    <script>alert('Company has been added! Thank you! ');</script>
    <script>document.location.href='m_company';</script>
    <?php
    die(0);
}
?>