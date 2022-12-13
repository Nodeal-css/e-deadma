<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" href="css/admin.css?v=<?php echo time(); ?>">
    
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
            <span class="logo_name">Grave.ly</span>
            
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
                <li><a href="adminAccounting.php">
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
                <input type="hidden" placeholder="Search by id" id="search-grave">
				<input type="text" placeholder="Search by name" id="search-name">
                <i class="uil uil-search" style="margin-left: 240px;" onclick="searchGraveName();"></i>
            </div>
            <div>
                <p id="active-user" style="float:left;margin-top: 20px;margin-right: 10px;"></p>
                <img src="assets/adminprofile.png" alt="">
            </div>
        </div>
        <!-- Start Workspace-->
        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="uil uil-estate"></i>
                    <span class="text" id="logo_cem_name">Dashboard / Cemetery Map</span>
                </div>

				

                <!-- Start of the Map -->
                <div style="width:100%;height:480px;" class="w3-row w3-card-4 w3-container">
					<div class='w3-bar' style="width: 80%;">
						<button class="w3-button w3-bar-item w3-left w3-margin-top w3-animate-bottom" onclick="document.getElementById('modal-import-map').style.display='block'" style="background-color: rgb(223, 116, 67);color: white;">Import map layout</button>
						<button class="w3-button w3-bar-item w3-left w3-margin-top w3-animate-bottom" onclick="checkVacantGrave();" style="background-color: rgb(223, 116, 67);color: white;">Check vacant graves</button>
						<button class="w3-button w3-bar-item w3-left w3-margin-top w3-animate-bottom" onclick="location.reload();" style="background-color: rgb(223, 116, 67);color: white;">Reload Map</button>
						<button class="w3-button w3-bar-item w3-right w3-margin-top w3-animate-bottom" onclick="zoomIn();">+</button>
						<button class="w3-button w3-bar-item w3-right w3-margin-top w3-animate-bottom" onclick="zoomOut();">-</button>
					</div>
                    <div class="w3-col s9" style="width: 80%; margin-right:20px;height:400px;overflow:scroll;">
						<div id="workspace">
						<!--canvas id="canvas"-->
                    		<img src="" usemap="#map" id="map-pic" onclick="clickOnImage();">
						<!--/canvas-->
                    	</div>
                    </div>
                    <div class="w3-col s3" style="width: 17%;">
                    	<!-- This area or div will show the legends assigned-->
						<div class="w3-card-2">
							<h4 class="w3-center" >Legend</h4>
							<table class="w3-table">
								<tr>
									<td><button class="w3-button w3-indigo w3-hover-indigo"></button></td>
									<td>Grave</td>
								</tr>
								<tr>
									<td><button class="w3-button w3-green w3-hover-green"></button></td>
									<td>Vacant</td>
								</tr>
								<tr>
									<td><button class="w3-button w3-red w3-hover-red"></button></td>
									<td>Occupied</td>
								</tr>
								<tr>
									<td><button class="w3-button w3-yellow w3-hover-yellow"></button></td>
									<td>Search</td>
								</tr>
							</table>
						</div>
                    </div>
                </div>
				
				<div class="w3-row w3-padding-16">
					<div class="w3-col s9" style="font-size: 11px;">
						<table style="border: 0px solid;">
							<tr><td>Properties</td><td></td><td></td><td></td></tr>
							<tr><td></td><td>Point A</td><td>Point B</td><td>Point C</td><td>Point D</td></tr>
							<tr><td><input type="hidden" name="tempX" id="tempX" style="border: 0px;width: 90px;" readonly></td><td><label>X: </label><input type="text" name="x1" id="x1" style="border: 0px;width:90px;" readonly></td><td><label>X: </label><input type="text" name="x2" id="x2" style="border: 0px;width:90px;" readonly></td><td><label>X: </label><input type="text" name="x3" id="x3" style="border: 0px;width:90px;" readonly></td><td><label>X: </label><input type="text" name="x4" id="x4" style="border: 0px;width:90px;" readonly></td><td style="width:80px;"></td><td><button class="w3-button w3-right" style="background-color: rgb(223, 116, 67);color: white;" onclick="addCoordinates();">Save Coordinates</button></td></tr>
							<tr><td><input type="hidden" name="tempY" id="tempY" style="border: 0px;width: 90px;" readonly></td><td><label>Y: </label><input type="text" name="y1" id="y1" style="border: 0px;width:90px;" readonly></td><td><label>Y: </label><input type="text" name="y2" id="y2" style="border: 0px;width:90px;" readonly></td><td><label>Y: </label><input type="text" name="y3" id="y3" style="border: 0px;width:90px;" readonly></td><td><label>Y: </label><input type="text" name="y4" id="y4" style="border: 0px;width:90px;" readonly></td><td style="width:80px;"></td><td><button class="w3-button w3-right" style="background-color: #4169e1;color: white;" onclick="clearCoordinates();">Clear</button></td></tr>
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
	<div class="w3-modal-content" style="width: 50%;">
		<span onclick="closeGraveModal();" style="color: white;background-color: rgb(223, 116, 67);" class="w3-button w3-display-topright">&times;</span>
		<header class="w3-padding" style="background-color: rgb(223, 116, 67);">
			<h2 style="color: white;">Grave</h2>
		</header>
		<!-- Start modal Main Content -->
		<div class="w3-bar" style="color: white;background-color: rgb(223, 116, 67);">
			<button id="load-Deceased" class="w3-bar-item w3-button" onclick="loadDeceasedModal();" style="color: white;background-color: rgb(223, 116, 67);">Deceased</button>
			<button id="load-Plot" class="w3-bar-item w3-button" onclick="loadPlotModal();" style="color: white;background-color: rgb(223, 116, 67);">Plot record</button>
		</div>
			<div id="modal-deceased-record" class="w3-container w3-border city" style="display:none;max-height: 270px;overflow:scroll;">
				
			</div>
			<div id="modal-plot-owner" class ="w3-container w3-border city"  style="display:none;height: 270px;">
				
			</div>
			<div id="modal-assign-deceased" class="w3-container w3-border city" style="display:none;height: 270px;">
				<input type="hidden" name='modal-deceased-id' id='modal-deceased-id' readonly>
				<input type="text" class="w3-input" name='modal-find-deceased' id='modal-find-deceased' placeholder='Search name of the deceased'>
				<div id="deceased-result" style="position:fixed;background-color: white;"></div>
				<button onclick="placeDeceasedToGrave();" class="w3-button w3-round-xxlarge w3-right w3-margin" style="color: white;background-color: rgb(223, 116, 67);">Save</button>
				<div>	
					<p class="w3-center" style="margin-top: 60px; margin-left: 90px;cursor: pointer;" onclick="redirectDeceasedPage();">Deceased record not found?</p>
				</div>
			</div>
			<div id="modal-assign-plot" class="w3-container w3-border city" style="display:none;height: 270px;">
				<input type="hidden" name="modal-plot-id" id="modal-plot-id" readonly>
				<input type="text" class="w3-input" name="modal-owner-name" id="modal-owner-name" placeholder="Search name of the Plot owner">
				<div id="plot-result" style="position:fixed;background-color: white;"></div>
				<button onclick="placePlotToGrave();" class="w3-button w3-round-xxlarge w3-right w3-margin w3-indigo" style="color: white;">Save</button>
				<div>
					<p class="w3-center" style="margin-top: 60px; margin-left: 90px;cursor: pointer;" onclick="redirectPlotPage();">Burial record not found?</p>
				</div>
			</div>
		<!-- End modal Main Content -->
		<div class="w3-container" id="modal-footer">
			<input type="hidden" name="grave-id" id="grave-id">
			<button onclick="deleteBlock();" class="w3-button w3-right w3-margin w3-red w3-round-xxlarge">Remove Grave</button>
		</div>
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
		findDeceasedModal();
		findOwnerModal();
		displayImgMap();
		deleteCacheImages();
		checkOpenGrave();
	});
	//window.setTimeout(checkOpenGrave(), 9000); MIGHT Transfer this to pure php code
	//Onload of image
	$("#map-pic").on('load', function() {
		var id = localStorage.getItem('grave-id');
		if(id != ""){
			searchGrave(id);
		}else{
			getAllCoordinates();
		}
		
		getWidthHeight();
	});
	
	//this function will check if opening this page is from adding deceased records
	function checkOpenGrave(){
		var urlstr = window.location.search;
		if(urlstr != null){
			var req = new URLSearchParams(urlstr);
			var grave_id = req.get('graveid');
			if(grave_id != null && req.get('request') == 'deceased'){
				console.log("grave id: " + grave_id);
				console.log("request: " + req.get('request'));
				openGraveModal(grave_id);
				loadAssignDeceased();
			}else if(req.get('grave-id') != null && req.get('request') == 'plot'){
				console.log("grave id: " + req.get('grave-id'));
				console.log("request: " + req.get('request'));
				openGraveModal(req.get('grave-id'));
				loadAssignPlot();
			}
		}
	}

	//Function for receiving localStorage of grave_id data from deceased and plot page

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
						},
						{
							key: 'search-grave',
							fillColor: 'ffffff',
							staticState: true,
							stroke: true,
							strokeColor: 'fcba03',
							strokeWidth: '3'
						},
						{
							key: 'vacant',
							fillColor: 'ffffff',
							staticState: true,
							stroke: true,
							strokeColor: '078200',
							strokeWidth: '3'
						},
						{
							key: 'occupied',
							fillColor: 'ffffff',
							staticState: true,
							stroke: true,
							strokeColor: 'fc2003',
							strokeWidth: '3'
						}
					],
					mapKey: 'state'
				});
				localStorage.removeItem('grave-id');
			}else{
				alert('not finished, reloading the page');
				//window.location.href ="adminCemeteryMap.php";
				location.reload();
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
		$("#canvas").width(w).height(h);
		console.log("width: " + w);
  		console.log("height: " + h);
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
				location.reload();
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
			data:{
				request:req
			},
			success:function(result, status){
				//$("#map-pic").attr("src", result.substring(20));
				document.getElementById('map-pic').src = result.substring(20);
				console.log("output: " + result.substring(20));
				console.log("status: " + status);
			}
		});
	}

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

	//Function to open a modal and send the grave id
	//This function is under developed | this is meant to populated with info about the deceased and plot owner if available
	function openGraveModal(grave_id){
		document.getElementById('modal-grave').style.display = 'block';
		$("#grave-id").val(grave_id);
		loadDeceasedModal();
	}

	//function to close the #modal-grave | clear the fields
	function closeGraveModal(){
		document.getElementById('modal-grave').style.display = 'none';
		document.getElementById('modal-deceased-record').style.display = 'none';
		document.getElementById('modal-plot-owner').style.display = 'none';
		$("#grave-id").val('');
		$("#modal-deceased-id").val('');
	}

	//Function to search a specific grave and load new element inside #map-display 
	//Change the function to be able to search by name of the deceased or grave id
	function searchGrave(grave_id){
		//var grave_id = $("#search-grave").val();
		//console.log('grave_id: ' + grave_id);
		$.ajax({
			type:'post',
			url:'includes/functionGetAllCoordinates.php',
			data:{
				grave:grave_id
			},
			success:function(result, status){
				$("#map-display").html(result);
				loadGraves();
				//focus(grave_id);
				$("#search-grave").val('');
			}
		});
	}

	//Function to re-layer the mapster to red and green if it is vacant or occupied | on button click
	function checkVacantGrave(){
		var request = 'vacancy';
		$.ajax({
			type:'post',
			url:'includes/functionGetAllCoordinates.php',
			data:{
				vacancy:request
			},
			success:function(result, status){
				$("#map-display").html(result);
				loadGraves();
				//console.log(result);
			}
		});
	}

	//Function to delete a grave/block | done inside the modal
	//set the grave_id of both deceased & plot_ownership table to null in able to fully delete 
	//without restraints. PROMPT the changes, to inform the user.
	function deleteBlock(){
		var block = $("#grave-id").val();
		$.ajax({
			type:'post',
			url:'includes/functionDeleteGrave.php',
			data:{
				grave_id:block
			},
			success:function(result, status){
				alert(result);
				$("#grave-id").val('');
				document.getElementById('modal-grave').style.display = 'none';
				getAllCoordinates();
			}
		});
	}

	//START OF MODAL JAVASCRIPT ----------------------------
	//function to load the deceased records inside the grave
	// Assign the maximum width of this div element
	function loadDeceasedModal(){
		document.getElementById('modal-deceased-record').style.display = 'block';
		document.getElementById('modal-plot-owner').style.display = 'none';
		document.getElementById('modal-assign-deceased').style.display = 'none';
		document.getElementById('modal-assign-plot').style.display = 'none';

		var block = $("#grave-id").val();
		$.ajax({
			type:'post',
			url:'includes/populateModalDeceased.php',
			data:{
				grave_id: block
			},
			success:function(result, status){
				$("#modal-deceased-record").html(result);
			}
		});
	}

	//function to load the plot record of the grave
	function loadPlotModal(){
		document.getElementById('modal-deceased-record').style.display = 'none';
		document.getElementById('modal-plot-owner').style.display = 'block';
		document.getElementById('modal-assign-deceased').style.display = 'none';
		document.getElementById('modal-assign-plot').style.display = 'none';

		var block = $("#grave-id").val();
		$.ajax({
			type:'post',
			url:'includes/populateModalPlot.php',
			data:{
				grave_id:block
			},
			success:function(result, status){
				$("#modal-plot-owner").html(result);
			}
		});
		
	}

	//function to load the dropdown element of finding the deceased for #modal-assign-deceased
	function findDeceasedModal(){
		$("#modal-find-deceased").keyup(function() {
			$("#deceased-result").show();
				var name = $("#modal-find-deceased").val();
				console.log("name: " + name);
				if(name != ""){
					$.ajax({
						type:'post',
						url:'includes/functionFindDeceased_Plot.php',
						data:{
							deceased:name
						},
						success:function(result, status){
							$("#deceased-result").html(result);
						}
					});
				}else{
					$("#deceased-result").html('');
				}
		});
		
	}
	// Assign the deceased_id to the hidden input field
	function getDeceasedId(name, id){
		$("#modal-deceased-id").val(id);
		$("#modal-find-deceased").val(name);
		$("#deceased-result").hide();
	}

	//Function to show the dropdown element when searching for the owner's name
	function findOwnerModal(){
		$("#modal-owner-name").keyup(function() {
			$("#plot-result").show();
			var name = $("#modal-owner-name").val();
			console.log("owner: " + name);
			if(name != ""){
				$.ajax({
					type:'post',
					url:'includes/functionFindDeceased_Plot.php',
					data:{
						owner:name
					},
					success:function(result, status){
						$("#plot-result").html(result);
					}
				});
			}else{
				$("#plot-result").html('');
			}
		});
	}
	//Assign the plot_id to the input field
	function getPlotId(data, id){
		$("#modal-plot-id").val(id);
		$("#modal-owner-name").val(data);
		$("#plot-result").hide();
	}

	//function to load the #modal-assign-deceased
	function loadAssignDeceased(){
		document.getElementById('modal-deceased-record').style.display = 'none';
		document.getElementById('modal-plot-owner').style.display = 'none';
		document.getElementById('modal-assign-deceased').style.display = 'block';
		document.getElementById('modal-assign-plot').style.display = 'none';
		$("#modal-deceased-id").val('');
		$("#modal-find-deceased").val('');
		$("#deceased-result").hide();
	}
	//function to load the #modal-assign-plot
	function loadAssignPlot(){
		document.getElementById('modal-deceased-record').style.display = 'none';
		document.getElementById('modal-plot-owner').style.display = 'none';
		document.getElementById('modal-assign-deceased').style.display = 'none';
		document.getElementById('modal-assign-plot').style.display = 'block';
		$("#modal-plot-id").val('');
		$("#modal-owner-name").val('');
		$("#plot-result").hide();
	}

	//function to update the grave_id of deceased record
	function placeDeceasedToGrave(){
		var block = $("#grave-id").val();
		var id = $("#modal-deceased-id").val();
		if(id != ""){
			$.ajax({
				type:'post',
				url:'includes/functionUpdateDeceasedGrave.php',
				data:{
					grave:block,
					deceased:id
				},
				success:function(result, status){
					alert(result);
					loadDeceasedModal();
				}
			});
		}else{
			alert('Please click the deceased name');
		}
	}

	//function to update the grave_id of plot_ownership record
	//in the next session re-evaluate if we want to delete the current
	//plot record to this modal or just update it | Create event instead
	function placePlotToGrave(){
		var block = $("#grave-id").val();
		var plot_id = $("#modal-plot-id").val();
		if(plot_id != ""){
			$.ajax({
				type:'post',
				url:'includes/functionUpdateDeceasedGrave.php',
				data:{
					block_id:block,
					plot:plot_id
				},
				success:function(result, status){
					alert(result);
					loadPlotModal();
				}
			});
		}else{
			alert('Please click the Plot ownership drop down');
		}
	}

	//Redirect to deceased records page to add a new record
	function redirectDeceasedPage(){
		var request = 'addrecord';
		var grave_id = $("#grave-id").val();
		window.location.href = 'adminDeceasedRecords.php?request=' + request + "&grave=" + grave_id;
	}

	//Redirect to plot records page to add new record
	function redirectPlotPage(){
		var request = 'addplot';
		var grave_id = $("#grave-id").val();
		window.location.href = 'adminPlotRecords.php?request=' + request + '&graveid=' + grave_id;
	}

	var zoomlvl = 1; 
	var container = document.getElementById('workspace');
	//Workspace zoom in
	function zoomIn(){
		if(zoomlvl < 1.9){
			zoomlvl += 0.1;
			container.style.transition = 'transform 1.0s';
			container.style.transform = `scale(${zoomlvl})`;
		}
	}
	//Workspace zoom out
	function zoomOut(){
		if(zoomlvl > 0.6){
			zoomlvl -= 0.1;
			container.style.transition = 'transform 1.0s';
			container.style.transform = `scale(${zoomlvl})`;
		}
	}

	//Focus on a specific grave
	function focus(grave_id){
		zoomlvl = 1.0;
		var width = $("#map-pic").width();
  		var height = $("#map-pic").height();

		$.ajax({
			type:'post',
			url:'includes/searchGrave.php',
			data:{
				grave:grave_id
			},
			success:function(result, status){
				var obj = JSON.parse(result);
				var left = '-' + ((obj.x1 / width) * 100) + '%';
				var top = '-' + ((obj.y1 / height) * 100) + '%';
				var right = 100 - ((obj.x1 / width) * 100) + '%';
				var bottom = 100 - ((obj.y1 / height) * 100) + '%';
				console.log("top: " + top);
				console.log("left: " + left);
				console.log("right: " + right);
				console.log("bottom: " + bottom);
				container.style.top = top;
        		container.style.left = left;
				container.style.right = right;
				container.style.bottom = bottom;
        		container.style.transform = `scale(${zoomlvl})`;
			}
		});

    }

	//search grave by deceased name
	function searchGraveName(){
		var name = $("#search-name").val();
		//console.log('grave_id: ' + grave_id);
		$.ajax({
			type:'post',
			url:'includes/functionFindGraveByName.php',
			data:{
				search_name:name
			},
			success:function(result, status){
				$("#map-display").html(result);
				loadGraves();
				//focus(grave_id);
				
			}
		});
	}

	//Updating the deceased_record's grave_id to null
	//loadDeceasedModal()
	function removeDeceasedInGrave(deceased_id){
		if(confirm("Are you sure you want to remove this record in the grave?")){
			$.ajax({
				type: 'post',
				url: 'includes/removeRecordFromGrave.php',
				data: {
					deceased: deceased_id
				}, 
				success:function(result, status){
					alert(result);
					loadDeceasedModal();
				}
			});
		}
	}

	//updating the plot_record's grave_id to null
	//loadPlotModal()
	function removePlotInGrave(plot_id){
		if(confirm("Are you sure you want to remove this plot record in the grave?")){
			$.ajax({
				type: 'post',
				url: 'includes/removeRecordFromGrave.php',
				data: {
					plot: plot_id
				}, 
				success:function(result, status){
					alert(result);
					loadPlotModal();
				}
			});
		}
	}

// start javascript for canvas


// end javascript for canvas

// End of #modal-grave javascript
</script>
<!-- Javascript Ends -->
</body>
</html>