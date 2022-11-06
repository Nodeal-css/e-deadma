<?php 
include 'connectDB.php';

if(isset($_POST['plotID'])){
	$arr = array();
	$plot_id = isset($_POST['plotID']) ? $_POST['plotID'] : '';

	$sql = "SELECT `grave_id`, `date_purchased`, `purchase_price`, `ownership_status`, `square_meters`, owner.fname AS firstname, owner.lname AS lastname, owner.mi AS middle, owner.street AS street_add, owner.city AS city_add, owner.zip AS zip_code, owner.phone_no AS phone_num, owner.email AS email_address FROM `plot_ownership`, `owner` WHERE owner.owner_id = plot_ownership.owner_id AND plot_id = '$plot_id';";
	$result = mysqli_query($conn, $sql);
	if(mysqli_num_rows($result) > 0){
		$row = mysqli_fetch_assoc($result);
		$arr = $row;
		echo json_encode($arr);
	}
}

exit();

?>