<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gravely</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>

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
                    <a href="#" class="att">Create New Account </a> here</a></p>



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
			alert("Please Fill Up Username and Password!!!!!!");
		}
	}
</script>

</body>
</html>