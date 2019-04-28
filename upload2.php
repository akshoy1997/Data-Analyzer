<?php

	//finding the column names for primary key selection and base field in which we order the query
	$con=mysqli_connect("localhost","root","","learn") or die("Database not connected");
	$data = $_POST;
	$table1 = $_POST['table1'];
	$table2 = $_POST['table2'];
	$query1 = "SELECT COLUMN_NAME from INFORMATION_SCHEMA.COLUMNS  where Table_name = '".$table1."'";
	$query2 = "SELECT COLUMN_NAME from INFORMATION_SCHEMA.COLUMNS  where Table_name = '".$table2."'";
	$result1 = mysqli_query($con,$query1) or die("Query Error");
	$result2 = mysqli_query($con,$query2) or die("Query Error");
	$num_rows1 = mysqli_num_rows($result1);
	$num_rows2 = mysqli_num_rows($result2);
	$data1 = $result1->fetch_array();
	$data2 = $result2->fetch_array();
	$array1 = array();
	$array2 = array();
	$response = array(
		"postData" => $data
	);
	$dataString1 = "";
	$dataString2 = "";
	$dataString3 = "";
	$j = 1;
	$k = 1;
	$m = 1;
	
	for($i=0;$i<count($data1)/2;$i++){
		$dataString1 .= "<button type='button' onclick='click1(this)'";
		$dataString1 .= "id='primary".$j."'";
		$dataString1 .= "class='btn btn-success' style='margin:5px; align:center; width:97%'>";
		$dataString1 .= $data1[$i];
		$dataString1 .= "</button>";
		$j++;
		for ($i=0;$i<$num_rows1-1;$i++){
			$dataString1 .= "<button type='button' onclick='click1(this)'";
			$dataString1 .= "id='primary".$j."'";
			$dataString1 .= "class='btn btn-success' style='margin:5px; align:center; width:97%'>";
			$row = mysqli_fetch_row($result1);
			array_push($array1,$row[0]);
			$dataString1 .= $row[0];
			$dataString1 .= "</button>";
			$j++;
		}
	}

	for($l=0;$l<count($data2)/2;$l++){
		$dataString2 .= "<button type='button' onclick='click2(this)'";
		$dataString2 .= "id='primary".$k."'";
		$dataString2 .= "class='btn btn-success' style='margin:5px; align:center; width:97%'>";
		$dataString2 .= $data2[$l];
		$dataString2 .= "</button>";
		$k++;
		for ($i=0;$i<$num_rows2-1;$i++){
			$dataString2 .= "<button type='button' onclick='click2(this)'";
			$dataString2 .= "id='primary".$j."'";
			$dataString2 .= "class='btn btn-success' style='margin:5px; align:center; width:97%'>";
			$row = mysqli_fetch_row($result2);
			array_push($array2,$row[0]);
			$dataString2 .= $row[0];
			$dataString2 .= "</button>";
			$k++;
		}
	}
	
	for($x=0;$x<count($data1)/2;$x++){
		$dataString3 .= "<button type='button' onclick='click4(this)'";
		$dataString3 .= "id='primary".$m."'";
		$dataString3 .= "class='btn btn-success' style='margin:5px; align:center; width:97%'>";
		$dataString3 .= $data1[$x];
		$dataString3 .= "</button>";
		$m++;
		for ($i=0;$i<$num_rows1-1;$i++){
			$dataString3 .= "<button type='button' onclick='click4(this)'";
			$dataString3 .= "id='primary".$j."'";
			$dataString3 .= "class='btn btn-success' style='margin:5px; align:center; width:97%'>";
			$dataString3 .= $array1[$i];
			$dataString3 .= "</button>";
			$m++;
		}
	}

	for($y=0;$y<count($data2)/2;$y++){
		$dataString3 .= "<button type='button' onclick='click4(this)'";
		$dataString3 .= "id='primary".$m."'";
		$dataString3 .= "class='btn btn-success' style='margin:5px; align:center; width:97%'>";
		$dataString3 .= $data2[$y];
		$dataString3 .= "</button>";
		$m++;
		for ($i=0;$i<$num_rows2-1;$i++){
			$dataString3 .= "<button type='button' onclick='click4(this)'";
			$dataString3 .= "id='primary".$j."'";
			$dataString3 .= "class='btn btn-success' style='margin:5px; align:center; width:97%'>";
			$dataString3 .= $array2[$i];
			$dataString3 .= "</button>";
			$m++;
		}
	}
	
	$response['data1'] = $dataString1;
	$response['data2'] = $dataString2;
	$response['data3'] = $dataString3;
	echo json_encode($response);
?>