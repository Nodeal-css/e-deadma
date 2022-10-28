<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- CSS  -->
    <link rel="stylesheet" href="css/admin.css">
     
    <!-- Iconscout CSS para sa mga icons ne -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <title>Dashboard</title>
</head>
<body>
    <nav>
        <div class="logo-name">
            <div class="logo-image">
                <img src="assets/KG.png" alt="">
            </div>
            <span class="logo_name">ReConnect</span>
            
        </div>
        

        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="admin.html">
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
                <li><a href="map.html">
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

    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>

            <div class="search-box">
                <i class="uil uil-search"></i>
                <input type="text" placeholder="Search ReConnect">
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
                    <span class="text" id="logo_cem_name">Dashboard</span>
                </div>

                <div class="boxes">
                    <div class="box box1">       
                        <span class="number">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nemo nostrum voluptatem eaque.</span>
                    </div>
                    <div class="box box2">
                        <span class="number">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nemo maxime asperiores eveniet.</span>
                    </div>
                    <div class="box box3">
                        <span class="number">Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet saepe ducimus fugiat?</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    

<!-- Javascript starts -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>

  $(document).ready(function(){
    checkSession();
    getSession();
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
            $("#logo_cem_name").html(obj.cemetery_name);
            $("#active-user").html(obj.name);
            //console.log(obj.name);
            //console.log(obj.cemetery_name);
        }
    });
  }

  
</script>
<!-- Javascript starts -->
</body>
</html>
