CREATE DATABASE IF NOT EXISTS lab11_categories;
USE lab11_categories;

CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    slug VARCHAR(120) NOT NULL UNIQUE,
    description TEXT NULL,
    status TINYINT(1) DEFAULT 1,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Dữ liệu mẫu
INSERT INTO categories (name, slug, description, status) VALUES 
('Điện thoại', 'dien-thoai', 'Các loại smartphone', 1),
('Laptop', 'laptop', 'Máy tính xách tay', 1),
('Phụ kiện', 'phu-kien', 'Tai nghe, sạc, cáp', 1),
('Máy tính bảng', 'may-tinh-bang', 'Tablet các loại', 0),
('Đồng hồ', 'dong-ho', 'Smartwatch', 1);