<?php
$DINO  = date("Y-m-d H:i:s");
$stmt  = GetQuery("select a.*,
                          b.company_name,
                          b.company_address,
                          b.company_phone,
                          c.visitortype_name,
                          d.purpose_desc,
                          e.vehicle_name,
                          f.um_desc,
                          g.nama_user
                     from t_vms a 
                     join m_company b ON a.company_id = b.company_id 
                     join m_visitortype c ON a.visitor_type = c.visitortype_id 
                     join m_purpose d ON a.purpose_id = d.purpose_id
                left join m_vehicle e ON a.vehicle_type = e.vehicle_id
                left join m_um f ON a.um_id = f.um_id
                     join m_user g ON a.checkin_hk_by = g.kode_user
                    where a.state='2' and a.status_visitor='1' and a.status_hapus='0' order by a.vms_id");
?>
<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="fas fa-people-arrows"></i> Visitor Management System - Production Area</h4>
    </div>
    <div class="page-header-section">
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama"><i class="ico-home2"></i> Dashboard</a></li>
                <li class="active"><i class="fas fa-expand"></i> VMS - Production Area</li>
            </ol>
        </div>
    </div>
</div>
<?php 
if($create_tvms == 1){
?>
<div class="row">
    <div class="col-lg-4">
    </div>
    <div class="col-lg-4">
        <div class="btn-group btn-group-justified" role="group" aria-label="...">
          <div class="btn-group" role="group">
            <a href="vmsp_in" class="btn btn-primary">Check In <i class="fas fa-sign-in-alt"></i></a>
          </div>
          <div class="btn-group" role="group">
            <a href="vmsp_out" class="btn btn-danger">Check Out <i class="fas fa-sign-out-alt"></i></a>
          </div>
        </div>
    </div>
    <div class="col-lg-4">
    </div>
</div><br>

<?php } ?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Currently Active</h3>
            </div>
            <table class="table table-striped table-bordered" id="column-filtering">
                <thead>
                    <tr>
                        <th>Option</th>
                        <th>Visitor Code</th>
                        <th>Visitor Name</th>
                        <th>Company Origin</th>
                        <th>Visitor Type</th>
                        <th>Purpose</th>
                        <th>PIC</th>
                        <th>Checkin Time</th>
						<th>Total Time Inside</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) 
                    {
                        $datetime1  = new DateTime($row["checkin_hk_date"]);
                        $datetime2  = new DateTime($DINO);
                        $intervalx  = $datetime1->diff($datetime2);

                        $date1      = new DateTime($row["checkin_hk_date"]);
                        $date2      = new DateTime($DINO);
                        $DATEZ      = $date2->diff($date1)->format('%a');
                        ?>
                        <tr>
                            <td align="center">
                                <?php 
                                if($delete_tvms == 1){
                                ?>
                                <a href="hapus_vmsp?KODE=<?php echo $row["vms_id"]; ?>" title="Delete" class="btn btn-danger" onclick="return confirm('Delete : <?=$row["vms_id"];?> ?')"><i class="fas fa-trash"></i></a>
                                <?php }
                                if($update_tvms == 1){
                                ?>
                                <!-- <a href="edit_vmsp?KODE=<?php echo $row["vms_id"]; ?>" title="Edit" class="btn btn-teal"><i class="fas fa-edit"></i></a> -->
                                <?php } ?>
                                    <button data-toggle="modal" data-target="#modalDetail" class="btn btn-success open-detail" title="Detail"
                                    data-vms_id="<?=$row['vms_id'];?>" data-created_by="<?=$row['nama_user'];?>" data-created_date="<?=$row['created_date'];?>"
                                    data-visitor_asal="<?=$row['visitor_asal'];?>" data-visitortype_name="<?=$row['visitortype_name'];?>" data-purpose_desc="<?=$row['purpose_desc'];?>" data-pic="<?=$row['pic'];?>" data-kitas_type="<?=$row['kitas_type'];?>" data-kitas_no="<?=$row['kitas_no'];?>" data-visitor_name="<?=$row['visitor_name'];?>" data-visitor_phone="<?=$row['visitor_phone'];?>" data-company_name="<?=$row['company_name'];?>" data-company_address="<?=$row['company_address'];?>" data-company_phone="<?=$row['company_phone'];?>" data-vehicle_no="<?=$row['vehicle_no'];?>" data-driver_pengganti="<?=$row['driver_pengganti'];?>" data-vehicle_name="<?=$row['vehicle_name'];?>" data-vehicle_brand="<?=$row['vehicle_brand'];?>" data-vehicle_qty="<?=$row['vehicle_qty'];?>" data-um_desc="<?=$row['um_desc'];?>" data-sim_type="<?=$row['sim_type'];?>" data-sim_no="<?=$row['sim_no'];?>" data-sim_exp="<?=$row['sim_exp'];?>" data-cek_suhu="<?=$row['cek_suhu'];?>" data-mcu_type="<?=$row['mcu_type'];?>" data-mcu_type="<?=$row['mcu_type'];?>" data-mcu_result="<?=$row['mcu_result'];?>" data-mcu_date="<?=$row['mcu_date'];?>" data-smell_test="<?=$row['smell_test'];?>" data-gejala_flu="<?=$row['gejala_flu'];?>" data-photo_path="<?=$row['photo_path'];?>" data-doc_path="<?=$row['doc_path'];?>" data-card_no="<?=$row['card_no'];?>"><i class="fas fa-search"></i></button>
                            </td>
                            <td><?php echo $row["vms_id"]; ?></td>
                            <td><?php echo $row["visitor_name"]; ?></td>
                            <td><?php echo $row["company_name"]; ?></td>
                            <td><?php echo $row["visitortype_name"]; ?></td>
                            <td><?php echo $row["purpose_desc"]; ?></td>
                            <td><?php echo $row["pic"]; ?></td>
                            <td><?php echo $row["checkin_hk_date"]; ?></td>
                            <td align="left"><?php echo $DATEZ . " Hari, " . $intervalx->format('%h')." Jam ".$intervalx->format('%i')." Menit"; ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Detail -->
<div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header text-center" style="background-color:#3B678F;">
        <h3 class="semibold modal-title"><b style="color:white;" id="vms_id"></b></h3>
        <h5 class="text-center" style="color:white;">Created By : <a style="color:white;" id="created_by"></a> || <a style="color:white;" id="created_date"></a> </h5>
      </div>
      <div class="modal-body table-responsive">
        <table class="table table-bordered" id="bergaris" style="font-size: 11px;">
            <tr>
                <td colspan="2"><h5 style="color: lightcoral;"><b>Visitor Data :</b></h5></td>
            </tr>
            <tr>
                <td><b>Visitor Origin</b></td><td id="visitor_asal"></td>
            </tr>
            <tr>
                <td><b>Visitor Type</b></td><td id="visitortype_name"></td>
            </tr>
            <tr>
                <td><b>Purpose</b></td><td id="purpose_desc"></td>
            </tr>
            <tr>
                <td><b>Meet With</b></td><td id="pic"></td>
            </tr>
            <tr>
                <td><b>ID Card Type</b></td><td id="kitas_type"></td>
            </tr>
            <tr>
                <td><b>ID Card Number</b></td><td id="kitas_no"></td>
            </tr>
            <tr>
                <td><b>Visitor Name</b></td><td id="visitor_name"></td>
            </tr>
            <tr>
                <td><b>Phone Number</b></td><td id="visitor_phone"></td>
            </tr>
            <tr>
                <td><b>Company Origin</b></td><td id="company_name"></td>
            </tr>
            <tr>
                <td><b>Company Address</b></td><td id="company_address"></td>
            </tr>
            <tr>
                <td><b>Company Phone</b></td><td id="company_phone"></td>
            </tr>
            <tr>
                <td colspan="2"><h5 style="color: lightcoral;"><b>Vehicle Data :</b></h5></td>
            </tr>
            <tr>
                <td><b>Vehicle Number</b></td><td id="vehicle_no"></td>
            </tr>
            <tr>
                <td><b>Replacement Driver</b></td><td id="driver_pengganti"></td>
            </tr>
            <tr>
                <td><b>Vehicle Name</b></td><td id="vehicle_name"></td>
            </tr>
            <tr>
                <td><b>Vehicle Brand</b></td><td id="vehicle_brand"></td>
            </tr>
            <tr>
                <td><b>Amount Of Goods</b></td><td id="vehicle_qty"></td>
            </tr>
            <tr>
                <td><b>Unit Measurement</b></td><td id="um_desc"></td>
            </tr>
            <tr>
                <td><b>Driving Licence</b></td><td id="sim_type"></td>
            </tr>
            <tr>
                <td><b>Driving Licence Number</b></td><td id="sim_no"></td>
            </tr>
            <tr>
                <td><b>Driving Licence Expired</b></td><td id="sim_exp"></td>
            </tr>
            <tr>
                <td colspan="2"><h5 style="color: lightcoral;"><b>Document Data :</b></h5></td>
            </tr>
            <tr>
                <td><b>Temperature Check</b></td><td id="cek_suhu"></td>
            </tr>
            <tr>
                <td><b>MCU Type</b></td><td id="mcu_type"></td>
            </tr>
            <tr>
                <td><b>MCU Result</b></td><td id="mcu_result"></td>
            </tr>
            <tr>
                <td><b>MCU Date</b></td><td id="mcu_date"></td>
            </tr>
            <tr>
                <td><b>Smell Test</b></td><td id="smell_test"></td>
            </tr>
            <tr>
                <td><b>Flu Symptoms</b></td><td id="gejala_flu"></td>
            </tr>
            <tr>
                <td><b>RFID Number</b></td><td id="card_no"></td>
            </tr>
            <tr>
                <td><b>Visitor Pic.</b></td><td><img id="photo_path" src="" width="70%" height="auto" onclick="window.open(this.src)"></td>
            </tr>
            <tr>
                <td><b>Document Pic.</b></td><td><img id="doc_path" src="" width="70%" height="auto" onclick="window.open(this.src)"></td>
            </tr>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">

//open-detail
$(document).on("click", ".open-detail", function ()
{
    $(".modal-header #vms_id").html( $(this).data('vms_id'));
    $(".modal-header #created_by").html( $(this).data('created_by'));
    $(".modal-header #created_date").html( $(this).data('created_date'));
    $(".modal-body #visitor_asal").html( $(this).data('visitor_asal'));
    $(".modal-body #pre_approval").html( $(this).data('pre_approval'));
    $(".modal-body #final_approval").html( $(this).data('final_approval'));
    $(".modal-body #purpose_desc").html( $(this).data('purpose_desc'));
    $(".modal-body #pic").html( $(this).data('pic'));
    $(".modal-body #kitas_type").html( $(this).data('kitas_type'));
    $(".modal-body #kitas_no").html( $(this).data('kitas_no'));
    $(".modal-body #visitor_name").html( $(this).data('visitor_name'));
    $(".modal-body #visitor_phone").html( $(this).data('visitor_phone'));
    $(".modal-body #company_name").html( $(this).data('company_name'));
    $(".modal-body #company_address").html( $(this).data('company_address'));
    $(".modal-body #company_phone").html( $(this).data('company_phone'));
    $(".modal-body #vehicle_no").html( $(this).data('vehicle_no'));
    $(".modal-body #driver_pengganti").html( $(this).data('driver_pengganti'));
    $(".modal-body #vehicle_name").html( $(this).data('vehicle_name'));
    $(".modal-body #vehicle_brand").html( $(this).data('vehicle_brand'));
    $(".modal-body #vehicle_qty").html( $(this).data('vehicle_qty'));
    $(".modal-body #um_desc").html( $(this).data('um_desc'));
    $(".modal-body #sim_type").html( $(this).data('sim_type'));
    $(".modal-body #sim_no").html( $(this).data('sim_no'));
    $(".modal-body #sim_exp").html( $(this).data('sim_exp'));
    $(".modal-body #cek_suhu").html( $(this).data('cek_suhu'));
    $(".modal-body #mcu_type").html( $(this).data('mcu_type'));
    $(".modal-body #mcu_result").html( $(this).data('mcu_result'));
    $(".modal-body #mcu_date").html( $(this).data('mcu_date'));
    $(".modal-body #smell_test").html( $(this).data('smell_test'));
    $(".modal-body #gejala_flu").html( $(this).data('gejala_flu'));
    $(".modal-body #card_no").html( $(this).data('card_no'));

    let pp = $(this).data('photo_path');
    document.getElementById("photo_path").src = pp;

    let dp = $(this).data('doc_path');
    document.getElementById("doc_path").src = dp;
});
</script>