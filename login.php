<?php

	//Database connection
	$con=mysqli_connect("localhost","root","","demo");
	
	//Login_details check
	if(isset($_POST['host'])){
		
		$host = $_POST['host'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		$sql = "SELECT * FROM loginform WHERE host='".$host."' AND username='".$username."' AND password='".$password."' limit 1";
		$result = mysqli_query($con,$sql);
		
		if(mysqli_num_rows($result)==1){
			echo "You have Successfully logged in";
			header("Location: index2.php");
			exit();
		}
		else{
			echo "You have Entered Incorrect Details";
			header("Location: index.php");
			exit();
		}
		
	}

?>

