<?php
include "module/controller/master/division/t_division.php";
?>
<script type="text/javascript">
function getMASTER_DIVISI(val)
{
  $.ajax({
  type: "POST",
  url: "cek_m_divisi.php",
  data:'DIVISION_CODE='+val,
  success: function(data){
    $("#DATA_DIV").html(data);
  }
  });
}
</script>
<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="fas fa-landmark"></i> Edit Division</h4>
    </div>
    <div class="page-header-section">
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama"><i class="ico-home2"></i> Dashboard</a></li>
                <li><a href="m_division"><i class="fas fa-landmark"></i> Division</a></li>
                <li class="active"><i class="fas fa-edit"></i> Edit Division</li>
            </ol>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <form role="form" action="" method="post" data-parsley-validate>
            <div id="DATA_DIV"></div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="DEPARTMENT_CODE">Department <span class="text-danger">*</span></label>
                        <select name="DEPARTMENT_CODE" id="DEPARTMENT_CODE" required="" class="form-control" data-parsley-required>
                            <option value="">Choose Department</option>
                            <?php
                            $stmj = GetQuery("select * from m_department order by dept_name asc");
                            while ($rowz = $stmj->fetch(PDO::FETCH_ASSOC)) 
                            {
                                ?>
                                <option value="<?php echo $rowz["dept_id"]; ?>"
                                    <?php 
                                        if($DEPARTMENT_CODE == $rowz["dept_id"]) 
                                        { 
                                            echo "selected"; 
                                        } 
                                    ?>>
                                    <?php 
                                        echo $rowz["dept_name"]; 
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
                        <label for="DIVISION_CODE">Division Code <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" required="" autocomplete="off" id="DIVISION_CODE" name="DIVISION_CODE" oninput="getMASTER_DIVISI(this.value);" onkeypress="return event.keyCode!=13" value="<?php echo $DIVISION_CODE; ?>" data-parsley-required>
                    </div>                          
                </div> 
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="DIVISION_NAME">Division <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" required="" autocomplete="off" id="DIVISION_NAME" name="DIVISION_NAME" value="<?php echo $DIVISION_NAME; ?>" data-parsley-required>
                    </div>                          
                </div> 
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="STATUS">Status <span class="text-danger">*</span></label>
                        <select name="STATUS" id="STATUS" required="" class="form-control" data-parsley-required>
                            <option value="">Pilih Status</option>
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
                    <a href="m_division" type="button" class="btn btn-danger"><i class="ico-close2"></i> Cancel</a>
                </div>                    
            </div>
            <br><br>
        </form>
    </div>
</div>