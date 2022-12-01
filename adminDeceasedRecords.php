<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- CSS  -->
    <link rel="stylesheet" href="css/admin.css?v=<?php echo time(); ?>">
    
    <!-- Iconscout CSS para sa mga icons ne -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <!-- CSS only -->
    <!--link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"-->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <title>Deceased Records</title>
</head>
<body>
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
                <li><a href="#">
                    <i class="uil uil-folder"></i>
                    <span class="link-name">Deceased Records</span>
                </a></li>
                <li><a href="adminPlotRecords.php">
                    <i class="uil uil-folder-open"></i>
                    <span class="link-name">Plot Records</span>
                </a></li>
                <li><a href="adminCemeteryMap.php">
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

    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>

            <div class="search-box">
                <input type="text" placeholder="Search by name" id="search-deceased">
                <i class="uil uil-search" style="margin-left: 240px;" onclick="searchDeceasedRecords();"></i>
            </div>
            <div>
                <p id="active-user" style="float:left;margin-top: 20px;margin-right: 10px;"></p>
                <img src="assets/adminprofile.png" alt="">
            </div>
        </div>

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="uil uil-estate"></i>
                    <span class="text" id="logo_cem_name">Dashboard</span>
                </div>

                <div class='w3-bar'>
                    <button class="w3-button w3-left w3-margin-bottom w3-bar-item" onclick="modalInsertDeceased();" style="background-color: rgb(223, 116, 67);color: white;">Add</button>
                    <button class="w3-button w3-left w3-margin-bottom w3-bar-item" style="background-color: rgb(223, 116, 67);color: white;" onclick="getDeceasedExceed();">Exceed 5 yrs</button>
                    <button class="w3-button w3-left w3-margin-bottom w3-bar-item" style="background-color: rgb(223, 116, 67);color: white;" onclick="getDeceasedNullGraveId();">Not in Map</button>
                </div>
                <div>
                    <table class="w3-table">
                    	<thead>
                    		<tr><th>First name</th><th>Last name</th><th>Middle Initial</th><th>Date of Burial</th><th>Date of Birth</th><th>Marital status</th><th>Age</th><th>Epitaph</th></tr>
                    	</thead>
                    	<tbody id="table-body">
                    		
                    	</tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal for Inserting deceased records -->
    <div id="modal-insert" class="w3-modal">
        <div class="w3-modal-content">
            <span id="close-modal-insert" onclick="document.getElementById('modal-insert').style.display='none'" style="color: white;background-color: rgb(223, 116, 67);" class="w3-button w3-display-topright">&times;</span>
            <header class="w3-padding" style="background-color: rgb(223, 116, 67);">
                <h2 style="color:white;">Deceased person</h2>
            </header>
            <div class="w3-padding w3-row">
                <div class="w3-col s3">
                    <p style="padding-top: 17px;">First name</p>
                    <p style="padding-top: 17px;">Last name</p>
                    <p style="padding-top: 17px;">Middle initial</p>
                    <p style="padding-top: 17px;">Date of burial</p>
                    <p style="padding-top: 17px;">Date of birth</p>
                    <p style="padding-top: 17px;">Marital status</p>
                    <p style="padding-top: 17px;">Age</p>
                    <p style="padding-top: 17px;">Epitaph</p>
                </div>
                <div class="w3-col s9">
                    <input type="text" id="first-name" name="first-name" class="w3-input" required>
                    <input type="text" id="last-name" name="last-name" class="w3-input" required>
                    <input type="text" id="middle-initial" name="middle-initial" class="w3-input" required>
                    <input type="date" id="burial-date" name="burial-date" class="w3-input" required>
                    <input type="date" id="birth-date" name="birth-date" class="w3-input" required>
                    <select class="w3-select" id="marital-status" name="marital-status">
                      <option value="" disabled selected>Choose your option</option>
                      <option value="Married">Married</option>
                      <option value="Widowed">Widowed</option>
                      <option value="Separated">Separated</option>
                      <option value="Divorced">Divorced</option>
                      <option value="Single">Single</option>
                  </select>
                  <input type="number" id="age" name="age" class="w3-input" required>
                  <input type="text" id="epitaph" name="epitaph" class="w3-input" required>
              </div>
          </div>
          <div class="w3-container">
            <button class="w3-button w3-right" id="btn-insert-deceased" onclick="addDeceasedRecords();" style="background-color: rgb(223, 116, 67);color: white;">Add +</button>
        </div>
    </div>
