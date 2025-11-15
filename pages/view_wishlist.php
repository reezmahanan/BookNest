<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login_user.php");
    exit;
}

$pageTitle = 'My Wishlist - BookNest';
include __DIR__ . '/../includes/head.php';
include __DIR__ . '/../includes/navbar.php';
include __DIR__ . '/../config/db.php';

$user_id = $_SESSION['user_id'];

// Fetch wishlist items with book details
$wishlistQuery = "
    SELECT w.wishlist_id, w.added_at, b.* 
    FROM wishlist w
    JOIN books b ON w.book_id = b.book_id
    WHERE w.user_id = $user_id
    ORDER BY w.added_at DESC
";
$wishlistResult = $conn->query($wishlistQuery);
?>

<div class="container my-5">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold">
                    <i class="bi bi-heart-fill text-danger me-2"></i>My Wishlist
                </h2>
                <a href="/bookshop/pages/view_book.php" class="btn btn-outline-primary">
                    <i class="bi bi-book me-2"></i>Browse Books
                </a>
            </div>

            <?php if (isset($_SESSION['success_message'])): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= htmlspecialchars($_SESSION['success_message']) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php unset($_SESSION['success_message']); ?>
            <?php endif; ?>

            <?php if (isset($_SESSION['error_message'])): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= htmlspecialchars($_SESSION['error_message']) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php unset($_SESSION['error_message']); ?>
            <?php endif; ?>

            <?php if ($wishlistResult->num_rows > 0): ?>
                <div class="row g-4">
                    <?php while($item = $wishlistResult->fetch_assoc()): 
                        // Check if image_url is a full URL or local path
                        $imageUrl = $item['image_url'];
                        if (filter_var($imageUrl, FILTER_VALIDATE_URL)) {
                            $imagePath = htmlspecialchars($imageUrl);
                        } else {
                            $imagePath = "/bookshop/assets/images/" . htmlspecialchars($imageUrl);
                        }
                        
                        // Calculate discounted price if applicable
                        $originalPrice = $item['price'];
                        $discount = $item['discount_percentage'];
                        $discountEndDate = $item['discount_end_date'];
                        $hasDiscount = $discount > 0 && ($discountEndDate == null || strtotime($discountEndDate) >= time());
                        $finalPrice = $hasDiscount ? $originalPrice * (1 - $discount / 100) : $originalPrice;
                    ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 book-card position-relative">
                            <?php if ($hasDiscount): ?>
                                <div class="position-absolute top-0 end-0 m-2">
                                    <span class="badge bg-danger">-<?= number_format($discount, 0) ?>% OFF</span>
                                </div>
                            <?php endif; ?>
                            
                            <img src="<?= $imagePath ?>" 
                                 class="card-img-top" 
                                 alt="<?= htmlspecialchars($item['title']) ?>"
                                 onerror="this.src='/bookshop/assets/images/no-image.jpg';">
                            
                            <div class="card-body d-flex flex-column">
                                <h5 class="book-title"><?= htmlspecialchars($item['title']) ?></h5>
                                <p class="book-author mb-2">by <?= htmlspecialchars($item['author']) ?></p>
                                
                                <div class="mb-2">
                                    <?php if ($hasDiscount): ?>
                                        <span class="book-price">$<?= number_format($finalPrice, 2) ?></span>
                                        <small class="text-muted text-decoration-line-through ms-2">$<?= number_format($originalPrice, 2) ?></small>
                                    <?php else: ?>
                                        <span class="book-price">$<?= number_format($originalPrice, 2) ?></span>
                                    <?php endif; ?>
                                </div>
                                
                                <small class="text-muted mb-3">
                                    <i class="bi bi-clock me-1"></i>
                                    Added <?= date('M d, Y', strtotime($item['added_at'])) ?>
                                </small>
                                
                                <div class="mt-auto d-flex gap-2">
                                    <a href="/bookshop/pages/add_to_cart.php?book_id=<?= $item['book_id'] ?>" 
                                       class="btn btn-primary flex-grow-1">
                                        <i class="bi bi-cart-plus me-1"></i>Add to Cart
                                    </a>
                                    <a href="/bookshop/pages/remove_wishlist_item.php?wishlist_id=<?= $item['wishlist_id'] ?>" 
                                       class="btn btn-outline-danger"
                                       onclick="return confirm('Remove this book from your wishlist?');">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; ?>
                </div>
            <?php else: ?>
                <div class="text-center py-5">
                    <i class="bi bi-heart display-1 text-muted"></i>
                    <h4 class="mt-3 text-muted">Your wishlist is empty</h4>
                    <p class="text-muted">Start adding books you love to your wishlist!</p>
                    <a href="/bookshop/pages/view_book.php" class="btn btn-primary mt-3">
                        <i class="bi bi-book me-2"></i>Browse Books
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../includes/scripts.php'; ?>
</body>
</html>
