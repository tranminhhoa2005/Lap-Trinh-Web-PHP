-- Tạo database mới tên chuẩn ql_thu_vien
CREATE DATABASE ql_thu_vien CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE ql_thu_vien;

-- Tạo bảng Categories (Danh mục)
CREATE TABLE categories (
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE
) ENGINE=InnoDB;

-- Tạo bảng Publishers (Nhà xuất bản)
CREATE TABLE publishers (
    publisher_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE
) ENGINE=InnoDB;

-- Tạo bảng Books (Sách)
CREATE TABLE books (
    book_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    category_id INT NOT NULL,
    publisher_id INT NOT NULL,
    price DECIMAL(10, 2) CHECK (price > 0),
    published_year INT,
    stock INT CHECK (stock >= 0),
    FOREIGN KEY (category_id) REFERENCES categories(category_id),
    FOREIGN KEY (publisher_id) REFERENCES publishers(publisher_id)
) ENGINE=InnoDB;

-- Tạo bảng Members (Thành viên)
CREATE TABLE members (
    member_id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    phone VARCHAR(15) NOT NULL UNIQUE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Tạo bảng Loans (Phiếu mượn)
CREATE TABLE loans (
    loan_id INT AUTO_INCREMENT PRIMARY KEY,
    member_id INT NOT NULL,
    loan_date DATE NOT NULL,
    due_date DATE NOT NULL,
    status ENUM('BORROWED', 'RETURNED', 'OVERDUE') DEFAULT 'BORROWED',
    FOREIGN KEY (member_id) REFERENCES members(member_id) ON DELETE RESTRICT
) ENGINE=InnoDB;

-- Tạo bảng Loan Items (Chi tiết mượn)
CREATE TABLE loan_items (
    loan_id INT,
    book_id INT,
    qty INT NOT NULL CHECK (qty > 0),
    PRIMARY KEY (loan_id, book_id),
    FOREIGN KEY (loan_id) REFERENCES loans(loan_id) ON DELETE CASCADE,
    FOREIGN KEY (book_id) REFERENCES books(book_id)
) ENGINE=InnoDB;

-- Categories
INSERT INTO categories (name) VALUES 
('Công nghệ thông tin'), ('Kinh tế'), ('Văn học'), ('Ngoại ngữ'), ('Khoa học đời sống');

-- Publishers
INSERT INTO publishers (name) VALUES 
('NXB Trẻ'), ('NXB Kim Đồng'), ('NXB Giáo Dục');

-- Books
INSERT INTO books (title, category_id, publisher_id, price, published_year, stock) VALUES
('Lập trình PHP', 1, 3, 150000, 2023, 10),
('Cấu trúc dữ liệu', 1, 3, 120000, 2022, 5),
('MySQL Nâng cao', 1, 1, 180000, 2024, 8),
('Kinh tế vi mô', 2, 2, 90000, 2021, 20),
('Marketing căn bản', 2, 1, 110000, 2020, 15),
('Dế mèn phiêu lưu ký', 3, 2, 50000, 2019, 30),
('Harry Potter 1', 3, 1, 250000, 2021, 12),
('Tiếng Anh giao tiếp', 4, 3, 80000, 2022, 50),
('TOEIC Practice', 4, 1, 150000, 2023, 25),
('Sinh học đại cương', 5, 3, 120000, 2020, 10),
('Mạng máy tính', 1, 3, 130000, 2022, 7),
('Quản trị dự án', 2, 1, 160000, 2023, 6),
('Sherlock Holmes', 3, 2, 140000, 2018, 18),
('IELTS Writing', 4, 2, 110000, 2024, 22),
('Sách chưa ai mượn', 1, 1, 200000, 2024, 5); 

-- Members
INSERT INTO members (full_name, phone) VALUES
('Nguyễn Văn A', '0901234567'),
('Trần Thị B', '0912345678'),
('Lê Văn C', '0987654321'),
('Phạm Thị D', '0977888999'),
('Hoàng Văn E', '0909090909'),
('Đỗ Thị F', '0911223344'),
('Bùi Văn G', '0922334455'),
('Vũ Thị H', '0933445566');

-- Loans
INSERT INTO loans (member_id, loan_date, due_date, status) VALUES
(1, '2025-12-01', '2025-12-10', 'RETURNED'),
(1, CURDATE(), DATE_ADD(CURDATE(), INTERVAL 7 DAY), 'BORROWED'),
(2, '2025-10-01', '2025-10-15', 'OVERDUE'),
(3, CURDATE(), DATE_ADD(CURDATE(), INTERVAL 7 DAY), 'BORROWED'),
(4, '2026-01-01', '2026-01-08', 'RETURNED'),
(1, DATE_SUB(CURDATE(), INTERVAL 5 DAY), DATE_ADD(CURDATE(), INTERVAL 2 DAY), 'BORROWED'), 
(5, '2026-01-10', '2026-01-17', 'BORROWED'),
(6, '2025-11-20', '2025-11-27', 'RETURNED'),
(2, DATE_SUB(CURDATE(), INTERVAL 20 DAY), DATE_SUB(CURDATE(), INTERVAL 10 DAY), 'OVERDUE'),
(7, CURDATE(), DATE_ADD(CURDATE(), INTERVAL 14 DAY), 'BORROWED'),
(8, '2026-01-05', '2026-01-12', 'RETURNED'),
(1, DATE_SUB(CURDATE(), INTERVAL 2 DAY), DATE_ADD(CURDATE(), INTERVAL 5 DAY), 'BORROWED');

-- Loan Items
INSERT INTO loan_items (loan_id, book_id, qty) VALUES
(1, 1, 1), (1, 2, 2),
(2, 3, 1),
(3, 4, 3), (3, 5, 1),
(4, 6, 1), (4, 7, 2),
(5, 8, 1),
(6, 9, 2), (6, 10, 1),
(7, 11, 1), (7, 12, 1), (7, 1, 2),
(8, 13, 1),
(9, 14, 2), (9, 2, 1),
(10, 3, 1),
(11, 4, 1), (11, 5, 1),
(12, 6, 2), (12, 1, 1),
(2, 6, 1),
(3, 7, 1),
(5, 11, 1);