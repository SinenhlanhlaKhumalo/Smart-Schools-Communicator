<?php

 include('connection.php');
 $conn = new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
 function insertDotument($title,$descript,$username)
 {
     
 }
 function userDetails($username)
 { 
 	$userdetails="";
 	$sql = "select user_initial,user_title,user_surname from users where username='".$username."'";
	$results = $conn->query($sql);
	if($result->num_rows > 0)
	{
	   while($row = $result->fetch_assoc())
	   {
	   	 $userdetails = $row['user_title']." ".$row['user_initial']." ".$row['user_surname'];
	   }
    }
    return $userdetails;
 } 
 function userId($username)
 {
 	$userid="";
 	$sql = "select user_id from users where username='".$username."'";
	$results = $conn->query($sql);
	if($result->num_rows > 0)
	{
	   while($row = $result->fetch_assoc())
	   {
	   	 $userid = $row['user_id'];
	   }
    }
    return $userid;
 }
 
?>