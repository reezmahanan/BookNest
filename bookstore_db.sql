-- MySQL dump 10.13  Distrib 8.0.40, for Win64 (x86_64)
--
-- Host: localhost    Database: bookstore_db
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `bookstore_db`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `bookstore_db` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `bookstore_db`;

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('manager','staff','superadmin') DEFAULT 'superadmin',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`admin_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES (1,'Super Admin','admin@example.com','$2y$10$kC6/TxN3CBt5a8I.GpEG0uuvtu4mNxR.laNgC6Y0r5BmMm.PaW13a','superadmin','2025-11-08 07:54:18'),(2,'New one','hello@gmail.com','$2y$10$H01505gGVTDte9UrO4o0JuPCRZEHJ/cIsIlztNxIzwf5gxlBXe4He','manager','2025-11-08 08:19:47'),(3,'jhon','adminjhon@example.com','$2y$10$aL1uzpjUItS1XhnDZxgLMOExyYdTwrsSetF6o.2VwPPVZ4Vs3n28e','manager','2025-11-12 04:30:40');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `books` (
  `book_id` int(11) NOT NULL AUTO_INCREMENT,
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
  `added_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`book_id`),
  UNIQUE KEY `isbn` (`isbn`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `books_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `books`
--

LOCK TABLES `books` WRITE;
/*!40000 ALTER TABLE `books` DISABLE KEYS */;
INSERT INTO `books` VALUES (1,'The Great Gatsby','F. Scott Fitzgerald','Scribner',1,'9780743273565',12.99,15.00,'2025-12-31',15,'A classic novel set in the Jazz Age exploring themes of wealth, love, and the American Dream.','https://covers.openlibrary.org/b/id/7222246-L.jpg','2025-11-08 11:00:12'),(2,'Atomic Habits','James Clear','Penguin Random House',2,'9780735211292',18.50,0.00,NULL,25,'A guide to building good habits and breaking bad ones using practical strategies.','https://covers.openlibrary.org/b/id/8664109-L.jpg','2025-11-08 11:00:12'),(3,'To Kill a Mockingbird','Harper Lee','J.B. Lippincott & Co.',1,'9780060935467',14.25,15.00,'2025-12-31',12,'A moving story about racial injustice and moral growth in the Deep South.','https://covers.openlibrary.org/b/id/8228691-L.jpg','2025-11-08 11:00:12'),(4,'The Psychology of Money','Morgan Housel','Harriman House',3,'9780857197689',16.00,0.00,NULL,19,'Doing well with money isn\'t necessarily about what you know. It\'s about how you behave. And behavior is hard to teach, even to really smart people.','https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1581527774i/41881472.jpg','2025-11-08 11:00:12'),(5,'1984','George Orwell','Secker & Warburg',1,'9780451524935',11.99,0.00,NULL,18,'A dystopian novel about totalitarianism, surveillance, and loss of individuality.','https://covers.openlibrary.org/b/id/7222246-L.jpg','2025-11-08 11:00:12'),(6,'Deep Work','Cal Newport','Grand Central Publishing',2,'9781455586691',17.75,15.00,'2025-12-31',22,'A must-read on focused success in a distracted world.','https://covers.openlibrary.org/b/id/8240743-L.jpg','2025-11-08 11:00:28'),(7,'Harry Potter and the Sorcerer Stone','J.K. Rowling','Scholastic',5,'9780439708180',15.99,0.00,NULL,30,'The magical adventure of a young wizard discovering his destiny.','https://covers.openlibrary.org/b/id/10521270-L.jpg','2025-11-08 11:00:28'),(8,'Sapiens','Yuval Noah Harari','Harper',4,'9780062316097',19.99,10.00,'2025-12-15',14,'A brief history of humankind exploring how we came to dominate the world.','https://covers.openlibrary.org/b/id/8739161-L.jpg','2025-11-08 11:00:28'),(9,'Thinking Fast and Slow','Daniel Kahneman','Farrar Straus Giroux',2,'9780374533557',20.50,0.00,NULL,16,'Explores the two systems that drive the way we think and make decisions.','https://covers.openlibrary.org/b/id/7895296-L.jpg','2025-11-08 11:00:28'),(10,'The Hobbit','J.R.R. Tolkien','George Allen & Unwin',1,'9780547928227',13.75,0.00,NULL,20,'A timeless fantasy adventure about Bilbo Baggins journey to the Lonely Mountain.','https://covers.openlibrary.org/b/id/8490814-L.jpg','2025-11-08 11:00:28'),(11,'The 7 Habits of Highly Effective People','Stephen Covey','Simon & Schuster',2,'9781982137274',16.99,20.00,'2025-11-30',28,'A principle-centered approach for solving personal and professional problems.','https://covers.openlibrary.org/b/id/8739694-L.jpg','2025-11-08 11:00:43'),(12,'Rich Dad Poor Dad','Robert Kiyosaki','Plata Publishing',3,'9781612680194',14.50,10.00,'2025-12-15',24,'What the rich teach their kids about money that the poor and middle class do not.','https://covers.openlibrary.org/b/id/8696823-L.jpg','2025-11-08 11:00:43'),(13,'Pride and Prejudice','Jane Austen','T. Egerton',1,'9780141439518',10.99,0.00,NULL,17,'A romantic novel of manners exploring the themes of love and social standing.','https://covers.openlibrary.org/b/id/8300032-L.jpg','2025-11-08 11:00:43'),(14,'The Alchemist','Paulo Coelho','HarperOne',1,'9780062315007',12.50,0.00,NULL,19,'A philosophical book about following your dreams and personal legend.','https://covers.openlibrary.org/b/id/8235774-L.jpg','2025-11-08 11:00:43'),(15,'The Power of Now','Eckhart Tolle','New World Library',2,'9781577314806',15.25,20.00,'2025-11-30',21,'A guide to spiritual enlightenment and living in the present moment.','https://covers.openlibrary.org/b/id/8694698-L.jpg','2025-11-08 11:00:43'),(16,'Good to Great','Jim Collins','Harper Business',3,'9780066620992',18.99,0.00,NULL,10,'Why some companies make the leap and others do not.','https://covers.openlibrary.org/b/id/8404384-L.jpg','2025-11-08 11:01:00'),(17,'The Martian','Andy Weir','Crown Publishing',4,'9780553418026',16.50,0.00,NULL,13,'A gripping tale of survival on Mars with science and humor.','https://covers.openlibrary.org/b/id/8235014-L.jpg','2025-11-08 11:01:00'),(18,'Charlotte Web','E.B. White','Harper & Brothers',5,'9780064400558',9.99,10.00,'2025-12-15',20,'A classic tale of friendship between a pig and a spider.','https://covers.openlibrary.org/b/id/8434432-L.jpg','2025-11-08 11:01:00'),(19,'Educated','Tara Westover','Random House',2,'9780399590504',17.00,0.00,NULL,16,'A memoir about the transformative power of education.','https://covers.openlibrary.org/b/id/8529610-L.jpg','2025-11-08 11:01:00'),(20,'Becoming','Michelle Obama','Crown Publishing',2,'9781524763138',21.99,0.00,NULL,23,'An intimate memoir by the former First Lady of the United States.','https://covers.openlibrary.org/b/id/8690963-L.jpg','2025-11-08 11:01:00');
/*!40000 ALTER TABLE `books` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT 1,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`cart_id`),
  KEY `user_id` (`user_id`),
  KEY `book_id` (`book_id`),
  CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart`
--

LOCK TABLES `cart` WRITE;
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
INSERT INTO `cart` VALUES (14,3,12,1,'2025-11-08 07:25:13'),(16,3,16,1,'2025-11-08 07:30:40'),(25,2,17,1,'2025-11-12 00:11:05');
/*!40000 ALTER TABLE `cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`category_id`),
  UNIQUE KEY `category_name` (`category_name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Fiction','Novels and stories based on imagination and creativity.','2025-11-07 05:56:34'),(2,'Self-Help','Books focused on personal growth and productivity.','2025-11-07 05:56:34'),(3,'Finance','Books related to money, investing, and financial management.','2025-11-07 05:56:34'),(4,'Science & Technology','Books about scientific discoveries and innovations.','2025-11-07 05:56:34'),(5,'Children','Books suitable for kids and young readers.','2025-11-07 05:56:34');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `order_status` enum('Pending','Confirmed','Shipped','Delivered','Cancelled') DEFAULT 'Pending',
  `payment_method` enum('COD','Card','Online') DEFAULT 'COD',
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`order_id`),
  KEY `user_id` (`user_id`),
  KEY `book_id` (`book_id`),
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (5,4,18,9.99,'Pending','COD','2025-11-08 11:56:12'),(6,4,18,39.96,'Pending','COD','2025-11-08 12:02:09'),(7,4,16,18.99,'Pending','COD','2025-11-08 12:03:30'),(8,4,16,18.99,'Pending','COD','2025-11-08 12:35:54'),(9,5,17,16.50,'Pending','COD','2025-11-11 08:25:07'),(10,2,4,16.00,'Pending','COD','2025-11-12 04:34:06'),(11,2,16,18.99,'Pending','COD','2025-11-12 04:40:38'),(12,2,17,16.50,'Pending','COD','2025-11-12 04:40:38');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `payment_method` enum('COD','Card') DEFAULT 'COD',
  `card_number` varchar(20) DEFAULT NULL,
  `card_holder` varchar(100) DEFAULT NULL,
  `expiry_date` varchar(10) DEFAULT NULL,
  `cvv` varchar(10) DEFAULT NULL,
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`payment_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
INSERT INTO `payments` VALUES (1,1,'Card','11','ee','09/22','123','2025-11-08 07:40:24'),(2,4,'COD','','','','','2025-11-08 12:38:03');
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `rating` int(11) DEFAULT NULL CHECK (`rating` between 1 and 5),
  `comment` text DEFAULT NULL,
  `review_date` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`review_id`),
  KEY `user_id` (`user_id`),
  KEY `book_id` (`book_id`),
  CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reviews`
--

LOCK TABLES `reviews` WRITE;
/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;
INSERT INTO `reviews` VALUES (5,3,4,3,'good','2025-11-12 04:29:39'),(6,2,4,5,'very nice','2025-11-12 04:33:50');
/*!40000 ALTER TABLE `reviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'User1','hello@gmail.com','$2y$10$kC6/TxN3CBt5a8I.GpEG0uuvtu4mNxR.laNgC6Y0r5BmMm.PaW13a','1234567890','eeeeeeeexx2323','2025-11-07 05:36:41'),(2,'demo','demo@student.com','$2y$10$JnSbpZinBjiVq5SQoEv4dOTaCw6iATH5bbI5Wtw6apN/ftwXw6qkS','0123456789','my street','2025-11-08 09:01:20'),(3,'admin','admin@example.com','$2y$10$L3mz7OUPIh5W.zxRHDL/jesFarVbs/FjiEOh4/NniEQeFIUJMyZDm','1234567890','hek123','2025-11-08 09:05:25'),(4,'demo','demo12@student.com','$2y$10$MvPwbFfaBLDN823h5a/WKeN6Z/ZfgAPSjYzP/O2YvCsVsmFYAkjnC','0123456789','my street 12','2025-11-08 10:28:27'),(5,'fathima shahfa','fathimashahfa@gmail.om','$2y$10$J2/n3Xc0JBqsq2ezt/ka/em1E1BXWNHn71wB0Zm94F3FPGUDz9fZe','0740894774','6D,ceylon house lane sainthmaruthu-09','2025-11-11 08:24:12');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wishlist`
--

DROP TABLE IF EXISTS `wishlist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wishlist` (
  `wishlist_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`wishlist_id`),
  UNIQUE KEY `unique_user_book` (`user_id`,`book_id`),
  KEY `book_id` (`book_id`),
  CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wishlist`
--

LOCK TABLES `wishlist` WRITE;
/*!40000 ALTER TABLE `wishlist` DISABLE KEYS */;
INSERT INTO `wishlist` VALUES (4,3,12,'2025-11-12 04:32:26'),(5,3,10,'2025-11-12 04:32:33'),(6,2,17,'2025-11-12 04:33:04'),(7,2,6,'2025-11-12 04:33:10');
/*!40000 ALTER TABLE `wishlist` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-11-12 19:59:54
