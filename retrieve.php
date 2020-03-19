<?php
	include('connection.php');

	$type = $_POST["type"];
	$school = $_POST["school"];
	$receiver = $_POST["receiver"];
    $data = selectPosts($conn,$type,$school,$receiver);
    echo $data;
     function selectPosts($conn,$type,$school,$receiver)
     {
        $post=array();
        $count=0;
        $sql ="SELECT A.title As title, A.time As time, A.message As message, A.which_one As which_one, A.url As url, B.title as titlle, B.name as name, B.surname as surname, B.pic as profile 
               FROM media A, staff B 
               where A.uploader = B.id
               AND A.which_one = '$type' 
               AND A.school = '$school' 
               AND (A.receiver = '$receiver' OR A.receiver='All') 
               ORDER BY A.id DESC";
      
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
?>