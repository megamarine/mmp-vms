<?php 
require_once("module/model/koneksi/koneksi.php");

if(!empty($_POST["CARD_NUMBER"])) 
{
	$CARD_NUMBER = $_POST["CARD_NUMBER"];

	//CEK APAKAH DATA USER SUDAH ADA?
	$query = getQuery("select count(*) as itung from m_card where card_no = '$CARD_NUMBER'");
	while ($rowz = $query->fetch(PDO::FETCH_ASSOC))
	{
		$onok = $rowz["itung"];
	}
	//JIKA SUDAH ADA
	if($onok != 0)
	{
	?>
		<div class="alert alert-danger" role="alert">
		  Card Number Already Exist!
		</div>
	<?php
	}	
}

?>
