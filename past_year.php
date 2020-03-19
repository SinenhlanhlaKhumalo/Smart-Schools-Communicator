<?php
	include('connection.php');

	$school = $_POST["school"];
	$grade = $_POST["grade"];
	$module = $_POST["module"];
	$action = $_POST["action"];
	
	switch($action)
	{
	    case "POST":
	            $description = $_POST["description"];
	            $subject = $_POST["subject"];
	            date_default_timezone_set("Africa/Johannesburg");
	        $date = new DateTime("now");
	         $time = $date->format('d F H:i');
	           $data = post($conn,$subject,$description,$school,$grade,$module,$time);
               echo $data; 
        break;
        case "GET":
            get($conn,$school,$grade,$module);
        break;
	}

     function post($conn,$subject,$description,$school,$grade,$module,$time)
     {
        $file_path = "resources/";
        $file_path = $file_path . basename( $_FILES['uploaded_file']['name']);
        $filename = basename( $_FILES['uploaded_file']['name']);
        $link = "http://mydm.co.za/schools/".$file_path;
    
        if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'],$file_path)) 
        {
            sendDoc($conn,$subject,$description,$school,$grade,$module,$link,$time);
        }
        else
        {
            echo "fail";
        }
        
     }
 
    function sendDoc($conn,$subject,$description,$school,$grade,$module,$link,$time)
    {
        $result; 
        $sql = "insert into PreviousYears(subject,description,school,grade,module,link,date)values('$subject','$description','$school','$grade','$module','$link','$time')"; 
    	if($conn->query($sql)===TRUE)
        {
          $result="success";
        }
        else
        {
            $result = "fail";
        }

    }
      function get($conn,$school,$grade,$module)
     {
        $post=array();
        $count=0;
        $response="nodata";
        $sql ="SELECT * FROM PreviousYears where school = '$school' AND grade = '$grade' AND module = '$module' ORDER BY id DESC";
      
        $r = mysqli_query($conn,$sql); 
        $result = array();
         while($row = mysqli_fetch_array($r))
         {
            array_push($result,array("subject"=>$row['subject'],"description"=>$row['description'],"link"=>$row['link']));
            $response="success";
         }
         
        if($response=='success')
        {
            echo json_encode(array('result'=>$result));
        }
        else
        {
           echo $response; 
        }
             
        $conn->close();
     }
?>