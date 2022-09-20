<?php
$stmt = GetQuery("select a.*, b.um_desc 
                    from m_vehicle a
                    left join m_um b ON a.um_id = b.um_id
                order by a.vehicle_id asc");
?>
<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="fas fa-car"></i> Master Vehicle</h4>
    </div>
    <div class="page-header-section">
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama"><i class="ico-home2"></i> Dashboard</a></li>
                <li class="active"><i class="fas fa-car"></i> Vehicle</li>
            </ol>
        </div>
    </div>
</div>
<?php 
if($create_mvehicle == 1){
?>
<div class="row">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-12">
                <a href="tambah_vehicle" type="button" class="btn btn-danger btn-outline mb5"><i class="ico-plus2"></i> Add Vehicle</a>
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
                <h3 class="panel-title">Vehicle List</h3>
            </div>
            <table class="table table-striped table-bordered" id="column-filtering">
                <thead>
                    <tr>
                        <th>Option</th>
                        <th>Vehicle</th>
                        <th>Size</th>
                        <th>Unit Measurement</th>
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
                                if($delete_mvehicle == 1){
                                ?>
                                <a href="hapus_vehicle?KODE=<?php echo $row["vehicle_id"]; ?>" class="btn btn-danger mb5" onclick="return confirm('Delete : <?= $row["vehicle_id"]." - ".$row["vehicle_name"]?> ?')"> <i class="fas fa-trash" ></i></a>
                                <?php }
                                if($update_mvehicle == 1){
                                ?>
                                <a href="edit_vehicle?KODE=<?php echo $row["vehicle_id"]; ?>" class="btn btn-teal mb5"><i class="fas fa-edit"></i></a>
                                <?php } ?>
                            </td>
                            <td align="left"><?php echo $row["vehicle_name"]; ?></td>
                            <td align="left"><?php echo $row["size"]; ?></td>
                            <td align="left"><?php echo $row["um_desc"]; ?></td>
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