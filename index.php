<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<style type="text/css">

</style>
<body>

  <!-- header starts-->
  <header class="" style="position: fixed;background-color: lightcoral;height: 50px;width: 100%;">
    <nav class="nav" style="float: right;">
      <a class="nav-link active" aria-current="page" href="#">Active</a>
      <a class="nav-link" href="#">Link</a>
      <a class="nav-link" href="#">Link</a>
      <a class="nav-link disabled">Disabled</a>
    </nav>
  </header>
  <!-- header starts-->
  <!-- side bar starts -->
  <nav class="nav flex-column" style="background-color: lightgoldenrodyellow;width: 15%;position: fixed;height: 100%;">

    <a class="nav-link active p-3" aria-current="page" href="#">Home</a>
    <a class="nav-link p-3" href="#">Deceased Records</a>
    <a class="nav-link p-3" href="#">Plot Ownership</a>
    <a class="nav-link p-3" href="#">Cemetery Map</a>
    <button class="btn btn-danger" id="logout" onclick="logout();">Logout</button>

  </nav>
  <!-- side bar ends -->
  <!-- main body starts -->
  <main class="flex-grow-1" style="width:85%;margin-left: 15%;position: absolute;z-index: -1;">
    <div class="mt-5 container p-5" style="background-color: white;">
      <h3>Hello World</h3>
      <h3>Hello World</h3>
      <h3>Hello World</h3>
    </div>
  </main>
  <!-- main body ends -->

<!-- Javascript starts -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>

  $(document).ready(function(){
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
</script>
<!-- Javascript starts -->
</body>
</html>