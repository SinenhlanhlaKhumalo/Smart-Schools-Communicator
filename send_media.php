<?php
	include('connection.php');
	include('notification.php');
	
    $subject = $_POST["subject"];
    $desc = $_POST["description"];
    $receiver = $_POST["receiver"];
    $school = $_POST["school"];
    $which_one = $_POST["which_one"];
    $image = $_POST["image"];
    $uploader = $_POST["uploader"];
    $userId = $_POST["userid"];
date_default_timezone_set("Africa/Johannesburg");
	        $date = new DateTime("now");
	         $time = $date->format('d F H:i');


    $result = sendMedia($conn,$subject,$desc,$receiver,$school,$time,$url,$which_one,$image,$uploader,$userId);
    if($receiver=="instructor")
    {
       notify($result,$conn,$school,$receiver,"staff"); 
    }
    else
    {
        notify($result,$conn,$school,$receiver,"Users");
    }
    
    function sendMedia($conn,$subject,$desc,$receiver,$school,$time,$url,$which_one,$image,$uploader,$userId)
    {
        $result; 
        
            if($which_one == "image")
            {
               if(file_exists("Schools/$school"))
               {
                    if(file_exists("Schools/$school/Officials"))
                   {
                       if(file_exists("Schools/$school/Officials/$userId"))
                       {
                          if(file_exists("Schools/$school/Officials/$userId/Media"))
                           {
                               if(file_exists("Schools/$school/Officials/$userId/Media/Images"))
                               {
                                   
                               }
                               else
                               {
                                    mkdir("Schools/$school/Officials/$userId/Media/Images");
                               } 
                           }
                           else
                           {
                                mkdir("Schools/$school/Officials/$userId/Media");
                                mkdir("Schools/$school/Officials/$userId/Media/Images");
                           }
                       }
                       else
                       {
                            mkdir("Schools/$school/Officials/$userId");
                            mkdir("Schools/$school/Officials/$userId/Media");
                            mkdir("Schools/$school/Officials/$userId/Media/Images");
                       }
                   }
                   else
                   {
                    mkdir("Schools/$school/Officials");
                    mkdir("Schools/$school/Officials/$userId");
                    mkdir("Schools/$school/Officials/$userId/Media");
                    mkdir("Schools/$school/Officials/$userId/Media/Images");
                   }
               }
               else
               {
                mkdir("Schools/$school");
                mkdir("Schools/$school/Officials");
                mkdir("Schools/$school/Officials/$userId");
                mkdir("Schools/$school/Officials/$userId/Media");
                mkdir("Schools/$school/Officials/$userId/Media/Images");
               }
               if(file_exists("Schools/$school/Officials/$userId/Media/Images"))
               {
                    $actualpath = "Schools/$school/Officials/$userId/Media/Images/";
                    $actualpath = $actualpath ."KBJFHcfgj".uniqid().'.png';
                    $filename = $date."KBJFHcfgj".uniqid().'.png';
                    $link = "http://mydm.co.za/schools/".$actualpath;
                    
                    if(file_put_contents($actualpath , base64_decode($image))) 
                    {
                     
                        $sql = "insert into media(title,message,receiver,school,time,url,which_one,uploader)values('$subject','$desc','$receiver','$school','$time','$link','$which_one','$uploader')"; 
                     	if($conn->query($sql)===TRUE)
                        {
                             $result = array('key'=>"image",'subject'=>$subject,'time'=>$time,'desc'=>$desc,'school'=>$school,'url'=>"$link");
                        }
                    }
                    else
                    {
                        echo "fail";
                    }
               }

            }
            else
            {
               if(file_exists("Schools/$school"))
               {
                    if(file_exists("Schools/$school/Officials"))
                   {
                       if(file_exists("Schools/$school/Officials/$userId"))
                       {
                          if(file_exists("Schools/$school/Officials/$userId/Media"))
                           {
                               if(file_exists("Schools/$school/Officials/$userId/Media/Videos"))
                               {
                                   
                               }
                               else
                               {
                                    mkdir("Schools/$school/Officials/$userId/Media/Videos");
                               } 
                           }
                           else
                           {
                                mkdir("Schools/$school/Officials/$userId/Media");
                                mkdir("Schools/$school/Officials/$userId/Media/Videos");
                           }
                       }
                       else
                       {
                            mkdir("Schools/$school/Officials/$userId");
                            mkdir("Schools/$school/Officials/$userId/Media");
                            mkdir("Schools/$school/Officials/$userId/Media/Videos");
                       }
                   }
                   else
                   {
                    mkdir("Schools/$school/Officials");
                    mkdir("Schools/$school/Officials/$userId");
                    mkdir("Schools/$school/Officials/$userId/Media");
                    mkdir("Schools/$school/Officials/$userId/Media/Videos");
                   }
               }
               else
               {
                mkdir("Schools/$school");
                mkdir("Schools/$school/Officials");
                mkdir("Schools/$school/Officials/$userId");
                mkdir("Schools/$school/Officials/$userId/Media");
                mkdir("Schools/$school/Officials/$userId/Media/Videos");
               }
              if(file_exists("Schools/$school/Officials/$userId/Media/Videos"))
               {
                   $actualpath = "Schools/$school/Officials/$userId/Media/Videos/";
                    $actualpath = $actualpath . basename( $_FILES['uploaded_file']['name']);
                    $filename = basename( $_FILES['uploaded_file']['name']);
                    $link = "http://mydm.co.za/schools/".$actualpath;
            
                    if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $actualpath)) 
                    {
                     
                       $sql = "insert into media(title,message,receiver,school,time,url,which_one,uploader)values('$subject','$desc','$receiver','$school','$time','$link','$which_one','$uploader')"; 
                     	if($conn->query($sql)===TRUE)
                        {
                             $result = array('key'=>"video",'subject'=>$subject,'time'=>$time,'desc'=>$desc,'school'=>$school,'url'=>"$link");
                        }
                    }
                    else
                    {
                        echo "fail";
                    }
              
               }

          
            }
        return $result;
    }
    $conn->close();
?>