<?php
include "module/controller/pms/t_pms.php";
?>
<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="fa fa-cube fa-lg"></i> Package Management System - Process</h4>
    </div>
    <div class="page-header-section">
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama"><i class="ico-home2"></i> Dashboard</a></li>
                <li><a href="pms"><i class="fa fa-cube"></i> PMS</a></li>
                <li class="active"><i class="fas fa-check"></i> Process</li>
            </ol>
        </div>
    </div>
</div>
<h5>Package For : <strong><?= $KEPADA; ?></strong> </h5><br><br>
<div class="row">
    <div class="col-md-12">
        <form role="form" id="form" action="" method="post" data-parsley-validate>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="PENERIMA" style="font-size: 15px;"><span style="color: red"> *</span> Received By : </label>
                        <input type="text" required autocomplete="off" class="form-control" id="PENERIMA" name="PENERIMA">
                    </div>                          
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="PENGANTAR" style="font-size: 15px;"><span style="color: red"> *</span> Delivered By : </label>
                        <input type="text" required autocomplete="off" class="form-control" id="PENGANTAR" name="PENGANTAR">
                    </div>                          
                </div>               
            </div>
            <br><br>
            <div class="row">
                <div class="col-lg-12" align="center">
                    <button type="submit" name="simpan" class="btn btn-primary"><i class="ico-save"></i> Save</button>
                    <a href="pms" class="btn btn-danger"><i class="fas fa-times"></i> Cancel</a>
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

    //OPTION FOR PIC
    $(document).ready(function(){
        $('#tableKEPADA').DataTable();
       
        $(document).on('click', '#KEPADA', function (e) {
            document.getElementById("KEPADA").value = $(this).attr('data-namaKEPADA');
            $('#modalKEPADA').modal('hide');
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

