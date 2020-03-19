<?php

	function filtering_vehicles($conn,$province,$make,$minPrice,$maxPrice,$minYear,$maxYear)
	{
		$post=array();
	    $count=0;
	    $sql="";
	    $response="nodata";
	    
	    if($make=='Any' && $province=='All')
	    {
	     
	    	$sql ="SELECT * FROM vehicles where (vehicle_price BETWEEN $minPrice AND $maxPrice) AND (vehicle_year BETWEEN $minYear AND $maxYear) ORDER BY vehicle_id DESC";
	    }
	    else
    	    if($make=='Any' || $province=='All')
    	    {
          	    if($make=='Any' && $province != 'All')
        	    {
        	        $sql ="SELECT * FROM vehicles where (vehicle_province = '$province')AND(vehicle_price BETWEEN $minPrice AND $maxPrice)AND (vehicle_year BETWEEN $minYear AND $maxYear)ORDER BY vehicle_id DESC";
        	    }
        	    else
        	      if($make!='Any' && $province == 'All')
        	      {
        	          $sql ="SELECT * FROM vehicles where (vehicle_make = '$make')AND(vehicle_price BETWEEN $minPrice AND $maxPrice)AND (vehicle_year BETWEEN $minYear AND $maxYear)ORDER BY vehicle_id DESC";
        	      }
    	    }
        	else
        	{
            	$sql ="SELECT * FROM vehicles where (vehicle_province = '$province')AND(vehicle_make = '$make')AND(vehicle_price BETWEEN $minPrice AND $maxPrice)AND (vehicle_year BETWEEN $minYear AND $maxYear)ORDER BY vehicle_id DESC";
        	    
        	}
	 
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

	}
	function getMinPrice($price)
	{
		$prices="10000";
		switch ($price) 
		{
			case 2:
				$prices = "100000";
				break;
			case 3:
				$prices = "300000";
				break;
			case 4:
				$prices = "500000";
				break;
			case 5:
				$prices = "800000";
				break;
			default:
				$prices="10000";
				break;
		}
		return $prices;
	}
	function getMaxPrice($price)
	{
		$prices="999000";
		switch ($price) 
		{
			case 1:
				$prices = "99000";
				break;
			case 2:
				$prices = "299000";
				break;
			case 3:
				$prices = "499000";
				break;
			case 4:
				$prices = "799000";
				break;
			default:
				$prices="999000";
				break;
		}
		return $prices;
	}
	function getMinYear($year)
	{
		$years="1990";
		switch ($year) 
		{
			case 2:
				$years = "1995";
				break;
			case 3:
				$years = "2000";
				break;
			case 4:
				$years = "2005";
				break;
			case 5:
				$years = "2010";
				break;
			case 6:
				$years = "2015";
				break;
			case 7:
				$years = "2020";
				break;
			default:
				$years="1990";
				break;
		}
		return $years;
	}
	function getMaxYear($year)
	{
		$years="2024";
		switch ($year) 
		{
			case 1:
				$years = "1994";
				break;
			case 2:
				$year = "1999";
				break;
			case 3:
				$years = "2004";
				break;
			case 4:
				$years = "2009";
				break;
			case 5:
				$years = "2014";
				break;
			case 6:
				$years = "2019";
				break;
			default:
				$years="2024";
				break;
		}
		return $years;
	}
?>