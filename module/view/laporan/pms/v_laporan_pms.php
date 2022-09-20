<?php
$where_clause   = "";
$JENIS_PAKET    = "";

if (isset($_POST["cari"]))
{
    $PERIODE      = $_POST["PERIODE"];
    $PERIODE2     = $_POST["PERIODE2"];
    if (isset($_POST["JENIS_PAKET"]) and ($_POST["JENIS_PAKET"] != '' ))
    {
        $JENIS_PAKET  = $_POST["JENIS_PAKET"];
        $where_clause = "and package_type = '$JENIS_PAKET'";
    }
}
else
{
    $PERIODE    = date("Y-m-01");
    $PERIODE2   = date("Y-m-d");
}

$stmt = GetQuery("select *
                    from t_pms
                   where STR_TO_DATE(date_trans, '%Y-%m-%d') between '$PERIODE' and '$PERIODE2' $where_clause
                order by date_trans desc");
?>

<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="fa fa-box-open fa-lg"></i> Report Package Management System <?= $JENIS_PAKET; ?></h4>
    </div>
    <div class="page-header-section">
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama"><i class="ico-home2"></i> Dashboard</a></li>
                <li class="active"><i class="fa fa-box-open"></i> Laporan PMS</li>
            </ol>
        </div>
    </div>
</div>
<div class="row">
    <form role="form" action="" method="post">
        <div class="col-md-3">
            <div class="form-group">
                <label for="PERIODE">Periode Awal</label>
                <input type="date" class="form-control" name="PERIODE" value="<?= $PERIODE; ?>" />
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="PERIODE">Periode Akhir</label>
                <input type="date" class="form-control" name="PERIODE2" value="<?= $PERIODE2; ?>" />
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="JENIS_PAKET">Package Type</label>
                <select name="JENIS_PAKET" id="JENIS_PAKET" class="form-control">
                    <option style="background: #74777a; color: #fff;" value="">-- Choose Package Type --</option>
                    <option value="Dokumen" <?php if($JENIS_PAKET == 'Dokumen'){ echo "selected";} ?>>Dokumen</option>
                    <option value="Barang" <?php if($JENIS_PAKET == 'Barang'){ echo "selected";} ?>>Barang</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label style="color: transparent;">.</label><br>
            <button type="submit" name="cari" class="btn btn-primary"><i class="fa fa-search-plus"></i> Search</button>&nbsp&nbsp&nbsp
            <a href="laporan_pms" type="button" class="btn btn-danger"><i class="fas fa-redo"></i> Clear</a>
        </div>   
    </form>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-12" align="right">
                <a href="print_laporan_pms?PERIODE=<?= $PERIODE; ?>&PERIODE2=<?= $PERIODE2; ?>&PT=<?= $JENIS_PAKET; ?>" type="button" target="_blank" class="btn btn-inverse btn-outline btn-rounded mb5"><i class="fa fa-print fa-lg"></i> Export to PDF</a>
            </div>                    
        </div>
        <br/>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Report PMS</h3>
            </div>
            <table class="table table-striped table-bordered" id="table-tools">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>PMS ID</th>
                        <th>Time Received</th>
                        <th>Package Type</th>
                        <th>Package From</th>
                        <th>Package For</th>
                        <th>Received By</th>
                        <th>Delivered By</th>
                        <th>Time Deliver</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
                    {
                        $DINO   = date("Y-m-d H:i:s");
                        if($row["status"] == 1)
                        {
                            $stat = "Waiting";
                        }
                        else
                        {
                            $stat = "Done";
                        }
                        ?>
                        <tr>
                            <td align="center"><?= $no++."."; ?></a></td>
                            <td align="left"><?= "<b>".$row["pms_id"]."</b>"; ?></a></td>
                            <td align="left"><?= $row["date_trans"]; ?></td>
                            <td align="left"><?= $row["package_type"]; ?></td>
                            <td align="left"><?= ucwords(strtolower($row["package_from"])); ?></td>
                            <td align="left"><?= ucwords(strtolower($row["package_for"])); ?></td>
                            <td align="left"><?= ucwords(strtolower($row["receiver"])); ?></td>
                            <td align="left"><?= ucwords(strtolower($row["deliver"])); ?></td>
                            <td align="left"><?= $row["date_received"]; ?></td>
                            <td align="left"><?= $stat; ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>