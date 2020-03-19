<?php
    include("connection.php");
    
    $school_logo = $_POST["icon"];
    $school = $_POST["school"];
    $id = $_POST["id"];
    $email = $_POST['email'];
    $name = $_POST['name'];
    $title = $_POST['title'];
    $surname = $_POST['surname'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    switch($_POST["action"])
    {
        case "UPDATE":
            $andIcon = $_POST["differ"];
            if($andIcon=="fresh")
            {
                   if(file_exists("Schools/$school"))
                   {
                        if(file_exists("Schools/$school/Officials"))
                       {
                           if(file_exists("Schools/$school/Officials/$id"))
                           {
                              if(file_exists("Schools/$school/Officials/$id/userProfPic"))
                               {
                                   
                               }
                               else
                               {
                                    mkdir("Schools/$school/Officials/$id/userProfPic");
                               }
                           }
                           else
                           {
                                mkdir("Schools/$school/Officials/$id");
                                mkdir("Schools/$school/Officials/$id/userProfPic");
                           }
                       }
                       else
                       {
                        mkdir("Schools/$school/Officials");
                        mkdir("Schools/$school/Officials/$id");
                        mkdir("Schools/$school/Officials/$id/userProfPic");
                       }
                   }
                   else
                   {
                    mkdir("Schools/$school");
                    mkdir("Schools/$school/Officials");
                    mkdir("Schools/$school/Officials/$id");
                    mkdir("Schools/$school/Officials/$id/userProfPic");
                   }
                $path = "Schools/$school/Officials/$id/userProfPic/profilePic.png";
                $actualpath = "http://mydm.co.za/schools/$path";
                 $sql="UPDATE staff SET title='$title',name='$name',surname='$surname',dob='$dob',gender='$gender',email='$email',pic='$actualpath' WHERE id='$id'";
                if(file_put_contents($path,base64_decode($school_logo)))
                {
                    if($conn->query($sql)===TRUE)
                    {
                         echo $actualpath;         
                    }
                }

            }
            else
            {
                $sql="UPDATE staff SET title='$title',name='$name',surname='$surname',dob='$dob',gender='$gender',email='$email' WHERE id='$id'";
                if($conn->query($sql)===TRUE)
                {
                   
                }
            }
    
        break;
    }
    $conn->close();
?>