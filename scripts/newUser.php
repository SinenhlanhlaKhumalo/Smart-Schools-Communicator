<?php
	include('connection.php');
	include('functions.php');
    
	$conn = new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
	
	$username = $_POST["username"];
	$password = md5($_POST['password']);
	$initial = $_POST['initial'];
    $title = $_POST["title"];
    $district = $_POST["district"];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $phone = $_POST['cell'];
    $privileges = $_POST['privileges'];

    $result = insertUser($username,$password,$initial,$title,$district,$email,$surname, $phone,$privileges,$conn);

?>