<?php
include "module/controller/kms/t_kms.php";

$kms_id = $_GET["TRANS_ID"];
$stmt = GetQuery("select a.kms_id,
                         b.nama_ruangan
                    from t_kms a
                    join m_key b ON a.key_id = b.key_id
                   where a.kms_id ='$kms_id'");
while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
    $key_transss = $row["kms_id"];
    $namu        = $row["nama_ruangan"];
}

?>
<script type="text/javascript">
    function getKODE_KARYAWAN(val) {
      $.ajax({
      type: "POST",
      url: "cek_data_karyawan.php",
      data:'RFID='+val,
      success: function(data){
        $("#DATAKEMBALI").html(data);
      }
      });
    }
</script>
<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="fa fa-key fa-lg"></i><i class="fa fa-level-down fa-lg"></i> Key Management System - Process</h4>
    </div>
    <div class="page-header-section">
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama"><i class="ico-home2"></i> Dashboard</a></li>
                <li><a href="kms"><i class="fa fa-key"></i> KMS</a></li>
                <li class="active"><i class="fa fa-check"></i> Process</li>
            </ol>
        </div>
    </div>
</div>
<h5>Room's Name : <strong><?= $namu; ?></strong> </h5><br><br>
<div class="row">
    <div class="col-md-12">
        <form role="form" id="form" action="" method="post" data-parsley-validate>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="RETURN_RFID" style="font-size: 15px;"><span class="text-danger">*</span> RFID Return : </label>
                        <input type="text" autocomplete="off" class="form-control" id="RETURN_RFID" name="RETURN_RFID" placeholder="Scan RFID here" oninput="getKODE_KARYAWAN(this.value);" onkeypress="return event.keyCode!=13" required="" data-parsley-required>
                    </div>                          
                </div>
                <div id="DATAKEMBALI"></div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="RETURN_REMARK" style="font-size: 15px;"> Remark : </label>
                        <input type="text" autocomplete="off" class="form-control" id="RETURN_REMARK" name="RETURN_REMARK">
                    </div>                          
                </div>
            </div>
            <br><br>
            <div class="row">
                <div class="col-lg-12" align="center">
                    <button type="submit" name="simpan" class="btn btn-primary"><i class="ico-save"></i> Save</button>
                    <a href="kms" class="btn btn-danger"><i class="fas fa-times"></i> Cancel</a>
                </div>                    
            </div>
            <br><br>
        </form>
    </div>
</div>
<script type="text/javascript">
    $(function(){
        // Find any date inputs and override their functionality
        $('#datepicker').datepicker({
            dateFormat: 'yy-mm-dd'
        });
    });
</script>
<script type="text/javascript" src="../plugins/clockpicker/bootstrap-clockpicker.min.js"></script>
<script type="text/javascript">
    $('.clockpicker').clockpicker();
</script>
<script type="text/javascript">
    $('form').preventDoubleSubmission();
</script>