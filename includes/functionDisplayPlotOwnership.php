<?php
include 'connectDB.php';
session_start();

//Fix: change id's to names of the owner or the deceased
if(isset($_POST['request'])){
	$html = "";
	$cemetery = isset($_SESSION['cemetery_id']) ? $_SESSION['cemetery_id'] : '';

	$sql = "SELECT `plot_id`, `grave_id`, `date_purchased`, `ownership_status`, plot_ownership.owner_id AS plot_owner, owner.owner_id AS owner, `purchase_price`,  `square_meters` FROM `plot_ownership`, `owner` WHERE plot_ownership.owner_id = owner.owner_id AND cemetery_id = '$cemetery';"; 
	$result = mysqli_query($conn, $sql);
	if(mysqli_num_rows($result) > 0){
		while($row = mysqli_fetch_assoc($result)){
			$html .= "<div class='w3-col m3 w3-margin w3-round-xlarge w3-container' style='height: auto;background-color: rgb(223, 116, 67);color:white;'>
			<table class='w3-table'>
			<tr><td></td><td class='w3-right'><button onclick='' class='w3-button w3-round w3-white'>View</button></td></tr>
			<tr><td>date: </td><td>" . $row['date_purchased'] . "</td></tr>
			<tr><td>status: </td><td>" . $row['ownership_status'] . "</td></tr>
			<tr><td>owner: </td><td>" . $row['plot_owner'] . "</td></tr>
			<tr><td>Deceased: </td><td>Joanne</td></tr>
			</table></div>";
		}
		echo '<div class="w3-row">' . $html . '</div>';
	}else{
		echo 'Empty Plot Records';
	}
	
}
exit();

?>