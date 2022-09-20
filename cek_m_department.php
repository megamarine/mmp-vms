<?php 
require_once("module/model/koneksi/koneksi.php");

if(!empty($_POST["DEPARTMENT_CODE"])) 
{
	$DEPARTMENT_CODE = $_POST["DEPARTMENT_CODE"];

	//CEK APAKAH DATA USER SUDAH ADA?
	$query = getQuery("select count(*) as itung from m_department where dept_id = '$DEPARTMENT_CODE'");
	while ($rowz = $query->fetch(PDO::FETCH_ASSOC))
	{
		$onok = $rowz["itung"];
	}
	//JIKA SUDAH ADA
	if($onok != 0)
	{
	?>
		<div class="alert alert-danger" role="alert">
		  Department Code Already Exist!
		</div>
	<?php
	}	
}

?>
