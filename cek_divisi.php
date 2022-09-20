<?php
	require_once("module/model/koneksi/koneksi.php");
	?>
		<option value="">Choose Division</option>
	<?php
	if(!empty($_POST["DEPARTEMENT"])) 
	{
		$DEPARTEMENT = $_POST["DEPARTEMENT"];
		$results = getQuery("select * from m_division where dept_id = '$DEPARTEMENT' order by div_name asc");
		while ($rowz = $results->fetch(PDO::FETCH_ASSOC))
		{
			?>
				<option value="<?php echo $rowz["div_id"]; ?>">
					<?php echo $rowz["div_name"]; ?>
				</option>
			<?php
		}
	}
?>
