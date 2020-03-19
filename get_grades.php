<?php 

require_once('connection.php');

 //Creating sql query
 $school_id = $_POST["school_id"];
 $sql = "SELECT * FROM  AllGrades WHERE school_id=$school_id ORDER BY AllGrades.grade ASC";  

 $r = mysqli_query($conn,$sql);

 $result = array();
 
 while($row = mysqli_fetch_array($r))
 {
 
 array_push($result,
			 array("id"=>$row['id'],
					 "grade"=>$row['grade']));
 }
 
 echo json_encode(array('result'=>$result));
 
 mysqli_close($conn);
 
 ?>