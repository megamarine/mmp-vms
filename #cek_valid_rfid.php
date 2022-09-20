<?php
    require_once("module/model/koneksi/koneksi.php");
    include "module/controller/distribusi/t_distribusi.php";

    if(!empty($_POST["NOMOR_RFID"])) 
    {
        $NOMOR_RFID = $_POST["NOMOR_RFID"];
        $stmt       = GetQuery("select * from m_cards where card_no = '$NOMOR_RFID'");
        
        while($row=pg_fetch_assoc($stmt))
        {
            $TANGGAL_MASUK = $row["created_by"];
            ?>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="TANGGAL_MASUK" style="font-size: 20px;"><?php echo $TANGGAL_MASUK; ?> </label>
                    </div>                          
                </div>
            </div>
            <?php
        }
    }
?>