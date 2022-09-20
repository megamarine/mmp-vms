<?php
include "module/controller/master/employees/t_employees.php";
?>
<script type="text/javascript">
function getMASTER_EMPLOYEES(val)
{
  $.ajax({
  type: "POST",
  url: "cek_m_employees.php",
  data:'EMPLOYEES_CODE='+val,
  success: function(data){
    $("#DATA_EMPLOYEES").html(data);
  }
  });
}

function getKODE_DIVISI(val) {
  $.ajax({
  type: "POST",
  url: "cek_divisi.php",
  data:'DEPARTEMENT='+val,
  success: function(data){
    $("#DIVISION_CODE").html(data);
  }
  });
}
</script>
<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="fas fa-users"></i> Edit Employees</h4>
    </div>
    <div class="page-header-section">
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama"><i class="ico-home2"></i> Dashboard</a></li>
                <li><a href="m_employees"><i class="fas fa-users"></i> Employees</a></li>
                <li class="active"><i class="fas fa-edit"></i> Edit Employees</li>
            </ol>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <form role="form" action="" method="post" data-parsley-validate>
            <div id="DATA_EMPLOYEES"></div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="EMPLOYEES_CODE">Employees Code <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" required="" autocomplete="off" id="EMPLOYEES_CODE" name="EMPLOYEES_CODE" oninput="getMASTER_EMPLOYEES(this.value);" onkeypress="return event.keyCode!=13" value="<?php echo $EMPLOYEES_CODE; ?>" data-parsley-required>
                    </div>                          
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="EMPLOYEES_NAME">Employees Name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" required="" autocomplete="off" id="EMPLOYEES_NAME" name="EMPLOYEES_NAME" value="<?php echo $EMPLOYEES_NAME; ?>" data-parsley-required>
                    </div>                          
                </div> 
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
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="DEPARTMENT_CODE">Department <span class="text-danger">*</span></label>
                        <select name="DEPARTMENT_CODE" id="DEPARTMENT_CODE" required="" class="form-control" onchange="getKODE_DIVISI(this.value);"  data-parsley-required>
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
                        <label for="DIVISION_CODE">Division <span class="text-danger">*</span></label>
                        <select name="DIVISION_CODE" id="DIVISION_CODE" required="" class="form-control" data-parsley-required>
                            <option value="">Choose Division</option>
                            <?php
                            $stmj = GetQuery("select * from m_division where dept_id = '$DEPARTMENT_CODE' order by div_name asc");
                            while ($rowz = $stmj->fetch(PDO::FETCH_ASSOC)) 
                            {
                                ?>
                                <option value="<?php echo $rowz["div_id"]; ?>"
                                    <?php 
                                        if($DIVISION_CODE == $rowz["div_id"]) 
                                        { 
                                            echo "selected"; 
                                        } 
                                    ?>>
                                    <?php 
                                        echo $rowz["div_name"]; 
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
                        <label for="LEVEL_CODE">Level <span class="text-danger">*</span></label>
                        <select name="LEVEL_CODE" id="LEVEL_CODE" required="" class="form-control" data-parsley-required>
                            <option value="">Choose Level</option>
                            <?php
                            $stmj = GetQuery("select * from m_level order by level_name asc");
                            while ($rowz = $stmj->fetch(PDO::FETCH_ASSOC)) 
                            {
                                ?>
                                <option value="<?php echo $rowz["level_id"]; ?>"
                                    <?php 
                                        if($LEVEL_CODE == $rowz["level_id"]) 
                                        { 
                                            echo "selected"; 
                                        } 
                                    ?>>
                                    <?php 
                                        echo $rowz["level_name"]; 
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
                        <label for="RFID_NUMBER">RFID Number <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" required="" autocomplete="off" id="RFID_NUMBER" name="RFID_NUMBER" value="<?php echo $RFID_NUMBER; ?>" data-parsley-required>
                    </div>                          
                </div>
            </div>
            <br><br>
            <div class="row">
                <div class="col-lg-12" align="center">
                    <button type="submit" name="simpan" class="btn btn-primary"><i class="ico-save"></i> Save</button>&nbsp&nbsp&nbsp
                    <a href="m_employees" type="button" class="btn btn-danger"><i class="ico-close2"></i> Cancel</a>
                </div>                    
            </div>
            <br><br>
        </form>
    </div>
</div>