</div>
<!-- End of Modal for Inserting deceased records -->

<!-- Modal for Updating deceased records-->
<div id="modal-update" class="w3-modal">
    <div class="w3-modal-content">
        <span onclick="document.getElementById('modal-update').style.display='none'" style="color: white;background-color: rgb(223, 116, 67);" class="w3-button w3-display-topright">&times;</span>
        <header class="w3-padding" style="background-color: rgb(223, 116, 67);">
            <h2 style="color:white;">Edit Deceased Record</h2>
        </header>
        <div class="w3-row w3-padding">
            <div class="w3-col s3">
                <p style="padding-top: 17px;">First name</p>
                <p style="padding-top: 17px;">Last name</p>
                <p style="padding-top: 17px;">Middle initial</p>
                <p style="padding-top: 17px;">Date of burial</p>
                <p style="padding-top: 17px;">Date of birth</p>
                <p style="padding-top: 17px;">Marital status</p>
                <p style="padding-top: 17px;">Age</p>
                <p style="padding-top: 17px;">Epitaph</p>
            </div>
            <div class="w3-col s9">
                <input type="hidden" id="upd-deceased-id" name="upd-deceased-id" class="w3-input" required>
                <input type="text" id="upd-first-name" name="upd-first-name" class="w3-input" required>
                <input type="text" id="upd-last-name" name="upd-last-name" class="w3-input" required>
                <input type="text" id="upd-middle-initial" name="upd-middle-initial" class="w3-input" required>
                <input type="date" id="upd-burial-date" name="upd-burial-date" class="w3-input" required>
                <input type="date" id="upd-birth-date" name="upd-birth-date" class="w3-input" required>
                <select class="w3-select" id="upd-marital-status" name="upd-marital-status">
                  <option value="" disabled selected>Choose your option</option>
                  <option value="Married">Married</option>
                  <option value="Widowed">Widowed</option>
                  <option value="Separated">Separated</option>
                  <option value="Divorced">Divorced</option>
                  <option value="Single">Single</option>
              </select>
              <input type="number" id="upd-age" name="upd-age" class="w3-input" required>
              <input type="text" id="upd-epitaph" name="upd-epitaph" class="w3-input" required>
              <input type="hidden" id="upd-grave-id" name="upd-grave-id" required>
          </div>
      </div>
      <div class="w3-container w3-padding-24">
        <button class="w3-button w3-right w3-round" onclick="updateDeceasedRecord()" style="background-color: rgb(223, 116, 67);color: white;">Save</button>
        <button class="w3-button w3-right w3-round" onclick="deleteDeceasedRecord()" style="margin-right: 30px;background-color: rgb(218, 52, 48);color: white;">Delete</button>
        <button class="w3-button w3-round" onclick="locateDeceasedRecord();" style="background-color: rgb(223, 116, 67);color: white;">Locate</button>
    </div>
</div>
</div>
<!-- End of Modal for Updating deceased records-->

