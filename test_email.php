<?php
/**
 * Email Test Page
 * Use this page to test your email configuration
 */

include 'config/mail.php';

$result = '';
$test_email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $test_email = trim($_POST['test_email']);
    
    if (filter_var($test_email, FILTER_VALIDATE_EMAIL)) {
        // Test contact form email
        $contactData = [
            'name' => 'Test User',
            'email' => $test_email,
            'subject' => 'Test Email from BookNest',
            'message' => 'This is a test email to verify your email configuration is working correctly. If you receive this email, your setup is successful!'
        ];
        
        if (sendContactFormEmail($contactData)) {
            $result = '<div class="alert alert-success">✅ Email sent successfully! Check your inbox at ' . htmlspecialchars($test_email) . '</div>';
        } else {
            $result = '<div class="alert alert-danger">❌ Email failed to send. Please check your configuration in config/mail.php and follow the EMAIL_SETUP_GUIDE.md</div>';
        }
    } else {
        $result = '<div class="alert alert-warning">⚠️ Please enter a valid email address.</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Test - BookNest</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>
<body class="bg-light">
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0"><i class="bi bi-envelope-check"></i> Email Configuration Test</h4>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-info">
                            <h5 class="alert-heading"><i class="bi bi-info-circle"></i> Before Testing:</h5>
                            <ol class="mb-0">
                                <li>Make sure you've configured <code>config/mail.php</code></li>
                                <li>Follow the steps in <code>EMAIL_SETUP_GUIDE.md</code></li>
                                <li>Restart Apache in XAMPP after making changes</li>
                            </ol>
                        </div>

                        <?php if ($result): ?>
                            <?= $result ?>
                        <?php endif; ?>

                        <form method="POST" action="">
                            <div class="mb-3">
                                <label for="test_email" class="form-label">Enter Your Email Address:</label>
                                <input type="email" 
                                       class="form-control" 
                                       id="test_email" 
                                       name="test_email" 
                                       value="<?= htmlspecialchars($test_email) ?>"
                                       placeholder="your-email@example.com" 
                                       required>
                                <div class="form-text">We'll send a test email to this address</div>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="bi bi-send"></i> Send Test Email
                            </button>
                        </form>

                        <hr class="my-4">

                        <div class="alert alert-secondary">
                            <h6><i class="bi bi-gear"></i> Current Configuration:</h6>
                            <table class="table table-sm mb-0">
                                <tr>
                                    <td><strong>SMTP Host:</strong></td>
                                    <td><?= MAIL_HOST ?></td>
                                </tr>
                                <tr>
                                    <td><strong>SMTP Port:</strong></td>
                                    <td><?= MAIL_PORT ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Encryption:</strong></td>
                                    <td><?= MAIL_ENCRYPTION ?></td>
                                </tr>
                                <tr>
                                    <td><strong>From Address:</strong></td>
                                    <td><?= MAIL_FROM_ADDRESS ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Username:</strong></td>
                                    <td><?= substr(MAIL_USERNAME, 0, 3) ?>***@***</td>
                                </tr>
                            </table>
                        </div>

                        <div class="d-grid gap-2">
                            <a href="EMAIL_SETUP_GUIDE.md" class="btn btn-outline-secondary" download>
                                <i class="bi bi-download"></i> Download Setup Guide
                            </a>
                            <a href="index.php" class="btn btn-outline-primary">
                                <i class="bi bi-house"></i> Back to Home
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Troubleshooting Tips -->
                <div class="card shadow-sm mt-4">
                    <div class="card-header bg-warning">
                        <h5 class="mb-0"><i class="bi bi-tools"></i> Troubleshooting Tips</h5>
                    </div>
                    <div class="card-body">
                        <h6>If emails are not sending:</h6>
                        <ul>
                            <li>Check that Apache is running in XAMPP</li>
                            <li>Verify your Gmail App Password is correct (not your regular password)</li>
                            <li>Make sure 2-Step Verification is enabled on your Gmail account</li>
                            <li>Check the error log: <code>C:\xampp\sendmail\error.log</code></li>
                            <li>Verify <code>C:\xampp\sendmail\sendmail.ini</code> is configured</li>
                            <li>Check spam/junk folder in your email</li>
                        </ul>

                        <h6 class="mt-3">Common Configuration Files:</h6>
                        <ul>
                            <li><code>C:\xampp\php\php.ini</code> - PHP mail settings</li>
                            <li><code>C:\xampp\sendmail\sendmail.ini</code> - Sendmail configuration</li>
                            <li><code>config/mail.php</code> - BookNest email settings</li>
                        </ul>
                    </div>
                </div>

                <!-- Email Features -->
                <div class="card shadow-sm mt-4">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0"><i class="bi bi-check-circle"></i> Email Features Implemented</h5>
                    </div>
                    <div class="card-body">
                        <div class="list-group list-group-flush">
                            <div class="list-group-item">
                                <i class="bi bi-envelope text-primary"></i> 
                                <strong>Contact Form Notifications</strong> - Sends inquiries to admin
                            </div>
                            <div class="list-group-item">
                                <i class="bi bi-person-plus text-success"></i> 
                                <strong>Welcome Email</strong> - Sent to new users on registration
                            </div>
                            <div class="list-group-item">
                                <i class="bi bi-cart-check text-info"></i> 
                                <strong>Order Confirmation</strong> - Sent after placing an order
                            </div>
                            <div class="list-group-item text-muted">
                                <i class="bi bi-arrow-repeat text-secondary"></i> 
                                <strong>Order Status Updates</strong> - Ready to implement
                            </div>
                            <div class="list-group-item text-muted">
                                <i class="bi bi-key text-secondary"></i> 
                                <strong>Password Reset</strong> - Ready to implement
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
