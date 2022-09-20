<?php
    require_once("module/model/koneksi/koneksi.php");

    if(!empty($_POST["CARD_NO"])) 
    {
        $CARD_NO   = $_POST["CARD_NO"];
        $stmt      = GetQuery("select a.vms_id,
                                      a.checkin_date,
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
                                where a.card_no = '$CARD_NO' and a.status_visitor='1' and a.state='1' and a.status_hapus='0'");

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
                            <td>Checkin Date (Outside Area)</td>
                            <td><?=$row["checkin_date"];?></td>
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
                                <label for="CARD_NO" style="font-size: 20px;">Scan New RFID Card from House Keeping <span class="text-danger">*</span></label>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <input type="text" class="form-control" name="CARD_NO_HK" id="CARD_NO_HK" oninput="getRFID(this.value);" onkeypress="return event.keyCode!=13" required="" autocomplete="off" placeholder="Scan RFID Card from House Keeping here...">
                                <input type="text" name="KODE_TAMU" id="KODE_TAMU" value="<?=$row['vms_id'];?>" hidden>
                            </td>
                        </tr>
                    </table>
                </div>
                <button type="submit" name="simpan" id="simpan" class="btn btn-primary btn-block"> Checkin Now &nbsp; <i class="fas fa-sign-in-alt fa-lg"></i> </button>
            </div>
            <div class="col-md-2">
            </div>
        </div>
        <?php
        }
    }
?>

<script>
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
            $("#simpan"). attr("disabled", false);
        }
        else
        {
            $("#simpan"). attr("disabled", true);
        }
        }
    });
}

//FUNCTION DISABLE BUTTON SIMPAN
$(document).ready(function()
{
    $("#simpan"). attr("disabled", true);
});
</script>