<?php
$DINO           = date('Y-m-d H:i:s');
$ID_USER1       = $_SESSION["LOGINIDUS_VISITOR"];
$IP_ADDRESS     = $_SESSION["IP_ADDRESS_VISITOR"];
$NAMA_USER      = $_SESSION["LOGINNAMAUS_VISITOR"];
$PC_NAME        = gethostbyaddr($IP_ADDRESS);

$EMPLOYEES_CODE = "";
$EMPLOYEES_NAME = "";
$DEPARTMENT_CODE= "";
$DIVISION_CODE  = "";
$LEVEL_CODE     = "";
$RFID_NUMBER    = "";
$STATUS         = "";

//EDIT
if(isset($_GET["KODE"]))
{
    $KODE  = $_GET["KODE"];
    $result     = GetQuery("select * from m_employees where employees_id ='$KODE'");
    while ($row = $result->fetch(PDO::FETCH_ASSOC))
    {
        $EMPLOYEES_CODE  = $row["employees_id"];
        $EMPLOYEES_NAME  = $row["employees_name"];
        $DEPARTMENT_CODE = $row["dept_id"];
        $DIVISION_CODE   = $row["div_id"];
        $LEVEL_CODE      = $row["level_id"];
        $RFID_NUMBER     = $row["rfid_number"];
        $STATUS          = $row["status"];
    }

    if(isset($_POST["simpan"]))
    {
        $EMPLOYEES_CODE  = $_POST["EMPLOYEES_CODE"];
        $EMPLOYEES_NAME  = $_POST["EMPLOYEES_NAME"];
        $DEPARTMENT_CODE = $_POST["DEPARTMENT_CODE"];
        $DIVISION_CODE   = $_POST["DIVISION_CODE"];
        $LEVEL_CODE      = $_POST["LEVEL_CODE"];
        $RFID_NUMBER     = $_POST["RFID_NUMBER"];
        $STATUS          = $_POST["STATUS"];

        UpdateData(
        "m_employees",
        "employees_id = '$EMPLOYEES_CODE', employees_name = '$EMPLOYEES_NAME', dept_id = '$DEPARTMENT_CODE', div_id = '$DIVISION_CODE', level_id = '$LEVEL_CODE', rfid_number = '$RFID_NUMBER', status = '$STATUS', modified_date = '$DINO', modified_by = '$ID_USER1'",
        "employees_id = '$KODE'");

        InsertData(
        "users_log",
        "log_id, description, ip_adress, user_id, created_date, created_by, module, trans_type",
        "'', 'Edit Employees - $EMPLOYEES_CODE', '$IP_ADDRESS','$ID_USER1','$DINO','$ID_USER1','Master','Edit'");
        ?>
        <script>alert('Employees has been updated! Thank you! ');</script>
        <script>document.location.href='m_employees';</script>
        <?php
        die(0); 
        
    }
}

//BARU
if(isset($_POST["simpan"]))
{
    $EMPLOYEES_CODE  = $_POST["EMPLOYEES_CODE"];
    $EMPLOYEES_NAME  = $_POST["EMPLOYEES_NAME"];
    $DEPARTMENT_CODE = $_POST["DEPARTMENT_CODE"];
    $DIVISION_CODE   = $_POST["DIVISION_CODE"];
    $LEVEL_CODE      = $_POST["LEVEL_CODE"];
    $RFID_NUMBER     = $_POST["RFID_NUMBER"];

    InsertData(
    "m_employees",
    "employees_id, employees_name, dept_id, div_id, level_id, rfid_number, created_date, created_by",
    "'$EMPLOYEES_CODE', '$EMPLOYEES_NAME', '$DEPARTMENT_CODE', '$DIVISION_CODE', '$LEVEL_CODE', '$RFID_NUMBER', '$DINO', '$ID_USER1'");

    InsertData(
        "users_log",
        "log_id, description, ip_adress, user_id, created_date, created_by, module, trans_type",
        "'', 'Tambah Level - $LEVEL_CODE', '$IP_ADDRESS','$ID_USER1','$DINO','$ID_USER1','Master','Tambah'");

    ?>
    <script>alert('Level has been added! Thank you! ');</script>
    <script>document.location.href='m_employees';</script>
    <?php
    die(0);
}
?>