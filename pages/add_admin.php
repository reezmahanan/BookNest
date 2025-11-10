<?php
session_start();
include '../config/db.php';

// Check superadmin login
if (!isset($_SESSION['admin_id']) || $_SESSION['admin_role'] != 'superadmin') {
    header("Location: admin_login.php");
    exit();
}

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    $stmt = $conn->prepare("INSERT INTO admins (name, email, password, role, created_at) VALUES (?, ?, ?, ?, NOW())");
    $stmt->bind_param("ssss", $name, $email, $password, $role);

    if ($stmt->execute()) {
        $message = "Admin added successfully!";
    } else {
        $message = "Error adding admin. Email may already exist.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Add Admin</title>
<style>
body { font-family: "Poppins", sans-serif; background: #f4f4f4; }
.container { width: 95%; max-width: 400px; margin: 40px auto; background: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);}
h2 { text-align: center; margin-bottom: 20px; }
label { font-weight: bold; display: block; margin-top: 10px; }
input, select { width: 100%; padding: 10px; margin-top: 5px; border-radius: 6px; border: 1px solid #ccc; }
button { padding: 10px; background: #007bff; color: #fff; border: none; border-radius: 6px; margin-top: 15px; width: 100%; cursor: pointer; }
button:hover { background: #0056b3; }
.message { text-align: center; color: green; margin-bottom: 10px; }
</style>
</head>
<body>

<div class="container">
<h2>➕ Add Admin</h2>

<?php if ($message) echo "<p class='message'>$message</p>"; ?>

<form method="POST">
    <label>Name</label>
    <input type="text" name="name" required>

    <label>Email</label>
    <input type="email" name="email" required>

    <label>Password</label>
    <input type="password" name="password" required>

    <label>Role</label>
    <select name="role" required>
        <option value="manager">Manager</option>
        <option value="superadmin">Super Admin</option>
        <option value="staff">Staff</option>
       
    </select>

    <button type="submit">Add Admin</button>
</form>
</div>
</body>
</html>
