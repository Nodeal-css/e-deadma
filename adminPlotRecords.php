<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- CSS  -->
    <link rel="stylesheet" href="css/admin.css">
    
    <!-- Iconscout CSS para sa mga icons ne -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <!-- CSS only -->
    <!--link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"-->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <title>Plot Records</title>
</head>
<body>
<!-- Start of navigation menu -->
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
                <li><a href="#">
                    <i class="uil uil-folder-open"></i>
                    <span class="link-name">Plot Records</span>
                </a></li>
                <li><a href="adminCemeteryMap.php">
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
<!-- Endof navigation menu -->

    <!-- Start of Plot records Dashboard-->
    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>

            <div class="search-box">
                <input type="text" placeholder="Search by name" id="search-deceased">
                <i class="uil uil-search" style="margin-left: 240px;" onclick="searchDeceasedRecords();"></i>
            </div>
            <div>
                <p id="active-user" style="float:left;margin-top: 20px;margin-right: 10px;"></p>
                <img src="assets/PP.webp" alt="">
            </div>
        </div>

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="uil uil-estate"></i>
                    <span class="text" id="logo_cem_name"></span>
                </div>

                <button class="w3-button w3-bordered w3-right w3-margin-bottom w3-round" onclick="document.getElementById('modal-plot-record').style.display='block'" style="background-color: rgb(223, 116, 67);color: white;">Add +</button>

                <!-- Main content -->
                <div id="grid-view">
                    
                </div>
                <!-- Main content -->
            </div>
        </div>
    </section>
<!-- End of Plot records Dashboard-->

<!-- Modal for adding Plot records-->
<div class="w3-modal" id="modal-plot-record">
	<div class="w3-modal-content">
		<span onclick="closeModal();" style="background-color: rgb(223, 116, 67);color:white;" class="w3-button w3-display-topright">&times;</span>
		<header class="w3-padding" style="background-color: rgb(223, 116, 67);">
			<h2 style="color:white;">Add Plot Record</h2>
		</header>
		<div class="w3-row w3-padding">
			<div class="w3-col s5 w3-left" id="plot-info">
				<label class="w3-left">Owner </label><button class="w3-right" id="btn-display-owner">Add new owner</button>
                <input type="text" name="owner-id" id="owner-id">
				<input type="text" class="w3-input" name="owner-find" id="owner-find" autocomplete="off" placeholder="Choose from the dropdown">
				<div id="back-result-owner" style="position:fixed;background-color: white;"></div>
				<label>Date of purchase</label>
				<input type="date" class="w3-input" name="date-purchase" id="date-purchase">
				<label>Purchase price</label>
				<input type="number" class="w3-input" name="purchase-price" id="purchase-price">
				<label>Square meters</label>
				<input type="text" class="w3-input" name="sqr-meters" id="sqr-meters">
			</div>
			<div class="w3-col s6 w3-right" id="owner-info">
				<label>First name</label>
				<input type="text" class="w3-input" name="owner-fname" id="owner-fname" >
				<label>Last name</label>
				<input type="text" class="w3-input" name="owner-lname" id="owner-lname" >
				<label>Middle initial</label>
				<input type="text" class="w3-input" name="owner-mi" id="owner-mi" >
				<label>Street address</label>
				<input type="text" class="w3-input" name="owner-street" id="owner-street" >
				<label>City address</label>
				<input type="text" class="w3-input" name="owner-city" id="owner-city" >
				<label>Zip code</label>
				<input type="text" class="w3-input" name="owner-zip" id="owner-zip" >
				<label>Phone number</label>
				<input type="text" class="w3-input" name="owner-phone" id="owner-phone" >
				<label>Email</label>
				<input type="text" class="w3-input" name="owner-email" id="owner-email">
			</div>
		</div>
		<div class="w3-container">
			<button class="w3-button w3-round w3-right" style="background-color: rgb(223, 116, 67);color: white;" onclick="addPlotRecord();">Save</button>
		</div>
	</div>
</div>
<!-- End of Modal for adding Plot records-->

