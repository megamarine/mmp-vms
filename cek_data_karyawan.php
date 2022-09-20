<?php
require_once("module/model/koneksi/koneksi.php");

    if(!empty($_POST["RFID"])) 
    {
        $RFID = $_POST["RFID"];
        $stmt = GetQuery("select employees_name from m_employees where rfid_number = '$RFID'");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            $NAMA_KARYAWAN = $row["employees_name"];
            ?>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="NAME" style="font-size: 16px;text-align: center">Name :</label>
                        <input type="text" autocomplete="off" readonly="" class="form-control" name="NAME" id="NAME" value="<?php echo $NAMA_KARYAWAN;?>">
                    </div> 
                </div>  
            <?php
        }
    }
?>