<!-- 🎨 Modern Footer with Purple & Teal Gradient Theme -->
<footer class="footer-modern">
  <div class="footer-main">
    <div class="container py-5">
      <div class="row g-4">
        <!-- Brand Section -->
        <div class="col-lg-4 col-md-6">
          <div class="footer-brand mb-4">
            <h3 class="fw-bold text-white mb-3">
              📚 <span class="text-gradient-footer">Book</span><span class="text-warning">Nest</span>
            </h3>
            <p class="text-light-muted mb-4">
              Your literary sanctuary. Discover thousands of books across all genres, from timeless classics to modern bestsellers.
            </p>
            <div class="social-links d-flex gap-3">
              <a href="https://www.facebook.com/booknest" target="_blank" rel="noopener noreferrer" class="social-icon" aria-label="Facebook">
                <i class="bi bi-facebook"></i>
              </a>
              <a href="https://twitter.com/booknest" target="_blank" rel="noopener noreferrer" class="social-icon" aria-label="Twitter">
                <i class="bi bi-twitter"></i>
              </a>
              <a href="https://www.instagram.com/booknest" target="_blank" rel="noopener noreferrer" class="social-icon" aria-label="Instagram">
                <i class="bi bi-instagram"></i>
              </a>
              <a href="https://www.linkedin.com/company/booknest" target="_blank" rel="noopener noreferrer" class="social-icon" aria-label="LinkedIn">
                <i class="bi bi-linkedin"></i>
              </a>
            </div>
          </div>
        </div>

        <!-- Quick Links -->
        <div class="col-lg-2 col-md-6 col-6">
          <h5 class="footer-title mb-4">Quick Links</h5>
          <ul class="footer-links list-unstyled">
            <li><a href="/bookshop/index.php">🏠 Home</a></li>
            <li><a href="/bookshop/pages/view_book.php">📚 Books</a></li>
            <li><a href="/bookshop/pages/view_cart.php">🛒 Cart</a></li>
            <li><a href="/bookshop/pages/view_order.php">📦 Orders</a></li>
          </ul>
        </div>

        <!-- Categories -->
        <div class="col-lg-2 col-md-6 col-6">
          <h5 class="footer-title mb-4">Categories</h5>
          <ul class="footer-links list-unstyled">
            <li><a href="/bookshop/pages/view_book.php?category=1">Fiction</a></li>
            <li><a href="/bookshop/pages/view_book.php?category=2">Self-Help</a></li>
            <li><a href="/bookshop/pages/view_book.php?category=3">Finance</a></li>
            <li><a href="/bookshop/pages/view_book.php?category=4">Science & Technology</a></li>
            <li><a href="/bookshop/pages/view_book.php?category=5">Children</a></li>
          </ul>
        </div>

        <!-- Customer Service -->
        <div class="col-lg-2 col-md-6 col-6">
          <h5 class="footer-title mb-4">Support</h5>
          <ul class="footer-links list-unstyled">
            <li><a href="/bookshop/pages/help_center.php">Help Center</a></li>
            <li><a href="/bookshop/pages/shipping_info.php">Shipping Info</a></li>
            <li><a href="/bookshop/pages/returns.php">Returns</a></li>
            <li><a href="/bookshop/pages/track_order.php">Track Order</a></li>
            <li><a href="/bookshop/pages/contact_us.php">Contact Us</a></li>
          </ul>
        </div>

        <!-- Newsletter -->
        <div class="col-lg-2 col-md-6 col-6">
          <h5 class="footer-title mb-4">Account</h5>
          <ul class="footer-links list-unstyled">
            <?php if(isset($_SESSION['user_id'])): ?>
              <li><a href="/bookshop/pages/user_profile.php">👤 Profile</a></li>
              <li><a href="/bookshop/pages/view_order.php">📋 Orders</a></li>
              <li><a href="/bookshop/pages/logout.php">🚪 Logout</a></li>
            <?php else: ?>
              <li><a href="/bookshop/pages/login_user.php">🔐 Login</a></li>
              <li><a href="/bookshop/pages/register.php">✨ Register</a></li>
            <?php endif; ?>
            <?php if(isset($_SESSION['admin_id'])): ?>
              <li><a href="/bookshop/pages/admin_dashboard.php">⚙️ Dashboard</a></li>
            <?php endif; ?>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer Bottom -->
  <div class="footer-bottom">
    <div class="container">
      <div class="row align-items-center py-4">
        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
          <p class="mb-0 text-light-muted">
            &copy; <?= date('Y') ?> <strong>BookNest</strong>. All rights reserved.
          </p>
        </div>
        <div class="col-md-6 text-center text-md-end">
          <ul class="footer-legal list-inline mb-0">
            <li class="list-inline-item"><a href="/bookshop/pages/privacy_policy.php">Privacy Policy</a></li>
            <li class="list-inline-item">•</li>
            <li class="list-inline-item"><a href="/bookshop/pages/terms_of_service.php">Terms of Service</a></li>
            <li class="list-inline-item">•</li>
            <li class="list-inline-item"><a href="/bookshop/pages/cookies.php">Cookies</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</footer>
