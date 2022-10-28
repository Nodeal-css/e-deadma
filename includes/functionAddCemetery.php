<?php 
include 'connectDB.php';

$cemetery = isset($_POST['cemetery_name']) ? $_POST['cemetery_name'] : '';
$street = isset($_POST['street_address']) ? $_POST['street_address'] : '';
$city = isset($_POST['city_address']) ? $_POST['city_address'] : '';
$zip = isset($_POST['zip_code']) ? $_POST['zip_code'] : '';
$type = isset($_POST['cemetery_type']) ? $_POST['cemetery_type'] : '';
$pass_code = isset($_POST['passcode']) ? $_POST['passcode'] : '';

if(isset($_POST['addRequest'])){
	$sql = "INSERT INTO `cemetery`(`cemetery_id`, `cemetery_name`, `street`, `city`, `zip`, `cemetery_type`, `pass_code`) VALUES (null, '$cemetery', '$street', '$city', '$zip', '$type', '$pass_code')";
	if(mysqli_query($conn, $sql)){
		echo 'submitted';
	}else{
		echo 'mysqli_error';
	}
}

exit();

?>