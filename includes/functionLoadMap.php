<?php 
include 'connectDB.php';
session_start();

if(isset($_POST['request'])){
    $cemetery = isset($_SESSION['cemetery_id']) ? $_SESSION['cemetery_id'] : '';
    $arr = "";

    $sql = "SELECT `cemetery_map_img` FROM `cemetery` WHERE cemetery_id = '$cemetery'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        $arr = $row['cemetery_map_img'];
        echo '' . $arr;
    }
}

exit();
?>