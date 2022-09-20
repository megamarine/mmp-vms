<?php
include "assets/phpqrcode/qrlib.php";

$DINO              = date("Y-m-d H:i:s");
$DATE              = date("Ymd");
$TIME              = date("H:i:s");
$TIMES             = date("His");
$T                 = date("y");
$Z                 = date("Y");
$X                 = date("m");
$V                 = date("d");
$ID_USER1          = $_SESSION["LOGINIDUS_VISITOR"];
$NAMA_USER         = $_SESSION["LOGINNAMAUS_VISITOR"];
$IP_ADDRESS        = $_SESSION["IP_ADDRESS_VISITOR"];
$PC_NAME           = $_SESSION["PC_NAME_VISITOR"];
$UNIQCODE          = $_SESSION["UNIQCODE_VISITOR"];
$KODE_TAMU         = createKode("t_vms","vms_id","VMS"."-$Z$X-",4);

$VISITOR_ASAL      = "";
$VISITOR_TYPE      = "";
$PURPOSE           = "";
$PIC               = "";
$KITAS_TYPE        = "";
$KITAS_NO          = "";
$VISITOR_NAME      = "";
$VISITOR_PHONE     = "";
$COMPANY           = "";

$CAR_NO            = "";
$CAR_TYPE          = "";
$CAR_QTY           = "";
$CAR_QTY_UM        = "";
$SIM_TYPE          = "";
$SIM_NO            = "";
$SIM_EXP           = "";

$CEK_SUHU          = "";
$MCU_TYPE          = "";
$MCU_RESULT        = "";
$MCU_DATE          = "";
$GEJALA_FLU        = "";
$FOTO_VISITOR      = "";
$FOTO_DOC          = "";
$RFID_NO           = "";

$FTVIS             = "";
$FTVIS_temp        = "";
$FTDOC             = "";
$FTDOC_temp        = "";

$VMS_ID            = "";

