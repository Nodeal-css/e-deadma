<?php 
include 'connectDB.php';
session_start();

if(isset($_POST['deceased'])){
    $cemetery = isset($_SESSION['cemetery_id']) ? $_SESSION['cemetery_id'] : '';
    $name = isset($_POST['deceased']) ? $_POST['deceased'] : '';
    $html = "";

    $sql = "SELECT `deceased_id`, `grave_id`, `cemetery_id`, CONCAT(fname, ' ', mi, ' ', lname) AS name FROM `deceased` WHERE CONCAT(fname, ' ', mi, ' ', lname) LIKE '%$name%' AND grave_id IS NULL AND cemetery_id = '$cemetery'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $html .= "<li onclick='getDeceasedId(\"". $row['name'] ."\"," . $row['deceased_id'] . ")'>id: " . $row['deceased_id'] . " - " . $row['name'] . "</li>";
        }
        echo "<ul class='w3-ul'>" . $html . "</ul>";
    }
}

//This is for plot_ownership
if(isset($_POST['owner'])){
    $cemetery = isset($_SESSION['cemetery_id']) ? $_SESSION['cemetery_id'] : '';
    $owner = isset($_POST['owner']) ? $_POST['owner'] : '';
    $html = "";

    $sql = "SELECT `plot_id`, owner.owner_id, date_purchased, CONCAT(fname, ' ', mi, ' ', lname) AS owner FROM `plot_ownership`, `owner` WHERE cemetery_id = '$cemetery' AND CONCAT(fname, ' ', mi, ' ', lname) LIKE '%$owner%' AND plot_ownership.owner_id = owner.owner_id AND grave_id IS NULL;";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $temp = "Plot: " . $row['plot_id'] . " - " . $row['owner'] . " - date purchased " . $row['date_purchased'];
            $html .= "<li onclick='getPlotId(\"" . $temp . "\",". $row['plot_id'] .")'>" . $temp . "</li>";
        }
        echo "<ul class='w3-ul'>" . $html . "</ul>";
    }
}

exit();

?>