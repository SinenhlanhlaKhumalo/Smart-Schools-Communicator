<?php
	include('connection.php');
	include('filtering_functions.php');
	$conn = new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);

	$province = $_POST["province"];
	$make = $_POST["make"];
	$price = $_POST["price"];
	$year = $_POST["year"];
	
	$minPrice = getMinPrice($price);
	$maxPrice = getMaxPrice($price);
	$minYear = getMinYear($year);
	$maxYear = getMaxYear($year);
	
	filtering_vehicles($conn,$province,$make,$minPrice,$maxPrice,$minYear,$maxYear);
?>