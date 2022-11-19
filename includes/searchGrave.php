<?php 
include 'connectDB.php';

if(isset($_POST['grave'])){
    $grave_id = isset($_POST['grave']) ? $_POST['grave'] : '';
    $arr = array();

    $sql = "SELECT `grave_id`, `x1`, `y1` FROM `grave_location` WHERE grave_id = '$grave_id'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        $arr = $row;
        echo json_encode($arr);
    }
}

?>