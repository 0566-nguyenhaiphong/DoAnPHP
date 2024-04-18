-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 15, 2024 lúc 12:50 PM
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
-- Cơ sở dữ liệu: `demo`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(500) NOT NULL,
  `name` varchar(200) NOT NULL,
  `role` varchar(50) NOT NULL,
  `locked` int(10) NOT NULL,
  `phone` int(10) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `account`
--

INSERT INTO `account` (`id`, `email`, `password`, `name`, `role`, `locked`, `phone`, `address`) VALUES
(1, 'dinhanhvnn1@gmail.com', '$2y$12$ltKZThYayS0PvmGQomKM1ORnaCRlxYkuWV1kDLm9S5Vb6fE6qhM4i', 'anhnguyen', 'admin', 1, 0, ''),
(2, 'admin@gmail.com', '$2y$12$DGgXBqv7SwH8.VI/OeUjyeZ2v9gBZrKuxn.ch44a3gGaWZ3j.DvKa', 'Admin', 'admin', 0, 0, ''),
(3, 'user@gmail.com', '$2y$12$WLJ0tNMHijk7TNt6hIp/yev0Vow/QMGcahkvEWQ0uSKW3Hm31zCi2', 'User', 'user', 0, 0, ''),
(4, 'phongp1192002@gmail.com', '$2y$12$Y90pjR27xcU2C9Z02Zq14.y0kYQUizd6ZlKIxk0T4bSYTUSHxHGXe', 'Nguyễn Hải Phong', 'user', 0, 395313759, 'Dương Quảng Hàm');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'women\'s'),
(2, 'accessories\'s'),
(3, 'men\'s');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders_table`
--

CREATE TABLE `orders_table` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `status` int(30) NOT NULL,
  `note` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orders_table`
--

