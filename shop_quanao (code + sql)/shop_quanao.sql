-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th1 28, 2026 lúc 04:36 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `shop_quanao`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `fullname` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(20) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `status` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `fullname`, `address`, `phone`, `total_price`, `status`, `created_at`) VALUES
(1, 2, 'Hòa Trần', 'Trịnh Văn Bô\r\nNam Từ Liêm', '0947036422', 380000.00, 2, '2026-01-25 10:15:15'),
(2, 3, 'thúy thanh', 'Trịnh Văn Bô\r\nNam Từ Liêm', '012345678', 680000.00, 2, '2026-01-26 00:47:49');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `tag` varchar(50) DEFAULT NULL,
  `stock_quantity` int(11) DEFAULT 10,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image`, `description`, `tag`, `stock_quantity`, `created_at`) VALUES
(1, 'Áo Thun Nam Basic', 150000.00, 't shirt.jpg', 'Chất liệu cotton co giãn 4 chiều, thấm hút mồ hôi tốt.', 'Hot', 20, '2026-01-24 14:01:58'),
(2, 'Quần Jean Denim Xanh', 350000.00, 'quan jean.jpg', 'Dáng Slim-fit trẻ trung, bền màu.', 'New', 15, '2026-01-24 14:01:58'),
(3, 'Áo Sơ Mi Trắng Công Sở', 280000.00, 'shopping (1).webp', 'Chống nhăn, form chuẩn dành cho nam giới.', 'Sale', 10, '2026-01-24 14:01:58'),
(4, 'Áo Hoodie Đen Hoodie', 450000.00, 'shopping.webp', 'Vải nỉ bông dày dặn, thích hợp mùa đông.', 'Hot', 5, '2026-01-24 14:01:58'),
(5, 'Váy Hoa Nhí Vintage', 320000.00, 'vay vingate.webp', 'Váy hoa nhí phong cách Hàn Quốc, chất liệu voan mềm mại.', 'Hot', 15, '2026-01-24 17:38:03'),
(6, 'Áo Khoác Nỉ Tai Gấu', 290000.00, 'áo tai gau.webp', 'Áo hoodie nỉ ngoại dày dặn, có tai gấu đáng yêu trên mũ.', 'New', 10, '2026-01-24 17:38:03'),
(7, 'Chân Váy Tennis Trắng', 180000.00, 'vay.avif', 'Chân váy xếp ly basic, dễ phối đồ, có quần bảo hộ bên trong.', 'Sale', 25, '2026-01-24 17:38:03'),
(8, 'Áo Cardigan Len Mỏng', 210000.00, 'ao cardigan.jpg', 'Áo khoác len dệt kim màu hồng pastel, phù hợp tiết trời thu.', 'New', 12, '2026-01-24 17:38:03'),
(9, 'Quần Baggy Jean Sáng Màu', 350000.00, 'quan baggy.webp', 'Quần jean form rộng thoải mải, màu xanh nhạt trẻ trung.', 'Hot', 20, '2026-01-24 17:38:03'),
(10, 'Áo Thun Baby Tee Cute', 120000.00, 'babytee.webp', 'Áo thun ôm form nhỏ, in hình thú cute.', 'Sale', 30, '2026-01-24 17:38:03'),
(11, 'Váy Suông Công Chúa', 450000.00, 'unnamed.jpg', 'Váy xòe bồng bềnh cho những buổi tiệc nhẹ nhàng.', 'Hot', 8, '2026-01-24 17:38:03'),
(12, 'Áo Sơ Mi Croptop Cổ Sen', 230000.00, 'ao croptop.jpg', 'Áo sơ mi dáng ngắn, cổ sen phối ren điệu đà.', 'New', 15, '2026-01-24 17:38:03'),
(13, 'Set Bộ Đồ Ngủ Pijama', 190000.00, 'pijama.jpg', 'Bộ đồ ngủ lụa satin in hình dâu tây cực xinh.', 'Sale', 18, '2026-01-24 17:38:03'),
(14, 'Yếm Jean Gấu Dâu', 380000.00, 'yem jean.jpg', 'Yếm jean năng động phối túi thêu hình gấu dâu.', 'Hot', 10, '2026-01-24 17:38:03');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `subscribers`
--

CREATE TABLE `subscribers` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `subscribers`
--

INSERT INTO `subscribers` (`id`, `email`, `created_at`) VALUES
(1, 'tranhoa2005ls@gmail.com', '2026-01-26 01:15:59');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `role` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `role`, `created_at`) VALUES
(1, 'vandung', '$2y$10$0mmKmH3T4pcrAA7OxdM0le/v4pl6Jl1oGRstX2epreOgxOl5ivWKu', 'dung@gmail.com', 0, '2026-01-26 01:00:24'),
(2, 'hoadeptrai', '$2y$10$sGmLtpWsWsZkPxvL2UHyx.CkzU8b5PxQtKG6a6WmL1Qk7r.M/Q6se', 'tranhoa2005ls@gmail.com', 1, '2026-01-24 17:10:04'),
(3, 'thuytieuthu', '$2y$10$Fi8wEOAgfYwCC0FZspOQ9OVBYM8pPwFp19tASpJ7e1ivBgmVJJcxS', 'vuthithanhthuy@gmail.com', 0, '2026-01-26 00:47:06'),
(4, 'admin', '$2y$10$0mmKmH3T4pcrAA7OxdM0le/v4pl6Jl1oGRstX2epreOgxOl5ivWKu', 'tranhoa2005ls@gmail.com', 1, '2026-01-26 00:57:16');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
