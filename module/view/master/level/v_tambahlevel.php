<?php
include "module/controller/master/level/t_level.php";
?>
<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="fas fa-chart-line"></i> Add Level</h4>
    </div>
    <div class="page-header-section">
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama"><i class="ico-home2"></i> Dashboard</a></li>
                <li><a href="m_level"><i class="fas fa-chart-line"></i> Level</a></li>
                <li class="active"><i class="ico-plus2"></i> Add Level</li>
            </ol>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <form role="form" action="" method="post" data-parsley-validate>
            <div id="DATA_LEVEL"></div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="LEVEL_NAME">Level <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" required="" autocomplete="off" id="LEVEL_NAME" name="LEVEL_NAME" data-parsley-required>
                    </div>                          
                </div> 
            </div>
            <br><br>
            <div class="row">
                <div class="col-lg-12" align="center">
                    <button type="submit" name="simpan" class="btn btn-primary"><i class="ico-save"></i> Save</button>&nbsp&nbsp&nbsp
                    <a href="m_level" type="button" class="btn btn-danger"><i class="ico-close2"></i> Cancel</a>
                </div>                    
            </div>
            <br><br>
        </form>
    </div>
</div>