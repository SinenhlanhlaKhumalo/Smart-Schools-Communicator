<?php
 include("connection.php");
 if(isset($_POST["device"]))
 {
 	$lock = $_POST["lock"];
 	$key = $_POST["key"];
 	getIn($lock,$key,$conn);
 	
 }
  function getIn($lock,$key,$conn)
 {
 	$access=array();
 //	$password = md5($password);
 	$sql = "SELECT * FROM  staff WHERE username='$lock' AND password='$key'";
	$results = $conn->query($sql);
	
     if($results->num_rows > 0)
      { 
         $access["access"] = "granted";
         while($row=$results->fetch_assoc())
         {
            $access['staff_id'] = $row['id'];
           $access['privileges'] = $row['type'];
           $access['school'] = $row['school'];
           $access['device'] = $row['device_id'];
           $access['username'] = $row['username'];
           $access['email'] = $row['email'];
           $access['name'] = $row['name'];
           $access['title'] = $row['title'];
           $access['surname'] = $row['surname'];
          $access['dob'] = $row['dob'];
          $access['gender'] = $row['gender'];
          $access['pic'] = $row['pic'];
         }
      }
    else
    {
       $access["access"]="denied";
       $access["privileges"]="unknown";
    }
    echo json_encode($access);
     $conn->close();
 }
?>