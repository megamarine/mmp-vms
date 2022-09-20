<?php
	session_start();
	ini_set("date.timezone","Asia/Jakarta");
	ini_set('max_execution_time', 0);
	$db1 = new PDO('mysql:host=192.168.10.167:3307;dbname=vms', 'vms', 'vmsmmp');	
	$TGL = date("Y-m-d");

	function kodeAuto($namatabel,$namakolom)
	{
		$db1 = new PDO('mysql:host=192.168.10.167:3307;dbname=vms', 'vms', 'vmsmmp');			

		$akhir = 0;
		$stmt  = $db1->query("select max($namakolom) as akhir from $namatabel");
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			if(isset($row["akhir"]))
			{
				$akhir = intval($row["akhir"]);
			}
		}
		$akhir = $akhir +1;
		return $akhir;
	}

	function GetQuery($query){
		$db1 = new PDO('mysql:host=192.168.10.167:3307;dbname=vms', 'vms', 'vmsmmp');			
		$result = $db1->prepare($query) or trigger_error(mysql_error()); 
		$result->execute();
		return $result;
	}

	function GetData($kolom,$from){
		$db1 = new PDO('mysql:host=192.168.10.167:3307;dbname=vms', 'vms', 'vmsmmp');		
		$result = $db1->prepare("select $kolom from $from") or trigger_error(mysql_error()); 
		$result->execute();
		return $result;
	}

	function GetData1($kolom,$from,$where){
		$db1 = new PDO('mysql:host=192.168.10.167:3307;dbname=vms', 'vms', 'vmsmmp');		
		$result = $db1->prepare("select $kolom from $from where $where") or trigger_error(mysql_error()); 
		$result->execute();
		return $result;
	}

	function UpdateData($from,$kolom,$where){
		$db1 = new PDO('mysql:host=192.168.10.167:3307;dbname=vms', 'vms', 'vmsmmp');		
		$result = $db1->prepare("update $from set $kolom where $where") or trigger_error(mysql_error()); 
		$result->execute();
		return $result;
	}

	function InsertData($table,$kolom,$values){
		$db1 = new PDO('mysql:host=192.168.10.167:3307;dbname=vms', 'vms', 'vmsmmp');		
		$result = $db1->prepare("insert into $table ($kolom) values ($values)") or trigger_error(mysql_error()); 
		$result->execute();
		return $result;
	}

	function DeleteData($table,$where){
		$db1 = new PDO('mysql:host=192.168.10.167:3307;dbname=vms', 'vms', 'vmsmmp');		
		$result = $db1->prepare("delete from $table where $where") or trigger_error(mysql_error()); 
		$result->execute();
		return $result;
	}

	function createKode($namaTabel,$namaKolom,$awalan,$jumlahAngka)
	{
		$db1 = new PDO('mysql:host=192.168.10.167:3307;dbname=vms', 'vms', 'vmsmmp');		
		$angkaAkhir = 0;
		
		$stmt = $db1->query("select max(right($namaKolom,$jumlahAngka)) as akhir from $namaTabel where $namaKolom like '".$awalan."%' ");
		while($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			if(isset($row["akhir"]))
			{
				$angkaAkhir = intval($row["akhir"]);
			}
		}
		$angkaAkhir = $angkaAkhir + 1;
		return $awalan.substr("0000000".$angkaAkhir,-1*$jumlahAngka);
	}	
	
	function getIp(){
	    $IP_ADDRESS = $_SERVER['REMOTE_ADDR'];     
	    if($IP_ADDRESS){
	        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
	            $IP_ADDRESS = $_SERVER['HTTP_CLIENT_IP'];
	        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
	            $IP_ADDRESS = $_SERVER['HTTP_X_FORWARDED_FOR'];
	        }
	        return $IP_ADDRESS;
	    }
	    return false;
	}
?>