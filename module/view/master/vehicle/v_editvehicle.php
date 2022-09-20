<?php
include "module/controller/master/vehicle/t_vehicle.php";
?>
<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="fas fa-car"></i> Edit Vehicle</h4>
    </div>
    <div class="page-header-section">
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama"><i class="ico-home2"></i> Dashboard</a></li>
                <li><a href="m_vehicle"><i class="fas fa-car"></i> Vehicle</a></li>
                <li class="active"><i class="fas fa-edit"></i> Edit Vehicle</li>
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
                        <input type="text" class="form-control" required="" autocomplete="off" id="VEHICLE_NAME" name="VEHICLE_NAME" value="<?php echo $VEHICLE_NAME; ?>" data-parsley-required>
                    </div>                          
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="SIZE">Size <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" required="" autocomplete="off" id="SIZE" name="SIZE" value="<?php echo $SIZE; ?>" data-parsley-required>
                    </div>                          
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="UM_CODE">Unit Measurement <span class="text-danger">*</span></label>
                        <select name="UM_CODE" id="UM_CODE" required="" class="form-control" data-parsley-required>
                            <option value="">Choose Unit Measurement</option>
                            <?php
                            $stmj = GetQuery("select * from m_um where status = 1 order by um_id asc");
                            while ($rowz = $stmj->fetch(PDO::FETCH_ASSOC)) 
                            {
                                ?>
                                <option value="<?php echo $rowz["um_id"]; ?>"
                                    <?php 
                                        if($UM_CODE == $rowz["um_id"]) 
                                        { 
                                            echo "selected"; 
                                        } 
                                    ?>>
                                    <?php 
                                        echo $rowz["um_desc"]; 
                                    ?>
                                </option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="STATUS">Status <span class="text-danger">*</span></label>
                        <select name="STATUS" id="STATUS" required="" class="form-control" data-parsley-required>
                            <option value="">Choose Status</option>
                            <option value="1" <?php if($STATUS == "1"){ echo "selected";} ?> >Active</option>
                            <option value="0" <?php if($STATUS == "0"){ echo "selected";} ?> >Non Active</option>
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