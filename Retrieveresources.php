<?php 
    require_once('connection.php');
    $sql="";
    $response="nodata";
    switch($_POST["which_one"])
    {
        case "learner":
            $which_one = $_POST["which_one"];
            $school_id =$_POST["school"];
            $grade_id = $_POST["grade"];
            $subject_name = $_POST["subject"];
            $resource = $_POST["type"];
            $sql = "SELECT * FROM  Resources WHERE type='$which_one' AND resource = '$resource' AND school='$school_id' AND (grade='$grade_id' OR grade='All') AND (subject='$subject_name' OR subject='All') ORDER BY Resources.id DESC"; 
        break;
        case "instructor":
            $which_one = $_POST["which_one"];
            $school_id =$_POST["school"];
            $sql = "SELECT * FROM  Resources WHERE type='$which_one' AND school='$school_id' ORDER BY Resources.id DESC"; 
            $response="success";
        break;
        default:
            $which_one = $_POST["which_one"];
            $school_id = $_POST["school"];
            $sql = "SELECT * FROM  Resources WHERE (type='$which_one' AND school='$school_id') ORDER BY Resources.id DESC";
        break;
    }
    $r = mysqli_query($conn,$sql); 
    $result = array();
     //looping through all the records fetched
     while($row = mysqli_fetch_array($r))
     {
         //Pushing name and id in the blank array created 
         array_push($result,array("title"=>$row['title'],"type"=>$row['type'],"description"=>$row['message'], "subject"=>$row['subject'],"grade"=>$row['grade'], "link"=>$row['link'],"date"=>$row['date'],"sender"=>$row['sender']));
        $response="success";
     }
     
     //Displaying the array in json format 
    if($response=='success')
    {
        echo json_encode(array('result'=>$result));
    }
    else
    {
       echo $response; 
    }
     mysqli_close($conn);

 ?>