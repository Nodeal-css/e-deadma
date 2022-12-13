<?php 
include 'connectDB.php';

if(isset($_POST['user'])){
    $username = isset($_POST['user']) ? ($_POST['user']) : '';
    $password = isset($_POST['pass']) ? ($_POST['pass']) : '';
    $fname = isset($_POST['firstname']) ? ($_POST['firstname']) : '';
    $lname = isset($_POST['lastname']) ? ($_POST['lastname']) : '';
    $mi = isset($_POST['middle']) ? ($_POST['middle']) : '';
    $street = isset($_POST['str']) ? ($_POST['str']) : '';
    $city = isset($_POST['cty']) ? ($_POST['cty']) : '';
    $zip = isset($_POST['zip_code']) ? ($_POST['zip_code']) : '';

    $sql = "INSERT INTO `authorized_account` VALUES (null, null, '$username', '$password', '$fname', '$lname', '$mi', '$street', '$city', '$zip', 'ADMIN');";
    if(mysqli_query($conn, $sql)){
        echo 'true';
    }else{
        echo 'false';
    }

}

exit();
?>