CREATE DATABASE IF NOT EXISTS employee_management;
USE employee_management;

CREATE TABLE employees (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(120) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    position VARCHAR(80) NOT NULL,
    salary INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO employees(full_name, phone, position, salary) VALUES
('Nguyen Van A', '0909000111', 'Cashier', 7000000),
('Tran Thi B', '0909000222', 'Sales', 8000000);