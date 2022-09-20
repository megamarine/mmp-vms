<?php
include "module/controller/vms/t_vmso_pre.php";
$statbut =0;
?>
<style>
hr { 
  display: block;
  margin-top: 0.5em;
  margin-bottom: 0.5em;
  margin-left: auto;
  margin-right: auto;
  border-style: inset;
  border-width: 1px;
  color:black;
  background-color:black; 
}

.form-check{
  display: block;
  position: relative;
  padding-left: 35px;
  margin-bottom: 12px;
  cursor: pointer;
  font-size: 17px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
} 

.form-check input{
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

.checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 25px;
  width: 25px;
  border-style: solid;
  border-width: 1px;
  background-color: #eee;
}

.form-check:hover input ~ .checkmark {
  background-color: #3B678F;
}

.form-check input:checked ~ .checkmark {
  background-color: #3B678F;
}

.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

.form-check input:checked ~ .checkmark:after {
  display: block;
}

.form-check .checkmark:after {
  left: 8px;
  top: 2px;
  width: 8px;
  height: 13px;
  border: solid white;
  border-width: 0 3px 3px 0;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  transform: rotate(45deg);
}
</style>
<script type="text/javascript">
    
    //delete temp setiap kali halaman diload
    function loadFunction() 
    {
        <?php
        //hapus data di database
        $UNIQCODE = $_SESSION["UNIQCODE_VISITOR"];
        GetQuery("delete from temp_vms_pic where name='$UNIQCODE'");
        GetQuery("delete from temp_vms_doc where name='$UNIQCODE'");

        //hapus file di dalam direktori temp_vms_pic
        $folder = 'temp_vms_pic/';
        $file = $UNIQCODE.".jpg";
        $filename = $folder.$file;
        unlink($filename);

        //hapus file di dalam direktori temp_vms_doc
        $folder2 = 'temp_vms_doc/';
        $file2 = $UNIQCODE.".jpg";
        $filename2 = $folder2.$file2;
        unlink($filename2);
        ?>
    }
</script>
<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="fas fa-list-ol"></i> Visitor Management System - Pre Register</h4>
    </div>
    <div class="page-header-section">
        <!-- Toolbar -->
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama"><i class="ico-home2"></i> Dashboard</a></li>
                <li><a href="vmso"><i class="fas fa-expand-alt"></i> VMS - Outside Area</a></li>
                <li class="active"><i class="fas fa-list-ol"></i> Pre Register</li>
            </ol>
        </div>
        <!--/ Toolbar -->
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <form role="form" action="" method="post" data-parsley-validate>
            <div class="col-md-12 center">
              
            <div class="alert alert-info" role="alert">*Please input the form below step by step.</div>
                <ul class="nav nav-pills nav-justified">
                    <li class="active"><a href="#tab1" data-toggle="tab"><strong>1. Visitor Data </strong><i class="fas fa-user-friends fa-lg"></i></a></li>
                    <!-- <li><a href="#tab2" data-toggle="tab"><strong>2. Vehicle Data </strong><i class="fas fa-car fa-lg"></i></a></li>
                    <li><a href="#tab3" data-toggle="tab"><strong>3. Document Data </strong><i class="fas fa-file-medical-alt fa-lg"></i></a></li> -->
                </ul>
                <div class="tab-content panel">
