<?php 
include 'connectDB.php';

$html = "";
if(isset($_POST['owner_name'])){
	$owner = isset($_POST['owner_name']) ? $_POST['owner_name'] : '';
	$sql = "SELECT CONCAT(fname, ' ', mi, ' ', lname) AS name, owner_id FROM `owner` WHERE CONCAT(fname, ' ', mi, ' ', lname) LIKE '%$owner%';";
	$result = mysqli_query($conn, $sql);
	while($row = mysqli_fetch_assoc($result)){
		$temp = $row['name'];
		$id = $row['owner_id'];
		$html .= "<li onclick='getOwner(\"$temp\", $id)'>". $temp ."</li>";
	}
	echo "<ul class='w3-ul'>". $html ."</ul>";
}else{
	echo 'error';
}
exit();

?>