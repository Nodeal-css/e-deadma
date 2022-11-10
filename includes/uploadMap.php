<?php 
include 'connectDB.php';
session_start();

if(isset($_FILES['upload-map'])){
    $folder = "D:/WAMP/www/edeadma/maps/";
    $filename = isset($_FILES['upload-map']['name']) ? $_FILES['upload-map']['name'] : '';
    $tempfile = isset($_FILES['upload-map']['tmp_name']) ? $_FILES['upload-map']['tmp_name'] : '';
    $cemetery = isset($_SESSION['cemetery_id']) ? $_SESSION['cemetery_id'] : '';

    if($tempfile != ""){
        $path = $folder. time() .$filename;
        //echo 'path: ' . $path;
        if(substr($filename, -3) == 'jpg' || substr($filename, -4) == 'jpeg' || substr($filename, -3) == 'png'){
            $move = move_uploaded_file($tempfile, $path);

            if($move){
                $sql = "UPDATE `cemetery` SET `cemetery_map_img`= '$path' WHERE cemetery_id = '$cemetery'";
                if(mysqli_query($conn, $sql)){
                    echo 'imgfile: ' . $path . ' uploaded to maps folder';
                }else{
                    echo 'Error updating record ' . mysqli_error($conn);
                }
                
            }else{
                echo 'Image not uploaded';
            }
        }else{
            echo 'Please upload an image format e.g: .jpg, .jpeg, .png';
        }
    }else{
        echo 'Empty tmp_name';
    }
}else{
    echo 'File too large';
}

exit();
?>