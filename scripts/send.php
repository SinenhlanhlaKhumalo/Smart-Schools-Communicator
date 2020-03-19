<?php
	include('connection.php');
	include('notification.php');
	include('functions_message.php');
    
	$conn = new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
	
    $subject = $_POST["subject"];
    $message = $_POST["message"];
    $username = $_POST["username"];
    $attachment = $_POST['attachment'];
    $urgent = $_POST['urgent'];
    $username = $_POST['username'];

    date_default_timezone_set("Africa/Johannesburg");
    $time = new DateTime("now");
    $time = $time->format('H:ia');

    $user_id = userId($username,$conn);
    $user = userDetails($username,$conn);

    $result = insertMessage($subject,$message,$conn);
    $message_id= selectMessage($conn);
    $arraymessage= insertPost($subject,$message,$message_id,$user_id,$user,$attachment,$urgent,$time);
    notify($arraymessage);

?>