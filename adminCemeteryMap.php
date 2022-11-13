<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" href="css/admin.css">
    
    <!-- Iconscout CSS para sa mga icons ne -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <!-- CSS only -->
    <!--link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"-->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<title>Cemetery Map</title>
	<style>

		/*img[usemap] {
        border: none;
        height: auto;
        max-width: 100%;
        width: auto;
    	}*/

    	#workspace{
            position: relative;
        }
        
	</style>
</head>
<body>
	<!-- Start of the side Navigation -->
	<nav>
        <div class="logo-name">
            <div class="logo-image">
                <img src="assets/KG.png" alt="">
            </div>
            <span class="logo_name">ReConnect</span>
            
        </div>

        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="adminDashboard.php">
                    <i class="uil uil-estate"></i>
                    <span class="link-name">Dashboard</span>
                </a></li>
                <li><a href="adminDeceasedRecords.php">
                    <i class="uil uil-folder"></i>
                    <span class="link-name">Deceased Records</span>
                </a></li>
                <li><a href="adminPlotRecords.php">
                    <i class="uil uil-folder-open"></i>
                    <span class="link-name">Plot Records</span>
                </a></li>
                <li><a href="#">
                    <i class="uil uil-location-point"></i>
                    <span class="link-name">Cemetery Map</span>
                </a></li>
                <li><a href="#">
                    <i class="uil uil-bill"></i>
                    <span class="link-name">Accounting</span>
                </a></li>
            </ul>
            
            <ul class="logout-mode">
                <li><a href="#">
                    <i class="uil uil-signout"></i>
                    <span class="link-name" onclick="logout();">Logout</span>
                </a></li>
            </ul>
            
        </div>
    </nav>
    <!-- End of the side Navigation -->

    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>

            <div class="search-box">
                <input type="text" placeholder="Search by name" id="search-deceased">
                <i class="uil uil-search" style="margin-left: 240px;" onclick=""></i>
            </div>
            <div>
                <p id="active-user" style="float:left;margin-top: 20px;margin-right: 10px;"></p>
                <img src="assets/PP.webp" alt="">
            </div>
        </div>
        <!-- Start Workspace-->
        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="uil uil-estate"></i>
                    <span class="text" id="logo_cem_name">Dashboard / Cemetery Map</span>
                </div>

                <button class="w3-button w3-bordered w3-left w3-margin w3-round" onclick="document.getElementById('modal-import-map').style.display='block'" style="background-color: rgb(223, 116, 67);color: white;">Import map layout</button>

                <!-- Start of the Map -->
                <div style="width:100%;height:480px;" class="w3-row w3-card-4 w3-container">
                    <div class="w3-col s9" style="width:800px;margin-right:20px;height:400px;overflow:scroll;">
                    	<div id="workspace">
                    		<img src="" usemap="#map" id="map-pic" onclick="clickOnImage();">
                    	</div>
                    </div>
                    <div class="w3-col s3">
                    	<!-- This area or div will show the legends assigned-->
                    </div>
                </div>
				
				<div class="w3-row w3-padding-16">
					<div class="w3-col s9" style="font-size: 11px;">
						<table style="border: 0px solid;">
							<tr><td>Properties</td><td></td><td></td><td></td></tr>
							<tr><td></td><td>Point A</td><td>Point B</td><td>Point C</td><td>Point D</td></tr>
							<tr><td><label>X: </label><input type="text" name="tempX" id="tempX" style="border: 0px;width: 90px;" readonly></td><td><label>X: </label><input type="text" name="x1" id="x1" style="border: 0px;width:90px;" readonly></td><td><label>X: </label><input type="text" name="x2" id="x2" style="border: 0px;width:90px;" readonly></td><td><label>X: </label><input type="text" name="x3" id="x3" style="border: 0px;width:90px;" readonly></td><td><label>X: </label><input type="text" name="x4" id="x4" style="border: 0px;width:90px;" readonly></td><td style="width:80px;"></td><td><button class="w3-button w3-right" style="background-color: rgb(223, 116, 67);color: white;" onclick="addCoordinates();">Save Coordinates</button></td></tr>
							<tr><td><label>Y: </label><input type="text" name="tempY" id="tempY" style="border: 0px;width: 90px;" readonly></td><td><label>Y: </label><input type="text" name="y1" id="y1" style="border: 0px;width:90px;" readonly></td><td><label>Y: </label><input type="text" name="y2" id="y2" style="border: 0px;width:90px;" readonly></td><td><label>Y: </label><input type="text" name="y3" id="y3" style="border: 0px;width:90px;" readonly></td><td><label>Y: </label><input type="text" name="y4" id="y4" style="border: 0px;width:90px;" readonly></td><td style="width:80px;"></td><td><button class="w3-button w3-right" style="background-color: #4169e1;color: white;" onclick="clearCoordinates();">Clear</button></td></tr>
						</table>
					</div>
					<div class="w3-col s3"></div>
                </div>
                <!-- End of the Map -->
            </div>
        </div>
        <!-- End Workspace-->
    </section>

