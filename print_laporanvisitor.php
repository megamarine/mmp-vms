<?php
require_once("module/model/koneksi/koneksi.php");
require('fpdf/fpdf.php');

$P		 		  = $_GET["PERIODE"];
$P2 	 		  = $_GET["PERIODE2"];

if(isset($_GET["TYPE"]))
{
	$TYPE = $_GET["TYPE"];
	$stmt = GetQuery("select name from m_visitor_type where id = '$TYPE'");
	while ($rowz = $stmt->fetch(PDO::FETCH_ASSOC))
	{
		$TYPE 	= $rowz["name"];
	}
}

$PERIODE         = date("Y-m-d", strtotime($P));
$PERIODE2        = date("Y-m-d", strtotime($P2));

$DINO            = date('Y-m-d H:i:s');
$ID_USER         = $_SESSION["LOGINIDUS_VISITOR"];
$IP_ADDRESS      = $_SESSION["IP_ADDRESS_VISITOR"];
$PC_NAME         = $_SESSION["PC_NAME_VISITOR"];
$KODE_PERUSAHAAN = $_SESSION["LOGINPER_VISITOR"];

	class PDF extends FPDF
	{
		// Page header
		function Header()
		{	
			$P		 		 = $_GET["PERIODE"];
			$P2 	 		 = $_GET["PERIODE2"];
			$TYPE 			 = "";

			if(isset($_GET["TYPE"]))
		    {
		    	$TYPE = $_GET["TYPE"];
		     	$stmt = GetQuery("select name from m_visitor_type where id = '$TYPE'");
		     	while ($rowz = $stmt->fetch(PDO::FETCH_ASSOC))
		     	{
		     		$TYPE 	= $rowz["name"];
		     	}
		    }
            $FORMAT_PERIODE  = date("d F Y", strtotime($P));
            $FORMAT_PERIODE2 = date("d F Y", strtotime($P2));
            $KODE_PERUSAHAAN = $_SESSION["LOGINPER_VISITOR"];

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
		    $this->Cell(0,5,"Periode " . $FORMAT_PERIODE . " s/d " . $FORMAT_PERIODE2 . " - " . $TYPE,0,0,"C");
            $this->Ln(8);
            
		    $this->SetFont('Arial','B',9);
            $this->Cell(10,5,"No.",1,0,"C");
            // $this->Cell(30,5,"Kode Tamu",1,0,"C");
            $this->Cell(30,5,"Nama Visitor",1,0,"C");
            $this->Cell(45,5,"Asal",1,0,"C");
            $this->Cell(35,5,"Tipe Visitor",1,0,"C");
            $this->Cell(35,5,"Keperluan",1,0,"C");
            $this->Cell(35,5,"PIC",1,0,"C");
            $this->Cell(30,5,"Tanggal Masuk",1,0,"C");
            $this->Cell(30,5,"Tanggal Keluar",1,0,"C");
            $this->Cell(30,5,"Status",1,0,"C");
            $this->Ln();
		}
	}

// Format Page Portrait(P)/Landscape(L), Satuan Ukur, Ukuran kertas
$pdf = new PDF('L','mm','A4');
$pdf->AddPage();
$where_clause = "";
if(isset($_GET["TYPE"]))
{
	$TYPE 		  = $_GET["TYPE"];
    $where_clause = "and vr.visitor_type = '$TYPE'";
}

$stmt = GetQuery("
                select vr.*, 
                 case status_visitor
                 when '1' then 'Check In'
                 else 'Check Out'
                 end as status_visit, 
               mc.company_name as company,
               mp.description as purpose,
               mv.name as vtype
          from vims_reg as vr
     LEFT JOIN m_company mc ON vr.company_id = mc.company_id
     LEFT JOIN m_purpose mp ON vr.purpose_id = mp.purpose_id
     LEFT JOIN m_visitor_type as mv ON vr.visitor_type = mv.id
        where  to_date(cast(checkin_date as text), 'YYYY-MM-DD') between '$PERIODE' and '$PERIODE2' and
               vr.plant_id = '$KODE_PERUSAHAAN'
               $where_clause
      order by vm_no desc");
$no = 1;
while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
	extract($row);
	$KODE_TAMU		  = $row["vm_no"];
	$datetimex       = new DateTime($row["checkin_date"]);
	$datetimey       = new DateTime($row["checkout_date"]);
	$intervalx       = $datetimey->diff($datetimex);
	$datex           = new DateTime($row["checkin_date"]);
	$datey           = new DateTime($row["checkout_date"]);
	$DATEX           = $datex->diff($datey)->format('%a'); 
	$TOTAL 		     = $DATEX . " Hari " . $intervalx->format('%h')." Jam ".$intervalx->format('%i')." Menit";	
	$NAMA_TAMU		  = $row["visitor_name"];
	$KODE_TAMU 		  = $row["vm_no"];
   $ASAL_PERUSAHAAN = $row["company"];
   $TYPE_VISITOR 	  = $row["vtype"];
   $KEPERLUAN 		  = $row["purpose"];
   $BERTEMU_DENGAN  = $row["pic"];
   $TANGGAL_MASUK	  = $row["checkin_date"];
   $TANGGAL_KELUAR  = $row["checkout_date"];
   $NOPOL 			  = $row["car_no"];
   $STATUS_VISIT    = $row["status_visit"];

   $pdf->SetFont('Arial','',7);
   $pdf->Cell(10,5,$no++.".",1,0,"C");
   // $pdf->Cell(30,5,$KODE_TAMU,1,0,"L");
   $pdf->Cell(30,5,ucwords(strtolower($NAMA_TAMU)),1,0,"L");
	$pdf->Cell(45,5,ucwords(strtolower($ASAL_PERUSAHAAN)),1,0,"L");
	$pdf->Cell(35,5,ucwords(strtolower($TYPE_VISITOR)),1,0,"L");
   $pdf->Cell(35,5,ucwords(strtolower($KEPERLUAN)),1,0,"L");
   $pdf->Cell(35,5,ucwords(strtolower($BERTEMU_DENGAN)),1,0,"L");
   $pdf->Cell(30,5,$TANGGAL_MASUK,1,0,"L");
   $pdf->Cell(30,5,$TANGGAL_KELUAR,1,0,"L");
   $pdf->Cell(30,5,$STATUS_VISIT,1,0,"L");
   $pdf->Ln();

}
$pdf->Output("Laporan VMS_".$P."_".$P2.".pdf","I");
// }
?>