//------------------------------------------- CHECKIN ---------------------------------------------------------------------
if(isset($_POST["simpan"]))
{
    $VISITOR_ASAL      = $_POST["VISITOR_ASAL"];
    $VISITOR_TYPE      = $_POST["VISITOR_TYPE"];
    $PURPOSE           = $_POST["PURPOSE"];
    $PIC               = $_POST["PIC"];
    $KITAS_TYPE        = $_POST["KITAS_TYPE"];
    $KITAS_NO          = $_POST["KITAS_NO"];
    $VISITOR_NAME      = $_POST["VISITOR_NAME"];
    $VISITOR_PHONE     = $_POST["VISITOR_PHONE"];
    $COMPANY           = $_POST["COMPANY"];

    $CEK_SUHU          = $_POST["CEK_SUHU"];
    $MCU_TYPE          = $_POST["MCU_TYPE"];
    $MCU_RESULT        = $_POST["MCU_RESULT"];
    $MCU_DATE          = $_POST["MCU_DATE"] ?? "default";
    $GEJALA_FLU        = $_POST["GEJALA_FLU"];
    $RFID_NO           = $_POST["RFID_NO"];
    
    $CAR_NO            = $_POST["CAR_NO"] ?? "default";
    $CAR_TYPE          = $_POST["CAR_TYPE"] ?? "default";
    $CAR_QTY           = $_POST["CAR_QTY"] ?? "default";
    $CAR_QTY_UM        = $_POST["CAR_QTY_UM"] ?? "default";
    $SIM_TYPE          = $_POST["SIM_TYPE"] ?? "default";
    $SIM_NO            = $_POST["SIM_NO"] ?? "default";
    $SIM_EXP           = $_POST["SIM_EXP"] ?? "default";

    $VMS_ID           = $_POST["VMS_ID"];

    //masa berlaku dokumen mcu = tanggal mcu + 6 hari
    $MCU_EXP_DATE = date('Y-m-d', strtotime('+6 days', strtotime($MCU_DATE)));

    //ambil foto temp
    $stmt0  = GetQuery("select name from temp_vms_pic where name = '$UNIQCODE'");
    while ($row0 = $stmt0->fetch(PDO::FETCH_ASSOC))
    {
        $FTVIS = $row0["name"];
    }

    //ambil foto temp_id
    $stmt1  = GetQuery("select name from temp_vms_doc where name = '$UNIQCODE'");
    while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC))
    {
        $FTDOC = $row1["name"];
    }

    //move file dari direktori temp_vms_pic ke direktori vms_pic + deklarasi path foto
    if ($FTVIS)
    {
        $FTVIS_temp = "temp_vms_pic/".$UNIQCODE.".jpg";
    };    
    
    $FTVIS2 = "vms_pic/".$KODE_TAMU.".jpg";
    if (($FTVIS_temp) && ($FTVIS2))
    {    
      if(!rename($FTVIS_temp, $FTVIS2))
      {
        //do nothing
      }
      else
      {
        //delete data yg sudah dipindah dari table vims_temp
        GetQuery("delete from temp_vms_pic where name = '$UNIQCODE'");
      }
    }

    //move file dari direktori temp_vms_doc ke direktori vms_doc + deklarasi path foto
    if ($FTDOC)
    { 
        $FTDOC_temp = "temp_vms_doc/".$UNIQCODE.".jpg"; 
    }

    $FTDOC2     = "vms_doc/".$KODE_TAMU.".jpg";
    if (($FTDOC_temp) && ($FTDOC2))
    {
      if(!rename($FTDOC_temp, $FTDOC2))
      {
        //do nothing
      }
      else
      {
        //delete data yg sudah dipindah dari table vims_temp_id
        GetQuery("delete from temp_vms_doc where name = '$UNIQCODE'");
      }
    }

    // $NAMA_FILE = preg_replace("/[^a-zA-Z0-9]/", "", $KODE_TAMU);

    // buat QR
    QRcode::png("$KODE_TAMU", "qrcode/$KODE_TAMU.png");

    if ($VMS_ID != "") {
      UpdateData(
        "t_vms",
        "vms_date = '".$DINO."', 
        visitor_asal = '".$VISITOR_ASAL."', 
        visitor_type = '".$VISITOR_TYPE."', 
        purpose_id = '".$PURPOSE."', 
        pic = '".$PIC."', 
        kitas_type = '".$KITAS_TYPE."', 
        kitas_no = '".$KITAS_NO."', 
        visitor_name = '".$VISITOR_NAME."', 
        visitor_phone = '".$VISITOR_PHONE."', 
        company_id = '".$COMPANY."', 
        cek_suhu = '".$CEK_SUHU."', 
        mcu_type = '".$MCU_TYPE."', 
        mcu_result = '".$MCU_RESULT."', 
        mcu_date = '".$MCU_DATE."',
        mcu_exp_date = '".$MCU_EXP_DATE."',
        gejala_flu = '".$GEJALA_FLU."', 
        card_no = '".$RFID_NO."', 
        vehicle_no = '".$CAR_NO."', 
        vehicle_type = '".$CAR_TYPE."', 
        vehicle_qty = '".$CAR_QTY."', 
        um_id = '".$CAR_QTY_UM."', 
        sim_type = '".$SIM_TYPE."', 
        sim_no = '".$SIM_NO."', 
        sim_exp = '".$SIM_EXP."', 
        photo_path = '".$FTVIS2."', 
        doc_path = '".$FTDOC2."', 
        checkin_date = '".$DINO."', 
        state = '1', 
        status_visitor = '1', 
        created_date = '".$DINO."', 
        created_by = '".$ID_USER1."'",
        "vms_id = '$VMS_ID'");
    }
    else {
      InsertData(
        "t_vms",
        "vms_id, 
        vms_date, 
        visitor_asal, 
        visitor_type, 
        purpose_id, 
        pic, 
        kitas_type, 
        kitas_no, 
        visitor_name, 
        visitor_phone, 
        company_id, 
        cek_suhu, 
        mcu_type, 
        mcu_result, 
        mcu_date,
        mcu_exp_date,
        gejala_flu, 
        card_no, 
        vehicle_no, 
        vehicle_type, 
        vehicle_qty, 
        um_id, 
        sim_type, 
        sim_no, 
        sim_exp, 
        photo_path, 
        doc_path, 
        checkin_date, 
        state, 
        status_visitor, 
        created_date, 
        created_by",
      "'$KODE_TAMU',
        '$DINO',
        '$VISITOR_ASAL',
        '$VISITOR_TYPE',
        '$PURPOSE',
        '$PIC',
        '$KITAS_TYPE',
        '$KITAS_NO',
        '$VISITOR_NAME',
        '$VISITOR_PHONE',
        '$COMPANY',
        '$CEK_SUHU',
        '$MCU_TYPE',
        '$MCU_RESULT',
        '$MCU_DATE',
        '$MCU_EXP_DATE',
        '$GEJALA_FLU',
        '$RFID_NO',
        '$CAR_NO',
        '$CAR_TYPE',
        '$CAR_QTY',
        '$CAR_QTY_UM',
        '$SIM_TYPE',
        '$SIM_NO',
        '$SIM_EXP',
        '$FTVIS2',
        '$FTDOC2',
        '$DINO',
        '1',
        '1',
        '$DINO',
        '$ID_USER1'");    
    }
    
    //update status card yang dipakai
    UpdateData(
    "m_card",
    "status='1'",
    "card_no = '$RFID_NO'");

    //insert userlog
    InsertData(
    "users_log",
    "description, ip_adress, user_id, created_date, created_by, module, trans_type",
    "'Kode = $KODE_TAMU','$IP_ADDRESS','$ID_USER1','$DINO','$ID_USER1','VMS','Checkin Outside'");
            
    ?>
    <script>window.open("print_vms.php?KODE_TAMU=<?=$KODE_TAMU; ?>);</script>
    <script>document.location.href='vmso'</script>
    <?php
    die(0);   
}

//----------------------------------------- CHECKOUT ---------------------------------------------------------------------
if(isset($_POST["simpan2"]))
{
    $KODE_TAMU = $_POST["KODE_TAMU"];
    $REMARK    = $_POST["REMARK"];

    $stmt1 = GetQuery("select card_no from t_vms where vms_id = '$KODE_TAMU'");
    while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC))
    {
        $NO_KARTU   = $row1["card_no"];
        //Release status rfid
        UpdateData(
        "m_card",
        "status=0",
        "card_no = '$NO_KARTU'");
    }

    UpdateData(
    "t_vms",
    "checkout_date='$DINO', status_visitor=0, state=0, modified_date='$DINO', modified_by='$ID_USER1', remark='$REMARK'",
    "vms_id = '$KODE_TAMU'");

    InsertData(
    "users_log",
    "description, ip_adress, user_id, created_date, created_by, module, trans_type",
    "'Kode = $KODE_TAMU','$IP_ADDRESS','$ID_USER1','$DINO','$ID_USER1','VMS','Checkout Outside'");
    ?>
    <script>alert('Checkout Successfully!');</script>
    <script>document.location.href='vmso';</script>
    <?php
    die(0);
}
?>