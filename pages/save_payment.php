<?php
session_start();
include '../config/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login_user.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $payment_method = $_POST['payment_method'];
    $card_number = isset($_POST['card_number']) ? trim($_POST['card_number']) : NULL;
    $card_holder = isset($_POST['card_holder']) ? trim($_POST['card_holder']) : NULL;
    $expiry_date = isset($_POST['expiry_date']) ? trim($_POST['expiry_date']) : NULL;
    $cvv = isset($_POST['cvv']) ? trim($_POST['cvv']) : NULL;

    // Check if user already has a saved payment method
    $check_sql = "SELECT payment_id FROM payments WHERE user_id = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("i", $user_id);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows > 0) {
        // Update existing record
        $update_sql = "UPDATE payments 
                       SET payment_method=?, card_number=?, card_holder=?, expiry_date=?, cvv=? 
                       WHERE user_id=?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("sssssi", $payment_method, $card_number, $card_holder, $expiry_date, $cvv, $user_id);
        $update_stmt->execute();
    } else {
        // Insert new payment record
        $insert_sql = "INSERT INTO payments (user_id, payment_method, card_number, card_holder, expiry_date, cvv)
                       VALUES (?, ?, ?, ?, ?, ?)";
        $insert_stmt = $conn->prepare($insert_sql);
        $insert_stmt->bind_param("isssss", $user_id, $payment_method, $card_number, $card_holder, $expiry_date, $cvv);
        $insert_stmt->execute();
    }

    $_SESSION['message'] = "Payment method saved successfully!";
    header("Location: user_profile.php");
    exit();
}
?>
