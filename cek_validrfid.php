<?php
    require_once("module/model/koneksi/koneksi.php");
    // include "module/controller/distribusi/t_distribusi.php";
    if(!empty($_POST["NOMOR_RFID"])) 
    {
        $norfid  = $_POST["NOMOR_RFID"];
        $stmt    = GetQuery("select * from m_card where card_no = '$norfid' and status='0'");
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            echo 'ok';
        }
    }
?>