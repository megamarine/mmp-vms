<?php
include "assets/phpqrcode/qrlib.php"; 

$DINO               = date("Y-m-d H:i:s");
$DATE               = date("Ymd");
$TIME               = date("H:i:s");
$TIMES              = date("His");
$T                  = date("y");
$Z                  = date("Y");
$X                  = date("m");
$V                  = date("d");
$ID_USER1           = $_SESSION["LOGINIDUS_VISITOR"];
$NAMA_USER          = $_SESSION["LOGINNAMAUS_VISITOR"];
$IP_ADDRESS         = $_SESSION["IP_ADDRESS_VISITOR"];
$PC_NAME            = $_SESSION["PC_NAME_VISITOR"];
$PERUSAHAAN_USER    = $_SESSION["LOGINPER_VISITOR"];
$KODE_TAMU          = createKode("trans_vms","vms_id","$T"."/M/VMS/",7);

$VISITOR_TYPE       = "";
$PRE_APPROVAL_NO    = "";
$FINAL_APPROVAL_NO  = "";
$PURPOSE            = "";
$PIC                = "";
$VISITOR_ASAL       = "";
$VISITOR_NAME       = "";
$VISITOR_PHONE      = "";
$COMPANY            = "";
$KITAS_TYPE         = "";
$KITAS_NO           = "";
$CEK_SUHU           = "";
$MCU_TYPE           = "";
$MCU_RESULT         = "";
$MCU_DATE           = "";
$SMELL_TEST         = "";
$GEJALA_FLU         = "";
$RFID_NO            = "";
$FOTO_VISITOR       = "";
$FOTO_DOC           = "";
$CAR_TYPE           = "";
$CAR_BRAND          = "";
$CAR_NO             = "";
$CAR_QTY            = "";
$CAR_QTY_UM         = "";
$SIM_TYPE           = "";
$SIM_NO             = "";
$FTVIS              = "";
$FTVIS_temp         = "";
$FTDOC              = "";
$FTDOC_temp         = "";
$SIM_EXP            = "";
$DRIVER_PENGGANTI   = "";

