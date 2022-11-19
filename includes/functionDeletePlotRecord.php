<?php 
include 'connectDB.php';

if(isset($_POST['plot'])){
    $plot_id = isset($_POST['plot']) ? $_POST['plot'] : '';

    $sql1 = "DELETE FROM `cemetery_deed` WHERE cemetery_deed.plot_id = '$plot_id'";
    $sql2 = "DELETE FROM `plot_ownership` WHERE plot_id = '$plot_id'";
    if(mysqli_query($conn, $sql1)){
        if(mysqli_query($conn, $sql2)){
            echo 'Plot and deed records were deleted';
        }
    }else{
        echo 'error in deleting plot record mysql: ' . mysqli_error($conn);
    }
}
exit();
?>