<?php 

require_once('connection.php');

 //Creating sql query
 $sql = "SELECT * FROM  schools ORDER BY schools.id DESC ";  
                                                                                            
 //getting result 
 $r = mysqli_query($conn,$sql);
 
 //creating a blank array 
 $result = array();
 
 //looping through all the records fetched
 while($row = mysqli_fetch_array($r)){
 
 //Pushing name and id in the blank array created 
 array_push($result,array(
  
  "logo"=>$row['logo'],
 "name"=>$row['name']
 
 ));
 }
 
 //Displaying the array in json format 
 echo json_encode(array('result'=>$result));
 
 mysqli_close($conn);
 
 ?>