<?php
session_start();
include('../config/db.php');

// ✅ Check login
if (!isset($_SESSION['user_id'])) {
    header("Location: login_user.php?error=Please login to view your cart");
    exit();
}

$user_id = $_SESSION['user_id'];

// ✅ Fetch cart details joined with books
$sql = "SELECT c.cart_id, c.book_id, c.quantity, b.title, b.price, b.image_url, b.author 
        FROM cart c 
        JOIN books b ON c.book_id = b.book_id 
        WHERE c.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$total = 0;
?>

<?php $pageTitle = 'My Cart'; include __DIR__ . '/../includes/head.php'; ?>
<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f6f6f6;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 90%;
            margin: 30px auto;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th, table td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: #ffb400;
            color: black;
        }

        table img {
            width: 70px;
            height: 90px;
            object-fit: cover;
            border-radius: 5px;
        }

        .update-btn, .remove-btn, .order-btn {
            padding: 6px 12px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            text-decoration: none;
            color: black;
        }

        .update-btn {
            background-color: #ffb400;
        }

        .remove-btn {
            background-color: #ff6666;
            color: white;
        }

        .remove-btn:hover {
            background-color: #e05555;
        }

        .order-section {
            text-align: right;
            margin-top: 25px;
        }

        .order-btn {
            background-color: #1a1a1a;
            color: white;
            padding: 10px 25px;
            font-size: 16px;
            border-radius: 8px;
        }

        .order-btn:hover {
            background-color: #333;
        }

        .total {
            font-size: 18px;
            font-weight: bold;
        }

        input[type="number"] {
            width: 60px;
            text-align: center;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
    </style>
</style>
<?php include('../includes/navbar.php'); ?>

<div class="container mt-4">
    <h2 class="mb-3">🛒 My Cart</h2>

    <?php if ($result->num_rows > 0): ?>
        <form method="post" action="update_cart.php">
            <div class="table-responsive">
            <table class="table table-dark table-hover align-middle">
                <thead class="table-secondary text-dark">
                <tr>
                    <th>Book</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Price</th>
                    <th style="width:110px">Quantity</th>
                    <th>Subtotal</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>

                <?php while ($row = $result->fetch_assoc()): 
                    $subtotal = $row['price'] * $row['quantity'];
                    $total += $subtotal;
                ?>
                    <tr>
                        <td><img src="../assets/images/<?php echo htmlspecialchars($row['image_url']); ?>" alt="Book" class="img-fluid"></td>
                        <td><?php echo htmlspecialchars($row['title']); ?></td>
                        <td><?php echo htmlspecialchars($row['author']); ?></td>
                        <td>$<?php echo number_format($row['price'], 2); ?></td>
                        <td>
                            <input class="form-control form-control-sm" type="number" name="quantity[<?php echo $row['cart_id']; ?>]" value="<?php echo $row['quantity']; ?>" min="1">
                        </td>
                        <td>$<?php echo number_format($subtotal, 2); ?></td>
                        <td>
                            <a href="remove_cart_item.php?cart_id=<?php echo $row['cart_id']; ?>" class="btn btn-sm btn-danger">Remove</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
            </div>
            <div class="d-flex flex-column flex-md-row justify-content-md-end gap-2 mt-3">
                <p class="total mb-0 me-md-3">Total: $<?php echo number_format($total, 2); ?></p>
                <button type="submit" class="btn btn-secondary">Update Cart</button>
                <a href="place_order.php" class="btn btn-primary">Place Order</a>
            </div>
        </form>

    <?php else: ?>
        <p>Your cart is empty 😔</p>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/../includes/scripts.php'; ?>
</body>
</html>
