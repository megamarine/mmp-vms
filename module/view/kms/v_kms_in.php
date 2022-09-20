<?php
include "module/controller/kms/t_kms.php";
?>
<script type="text/javascript">
    function getKODE_KARYAWAN(val) {
      $.ajax({
      type: "POST",
      url: "cek_data_karyawan.php",
      data:'RFID='+val,
      success: function(data){
        $("#DATAPEMINJAM").html(data);
      }
      });
    }
</script>
<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="fa fa-key fa-lg"></i><i class="fa fa-level-up fa-lg"></i> Key Management System - New Transaction</h4>
    </div>
    <div class="page-header-section">
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama"><i class="ico-home2"></i> Dashboard</a></li>
                <li><a href="kms"><i class="fa fa-key"></i> KMS</a></li>
                <li class="active"><i class="fas fa-plus"></i> New</li>
            </ol>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <form role="form" id="form" action="" method="post" data-parsley-validate>
            <div class="row">
                
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="KEY_ID" style="font-size: 15px;"><span class="text-danger">*</span> Key's Name : </label>
                        <select name="KEY_ID" id="KEY_ID" required class="form-control" data-parsley-required>
                            <option style="background: #74777a; color: #fff;" value="">Choose Key's Name</option>
                            <?php
                            $stmj = GetQuery("select * from m_key where status = '0' order by nama_ruangan asc ");
                            while ($rowz = $stmj->fetch(PDO::FETCH_ASSOC))
                            {
                                ?>
                                <option value="<?php echo $rowz["key_id"]; ?>"
                                    <?php 
                                        if($KEY_ID == $rowz["key_id"]) 
                                        { 
                                            echo "selected"; 
                                        } 
                                    ?>>
                                    <?php 
                                        echo $rowz["nama_ruangan"]; 
                                    ?>
                                </option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>                          
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="BORROWED_RFID" style="font-size: 15px;"><span class="text-danger">*</span>RFID Borrower : </label>
                        <input type="text" autocomplete="off" class="form-control" id="BORROWED_RFID" name="BORROWED_RFID" placeholder="Scan RFID here" oninput="getKODE_KARYAWAN(this.value);" onkeypress="return event.keyCode!=13" required="" data-parsley-required>
                    </div>                          
                </div>
                <div id="DATAPEMINJAM"></div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="BORROWED_REMARK" style="font-size: 15px;"> Remark : </label>
                        <input type="text" autocomplete="off" class="form-control" id="BORROWED_REMARK" name="BORROWED_REMARK">
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