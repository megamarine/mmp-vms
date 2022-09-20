<?php include "module/controller/vms/t_vmsp.php";?>
<script type="text/javascript">
function getKODE_TAMU(val) {
    $.ajax({
    type: "POST",
    url: "cek_data_hk.php",
    data:'CARD_NO='+val,
    success: function(data){
    $("#DATA").html(data);
    }
    });
}
</script>
<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="fas fa-sign-in-alt"></i> Visitor Management System - Check In</h4>
    </div>
    <div class="page-header-section">
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama"><i class="ico-home2"></i> Dashboard</a></li>
                <li><a href="vmsp"><i class="fas fa-expand"></i> VMS - Production Area</a></li>
                <li class="active"><i class="fas fa-sign-in-alt"></i> Check In</li>
            </ol>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <form role="form" id="form" action="" method="post" data-parsley-validate>
            <div class="row">
				<div class="col-md-2">
				</div>
                <div class="col-md-8">
					<label for="CARD_NO" style="font-size: 20px;">Scan RFID Card from outside : <span class="text-danger">*</span></label>
					<div class="form-group">
						<input type="text" autocomplete="off" autofocus class="form-control" id="CARD_NO" name="CARD_NO" maxlength="15" required="" oninput="getKODE_TAMU(this.value);" onkeypress="return event.keyCode!=13" data-parsley-required>
					</div>
				</div>
				<div class="col-md-2">
            	</div>
            </div>
			<div id="DATA"></div>
        </form>
    </div>
</div>
<script type="text/javascript">
$('form').preventDoubleSubmission();
</script>