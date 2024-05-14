-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2024 at 07:03 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `archived` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `image`, `archived`) VALUES
(28, 'Apple', 'Apple Inc. is an American multinational technology company that designs, manufactures, and markets consumer electronics, software, and services.', 'iphones.png', 0),
(29, 'Samsung', 'Samsung Electronics Co., Ltd. is a South Korean multinational electronics company headquartered in the Yeongtong District of Suwon.', 'samsung.jpg', 0),
(30, 'Huawei', 'Huawei Technologies Co., Ltd. is a Chinese multinational technology company headquartered in Shenzhen, Guangdong, China.', 'huawei.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `payment_method` enum('credit_card','cash_on_delivery') NOT NULL,
  `status` enum('pending','processing','shipped','cancelled') NOT NULL DEFAULT 'pending',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `payment_method`, `status`, `created_at`, `total`) VALUES
(15, 5, 'credit_card', 'shipped', '2024-05-13 10:00:00', 2399.98),
(16, 5, 'cash_on_delivery', 'cancelled', '2024-05-13 11:30:00', 1499.98),
(19, 5, 'cash_on_delivery', 'shipped', '2024-05-13 14:38:26', 2399.97),
(20, 5, 'credit_card', 'processing', '2024-05-13 17:56:27', 799.98),
(21, 5, 'cash_on_delivery', 'pending', '2024-05-13 20:45:18', 3899.96),
(22, 5, 'cash_on_delivery', 'processing', '2024-05-13 20:46:12', 3899.96),
(23, 5, 'credit_card', 'cancelled', '2024-05-13 20:51:41', 1499.97),
(24, 5, 'cash_on_delivery', 'pending', '2024-05-13 20:52:54', 2899.97),
(26, 5, 'cash_on_delivery', 'pending', '2024-05-14 17:08:30', 2799.96),
(27, 5, 'credit_card', 'pending', '2024-05-14 17:08:47', 1399.98),
(28, 5, 'cash_on_delivery', 'pending', '2024-05-14 18:02:56', 7799.91);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `total`) VALUES
(23, 15, 33, 1, 999.99),
(24, 15, 36, 1, 1399.99),
(25, 16, 34, 1, 699.99),
(26, 16, 36, 1, 799.99),
(27, 19, 33, 2, 1999.98),
(28, 19, 34, 1, 399.99),
(29, 20, 37, 2, 799.98),
(30, 21, 40, 2, 2399.98),
(31, 21, 39, 1, 999.99),
(32, 21, 41, 1, 499.99),
(33, 22, 40, 2, 2399.98),
(34, 22, 39, 1, 999.99),
(35, 22, 41, 1, 499.99),
(36, 23, 34, 2, 799.98),
(37, 23, 35, 1, 699.99),
(38, 24, 40, 2, 2399.98),
(39, 24, 41, 1, 499.99),
(42, 26, 37, 2, 799.98),
(43, 26, 33, 2, 1999.98),
(44, 27, 34, 1, 399.99),
(45, 27, 33, 1, 999.99),
(46, 28, 37, 5, 1999.95),
(47, 28, 36, 1, 1199.99),
(48, 28, 38, 2, 3599.98),
(49, 28, 39, 1, 999.99);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `ram` int(11) NOT NULL,
  `storage` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `cost_price` int(11) NOT NULL,
  `color` varchar(255) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `archived` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `ram`, `storage`, `price`, `cost_price`, `color`, `image`, `category_id`, `archived`) VALUES
