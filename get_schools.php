<?php 

include('connection.php');

 $sql = "SELECT * FROM  schools ORDER BY schools.name ASC ";  
                                                
 $r = mysqli_query($conn,$sql);
 $result = array();
 
 while($row = mysqli_fetch_array($r))
 {
 
 array_push($result,array("id"=>$row['id'],"logo"=>$row['logo'],"name"=>$row['name']));
 }
 
 echo json_encode(array('result'=>$result));
 
 mysqli_close($conn);
 
 ?>