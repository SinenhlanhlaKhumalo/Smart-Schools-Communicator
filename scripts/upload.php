<?php
  
    include("connection.php");
	include("notification.php");
	include("functions.php");

  	$conn = new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
  	
    
    $subject = $_POST["subject"];
    $message = $_POST["message"];
    $username = $_POST["username"];
    $attachment = $_POST['attachment'];
    $type = $_POST['type'];
    $urgent = $_POST['urgent'];
    $user = userDetails($username,$conn);
    
    date_default_timezone_set("Africa/Johannesburg");
    $time = new DateTime("now");
    $time = $time->format('d F H:i');
    
    if($attachment=='yes')
    {
        if($type=='document')
        {
            $time = new DateTime("now");
            $time = $time->format('d F H:i');
            $file_path = "documents/";
            $file_path = $file_path . basename( $_FILES['uploaded_file']['name']);
            $filename = basename( $_FILES['uploaded_file']['name']);
            $link = "http://mydm.co.za/Autodealer/scripts/".$file_path;
    
            if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $file_path)) 
            {
             
              $message = insertPost($subject,$message,$link,$filename,$user,$attachment,$urgent,$time,$conn);
              notify($message);
            }
            else
            {
                echo "fail";
            }
        }
        else
            if($type=='video')
            {
                $file_path = "videos/";
                $file_path = $file_path . basename( $_FILES['uploaded_file']['name']);
                $filename = basename( $_FILES['uploaded_file']['name']);
                $link = "http://mydm.co.za/Autodealer/scripts/".$file_path;
        
                if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $file_path)) 
                {
                 
                  $message = insertPost($subject,$message,$link,$filename,$user,$type,$urgent,$time,$conn);
                  echo "success";
                }
                else
                {
                    echo "fail";
                }
            }
            else
                if($type=='image')
                {
                    $file_path = "images/postImages/";
                    $file_path = $file_path ."KBJFHcfgj".uniqid().'.png';
                    $filename = $date."KBJFHcfgj".uniqid().'.png';
                    $link = "http://mydm.co.za/Autodealer/scripts/".$file_path;
                    
                    if(file_put_contents($file_path , base64_decode($subject))) 
                    {
                     $subject="";
                      $message = insertPost($subject,$message,$link,$filename,$user,$type,$urgent,$time,$conn);
                      notify($message);
                    }
                    else
                    {
                        echo "fail";
                    }
                }

    }
    else
    {
          $filename="";
          $link = "";
          $message = insertPost($subject,$message,$link,$filename,$user,$attachment,$urgent,$time,$conn);
         
          notify($message);
    }
 ?>