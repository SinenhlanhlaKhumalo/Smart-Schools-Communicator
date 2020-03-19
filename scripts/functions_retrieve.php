<?php
 function selectPosts($conn,$type)
 {
    $post=array();
    $count=0;
    $sql ="SELECT * FROM posts where attachment = '$type' ORDER BY post_id DESC";
  
    $results = $conn->query($sql);
    $rows = $results->num_rows;
 
	if($results->num_rows > 0)
	{
	       while($row = $results->fetch_assoc())
    	   {
    	       
             $post[] =  $row;
            $count++;
    	   }
	}
    if($count>0)
    {
        return json_encode($post);
    }
    else
    {
     return "nodata";
    }
    $conn->close();
 }
  function selectVehilces($conn)
 {
    $post=array();
    $count=0;
    $sql ="SELECT * FROM vehicles ORDER BY vehicle_id DESC";
  
    $results = $conn->query($sql);
    $rows = $results->num_rows;
 
	if($results->num_rows > 0)
	{
	       while($row = $results->fetch_assoc())
    	   {
    	       
             $post[] =  $row;
             $count++;
    	   }
	}
    if($count>0)
    {
        echo json_encode($post);
    }
    else
    {
     echo"nodata";
    }
     $conn->close();
 }
 
function selectGroups($conn)
 { 
    $post=array();
    $count=0;
 	$sql = "select * from Groups";
	$results = $conn->query($sql);
	if($results->num_rows > 0)
	{
	   while($row = $results->fetch_assoc())
	   {
             $post[] =  $row;
             $count++;
	   }
    }
    if($count>0)
    {
       return json_encode($post);
    }
    else
    {
      return "nodata";
    }
     $conn->close();
 }

?>