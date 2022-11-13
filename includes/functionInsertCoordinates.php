<?php 
include 'connectDB.php';
session_start();

if(isset($_POST['req'])){
    $cemetery = isset($_SESSION['cemetery_id']) ? $_SESSION['cemetery_id'] : '';
    $x1 = isset($_POST['axis_x1']) ? $_POST['axis_x1'] : '';
    $y1 = isset($_POST['axis_y1']) ? $_POST['axis_y1'] : '';
    $x2 = isset($_POST['axis_x2']) ? $_POST['axis_x2'] : '';
	$y2 = isset($_POST['axis_y2']) ? $_POST['axis_y2'] : '';
	$x3 = isset($_POST['axis_x3']) ? $_POST['axis_x3'] : '';
	$y3 = isset($_POST['axis_y3']) ? $_POST['axis_y3'] : '';
	$x4 = isset($_POST['axis_x4']) ? $_POST['axis_x4'] : '';
	$y4 = isset($_POST['axis_y4']) ? $_POST['axis_y4'] : '';

    $sql = "INSERT INTO `grave_location`(`grave_id`, `cemetery_id`, `x1`, `y1`, `x2`, `y2`, `x3`, `y3`, `x4`, `y4`) VALUES (null, '$cemetery', '$x1', '$y1', '$x2', '$y2', '$x3', '$y3', '$x4', '$y4');";
    if(mysqli_query($conn, $sql)){
        echo 'Coordinates has been added.';
    }else{
        echo 'Error ' . mysqli_error($conn);
    }
}
exit();
?>