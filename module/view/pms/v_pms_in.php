<?php
include "module/controller/pms/t_pms.php";
?>
<!-- <script type="text/javascript">
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
</script> -->
<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="fa fa-cube fa-lg"></i> Package Management System - New Transaction</h4>
    </div>
    <div class="page-header-section">
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama"><i class="ico-home2"></i> Dashboard</a></li>
                <li><a href="pms"><i class="fa fa-cube"></i> PMS</a></li>
                <li class="active"><i class="fas fa-plus"></i> New</li>
            </ol>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <form role="form" id="form" action="" method="post" data-parsley-validate>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="JENIS_PAKET" style="font-size: 15px;"><span class="text-danger">*</span> Package Type</label>
                        <select name="JENIS_PAKET" id="JENIS_PAKET" required class="form-control" data-parsley-required>
                            <option style="background: #74777a; color: #fff;" value="">Choose Package Type</option>
                            <option value="Dokumen">Dokumen</option>
                            <option value="Barang">Barang</option>
                        </select>
                    </div>                          
                </div> 
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="PENGIRIM" style="font-size: 15px;"><span style="color: red"> *</span> Package From</label>
                        <input type="text" required autocomplete="off" class="form-control" id="PENGIRIM" name="PENGIRIM">
                    </div>                          
                </div>
                <div class="col-md-4">
                    <div class="input-group">
                        <label for="KEPADA" style="font-size: 15px;"><span style="color: red">* </span>Package For</label>
                        <input type="text" class="form-control" readonly="" autocomplete="off" id="KEPADA" name="KEPADA" required="" data-parsley-required>
                        <span class="input-group-btn" style="vertical-align: bottom;">
                          <!-- Trigger button -->
                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalKEPADA">
                            <i class="fa fa-search"></i>
                          </button>
                        </span>
                        <div id="modalKEPADA" class="modal fade" role="dialog">
                          <div class="modal-dialog modal-lg">
                              <div class="modal-content">
                                  <form role="form" id="form-tambah" method="post" action="input.php">
                                  <div class="modal-header" style="background-color: #3B678F;color:white">
                                      <center>
                                      <h3 class="modal-title">Choose PIC (Person In Charge)</h3>
                                      </center>
                                  </div>
                                      <div class="modal-body">
                                          <table width="100%" class="table table-hover" id="tableKEPADA">
                                              <thead>
                                                  <tr>
                                                      <th>Name</th>
                                                      <th>Department</th>
                                                      <th>Division</th>
                                                  </tr>
                                              </thead>
                                              <tbody>
                                              <?php
                                              $stmj = GetQuery("select  a.*,
                                                                        b.dept_name,
                                                                        c.div_name
                                                                    from m_employees a
                                                                    LEFT JOIN m_department b ON a.dept_id = b.dept_id
                                                                    LEFT JOIN m_division c ON a.div_id = c.div_id
                                                                    order by a.employees_name asc");

                                              while ($rowz = $stmj->fetch(PDO::FETCH_ASSOC))
                                              {
                                              ?>
                                                  <tr id="KEPADA" data-namaKEPADA="<?= $rowz["employees_name"]; ?>">
                                                      <td><?= $rowz["employees_name"]; ?></td>
                                                      <td><?= $rowz["dept_name"]; ?></td>
                                                      <td><?= $rowz["div_name"]; ?></td>
                                                  </tr>        
                                              <?php
                                              }
                                              ?>  
                                              </tbody>
                                          </table>
                                      </div> 
                                     
                                      <div class="modal-footer">
                                          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                                      </div>
                              </div>
                          </div>
                      </div>
                        <!-- End of Modal -->
                        
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

