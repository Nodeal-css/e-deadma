<?php 
include 'connectDB.php';
session_start();

if(isset($_POST['request'])){
	$firstname = isset($_POST['first_name']) ? $_POST['first_name'] : '';
	$lastname = isset($_POST['last_name']) ? $_POST['last_name'] : '';
	$mi = isset($_POST['middle_initial']) ? $_POST['middle_initial'] : '';
	$burialdate = isset($_POST['burial_date']) ? $_POST['burial_date'] : '';
	$birthdate = isset($_POST['birth_place']) ? $_POST['birth_place'] : '';
	$maritalstatus = isset($_POST['marital_status']) ? $_POST['marital_status'] : '';
	$age = isset($_POST['age_']) ? $_POST['age_'] : '';
	$epitaph = isset($_POST['epitaph_']) ? $_POST['epitaph_'] : '';
	$cemetery = isset($_SESSION['cemetery_id']) ? $_SESSION['cemetery_id'] : '';

	$sql = "INSERT INTO `deceased`(`cemetery_id`, `fname`, `lname`, `mi`, `burial_date`, `birth_date`, `marital_status`, `age`, `epitaph`) VALUES ('$cemetery', '$firstname', '$lastname', '$mi', '$burialdate', '$birthdate', '$maritalstatus', '$age', '$epitaph');";
	if(mysqli_query($conn, $sql)){
		echo 'saved';
	}else{
		echo 'error';
	}
}

exit();

?>