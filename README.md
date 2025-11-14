 # BookNest - Online Bookstore

A complete online bookstore website built with PHP and MySQL.

## Student Project

This is a web development project for learning PHP, MySQL, and web design.

## Features

### For Customers:
- Browse books by categories (Fiction, Self-Help, Finance, Science & Technology, Children)
- Search and filter books
- View book details with descriptions and reviews
- Add books to shopping cart
- Wishlist to save favorite books
- Place orders with Cash on Delivery payment
- Track order status
- User registration and login
- View order history
- Get discounts on selected books

### For Admin:
- Admin login (separate from users)
- Add new books with details
- Edit existing books
- Delete books
- Set discounts on books
- View all orders
- Manage inventory

### Support Pages:
- Contact Us form
- Help Center with FAQs
- Track Order page
- Returns & Refund policy
- Shipping Information
- Privacy Policy
- Terms of Service
- Cookie Policy

## Technologies Used

- **Frontend:** HTML5, CSS3, Bootstrap 5.3.3, JavaScript
- **Backend:** PHP 8.2.12
- **Database:** MySQL/MariaDB 10.4.32
- **Server:** XAMPP (Apache + MySQL)
- **Icons:** Bootstrap Icons
- **Fonts:** Google Fonts (Inter)

## Requirements

- XAMPP (with Apache and MySQL)
- Web Browser (Chrome, Firefox, Edge, etc.)
- Text Editor (VS Code recommended)

## Installation Steps

### 1. Install XAMPP
- Download from: https://www.apachefriends.org/
- Install and start Apache and MySQL

### 2. Setup Project
```
1. Copy the 'bookshop' folder to: C:\xampp\htdocs\
2. Your project path should be: C:\xampp\htdocs\bookshop\
```

### 3. Create Database
```
1. Open browser and go to: http://localhost/phpmyadmin
2. Click "New" to create database
3. Database name: bookstore_db
4. Click "Create"
```

### 4. Import Database
```
1. Select 'bookstore_db' database
2. Click "Import" tab
3. Click "Choose File"
4. Select: bookstore_db.sql (from project folder)
5. Click "Go" button at bottom
6. Wait for success message
```

### 5. Configure Database Connection
Open `config/db.php` and check these settings:
```php
$host = 'localhost';
$username = 'root';
$password = '';  // Leave empty for default XAMPP
$database = 'bookstore_db';
$port = 3307;  // Change to 3306 if needed
```

### 6. Run the Website
```
Open browser and visit: http://localhost/bookshop/
```

## Login Details

### User Account:
- Register new account from website
- Or use existing user if imported from database

### Admin Account:
- Go to: http://localhost/bookshop/pages/admin_login.php
- Check database 'admins' table for credentials
- Default admin should be in the SQL file

## Project Structure

```
bookshop/
├── index.php              # Homepage
├── book_details.php       # Individual book page
├── assets/
│   ├── css/
│   │   └── style.css      # All styling
│   ├── images/            # Book images
│   └── js/
│       └── script.js      # JavaScript
├── config/
│   ├── db.php            # Database connection
│   └── mail.php          # Email configuration
├── includes/
│   ├── head.php          # HTML head section
│   ├── navbar.php        # Navigation bar
│   ├── footer.php        # Footer section
│   └── scripts.php       # JavaScript includes
├── pages/
│   ├── view_book.php     # Browse all books
│   ├── view_cart.php     # Shopping cart
│   ├── view_wishlist.php # Wishlist page
│   ├── view_order.php    # Order history
│   ├── register.php      # User registration
│   ├── login_user.php    # User login
│   ├── user_profile.php  # User profile
│   ├── add_to_cart.php   # Add item to cart
│   ├── place_order.php   # Place order
│   ├── admin_login.php   # Admin login
│   ├── admin_dashboard.php # Admin panel
│   ├── add_book.php      # Add new book
│   ├── edit_book.php     # Edit book
│   ├── contact_us.php    # Contact form
│   ├── help_center.php   # FAQ page
│   └── [more pages...]
└── bookstore_db.sql      # Database file

```

## Color Theme

- Purple: #6B46C1
- Teal: #14B8A6
- Amber: #F59E0B

## Email Setup (Optional)

For email notifications (order confirmation, contact form):

- Requires Gmail account with App Password
- Test using `test_email.php`

## Common Issues

### MySQL Port Issue:
If you get "Connection refused" error:
- Check if MySQL is running in XAMPP
- Try changing port from 3307 to 3306 in `db.php`

### Images Not Showing:
- Book images use Open Library URLs
- Make sure you have internet connection
- Or upload local images to `assets/images/`

### Page Not Found:
- Check Apache is running in XAMPP
- Verify folder is at: `C:\xampp\htdocs\bookshop\`
- Use correct URL: `http://localhost/bookshop/`

## Important Notes

- This is a learning project, not production-ready
- Passwords are hashed using PHP's `password_hash()`
- SQL injection prevented using prepared statements
- Session management for user authentication
- Bootstrap for responsive design

## Learning Objectives

This project covers:
- PHP basics and OOP concepts
- MySQL database design
- CRUD operations (Create, Read, Update, Delete)
- User authentication and sessions
- Shopping cart functionality
- File uploads
- Form validation
- Responsive web design
- CSS styling and animations

## Credits

- Book covers from Open Library
- Icons from Bootstrap Icons
- Framework: Bootstrap 5
- Fonts: Google Fonts

## Team Members

This project was developed by:
- M. Reezma Hanan
- AJ. Raaef
- NM. Mahuroos[repo](https://github.com/Mahroos03)
- NM. Asrar

## Need Help?

If something doesn't work:
1. Check XAMPP - Apache and MySQL are running
2. Check database is imported correctly
3. Check file paths are correct
4. Look for error messages in browser
5. Check PHP error log in XAMPP

---

**Project:** BookNest - Online Bookstore  
**Type:** Team Project  
**Purpose:** Educational/Learning  
**Year:** 2025  
**Version:** 1.0
