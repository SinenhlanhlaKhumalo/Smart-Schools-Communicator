<?php
	include('connection.php');
    include('notification.php');
	$receive="";
	$result;
    $subject = $_POST["subject"];
    $message = $_POST["message"];
    $school = $_POST['school'];
    
    date_default_timezone_set("Africa/Johannesburg");
	        $date = new DateTime("now");
	         $time = $date->format('d F H:i');
    $result = sendMessage($conn,$subject,$message,"principal",$school,$time,"");
    notify($result,$conn,$school,"principal","staff");
    function sendMessage($conn,$subject,$message,$receiver,$school,$time,$grade)
    {
        $result; 
        $sql = "insert into messageTable(title,message,type,school,date,grade)values('$subject','$message','$receiver','$school','$time','$grade')"; 
    	if($conn->query($sql)===TRUE)
        {
           $result = array('key'=>"message",'subject'=>$subject,'time'=>$time,'message'=>$message,'school'=>$school);
           echo "success";
        }
        else
        {
            echo "fail";
        }
        return $result;
    }
   $conn->close(); 
?>