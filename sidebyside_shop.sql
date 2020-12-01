-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 30, 2020 lúc 02:12 AM
-- Phiên bản máy phục vụ: 10.4.13-MariaDB
-- Phiên bản PHP: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `sidebyside.shop`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` smallint(5) NOT NULL COMMENT 'id Danh mục',
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Tên Danh mục',
  `sort` tinyint(4) DEFAULT 0 COMMENT 'Sắp xếp',
  `lft` int(11) NOT NULL COMMENT 'left index',
  `rgt` int(11) NOT NULL COMMENT 'right index'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `sort`, `lft`, `rgt`) VALUES
(1, 'Thiết bị di động', 1, 1, 10),
(2, 'Điện tử - Điện lạnh', 0, 11, 18),
(3, 'Phụ kiện - Thiết bị số', 0, 19, 28),
(4, 'Laptop - Thiết bị IT', 0, 29, 30),
(5, 'Điện gia dụng', 0, 31, 40),
(6, 'Tiêu dùng - Thực phẩm', 0, 41, 42),
(7, 'Mẹ và bé', 0, 43, 44),
(8, 'Thời trang - Phụ kiện', 0, 45, 46),
(9, 'Phụ nữ - Làm đẹp', 0, 47, 48),
(10, 'Học tập', 0, 49, 50),
(11, 'Thể thao - Dã ngoại', 0, 51, 52),
(12, 'Y tế - Sức khoẻ', 0, 53, 54),
(13, 'Giao thông - Di chuyển', 0, 55, 56),
(14, 'Truyền thông - Giải trí', 0, 57, 58),
(15, 'Voucher - Dịch vụ', 0, 59, 60),
(18, 'Điện thoại', 9, 8, 9),
(19, 'Máy tính bảng', 5, 6, 7),
(20, 'Đồng hồ thông minh', 4, 4, 5),
(21, 'Máy ảnh', 2, 2, 3),
(22, 'Nghe, nhìn', 0, 16, 17),
(23, 'Nội trợ', 0, 14, 15),
(24, 'Gia dụng', 0, 12, 13),
(25, 'Âm thanh', 0, 26, 27),
(26, 'Máy ảnh, camera', 0, 24, 25),
(27, 'Phụ kiện tổng hợp', 0, 22, 23),
(29, 'Công việc, giải trí', 0, 20, 21),
(30, 'Nhà bếp', 0, 38, 39),
(31, 'Phòng khách', 0, 36, 37),
(32, 'Phòng ngủ', 0, 34, 35),
(33, 'Nhà tắm', 0, 32, 33);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category_hashtag`
--

