<?php 
include 'connectDB.php';

if(isset($_POST['grave_id'])){
    $html = "";
    $grave = isset($_POST['grave_id']) ? $_POST['grave_id'] : '';

    $sql = "SELECT `deceased_id`, CONCAT(`fname`, ' ', `mi`, '. ', `lname`) AS name, `burial_date`, `birth_date`, `epitaph` FROM `deceased` WHERE grave_id = $grave";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $html .= "<div class='w3-row'>" . 
                     "<div class='w3-col s3 w3-panel'>
                     <img src='assets/grave-logo.png' style='width: 100%;height: 100%;margin-top: 20px;'>" .
                     "</div>" .
                     "<div class='w3-panel w3-round-xlarge w3-col s9'>" .
                     "<h3>" . $row['name'] . "</h3>" .
                     "<i style='color: rgb(223, 116, 67);'>" . $row['epitaph'] . "</i>" .
                     "<div><p class='w3-left' style='color: #636363;'>DOB: " . $row['birth_date'] . ' - DOD:' . $row['burial_date'] . "</p>" .
                     "<button onclick='removeDeceasedInGrave(". $row['deceased_id'] .");' class='w3-button-tiny w3-right w3-round-xxlarge' style='color:white; background-color: rgb(223, 116, 67);'>Remove</button></div>" .
                     "</div>
                        <hr style='border-bottom: 1px solid #8c8b8b;'>
                     </div>";
        }
        echo $html . '<div class="w3-center"><button onclick="loadAssignDeceased();" class="w3-button w3-margin w3-indigo w3-round-xxlarge">Insert</button></div>';
    }else{
        echo '<h3 style="color:green;">This grave is vacant</h3><div class="w3-center"><button onclick="loadAssignDeceased();" class="w3-button w3-margin w3-indigo w3-round-xxlarge">Insert</button></div>';
    }
}
exit();

?>