<?php 
include 'connectDB.php';
session_start();

if(isset($_POST['request'])){
	$user_id = isset($_SESSION['account_id']) ? $_SESSION['account_id'] : '';
	$sql = "SELECT cemetery.cemetery_name AS cemetery_name, CONCAT(fname, ' ', mi, '. ', lname) AS name FROM cemetery, authorized_account WHERE cemetery.cemetery_id = authorized_account.cemetery_id AND authorized_account.account_id = '$user_id'";
	$result = mysqli_query($conn, $sql);
	$response = array();
	$row = mysqli_fetch_assoc($result);
	$response = $row;
	echo json_encode($response);
}else{
	echo 'none';
}


exit();

?>