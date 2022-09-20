<?php 
require_once("module/model/koneksi/koneksi.php");

if(!empty($_POST["ROOMS_KEY"])) 
{
	$ROOMS_KEY = $_POST["ROOMS_KEY"];

	//CEK APAKAH DATA USER SUDAH ADA?
	$query = getQuery("select count(*) as itung from m_key where nama_ruangan = '$ROOMS_KEY'");
	while ($rowz = $query->fetch(PDO::FETCH_ASSOC))
	{
		$onok = $rowz["itung"];
	}
	//JIKA SUDAH ADA
	if($onok != 0)
	{
	?>
		<div class="alert alert-danger" role="alert">
		  Key Already Exist!
		</div>
	<?php
	}	
}

?>
