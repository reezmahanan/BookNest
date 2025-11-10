<?php
session_start();
$pageTitle = 'BookNest - Your Literary Sanctuary';
include __DIR__ . '/includes/head.php';
?>

<?php include __DIR__ . '/includes/navbar.php'; ?>

<!-- Enhanced Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-4">Discover Your Next Great Read</h1>
                <p class="lead mb-4">Explore thousands of books across all genres. From timeless classics to modern bestsellers, your next favorite book is waiting.</p>
                <div class="d-flex gap-3 flex-wrap">
                    <a href="/bookshop/pages/view_book.php" class="btn btn-primary btn-lg px-4">
                        <i class="bi bi-book me-2"></i>BROWSE COLLECTION
                    </a>
                    <?php if (!isset($_SESSION['user_id'])): ?>
                    <a href="/bookshop/pages/register.php" class="btn btn-outline-light btn-lg px-4">
                        <i class="bi bi-person-plus me-2"></i>Join Now
                    </a>
                    <?php else: ?>
                    <a href="/bookshop/pages/view_order.php" class="btn btn-outline-light btn-lg px-4">
                        <i class="bi bi-box-seam me-2"></i>My Orders
                    </a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <div class="hero-image mt-5 mt-lg-0">
                    <img src="/bookshop/assets/images/reading-illustration.svg" 
                         alt="Reading Illustration" 
                         class="img-fluid" 
                         style="max-height: 400px;"
                         onerror="this.onerror=null; this.src='https://illustrations.popsy.co/amber/reading-book.svg';">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Why Choose BookNest?</h2>
            <p class="text-muted">Experience the best in online book shopping</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon">📚</div>
                    <h4>Vast Collection</h4>
                    <p class="text-muted">Thousands of books across all genres and categories</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon">🚚</div>
                    <h4>Fast Delivery</h4>
                    <p class="text-muted">Free shipping on orders over $25 with quick delivery</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon">⭐</div>
                    <h4>Verified Reviews</h4>
                    <p class="text-muted">Real reviews from genuine readers to help you choose</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Books Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Featured Books</h2>
            <p class="text-muted">Handpicked selections from our collection</p>
        </div>
        <div class="row">
            <?php
            include 'config/db.php';
            $featured_books = $conn->query("SELECT * FROM books ORDER BY added_at DESC LIMIT 3");
            while($book = $featured_books->fetch_assoc()):
                // Check if image_url is a full URL or a local path
                $imageUrl = $book['image_url'];
                if (filter_var($imageUrl, FILTER_VALIDATE_URL)) {
                    // It's a full URL (e.g., Open Library)
                    $imagePath = htmlspecialchars($imageUrl);
                } else {
                    // It's a local path
                    $imagePath = "/bookshop/assets/images/" . htmlspecialchars($imageUrl);
                    if (!file_exists(__DIR__ . "/assets/images/" . $imageUrl) || empty($imageUrl)) {
                        $imagePath = "/bookshop/assets/images/no-image.jpg";
                    }
                }
                
                // Calculate discount
                $originalPrice = $book['price'];
                $discount = $book['discount_percentage'];
                $discountEndDate = $book['discount_end_date'];
                $hasDiscount = $discount > 0 && ($discountEndDate == null || strtotime($discountEndDate) >= time());
                $finalPrice = $hasDiscount ? $originalPrice * (1 - $discount / 100) : $originalPrice;
            ?>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="book-card card h-100 position-relative">
                    <?php if ($hasDiscount): ?>
                        <div class="position-absolute top-0 end-0 m-2" style="z-index: 10;">
                            <span class="badge bg-danger">-<?= number_format($discount, 0) ?>% OFF</span>
                        </div>
                    <?php endif; ?>
                    <img src="<?= $imagePath ?>" class="card-img-top" alt="<?= htmlspecialchars($book['title']) ?>" onerror="this.src='/bookshop/assets/images/no-image.jpg';">
                    <div class="card-body d-flex flex-column">
                        <h5 class="book-title"><?= htmlspecialchars($book['title']) ?></h5>
                        <p class="book-author">by <?= htmlspecialchars($book['author']) ?></p>
                        <div class="rating-stars mb-2">
                            <?php
                            $avgQuery = $conn->query("SELECT AVG(rating) AS avg_rating FROM reviews WHERE book_id = {$book['book_id']}");
                            $avg = $avgQuery->fetch_assoc()['avg_rating'] ?? 0;
                            $fullStars = floor($avg);
                            $hasHalfStar = ($avg - $fullStars) >= 0.5;
                            
                            for ($i = 1; $i <= 5; $i++) {
                                if ($i <= $fullStars) {
                                    echo '<span class="filled">★</span>';
                                } elseif ($i == $fullStars + 1 && $hasHalfStar) {
                                    echo '<span class="filled">★</span>';
                                } else {
                                    echo '<span class="empty">★</span>';
                                }
                            }
                            ?>
                            <small class="text-muted ms-1">(<?= number_format($avg, 1) ?>)</small>
                        </div>
                        <div class="mt-auto">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div>
                                    <?php if ($hasDiscount): ?>
                                        <span class="book-price">$<?= number_format($finalPrice, 2) ?></span>
                                        <small class="text-muted text-decoration-line-through ms-1">$<?= number_format($originalPrice, 2) ?></small>
                                    <?php else: ?>
                                        <span class="book-price">$<?= number_format($originalPrice, 2) ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="d-flex gap-2">
                                <?php if (isset($_SESSION['user_id'])): ?>
                                <a href="pages/add_to_cart.php?book_id=<?= $book['book_id'] ?>" class="btn btn-primary btn-sm flex-grow-1">
                                    <i class="bi bi-cart-plus"></i> Add to Cart
                                </a>
                                <a href="pages/add_to_wishlist.php?book_id=<?= $book['book_id'] ?>&redirect=/bookshop/index.php" 
                                   class="btn btn-outline-danger btn-sm" title="Add to Wishlist">
                                    <i class="bi bi-heart"></i>
                                </a>
                                <?php else: ?>
                                <a href="pages/login_user.php" class="btn btn-outline-primary btn-sm flex-grow-1">
                                    Login to Buy
                                </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
        <div class="text-center mt-4">
            <a href="pages/view_book.php" class="btn btn-outline-primary">View All Books</a>
        </div>
    </div>
</section>

<!-- Newsletter Section -->
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 text-center">
                <h3 class="fw-bold mb-3">Stay Updated</h3>
                <p class="text-muted mb-4">Get the latest book recommendations and exclusive deals</p>
                <form class="d-flex gap-2">
                    <input type="email" class="form-control" placeholder="Enter your email" required>
                    <button type="submit" class="btn btn-primary">Subscribe</button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>

<?php include __DIR__ . '/includes/scripts.php'; ?>
</body>
</html>