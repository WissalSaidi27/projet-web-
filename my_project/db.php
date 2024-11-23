<?php
$servername = "localhost"; 
$username = "root";       
$password = "";            
$dbname = "hawes"; 


$conn = new mysqli('localhost', 'hawes', '', 'database');


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>