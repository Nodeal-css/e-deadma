<?php 
include 'connectDB.php';
session_start();

if(isset($_POST['deceased_name'])){
	$cemetery_id = isset($_SESSION['cemetery_id']) ? $_SESSION['cemetery_id'] : '';
	$name = isset($_POST['deceased_name']) ? $_POST['deceased_name'] : '';
	$html = "";

	$sql = "SELECT * FROM `deceased` WHERE CONCAT(fname, ' ', mi, ' ', lname) LIKE '%$name%' AND cemetery_id = '$cemetery_id';";
	$result = mysqli_query($conn, $sql);
	if(mysqli_num_rows($result) > 0){
		while($row = mysqli_fetch_assoc($result)){
			$html .= '<tr onclick="openUpdateModal('. $row['deceased_id'] .', \''. $row['fname'] .'\', \''. $row['lname'] .'\', \''. $row['mi'] .'\', \''. $row['burial_date'] .'\', \''. $row['birth_date'] .'\', \''. $row['marital_status'] .'\', '. $row['age'] .', \''. $row['epitaph'] .'\');" style="cursor:pointer;"><td>'. $row['fname'] .'</td><td>'. $row['lname'] .'</td><td>'. $row['mi'] .'</td><td>'. $row['burial_date'] .'</td><td>'. $row['birth_date'] .'</td><td>'. $row['marital_status'] .'</td><td>'. $row['age'] .'</td><td>'. $row['epitaph'] .'</td></tr>';
		}
		echo $html;
	}else{
		echo '0 results';
	}
}

exit();
?>