<?php
session_start();
include '../config/db.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login_user.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$wishlist_id = isset($_GET['wishlist_id']) ? intval($_GET['wishlist_id']) : 0;

if ($wishlist_id > 0) {
    // Remove from wishlist (ensure it belongs to the current user)
    $stmt = $conn->prepare("DELETE FROM wishlist WHERE wishlist_id = ? AND user_id = ?");
    $stmt->bind_param("ii", $wishlist_id, $user_id);
    
    if ($stmt->execute()) {
        $_SESSION['success_message'] = "Book removed from your wishlist.";
    } else {
        $_SESSION['error_message'] = "Failed to remove book from wishlist.";
    }
    $stmt->close();
}

header("Location: view_wishlist.php");
exit;
?>
