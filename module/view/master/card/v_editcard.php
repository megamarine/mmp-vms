<?php
include "module/controller/master/card/t_card.php";
?>
<script type="text/javascript">
function getMASTER_EMPLOYEES(val)
{
  $.ajax({
  type: "POST",
  url: "cek_m_card.php",
  data:'CARD_NUMBER='+val,
  success: function(data){
    $("#DATA_CARD").html(data);
  }
  });
}
</script>
<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="fas fa-id-card"></i> Edit Card</h4>
    </div>
    <div class="page-header-section">
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama"><i class="ico-home2"></i> Dashboard</a></li>
                <li><a href="m_card"><i class="fas fa-id-card"></i> Card</a></li>
                <li class="active"><i class="fas fa-edit"></i> Edit Card</li>
            </ol>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <form role="form" action="" method="post" data-parsley-validate>
            <div id="DATA_CARD"></div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="CARD_NUMBER">Card Number <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" required="" autocomplete="off" id="CARD_NUMBER" name="CARD_NUMBER" oninput="getMASTER_EMPLOYEES(this.value);" onkeypress="return event.keyCode!=13" value="<?php echo $CARD_NUMBER; ?>" data-parsley-required>
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
                    <a href="m_card" type="button" class="btn btn-danger"><i class="ico-close2"></i> Cancel</a>
                </div>                    
            </div>
            <br><br>
        </form>
    </div>
</div>