<?php
session_start();
include('../config/db.php');

// Handle adding review
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['book_id'])) {
    if (!isset($_SESSION['user_id'])) {
        header("Location: login_user.php");
        exit();
    }

    $book_id = intval($_POST['book_id']);
    $user_id = $_SESSION['user_id'];
    $rating = intval($_POST['rating']);
    $comment = trim($_POST['comment']);

    $stmt = $conn->prepare("INSERT INTO reviews (user_id, book_id, rating, comment, review_date) VALUES (?, ?, ?, ?, NOW())");
    $stmt->bind_param("iiis", $user_id, $book_id, $rating, $comment);
    $stmt->execute();

    header("Location: view_book.php?" . $_SERVER['QUERY_STRING']);
    exit();
}

// Fetch categories for filter
$catQuery = "SELECT * FROM categories ORDER BY category_name";
$catResult = $conn->query($catQuery);

// Base book query with search and filters
$sql = "SELECT b.*, c.category_name 
        FROM books b 
        LEFT JOIN categories c ON b.category_id = c.category_id 
        WHERE 1";
$params = [];

if (!empty($_GET['search'])) {
    $search = '%' . $conn->real_escape_string($_GET['search']) . '%';
    $sql .= " AND (b.title LIKE ? OR b.author LIKE ? OR b.description LIKE ?)";
    $params = array_merge($params, [$search, $search, $search]);
}

if (!empty($_GET['category'])) {
    $category = intval($_GET['category']);
    $sql .= " AND b.category_id = ?";
    $params[] = $category;
}

if (!empty($_GET['min_price'])) {
    $min_price = floatval($_GET['min_price']);
    $sql .= " AND b.price >= ?";
    $params[] = $min_price;
}

if (!empty($_GET['max_price'])) {
    $max_price = floatval($_GET['max_price']);
    $sql .= " AND b.price <= ?";
    $params[] = $max_price;
}

$sql .= " ORDER BY b.added_at DESC";

