<?php
session_start();
$pageTitle = 'Cookie Policy - BookNest';
include __DIR__ . '/../includes/head.php';
include __DIR__ . '/../includes/navbar.php';
?>

<div class="container my-5">
    <div class="row">
        <div class="col-lg-9 mx-auto">
            <div class="text-center mb-5">
                <h1 class="fw-bold mb-3">
                    <i class="bi bi-cookie text-primary me-2"></i>Cookie Policy
                </h1>
                <p class="text-muted">Last Updated: November 8, 2025</p>
            </div>

            <div class="card shadow-sm border-0 rounded-3 mb-4">
                <div class="card-body p-4">
                    <h3 class="h4 fw-bold mb-3">1. What Are Cookies?</h3>
                    <p>Cookies are small text files that are placed on your device (computer, smartphone, or tablet) when you visit a website. They are widely used to make websites work more efficiently and provide information to website owners.</p>
                    <p class="mb-0">Cookies help us understand how you use our website, remember your preferences, and improve your browsing experience.</p>
                </div>
            </div>

            <div class="card shadow-sm border-0 rounded-3 mb-4">
                <div class="card-body p-4">
                    <h3 class="h4 fw-bold mb-3">2. How We Use Cookies</h3>
                    <p>BookNest uses cookies for the following purposes:</p>
                    <ul>
                        <li><strong>Essential functionality:</strong> Enable core website features like user authentication and shopping cart</li>
                        <li><strong>Performance:</strong> Understand how visitors interact with our website</li>
                        <li><strong>Personalization:</strong> Remember your preferences and settings</li>
                        <li><strong>Analytics:</strong> Analyze website traffic and user behavior</li>
                        <li><strong>Marketing:</strong> Show you relevant advertisements and track campaign effectiveness</li>
                    </ul>
                </div>
            </div>

            <div class="card shadow-sm border-0 rounded-3 mb-4">
                <div class="card-body p-4">
                    <h3 class="h4 fw-bold mb-3">3. Types of Cookies We Use</h3>

                    <h5 class="fw-bold mt-4 mb-3">3.1 Strictly Necessary Cookies</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>Purpose</th>
                                    <th>Examples</th>
                                    <th>Duration</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>User authentication</td>
                                    <td>Login session cookies</td>
                                    <td>Session</td>
                                </tr>
                                <tr>
                                    <td>Shopping cart</td>
                                    <td>Cart items, quantities</td>
                                    <td>Session</td>
                                </tr>
                                <tr>
                                    <td>Security</td>
                                    <td>CSRF protection tokens</td>
                                    <td>Session</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <p class="mb-0"><small class="text-muted">These cookies are essential for the website to function properly. They cannot be disabled.</small></p>

                    <h5 class="fw-bold mt-4 mb-3">3.2 Performance Cookies</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>Purpose</th>
                                    <th>Examples</th>
                                    <th>Duration</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Page load times</td>
                                    <td>Performance metrics</td>
                                    <td>1 year</td>
                                </tr>
                                <tr>
                                    <td>Error tracking</td>
                                    <td>Error logs, debugging</td>
                                    <td>Session</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <p class="mb-0"><small class="text-muted">These cookies help us improve website performance and user experience.</small></p>

                    <h5 class="fw-bold mt-4 mb-3">3.3 Functional Cookies</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>Purpose</th>
                                    <th>Examples</th>
                                    <th>Duration</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Language preferences</td>
                                    <td>Selected language</td>
                                    <td>1 year</td>
                                </tr>
                                <tr>
                                    <td>Display preferences</td>
                                    <td>Theme, layout settings</td>
                                    <td>1 year</td>
                                </tr>
                                <tr>
                                    <td>Wishlist</td>
                                    <td>Saved items</td>
                                    <td>30 days</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <p class="mb-0"><small class="text-muted">These cookies remember your choices to provide enhanced, personalized features.</small></p>

                    <h5 class="fw-bold mt-4 mb-3">3.4 Analytics Cookies</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>Purpose</th>
                                    <th>Service</th>
                                    <th>Duration</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Website traffic analysis</td>
                                    <td>Google Analytics</td>
                                    <td>2 years</td>
                                </tr>
                                <tr>
                                    <td>User behavior tracking</td>
                                    <td>Heatmaps, click tracking</td>
                                    <td>1 year</td>
                                </tr>
                                <tr>
                                    <td>Conversion tracking</td>
                                    <td>Purchase completion</td>
                                    <td>90 days</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <p class="mb-0"><small class="text-muted">These cookies help us understand how visitors use our website so we can improve it.</small></p>

                    <h5 class="fw-bold mt-4 mb-3">3.5 Marketing Cookies</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>Purpose</th>
                                    <th>Service</th>
                                    <th>Duration</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Targeted advertising</td>
                                    <td>Facebook Pixel, Google Ads</td>
                                    <td>1 year</td>
                                </tr>
                                <tr>
                                    <td>Retargeting</td>
                                    <td>Display ads on other sites</td>
                                    <td>180 days</td>
                                </tr>
                                <tr>
                                    <td>Social media integration</td>
                                    <td>Share buttons, widgets</td>
                                    <td>Session</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <p class="mb-0"><small class="text-muted">These cookies track your activity to show you relevant advertisements.</small></p>
                </div>
            </div>

            <div class="card shadow-sm border-0 rounded-3 mb-4">
                <div class="card-body p-4">
                    <h3 class="h4 fw-bold mb-3">4. First-Party vs Third-Party Cookies</h3>
                    
                    <h5 class="fw-bold mt-4 mb-3">4.1 First-Party Cookies</h5>
                    <p>These are cookies set directly by BookNest. We use them to operate our website and provide you with our services.</p>

                    <h5 class="fw-bold mt-4 mb-3">4.2 Third-Party Cookies</h5>
                    <p>These are cookies set by third-party services we use, such as:</p>
                    <ul>
                        <li><strong>Google Analytics:</strong> Website analytics and reporting</li>
                        <li><strong>Payment processors:</strong> Secure payment processing</li>
                        <li><strong>Social media platforms:</strong> Social sharing and login features</li>
                        <li><strong>Advertising networks:</strong> Targeted advertising</li>
                    </ul>
                </div>
            </div>

            <div class="card shadow-sm border-0 rounded-3 mb-4">
                <div class="card-body p-4">
                    <h3 class="h4 fw-bold mb-3">5. Cookie Duration</h3>
                    
                    <h5 class="fw-bold mt-4 mb-3">5.1 Session Cookies</h5>
                    <p>These temporary cookies are deleted when you close your browser. They help us remember your actions during a single browsing session.</p>

                    <h5 class="fw-bold mt-4 mb-3">5.2 Persistent Cookies</h5>
                    <p>These cookies remain on your device for a set period (ranging from days to years) or until you manually delete them. They remember your preferences across multiple visits.</p>
                </div>
            </div>

            <div class="card shadow-sm border-0 rounded-3 mb-4">
                <div class="card-body p-4">
                    <h3 class="h4 fw-bold mb-3">6. Managing Your Cookie Preferences</h3>
                    
                    <h5 class="fw-bold mt-4 mb-3">6.1 Browser Settings</h5>
                    <p>Most web browsers allow you to control cookies through their settings. You can:</p>
                    <ul>
                        <li>Block all cookies</li>
                        <li>Accept only first-party cookies</li>
                        <li>Delete cookies after each session</li>
                        <li>Clear all existing cookies</li>
                    </ul>
                    
                    <div class="alert alert-info mb-3">
                        <strong>Popular browser cookie settings:</strong>
                        <ul class="mb-0 mt-2">
                            <li><strong>Chrome:</strong> Settings → Privacy and security → Cookies and other site data</li>
                            <li><strong>Firefox:</strong> Settings → Privacy & Security → Cookies and Site Data</li>
                            <li><strong>Safari:</strong> Preferences → Privacy → Cookies and website data</li>
                            <li><strong>Edge:</strong> Settings → Cookies and site permissions → Cookies and site data</li>
                        </ul>
                    </div>

                    <h5 class="fw-bold mt-4 mb-3">6.2 Opt-Out Tools</h5>
                    <p>You can opt out of specific cookie types:</p>
                    <ul>
                        <li><strong>Google Analytics:</strong> <a href="https://tools.google.com/dlpage/gaoptout" target="_blank">Google Analytics Opt-out Browser Add-on</a></li>
                        <li><strong>Advertising cookies:</strong> <a href="https://optout.aboutads.info/" target="_blank">Digital Advertising Alliance Opt-Out</a></li>
                        <li><strong>Facebook:</strong> <a href="https://www.facebook.com/settings?tab=ads" target="_blank">Facebook Ad Preferences</a></li>
                    </ul>

                    <h5 class="fw-bold mt-4 mb-3">6.3 Impact of Disabling Cookies</h5>
                    <div class="alert alert-warning">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        <strong>Please note:</strong> If you disable cookies, some features of our website may not function properly. You may not be able to:
                        <ul class="mb-0 mt-2">
                            <li>Log in to your account</li>
                            <li>Add items to your cart</li>
                            <li>Complete purchases</li>
                            <li>Save preferences</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm border-0 rounded-3 mb-4">
                <div class="card-body p-4">
                    <h3 class="h4 fw-bold mb-3">7. Do Not Track (DNT)</h3>
                    <p>Some browsers have a "Do Not Track" feature that lets you tell websites you don't want your online activities tracked. Currently, there is no industry standard for recognizing DNT signals, so our website does not respond to DNT browser settings.</p>
                </div>
            </div>

            <div class="card shadow-sm border-0 rounded-3 mb-4">
                <div class="card-body p-4">
                    <h3 class="h4 fw-bold mb-3">8. Updates to This Cookie Policy</h3>
                    <p>We may update this Cookie Policy from time to time to reflect changes in technology, legislation, or our practices. We will notify you of significant changes by posting the updated policy on this page.</p>
                    <p class="mb-0">We encourage you to review this Cookie Policy periodically.</p>
                </div>
            </div>

            <div class="card shadow-sm border-0 rounded-3 mb-4">
                <div class="card-body p-4">
                    <h3 class="h4 fw-bold mb-3">9. More Information</h3>
                    <p>For more information about how we process your personal data, please see our <a href="privacy_policy.php">Privacy Policy</a>.</p>
                    <p>If you have questions about our use of cookies, please contact us:</p>
                    <ul class="list-unstyled mb-0">
                        <li><strong>Email:</strong> <a href="mailto:privacy@booknest.com">privacy@booknest.com</a></li>
                        <li><strong>Phone:</strong> +1 (555) 123-4567</li>
                        <li><strong>Address:</strong> 123 Book Street, Reading City, RC 12345</li>
                    </ul>
                </div>
            </div>

            <div class="card border-0 shadow-sm p-4 text-center" style="background: linear-gradient(135deg, rgba(107,70,193,0.1) 0%, rgba(20,184,166,0.1) 100%);">
                <div class="card-body">
                    <i class="bi bi-cookie display-4 text-primary mb-3"></i>
                    <h4 class="fw-bold mb-3">Your Privacy Matters</h4>
                    <p class="mb-3">We use cookies to improve your experience and provide personalized services. You have control over your cookie preferences.</p>
                    <div class="d-flex gap-2 justify-content-center flex-wrap">
                        <a href="privacy_policy.php" class="btn btn-primary">
                            <i class="bi bi-shield-check me-2"></i>Privacy Policy
                        </a>
                        <a href="contact_us.php" class="btn btn-outline-primary">
                            <i class="bi bi-envelope me-2"></i>Contact Us
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>
<?php include __DIR__ . '/../includes/scripts.php'; ?>
</body>
</html>
