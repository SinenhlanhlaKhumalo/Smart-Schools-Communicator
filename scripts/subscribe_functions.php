<?php
	function subscribe_to_vehicles($conn,$email,$full_name,$cell_no,$car_manufacturer,$minPrice,$maxPrice,$subscriber_device)
	{
		$message ="success";

	    $sql = "INSERT INTO subscribers(email,full_name,cell_no,car_manufacturer,price_min,price_max,subscriber_device) VALUES('$email','$full_name','$cell_no','$car_manufacturer','$minPrice','$maxPrice','$subscriber_device')";
    	 if($conn->query($sql)===TRUE)
    	 {
    	 	$message = "success";
    	 }
    	 else
    	 {
    	 	$message = "error";
    	 }
    	 $conn->close();
    	 return $message;
	}
	function isRegistered($conn,$subscriber_device)
	{
		$response=false;
	    $sql ="SELECT device_token FROM devices where device_token = '$subscriber_device'";
	 
	    $results = $conn->query($sql);
	    $rows = $results->num_rows;
	 
		if($results->num_rows > 0)
		{
		       while($row = $results->fetch_assoc())
	    	   {
	    	       
	            $response = true;
	    	   }
		}
	    else
	    {
	    	$response = false;
	    }
	    $conn->close();
	    return $response;
	}
?>