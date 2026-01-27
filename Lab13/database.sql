CREATE DATABASE IF NOT EXISTS inventory_db;
USE inventory_db;

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    code VARCHAR(50) NOT NULL UNIQUE,
    name VARCHAR(255) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Chèn ít nhất 10 bản ghi mẫu
INSERT INTO products (code, name, price) VALUES
('P001', 'iPhone 15 Pro', 25000000),
('P002', 'Samsung S24 Ultra', 23000000),
('P003', 'MacBook Air M2', 28000000),
('P004', 'Logitech MX Master 3S', 2500000),
('P005', 'Keychron K2 V2', 1800000),
('P006', 'Dell XPS 13', 35000000),
('P007', 'Sony WH-1000XM5', 8500000),
('P008', 'iPad Pro M4', 32000000),
('P009', 'Apple Watch Series 9', 10500000),
('P010', 'Asus ROG Zephyrus', 45000000);