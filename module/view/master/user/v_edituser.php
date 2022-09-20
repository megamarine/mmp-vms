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
function getKODE_DIVISI(val)
{
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
        <h4 class="title semibold"><i class="fas fa-edit"></i> Edit User</h4>
    </div>
    <div class="page-header-section">
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama"><i class="ico-home2"></i> Dashboard</a></li>
                <li><a href="m_user"><i class="fas fa-user"></i> Master User</a></li>
                <li class="active"><i class="fas fa-edit"></i> Edit User</li>
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
                        <label for="AKSES">Department <span class="text-danger">*</span></label>
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
                            $stmj = GetQuery("select * from m_division where dept_id = '$DEPARTEMENT' order by div_name asc");
                            while ($rowz = $stmj->fetch(PDO::FETCH_ASSOC)) 
                            {
                                ?>
                                <option value="<?php echo $rowz["div_id"]; ?>"
                                    <?php 
                                        if($DIVISI == $rowz["div_id"]) 
                                        { 
                                            echo "selected"; 
                                        } 
                                    ?>>
                                    <?php 
                                        echo $rowz["div_name"]; 
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
                            <option style="background: #74777a; color: #fff;">-- Pilih Akses --</option>
                            <option value="administrator" <?php if($AKSES == "administrator"){ echo "selected";} ?> >Administrator</option>
                            <option value="security" <?php if($AKSES == "security"){ echo "selected";} ?> >Security</option>
                            <option value="adminhk" <?php if($AKSES == "adminhk"){ echo "selected";} ?> >Admin HK</option>
                        </select>
                    </div>                          
                </div>                                 
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">Email</label>
                        <input name="EMAIL" id="EMAIL" type="text" class="form-control" value="<?php echo $EMAIL; ?>" autocomplete="off">
                    </div>                          
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="STATUS">Status <span class="text-danger">*</span></label>
                        <select name="STATUS" id="STATUS" required="" class="form-control" data-parsley-required>
                            <option value="">Choose Status</option>
                            <option value="1" <?php if($STATUS == "1"){ echo "selected";} ?> >Active</option>
                            <option value="0" <?php if($STATUS == "0"){ echo "selected";} ?> >Non Active</option>
                        </select>
                    </div>                          
                </div>
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
                                <td align="left">Master User</td>
                                <td align="center"><input type="checkbox" id="mod_muser_c" name="mod_muser_c" <?php if($mod_muser_c==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_muser_r" name="mod_muser_r" <?php if($mod_muser_r==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_muser_u" name="mod_muser_u" <?php if($mod_muser_u==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_muser_d" name="mod_muser_d" <?php if($mod_muser_d==1){echo "checked";} ?>></td>
                            </tr>
                            <tr>
                                <td align="left">Master Company</td>
                                <td align="center"><input type="checkbox" id="mod_mcomp_c" name="mod_mcomp_c" <?php if($mod_mcomp_c==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_mcomp_r" name="mod_mcomp_r" <?php if($mod_mcomp_r==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_mcomp_u" name="mod_mcomp_u" <?php if($mod_mcomp_u==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_mcomp_d" name="mod_mcomp_d" <?php if($mod_mcomp_d==1){echo "checked";} ?>></td>
                            </tr>
                            <tr>
                                <td align="left">Master Company Type</td>
                                <td align="center"><input type="checkbox" id="mod_mcomptype_c" name="mod_mcomptype_c" <?php if($mod_mcomptype_c==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_mcomptype_r" name="mod_mcomptype_r" <?php if($mod_mcomptype_r==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_mcomptype_u" name="mod_mcomptype_u" <?php if($mod_mcomptype_u==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_mcomptype_d" name="mod_mcomptype_d" <?php if($mod_mcomptype_d==1){echo "checked";} ?>></td>
                            </tr>
                            <tr>
                                <td align="left">Master Department</td>
                                <td align="center"><input type="checkbox" id="mod_mdept_c" name="mod_mdept_c" <?php if($mod_mdept_c==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_mdept_r" name="mod_mdept_r" <?php if($mod_mdept_r==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_mdept_u" name="mod_mdept_u" <?php if($mod_mdept_u==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_mdept_d" name="mod_mdept_d" <?php if($mod_mdept_d==1){echo "checked";} ?>></td>
                            </tr>
                            <tr>
                                <td align="left">Master Division</td>
                                <td align="center"><input type="checkbox" id="mod_mdiv_c" name="mod_mdiv_c" <?php if($mod_mdiv_c==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_mdiv_r" name="mod_mdiv_r" <?php if($mod_mdiv_r==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_mdiv_u" name="mod_mdiv_u" <?php if($mod_mdiv_u==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_mdiv_d" name="mod_mdiv_d" <?php if($mod_mdiv_d==1){echo "checked";} ?>></td>
                            </tr>
                            <tr>
                                <td align="left">Master Level</td>
                                <td align="center"><input type="checkbox" id="mod_mlevel_c" name="mod_mlevel_c" <?php if($mod_mlevel_c==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_mlevel_r" name="mod_mlevel_r" <?php if($mod_mlevel_r==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_mlevel_u" name="mod_mlevel_u" <?php if($mod_mlevel_u==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_mlevel_d" name="mod_mlevel_d" <?php if($mod_mlevel_d==1){echo "checked";} ?>></td>
                            </tr>
                            <tr>
                                <td align="left">Master Employees</td>
                                <td align="center"><input type="checkbox" id="mod_memploy_c" name="mod_memploy_c" <?php if($mod_memploy_c==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_memploy_r" name="mod_memploy_r" <?php if($mod_memploy_r==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_memploy_u" name="mod_memploy_u" <?php if($mod_memploy_u==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_memploy_d" name="mod_memploy_d" <?php if($mod_memploy_d==1){echo "checked";} ?>></td>
                            </tr>
                            <tr>
                                <td align="left">Master Card</td>
                                <td align="center"><input type="checkbox" id="mod_mcard_c" name="mod_mcard_c" <?php if($mod_mcard_c==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_mcard_r" name="mod_mcard_r" <?php if($mod_mcard_r==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_mcard_u" name="mod_mcard_u" <?php if($mod_mcard_u==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_mcard_d" name="mod_mcard_d" <?php if($mod_mcard_d==1){echo "checked";} ?>></td>
                            </tr>
                            <tr>
                                <td align="left">Master Key</td>
                                <td align="center"><input type="checkbox" id="mod_mkey_c" name="mod_mkey_c" <?php if($mod_mkey_c==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_mkey_r" name="mod_mkey_r" <?php if($mod_mkey_r==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_mkey_u" name="mod_mkey_u" <?php if($mod_mkey_u==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_mkey_d" name="mod_mkey_d" <?php if($mod_mkey_d==1){echo "checked";} ?>></td>
                            </tr>
                            <tr>
                                <td align="left">Master Unit Measurement</td>
                                <td align="center"><input type="checkbox" id="mod_mum_c" name="mod_mum_c" <?php if($mod_mum_c==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_mum_r" name="mod_mum_r" <?php if($mod_mum_r==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_mum_u" name="mod_mum_u" <?php if($mod_mum_u==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_mum_d" name="mod_mum_d" <?php if($mod_mum_d==1){echo "checked";} ?>></td>
                            </tr>
                            <tr>
                                <td align="left">Master Vehicle</td>
                                <td align="center"><input type="checkbox" id="mod_mvehicle_c" name="mod_mvehicle_c" <?php if($mod_mvehicle_c==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_mvehicle_r" name="mod_mvehicle_r" <?php if($mod_mvehicle_r==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_mvehicle_u" name="mod_mvehicle_u" <?php if($mod_mvehicle_u==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_mvehicle_d" name="mod_mvehicle_d" <?php if($mod_mvehicle_d==1){echo "checked";} ?>></td>
                            </tr>
                            <tr>
                                <td align="left">Master Visitor Type</td>
                                <td align="center"><input type="checkbox" id="mod_mvistype_c" name="mod_mvistype_c" <?php if($mod_mvistype_c==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_mvistype_r" name="mod_mvistype_r" <?php if($mod_mvistype_r==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_mvistype_u" name="mod_mvistype_u" <?php if($mod_mvistype_u==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_mvistype_d" name="mod_mvistype_d" <?php if($mod_mvistype_d==1){echo "checked";} ?>></td>
                            </tr>
                            <tr>
                                <td align="left">Master Purpose</td>
                                <td align="center"><input type="checkbox" id="mod_mpurp_c" name="mod_mpurp_c" <?php if($mod_mpurp_c==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_mpurp_r" name="mod_mpurp_r" <?php if($mod_mpurp_r==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_mpurp_u" name="mod_mpurp_u" <?php if($mod_mpurp_u==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_mpurp_d" name="mod_mpurp_d" <?php if($mod_mpurp_d==1){echo "checked";} ?>></td>
                            </tr>
                            <tr>
                                <td align="center" colspan="5" style="background-color:#C9DEE6;"></td>                              
                            </tr>
                            <tr>
                                <td align="left">Visitor Management</td>
                                <td align="center"><input type="checkbox" id="mod_visitormg_c" name="mod_visitormg_c" <?php if($mod_visitormg_c==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_visitormg_r" name="mod_visitormg_r" <?php if($mod_visitormg_r==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_visitormg_u" name="mod_visitormg_u" <?php if($mod_visitormg_u==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_visitormg_d" name="mod_visitormg_d" <?php if($mod_visitormg_d==1){echo "checked";} ?>></td>
                            </tr>
                            <tr>
                                <td align="left">Package Management</td>
                                <td align="center"><input type="checkbox" id="mod_packagemg_c" name="mod_packagemg_c" <?php if($mod_packagemg_c==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_packagemg_r" name="mod_packagemg_r" <?php if($mod_packagemg_r==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_packagemg_u" name="mod_packagemg_u" <?php if($mod_packagemg_u==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_packagemg_d" name="mod_packagemg_d" <?php if($mod_packagemg_d==1){echo "checked";} ?>></td>
                            </tr>
                            <tr>
                                <td align="left">Key Management</td>
                                <td align="center"><input type="checkbox" id="mod_keymg_c" name="mod_keymg_c" <?php if($mod_keymg_c==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_keymg_r" name="mod_keymg_r" <?php if($mod_keymg_r==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_keymg_u" name="mod_keymg_u" <?php if($mod_keymg_u==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_keymg_d" name="mod_keymg_d" <?php if($mod_keymg_d==1){echo "checked";} ?>></td>
                            </tr>
                            <tr>
                                <td align="center" colspan="5" style="background-color:#C9DEE6;"></td>                              
                            </tr>
                            <tr>
                                <td align="left">Report Visitor Management</td>
                                <td align="center" colspan="4"><input type="checkbox" id="mod_laporanvms" name="mod_laporanvms" <?php if($mod_laporanvms==1){echo "checked";} ?>></td>
                            </tr>
                            <tr>
                                <td align="left">Report Package Management</td>
                                <td align="center" colspan="4"><input type="checkbox" id="mod_laporanpmg" name="mod_laporanpmg" <?php if($mod_laporanpmg==1){echo "checked";} ?>></td>
                            </tr>
                            <tr>
                                <td align="left">Report Key Management</td>
                                <td align="center" colspan="4"><input type="checkbox" id="mod_laporankmg" name="mod_laporankmg" <?php if($mod_laporankmg==1){echo "checked";} ?>></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12" align="center">
                    <button type="submit" name="simpan" class="btn btn-primary"><i class="ico-save"></i> Simpan</button>&nbsp&nbsp&nbsp
                    <a href="m_user" type="button" class="btn btn-danger"><i class="ico-close2"></i> Batal</a>
                </div>                    
            </div>
            <br><br>
        </form>
    </div>
</div>