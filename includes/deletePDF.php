<?php 
include 'connectDB.php';

if(isset($_POST['request'])){
	$directory = "D:/WAMP/www/edeadma/documents/";
	$files = glob($directory . "*.pdf");
	$html = "";
	foreach($files as $file){
		if(checkPdf($file)){
			$html .= "deleted: " . $file . "\n";
			unlink($file);
		}
	}
	echo ':' . $html;
}

function checkPdf($pdf){
	global $conn;
	$sql = "SELECT `document` FROM `cemetery_deed` WHERE document = '$pdf'";
	$result = mysqli_query($conn, $sql);
	if(mysqli_num_rows($result) > 0){
		return false;
	}
	return true;
}

exit();
?>