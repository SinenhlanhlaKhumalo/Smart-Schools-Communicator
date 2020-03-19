<?php
    include("connection.php");

	$token = $_POST["Token"];
	
	$conn = new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
	
//	$sql = "INSERT INTO users(device_token)VALUES('$token')ON DUPLICATE KEY UPDATE device_token = '$token'";
	//$results=$con->query($query);
/*	if($conn->query($sql)===TRUE)
	{
		echo "Success";
	}*/
	echo "success";
	$conn->close();
?>