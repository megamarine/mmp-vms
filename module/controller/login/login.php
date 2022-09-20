<?php
$DINO = date('Y-m-d H:i:s');
if(isset($_POST["login"]))
{
    $USERNAME  = $_POST["username"];
    $PASSWORD  = $_POST['password'];

    $stmt      = GetQuery("select * from m_user where kode_user = '$USERNAME'");

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
    {
        $USER_PASSWORD   = $row["password"];
        $STATUS          = $row["status"];
        $IP_ADDRESS      = getIp();
        $PC_NAME         = gethostbyaddr($IP_ADDRESS);

        if ($STATUS == '1'  and password_verify($PASSWORD, $USER_PASSWORD)) 
        { 
            $_SESSION["IP_ADDRESS_VISITOR"]  = $IP_ADDRESS;
            $_SESSION["PC_NAME_VISITOR"]     = $PC_NAME;
            $_SESSION["LOGINIDUS_VISITOR"]   = $row["kode_user"];
            $_SESSION["LOGINNAMAUS_VISITOR"] = $row["nama_user"];
            $_SESSION["LOGINAKS_VISITOR"]    = $row["akses"];
            $_SESSION["UNIQCODE_VISITOR"]    = date("ymdHis").rand(10000,99999);
            $ID_USER1                        = $_SESSION["LOGINIDUS_VISITOR"];

            InsertData(
                "users_log",
                "log_id,description, ip_adress, user_id, created_date, created_by, module, trans_type",
                "'','User login','$IP_ADDRESS','$ID_USER1','$DINO','$ID_USER1','Login','Login'");
           
           ?><script>document.location.href='menuutama';</script><?php
            die(0);
        }
        else 
        {
            ?><script>alert('Incorrect Username or Password / Access Denied!');</script><?php
            ?><script>document.location.href='index';</script><?php
            die(0);
        } 
    }
}
?>