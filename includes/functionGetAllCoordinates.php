<?php 
include 'connectDB.php';
session_start();

if(isset($_POST['request'])){
    $html = "";
    $cemetery = isset($_SESSION['cemetery_id']) ? $_SESSION['cemetery_id'] : '';
    $sql = "SELECT `grave_id`, `x1`, `y1`, `x2`, `y2`, `x3`, `y3`, `x4`, `y4` FROM `grave_location` WHERE cemetery_id = '$cemetery';";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $html .= "<area shape='poly' coords='". $row['x1'] .",". $row['y1'] .",". $row['x2'] .",". $row['y2'] .",". $row['x3'] .",". $row['y3'] .",". $row['x4'] .",". $row['y4'] ."' data-toggle='tooltip' href='#' alt='' title='". $row['grave_id'] ."' data-maphilight='' state='grave'/>";
        }
        echo $html;
    }
}
exit();

?>