<?php
 function insertPost($subject,$message,$link,$filename,$user,$attachment,$urgent,$time,$conn)
 {
     $messages;
	 $sql = "insert into posts(user,subject,message,link,filename,attachment,urgent,time)values('$user','$subject','$message','$link','$filename','$attachment','$urgent','$time')";
	 if($conn->query($sql)===TRUE)
	 {
	 	$messages = array('subject'=>$subject ,'time'=>$time, 'message'=>$message,'attachment'=>$attachment,'urgent'=>$urgent, 'user'=>$user,'link'=>$link,'filename'=>$filename);
	 }
	  $conn->close();
	 return $messages;
 }
  function insertUser($username,$password,$initial,$title,$district,$email,$surname,$phone,$privileges,$conn)
 {
     $message;
     $sql = "select * from users where username='$username'";
	$results = $conn->query($sql);
	if($results->num_rows > 0)
	{
        $message = "username exists";
    }
    else
    {
       	 $sql = "insert into users(username,password,user_initial,user_title,district,user_email,user_surname,user_phone,privileges)values('$username','$password','$initial','$title','$district','$email','$surname','$phone','$privileges')";
    	 if($conn->query($sql)===TRUE)
    	 {
    	 	$message = "success";
    	 } 
    }
    $conn->close();
	return $message;
 }
 function users_devices($conn)
 {
 	$post=array();
    $count=0;
 	$sql = "select device_token from devices";
	$results = $conn->query($sql);
	if($results->num_rows > 0)
	{
	   while($row = $results->fetch_assoc())
	   {
	   	    $post[] =  $row;
            $count++;
	   }
    }
    if($count>0)
    {
        echo json_encode($post);
    }
    else
    {
     echo"nodata";
    }
    $conn->close();
 }
 function createGroup($group_name,$group_admin,$conn)
 {
    $message = "failed";
     $sql = "insert into Groups(group_name,group_admin)values('$group_name','$group_admin')";
     if($conn->query($sql)===TRUE)
     {
        $message = "success";
     } 
   $conn->close();
    return $message;
 }
 function userDetails($username,$conn)
 { 
 	$userdetails;
 	$sql = "select * from users where username='$username'";
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
  function getIn($username,$password,$conn)
 {
 	$access=array();
 	$password = md5($password);
 	$sql = "select * from users where username='$username' AND password='$password'";
	$results = $conn->query($sql);
	
     if($results->num_rows > 0)
      { 
         $access["access"] = "granted";
         while($row=$results->fetch_assoc())
         {
           $access['privileges'] = $row['privileges'];
         }
      }
    else
    {
       $access["access"]="denied";
       $access["privileges"]="unknown";
    }
    $conn->close();
    echo json_encode($access);
 }
 
?>