<!-- DATA VISITOR -->
                    <div class="tab-pane active" id="tab1">
                        <div class="panel panel-default" style="border-width: 0px;">

                            <!-- ASAL VISITOR LUAR / DALAM NEGERI -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="VISITOR_ASAL" style="font-size: 15px;">Visitor Origin<span style="color: red"> *</span></label>
                                        <select name="VISITOR_ASAL" id="VISITOR_ASAL" required class="form-control" data-parsley-required>
                                            <option style="background: #74777a; color: #fff;" value="">Choose Visitor Origin</option>
                                                <option value="dalam negeri">Dalam Negeri</option>
                                                <option value="luar negeri">Luar Negeri</option>
                                        </select>
                                    </div>                           
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="VISITOR_TYPE" style="font-size: 15px;">Visitor Type<span style="color: red"> *</span></label>
                                        <select name="VISITOR_TYPE" id="VISITOR_TYPE" required class="form-control" data-parsley-required>
                                            <option style="background: #74777a; color: #fff;" value="">Choose Visitor Type</option>
                                            <?php
                                            $stmj = GetQuery("select * from m_visitortype where status = '1' order by visitortype_name asc");
                                            while ($rowz = $stmj->fetch(PDO::FETCH_ASSOC))
                                            {
                                                ?>
                                                <option value="<?php echo $rowz["visitortype_id"]; ?>"
                                                    <?php 
                                                        if($VISITOR_TYPE == $rowz["visitortype_name"]) 
                                                        { 
                                                            echo "selected"; 
                                                        } 
                                                    ?>>
                                                    <?php 
                                                        echo $rowz["visitortype_name"]; 
                                                    ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>                           
                                </div>
                            </div>

                            <!-- PRE & FINAL APPROVAL -->
                            <!-- <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group" data-toggle="tooltip" data-placement="bottom" title="Untuk Visitor yang diundang">
                                        <label for="PRE_APPROVAL_NO" style="font-size: 15px;" >Pre Approval Number (HSE H-1)<span class="text-danger">*</span></label>
                                        <input type="text" style="height: 100%;font-size: 100%;" class="form-control" autocomplete="off" required="" id="PRE_APPROVAL_NO" name="PRE_APPROVAL_NO" value="<?php echo $PRE_APPROVAL_NO; ?>" data-parsley-required>
                                    </div>                           
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group" data-toggle="tooltip" data-placement="bottom" title="Untuk Visitor yang diundang">
                                        <label for="FINAL_APPROVAL_NO" style="font-size: 15px;" >Final Approval Number (HSE Hari H)<span class="text-danger">*</span></label>
                                        <input type="text" style="height: 100%;font-size: 100%;" class="form-control" autocomplete="off" required="" id="FINAL_APPROVAL_NO" name="FINAL_APPROVAL_NO" value="<?php echo $FINAL_APPROVAL_NO; ?>" data-parsley-required>
                                    </div>                           
                                </div>
                            </div> -->

                            <!-- TUJUAN dan PIC -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="PURPOSE" style="font-size: 15px;">Purpose<span style="color: red"> *</span></label>
                                        <select name="PURPOSE" id="PURPOSE" required="" class="form-control" data-parsley-required>
                                            <option style="background: #74777a; color: #fff;" value="">Choose Purpose</option>
                                            <?php
                                            $stmj = GetQuery("
                                                    select * from m_purpose where status = '1' order by purpose_desc asc");
                                            while ($rowz = $stmj->fetch(PDO::FETCH_ASSOC))
                                            {
                                                ?>
                                                <option value="<?php echo $rowz["purpose_id"]; ?>"
                                                    <?php 
                                                        if($PURPOSE == $rowz["purpose_desc"]) 
                                                        { 
                                                            echo "selected"; 
                                                        } 
                                                    ?>>
                                                    <?php 
                                                        echo $rowz["purpose_desc"]; 
                                                    ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>                         
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <label for="PIC" style="font-size: 15px;">Meet With<span style="color: red"> *</span></label>
                                        <input type="text" class="form-control" readonly="" autocomplete="off" id="namaPIC" name="PIC" required="" data-parsley-required>
                                        <span class="input-group-btn" style="vertical-align: bottom;">
                                          <!-- Trigger button -->
                                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalPIC">
                                            <i class="fa fa-search"></i>
                                          </button>
                                        </span>
                                        <div id="modalPIC" class="modal fade" role="dialog">
                                          <div class="modal-dialog modal-lg">
                                              <div class="modal-content">
                                                  <form role="form" id="form-tambah" method="post" action="input.php">
                                                  <div class="modal-header" style="background-color: #3B678F;color:white">
                                                      <center>
                                                      <h3 class="modal-title">Choose (Person In Charge)</h3>
                                                      </center>
                                                  </div>
                                                  <div class="modal-body">
                                                      <table width="100%" class="table table-hover" id="tablePIC">
                                                          <thead>
                                                              <tr>
                                                                  <th>Name</th>
                                                                  <th>Department</th>
                                                                  <th>Division</th>
                                                              </tr>
                                                          </thead>
                                                          <tbody>
                                                          <?php
                                                          $stmj = GetQuery("
                                                                  select a.*,
                                                                         b.level_name,
                                                                         c.dept_name,
                                                                         d.div_name
                                                                    from m_employees a
                                                                    LEFT JOIN m_level b ON a.level_id = b.level_id
                                                                    LEFT JOIN m_department c ON a.dept_id = c.dept_id
                                                                    LEFT JOIN m_division d ON a.div_id = d.div_id
                                                                    order by a.employees_name asc");

                                                          while ($rowz = $stmj->fetch(PDO::FETCH_ASSOC))
                                                          {
                                                          ?>
                                                              <tr id="PIC" data-namaPIC="<?php echo $rowz["employees_name"]; ?>" data-alamat="<?php echo $rowz["card_id"]; ?>" >
                                                                  <td><?php echo $rowz["employees_name"]; ?></td>
                                                                  <td><?php echo $rowz["dept_name"]; ?></td>
                                                                  <td><?php echo $rowz["div_name"]; ?></td>
                                                              </tr>        
                                                          <?php
                                                          }
                                                          ?>  
                                                          </tbody>
                                                      </table>
                                                  </div>                                                     
                                                  <div class="modal-footer">
                                                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                        <!-- End of Modal -->
                                    </div>                           
                                </div>
                            </div>

                            <hr>

                            <!-- KARTU IDENTITAS / KITAS -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="KITAS_TYPE" style="font-size: 15px;">ID Card Type <span class="text-danger">*</span></label>
                                        <select name="KITAS_TYPE" id="KITAS_TYPE" style="height: 100%;font-size: 100%;" class="form-control" required="" data-parsley-required>
                                            <option style="background: #74777a; color: #fff;" value="">Choose ID Type</option>
                                            <option value="KTP">KTP</option>
                                            <option value="Kartu Pelajar">Kartu Pelajar</option>
                                            <option value="SIM">SIM</option>
                                        </select>
                                    </div>                           
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="KITAS_NO" style="font-size: 15px;">ID Card Number <span class="text-danger">*</span></label>
                                        <input type="text" style="height: 100%;font-size: 100%;" class="form-control" autocomplete="off" required="" id="KITAS_NO" name="KITAS_NO" value="<?php echo $KITAS_NO; ?>" data-parsley-required>
                                    </div>                           
                                </div>
                            </div>

                            <!-- NAMA & TELP -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="VISITOR_NAME" style="font-size: 15px;">Visitor Name <span class="text-danger">*</span></label>
                                        <input type="text" style="height: 100%;font-size: 100%;" class="form-control" autocomplete="off" required="" id="VISITOR_NAME" name="VISITOR_NAME" value="<?php echo $VISITOR_NAME; ?>" data-parsley-required>
                                    </div>                           
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="VISITOR_PHONE" style="font-size: 15px;">Phone Number <span class="text-danger">*</span></label>
                                        <input type="text" style="height: 100%;font-size: 100%;" class="form-control" autocomplete="off" required="" id="VISITOR_PHONE" name="VISITOR_PHONE" value="<?php echo $VISITOR_PHONE; ?>" data-parsley-required>
                                    </div>                           
                                </div>
                            </div>  

                            <!-- PERUSAHAAN -->
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <label for="COMPANY" style="font-size: 15px;">Company Origin<span style="color: red"> *</span></label><br>
                                        <input type="text" readonly="" class="form-control" autocomplete="off" id="id_company" name="COMPANY" required="" data-parsley-required>
                                        <span class="input-group-btn" style="vertical-align: bottom;">
                                          <!-- Trigger button -->
                                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal">
                                            <i class="fa fa-search"></i>
                                          </button>
                                        </span>
                                        <div id="modal" class="modal fade" role="dialog">
                                          <div class="modal-dialog modal-lg">
                                              <div class="modal-content">
                                                  <form role="form" id="form-tambah" method="post" action="input.php">
                                                  <div class="modal-header" style="background-color: #3B678F;color:white">
                                                      <center>
                                                      <h3 class="modal-title">Choose Company Origin</h3>
                                                      </center>
                                                  </div>
                                                      <div class="modal-body">
                                                          <table width="100%" class="table table-hover" id="tablePerusahaan">
                                                              <thead>
                                                                  <tr>
                                                                      <th>#</th>
                                                                      <th>Company Name</th>
                                                                      <th>Address</th>
                                                                      <th>Phone Number</th>
                                                                  </tr>
                                                              </thead>
                                                              <tbody>
                                                                <?php 
                                                                  $stmj = GetQuery("select * from m_company");
                                                                  while ($rowz = $stmj->fetch(PDO::FETCH_ASSOC))
                                                                  {
                                                                    ?>
                                                                    <tr id="perusahaan" data-id="<?php echo $rowz["company_id"]; ?>" data-nama="<?php echo $rowz["company_name"]; ?>" data-alamat="<?php echo $rowz["company_address"]; ?>" >
                                                                        <td><?php echo $rowz["company_id"]; ?></td>
                                                                        <td><?php echo $rowz["company_name"]; ?></td>
                                                                        <td><?php echo $rowz["company_address"]; ?></td>
                                                                        <td><?php echo $rowz["company_phone"]; ?></td>
                                                                    </tr>
                                                                    <?php 
                                                                  } 

                                                                  ?>
                                                              </tbody>
                                                          </table>
                                                      </div> 
                                                     
                                                      <div class="modal-footer">
                                                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                      </div>
                                              </div>
                                          </div>
                                      </div>
                                        <!-- End of Modal -->
                                    </div>                         
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <label for="COMPANY_NAME" style="font-size: 15px;">Company Name</label><br>
                                        <input type="text" readonly="" class="form-control" autocomplete="off" id="nama" name="COMPANY_NAME">
                                    </div>                         
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <label for="COMPANY_ADDR" style="font-size: 15px;">Company Address</label><br>
                                        <input type="text" readonly="" class="form-control" autocomplete="off" id="alamat" name="COMPANY_ADDR">
                                    </div>                         
                                </div>
                            </div><br>

                            
                        </div>
                    <!-- <span class="text-danger">*Must be filled</span> -->
                    </div>

<!-- DATA KENDARAAN -->

<!-- KELENGKAPAN DOKUMEN -->
                    <!-- <div class="alert alert-danger" role="alert">*The SAVE button will be activated after you successfully scanning the RFID Card.</div> -->
                </div>
                <!-- SAVE BUTTON -->
                <div class="row">
                    <div class="col-lg-12" align="center">
                        <button  type="submit" name="simpan" id="simpan" class="btn btn-primary"><i class="ico-save"></i> Save</button>&nbsp&nbsp&nbsp
                        <a href="batal_checkin" type="button" style="height: 100%;font-size: 100%;" class="btn btn-danger"><i class="ico-close2"></i> Cancel</a>
                    </div>                    
                </div>
            </div>  
        </form>
    </div>
</div>

<script>
//DISABLE DATA KENDARAAN WHEN 'PICKED BY COMPANY' IS CHECKED
document.getElementById('PICKED').onchange = function() 
{
  document.getElementById('CAR_NO').disabled           = this.checked;
  document.getElementById('CAR_QTY').disabled          = this.checked;
  document.getElementById('CAR_QTY_UM').disabled       = this.checked;
  document.getElementById('DRIVER_PENGGANTI').disabled = this.checked;
  document.getElementById('search-kend').disabled      = this.checked;
  document.getElementById('CAR_BRAND').disabled        = this.checked;
  document.getElementById('SIM_TYPE').disabled         = this.checked;
  document.getElementById('SIM_NO').disabled           = this.checked;
  document.getElementById('datepicker2').disabled      = this.checked;
};

//FUNCTION DISABLE BUTTON SIMPAN
$(document).ready(function()
{
    // $("#simpan"). attr("disabled", true);
});

//VALIDASI KARTU RFID
function getRFID(val) 
{
    $.ajax
    ({
        type : "POST",
        url  : "cek_validrfid.php",
        data : 'NOMOR_RFID='+val,
        success: function(data)
        {
        if(data=='ok')
        {
            $("#DATA").html('<script language="javascript"> alert("RFID Valid!")');
            $("#simpan"). attr("disabled", false);
        }
        else
        {
            $("#simpan"). attr("disabled", true);
        }
        }
    });
}

function disableBut()
{
    $("#simpan"). attr("disabled", true);
}

//FUNCTION UNTUK AMBIL FOTO VISITOR
var myWindow;
function openWin() 
{
  myWindow = window.open("ambil_foto", "_blank", "left=20,top=20,width=740,height=560,toolbar=1,resizable=0");
}

//FUNCTION UNTUK AMBIL FOTO DOCUMENT
var myWindow2;
function openWin2() 
{
  myWindow2 = window.open("ambil_foto_doc", "_blank", "left=20,top=20,width=740,height=560,toolbar=1,resizable=0");
}
</script>

<script type="text/javascript">
//OPTION FOR PIC
$(document).ready(function(){
    $('#tablePIC').DataTable();
   
    $(document).on('click', '#PIC', function (e) {
        document.getElementById("namaPIC").value = $(this).attr('data-namaPIC');
        $('#modalPIC').modal('hide');
    });
   
});

//OPTION FOR PERUSAHAAN
$(document).ready(function()
{
    $('#tablePerusahaan').DataTable();
   
    $(document).on('click', '#perusahaan', function (e) 
    {
      // alert('test');
        document.getElementById("id_company").value = $(this).attr('data-id');
        document.getElementById("nama").value = $(this).attr('data-nama');
        document.getElementById("alamat").value = $(this).attr('data-alamat');
        $('#modal').modal('hide');
    });
   
});

//OPTION FOR KENDARAAN
$(document).ready(function(){
    $('#tableKendaraan').DataTable();
   
    $(document).on('click', '#kendaraan', function (e) {
        document.getElementById("car_type").value = $(this).attr('data-id-kend');
        document.getElementById("CAR_NAME").value = $(this).attr('data-nama-kend');
        // document.getElementById("CAR_SIZE").value = $(this).attr('data-size-kend');
        $('#modalKendaraan').modal('hide');
    });
   
});

$(function(){
        // Find any date inputs and override their functionality
        $('#datepicker1').datepicker({
            dateFormat: 'yy-mm-dd'
        });
    });

$(function(){
        // Find any date inputs and override their functionality
        $('#datepicker2').datepicker({
            dateFormat: 'yy-mm-dd'
        });
    });
</script>
