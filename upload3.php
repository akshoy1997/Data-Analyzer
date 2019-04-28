<?php

	//checking if file output.csv exists and delete if yes
	$myFile = "uploads/output.csv";
	if(file_exists($myFile)){
		unlink($myFile) or die("Couldn't delete file");
	}

	$table1 = $_GET['table1'];
	$table2 = $_GET['table2'];
	$table3 = $_GET['joinfield'];
	$table6 = $_GET['joinfield2'];
	$table4 = $_GET['sortType'];
	$table5 = $_GET['sortfield'];
	$data = $_GET;
	$response = array(
		"postData" => $data
	);
	
	$response['data1'] = $table1;
	$response['data2'] = $table2;
	$response['data3'] = $table3;
	$response['data4'] = $table4;
	$response['data5'] = $table5;
	
	// Database connection
	mysql_connect('localhost','root', '');						
	mysql_select_db('learn');
	
	// create var to be filled with export data
	$csv_export = '';
	// query to get data from database
	$filter = "SELECT * FROM ".$table1." JOIN ".$table2." ON ".$table1.".".$table3."=".$table2.".".$table6." ORDER BY ".$table5." ".$table4;
	$queryt = mysql_query($filter);
	$field = mysql_num_fields($queryt);
	
	// SQL Query to write output.csv in table of learn database in phpmyadmin
	mysql_query("DELETE FROM learn.table");
	$temp = 'INSERT INTO learn.table VALUES ';
	$temp2 = mysql_num_rows($queryt);
	$j = 0;
	while($row = mysql_fetch_array($queryt)) {
	  $temp.= "(";
	  // create line with field values
	  for($i = 0; $i < $field; $i++) {
		$csv_export.= '"'.$row[mysql_field_name($queryt,$i)].'",';
		$temp.= '"'.$row[mysql_field_name($queryt,$i)].'"';
		if($i!= $field-1){
			$temp.= ",";
		}
	  }
	  $temp.= ")";
	  if ($j!= $temp2-1){
		  $temp.= ",";
	  }
	  $csv_export.= '
	';	
	   $j++;
	}
	mysql_query($temp) or die(mysql_error());
	
	// Export the data and prompt a csv file for download
	header("Content-type: text/x-csv");
	header("Content-Disposition: attachment; filename=".'output.csv'."");
	echo($csv_export);	
?>