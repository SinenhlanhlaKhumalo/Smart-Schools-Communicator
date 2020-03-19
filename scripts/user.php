<?php
  
    include("connection.php");
    include("notification.php");
    include("functions.php");

    $conn = new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);

    $id = $_POST["id"];
    $make = $_POST["make"];
    $transmission = $_POST["transmission"];
    $model = $_POST["model"];
    $mileage = $_POST["mileage"];
    $year = $_POST["year"];
    $price = $_POST["price"];
    $features = $_POST["features"];
    $photo = $_POST["photo"];
    $province = $_POST["province"];
    $changed = $_POST["changed"];
    
    if($id==999999)
    {
        insertVehicles($conn,$make,$transmission,$model,$mileage,$year,$price,$features,$photo,$province);
    }
    else
    {
        updateVehicles($conn,$id,$make,$transmission,$model,$mileage,$year,$price,$features,$photo,$province,$changed);
    }
    
    function insertVehicles($conn,$make,$transmission,$model,$mileage,$year,$price,$features,$photo,$province)
    {
        $message;
        $image = $make.uniqid().$model.".png";
        $link = "http://mydm.co.za/Autodealer/scripts/images/vehicles/".$image;
        $sql = "insert into vehicles(vehicle_make,vehicle_transmission,vehicle_model,vehicle_mileage,vehicle_price,vehicle_year,vehicle_features,vehicle_photo,vehicle_link,vehicle_province)values('$make','$transmission','$model','$mileage','$price','$year','$features','$image','$link','$province')";
        if($conn->query($sql)===TRUE)
        {
           if(file_put_contents("images/vehicles/".$image,base64_decode($photo)))
            {
                echo "success";
            }
        }
        else
        {
            echo "fail";
        }
        $conn->close();
    }
    function updateVehicles($conn,$id,$make,$transmission,$model,$mileage,$year,$price,$features,$photo,$province,$changed)
    {
        $message = "success";
        $image = $make.uniqid().$model.".png";
        $link = "http://mydm.co.za/Autodealer/scripts/images/vehicles/".$image;
        $sql = "UPDATE vehicles set vehicle_make = '$make',vehicle_transmission = '$trasnmission',vehicle_model = '$model',vehicle_mileage = '$mileage',vehicle_price = '$price',vehicle_year = '$year',vehicle_features = '$features',vehicle_photo = '$image',vehicle_link = '$link',vehicle_province ='$province' where vehicle_id = '$id'";
        if($conn->query($sql)===TRUE)
        {
            if($changed == "true")
            {
                if(file_put_contents("images/vehicles/".$image,base64_decode($photo)))
                {
                   $message = "success";
                }
                else
                {
                    $message = "fail";
                }
            }
            $message = "success";

        }
        else
        {
           $message = "fail";
        }
        $conn->close();
    }

?>