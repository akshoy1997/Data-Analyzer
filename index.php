<!DOCTYPE html>
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
	
  
  <!-- BootStrap And JQuery Framework-->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	
  <!-- AJAX Code to stop the page from refreshing -->
  <script type="text/javascript">
	$(document).ready(function (e) {
		$("#csvupload").on('submit',(function(e) {
			e.preventDefault();  //If this method is called, the default action of the event will not be 							triggered.
			var data = new FormData(this);
			$.ajax({
				url: "upload.php",
				type: "POST",
				data:  data,
				contentType: false,     //when we send json file we write contentType: 'application/json'
				cache: false,
				processData:false,
				success: function(data){
					$temp = true;
					response = JSON.parse(data);
					$('#BUTTON').html(response['filename']);
					$('#BUTTON').attr("draggable","true");
					$('#tab2default').css("display","block");
					$('#button1').attr("draggable","true");
					$('#button2').attr("draggable","true");
					$('#tableData').html(response['table']);
				},
				error: function(data) {
					alert("Incorrect details. Re-enter your particulars!");
					console.log(data);
				}
			});
		}));
		
		$("#tableSQL").on('submit',(function(e) {
			e.preventDefault();  //If this method is called, the default action of the event will not be 							triggered.
			var data = new FormData(this);
			$.ajax({
				url: "upload5.php",
				type: "POST",
				data:  data,
				contentType: false,     //when we send json file we write contentType: 'application/json'
				cache: false,
				processData:false,
				success: function(data){
					$temp = true;
					response = JSON.parse(data);
					console.log(data);
					$('#button1').html("File");
					$('#button2').html("Transform");
					$('#button3').html("Output As MySQL");
				},
				error: function(data) {
					alert("Incorrect details. Re-enter your particulars!");
					console.log(data);
				}
			});
		}));
		
	});
  </script>
  
  <!-- Drag And Drop Functions -->
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
		var nodeCopy = document.getElementById(data).cloneNode(true);
		nodeCopy.id = "newId";
		ev.target.innerHTML = "File added";
		$("#tableName").val(document.getElementById('BUTTON').innerHTML);
		console.log(document.getElementById('BUTTON').innerHTML);
	}
	
	function drop2(ev) {
		ev.preventDefault();
		var data=ev.dataTransfer.getData("text");
		var nodeCopy = document.getElementById(data).cloneNode(true);
		nodeCopy.id = "newId";
		ev.target.innerHTML = "Transformed";
	}
	function drop3(ev) {
		ev.preventDefault();
		var data=ev.dataTransfer.getData("text");
		var nodeCopy = document.getElementById(data).cloneNode(true);
		nodeCopy.id = "newId";
		ev.target.innerHTML = "Table Created";
	}
  </script>
  
  <!-- Slider JS -->
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
	<div id="mySidenav" class="sidenav" style="width:90%">
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
			<li class="active"><button style="margin-left:1040px;" class="w3-button w3-teal w3-xlarge" id="slider">☰</button></li>
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
						<li><a href="#tab1default1" data-toggle="tab"><b>MySQL</b></a></li>
						<li class="active"><a href="#tab2default2" data-toggle="tab"><b>CSV</b></a></li>
					</ul>
				</div>
				
				<div class="panel-body">
					<div class="tab-content">
					    <!-- Login to LocalHost-->
						<div class="tab-pane fade" id="tab1default1">
							<form action="login.php" method="post">
								<div class="form-group">
									<input type="name" name="host" class="form-control" placeholder="Host">
								</div>
								<div class="form-group">
									<input type="name" name="username" class="form-control" placeholder="UserName">
								</div>
								<div class="form-group">
									<input type="password" name="password" class="form-control" placeholder="Password">
								</div>
								<button type="submit" class="btn btn-danger">Submit</button>
							</form>
						</div>
						<!-- Upload Files-->
						<div class="tab-pane fade in active" id="tab2default2">
							<form method="post" enctype="multipart/form-data" id="csvupload">
								<input type="file" name="MyFile" id="MyFile"/></br>
								<input type="submit" class="btn btn-danger" style="width:100px; length: 40px;" value="Submit" name="submit"/ >
							</form>
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
						<li><a href="#tab1default"><b>MySQL</b></a></li>
						<li class="active"><a href="#tab2default" data-toggle="tab"><b>CSV</b></a></li>
					</ul>
				</div>
				<div class="panel-body">
					<div class="tab-content">
						<div class="tab-pane fade" id="tab1default">You are not logged in.
						Log In to view the files in the LocalHost.</div>
						<div class="tab-pane fade in active" id="tab2default" draggable="false" ondragstart="drag(event)" style="display:none;"><button type="button" class="btn btn-info" id="BUTTON" style="width:95%;">No file uploaded</button></div>
					</div>
				</div>
			</div>
		</div>
	<!-- Visualization-->
    <div class="col-sm-5" style="margin:1px 1px 1px 15px;">
	<div class="panel panel-default">
    <div class="panel-body">
		<div class="container-fluid" style="padding:30px 30px 30px 155px; align:center;">
			<button type="button" id="button1" class="btn" ondrop="drop1(event)" ondragover="allowDrop(event)" style="width:60%;" draggable="false" ondragstart="drag(event)">File</button>
		</div>
		<div class="container-fluid" style="padding:30px 30px 30px 155px; align:center;">
			<button type="button" id="button2" class="btn" ondrop="drop2(event)" ondragover="allowDrop(event)" style="width:60%;" draggable="false" ondragstart="drag(event)">Transform</button>
		</div>
		<div class="container-fluid" style="padding:30px 30px 50px 155px; align:center;">
			<button type="button" id="button3" class="btn" ondrop="drop3(event)" style="width:60%;" ondragover="allowDrop(event)" >Output as MySQL</button>
		</div>
	</div>
	<div class="panel-footer">
		<div class="container-fluid" style="padding:10px 30px 30px 155px; align:center;">
			<form id="tableSQL" method="post">
				<input type="hidden" name="table" value="" id="tableName">
				<button type="submit" class="btn btn-primary" style="padding:15px; margin-top:5px;">Run the Mapping</button>
			<form>
		</div>
	</div>
	</div>
	</div>
	</div>
  </div>
</body>
</html>