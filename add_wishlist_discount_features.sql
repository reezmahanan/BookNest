-- Add discount features to books table
ALTER TABLE books 
ADD COLUMN discount_percentage DECIMAL(5,2) DEFAULT 0.00 AFTER price,
ADD COLUMN discount_end_date DATE NULL AFTER discount_percentage;

-- Create wishlist table
CREATE TABLE IF NOT EXISTS wishlist (
    wishlist_id INT(11) AUTO_INCREMENT PRIMARY KEY,
    user_id INT(11) NOT NULL,
    book_id INT(11) NOT NULL,
    added_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (book_id) REFERENCES books(book_id) ON DELETE CASCADE,
    UNIQUE KEY unique_user_book (user_id, book_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Optional: Add some sample discounts to existing books
UPDATE books SET discount_percentage = 15.00, discount_end_date = '2025-12-31' WHERE book_id IN (1, 3, 6);
UPDATE books SET discount_percentage = 20.00, discount_end_date = '2025-11-30' WHERE book_id IN (11, 15);
UPDATE books SET discount_percentage = 10.00, discount_end_date = '2025-12-15' WHERE book_id IN (8, 12, 18);
