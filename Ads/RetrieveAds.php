<?php
 //Importing Database Script 

$servername = "localhost";
$username = "mydmc001_schools";
$password = "-B(Ue{kxDBu}";
$dbname = "mydmc001_MobileSchools";


// Create connection


$conn = new mysqli($servername, $username, $password, $dbname);


// Check connection


if ($conn->connect_error) {


    die("Connection failed: " . $conn->connect_error);


} 
 

$sql = "SELECT * FROM AdsDB ORDER BY RAND() LIMIT 1";

$result = $conn->query($sql);

if ($result->num_rows >0) {
 
 
 while($row[] = $result->fetch_assoc()) {
 
 $tem = $row;
 
 $json = json_encode($tem);
 
 }
 
} else {
 echo "No Results Found.";
}
 echo $json;
$conn->close();
?>