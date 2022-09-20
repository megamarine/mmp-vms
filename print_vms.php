<?php
	require_once("module/model/koneksi/koneksi.php");
	
	require('assets/fpdf/pdf_js.php');
	$KODE_TAMU	 = $_GET["KODE_TAMU"];

	$stmt = GetQuery("select a.checkin_date,
							 a.pic,
							 a.visitor_name, 
							 b.company_name as nama_company,
							 c.purpose_desc as nama_keperluan,
							 d.visitortype_name
						from t_vms a
				   LEFT JOIN m_company b ON a.company_id = b.company_id
				   LEFT JOIN m_purpose c ON a.purpose_id = c.purpose_id
				   LEFT JOIN m_visitortype d ON a.visitor_type = d.visitortype_id
					   where vms_id = '$KODE_TAMU'");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
    {
    	$TANGGAL 		 = DATE_CREATE($row["checkin_date"]);
    	$TANGGAL_MASUK	 = DATE_FORMAT($TANGGAL, 'd F Y');
    	$JAM_MASUK	 	 = DATE_FORMAT($TANGGAL, 'H:i');
    	$ASAL_PERUSAHAAN = $row["nama_company"];
		$VISITOR_TYPE    = $row["visitortype_name"];
    	$KEPERLUAN 		 = $row["nama_keperluan"];
    	$BERTEMU_DENGAN	 = $row["pic"];
    	$NAMA_VISITOR    = $row["visitor_name"];
    }

	class PDF_AutoPrint extends PDF_JavaScript
	{
		function AutoPrint($printer='')
	    {
	        // Open the print dialog
	        if($printer)
	        {
	            $printer = str_replace('\\', '\\\\', $printer);
	            $script  = "var pp = getPrintParams();";
	            $script .= "pp.interactive = pp.constants.interactionLevel.full;";
	            $script .= "pp.printerName = '$printer'";
	            $script .= "print(pp);";
	        }
	        else
	            $script = 'print(true);';
	        $this->IncludeJS($script);
	    }
		// Page header
		function Header()
		{
		    $this->Ln(4);
		    $this->SetFont('Times','',12);
		    $this->Cell(0,5,"- Visitor Pass -",0,0,"C");
		    $this->Ln(5);
		    $this->SetFont('Times','B',12);
		    $this->Cell(0,5,"           PT. Mega Marine Pride           ",0,0,"C");
		    $this->Line(5,20,73,20);
		}

		// Page footer
		function Footer()
		{	
		    // Position at 1.5 cm from bottom
		    $this->SetY(-24);
		    // Arial italic 8
		    $this->SetFont('Times','B',9);
		    $this->Cell(0,5,"-SIMPAN VISITOR PASS INI DENGAN AMAN-",0,0,"C");
		}
		// Load data
		function LoadData($file)
		{
		    // Read file lines
		    $lines = file($file);
		    $data = array();
		    foreach($lines as $line)
		        $data[] = explode(';',trim($line));
		    return $data;
		}
		// Colored table
		function FancyTable($header)
		{
		    // Colors, line width and bold font
		    $this->SetFillColor(255,0,0);
		    $this->SetTextColor(255);
		    $this->SetDrawColor(128,0,0);
		    $this->SetLineWidth(.3);
		    $this->SetFont('','B');
		    // Header
		    $w = array(40, 35, 40, 45);
		    for($i=0;$i<count($header);$i++)
		        $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
		    $this->Ln();
		    // Color and font restoration
		    $this->SetFillColor(224,235,255);
		    $this->SetTextColor(0);
		    $this->SetFont('');
		    // Data
		    $fill = false;
		    foreach($data as $row)
		    {
		        $this->Cell($w[0],6,$row[0],'LR',0,'L',$fill);
		        $this->Cell($w[1],6,$row[1],'LR',0,'L',$fill);
		        $this->Cell($w[2],6,number_format($row[2]),'LR',0,'R',$fill);
		        $this->Cell($w[3],6,number_format($row[3]),'LR',0,'R',$fill);
		        $this->Ln();
		        $fill = !$fill;
		    }
		    // Closing line
		    $this->Cell(array_sum($w),0,'','T');
		}
	}

// Instanciation of inherited class
$pdf = new PDF_AutoPrint('P','mm',array(80,107));
$pdf->SetLeftMargin(8);
$pdf->SetTopMargin(5);
// Format Page Portrait/Landscape, Type of Paper, Rotation
$pdf->AddPage();
$pdf->SetFont('Times','',10);
$pdf->Ln(8);
$pdf->Cell(17,5,"Tanggal",0,0,"L");
$pdf->Cell(10,5,": " . $TANGGAL_MASUK,0,0,"L");
$pdf->Ln();
$pdf->Cell(17,5,"Waktu",0,0,"L");
$pdf->Cell(10,5,": " . $JAM_MASUK." WIB",0,0,"L");
$pdf->Ln();	
$pdf->Cell(17,5,"Nama",0,0,"L");
$pdf->Cell(10,5,": " . ucwords(strtolower($NAMA_VISITOR)),0,0,"L");
$pdf->Ln();
$pdf->Cell(17,5,"Asal",0,0,"L");
$pdf->Cell(10,5,": " . ucwords(strtolower($ASAL_PERUSAHAAN)),0,0,"L");
$pdf->Ln();
$pdf->Cell(17,5,"Keperluan",0,0,"L");
$pdf->Cell(10,5,": " . ucwords(strtolower($VISITOR_TYPE." - ".$KEPERLUAN)),0,0,"L");
$pdf->Ln();
$pdf->Cell(17,5,"Bertemu",0,0,"L");
$pdf->Cell(10,5,": " . ucwords(strtolower($BERTEMU_DENGAN)),0,0,"L");
$pdf->Ln();
$pdf->Image("qrcode/$KODE_TAMU.png",6,52,30);
$pdf->rect(40,56,33,22);
$pdf->Ln(26);
$pdf->SetFont('Times','',8);
$pdf->Cell(0,5,"[".$KODE_TAMU."]",0,0,"L");
$pdf->SetFont('Times','',8);
$pdf->Cell(3,5,"[ TANDA TANGAN PIC ]",0,0,"R");
$pdf->Line(5,83,73,83);

// write some JavaScript code
$js = <<<EOD
EOD;

// force print dialog
$js .= 'print(true);';

// set javascript
$pdf->IncludeJS($js);

$pdf->Output("pdf/Laporan ".$KODE_TAMU.".pdf","I");
?>