//------------------------------------------- CHECKIN ---------------------------------------------------------------------
if(isset($_POST["simpan"]))
{
    $ai_users_log       = kodeAuto("users_log","log_id");
    $VISITOR_ASAL       = $_POST["VISITOR_ASAL"];
    $VISITOR_TYPE       = $_POST["VISITOR_TYPE"];
    $PRE_APPROVAL_NO    = $_POST["PRE_APPROVAL_NO"];
    $FINAL_APPROVAL_NO  = $_POST["FINAL_APPROVAL_NO"];
    $PURPOSE            = $_POST["PURPOSE"];
    $PIC                = $_POST["PIC"];
    $VISITOR_NAME       = $_POST["VISITOR_NAME"];
    $VISITOR_PHONE      = $_POST["VISITOR_PHONE"];
    $COMPANY            = $_POST["COMPANY"];
    $KITAS_TYPE         = $_POST["KITAS_TYPE"];
    $KITAS_NO           = $_POST["KITAS_NO"];
    $CEK_SUHU           = $_POST["CEK_SUHU"];
    $MCU_TYPE           = $_POST["MCU_TYPE"];
    $MCU_RESULT         = $_POST["MCU_RESULT"];
    $MCU_DATE           = $_POST["MCU_DATE"];
    $SMELL_TEST         = $_POST["SMELL_TEST"];
    $GEJALA_FLU         = $_POST["GEJALA_FLU"];
    $RFID_NO            = $_POST["RFID_NO"];
    
    //SET NULL JIKA "PICKED BY COMPANY" DICENTANG
    if(isset($_POST["PICKED"]))
    {
        $CAR_TYPE   = "";
        $CAR_BRAND  = "";
        $CAR_NO     = "";
        $SIM_TYPE   = "";
        $SIM_NO     = "";
        $SIM_EXP    = "";
    }
    else
    {
        $CAR_TYPE           = $_POST["CAR_TYPE"];
        $CAR_BRAND          = $_POST["CAR_BRAND"];
        $CAR_NO             = $_POST["CAR_NO"];
        $CAR_QTY            = $_POST["CAR_QTY"];
        $CAR_QTY_UM         = $_POST["CAR_QTY_UM"];
        $SIM_TYPE           = $_POST["SIM_TYPE"];
        $SIM_NO             = $_POST["SIM_NO"];
        $SIM_EXP            = $_POST["SIM_EXP"];

        if(isset($_POST["DRIVER_PENGGANTI"]))
        {
            $DRIVER_PENGGANTI   = $_POST["DRIVER_PENGGANTI"];
        }
    }

    $MCU_EXP_DATE       = date('Y-m-d', strtotime('+6 days', strtotime($MCU_DATE)));

    //ambil foto temp
    $stmt0  = GetQuery("select name from vims_temp order by id asc");
    while ($row0 = $stmt0->fetch(PDO::FETCH_ASSOC))
    {
        $FTVIS = $row0["name"];
    }

    //ambil foto temp_id
    $stmt1  = GetQuery("select name from vims_temp_id order by id asc");
    while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC))
    {
        $FTDOC = $row1["name"];
    }

    //move file dari direktori temp_visitor ke direktori foto_visitor + deklarasi path foto
    $NEWNAMEVIS = str_replace('/', '', $KODE_TAMU);
    if ($FTVIS)
    {
        $FTVIS_temp = "temp_visitor/".$FTVIS.".jpg";
    };    
    
    $FTVIS2     = "foto_visitor/".$NEWNAMEVIS.".jpg";
    if (($FTVIS_temp) && ($FTVIS2))
    {    
      if(!rename($FTVIS_temp, $FTVIS2))
      {
        //do nothing
      }
      else
      {
        //delete data yg sudah dipindah dari table vims_temp
        GetQuery("delete from vims_temp");
      }
    }

    //move file dari direktori temp_doc ke direktori foto_doc + deklarasi path foto
    $NEWNAMEDOC = str_replace('/', '', $KODE_TAMU);
    IF ($FTDOC)
    { $FTDOC_temp = "temp_doc/".$FTDOC.".jpg"; }

    $FTDOC2     = "foto_doc/".$NEWNAMEDOC.".jpg";

    if (($FTDOC_temp) && ($FTDOC2))
    {
      if(!rename($FTDOC_temp, $FTDOC2))
      {
        //do nothing
      }
      else
      {
        //delete data yg sudah dipindah dari table vims_temp_id
        GetQuery("delete from vims_temp_id");
      }
    }

    $NAMA_FILE = preg_replace("/[^a-zA-Z0-9]/", "", $KODE_TAMU);

    // buat QR
    QRcode::png("$KODE_TAMU", "qrcode/$NAMA_FILE.png");


    if(isset($_POST["PICKED"]))
    {
        InsertData(
        "vims_reg",
        "vm_no, vm_date, plant_id, company_id, visitor_asal, visitor_type, visitor_name, visitor_phone, kitas_type, kitas_no, purpose_id, pic, cek_suhu, mcu_type, mcu_result, smell_test, gejala_flu, pre_approval_no, final_approval_no, photo_path, doc_path, rfid_no, checkin_date, state, status_visitor, created_date, created_by",
        "'$KODE_TAMU','$DINO','$PERUSAHAAN_USER','$COMPANY','$VISITOR_ASAL','$VISITOR_TYPE','$VISITOR_NAME','$VISITOR_PHONE','$KITAS_TYPE','$KITAS_NO','$PURPOSE','$PIC','$CEK_SUHU','$MCU_TYPE','$MCU_RESULT','$SMELL_TEST','$GEJALA_FLU','$PRE_APPROVAL_NO','$FINAL_APPROVAL_NO','$FTVIS2','$FTDOC2','$RFID_NO','$DINO','1','1','$DINO','$NAMA_USER'");
        echo("<br> b");

        if($_POST["MCU_DATE"] != '')
        {
            UpdateData("vims_reg","mcu_date='$MCU_DATE', mcu_exp_date='$MCU_EXP_DATE'","vm_no = '$KODE_TAMU'");
        }
    }
    else
    {
        InsertData(
        "vims_reg",
        "vm_no, vm_date, plant_id, company_id, visitor_asal, visitor_type, visitor_name, visitor_phone, kitas_type, kitas_no, purpose_id, pic, cek_suhu, mcu_type, mcu_result, smell_test, gejala_flu, car_type, car_brand, car_no, car_qty, car_qty_um, sim_type, sim_no, driver_pengganti, pre_approval_no, final_approval_no, photo_path, doc_path, rfid_no, checkin_date, state, status_visitor, created_date, created_by",
        "'$KODE_TAMU','$DINO','$PERUSAHAAN_USER','$COMPANY','$VISITOR_ASAL','$VISITOR_TYPE','$VISITOR_NAME','$VISITOR_PHONE','$KITAS_TYPE','$KITAS_NO','$PURPOSE','$PIC','$CEK_SUHU','$MCU_TYPE','$MCU_RESULT','$SMELL_TEST','$GEJALA_FLU','$CAR_TYPE','$CAR_BRAND','$CAR_NO','$CAR_QTY','$CAR_QTY_UM','$SIM_TYPE','$SIM_NO','$DRIVER_PENGGANTI','$PRE_APPROVAL_NO','$FINAL_APPROVAL_NO','$FTVIS2','$FTDOC2','$RFID_NO','$DINO','1','1','$DINO','$NAMA_USER'");
        
        if($_POST["SIM_EXP"] != '')
        {
            UpdateData("vims_reg","sim_exp_date='$SIM_EXP'","vm_no = '$KODE_TAMU'");
        }

        if($_POST["MCU_DATE"] != '')
        {
            UpdateData("vims_reg","mcu_date='$MCU_DATE', mcu_exp_date='$MCU_EXP_DATE'","vm_no = '$KODE_TAMU'");
        }

    }
    //update status card yang dipakai
    UpdateData(
    "m_cards",
    "status='1'",
    "card_no = '$RFID_NO'");

    //insert userlog
    InsertData(
    "users_log",
    "log_id, description, ip_adress, user_id, created_date, created_by, module, trans_type",
    "'$ai_users_log','Kode = $KODE_TAMU','$IP_ADDRESS','$NAMA_USER','$DINO','$NAMA_USER','VMS','Checkin'");
            
    ?>
    <script>window.open("print_transaksi.php?KODE_TAMU=<?php echo $KODE_TAMU; ?>&NAMA_FILE=<?php echo $NAMA_FILE; ?>");</script>
    <script>document.location.href='transaksi_checkin.php';</script>
    <?php
    
    die(0);   
}

