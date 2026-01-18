CREATE DATABASE IF NOT EXISTS it3220_php CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE it3220_php;

CREATE TABLE IF NOT EXISTS students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    code VARCHAR(20) NOT NULL UNIQUE,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    dob DATE NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Dữ liệu mẫu (5 bản ghi)
INSERT INTO students (code, full_name, email, dob) VALUES 
('SV001', 'Nguyen Van A', 'a@example.com', '2000-01-01'),
('SV002', 'Tran Thi B', 'b@example.com', '2001-02-15'),
('SV003', 'Le Van C', 'c@example.com', '2000-05-20'),
('SV004', 'Pham Thi D', 'd@example.com', '2002-11-11'),
('SV005', 'Hoang Van E', 'e@example.com', '2001-09-30');