<?php
// Unified, styled Orders page using shared includes & Bootstrap components
session_start();
require_once __DIR__ . '/../config/db.php';

if (!isset($_SESSION['user_id'])) {
        header('Location: /bookshop/pages/login_user.php');
        exit;
}

$user_id = (int) $_SESSION['user_id'];

$sql = "SELECT o.order_id, o.total_amount, o.order_status, o.payment_method, o.order_date,
                             b.title, b.author, b.image_url
                FROM orders o
                JOIN books b ON o.book_id = b.book_id
                WHERE o.user_id = ?
                ORDER BY o.order_date DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();

$pageTitle = 'My Orders';
include __DIR__ . '/../includes/head.php';
include __DIR__ . '/../includes/navbar.php';
?>

<main class="py-5 bg-light">
    <div class="container">
        <div class="row mb-4">
            <div class="col">
                <h1 class="h3 fw-bold d-flex align-items-center gap-2">📦 My Orders</h1>
                <p class="text-muted mb-0">Track the status of every book you purchased.</p>
            </div>
        </div>

        <?php if ($result->num_rows > 0): ?>
            <div class="list-group shadow-sm">
                <?php while ($row = $result->fetch_assoc()): ?>
                    <?php
                        $status = $row['order_status'];
                        $badgeClass = match($status) {
                            'Pending' => 'bg-warning text-dark',
                            'Confirmed' => 'bg-primary',
                            'Shipped' => 'bg-info',
                            'Delivered' => 'bg-success',
                            'Cancelled' => 'bg-danger',
                            default => 'bg-secondary'
                        };
                        
                        // Check if image_url is a full URL or local path
                        if (filter_var($row['image_url'], FILTER_VALIDATE_URL)) {
                            $imgSrc = $row['image_url'];
                        } else {
                            $imgSrc = "/bookshop/assets/images/" . htmlspecialchars($row['image_url']);
                        }
                    ?>
                    <div class="list-group-item py-3">
                        <div class="d-flex">
                            <img src="<?= $imgSrc ?>" alt="<?= htmlspecialchars($row['title']) ?>" class="rounded shadow-sm me-3" style="width:80px;height:110px;object-fit:cover;" onerror="this.src='/bookshop/assets/images/no-image.jpg'" />
                            <div class="flex-grow-1">
                                <h5 class="mb-1"><?= htmlspecialchars($row['title']) ?></h5>
                                <p class="mb-1 small text-muted">By <?= htmlspecialchars($row['author']) ?></p>
                                <div class="small text-secondary">
                                    <span class="me-3">Total: <strong>$<?= number_format($row['total_amount'], 2) ?></strong></span>
                                    <span class="me-3">Payment: <?= htmlspecialchars($row['payment_method']) ?></span>
                                    <span>Date: <?= date('M d, Y h:i A', strtotime($row['order_date'])) ?></span>
                                </div>
                            </div>
                            <div class="text-end">
                                <span class="badge <?= $badgeClass ?> px-3 py-2 fw-semibold"><?= htmlspecialchars($status) ?></span>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <div class="text-center py-5 bg-white rounded shadow-sm">
                <p class="lead mb-3">You haven't placed any orders yet.</p>
                <a href="/bookshop/pages/view_book.php" class="btn btn-primary btn-lg">Browse Books</a>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php include __DIR__ . '/../includes/scripts.php'; ?>
</body>
</html>
