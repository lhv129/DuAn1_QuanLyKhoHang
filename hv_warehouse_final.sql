-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 09, 2024 at 05:31 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hv_warehouse`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int NOT NULL,
  `name` varchar(250) NOT NULL,
  `is_delete` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `is_delete`) VALUES
(1, 'Yonex', 0),
(2, 'Victor', 0),
(3, 'Thành Công', 0);

-- --------------------------------------------------------

--
-- Table structure for table `goods_delivery_note`
--

CREATE TABLE `goods_delivery_note` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `payment_id` int NOT NULL,
  `customer` varchar(250) NOT NULL,
  `total_price` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL,
  `is_delete` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `goods_delivery_note`
--

INSERT INTO `goods_delivery_note` (`id`, `user_id`, `payment_id`, `customer`, `total_price`, `created_at`, `is_delete`) VALUES
(16, 3, 2, 'Nguyễn Văn A', '700000', '2024-08-05 23:39:00', 1),
(17, 3, 2, 'Nguyễn Văn A', '600000', '2024-08-04 23:40:00', 0),
(18, 3, 1, 'Nguyễn văn B', '700000', '2024-08-05 23:42:00', 0),
(19, 3, 2, 'Nguyễn văn B', '1200000', '2024-08-06 23:42:00', 0),
(20, 3, 2, 'Nguyễn Văn A', '600000', '2024-08-07 23:42:00', 0),
(21, 3, 2, 'Lưu Đình Dũng', '360000', '2024-08-06 23:42:00', 0),
(22, 2, 2, 'VND SHOP - Đại lý bán lẻ', '48000000', '2024-08-06 23:43:00', 0),
(23, 2, 2, 'Nguyễn văn C', '1200000', '2024-08-07 23:44:00', 0),
(24, 2, 2, 'VND SHOP - Đại lý bán lẻ', '20000000', '2024-08-05 23:44:00', 1),
(25, 2, 1, 'VND SHOP - Đại lý bán lẻ', '6000000', '2024-08-07 23:45:00', 0),
(26, 2, 1, 'VND SHOP - Đại lý bán lẻ', '2800000', '2024-08-07 23:46:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `goods_delivery_note_details`
--

CREATE TABLE `goods_delivery_note_details` (
  `id` int NOT NULL,
  `goods_delivery_note_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `sub_total` varchar(250) NOT NULL,
  `status` int DEFAULT NULL,
  `is_delete` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `goods_delivery_note_details`
--

