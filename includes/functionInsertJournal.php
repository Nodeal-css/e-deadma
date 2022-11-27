<?php 
include 'connectDB.php';
session_start();

$cemetery = isset($_SESSION['cemetery_id']) ? $_SESSION['cemetery_id'] : '';
if(isset($_POST['debit'])){
    $account = isset($_POST['account']) ? $_POST['account'] : '';
    $ledger = isset($_POST['ledger']) ? $_POST['ledger'] : '';
    $date = isset($_POST['date']) ? $_POST['date'] : '';
    $description = isset($_POST['description']) ? $_POST['description'] : '';
    $debit = isset($_POST['debit']) ? $_POST['debit'] : '';
    $financial_id = existFinancialReport($date);

    if($financial_id != 0){
        //1. Update financial report | expense
        //2. Insert a journal entry
        //echo 'Expense: financial report exist';
        $sql1 = "UPDATE `financial_report` SET `total_expense` = (total_expense + $debit) WHERE report_id = '$financial_id'";
        $sql2 = "INSERT INTO `entry_journal` VALUES (null, '$financial_id', '$date', '$account', '$ledger', '$debit', '0', '$description')";
        if(mysqli_query($conn, $sql1) && mysqli_query($conn, $sql2)){
            echo 'Expense: Journal entry added';
        }else{
            echo 'SQL error ' . mysqli_error($conn);
        }
    }else{
        //1. Insert a new financial report | get its last inserted id
        //2. Insert a journal entry, use the last id of financial report
        //3. update financial report | expense
        //echo 'Expense: financial report not exist';

        $report_id = insertFinancialReport($date);
        $sql2 = "INSERT INTO `entry_journal` VALUES (null, '$report_id', '$date', '$account', '$ledger', '$debit', '0', '$description')";
        $sql3 = "UPDATE `financial_report` SET `total_expense` = (total_expense + $debit) WHERE report_id = '$report_id'";
        if(mysqli_query($conn, $sql2) && mysqli_query($conn, $sql3)){
            echo 'Expense: Financial & journal entry added';
        }else{
            echo 'SQL error ' . mysqli_error($conn);
        }
    }
}

if(isset($_POST['credit'])){
    $account = isset($_POST['account']) ? $_POST['account'] : '';
    $ledger = isset($_POST['ledger']) ? $_POST['ledger'] : '';
    $date = isset($_POST['date']) ? $_POST['date'] : '';
    $description = isset($_POST['description']) ? $_POST['description'] : '';
    $credit = isset($_POST['credit']) ? $_POST['credit'] : '';
    $financial_id = existFinancialReport($date);

    if($financial_id != 0){
        //1. update financial report | total revenue
        //2. Insert a journal entry
        //echo 'Revenue: financial report exist';
        $sql1 = "UPDATE `financial_report` SET `total_revenue` = (total_revenue + $credit) WHERE report_id = '$financial_id'";
        $sql2 = "INSERT INTO `entry_journal` VALUES (null, '$financial_id', '$date', '$account', '$ledger', '0', '$credit', '$description')";
        if(mysqli_query($conn, $sql1) && mysqli_query($conn, $sql2)){
            echo 'Revenue: Journal entry added';
        }else{
            echo 'SQL error ' . mysqli_error($conn);
        }
    }else{
        //1. Insert a new financial report | get its last inserted id
        //2. Insert a journal entry, use the last id of financial report
        //3. update financial report | revenue
        //echo 'Revenue: financial report not exist';
        $report_id = insertFinancialReport($date);
        $sql2 = "INSERT INTO `entry_journal` VALUES (null, '$report_id', '$date', '$account', '$ledger', '0', '$credit', '$description')";
        $sql3 = "UPDATE `financial_report` SET `total_revenue` = (total_revenue + $credit) WHERE report_id = '$report_id'";
        if(mysqli_query($conn, $sql2) && mysqli_query($conn, $sql3)){
            echo 'Revenue: Financial & Journal entry added';
        }else{
            echo 'SQL error ' . mysqli_error($conn);
        }
    }
}

function existFinancialReport($date){
    //SELECT report_id FROM `financial_report` WHERE date_from <= '2022-02-23' AND date_to >= '2022-02-23'
    global $conn, $cemetery;
    $id = 0;

    $sqlscrpt = "SELECT report_id FROM `financial_report` WHERE date_from <= '$date' AND date_to >= '$date' AND cemetery_id = '$cemetery'";
    $result = mysqli_query($conn, $sqlscrpt);
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        $id = $row['report_id'];
    }
    return $id;
}


function insertFinancialReport($date){
    global $conn, $cemetery;
    $timestamp = strtotime($date);
    $first = date("Y-m-01", $timestamp);
    $last = date("Y-m-t", $timestamp);

    $sql = "INSERT INTO `financial_report`(`report_id`, `cemetery_id`, `date_from`, `date_to`, `total_revenue`, `total_expense`) VALUES (null, '$cemetery', '$first', '$last', 0, 0)";
    if(mysqli_query($conn, $sql)){
        return mysqli_insert_id($conn);
    }
}

exit();
?>