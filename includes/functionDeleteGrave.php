<?php 
include 'connectDB.php';

if(isset($_POST['grave_id'])){
    $grave_id = isset($_POST['grave_id']) ? $_POST['grave_id'] : '';

    $sql = "DELETE FROM `grave_location` WHERE grave_id = '$grave_id'";
    if(mysqli_query($conn, $sql)){
        echo 'No. ' . $grave_id . ' Grave has been removed';
    }else{
        echo 'Error: ' . $sql . ' connection: ' . mysqli_error($conn);
    }

}

exit();
?>