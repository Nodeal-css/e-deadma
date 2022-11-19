<?php
include 'connectDB.php';
session_start();

//Fix: change id's to names of the owner or the deceased
if(isset($_POST['request_load_plot'])){
	$html = "";
	$cemetery = isset($_SESSION['cemetery_id']) ? $_SESSION['cemetery_id'] : '';

	$sql = "SELECT `plot_id`, `grave_id`, CONCAT(owner.fname, ' ', owner.mi, '. ', owner.lname) AS name, `date_purchased`, `ownership_status`, plot_ownership.owner_id AS plot_owner, owner.owner_id AS owner, `purchase_price`,  `square_meters` FROM `plot_ownership`, `owner` WHERE plot_ownership.owner_id = owner.owner_id AND cemetery_id = '$cemetery';"; 
	$result = mysqli_query($conn, $sql);
	if(mysqli_num_rows($result) > 0){
		while($row = mysqli_fetch_assoc($result)){
			$html .= "<div class='w3-col m3 w3-margin w3-round-xlarge w3-container' style='height: 350px;background-color: rgb(223, 116, 67);color:white;'><table class='w3-table'><tr><td></td><td class='w3-right'><button onclick='openModalView(". $row['plot_id'] .", ". $row['owner'] .");' class='w3-button w3-round w3-white'>View</button></td></tr><tr><td>date: </td><td>" . $row['date_purchased'] . "</td></tr><tr><td>status: </td><td>" . $row['ownership_status'] . "</td></tr><tr><td>owner: </td><td>" . $row['name'] . "</td></tr><tr><td>Deceased: </td><td>" . getDeceased($row['grave_id']) . "</td></tr></table></div>";
		}
		echo '<div class="w3-row">' . $html . '</div>';
	}
	
}


function getDeceased($id){
	global $conn;
	$sql1 = "SELECT CONCAT(`fname`, ' ', `mi`, '. ', `lname`) AS name FROM `deceased` WHERE grave_id = '$id'";
	$res = mysqli_query($conn, $sql1);
	$temp = "";
	if(mysqli_num_rows($res) > 0){
		while($row = mysqli_fetch_assoc($res)){
			$temp .= "<br>• " . $row['name'];
		}
	}
	//mysqli_close($conn);
	return $temp;
}

exit();

?>