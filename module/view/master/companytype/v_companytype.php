<?php
$stmt = GetQuery("select * from m_companytype order by type_id asc");
?>
<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="fas fa-city"></i> Master Company Type</h4>
    </div>
    <div class="page-header-section">
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama"><i class="ico-home2"></i> Dashboard</a></li>
                <li class="active"><i class="fas fa-city"></i> Company Type</li>
            </ol>
        </div>
    </div>
</div>
<?php 
if($create_mcompanytype == 1){
?>
<div class="row">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-12">
                    <a href="tambah_companytype" type="button" class="btn btn-danger btn-outline mb5"><i class="ico-plus2"></i> Add Company Type</a>
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
                <h3 class="panel-title">Company Type List</h3>
            </div>
            <table class="table table-striped table-bordered" id="column-filtering">
                <thead>
                    <tr>
                        <th>Option</th>
                        <th>Company Type</th>
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
                                if($delete_mcompanytype == 1){
                                ?>
                                <a href="hapus_companytype?KODE=<?php echo $row["type_id"]; ?>" class="btn btn-danger mb5" onclick="return confirm('Delete : <?= $row["type_id"]." - ".$row["type_name"]?> ?')"> <i class="fas fa-trash" ></i></a>
                                <?php }
                                if($update_mcompanytype == 1){
                                ?>
                                <a href="edit_companytype?KODE=<?php echo $row["type_id"]; ?>" class="btn btn-teal mb5"><i class="fas fa-edit"></i></a>
                                <?php } ?>
                            </td>
                            <td align="left"><?php echo $row["type_name"]; ?></td>
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