CREATE TABLE `category_hashtag` (
  `id` int(11) NOT NULL COMMENT 'id Hastag sản phẩm',
  `name` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Tên phân nhánh danh mục',
  `id_category` smallint(5) NOT NULL COMMENT 'id Danh mục'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `category_hashtag`
--

INSERT INTO `category_hashtag` (`id`, `name`, `id_category`) VALUES
(1, 'Android', 18),
(2, 'iOS', 18),
(3, 'Phiên bản cũ', 18),
(4, 'iPad', 19),
(5, 'Android', 19),
(6, 'Window', 19),
(7, 'Thông dụng', 20),
(8, 'Trẻ em', 20),
(9, 'TV', 22),
(10, 'Loa nghe nhạc', 22),
(11, 'DVD, CD, Karaoke', 22),
(12, 'Quạt', 24),
(13, 'Máy sưởi', 24),
(14, 'Máy lạnh, điều hoà', 24),
(15, 'Máy lọc nước', 24),
(16, 'Máy hút bụi', 24),
(17, 'Tai nghe có dây', 25),
(18, 'Tai nghe không dây', 25),
(19, 'Micro', 25),
(20, 'Loa vi tính', 25),
(21, 'Loa kéo', 25),
(22, 'Loa Bluetooth', 25),
(23, 'Camera giám sát', 26),
(24, 'Máy quay phim', 26),
(25, 'Máy ảnh', 26),
(26, 'Ống kính - Lens', 26),
(27, 'USB, thẻ nhớ', 27),
(28, 'Bộ sạc', 27),
(29, 'Phụ kiện Macbook', 27),
(30, 'Đèn flash', 27),
(31, 'Streaming', 27),
(32, 'Webcam', 26),
(33, 'Balo, lót chuột,...', 27),
(34, 'Console, PS', 29),
(35, 'Wacom', 29),
(36, 'Đĩa game', 29),
(37, 'Nồi cơm điện', 30),
(38, 'Lò vi sóng', 30),
(39, 'Bếp các loại', 30),
(40, 'Tô, chén, đĩa', 30),
(41, 'Muỗng, đũa, dao', 30),
(42, 'Thức uống, pha chế', 30),
(43, 'Tiện ích nấu nướng', 30),
(44, 'Ly, cốc, bình trà', 31),
(45, 'Nội thất', 31),
(46, 'Đèn, thiết bị chiếu sáng', 31),
(47, 'Cây cảnh', 31),
(48, 'Đồ trang trí', 31),
(49, 'Tủ quần áo', 32),
(50, 'Đèn', 32),
(51, 'Ga, gối, nệm', 32),
(52, 'Giường ngủ', 32),
(53, 'Đồ trang trí', 32),
(54, 'Vòi nước', 33),
(55, 'Bồn cầu', 33),
(56, 'Chậu rửa mặt', 33),
(57, 'Bồn tắm', 33),
(58, 'Giá, kệ', 33);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `content` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `delivery_address`
--

CREATE TABLE `delivery_address` (
  `id` int(11) NOT NULL COMMENT 'id Nơi nhận hàng',
  `client_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Tên người nhận',
  `tel` varchar(11) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Sđt người nhận',
  `province` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Tỉnh/Thành phố',
  `district` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Quận/Huyện',
  `ward` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Phường/Xã',
  `specific_address` varchar(150) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Địa chỉ cụ thể',
  `id_user` int(11) NOT NULL COMMENT 'id Người dùng'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(11) NOT NULL,
  `id_cart` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `amount` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL COMMENT 'id Sản phẩm',
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Tên sản phẩm',
  `id_category` smallint(5) NOT NULL COMMENT 'id Danh mục',
  `categories_hashtag` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Phân nhóm danh mục',
  `id_seller` int(11) NOT NULL COMMENT 'id Người bán',
  `date` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Ngày thêm sản phẩm',
  `price` int(10) NOT NULL COMMENT 'Giá sản phẩm',
  `purchase` int(10) NOT NULL DEFAULT 0 COMMENT 'Lượt mua',
  `description` mediumtext COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Mô tả',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT 'Trạng thái\r\n(0: banned, 1: inactive, 2: active)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_classify_bycat`
--

CREATE TABLE `product_classify_bycat` (
  `id` int(11) NOT NULL COMMENT 'id Phân loại sp',
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Tên phân loại',
  `id_category` smallint(5) NOT NULL COMMENT 'id Danh mục'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_images`
--

CREATE TABLE `product_images` (
  `id` int(11) NOT NULL COMMENT 'id Hình ảnh sản phẩm',
  `name` varchar(105) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Tên hình ảnh sản phẩm',
  `id_product` int(11) NOT NULL COMMENT 'id Sản phẩm',
  `basename` varchar(254) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Tên file hình ảnh'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `rate`
--

CREATE TABLE `rate` (
  `id` int(11) NOT NULL COMMENT 'id Đánh giá',
  `id_product` int(11) NOT NULL COMMENT 'id Sản phẩm',
  `id_user` int(11) NOT NULL COMMENT 'id Người dùng',
  `value` tinyint(1) NOT NULL COMMENT 'Giá trị đánh giá (1 - 5)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sellers`
--

CREATE TABLE `sellers` (
  `id` int(11) NOT NULL COMMENT 'id Người bán',
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Tên gian hàng',
  `email` varchar(254) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Email người bán',
  `tel` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Số điện thoại',
  `address` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Việt Nam' COMMENT 'Địa chỉ kho (Quốc gia)',
  `pass` varchar(254) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Mật khẩu',
  `activation` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Kích hoạt',
  `avatar` varchar(254) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Ảnh đại diện',
  `cardimage` varchar(254) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Ảnh bìa',
  `date` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Ngày đăng ký',
  `role` int(2) NOT NULL COMMENT 'Phân quyền (10: Cá nhân; 20: Công ty) ( >= X1: Seller VIP)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sellers`
--

INSERT INTO `sellers` (`id`, `name`, `email`, `tel`, `address`, `pass`, `activation`, `avatar`, `cardimage`, `date`, `role`) VALUES
(1, 'Nguyễn Bảo Toàn', 'nguyenbaotoan2001@gmail.com', '0921469828', 'Việt Nam', '$2y$10$NFgJQ3k0Lr4MND5aEMadaOV7ysSTwSlMHSZNvpg3vqcevqZBvUnV2', 'e7702c37117d4566a80d829f47d5108d', NULL, NULL, '2020-11-29 21:24:42', 10);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL COMMENT 'id Giao dịch',
  `client_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Tên khách hàng',
  `date` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Ngày giao dịch',
  `address` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Địa chỉ nhận hàng',
  `tel` varchar(15) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Số điện thoại liên hệ',
  `id_user` int(11) NOT NULL COMMENT 'id Người dùng'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL COMMENT 'id người dùng',
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Tên người dùng',
  `email` varchar(254) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Email người dùng',
  `tel` varchar(15) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Số điện thoại',
  `pass` varchar(254) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Mật khẩu',
  `activation` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Mã kích hoạt',
  `avatar` varchar(254) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Ảnh địa diện',
  `cardimage` varchar(254) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Ảnh bìa',
  `birth` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Ngày sinh',
  `date` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Ngày đăng kí',
  `role` tinyint(2) NOT NULL DEFAULT 0 COMMENT 'Phân quyền người dùng'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `tel`, `pass`, `activation`, `avatar`, `cardimage`, `birth`, `date`, `role`) VALUES
(1, 'Nguyễn Bảo Toàn', 'nguyenbaotoan2001@gmail.com', '0921469828', '$2y$10$iAVtXGJDbgZsGGnbEw6nVuW0mMg89fqEWe64UGg1Em/hpni2JGQw.', '019b5d642f96d5779c163efd60af750d', NULL, NULL, '2020-11-18 17:07:21', '2020-11-18 17:07:21', 0),
(2, 'admin', 'admin@admin.com', '123456789', '$2y$10$0tuOBAmirrK4UD8v/.GWbuEhaQswialobjhpRwrsAR47FzO5s81Jq', '72e886fbc4c47215ac5793a1575a75f2', NULL, NULL, '2020-11-18 17:11:00', '2020-11-18 17:11:00', 30);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `category_hashtag`
--
ALTER TABLE `category_hashtag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_hashtag` (`id_category`) USING BTREE;

--
-- Chỉ mục cho bảng `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_comment` (`id_product`);

--
-- Chỉ mục cho bảng `delivery_address`
--
ALTER TABLE `delivery_address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_DeliveryAddress` (`id_user`);

--
-- Chỉ mục cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_order` (`id_cart`),
  ADD KEY `product_order` (`id_product`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seller_product` (`id_seller`) USING BTREE,
  ADD KEY `category_product` (`id_category`) USING BTREE;

--
-- Chỉ mục cho bảng `product_classify_bycat`
--
ALTER TABLE `product_classify_bycat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_productClassify` (`id_category`);

--
-- Chỉ mục cho bảng `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_image` (`id_product`);

--
-- Chỉ mục cho bảng `rate`
--
ALTER TABLE `rate`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_rate` (`id_user`),
  ADD KEY `product_rate` (`id_product`);

--
-- Chỉ mục cho bảng `sellers`
--
ALTER TABLE `sellers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_seller` (`email`,`tel`) USING BTREE;

--
-- Chỉ mục cho bảng `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_cart` (`id_user`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_user` (`email`,`tel`) USING BTREE;

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` smallint(5) NOT NULL AUTO_INCREMENT COMMENT 'id Danh mục', AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT cho bảng `category_hashtag`
--
ALTER TABLE `category_hashtag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id Hastag sản phẩm', AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT cho bảng `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id Sản phẩm', AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `product_classify_bycat`
--
ALTER TABLE `product_classify_bycat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id Phân loại sp';

--
-- AUTO_INCREMENT cho bảng `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id Hình ảnh sản phẩm', AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `rate`
--
ALTER TABLE `rate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id Đánh giá';

--
-- AUTO_INCREMENT cho bảng `sellers`
--
ALTER TABLE `sellers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id Người bán', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id Giao dịch';

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id người dùng', AUTO_INCREMENT=3;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `category_hashtag`
--
ALTER TABLE `category_hashtag`
  ADD CONSTRAINT `category_owned` FOREIGN KEY (`id_category`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `product_comment` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `delivery_address`
--
ALTER TABLE `delivery_address`
  ADD CONSTRAINT `user_DeliveryAddress` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `cart_order` FOREIGN KEY (`id_cart`) REFERENCES `transactions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_order` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `category_product` FOREIGN KEY (`id_category`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `seller_product` FOREIGN KEY (`id_seller`) REFERENCES `sellers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `product_classify_bycat`
--
ALTER TABLE `product_classify_bycat`
  ADD CONSTRAINT `category_productClassify` FOREIGN KEY (`id_category`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_image` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `rate`
--
ALTER TABLE `rate`
  ADD CONSTRAINT `product_rate` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_rate` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `user_cart` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
