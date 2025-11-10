<?php
// Quick DB connection test. Place this file in the project root and open
// http://localhost/bookshop/test_db_connection.php after starting XAMPP (Apache + MySQL).
require_once __DIR__ . '/config/db.php';

if (!isset($conn)) {
    echo "Configuration file did not provide a $conn variable. Check `config/db.php`.";
    exit;
}

if ($conn->connect_error) {
    echo "Connection failed: " . $conn->connect_error;
} else {
    echo "Connected to MySQL successfully.";
    if (isset($dbname)) {
        echo " Database: " . htmlspecialchars($dbname);
    }
}

?>
