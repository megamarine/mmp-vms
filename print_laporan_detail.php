<?php
	 require_once("module/model/koneksi/koneksi.php");
	 require('fpdf/fpdf.php');

	class PDF extends FPDF
	{
		// Page header
		function Header()
		{	
            $KODE_PERUSAHAAN = $_SESSION["LOGINPER_VISITOR"];
            $KODE_TAMU 		 = $_GET["KODE_TAMU"];

			$this->SetFont('Arial','B',12);
			
			$this->Image('../image/images/logommp.png',10,9,30);
			$this->Cell(25);
	    	$this->Write(5,"PT. MEGA MARINE PRIDE");
		    
		    $this->Ln(4);
		    $this->Cell(25);
		    $this->SetFont('Arial','',7);
		    $this->Write(5,"Ds. Wonokoyo - Kec. Beji, Pasuruan 67514 Jawa Timur Indonesia");
		    $this->Ln(4);
		    $this->Cell(25);
		    $this->Write(5,"Phone (62-343) 656513 - 656446 Fax. (62-343) 656195");
		    $this->Ln(4);
		    $this->Cell(25);
		    $this->Write(5,"PO Box. 6135/SBSG, Surabaya 60061 - Indonesia");
		    $this->Ln(2);
		    
		    $this->SetFont('Arial','I',8);
		    
		    $this->Cell(0,10,'Page '.$this->PageNo(),0,0,'R');
		    
		    $this->Ln(5);
		    $this->SetFont('Arial','BU',14);
		    $this->Cell(0,5,"Laporan Visitor Management System",0,0,"C");
		    $this->Ln();
		    $this->SetFont('Arial','',10);
		    $this->Cell(0,5,"Kode Tamu : ".$KODE_TAMU,0,0,"C");
            $this->Ln(8);
            
		    $this->SetFont('Arial','B',9);
            $this->Cell(10,5,"No.",1,0,"C");
            $this->Cell(35,5,"Nama Tamu",1,0,"C");
            $this->Cell(35,5,"Asal",1,0,"C");
            $this->Cell(35,5,"Keperluan",1,0,"C");
            $this->Cell(35,5,"PIC",1,0,"C");
            $this->Cell(35,5,"Tanggal Masuk",1,0,"C");
            $this->Cell(35,5,"Tanggal Keluar",1,0,"C");
            $this->Cell(35,5,"Total Waktu",1,0,"C");
            $this->Ln();
		}
		// Page footer
		// function Footer()
		// {	

		//     // Position at 1.5 cm from bottom
		//     $this->SetY(-70);
		//     // Arial italic 8
		//     $this->SetFont('Times','B',9);
		//     // Page number
		//     $this->Cell(10,5,"",0,0,"L");
		//     $this->Cell(40,5,"Mengetahui,",0,0,"L");
		//     $this->Cell(40,5,"Dibuat oleh,",0,0,"L");
		//     $this->Ln(25);
		//     $this->Cell(10,5,"",0,0,"L");
		//     $this->Cell(40,5,"(......................)",0,0,"L");
		//     $this->Cell(40,5,"(......................)",0,0,"L");
		// }
	}

// Format Page Portrait(P)/Landscape(L), Satuan Ukur, Ukuran kertas
$pdf = new PDF('L','mm','A4');
$pdf->AddPage();
$KODE_TAMU = $_GET["KODE_TAMU"];

$stmt = GetQuery("
         select ROW_NUMBER() OVER (ORDER BY vd.id_seq asc),
         		vm.vm_no as kode, 
                vm.company_name as company, 
                vm.checkin_date as date_in,
                vm.checkout_date as date_out,
                vm.app_type as app_type,
                vm.app_with as app_with,
                vm.visitor_leader as leader,
                vd.checkin_date_p as date_in_p,
                vd.checkout_date_p as date_out_p,
                vd.visitor_name as name,
                vd.id_seq as id_seq
         FROM  vims_master as vm
         INNER JOIN vims_detail as vd ON vm.vm_no = vd.vm_no
         WHERE vm.vm_no='$KODE_TAMU'");
while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
	extract($row);

	$datetimex       = new DateTime($row["date_in"]);
    $datetimey       = new DateTime($row["date_out"]);
    $intervalx       = $datetimey->diff($datetimex);
    $datex           = new DateTime($row["date_in"]);
    $datey           = new DateTime($row["date_out"]);
    $DATEX           = $datex->diff($datey)->format('%a'); 
    $TOTAL 		     = $DATEX . " Hari " . $intervalx->format('%h')." Jam ".$intervalx->format('%i')." Menit";

	$NAMA_TAMU		 = $row["name"];
	$KODE_TAMU 		 = $row["kode"];
    $ASAL_PERUSAHAAN = $row["company"];
    $KEPERLUAN 		 = $row["app_type"];
    $BERTEMU_DENGAN	 = $row["app_with"];
    $TANGGAL_MASUK	 = $row["date_in"];
    $TANGGAL_KELUAR	 = $row["date_out"];

    if($KEPERLUAN == 1)
    {
        $KEPERLUAN = "Audit";
    }
    else if ($KEPERLUAN == 2)
    {
        $KEPERLUAN = "Buyer/Supplier";
    }
    else if ($KEPERLUAN == 3)
    {
        $KEPERLUAN = "Dinas";
    }
    else if ($KEPERLUAN == 4)
    {
        $KEPERLUAN = "Inspector";
    }
    else if ($KEPERLUAN == 5)
    {
        $KEPERLUAN = "Meeting";
    }
    else if ($KEPERLUAN == 6)
    {
        $KEPERLUAN = "Tes/Interview";
    }
    else if ($KEPERLUAN == 7)
    {
        $KEPERLUAN = "Vendor";
    }

    $pdf->SetFont('Arial','',7);
    $pdf->Cell(10,5,$row_number.".",1,0,"C");
    $pdf->Cell(35,5,$NAMA_TAMU,1,0,"L");
	$pdf->Cell(35,5,$ASAL_PERUSAHAAN,1,0,"L");
    $pdf->Cell(35,5,$KEPERLUAN,1,0,"C");
    $pdf->Cell(35,5,$BERTEMU_DENGAN,1,0,"L");
    $pdf->Cell(35,5,$TANGGAL_MASUK,1,0,"C");
    $pdf->Cell(35,5,$TANGGAL_KELUAR,1,0,"C");
    $pdf->Cell(35,5,$TOTAL,1,0,"C");
    $pdf->Ln();

}
$pdf->Output("Laporan VMS_".$KODE_TAMU.".pdf","I");
// }
?>