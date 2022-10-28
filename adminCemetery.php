<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Cemetery</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</head>
<body>
<!-- header starts-->
	<header class="" style="position: fixed;background-color: lightcoral;height: 50px;width: 100%;">
		<nav class="nav" style="float: right;">
			<a class="nav-link active" aria-current="page" href="#">Active</a>
			<a class="nav-link" href="#">Link</a>
			<button id="btnlogout" name="btnlogout" onclick="logout();"> Sign Out</button>
		</nav>
	</header>
<!-- Header ends -->

<!-- Main starts-->
<!-- Review this part | Date: OCT 16, 2022


	We left to this part

-->
	<main class="flex-grow-1" style="background: url('assets/body.png');background-repeat: no-repeat; background-size: 100% 100%;height: 100%;width: 100%;position: absolute;z-index: -1;">
		<div class="container" style="margin-top:70px;">
			<div class="d-flex justify-content-center" style="height:auto;">
				<div class="card text-center">
				  <h5 class="card-header">Are you an employee of a cemetery?</h5>
				  <div class="card-body">
				    <h5 class="card-title">Select Cemetery</h5>
				    <input type="text" name="cemetery-search" id="cemetery-search" placeholder="Search Cemetery" class="form-control">
				    <div id="back_result" style="position:fixed;background-color: white;"></div><br>
					<input type="password" name="pass-code" id="pass-code" placeholder="Passcode" class="form-control" style="width:100%;">
				    <p class="card-text">If the cemetery has not been added to our database,<br> please add a new cemetery</p>
				    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAddCemetery">New Cemetery</button>
				    <br>
				    <button class="btn btn-primary mt-5" onclick="updateCemID();" id="btnNext">Next</button>
				  </div>
				</div>
			</div>
		</div>
	</main>
<!-- header ends-->

<!-- Modal to add a new cemetery -->
<div class="modal fade" id="modalAddCemetery" tabindex="-1" role="dialog" aria-labelledby="modalAddCemetery" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalAddCemetery">Cemetery details</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
        	<input type="text" id="cemetery-name" class="form-control mb-2" name="cemetery-name" placeholder="Name of the cemetery">
        	<input type="text" id="street" class="form-control mb-2" name="street" placeholder="Street address">
        	<input type="text" id="city" class="form-control mb-2" name="city" placeholder="City address">
        	<input type="text" id="zip" class="form-control mb-2" name="zip" placeholder="Zip code">
        	<select class="form-select mb-2" id="select-cemetery-type">
				<option value="PRIVATE">Private Cemetery</option> 
				<option value="PUBLIC">Public Cemetery</option>
        	</select>
        	<input type="password" id="pass-code-add-cemetery" class="form-control mb-2" name="pass-code-add-cemetery" placeholder="Pass code">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Clear</button>
        <button type="button" class="btn btn-primary" onclick="addCemetery();">Save changes</button>
      </div>
    </div>
  </div>
</div>
<!-- END Modal to add a new cemetery -->

<!-- Javascript load last -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
	$(document).ready(function(){
		searchCemetery();
		checkSession();
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
        if(data != 'pick'){
          alert('The session is INVALID');
          
          window.location.href = "adminlogin.php";
        }
      }
    });
  	}
	
	function addCemetery(){
		var cemetery = $("#cemetery-name").val();
		var street = $("#street").val();
		var city = $("#city").val();
		var zip = $("#zip").val();
		var type = $("#select-cemetery-type").val();
		var pass_code = $("#pass-code-add-cemetery").val();

		if(cemetery != "" || street != "" || city != "" || zip != "" || type != "" || pass_code != ""){
			$.ajax({
				url:'includes/functionAddCemetery.php',
				type:'post',
				data:{
					addRequest:'addRequest',
					cemetery_name:cemetery,
					street_address:street,
					city_address:city,
					zip_code:zip,
					cemetery_type:type,
					passcode:pass_code
				},
				success:function(data, status){
					if(data == 'submitted'){
						alert('submitted');
						$("#modalAddCemetery").modal('hide');
					}else{
						console.log(data);
					}
				}
			});
		}else{
			alert("Please fill up username and password");
		}
	}

	function searchCemetery(){
		$("#cemetery-search").keyup(function(){
			$("#back_result").show();
			var cemetery = $("#cemetery-search").val();
			console.log("cemetery-search: " + cemetery);
			$.ajax({
				url:'includes/functionSearchCemetery.php',
				type:'post',
				data:{
					cem:cemetery
				},
				success:function(data, status){
					$("#back_result").html(data);
				}
			});
		});
	}


	function getCemetery(data){
		//console.log("getCemetery: " + data;
		$("#cemetery-search").val(data);
		$("#back_result").hide();
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

	// function to initialize the cemetery_id for authorized users who dont have cemetery_id
	function updateCemID(){
		var cemetery = $("#cemetery-search").val();
		var passcode = $("#pass-code").val();
		if(cemetery != "" && passcode != ""){
			$.ajax({
				url:'includes/functionUpdateCemID.php',
				type:'post',
				data:{
					cem:cemetery,
					pass:passcode
				},
				success:function(data, status){
					if(data == 'updated'){
						window.location.href = "adminDashboard.php";
					}else{
						console.log(data);
						alert('Cemetery name or Passcode is incorrect');
					}
					//console.log("update: " + data);
					//do something
					//go to dashboard
					//and enable session for cemetery_id
				}
			});
		}else{
			alert("Please fill empty fields");
		}
	}
</script>
</body>
</html>