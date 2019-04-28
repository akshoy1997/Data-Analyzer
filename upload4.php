<?php

	//Writing SQL table from output.csv to display in slider
	$file = fopen('uploads/output.csv',"r");
	$response = array();

	$tableString = '<div class=""button type="button" class="btn btn-danger" data-dismiss="modal">Transform</button>';
	$tableString = '<table class="table"><thead>';
	$tableString .=	"</thead><tbody>";
	while(! feof($file)){
		$tableString .= "<tr>";
		$row=fgetcsv($file);
		$temp = count($row);
		for($k=0;$k<$temp;$k++){
			$tableString .= "<td>".$row[$k]."</td>"; 	
		}
		$tableString .= "</tr>";
	}

	fclose($file); 
	$tableString .= "</tbody></table>";

	echo $tableString;
	
?>