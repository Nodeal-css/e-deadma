<?php 
include 'connectDB.php';
session_start();

$cemetery = isset($_SESSION['cemetery_id']) ? $_SESSION['cemetery_id'] : '';
if(isset($_POST['search_name'])){
    
    $name = isset($_POST['search_name']) ? $_POST['search_name'] : '';
    $html = "";
    $arr_tmp = array();
    $arr_tmp = searchName($name);

    $sql = "SELECT `grave_id`, `x1`, `y1`, `x2`, `y2`, `x3`, `y3`, `x4`, `y4` FROM `grave_location` WHERE cemetery_id = '$cemetery';";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            if(in_array($row['grave_id'], $arr_tmp)){
                $html .= "<area shape='poly' coords='". $row['x1'] .",". $row['y1'] .",". $row['x2'] .",". $row['y2'] .",". $row['x3'] .",". $row['y3'] .",". $row['x4'] .",". $row['y4'] ."' onclick='openGraveModal(". $row['grave_id'] .")' data-toggle='tooltip' href='#' alt='' title='". $row['grave_id'] ."' data-maphilight='' state='search-grave'/>";
            }else{
                $html .= "<area shape='poly' coords='". $row['x1'] .",". $row['y1'] .",". $row['x2'] .",". $row['y2'] .",". $row['x3'] .",". $row['y3'] .",". $row['x4'] .",". $row['y4'] ."' onclick='openGraveModal(". $row['grave_id'] .")' data-toggle='tooltip' href='#' alt='' title='". $row['grave_id'] ."' data-maphilight='' state='grave'/>";
            }
        }
        echo $html;
    }
}

//
function searchName($name){
    global $conn, $cemetery;
    $arr = array();

    $sql1 = "SELECT deceased.grave_id AS grave, deceased.deceased_id FROM deceased, grave_location WHERE CONCAT(fname, ' ', mi, ' ', lname) LIKE '%$name%' AND deceased.grave_id = grave_location.grave_id AND grave_location.cemetery_id = '$cemetery';";
    $result = mysqli_query($conn, $sql1);
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $arr[] = $row['grave'];
        }
    }
    return $arr;
}

exit();
?>