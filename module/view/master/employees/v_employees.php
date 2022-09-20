<?php
$stmt = GetQuery("select a.*,
                         b.dept_name,
                         c.div_name,
                         d.level_name
                    from m_employees a
                    join m_department b ON a.dept_id = b.dept_id
                    join m_division c ON a.div_id = c.div_id
                    join m_level d ON a.level_id = d.level_id
                order by a.employees_id asc");
?>
<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="fas fa-users"></i> Master Employees</h4>
    </div>
    <div class="page-header-section">
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama"><i class="ico-home2"></i> Dashboard</a></li>
                <li class="active"><i class="fas fa-users"></i> Employees</li>
            </ol>
        </div>
    </div>
</div>
<?php 
if($create_memployees == 1){
?>
<div class="row">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-12">
                    <a href="tambah_employees" type="button" class="btn btn-danger btn-outline mb5"><i class="ico-plus2"></i> Add Employees</a>
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
                <h3 class="panel-title">Employees List</h3>
            </div>
            <table class="table table-striped table-bordered" id="column-filtering">
                <thead>
                    <tr>
                        <th>Option</th>
                        <th>Employees Code</th>
                        <th>Employees</th>
                        <th>Department</th>
                        <th>Division</th>
                        <th>Level</th>
                        <th>RFID Number</th>
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
                                if($delete_memployees == 1){
                                ?>
                                <a href="hapus_employees?KODE=<?php echo $row["employees_id"]; ?>" class="btn btn-danger mb5" onclick="return confirm('Delete : <?= $row["employees_id"]." - ".$row["employees_name"]?> ?')"> <i class="fas fa-trash" ></i></a>
                                <?php }
                                if($update_memployees == 1){
                                ?>
                                <a href="edit_employees?KODE=<?php echo $row["employees_id"]; ?>" class="btn btn-teal mb5"><i class="fas fa-edit"></i></a>
                                <?php } ?>
                            </td>
                            <td align="left"><?php echo $row["employees_id"]; ?></td>
                            <td align="left"><?php echo $row["employees_name"]; ?></td>
                            <td align="left"><?php echo $row["dept_name"]; ?></td>
                            <td align="left"><?php echo $row["div_name"]; ?></td>
                            <td align="left"><?php echo $row["level_name"]; ?></td>
                            <td align="left"><?php echo $row["rfid_number"]; ?></td>
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