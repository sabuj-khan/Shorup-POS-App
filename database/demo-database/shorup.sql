-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 17, 2024 at 09:06 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shorup`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Pastry', 1, '2024-08-11 05:24:11', '2024-08-11 05:24:11'),
(2, 'Chiness', 1, '2024-08-11 05:24:38', '2024-08-11 05:24:38'),
(3, 'Fast Food', 1, '2024-08-11 05:25:23', '2024-08-11 12:21:21'),
(5, 'Indian Food', 1, '2024-08-11 12:21:43', '2024-08-11 12:21:43'),
(9, 'Biriyani', 1, '2024-08-12 09:55:05', '2024-08-12 09:55:05'),
(10, 'Seafood', 1, '2024-08-12 09:55:48', '2024-08-12 09:55:48'),
(11, 'Beverages', 1, '2024-08-12 09:56:32', '2024-08-12 09:56:32'),
(12, 'Fast Food', 1, '2024-08-12 09:57:01', '2024-08-12 09:57:01'),
(13, 'Vegetables', 1, '2024-08-12 09:57:18', '2024-08-12 09:57:18'),
(14, 'Street Food', 1, '2024-08-12 09:57:33', '2024-08-12 09:57:33'),
(15, 'Sweets', 1, '2024-08-12 09:57:51', '2024-08-12 09:57:51'),
(16, 'Main Course( Rice )', 1, '2024-08-12 10:21:33', '2024-08-12 10:21:33'),
(17, 'Men', 6, '2024-08-15 02:57:41', '2024-08-15 02:57:41'),
(18, 'Women', 6, '2024-08-15 02:57:51', '2024-08-15 02:57:51'),
(19, 'Baby', 6, '2024-08-15 02:57:59', '2024-08-15 02:57:59');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `phone`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Sabuj Khan', 'sabuj@khan.xcom', '9876543210', 1, '2024-08-11 14:54:45', '2024-08-11 14:54:45'),
(2, 'Shojib Khan', 'shojib@khan.xcom', '0123456789', 1, '2024-08-11 14:57:08', '2024-08-11 14:57:08'),
(4, 'Mr John', 'mr@jhon.com', '918726531', 1, '2024-08-11 15:37:54', '2024-08-11 16:27:28'),
(5, 'Jamar Lomax', 'jamar@lomax.com', '98765234', 1, '2024-08-11 15:38:35', '2024-08-11 16:27:22'),
(9, 'Rupantor', 'rupantor@khan.com', '01908241281', 6, '2024-08-15 02:58:34', '2024-08-15 02:58:34'),
(10, 'Sabuj Khan', 'sabuj@khan.com', '01322158321', 6, '2024-08-15 02:58:59', '2024-08-15 02:58:59');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `total` varchar(50) NOT NULL,
  `discount` varchar(50) NOT NULL,
  `vat` varchar(50) NOT NULL,
  `payable` varchar(50) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `total`, `discount`, `vat`, `payable`, `user_id`, `customer_id`, `created_at`, `updated_at`) VALUES
(4, '200', '20', '20', '200', 1, 2, '2024-08-12 16:57:34', '2024-08-12 16:57:34'),
(6, '570.00', '30', '28.50', '598.50', 1, 5, '2024-08-13 11:26:31', '2024-08-13 11:26:31'),
(7, '2090.00', '110', '104.50', '2194.50', 1, 4, '2024-08-13 13:09:46', '2024-08-13 13:09:46'),
(8, '741.00', '39', '37.05', '778.05', 1, 5, '2024-08-15 01:48:00', '2024-08-15 01:48:00'),
(9, '2790.00', '310', '139.50', '2929.50', 6, 9, '2024-08-15 03:01:26', '2024-08-15 03:01:26'),
(10, '1900.00', '100', '95.00', '1995.00', 6, 10, '2024-08-15 03:02:05', '2024-08-15 03:02:05');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_products`
--

CREATE TABLE `invoice_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `qty` varchar(50) NOT NULL,
  `sale_price` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoice_products`
--

