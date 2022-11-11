<?php 
include 'connectDB.php';

if(isset($_POST['request'])){
    $directory = "D:/WAMP/www/edeadma/maps/";
    $files = glob($directory . "*.{jpg,jpeg,png}", GLOB_BRACE);
    $html = "";
    foreach($files as $file){
        if(checkImageExist($file)){
            $html .= "deleted: " . substr($file, 20) . "\n";
            unlink($file);
        }
    }
    echo $html;
}
exit();

//function to check the images if it exist in DB
function checkImageExist($image){
    global $conn;
    $sql = "SELECT `cemetery_id`, `cemetery_map_img` FROM `cemetery` WHERE `cemetery_map_img` = '$image'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        return false;
    }
    return true;
}

?>