<?php
    include("connection.php");
    if(isset($_POST["device_registration"])=="yep" && isset($_POST["action"])=="INSERT")
    {
        $school_logo = $_POST["icon"];
        $school_name = $_POST["name"];
        $data = json_decode($_POST["json"],true);
        $path = "schoollogo/".md5($school_name).".png";
        $actualpath = "http://mydm.co.za/schools/$path";
        if(!empty($school_name))
        {
            $sql="INSERT INTO schools(logo,name)values('$actualpath','$school_name')ON DUPLICATE KEY UPDATE logo='$actualpath',name='$school_name'";
        
            if($conn->query($sql)===TRUE)
            {
                file_put_contents($path,base64_decode($school_logo));
                $school_id = $conn->insert_id;
                
                foreach($data as $key => $arrays)
                {
                    $subjects = json_decode($data[$key],true);
                    
                    foreach($subjects as $key=>$arrays)
                    {
                        $sql ="INSERT INTO AllGrades(grade,school_id)values('$key','$school_id')";
                        
                        if($conn->query($sql)===TRUE)
                        {
                            $grade_id = $conn->insert_id;
                            
                            foreach($subjects as $array)
                            {
                                foreach($array as $key => $value)
                                {
                                    
                                    $sql ="INSERT INTO AllSubjects(subject,grade_code,school_id)values('$value','$grade_id','$school_id')";
                                    if($conn->query($sql)===TRUE)
                                    {
                                      
                                    }
                                }
                            }
                        }
                    }
                }
                echo $school_id;
            }
        }
        $conn->close();
    }
?>