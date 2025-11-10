<?php
/**
 * Email Configuration and Helper Functions
 * 
 * This file contains email settings and functions for sending emails
 * throughout the BookNest application.
 */

// Email Configuration
define('MAIL_HOST', 'smtp.gmail.com');           // SMTP server (Gmail, Outlook, etc.)
define('MAIL_PORT', 587);                         // Port (587 for TLS, 465 for SSL)
define('MAIL_USERNAME', 'your-email@gmail.com'); // Your email address
define('MAIL_PASSWORD', 'your-app-password');    // Your email password or app-specific password
define('MAIL_ENCRYPTION', 'tls');                // Encryption type: 'tls' or 'ssl'
define('MAIL_FROM_ADDRESS', 'noreply@booknest.com');
define('MAIL_FROM_NAME', 'BookNest');

/**
 * Send email using PHP's mail() function
 * For production, consider using PHPMailer or SwiftMailer
 */
function sendEmail($to, $subject, $message, $headers = '') {
    // Set default headers if not provided
    if (empty($headers)) {
        $headers = "From: " . MAIL_FROM_NAME . " <" . MAIL_FROM_ADDRESS . ">\r\n";
        $headers .= "Reply-To: " . MAIL_FROM_ADDRESS . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    }
    
    // Send email
    return mail($to, $subject, $message, $headers);
}

/**
 * Send Order Confirmation Email
 */
function sendOrderConfirmationEmail($orderData) {
    $to = $orderData['email'];
    $subject = "Order Confirmation - Order #" . $orderData['order_id'];
    
    $message = getOrderConfirmationTemplate($orderData);
    
    return sendEmail($to, $subject, $message);
}

/**
 * Send Order Status Update Email
 */
function sendOrderStatusEmail($orderData, $newStatus) {
    $to = $orderData['email'];
    $subject = "Order Update - Order #" . $orderData['order_id'];
    
    $message = getOrderStatusTemplate($orderData, $newStatus);
    
    return sendEmail($to, $subject, $message);
}

/**
 * Send Contact Form Email to Admin
 */
function sendContactFormEmail($contactData) {
    $to = MAIL_FROM_ADDRESS; // Send to admin
    $subject = "New Contact Form Submission: " . $contactData['subject'];
    
    $message = getContactFormTemplate($contactData);
    
    return sendEmail($to, $subject, $message);
}

/**
 * Send Welcome Email to New User
 */
function sendWelcomeEmail($userData) {
    $to = $userData['email'];
    $subject = "Welcome to BookNest!";
    
    $message = getWelcomeEmailTemplate($userData);
    
    return sendEmail($to, $subject, $message);
}

/**
 * Send Password Reset Email
 */
function sendPasswordResetEmail($email, $resetToken) {
    $to = $email;
    $subject = "Password Reset Request - BookNest";
    
    $resetLink = "http://localhost/bookshop/pages/reset_password.php?token=" . $resetToken;
    $message = getPasswordResetTemplate($resetLink);
    
    return sendEmail($to, $subject, $message);
}

// ================== EMAIL TEMPLATES ==================

/**
 * Order Confirmation Email Template
 */
