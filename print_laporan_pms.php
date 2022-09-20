<?php
	require_once("module/model/koneksi/koneksi.php");
	require('assets/fpdf/fpdf.php');

    $P		 		  = $_GET["PERIODE"];
    $P2 	 		  = $_GET["PERIODE2"];
    if($_GET["PT"]!='')
    {
    	$JENIS_PAKET = $_GET["PT"];
    }
    $PERIODE 	        = date("Y-m-d", strtotime($P));
    $PERIODE2           = date("Y-m-d", strtotime($P2));
	$DINO 		        = date('Y-m-d H:i:s');
	$ID_USER 		    = $_SESSION["LOGINIDUS_VISITOR"];
	$IP_ADDRESS 	    = $_SESSION["IP_ADDRESS_VISITOR"];
    $PC_NAME 		    = $_SESSION["PC_NAME_VISITOR"];

	class PDF extends FPDF
	{
		// Page header
		function Header()
		{	
		    $P		 		 = $_GET["PERIODE"];
			$P2 	 		 = $_GET["PERIODE2"];
			$JENIS_PAKET     = "";

			if($_GET["PT"]!='')
		    {
		    	$JENIS_PAKET = $_GET["PT"];
		    }
            $FORMAT_PERIODE  = date("d F Y", strtotime($P));
            $FORMAT_PERIODE2 = date("d F Y", strtotime($P2));

			$this->SetFont('Arial','B',12);
			
			$this->Image('assets/image/images/logommp.png',10,9,30);
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
		    $this->Cell(0,5,"Laporan Package Management System",0,0,"C");
		    $this->Ln();
		    $this->SetFont('Arial','',10);
		    $this->Cell(0,5,"Periode " . $FORMAT_PERIODE . " s/d " . $FORMAT_PERIODE2 . " - " . $JENIS_PAKET,0,0,"C");
	        $this->Ln(8);
	         
		    $this->SetFont('Arial','B',9);
	        $this->Cell(10,5,"No.",1,0,"C");
	        $this->Cell(25,5,"PMS ID",1,0,"C");
	        $this->Cell(30,5,"Time Received",1,0,"C");
	        $this->Cell(25,5,"Package Type",1,0,"C");
	        $this->Cell(35,5,"Package From",1,0,"C");
	        $this->Cell(35,5,"Package For",1,0,"C");
	        $this->Cell(35,5,"Received By",1,0,"C");
	        $this->Cell(35,5,"Delivered By",1,0,"C");
	        $this->Cell(30,5,"Time Deliver",1,0,"C");
	        $this->Cell(22,5,"Status",1,0,"C");
	        $this->Ln();
		}
	}

// Format Page Portrait(P)/Landscape(L), Satuan Ukur, Ukuran kertas
$pdf = new PDF('L','mm','A4');
$pdf->AddPage();
$where_clause = "";
if($_GET["PT"]!='')
{
	$JENIS_PAKET  = $_GET["PT"];
    $where_clause = "and package_type = '$JENIS_PAKET'";
}

$stmt = GetQuery("select *
                    from t_pms
                   where STR_TO_DATE(date_trans, '%Y-%m-%d') between '$PERIODE' and '$PERIODE2' $where_clause
                   order by date_trans desc");
$no = 1;
while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
	if($row["status"] == 1)
	{
		$stat = "Waiting";
	}
	else
	{
		$stat = "Done";
	}

    $pdf->SetFont('Arial','',7);
    $pdf->Cell(10,5,$no++.".",1,0,"C");
    $pdf->Cell(25,5,$row["pms_id"],1,0,"L");
	$pdf->Cell(30,5,$row["date_trans"],1,0,"L");
	$pdf->Cell(25,5,$row["package_type"],1,0,"L");
    $pdf->Cell(35,5,$row["package_from"],1,0,"L");
    $pdf->Cell(35,5,$row["package_for"],1,0,"L");
    $pdf->Cell(35,5,$row["receiver"],1,0,"L");
    $pdf->Cell(35,5,$row["deliver"],1,0,"L");
    $pdf->Cell(30,5,$row["date_received"],1,0,"L");
    $pdf->Cell(22,5,$stat,1,0,"L");
    $pdf->Ln();

}
$pdf->Output("Laporan PMS_".$P."_".$P2.".pdf","I");
// }
?>