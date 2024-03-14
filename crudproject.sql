-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 14, 2024 at 12:48 PM
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
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(14, 'biscuits', '1', NULL, NULL, '2024-03-08 06:18:39', '2024-03-09 02:09:56'),
(16, 'fruit', '1', NULL, NULL, '2024-03-14 04:36:48', NULL);

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
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2024_03_08_101712_create_product_table', 1),
(3, '2024_03_08_102116_create_category_table', 2),
(4, '2024_03_08_121611_add_category_id_to_product', 3),
(8, '2024_03_12_085231_create_subcategory_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `prod_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prod_desc` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subcategory_id` bigint UNSIGNED DEFAULT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `u_user_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_category_id_foreign` (`category_id`),
  KEY `product_subcategory_id_foreign` (`subcategory_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `prod_name`, `prod_desc`, `subcategory_id`, `category_id`, `status`, `user_id`, `u_user_id`, `created_at`, `updated_at`) VALUES
(1, 'parle g updated', 'desc updated', 1, 14, '1', NULL, NULL, '2024-03-08 06:26:28', '2024-03-13 06:59:13'),
(2, 'monaco', 'desc updated', 2, 14, '1', NULL, NULL, '2024-03-08 06:26:57', '2024-03-11 04:01:33'),
(3, 'crack jack', 'desc updating', 3, 14, '1', NULL, NULL, '2024-03-08 06:30:09', '2024-03-11 04:10:08'),
(4, 'kaju katri', 'desc updated', 7, 3, '1', NULL, NULL, '2024-03-08 06:30:58', '2024-03-11 04:06:25'),
(5, 'peda', 'desc updated', 8, 3, '1', NULL, NULL, '2024-03-08 06:50:15', '2024-03-13 06:44:23'),
(6, 'fanta updated', 'desc updated', 4, 2, '1', NULL, NULL, '2024-03-08 06:50:26', '2024-03-13 23:15:50'),
(7, 'mazza', 'desc updated', 4, 2, '1', NULL, NULL, '2024-03-08 06:50:32', '2024-03-11 04:01:43'),
(8, 'cabbage', 'desc', 10, 11, '1', NULL, NULL, '2024-03-08 06:50:42', '2024-03-13 23:56:34'),
(9, 'chataka pataka', 'desc', 12, 1, '1', NULL, NULL, '2024-03-08 06:50:55', '2024-03-13 23:58:27'),
(10, 'wafer', 'desc', 13, 1, '1', NULL, NULL, '2024-03-08 06:51:04', '2024-03-13 23:59:00'),
(11, 'pop rings', 'description', 12, 1, '1', NULL, NULL, '2024-03-08 06:51:16', '2024-03-13 23:59:19'),
(12, 'dairy milk', 'desc', 5, 10, '1', NULL, NULL, '2024-03-08 06:51:24', '2024-03-13 23:59:26'),
(13, 'munch', 'description', 14, 10, '1', NULL, NULL, '2024-03-08 06:51:33', '2024-03-13 23:59:59'),
(14, 'perk', 'desc', 14, 10, '1', NULL, NULL, '2024-03-08 06:51:40', '2024-03-14 00:00:08'),
(15, 'happy happy', 'desc', 15, 14, '1', NULL, NULL, '2024-03-09 00:50:58', '2024-03-14 00:00:41'),
(16, 'kit kat', 'desc updated', 5, 10, '1', NULL, NULL, '2024-03-09 00:52:55', '2024-03-14 00:00:51'),
(17, 'pav', 'pav description', NULL, 15, '0', NULL, NULL, '2024-03-09 01:57:48', '2024-03-14 00:02:59'),
(18, 'bread', 'bread description', NULL, 15, '0', NULL, NULL, '2024-03-09 01:58:02', '2024-03-14 00:03:56'),
(19, 'parle g', 'asdf', 6, 1, '0', NULL, NULL, '2024-03-11 05:56:40', '2024-03-14 00:01:40'),
(20, 'crack jack', 'asfa', 9, 2, '0', NULL, NULL, '2024-03-11 05:59:10', '2024-03-14 00:01:43'),
(21, 'parle g updated', 'sdaf', 1, 14, '0', NULL, NULL, '2024-03-11 06:00:10', '2024-03-14 00:01:44'),
(22, 'kaju katri', 'sdf', 9, 1, '0', NULL, NULL, '2024-03-11 06:13:21', '2024-03-14 00:01:46'),
(23, 'peda', 'seryre', 8, 3, '0', NULL, NULL, '2024-03-11 06:13:44', '2024-03-14 00:01:47'),
(24, 'monaco', 'sd', 5, 10, '0', NULL, NULL, '2024-03-11 06:14:07', '2024-03-14 00:01:48'),
(25, 'ds', 'ds', 2, 1, '0', NULL, NULL, '2024-03-11 06:14:26', '2024-03-14 00:01:48'),
(26, 'fanta', 'zds', 4, 2, '1', NULL, NULL, '2024-03-11 06:53:45', '2024-03-14 00:01:49'),
(27, 'wafer', 'ad', 6, 1, '1', NULL, NULL, '2024-03-11 07:11:28', '2024-03-14 00:01:50'),
(28, 'parle g updated', 'desc updating', 5, 14, '0', NULL, NULL, '2024-03-11 07:37:50', '2024-03-14 00:57:30'),
(29, 'parle', 'desc updating', 4, 1, '0', NULL, NULL, '2024-03-11 07:42:41', '2024-03-14 00:57:17'),
(30, 'parle g updated', 'desc updating', 3, 14, '0', NULL, NULL, '2024-03-11 07:43:02', '2024-03-14 00:57:08'),
(31, 'monaco', 'aa biscuit che', 2, 14, '0', NULL, NULL, '2024-03-11 23:59:32', '2024-03-14 00:56:59'),
(33, 'parle g', 'this is a biscuit', 1, 14, '0', NULL, NULL, '2024-03-13 00:32:59', '2024-03-14 00:56:40'),
(34, 'parle g', 'ef', 1, 14, '0', NULL, NULL, '2024-03-13 02:32:01', '2024-03-14 00:56:00'),
(35, 'parle g', 'ef', 1, 14, '0', NULL, NULL, '2024-03-13 02:32:01', '2024-03-14 00:55:26'),
(36, 'grapes', 'this is a draksh known in gujarati', 16, 16, '1', NULL, NULL, '2024-03-14 10:52:52', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

DROP TABLE IF EXISTS `subcategory`;
CREATE TABLE IF NOT EXISTS `subcategory` (
  `subcategory_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `subcategory_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `status` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `u_user_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`subcategory_id`),
  KEY `subcategory_category_id_foreign` (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`subcategory_id`, `subcategory_name`, `category_id`, `status`, `user_id`, `u_user_id`, `created_at`, `updated_at`) VALUES
(1, 'galya biscuit', 14, 1, NULL, NULL, '2024-03-12 05:08:59', NULL),
(2, 'salty biscuit', 14, 1, NULL, NULL, '2024-03-12 05:25:11', NULL),
(3, 'less sweet biscuits', 14, 1, NULL, NULL, '2024-03-12 05:36:07', NULL),
(4, 'sour', 2, 1, NULL, NULL, '2024-03-12 05:42:20', '2024-03-14 10:32:30'),
(5, 'milk chocolate', 10, 1, NULL, NULL, '2024-03-12 05:44:34', NULL),
(6, 'dark chocolate', 10, 1, NULL, NULL, '2024-03-12 05:44:49', NULL),
(7, 'milk mithai', 3, 1, NULL, NULL, '2024-03-12 05:46:56', NULL),
(8, 'mava mithai', 3, 1, NULL, NULL, '2024-03-12 05:47:07', NULL),
(9, 'spicy biscuit', 14, 1, NULL, NULL, '2024-03-12 05:51:52', NULL),
(10, 'good quality', 11, 1, NULL, NULL, '2024-03-13 23:55:52', '2024-03-14 12:43:13'),
(11, 'bad quality', 11, 1, NULL, NULL, '2024-03-13 23:56:15', '2024-03-14 10:34:59'),
(12, 'spicy snack', 1, 1, NULL, NULL, '2024-03-13 23:58:19', NULL),
(13, 'salty snack', 1, 1, NULL, NULL, '2024-03-13 23:58:51', NULL),
(14, 'wafer biscuit chocolate', 10, 1, NULL, NULL, '2024-03-13 23:59:54', '2024-03-14 04:48:49'),
(15, 'chocolate biscuit', 14, 1, NULL, NULL, '2024-03-14 00:00:36', NULL),
(16, 'sweet grapes', 16, 1, NULL, NULL, '2024-03-14 04:38:05', '2024-03-14 10:32:02'),
(17, 'sour grapes', 16, 1, NULL, NULL, '2024-03-14 04:41:00', '2024-03-14 04:57:51');

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
