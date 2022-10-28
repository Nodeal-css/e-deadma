<?php 
include 'connectDB.php';

$cemetery = isset($_POST['cem']) ? $_POST['cem'] : '';
$html = "";
if(isset($_POST['cem'])){
	$sql = "SELECT cemetery_name FROM `cemetery` WHERE cemetery_name LIKE '%$cemetery%';";
	$result = mysqli_query($conn, $sql);
	while($row = mysqli_fetch_assoc($result)){
		$temp = $row['cemetery_name'];
		$html .= "<li class='list-group-item' onclick='getCemetery(\"$temp\")'>". $row['cemetery_name'] . "</li>";
	}
	echo "<ul class='list-group'>". $html . "</ul>";
}else{
	echo "error";
}


exit();

?>