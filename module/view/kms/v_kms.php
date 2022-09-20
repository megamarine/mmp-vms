<?php
$stmt = GetQuery("select a.kms_id,
                         a.borrowed_date,
                         a.borrowed_name,
                         a.borrowed_remark,
                         b.nama_ruangan
                    from t_kms a
                    join m_key b ON a.key_id = b.key_id
                   where a.status ='1'
                order by a.kms_id desc");
?>
<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="fa fa-key fa-lg"></i> Key Management System</h4>
    </div>
    <div class="page-header-section">
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama"><i class="ico-home2"></i> Dashboard</a></li>
                <li class="active"><i class="fa fa-key"></i> KMS</li>
            </ol>
        </div>
    </div>
</div>
<div align="center">
    <a href="kms_in" class="btn btn-primary mb5"><i class="fa fa-plus"></i> New Transaction</a>
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
                        <th>Room's / Key's Name</th>
                        <th>Borrowed By</th>
                        <th>Borrowed Time</th>
                        <th>Remark</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
                    {
                        ?>
                        <tr>
                            <td align="center">
                                <a href="kms_out?TRANS_ID=<?= $row["kms_id"]; ?>" class="btn btn-danger mb5">Kembalikan</a>
                            </td>
                            <td align="left"><?= $row["nama_ruangan"]; ?></td>
                            <td align="left"><?= $row["borrowed_name"]; ?></td>
                            <td align="left"><?= $row["borrowed_date"]; ?></td>
                            <td align="left"><?= $row["borrowed_remark"]; ?></td>
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