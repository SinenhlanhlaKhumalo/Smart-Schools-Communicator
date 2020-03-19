<?php
function insertMessage($subject,$message,$conn)
{
    $reslut =false; 
    $sql = "insert into messages(message,subject)values('".$subject."','".$message."')"; 
	if($conn->query($sql)===TRUE)
    {
       $result = true; 
    }
    return $result;
}

function selectMessage($conn)
{
    $message_id;
    $sql = "SELECT * FROM messages ORDER BY message_id DESC LIMIT 1";

	$results = $conn->query($sql);
	
	if($results->num_rows > 0)
	{
	   while($row = $results->fetch_assoc())
	   {
         $message_id=$row['message_id'];
	   }
	}
	return $message_id;
 }

 function insertPost($subject,$message,$message_id,$user_id,$user,$attachment,$urgent,$time)
 {
     $conn = new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
     $singlemessage;
	 $sql = "insert into posts(message_id,user_id,attachment,urgent,time)values('$message_id','$user_id','$attachment','$urgent','$time')";
	 if($conn->query($sql)===TRUE)
	 {
	 	$singlemessage = array('subject'=>$title,'time'=>$time,'message'=>$message,'attachment'=>$attachment,'urgent'=>$urgent,'user'=>$user);
	 }
	 return $singlemessage;
 }
 function userDetails($username,$conn)
 { 
 	$userdetails;
 	$sql = "select * from users where username='.$username.'";
	$results = $conn->query($sql);
	if($results->num_rows > 0)
	{
	   while($row = $results->fetch_assoc())
	   {
	   	 $userdetails = $row['user_title']." ".$row['user_initial']." ".$row['user_surname'];
	   }
    }
    return $userdetails;
 }
 
 function userId($username,$conn)
 {
 	$userid;
 	$sql = "select user_id from users where username='$username'";
	$results = $conn->query($sql);
	if($results->num_rows > 0)
	{
	   while($row = $results->fetch_assoc())
	   {
	   	 $userid = $row['user_id'];
	   }
    }
    return $userid;
 }
?>