-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2024 at 06:21 PM
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
  `archived` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `archived`) VALUES
(17, 'Smartphones', 'jadzifnaozifn', 0),
(18, 'Cameras', '', 0),
(19, 'Laptops', '', 0),
(27, 'Quyn Webster', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `payment_method` enum('credit_card','cash_on_delivery') NOT NULL,
  `status` enum('pending','processing','shipped','completed','cancelled') DEFAULT 'pending',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `payment_method`, `status`, `created_at`, `total`) VALUES
(11, 5, 'cash_on_delivery', 'pending', '2024-04-18 10:11:59', 2000.00),
(12, 5, 'cash_on_delivery', 'completed', '2024-04-18 10:46:15', 1400.00),
(13, 5, 'cash_on_delivery', 'pending', '2024-04-18 10:52:50', 522.00),
(14, 5, 'cash_on_delivery', 'completed', '2024-04-18 14:33:42', 4700.00);

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
(13, 11, 20, 2, 1300.00),
(14, 11, 21, 1, 700.00),
(15, 12, 21, 2, 1400.00),
(16, 13, 30, 1, 522.00),
(17, 14, 18, 3, 2700.00),
(18, 14, 19, 2, 2000.00);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `cost_price` int(11) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `archived` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `cost_price`, `stock`, `image`, `category_id`, `archived`) VALUES
(18, 'Iphone X', 'This is a ', 900.00, 700, NULL, 'iphoneX.jpg', 17, 0),
(19, 'Iphone 11', 'This is a ', 1000.00, 800, NULL, 'iphone11.jpg', 17, 0),
(20, 'Nikon', 'This is a ', 650.00, 600, NULL, 'Nikon.jpg', 18, 0),
(21, 'Canon', 'This is a ', 700.00, 650, NULL, 'Canon.jpg', 18, 0),
(22, 'Mac Air M1', 'This is a ', 1200.00, 1003, NULL, 'macAirM1.jpg', 19, 0),
(23, 'Mac Pro M3', 'Molestiae velit repr', 2100.00, 2000, NULL, 'MacProM3.jpg', 19, 0),
(30, 'Judith Wilson', 'Soluta iste et venia', 522.00, 500, NULL, 'download.jpg', 27, 1);

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
(2, 'alex', 'alex@mail.com', 'Res alex 3 route tan, imm 8', NULL, 'alex', 0, 0),
(3, 'said', 'said@mail.com', 'Res Said 1 route kenitra', NULL, 'said', 0, 0),
(5, 'test', 'test@mail.com', 'Res halima, imm 2, app 4', '066320871', '$2y$10$DmhVKqSLOkJtPyBIBrLkcehFk4J3bVzjVrcFzwHDnI09nP5uGBl5m', 0, 0),
(6, 't', 't@mail.com', 'freaz', '32', '$2y$10$oFvsfSvFAGfvjBvIlv2vLeiX0nQrNzYGPe1yffvjB4/loJQXs0UkK', 0, 0),
(11, 'te', 'nihysi@mailinator.com', 'Reiciendis laborum ', '+1 (632) 449-8016', '$2y$10$iueXMBzkcYtSe159dNuja.GBtsHHyGIPofcdsikYN2l3Vj.Q/LJbO', 1, 0),
(12, 'ali', 'ali@mail.com', 'faerz', '423', '$2y$10$ukm/KHMHuAfApHAVh7UPjeajRi1jVw9xY.rCyBLt7XVnS./N7c3hC', 1, 0);

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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
