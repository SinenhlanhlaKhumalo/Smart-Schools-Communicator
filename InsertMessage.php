<?php
    
        require_once 'connection.php';
    
date_default_timezone_set("Africa/Johannesburg");
	        $date = new DateTime("now");
	         $date = $date->format('d F H:i');
           

	$title= $_POST["title"];
	$type= $_POST["type"];
	$message= $_POST["message"];


$sql = "INSERT INTO messageTable(title, message, type, date)
	VALUES ('$title','$message','$type',' $date')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


$conn->close();
?>