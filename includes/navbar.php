<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }

$current = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
function navActive($names) {
    global $current;
    $names = (array)$names;
    return in_array($current, $names) ? ' active' : '';
}

// Get cart count for user (safe include + cast)
$cart_count = 0;
$wishlist_count = 0;
if (isset($_SESSION['user_id'])) {
    @include_once __DIR__ . '/../config/db.php';
    if (isset($conn) && $conn) {
        $user_id = (int) $_SESSION['user_id'];
        $cart_result = $conn->query("SELECT COALESCE(SUM(quantity),0) AS total FROM cart WHERE user_id = $user_id");
        if ($cart_result) {
            $cart_data = $cart_result->fetch_assoc();
            $cart_count = (int)($cart_data['total'] ?? 0);
        }
        
        // Get wishlist count
        $wishlist_result = $conn->query("SELECT COUNT(*) AS total FROM wishlist WHERE user_id = $user_id");
        if ($wishlist_result) {
            $wishlist_data = $wishlist_result->fetch_assoc();
            $wishlist_count = (int)($wishlist_data['total'] ?? 0);
        }
    }
}
?>

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold fs-3" href="/bookshop/index.php">
            📚 <span>Book</span>Nest
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link<?= navActive(['index.php']) ?>" href="/bookshop/index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link<?= navActive(['view_book.php','book_details.php']) ?>" href="/bookshop/pages/view_book.php">Books</a>
                </li>
            </ul>
            
            <ul class="navbar-nav ms-auto">
                <?php if (isset($_SESSION['admin_id'])): ?>
                    <!-- Admin Menu -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            👨‍💼 <?= htmlspecialchars($_SESSION['admin_name'] ?? 'Admin') ?>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/bookshop/pages/admin_dashboard.php">Dashboard</a></li>
                            <li><a class="dropdown-item" href="/bookshop/pages/add_book.php">Add Book</a></li>
                            <?php if(($_SESSION['admin_role'] ?? '') === 'superadmin'): ?>
                                <li><a class="dropdown-item" href="/bookshop/pages/add_admin.php">Add Admin</a></li>
                            <?php endif; ?>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="/bookshop/pages/logout.php">Logout</a></li>
                        </ul>
                    </li>
                    
                <?php elseif (isset($_SESSION['user_id'])): ?>
                    <!-- User Menu -->
                    <li class="nav-item">
                        <a class="nav-link<?= navActive(['view_cart.php']) ?>" href="/bookshop/pages/view_cart.php">
                            🛒 Cart 
                            <?php if($cart_count > 0): ?>
                                <span class="cart-badge"><?= $cart_count ?></span>
                            <?php endif; ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link<?= navActive(['view_wishlist.php']) ?>" href="/bookshop/pages/view_wishlist.php">
                            ❤️ Wishlist
                            <?php if($wishlist_count > 0): ?>
                                <span class="cart-badge"><?= $wishlist_count ?></span>
                            <?php endif; ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link<?= navActive(['view_order.php']) ?>" href="/bookshop/pages/view_order.php">📦 Orders</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            👋 <?= htmlspecialchars($_SESSION['full_name'] ?? 'User') ?>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/bookshop/pages/user_profile.php">Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="/bookshop/pages/logout.php">Logout</a></li>
                        </ul>
                    </li>
                    
                <?php else: ?>
                    <!-- Guest Menu -->
                    <li class="nav-item">
                        <a class="nav-link<?= navActive(['login_user.php']) ?>" href="/bookshop/pages/login_user.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link<?= navActive(['register.php']) ?>" href="/bookshop/pages/register.php">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link<?= navActive(['admin_login.php']) ?>" href="/bookshop/pages/admin_login.php">Admin</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>