INSERT INTO `goods_delivery_note_details` (`id`, `goods_delivery_note_id`, `product_id`, `quantity`, `sub_total`, `status`, `is_delete`) VALUES
(16, 16, 1, 2, '700000', NULL, 1),
(17, 17, 2, 5, '600000', NULL, 0),
(18, 18, 1, 2, '700000', NULL, 0),
(19, 19, 2, 10, '1200000', NULL, 0),
(20, 20, 5, 5, '600000', NULL, 0),
(21, 21, 5, 3, '360000', NULL, 0),
(22, 22, 4, 12, '48000000', NULL, 0),
(23, 23, 5, 10, '1200000', NULL, 0),
(24, 24, 4, 5, '20000000', NULL, 1),
(25, 25, 3, 4, '6000000', NULL, 0),
(26, 26, 1, 8, '2800000', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `goods_receipt_note`
--

CREATE TABLE `goods_receipt_note` (
  `id` int NOT NULL,
  `supplier_id` int NOT NULL,
  `user_id` int NOT NULL,
  `payment_id` int NOT NULL,
  `total_price` float DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_delete` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `goods_receipt_note`
--

INSERT INTO `goods_receipt_note` (`id`, `supplier_id`, `user_id`, `payment_id`, `total_price`, `status`, `created_at`, `is_delete`) VALUES
(71, 3, 2, 1, 1800000, 'Success', '2024-08-07 23:35:00', 0),
(72, 3, 2, 1, 32000000, 'Success', '2024-07-29 23:36:00', 0),
(73, 1, 2, 1, 5000000, 'Success', '2024-07-27 23:37:00', 0),
(74, 2, 2, 1, 16000000, 'Success', '2024-08-07 23:38:00', 0),
(75, 1, 2, 2, 750000, 'Success', '2024-07-27 23:38:00', 0),
(76, 1, 3, 1, 750000, 'Success', '2024-08-07 23:39:00', 0),
(77, 2, 1, 2, 3000000, 'Success', '2024-07-29 23:40:00', 0),
(78, 3, 2, 2, 750000, 'Success', '2024-08-08 00:38:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `goods_receipt_note_details`
--

CREATE TABLE `goods_receipt_note_details` (
  `id` int NOT NULL,
  `goods_receipt_note_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `sub_total` decimal(10,0) NOT NULL,
  `status` int DEFAULT NULL,
  `is_delete` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `goods_receipt_note_details`
--

INSERT INTO `goods_receipt_note_details` (`id`, `goods_receipt_note_id`, `product_id`, `quantity`, `sub_total`, `status`, `is_delete`) VALUES
(66, 71, 5, 20, '1800000', NULL, 0),
(67, 72, 4, 10, '32000000', NULL, 0),
(68, 73, 3, 5, '5000000', NULL, 0),
(69, 74, 4, 5, '16000000', NULL, 0),
(70, 75, 2, 10, '750000', NULL, 0),
(71, 76, 2, 10, '750000', NULL, 0),
(72, 77, 1, 10, '3000000', NULL, 0),
(73, 78, 2, 10, '750000', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int NOT NULL,
  `name` varchar(250) NOT NULL,
  `is_delete` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `name`, `is_delete`) VALUES
(1, 'Chuyển Khoản', 0),
(2, 'Tiền Mặt', 0),
(3, 'Quẹt Thẻ', 0);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `brand_id` int NOT NULL,
  `unit_id` int NOT NULL,
  `name` varchar(250) NOT NULL,
  `image` varchar(250) NOT NULL,
  `entry_price` varchar(250) NOT NULL,
  `retail_price` varchar(250) NOT NULL,
  `slug` varchar(250) NOT NULL,
  `status` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `is_delete` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `brand_id`, `unit_id`, `name`, `image`, `entry_price`, `retail_price`, `slug`, `status`, `created_at`, `is_delete`) VALUES
(1, 1, 1, 'Vợt cầu lông chính hãng', 'uploads/products/vot-cau-long-vicleo-chinh-hang (3)(2).jpg', '300000', '350000', 'vot-cau-long-chinh-hang', NULL, '2024-07-04 16:19:39', 0),
(2, 3, 2, 'Ống cầu lông Thành Công 24 quả', 'uploads/products/712887ca793c8062d92d-2f2fd661-ae2a-4dfe-ae67-6ce7eee7f5eb.webp', '75000', '120000', 'hop-cau-long-24-qua', NULL, '2024-07-04 17:26:56', 0),
(3, 2, 1, 'Vợt Victor', 'uploads/products/victor.jpg', '1000000', '1500000', 'vot-victor', NULL, '2024-07-25 13:08:05', 0),
(4, 2, 1, 'Vợt Cầu Lông Victor Auraspeed HS Plus - Xách Tay', 'uploads/products/vot-cau-long-victor-auraspeed-hs-plus-xach-tay.jpg', '3200000', '4000000', 'vot-cau-long-victor', NULL, '2024-07-28 17:21:30', 0),
(5, 3, 2, 'Hộp cầu lông PROMAX', 'uploads/products/image.png.webp', '90000', '120000', 'hop-cau-long-promax', NULL, '2024-08-04 19:31:32', 0);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int NOT NULL,
  `name` varchar(250) NOT NULL,
  `is_delete` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`, `is_delete`) VALUES
(1, 'Khách hàng', 0),
(2, 'Nhân viên', 0),
(3, 'Quản trị viên', 0);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int NOT NULL,
  `name` varchar(250) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `email` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `is_delete` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `phone_number`, `email`, `is_delete`) VALUES
(1, 'VNB Shop', '0983668888', 'vnbshop8888@gmail.com', 0),
(2, 'TT Sport', '0966668888', 'ttsport@gmail.com', 0),
(3, 'Wsport', '0981831994', 'wsport.vn@gmail.com', 0);

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` int NOT NULL,
  `name` varchar(250) NOT NULL,
  `is_delete` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `name`, `is_delete`) VALUES
