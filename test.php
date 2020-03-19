<?php

	include('connection.php');
	$school = "50";
   // $data = selectPosts($conn,$school);
   if(file_exists("Schools/50/213/500/20"))
   {
       echo "true";
   }
   else
   {
       echo "false";
   }
   /* mkdir("Schools/50/");
     mkdir("Schools/50/213");
      mkdir("Schools/50/213/500");*/
     function selectPosts($conn,$school)
     {
        $sql = "
        SELECT *
        FROM schools
        WHERE id = '$school' ";
      
         $r = mysqli_query($conn,$sql);
         
         //creating a blank array 
         $result = array();
         
         //looping through all the records fetched
         while($row = mysqli_fetch_array($r)){
         
         //Pushing name and id in the blank array created 
         array_push($result,$row);
         }
         return json_encode(array('result'=>$result));
        $conn->close();
     }
    
?>