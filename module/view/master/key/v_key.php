<?php
$stmt = GetQuery("select * from m_key order by key_id asc");
?>
<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="fas fa-key"></i> Master Key</h4>
    </div>
    <div class="page-header-section">
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama"><i class="ico-home2"></i> Dashboard</a></li>
                <li class="active"><i class="fas fa-key"></i> Key</li>
            </ol>
        </div>
    </div>
</div>
<?php 
if($create_mkey == 1){
?>
<div class="row">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-12">
                <a href="tambah_key" type="button" class="btn btn-danger btn-outline mb5"><i class="ico-plus2"></i> Add Key</a>
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
                <h3 class="panel-title">Key List</h3>
            </div>
            <table class="table table-striped table-bordered" id="column-filtering">
                <thead>
                    <tr>
                        <th>Option</th>
                        <th>Room's Key</th>
                        <th>Key's Location</th>
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
                            $status = "Not Available";
                        }
                        elseif($status == "0")
                        {
                            $status = "Available";
                        }
                        ?>
                        <tr>
                            <td align="center">
                                <?php 
                                if($delete_mkey == 1){
                                ?>
                                <a href="hapus_key?KODE=<?php echo $row["key_id"]; ?>" class="btn btn-danger mb5" onclick="return confirm('Delete : <?= $row["key_id"]." - ".$row["nama_ruangan"]?> ?')"> <i class="fas fa-trash" ></i></a>
                                <?php }
                                if($update_mkey == 1){
                                ?>
                                <a href="edit_key?KODE=<?php echo $row["key_id"]; ?>" class="btn btn-teal mb5"><i class="fas fa-edit"></i></a>
                                <?php } ?>
                            </td>
                            <td align="left"><?php echo $row["nama_ruangan"]; ?></td>
                            <td align="left"><?php echo $row["key_location"]; ?></td>
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