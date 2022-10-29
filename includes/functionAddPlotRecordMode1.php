<?php 
include 'connectDB.php';
session_start();

if(isset($_POST['owner'])){
	$owner_id = isset($_POST['owner']) ? $_POST['owner'] : '';
	$cemetery_id = isset($_SESSION['cemetery_id']) ? $_SESSION['cemetery_id'] : '';
	$date_purchase = isset($_POST['date_pur']) ? $_POST['date_pur'] : '';
	$purchase_price = isset($_POST['purch_price']) ? $_POST['purch_price'] : '';
	$ownership = isset($_POST['ownership']) ? $_POST['ownership'] : '';
	$sqr = isset($_POST['sqr_area']) ? $_POST['sqr_area'] : '';

	$sql = "INSERT INTO `plot_ownership`(`owner_id`, `cemetery_id`, `date_purchased`, `purchase_price`, `ownership_status`, `square_meters`) VALUES ('$owner_id', '$cemetery_id', '$date_purchase', '$purchase_price', '$ownership', '$sqr')";
	if(mysqli_query($conn, $sql)){
		echo 'saved';
	}else{
		echo 'not saved error: '. mysqli_error($conn);
	}
}
exit();

?>