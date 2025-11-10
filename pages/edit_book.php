<?php
session_start();
include '../config/db.php';

// ✅ Check admin login
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

// Get book_id
if (!isset($_GET['book_id']) || empty($_GET['book_id'])) {
    header("Location: admin_dashboard.php");
    exit();
}
$book_id = intval($_GET['book_id']);

// Fetch categories
$categories = $conn->query("SELECT * FROM categories ORDER BY category_name");

// Fetch current book details
$stmt = $conn->prepare("SELECT * FROM books WHERE book_id=?");
$stmt->bind_param("i", $book_id);
$stmt->execute();
$result = $stmt->get_result();
$book = $result->fetch_assoc();

if (!$book) {
    die("Book not found!");
}

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
    $image_url = $book['image_url']; // keep current if not changed
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $target_dir = "../assets/images/";
        $image_name = time() . '_' . basename($_FILES['image']['name']);
        $target_file = $target_dir . $image_name;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            // Delete old image if exists
            if (!empty($book['image_url']) && file_exists($target_dir . $book['image_url'])) {
                unlink($target_dir . $book['image_url']);
            }
            $image_url = $image_name;
        } else {
            $message = "Error uploading image.";
        }
    }

    // Update book
    $update_stmt = $conn->prepare("UPDATE books SET title=?, author=?, publisher=?, category_id=?, isbn=?, price=?, discount_percentage=?, discount_end_date=?, stock=?, description=?, image_url=? WHERE book_id=?");
    $update_stmt->bind_param("sssisdssissi", $title, $author, $publisher, $category_id, $isbn, $price, $discount_percentage, $discount_end_date, $stock, $description, $image_url, $book_id);

    if ($update_stmt->execute()) {
        $message = "Book updated successfully!";
        // Refresh book info
        $book['title']=$title;
        $book['author']=$author;
        $book['publisher']=$publisher;
        $book['category_id']=$category_id;
        $book['isbn']=$isbn;
        $book['price']=$price;
        $book['stock']=$stock;
        $book['description']=$description;
        $book['image_url']=$image_url;
        $book['discount_percentage']=$discount_percentage;
        $book['discount_end_date']=$discount_end_date;
    } else {
        $message = "Error updating book.";
    }
}

$pageTitle = 'Edit Book | BookNest Admin';
include __DIR__ . '/../includes/head.php';
include __DIR__ . '/../includes/navbar.php';
?>

<main class="py-5 bg-light">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="card shadow-sm border-0 rounded-3">
          <div class="card-body p-4">
            <h2 class="h3 fw-bold mb-4 text-center">📝 Edit Book</h2>
            
            <?php if ($message): ?>
              <div class="alert alert-<?= strpos($message, 'success') !== false ? 'success' : 'danger' ?> text-center">
                <?= htmlspecialchars($message) ?>
              </div>
            <?php endif; ?>

<form method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label fw-semibold">Title *</label>
            <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($book['title']) ?>" required>
        </div>
        
        <div class="col-md-6">
            <label class="form-label fw-semibold">Author *</label>
            <input type="text" name="author" class="form-control" value="<?= htmlspecialchars($book['author']) ?>" required>
        </div>
        
        <div class="col-md-6">
            <label class="form-label fw-semibold">Publisher</label>
            <input type="text" name="publisher" class="form-control" value="<?= htmlspecialchars($book['publisher']) ?>">
        </div>
        
        <div class="col-md-6">
            <label class="form-label fw-semibold">Category *</label>
            <select name="category_id" class="form-select" required>
                <option value="">Select Category</option>
                <?php 
                $categories->data_seek(0); // Reset result pointer
                while($cat = $categories->fetch_assoc()): 
                ?>
                    <option value="<?= $cat['category_id'] ?>" <?= ($book['category_id']==$cat['category_id'])?'selected':'' ?>>
                        <?= htmlspecialchars($cat['category_name']) ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
        
        <div class="col-md-6">
            <label class="form-label fw-semibold">ISBN</label>
            <input type="text" name="isbn" class="form-control" value="<?= htmlspecialchars($book['isbn']) ?>">
        </div>
        
        <div class="col-md-3">
            <label class="form-label fw-semibold">Price *</label>
            <input type="number" name="price" step="0.01" class="form-control" value="<?= $book['price'] ?>" required>
        </div>
        
        <div class="col-md-3">
            <label class="form-label fw-semibold">Stock</label>
            <input type="number" name="stock" class="form-control" value="<?= $book['stock'] ?>">
        </div>
        
        <div class="col-md-4">
            <label class="form-label fw-semibold">💰 Discount %</label>
            <input type="number" name="discount_percentage" step="0.01" min="0" max="100" 
                   class="form-control" value="<?= $book['discount_percentage'] ?? 0 ?>" placeholder="0">
            <small class="text-muted">Leave 0 for no discount</small>
        </div>
        
        <div class="col-md-5">
            <label class="form-label fw-semibold">📅 Discount End Date</label>
            <input type="date" name="discount_end_date" class="form-control" 
                   value="<?= $book['discount_end_date'] ?? '' ?>" min="<?= date('Y-m-d') ?>">
            <small class="text-muted">Leave empty for no expiry</small>
        </div>
        
        <div class="col-12">
            <label class="form-label fw-semibold">Description</label>
            <textarea name="description" rows="3" class="form-control"><?= htmlspecialchars($book['description']) ?></textarea>
        </div>
        
        <div class="col-12">
            <label class="form-label fw-semibold">Current Book Cover</label>
            <?php
            $imageUrl = $book['image_url'];
            if (filter_var($imageUrl, FILTER_VALIDATE_URL)) {
                $imgPath = $imageUrl;
            } else {
                $imgPath = "../assets/images/" . htmlspecialchars($imageUrl);
                if (!file_exists($imgPath) || empty($imageUrl)) {
                    $imgPath = "../assets/images/no-image.jpg";
                }
            }
            ?>
            <div class="mt-2">
                <img src="<?= $imgPath ?>" alt="Book Cover" class="img-thumbnail" style="max-height: 200px;">
            </div>
        </div>
        
        <div class="col-12">
            <label class="form-label fw-semibold">Change Book Cover</label>
            <input type="file" name="image" class="form-control" accept="image/*">
            <small class="text-muted">Leave empty to keep current image</small>
        </div>
        
        <div class="col-12 d-flex gap-2 justify-content-end mt-4">
            <a href="admin_dashboard.php" class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary px-4">Update Book</button>
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
