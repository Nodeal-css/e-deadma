<?php 

$localhost = "localhost";
$user = "root";
$password = "";
$dbname = "edeadma";

$conn = new mysqli($localhost, $user, $password, $dbname);
if(!$conn){
	die(mysql_error($conn));
}

?>