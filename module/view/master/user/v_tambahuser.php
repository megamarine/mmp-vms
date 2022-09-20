<?php
include "module/controller/master/user/t_user.php";
?>

<style type="text/css">
th, td 
{
padding: 4px;
}
</style>

<script type="text/javascript">
function getUSER(val) {
  $.ajax({
  type: "POST",
  url: "cek_user.php",
  data:'KODE_USER='+val,
  success: function(data){
    $("#DATA_USER").html(data);
  }
  });
}

function getKODE_DIVISI(val) {
  $.ajax({
  type: "POST",
  url: "cek_divisi.php",
  data:'DEPARTEMENT='+val,
  success: function(data){
    $("#DIVISI").html(data);
  }
  });
}
</script>
<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="fas fa-user"></i> Add User</h4>
    </div>
    <div class="page-header-section">
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama"><i class="ico-home2"></i> Dashboard</a></li>
                <li><a href="m_user"><i class="fas fa-user"></i> Master User</a></li>
                <li class="active"><i class="ico-plus2"></i> Add User</li>
            </ol>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <form role="form" action="" method="post" data-parsley-validate>
            <div id="DATA_USER"></div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="USERNAME">Username <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" required="" id="USERNAME" name="USERNAME" oninput="getUSER(this.value);" onkeypress="return event.keyCode!=13" value="<?php echo $USERNAME; ?>" data-parsley-required autocomplete="off">
                    </div>                          
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="PASSWORD">Password <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="PASSWORD" name="PASSWORD" value="<?php echo $PASSWORD; ?>" data-parsley-required autocomplete="off">
                    </div>                          
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="NAMA">Employees Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="NAMA" name="NAMA" value="<?php echo $NAMA; ?>" data-parsley-required autocomplete="off">
                    </div>                          
                </div> 
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="DEPARTMENT">Department <span class="text-danger">*</span></label>
                        <select name="DEPARTEMENT" id="DEPARTEMENT" required="" class="form-control" onchange="getKODE_DIVISI(this.value);"  data-parsley-required>
                            <option value="">Choose Department</option>
                            <?php
                            $stmj = GetQuery("select * from m_department order by dept_name asc");
                            while ($rowz = $stmj->fetch(PDO::FETCH_ASSOC)) 
                            {
                                ?>
                                <option value="<?php echo $rowz["dept_id"]; ?>"
                                    <?php 
                                        if($DEPARTEMENT == $rowz["dept_id"]) 
                                        { 
                                            echo "selected"; 
                                        } 
                                    ?>>
                                    <?php 
                                        echo $rowz["dept_name"]; 
                                    ?>
                                </option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="DIVISI">Division <span class="text-danger">*</span></label>
                        <select name="DIVISI" id="DIVISI" required="" class="form-control" onchange="getKODE_SECTION(this.value);"  data-parsley-required>
                            <option value="">Choose Division</option>
                            <?php
                            $stmj = GetQuery("select * from m_divisi where kode_departement = '$DEPARTEMENT' order by nama_divisi asc");
                            while ($rowz = $stmj->fetch(PDO::FETCH_ASSOC)) 
                            {
                                ?>
                                <option value="<?php echo $rowz["kode_divisi"]; ?>"
                                    <?php 
                                        if($DIVISI == $rowz["kode_divisi"]) 
                                        { 
                                            echo "selected"; 
                                        } 
                                    ?>>
                                    <?php 
                                        echo $rowz["nama_divisi"]; 
                                    ?>
                                </option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="AKSES">Access <span class="text-danger">*</span></label>
                        <select name="AKSES" id="AKSES" required="" class="form-control" data-parsley-required>
                            <option value="">Choose Access</option>
                            <option value="administrator">Administrator</option>
                            <option value="security">Security</option>
                            <option value="adminhk">Admin HK</option>
                        </select>
                    </div>                          
                </div>                                 
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="EMAIL">Email <span class="text-danger">*</span></label>
                        <input name="EMAIL" id="EMAIL" type="text" required="" class="form-control" data-parsley-trigger="change" data-parsley-type="email" value="<?php echo $EMAIL; ?>" autocomplete="off">
                    </div>                          
                </div>
                <?php
                if (isset($_GET["KODE_USER"])) 
                { ?> 
                    <div class="col-md-4">
                        <div class="form-group">
                        <label for="STATUS">Status <span class="text-danger">*</span></label>
                        <select name="STATUS" id="STATUS" required="" class="form-control" data-parsley-required>
                            <option value="">Pilih Status</option>
                            <option value="1">Aktif</option>
                            <option value="0">Tidak Aktif</option>
                        </select>
                    </div>                          
                    </div>
                    <?php
                } ?>   
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="MODULE">Module User <span class="text-danger">*</span></label>
                        <table border="1" style="border:1px solid #bfc1c0;width:100%; height: 100%;padding: auto;">
                            <tr align="center" style="background-color:#86C3D0;font-weight: bold;margin-left: auto;">
                                <td style="width:60%">Module</td>
                                <td style="width:10%">Create</td>
                                <td style="width:10%">Read</td>
                                <td style="width:10%">Update</td>
                                <td style="width:10%">Delete</td>
                            </tr>
                            <tr>
                                <td align="center" colspan="5" style="background-color:#C9DEE6;font-size: 1.5rem;"><b>MASTER</b></td>
                            </tr>
                            <tr>
                                <td align="left">Master User</td>
                                <td align="center"><input type="checkbox" id="mod_muser_c" name="mod_muser_c"></td>
                                <td align="center"><input type="checkbox" id="mod_muser_r" name="mod_muser_r"></td>
                                <td align="center"><input type="checkbox" id="mod_muser_u" name="mod_muser_u"></td>
                                <td align="center"><input type="checkbox" id="mod_muser_d" name="mod_muser_d"></td>
                            </tr>
                            <tr>
                                <td align="left">Master Company</td>
                                <td align="center"><input type="checkbox" id="mod_mcomp_c" name="mod_mcomp_c"></td>
                                <td align="center"><input type="checkbox" id="mod_mcomp_r" name="mod_mcomp_r"></td>
                                <td align="center"><input type="checkbox" id="mod_mcomp_u" name="mod_mcomp_u"></td>
                                <td align="center"><input type="checkbox" id="mod_mcomp_d" name="mod_mcomp_d"></td>
                            </tr>
                            <tr>
                                <td align="left">Master Company Type</td>
                                <td align="center"><input type="checkbox" id="mod_mcomptype_c" name="mod_mcomptype_c"></td>
                                <td align="center"><input type="checkbox" id="mod_mcomptype_r" name="mod_mcomptype_r"></td>
                                <td align="center"><input type="checkbox" id="mod_mcomptype_u" name="mod_mcomptype_u"></td>
                                <td align="center"><input type="checkbox" id="mod_mcomptype_d" name="mod_mcomptype_d"></td>
                            </tr>
                            <tr>
                                <td align="left">Master Department</td>
                                <td align="center"><input type="checkbox" id="mod_mdept_c" name="mod_mdept_c"></td>
                                <td align="center"><input type="checkbox" id="mod_mdept_r" name="mod_mdept_r"></td>
                                <td align="center"><input type="checkbox" id="mod_mdept_u" name="mod_mdept_u"></td>
                                <td align="center"><input type="checkbox" id="mod_mdept_d" name="mod_mdept_d"></td>
                            </tr>
                            <tr>
                                <td align="left">Master Division</td>
                                <td align="center"><input type="checkbox" id="mod_mdiv_c" name="mod_mdiv_c"></td>
                                <td align="center"><input type="checkbox" id="mod_mdiv_r" name="mod_mdiv_r"></td>
                                <td align="center"><input type="checkbox" id="mod_mdiv_u" name="mod_mdiv_u"></td>
                                <td align="center"><input type="checkbox" id="mod_mdiv_d" name="mod_mdiv_d"></td>
                            </tr>
                            <tr>
                                <td align="left">Master Level</td>
                                <td align="center"><input type="checkbox" id="mod_mlevel_c" name="mod_mlevel_c"></td>
                                <td align="center"><input type="checkbox" id="mod_mlevel_r" name="mod_mlevel_r"></td>
                                <td align="center"><input type="checkbox" id="mod_mlevel_u" name="mod_mlevel_u"></td>
                                <td align="center"><input type="checkbox" id="mod_mlevel_d" name="mod_mlevel_d"></td>
                            </tr>
                            <tr>
                                <td align="left">Master Employees</td>
                                <td align="center"><input type="checkbox" id="mod_memploy_c" name="mod_memploy_c"></td>
                                <td align="center"><input type="checkbox" id="mod_memploy_r" name="mod_memploy_r"></td>
                                <td align="center"><input type="checkbox" id="mod_memploy_u" name="mod_memploy_u"></td>
                                <td align="center"><input type="checkbox" id="mod_memploy_d" name="mod_memploy_d"></td>
                            </tr>
                            <tr>
                                <td align="left">Master Card</td>
                                <td align="center"><input type="checkbox" id="mod_mcard_c" name="mod_mcard_c"></td>
                                <td align="center"><input type="checkbox" id="mod_mcard_r" name="mod_mcard_r"></td>
                                <td align="center"><input type="checkbox" id="mod_mcard_u" name="mod_mcard_u"></td>
                                <td align="center"><input type="checkbox" id="mod_mcard_d" name="mod_mcard_d"></td>
                            </tr>
                            <tr>
                                <td align="left">Master Key</td>
                                <td align="center"><input type="checkbox" id="mod_mkey_c" name="mod_mkey_c"></td>
                                <td align="center"><input type="checkbox" id="mod_mkey_r" name="mod_mkey_r"></td>
                                <td align="center"><input type="checkbox" id="mod_mkey_u" name="mod_mkey_u"></td>
                                <td align="center"><input type="checkbox" id="mod_mkey_d" name="mod_mkey_d"></td>
                            </tr>
                            <tr>
                                <td align="left">Master Unit Measurement</td>
                                <td align="center"><input type="checkbox" id="mod_mum_c" name="mod_mum_c"></td>
                                <td align="center"><input type="checkbox" id="mod_mum_r" name="mod_mum_r"></td>
                                <td align="center"><input type="checkbox" id="mod_mum_u" name="mod_mum_u"></td>
                                <td align="center"><input type="checkbox" id="mod_mum_d" name="mod_mum_d"></td>
                            </tr>
                            <tr>
                                <td align="left">Master Vehicle</td>
                                <td align="center"><input type="checkbox" id="mod_mvehicle_c" name="mod_mvehicle_c"></td>
                                <td align="center"><input type="checkbox" id="mod_mvehicle_r" name="mod_mvehicle_r"></td>
                                <td align="center"><input type="checkbox" id="mod_mvehicle_u" name="mod_mvehicle_u"></td>
                                <td align="center"><input type="checkbox" id="mod_mvehicle_d" name="mod_mvehicle_d"></td>
                            </tr>
                            <tr>
                                <td align="left">Master Visitor Type</td>
                                <td align="center"><input type="checkbox" id="mod_mvistype_c" name="mod_mvistype_c"></td>
                                <td align="center"><input type="checkbox" id="mod_mvistype_r" name="mod_mvistype_r"></td>
                                <td align="center"><input type="checkbox" id="mod_mvistype_u" name="mod_mvistype_u"></td>
                                <td align="center"><input type="checkbox" id="mod_mvistype_d" name="mod_mvistype_d"></td>
                            </tr>
                            <tr>
                                <td align="left">Master Purpose</td>
                                <td align="center"><input type="checkbox" id="mod_mpurp_c" name="mod_mpurp_c"></td>
                                <td align="center"><input type="checkbox" id="mod_mpurp_r" name="mod_mpurp_r"></td>
                                <td align="center"><input type="checkbox" id="mod_mpurp_u" name="mod_mpurp_u"></td>
                                <td align="center"><input type="checkbox" id="mod_mpurp_d" name="mod_mpurp_d"></td>
                            </tr>
                            <tr>
                                <td align="center" colspan="5" style="background-color:#C9DEE6;font-size: 1.5rem;"><b>TRANSACTION</b></td>
                            </tr>
                            <tr>
                                <td align="left">Visitor Management</td>
                                <td align="center"><input type="checkbox" id="mod_visitormg_c" name="mod_visitormg_c"></td>
                                <td align="center"><input type="checkbox" id="mod_visitormg_r" name="mod_visitormg_r"></td>
                                <td align="center"><input type="checkbox" id="mod_visitormg_u" name="mod_visitormg_u"></td>
                                <td align="center"><input type="checkbox" id="mod_visitormg_d" name="mod_visitormg_d"></td>
                            </tr>
                            <tr>
                                <td align="left">Package Management</td>
                                <td align="center"><input type="checkbox" id="mod_packagemg_c" name="mod_packagemg_c"></td>
                                <td align="center"><input type="checkbox" id="mod_packagemg_r" name="mod_packagemg_r"></td>
                                <td align="center"><input type="checkbox" id="mod_packagemg_u" name="mod_packagemg_u"></td>
                                <td align="center"><input type="checkbox" id="mod_packagemg_d" name="mod_packagemg_d"></td>
                            </tr>
                            <tr>
                                <td align="left">Key Management</td>
                                <td align="center"><input type="checkbox" id="mod_keymg_c" name="mod_keymg_c"></td>
                                <td align="center"><input type="checkbox" id="mod_keymg_r" name="mod_keymg_r"></td>
                                <td align="center"><input type="checkbox" id="mod_keymg_u" name="mod_keymg_u"></td>
                                <td align="center"><input type="checkbox" id="mod_keymg_d" name="mod_keymg_d"></td>
                            </tr>
                            <tr>
                                <td align="center" colspan="5" style="background-color:#C9DEE6;font-size: 1.5rem;"><b>REPORT</b></td>
                            </tr>
                            <tr>
                                <td align="left">Report Visitor Management</td>
                                <td align="center" colspan="4"><input type="checkbox" id="mod_laporanvms" name="mod_laporanvms"></td>
                            </tr>
                            <tr>
                                <td align="left">Report Package Management</td>
                                <td align="center" colspan="4"><input type="checkbox" id="mod_laporanpmg" name="mod_laporanpmg"></td>
                            </tr>
                            <tr>
                                <td align="left">Report Key Management</td>
                                <td align="center" colspan="4"><input type="checkbox" id="mod_laporankmg" name="mod_laporankmg"></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12" align="center">
                    <button type="submit" name="simpan" class="btn btn-primary"><i class="ico-save"></i> Save</button>&nbsp&nbsp&nbsp
                    <a href="m_user" type="button" class="btn btn-danger"><i class="ico-close2"></i> Cancel</a>
                </div>                    
            </div>
            <br><br>
        </form>
    </div>
</div>