<!-- Start of Modal for viewing the plot records -->
<div class="w3-modal" id="mdl-view">
    <div class="w3-modal-content">
        <span onclick="closeVWModal();" style="background-color: rgb(223, 116, 67);color:white;" class="w3-button w3-display-topright">&times;</span>
        <header class="w3-padding" style="background-color: rgb(223, 116, 67);">
            <h2 style="color:white;">Plot Ownership</h2>
        </header>
        <div class="w3-row w3-padding">
            <div class="w3-col s6">
                <table class="w3-table">
                    <tr><td></td><td><b>Plot</b></td></tr>
                    <tr><td class="w3-right">Date purchased: </td><td><input type="text" class="w3-input" name="vw-date-purchase" id="vw-date-purchase" style="width:80%;"></td></tr>
                    <tr><td class="w3-right">Price: </td><td><input type="text" class="w3-input" name="vw-price" id="vw-price" style="width:80%;"></td></tr>
                    <tr><td class="w3-right">Status: </td><td><input type="text" class="w3-input" name="vw-status" id="vw-status" style="width:80%;"></td></tr>
                    <tr><td class="w3-right">Square meters: </td><td><input type="text" class="w3-input" name="vw-sqr-meters" id="vw-sqr-meters" style="width:80%;"></td></tr>
                    <tr><td>plot: </td><td><input type="text" class="w3-input" name="vw-plot-id" id="vw-plot-id" style="width:80%;"></td></tr>
                    <tr><td>grave id: </td><td><input type="text" class="w3-input" name="vw-grave-id" id="vw-grave-id" style="width:80%;"></td></tr>
                </table>
                <div class="w3-container w3-center w3-round-xlarge" style="width: 100%;min-height: 190px;background-color: royalblue;">
                    <h4>Cemetery deed...</h4>
                    <div>
                        <div onclick="openPDFwindow();">
                                <iframe src="" id="deed-thumbnail" type="application/pdf" height="180" width="150"></iframe> 
                        </div>
                        <form id="file-upload">
                            <input type="hidden" name="upload-plot-id" id="upload-plot-id">
                            <input type="file" name="upload-pdf" id="upload-pdf" accept="application/pdf">
                            <button type="submit" class="w3-button" id="submit-pdf">Upload</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="w3-col s6">
                <table class="w3-table">
                    <tr><td></td><td><b>Owner</b></td></tr>
                    <tr><td class="w3-right">First name: </td><td><input type="text" class="w3-input" name="vw-fname" id="vw-fname" style="width:80%;"></td></tr>
                    <tr><td class="w3-right">Last name: </td><td><input type="text" class="w3-input" name="vw-lname" id="vw-lname" style="width:80%;"></td></tr>
                    <tr><td class="w3-right">Middle initial: </td><td><input type="text" class="w3-input" name="vw-mi" id="vw-mi" style="width:80%;"></td></tr>
                    <tr><td class="w3-right">Street address: </td><td><input type="text" class="w3-input" name="vw-street" id="vw-street" style="width:80%;"></td></tr>
                    <tr><td class="w3-right">City address: </td><td><input type="text" class="w3-input" name="vw-city" id="vw-city" style="width:80%;"></td></tr>
                    <tr><td class="w3-right">Zip code: </td><td><input type="text" class="w3-input" name="vw-zip" id="vw-zip" style="width:80%;"></td></tr>
                    <tr><td class="w3-right">Phone #: </td><td><input type="text" class="w3-input" name="vw-phone" id="vw-phone" style="width:80%;"></td></tr>
                    <tr><td class="w3-right">Email: </td><td><input type="text" class="w3-input" name="vw-email" id="vw-email" style="width:80%;"></td></tr>
                    <tr><td>owner: </td><td><input type="text" class="w3-input" name="vw-owner-id" id="vw-owner-id" style="width:80%;"></td></tr>
                </table>
            </div>
        </div>
        <div class="w3-container">
            <button class="w3-button w3-round w3-right" style="background-color: rgb(223, 116, 67);color: white;" onclick="">Locate</button>
        </div>
    </div>
</div>
<!-- End of Modal for viewing the plot records -->

