<?php
// Database configuration
$host = '127.0.0.1';
$user = 'root';
$pass = ''; // default XAMPP root password
$dbname = 'bookstore_db';

// List of ports to try
$ports = [3306, 3307];

// Initialize connection variable
$conn = null;

foreach ($ports as $port) {
    $conn = @new mysqli($host, $user, $pass, $dbname, $port);
    if (!$conn->connect_error) {
        break; // Successfully connected
    }
}

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error . 
        ". Tried ports: " . implode(", ", $ports));
}

// Optional: set charset to avoid UTF-8 issues
$conn->set_charset("utf8");
?>
