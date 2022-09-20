<?php
$stmt = GetQuery("select pms_id,
                         DATE_FORMAT(date_trans, '%d %M %Y') as tanggal_datang,
                         DATE_FORMAT(date_trans, '%H:%i:%s') as jam_datang,
                         package_type,
                         package_from,
                         package_for
                    from t_pms
                   where status = '1'
                order by date_trans desc");
?>
<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="fa fa-cube fa-lg"></i> Package Management System</h4>
    </div>
    <div class="page-header-section">
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama"><i class="ico-home2"></i> Dashboard</a></li>
                <li class="active"><i class="fa fa-cube"></i> PMS</li>
            </ol>
        </div>
    </div>
</div>
<div align="center">
    <a href="pms_in" class="btn btn-primary mb5"><i class="fas fa-plus"></i> New Transaction</a>
</div></br>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Currently Active</h3>
            </div>
            <table class="table table-striped table-bordered" id="table-tools">
                <thead>
                    <tr>
                        <th>Option</th>
                        <th>Package Code</th>
                        <th>Time Received</th>
                        <th>Package For</th>
                        <th>Package From</th>
                        <th>Type</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
                    {
                        ?>
                        <tr>
                            <td align="center"><a href="pms_out?TRANS_ID=<?= $row["pms_id"]; ?>" class="btn btn-danger mb5">Antar / Ambil</a></td>
                            <td align="left"><?= $row["pms_id"]; ?></a></td>
                            <td align="left"><?= $row["tanggal_datang"]." ".$row["jam_datang"]; ?></a></td>
                            <td align="left"><?= $row["package_for"]; ?></a></td>
                            <td align="left"><?= $row["package_from"]; ?></a></td>
                            <td align="left"><?= $row["package_type"]; ?></a></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    $(function(){
        $('#datepicker1').datepicker({
            dateFormat: 'yy-mm-dd'
        });
    });
</script>