<?php
	include('connection.php');
    $school = $_POST["school"];
    $data = selectPosts($conn,$school);
    echo $data;
     function selectPosts($conn,$school)
     {
        $sql = "
        SELECT A.id AS SchoolId, A.logo AS SchoolLogo, A.name AS SchoolName, B.id AS GradeId, B.grade AS GradeName, C.id AS SubjectId, C.subject As SubjectName
        FROM schools A, AllGrades B, AllSubjects C
        WHERE A.id = '$school' 
        AND B.school_id = '$school' 
        AND C.school_id = '$school'
        AND B.id = C.grade_code
        ORDER BY B.grade ASC";
      
         $r = mysqli_query($conn,$sql);
         
         //creating a blank array 
         $result = array();
         
         //looping through all the records fetched
         while($row = mysqli_fetch_array($r)){
         
         //Pushing name and id in the blank array created 
         array_push($result,array(
         "SchoolId"=>$row["SchoolId"],
         "SchoolLogo"=>$row["SchoolLogo"],
         "SchoolName"=>$row["SchoolName"],
         "GradeId"=>$row["GradeId"],
         "GradeName"=>$row["GradeName"],
         "SubjectId"=>$row["SubjectId"],
         "SubjectName"=>$row["SubjectName"],
         "SubjectAction"=>"nothing",
         "GradeAction"=>"nothing"));
         }
         return json_encode(array('result'=>$result));
        $conn->close();
     }
?>