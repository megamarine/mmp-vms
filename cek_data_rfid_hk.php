<?php
    require_once("module/model/koneksi/koneksi.php");
    include "module/controller/distribusi/t_distribusi_hk.php";

    if(!empty($_POST["NO_RFID_HK"])) 
    {
        $NO_RFID_HK   = $_POST["NO_RFID_HK"];
        $stmt         = GetQuery("select * from vims_reg where rfid_no_hk = '$NO_RFID_HK' and state='2'");

        // $stmt = GetQuery("
        //                 select  vr.vm_no as vm_no, 
        //                         vr.company_name as company_name,
        //                         vd.checkin_date_p as checkin_date_p,
        //                         vd.rfid_no as rfid_no,
        //                         vd.visitor_name as visitor_name
        //                  FROM  vims_reg as vr
        //                  LEFT JOIN m_company
        //                  LEFT JOIN vims_detail as vd ON vm.vm_no = vd.vm_no

        //                  WHERE vd.rfid_no_hk='$NO_RFID_HK' and vd.state='2'");

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            $KODE_TAMU          = $row["vm_no"];
            $NAMA_TAMU          = $row["visitor_name"];
            $RFID_HK            = $row["rfid_no"];
            $JAM_MASUK          = $row["checkin_hk"];

            ?>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="KODE_TAMU" style="font-size: 16px;"><?php echo $KODE_TAMU; ?> </label>
                    </div>                          
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="NAMA_TAMU" style="font-size: 16px;"><?php echo $NAMA_TAMU; ?> </label>
                    </div>                          
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="RFID" style="font-size: 16px;"><?php echo $RFID_HK; ?> </label>
                    </div>                          
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="JAM_MASUK" style="font-size: 16px;"><?php echo $JAM_MASUK; ?> </label>
                    </div>                          
                </div>
            <?php
        }
    }
?>