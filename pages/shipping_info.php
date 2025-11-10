<?php
session_start();
$pageTitle = 'Shipping Information - BookNest';
include __DIR__ . '/../includes/head.php';
include __DIR__ . '/../includes/navbar.php';
?>

<div class="container my-5">
    <div class="row">
        <div class="col-lg-9 mx-auto">
            <div class="text-center mb-5">
                <h1 class="fw-bold mb-3">
                    <i class="bi bi-truck text-primary me-2"></i>Shipping Information
                </h1>
                <p class="lead text-muted">Fast, reliable delivery to your doorstep</p>
            </div>

            <div class="card shadow-sm border-0 rounded-3 mb-4">
                <div class="card-body p-4">
                    <h3 class="h4 fw-bold mb-4">📦 Shipping Options</h3>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Shipping Method</th>
                                    <th>Delivery Time</th>
                                    <th>Cost</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <strong>Standard Shipping</strong>
                                        <br><small class="text-muted">Regular ground shipping</small>
                                    </td>
                                    <td>5-7 business days</td>
                                    <td>
                                        <strong>FREE</strong> on orders over $25
                                        <br><small class="text-muted">$4.99 under $25</small>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <strong>Express Shipping</strong>
                                        <br><small class="text-muted">Priority delivery</small>
                                    </td>
                                    <td>2-3 business days</td>
                                    <td>$9.99</td>
                                </tr>
                                <tr>
                                    <td>
                                        <strong>Next Day Delivery</strong>
                                        <br><small class="text-muted">Order before 2 PM</small>
                                    </td>
                                    <td>1 business day</td>
                                    <td>$19.99</td>
                                </tr>
                                <tr>
                                    <td>
                                        <strong>International Shipping</strong>
                                        <br><small class="text-muted">Outside USA</small>
                                    </td>
                                    <td>10-15 business days</td>
                                    <td>Varies by location</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm border-0 rounded-3 mb-4">
                <div class="card-body p-4">
                    <h3 class="h4 fw-bold mb-4">🚀 Order Processing</h3>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="d-flex align-items-start">
                                <i class="bi bi-clock-fill text-primary me-3 fs-4"></i>
                                <div>
                                    <h6 class="fw-bold mb-2">Processing Time</h6>
                                    <p class="text-muted mb-0">Orders are typically processed within 1-2 business days. You'll receive a confirmation email once your order ships.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-start">
                                <i class="bi bi-calendar-check text-primary me-3 fs-4"></i>
                                <div>
                                    <h6 class="fw-bold mb-2">Business Days</h6>
                                    <p class="text-muted mb-0">Monday through Friday, excluding US federal holidays. Weekend orders are processed on the next business day.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-start">
                                <i class="bi bi-alarm text-primary me-3 fs-4"></i>
                                <div>
                                    <h6 class="fw-bold mb-2">Same-Day Processing</h6>
                                    <p class="text-muted mb-0">Orders placed before 2 PM EST on business days ship the same day for express and next-day delivery.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-start">
                                <i class="bi bi-box-seam text-primary me-3 fs-4"></i>
                                <div>
                                    <h6 class="fw-bold mb-2">Pre-Orders</h6>
                                    <p class="text-muted mb-0">Pre-ordered books ship on or shortly after their release date. You'll be charged when the item ships.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm border-0 rounded-3 mb-4">
                <div class="card-body p-4">
                    <h3 class="h4 fw-bold mb-4">📍 Shipping Locations</h3>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <h6 class="fw-bold">
                                <i class="bi bi-flag-fill text-primary me-2"></i>Domestic (USA)
                            </h6>
                            <p class="text-muted mb-0">We ship to all 50 states including Alaska, Hawaii, and US territories (Puerto Rico, Guam, US Virgin Islands).</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <h6 class="fw-bold">
                                <i class="bi bi-globe text-primary me-2"></i>International
                            </h6>
                            <p class="text-muted mb-0">We ship to over 100 countries worldwide. International orders may be subject to customs fees and import duties.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm border-0 rounded-3 mb-4">
                <div class="card-body p-4">
                    <h3 class="h4 fw-bold mb-4">📦 Packaging & Care</h3>
                    <p class="mb-3">We take great care in packaging your books:</p>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Books are wrapped in protective bubble wrap</li>
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Shipped in sturdy, crush-resistant boxes</li>
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Eco-friendly, recyclable packaging materials</li>
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Weather-resistant outer packaging for protection</li>
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Fragile stickers on delicate items</li>
                    </ul>
                </div>
            </div>

            <div class="card shadow-sm border-0 rounded-3 mb-4">
                <div class="card-body p-4">
                    <h3 class="h4 fw-bold mb-4">📱 Order Tracking</h3>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <h6 class="fw-bold mb-3">How to Track Your Order</h6>
                            <ol class="mb-0">
                                <li class="mb-2">Check your email for the shipping confirmation</li>
                                <li class="mb-2">Click the tracking number in the email</li>
                                <li class="mb-2">Or visit our <a href="track_order.php">Track Order</a> page</li>
                                <li class="mb-2">Enter your order ID to see real-time updates</li>
                            </ol>
                        </div>
                        <div class="col-md-6">
                            <h6 class="fw-bold mb-3">Tracking Updates Include</h6>
                            <ul class="list-unstyled mb-0">
                                <li class="mb-2"><i class="bi bi-circle-fill text-primary me-2" style="font-size: 0.5rem;"></i>Order confirmed</li>
                                <li class="mb-2"><i class="bi bi-circle-fill text-primary me-2" style="font-size: 0.5rem;"></i>Package shipped</li>
                                <li class="mb-2"><i class="bi bi-circle-fill text-primary me-2" style="font-size: 0.5rem;"></i>In transit</li>
                                <li class="mb-2"><i class="bi bi-circle-fill text-primary me-2" style="font-size: 0.5rem;"></i>Out for delivery</li>
                                <li class="mb-2"><i class="bi bi-circle-fill text-primary me-2" style="font-size: 0.5rem;"></i>Delivered</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm border-0 rounded-3 mb-4">
                <div class="card-body p-4">
                    <h3 class="h4 fw-bold mb-4">❓ Shipping FAQs</h3>
                    
                    <div class="mb-4">
                        <h6 class="fw-bold">Can I change my shipping address after placing an order?</h6>
                        <p class="text-muted mb-0">If your order hasn't shipped yet, contact us immediately at support@booknest.com and we'll try to update the address. Once shipped, address changes are not possible.</p>
                    </div>
                    
                    <div class="mb-4">
                        <h6 class="fw-bold">What if I miss my delivery?</h6>
                        <p class="text-muted mb-0">The courier will leave a delivery notice with instructions. You can usually reschedule delivery online or pick up from a local facility.</p>
                    </div>
                    
                    <div class="mb-4">
                        <h6 class="fw-bold">Do you ship to PO Boxes?</h6>
                        <p class="text-muted mb-0">Yes, we ship to PO Boxes via USPS. However, expedited shipping options may not be available for PO Box addresses.</p>
                    </div>
                    
                    <div class="mb-4">
                        <h6 class="fw-bold">Are there any additional fees?</h6>
                        <p class="text-muted mb-0">Domestic orders have no additional fees. International orders may be subject to customs duties, taxes, or brokerage fees determined by your country.</p>
                    </div>
                    
                    <div class="mb-0">
                        <h6 class="fw-bold">What if my package is lost or damaged?</h6>
                        <p class="text-muted mb-0">All shipments are insured. If your package is lost or arrives damaged, contact us within 48 hours at support@booknest.com with photos, and we'll send a replacement or issue a full refund.</p>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm border-0 rounded-3 mb-4" style="background: linear-gradient(135deg, rgba(107,70,193,0.1) 0%, rgba(20,184,166,0.1) 100%);">
                <div class="card-body p-4">
                    <h3 class="h4 fw-bold mb-3">🌱 Sustainable Shipping</h3>
                    <p class="mb-3">We're committed to reducing our environmental impact:</p>
                    <div class="row g-3">
                        <div class="col-md-4 text-center">
                            <i class="bi bi-recycle text-success" style="font-size: 2.5rem;"></i>
                            <p class="mt-2 mb-0 fw-bold">100% Recyclable Packaging</p>
                        </div>
                        <div class="col-md-4 text-center">
                            <i class="bi bi-tree text-success" style="font-size: 2.5rem;"></i>
                            <p class="mt-2 mb-0 fw-bold">Carbon Neutral Shipping</p>
                        </div>
                        <div class="col-md-4 text-center">
                            <i class="bi bi-box-seam text-success" style="font-size: 2.5rem;"></i>
                            <p class="mt-2 mb-0 fw-bold">Minimal Packaging</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm text-center p-4" style="background: linear-gradient(135deg, #6B46C1 0%, #14B8A6 100%);">
                <div class="card-body text-white">
                    <h4 class="fw-bold mb-3">Questions About Shipping?</h4>
                    <p class="mb-3">Our customer service team is here to help!</p>
                    <div class="d-flex gap-3 justify-content-center flex-wrap">
                        <a href="contact_us.php" class="btn btn-light btn-lg">
                            <i class="bi bi-envelope me-2"></i>Contact Us
                        </a>
                        <a href="track_order.php" class="btn btn-outline-light btn-lg">
                            <i class="bi bi-truck me-2"></i>Track Order
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
