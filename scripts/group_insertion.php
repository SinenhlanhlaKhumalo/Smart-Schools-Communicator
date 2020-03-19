<?php

   include("connection.php");
   include("functions.php");
   if(isset($_POST["device"]))
   {
        $conn = new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
        $group_name = $_POST["group_name"];
        $group_admin = "Mr K.Mbukutshe";
        $response = createGroup($group_name,$group_admin,$conn);
        echo $response;

   }
?>