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
    $result     = GetQuery("select * from m_vehicle where vehicle_id ='$KODE'");
    while ($row = $result->fetch(PDO::FETCH_ASSOC))
    {
        $VEHICLE_NAME = $row["vehicle_name"];
        $SIZE         = $row["size"];
        $UM_CODE      = $row["um_id"];
        $STATUS       = $row["status"];
    }

    if(isset($_POST["simpan"]))
    {
        $VEHICLE_NAME = $_POST["VEHICLE_NAME"];
        $SIZE         = $_POST["SIZE"];
        $UM_CODE      = $_POST["UM_CODE"];
        $STATUS       = $_POST["STATUS"];

        UpdateData(
        "m_vehicle",
        "vehicle_name = '$VEHICLE_NAME', size = '$SIZE', um_id = '$UM_CODE', status = '$STATUS', modified_date = '$DINO', modified_by = '$ID_USER1'",
        "vehicle_id = '$KODE'");

        InsertData(
        "users_log",
        "log_id, description, ip_adress, user_id, created_date, created_by, module, trans_type",
        "'', 'Edit Vehicle - $KODE', '$IP_ADDRESS','$ID_USER1','$DINO','$ID_USER1','Master','Edit'");
        ?>
        <script>alert('Vehicle has been updated! Thank you! ');</script>
        <script>document.location.href='m_vehicle';</script>
        <?php
        die(0); 
        
    }
}

//BARU
if(isset($_POST["simpan"]))
{
    $VEHICLE_CODE = createKode("m_vehicle","vehicle_id","VHC",4);
    $VEHICLE_NAME = $_POST["VEHICLE_NAME"];
    $SIZE         = $_POST["SIZE"];
    $UM_CODE      = $_POST["UM_CODE"];

    InsertData(
    "m_vehicle",
    "vehicle_id, vehicle_name, size, um_id, created_date, created_by",
    "'$VEHICLE_CODE', '$VEHICLE_NAME', '$SIZE', '$UM_CODE', '$DINO', '$ID_USER1'");

    InsertData(
        "users_log",
        "log_id, description, ip_adress, user_id, created_date, created_by, module, trans_type",
        "'', 'Tambah Vehicle - $VEHICLE_CODE', '$IP_ADDRESS','$ID_USER1','$DINO','$ID_USER1','Master','Tambah'");

    ?>
    <script>alert('Vehicle has been added! Thank you! ');</script>
    <script>document.location.href='m_vehicle';</script>
    <?php
    die(0);
}
?>