(33, 'iPhone 13 Pro', 'The iPhone 13 Pro is Apple\'s latest flagship smartphone, featuring a stunning Super Retina XDR display, powerful A15 Bionic chip, and advanced camera system.', 12, 256, 999.99, 850, NULL, 'iphone13pro.jpeg', 28, 0),
(34, 'iPhone SE', 'The iPhone SE packs powerful features into a compact design. It features the A15 Bionic chip, advanced camera system, and 5G connectivity.', 4, 128, 399.99, 370, NULL, 'iphonese.jpeg', 28, 0),
(35, 'iPhone 12', 'The iPhone 12 features a beautiful Super Retina XDR display, A14 Bionic chip, and dual-camera system. It combines performance and style in a sleek design.', 6, 128, 699.99, 640, NULL, 'iphone12.jpeg', 28, 0),
(36, 'Samsung Galaxy S21 Ultra', 'The Samsung Galaxy S21 Ultra is a premium flagship smartphone with a stunning Dynamic AMOLED 2X display, powerful Exynos 2100 processor, and versatile camera system.', 12, 256, 1199.99, 1120, NULL, 'galaxys21ultra.jpg', 29, 0),
(37, 'Samsung Galaxy A52', 'The Samsung Galaxy A52 is a mid-range smartphone with a high-refresh-rate Super AMOLED display, Snapdragon 720G processor, and quad-camera setup.', 8, 128, 399.99, 350, NULL, 'galaxya52.jpg', 29, 0),
(38, 'Samsung Galaxy Z Fold 3', 'The Samsung Galaxy Z Fold 3 is a foldable smartphone with a large flexible display, Snapdragon 888 processor, and versatile camera system.', 12, 256, 1799.99, 1700, NULL, 'galaxyzfold3.jpg', 29, 0),
(39, 'Huawei P40 Pro', 'The Huawei P40 Pro features a stunning Quad-Curve Overflow Display, Kirin 990 5G chipset, and Leica Quad Camera system for professional-grade photography.', 8, 256, 999.99, 940, NULL, 'huaweip40pro.jpg', 30, 0),
(40, 'Huawei Mate 40 Pro', 'The Huawei Mate 40 Pro is a flagship smartphone with a Horizon Display, Kirin 9000 chipset, and versatile camera setup for capturing stunning photos and videos.', 8, 256, 1199.99, 1120, NULL, 'huaweimate40pro.jpg', 30, 0),
(41, 'Huawei Nova 7', 'The Huawei Nova 7 is a mid-range smartphone with a high-resolution display, Kirin 985 chipset, and quad-camera setup for capturing memorable moments.', 8, 128, 499.99, 450, NULL, 'huaweinova7.jpg', 30, 0),
(43, 'test', 'afez', 10, 203, 1200.00, 1199, 'FE', 'huaweinova7.jpg', 30, 0),
(44, 'testing', 'afez', 10, 203, 1200.00, 1199, 'FE', 'huaweinova7.jpg', 30, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `archived` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `address`, `phone_number`, `password`, `is_admin`, `archived`) VALUES
(2, 'alex', 'alex@mail.com', 'Res alex 3 route tan, imm 8', '066320422', 'alex', 0, 0),
(3, 'said', 'said@mail.com', 'Res Said 1 route kenitra', '066320871', 'said', 0, 0),
(5, 'test', 'test@mail.com', 'Res halima, imm 2, app 4', '066320871', '$2y$10$D6QvmpKF/X71a6uqnT0WNubyGZjEXp.fIYVyt0jmZlAahv1l8SXC6', 0, 0),
(6, 't', 't@mail.com', 'freazfnzerji', '062420871', '$2y$10$oFvsfSvFAGfvjBvIlv2vLeiX0nQrNzYGPe1yffvjB4/loJQXs0UkK', 0, 0),
(11, 'te', 'nihysi@mailinator.com', 'Reiciendis laborum ', '+1 (632) 449-8016', '$2y$10$iueXMBzkcYtSe159dNuja.GBtsHHyGIPofcdsikYN2l3Vj.Q/LJbO', 1, 0),
(12, 'ali', 'ali@mail.com', 'faerz', '423', '$2y$10$fxRt/2tWHTMoUjsRad6t8uacBCphjTKhr1G/z.ezK8lahg7Dn5X5i', 1, 0),
(13, 'datocenun', 'syfola@mailinator.com', 'Sapiente omnis dolor', '+1 (521) 366-69848', '$2y$10$UicxnvmJ7400u0KZdAD9Qu2E/cwCSSFkg84P2pL9Yy5CoF57Jl/mi', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
