<?php
$stmt = GetQuery("select * from m_department order by dept_id asc");
?>
<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="fas fa-sitemap"></i> Master Department</h4>
    </div>
    <div class="page-header-section">
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama"><i class="ico-home2"></i> Dashboard</a></li>
                <li class="active"><i class="fas fa-sitemap"></i> Department</li>
            </ol>
        </div>
    </div>
</div>
<?php 
if($create_mdepartment == 1){
?>
<div class="row">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-12">
                    <a href="tambah_department" type="button" class="btn btn-danger btn-outline mb5"><i class="ico-plus2"></i> Add Department</a>
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
                <h3 class="panel-title">Department List</h3>
            </div>
            <table class="table table-striped table-bordered" id="column-filtering">
                <thead>
                    <tr>
                        <th>Option</th>
                        <th>Department Code</th>
                        <th>Department</th>
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
                                if($delete_mdepartment == 1){
                                ?>
                                <a href="hapus_department?KODE=<?php echo $row["dept_id"]; ?>" class="btn btn-danger mb5" onclick="return confirm('Delete : <?= $row["dept_id"]." - ".$row["dept_name"]?> ?')"> <i class="fas fa-trash" ></i></a>
                                <?php }
                                if($update_mdepartment == 1){
                                ?>
                                <a href="edit_department?KODE=<?php echo $row["dept_id"]; ?>" class="btn btn-teal mb5"><i class="fas fa-edit"></i></a>
                                <?php } ?>
                            </td>
                            <td align="left"><?php echo $row["dept_id"]; ?></td>
                            <td align="left"><?php echo $row["dept_name"]; ?></td>
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