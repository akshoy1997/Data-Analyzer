<?php

	$str = "uploads/orders.csv";
	$str2 = (trim($str,'csv'));
	$str3 = (trim($str2,'uploads'));
	$str4 = (trim($str3,'/'));
	$str5 = (trim($str4,'.'));
	echo ($str5);
	
?>