INSERT INTO `invoice_products` (`id`, `invoice_id`, `user_id`, `product_id`, `qty`, `sale_price`, `created_at`, `updated_at`) VALUES
(7, 4, 1, 6, '2', '300', '2024-08-12 16:57:35', '2024-08-12 16:57:35'),
(8, 4, 1, 7, '1', '40', '2024-08-12 16:57:36', '2024-08-12 16:57:36'),
(10, 6, 1, 7, '5', '200.00', '2024-08-13 11:26:32', '2024-08-13 11:26:32'),
(11, 6, 1, 5, '1', '300.00', '2024-08-13 11:26:32', '2024-08-13 11:26:32'),
(12, 6, 1, 4, '1', '100.00', '2024-08-13 11:26:32', '2024-08-13 11:26:32'),
(13, 7, 1, 5, '5', '1500.00', '2024-08-13 13:09:46', '2024-08-13 13:09:46'),
(14, 7, 1, 4, '5', '500.00', '2024-08-13 13:09:46', '2024-08-13 13:09:46'),
(15, 7, 1, 7, '5', '200.00', '2024-08-13 13:09:46', '2024-08-13 13:09:46'),
(16, 8, 1, 7, '2', '80.00', '2024-08-15 01:48:01', '2024-08-15 01:48:01'),
(17, 8, 1, 5, '2', '600.00', '2024-08-15 01:48:01', '2024-08-15 01:48:01'),
(18, 8, 1, 4, '1', '100.00', '2024-08-15 01:48:01', '2024-08-15 01:48:01'),
(19, 8, 1, 6, '0', '0.00', '2024-08-15 01:48:01', '2024-08-15 01:48:01'),
(20, 9, 6, 11, '1', '1500.00', '2024-08-15 03:01:26', '2024-08-15 03:01:26'),
(21, 9, 6, 12, '2', '1600.00', '2024-08-15 03:01:26', '2024-08-15 03:01:26'),
(22, 10, 6, 10, '5', '2000.00', '2024-08-15 03:02:05', '2024-08-15 03:02:05');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2024_08_09_114839_create_users_table', 1),
(2, '2024_08_09_121309_create_sessions_table', 2),
(3, '2024_08_11_102013_create_categories_table', 3),
(4, '2024_08_11_193245_create_customers_table', 4),
(5, '2024_08_11_224420_create_products_table', 5),
(6, '2024_08_12_213040_create_invoices_table', 6),
(7, '2024_08_12_213818_create_invoice_products_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` varchar(50) NOT NULL,
  `unit` varchar(50) NOT NULL,
  `img` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `user_id`, `category_id`, `name`, `price`, `unit`, `img`, `created_at`, `updated_at`) VALUES
(4, 1, 14, 'Fuchka', '100', '1', 'uploads/1-1723480166-chotpoti.jpg', '2024-08-12 10:29:26', '2024-08-12 10:29:26'),
(5, 1, 9, 'Kacchi Biriyani', '300', '1', 'uploads/1-1723480316-kacci-biriyani.jpg', '2024-08-12 10:31:56', '2024-08-12 10:31:56'),
(6, 1, 14, 'Chotpoti', '150', '1', 'uploads/1-1723494671-cxh.jpg', '2024-08-12 10:32:25', '2024-08-12 14:31:11'),
(7, 1, 15, 'Rosogolla', '40', '1', 'uploads/1-1723492485-rosogolla.jpg', '2024-08-12 13:54:45', '2024-08-12 16:55:02'),
(10, 6, 17, 'T-shirt', '400', '1', 'uploads/6-1723712393-bangladesh.jpg', '2024-08-15 02:59:54', '2024-08-15 02:59:54'),
(11, 6, 18, 'Three-pices', '1500', '1', 'uploads/6-1723712420-bangladesh.jpg', '2024-08-15 03:00:20', '2024-08-15 03:00:20'),
(12, 6, 19, 'Fotua', '800', '1', 'uploads/6-1723712447-bangladesh.jpg', '2024-08-15 03:00:47', '2024-08-15 03:00:47');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('xS4PABLt0y7CMl8qwFNmQQbQxLA4DpcodoV8pSay', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoib3A1cHQ3NEVQS2ttRUMwTkxlcmFaZldXSlN1MHlEM2hrbnplSlNEaSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zYWxlcy1yZXBvcnQvMjAyNC0wOC0xMC8yMDI0LTA4LTE3Ijt9fQ==', 1723877247);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `password` varchar(50) NOT NULL,
  `otp` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `mobile`, `password`, `otp`, `created_at`, `updated_at`) VALUES
(1, 'Mohammad Sabuj', 'Khan', 'shobuj@khan.com', '01322158321', '123', '1', '2024-08-09 12:32:26', '2024-08-11 03:54:46'),
(2, 'Rupantor', 'Khan', 'rupantor@khan.com', '01908241281', 'asd', '1', '2024-08-10 10:35:50', '2024-08-10 13:53:38'),
(6, 'Tahmid', 'Khan', 'tahmid@khan.com', '01908241281', '123', '0', '2024-08-15 02:56:56', '2024-08-15 02:56:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_user_id_foreign` (`user_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customers_user_id_foreign` (`user_id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoices_user_id_foreign` (`user_id`),
  ADD KEY `invoices_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `invoice_products`
--
ALTER TABLE `invoice_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_products_invoice_id_foreign` (`invoice_id`),
  ADD KEY `invoice_products_user_id_foreign` (`user_id`),
  ADD KEY `invoice_products_product_id_foreign` (`product_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_user_id_foreign` (`user_id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `invoice_products`
--
ALTER TABLE `invoice_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `invoices_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `invoice_products`
--
ALTER TABLE `invoice_products`
  ADD CONSTRAINT `invoice_products_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `invoice_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `invoice_products_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `products_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
