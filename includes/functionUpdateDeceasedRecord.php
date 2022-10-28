<?php 
include 'connectDB.php';

if(isset($_POST['deceased_id'])){
	$id = isset($_POST['deceased_id']) ? $_POST['deceased_id'] : '';
	$fname = isset($_POST['fname']) ? $_POST['fname'] : '';
	$lname = isset($_POST['lname']) ? $_POST['lname'] : '';
	$mi = isset($_POST['mi']) ? $_POST['mi'] : '';
	$burialdate = isset($_POST['burialdate']) ? $_POST['burialdate'] : '';
	$birthdate = isset($_POST['birthdate']) ? $_POST['birthdate'] : '';
	$maritalstatus = isset($_POST['marital']) ? $_POST['marital'] : '';
	$age = isset($_POST['age']) ? $_POST['age'] : '';
	$epitaph = isset($_POST['epitaph']) ? $_POST['epitaph'] : '';

	$sql = "UPDATE `deceased` SET `fname` = '$fname', `lname` = '$lname', `mi` = '$mi', `burial_date` = '$burialdate', `birth_date` = '$birthdate', `marital_status` = '$maritalstatus', `age` = '$age', `epitaph` = '$epitaph' WHERE deceased_id = '$id'";
	if(mysqli_query($conn, $sql)){
		echo 'updated';
	}else{
		echo 'Mysql error: ' . mysqli_error($conn);
	}
}
exit();
?>