(1, 'Chiếc', 0),
(2, 'Hộp', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `full_name` varchar(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `address` varchar(250) NOT NULL,
  `is_active` int NOT NULL DEFAULT '0',
  `role_id` int NOT NULL,
  `is_delete` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `name`, `email`, `password`, `phone_number`, `address`, `is_active`, `role_id`, `is_delete`) VALUES
(1, 'Admin', 'Admin', 'admin@gmail.com', '123456', '0988886666', 'Hà Nội', 1, 3, 0),
(2, 'Lưu Hoàng Việt', 'vietlh', 'vietlh04@gmail.com', '123456', '0983669129', 'Hà Nội', 1, 2, 0),
(3, 'Nguyễn Thúy Ngọc', 'tngoc', 'tngoc@gmail.com', '123456', '0988886666', 'Hà Nội', 1, 2, 0),
(4, 'Khiếu Đăng Tùng', 'tungdk', 'tungdk04@gmail.com', '123456', '09836415821', 'TP. HCM', 0, 2, 0),
(5, 'Nguyễn Văn A', 'vana', 'vana@gmail.com', '123456789', '08342512211', 'Hải Phòng', 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `warehousing`
--

CREATE TABLE `warehousing` (
  `id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `is_delete` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `warehousing`
--

INSERT INTO `warehousing` (`id`, `product_id`, `quantity`, `is_delete`) VALUES
(20, 5, 2, 0),
(21, 4, 3, 0),
(22, 3, 1, 0),
(23, 2, 15, 0),
(24, 1, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `goods_delivery_note`
--
ALTER TABLE `goods_delivery_note`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lk_delivery_staff` (`user_id`);

--
-- Indexes for table `goods_delivery_note_details`
--
ALTER TABLE `goods_delivery_note_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lk_delivery_note` (`goods_delivery_note_id`),
  ADD KEY `lk_delivery_product` (`product_id`);

--
-- Indexes for table `goods_receipt_note`
--
ALTER TABLE `goods_receipt_note`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lk_supplier` (`supplier_id`),
  ADD KEY `lk_user` (`user_id`),
  ADD KEY `lk_payment` (`payment_id`);

--
-- Indexes for table `goods_receipt_note_details`
--
ALTER TABLE `goods_receipt_note_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lk_receipt_note` (`goods_receipt_note_id`),
  ADD KEY `receipt_note_details_lk_product` (`product_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lk_brand` (`brand_id`),
  ADD KEY `lk_unit` (`unit_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lk_role` (`role_id`);

--
-- Indexes for table `warehousing`
--
ALTER TABLE `warehousing`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lk_product` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `goods_delivery_note`
--
ALTER TABLE `goods_delivery_note`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `goods_delivery_note_details`
--
ALTER TABLE `goods_delivery_note_details`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `goods_receipt_note`
--
ALTER TABLE `goods_receipt_note`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `goods_receipt_note_details`
--
ALTER TABLE `goods_receipt_note_details`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `warehousing`
--
ALTER TABLE `warehousing`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `goods_delivery_note`
--
ALTER TABLE `goods_delivery_note`
  ADD CONSTRAINT `lk_delivery_staff` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `goods_delivery_note_details`
--
ALTER TABLE `goods_delivery_note_details`
  ADD CONSTRAINT `lk_delivery_note` FOREIGN KEY (`goods_delivery_note_id`) REFERENCES `goods_delivery_note` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `lk_delivery_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `goods_receipt_note`
--
ALTER TABLE `goods_receipt_note`
  ADD CONSTRAINT `lk_payment` FOREIGN KEY (`payment_id`) REFERENCES `payments` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `lk_supplier` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `lk_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `goods_receipt_note_details`
--
ALTER TABLE `goods_receipt_note_details`
  ADD CONSTRAINT `lk_receipt_note` FOREIGN KEY (`goods_receipt_note_id`) REFERENCES `goods_receipt_note` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `receipt_note_details_lk_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `lk_brand` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `lk_unit` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `lk_role` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `warehousing`
--
ALTER TABLE `warehousing`
  ADD CONSTRAINT `lk_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
