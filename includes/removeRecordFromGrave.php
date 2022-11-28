<?php 
include 'connectDB.php';

if(isset($_POST['deceased'])){
    $deceased_id = isset($_POST['deceased']) ? $_POST['deceased'] : '';

    $sql = "UPDATE `deceased` SET `grave_id` = null WHERE deceased_id = '$deceased_id'";
    if(mysqli_query($conn, $sql)){
        echo 'Deceased record has been removed to this grave';
    }else{
        echo 'SQL error ' . mysqli_error($conn);
    }
}

if(isset($_POST['plot'])){
    $plot_id = isset($_POST['plot']) ? $_POST['plot'] : '';

    $sql = "UPDATE `plot_ownership` SET `grave_id` = null WHERE plot_id = '$plot_id'";
    if(mysqli_query($conn, $sql)){
        echo 'Plot/burial record has been removed to this grave';
    }else{
        echo 'SQL error ' . mysqli_error($conn);
    }
}


exit();
?>