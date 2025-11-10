<?php
session_start();
$pageTitle = 'Contact Us - BookNest';
include __DIR__ . '/../includes/head.php';
include __DIR__ . '/../includes/navbar.php';
include __DIR__ . '/../config/db.php';
include __DIR__ . '/../config/mail.php';

$success_message = '';
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $subject = trim($_POST['subject']);
    $message = trim($_POST['message']);
    
    if (!empty($name) && !empty($email) && !empty($subject) && !empty($message)) {
        // Validate email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error_message = "Please enter a valid email address.";
        } else {
            // Prepare contact data for email
            $contactData = [
                'name' => $name,
                'email' => $email,
                'subject' => $subject,
                'message' => $message
            ];
            
            // Send email to admin
            if (sendContactFormEmail($contactData)) {
                $success_message = "Thank you for contacting us! We've received your message and will get back to you within 24-48 hours.";
            } else {
                $error_message = "There was an error sending your message. Please try again later or email us directly at support@booknest.com.";
            }
        }
    } else {
        $error_message = "Please fill in all fields.";
    }
}
?>

<div class="container my-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="text-center mb-5">
                <h1 class="fw-bold mb-3">
                    <i class="bi bi-envelope-heart text-primary me-2"></i>Contact Us
                </h1>
                <p class="lead text-muted">Have a question or feedback? We'd love to hear from you!</p>
            </div>

            <?php if ($success_message): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-2"></i><?= htmlspecialchars($success_message) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <?php if ($error_message): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle me-2"></i><?= htmlspecialchars($error_message) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <div class="row g-4 mb-5">
                <div class="col-md-4">
                    <div class="card h-100 text-center border-0 shadow-sm">
                        <div class="card-body">
                            <div class="mb-3">
                                <i class="bi bi-geo-alt-fill text-primary" style="font-size: 2.5rem;"></i>
                            </div>
                            <h5 class="fw-bold">Visit Us</h5>
                            <p class="text-muted mb-0">123 Book Street<br>Reading City, RC 12345</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 text-center border-0 shadow-sm">
                        <div class="card-body">
                            <div class="mb-3">
                                <i class="bi bi-telephone-fill text-primary" style="font-size: 2.5rem;"></i>
                            </div>
                            <h5 class="fw-bold">Call Us</h5>
                            <p class="text-muted mb-0">+1 (555) 123-4567<br>Mon-Fri 9AM-6PM</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 text-center border-0 shadow-sm">
                        <div class="card-body">
                            <div class="mb-3">
                                <i class="bi bi-envelope-fill text-primary" style="font-size: 2.5rem;"></i>
                            </div>
                            <h5 class="fw-bold">Email Us</h5>
                            <p class="text-muted mb-0">support@booknest.com<br>info@booknest.com</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body p-4">
                    <h3 class="h4 fw-bold mb-4 text-center">Send Us a Message</h3>
                    <form method="POST" action="">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Your Name *</label>
                                <input type="text" name="name" class="form-control" placeholder="John Doe" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Your Email *</label>
                                <input type="email" name="email" class="form-control" placeholder="john@example.com" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold">Subject *</label>
                                <input type="text" name="subject" class="form-control" placeholder="What is your message about?" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold">Message *</label>
                                <textarea name="message" class="form-control" rows="6" placeholder="Tell us more..." required></textarea>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="bi bi-send me-2"></i>Send Message
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>
<?php include __DIR__ . '/../includes/scripts.php'; ?>
</body>
</html>
