<?php

	include('connection.php');
	$token = $_POST["token"];
	$id = $_POST["id"];
	$school = $_POST["school"];
    $sql="UPDATE staff SET device_id='$token',school='$school' WHERE id='$id'";
    if($conn->query($sql)===TRUE)
    {
       
    }
?>