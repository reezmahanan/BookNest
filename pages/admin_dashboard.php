<?php
session_start();
include '../config/db.php';

// Check admin login
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

// Fetch Dashboard Summary with better queries
$total_books = $conn->query("SELECT COUNT(*) as count FROM books")->fetch_assoc()['count'];
$total_users = $conn->query("SELECT COUNT(*) as count FROM users")->fetch_assoc()['count'];
$total_orders = $conn->query("SELECT COUNT(*) as count FROM orders")->fetch_assoc()['count'];
$total_earnings = $conn->query("SELECT SUM(total_amount) as sum FROM orders WHERE order_status IN ('Confirmed','Shipped','Delivered')")->fetch_assoc()['sum'];
$pending_orders = $conn->query("SELECT COUNT(*) as count FROM orders WHERE order_status = 'Pending'")->fetch_assoc()['count'];
?>

<?php $pageTitle='Admin Dashboard | BookNest'; include __DIR__ . '/../includes/head.php'; ?>
<style>
.dashboard-card {
    background: white;
    border-radius: 15px;
    padding: 1.5rem;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    border: none;
    transition: transform 0.3s ease;
}

.dashboard-card:hover {
    transform: translateY(-5px);
}

.stat-number {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
}

.stat-label {
    color: #6c757d;
    font-weight: 600;
}

.table-responsive {
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
}

.book-img {
    width: 60px;
    height: 80px;
    object-fit: cover;
    border-radius: 8px;
}
</style>

<?php include('../includes/navbar.php'); ?>

<div class="container-fluid mt-4">
    <!-- Dashboard Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h3 fw-bold">📊 Admin Dashboard</h1>
                <div class="btn-group">
                    <a href="add_book.php" class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i> Add New Book
                    </a>
                    <?php if($_SESSION['admin_role'] === 'superadmin'): ?>
                    <a href="add_admin.php" class="btn btn-outline-primary">
                        <i class="bi bi-person-plus"></i> Add Admin
                    </a>
                    <?php endif; ?>
                </div>
            </div>
            <p class="text-muted">Welcome back, <?= htmlspecialchars($_SESSION['admin_name']) ?>! Here's your store overview.</p>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row g-4 mb-5">
        <div class="col-xl-2 col-md-4 col-6">
            <div class="dashboard-card text-center">
                <div class="stat-number text-primary"><?= $total_books ?></div>
                <div class="stat-label">Total Books</div>
            </div>
        </div>
        <div class="col-xl-2 col-md-4 col-6">
            <div class="dashboard-card text-center">
                <div class="stat-number text-success"><?= $total_users ?></div>
                <div class="stat-label">Total Users</div>
            </div>
        </div>
        <div class="col-xl-2 col-md-4 col-6">
            <div class="dashboard-card text-center">
                <div class="stat-number text-info"><?= $total_orders ?></div>
                <div class="stat-label">Total Orders</div>
            </div>
        </div>
        <div class="col-xl-2 col-md-4 col-6">
            <div class="dashboard-card text-center">
                <div class="stat-number text-warning"><?= $pending_orders ?></div>
                <div class="stat-label">Pending Orders</div>
            </div>
        </div>
        <div class="col-xl-2 col-md-4 col-6">
            <div class="dashboard-card text-center">
                <div class="stat-number text-danger">$<?= number_format($total_earnings, 2) ?></div>
                <div class="stat-label">Total Revenue</div>
            </div>
        </div>
        <div class="col-xl-2 col-md-4 col-6">
            <div class="dashboard-card text-center">
                <div class="stat-number" style="color: #8b4513;"><?= $_SESSION['admin_role'] ?></div>
                <div class="stat-label">Your Role</div>
            </div>
        </div>
    </div>

    <!-- Books Management -->
    <div class="row">
        <div class="col-12">
            <div class="dashboard-card">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="fw-bold">📚 Books Management</h4>
                    <a href="add_book.php" class="btn btn-sm btn-primary">Add New Book</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $books = $conn->query("SELECT b.*, c.category_name FROM books b LEFT JOIN categories c ON b.category_id=c.category_id ORDER BY b.added_at DESC");
                            while($b = $books->fetch_assoc()):
                            ?>
                            <tr>
                                <td><strong>#<?= $b['book_id'] ?></strong></td>
                                <td>
                                    <?php 
                                    // Check if image_url is a full URL or local path
                                    if (filter_var($b['image_url'], FILTER_VALIDATE_URL)) {
                                        // It's a full URL (e.g., Open Library)
                                        $imgSrc = $b['image_url'];
                                    } else {
                                        // It's a local path
                                        $imgPath = "../assets/images/".$b['image_url'];
                                        if(!file_exists($imgPath) || empty($b['image_url'])) {
                                            $imgSrc = "../assets/images/no-image.jpg";
                                        } else {
                                            $imgSrc = $imgPath;
                                        }
                                    }
                                    ?>
                                    <img src="<?= $imgSrc ?>" alt="<?= htmlspecialchars($b['title']) ?>" class="book-img" onerror="this.src='../assets/images/no-image.jpg'">
                                </td>
                                <td>
                                    <strong><?= htmlspecialchars($b['title']) ?></strong>
                                    <?php if($b['stock'] == 0): ?>
                                        <span class="badge bg-danger ms-1">Out of Stock</span>
                                    <?php endif; ?>
                                </td>
                                <td><?= htmlspecialchars($b['author']) ?></td>
                                <td>
                                    <span class="badge bg-secondary"><?= htmlspecialchars($b['category_name']) ?></span>
                                </td>
                                <td><strong>$<?= number_format($b['price'],2) ?></strong></td>
                                <td>
                                    <span class="badge bg-<?= $b['stock'] > 10 ? 'success' : ($b['stock'] > 0 ? 'warning' : 'danger') ?>">
                                        <?= $b['stock'] ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="edit_book.php?book_id=<?= $b['book_id'] ?>" class="btn btn-outline-primary">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>
                                        <a href="delete_book.php?book_id=<?= $b['book_id'] ?>" class="btn btn-outline-danger" 
                                           onclick="return confirm('Are you sure you want to delete this book?')">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Additional sections for Users, Orders, Reviews, Payments would follow similar enhanced structure -->
</div>

<?php include __DIR__ . '/../includes/scripts.php'; ?>
</body>
</html>
