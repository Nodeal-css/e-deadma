<?php 
include 'connectDB.php';
session_start();

$cemetery = isset($_SESSION['cemetery_id']) ? $_SESSION['cemetery_id'] : '';
if(isset($_POST['journal'])){
    $html = "<tr><th>Date</th><th>Account</th><th>Ledger</th><th>Debit</th><th>Credit</th><th>Description</th><th>Action</th></tr>";

    $sql = "SELECT `journal_id`, entry_journal.report_id, `entry_date`, `account`, `ledger`, `debit`, `credit`, `description` FROM `entry_journal`, financial_report WHERE financial_report.report_id = entry_journal.report_id AND financial_report.cemetery_id = $cemetery";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $html .= "<tr><td>". $row['entry_date'] ."</td><td>". $row['account'] ."</td><td>". $row['ledger'] ."</td><td>". $row['debit'] ."</td><td>". $row['credit'] ."</td><td>". $row['description'] ."</td><td><button onclick='deleteJournal(". $row['journal_id'] .");'>Delete</button></td></tr>";
        }
        echo $html;
    }
}

if(isset($_POST['report'])){
    $report_id = isset($_POST['report']) ? $_POST['report'] : '';
    $html = "<tr><th>Date</th><th>Account</th><th>Ledger</th><th>Debit</th><th>Credit</th><th>Description</th><th>Action</th></tr>";

    $sql = "SELECT `journal_id`, entry_journal.report_id, `entry_date`, `account`, `ledger`, `debit`, `credit`, `description` FROM `entry_journal`, financial_report WHERE financial_report.report_id = entry_journal.report_id AND financial_report.cemetery_id = '$cemetery' AND entry_journal.report_id = '$report_id'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $html .= "<tr><td>". $row['entry_date'] ."</td><td>". $row['account'] ."</td><td>". $row['ledger'] ."</td><td>". $row['debit'] ."</td><td>". $row['credit'] ."</td><td>". $row['description'] ."</td><td><button onclick='deleteJournal(". $row['journal_id'] .");'>Delete</button></td></tr>";
        }
        echo $html;
    }
}

exit();
?>