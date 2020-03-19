<?php
	include('connection.php');
	include('notification.php');
	$result;
    $title = $_POST["title"];
    $desc = $_POST["description"];
    $school = $_POST['school'];
    $subject = $_POST['subject'];
    $learner_grade = $_POST["learner_grade"];
    $learners = $_POST["learner"];
    $parents = $_POST["parent"];
    $staff = $_POST["staff"];
    $staff_grade = $_POST["staff_grade"];
    $unique = md5($_POST["unique"]);
    $type = $_POST["type"];
    $uploader = $_POST["uploader"];
    $userId = $_POST["userid"];
    date_default_timezone_set("Africa/Johannesburg");
	        $date = new DateTime("now");
	         $time = $date->format('d F H:i');
   if(file_exists("Schools/$school"))
   {
        if(file_exists("Schools/$school/Officials"))
       {
           if(file_exists("Schools/$school/Officials/$userId"))
           {
              if(file_exists("Schools/$school/Officials/$userId/Documents"))
               {
                   
               }
               else
               {
                    mkdir("Schools/$school/Officials/$userId/Documents");
               }
           }
           else
           {
                mkdir("Schools/$school/Officials/$userId");
                mkdir("Schools/$school/Officials/$userId/Documents");
           }
       }
       else
       {
        mkdir("Schools/$school/Officials");
        mkdir("Schools/$school/Officials/$userId");
        mkdir("Schools/$school/Officials/$userId/Documents");
       }
   }
   else
   {
    mkdir("Schools/$school");
    mkdir("Schools/$school/Officials");
    mkdir("Schools/$school/Officials/$userId");
    mkdir("Schools/$school/Officials/$userId/Documents");
   }	         
  if(file_exists("Schools/$school/Officials/$userId/Documents"))
   {
        $file_path = "Schools/$school/Officials/$userId/Documents/";
        $file_path = $file_path . basename( $_FILES['uploaded_file']['name']);
        $filename = basename( $_FILES['uploaded_file']['name']);
        $link = "http://mydm.co.za/schools/".$file_path; 
        if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'],$file_path)) 
        {
            if(!empty($learners))
            {
                $result = sendDoc($conn,$title,$desc,$learners,$school,$time,$link,$subject,$learner_grade,$type,$uploader);
                $sqll = "DELETE * FROM temp_files where unique_id=$unique";
                $r= mysqli_query($conn,$sql); 
                 notify($result,$conn,$school,$learners,"Users");
            }
            
            if(!empty($parents))
            {
                 $result = sendDoc($conn,$title,$desc,$parents,$school,$time,$link,"","","",$uploader);
                  notify($result,$conn,$school,$parents,"Users");
            }
            
            if(!empty($staff))
            {
                  $result = sendDoc($conn,$title,$desc,$staff,$school,$time,$link,$subject,$staff_grade,"",$uploader);
                   notify($result,$conn,$school,$staff,"staff");
            }
        }
        else
        {
            echo "fail";
        }
   }

    function sendDoc($conn,$title,$desc,$receiver,$school,$time,$link,$subject,$grade,$type,$uploader)
    {

        $sql = "insert into Resources(title,message,type,school,subject,grade,date,link,resource,sender)values('$title','$desc','$receiver','$school','$subject','$grade','$time','$link','$type','$uploader')"; 
    	if($conn->query($sql)===TRUE)
        {
          $result = array('key'=>"document",'title'=>$title,'time'=>$time,'message'=>$desc,'school'=>$school,'subject'=>$subject,'grade'=>$grade,'url'=>$link);
        }
        else
        {
            echo "fail";
        }
       return $result;
    }
 
?>