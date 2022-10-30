<?php 
include 'connectDB.php';
session_start();

if(isset($_POST['firstname'])){
	//owner table
	$fname = isset($_POST['firstname']) ? $_POST['firstname'] : '';
	$lname = isset($_POST['lastname']) ? $_POST['lastname'] : '';
	$mi = isset($_POST['middle']) ? $_POST['middle'] : '';
	$street = isset($_POST['street_address']) ? $_POST['street_address'] : '';
	$city = isset($_POST['city_address']) ? $_POST['city_address'] : '';
	$zip = isset($_POST['zip_code']) ? $_POST['zip_code'] : '';
	$phone = isset($_POST['phone_no']) ? $_POST['phone_no'] : '';
	$email = isset($_POST['email_address']) ? $_POST['email_address'] : '';

	//plot_ownership table
	$cemetery = isset($_SESSION['cemetery_id']) ? $_SESSION['cemetery_id'] : '';
	$date_pur = isset($_POST['date_pur']) ? $_POST['date_pur'] : '';
	$purchase_price = isset($_POST['purch_price']) ? $_POST['purch_price'] : '';
	$ownership = isset($_POST['ownership']) ? $_POST['ownership'] : '';
	$sqr = isset($_POST['sqr_area']) ? $_POST['sqr_area'] : '';

	//query
	$sql = "INSERT INTO `owner`(`fname`, `lname`, `mi`, `street`, `city`, `zip`, `phone_no`, `email`) VALUES ('$fname', '$lname', '$mi', '$street', '$city', '$zip', '$phone', '$email');";
	if(mysqli_query($conn, $sql)){
		$last_id = mysqli_insert_id($conn);
		$sql2 = "INSERT INTO `plot_ownership`(`owner_id`, `cemetery_id`, `date_purchased`, `purchase_price`, `ownership_status`, `square_meters`) VALUES ('$last_id', '$cemetery', '$date_pur', '$purchase_price', '$ownership', '$sqr');";
		if(mysqli_query($conn, $sql2)){
			echo 'Last inserted owner_id: ' . $last_id . ' | saved to database';
		}
	}else{
		echo 'Error: ' . mysqli_error($conn);
	}
}
exit();

?>