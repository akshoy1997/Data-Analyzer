<html>

<head>
  <title>Data Analyser</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!-- Font-family -->
  <style> 
	@font-face {
		font-family: myFirstFont;
		src: url('Artifika-Regular.ttf');
	}

	* {
		font-family: myFirstFont;
	}
  </style>
  
  <!-- BootStrap And JQuery Framework-->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  
  <!-- Drag, Drop And Click Functions -->
  <script>
	function allowDrop(ev) {
		ev.preventDefault();
	}

	function drag(ev) {
		ev.dataTransfer.setData("text", ev.target.id);
	}

	function drop1(ev) {
		ev.preventDefault();
		var data=ev.dataTransfer.getData("text");
		ev.target.innerHTML = document.getElementById(data).innerHTML;
		const id = ev.target.id;
		$("#"+id+'input').val(ev.target.innerHTML);
		$("#"+id+'transform').val(ev.target.innerHTML);
		$("#"+id+'map').val(ev.target.innerHTML);
		$("#"+id+'col').val(ev.target.innerHTML);
		console.log(ev.target);
	}
	
	function click1(d){     
		document.getElementById("table1").innerHTML = d.innerHTML;
    }

    function click2(d){     
		document.getElementById("table2").innerHTML = d.innerHTML;
    }

    function click3(d){     
		document.getElementById("table3").innerHTML = d.innerHTML;
    }	

    function click4(d){     
		document.getElementById("table4").innerHTML = d.innerHTML;
    }
	
	function click5(d){     
		document.getElementById("table5").innerHTML = d.innerHTML;
    }
	
	function click6(d){     
		$("#joinfieldinput").val(document.getElementById("table1").innerHTML);
		$("#joinfieldinput2").val(document.getElementById("table2").innerHTML);
		console.log(document.getElementById("table2"));
    }
	
	function click7(d){     
		$("#sortTypeinput").val(document.getElementById("table3").innerHTML);
		$("#sortfieldinput").val(document.getElementById("table4").innerHTML);
		console.log(document.getElementById("table3"));
    }
	
  </script>
  
  <!-- AJAX Response for joining, transforming Tables and finally showing it as SQL tables  -->
  <script>
	$(document).ready(function (e) {
		$('#joinTable').on('submit', (function (e){
			e.preventDefault();
			const dataString = new FormData(this);
			
			$.ajax({
				url: "upload2.php",
				type: "POST",
				data:  dataString,
				contentType: false,     //when we send json file we write contentType: 'application/json'
				cache: false,
				processData:false,
				success: function(data){
					console.log(data);
					response = JSON.parse(data);
					$("#col1Data").html(response['data1']);
					$("#col2Data").html(response['data2']);
				},
				error: function(data) {
					alert("Incorrect details. Re-enter your particulars!");
					console.log(data);
				}
			});
		}));
		
		$('#transformTable').on('submit', (function (e){
			e.preventDefault();
			const dataString = new FormData(this);
			
			$.ajax({
				url: "upload2.php",
				type: "POST",
				data:  dataString,
				contentType: false,     //when we send json file we write contentType: 'application/json'
				cache: false,
				processData:false,
				success: function(data){
					response = JSON.parse(data);
					$("#col3Data").html(response['data3']);
				},
				error: function(data) {
					alert("Incorrect details. Re-enter your particulars!");
					console.log(data);
				}
			});
		}));
		
		$('#sqlData').on('submit', (function (e){
			e.preventDefault();
			const dataString = new FormData(this);
			
			$.ajax({
				url: "upload4.php",
				type: "POST",
				data:  dataString,
				contentType: false,     //when we send json file we write contentType: 'application/json'
				cache: false,
				processData:false,
				success: function(data){
					$("#tableData").html(data);
					console.log(data);
				},
				error: function(data) {
					alert("Incorrect details. Re-enter your particulars!");
					console.log(data);
				}
			});
		}));
		
	});
  </script>
  
  <!-- Side Nav-Bar Collapsible -->
  <style>
	.sidenav {
	  height: 100%;
	  width: 600px;
	  position: fixed;
	  z-index: 1;
	  top: 0;
	  right: 0;
	  background-color: #fff;
	  display: none;
	  overflow-x: hidden;
	  transition: 0.5s;
	  padding-top: 60px;
	}

	.sidenav a {
	  padding: 8px 8px 8px 32px;
	  text-decoration: none;
	  font-size: 25px;
	  color: #818181;
	  display: block;
	  transition: 2s;
	}

	.sidenav a:hover {
	  color: #f1f1f1;
	}

	.sidenav .closebtn {
	  position: absolute;
	  top: 0;
	  right: 25px;
	  font-size: 36px;
	  margin-left: 50px;
	}

	@media screen and (max-height: 450px) {
	  .sidenav {padding-top: 15px;}
	  .sidenav a {font-size: 18px;}
	}
	</style>
  
  <!-- JS Code -->
	<script type="text/javascript">
	$(document).ready(function(){
		$("#slider").click(function(e){
			e.preventDefault();
		    $("#mySidenav").show();
			console.log($("#slider"));
		});

		$("#close").click(function(e){
			e.preventDefault();
		    $("#mySidenav").hide();
		});
	})
	</script>
  
