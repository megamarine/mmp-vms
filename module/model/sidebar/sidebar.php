<?php
$KODE_USER = $_SESSION["LOGINIDUS_VISITOR"];
$akses     = $_SESSION["LOGINAKS_VISITOR"];
$div       ='';

//MODULE------------------------------------------------------------------------------------------------------------------
$query1       = getQuery("select * from m_usermodule where kode_user = '$KODE_USER' and id_module = '1' and xread = '1'");
$cek_muser    = $query1->rowCount();

$query2       = getQuery("select * from m_usermodule where kode_user = '$KODE_USER' and id_module = '2' and xread = '1'");
$cek_mcom     = $query2->rowCount();

$query3       = getQuery("select * from m_usermodule where kode_user = '$KODE_USER' and id_module = '3' and xread = '1'");
$cek_mcomtype = $query3->rowCount();

$query4       = getQuery("select * from m_usermodule where kode_user = '$KODE_USER' and id_module = '4' and xread = '1'");
$cek_mdep     = $query4->rowCount();

$query5       = getQuery("select * from m_usermodule where kode_user = '$KODE_USER' and id_module = '5' and xread = '1'");
$cek_mdiv     = $query5->rowCount();

$query6       = getQuery("select * from m_usermodule where kode_user = '$KODE_USER' and id_module = '6' and xread = '1'");
$cek_mlev     = $query6->rowCount();

$query7       = getQuery("select * from m_usermodule where kode_user = '$KODE_USER' and id_module = '7' and xread = '1'");
$cek_memplo   = $query7->rowCount();

$query8       = getQuery("select * from m_usermodule where kode_user = '$KODE_USER' and id_module = '8' and xread = '1'");
$cek_mcard    = $query8->rowCount();

$query9       = getQuery("select * from m_usermodule where kode_user = '$KODE_USER' and id_module = '9' and xread = '1'");
$cek_mkey     = $query9->rowCount();

$query10      = getQuery("select * from m_usermodule where kode_user = '$KODE_USER' and id_module = '10' and xread = '1'");
$cek_mum      = $query10->rowCount();

$query11      = getQuery("select * from m_usermodule where kode_user = '$KODE_USER' and id_module = '11' and xread = '1'");
$cek_mvehic   = $query11->rowCount();

$query12      = getQuery("select * from m_usermodule where kode_user = '$KODE_USER' and id_module = '12' and xread = '1'");
$cek_mvistype = $query12->rowCount();

$query13      = getQuery("select * from m_usermodule where kode_user = '$KODE_USER' and id_module = '13' and xread = '1'");
$cek_mpurpose = $query13->rowCount();

$query14      = getQuery("select * from m_usermodule where kode_user = '$KODE_USER' and id_module = '14' and xread = '1'");
$cek_vms      = $query14->rowCount();

$query15      = getQuery("select * from m_usermodule where kode_user = '$KODE_USER' and id_module = '15' and xread = '1'");
$cek_pms      = $query15->rowCount();

$query16      = getQuery("select * from m_usermodule where kode_user = '$KODE_USER' and id_module = '16' and xread = '1'");
$cek_kms      = $query16->rowCount();

$query17      = getQuery("select * from m_usermodule where kode_user = '$KODE_USER' and id_module = '17' and xcreate = '1'");
$cek_repvms   = $query17->rowCount();

$query18      = getQuery("select * from m_usermodule where kode_user = '$KODE_USER' and id_module = '18' and xcreate = '1'");
$cek_reppms   = $query18->rowCount();

$query19      = getQuery("select * from m_usermodule where kode_user = '$KODE_USER' and id_module = '19' and xcreate = '1'");
$cek_repkms   = $query19->rowCount();

// --------------------------------------------------------------------------------------------------------------------------

if($akses == "administrator")
{
    $where_clause = "";
}
else if($akses == "security")
{
    $where_clause = "";
}
else if($akses == "adminhk")
{
    $where_clause = "";
}

//count vms all
$query_vms = getQuery("select * from t_vms where status_visitor = '1' and status_hapus='0'");
$count_vms = $query_vms->rowCount();

// count vms preregister
$query_vmsPreRegister = getQuery("select * from t_vms where state ='3' and status_hapus='0'");
$count_vmsPreRegister = $query_vmsPreRegister->rowCount();


