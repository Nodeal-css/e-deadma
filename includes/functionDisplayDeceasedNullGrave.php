<?php 
include 'connectDB.php';
session_start();

if(isset($_POST['request1'])){
	$cemetery = isset($_SESSION['cemetery_id']) ? $_SESSION['cemetery_id'] : '';
	$html = "";
	$sql = "SELECT * FROM `deceased` WHERE cemetery_id = '$cemetery';";
	$result = mysqli_query($conn, $sql);
	if(mysqli_num_rows($result) > 0){
		while($row = mysqli_fetch_assoc($result)){
            if($row['grave_id'] == null){
                $html .= '<tr class="w3-green" onclick="openUpdateModal('. $row['deceased_id'] .', \''. $row['fname'] .'\', \''. $row['lname'] .'\', \''. $row['mi'] .'\', \''. $row['burial_date'] .'\', \''. $row['birth_date'] .'\', \''. $row['marital_status'] .'\', '. $row['age'] .', \''. $row['epitaph'] .'\', '. $row['grave_id'] .');" style="cursor:pointer;"><td>'. $row['fname'] .'</td><td>'. $row['lname'] .'</td><td>'. $row['mi'] .'</td><td>'. $row['burial_date'] .'</td><td>'. $row['birth_date'] .'</td><td>'. $row['marital_status'] .'</td><td>'. $row['age'] .'</td><td>'. $row['epitaph'] .'</td></tr>';
            }else{
                $html .= '<tr class="w3-opacity" onclick="openUpdateModal('. $row['deceased_id'] .', \''. $row['fname'] .'\', \''. $row['lname'] .'\', \''. $row['mi'] .'\', \''. $row['burial_date'] .'\', \''. $row['birth_date'] .'\', \''. $row['marital_status'] .'\', '. $row['age'] .', \''. $row['epitaph'] .'\', '. $row['grave_id'] .');" style="cursor:pointer;"><td>'. $row['fname'] .'</td><td>'. $row['lname'] .'</td><td>'. $row['mi'] .'</td><td>'. $row['burial_date'] .'</td><td>'. $row['birth_date'] .'</td><td>'. $row['marital_status'] .'</td><td>'. $row['age'] .'</td><td>'. $row['epitaph'] .'</td></tr>';
            }
		}
		echo $html;
	}else{
		echo '0 Results';
	}
}

exit();
?>