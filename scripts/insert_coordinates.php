<?php
    include("connection.php");

	$token = $_POST["Token"];
	$latitude = $_POST["latitude"];
	$longitude = $_POST["longitude"];
	
	$conn = new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
	
	$sql = "INSERT INTO devices(device_token,device_lati,device_longi)VALUES('$token','$latitude','$longitude')ON DUPLICATE KEY UPDATE device_token = '$token',device_lati='$latitude',device_longi='$longitude'";
	//$results=$con->query($query);
	if($conn->query($sql)===TRUE)
	{
		echo "Success";
	}
	$conn->close();
?>