<!-- Start of javascript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
	var flag = false;

	$(document).ready(function(){
    	checkSession();
    	findOwner();
   		getSession();
        displayPlotOwnership();
        deleteCache();

   		console.log("flag: " + flag);
   		$("#owner-info").hide();
  	});

	//when button is clicked, the owner fill up form will display
  	$("#btn-display-owner").click(function(){
  		flag = true;
  		$("#owner-info").show();
        $("#owner-find").hide();
        $("#btn-display-owner").hide();
  		console.log("flag: " + flag);
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
  			$("#logo_cem_name").html(obj.cemetery_name + " / Plot Records");
  			$("#active-user").html(obj.name);
            //console.log(obj.name);
            //console.log(obj.cemetery_name);
        }
    });
  }

  //function to search up existing owner record | similar in adminCemetery.php to find cemetery
  //update this function where in the name will bring the owner id during keyup
  function findOwner(){
      $("#owner-find").keyup(function(){
      	$("#back-result-owner").show();
      	var owner = $("#owner-find").val();
      	console.log("owner: " + owner);
        if(owner != ""){
          	$.ajax({
          		url:'includes/functionFindOwner.php',
          		type:'post',
          		data:{
          			owner_name:owner
          		},
          		success:function(data, status){
          			$("#back-result-owner").html(data);
          		}
          	});
        }else{
            $("#back-result-owner").html('');
        }
      });
  }

  	// function to close the search drop down
  	function getOwner(data, id){
		//console.log("getCemetery: " + data;
		$("#owner-find").val(data);
        $("#owner-id").val(id);
		$("#back-result-owner").hide();
	}

  //Create a function that will accept 2 input modes
  //1. For plot ownership that has existing owner records in the database note: hide owner id input
  //2. For new Plot ownerhip and owner information
  //
  //NEXT ASSIGNMENT
  //
  //
  //set ajax functions to async = false 
  //
  //update this function where in the name will bring the owner id during keyup
  //user will have to click the drop down div so that owner_id will output to the #owner-id
  function addPlotRecord(){
    var id = $("#owner-id").val();
    var owner = $("#owner-find").val();
    var date_purchase = $("#date-purchase").val();
    var purchase_price = $("#purchase-price").val();
    var sqr = $("#sqr-meters").val();

    var fname = $("#owner-fname").val();
    var lname = $("#owner-lname").val();
    var mi = $("#owner-mi").val();
    var street = $("#owner-street").val();
    var city = $("#owner-city").val();
    var zip = $("#owner-zip").val();
    var phone = $("#owner-phone").val();
    var email = $("#owner-email").val();

  	if(flag){
  		// for not existing owner record
        addPlotRecord2(fname, lname, mi, street, city, zip, phone, email, date_purchase, purchase_price, sqr);
        displayPlotOwnership();
  	}else{
  		addPlotRecord1(id, owner, date_purchase, purchase_price, sqr);
        displayPlotOwnership();
  	}
    //Refresh the gridView everytime there will be a new record added.
    
  }

  //function for adding non existing owner for plot_ownership table
  function addPlotRecord2(fname, lname, mi, street, city, zip, phone, email, date_purchase, purchase_price, sqr){
    if(fname != "" && lname != "" && mi != "" && street != "" && city != "" && zip != "" && phone != "" && email != "" && date_purchase != "" && purchase_price != "" && sqr != ""){
        $.ajax({
            url:'includes/functionAddPlotRecordMode2.php',
            type:'post',
            data:{
                firstname:fname,
                lastname:lname,
                middle:mi,
                street_address:street,
                city_address:city,
                zip_code:zip,
                phone_no:phone,
                email_address:email,
                date_pur:date_purchase, // plot owner ship
                purch_price:purchase_price,
                ownership:'active',
                sqr_area:sqr
            },
            success:function(data, status){
                //do something
                alert(data);
                flag = false;
                clearInputFields();
                $("#owner-find").show();
                document.getElementById('modal-plot-record').style.display = 'none';
            }
        });
    }else{
        alert('Please input empty fields flag: ' + flag);
    }
  }

  //function for adding existing owner for plot_ownership table
  function addPlotRecord1(id, owner, date_purchase, purchase_price, sqr){
    if(id != "" && owner != "" && date_purchase != "" && purchase_price != "" && sqr != ""){
        $.ajax({
            url:'includes/functionAddPlotRecordMode1.php',
            type:'post',
            data:{
                owner:id,
                date_pur:date_purchase,
                purch_price:purchase_price,
                ownership:'active',
                sqr_area:sqr
            },
            success:function(data, status){
                alert(data);
                //close the modal and clear fields
                flag = false;
                clearInputFields();
                document.getElementById('modal-plot-record').style.display = 'none';
            }
        });
    }else{
        alert('Please input empty fields flag: ' + flag);
    }
  }

  //void method for closing the modal. to reset the contents before opening it once again
  function closeModal(){
    document.getElementById('modal-plot-record').style.display = 'none';
    $("#owner-info").hide();
    $("#owner-find").show();
    $("#back-result-owner").hide();
    $("#btn-display-owner").show();
    flag = false;
    console.log("flag: " + flag);
    clearInputFields();
  }

  //function to clear all the input fields of the modal
  function clearInputFields(){
    $("#owner-id").val('');
    $("#owner-find").val('');
    $("#date-purchase").val('');
    $("#purchase-price").val('');
    $("#sqr-meters").val('');

    $("#owner-fname").val('');
    $("#owner-lname").val('');
    $("#owner-mi").val('');
    $("#owner-street").val('');
    $("#owner-city").val('');
    $("#owner-zip").val('');
    $("#owner-phone").val('');
    $("#owner-email").val('');
    $("#owner-info").hide();
    $("#btn-display-owner").show();
  }

  //display plot_ownership using gridview
  function displayPlotOwnership(){
    $.ajax({
        url:'includes/functionDisplayPlotOwnership.php',
        type:'post',
        data:{
            request:'request'
        },
        success:function(data, status){
            $("#grid-view").html(data);
        }
    });
  }

  //function to populate data in opening #mdl-view
  function openModalView(plot_id, owner_id){
    document.getElementById('mdl-view').style.display = 'block';
    $("#vw-plot-id").val(plot_id);
    $("#vw-owner-id").val(owner_id);
    $("#upload-plot-id").val(plot_id);

    $.ajax({
        url:'includes/functionViewPlot.php',
        type:'post',
        data:{
            plotID:plot_id
        },
        success:function(data, status){
            //console.log(data);
            var obj = JSON.parse(data);
            
            $("#vw-date-purchase").val(obj.date_purchased);
            $("#vw-price").val(obj.purchase_price);
            $("#vw-status").val(obj.ownership_status);
            $("#vw-sqr-meters").val(obj.square_meters);
            $("#vw-grave-id").val(obj.grave_id);

            $("#vw-fname").val(obj.firstname);
            $("#vw-lname").val(obj.lastname);
            $("#vw-mi").val(obj.middle);
            $("#vw-street").val(obj.street_add);
            $("#vw-city").val(obj.city_add);
            $("#vw-zip").val(obj.zip_code);
            $("#vw-phone").val(obj.phone_num);
            $("#vw-email").val(obj.email_address);

            if(obj.pdf_path != null){
                $("#deed-thumbnail").attr("src", obj.pdf_path.substring(20));
                console.log("output: " + $("#deed-thumbnail").attr("src"));
            }
        }
    });
  }
  
  //clear fields on view modal
  //close view modal
  function closeVWModal(){
    $("#vw-date-purchase").val('');
    $("#vw-price").val('');
    $("#vw-status").val('');
    $("#vw-sqr-meters").val('');
    $("#vw-grave-id").val('');

    $("#vw-fname").val('');
    $("#vw-lname").val('');
    $("#vw-mi").val('');
    $("#vw-street").val('');
    $("#vw-city").val('');
    $("#vw-zip").val('');
    $("#vw-phone").val('');
    $("#vw-email").val(''); 
    $("#upload-plot-id").val('');

    $("#deed-thumbnail").attr("src", "");
    $("#upload-pdf").val(null);
    document.getElementById('mdl-view').style.display = 'none';
  }

  //function to upload pdf file
  //Assignment:
  //Update this part wherein after insert - will change the appearance of document field - display pdf
  //Note: that there's only one document per plot_record
  //
  //ATTENTION: 
  //MUST delete multiple files if not associated to the records in the database
  //created deletion event - pls try to test next session
  $("#file-upload").on('submit', function(e) {
    e.preventDefault();
    var form = document.getElementById('file-upload');
    var fdata = new FormData(form);
    
    $.ajax({
        type:'post',
        url:'includes/uploadPDF.php',
        data:fdata, 
        contentType: false,
        cache: false,
        processData:false,
        success:function(data, status){
            alert(data);
            $("#upload-pdf").val(null);
            openModalView(plot, $("#vw-owner-id").val());
            //closeVWModal();
        }
    });
  });

  //An onclick function to open a pdf file to another window
  function openPDFwindow(){
    var pdfPath = $("#deed-thumbnail").attr("src");
    if(pdfPath != ""){
        window.open(pdfPath, '_blank');
    }
  }

  //function to delete pdf files in the documents folder to avoid duplication
  function deleteCache(){
    $.ajax({
        type:'post',
        url:'includes/deletePDF.php',
        data:{
            request:'delete'
        },
        success:function(data, status){
            console.log(data);
        }
    });
  }

</script>
<!-- End line of javascript -->
</body>
</html>