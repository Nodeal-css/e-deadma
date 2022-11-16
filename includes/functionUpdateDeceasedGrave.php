<?php 
include 'connectDB.php';

if(isset($_POST['grave'])){
    $grave_id = isset($_POST['grave']) ? $_POST['grave'] : '';
    $deceased = isset($_POST['deceased']) ? $_POST['deceased'] : '';

    $sql = "UPDATE `deceased` SET `grave_id`= '$grave_id' WHERE deceased_id = '$deceased'";
    if(mysqli_query($conn, $sql)){
        echo 'Deceased record has been added to this grave: ' . $grave_id;
    }else{
        echo 'Deceased was not added to the grave: ' . mysqli_error($conn);
    }
}

if(isset($_POST['block_id'])){
    $grave_id = isset($_POST['block_id']) ? $_POST['block_id'] : '';
    $plot_id = isset($_POST['plot']) ? $_POST['plot'] : '';

    $sql = "UPDATE `plot_ownership` SET `grave_id`= '$grave_id' WHERE plot_id = '$plot_id'";
    if(mysqli_query($conn, $sql)){
        echo 'Plot record has been added to this grave: ' . $grave_id;
    }else{
        echo 'Plot record was not added to the grave: ' . mysqli_error($conn);
    }
}

exit();
?>