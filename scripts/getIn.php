<?php
 include("connection.php");
 include("functions.php");
 if(isset($_POST["device"]))
 {
 	$conn = new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);

 	$lock = $_POST["lock"];
 	$key = $_POST["key"];
 	getIn($lock,$key,$conn);
 }
?>