<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <title>Admin Registration</title>
</head>
<body>
<div class="main">
        <div class="navbar">
            <div class="icon">
                <h2 class="logo">Gravely <br>Sign Up as Admin</h2>
            </div>
            <div class="menu">
                <ul>
                    <li><a href="#">HOME</a></li>
                    <li><a href="#">ABOUT</a></li>
                </ul>
            </div>
        </div> 
        <div class="w3-container w3-card-4" style="background: rgba(255, 255, 255, 0.3); width: 40%; margin: auto;">
            <div class="w3-container w3-padding">
                <input type="text" class="w3-input w3-border-orange" name="user-name" id="usern" placeholder="Username" style="background: rgba(0,0,0,0);color:white;">
                <br>
                <input type="password" class="w3-input w3-border-orange" name="pass-word" id="passw" placeholder="Password" style="background: rgba(0,0,0,0);color:white;">
                <br>
                <input type="text" class="w3-input w3-border-orange" name="f-name" id="f-name" placeholder="First name" style="background: rgba(0,0,0,0);color:white;">
                <br>
                <input type="text" class="w3-input w3-border-orange" name="l-name" id="l-name" placeholder="Last name" style="background: rgba(0,0,0,0);color:white;">
                <br>
                <input type="text" class="w3-input w3-border-orange" name="m-initial" id="m-initial" placeholder="Middle Initial" style="background: rgba(0,0,0,0);color:white;">
                <br>
                <input type="text" class="w3-input w3-border-orange" name="street_" id="street" placeholder="Street address" style="background: rgba(0,0,0,0);color:white;">
                <br>
                <input type="text" class="w3-input w3-border-orange" name="city" id="city" placeholder="City address" style="background: rgba(0,0,0,0);color:white;">
                <br>
                <input type="text" class="w3-input w3-border-orange" name="zip" id="zip" placeholder="Zip code" style="background: rgba(0,0,0,0);color:white;">
                <br>
                <button onclick="signUp();" class="w3-button w3-round w3-right" style="background-color: rgb(223, 116, 67);color: white;">Sign Up</button>
            </div>
        </div>
</div>
    
<!-- Start of Javascript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    function signUp(){
        var uname = $("#usern").val();
        var pword = $("#passw").val();
        var fname = $("#f-name").val();
        var lname = $("#l-name").val();
        var mi = $("#m-initial").val();
        var street = $("#street").val();
        var city = $("#city").val();
        var zip = $("#zip").val();

        if(uname != "" && pword != "" && fname != "" && lname != "" && mi  != "" && street != "" && city != "" && zip != ""){
        $.ajax({
            type:'post',
            url:'includes/register.php',
            data: {
                user:uname,
                pass:pword,
                firstname:fname,
                lastname:lname,
                middle:mi,
                str:street,
                cty:city,
                zip_code:zip
            },
            success:function(result, status){
                if(result == 'true'){
                    alert('Successfully registered proceed to log in');
                    location.href = "adminlogin.php";
                }else{
                    alert('an error has occured');
                }
            }
        });
        }else{
            alert('Please fill empty fields');
        }
    }

</script>
<!-- End of Javascript -->
</body>
</html>