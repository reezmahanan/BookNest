<?php
// Database configuration
// Use 127.0.0.1 and pass port separately to avoid ambiguous "localhost" socket behavior.
$host = '127.0.0.1';
$port = 3307; // set to 3306 or 3307 depending on your XAMPP MySQL port
$user = 'root';
$pass = ''; // set to your root password if one exists
$dbname = 'bookstore_db';

// Create connection using explicit port
$conn = new mysqli($host, $user, $pass, $dbname, $port);

// Better error reporting for debugging (change in production)
if ($conn->connect_error) {
    // Show a friendly message and the underlying error for troubleshooting
    die("Connection failed: " . $conn->connect_error);
}
?>
