<?php
$stmt = GetQuery("select a.*, b.dept_name from m_division a join m_department b ON a.dept_id = b.dept_id order by a.div_id asc");
?>
<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="fas fa-landmark"></i> Master Division</h4>
    </div>
    <div class="page-header-section">
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama"><i class="ico-home2"></i> Dashboard</a></li>
                <li class="active"><i class="fas fa-landmark"></i> Division</li>
            </ol>
        </div>
    </div>
</div>
<?php 
if($create_mdivision == 1){
?>
<div class="row">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-12">
                    <a href="tambah_division" type="button" class="btn btn-danger btn-outline mb5"><i class="ico-plus2"></i> Add Division</a>
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
                <h3 class="panel-title">Division List</h3>
            </div>
            <table class="table table-striped table-bordered" id="column-filtering">
                <thead>
                    <tr>
                        <th>Option</th>
                        <th>Department</th>
                        <th>Division Code</th>
                        <th>Division</th>
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
                                if($delete_mdivision == 1){
                                ?>
                                <a href="hapus_division?KODE=<?php echo $row["div_id"]; ?>" class="btn btn-danger mb5" onclick="return confirm('Delete : <?= $row["div_id"]." - ".$row["div_name"]?> ?')"> <i class="fas fa-trash" ></i></a>
                                <?php }
                                if($update_mdivision == 1){
                                ?>
                                <a href="edit_division?KODE=<?php echo $row["div_id"]; ?>" class="btn btn-teal mb5"><i class="fas fa-edit"></i></a>
                                <?php } ?>
                            </td>
                            <td align="left"><?php echo $row["dept_name"]; ?></td>
                            <td align="left"><?php echo $row["div_id"]; ?></td>
                            <td align="left"><?php echo $row["div_name"]; ?></td>
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