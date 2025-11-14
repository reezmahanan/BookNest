-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Nov 14, 2025 at 08:12 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookstore_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('manager','staff','superadmin') DEFAULT 'superadmin',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `name`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'Super Admin', 'admin@example.com', '$2y$10$kC6/TxN3CBt5a8I.GpEG0uuvtu4mNxR.laNgC6Y0r5BmMm.PaW13a', 'superadmin', '2025-11-08 07:54:18'),
(2, 'New one', 'hello@gmail.com', '$2y$10$H01505gGVTDte9UrO4o0JuPCRZEHJ/cIsIlztNxIzwf5gxlBXe4He', 'manager', '2025-11-08 08:19:47'),
(3, 'jhon', 'adminjhon@example.com', '$2y$10$aL1uzpjUItS1XhnDZxgLMOExyYdTwrsSetF6o.2VwPPVZ4Vs3n28e', 'manager', '2025-11-12 04:30:40'),
(7, 'jhon', 'admin123@example.com', '$2y$10$k6.Mrjqb3mCEFbsI.TvrjO7G6ec7KsdRER04JHw3CqHB2xOX/r/L.', 'staff', '2025-11-12 14:48:10'),
(8, 'Reezma Hanan', 'reezmahanan@gmail.com', '$2y$10$Pbj4ja7sITJqUuKens.SPeiWCVE7h4JrX6SwCTFQKPXiJ0QR0r1qq', 'manager', '2025-11-12 14:54:10');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `book_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `publisher` varchar(255) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `isbn` varchar(50) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `discount_percentage` decimal(5,2) DEFAULT 0.00,
  `discount_end_date` date DEFAULT NULL,
  `stock` int(11) DEFAULT 0,
  `description` text DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `title`, `author`, `publisher`, `category_id`, `isbn`, `price`, `discount_percentage`, `discount_end_date`, `stock`, `description`, `image_url`, `added_at`) VALUES
(1, 'The Great Gatsby', 'F. Scott Fitzgerald', 'Scribner', 1, '9780743273565', 12.99, 15.00, '2025-12-31', 15, 'A classic novel set in the Jazz Age exploring themes of wealth, love, and the American Dream.', 'https://covers.openlibrary.org/b/id/7222246-L.jpg', '2025-11-08 11:00:12'),
(2, 'Atomic Habits', 'James Clear', 'Penguin Random House', 2, '9780735211292', 18.50, 0.00, NULL, 25, 'A guide to building good habits and breaking bad ones using practical strategies.', 'https://covers.openlibrary.org/b/id/8664109-L.jpg', '2025-11-08 11:00:12'),
(3, 'To Kill a Mockingbird', 'Harper Lee', 'J.B. Lippincott & Co.', 1, '9780060935467', 14.25, 15.00, '2025-12-31', 12, 'A moving story about racial injustice and moral growth in the Deep South.', 'https://covers.openlibrary.org/b/id/8228691-L.jpg', '2025-11-08 11:00:12'),
(4, 'The Psychology of Money', 'Morgan Housel', 'Harriman House', 3, '9780857197689', 16.00, 0.00, NULL, 18, 'Doing well with money isn\'t necessarily about what you know. It\'s about how you behave. And behavior is hard to teach, even to really smart people.', 'https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1581527774i/41881472.jpg', '2025-11-08 11:00:12'),
(5, '1984', 'George Orwell', 'Secker & Warburg', 1, '9780451524935', 11.99, 0.00, NULL, 18, 'A dystopian novel about totalitarianism, surveillance, and loss of individuality.', 'https://covers.openlibrary.org/b/id/7222246-L.jpg', '2025-11-08 11:00:12'),
(6, 'Deep Work', 'Cal Newport', 'Grand Central Publishing', 2, '9781455586691', 17.75, 15.00, '2025-12-31', 22, 'A must-read on focused success in a distracted world.', 'https://covers.openlibrary.org/b/id/8240743-L.jpg', '2025-11-08 11:00:28'),
(7, 'Harry Potter and the Sorcerer Stone', 'J.K. Rowling', 'Scholastic', 5, '9780439708180', 15.99, 0.00, NULL, 30, 'The magical adventure of a young wizard discovering his destiny.', 'https://covers.openlibrary.org/b/id/10521270-L.jpg', '2025-11-08 11:00:28'),
(8, 'Sapiens', 'Yuval Noah Harari', 'Harper', 4, '9780062316097', 19.99, 10.00, '2025-12-15', 14, 'A brief history of humankind exploring how we came to dominate the world.', 'https://covers.openlibrary.org/b/id/8739161-L.jpg', '2025-11-08 11:00:28'),
(9, 'Thinking Fast and Slow', 'Daniel Kahneman', 'Farrar Straus Giroux', 2, '9780374533557', 20.50, 0.00, NULL, 16, 'Explores the two systems that drive the way we think and make decisions.', 'https://covers.openlibrary.org/b/id/7895296-L.jpg', '2025-11-08 11:00:28'),
(10, 'The Hobbit', 'J.R.R. Tolkien', 'George Allen & Unwin', 1, '9780547928227', 13.75, 0.00, NULL, 20, 'A timeless fantasy adventure about Bilbo Baggins journey to the Lonely Mountain.', 'https://covers.openlibrary.org/b/id/8490814-L.jpg', '2025-11-08 11:00:28'),
(11, 'The 7 Habits of Highly Effective People', 'Stephen Covey', 'Simon & Schuster', 2, '9781982137274', 16.99, 20.00, '2025-11-30', 28, 'A principle-centered approach for solving personal and professional problems.', 'https://covers.openlibrary.org/b/id/8739694-L.jpg', '2025-11-08 11:00:43'),
(12, 'Rich Dad Poor Dad', 'Robert Kiyosaki', 'Plata Publishing', 3, '9781612680194', 14.50, 10.00, '2025-12-15', 24, 'What the rich teach their kids about money that the poor and middle class do not.', 'https://covers.openlibrary.org/b/id/8696823-L.jpg', '2025-11-08 11:00:43'),
(13, 'Pride and Prejudice', 'Jane Austen', 'T. Egerton', 1, '9780141439518', 10.99, 0.00, NULL, 17, 'A romantic novel of manners exploring the themes of love and social standing.', 'https://covers.openlibrary.org/b/id/8300032-L.jpg', '2025-11-08 11:00:43'),
(14, 'The Alchemist', 'Paulo Coelho', 'HarperOne', 1, '9780062315007', 12.50, 0.00, NULL, 19, 'A philosophical book about following your dreams and personal legend.', 'https://covers.openlibrary.org/b/id/8235774-L.jpg', '2025-11-08 11:00:43'),
(15, 'The Power of Now', 'Eckhart Tolle', 'New World Library', 2, '9781577314806', 15.25, 20.00, '2025-11-30', 21, 'A guide to spiritual enlightenment and living in the present moment.', 'https://covers.openlibrary.org/b/id/8694698-L.jpg', '2025-11-08 11:00:43'),
(16, 'Good to Great', 'Jim Collins', 'Harper Business', 3, '9780066620992', 18.99, 0.00, NULL, 9, 'Why some companies make the leap and others do not.', 'https://covers.openlibrary.org/b/id/8404384-L.jpg', '2025-11-08 11:01:00'),
(17, 'The Martian', 'Andy Weir', 'Crown Publishing', 4, '9780553418026', 16.50, 0.00, NULL, 13, 'A gripping tale of survival on Mars with science and humor.', 'https://covers.openlibrary.org/b/id/8235014-L.jpg', '2025-11-08 11:01:00'),
(18, 'Charlotte Web', 'E.B. White', 'Harper & Brothers', 5, '9780064400558', 9.99, 10.00, '2025-12-15', 20, 'A classic tale of friendship between a pig and a spider.', 'https://covers.openlibrary.org/b/id/8434432-L.jpg', '2025-11-08 11:01:00'),
(19, 'Educated', 'Tara Westover', 'Random House', 2, '9780399590504', 17.00, 0.00, NULL, 16, 'A memoir about the transformative power of education.', 'https://covers.openlibrary.org/b/id/8529610-L.jpg', '2025-11-08 11:01:00'),
(20, 'Becoming', 'Michelle Obama', 'Crown Publishing', 2, '9781524763138', 21.99, 0.00, NULL, 23, 'An intimate memoir by the former First Lady of the United States.', 'https://covers.openlibrary.org/b/id/8690963-L.jpg', '2025-11-08 11:01:00');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT 1,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `user_id`, `book_id`, `quantity`, `added_on`) VALUES
(14, 3, 12, 1, '2025-11-08 07:25:13'),
(16, 3, 16, 1, '2025-11-08 07:30:40');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `description`, `created_at`) VALUES
(1, 'Fiction', 'Novels and stories based on imagination and creativity.', '2025-11-07 05:56:34'),
(2, 'Self-Help', 'Books focused on personal growth and productivity.', '2025-11-07 05:56:34'),
(3, 'Finance', 'Books related to money, investing, and financial management.', '2025-11-07 05:56:34'),
(4, 'Science & Technology', 'Books about scientific discoveries and innovations.', '2025-11-07 05:56:34'),
(5, 'Children', 'Books suitable for kids and young readers.', '2025-11-07 05:56:34');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `order_status` enum('Pending','Confirmed','Shipped','Delivered','Cancelled') DEFAULT 'Pending',
  `payment_method` enum('COD','Card','Online') DEFAULT 'COD',
  `order_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `book_id`, `total_amount`, `order_status`, `payment_method`, `order_date`) VALUES