function getOrderConfirmationTemplate($orderData) {
    $html = '
    <!DOCTYPE html>
    <html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
            .container { max-width: 600px; margin: 0 auto; padding: 20px; }
            .header { background: linear-gradient(135deg, #6B46C1 0%, #14B8A6 100%); color: white; padding: 30px; text-align: center; }
            .content { background: #f9f9f9; padding: 30px; }
            .order-details { background: white; padding: 20px; margin: 20px 0; border-radius: 8px; }
            .footer { background: #333; color: white; padding: 20px; text-align: center; font-size: 12px; }
            .button { display: inline-block; padding: 12px 30px; background: #6B46C1; color: white; text-decoration: none; border-radius: 5px; margin: 10px 0; }
            table { width: 100%; border-collapse: collapse; }
            th, td { padding: 10px; text-align: left; border-bottom: 1px solid #ddd; }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <h1>📚 BookNest</h1>
                <h2>Order Confirmation</h2>
            </div>
            <div class="content">
                <h3>Thank you for your order!</h3>
                <p>Hi ' . htmlspecialchars($orderData['customer_name']) . ',</p>
                <p>Your order has been successfully placed. Here are your order details:</p>
                
                <div class="order-details">
                    <h4>Order #' . $orderData['order_id'] . '</h4>
                    <p><strong>Order Date:</strong> ' . date('F d, Y') . '</p>
                    <p><strong>Total Amount:</strong> $' . number_format($orderData['total_amount'], 2) . '</p>
                    <p><strong>Payment Method:</strong> ' . htmlspecialchars($orderData['payment_method']) . '</p>
                    <p><strong>Shipping Address:</strong><br>' . nl2br(htmlspecialchars($orderData['shipping_address'])) . '</p>
                </div>
                
                <p>You can track your order status anytime:</p>
                <center>
                    <a href="http://localhost/bookshop/pages/track_order.php?order_id=' . $orderData['order_id'] . '" class="button">Track Your Order</a>
                </center>
                
                <p>We will send you another email once your order ships.</p>
            </div>
            <div class="footer">
                <p>&copy; 2025 BookNest. All rights reserved.</p>
                <p>If you have any questions, contact us at support@booknest.com</p>
            </div>
        </div>
    </body>
    </html>';
    
    return $html;
}

/**
 * Order Status Update Email Template
 */
function getOrderStatusTemplate($orderData, $newStatus) {
    $statusMessages = [
        'Confirmed' => 'Your order has been confirmed and is being prepared for shipment.',
        'Shipped' => 'Great news! Your order has been shipped and is on its way to you.',
        'Delivered' => 'Your order has been delivered. We hope you enjoy your books!',
        'Cancelled' => 'Your order has been cancelled. If you did not request this, please contact us.'
    ];
    
    $message = isset($statusMessages[$newStatus]) ? $statusMessages[$newStatus] : 'Your order status has been updated.';
    
    $html = '
    <!DOCTYPE html>
    <html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
            .container { max-width: 600px; margin: 0 auto; padding: 20px; }
            .header { background: linear-gradient(135deg, #6B46C1 0%, #14B8A6 100%); color: white; padding: 30px; text-align: center; }
            .content { background: #f9f9f9; padding: 30px; }
            .status-badge { display: inline-block; padding: 10px 20px; background: #14B8A6; color: white; border-radius: 20px; font-weight: bold; }
            .footer { background: #333; color: white; padding: 20px; text-align: center; font-size: 12px; }
            .button { display: inline-block; padding: 12px 30px; background: #6B46C1; color: white; text-decoration: none; border-radius: 5px; margin: 10px 0; }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <h1>📚 BookNest</h1>
                <h2>Order Status Update</h2>
            </div>
            <div class="content">
                <p>Hi ' . htmlspecialchars($orderData['customer_name']) . ',</p>
                <p>Your order #' . $orderData['order_id'] . ' status has been updated:</p>
                
                <center>
                    <span class="status-badge">' . htmlspecialchars($newStatus) . '</span>
                </center>
                
                <p>' . $message . '</p>
                
                <center>
                    <a href="http://localhost/bookshop/pages/track_order.php?order_id=' . $orderData['order_id'] . '" class="button">Track Your Order</a>
                </center>
            </div>
            <div class="footer">
                <p>&copy; 2025 BookNest. All rights reserved.</p>
                <p>If you have any questions, contact us at support@booknest.com</p>
            </div>
        </div>
    </body>
    </html>';
    
    return $html;
}

/**
 * Contact Form Email Template
 */
function getContactFormTemplate($contactData) {
    $html = '
    <!DOCTYPE html>
    <html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
            .container { max-width: 600px; margin: 0 auto; padding: 20px; background: #f9f9f9; }
            .header { background: #6B46C1; color: white; padding: 20px; text-align: center; }
            .content { background: white; padding: 30px; margin: 20px 0; border-radius: 8px; }
            .field { margin: 15px 0; }
            .label { font-weight: bold; color: #6B46C1; }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <h2>New Contact Form Submission</h2>
            </div>
            <div class="content">
                <div class="field">
                    <span class="label">From:</span> ' . htmlspecialchars($contactData['name']) . '
                </div>
                <div class="field">
                    <span class="label">Email:</span> ' . htmlspecialchars($contactData['email']) . '
                </div>
                <div class="field">
                    <span class="label">Subject:</span> ' . htmlspecialchars($contactData['subject']) . '
                </div>
                <div class="field">
                    <span class="label">Message:</span><br>
                    ' . nl2br(htmlspecialchars($contactData['message'])) . '
                </div>
                <div class="field">
                    <span class="label">Submitted:</span> ' . date('F d, Y H:i:s') . '
                </div>
            </div>
        </div>
    </body>
    </html>';
    
    return $html;
}

/**
 * Welcome Email Template
 */
function getWelcomeEmailTemplate($userData) {
    $html = '
    <!DOCTYPE html>
    <html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
            .container { max-width: 600px; margin: 0 auto; padding: 20px; }
            .header { background: linear-gradient(135deg, #6B46C1 0%, #14B8A6 100%); color: white; padding: 30px; text-align: center; }
            .content { background: #f9f9f9; padding: 30px; }
            .footer { background: #333; color: white; padding: 20px; text-align: center; font-size: 12px; }
            .button { display: inline-block; padding: 12px 30px; background: #6B46C1; color: white; text-decoration: none; border-radius: 5px; margin: 10px 0; }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <h1>📚 Welcome to BookNest!</h1>
            </div>
            <div class="content">
                <p>Hi ' . htmlspecialchars($userData['full_name']) . ',</p>
                <p>Welcome to BookNest - Your Literary Sanctuary! 🎉</p>
                <p>Thank you for creating an account with us. We are excited to have you join our community of book lovers.</p>
                
                <h3>Here is what you can do:</h3>
                <ul>
                    <li>📚 Browse thousands of books across all genres</li>
                    <li>❤️ Create your personal wishlist</li>
                    <li>🛒 Easy checkout and secure payment</li>
                    <li>📦 Track your orders in real-time</li>
                    <li>💰 Get exclusive discounts and deals</li>
                </ul>
                
                <center>
                    <a href="http://localhost/bookshop/pages/view_book.php" class="button">Start Shopping</a>
                </center>
                
                <p>Happy reading!</p>
                <p>The BookNest Team</p>
            </div>
            <div class="footer">
                <p>&copy; 2025 BookNest. All rights reserved.</p>
                <p>If you have any questions, contact us at support@booknest.com</p>
            </div>
        </div>
    </body>
    </html>';
    
    return $html;
}

/**
 * Password Reset Email Template
 */
function getPasswordResetTemplate($resetLink) {
    $html = '
    <!DOCTYPE html>
    <html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
            .container { max-width: 600px; margin: 0 auto; padding: 20px; }
            .header { background: linear-gradient(135deg, #6B46C1 0%, #14B8A6 100%); color: white; padding: 30px; text-align: center; }
            .content { background: #f9f9f9; padding: 30px; }
            .footer { background: #333; color: white; padding: 20px; text-align: center; font-size: 12px; }
            .button { display: inline-block; padding: 12px 30px; background: #EF4444; color: white; text-decoration: none; border-radius: 5px; margin: 10px 0; }
            .warning { background: #FEF3C7; border-left: 4px solid #F59E0B; padding: 15px; margin: 20px 0; }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <h1>📚 BookNest</h1>
                <h2>Password Reset Request</h2>
            </div>
            <div class="content">
                <p>You have requested to reset your password.</p>
                <p>Click the button below to reset your password:</p>
                
                <center>
                    <a href="' . $resetLink . '" class="button">Reset Password</a>
                </center>
                
                <div class="warning">
                    <strong>⚠️ Security Notice:</strong> This link will expire in 1 hour. If you did not request a password reset, please ignore this email and your password will remain unchanged.
                </div>
                
                <p>Or copy and paste this link into your browser:<br>
                <small>' . $resetLink . '</small></p>
            </div>
            <div class="footer">
                <p>&copy; 2025 BookNest. All rights reserved.</p>
                <p>If you have any questions, contact us at support@booknest.com</p>
            </div>
        </div>
    </body>
    </html>';
    
    return $html;
}
?>
