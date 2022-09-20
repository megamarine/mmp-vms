<?php
$DINO           = date("Y-m-d H:i:s");
$Z              = date("Y");
$X              = date("m");
$TRANS_ID       = createKode("t_kms","kms_id","KMS"."-$Z$X-",4);
$ID_USER1       = $_SESSION["LOGINIDUS_VISITOR"];
$NAMA_USER      = $_SESSION["LOGINNAMAUS_VISITOR"];
$IP_ADDRESS     = $_SESSION["IP_ADDRESS_VISITOR"];
$PC_NAME        = $_SESSION["PC_NAME_VISITOR"];
$KEY_ID         = "";
$RFID           = "";
$NAMA_PEMINJAM  = "";
$REMARK_PINJAM  = "";

//------------------------------------------- KMS PROCESS -----------------------------------------------
if(isset($_GET["TRANS_ID"]))
{
    $TRANS_ID   = $_GET["TRANS_ID"];

    $stmt = GetQuery("select key_id from t_kms where kms_id='$TRANS_ID'");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
    {
        $KEY_ID = $row["key_id"];
    }
    
    if(isset($_POST["simpan"]))
    {
        $RETURN_RFID   = $_POST["RETURN_RFID"];
        $RETURN_NAME   = $_POST["NAME"];
        $RETURN_REMARK = $_POST["RETURN_REMARK"]; 

        UpdateData(
        "t_kms",
        "return_date='$DINO',return_rfid='$RETURN_RFID',return_name='$RETURN_NAME',return_remark='$RETURN_REMARK',status='0', modified_date='$DINO', modified_by='$ID_USER1'",
        "kms_id = '$TRANS_ID'");

        UpdateData(
        "m_key",
        "status = '0'",
        "key_id = '$KEY_ID'");
            
        InsertData(
        "users_log",
        "description, ip_adress, user_id, created_date, created_by, module, trans_type",
        "'Kode = $TRANS_ID','$IP_ADDRESS','$ID_USER1','$DINO','$ID_USER1','PMS','Trans Complete'");
        ?>
        <script>alert('Successfully Saved!');</script>
        <script>document.location.href='kms';</script>
        <?php
        die(0);
    }
}

//------------------------------------------- KMS IN -----------------------------------------------
if(isset($_POST["simpan"]))
{
    $KEY_ID          = $_POST["KEY_ID"];
    $BORROWED_RFID   = $_POST["BORROWED_RFID"];
    $BORROWED_NAME   = $_POST["NAME"];
    $BORROWED_REMARK = $_POST["BORROWED_REMARK"];  

    InsertData(
    "t_kms",
    "kms_id, key_id, borrowed_date, borrowed_rfid, borrowed_name, borrowed_remark, status, created_by, created_date",
    "'$TRANS_ID','$KEY_ID','$DINO','$BORROWED_RFID','$BORROWED_NAME','$BORROWED_REMARK','1','$ID_USER1','$DINO'");

    UpdateData(
    "m_key",
    "status = '1'",
    "key_id = '$KEY_ID'");

    InsertData(
    "users_log",
    "description, ip_adress, user_id, created_date, created_by, module, trans_type",
    "'Kode = $TRANS_ID','$IP_ADDRESS','$ID_USER1','$DINO','$ID_USER1','KMS','New Trans'");
    ?>
    <script>alert('Successfully Added!');</script>
    <script>document.location.href='kms';</script>
    <?php
    die(0);
}
?>