//----------------------------------------- CHECKOUT ---------------------------------------------------------------------
if(isset($_POST["simpan2"]))
{
    $KODE_TAMU      = $_POST["KODE_TAMU"];
    $REMARK         = $_POST["REMARK"];
    $ai_users_log   = kodeAuto("users_log","log_id");

    $stmt1          = GetQuery("select * from vims_reg where vm_no = '$KODE_TAMU'");
    while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC))
    {
        $NO_KARTU   = $row1["rfid_no"];

        //update status rfid
        UpdateData(
        "m_cards",
        "status=0",
        "card_no = '$NO_KARTU'");
    }

    $stmt2          = GetQuery("select * from vims_reg where vm_no = '$KODE_TAMU'");
    while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
    {
        $TANGGAL_MASUK = $row2["checkin_date"];
    }

    $day1      = $TANGGAL_MASUK;
    $day2      = $DINO;
    $day1      = strtotime($day1);
    $day2      = strtotime($day2);
    $diffHours = round(($day2 - $day1) / 3600);
    $interval  = ($day2 - $day1)/60;


    UpdateData(
    "vims_reg",
    "checkout_date='$DINO', status_visitor=0, state=0, modified_date='$DINO', modified_by='$NAMA_USER', remark='$REMARK'",
    "vm_no = '$KODE_TAMU'");

    InsertData(
    "users_log",
    "log_id, description, ip_adress, user_id, created_date, created_by, module, trans_type",
    "'$ai_users_log','kode = $KODE_TAMU','$IP_ADDRESS','$NAMA_USER','$DINO','$NAMA_USER','VMS','Checkout'");
    ?>
    <script>alert('Checkout Successfully!');</script>
    <script>document.location.href='transaksi_checkout.php';</script>
    <?php
    die(0);
}
?>