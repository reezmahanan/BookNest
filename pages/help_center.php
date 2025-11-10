<?php
session_start();
$pageTitle = 'Help Center - BookNest';
include __DIR__ . '/../includes/head.php';
include __DIR__ . '/../includes/navbar.php';
?>

<div class="container my-5">
    <div class="text-center mb-5">
        <h1 class="fw-bold mb-3">
            <i class="bi bi-question-circle text-primary me-2"></i>Help Center
        </h1>
        <p class="lead text-muted">Find answers to frequently asked questions</p>
    </div>

    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="accordion" id="faqAccordion">
                <!-- Account & Orders -->
                <div class="accordion-item border-0 shadow-sm mb-3">
                    <h2 class="accordion-header">
                        <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                            <i class="bi bi-person-circle text-primary me-2"></i>How do I create an account?
                        </button>
                    </h2>
                    <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Click on the "Register" button in the top navigation menu. Fill in your details including full name, email, phone, and address. Once registered, you can login and start shopping immediately!
                        </div>
                    </div>
                </div>

                <div class="accordion-item border-0 shadow-sm mb-3">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                            <i class="bi bi-cart-check text-primary me-2"></i>How do I place an order?
                        </button>
                    </h2>
                    <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Browse our collection, click "Add to Cart" on books you want, then go to your cart and click "Checkout". Fill in your payment details and confirm your order. You'll receive an email confirmation immediately.
                        </div>
                    </div>
                </div>

                <div class="accordion-item border-0 shadow-sm mb-3">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                            <i class="bi bi-box-seam text-primary me-2"></i>How can I track my order?
                        </button>
                    </h2>
                    <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Go to "Orders" from your account menu. You'll see all your orders with their current status (Pending, Confirmed, Shipped, Delivered). For detailed tracking, visit our <a href="track_order.php">Track Order</a> page.
                        </div>
                    </div>
                </div>

                <!-- Payment & Pricing -->
                <div class="accordion-item border-0 shadow-sm mb-3">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                            <i class="bi bi-credit-card text-primary me-2"></i>What payment methods do you accept?
                        </button>
                    </h2>
                    <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            We accept Credit/Debit Cards (Visa, Mastercard, American Express) and Cash on Delivery (COD). You can save your payment method in your profile for faster checkout.
                        </div>
                    </div>
                </div>

                <div class="accordion-item border-0 shadow-sm mb-3">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq5">
                            <i class="bi bi-tag text-primary me-2"></i>Do you offer discounts?
                        </button>
                    </h2>
                    <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Yes! We regularly offer discounts on selected books. Look for the red discount badges showing percentage off. Subscribe to our newsletter for exclusive deals and early access to sales.
                        </div>
                    </div>
                </div>

                <!-- Shipping & Delivery -->
                <div class="accordion-item border-0 shadow-sm mb-3">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq6">
                            <i class="bi bi-truck text-primary me-2"></i>What are the shipping costs?
                        </button>
                    </h2>
                    <div id="faq6" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            We offer FREE shipping on all orders over $25. For orders under $25, standard shipping is $4.99. Express shipping is available for $9.99. Learn more on our <a href="shipping_info.php">Shipping Info</a> page.
                        </div>
                    </div>
                </div>

                <div class="accordion-item border-0 shadow-sm mb-3">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq7">
                            <i class="bi bi-clock-history text-primary me-2"></i>How long does delivery take?
                        </button>
                    </h2>
                    <div id="faq7" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Standard delivery takes 5-7 business days. Express delivery takes 2-3 business days. You'll receive tracking information once your order ships.
                        </div>
                    </div>
                </div>

                <!-- Returns & Refunds -->
                <div class="accordion-item border-0 shadow-sm mb-3">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq8">
                            <i class="bi bi-arrow-return-left text-primary me-2"></i>What is your return policy?
                        </button>
                    </h2>
                    <div id="faq8" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            We accept returns within 30 days of delivery. Books must be in original condition with no marks or damage. Refunds are processed within 5-7 business days. Visit our <a href="returns.php">Returns</a> page for detailed information.
                        </div>
                    </div>
                </div>

                <div class="accordion-item border-0 shadow-sm mb-3">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq9">
                            <i class="bi bi-cash-coin text-primary me-2"></i>How do I get a refund?
                        </button>
                    </h2>
                    <div id="faq9" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Once we receive and inspect your return, we'll process your refund. The amount will be credited back to your original payment method within 5-7 business days.
                        </div>
                    </div>
                </div>

                <!-- Account Management -->
                <div class="accordion-item border-0 shadow-sm mb-3">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq10">
                            <i class="bi bi-heart text-primary me-2"></i>How do I use the wishlist?
                        </button>
                    </h2>
                    <div id="faq10" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Click the heart icon on any book to add it to your wishlist. Access your wishlist from the navigation menu to see all saved books. You can easily add items to cart or remove them from your wishlist anytime.
                        </div>
                    </div>
                </div>

                <div class="accordion-item border-0 shadow-sm mb-3">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq11">
                            <i class="bi bi-shield-check text-primary me-2"></i>Is my personal information secure?
                        </button>
                    </h2>
                    <div id="faq11" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Yes! We use industry-standard encryption to protect your personal and payment information. We never share your data with third parties without your consent.
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm mt-5 text-center p-3" style="background: linear-gradient(135deg, #6B46C1 0%, #14B8A6 100%);">
                <div class="card-body text-white py-3">
                    <h5 class="fw-bold mb-2">Still Need Help?</h5>
                    <p class="mb-3 small">Can't find what you're looking for? Our support team is here to help!</p>
                    <a href="contact_us.php" class="btn btn-light">
                        <i class="bi bi-envelope me-2"></i>Contact Support
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../includes/scripts.php'; ?>