<!-- Javascript starts -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
	$(document).ready(function(){
       checkSession();
       getSession();
       getDeceasedRecords();

       checkOpenInsertModal();
    });

  //Open modal for inserting a deceased Record
  function modalInsertDeceased(){
    document.getElementById('modal-insert').style.display='block';
  }

  //check if opening this page will also open the modal for inserting record
  //receive the grave_id to this method
  function checkOpenInsertModal(){
    var urlstr = window.location.search;
        if(urlstr != null){
            var req = new URLSearchParams(urlstr);
            if(req.get('request') == 'addrecord'){
                var grave_id = req.get('grave');
                console.log("search: " + req.get('request'));
                console.log("grave-id: " + grave_id);
                
                //Load Modal for adding
                modalInsertDeceased();
                $("#btn-insert-deceased").on('click', function(){
                    var fname = $("#first-name").val();
                    var lname = $("#last-name").val();
                    var mi = $("#middle-initial").val();
                    var burialdate = $("#burial-date").val();
                    var birthdate = $("#birth-date").val();
                    var marital = $("#marital-status").val();
                    var age = $("#age").val();
                    var epitaph = $("#epitaph").val();
                    if(fname != "" && lname != "" && mi != "" && burialdate != "" && birthdate != "" && marital != "" && age != "" && epitaph != ""){
                        alert('Added a deceased record. Returning to cemetery map.');
                        window.location.href = "adminCemeteryMap.php?request=" + "deceased" + "&graveid=" + grave_id;
                    }
                });
                $("#close-modal-insert").on('click', function(){
                    window.location.href = "adminCemeteryMap.php?request=" + "deceased" + "&graveid=" + grave_id;
                });
            }
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
            $("#logo_cem_name").html(obj.cemetery_name + " / Records");
            $("#active-user").html(obj.name);
            //console.log(obj.name);
            //console.log(obj.cemetery_name);
        }
    });
}

  //function to load all deceased records
  //Should be added in the $(document).ready
  function getDeceasedRecords(){
  	var request = 'dislay';
  	$.ajax({
  		url:'includes/functionDisplayDeceasedRecords.php',
  		type:'post',
  		data:{
  			req:request
  		},
  		success:function(data, status){
  			//do something
            $("#table-body").html(data);
        }
    });
  }

  //function to add deceased records
  function addDeceasedRecords(){
    var fname = $("#first-name").val();
    var lname = $("#last-name").val();
    var mi = $("#middle-initial").val();
    var burialdate = $("#burial-date").val();
    var birthdate = $("#birth-date").val();
    var marital = $("#marital-status").val();
    var age = $("#age").val();
    var epitaph = $("#epitaph").val();
    if(fname != "" && lname != "" && mi != "" && burialdate != "" && birthdate != "" && marital != "" && age != "" && epitaph != ""){
        $.ajax({
            url:'includes/functionAddDeceasedRecord.php',
            type:'post',
            data:{
                request:'post',
                first_name:fname,
                last_name:lname,
                middle_initial:mi,
                burial_date:burialdate,
                birth_place:birthdate,
                marital_status:marital,
                age_:age,
                epitaph_:epitaph
            },
            success:function(data, status){
                /*console.log("fname: " + fname);
                console.log("lname: " + lname);
                console.log("mi: " + mi);
                console.log("burialdate: " + burialdate);
                console.log("birthdate: " + birthdate);
                console.log("marital: " + marital);
                console.log("age: " + age);
                console.log("epitaph: " + epitaph);*/
                if(data == "saved"){
                    alert('New record added');
                    clearInput();
                    getDeceasedRecords();
                }else{
                    alert('An error has occured');
                }
            }
        });
    }else{
        alert('Please fill empty fields');
    }
}

  //function to open modal of modal-update the deceased record
  function openUpdateModal(deceased_id, fname, lname, mi, burialdate, birthdate, marital, age, epitaph, grave_id){
    document.getElementById('modal-update').style.display = 'block';
    $("#upd-deceased-id").val(deceased_id);
    $("#upd-first-name").val(fname);
    $("#upd-last-name").val(lname);
    $("#upd-middle-initial").val(mi);
    $("#upd-burial-date").val(burialdate);
    $("#upd-birth-date").val(birthdate);
    $("#upd-marital-status").val(marital);
    $("#upd-age").val(age);
    $("#upd-epitaph").val(epitaph);
    console.log("grave_id: " + grave_id);
    $("#upd-grave-id").val(grave_id);
}

  //function to delete a deceased Record
  function deleteDeceasedRecord(){
    var id = $("#upd-deceased-id").val();
    //confirm deletion with confirm();
    if(confirm('Confrim: Delete this record?')){
        $.ajax({
            type:'post',
            url:'includes/functionDeleteDeceasedRecord.php',
            data:{
                deceased_id:id
            },
            success:function(data, status){
                //do something
                if(data == 'deleted'){
                    alert('Record deleted');
                    getDeceasedRecords();
                    $("#upd-deceased-id").val('');
                    document.getElementById('modal-update').style.display = 'none';
                }else{
                    alert(data);
                }
                //load display all deceased Records & clear the input of upd-deceased-id
            }
        });
    }
}

  //function to update the deceased Record
  function updateDeceasedRecord(){
    var id = $("#upd-deceased-id").val();
    var firstname = $("#upd-first-name").val();
    var lastname = $("#upd-last-name").val();
    var middle_initial = $("#upd-middle-initial").val();
    var burial_date = $("#upd-burial-date").val();
    var birth_date = $("#upd-birth-date").val();
    var marital_status = $("#upd-marital-status").val();
    var age_ = $("#upd-age").val();
    var epitaph_ = $("#upd-epitaph").val();
    if(id != "" && firstname != "" && lastname != "" && middle_initial != "" && burial_date != "" && birth_date != "" && marital_status != "" && age_ != "" && epitaph_ != ""){
        $.ajax({
            url:'includes/functionUpdateDeceasedRecord.php',
            type:'post',
            data:{
                deceased_id:id,
                fname:firstname,
                lname:lastname,
                mi:middle_initial,
                burialdate:burial_date,
                birthdate:birth_date,
                marital:marital_status,
                age:age_,
                epitaph:epitaph_
            },
            success:function(data, status){
                //do something
                if(data == 'updated'){
                    alert('Record has been updated');
                    getDeceasedRecords();
                    $("#upd-deceased-id").val('');
                    document.getElementById('modal-update').style.display = 'none';
                }else{
                    alert(data);
                }
            }
        });
    }else{
        alert('Please fill empty fields');
    }
}

  //clear the input fields of the modal for #modal-insert
  function clearInput(){
    $("#first-name").val('');
    $("#last-name").val('');
    $("#middle-initial").val('');
    $("#burial-date").val('');
    $("#birth-date").val();
    $("#marital-status").val('');
    $("#age").val('');
    $("#epitaph").val('');
    document.getElementById('modal-insert').style.display = 'none';
}

    //function to search Deceased Records
    function searchDeceasedRecords(){
        var name = $("#search-deceased").val();
        $.ajax({
            url:'includes/functionSearchDeceasedRecord.php',
            type:'post',
            data:{
                deceased_name:name
            },
            success:function(data, status){
                console.log("search: " + name);
                $("#table-body").html(data);
            }
        });
    }

    //display deceased records that has not yet placed to the grave
    function getDeceasedNullGraveId(){
        var request = 'dislay';
        $.ajax({
            url:'includes/functionDisplayDeceasedNullGrave.php',
            type:'post',
            data:{
                request1:request
            },
            success:function(data, status){
                //do something
                alert('Highlighted rows are not assigned to a grave');
                $("#table-body").html(data);
            }
        });
    }

    //function deceased records that exceeded 5 years
    function getDeceasedExceed(){
        var request = 'dislay';
        $.ajax({
            url:'includes/functionDisplayExceedDeceased.php',
            type:'post',
            data:{
                request2:request
            },
            success:function(data, status){
                //do something
                alert('Highlighted rows exceeded 5 years in the cemetery');
                $("#table-body").html(data);
            }
        });
    }

    //function to locate the specific grave of a record
    function locateDeceasedRecord(){
        var grave = $("#upd-grave-id").val();
        if(grave != ""){
            localStorage.setItem('grave-id', grave);
            window.location.href = "adminCemeteryMap.php";
        }else{
            alert("This deceased record has not been allocated to the cemetery map.\nPlease assign this record first to the map");
        }
    }
</script>

</body>
</html>