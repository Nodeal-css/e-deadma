<?php 
include 'connectDB.php';

if(isset($_POST['deceased_id'])){
	$id = isset($_POST['deceased_id']) ? $_POST['deceased_id'] : '';
	$sql = "DELETE FROM `deceased` WHERE deceased_id = '$id';";
	if(mysqli_query($conn, $sql)){
		echo 'deleted';
	}else{
		echo 'Deletion error: msqli';
	}
}
exit();
?>