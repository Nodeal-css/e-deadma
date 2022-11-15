<?php 
include 'connectDB.php';

if(isset($_POST['grave_id'])){
    $html = "";
    $grave = isset($_POST['grave_id']) ? $_POST['grave_id'] : '';

    $sql = "SELECT `deceased_id`, CONCAT(`fname`, ' ', `mi`, '. ', `lname`) AS name, `burial_date`, `birth_date`, `epitaph` FROM `deceased` WHERE grave_id = $grave";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $html .= "<div class='w3-panel w3-red w3-round-xlarge'>" .
                     "<h3>" . $row['name'] . "</h3>" .
                     "<i>" . $row['epitaph'] . "</i>" .
                     "<p>DOB: " . $row['birth_date'] . "</p>" .
                     "<p>DOD: " . $row['burial_date'] . "</p></div>";
        }
        echo $html;
    }else{
        echo '<p style="color:green;">This grave is vacant</p>';
    }
}
exit();

?>