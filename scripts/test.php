<?php

    include_once("connection.php");
  
	$conn = new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
			$post=array();
	    $count=0;
	    $sql="";
	    $response="nodata";
	$minPrice = "100000";
	$maxPrice = "299000";
		$minYear = "2020";
	$maxYear = "2024";
   $sql ="SELECT * FROM vehicles where (vehicle_price BETWEEN $minPrice AND $maxPrice)  AND  (vehicle_year BETWEEN $minYear AND  $maxYear) ORDER BY vehicle_id DESC";
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
		    $count=0;
		   echo json_encode($post);
		}
		else
		    if($count==0)
    		{
    		     echo $response;
    		}
    
?>