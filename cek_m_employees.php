<?php 
require_once("module/model/koneksi/koneksi.php");

if(!empty($_POST["EMPLOYEES_CODE"])) 
{
	$EMPLOYEES_CODE = $_POST["EMPLOYEES_CODE"];

	//CEK APAKAH DATA USER SUDAH ADA?
	$query = getQuery("select count(*) as itung from m_employees where employees_id = '$EMPLOYEES_CODE'");
	while ($rowz = $query->fetch(PDO::FETCH_ASSOC))
	{
		$onok = $rowz["itung"];
	}
	//JIKA SUDAH ADA
	if($onok != 0)
	{
	?>
		<div class="alert alert-danger" role="alert">
		  Employees ID Already Exist!
		</div>
	<?php
	}	
}

?>