// Prepare and execute with parameters
$stmt = $conn->prepare($sql);
if (!empty($params)) {
    $types = str_repeat('s', count($params));
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();
?>

<?php $pageTitle = 'Browse Books | BookNest'; include __DIR__ . '/../includes/head.php'; ?>
<style>
.advanced-filters {
    background: white;
    border-radius: 15px;
    padding: 2rem;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    margin-bottom: 2rem;
}

.filter-group {
    margin-bottom: 1rem;
}

.price-range {
    display: flex;
    gap: 1rem;
    align-items: center;
}

.price-range input {
    flex: 1;
}

.book-card {
    transition: all 0.3s ease;
}

.book-card:hover {
    transform: translateY(-5px);
}

.review-section {
    background: #f8f9fa;
    border-radius: 10px;
    padding: 1rem;
    margin-top: 1rem;
}

.review {
    border-bottom: 1px solid #dee2e6;
    padding: 0.75rem 0;
}

.review:last-child {
    border-bottom: none;
}
</style>

<?php include('../includes/navbar.php'); ?>

<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <h1 class="display-5 fw-bold text-center mb-4">📖 Our Book Collection</h1>
            <p class="text-center text-muted mb-5">Discover amazing books from various genres and authors</p>
        </div>
    </div>

    <!-- Advanced Filter Section -->
    <div class="advanced-filters">
        <form method="GET" class="row g-3">
            <div class="col-md-4">
                <label class="form-label fw-semibold">🔍 Search Books</label>
                <input type="text" class="form-control" name="search" placeholder="Title, author, or description..." 
                       value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold">📚 Category</label>
                <select class="form-select" name="category">
                    <option value="">All Categories</option>
                    <?php while ($cat = $catResult->fetch_assoc()): ?>
                        <option value="<?= $cat['category_id'] ?>" 
                            <?= (isset($_GET['category']) && $_GET['category'] == $cat['category_id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($cat['category_name']) ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold">💰 Price Range</label>
                <div class="price-range">
                    <input type="number" class="form-control" name="min_price" placeholder="Min" 
                           step="0.01" value="<?= htmlspecialchars($_GET['min_price'] ?? '') ?>">
                    <span class="text-muted">to</span>
                    <input type="number" class="form-control" name="max_price" placeholder="Max" 
                           step="0.01" value="<?= htmlspecialchars($_GET['max_price'] ?? '') ?>">
                </div>
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">Apply Filters</button>
            </div>
        </form>
    </div>

    <!-- Book Grid -->
    <div class="row">
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                    <div class="book-card card h-100 position-relative">
                        <?php 
                            // Check if image_url is a full URL (Unsplash) or local file
                            $imageUrl = $row['image_url'];
                            if (filter_var($imageUrl, FILTER_VALIDATE_URL)) {
                                // It's a full URL (Unsplash)
                                $imagePath = $imageUrl;
                            } else {
                                // It's a local file
                                $imagePath = "../assets/images/" . htmlspecialchars($imageUrl);
                                if (!file_exists($imagePath) || empty($imageUrl)) {
                                    $imagePath = "https://images.unsplash.com/photo-1512820790803-83ca734da794?w=400&h=600&fit=crop";
                                }
                            }

                            // Calculate discount
                            $originalPrice = $row['price'];
                            $discount = $row['discount_percentage'];
                            $discountEndDate = $row['discount_end_date'];
                            $hasDiscount = $discount > 0 && ($discountEndDate == null || strtotime($discountEndDate) >= time());
                            $finalPrice = $hasDiscount ? $originalPrice * (1 - $discount / 100) : $originalPrice;

                            // Calculate average rating
                            $book_id = $row['book_id'];
                            $avgQuery = $conn->query("SELECT AVG(rating) AS avg_rating FROM reviews WHERE book_id = $book_id");
                            $avg = $avgQuery->fetch_assoc()['avg_rating'] ?? 0;
                            $fullStars = floor($avg);
                            $hasHalfStar = ($avg - $fullStars) >= 0.5;
                            
                            // Check if in wishlist
                            $inWishlist = false;
                            if (isset($_SESSION['user_id'])) {
                                $userId = $_SESSION['user_id'];
                                $wishCheck = $conn->query("SELECT wishlist_id FROM wishlist WHERE user_id = $userId AND book_id = $book_id");
                                $inWishlist = $wishCheck->num_rows > 0;
                            }
                        ?>
                        
                        <?php if ($hasDiscount): ?>
                            <div class="position-absolute top-0 end-0 m-2" style="z-index: 10;">
                                <span class="badge bg-danger">-<?= number_format($discount, 0) ?>% OFF</span>
                            </div>
                        <?php endif; ?>
                        
                        <img src="<?= $imagePath ?>" class="card-img-top" alt="<?= htmlspecialchars($row['title']) ?>" 
                             style="height: 300px; object-fit: cover;">
                        
                        <div class="card-body d-flex flex-column">
                            <h5 class="book-title"><?= htmlspecialchars($row['title']) ?></h5>
                            <p class="book-author text-muted">by <?= htmlspecialchars($row['author']) ?></p>
                            <p class="book-category small text-muted mb-2">
                                <strong>Category:</strong> <?= htmlspecialchars($row['category_name'] ?? 'Uncategorized') ?>
                            </p>
                            
                            <div class="rating-stars mb-2">
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <?php if ($i <= $fullStars): ?>
                                        <span class="filled">★</span>
                                    <?php elseif ($i == $fullStars + 1 && $hasHalfStar): ?>
                                        <span class="filled">★</span>
                                    <?php else: ?>
                                        <span class="empty">★</span>
                                    <?php endif; ?>
                                <?php endfor; ?>
                                <small class="text-muted ms-1">(<?= number_format($avg, 1) ?>)</small>
                            </div>

                            <div class="mt-auto">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <?php if ($hasDiscount): ?>
                                            <span class="book-price h5 mb-0">$<?= number_format($finalPrice, 2) ?></span>
                                            <small class="text-muted text-decoration-line-through ms-1">$<?= number_format($originalPrice, 2) ?></small>
                                        <?php else: ?>
                                            <span class="book-price h5 mb-0">$<?= number_format($originalPrice, 2) ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <span class="badge bg-<?= $row['stock'] > 0 ? 'success' : 'danger' ?>">
                                        <?= $row['stock'] > 0 ? 'In Stock' : 'Out of Stock' ?>
                                    </span>
                                </div>
                                
                                <?php if (isset($_SESSION['user_id'])): ?>
                                    <div class="d-flex gap-2">
                                        <a href="add_to_cart.php?book_id=<?= $row['book_id'] ?>" 
                                           class="btn btn-primary flex-grow-1 <?= $row['stock'] == 0 ? 'disabled' : '' ?>">
                                            <i class="bi bi-cart-plus"></i> Add to Cart
                                        </a>
                                        <?php if ($inWishlist): ?>
                                            <a href="remove_wishlist_item.php?wishlist_id=<?= $book_id ?>" 
                                               class="btn btn-danger" title="Remove from Wishlist">
                                                <i class="bi bi-heart-fill"></i>
                                            </a>
                                        <?php else: ?>
                                            <a href="add_to_wishlist.php?book_id=<?= $row['book_id'] ?>&redirect=view_book.php" 
                                               class="btn btn-outline-danger" title="Add to Wishlist">
                                                <i class="bi bi-heart"></i>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                <?php else: ?>
                                    <a href="login_user.php" class="btn btn-outline-primary w-100">
                                        Login to Purchase
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Reviews Section -->
                        <div class="card-footer bg-transparent">
                            <div class="review-section">
                                <h6 class="fw-semibold mb-3">💬 Customer Reviews</h6>
                                <?php
                                $reviewQuery = $conn->query("SELECT r.*, u.full_name FROM reviews r 
                                                             JOIN users u ON r.user_id = u.user_id 
                                                             WHERE r.book_id = $book_id 
                                                             ORDER BY r.review_date DESC LIMIT 2");
                                if ($reviewQuery->num_rows > 0):
                                    while ($rev = $reviewQuery->fetch_assoc()): ?>
                                        <div class="review">
                                            <div class="d-flex justify-content-between align-items-start">
                                                <strong><?= htmlspecialchars($rev['full_name']) ?></strong>
                                                <span class="badge bg-warning text-dark">⭐ <?= $rev['rating'] ?>/5</span>
                                            </div>
                                            <p class="mb-1"><?= htmlspecialchars($rev['comment']) ?></p>
                                            <small class="text-muted"><?= date('M j, Y', strtotime($rev['review_date'])) ?></small>
                                        </div>
                                    <?php endwhile;
                                else:
                                    echo "<p class='text-muted mb-0'>No reviews yet. Be the first to review!</p>";
                                endif;
                                ?>

                                <?php if (isset($_SESSION['user_id'])): ?>
                                    <button class="btn btn-sm btn-outline-primary mt-3 w-100" 
                                            type="button" 
                                            data-bs-toggle="collapse" 
                                            data-bs-target="#reviewForm<?= $book_id ?>">
                                        Write a Review
                                    </button>
                                    
                                    <div class="collapse mt-2" id="reviewForm<?= $book_id ?>">
                                        <form method="POST">
                                            <input type="hidden" name="book_id" value="<?= $book_id ?>">
                                            <div class="mb-2">
                                                <label class="form-label small">Your Rating</label>
                                                <select name="rating" class="form-select form-select-sm" required>
                                                    <option value="">Select Rating</option>
                                                    <option value="5">5 ⭐ - Excellent</option>
                                                    <option value="4">4 ⭐ - Very Good</option>
                                                    <option value="3">3 ⭐ - Good</option>
                                                    <option value="2">2 ⭐ - Fair</option>
                                                    <option value="1">1 ⭐ - Poor</option>
                                                </select>
                                            </div>
                                            <div class="mb-2">
                                                <textarea name="comment" class="form-control form-control-sm" 
                                                          rows="2" placeholder="Share your thoughts..." required></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-sm w-100">Submit Review</button>
                                        </form>
                                    </div>
                                <?php else: ?>
                                    <p class="text-center mt-2 small">
                                        <a href="login_user.php" class="text-primary">Login</a> to leave a review
                                    </p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="col-12 text-center py-5">
                <div class="empty-state">
                    <h3 class="text-muted">📚 No books found</h3>
                    <p class="text-muted">Try adjusting your search filters or browse all books.</p>
                    <a href="view_book.php" class="btn btn-primary">View All Books</a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include __DIR__ . '/../includes/scripts.php'; ?>
</body>
</html>