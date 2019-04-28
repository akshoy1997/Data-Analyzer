<?php

	//download the file that is submitted
	$con=mysqli_connect("localhost","root","","upload") or die("Database not connected");
	$filename= $_FILES['MyFile']['name'];
	$file_loc = $_FILES['MyFile']['tmp_name'];
	$csvAsArray = array_map('str_getcsv', file($file_loc));
	$target = "uploads/".$filename;
		
	$query=mysqli_query($con,"INSERT INTO uploadfile(filename) VALUES ('$filename')")
		   or die("Query Error");
			
	move_uploaded_file($file_loc,$target);
	$response = array(
		"filename" => $filename
	);
		
?>


<?php

	//Displaying the file data as a table in slider
	$file = fopen($target,"r");
	$table= array();

	while(! feof($file)){
		$row=fgetcsv($file);
		array_push($table,$row);
	}

	$temp2 = count($table);
	fclose($file);
	$temp = count($row);
	$tableString = '<table class="table"><thead class="thead-light">';
	for($i=0;$i<count($table[0]);$i++){
		$tableString .= "<th>".$table[0][$i]."</th>"; 
	}
	$tableString .=	"</thead><tbody>";
	for($i=1;$i<count($table);$i++){
		$tableString .= "<tr>";
		for($j=0;$j<count($table[0]);$j++){
			$tableString .= "<td>".$table[$i][$j]."</td>"; 
		}
	$tableString .= "</tr>";
	}
	$tableString .= "</tbody></table>";
	$response['table'] = $tableString;
	
	echo json_encode($response);
	
?>