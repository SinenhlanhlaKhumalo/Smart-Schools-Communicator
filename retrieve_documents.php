<?php
require_once('connection.php');

 $school = $_POST["school"];
 $which_one = $_POST["user"];

$sql = "SELECT * FROM  Resources WHERE sender='$which_one' AND school='$school' ORDER BY Resources.id DESC"; 
select($conn,$sql);
 function select($conn,$sql)
 {
     $r = mysqli_query($conn,$sql);
     $result = array();
     while($row = mysqli_fetch_array($r))
     {
    
     array_push($result,$row);
 }
 echo json_encode(array('result'=>$result));
 }
 mysqli_close($conn);

?>