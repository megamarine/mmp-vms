<?php
    require_once("module/model/koneksi/koneksi.php");

    if(!empty($_POST["CARD_NO"])) 
    {
        $CARD_NO   = $_POST["CARD_NO"];
        $stmt      = GetQuery("select a.vms_id,
                                      a.checkin_hk_date,
                                      a.pic,
                                      a.visitor_name,
                                      a.photo_path, 
                                      b.company_name,
                                      c.purpose_desc,
                                      d.visitortype_name
                                 from t_vms a
                            left join m_company b ON a.company_id = b.company_id
                            left join m_purpose c ON a.purpose_id = c.purpose_id
                            left join m_visitortype d ON a.visitor_type = d.visitortype_id
                                where a.card_no_hk = '$CARD_NO' and a.status_visitor='1' and a.state='2' and a.status_hapus='0'");

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
        ?>
        <div class="row ">
            <div class="col-md-2">
            </div>
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">Visitor Detail</h3>
                    </div>
                    <table class="table table-striped table-bordered">
                        <tr>
                            <td>VMS Code</td>
                            <td><?=$row["vms_id"];?></td>
                        </tr>
                        <tr>
                            <td>Checkin Date (Production Area)</td>
                            <td><?=$row["checkin_hk_date"];?></td>
                        </tr>
                        <tr>
                            <td>Visitor Name</td>
                            <td><?=$row["visitor_name"];?></td>
                        </tr>
                        <tr>
                            <td>Company Origin</td>
                            <td><?=$row["company_name"];?></td>
                        </tr>
                        <tr>
                            <td>Visitor Type</td>
                            <td><?=$row["visitortype_name"];?></td>
                        </tr>
                        <tr>
                            <td>Purpose</td>
                            <td><?=$row["purpose_desc"];?></td>
                        </tr>
                        <tr>
                            <td>PIC</td>
                            <td><?=$row["pic"];?></td>
                        </tr>
                        <tr>
                            <td colspan="2"><img src="<?=$row["photo_path"];?>" width="100%" height="auto"></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <input type="text" name="KODE_TAMU" id="KODE_TAMU" value="<?=$row['vms_id'];?>" hidden>
                            </td>
                        </tr>
                    </table>
                </div>
                <button type="submit" name="simpan2" id="simpan2" class="btn btn-primary btn-block"> Checkout Now &nbsp; <i class="fas fa-sign-out-alt fa-lg"></i> </button>
            </div>
            <div class="col-md-2">
            </div>
        </div>
        <?php
        }
    }
?>