//count vms outside area
$query_vmso = getQuery("select * from t_vms where state ='1' and status_visitor = '1' and status_hapus='0'");
$count_vmso = $query_vmso->rowCount();

//count vms production area
$query_vmsp = getQuery("select * from t_vms where state ='2' and status_visitor = '1' and status_hapus='0'");
$count_vmsp = $query_vmsp->rowCount();

//count pms
$query_pms = getQuery("select * from t_pms where status ='1'");
$count_pms = $query_pms->rowCount();

//count kms
$query_kms = getQuery("select * from t_kms where status='1'");
$count_kms = $query_kms->rowCount();


// --------------------------------------------------------------------------------------------------------------------------
?>

<aside class="sidebar sidebar-left sidebar-menu">
    <section class="content slimscroll">
        <ul class="topmenu topmenu-responsive" data-toggle="menu">

            <!-- DASHBOARD -->
            <li>
                <a href="menuutama" data-target="#dashboard" data-parent=".topmenu">
                    <span class="figure"><i class="ico-home"></i></span>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            
            <!-- MASTER -->
            <?php
            if($cek_muser==1 || $cek_mcom==1 || $cek_mcomtype==1 || $cek_mdep==1 || $cek_mdiv==1 || $mlev ==1 || $cek_memplo==1 || $cek_mcard==1 || $cek_mkey==1 || $cek_mum==1 || $cek_mvehic==1 || $cek_mvistype==1 || $cek_mpurpose==1 )
            { ?>

                <li>
                    <a href="javascript:void(0);" data-toggle="submenu" data-target="#layout" data-parent=".topmenu">
                        <span class="figure"><i class="fas fa-th"></i></span>
                        <span class="text">Master</span>
                        <span class="arrow"></span>
                    </a>
                    <ul id="layout" class="submenu collapse ">
                        <li class="submenu-header ellipsis">Master</li>

                        <?php
                        if($cek_muser == 1)
                        { ?>
                        <li>
                            <a href="m_user">
                                <span class="text"><i class="fas fa-user"></i> User</span>
                            </a>
                        </li>
                        <?php } 

                        if($cek_mcom == 1)
                        { ?>
                        <li>
                            <a href="m_company">
                                <span class="text"><i class="fas fa-building"></i> Company</span>
                            </a>
                        </li>
                        <?php } 

                        if($cek_mcomtype == 1)
                        { ?>
                        <li>
                            <a href="m_companytype">
                                <span class="text"><i class="fas fa-city"></i> Company Type</span>
                            </a>
                        </li>
                        <?php } 

                        if($cek_mdep == 1)
                        { ?>
                        <li>
                            <a href="m_department">
                                <span class="text"><i class="fas fa-sitemap"></i> Department</span>
                            </a>
                        </li>
                        <?php } 

                        if($cek_mdiv == 1)
                        { ?>
                        <li>
                            <a href="m_division">
                                <span class="text"><i class="fas fa-landmark"></i> Division</span>
                            </a>
                        </li>
                        <?php } 

                        if($cek_mlev == 1)
                        { ?>
                        <li>
                            <a href="m_level">
                                <span class="text"><i class="fas fa-chart-line"></i> Level</span>
                            </a>
                        </li>
                        <?php }

                        if($cek_memplo == 1)
                        { ?>
                        <li>
                            <a href="m_employees">
                                <span class="text"><i class="fas fa-users"></i> Employees</span>
                            </a>
                        </li>
                        <?php }

                        if($cek_mcard == 1)
                        { ?>
                        <li>
                            <a href="m_card">
                                <span class="text"><i class="far fa-id-card"></i> Card</span>
                            </a>
                        </li>
                        <?php }

                        if($cek_mkey == 1)
                        { ?>
                        <li>
                            <a href="m_key">
                                <span class="text"><i class="fas fa-key"></i> Key</span>
                            </a>
                        </li>
                        <?php }

                        if($cek_mum == 1)
                        { ?>
                        <li>
                            <a href="m_um">
                                <span class="text"><i class="fas fa-balance-scale"></i> Unit Measurement</span>
                            </a>
                        </li>
                        <?php }

                        if($cek_mvehic == 1)
                        { ?>
                        <li>
                            <a href="m_vehicle">
                                <span class="text"><i class="fas fa-car"></i> Vehicle</span>
                            </a>
                        </li>
                        <?php }
                        
                        if($cek_mvistype == 1)
                        { ?>
                        <li>
                            <a href="m_visitortype">
                                <span class="text"><i class="fas fa-user-tag"></i> Visitor Type</span>
                            </a>
                        </li>
                        <?php }

                        if($cek_mpurpose == 1)
                        { ?>
                        <li>
                            <a href="m_purpose">
                                <span class="text"><i class="fas fa-map-signs"></i> Purpose</span>
                            </a>
                        </li>
                        <?php }

                        ?>
                    </ul>
                </li>
            <?php 
            } ?>

            <!-- VMS -->
            <?php
            if($cek_vms == 1)
            { ?>
                <li>
                    <a href="javascript:void(0);" data-toggle="submenu" data-target="#vms" data-parent=".topmenu">
                        <span class="figure"><i class="fas fa-people-arrows"></i></span>
                        <span class="text">Visitor Management</span>
                        <span class="arrow"></span>
                        <span class="number"><span class="label label-danger"><?=$count_vms; ?></span></span>
                    </a>
                    <ul id="vms" class="submenu collapse ">
                        <li class="submenu-header ellipsis">Visitor Management</li>
                        <li>
                            <a href="vmsPreRegister">
                                <span class="text"><i class="fas fa-expand-alt"></i> Pre Register</span>
                                <span class="number"><span class="label label-danger"><?=$count_vmsPreRegister; ?></span></span>
                            </a>
                        </li>
                        <li>
                            <a href="vmso">
                                <span class="text"><i class="fas fa-expand-alt"></i> Outside Area</span>
                                <span class="number"><span class="label label-danger"><?=$count_vmso; ?></span></span>
                            </a>
                        </li>
                        <li>
                            <a href="vmsp">
                                <span class="text"><i class="fas fa-expand"></i> Production Area</span>
                                <span class="number"><span class="label label-danger"><?=$count_vmsp; ?></span></span>
                            </a>
                        </li>
                    </ul>
                </li>
            <?php } ?>

            <!-- Package Management -->
            <?php
            if($cek_pms == 1)
            { ?>
                <li>
                    <a href="pms" data-target="#chart" data-parent=".topmenu">
                        <span class="figure"><i class="fas fa-box-open"></i></span>
                        <span class="text">Package Management</span>
                        <span class="number"><span class="label label-danger"><?=$count_pms; ?></span></span>
                    </a>
                </li>
            <?php } ?>

            <!-- Key Management -->
            <?php
            if($cek_kms == 1)
            { ?>
                <li>
                    <a href="kms" data-target="#chart" data-parent=".topmenu">
                        <span class="figure"><i class="fas fa-key"></i></span>
                        <span class="text">Key Management</span>
                        <span class="number"><span class="label label-danger"><?=$count_kms; ?></span></span>
                    </a>
                </li>
            <?php } ?>

            <!-- LAPORAN -->
            <?php
            if($cek_repvms==1 || $cek_reppms==1 || $cek_repkms==1)
            { ?>
                <li>
                    <a href="javascript:void(0);" data-target="#laporan" data-toggle="submenu" data-parent=".topmenu">
                        <span class="figure"><i class="fas fa-book"></i></span>
                        <span class="text">Report</span>
                        <span class="arrow"></span>
                    </a>
                    <ul id="laporan" class="submenu collapse ">
                        <li class="submenu-header ellipsis">Report</li>
                        <?php
                        if($cek_repvms == 1)
                        { ?>
                            <li>
                                <a href="laporan_vms">
                                    <span class="text">Report Visitor</span>
                                </a>
                            </li>
                        <?php }
                        if($cek_reppms == 1)
                        { ?>
                            <li>
                                <a href="laporan_pms">
                                    <span class="text">Report Package</span>
                                </a>
                            </li>
                        <?php }
                        if($cek_repkms == 1)
                        { ?>
                            <li>
                                <a href="laporan_kms">
                                    <span class="text">Report Key</span>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </li>
            <?php } ?>
        </ul>
    </section>
</aside>