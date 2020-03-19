<?php
    
    require_once 'connection.php';
        
    date_default_timezone_set("Africa/Johannesburg");
    $date = new DateTime("now");
    $date = $date->format('d-m-Y H:ia');
    
    $title = $_POST["title"];
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $dob = $_POST["dob"];
    $gender = $_POST["gender"];
    $school = $_POST["school"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $type = $_POST["type"];
    $device = $_POST["device"];
    
    $message = user_registration($conn,$title,$name,$surname,$dob,$gender,$school,$email,$username,$password,$type,$device);
    echo $message;
    function user_registration($conn,$title,$name,$surname,$dob,$gender,$school,$email,$username,$password,$type,$device)
    {
        $message;
        $sql = "SELECT id FROM staff WHERE username='$username'";
        if($conn->query($sql)===TRUE)
        {
             $message = "Username Already Exist. Try another one";
        }
        else
        {
            $sql ="insert into staff(title,name,surname,dob,gender,school,email,username,password,type,device_id)values('$title','$name','$surname','$dob','$gender','$school','$email','$username','$password','$type','$device') ON DUPLICATE KEY UPDATE device_id=''";
            if($conn->query($sql)===TRUE)
            {
             $message = "success";
            }
            else
            {
               $message = "error"; 
            }
        }
        return $message;
    }

   $conn->close();
?>