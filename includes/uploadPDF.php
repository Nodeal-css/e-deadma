<?php 
include 'connectDB.php';

//FOLDER : documents
if(isset($_FILES['upload-pdf']['name'])){
	$folder = "D:/WAMP/www/edeadma/documents/";
	$filename = isset($_FILES['upload-pdf']['name']) ? $_FILES['upload-pdf']['name'] : '';
	$tempfile = isset($_FILES['upload-pdf']['tmp_name']) ? $_FILES['upload-pdf']['tmp_name'] : '';
	$plot_id = isset($_POST['upload-plot-id']) ? $_POST['upload-plot-id'] : '';
	//echo 'there is a file ' . $filename . '<br>tmp: ' . $tempfile;

	if($tempfile != ""){
		$path = $folder.$filename;
		$move = move_uploaded_file($tempfile, $folder.$filename);

		if($move){
			$sql = "INSERT INTO `cemetery_deed`(`deed_id`, `plot_id`, `document`) VALUES (null, '$plot_id', '$path')";
			
			if(mysqli_query($conn, $sql)){
				echo 'Successfully uploaded ';
			}else{
				echo 'Error: ' . mysqli_error($conn);
			}

			
		}else{
			echo 'Something is wrong, file not uploaded';
		}

	}
}

exit();
?>