<?php
include "module/controller/master/visitortype/t_visitortype.php";
?>
<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="fas fa-user-tag"></i> Add Visitor Type</h4>
    </div>
    <div class="page-header-section">
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama"><i class="ico-home2"></i> Dashboard</a></li>
                <li><a href="m_visitortype"><i class="fas fa-user-tag"></i> Visitor Type</a></li>
                <li class="active"><i class="ico-plus2"></i> Add Visitor Type</li>
            </ol>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <form role="form" action="" method="post" data-parsley-validate>
            <div id="DATA_VISITORTYPE"></div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="VISITORTYPE_NAME">Visitor Type Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" required="" autocomplete="off" id="VISITORTYPE_NAME" name="VISITORTYPE_NAME"" data-parsley-required>
                    </div>                          
                </div>
            </div>
            <br><br>
            <div class="row">
                <div class="col-lg-12" align="center">
                    <button type="submit" name="simpan" class="btn btn-primary"><i class="ico-save"></i> Save</button>&nbsp&nbsp&nbsp
                    <a href="m_visitortype" type="button" class="btn btn-danger"><i class="ico-close2"></i> Cancel</a>
                </div>                    
            </div>
            <br><br>
        </form>
    </div>
</div>