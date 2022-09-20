<?php
$DINO             = date('Y-m-d H:i:s');
$ID_USER1         = $_SESSION["LOGINIDUS_VISITOR"];
$IP_ADDRESS       = $_SESSION["IP_ADDRESS_VISITOR"];
$NAMA_USER        = $_SESSION["LOGINNAMAUS_VISITOR"];
$PC_NAME          = gethostbyaddr($IP_ADDRESS);

$DEPARTMENT_CODE  = "";
$DEPARTMENT_NAME  = "";
$STATUS           = "";

//EDIT
if(isset($_GET["KODE"]))
{
    $KODE  = $_GET["KODE"];
    $result        = GetQuery("select * from m_department where dept_id ='$KODE'");
    while ($row = $result->fetch(PDO::FETCH_ASSOC))
    {
        $DEPARTMENT_CODE     = $row["dept_id"];
        $DEPARTMENT_NAME     = $row["dept_name"];
        $STATUS              = $row["status"];
    }

    if(isset($_POST["simpan"]))
    {
        $DEPARTMENT_CODE     = $_POST["DEPARTMENT_CODE"];
        $DEPARTMENT_NAME     = $_POST["DEPARTMENT_NAME"];
        $STATUS              = $_POST["STATUS"];

        UpdateData(
        "m_department",
        "dept_id = '$DEPARTMENT_CODE', dept_name = '$DEPARTMENT_NAME', status = '$STATUS', modified_date = '$DINO', modified_by = '$ID_USER1'",
        "dept_id = '$KODE'");

        InsertData(
        "users_log",
        "log_id, description, ip_adress, user_id, created_date, created_by, module, trans_type",
        "'', 'Edit Department - $DEPARTMENT_CODE', '$IP_ADDRESS','$ID_USER1','$DINO','$ID_USER1','Master','Edit'");
        ?>
        <script>alert('Department has been updated! Thank you! ');</script>
        <script>document.location.href='m_department';</script>
        <?php
        die(0); 
        
    }
}

//BARU
if(isset($_POST["simpan"]))
{
    $DEPARTMENT_CODE     = $_POST["DEPARTMENT_CODE"];
    $DEPARTMENT_NAME     = $_POST["DEPARTMENT_NAME"];

    InsertData(
    "m_department",
    "dept_id, dept_name, created_date, created_by",
    "'$DEPARTMENT_CODE','$DEPARTMENT_NAME', '$DINO', '$ID_USER1'");

    InsertData(
        "users_log",
        "log_id, description, ip_adress, user_id, created_date, created_by, module, trans_type",
        "'', 'Tambah Department - $DEPARTMENT_CODE', '$IP_ADDRESS','$ID_USER1','$DINO','$ID_USER1','Master','Tambah'");

    ?>
    <script>alert('Department has been added! Thank you! ');</script>
    <script>document.location.href='m_department';</script>
    <?php
    die(0);
}
?>