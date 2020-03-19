<?php

require_once 'connection.php';
 

 date_default_timezone_set("Africa/Johannesburg");
	        $date = new DateTime("now");
	        $date = $date->format('d-m-Y H:ia');
 
 	$name= $_POST["name"];
 	 $logo = $_POST['logo'];

	
 
 $sql ="SELECT id FROM schools ORDER BY id ASC";
 
 $res = mysqli_query($conn,$sql);
 
 $id = 0;
 
 while($row = mysqli_fetch_array($res)){
 $id = $row['id'];
 }
 
 $path = "schoollogo/$id.png";
 
 $actualpath = "http://mydm.co.za/resources/$path";
 
// $sql = "INSERT INTO schools(name, logo, time) VALUES ('$name','$actualpath','$date')";
 
 if(mysqli_query($conn,$sql))
 {
     file_put_contents($path,base64_decode($image));
     echo "Successfully Uploaded";
 }
else{
 echo "Error";
 }
 
 mysqli_close($conn);
 ?>