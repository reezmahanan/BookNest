<?php
session_start();
$pageTitle = 'Terms of Service - BookNest';
include __DIR__ . '/../includes/head.php';
include __DIR__ . '/../includes/navbar.php';
?>

<div class="container my-5">
    <div class="row">
        <div class="col-lg-9 mx-auto">
            <div class="text-center mb-5">
                <h1 class="fw-bold mb-3">
                    <i class="bi bi-file-text text-primary me-2"></i>Terms of Service
                </h1>
                <p class="text-muted">Last Updated: November 8, 2025</p>
            </div>

            <div class="card shadow-sm border-0 rounded-3 mb-4">
                <div class="card-body p-4">
                    <h3 class="h4 fw-bold mb-3">1. Acceptance of Terms</h3>
                    <p>Welcome to BookNest. By accessing or using our website and services, you agree to be bound by these Terms of Service ("Terms"). If you do not agree to these Terms, please do not use our services.</p>
                    <p class="mb-0">These Terms apply to all visitors, users, and others who access or use our service.</p>
                </div>
            </div>

            <div class="card shadow-sm border-0 rounded-3 mb-4">
                <div class="card-body p-4">
                    <h3 class="h4 fw-bold mb-3">2. Account Registration</h3>
                    
                    <h5 class="fw-bold mt-4 mb-3">2.1 Account Creation</h5>
                    <p>To access certain features, you must create an account. You agree to:</p>
                    <ul>
                        <li>Provide accurate, current, and complete information</li>
                        <li>Maintain and update your information</li>
                        <li>Keep your password secure and confidential</li>
                        <li>Be responsible for all activities under your account</li>
                        <li>Notify us immediately of any unauthorized access</li>
                    </ul>

                    <h5 class="fw-bold mt-4 mb-3">2.2 Account Eligibility</h5>
                    <p>You must be at least 18 years old to create an account. By creating an account, you represent that you meet this age requirement.</p>

                    <h5 class="fw-bold mt-4 mb-3">2.3 Account Termination</h5>
                    <p class="mb-0">We reserve the right to suspend or terminate your account at any time for violation of these Terms or for any other reason at our sole discretion.</p>
                </div>
            </div>

            <div class="card shadow-sm border-0 rounded-3 mb-4">
                <div class="card-body p-4">
                    <h3 class="h4 fw-bold mb-3">3. Orders and Payments</h3>
                    
                    <h5 class="fw-bold mt-4 mb-3">3.1 Order Acceptance</h5>
                    <p>All orders are subject to acceptance and availability. We reserve the right to refuse or cancel any order for any reason, including:</p>
                    <ul>
                        <li>Product unavailability</li>
                        <li>Pricing or product description errors</li>
                        <li>Suspected fraudulent activity</li>
                        <li>Violation of these Terms</li>
                    </ul>

                    <h5 class="fw-bold mt-4 mb-3">3.2 Pricing</h5>
                    <p>All prices are in USD and subject to change without notice. We strive to display accurate pricing, but errors may occur. If an error is discovered, we will notify you and give you the option to cancel your order.</p>

                    <h5 class="fw-bold mt-4 mb-3">3.3 Payment Methods</h5>
                    <p>We accept major credit cards and Cash on Delivery (COD). By providing payment information, you authorize us to charge your payment method for all purchases.</p>

                    <h5 class="fw-bold mt-4 mb-3">3.4 Sales Tax</h5>
                    <p class="mb-0">Sales tax will be added to purchases as required by law. The tax amount is based on the shipping destination.</p>
                </div>
            </div>

            <div class="card shadow-sm border-0 rounded-3 mb-4">
                <div class="card-body p-4">
                    <h3 class="h4 fw-bold mb-3">4. Shipping and Delivery</h3>
                    <p>We ship to addresses within the United States and internationally. Shipping times and costs vary based on location and shipping method selected.</p>
                    <ul>
                        <li>Orders are typically processed within 1-2 business days</li>
                        <li>Delivery times are estimates and not guaranteed</li>
                        <li>Risk of loss passes to you upon delivery to the carrier</li>
                        <li>You are responsible for providing accurate shipping information</li>
                    </ul>
                    <p class="mb-0">For more details, see our <a href="shipping_info.php">Shipping Information</a> page.</p>
                </div>
            </div>

            <div class="card shadow-sm border-0 rounded-3 mb-4">
                <div class="card-body p-4">
                    <h3 class="h4 fw-bold mb-3">5. Returns and Refunds</h3>
                    <p>We accept returns within 30 days of delivery for items in original condition. To initiate a return:</p>
                    <ol>
                        <li>Contact us at returns@booknest.com</li>
                        <li>Obtain a Return Authorization Number (RMA)</li>
                        <li>Ship the item back using our prepaid label</li>
                        <li>Refunds are processed within 5-7 business days</li>
                    </ol>
                    <p class="mb-0">For complete return policy details, see our <a href="returns.php">Returns Policy</a> page.</p>
                </div>
            </div>

            <div class="card shadow-sm border-0 rounded-3 mb-4">
                <div class="card-body p-4">
                    <h3 class="h4 fw-bold mb-3">6. User Conduct</h3>
                    <p>You agree not to:</p>
                    <ul>
                        <li>Use our services for any illegal purpose</li>
                        <li>Violate any laws in your jurisdiction</li>
                        <li>Infringe on intellectual property rights</li>
                        <li>Transmit harmful code, viruses, or malware</li>
                        <li>Attempt to gain unauthorized access to our systems</li>
                        <li>Harass, abuse, or harm other users</li>
                        <li>Post false, misleading, or fraudulent content</li>
                        <li>Scrape, spider, or crawl our website</li>
                        <li>Interfere with the proper functioning of our services</li>
                    </ul>
                </div>
            </div>

            <div class="card shadow-sm border-0 rounded-3 mb-4">
                <div class="card-body p-4">
                    <h3 class="h4 fw-bold mb-3">7. Intellectual Property</h3>
                    
                    <h5 class="fw-bold mt-4 mb-3">7.1 Our Content</h5>
                    <p>All content on BookNest, including text, graphics, logos, images, and software, is the property of BookNest or its licensors and is protected by copyright, trademark, and other intellectual property laws.</p>

                    <h5 class="fw-bold mt-4 mb-3">7.2 User Content</h5>
                    <p>By posting reviews, comments, or other content on our site, you grant us a non-exclusive, royalty-free, worldwide license to use, display, and distribute your content.</p>

                    <h5 class="fw-bold mt-4 mb-3">7.3 Trademarks</h5>
                    <p class="mb-0">BookNest and our logo are trademarks of BookNest. You may not use our trademarks without our prior written consent.</p>
                </div>
            </div>

            <div class="card shadow-sm border-0 rounded-3 mb-4">
                <div class="card-body p-4">
                    <h3 class="h4 fw-bold mb-3">8. Disclaimers and Limitations of Liability</h3>
                    
                    <h5 class="fw-bold mt-4 mb-3">8.1 Service "As Is"</h5>
                    <p>Our services are provided "as is" and "as available" without warranties of any kind, either express or implied, including but not limited to:</p>
                    <ul>
                        <li>Implied warranties of merchantability</li>
                        <li>Fitness for a particular purpose</li>
                        <li>Non-infringement</li>
                    </ul>

                    <h5 class="fw-bold mt-4 mb-3">8.2 Limitation of Liability</h5>
                    <p>To the fullest extent permitted by law, BookNest shall not be liable for any indirect, incidental, special, consequential, or punitive damages, including but not limited to:</p>
                    <ul>
                        <li>Loss of profits or revenue</li>
                        <li>Loss of data</li>
                        <li>Loss of business opportunity</li>
                        <li>Personal injury or property damage</li>
                    </ul>

                    <h5 class="fw-bold mt-4 mb-3">8.3 Maximum Liability</h5>
                    <p class="mb-0">Our total liability for any claim arising out of or relating to these Terms shall not exceed the amount you paid to us in the 12 months preceding the claim.</p>
                </div>
            </div>

            <div class="card shadow-sm border-0 rounded-3 mb-4">
                <div class="card-body p-4">
                    <h3 class="h4 fw-bold mb-3">9. Indemnification</h3>
                    <p>You agree to indemnify, defend, and hold harmless BookNest, its officers, directors, employees, and agents from any claims, damages, losses, liabilities, and expenses (including attorney's fees) arising out of:</p>
                    <ul>
                        <li>Your use of our services</li>
                        <li>Your violation of these Terms</li>
                        <li>Your violation of any rights of another party</li>
                        <li>Your user content</li>
                    </ul>
                </div>
            </div>

            <div class="card shadow-sm border-0 rounded-3 mb-4">
                <div class="card-body p-4">
                    <h3 class="h4 fw-bold mb-3">10. Dispute Resolution</h3>
                    
                    <h5 class="fw-bold mt-4 mb-3">10.1 Governing Law</h5>
                    <p>These Terms are governed by the laws of the United States, without regard to conflict of law principles.</p>

                    <h5 class="fw-bold mt-4 mb-3">10.2 Arbitration</h5>
                    <p>Any dispute arising from these Terms shall be resolved through binding arbitration in accordance with the American Arbitration Association rules.</p>

                    <h5 class="fw-bold mt-4 mb-3">10.3 Class Action Waiver</h5>
                    <p class="mb-0">You agree to bring claims against us only in your individual capacity and not as part of any class or representative action.</p>
                </div>
            </div>

            <div class="card shadow-sm border-0 rounded-3 mb-4">
                <div class="card-body p-4">
                    <h3 class="h4 fw-bold mb-3">11. Modifications to Terms</h3>
                    <p>We reserve the right to modify these Terms at any time. We will notify you of material changes by:</p>
                    <ul>
                        <li>Posting the updated Terms on our website</li>
                        <li>Updating the "Last Updated" date</li>
                        <li>Sending you an email notification (for significant changes)</li>
                    </ul>
                    <p class="mb-0">Your continued use of our services after changes constitutes acceptance of the modified Terms.</p>
                </div>
            </div>

            <div class="card shadow-sm border-0 rounded-3 mb-4">
                <div class="card-body p-4">
                    <h3 class="h4 fw-bold mb-3">12. Termination</h3>
                    <p>We may terminate or suspend your account and access to our services immediately, without prior notice, for:</p>
                    <ul>
                        <li>Breach of these Terms</li>
                        <li>Fraudulent or illegal activity</li>
                        <li>Request by law enforcement</li>
                        <li>Extended periods of inactivity</li>
                        <li>Technical or security reasons</li>
                    </ul>
                    <p class="mb-0">Upon termination, your right to use our services will immediately cease.</p>
                </div>
            </div>

            <div class="card shadow-sm border-0 rounded-3 mb-4">
                <div class="card-body p-4">
                    <h3 class="h4 fw-bold mb-3">13. Severability</h3>
                    <p>If any provision of these Terms is found to be unenforceable or invalid, that provision will be limited or eliminated to the minimum extent necessary, and the remaining provisions will remain in full force and effect.</p>
                </div>
            </div>

            <div class="card shadow-sm border-0 rounded-3 mb-4">
                <div class="card-body p-4">
                    <h3 class="h4 fw-bold mb-3">14. Contact Information</h3>
                    <p>If you have questions about these Terms, please contact us:</p>
                    <ul class="list-unstyled">
                        <li><strong>Email:</strong> <a href="mailto:legal@booknest.com">legal@booknest.com</a></li>
                        <li><strong>Phone:</strong> +1 (555) 123-4567</li>
                        <li><strong>Address:</strong> 123 Book Street, Reading City, RC 12345</li>
                    </ul>
                </div>
            </div>

            <div class="alert alert-warning">
                <i class="bi bi-exclamation-triangle me-2"></i>
                <strong>Important:</strong> By using BookNest, you acknowledge that you have read, understood, and agree to be bound by these Terms of Service.
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>
<?php include __DIR__ . '/../includes/scripts.php'; ?>
</body>
</html>
