<?php
	include('connection.php');
	include('filtering_functions.php');
	include('subscribe_functions.php');
	$conn = new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);

	$email = $_POST["email"];
	$full_name = $_POST["name"];
	$cell_no = $_POST["cell"];
	$car_manufacturer = $_POST["manufacturer"];
	$price = $_POST["price"];
	$device = $_POST["device"];
	$minPrice = getMinPrice($price);
	$maxPrice = getMaxPrice($price);
    $message = subscribe_to_vehicles($conn,$email,$full_name,$cell_no,$car_manufacturer,$minPrice,$maxPrice,$device);
    echo $message;
?>