<?php
	include('connection.php');
    include('functions_retrieve.php');
	$conn = new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
	$type = $_POST["type"];
    $data = selectPosts($conn,$type);
    echo $data;
?>