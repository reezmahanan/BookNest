<?php
session_start();
include('../config/db.php');

// If user already logged in
if (isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($email) || empty($password)) {
        $error = "Please enter both email and password.";
    } else {
        // Check if user exists
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

            // Verify password
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['full_name'] = $user['full_name'];
                $_SESSION['email'] = $user['email'];

                header("Location: view_book.php");
                exit();
            } else {
                $error = "Incorrect password.";
            }
        } else {
            $error = "No account found with that email.";
        }
    }
}
?>

<?php $pageTitle='Login | Bookstore'; include __DIR__ . '/../includes/head.php'; ?>
<?php include('../includes/navbar.php'); ?>
    <div class="container" style="max-width:480px; margin-top:60px;">
        <div class="card p-4 shadow-sm">
        <h2 class="text-center mb-3">Login</h2>

        <?php if (isset($error)): ?>
            <p class="error"><?= $error ?></p>
        <?php endif; ?>

        <?php if (isset($_SESSION['success'])): ?>
            <p class="success"><?= $_SESSION['success'] ?></p>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <form method="POST" action="" class="d-grid gap-3">
            <input class="form-control" type="email" name="email" placeholder="Email Address" required>
            <input class="form-control" type="password" name="password" placeholder="Password" required>
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
        <p class="mt-3 text-center">Don't have an account? <a href="register.php">Register here</a></p>
        </div>
    </div>
<?php include __DIR__ . '/../includes/scripts.php'; ?>
</body>
</html>
