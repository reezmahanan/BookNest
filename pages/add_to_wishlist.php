<?php
session_start();
include '../config/db.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login_user.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$book_id = isset($_GET['book_id']) ? intval($_GET['book_id']) : 0;

if ($book_id > 0) {
    // Check if book exists
    $bookCheck = $conn->query("SELECT book_id FROM books WHERE book_id = $book_id");
    
    if ($bookCheck->num_rows > 0) {
        // Check if already in wishlist
        $wishlistCheck = $conn->query("SELECT wishlist_id FROM wishlist WHERE user_id = $user_id AND book_id = $book_id");
        
        if ($wishlistCheck->num_rows == 0) {
            // Add to wishlist
            $stmt = $conn->prepare("INSERT INTO wishlist (user_id, book_id) VALUES (?, ?)");
            $stmt->bind_param("ii", $user_id, $book_id);
            
            if ($stmt->execute()) {
                $_SESSION['success_message'] = "Book added to your wishlist!";
            } else {
                $_SESSION['error_message'] = "Failed to add book to wishlist.";
            }
            $stmt->close();
        } else {
            $_SESSION['info_message'] = "This book is already in your wishlist.";
        }
    } else {
        $_SESSION['error_message'] = "Book not found.";
    }
}

// Redirect back to the previous page or to view_wishlist
$redirect = isset($_GET['redirect']) ? $_GET['redirect'] : 'view_wishlist.php';
header("Location: $redirect");
exit;
?>
