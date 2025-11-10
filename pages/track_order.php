<?php
session_start();
$pageTitle = 'Track Order - BookNest';
include __DIR__ . '/../includes/head.php';
include __DIR__ . '/../includes/navbar.php';
include __DIR__ . '/../config/db.php';

$order = null;
$error = '';

if (isset($_GET['order_id']) && !empty($_GET['order_id'])) {
    $order_id = intval($_GET['order_id']);
    
    // If user is logged in, check if order belongs to them
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        $stmt = $conn->prepare("SELECT * FROM orders WHERE order_id = ? AND user_id = ?");
        $stmt->bind_param("ii", $order_id, $user_id);
    } else {
        // Guest tracking (optional - you might want to add email verification)
        $stmt = $conn->prepare("SELECT * FROM orders WHERE order_id = ?");
        $stmt->bind_param("i", $order_id);
    }
    
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $order = $result->fetch_assoc();
    } else {
        $error = "Order not found. Please check your order ID.";
    }
}
?>

<div class="container my-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="text-center mb-5">
                <h1 class="fw-bold mb-3">
                    <i class="bi bi-truck text-primary me-2"></i>Track Your Order
                </h1>
                <p class="lead text-muted">Enter your order ID to check the status</p>
            </div>

            <div class="card shadow-sm border-0 rounded-3 mb-4">
                <div class="card-body p-4">
                    <form method="GET" action="">
                        <div class="row g-3">
                            <div class="col-md-8">
                                <label class="form-label fw-semibold">Order ID</label>
                                <input type="number" name="order_id" class="form-control form-control-lg" 
                                       placeholder="Enter your order ID" 
                                       value="<?= isset($_GET['order_id']) ? htmlspecialchars($_GET['order_id']) : '' ?>" 
                                       required>
                            </div>
                            <div class="col-md-4 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary btn-lg w-100">
                                    <i class="bi bi-search me-2"></i>Track
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <?php if ($error): ?>
                <div class="alert alert-danger">
                    <i class="bi bi-exclamation-triangle me-2"></i><?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <?php if ($order): ?>
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h3 class="h4 fw-bold mb-0">Order #<?= $order['order_id'] ?></h3>
                            <span class="badge bg-<?= 
                                match($order['status']) {
                                    'Pending' => 'warning',
                                    'Confirmed' => 'info',
                                    'Shipped' => 'primary',
                                    'Delivered' => 'success',
                                    'Cancelled' => 'danger',
                                    default => 'secondary'
                                } 
                            ?> fs-6"><?= htmlspecialchars($order['status']) ?></span>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <p class="mb-2"><strong>Order Date:</strong> <?= date('F d, Y', strtotime($order['order_date'])) ?></p>
                                <p class="mb-2"><strong>Total Amount:</strong> $<?= number_format($order['total_amount'], 2) ?></p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-2"><strong>Payment Method:</strong> <?= htmlspecialchars($order['payment_method']) ?></p>
                                <p class="mb-2"><strong>Shipping Address:</strong> <?= htmlspecialchars($order['shipping_address']) ?></p>
                            </div>
                        </div>

                        <hr class="my-4">

                        <!-- Order Progress Timeline -->
                        <h5 class="fw-bold mb-4">Order Progress</h5>
                        <div class="position-relative">
                            <?php
                            $statuses = ['Pending', 'Confirmed', 'Shipped', 'Delivered'];
                            $currentStatusIndex = array_search($order['status'], $statuses);
                            if ($currentStatusIndex === false) $currentStatusIndex = -1;
                            ?>
                            
                            <div class="d-flex justify-content-between mb-2">
                                <?php foreach ($statuses as $index => $status): ?>
                                    <div class="text-center" style="flex: 1;">
                                        <div class="position-relative mb-2">
                                            <div class="rounded-circle mx-auto d-flex align-items-center justify-content-center <?= $index <= $currentStatusIndex ? 'bg-primary text-white' : 'bg-light text-muted' ?>" 
                                                 style="width: 50px; height: 50px; font-size: 1.5rem;">
                                                <?php if ($index <= $currentStatusIndex): ?>
                                                    <i class="bi bi-check-lg"></i>
                                                <?php else: ?>
                                                    <i class="bi bi-circle"></i>
                                                <?php endif; ?>
                                            </div>
                                            <?php if ($index < count($statuses) - 1): ?>
                                                <div class="position-absolute top-50 start-100 translate-middle-y <?= $index < $currentStatusIndex ? 'bg-primary' : 'bg-light' ?>" 
                                                     style="width: 100%; height: 3px; z-index: -1;"></div>
                                            <?php endif; ?>
                                        </div>
                                        <small class="fw-bold <?= $index <= $currentStatusIndex ? 'text-primary' : 'text-muted' ?>">
                                            <?= $status ?>
                                        </small>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <?php if ($order['status'] === 'Shipped'): ?>
                            <div class="alert alert-info mt-4">
                                <i class="bi bi-info-circle me-2"></i>
                                <strong>Your order is on the way!</strong> Expected delivery in 2-3 business days.
                            </div>
                        <?php elseif ($order['status'] === 'Delivered'): ?>
                            <div class="alert alert-success mt-4">
                                <i class="bi bi-check-circle me-2"></i>
                                <strong>Order delivered!</strong> Thank you for shopping with us.
                            </div>
                        <?php elseif ($order['status'] === 'Cancelled'): ?>
                            <div class="alert alert-danger mt-4">
                                <i class="bi bi-x-circle me-2"></i>
                                <strong>Order cancelled.</strong> If you have questions, please <a href="contact_us.php">contact us</a>.
                            </div>
                        <?php endif; ?>

                        <?php if (isset($_SESSION['user_id'])): ?>
                            <div class="d-grid gap-2 mt-4">
                                <a href="view_order.php" class="btn btn-outline-primary">
                                    <i class="bi bi-box-seam me-2"></i>View All Orders
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php else: ?>
                <div class="card border-0 shadow-sm text-center p-5">
                    <i class="bi bi-search display-1 text-muted mb-3"></i>
                    <h4 class="fw-bold mb-2">Track Your Package</h4>
                    <p class="text-muted">Enter your order ID above to see real-time tracking information</p>
                    
                    <div class="row g-3 mt-4 text-start">
                        <div class="col-md-4">
                            <div class="d-flex align-items-start">
                                <i class="bi bi-1-circle-fill text-primary me-3 fs-4"></i>
                                <div>
                                    <h6 class="fw-bold mb-1">Find Your Order ID</h6>
                                    <small class="text-muted">Check your email confirmation or account orders</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex align-items-start">
                                <i class="bi bi-2-circle-fill text-primary me-3 fs-4"></i>
                                <div>
                                    <h6 class="fw-bold mb-1">Enter Order ID</h6>
                                    <small class="text-muted">Type it in the search box above</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex align-items-start">
                                <i class="bi bi-3-circle-fill text-primary me-3 fs-4"></i>
                                <div>
                                    <h6 class="fw-bold mb-1">Track Status</h6>
                                    <small class="text-muted">See real-time updates on your delivery</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>
<?php include __DIR__ . '/../includes/scripts.php'; ?>
</body>
</html>
