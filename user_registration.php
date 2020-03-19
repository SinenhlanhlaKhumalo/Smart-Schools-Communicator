<?php
  
    include("connection.php");
    
    $title = $_POST["title"];
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $dob = $_POST["dob"];
    $gender = $_POST["gender"];
    $school = $_POST["school"];
    $email = $_POST["email"];
    $grade = $_POST["grade"];
    $type = $_POST["type"];
    $device = $_POST["device"];

    $message = user_registration($conn,$title,$name,$surname,$dob,$gender,$school,$email,$grade,$type,$device);
    echo $message;

    function user_registration($conn,$title,$name,$surname,$dob,$gender,$school,$email,$grade,$type,$device)
    {
        $message;
        $sql ="insert into Users(title,name,surname,dob,gender,school,email,grade,type,device_id)values('$title','$name','$surname','$dob','$gender','$school','$email','$grade','$type','$device')";
        if($conn->query($sql)===TRUE)
        {
         $message = "success";
        }
        else
        {
            $message="error";
        }
        return $message;
    }

?>