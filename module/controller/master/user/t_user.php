<?php
$options = [
    'cost' => 12,
];

$DINO            = date('Y-m-d H:i:s');
$ID_USER1        = $_SESSION["LOGINIDUS_VISITOR"];
$IP_ADDRESS      = $_SESSION["IP_ADDRESS_VISITOR"];
$PC_NAME         = $_SESSION["PC_NAME_VISITOR"];
$NAMA_USER       = $_SESSION["LOGINNAMAUS_VISITOR"];

$USERNAME        = "";
$PASSWORD        = "";
$NAMA            = "";
$DEPARTEMENT     = "";
$DIVISI          = "";
$AKSES           = "";
$EMAIL           = "";
$STATUS          = "";
$mod_muser_c     = "";
$mod_muser_r     = "";
$mod_muser_u     = "";
$mod_muser_d     = "";
$mod_mcomp_c     = "";
$mod_mcomp_r     = "";
$mod_mcomp_u     = "";
$mod_mcomp_d     = "";
$mod_mcomptype_c = "";
$mod_mcomptype_r = "";
$mod_mcomptype_u = "";
$mod_mcomptype_d = "";
$mod_mdept_c     = "";
$mod_mdept_r     = "";
$mod_mdept_u     = "";
$mod_mdept_d     = "";
$mod_mdiv_c      = "";
$mod_mdiv_r      = "";
$mod_mdiv_u      = "";
$mod_mdiv_d      = "";
$mod_mlevel_c    = "";
$mod_mlevel_r    = "";
$mod_mlevel_u    = "";
$mod_mlevel_d    = "";
$mod_memploy_c   = "";
$mod_memploy_r   = "";
$mod_memploy_u   = "";
$mod_memploy_d   = "";
$mod_mcard_c     = "";
$mod_mcard_r     = "";
$mod_mcard_u     = "";
$mod_mcard_d     = "";
$mod_mkey_c      = "";
$mod_mkey_r      = "";
$mod_mkey_u      = "";
$mod_mkey_d      = "";
$mod_mum_c       = "";
$mod_mum_r       = "";
$mod_mum_u       = "";
$mod_mum_d       = "";
$mod_mvehicle_c  = "";
$mod_mvehicle_r  = "";
$mod_mvehicle_u  = "";
$mod_mvehicle_d  = "";
$mod_mvistype_c  = "";
$mod_mvistype_r  = "";
$mod_mvistype_u  = "";
$mod_mvistype_d  = "";
$mod_mpurp_c     = "";
$mod_mpurp_r     = "";
$mod_mpurp_u     = "";
$mod_mpurp_d     = "";
$mod_visitormg_c = "";
$mod_visitormg_r = "";
$mod_visitormg_u = "";
$mod_visitormg_d = "";
$mod_packagemg_c = "";
$mod_packagemg_r = "";
$mod_packagemg_u = "";
$mod_packagemg_d = "";
$mod_keymg_c     = "";
$mod_keymg_r     = "";
$mod_keymg_u     = "";
$mod_keymg_d     = "";
$mod_laporanvms  = "";
$mod_laporanpmg  = "";
$mod_laporankmg  = "";

