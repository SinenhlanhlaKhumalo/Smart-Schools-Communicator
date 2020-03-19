<?php
	include('connection.php');
	include('functions.php');
	$conn = new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);

	$devices = users_devices($conn);
	echo $devices;
?>