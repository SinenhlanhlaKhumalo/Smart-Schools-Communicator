<?php
	include('connection.php');
    include('notification.php');
	$receive="";
	 $result;
    $subject = $_POST["subject"];
    $message = $_POST["message"];
    $learners = $_POST["learner"];
    $parents = $_POST["parent"];
    $staff = $_POST["staff"];
    $school = $_POST['school'];
    $staff_grade = $_POST["staff_grade"];
    $sender = $_POST["sender"];
    date_default_timezone_set("Africa/Johannesburg");
	        $date = new DateTime("now");
	         $time = $date->format('d F H:i');
    
    if(!empty($learners))
    {
        $result = sendMessage($conn,$subject,$message,$learners,$school,$time,$_POST["learner_grade"],$sender);
         notify($result,$conn,$school,$learners,"Users");
    }
    
    if(!empty($parents))
    {
        $result = sendMessage($conn,$subject,$message,$parents,$school,$time,"",$sender);
         notify($result,$conn,$school,$parents,"Users");
    }
    if(!empty($staff))
    {
        $result = sendMessage($conn,$subject,$message,$staff,$school,$time,$staff_grade,$sender);
        notify($result,$conn,$school,$staff,"staff");
    }
    
    function sendMessage($conn,$subject,$message,$receiver,$school,$time,$grade,$sender)
    {
        $result; 
        $sql = "insert into messageTable(title,message,sender,type,school,date,grade)values('$subject','$message','$sender','$receiver','$school','$time','$grade')"; 
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