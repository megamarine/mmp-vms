<?php

$stmt  = GetQuery("select a.*, 
                          b.dept_name, 
                          c.div_name 
                     from m_user a 
                     join m_department b ON a.dept_id = b.dept_id 
                     join m_division c ON a.div_id = c.div_id 
                    where a.status_delete='0' order by a.kode_user;");

?>
<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="fas fa-user"></i> Master User</h4>
    </div>
    <div class="page-header-section">
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama"><i class="ico-home2"></i> Dashboard</a></li>
                <li class="active"><i class="fas fa-user"></i> User</li>
            </ol>
        </div>
    </div>
</div>
<?php 
if($create_muser == 1){
?>
<div class="row">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-12">
                <a href="tambah_user" type="button" class="btn btn-danger btn-outline mb5"><i class="ico-plus2"></i> Add User</a>
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
                <h3 class="panel-title">User List</h3>
            </div>
            <table class="table table-striped table-bordered" id="column-filtering">
                <thead>
                    <tr>
                        <th>Option</th>
                        <th>Username</th>
                        <th>Name</th>
                        <th>Departement</th>
                        <th>Division</th>
                        <th>Access</th>
                        <th>Email</th>
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
                                if($delete_muser == 1){
                                ?>
                                <a href="hapus_user?KODE=<?php echo $row["kode_user"]; ?>" title="Delete" class="btn btn-danger mb5" onclick="return confirm('Delete : <?= $row["kode_user"]." - ".$row["nama_user"]?> ?')"><i class="fas fa-trash"></i></a>
                                <?php }
                                if($update_muser == 1){
                                ?>
                                <a href="edit_user?KODE=<?php echo $row["kode_user"]; ?>" title="Edit" class="btn btn-teal mb5"><i class="fas fa-edit"></i></a>
                                <?php } ?>
                            </td>
                            <td><?php echo $row["kode_user"]; ?></td>
                            <td><?php echo $row["nama_user"]; ?></td>
                            <td><?php echo $row["dept_name"]; ?></td>
                            <td><?php echo $row["div_name"]; ?></td>
                            <td><?php echo $row["akses"]; ?></td>
                            <td><?php echo $row["email"]; ?></td>
                            <td><?php echo $status; ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>