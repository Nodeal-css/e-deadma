<?php 
include 'connectDB.php';
session_start();

$cemetery = isset($_SESSION['cemetery_id']) ? $_SESSION['cemetery_id'] : '';
if(isset($_POST['request'])){
    $html = "";
    
    $sql = "SELECT `grave_id`, `x1`, `y1`, `x2`, `y2`, `x3`, `y3`, `x4`, `y4` FROM `grave_location` WHERE cemetery_id = '$cemetery';";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $html .= "<area shape='poly' coords='". $row['x1'] .",". $row['y1'] .",". $row['x2'] .",". $row['y2'] .",". $row['x3'] .",". $row['y3'] .",". $row['x4'] .",". $row['y4'] ."' onclick='openGraveModal(". $row['grave_id'] .")' data-toggle='tooltip' href='#' alt='' title='". $row['grave_id'] ."' data-maphilight='' state='grave'/>";
        }
        echo $html;
    }
}

// For searching
if(isset($_POST['search'])){
    $grave_id = isset($_POST['grave']) ? $_POST['grave'] : '';
    $html = "";

    $sql = "SELECT `grave_id`, `x1`, `y1`, `x2`, `y2`, `x3`, `y3`, `x4`, `y4` FROM `grave_location` WHERE cemetery_id = '$cemetery';";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            if($row['grave_id'] == $grave_id){
                $html .= "<area shape='poly' coords='". $row['x1'] .",". $row['y1'] .",". $row['x2'] .",". $row['y2'] .",". $row['x3'] .",". $row['y3'] .",". $row['x4'] .",". $row['y4'] ."' onclick='openGraveModal(". $row['grave_id'] .")' data-toggle='tooltip' href='#' alt='' title='". $row['grave_id'] ."' data-maphilight='' state='search-grave'/>";
            }else{
                $html .= "<area shape='poly' coords='". $row['x1'] .",". $row['y1'] .",". $row['x2'] .",". $row['y2'] .",". $row['x3'] .",". $row['y3'] .",". $row['x4'] .",". $row['y4'] ."' onclick='openGraveModal(". $row['grave_id'] .")' data-toggle='tooltip' href='#' alt='' title='". $row['grave_id'] ."' data-maphilight='' state='grave'/>";
            }
        }
        echo $html;
    }
}

// Checking for occupied or not
if(isset($_POST['vacancy'])){
    $html = "";
    $arr_tmp = array();
    $arr_tmp = occupied($cemetery);
    
    $sql = "SELECT `grave_id`, `x1`, `y1`, `x2`, `y2`, `x3`, `y3`, `x4`, `y4` FROM `grave_location` WHERE cemetery_id = '$cemetery';";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            if(in_array($row['grave_id'], $arr_tmp)){
                $html .= "<area shape='poly' coords='". $row['x1'] .",". $row['y1'] .",". $row['x2'] .",". $row['y2'] .",". $row['x3'] .",". $row['y3'] .",". $row['x4'] .",". $row['y4'] ."' onclick='openGraveModal(". $row['grave_id'] .")' data-toggle='tooltip' href='#' alt='' title='". $row['grave_id'] ."' data-maphilight='' state='vacant'/>";
            }else{
                $html .= "<area shape='poly' coords='". $row['x1'] .",". $row['y1'] .",". $row['x2'] .",". $row['y2'] .",". $row['x3'] .",". $row['y3'] .",". $row['x4'] .",". $row['y4'] ."' onclick='openGraveModal(". $row['grave_id'] .")' data-toggle='tooltip' href='#' alt='' title='". $row['grave_id'] ."' data-maphilight='' state='occupied'/>";
            }
        }
        echo $html;
    }
}

function occupied($cem){
    global $conn;
    $arr = array();

    $sql1 = "SELECT g.grave_id AS grave, `cemetery_id`, `x1`, `y1`, `x2`, `y2`, `x3`, `y3`, `x4`, `y4` FROM grave_location g WHERE g.cemetery_id = '$cem' AND g.grave_id NOT IN (SELECT d.grave_id FROM deceased d WHERE g.grave_id = d.grave_id)";
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