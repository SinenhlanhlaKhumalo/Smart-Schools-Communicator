<?php 

require_once('connection.php');
    $sql="";
    $school_id = $_POST["school_id"];
    $grade_code = $_POST["grade_code"];
    if(!empty($school_id) && !empty($grade_code))
    {
         $sql = "SELECT DISTINCT subject FROM  AllSubjects where school_id=$school_id AND grade_code=$grade_code  ORDER BY subject ASC";  
    }
    else
    {
    
        $sql = "SELECT DISTINCT * FROM  AllSubjects where school_id=$school_id ORDER BY subject ASC";  
    }
    
    $r = mysqli_query($conn,$sql);
    
    $result = array();
    
    while($row = mysqli_fetch_array($r))
    {
    
     array_push($result,
    		 array("id"=>$row['id'],"subject"=>$row['subject']));
    }
    
    echo json_encode(array('result'=>$result));
    mysqli_close($conn);
 
 ?>