<!-- Start of displaying map html -->
<map name="map" id="map-display">
	
</map>
<!-- End of displaying map html -->

<!-- Start Modal for importing a new image for map layout -->
<div id="modal-import-map" class="w3-modal w3-animate-opacity">
	<div class="w3-modal-content">
		<span onclick="document.getElementById('modal-import-map').style.display='none'" style="color: white;background-color: rgb(223, 116, 67);" class="w3-button w3-display-topright">&times;</span>
		<header class="w3-padding" style="background-color: rgb(223, 116, 67);">
			<h2 style="color: white;">Import map layout</h2>
		</header>
		<form id="upload-image-map">
			<div class="w3-center" style="margin-top: 50px; margin-bottom: 50px;">
				<input type="file" name="upload-map" id="upload-map" accept=".jpg, .jpeg, .png">
			</div>
			<div class="w3-center">
				<button id="submit-map" class="w3-button" style="background-color: rgb(223, 116, 67);color: white;">Upload</button>
			</div>
		</form>
	</div>
</div>
<!-- End of Modal for importing a new image for map layout -->

<!-- Start of Modal for opening a grave/block -->
<div class="w3-modal w3-animate-opacity" id="modal-grave">
	<div class="w3-modal-content">
		<span onclick="document.getElementById('modal-grave').style.display='none'" style="color: white;background-color: rgb(223, 116, 67);" class="w3-button w3-display-topright">&times;</span>
		<header class="w3-padding" style="background-color: rgb(223, 116, 67);">
			<h2 style="color: white;">Grave</h2>
		</header>
		<input type="text" name="grave-id" id="grave-id" readonly>
		<button onclick="">Delete</button>
	</div>
</div>
<!-- Start of Modal for opening a grave/block -->

