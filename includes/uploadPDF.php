<?php 
include 'connectDB.php';

//FOLDER : documents
if(isset($_FILES['upload-pdf'])){
	$folder = "D:/WAMP/www/edeadma/documents/";
	$filename = isset($_FILES['upload-pdf']['name']) ? $_FILES['upload-pdf']['name'] : '';
	$tempfile = isset($_FILES['upload-pdf']['tmp_name']) ? $_FILES['upload-pdf']['tmp_name'] : '';
	$plot_id = isset($_POST['upload-plot-id']) ? $_POST['upload-plot-id'] : '';
	//echo 'there is a file ' . $filename . '<br>tmp: ' . $tempfile;

	if($tempfile != ""){
		$path = $folder. time() .$filename;
		
		if(substr($filename, -3) == 'pdf'){
			$move = move_uploaded_file($tempfile, $path);

			if($move){
				if(!checkExist($plot_id)){
					$sql = "INSERT INTO `cemetery_deed`(`deed_id`, `plot_id`, `document`) VALUES (null, '$plot_id', '$path')";
					
					if(mysqli_query($conn, $sql)){
						echo 'Successfully uploaded ';
					}else{
						echo 'Error: ' . mysqli_error($conn);
					}
				}else{
					$sql2 = "UPDATE `cemetery_deed` SET `document`= '$path' WHERE `plot_id` = '$plot_id'";
					if(mysqli_query($conn, $sql2)){
						echo 'Successfully updated';
					}else{
						echo 'Error: ' . mysqli_error($conn);
					}
				}
				
			}else{
				echo 'Something is wrong, file not uploaded';
			}
		}else{
			echo 'Pls upload pdf format';
		}

	}else{
		echo 'Empty tmp_name';
	}
}else{
	echo 'No post request';
}

//Create a method to check if there is an existing plot_id in `cemetery_deeds` table
	function checkExist($id){
		global $conn;
		$sql = "SELECT * FROM `cemetery_deed` WHERE plot_id = '$id'";
		$result = mysqli_query($conn, $sql);
		if(mysqli_num_rows($result) > 0){
			return true;
		}
		return false;
	}

exit();
?>