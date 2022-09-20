<?php
include "module/controller/master/vehicle/t_vehicle.php";
?>
<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="fas fa-car"></i> Add Vehicle</h4>
    </div>
    <div class="page-header-section">
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama"><i class="ico-home2"></i> Dashboard</a></li>
                <li><a href="m_vehicle"><i class="fas fa-car"></i> Vehicle</a></li>
                <li class="active"><i class="ico-plus2"></i> Add Vehicle</li>
            </ol>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <form role="form" action="" method="post" data-parsley-validate>
            <div id="DATA_VEHICLE"></div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="VEHICLE_NAME">Vehicle Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" required="" autocomplete="off" id="VEHICLE_NAME" name="VEHICLE_NAME" data-parsley-required>
                    </div>                          
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="SIZE">Size </label>
                        <input type="text" class="form-control" autocomplete="off" id="SIZE" name="SIZE">
                    </div>                          
                </div>
                <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="UM_CODE">Unit Measurement </label>
                        <select name="UM_CODE" id="UM_CODE" class="form-control">
                            <option value="">Choose Unit Measurement</option>
                            <?php
                            $stmj = GetQuery("select * from m_um where status = 1 order by um_id asc");
                            while ($rowz = $stmj->fetch(PDO::FETCH_ASSOC)) 
                            {
                                ?>
                                <option value="<?php echo $rowz["um_id"]; ?>"><?= $rowz["um_desc"];?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <br><br>
            <div class="row">
                <div class="col-lg-12" align="center">
                    <button type="submit" name="simpan" class="btn btn-primary"><i class="ico-save"></i> Save</button>&nbsp&nbsp&nbsp
                    <a href="m_vehicle" type="button" class="btn btn-danger"><i class="ico-close2"></i> Cancel</a>
                </div>                    
            </div>
            <br><br>
        </form>
    </div>
</div>