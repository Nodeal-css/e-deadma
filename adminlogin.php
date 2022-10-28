<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin Login</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
	
</head>
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
	<!-- Header ends -->

	<!-- Main starts-->
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
	<!-- header ends-->

	<!-- Javascript load last -->
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