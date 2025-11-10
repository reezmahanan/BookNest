<?php
// update_cart.php
session_start();
include '../config/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login_user.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['quantity'])) {
    foreach ($_POST['quantity'] as $cart_id => $quantity) {
        $cart_id = intval($cart_id);
        $quantity = intval($quantity);
        
        if ($quantity > 0) {
            $stmt = $conn->prepare("UPDATE cart SET quantity = ? WHERE cart_id = ? AND user_id = ?");
            $stmt->bind_param("iii", $quantity, $cart_id, $user_id);
            $stmt->execute();
        }
    }
    
    $_SESSION['message'] = "Cart updated successfully!";
}

header("Location: view_cart.php");
exit();
?>