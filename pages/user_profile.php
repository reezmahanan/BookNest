<?php
session_start();
include '../config/db.php';

// ✅ Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login_user.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// ✅ Fetch current user details
$sql = "SELECT full_name, email, phone, address FROM users WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// ✅ Handle profile update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_profile'])) {
    $full_name = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);

    $update_sql = "UPDATE users SET full_name=?, email=?, phone=?, address=? WHERE user_id=?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("ssssi", $full_name, $email, $phone, $address, $user_id);

    if ($update_stmt->execute()) {
        $_SESSION['message'] = "Profile updated successfully!";
        $_SESSION['user_name'] = $full_name; // update name in session
        header("Location: user_profile.php");
        exit();
    } else {
        $_SESSION['message'] = "Error updating profile.";
    }
}

// ✅ Fetch user payment details (if any)
$pay_sql = "SELECT * FROM payments WHERE user_id = ?";
$pay_stmt = $conn->prepare($pay_sql);
$pay_stmt->bind_param("i", $user_id);
$pay_stmt->execute();
$pay_result = $pay_stmt->get_result();
$payment = $pay_result->fetch_assoc();

$pageTitle = 'My Profile - BookNest';
include __DIR__ . '/../includes/head.php';
include __DIR__ . '/../includes/navbar.php';
?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body p-4">
                    <h2 class="h3 fw-bold mb-4 text-center">
                        <i class="bi bi-person-circle text-primary me-2"></i>My Profile
                    </h2>

                    <?php if (isset($_SESSION['message'])): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?php echo $_SESSION['message']; unset($_SESSION['message']); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <!-- 🧍‍♂️ User Profile Form -->
                    <form action="" method="POST" class="row g-3">
                        <div class="col-12">
                            <label class="form-label fw-semibold">Full Name</label>
                            <input class="form-control" type="text" name="full_name" value="<?php echo htmlspecialchars($user['full_name']); ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Email</label>
                            <input class="form-control" type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Phone</label>
                            <input class="form-control" type="text" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Address</label>
                            <textarea class="form-control" name="address" rows="3"><?php echo htmlspecialchars($user['address']); ?></textarea>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary w-100" type="submit" name="update_profile">
                                <i class="bi bi-check-circle me-2"></i>Update Profile
                            </button>
                        </div>
                    </form>

                    <hr class="my-4">

                    <!-- 💳 Payment Method Section -->
                    <h3 class="h5 fw-bold mb-3">
                        <i class="bi bi-credit-card text-primary me-2"></i>Payment Method
                    </h3>

                    <?php if ($payment): ?>
                        <div class="alert alert-info mb-3">
                            <strong>Current Method:</strong> <?= htmlspecialchars($payment['payment_method']); ?>
                            <?php if ($payment['payment_method'] == 'Card'): ?>
                                <br><strong>Card Holder:</strong> <?= htmlspecialchars($payment['card_holder']); ?>
                                <br><strong>Card Number:</strong> **** **** **** <?= substr($payment['card_number'], -4); ?>
                                <br><strong>Expiry:</strong> <?= htmlspecialchars($payment['expiry_date']); ?>
                            <?php endif; ?>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-warning">
                            <i class="bi bi-exclamation-triangle me-2"></i>No payment method saved yet.
                        </div>
                    <?php endif; ?>

                    <form action="save_payment.php" method="POST" id="paymentForm" class="mt-3">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Choose Payment Method</label>
                            <select class="form-select" name="payment_method" id="payment_method" required>
                                <option value="COD" <?= ($payment && $payment['payment_method'] == 'COD') ? 'selected' : ''; ?>>Cash on Delivery</option>
                                <option value="Card" <?= ($payment && $payment['payment_method'] == 'Card') ? 'selected' : ''; ?>>Card Payment</option>
                            </select>
                        </div>

                        <div id="cardDetails" style="display: <?= ($payment && $payment['payment_method'] == 'Card') ? 'block' : 'none'; ?>;" class="row g-3">
                            <div class="col-12">
                                <label class="form-label fw-semibold">Card Number</label>
                                <input class="form-control" type="text" name="card_number" placeholder="1234 5678 9012 3456" value="<?= htmlspecialchars($payment['card_number'] ?? '') ?>">
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-semibold">Card Holder Name</label>
                                <input class="form-control" type="text" name="card_holder" placeholder="John Doe" value="<?= htmlspecialchars($payment['card_holder'] ?? '') ?>">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Expiry Date</label>
                                <input class="form-control" type="text" name="expiry_date" placeholder="MM/YY" value="<?= htmlspecialchars($payment['expiry_date'] ?? '') ?>">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">CVV</label>
                                <input class="form-control" type="password" name="cvv" placeholder="123" value="<?= htmlspecialchars($payment['cvv'] ?? '') ?>">
                            </div>
                        </div>

                        <button class="btn btn-secondary w-100 mt-3" type="submit">
                            <i class="bi bi-save me-2"></i>Save Payment Method
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('payment_method').addEventListener('change', function() {
        let cardDiv = document.getElementById('cardDetails');
        cardDiv.style.display = (this.value === 'Card') ? 'block' : 'none';
    });
</script>

<?php include __DIR__ . '/../includes/footer.php'; ?>
<?php include __DIR__ . '/../includes/scripts.php'; ?>
</body>
</html>
