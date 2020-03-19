<?php
require_once('connection.php');
if(isset($_POST["device"])=="true")
{

    $id = $_POST["id"];
    $table = $_POST["table"];
    $action = $_POST["action"];
    switch($action)
    {
        case "DELETE":
            $sql = "DELETE  FROM $table WHERE id=$id"; 
            delete($conn,$sql);
        break;
        case "UPDATE":
            $title = $_POST["title"];
            $message = $_POST["message"];
            $sql = "UPDATE $table set title='$title',message='$message' WHERE id=$id"; 
            delete($conn,$sql);
        break;
    }

}
 function delete($conn,$sql)
 {
   if($conn->query($sql)===TRUE)
   {
       echo "success";
   }
   else
   {
       echo "fail". $conn->error;
   }
    $conn->close();
 }
?>