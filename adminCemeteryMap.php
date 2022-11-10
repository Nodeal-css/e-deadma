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

                <button class="w3-button w3-bordered w3-right w3-margin-bottom w3-round" onclick="document.getElementById('modal-import-map').style.display='block'" style="background-color: rgb(223, 116, 67);color: white;">Import map layout</button>

                <!-- Start of the Map -->
                <div style="width:100%;height:480px;background-color: #bfcbff;" class="w3-row">
                    <div class="w3-col s9" style="width:700px;margin-right:20px;height:400px;overflow:scroll;">
                    	<div id="workspace">
                    		<img src="" usemap="#map" id="map-pic" onclick="">
                    	</div>
                    </div>
                    <div class="w3-col s3">
                    	<!-- This area or div will show the legends assigned-->
                    </div>
                </div>
                <div>
                	<table>
	                	<tr><td><label>X: </label><input type="text" name="tempX" id="tempX" readonly></td><td><label>Y:</label><input type="text" name="tempY" id="tempY" readonly></td><td></td><td></td><td></td></tr>
	                </table>
                </div>
                <!-- End of the Map -->
            </div>
        </div>
        <!-- End Workspace-->
    </section>

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

<!-- Javascript starts -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
	$(document).ready(function() {
		checkSession();
       	getSession();

		displayImgMap();
	});

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
  	$("#map-pic").mousemove(function(event) {
  		//console.log("X: " + event.offsetX + "\n" + "Y: " + event.offsetY);
  		$("#tempX").val(event.offsetX);
  		$("#tempY").val(event.offsetY);
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
	function displayImgMap(){
	var req = 'request';
		$.ajax({
			type:'post',
			url:'includes/functionLoadMap.php',
			data:{
				request:req
			},
			success:function(result, status){
				var object = JSON.parse(result);
				$("#map-pic").attr("src", object.cemetery_map_img.substring(20));
				
				console.log("output: " + $("#map-pic").attr("src"));
				if($("#map-pic").attr("src") != null){
					getWidthHeight();
				}
			
			}
		});
	}

</script>
<!-- Javascript Ends -->
</body>
</html>