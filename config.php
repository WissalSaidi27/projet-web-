<?php
$servername = "localhost";  // Database server (localhost for local development)
$username = "root";         // Database username
$password = "";             // Database password (empty for default XAMPP)
$dbname = "monument_site";  // Database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
