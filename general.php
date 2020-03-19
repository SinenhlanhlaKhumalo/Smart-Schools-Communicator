<?php
  
    include("connection.php");
    $action = $_POST["action"];
    $identify = $_POST["identifier"];
    $subject = $_POST["subject"];
    $description = $_POST["description"];
    $target = $_POST["target"];
    $school = $_POST["school"];
    $grade = $_POST["grade"];
    $link = $_POST["link"];
    
    if($action == "insert")
    {
        switch($identify)
        {
          case "general":
              echo insertRecord($conn,$subject,$description,$target,$school,$grade,$identify);
          break;
          case "quick":
              echo insertLink($conn,$subject,$link,$target,$school,$grade,$identify);
          break;
          case "policy":
              echo insertPolicy($conn,$subject,$description,$school,$link,$identify);
          break;
        }
       
    }
    else
        if($action == "read")
        {
             switch($target)
            {
              case "parent":
                   $sql = "SELECT * FROM General WHERE identifier = '$identify' AND school=$school"; 
                   getAll($conn,$sql);
              break;
              case "learner":
                  if(!$identify=="policy")
                  {
                    $sql = "SELECT * FROM General WHERE (identifier = '$identify' AND school=$school) AND (grade=$grade AND target='$target')"; 
                    getAll($conn,$sql);
                  }
                  else
                  {
                     $sql = "SELECT * FROM General WHERE (identifier = '$identify' AND school=$school)"; 
                    getAll($conn,$sql);
                  }

              break;
              case "instructor":
                  $sql = "SELECT * FROM General WHERE identifier = '$identify' AND school=$school"; 
                 getAll($conn,$sql);
              break;
            }
        }
        
    function getAll($conn,$sql)
    {
      
        $r = mysqli_query($conn,$sql); 
        $result = array();
     
         while($row = mysqli_fetch_array($r))
         {
           
             array_push($result,array("subject"=>$row['subject'],"link"=>$row['link'],"description"=>$row['description']));
         }
         if(sizeOf($result)>0)
         {
            echo json_encode(array('result'=>$result));
         }
         else
         {
             echo "nodata";
         }
      
         
        $conn->close();
    }
    
    function insertLink($conn,$subject,$link,$target,$school,$grade,$identifier)
    {
         $message = "success";
 
        $sql = "insert into General(subject,link,school,grade,target,identifier)values('$subject','$link','$school','$grade','$target','$identifier')";        
        if($conn->query($sql)===TRUE)
        {
            $message ="success";
        }
        else
        {
            $message = "fail";
        }
        $conn->close();
        return $message;
    }
    
    function insertPolicy($conn,$subject,$description,$school,$link,$identifier)
    {
         $message = "success";
        $sql = "insert into General(subject,description,school,link,identifier)values('$subject','$description','$school','$link','$identifier')";        
        if($conn->query($sql)===TRUE)
        {
            $message ="success";
        }
        else
        {
            $message = "fail";
        }
        $conn->close();
        return $message;
    }
    function insertRecord($conn,$subject,$description,$target,$school,$grade,$identifier)
    {
        $message = "success";
     
        $file_path = "resources/";
        $file_path = $file_path . basename( $_FILES['uploaded_file']['name']);
        $link = "http://mydm.co.za/schools/".$file_path;
        $sql = "insert into General(subject,description,link,school,grade,target,identifier)values('$subject','$description','$link','$school','$grade','$target','$identifier')";
        if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'],$file_path))
        {
            if($conn->query($sql)===TRUE)
            {
                $message = "success";
            }
            else
            {
               $message = "fail";
            }
        }
        $conn->close();
        return $message;
    }

?>