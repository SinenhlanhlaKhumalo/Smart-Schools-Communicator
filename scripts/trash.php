<?php
	include('connection.php');
	
	$conn = new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
	$id = $_POST["id"];

	$sql = "DELETE from vehicles where vehicle_id =$id";
	//$results=$con->query($query);
	if($conn->query($sql)===TRUE)
	{
		echo "success";
	}
	else
	{
		echo "error";
	}
	$conn->close();
?>