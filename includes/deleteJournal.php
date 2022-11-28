<?php  
include 'connectDB.php';

if(isset($_POST['journal'])){
    //Select first to get report_id, total_revenue, and total_expense
    //update financial report where report_id
    //DELETE the journal
    $journal_id = isset($_POST['journal']) ? $_POST['journal'] : '';
    $arr = array();
    $arr = getData($journal_id);
    $id = $arr['report_id'];
    $debit = $arr['debit'];
    $credit = $arr['credit'];

    $sql2 = "UPDATE `financial_report` SET `total_revenue` = (total_revenue - $credit) ,`total_expense` = (total_expense - $debit) WHERE report_id = '$id'";
    $sql3 = "DELETE FROM `entry_journal` WHERE journal_id = '$journal_id'";
    if(mysqli_query($conn, $sql2) && mysqli_query($conn, $sql3)){
        echo 'Journal entry has been deleted Financial report balance has been updated';
    }else{
        echo 'SQL error ' . mysqli_error($conn);
    }
}

function getData($journal_id){
    global $conn;

    $sql = "SELECT `report_id`, `debit`, `credit` FROM `entry_journal` WHERE journal_id = '$journal_id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row;
}


exit();
?>