<!-- Javascript starts -->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-imagemapster@1.2.10/dist/jquery.imagemapster.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		checkSession();
       	getSession();

		displayImgMap();
		deleteCacheImages();
		getAllCoordinates();
	});

	//Function to display all the graves using mapster framework |
	//Note: error will occur when image is not yet loaded. So this method is called inside #map-pic onload
	function loadGraves(){
		if($('#map-pic').attr('src') != ""){
			$('#map-pic').mapster({
				areas: [
					{
						key: 'grave',
						fillColor: 'ffffff',
						staticState: true,
						stroke: true,
						strokeColor: '063970',
						strokeWidth: '3'
					}
				],
				mapKey: 'state'
			});
		}else{
			alert('not finished, reloading the page');
			window.location.href ="adminCemeteryMap.php";
		}
	}

	// this function checks for session, will automatically load with the document
	function checkSession(){
		var req = "check";
		$.ajax({
			url:'includes/checkSession.php',
			type:'post',
			data:{
				request:req
			},
			success:function(data, status){
				if(data != 'true'){
					alert('The session is INVALID');

					window.location.href = "adminlogin.php";
				}
			}
		});
	}

	// function for logging out, will unset the session to the server
	function logout(){
		var req = 'logout';
		if(confirm('Proceed signing out?')){
			$.ajax({
				url:'includes/checkSession.php',
				type:'post',
				data:{
					logout:req
				},
				success:function(data, status){
					if(data == 'logout'){
						window.location.href = "adminlogin.php";
					}
				}
			});
		}
	}

  	//Get the session user id and cemetery id to display
  	function getSession(){
  		var check = "req";
  		$.post({
  			url:'includes/getSession.php',
  			data:{
  				request:check
  			},
  			success:function(data, status){
  				var obj = JSON.parse(data);
  				$("#logo_cem_name").html(obj.cemetery_name + " / Cemetery map");
  				$("#active-user").html(obj.name);
            //console.log(obj.name);
            //console.log(obj.cemetery_name);
        	}
    	});
  	}

  	//get the width and height of the map to assign in the #workspace
  	function getWidthHeight(){
  		var w = $("#map-pic").width();
  		var h = $("#map-pic").height();

  		$("#workspace").width(w).height(h);
		console.log("width: " + $("#workspace").width());
  		console.log("height: " + $("#workspace").height());
  	}

  	//Event listener to track the coordinates on moving the mouse inside the image
	var x;
	var y;
  	$("#map-pic").mousemove(function(event) {
  		//console.log("X: " + event.offsetX + "\n" + "Y: " + event.offsetY);
		x = event.offsetX;
		y = event.offsetY;
  	});

	//Function to upload the image-map to the maps folder & cemetery database
	$("#upload-image-map").on("submit", function(e) {
		e.preventDefault();
		var form = document.getElementById('upload-image-map');
		var fdata = new FormData(form);

		$.ajax({
			type:'post',
			url:'includes/uploadMap.php',
			data:fdata,
			contentType: false,
			cache: false,
			processData: false,
			success:function(data, status){
				alert(data);
				$("#upload-map").val(null);
				document.getElementById('modal-import-map').style.display = 'none';
				//Display the new image of the map
				displayImgMap();
			}
		});
	});

	//Function to display the image map on #map-pic. NOTE: include the function after uploading and loading the page.
	// Fix the workspace width and height
	function displayImgMap(){
	var req = 'request';
		$.ajax({
			type:'post',
			url:'includes/functionLoadMap.php',
			async: true,
			data:{
				request:req
			},
			success:function(result, status){
				$("#map-pic").attr("src", result.substring(20));
				
				console.log("output: " + $("#map-pic").attr("src"));
				console.log("status: " + status);
			}
		});
	}
	//Onload of image
	$("#map-pic").ready(function() {
		getWidthHeight();
		
	});

	//Method to delete images that are not found in the database
	function deleteCacheImages(){
		$.ajax({
			type:'post',
			url:'includes/deleteImageMaps.php',
			data:{
				request:'delete'
			},
			success:function(data, status){
				console.log(data);
			}
		});
	}

	//Click on image to populate coordinates in the properties
	function clickOnImage(){
		if(x1.value.length == 0 && x2.value.length == 0 && x3.value.length == 0 && x4.value.length == 0){
			$("#x1").val(x);
			$("#y1").val(y);
		}else if(x2.value.length == 0 && x1.value.length > 0){
			$("#x2").val(x);
			$("#y2").val(y);
		}else if(x3.value.length == 0 && x2.value.length > 0){
			$("#x3").val(x);
			$("#y3").val(y);
		}else if(x4.value.length == 0 && x3.value.length > 0){
			$("#x4").val(x);
			$("#y4").val(y);
		}else{
			alert('Reached the maximum points of adding a block');
		}
	}

	//Clear the input fields of the coordinates by clicking the cear button
	function clearCoordinates(){
		$("#x1").val('');
		$("#y1").val('');
		$("#x2").val('');
		$("#y2").val('');
		$("#x3").val('');
		$("#y3").val('');
		$("#x4").val('');
		$("#y4").val('');
	}

	//Save coordinates to the database
	function addCoordinates(){
		var x1 = $("#x1").val();
		var y1 = $("#y1").val();
		var x2 = $("#x2").val();
		var y2 = $("#y2").val();
		var x3 = $("#x3").val();
		var y3 = $("#y3").val();
		var x4 = $("#x4").val();
		var y4 = $("#y4").val();
		if(x1 != "" && y1 != "" && x2 != "" && y2 != "" && x3 != "" && y3 != "" && x4 != "" && y4 != ""){
			$.ajax({
				type:'post',
				url:'includes/functionInsertCoordinates.php',
				data:{
					req:'insert',
					axis_x1:x1,
					axis_y1:y1,
					axis_x2:x2,
					axis_y2:y2,
					axis_x3:x3,
					axis_y3:y3,
					axis_x4:x4,
					axis_y4:y4
				},
				success:function(result, status){
					alert(result);
					getAllCoordinates();
				}
			});
		}else{
			alert('Sorry, you have entered an incomplete block entry.\nPlease specify the four edges of a block.');
		}
		
		//clear coords at the end
		clearCoordinates();
	}

	//Function that will get the coordinates to display in the map
	function getAllCoordinates(){
		var req = 'request';
		$.ajax({
			type:'post',
			url:'includes/functionGetAllCoordinates.php',
			data:{
				request:req
			},
			success:function(result, status){
				$('#map-display').html(result);
				loadGraves();
			}
		});
	}

	/*Function to open a modal and send the grave id
	function openGraveModal(grave_id){
		document.document.getElementById('modal-grave').style.display = 'block';
		$("#grave-id").val(grave_id);
	}*/

</script>
<!-- Javascript Ends -->
</body>
</html>