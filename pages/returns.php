<?php
session_start();
$pageTitle = 'Returns Policy - BookNest';
include __DIR__ . '/../includes/head.php';
include __DIR__ . '/../includes/navbar.php';
?>

<div class="container my-5">
    <div class="row">
        <div class="col-lg-9 mx-auto">
            <div class="text-center mb-5">
                <h1 class="fw-bold mb-3">
                    <i class="bi bi-arrow-return-left text-primary me-2"></i>Returns & Refunds
                </h1>
                <p class="lead text-muted">We want you to love your purchase. If not, we're here to help!</p>
            </div>

            <div class="card shadow-sm border-0 rounded-3 mb-4">
                <div class="card-body p-4">
                    <h3 class="h4 fw-bold mb-4">📦 Return Policy Overview</h3>
                    <p class="mb-4">At BookNest, customer satisfaction is our priority. We accept returns within <strong>30 days</strong> of delivery for a full refund or exchange.</p>
                    
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="text-center p-3 border rounded">
                                <i class="bi bi-clock-history text-primary" style="font-size: 2rem;"></i>
                                <h6 class="fw-bold mt-3 mb-1">30 Days</h6>
                                <small class="text-muted">Return window</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="text-center p-3 border rounded">
                                <i class="bi bi-cash-coin text-primary" style="font-size: 2rem;"></i>
                                <h6 class="fw-bold mt-3 mb-1">Full Refund</h6>
                                <small class="text-muted">Money back guaranteed</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="text-center p-3 border rounded">
                                <i class="bi bi-truck text-primary" style="font-size: 2rem;"></i>
                                <h6 class="fw-bold mt-3 mb-1">Free Returns</h6>
                                <small class="text-muted">We cover shipping</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm border-0 rounded-3 mb-4">
                <div class="card-body p-4">
                    <h3 class="h4 fw-bold mb-4">✅ Eligible Items</h3>
                    <p class="mb-3">Items eligible for return must meet the following conditions:</p>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Books must be in original, unread condition</li>
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>No writing, highlighting, or markings</li>
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Original packaging and tags intact</li>
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Proof of purchase (order confirmation email)</li>
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Returned within 30 days of delivery</li>
                    </ul>
                </div>
            </div>

            <div class="card shadow-sm border-0 rounded-3 mb-4">
                <div class="card-body p-4">
                    <h3 class="h4 fw-bold mb-4">❌ Non-Returnable Items</h3>
                    <p class="mb-3">The following items cannot be returned:</p>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="bi bi-x-circle-fill text-danger me-2"></i>Books with visible damage or wear</li>
                        <li class="mb-2"><i class="bi bi-x-circle-fill text-danger me-2"></i>Digital downloads or eBooks</li>
                        <li class="mb-2"><i class="bi bi-x-circle-fill text-danger me-2"></i>Opened audiobooks or sealed packages</li>
                        <li class="mb-2"><i class="bi bi-x-circle-fill text-danger me-2"></i>Personalized or customized items</li>
                        <li class="mb-2"><i class="bi bi-x-circle-fill text-danger me-2"></i>Items returned after 30 days</li>
                    </ul>
                </div>
            </div>

            <div class="card shadow-sm border-0 rounded-3 mb-4">
                <div class="card-body p-4">
                    <h3 class="h4 fw-bold mb-4">📝 How to Return an Item</h3>
                    <div class="timeline">
                        <div class="d-flex mb-4">
                            <div class="flex-shrink-0">
                                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                    <strong>1</strong>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="fw-bold mb-2">Contact Us</h6>
                                <p class="text-muted mb-0">Email us at <a href="mailto:returns@booknest.com">returns@booknest.com</a> or call <strong>+1 (555) 123-4567</strong> with your order ID.</p>
                            </div>
                        </div>
                        
                        <div class="d-flex mb-4">
                            <div class="flex-shrink-0">
                                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                    <strong>2</strong>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="fw-bold mb-2">Get Return Authorization</h6>
                                <p class="text-muted mb-0">We'll email you a Return Authorization Number (RMA) and shipping label within 24 hours.</p>
                            </div>
                        </div>
                        
                        <div class="d-flex mb-4">
                            <div class="flex-shrink-0">
                                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                    <strong>3</strong>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="fw-bold mb-2">Pack Your Item</h6>
                                <p class="text-muted mb-0">Securely package your book(s) in original packaging. Include the RMA number inside the box.</p>
                            </div>
                        </div>
                        
                        <div class="d-flex mb-4">
                            <div class="flex-shrink-0">
                                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                    <strong>4</strong>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="fw-bold mb-2">Ship It Back</h6>
                                <p class="text-muted mb-0">Attach the prepaid shipping label and drop off at any courier location. Track your return shipment.</p>
                            </div>
                        </div>
                        
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                    <strong>5</strong>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="fw-bold mb-2">Get Your Refund</h6>
                                <p class="text-muted mb-0">Once we receive and inspect your return, we'll process your refund within 5-7 business days.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm border-0 rounded-3 mb-4">
                <div class="card-body p-4">
                    <h3 class="h4 fw-bold mb-4">💰 Refund Information</h3>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <h6 class="fw-bold">Processing Time</h6>
                            <p class="text-muted mb-0">Refunds are processed within 5-7 business days after we receive your return.</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <h6 class="fw-bold">Refund Method</h6>
                            <p class="text-muted mb-0">Refunds will be issued to your original payment method.</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <h6 class="fw-bold">Shipping Costs</h6>
                            <p class="text-muted mb-0">Original shipping costs are non-refundable unless the item was damaged or incorrect.</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <h6 class="fw-bold">Partial Refunds</h6>
                            <p class="text-muted mb-0">Books with obvious signs of use may receive a partial refund at our discretion.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm border-0 rounded-3 mb-4">
                <div class="card-body p-4">
                    <h3 class="h4 fw-bold mb-4">🔄 Exchanges</h3>
                    <p class="mb-3">If you'd like to exchange an item for something different:</p>
                    <ol>
                        <li class="mb-2">Follow the return process above</li>
                        <li class="mb-2">Wait for your refund to be processed</li>
                        <li class="mb-2">Place a new order for the item you want</li>
                    </ol>
                    <p class="text-muted mb-0"><small>This ensures the fastest service and that your preferred item is in stock.</small></p>
                </div>
            </div>

            <div class="card shadow-sm border-0 rounded-3 mb-4">
                <div class="card-body p-4">
                    <h3 class="h4 fw-bold mb-4">📦 Damaged or Defective Items</h3>
                    <p class="mb-3">If you receive a damaged or defective item:</p>
                    <div class="alert alert-warning mb-3">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        <strong>Important:</strong> Please contact us within 48 hours of delivery with photos of the damaged item.
                    </div>
                    <p class="mb-2">We will:</p>
                    <ul class="mb-0">
                        <li>Send a replacement at no charge, OR</li>
                        <li>Issue a full refund including original shipping costs</li>
                    </ul>
                </div>
            </div>

            <div class="card border-0 shadow-sm text-center p-4" style="background: linear-gradient(135deg, #6B46C1 0%, #14B8A6 100%);">
                <div class="card-body text-white">
                    <h4 class="fw-bold mb-3">Need Help with a Return?</h4>
                    <p class="mb-3">Our customer service team is ready to assist you!</p>
                    <div class="d-flex gap-3 justify-content-center flex-wrap">
                        <a href="contact_us.php" class="btn btn-light btn-lg">
                            <i class="bi bi-envelope me-2"></i>Contact Us
                        </a>
                        <a href="help_center.php" class="btn btn-outline-light btn-lg">
                            <i class="bi bi-question-circle me-2"></i>Help Center
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
