-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 12, 2024 at 05:55 AM
-- Server version: 8.2.0
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crudproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `category_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `u_user_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `status`, `user_id`, `u_user_id`, `created_at`, `updated_at`) VALUES
(1, 'snacks', '1', NULL, NULL, '2024-03-08 05:30:10', '2024-03-09 02:08:51'),
(2, 'cold drink', '1', NULL, NULL, '2024-03-08 05:48:02', NULL),
(3, 'sweet', '1', NULL, NULL, '2024-03-08 05:49:08', NULL),
(11, 'vegetables', '1', NULL, NULL, '2024-03-08 06:02:27', NULL),
(10, 'chocolates', '1', NULL, NULL, '2024-03-08 06:01:45', '2024-03-09 02:11:04'),
(15, 'bakery', '1', NULL, NULL, '2024-03-09 01:57:26', '2024-03-09 02:10:14'),
(14, 'biscuits', '1', NULL, NULL, '2024-03-08 06:18:39', '2024-03-09 02:09:56');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2024_03_08_101712_create_product_table', 1),
(3, '2024_03_08_102116_create_category_table', 2),
(4, '2024_03_08_121611_add_category_id_to_product', 3);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `prod_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prod_desc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `u_user_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_category_id_foreign` (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `prod_name`, `prod_desc`, `category_id`, `status`, `user_id`, `u_user_id`, `created_at`, `updated_at`) VALUES
(1, 'parle g updated', 'desc updated', 14, '1', NULL, NULL, '2024-03-08 06:26:28', '2024-03-11 23:12:50'),
(2, 'monaco', 'desc updated', 14, '1', NULL, NULL, '2024-03-08 06:26:57', '2024-03-11 04:01:33'),
(3, 'crack jack', 'desc updating', 14, '1', NULL, NULL, '2024-03-08 06:30:09', '2024-03-11 04:10:08'),
(4, 'kaju katri', 'desc updated', 3, '1', NULL, NULL, '2024-03-08 06:30:58', '2024-03-11 04:06:25'),
(5, 'peda', 'desc updated', 3, '1', NULL, NULL, '2024-03-08 06:50:15', '2024-03-11 04:01:33'),
(6, 'fanta updated', 'desc updated', 2, '1', NULL, NULL, '2024-03-08 06:50:26', '2024-03-11 04:01:44'),
(7, 'mazza', 'desc updated', 2, '1', NULL, NULL, '2024-03-08 06:50:32', '2024-03-11 04:01:43'),
(8, 'cabbage', 'desc', 11, '1', NULL, NULL, '2024-03-08 06:50:42', '2024-03-11 04:01:43'),
(9, 'chataka pataka', 'desc', 1, '1', NULL, NULL, '2024-03-08 06:50:55', '2024-03-11 04:01:43'),
(10, 'wafer', 'desc', 1, '1', NULL, NULL, '2024-03-08 06:51:04', '2024-03-11 04:01:42'),
(11, 'pop rings', 'description', 1, '1', NULL, NULL, '2024-03-08 06:51:16', '2024-03-11 04:00:55'),
(12, 'dairy milk', 'desc', 10, '1', NULL, NULL, '2024-03-08 06:51:24', '2024-03-11 04:00:54'),
(13, 'munch', 'description', 10, '1', NULL, NULL, '2024-03-08 06:51:33', '2024-03-11 04:00:54'),
(14, 'perk', 'desc', 10, '1', NULL, NULL, '2024-03-08 06:51:40', '2024-03-11 04:00:54'),
(15, 'happy happy', 'desc', 14, '1', NULL, NULL, '2024-03-09 00:50:58', '2024-03-11 04:00:52'),
(16, 'kit kat', 'desc updated', 10, '1', NULL, NULL, '2024-03-09 00:52:55', '2024-03-11 04:00:39'),
(17, 'pav', 'pav description', 15, '1', NULL, NULL, '2024-03-09 01:57:48', '2024-03-11 04:10:23'),
(18, 'bread', 'bread description', 15, '1', NULL, NULL, '2024-03-09 01:58:02', '2024-03-11 04:00:17'),
(19, 'parle g', 'asdf', 1, '1', NULL, NULL, '2024-03-11 05:56:40', NULL),
(20, 'crack jack', 'asfa', 2, '1', NULL, NULL, '2024-03-11 05:59:10', NULL),
(21, 'parle g updated', 'sdaf', 14, '1', NULL, NULL, '2024-03-11 06:00:10', NULL),
(22, 'kaju katri', 'sdf', 1, '1', NULL, NULL, '2024-03-11 06:13:21', NULL),
(23, 'peda', 'seryre', 3, '1', NULL, NULL, '2024-03-11 06:13:44', NULL),
(24, 'monaco', 'sd', 10, '1', NULL, NULL, '2024-03-11 06:14:07', NULL),
(25, 'ds', 'ds', 1, '1', NULL, NULL, '2024-03-11 06:14:26', NULL),
(26, 'fanta', 'zds', 3, '1', NULL, NULL, '2024-03-11 06:53:45', '2024-03-12 00:20:16'),
(27, 'wafer', 'ad', 1, '1', NULL, NULL, '2024-03-11 07:11:28', '2024-03-12 00:20:17'),
(28, 'parle g updated', 'desc updated', 14, '1', NULL, NULL, '2024-03-11 07:37:50', '2024-03-12 00:20:18'),
(29, 'parle', 'desc updating', 1, '1', NULL, NULL, '2024-03-11 07:42:41', '2024-03-12 00:20:03'),
(30, 'parle g updated', 'desc updating', 14, '1', NULL, NULL, '2024-03-11 07:43:02', '2024-03-11 23:08:29'),
(31, 'monaco', 'aa biscuit che', 14, '0', NULL, NULL, '2024-03-11 23:59:32', '2024-03-12 00:24:06');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
