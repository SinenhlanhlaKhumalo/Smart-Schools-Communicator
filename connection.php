<?php

$servername = "localhost";
$username = "mydmc001_school";
$password = "Ze}tky#nSSzj";
$dbname = "mydmc001_SmartSchool";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "connected";

?>