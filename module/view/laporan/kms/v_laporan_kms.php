<?php
$where_clause   = "";
$STATUS         = "";
$STATT          = "";

if (isset($_POST["cari"])) 
{
    $PERIODE      = $_POST["PERIODE"];
    $PERIODE2     = $_POST["PERIODE2"];
    if (isset($_POST["STATUS"]) and ($_POST["STATUS"] != '' ))
    {
        $STATUS       = $_POST["STATUS"];
        $where_clause = "and b.status = '$STATUS'";
    }
}
else
{
    $PERIODE    = date("Y-m-d");
    $PERIODE2   = date("Y-m-d");
}

$stmt = GetQuery("select a.*,
                         b.*
                    from m_key a
                    join t_kms b ON a.key_id = b.key_id
                   where STR_TO_DATE(b.borrowed_date, '%Y-%m-%d') between '$PERIODE' and '$PERIODE2' $where_clause
                order by b.kms_id desc");
?>

<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="fa fa-key fa-lg"></i> Laporan Key Management System</h4>
    </div>
    <div class="page-header-section">
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama"><i class="ico-home2"></i> Dashboard</a></li>
                <li class="active"><i class="fa fa-key"></i> Laporan Key</li>
            </ol>
        </div>
    </div>
</div>
<div class="row">
    <form role="form" action="" method="post">
        <div class="col-md-3">
            <div class="form-group">
                <label for="PERIODE">Periode Awal</label>
                <input type="date" class="form-control" name="PERIODE" value="<?php echo $PERIODE; ?>" />
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="PERIODE">Periode Akhir</label>
                <input type="date" class="form-control" name="PERIODE2" value="<?php echo $PERIODE2; ?>" />
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="STATUS">Status</label>
                <select name="STATUS" id="STATUS" class="form-control">
                    <option style="background: #74777a; color: #fff;" value="">-- Choose Status --</option>
                    <option value="0" <?php if($STATUS == '0'){ echo "selected";} ?>>Done</option>
                    <option value="1" <?php if($STATUS == '1'){ echo "selected";} ?>>Waiting</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label style="color: transparent;">.</label><br>
            <button type="submit" name="cari" class="btn btn-primary"><i class="fa fa-search-plus"></i> Search</button>&nbsp&nbsp&nbsp
            <a href="laporan_package" type="button" class="btn btn-danger"><i class="fa fa-redo"></i> Clear</a>
        </div>   
    </form>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-12" align="right">
                <a href="print_laporan_kms?PERIODE=<?= $PERIODE; ?>&PERIODE2=<?= $PERIODE2; ?>&ST=<?= $STATUS; ?>" type="button" target="_blank" class="btn btn-inverse btn-outline btn-rounded mb5"><i class="fa fa-print fa-lg"></i> Export to PDF</a>
            </div>                    
        </div>
        <br/>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Report KMS</h3>
            </div>
            <table class="table table-striped table-bordered" id="column-filtering">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>KMS ID</th>
                        <th>Room's Key</th>
                        <th>Borrowed By</th>
                        <th>Borrowed Time</th>
                        <th>Borrowed Remark</th>
                        <th>Returned By</th>
                        <th>Returned Time</th>
                        <th>Returned Remark</th>
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
                            <td align="left"><?= "<b>".$row["kms_id"]."</b>"; ?></a></td>
                            <td align="left"><?= $row["nama_ruangan"]; ?></td>
                            <td align="left"><?= ucwords(strtolower($row["borrowed_name"])); ?></td>
                            <td align="left"><?= $row["borrowed_date"]; ?></td>
                            <td align="left"><?= ucwords(strtolower($row["borrowed_remark"])); ?></td>
                            <td align="left"><?= ucwords(strtolower($row["return_name"])); ?></td>
                            <td align="left"><?= $row["return_date"]; ?></td>
                            <td align="left"><?= ucwords(strtolower($row["return_remark"])); ?></td>
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