<?php
session_start();
include('../config/db.php');

// ✅ Check if user logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login_user.php?error=Please login to add books to cart");
    exit();
}

// ✅ Check if book_id is provided
if (!isset($_GET['book_id'])) {
    header("Location: view_book.php?error=Invalid book");
    exit();
}

$user_id = $_SESSION['user_id'];
$book_id = intval($_GET['book_id']);
$quantity = 1; // default quantity
$added_on = date('Y-m-d H:i:s');

// ✅ Check if book already exists in the cart
$checkSql = "SELECT * FROM cart WHERE user_id = ? AND book_id = ?";
$stmt = $conn->prepare($checkSql);
$stmt->bind_param("ii", $user_id, $book_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Update quantity
    $row = $result->fetch_assoc();
    $newQty = $row['quantity'] + 1;

    $updateSql = "UPDATE cart SET quantity = ?, added_on = ? WHERE user_id = ? AND book_id = ?";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bind_param("isii", $newQty, $added_on, $user_id, $book_id);
    $updateStmt->execute();
    $updateStmt->close();

} else {
    // Insert new item
    $insertSql = "INSERT INTO cart (user_id, book_id, quantity, added_on) VALUES (?, ?, ?, ?)";
    $insertStmt = $conn->prepare($insertSql);
    $insertStmt->bind_param("iiis", $user_id, $book_id, $quantity, $added_on);
    $insertStmt->execute();
    $insertStmt->close();
}

// ✅ Redirect back with success message
header("Location: view_book.php?success=Book added to cart successfully");
exit();
?>
