<?php
include('../config/db.php');
include('../config/mail.php');
session_start();
//register user

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);

    // Validation
    if (empty($full_name) || empty($email) || empty($password) || empty($confirm_password)) {
        $error = "All required fields must be filled.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email address.";
    } elseif ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } else {
        // Check existing email
        $check = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $check->bind_param("s", $email);
        $check->execute();
        $result = $check->get_result();

        if ($result->num_rows > 0) {
            $error = "This email is already registered.";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO users (full_name, email, password, phone, address) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $full_name, $email, $hashed_password, $phone, $address);

            if ($stmt->execute()) {
                // Send welcome email
                $userData = [
                    'full_name' => $full_name,
                    'email' => $email
                ];
                sendWelcomeEmail($userData);
                
                $_SESSION['success'] = "Registration successful! Please check your email for a welcome message.";
                header("Location: view_book.php");
                exit();
            } else {
                $error = "Error: Unable to register.";
            }
        }
    }
}
?>

<?php $pageTitle='Register | Bookstore'; include __DIR__ . '/../includes/head.php'; ?>
<?php include('../includes/navbar.php'); ?>
    <div class="container" style="max-width:520px; margin-top:60px;">
        <div class="card p-4 shadow-sm">
        <h2 class="text-center mb-3">Create Account</h2>

        <?php if (isset($error)): ?>
            <p class="error"><?= $error ?></p>
        <?php endif; ?>

        <form method="POST" action="" class="row g-3">
            <div class="col-12">
                <input class="form-control" type="text" name="full_name" placeholder="Full Name" required>
            </div>
            <div class="col-md-6">
                <input class="form-control" type="email" name="email" placeholder="Email Address" required>
            </div>
            <div class="col-md-6">
                <input class="form-control" type="text" name="phone" placeholder="Phone Number">
            </div>
            <div class="col-md-6">
                <input class="form-control" type="password" name="password" placeholder="Password" required>
            </div>
            <div class="col-md-6">
                <input class="form-control" type="password" name="confirm_password" placeholder="Confirm Password" required>
            </div>
            <div class="col-12">
                <textarea class="form-control" name="address" placeholder="Address" rows="3"></textarea>
            </div>
            <div class="col-12 d-grid">
                <button type="submit" class="btn btn-primary">Register</button>
            </div>
        </form>
        <p class="mt-3 text-center">Already have an account? <a href="login_user.php">Login here</a></p>
        </div>
    </div>
<?php include __DIR__ . '/../includes/scripts.php'; ?>
</body>
</html>
