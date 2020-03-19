<?php
    include("connection.php");	
	$conn = new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
	selectPosts($conn);
	 function selectPosts($conn)
	 {
	    $post=array();
	    $count=0;
	    $sql ="SELECT device_lati,device_longi FROM devices where device_lati != ''";
	  
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
		 echo "nodata";
		}
 	}

?>