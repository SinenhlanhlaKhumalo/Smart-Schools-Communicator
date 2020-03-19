<?php
	include('connection.php');

    $unique = md5($_POST["unique"]);
 
date_default_timezone_set("Africa/Johannesburg");
	        $date = new DateTime("now");
	         $time = $date->format('d F H:i');
    $file_path = "resources/";
    $file_path = $file_path . basename( $_FILES['uploaded_file']['name']);
    $filename = basename( $_FILES['uploaded_file']['name']);
    $link = "http://mydm.co.za/schools/".$file_path;

    if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'],$file_path)) 
    {
        sendDoc($conn,$link,$unique,$time);
    }
    else
    {
        echo "fail";
    }
    
    function sendDoc($conn,$link,$unique,$time)
    {
        $result; 
        $sql = "insert into temp_files(unique_id,link,date)values('$unique','$link','$time')"; 
    	if($conn->query($sql)===TRUE)
        {
          
        }

    }
    
?>