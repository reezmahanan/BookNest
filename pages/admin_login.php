<?php
session_start();
include '../config/db.php';

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $sql = "SELECT * FROM admins WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $admin = $result->fetch_assoc();
        if (password_verify($password, $admin['password'])) {
            // Password correct
            $_SESSION['admin_id'] = $admin['admin_id'];
            $_SESSION['admin_name'] = $admin['name'];
            $_SESSION['admin_role'] = $admin['role'];
            header("Location: admin_dashboard.php");
            exit();
        } else {
            $message = "Incorrect password.";
        }
    } else {
        $message = "Admin not found with this email.";
    }
}
?>

<?php $pageTitle='Admin Login'; include __DIR__ . '/../includes/head.php'; ?>
<?php include('../includes/navbar.php'); ?>
<div class="container" style="max-width:460px; margin-top:70px;">
  <div class="card p-4 shadow-sm">
    <h2 class="text-center mb-3">Admin Login</h2>

    <?php if (!empty($message)): ?>
        <p class="message"><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

    <form method="POST" action="" class="d-grid gap-3">
        <div>
            <label class="form-label">Email</label>
            <input class="form-control" type="email" name="email" required>
        </div>
        <div>
            <label class="form-label">Password</label>
            <input class="form-control" type="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>
  </div>
</div>
<?php include __DIR__ . '/../includes/scripts.php'; ?>
</body>
</html>
