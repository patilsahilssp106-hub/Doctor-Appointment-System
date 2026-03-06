-- Drop the database if it already exists to avoid errors on re-run
DROP DATABASE IF EXISTS restaurant_db;

-- Create the Database
CREATE DATABASE restaurant_db;

USE restaurant_db;

-- 1. Users Table (Stores customer info)
CREATE TABLE users (
    user_id INT(11) NOT NULL AUTO_INCREMENT,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    phone VARCHAR(15),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (user_id)
);

-- 2. Admins Table (For backend access)
CREATE TABLE admins (
    admin_id INT(11) NOT NULL AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    PRIMARY KEY (admin_id)
);

-- 3. Tables Management (Stores info about restaurant tables)
CREATE TABLE restaurant_tables (
    table_id INT(11) NOT NULL AUTO_INCREMENT,
    table_no VARCHAR(20) NOT NULL,
    capacity INT(11) NOT NULL,
    status ENUM('available', 'maintenance') DEFAULT 'available',
    PRIMARY KEY (table_id)
);

-- 4. Bookings Table (The core feature)
CREATE TABLE bookings (
    booking_id INT(11) NOT NULL AUTO_INCREMENT,
    user_id INT(11) NOT NULL,
    table_id INT(11) DEFAULT NULL, -- Fixed: Must allow NULL for ON DELETE SET NULL to work
    booking_date DATE NOT NULL,
    booking_time TIME NOT NULL,
    num_guests INT(11) NOT NULL,
    status ENUM('pending', 'confirmed', 'cancelled', 'completed') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (booking_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (table_id) REFERENCES restaurant_tables(table_id) ON DELETE SET NULL
);

-- Insert a default Admin for testing
-- Username: admin, Password: password123 (hashed - purely for example, use PHP `password_hash` in production)
INSERT INTO admins (username, password) VALUES ('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

-- Insert some dummy tables
INSERT INTO restaurant_tables (table_no, capacity) VALUES 
('T1', 2),
('T2', 2),
('T3', 4),
('T4', 6),
('T5', 8);