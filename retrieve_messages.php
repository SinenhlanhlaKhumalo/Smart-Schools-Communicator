<?php
require_once('connection.php');

 $school = $_POST["school"];
 $which_one = $_POST["user"];
 $resource = $_POST["resource"];
 switch($resource)
 {
     case "delete_messages":
        $sql = "SELECT * FROM  messageTable WHERE sender='$which_one' AND school='$school' ORDER BY messageTable.id DESC"; 
        select($conn,$sql);
     break;
     case "delete_documents":
         $sql = "SELECT * FROM  Resources WHERE sender='$which_one' AND school='$school' ORDER BY Resources.id DESC "; 
         select($conn,$sql);
     break;
     case "delete_videos":
        $sql = "SELECT * FROM  media WHERE uploader='$which_one' AND school='$school' AND which_one='video' ORDER BY media.id DESC"; 
        select($conn,$sql);
     break;
     case "delete_images":
        $sql = "SELECT * FROM  media WHERE uploader='$which_one' AND school='$school' AND which_one='image' ORDER BY media.id DESC "; 
        select($conn,$sql);
     break;
 }

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