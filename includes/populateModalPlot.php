<?php 
include 'connectDB.php';

if(isset($_POST['grave_id'])){
    $grave = isset($_POST['grave_id']) ? $_POST['grave_id'] : '';
    $html = "";

    $sql = "SELECT `plot_id`, `grave_id`, plot_ownership.owner_id, CONCAT(fname, ' ', mi, '. ', lname) AS owner, CONCAT(street, ', ', city, ', ', zip) AS address, phone_no, email, `date_purchased`, `ownership_status` FROM `plot_ownership`, owner WHERE grave_id = '$grave' AND owner.owner_id = plot_ownership.owner_id;";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        $html = "<div class='w3-row'>" . 
                "<div class='w3-col s6'>" .
                "<table class='w3-table'>" .
                    "<tr><td></td><th>Owner</th></tr>" .
                    "<tr><td>Name: </td><th>" . $row['owner'] . "</th></tr>" .
                    "<tr><td>Address: </td><th>" . $row['address'] . "</th></tr>" .
                    "<tr><td>Contact: </td><th>" . $row['phone_no'] . "</th></tr>" .
                    "<tr><td>Email: </td><th>" . $row['email'] . "</th></tr>" .
                "</table>" .
                "</div>" . 
                "<div class='w3-col s6'>" .
                "<table class='w3-table'>" .
                    "<tr><td></td><th>Plot</th></tr>" .
                    "<tr><td>Date acquired: </td><th>" . $row['date_purchased'] . "</th></tr>" .
                    "<tr><td>Status: </td><th>" . $row['ownership_status'] . "</th></tr>" .
                    "<tr><td>Grave no: </td><th>" . $row['grave_id'] . "</th></tr>" .
                "</table>" .
                "</div>" .
                "</div>";
    }else{
        $html = "<h3 class='w3-margin'>No record of plot ownership for this grave</h3>";
    }
    echo $html . '<div class="w3-center"><button onclick="loadAssignPlot();" class="w3-button w3-margin w3-indigo w3-round-xxlarge">Edit</button></div>';
}
exit();
?>