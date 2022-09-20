<?php
$DINO            = date('Y-m-d H:i:s');
$ID_USER1        = $_SESSION["LOGINIDUS_VISITOR"];
$IP_ADDRESS      = $_SESSION["IP_ADDRESS_VISITOR"];
$NAMA_USER       = $_SESSION["LOGINNAMAUS_VISITOR"];
$PC_NAME         = gethostbyaddr($IP_ADDRESS);

$DEPARTMENT_CODE = "";
$DIVISION_CODE   = "";
$DIVISION_NAME   = "";
$STATUS          = "";

//EDIT
if(isset($_GET["KODE"]))
{
    $KODE  = $_GET["KODE"];
    $result        = GetQuery("select * from m_division where div_id ='$KODE'");
    while ($row = $result->fetch(PDO::FETCH_ASSOC))
    {
        $DEPARTMENT_CODE = $row["dept_id"];
        $DIVISION_CODE   = $row["div_id"];
        $DIVISION_NAME   = $row["div_name"];
        $STATUS          = $row["status"];
    }

    if(isset($_POST["simpan"]))
    {
        $DEPARTMENT_CODE = $_POST["DEPARTMENT_CODE"];
        $DIVISION_CODE   = $_POST["DIVISION_CODE"];
        $DIVISION_NAME   = $_POST["DIVISION_NAME"];
        $STATUS          = $_POST["STATUS"];

        UpdateData(
        "m_division",
        "dept_id = '$DEPARTMENT_CODE', div_id = '$DIVISION_CODE', div_name = '$DIVISION_NAME', status = '$STATUS', modified_date = '$DINO', modified_by = '$ID_USER1'",
        "div_id = '$KODE'");

        InsertData(
        "users_log",
        "log_id, description, ip_adress, user_id, created_date, created_by, module, trans_type",
        "'', 'Edit Division - $DIVISION_CODE', '$IP_ADDRESS','$ID_USER1','$DINO','$ID_USER1','Master','Edit'");
        ?>
        <script>alert('Division has been updated! Thank you! ');</script>
        <script>document.location.href='m_division';</script>
        <?php
        die(0); 
        
    }
}

//BARU
if(isset($_POST["simpan"]))
{
    $DEPARTMENT_CODE = $_POST["DEPARTMENT_CODE"];
    $DIVISION_CODE   = $_POST["DIVISION_CODE"];
    $DIVISION_NAME   = $_POST["DIVISION_NAME"];

    InsertData(
    "m_division",
    "dept_id, div_id, div_name, created_date, created_by",
    "'$DEPARTMENT_CODE', '$DIVISION_CODE', '$DIVISION_NAME', '$DINO', '$ID_USER1'");

    InsertData(
        "users_log",
        "log_id, description, ip_adress, user_id, created_date, created_by, module, trans_type",
        "'', 'Tambah Division - $DIVISION_CODE', '$IP_ADDRESS','$ID_USER1','$DINO','$ID_USER1','Master','Tambah'");

    ?>
    <script>alert('Division has been added! Thank you! ');</script>
    <script>document.location.href='m_division';</script>
    <?php
    die(0);
}
?>