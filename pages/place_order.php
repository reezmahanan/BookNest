<?php
session_start();
include '../config/db.php'; 
include '../config/mail.php';

// Check if user logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login_user.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user details for email
$sql_user = "SELECT full_name, email, address FROM users WHERE user_id = ?";
$stmt_user = $conn->prepare($sql_user);
$stmt_user->bind_param("i", $user_id);
$stmt_user->execute();
$user_result = $stmt_user->get_result();
$user_data = $user_result->fetch_assoc();

// Fetch all cart items for this user
$sql_cart = "SELECT c.book_id, c.quantity, b.price 
             FROM cart c
             JOIN books b ON c.book_id = b.book_id
             WHERE c.user_id = ?";
$stmt_cart = $conn->prepare($sql_cart);
$stmt_cart->bind_param("i", $user_id);
$stmt_cart->execute();
$result_cart = $stmt_cart->get_result();

if ($result_cart->num_rows === 0) {
    $_SESSION['message'] = "Your cart is empty. Add books before placing an order.";
    header("Location: view_cart.php");
    exit();
}

// Optional: choose payment method (default COD)
$payment_method = "COD"; 
$order_status = "Pending";
$total_amount = 0;
$first_order_id = null;

// Begin transaction for safety
$conn->begin_transaction();

try {
    while ($row = $result_cart->fetch_assoc()) {
        $book_id = $row['book_id'];
        $quantity = $row['quantity'];
        $price = $row['price'];
        $total = $price * $quantity;
        $total_amount += $total;

        // Insert each book as an individual order record
        $sql_order = "INSERT INTO orders (user_id, book_id, total_amount, order_status, payment_method, order_date)
                      VALUES (?, ?, ?, ?, ?, NOW())";
        $stmt_order = $conn->prepare($sql_order);
        $stmt_order->bind_param("iidss", $user_id, $book_id, $total, $order_status, $payment_method);
        $stmt_order->execute();
        
        // Store first order ID for email
        if ($first_order_id === null) {
            $first_order_id = $stmt_order->insert_id;
        }

        // Reduce book stock
        $sql_stock = "UPDATE books SET stock = stock - ? WHERE book_id = ?";
        $stmt_stock = $conn->prepare($sql_stock);
        $stmt_stock->bind_param("ii", $quantity, $book_id);
        $stmt_stock->execute();
    }

    // Clear user's cart
    $sql_clear = "DELETE FROM cart WHERE user_id = ?";
    $stmt_clear = $conn->prepare($sql_clear);
    $stmt_clear->bind_param("i", $user_id);
    $stmt_clear->execute();

    $conn->commit();
    
    // Send order confirmation email
    $orderData = [
        'order_id' => $first_order_id,
        'customer_name' => $user_data['full_name'],
        'email' => $user_data['email'],
        'total_amount' => $total_amount,
        'payment_method' => $payment_method,
        'shipping_address' => $user_data['address']
    ];
    sendOrderConfirmationEmail($orderData);
    
    $_SESSION['message'] = "✅ Your order has been placed successfully! Check your email for confirmation.";
    header("Location: view_cart.php");
    exit();

} catch (Exception $e) {
    $conn->rollback();
    $_SESSION['message'] = "❌ Error placing order. Please try again.";
    header("Location: view_cart.php");
    exit();
}
?>
