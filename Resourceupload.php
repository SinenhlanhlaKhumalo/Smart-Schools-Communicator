<?php

require_once 'connection.php';
 
 $image = $_POST['image'];
 date_default_timezone_set("Africa/Johannesburg");
	        $date = new DateTime("now");
	        $date = $date->format('d-m-Y H:ia');
 
 	$subject= $_POST["subject"];
	$title= $_POST["title"];
	$type= $_POST["type"];
	$description= $_POST["description"];
	$grade= $_POST["grade"];
	$link= $_POST["link"];
	
 
 $sql ="SELECT id FROM Resources ORDER BY id ASC";
 
 $res = mysqli_query($conn,$sql);
 
 $id = 0;
 
 while($row = mysqli_fetch_array($res)){
 $id = $row['id'];
 }
 
 $path = "resources/$id.png";
 
 $actualpath = "http://mydm.co.za/school/$path";
 
 $sql = "INSERT INTO Resources(title, type, description, subject, grade, link, date) VALUES ('$title','$type','$description','$subject','$grade','$actualpath','$date')";
 
 if(mysqli_query($conn,$sql)){
 file_put_contents($path,base64_decode($image));
 echo "Successfully Uploaded";

 }
else{
 echo "Error";
 }
 
 mysqli_close($conn);
 ?>