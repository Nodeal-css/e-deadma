<?php 
include 'connectDB.php';
session_start();

$cemetery = isset($_SESSION['cemetery_id']) ? $_SESSION['cemetery_id'] : '';

if(isset($_POST['request'])){
    $html = "<tr><th>Date from</th><th>Date to</th><th>Total revenue</th><th>Total expense</th><th>Net income</th></tr>";

    $sql = "SELECT `report_id`, `date_from`, `date_to`, `total_revenue`, `total_expense`, (total_revenue - total_expense) AS income FROM `financial_report` WHERE cemetery_id = $cemetery";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $html .= '<tr onclick="getJournalFromReport('. $row['report_id'] .');" style="cursor:pointer;"><td>'. $row['date_from'] .'</td><td>'. $row['date_to'] .'</td><td>'. $row['total_revenue'] .'</td><td>'. $row['total_expense'] .'</td><td>'. $row['income'] .'</td></tr>';
        }
        echo $html;
    }
}

exit();
?>