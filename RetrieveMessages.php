<?php 

require_once('connection.php');

 $school = $_POST["school"];
 $grade = $_POST["grade"];
 $which_one = $_POST["which_one"];
 switch($which_one)
 {
     case "learner":
         $sql = "SELECT A.title as title, A.message as message, A.type as type, A.date as date, B.title as titlle, B.name as name, B.surname as surname, B.pic as profile
                FROM  messageTable A,staff B
                WHERE A.sender = B.id 
                AND A.type='$which_one' 
                AND A.school='$school' 
                AND (A.grade='All' OR A.grade='$grade') 
                ORDER BY A.id DESC"; 
         select($conn,$sql);
     break;
     case "parent":
         $sql = "SELECT A.title as title,A.message as message,A.type as type,A.date as date, B.title as titlle,B.name as name,B.surname as surname,B.pic as profile
                FROM  messageTable A,staff B
                WHERE A.sender = B.id 
                AND A.type='$which_one' 
                AND A.school='$school' 
                ORDER BY A.id DESC "; 
         select($conn,$sql);
     break;
     case "instructor":
         $sql = "SELECT A.title as title, A.message as message, A.type as type, A.date as date,B.title as titlle, B.name as name,B.surname as surname,B.pic as profile
                FROM  messageTable A, staff B
                WHERE A.sender = B.id 
                AND A.type='$which_one' 
                AND A.school='$school' 
                ORDER BY A.id DESC "; 
         select($conn,$sql);
     break;
     case "principal":
         $sql = "SELECT A.title As title, A.message As message, A.type As type, A.date As date, B.title As titlle, B.name As name, B.surname As surname, B.pic As profile
                FROM  messageTable A, staff B
                WHERE A.sender = B.id 
                AND (A.type='instructor' || A.type='principal')
                AND A.school='$school' 
                ORDER BY A.id DESC "; 
         select($conn,$sql);
     break;
     case "admin":
         $sql = "SELECT A.title as title,A.message as message,A.type as type,A.date as date, B.title as titlle,B.name as name,B.surname as surname,B.pic as profile
                FROM  messageTable A,staff B
                WHERE A.sender = B.id  
                AND A.type='instructor' 
                AND A.school='$school' 
                ORDER BY A.id DESC "; 
         select($conn,$sql);
     break;
 }
 
 function select($conn,$sql)
 {
     $r = mysqli_query($conn,$sql);
     $result = array();
     while($row = mysqli_fetch_array($r))
     {
    
     array_push($result,array(
         "title"=>$row["title"],
         "message"=>$row["message"],
         "date"=>$row["date"],
         "titlle"=>$row["titlle"],
         "name"=>$row["name"],
         "surname"=>$row["surname"],
         "profile"=>$row["profile"]));
    }
 
 echo json_encode(array('result'=>$result));
 }
 mysqli_close($conn);
 
 ?>