</head>

<body>

	<!-- The slider to display Database -->
	<div id="mySidenav" class="sidenav" style="width:90%; overflow-x:scroll;">
	  <a href="javascript:void(0)" class="closebtn" id="close">&times;</a>
	  <div class="container" id="tableData">
	  </div>
	</div>
   
   <!--Header of the UI-->
    <div class="container-fluid" style="background-color:black; padding:10px;">
		<div class="navbar-header">
		  <a class="navbar-brand" href="#"><p style="font-size:1.3em; margin-left:50px; color:white;">DATA Analyzer</p></a>
		</div>
		<ul class="nav navbar-nav">
			<li class="active"><button style="margin-left:1040px; padding-top=70px;" class="w3-button w3-teal w3-xlarge" id="slider">☰</button></li>
		</ul>
    </div>

   	<div style="margin: 60px 50px 75px 50px;;" class="container-fluid">
		<!-- Options -->
		<div class="row">
			<div class="col-sm-3 " style="font-size:1.3em; margin:1px;"><b>1. Select Format</b></div>
			<div class="col-sm-3" style="font-size:1.3em; margin:1px;"><b>2. Select Source</b></div>
			<div class="col-sm-5" style="font-size:1.3em; margin:1px 1px 1px 15px;"><b>Visualizer</b></div>
		</div></br>
		
		<div class="row">
		<!--Format Select-->
		<div class="col-sm-3" style="margin:1px;">
			<div class="panel with-nav-tabs panel-default">
				<div class="panel-heading">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#tab1default1" data-toggle="tab"><b>MySQL</b></a></li>
						<li><a href="#tab2default2" data-toggle="tab"><b>CSV</b></a></li>
					</ul>
				</div>
				
				<div class="panel-body">
					<div class="tab-content">
					    <!-- Login to LocalHost-->
						<div class="tab-pane fade in active" id="tab1default1">
							You have successfully logged in as LocalHost.
						</div>
						<!-- Upload Files-->
						<div class="tab-pane fade" id="tab2default2">
							<a href="index.php"><button type="button" class="btn btn-primary" style="padding:5px;">Click Here to upload CSV file</button></a>
						</div>
					</div>
				</div>
			</div>	
		</div>
	
		<!-- Source Select-->
		<div class="col-sm-3" style="margin:1px;">
			<div class="panel with-nav-tabs panel-default">
				<div class="panel-heading">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#tab1default" data-toggle="tab"><b>MySQL</b></a></li>
						<li><a href="#tab2default"><b>CSV</b></a></li>
					</ul>
				</div>
				<div class="panel-body"  style="max-height: 350px; overflow-x:hidden; overflow-y: scroll;">
					<div class="tab-content">
						<div class="tab-pane fade in active" id="tab1default">
						<?php
						$link = mysql_connect('localhost', 'root', '');
						$res = mysql_query("SHOW DATABASES");
						$i=0;
						while ($row = mysql_fetch_assoc($res)) {
							echo "<div class='dropdown' style='align:center;'>";
							echo "<button type='button' class='btn btn-primary dropdown-toggle' style='margin:5px; width:95%;' data-toggle='dropdown'>";
							$temp = $row['Database'];
							echo $row['Database']."</br>";
							echo "</button></br>";
							$result = mysql_query("SHOW TABLES FROM {$temp}"); // run the query and assign the result to $result
							echo "<div class='dropdown-menu' style='max-height: 300px; overflow-x:hidden; overflow-y: scroll;'>";
							while ($row = mysql_fetch_row($result)) {
								echo "<button type='button'";
								echo "id='button".$i."'";
								echo "draggable='true' ondragstart='drag(event)' class='btn btn-info' style='margin:5px; width:95%;'>";
								echo "{$row[0]}";
								echo "</buttton>";
								$i++;
							}
							echo "</div></div>";
						}
						?>
						</div>
						<div class="tab-pane fade" id="tab2default"></div>
					</div>
				</div>
			</div>
		</div>
		
	<!-- Visualization-->
    <div class="col-sm-5" style="margin:1px 1px 1px 15px;">
	<div class="panel panel-default">
    <div class="panel-body">
		<div class="container-fluid" style="padding:30px 30px 30px 95px;">
			<button type="button" class="btn" ondrop="drop1(event)" ondragover="allowDrop(event)" style="margin:10px 10px 10px 10px; width:40%" id="tableDrop1">Table 1</button>
			<button type="button" class="btn" ondrop="drop1(event)" ondragover="allowDrop(event)" style="margin:10px 10px 10px 10px; width:40%" id="tableDrop2">Table 2</button>
		</div>
		<div class="container-fluid" style="padding:30px 30px 30px 155px; align:center;">
			<!-- AJAX Request to fetch data of the two tables for shoing column names -->
			<form id="joinTable" method="post">
				<input type="hidden" name="table1" value="" id="tableDrop1input">
				<input type="hidden" name="table2" value="" id="tableDrop2input">
				<button type="submit" style="width:60%;" class="btn" data-toggle="modal" data-target="#myModal1" name="submit">Join</button>
			</form>
			<div class="modal" id="myModal1">
			<div class="modal-dialog">
				<div class="modal-content">

				<!-- Modal Header -->
					<div class="modal-header">
						<h4 class="modal-title"><b>Verify the Primary Key For Joining.</b></h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>

				<!-- Modal body -->
					<div class="modal-body">
						<div class="dropdown" style="margin:10px 10px 10px 160px;">
							<button id="table1" style="width:50%" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
								Primary Key For Table1
							</button>
							<div class="dropdown-menu" id='col1Data'>
								
							</div>
						</div>
						<div class="dropdown" style="margin:10px 10px 10px 160px;">
							<button  id="table2" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" style="width:50%">
								Primary Key For Table2
							</button>
							<div class="dropdown-menu" id='col2Data'>
							</div>
						</div>
					</div>

				<!-- Modal footer -->
					<div class="modal-footer">
						<button onclick="click6(this)" type="button" class="btn btn-danger" data-dismiss="modal">Join</button>
					</div>
				</div>
			</div>
			</div>
		</div>
		<div class="container-fluid" style="padding:30px 30px 30px 155px; align:center;">
			<!-- AJAX Request to fetch data of the two tables for showing column names -->
			<form id="transformTable" method="post">
				<input type="hidden" name="table1" value="" id="tableDrop1transform">
				<input type="hidden" name="table2" value="" id="tableDrop2transform">
				<button type="submit" style="width:60%;" class="btn" data-toggle="modal" data-target="#myModal2" name="submit">Transform</button>
			</form>
			<div class="modal" id="myModal2">
			<div class="modal-dialog">
				<div class="modal-content">

				<!-- Modal Header -->
					<div class="modal-header">
						<h4 class="modal-title"><b>Which transformation you want to apply?</b></h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>

				<!-- Modal body -->
					<div class="modal-body">
						<div class="dropdown" style="margin:10px 10px 10px 150px;">
							<button type="button" id="table3" style="width:60%" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
								Type of Sort
							</button>
							<div class="dropdown-menu">
								<button type="button" id="asc" onclick="click3(this)" class="btn btn-success" style="margin:5px; align:center; width:90%">ASC</button></br>
								<button type="button" id="desc" onclick="click3(this)" class="btn btn-success" style="margin:5px;  align:center; width:90%">DESC</button>
							</div>
						</div>
						<div class="dropdown" style="margin:10px 10px 10px 150px;">
							<button type="button" id="table4" style="width:60%" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
								Base Field
							</button>
							<div class="dropdown-menu" id="col3Data">
							</div>
						</div>
					</div>
					

				<!-- Modal footer -->
					<div class="modal-footer">
						<button onclick="click7(this)" type="button" class="btn btn-danger" data-dismiss="modal">Transform</button>
					</div>
				</div>
			</div>
			</div>
		</div>
		<div class="container-fluid" style="padding:30px 30px 30px 155px; align:center;">
			<button type="button" style="width:60%;" class="btn" data-toggle="modal" data-target="#myModal3">Output File Type</button>
			<div class="modal" id="myModal3">
			<div class="modal-dialog">
				<div class="modal-content">

				<!-- Modal Header -->
					<div class="modal-header">
						<h4 class="modal-title"><b>Select output file type.</b></h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>

				<!-- Modal body -->
					<div class="modal-body">
						<div class="dropdown">
							<button type="button" style="width:30%" id="table5" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
							File Type Options
							</button>
							<div class="dropdown-menu">
								<button type="button" id="csv" onclick="click5(this)" class="btn btn-success" style="margin:5px; align:center; width:90%">CSV</br></button></br>
								<!-- AJAX Request to fetch data of output.csv and displaying it on slider -->
								<form id="sqlData" method="post">
									<input type="hidden" name="table1" value="" id="tableDrop1col">
									<input type="hidden" name="table2" value="" id="tableDrop2col">
									<button type="submit" name="submit" type="button" id="mysql" onclick="click5(this)" class="btn btn-success" style="margin:5px;  align:center; width:90%">MySQL</br></button>
								</form>
							</div>
						</div>
					</div>

				<!-- Modal footer -->
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Submit</button>
					</div>
				</div>
			</div>
			</div>
		</div>
	</div>
	<div class="panel-footer">
		<div class="container-fluid" style="padding:10px 30px 30px 155px; align:center;">
			<!-- AJAX Request to fetch data of queries and download it as output.csv -->
			<form id="mapping" method="get" action="upload3.php">
				<input type="hidden" name="table1" value="" id="tableDrop1map">
				<input type="hidden" name="table2" value="" id="tableDrop2map">
				<input type="hidden" name="joinfield" value="" id="joinfieldinput">
				<input type="hidden" name="joinfield2" value="" id="joinfieldinput2">
				<input type="hidden" name="sortType" value="" id="sortTypeinput">
				<input type="hidden" name="sortfield" value="" id="sortfieldinput">
				<button type="submit" class="btn btn-primary" style="padding:15px;" name="submit">Run the mapping</button>
			</form>
		</div>
	</div>
	</div>
	</div>
  </div>
</div>

</body>
</html>