<?php
include "module/controller/master/department/t_department.php";
?>
<script type="text/javascript">
function getMASTER_DEPARTMENT(val)
{
  $.ajax({
  type: "POST",
  url: "cek_m_department.php",
  data:'DEPARTMENT_CODE='+val,
  success: function(data){
    $("#DATA_DEPT").html(data);
  }
  });
}
</script>
<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="fas fa-sitemap"></i> Add Department</h4>
    </div>
    <div class="page-header-section">
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama"><i class="ico-home2"></i> Dashboard</a></li>
                <li><a href="m_department"><i class="fas fa-sitemap"></i> Department</a></li>
                <li class="active"><i class="ico-plus2"></i> Add Department</li>
            </ol>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <form role="form" action="" method="post" data-parsley-validate>
            <div id="DATA_DEPT"></div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="DEPARTMENT_CODE">Department Code <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" required="" autocomplete="off" id="DEPARTMENT_CODE" name="DEPARTMENT_CODE" oninput="getMASTER_DEPARTMENT(this.value);" onkeypress="return event.keyCode!=13" value="<?php echo $DEPARTMENT_CODE; ?>" data-parsley-required>
                    </div>                          
                </div> 
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="DEPARTMENT_NAME">Department <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" required="" autocomplete="off" id="DEPARTMENT_NAME" name="DEPARTMENT_NAME" value="<?php echo $DEPARTMENT_NAME; ?>" data-parsley-required>
                    </div>                          
                </div> 
            </div>
            <br><br>
            <div class="row">
                <div class="col-lg-12" align="center">
                    <button type="submit" name="simpan" class="btn btn-primary"><i class="ico-save"></i> Save</button>&nbsp&nbsp&nbsp
                    <a href="m_department" type="button" class="btn btn-danger"><i class="ico-close2"></i> Cancel</a>
                </div>                    
            </div>
            <br><br>
        </form>
    </div>
</div>