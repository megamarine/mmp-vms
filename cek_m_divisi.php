<?php 
require_once("module/model/koneksi/koneksi.php");

if(!empty($_POST["DIVISION_CODE"])) 
{
	$DIVISI = $_POST["DIVISION_CODE"];

	//CEK APAKAH DATA USER SUDAH ADA?
	$query = getQuery("select count(*) as itung from m_division where div_id = '$DIVISI'");
	while ($rowz = $query->fetch(PDO::FETCH_ASSOC))
	{
		$onok = $rowz["itung"];
	}
	//JIKA SUDAH ADA
	if($onok != 0)
	{
	?>
		<div class="alert alert-danger" role="alert">
		  Division Code Already Exist!
		</div>
	<?php
	}	
}

?>
