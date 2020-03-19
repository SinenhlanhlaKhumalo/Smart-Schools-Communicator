<?php
    include("connection.php");
    include("profile_object.php");
    
    $school_logo = $_POST["icon"];
    $school = $_POST["school"];
    $data = json_decode($_POST["json"],true);
    $object = new Object();
    switch($_POST["action"])
    {

        case "UPDATE":
            $andIcon = $_POST["differ"];
            $school_name = $_POST["name"];
            if($andIcon=="fresh")
            {
                $path = "schoollogo/".md5($school_name).".png";
                $actualpath = "http://mydm.co.za/schools/$path";
                $sql="INSERT INTO schools(logo,name)values('$actualpath','$school_name')ON DUPLICATE KEY UPDATE logo='$actualpath',name='$school_name'";
                if(file_put_contents($path,base64_decode($school_logo)))
                {
                    if($conn->query($sql)===TRUE)
                    {
                        
                    }
                }

            }
            else
            {
                $sql="UPDATE schools SET name='$school_name' WHERE id='$school'";
                if($conn->query($sql)===TRUE)
                {
                   
                }
            }
            foreach($data as $key => $arrays)
            {
              
                $subjects = $data[$key];
               
               foreach($subjects as $key=>$arrays)
                {
                     
                     $object->setSubjectId($subjects["SubjectId"]);
                     $object->setGradeId($subjects["GradeId"]);
                     $object->setSubjectName($subjects["SubjectName"]);
                     $object->setGradeName($subjects["GradeName"]);
                     $object->setSubjectAction($subjects["SubjectAction"]);
                     $object->setGradeAction($subjects["GradeAction"]);
                    // echo $object->getAll().",\n";
                   
                }
              //  echo $object->getAll().",\n";
                $sId = $object->getSubjectId();
                $gId = $object->getGradeId();
                $s = $object->getSubjectName();
                $g = $object->getGradeName();
                $sA = $object->getSubjectAction();
                $gA = $object->getGradeAction();
                if(!(empty($sId) || empty($gId) || empty($s) || empty($g)))
                {
                    $sql = "UDPATE AllGrades SET grade='$g' WHERE id='$gId' AND school_id='$school'";
                    if($conn->query($sql)===TRUE)
                    {
                         
                    }
                    $sql = "UPDATE AllSubjects SET subject='$s' WHERE id='$sId' AND grade_code='$gId' AND school_id='$school'";
                    if($conn->query($sql)===TRUE)
                    {
                       
                    }
                    if($gA=="INSERT" && $gId=="00")
                    {
                        $sql = "SELECT id FROM AllGrades WHERE grade='$g' AND school_id='$school'";
                    	$results = $conn->query($sql);
            	        if($results->num_rows > 0)
                        {
                             while($row=$results->fetch_assoc())
                            {
                                $gid = $row["id"];
                                $sql = "INSERT INTO AllSubjects (subject,grade_code,school_id)VALUES('$s','$gid','$school')";
                                if($conn->query($sql)===TRUE)
                                { 
                                    echo "success";
                                }
                            }
                            
                        }
                        else
                        {
                            $sql = "INSERT INTO AllGrades (grade,school_id)VALUES('$g','$school')";
                            if($conn->query($sql)===TRUE)
                            {
                                $gid = $conn->insert_id;
                                $sql = "INSERT INTO AllSubjects (subject,grade_code,school_id)VALUES('$s','$gid','$school')";
                                if($conn->query($sql)===TRUE)
                                { 
                                    echo "success";
                                }
                            }
                        }
                    }
                    if($gA=="DELETE")
                    {
                        $sql = "DELETE FROM AllGrades WHERE id='$gId' AND school_id='$school'";
                        if($conn->query($sql)===TRUE)
                        {
                            $sql = "DELETE FROM AllSubjects WHERE grade_code='$gId' AND school_id='$school'";
                            if($conn->query($sql)===TRUE)
                            {
                               
                            } 
                        }
                    }
                    if($sA=="INSERT" && $sId=="00")
                    {
                        $sql = "INSERT INTO AllSubjects (subject,grade_code,school_id)VALUES('$s','$gId','$school')";
                        if($conn->query($sql)===TRUE)
                        { 
                           
                        }
                    }
                    if($sA=="DELETE")
                    {
                        $sql = "DELETE FROM AllSubjects WHERE id='$sId' AND grade_code='$gId' AND school_id='$school'";
                        if($conn->query($sql)===TRUE)
                        {
                            
                        } 
                    }
                }

            }
    
        break;
    }
    $conn->close();
?>