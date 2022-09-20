<?php

$KODE_TAMU = $_GET["KODE_TAMU"];

$stmt = GetQuery("
         select vm.vm_no as kode, 
                vm.company_name as company, 
                vm.checkin_date as date_in,
                vm.checkout_date as date_out,
                vm.app_type as app_type,
                vm.app_with as app_with,
                vd.checkin_date_p as date_in_p,
                vd.checkout_date_p as date_out_p,
                vd.visitor_name as name
         FROM  vims_master as vm
         INNER JOIN vims_detail as vd ON vm.vm_no = vd.vm_no
         WHERE vm.vm_no='$KODE_TAMU'");
?>

<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="fa fa-file fa-lg"></i> Laporan Visitor - Detail </h4>
    </div>
    <div class="page-header-section">
        <!-- Toolbar -->
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama"><i class="ico-home2"></i> Dashboard</a></li>
                <li class="active"><i class="fa fa-file fa-lg"></i> Laporan Visitor</li>
            </ol>
        </div>
        <!--/ Toolbar -->
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-12" align="right">
                <a href="print_laporan_detail?KODE_TAMU=<?php echo $KODE_TAMU; ?>" type="button" target="_blank" class="btn btn-inverse btn-outline btn-rounded mb5"><i class="fa fa-print fa-lg"></i> Cetak</a>
                <a href="laporan_visitor" type="button" class="btn btn-inverse btn-outline btn-rounded mb5"><i class="fa fa-print fa-lg"></i> Back</a>
            </div>                    
        </div>
        <br/>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Kode Tamu : <?php echo $KODE_TAMU ?></h3>
            </div>
            <table class="table table-striped table-bordered" id="column-filtering">
                <thead>
                    <tr>
                        <th>Nama Visitor</th>
                        <th>Asal</th>
                        <th>Keperluan</th>
                        <th>PIC</th>
                        <th>Tanggal Masuk</th>
                        <th>Tanggal Keluar</th>
                        <th>Masuk Produksi</th>
                        <th>Keluar Produksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
                    {
                        $DINO            = date("Y-m-d H:i:s");
                        $KODE_TAMU       = $row["kode"];

                        $TANGGAL         = DATE_CREATE($row["date_in"]);
                        $TANGGAL2        = DATE_CREATE($row["date_out"]);
                        $TANGGAL_MASUK   = DATE_FORMAT($TANGGAL, 'd/m/Y');
                        $JAM_MASUK       = DATE_FORMAT($TANGGAL, 'H:i:s');
                        $TANGGAL_KELUAR  = DATE_FORMAT($TANGGAL2, 'd/m/Y');
                        $JAM_KELUAR      = DATE_FORMAT($TANGGAL2, 'H:i:s');

                        $TANGGAL_P       = DATE_CREATE($row["date_in_p"]);
                        $TANGGAL2_P      = DATE_CREATE($row["date_out_p"]);
                        $TANGGAL_MASUK_P = DATE_FORMAT($TANGGAL_P, 'd/m/Y');
                        $JAM_MASUK_P     = DATE_FORMAT($TANGGAL_P, 'H:i:s');
                        $TANGGAL_KELUAR_P= DATE_FORMAT($TANGGAL2_P, 'd/m/Y');
                        $JAM_KELUAR_P    = DATE_FORMAT($TANGGAL2_P, 'H:i:s');
 
                        $KEPERLUAN = $row["app_type"];

                        if($KEPERLUAN == 1)
                        {
                            $KEPERLUAN = "Audit";
                        }
                        else if ($KEPERLUAN == 2)
                        {
                            $KEPERLUAN = "Buyer/Supplier";
                        }
                        else if ($KEPERLUAN == 3)
                        {
                            $KEPERLUAN = "Dinas";
                        }
                        else if ($KEPERLUAN == 4)
                        {
                            $KEPERLUAN = "Inspector";
                        }
                        else if ($KEPERLUAN == 5)
                        {
                            $KEPERLUAN = "Meeting";
                        }
                        else if ($KEPERLUAN == 6)
                        {
                            $KEPERLUAN = "Tes/Interview";
                        }
                        else if ($KEPERLUAN == 7)
                        {
                            $KEPERLUAN = "Vendor";
                        }

                        if(null == $row["date_in_p"])
                        {
                            $TANGGAL_MASUK_P    = "-";
                            $JAM_MASUK_P        = "";
                            $TANGGAL_KELUAR_P   = "-";
                            $JAM_KELUAR_P       = "";
                        }

                        ?>
                        <tr>
                            <td align="center"><?php echo $row["name"]; ?></td>
                            <td><?php echo $row["company"]; ?></td>
                            <td align="center"><?php echo $KEPERLUAN ?></td>
                            <td align="center"><?php echo $row["app_with"]; ?></td>
                            <td align="center"><?php echo $TANGGAL_MASUK;?> <br/> 
                                                  <?php echo $JAM_MASUK; ?></td>
                            <td align="center"><?php echo $TANGGAL_KELUAR;?> <br/> 
                                                  <?php echo $JAM_KELUAR; ?></td>
                            <td align="center"><?php echo $TANGGAL_MASUK_P;?> <br/> 
                                                  <?php echo $JAM_MASUK_P; ?></td>
                            <td align="center"><?php echo $TANGGAL_KELUAR_P;?> <br/> 
                                                  <?php echo $JAM_KELUAR_P; ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>