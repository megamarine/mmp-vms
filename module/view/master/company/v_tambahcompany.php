<?php
include "module/controller/master/company/t_company.php";
?>
<script type="text/javascript">
function getMASTER_COMPANY(val)
{
  $.ajax({
  type: "POST",
  url: "cek_m_company.php",
  data:'COMPANY_CODE='+val,
  success: function(data){
    $("#DATA_COMPANY").html(data);
  }
  });
}
</script>
<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="fas fa-building"></i> Add Company</h4>
    </div>
    <div class="page-header-section">
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama"><i class="ico-home2"></i> Dashboard</a></li>
                <li><a href="m_company"><i class="fas fa-building"></i> Company</a></li>
                <li class="active"><i class="ico-plus2"></i> Add Company</li>
            </ol>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <form role="form" action="" method="post" data-parsley-validate>
            <div id="DATA_COMPANY"></div>
            <div class="row">
                <!-- <div class="col-md-6">
                    <div class="form-group">
                        <label for="COMPANY_CODE">Company Code <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" required="" autocomplete="off" id="COMPANY_CODE" name="COMPANY_CODE" oninput="getMASTER_COMPANY(this.value);" onkeypress="return event.keyCode!=13" value="<?php echo $COMPANY_CODE; ?>" data-parsley-required>
                    </div>                          
                </div>  -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="COMPANY_NAME">Company Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" required="" autocomplete="off" id="COMPANY_NAME" name="COMPANY_NAME" data-parsley-required>
                    </div>                          
                </div> 
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="COMPANY_TYPE">Company Type <span class="text-danger">*</span></label>
                        <select name="COMPANY_TYPE" id="COMPANY_TYPE" required="" class="form-control" data-parsley-required>
                            <option value="">Choose Company Type</option>
                            <?php
                            $stmt  = GetData("*","m_companytype where status='1'");
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
                            {
                                ?>
                                <option value="<?=$row["type_id"]; ?>"><?=$row["type_name"]; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>                          
                </div>  
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="COMPANY_ADDRESS">Address </label>
                        <input type="text" class="form-control" autocomplete="off" id="COMPANY_ADDRESS" name="COMPANY_ADDRESS">
                    </div>                          
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input name="COMPANY_PHONE" id="COMPANY_PHONE" autocomplete="off" type="text" class="form-control">
                    </div>                          
                </div>   
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Email </label>
                        <input name="COMPANY_EMAIL" id="COMPANY_EMAIL" autocomplete="off" type="text" class="form-control">
                    </div>                          
                </div>    
            </div>
            <br><br>
            <div class="row">
                <div class="col-lg-12" align="center">
                    <button type="submit" name="simpan" class="btn btn-primary"><i class="ico-save"></i> Save</button>&nbsp&nbsp&nbsp
                    <a href="m_company" type="button" class="btn btn-danger"><i class="ico-close2"></i> Cancel</a>
                </div>                    
            </div>
            <br><br>
        </form>
    </div>
</div>