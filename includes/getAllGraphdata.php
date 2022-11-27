<?php 
include 'connectDB.php';
session_start();

$cemetery = isset($_SESSION['cemetery_id']) ? $_SESSION['cemetery_id'] : '';
$arr = array();
$temp = array(1, 2, 3, 4);
if(isset($_POST['request'])){
    $sql = "SELECT `report_id`, `cemetery_id`, `date_from`, MONTHNAME(date_to), `total_revenue`, `total_expense` FROM `financial_report` WHERE cemetery_id = '$cemetery' ORDER BY date_to DESC LIMIT 5";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 4){
        while($row = mysqli_fetch_array($result)){
            $arr[] = $row;
        }
        echo json_encode($arr);
    }else{
        echo json_encode($temp);
    }
}
//print_r(json_encode($arr));
exit();
?>