(5, 4, 18, 9.99, 'Pending', 'COD', '2025-11-08 11:56:12'),
(6, 4, 18, 39.96, 'Pending', 'COD', '2025-11-08 12:02:09'),
(7, 4, 16, 18.99, 'Pending', 'COD', '2025-11-08 12:03:30'),
(8, 4, 16, 18.99, 'Pending', 'COD', '2025-11-08 12:35:54'),
(9, 5, 17, 16.50, 'Pending', 'COD', '2025-11-11 08:25:07'),
(10, 2, 4, 16.00, 'Pending', 'COD', '2025-11-12 04:34:06'),
(11, 2, 16, 18.99, 'Pending', 'COD', '2025-11-12 04:40:38'),
(12, 2, 17, 16.50, 'Pending', 'COD', '2025-11-12 04:40:38'),
(13, 2, 4, 16.00, 'Pending', 'COD', '2025-11-12 14:45:23'),
(14, 6, 16, 18.99, 'Pending', 'COD', '2025-11-12 14:51:59');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `payment_method` enum('COD','Card') DEFAULT 'COD',
  `card_number` varchar(20) DEFAULT NULL,
  `card_holder` varchar(100) DEFAULT NULL,
  `expiry_date` varchar(10) DEFAULT NULL,
  `cvv` varchar(10) DEFAULT NULL,
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `user_id`, `payment_method`, `card_number`, `card_holder`, `expiry_date`, `cvv`, `payment_date`) VALUES
(1, 1, 'Card', '11', 'ee', '09/22', '123', '2025-11-08 07:40:24'),
(2, 4, 'COD', '', '', '', '', '2025-11-08 12:38:03'),
(3, 2, 'COD', '', '', '', '', '2025-11-12 14:56:19');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `rating` int(11) DEFAULT NULL CHECK (`rating` between 1 and 5),
  `comment` text DEFAULT NULL,
  `review_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_id`, `user_id`, `book_id`, `rating`, `comment`, `review_date`) VALUES
