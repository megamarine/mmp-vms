<?php
    require_once("module/model/koneksi/koneksi.php");
    include "module/controller/distribusi/t_distribusi.php";

    if(!empty($_POST["NO_RFID"])) 
    {
        $PERUSAHAN_USER = $_SESSION["LOGINPER_VISITOR"];
        $NO_RFID   = $_POST["NO_RFID"];
        $stmt      = GetQuery("select * from vims_reg where rfid_no = '$NO_RFID' and state='1' and plant_id = '$PERUSAHAN_USER'");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            $KODE_TAMU          = $row["vm_no"];
            $NAMA_TAMU          = $row["visitor_name"];
            $RFID               = $row["rfid_no"];

            ?>
            <div class="row">
                <div class="col-md-1">                
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="KODE_TAMU" style="font-size: 16px;"><?php echo $KODE_TAMU; ?> </label>
                    </div>                          
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="NAMA_TAMU" style="font-size: 16px;"><?php echo $NAMA_TAMU; ?> </label>
                    </div>                          
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="RFID" style="font-size: 16px;"><?php echo $RFID; ?> </label>
                    </div>                          
                </div>
                    </div>                          
                </div>
            </div>
                <?php
        }
    }
?>