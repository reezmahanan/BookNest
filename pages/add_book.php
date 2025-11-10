<?php
session_start();
include '../config/db.php';

// Check admin login
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

// Fetch categories for dropdown
$categories = $conn->query("SELECT * FROM categories ORDER BY category_name");

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $author = trim($_POST['author']);
    $publisher = trim($_POST['publisher']);
    $category_id = intval($_POST['category_id']);
    $isbn = trim($_POST['isbn']);
    $price = floatval($_POST['price']);
    $stock = intval($_POST['stock']);
    $description = trim($_POST['description']);
    $discount_percentage = isset($_POST['discount_percentage']) ? floatval($_POST['discount_percentage']) : 0;
    $discount_end_date = !empty($_POST['discount_end_date']) ? $_POST['discount_end_date'] : null;

    // Handle image upload
    $image_url = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $target_dir = "../assets/images/";
        $image_name = time() . '_' . basename($_FILES['image']['name']);
        $target_file = $target_dir . $image_name;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            $image_url = $image_name;
        } else {
            $message = "Error uploading image.";
        }
    }

    // Insert into database
    $stmt = $conn->prepare("INSERT INTO books (title, author, publisher, category_id, isbn, price, discount_percentage, discount_end_date, stock, description, image_url, added_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");
    $stmt->bind_param("sssisdsdiss", $title, $author, $publisher, $category_id, $isbn, $price, $discount_percentage, $discount_end_date, $stock, $description, $image_url);

    if ($stmt->execute()) {
        $message = "Book added successfully!";
    } else {
        $message = "Error adding book.";
    }
}

$pageTitle = 'Add Book | BookNest Admin';
include __DIR__ . '/../includes/head.php';
include __DIR__ . '/../includes/navbar.php';
?>

<main class="py-5 bg-light">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="card shadow-sm border-0 rounded-3">
          <div class="card-body p-4">
            <h2 class="h3 fw-bold mb-4 text-center">📚 Add New Book</h2>
            
            <?php if ($message): ?>
              <div class="alert alert-<?= strpos($message, 'success') !== false ? 'success' : 'danger' ?> text-center">
                <?= htmlspecialchars($message) ?>
              </div>
            <?php endif; ?>

            <form method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Title *</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Author *</label>
                        <input type="text" name="author" class="form-control" required>
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Publisher</label>
                        <input type="text" name="publisher" class="form-control">
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Category *</label>
                        <select name="category_id" class="form-select" required>
                            <option value="">Select Category</option>
                            <?php while($cat = $categories->fetch_assoc()): ?>
                                <option value="<?= $cat['category_id'] ?>"><?= htmlspecialchars($cat['category_name']) ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">ISBN</label>
                        <input type="text" name="isbn" class="form-control">
                    </div>
                    
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Price *</label>
                        <input type="number" name="price" step="0.01" class="form-control" required>
                    </div>
                    
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Stock</label>
                        <input type="number" name="stock" value="0" class="form-control">
                    </div>
                    
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">💰 Discount %</label>
                        <input type="number" name="discount_percentage" step="0.01" min="0" max="100" value="0" class="form-control" placeholder="0">
                        <small class="text-muted">Leave 0 for no discount</small>
                    </div>
                    
                    <div class="col-md-5">
                        <label class="form-label fw-semibold">📅 Discount End Date</label>
                        <input type="date" name="discount_end_date" class="form-control" min="<?= date('Y-m-d') ?>">
                        <small class="text-muted">Leave empty for no expiry</small>
                    </div>
                    
                    <div class="col-12">
                        <label class="form-label fw-semibold">Description</label>
                        <textarea name="description" rows="3" class="form-control"></textarea>
                    </div>
                    
                    <div class="col-12">
                        <label class="form-label fw-semibold">Book Cover Image</label>
                        <input type="file" name="image" class="form-control" accept="image/*">
                    </div>
                    
                    <div class="col-12 d-flex gap-2 justify-content-end mt-4">
                        <a href="admin_dashboard.php" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary px-4">Add Book</button>
                    </div>
                </div>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<?php include __DIR__ . '/../includes/scripts.php'; ?>
</body>
</html>