(5, 3, 4, 3, 'good', '2025-11-12 04:29:39'),
(6, 2, 4, 5, 'very nice', '2025-11-12 04:33:50'),
(7, 2, 17, 4, 'very good experience', '2025-11-12 14:46:08'),
(8, 6, 16, 5, 'nice experience', '2025-11-12 14:52:34');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `full_name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `full_name`, `email`, `password`, `phone`, `address`, `created_at`) VALUES
(1, 'User1', 'hello@gmail.com', '$2y$10$kC6/TxN3CBt5a8I.GpEG0uuvtu4mNxR.laNgC6Y0r5BmMm.PaW13a', '1234567890', 'eeeeeeeexx2323', '2025-11-07 05:36:41'),
(2, 'demo', 'demo@student.com', '$2y$10$JnSbpZinBjiVq5SQoEv4dOTaCw6iATH5bbI5Wtw6apN/ftwXw6qkS', '0123456789', 'my street', '2025-11-08 09:01:20'),
(3, 'admin', 'admin@example.com', '$2y$10$L3mz7OUPIh5W.zxRHDL/jesFarVbs/FjiEOh4/NniEQeFIUJMyZDm', '1234567890', 'hek123', '2025-11-08 09:05:25'),
(4, 'demo', 'demo12@student.com', '$2y$10$MvPwbFfaBLDN823h5a/WKeN6Z/ZfgAPSjYzP/O2YvCsVsmFYAkjnC', '0123456789', 'my street 12', '2025-11-08 10:28:27'),
(5, 'fathima shahfa', 'fathimashahfa@gmail.om', '$2y$10$J2/n3Xc0JBqsq2ezt/ka/em1E1BXWNHn71wB0Zm94F3FPGUDz9fZe', '0740894774', '6D,ceylon house lane sainthmaruthu-09', '2025-11-11 08:24:12'),
(6, 'Reezma', 'reezmahanan@gmail.com', '$2y$10$WyHpf4Lu8YdjZZEqKi7UEOaTg4/5h3Bp7Kj8UeD.CR.xAGQv6TY66', '0123456789', 'no 32 street', '2025-11-12 14:50:59');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `wishlist_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`wishlist_id`, `user_id`, `book_id`, `added_at`) VALUES
(4, 3, 12, '2025-11-12 04:32:26'),
(5, 3, 10, '2025-11-12 04:32:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`),
  ADD UNIQUE KEY `isbn` (`isbn`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_name` (`category_name`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`wishlist_id`),
  ADD UNIQUE KEY `unique_user_book` (`user_id`,`book_id`),
  ADD KEY `book_id` (`book_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `wishlist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE SET NULL;

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`) ON DELETE CASCADE;

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