//EDIT /////////////////////////////////////////////////////////////////////////////////////////////
if(isset($_GET["KODE"]))
{
    $KODE    = $_GET["KODE"];

    $result  = GetQuery("select * from m_user where kode_user='$KODE'");
    while ($row = $result->fetch(PDO::FETCH_ASSOC))  
    {
        $USERNAME    = $row["kode_user"];
        $NAMA        = $row["nama_user"];
        $DEPARTEMENT = $row["dept_id"];
        $DIVISI      = $row["div_id"];
        $AKSES       = $row["akses"];
        $EMAIL       = $row["email"];
        $STATUS      = $row["status"];
    }

    //MODULE 1 / Master User
    $result1  = GetQuery("select * from m_usermodule where kode_user='$KODE' and id_module = '1'");
    while ($row1 = $result1->fetch(PDO::FETCH_ASSOC))  
    {
        $mod_muser_c = $row1["xcreate"];
        $mod_muser_r = $row1["xread"];
        $mod_muser_u = $row1["xupdate"];
        $mod_muser_d = $row1["xdelete"];
    }

    //MODULE 2 / Master Company
    $result2  = GetQuery("select * from m_usermodule where kode_user='$KODE' and id_module = '2'");
    while ($row2 = $result2->fetch(PDO::FETCH_ASSOC))  
    {
        $mod_mcomp_c = $row2["xcreate"];
        $mod_mcomp_r = $row2["xread"];
        $mod_mcomp_u = $row2["xupdate"];
        $mod_mcomp_d = $row2["xdelete"];
    }

    //MODULE 3 / Master Company Type
    $result3  = GetQuery("select * from m_usermodule where kode_user='$KODE' and id_module = '3'");
    while ($row3 = $result3->fetch(PDO::FETCH_ASSOC))  
    {
        $mod_mcomptype_c = $row3["xcreate"];
        $mod_mcomptype_r = $row3["xread"];
        $mod_mcomptype_u = $row3["xupdate"];
        $mod_mcomptype_d = $row3["xdelete"];
    }

    //MODULE 4 / Master Departement
    $result4  = GetQuery("select * from m_usermodule where kode_user='$KODE' and id_module = '4'");
    while ($row4 = $result4->fetch(PDO::FETCH_ASSOC))  
    {
        $mod_mdept_c = $row4["xcreate"];
        $mod_mdept_r = $row4["xread"];
        $mod_mdept_u = $row4["xupdate"];
        $mod_mdept_d = $row4["xdelete"];
    }

    //MODULE 5 / Master Divisi
    $result5  = GetQuery("select * from m_usermodule where kode_user='$KODE' and id_module = '5'");
    while ($row5 = $result5->fetch(PDO::FETCH_ASSOC))  
    {
        $mod_mdiv_c = $row5["xcreate"];
        $mod_mdiv_r = $row5["xread"];
        $mod_mdiv_u = $row5["xupdate"];
        $mod_mdiv_d = $row5["xdelete"];
    }

    //MODULE 6 / Master Level
    $result6  = GetQuery("select * from m_usermodule where kode_user='$KODE' and id_module = '6'");
    while ($row6 = $result6->fetch(PDO::FETCH_ASSOC))
    {
        $mod_mlevel_c = $row6["xcreate"];
        $mod_mlevel_r = $row6["xread"];
        $mod_mlevel_u = $row6["xupdate"];
        $mod_mlevel_d = $row6["xdelete"];
    }

    //MODULE 7 / Master Employees
    $result7  = GetQuery("select * from m_usermodule where kode_user='$KODE' and id_module = '7'");
    while ($row7 = $result7->fetch(PDO::FETCH_ASSOC))
    {
        $mod_memploy_c = $row7["xcreate"];
        $mod_memploy_r = $row7["xread"];
        $mod_memploy_u = $row7["xupdate"];
        $mod_memploy_d = $row7["xdelete"];
    }

    //MODULE 8 / Master Card
    $result8  = GetQuery("select * from m_usermodule where kode_user='$KODE' and id_module = '8'");
    while ($row8 = $result8->fetch(PDO::FETCH_ASSOC))
    {
        $mod_mcard_c = $row8["xcreate"];
        $mod_mcard_r = $row8["xread"];
        $mod_mcard_u = $row8["xupdate"];
        $mod_mcard_d = $row8["xdelete"];
    }

    //MODULE 9 / Master Key
    $result9  = GetQuery("select * from m_usermodule where kode_user='$KODE' and id_module = '9'");
    while ($row9 = $result9->fetch(PDO::FETCH_ASSOC))
    {
        $mod_mkey_c = $row9["xcreate"];
        $mod_mkey_r = $row9["xread"];
        $mod_mkey_u = $row9["xupdate"];
        $mod_mkey_d = $row9["xdelete"];
    }

    //MODULE 10 / Master Unit Measurement
    $result10  = GetQuery("select * from m_usermodule where kode_user='$KODE' and id_module = '10'");
    while ($row10 = $result10->fetch(PDO::FETCH_ASSOC))
    {
        $mod_mum_c = $row10["xcreate"];
        $mod_mum_r = $row10["xread"];
        $mod_mum_u = $row10["xupdate"];
        $mod_mum_d = $row10["xdelete"];
    }

    //MODULE 11 / Master Vehicle
    $result11  = GetQuery("select * from m_usermodule where kode_user='$KODE' and id_module = '11'");
    while ($row11 = $result11->fetch(PDO::FETCH_ASSOC))
    {
        $mod_mvehicle_c = $row11["xcreate"];
        $mod_mvehicle_r = $row11["xread"];
        $mod_mvehicle_u = $row11["xupdate"];
        $mod_mvehicle_d = $row11["xdelete"];
    }

    //MODULE 12 / Master Visitor Type
    $result12  = GetQuery("select * from m_usermodule where kode_user='$KODE' and id_module = '12'");
    while ($row12 = $result12->fetch(PDO::FETCH_ASSOC))
    {
        $mod_mvistype_c = $row12["xcreate"];
        $mod_mvistype_r = $row12["xread"];
        $mod_mvistype_u = $row12["xupdate"];
        $mod_mvistype_d = $row12["xdelete"];
    }

    //MODULE 13 / Master Purpose
    $result13  = GetQuery("select * from m_usermodule where kode_user='$KODE' and id_module = '13'");
    while ($row13 = $result13->fetch(PDO::FETCH_ASSOC))
    {
        $mod_mpurp_c = $row13["xcreate"];
        $mod_mpurp_r = $row13["xread"];
        $mod_mpurp_u = $row13["xupdate"];
        $mod_mpurp_d = $row13["xdelete"];
    }

    //MODULE 14 / Visitor Management
    $result14  = GetQuery("select * from m_usermodule where kode_user='$KODE' and id_module = '14'");
    while ($row14 = $result14->fetch(PDO::FETCH_ASSOC))
    {
        $mod_visitormg_c = $row14["xcreate"];
        $mod_visitormg_r = $row14["xread"];
        $mod_visitormg_u = $row14["xupdate"];
        $mod_visitormg_d = $row14["xdelete"];
    }

    //MODULE 15 / Package Management
    $result15  = GetQuery("select * from m_usermodule where kode_user='$KODE' and id_module = '15'");
    while ($row15 = $result15->fetch(PDO::FETCH_ASSOC))
    {
        $mod_packagemg_c = $row15["xcreate"];
        $mod_packagemg_r = $row15["xread"];
        $mod_packagemg_u = $row15["xupdate"];
        $mod_packagemg_d = $row15["xdelete"];
    }

    //MODULE 16 / Key Management
    $result16  = GetQuery("select * from m_usermodule where kode_user='$KODE' and id_module = '16'");
    while ($row16 = $result16->fetch(PDO::FETCH_ASSOC))
    {
        $mod_keymg_c = $row16["xcreate"];
        $mod_keymg_r = $row16["xread"];
        $mod_keymg_u = $row16["xupdate"];
        $mod_keymg_d = $row16["xdelete"];
    }

    //MODULE 17 / Laporan VMS
    $result17  = GetQuery("select * from m_usermodule where kode_user='$KODE' and id_module = '17'");
    while ($row17 = $result17->fetch(PDO::FETCH_ASSOC))
    {
        $mod_laporanvms = $row17["xcreate"];
    }

    //MODULE 18 / Laporan Package
    $result18  = GetQuery("select * from m_usermodule where kode_user='$KODE' and id_module = '18'");
    while ($row18 = $result18->fetch(PDO::FETCH_ASSOC))
    {
        $mod_laporanpmg = $row18["xcreate"];
    }

    //MODULE 19 / Laporan Key
    $result19  = GetQuery("select * from m_usermodule where kode_user='$KODE' and id_module = '19'");
    while ($row19 = $result19->fetch(PDO::FETCH_ASSOC))
    {
        $mod_laporankmg = $row19["xcreate"];
    }

    if(isset($_POST["simpan"]))
    {
        $USERNAME        = $_POST["USERNAME"];
        $PASSWORD        = password_hash($_POST["PASSWORD"], PASSWORD_BCRYPT, $options);
        $NAMA            = $_POST["NAMA"];
        $DEPARTEMENT     = $_POST["DEPARTEMENT"];
        $DIVISI          = $_POST["DIVISI"];
        $AKSES           = $_POST["AKSES"];
        $EMAIL           = $_POST["EMAIL"];
        $STATUS          = $_POST["STATUS"];

        $mod_muser_c     = isset($_POST["mod_muser_c"]) ? 1 : 0;
        $mod_muser_r     = isset($_POST["mod_muser_r"]) ? 1 : 0;
        $mod_muser_u     = isset($_POST["mod_muser_u"]) ? 1 : 0;
        $mod_muser_d     = isset($_POST["mod_muser_d"]) ? 1 : 0;

        $mod_mcomp_c     = isset($_POST["mod_mcomp_c"]) ? 1 : 0;
        $mod_mcomp_r     = isset($_POST["mod_mcomp_r"]) ? 1 : 0;
        $mod_mcomp_u     = isset($_POST["mod_mcomp_u"]) ? 1 : 0;
        $mod_mcomp_d     = isset($_POST["mod_mcomp_d"]) ? 1 : 0;

        $mod_mcomptype_c = isset($_POST["mod_mcomptype_c"]) ? 1 : 0;
        $mod_mcomptype_r = isset($_POST["mod_mcomptype_r"]) ? 1 : 0;
        $mod_mcomptype_u = isset($_POST["mod_mcomptype_u"]) ? 1 : 0;
        $mod_mcomptype_d = isset($_POST["mod_mcomptype_d"]) ? 1 : 0;

        $mod_mdept_c     = isset($_POST["mod_mdept_c"]) ? 1 : 0;
        $mod_mdept_r     = isset($_POST["mod_mdept_r"]) ? 1 : 0;
        $mod_mdept_u     = isset($_POST["mod_mdept_u"]) ? 1 : 0;
        $mod_mdept_d     = isset($_POST["mod_mdept_d"]) ? 1 : 0;

        $mod_mdiv_c      = isset($_POST["mod_mdiv_c"]) ? 1 : 0;
        $mod_mdiv_r      = isset($_POST["mod_mdiv_r"]) ? 1 : 0;
        $mod_mdiv_u      = isset($_POST["mod_mdiv_u"]) ? 1 : 0;
        $mod_mdiv_d      = isset($_POST["mod_mdiv_d"]) ? 1 : 0;

        $mod_mlevel_c    = isset($_POST["mod_mlevel_c"]) ? 1 : 0;
        $mod_mlevel_r    = isset($_POST["mod_mlevel_r"]) ? 1 : 0;
        $mod_mlevel_u    = isset($_POST["mod_mlevel_u"]) ? 1 : 0;
        $mod_mlevel_d    = isset($_POST["mod_mlevel_d"]) ? 1 : 0;

        $mod_memploy_c   = isset($_POST["mod_memploy_c"]) ? 1 : 0;
        $mod_memploy_r   = isset($_POST["mod_memploy_r"]) ? 1 : 0;
        $mod_memploy_u   = isset($_POST["mod_memploy_u"]) ? 1 : 0;
        $mod_memploy_d   = isset($_POST["mod_memploy_d"]) ? 1 : 0;

        $mod_mcard_c     = isset($_POST["mod_mcard_c"]) ? 1 : 0;
        $mod_mcard_r     = isset($_POST["mod_mcard_r"]) ? 1 : 0;
        $mod_mcard_u     = isset($_POST["mod_mcard_u"]) ? 1 : 0;
        $mod_mcard_d     = isset($_POST["mod_mcard_d"]) ? 1 : 0;

        $mod_mkey_c      = isset($_POST["mod_mkey_c"]) ? 1 : 0;
        $mod_mkey_r      = isset($_POST["mod_mkey_r"]) ? 1 : 0;
        $mod_mkey_u      = isset($_POST["mod_mkey_u"]) ? 1 : 0;
        $mod_mkey_d      = isset($_POST["mod_mkey_d"]) ? 1 : 0;

        $mod_mum_c       = isset($_POST["mod_mum_c"]) ? 1 : 0;
        $mod_mum_r       = isset($_POST["mod_mum_r"]) ? 1 : 0;
        $mod_mum_u       = isset($_POST["mod_mum_u"]) ? 1 : 0;
        $mod_mum_d       = isset($_POST["mod_mum_d"]) ? 1 : 0;

        $mod_mvehicle_c  = isset($_POST["mod_mvehicle_c"]) ? 1 : 0;
        $mod_mvehicle_r  = isset($_POST["mod_mvehicle_r"]) ? 1 : 0;
        $mod_mvehicle_u  = isset($_POST["mod_mvehicle_u"]) ? 1 : 0;
        $mod_mvehicle_d  = isset($_POST["mod_mvehicle_d"]) ? 1 : 0;

        $mod_mvistype_c  = isset($_POST["mod_mvistype_c"]) ? 1 : 0;
        $mod_mvistype_r  = isset($_POST["mod_mvistype_r"]) ? 1 : 0;
        $mod_mvistype_u  = isset($_POST["mod_mvistype_u"]) ? 1 : 0;
        $mod_mvistype_d  = isset($_POST["mod_mvistype_d"]) ? 1 : 0;

        $mod_mpurp_c     = isset($_POST["mod_mpurp_c"]) ? 1 : 0;
        $mod_mpurp_r     = isset($_POST["mod_mpurp_r"]) ? 1 : 0;
        $mod_mpurp_u     = isset($_POST["mod_mpurp_u"]) ? 1 : 0;
        $mod_mpurp_d     = isset($_POST["mod_mpurp_d"]) ? 1 : 0;

        $mod_visitormg_c = isset($_POST["mod_visitormg_c"]) ? 1 : 0;
        $mod_visitormg_r = isset($_POST["mod_visitormg_r"]) ? 1 : 0;
        $mod_visitormg_u = isset($_POST["mod_visitormg_u"]) ? 1 : 0;
        $mod_visitormg_d = isset($_POST["mod_visitormg_d"]) ? 1 : 0;

        $mod_packagemg_c = isset($_POST["mod_packagemg_c"]) ? 1 : 0;
        $mod_packagemg_r = isset($_POST["mod_packagemg_r"]) ? 1 : 0;
        $mod_packagemg_u = isset($_POST["mod_packagemg_u"]) ? 1 : 0;
        $mod_packagemg_d = isset($_POST["mod_packagemg_d"]) ? 1 : 0;

        $mod_keymg_c     = isset($_POST["mod_keymg_c"]) ? 1 : 0;
        $mod_keymg_r     = isset($_POST["mod_keymg_r"]) ? 1 : 0;
        $mod_keymg_u     = isset($_POST["mod_keymg_u"]) ? 1 : 0;
        $mod_keymg_d     = isset($_POST["mod_keymg_d"]) ? 1 : 0;

        $mod_laporanvms  = isset($_POST["mod_laporanvms"]) ? 1 : 0;
        $mod_laporanpmg  = isset($_POST["mod_laporanpmg"]) ? 1 : 0;
        $mod_laporankmg  = isset($_POST["mod_laporankmg"]) ? 1 : 0;

        //UPDATE M_USER
        $update = UpdateData(
        "m_user",
        "kode_user      = '$USERNAME', 
         nama_user      = '$NAMA', 
         password       = '$PASSWORD', 
         dept_id        = '$DEPARTEMENT', 
         div_id         = '$DIVISI' , 
         akses          = '$AKSES', 
         email          = '$EMAIL', 
         status         = '$STATUS', 
         modified_date  = '$DINO', 
         modified_by    = '$ID_USER1'", 
        "kode_user = '$KODE'");

        if($update)
        {
            //INSERT TO TABLE M_USERMODULE SESUAI JUMLAH MODULE YG ADA DI TABLE M_MODULE, SKIP JIKA MODULE USER SUDAH ADA DI M_USERMODULE
            $result2 = GetQuery(
            "insert into m_usermodule (kode_user,id_module) 
             SELECT '$USERNAME', a.id_module FROM m_module a WHERE NOT EXISTS (SELECT id_module FROM m_usermodule b WHERE a.id_module = b.id_module AND '$USERNAME' = b.kode_user)");

            //UPDATE M_USERMODULE SESUAI MODULE YG DICENTANG
            
            //MODULE 1 / Master User
            $M1 = GetQuery(
            "update m_usermodule set xcreate = '$mod_muser_c',
                                     xread   = '$mod_muser_r',
                                     xupdate = '$mod_muser_u',
                                     xdelete = '$mod_muser_d'
                               where kode_user = '$USERNAME' and
                                     id_module = '1' ");

            //MODULE 2 / Master Company
            $M1 = GetQuery(
            "update m_usermodule set xcreate = '$mod_mcomp_c',
                                     xread   = '$mod_mcomp_r',
                                     xupdate = '$mod_mcomp_u',
                                     xdelete = '$mod_mcomp_d'
                               where kode_user = '$USERNAME' and
                                     id_module = '2' ");

            //MODULE 3 / Master Company Type
            $M3 = GetQuery(
            "update m_usermodule set xcreate = '$mod_mcomptype_c',
                                     xread   = '$mod_mcomptype_r',
                                     xupdate = '$mod_mcomptype_u',
                                     xdelete = '$mod_mcomptype_d'
                               where kode_user = '$USERNAME' and
                                     id_module = '3' ");

            //MODULE 4 / Master Departement
            $M4 = GetQuery(
            "update m_usermodule set xcreate = '$mod_mdept_c',
                                     xread   = '$mod_mdept_r',
                                     xupdate = '$mod_mdept_u',
                                     xdelete = '$mod_mdept_d'
                               where kode_user = '$USERNAME' and
                                     id_module = '4' ");

            //MODULE 5 / Master Divisi
            $M5 = GetQuery(
            "update m_usermodule set xcreate = '$mod_mdiv_c',
                                     xread   = '$mod_mdiv_r',
                                     xupdate = '$mod_mdiv_u',
                                     xdelete = '$mod_mdiv_d'
                               where kode_user = '$USERNAME' and
                                     id_module = '5' ");

            //MODULE 6 / Master Level
            $M6 = GetQuery(
            "update m_usermodule set xcreate = '$mod_mlevel_c',
                                     xread   = '$mod_mlevel_r',
                                     xupdate = '$mod_mlevel_u',
                                     xdelete = '$mod_mlevel_d'
                               where kode_user = '$USERNAME' and
                                     id_module = '6' ");

            //MODULE 7 / Master Employees
            $M7 = GetQuery(
            "update m_usermodule set xcreate = '$mod_memploy_c',
                                     xread   = '$mod_memploy_r',
                                     xupdate = '$mod_memploy_u',
                                     xdelete = '$mod_memploy_d'
                               where kode_user = '$USERNAME' and
                                     id_module = '7' ");

            //MODULE 8 / Master Card
            $M8 = GetQuery(
            "update m_usermodule set xcreate = '$mod_mcard_c',
                                     xread   = '$mod_mcard_r',
                                     xupdate = '$mod_mcard_u',
                                     xdelete = '$mod_mcard_d'
                               where kode_user = '$USERNAME' and
                                     id_module = '8' ");

            //MODULE 9 / Master Key
            $M9 = GetQuery(
            "update m_usermodule set xcreate = '$mod_mkey_c',
                                     xread   = '$mod_mkey_r',
                                     xupdate = '$mod_mkey_u',
                                     xdelete = '$mod_mkey_d'
                               where kode_user = '$USERNAME' and
                                     id_module = '9' ");

            //MODULE 10 / Master Unit Measurement
            $M10 = GetQuery(
            "update m_usermodule set xcreate = '$mod_mum_c',
                                     xread   = '$mod_mum_r',
                                     xupdate = '$mod_mum_u',
                                     xdelete = '$mod_mum_d'
                               where kode_user = '$USERNAME' and
                                     id_module = '10' ");

            //MODULE 11 / Master Vehicle
            $M11 = GetQuery(
            "update m_usermodule set xcreate = '$mod_mvehicle_c',
                                     xread   = '$mod_mvehicle_r',
                                     xupdate = '$mod_mvehicle_u',
                                     xdelete = '$mod_mvehicle_d'
                               where kode_user = '$USERNAME' and
                                     id_module = '11' ");

            //MODULE 12 / Master Visitor Type
            $M12 = GetQuery(
            "update m_usermodule set xcreate = '$mod_mvistype_c',
                                     xread   = '$mod_mvistype_r',
                                     xupdate = '$mod_mvistype_u',
                                     xdelete = '$mod_mvistype_d'
                               where kode_user = '$USERNAME' and
                                     id_module = '12' ");

            //MODULE 13 / Master Purpose
            $M13 = GetQuery(
            "update m_usermodule set xcreate = '$mod_mpurp_c',
                                     xread   = '$mod_mpurp_r',
                                     xupdate = '$mod_mpurp_u',
                                     xdelete = '$mod_mpurp_d'
                               where kode_user = '$USERNAME' and
                                     id_module = '13' ");

            //MODULE 14 / Visitor Management System
            $M14 = GetQuery(
            "update m_usermodule set xcreate = '$mod_visitormg_c',
                                     xread   = '$mod_visitormg_r',
                                     xupdate = '$mod_visitormg_u',
                                     xdelete = '$mod_visitormg_d'
                               where kode_user = '$USERNAME' and
                                     id_module = '14' ");

            //MODULE 15 / Package Management
            $M15 = GetQuery(
            "update m_usermodule set xcreate = '$mod_packagemg_c',
                                     xread   = '$mod_packagemg_r',
                                     xupdate = '$mod_packagemg_u',
                                     xdelete = '$mod_packagemg_d'
                               where kode_user = '$USERNAME' and
                                     id_module = '15' ");

            //MODULE 16 / Key Management
            $M16 = GetQuery(
            "update m_usermodule set xcreate = '$mod_keymg_c',
                                     xread   = '$mod_keymg_r',
                                     xupdate = '$mod_keymg_u',
                                     xdelete = '$mod_keymg_d'
                               where kode_user = '$USERNAME' and
                                     id_module = '16' ");

            //MODULE 17 / Laporan VMS
            $M17 = GetQuery(
            "update m_usermodule set xcreate = '$mod_laporanvms'
                               where kode_user = '$USERNAME' and
                                     id_module = '17' ");

            //MODULE 18 / Laporan Package Management
            $M18 = GetQuery(
            "update m_usermodule set xcreate = '$mod_laporanpmg'
                               where kode_user = '$USERNAME' and
                                     id_module = '18' ");

            //MODULE 19 / Laporan Key Management
            $M19 = GetQuery(
            "update m_usermodule set xcreate = '$mod_laporankmg'
                               where kode_user = '$USERNAME' and
                                     id_module = '19' ");
        }

        InsertData(
        "users_log",
        "log_id, description, ip_adress, user_id, created_date, created_by, module, trans_type",
        "'', 'Edit User - $USERNAME', '$IP_ADDRESS','$ID_USER1','$DINO','$ID_USER1','Master','Edit'");

        ?><script>alert('User has been updated! Thank you! ');</script><?php
        ?><script>document.location.href='m_user.php';</script><?php
        die(0);
    }
}



//TAMBAH /////////////////////////////////////////////////////////////////////////////////////////////
if(isset($_POST["simpan"]))
{    
    $USERNAME        = $_POST["USERNAME"];
    $PASSWORD        = password_hash($_POST['PASSWORD'], PASSWORD_BCRYPT, $options);
    $NAMA            = $_POST["NAMA"];
    $DEPARTEMENT     = $_POST["DEPARTEMENT"];
    $DIVISI          = $_POST["DIVISI"];
    $AKSES           = $_POST["AKSES"];
    $EMAIL           = $_POST["EMAIL"];

    $mod_muser_c     = isset($_POST["mod_muser_c"]) ? 1 : 0;
    $mod_muser_r     = isset($_POST["mod_muser_r"]) ? 1 : 0;
    $mod_muser_u     = isset($_POST["mod_muser_u"]) ? 1 : 0;
    $mod_muser_d     = isset($_POST["mod_muser_d"]) ? 1 : 0;

    $mod_mcomp_c     = isset($_POST["mod_mcomp_c"]) ? 1 : 0;
    $mod_mcomp_r     = isset($_POST["mod_mcomp_r"]) ? 1 : 0;
    $mod_mcomp_u     = isset($_POST["mod_mcomp_u"]) ? 1 : 0;
    $mod_mcomp_d     = isset($_POST["mod_mcomp_d"]) ? 1 : 0;

    $mod_mcomptype_c = isset($_POST["mod_mcomptype_c"]) ? 1 : 0;
    $mod_mcomptype_r = isset($_POST["mod_mcomptype_r"]) ? 1 : 0;
    $mod_mcomptype_u = isset($_POST["mod_mcomptype_u"]) ? 1 : 0;
    $mod_mcomptype_d = isset($_POST["mod_mcomptype_d"]) ? 1 : 0;

    $mod_mdept_c     = isset($_POST["mod_mdept_c"]) ? 1 : 0;
    $mod_mdept_r     = isset($_POST["mod_mdept_r"]) ? 1 : 0;
    $mod_mdept_u     = isset($_POST["mod_mdept_u"]) ? 1 : 0;
    $mod_mdept_d     = isset($_POST["mod_mdept_d"]) ? 1 : 0;

    $mod_mdiv_c      = isset($_POST["mod_mdiv_c"]) ? 1 : 0;
    $mod_mdiv_r      = isset($_POST["mod_mdiv_r"]) ? 1 : 0;
    $mod_mdiv_u      = isset($_POST["mod_mdiv_u"]) ? 1 : 0;
    $mod_mdiv_d      = isset($_POST["mod_mdiv_d"]) ? 1 : 0;

    $mod_mlevel_c    = isset($_POST["mod_mlevel_c"]) ? 1 : 0;
    $mod_mlevel_r    = isset($_POST["mod_mlevel_r"]) ? 1 : 0;
    $mod_mlevel_u    = isset($_POST["mod_mlevel_u"]) ? 1 : 0;
    $mod_mlevel_d    = isset($_POST["mod_mlevel_d"]) ? 1 : 0;

    $mod_memploy_c   = isset($_POST["mod_memploy_c"]) ? 1 : 0;
    $mod_memploy_r   = isset($_POST["mod_memploy_r"]) ? 1 : 0;
    $mod_memploy_u   = isset($_POST["mod_memploy_u"]) ? 1 : 0;
    $mod_memploy_d   = isset($_POST["mod_memploy_d"]) ? 1 : 0;

    $mod_mcard_c     = isset($_POST["mod_mcard_c"]) ? 1 : 0;
    $mod_mcard_r     = isset($_POST["mod_mcard_r"]) ? 1 : 0;
    $mod_mcard_u     = isset($_POST["mod_mcard_u"]) ? 1 : 0;
    $mod_mcard_d     = isset($_POST["mod_mcard_d"]) ? 1 : 0;

    $mod_mkey_c      = isset($_POST["mod_mkey_c"]) ? 1 : 0;
    $mod_mkey_r      = isset($_POST["mod_mkey_r"]) ? 1 : 0;
    $mod_mkey_u      = isset($_POST["mod_mkey_u"]) ? 1 : 0;
    $mod_mkey_d      = isset($_POST["mod_mkey_d"]) ? 1 : 0;

    $mod_mum_c       = isset($_POST["mod_mum_c"]) ? 1 : 0;
    $mod_mum_r       = isset($_POST["mod_mum_r"]) ? 1 : 0;
    $mod_mum_u       = isset($_POST["mod_mum_u"]) ? 1 : 0;
    $mod_mum_d       = isset($_POST["mod_mum_d"]) ? 1 : 0;

    $mod_mvehicle_c  = isset($_POST["mod_mvehicle_c"]) ? 1 : 0;
    $mod_mvehicle_r  = isset($_POST["mod_mvehicle_r"]) ? 1 : 0;
    $mod_mvehicle_u  = isset($_POST["mod_mvehicle_u"]) ? 1 : 0;
    $mod_mvehicle_d  = isset($_POST["mod_mvehicle_d"]) ? 1 : 0;

    $mod_mvistype_c  = isset($_POST["mod_mvistype_c"]) ? 1 : 0;
    $mod_mvistype_r  = isset($_POST["mod_mvistype_r"]) ? 1 : 0;
    $mod_mvistype_u  = isset($_POST["mod_mvistype_u"]) ? 1 : 0;
    $mod_mvistype_d  = isset($_POST["mod_mvistype_d"]) ? 1 : 0;

    $mod_mpurp_c     = isset($_POST["mod_mpurp_c"]) ? 1 : 0;
    $mod_mpurp_r     = isset($_POST["mod_mpurp_r"]) ? 1 : 0;
    $mod_mpurp_u     = isset($_POST["mod_mpurp_u"]) ? 1 : 0;
    $mod_mpurp_d     = isset($_POST["mod_mpurp_d"]) ? 1 : 0;

    $mod_visitormg_c = isset($_POST["mod_visitormg_c"]) ? 1 : 0;
    $mod_visitormg_r = isset($_POST["mod_visitormg_r"]) ? 1 : 0;
    $mod_visitormg_u = isset($_POST["mod_visitormg_u"]) ? 1 : 0;
    $mod_visitormg_d = isset($_POST["mod_visitormg_d"]) ? 1 : 0;

    $mod_packagemg_c = isset($_POST["mod_packagemg_c"]) ? 1 : 0;
    $mod_packagemg_r = isset($_POST["mod_packagemg_r"]) ? 1 : 0;
    $mod_packagemg_u = isset($_POST["mod_packagemg_u"]) ? 1 : 0;
    $mod_packagemg_d = isset($_POST["mod_packagemg_d"]) ? 1 : 0;

    $mod_keymg_c     = isset($_POST["mod_keymg_c"]) ? 1 : 0;
    $mod_keymg_r     = isset($_POST["mod_keymg_r"]) ? 1 : 0;
    $mod_keymg_u     = isset($_POST["mod_keymg_u"]) ? 1 : 0;
    $mod_keymg_d     = isset($_POST["mod_keymg_d"]) ? 1 : 0;

    $mod_laporanvms  = isset($_POST["mod_laporanvms"]) ? 1 : 0;
    $mod_laporanpmg  = isset($_POST["mod_laporanpmg"]) ? 1 : 0;
    $mod_laporankmg  = isset($_POST["mod_laporankmg"]) ? 1 : 0;

    //INSERT TO TABLE M_USER
    $result = GetQuery(
    "insert into m_user (kode_user,nama_user,password,dept_id,div_id,akses,email,created_by,created_date)     
                values ('$USERNAME','$NAMA','$PASSWORD','$DEPARTEMENT','$DIVISI','$AKSES','$EMAIL','$ID_USER1','$DINO')");

    if($result)
    {
        //INSERT TO TABLE M_USERMODULE SESUAI JUMLAH MODULE YG ADA DI TABLE M_MODULE
        $result2 = GetQuery(
        "insert into m_usermodule (kode_user,id_module) SELECT '$USERNAME', id_module FROM m_module");

        if($result2)
        {
            //UPDATE M_USERMODULE SESUAI MODULE YG DICENTANG
            
            //MODULE 1 / Master User
            $M1 = GetQuery(
            "update m_usermodule set xcreate = '$mod_muser_c',
                                     xread   = '$mod_muser_r',
                                     xupdate = '$mod_muser_u',
                                     xdelete = '$mod_muser_d'
                               where kode_user = '$USERNAME' and
                                     id_module = '1' ");

            //MODULE 2 / Master Company
            $M1 = GetQuery(
            "update m_usermodule set xcreate = '$mod_mcomp_c',
                                     xread   = '$mod_mcomp_r',
                                     xupdate = '$mod_mcomp_u',
                                     xdelete = '$mod_mcomp_d'
                               where kode_user = '$USERNAME' and
                                     id_module = '2' ");

            //MODULE 3 / Master Company Type
            $M3 = GetQuery(
            "update m_usermodule set xcreate = '$mod_mcomptype_c',
                                     xread   = '$mod_mcomptype_r',
                                     xupdate = '$mod_mcomptype_u',
                                     xdelete = '$mod_mcomptype_d'
                               where kode_user = '$USERNAME' and
                                     id_module = '3' ");

            //MODULE 4 / Master Departement
            $M4 = GetQuery(
            "update m_usermodule set xcreate = '$mod_mdept_c',
                                     xread   = '$mod_mdept_r',
                                     xupdate = '$mod_mdept_u',
                                     xdelete = '$mod_mdept_d'
                               where kode_user = '$USERNAME' and
                                     id_module = '4' ");

            //MODULE 5 / Master Divisi
            $M5 = GetQuery(
            "update m_usermodule set xcreate = '$mod_mdiv_c',
                                     xread   = '$mod_mdiv_r',
                                     xupdate = '$mod_mdiv_u',
                                     xdelete = '$mod_mdiv_d'
                               where kode_user = '$USERNAME' and
                                     id_module = '5' ");

            //MODULE 6 / Master Level
            $M6 = GetQuery(
            "update m_usermodule set xcreate = '$mod_mlevel_c',
                                     xread   = '$mod_mlevel_r',
                                     xupdate = '$mod_mlevel_u',
                                     xdelete = '$mod_mlevel_d'
                               where kode_user = '$USERNAME' and
                                     id_module = '6' ");

            //MODULE 7 / Master Employees
            $M7 = GetQuery(
            "update m_usermodule set xcreate = '$mod_memploy_c',
                                     xread   = '$mod_memploy_r',
                                     xupdate = '$mod_memploy_u',
                                     xdelete = '$mod_memploy_d'
                               where kode_user = '$USERNAME' and
                                     id_module = '7' ");

            //MODULE 8 / Master Card
            $M8 = GetQuery(
            "update m_usermodule set xcreate = '$mod_mcard_c',
                                     xread   = '$mod_mcard_r',
                                     xupdate = '$mod_mcard_u',
                                     xdelete = '$mod_mcard_d'
                               where kode_user = '$USERNAME' and
                                     id_module = '8' ");

            //MODULE 9 / Master Key
            $M9 = GetQuery(
            "update m_usermodule set xcreate = '$mod_mkey_c',
                                     xread   = '$mod_mkey_r',
                                     xupdate = '$mod_mkey_u',
                                     xdelete = '$mod_mkey_d'
                               where kode_user = '$USERNAME' and
                                     id_module = '9' ");

            //MODULE 10 / Master Unit Measurement
            $M10 = GetQuery(
            "update m_usermodule set xcreate = '$mod_mum_c',
                                     xread   = '$mod_mum_r',
                                     xupdate = '$mod_mum_u',
                                     xdelete = '$mod_mum_d'
                               where kode_user = '$USERNAME' and
                                     id_module = '10' ");

            //MODULE 11 / Master Vehicle
            $M11 = GetQuery(
            "update m_usermodule set xcreate = '$mod_mvehicle_c',
                                     xread   = '$mod_mvehicle_r',
                                     xupdate = '$mod_mvehicle_u',
                                     xdelete = '$mod_mvehicle_d'
                               where kode_user = '$USERNAME' and
                                     id_module = '11' ");

            //MODULE 12 / Master Visitor Type
            $M12 = GetQuery(
            "update m_usermodule set xcreate = '$mod_mvistype_c',
                                     xread   = '$mod_mvistype_r',
                                     xupdate = '$mod_mvistype_u',
                                     xdelete = '$mod_mvistype_d'
                               where kode_user = '$USERNAME' and
                                     id_module = '12' ");

            //MODULE 13 / Master Purpose
            $M13 = GetQuery(
            "update m_usermodule set xcreate = '$mod_mpurp_c',
                                     xread   = '$mod_mpurp_r',
                                     xupdate = '$mod_mpurp_u',
                                     xdelete = '$mod_mpurp_d'
                               where kode_user = '$USERNAME' and
                                     id_module = '13' ");

            //MODULE 14 / Visitor Management System
            $M14 = GetQuery(
            "update m_usermodule set xcreate = '$mod_visitormg_c',
                                     xread   = '$mod_visitormg_r',
                                     xupdate = '$mod_visitormg_u',
                                     xdelete = '$mod_visitormg_d'
                               where kode_user = '$USERNAME' and
                                     id_module = '14' ");

            //MODULE 15 / Package Management
            $M15 = GetQuery(
            "update m_usermodule set xcreate = '$mod_packagemg_c',
                                     xread   = '$mod_packagemg_r',
                                     xupdate = '$mod_packagemg_u',
                                     xdelete = '$mod_packagemg_d'
                               where kode_user = '$USERNAME' and
                                     id_module = '15' ");

            //MODULE 16 / Key Management
            $M16 = GetQuery(
            "update m_usermodule set xcreate = '$mod_keymg_c',
                                     xread   = '$mod_keymg_r',
                                     xupdate = '$mod_keymg_u',
                                     xdelete = '$mod_keymg_d'
                               where kode_user = '$USERNAME' and
                                     id_module = '16' ");

            //MODULE 17 / Laporan VMS
            $M17 = GetQuery(
            "update m_usermodule set xcreate = '$mod_laporanvms'
                               where kode_user = '$USERNAME' and
                                     id_module = '17' ");

            //MODULE 18 / Laporan Package Management
            $M18 = GetQuery(
            "update m_usermodule set xcreate = '$mod_laporanpmg'
                               where kode_user = '$USERNAME' and
                                     id_module = '18' ");

            //MODULE 19 / Laporan Key Management
            $M19 = GetQuery(
            "update m_usermodule set xcreate = '$mod_laporankmg'
                               where kode_user = '$USERNAME' and
                                     id_module = '19' ");
        }
        else
        {
            ?><script>alert('Failed to assign module! Try again ');</script><?php
            ?><script>document.location.href='m_user';</script><?php
            die(0);
        }

        // INSERT TO TABLE USERS_LOG
        InsertData(
        "users_log",
        "log_id, description, ip_adress, user_id, created_date, created_by, module, trans_type",
        "'', 'Tambah Master User - $USERNAME', '$IP_ADDRESS', '$ID_USER1', '$DINO', '$ID_USER1', 'Master', 'Tambah'");

        ?><script>alert('User has been added! Thank you! ');</script><?php
        ?><script>document.location.href='m_user';</script><?php
        die(0);       
    }
    else
    {
        ?><script>alert('Failed to add user! Try again ');</script><?php
        ?><script>document.location.href='m_user';</script><?php
        die(0);
    }

    

    
}
?>
