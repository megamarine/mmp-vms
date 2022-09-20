<?php
	require_once("module/model/koneksi/koneksi.php");
	require('assets/fpdf/fpdf.php');

    $P		 	= $_GET["PERIODE"];
    $P2 	 	= $_GET["PERIODE2"];
    if($_GET["ST"]!='')
    {
    	$STATUS = $_GET["ST"];
    }
    $PERIODE 	= date("Y-m-d", strtotime($P));
    $PERIODE2   = date("Y-m-d", strtotime($P2));
	$DINO 		= date('Y-m-d H:i:s');
	$ID_USER 	= $_SESSION["LOGINIDUS_VISITOR"];
	$IP_ADDRESS = $_SESSION["IP_ADDRESS_VISITOR"];
    $PC_NAME 	= $_SESSION["PC_NAME_VISITOR"];

	class PDF extends FPDF
	{
		// Page header
		function Header()
		{	
		    $P		= $_GET["PERIODE"];
			$P2 	= $_GET["PERIODE2"];
			$STATUS = "";

			if($_GET["ST"]!='')
		    {
		    	$STATUS = $_GET["ST"];
				if($STATUS == 1)
				{
					$stat = "Waiting";
				}
				else
				{
					$stat = "Done";
				}
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
		    $this->Cell(0,5,"Laporan Key Management System",0,0,"C");
		    $this->Ln();
		    $this->SetFont('Arial','',10);
		    $this->Cell(0,5,"Periode " . $FORMAT_PERIODE . " s/d " . $FORMAT_PERIODE2 . " - " . $stat,0,0,"C");
	        $this->Ln(8);
	         
		    $this->SetFont('Arial','B',9);
	        $this->Cell(10,5,"No.",1,0,"C");
	        $this->Cell(25,5,"KMS ID",1,0,"C");
	        $this->Cell(35,5,"Room's Key",1,0,"C");
	        $this->Cell(25,5,"Borrowed By",1,0,"C");
	        $this->Cell(25,5,"Borrowed Time",1,0,"C");
	        $this->Cell(40,5,"Borrowed Remark",1,0,"C");
	        $this->Cell(35,5,"Returned By",1,0,"C");
	        $this->Cell(25,5,"Returned Time",1,0,"C");
	        $this->Cell(40,5,"Returned Remark",1,0,"C");
	        $this->Cell(22,5,"Status",1,0,"C");
	        $this->Ln();
		}
	}

// Format Page Portrait(P)/Landscape(L), Satuan Ukur, Ukuran kertas
$pdf = new PDF('L','mm','A4');
$pdf->AddPage();
$where_clause = "";
if($_GET["ST"]!='')
{
	$STATUS  = $_GET["ST"];
    $where_clause = "and a.status = '$STATUS'";
}

$stmt = GetQuery("select a.*,
						 b.nama_ruangan
                    from t_kms a
					join m_key b ON a.key_id = b.key_id
                   where STR_TO_DATE(a.borrowed_date, '%Y-%m-%d') between '$PERIODE' and '$PERIODE2' $where_clause
                   order by a.created_date desc");
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
    $pdf->Cell(25,5,$row["kms_id"],1,0,"L");
	$pdf->Cell(35,5,$row["nama_ruangan"],1,0,"L");
	$pdf->Cell(25,5,$row["borrowed_name"],1,0,"L");
    $pdf->Cell(25,5,$row["borrowed_date"],1,0,"L");
    $pdf->Cell(40,5,$row["borrowed_remark"],1,0,"L");
    $pdf->Cell(35,5,$row["return_name"],1,0,"L");
    $pdf->Cell(25,5,$row["return_date"],1,0,"L");
    $pdf->Cell(40,5,$row["return_remark"],1,0,"L");
    $pdf->Cell(22,5,$stat,1,0,"L");
    $pdf->Ln();

}
$pdf->Output("Laporan KMS_".$P."_".$P2.".pdf","I");
// }
?>