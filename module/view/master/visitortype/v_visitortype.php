<?php
$stmt = GetQuery("select * from m_visitortype order by visitortype_id");
?>
<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="fas fa-user-tag"></i> Master Visitor Type</h4>
    </div>
    <div class="page-header-section">
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama"><i class="ico-home2"></i> Dashboard</a></li>
                <li class="active"><i class="fas fa-user-tag"></i> Visitor Type</li>
            </ol>
        </div>
    </div>
</div>
<?php 
if($create_mvisitortype == 1){
?>
<div class="row">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-12">
                <a href="tambah_visitortype" type="button" class="btn btn-danger btn-outline mb5"><i class="ico-plus2"></i> Add Visitor Type</a>
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
                <h3 class="panel-title">Visitor Type List</h3>
            </div>
            <table class="table table-striped table-bordered" id="column-filtering">
                <thead>
                    <tr>
                        <th>Option</th>
                        <th>Visitor Type Name</th>
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
                                if($delete_mvisitortype == 1){
                                ?>
                                <a href="hapus_visitortype?KODE=<?php echo $row["visitortype_id"]; ?>" class="btn btn-danger mb5" onclick="return confirm('Delete : <?= $row["visitortype_id"]." - ".$row["visitortype_name"]?> ?')"> <i class="fas fa-trash" ></i></a>
                                <?php }
                                if($update_mvisitortype == 1){
                                ?>
                                <a href="edit_visitortype?KODE=<?php echo $row["visitortype_id"]; ?>" class="btn btn-teal mb5"><i class="fas fa-edit"></i></a>
                                <?php } ?>
                            </td>
                            <td align="left"><?php echo $row["visitortype_name"]; ?></td>
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