INSERT INTO `orders_table` (`id`, `customer_name`, `phone`, `status`, `note`, `email`, `address`, `payment_method`, `total_amount`, `created_at`) VALUES
(2, 'Nguyễn Hải Phong', '0395313750', 3, 'Đơn hàng ổn định', 'phongp1192002@gmail.com', 'Dương Quảng Hàm', 'cod', 1887.00, '2024-04-06 09:00:38'),
(3, 'Nguyễn Hải Phong', '0395313750', 2, 'Đơn hàng ổn định', 'phongp1192002@gmail.com', 'Dương Quảng Hàm', 'cod', 7992.00, '2024-04-06 09:06:26'),
(4, 'Ngọc Long Nguyễn', '0354123684', 3, 'Đơn hàng ổn định', 'higansama42@gmail.com', 'qưeasc', 'cod', 4995.00, '2024-04-14 07:14:32'),
(5, 'Nguyen Hai Phong', '0354123684', 1, 'Đơn hàng ổn định', 'higansama42@gmail.com', 'qưeasc', 'cod', 3996.00, '2024-04-14 07:15:20'),
(6, 'Nguyễn Hải Phong', '0395313750', 1, 'Đơn hàng ổn định', 'phongp1192002@gmail.com', 'Dương Quảng Hàm', 'cod', 3996.00, '2024-04-14 19:05:45'),
(7, 'Nguyễn Hải Phong', '0395313750', 1, 'Đơn hàng ổn định', 'phongp1192002@gmail.com', 'Dương Quảng Hàm', 'cod', 2997.00, '2024-04-14 19:08:14'),
(8, 'Nguyễn Hải Phong', '0395313750', 1, 'Đơn hàng ổn định', 'phongp1192002@gmail.com', 'Dương Quảng Hàm', 'cod', 999.00, '2024-04-14 19:14:43'),
(9, 'Nguyễn Ngọc Long', '0395313750', 1, 'Đơn hàng ổn định', 'phongp1192002@gmail.com', 'Dương Quảng Hàm', 'cod', 1299.00, '2024-04-15 03:41:57');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `total` decimal(12,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `order_detail`
--

INSERT INTO `order_detail` (`id`, `order_id`, `product_id`, `user_id`, `quantity`, `price`, `total`) VALUES
(5, 2, 4, 1, 1, 999.00, 999),
(6, 2, 6, 1, 1, 888.00, 888),
(7, 3, 3, 2, 6, 999.00, 5994),
(8, 3, 5, 1, 2, 999.00, 1998),
(9, 4, 4, 1, 4, 999.00, 0),
(10, 4, 8, 2, 1, 999.00, 0),
(11, 5, 9, 3, 1, 999.00, 999),
(12, 5, 10, 3, 3, 999.00, 2997),
(16, 8, 10, 4, 1, 999.00, 999),
(17, 9, 3, 4, 1, 999.00, 0),
(18, 9, 4, 4, 1, 300.00, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` varchar(500) NOT NULL,
  `price` double NOT NULL,
  `image` varchar(300) DEFAULT NULL,
  `thumnail` varchar(300) DEFAULT NULL,
  `categoryId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `image`, `thumnail`, `categoryId`) VALUES
(3, 'Fujifilm X100T 16 MP Digital Camera (Silver)', 'Fujifilm X100T 16 MP Digital Camera (Silver)', 999, 'uploads/product_3.png', 'uploads/1iphone 16.jpg', 1),
(4, 'Samsung CF591 Series Curved 27-Inch FHD Monitor', 'BMW 528i GT sx 2014 Trắng/Kem, tư nhân sd lăn bánh hơn 7v miles rất đẹp. Cam kết xe không đâm đụng , không ngập nước , máy móc nguyên bản Có hỗ trợ thủ tục vay ngân hàng trả góp Có bao test xe check hãng', 300, 'uploads/product_1.png', 'uploads/1iphone 16.jpg', 2),
(5, 'Blue Yeti USB Microphone Blackout Edition', 'Mercedes_E300_AMG xanh cavansite nt nâu - Sản xuất 2019 - Odo: 49.000 km (Full lịch sử hãng) - Option: Loa Bumester, cửa sổ trời, rèm che nắng, LED nội thất, cốp điện, Auto Hold, phanh tay điện tử, lẫy chuyển số vô lăng, ga tự động Cruise Control, giới hạn tốc độ Lim,… - Bank 70% - trả trước từ 500tr', 888, 'uploads/product_8.png', 'uploads/1iphone 16.jpg', 3),
(6, 'DYMO LabelWriter 450 Turbo Thermal Label Printer', 'Những điểm nổi bật trên Honda CR-V mới: - Công nghệ hỗ trợ lái xe an toàn tiên tiến Honda SENSING - Camera quan sát làn đường - Sạc không dây tiện ích - Cốp điện với tính năng mở cốp rảnh tay - Camera lùi 3 góc quay - Gạt mưa tự động,', 777, 'uploads/product_10.png', 'uploads/1iphone 16.jpg', 2),
(7, 'Pryma Headphones, Rose Gold &amp; Grey', '111Xe BMW Premium 2.0 AT 2022', 111, 'uploads/product_5.png', 'uploads/1iphone 16.jpg', 1),
(8, 'Fujifilm X100T 16 MP Digital Camera (Silver)', 'Xe Mazda CX5 Premium 2.0 AT 2022', 444, 'uploads/product_6.png', 'uploads/1iphone 16.jpg', 3),
(9, 'Fujifilm X100T 16 MP Digital Camera (Silver)', 'Fujifilm X100T 16 MP Digital Camera (Silver)', 666, 'uploads/product_8.png', 'uploads/1iphone 16.jpg', 1),
(10, 'Fujifilm X100T 16 MP Digital Camera (Silver)', 'Xe Mazda CX5 Premium 2.0 AT 2022', 245, 'uploads/product_2.png', 'uploads/1iphone 16.jpg', 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `voucher`
--

CREATE TABLE `voucher` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `value` int(2) NOT NULL,
  `isSave` tinyint(1) NOT NULL,
  `isUse` tinyint(1) NOT NULL,
  `user_id` int(11) NOT NULL,
  `createDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `voucher`
--

INSERT INTO `voucher` (`id`, `name`, `description`, `value`, `isSave`, `isUse`, `user_id`, `createDate`) VALUES
(1, 'Mã giảm giá 10%', 'Mã giảm giá 10%', 10, 1, 1, 1, '2024-04-14 19:24:47'),
(2, 'Mã giảm giá 20%', 'Mã giảm giá 20%', 20, 1, 1, 1, '2024-04-14 19:26:16'),
(3, 'Mã giảm giá 30%', 'Mã giảm giá 30%', 30, 0, 0, 4, '0000-00-00 00:00:00'),
(4, 'Mã giảm giá 40%', 'Mã giảm giá 40%', 40, 0, 0, 4, '0000-00-00 00:00:00'),
(5, 'Mã giảm giá 50%', 'Mã giảm giá 50%', 53, 0, 0, 4, '0000-00-00 00:00:00');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders_table`
--
ALTER TABLE `orders_table`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_order_id` (`order_id`),
  ADD KEY `fk_product_id` (`product_id`),
  ADD KEY `fk_user_id_a` (`user_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_category_id` (`categoryId`);

--
-- Chỉ mục cho bảng `voucher`
--
ALTER TABLE `voucher`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_id` (`user_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `orders_table`
--
ALTER TABLE `orders_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `voucher`
--
ALTER TABLE `voucher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `fk_order_id` FOREIGN KEY (`order_id`) REFERENCES `orders_table` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_user_id_a` FOREIGN KEY (`user_id`) REFERENCES `account` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_category_id` FOREIGN KEY (`categoryId`) REFERENCES `category` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `voucher`
--
ALTER TABLE `voucher`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `account` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
