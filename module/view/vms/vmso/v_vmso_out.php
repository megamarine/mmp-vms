<?php include "module/controller/vms/t_vmso.php";?>
<script type="text/javascript">
    function getKODE_TAMU(val) {
      $.ajax({
      type: "POST",
      url: "cek_data.php",
      data:'KODE_TAMU='+val,
      success: function(data){
        $("#DATA").html(data);
      }
      });
    }
</script>
<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="fas fa-sign-out-alt"></i> Visitor Management System - Check Out</h4>
    </div>
    <div class="page-header-section">
        <!-- Toolbar -->
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama"><i class="ico-home2"></i> Dashboard</a></li>
                <li><a href="vmso"><i class="fas fa-expand-alt"></i> VMS - Outside Area</a></li>
                <li class="active"><i class="fas fa-sign-out-alt"></i> Check Out</li>
            </ol>
        </div>
        <!--/ Toolbar -->
    </div>
</div>
<div class="row">
    <!-- START Left Side -->
    <div class="col-md-12">
        <form role="form" id="form" action="" method="post" data-parsley-validate>
            <div class="row">
				<div class="col-md-2">
				</div>
                <div class="col-md-8">
					<label for="KODE_TAMU" style="font-size: 20px;">Scan QR Code Here <span class="text-danger">*</span></label>
					<div class="form-group">
						<input type="text" autocomplete="off" autofocus class="form-control" id="KODE_TAMU" name="KODE_TAMU" maxlength="15" required="" oninput="getKODE_TAMU(this.value);" onkeypress="return event.keyCode!=13" data-parsley-required>
					</div>
				</div>
				<div class="col-md-2">
            	</div>
            </div>
			<br>
			<div id="DATA"></div>
        </form>
    </div>
    <!--/ END Right Side -->
</div>
<script type="text/javascript">
    $('form').preventDoubleSubmission();
</script>