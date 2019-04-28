<?php

	//finding the column names for primary key selection and base field in which we order the query
	mysql_connect('localhost','root', '') or die("Database not connected");
	mysql_select_db('learn');
	$data = $_POST;
	$table = $_POST['table'];

	//Writing SQL table from output.csv to display in slider
	$filename = "uploads/".$table;
	$tablename = trim($filename,'uploads');
	$tablename2 = trim($tablename,'csv');
	$tablename3 = trim($tablename2,'/');
	$tablename4 = trim($tablename3,'.');
	$file = fopen($filename,"r");
	$response = array();
	$row=fgetcsv($file);
	$temp = "DELETE FROM learn.".$tablename4;
	mysql_query($temp);
	$temp2 = 'INSERT INTO learn.'.$tablename4.' VALUES ';

	while(! feof($file)){
		$temp2.= "(";
		$row=fgetcsv($file);
		$temp3 = count($row);
		for($k=0;$k<$temp3;$k++){
			$temp2.= "'".$row[$k]."'";
			if($k!= $temp3-1){
				$temp2.= ", ";
			}
		}
		$temp2.= "), ";
	}
	
	$temp4 = trim($temp2,", (''), ");
	$temp4.= "')";
	mysql_query($temp4) or die(mysql_error());

	fclose($file); 

	echo json_encode($response);
	
?>