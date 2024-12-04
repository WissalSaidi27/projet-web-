<?php
$dsn = 'mysql:host=localhost;dbname=monument_site;charset=utf8mb4';  // Data Source Name
$username = 'root';  // Database username
$password = '';      // Database password (empty for default XAMPP)

try {
    // Create a new PDO instance
    $pdo = new PDO($dsn, $username, $password);

    // Set PDO attributes for better error handling
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // Handle connection error
    die("Database connection failed: " . $e->getMessage());
}
?>
