<?php
$stmt = GetQuery("select * from m_purpose order by purpose_id");
?>
<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="fas fa-map-signs"></i> Master Purpose</h4>
    </div>
    <div class="page-header-section">
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama"><i class="ico-home2"></i> Dashboard</a></li>
                <li class="active"><i class="fas fa-map-signs"></i> Purpose</li>
            </ol>
        </div>
    </div>
</div>
<?php 
if($create_mpurpose == 1){
?>
<div class="row">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-12">
                <a href="tambah_purpose" type="button" class="btn btn-danger btn-outline mb5"><i class="ico-plus2"></i> Add Purpose</a>
            </div>                    
        </div>
        <br/>
    </div>
</div>
<?php } ?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Purpose List</h3>
            </div>
            <table class="table table-striped table-bordered" id="column-filtering">
                <thead>
                    <tr>
                        <th>Option</th>
                        <th>Purpose Name</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
                    {
                        $status = $row["status"];
                        if($status == "1")
                        {
                            $status = "Active";
                        }
                        elseif($status == "0")
                        {
                            $status = "Non Active";
                        }
                        ?>
                        <tr>
                            <td align="center">
                                <?php 
                                if($delete_mpurpose == 1){
                                ?>
                                <a href="hapus_purpose?KODE=<?php echo $row["purpose_id"]; ?>" class="btn btn-danger mb5" onclick="return confirm('Delete : <?= $row["purpose_id"]." - ".$row["purpose_desc"]?> ?')"> <i class="fas fa-trash" ></i></a>
                                <?php }
                                if($update_mpurpose == 1){
                                ?>
                                <a href="edit_purpose?KODE=<?php echo $row["purpose_id"]; ?>" class="btn btn-teal mb5"><i class="fas fa-edit"></i></a>
                                <?php } ?>
                            </td>
                            <td align="left"><?php echo $row["purpose_desc"]; ?></td>
                            <td align="left"><?php echo $status; ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>