<?php
include "module/controller/master/key/t_key.php";
?>
<script type="text/javascript">
function getMASTER_EMPLOYEES(val)
{
  $.ajax({
  type: "POST",
  url: "cek_m_key.php",
  data:'ROOMS_KEY='+val,
  success: function(data){
    $("#DATA_KEY").html(data);
  }
  });
}
</script>
<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="fas fa-key"></i> Edit Key</h4>
    </div>
    <div class="page-header-section">
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama"><i class="ico-home2"></i> Dashboard</a></li>
                <li><a href="m_key"><i class="fas fa-key"></i> Key</a></li>
                <li class="active"><i class="fas fa-edit"></i> Edit Key</li>
            </ol>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <form role="form" action="" method="post" data-parsley-validate>
            <div id="DATA_KEY"></div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="ROOMS_KEY">Room's Key <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" required="" autocomplete="off" id="ROOMS_KEY" name="ROOMS_KEY" oninput="getMASTER_EMPLOYEES(this.value);" onkeypress="return event.keyCode!=13" value="<?php echo $ROOMS_KEY; ?>" data-parsley-required>
                    </div>                          
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="LOCATION">Location <span class="text-danger">*</span></label>
                        <select name="LOCATION" id="LOCATION" required="" class="form-control" data-parsley-required>
                            <option value="">Choose Location</option>
                            <option value="Security" <?php if($LOCATION == "Security"){ echo "selected";} ?> >Security</option>
                            <option value="House Keeping" <?php if($LOCATION == "House Keeping"){ echo "selected";} ?> >House Keeping</option>
                            <option value="IT" <?php if($LOCATION == "IT"){ echo "selected";} ?> >IT</option>
                        </select>
                    </div>                          
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="STATUS">Status <span class="text-danger">*</span></label>
                        <select name="STATUS" id="STATUS" required="" class="form-control" data-parsley-required>
                            <option value="">Pilih Status</option>
                            <option value="0" <?php if($STATUS == "0"){ echo "selected";} ?> >Available</option>
                            <option value="1" <?php if($STATUS == "1"){ echo "selected";} ?> >Not Available</option>
                        </select>
                    </div>                          
                </div>
            </div>
            <br><br>
            <div class="row">
                <div class="col-lg-12" align="center">
                    <button type="submit" name="simpan" class="btn btn-primary"><i class="ico-save"></i> Save</button>&nbsp&nbsp&nbsp
                    <a href="m_key" type="button" class="btn btn-danger"><i class="ico-close2"></i> Cancel</a>
                </div>                    
            </div>
            <br><br>
        </form>
    </div>
</div>