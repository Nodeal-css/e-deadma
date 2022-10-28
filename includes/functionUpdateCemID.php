<?php 
include 'connectDB.php';
session_start();

$cemetery_id = "";
if(isset($_POST['cem']) && isset($_POST['pass'])){
	$cemetery_name = isset($_POST['cem']) ? $_POST['cem'] : '';
	$pass_code = isset($_POST['pass']) ? $_POST['pass'] : '';
	$sql = "SELECT cemetery_id FROM cemetery WHERE cemetery_name = '$cemetery_name' AND pass_code = '$pass_code';";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	if(mysqli_num_rows($result) > 0){
		$cemetery_id = $row['cemetery_id'];
	}
}

if($cemetery_id != ""){
	$user = isset($_SESSION['account_id']) ? $_SESSION['account_id'] : '';
	$sql = "UPDATE authorized_account SET cemetery_id = '$cemetery_id' WHERE account_id = '$user'"; 
	if(mysqli_query($conn, $sql)){
		$_SESSION['cemetery_id'] = $cemetery_id;
		echo 'updated';
	}else{
		echo 'error';
	}
}

exit();

?>