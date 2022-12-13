<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Grave.ly Login</title>
	<link rel="stylesheet" href="css/login.css">
	
</head>
<body>
	<!-- header starts-->
	<!-- header class="" style="position: fixed;background-color: lightcoral;height: 50px;width: 100%;">
		<nav class="nav" style="float: right;">
			<a class="nav-link active" aria-current="page" href="#">Active</a>
			<a class="nav-link" href="#">Link</a>
			<a class="nav-link" href="#">Link</a>
			<a class="nav-link disabled">Disabled</a>
		</nav>
	</header>
	< Header ends >
	< Main starts>
	<main class="flex-grow-1" style="background: url('assets/body.png');background-repeat: no-repeat; background-size: 100% 100%;height: 100%;width: 100%;position: absolute;z-index: -1;">
		<div class="mt-5 container">
			<div class="d-flex flex-row-reverse" style="height:auto;">
				<div class="py-5 px-3 mt-5 border border-warning" style="background-color:white;width: auto;">
					<h3 class="mb-4">Log in as Administrator</h3>
					<input type="text" name="user-name" id="user-name" class="form-control" placeholder="Username" required><br>
					<input type="password" name="pass-word" id="pass-word" class="form-control" placeholder="Password" required>
					<label style="color:blue;">Forget my password</label><br>
					<button class="btn btn-primary mt-2" type="button" onclick="login();">Login</button><br>
					
				<button class="btn btn-primary btn-block mt-2">Create new account</button>
				</div>
				<div class="p-5" style="margin-right:40%;">
					<p>Cemetery records ease of access</p><br>

					<p>Some texts.....</p><br>

					<p>Visit the grave of your love ones...</p><br>
					<button class="btn btn-primary mt-2" type="button" onclick="">Open cemetery's map</button><br>
				</div>
			</div>
		</div>

	</main>
	< header ends >
	< Javascript load last -->

	<div class="main">
        <div class="navbar">
            <div class="icon">
                <h2 class="logo">Gravely</h2>
            </div>
            <div class="menu">
                <ul>
                    <li><a href="#">HOME</a></li>
                    <li><a href="#">ABOUT</a></li>
                </ul>
            </div>
        </div> 
        <div class="content">
            <h1>Cemetery Records<br><span>ease of access</span> <br>Visit the graves of your love ones</h1>
                <button class="cn"><a href="#">Cemetery Map</a></button>
                <div class="form">
                    <h2>Login as Administrator</h2>
                    <input type="text" name="user-name" id="user-name" placeholder="Enter Username" required>
                    <input type="password" name="pass-word" id="pass-word" placeholder="Enter Password" required>
                    <button class="btnn" onclick="login();">Login</button>
                    
                    <p class="link">Don't have an account<br>
                    <a href="adminRegister.php" class="att">Create New Account </a> here</a></p>
                </div>
                    </div>
                </div>
        </div>
    </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
	
	function login(){
		var user_name=$("#user-name").val();
		var pass_word=$("#pass-word").val();
		if(pass_word != "" && user_name != ""){
			$.ajax({
				url:'includes/functionLogin.php',
				type:'post',
				data:{
					login:'login',
					user_name:user_name,
					pass_word:pass_word
				},
				success:function(data, status){
					if(data == 'login'){
						window.location.href = "adminDashboard.php";
					}else if(data == 'assign_cemetery'){
						window.location.href = "adminCemetery.php";
					}else{
						alert(data);
					}
				}
			});
		}else{
			alert("Please fill up username and password");
		}
	}

</script>
	<!-- Javacript line end -->
</body>
</html>