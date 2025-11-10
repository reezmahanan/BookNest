<?php
session_start();
include '../config/db.php'; // Adjust path if needed

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login_user.php");
    exit();
}

// Check if cart_id is provided
if (!isset($_GET['cart_id'])) {
    header("Location: view_cart.php");
    exit();
}

$cart_id = intval($_GET['cart_id']);
$user_id = $_SESSION['user_id'];

// Delete the cart item belonging to this user
$sql = "DELETE FROM cart WHERE cart_id = ? AND user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $cart_id, $user_id);

if ($stmt->execute()) {
    // Successfully removed
    $_SESSION['message'] = "Item removed from your cart.";
} else {
    $_SESSION['message'] = "Error removing item. Please try again.";
}

// Redirect back to view_cart.php
header("Location: view_cart.php");
exit();
?>
