<?php 
include 'connectDB.php';
session_start();

$password = isset($_POST["pass_word"]) ? $_POST["pass_word"] : '';
$username = isset($_POST["user_name"]) ? $_POST["user_name"] : '';
if(isset($_POST['login'])){
	$sql = "SELECT * FROM authorized_account WHERE username = '$username' AND acc_password = '$password'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	$rowCount = mysqli_num_rows($result);
	if($rowCount > 0 && $row['cemetery_id'] != null){
		$_SESSION['account_id'] = $row['account_id'];
		$_SESSION['cemetery_id'] = $row['cemetery_id'];
		echo 'login';
	}else if($rowCount > 0 && $row['cemetery_id'] == null){
		$_SESSION['account_id'] = $row['account_id'];
		echo 'assign_cemetery';
	}
	else{
		echo 'Invalid Username or Password';
	}
}

//mysqli_close($conn);
exit();


?>