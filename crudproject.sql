-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 06, 2024 at 01:14 PM
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
  `category_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `u_user_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `status`, `user_id`, `u_user_id`, `created_at`, `updated_at`) VALUES
(1, 'snacks', '1', NULL, NULL, '2024-03-08 05:30:10', '2024-04-25 13:24:30'),
(2, 'cold drink', '1', NULL, NULL, '2024-03-08 05:48:02', NULL),
(3, 'sweet', '1', NULL, NULL, '2024-03-08 05:49:08', NULL),
(11, 'vegetables', '1', NULL, NULL, '2024-03-08 06:02:27', NULL),
(10, 'chocolates', '1', NULL, NULL, '2024-03-08 06:01:45', '2024-03-09 02:11:04'),
(15, 'bakery', '1', NULL, NULL, '2024-03-09 01:57:26', '2024-03-09 02:10:14'),
(14, 'biscuits', '1', NULL, NULL, '2024-03-08 06:18:39', '2024-03-09 02:09:56'),
(16, 'fruit', '1', NULL, NULL, '2024-03-14 04:36:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `form`
--

DROP TABLE IF EXISTS `form`;
CREATE TABLE IF NOT EXISTS `form` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `middle_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `form`
--

INSERT INTO `form` (`id`, `first_name`, `middle_name`, `last_name`, `created_at`, `updated_at`) VALUES
(1, 'solanki', 'yash', 'bhai', '2024-04-25 05:55:15', '2024-04-25 12:25:54'),
(2, 'solanki', 'milan', 'bhai', '2024-04-25 06:03:14', '2024-04-25 06:03:29'),
(3, 'fname', 'mname', 'lname', '2024-04-25 06:15:00', '2024-04-25 06:16:12'),
(4, 'first name', 'middle name', 'last name', '2024-04-25 06:17:17', '2024-04-25 06:17:34'),
(5, 'namwe', 'namw', NULL, '2024-04-25 06:17:50', '2024-04-25 06:18:16'),
(6, 'solanki', 'yash', 'kumar', '2024-04-25 06:27:48', '2024-04-25 06:28:05'),
(7, 'yash', 'solanki', 'yash', '2024-04-25 06:28:18', '2024-04-25 06:29:19'),
(8, 'yash', 'surthar', 'lasrname', '2024-04-25 06:31:29', '2024-04-25 06:31:45'),
(9, 'patel', 'prince', 'kumar', '2024-04-25 06:44:26', '2024-04-25 06:44:46'),
(10, NULL, 'product', NULL, '2024-04-25 06:48:42', '2024-04-25 06:49:09'),
(11, NULL, NULL, NULL, '2024-04-25 07:28:28', '2024-04-25 07:28:49'),
(12, 'yash', 'sooanki', 'rdsfds', '2024-04-25 08:57:19', '2024-04-25 08:57:28'),
(13, 'yash', NULL, NULL, '2024-04-25 08:58:25', NULL),
(14, 'Dropdown', NULL, NULL, '2024-04-25 08:59:35', NULL),
(15, 'Dropdown', NULL, NULL, '2024-04-25 08:59:55', '2024-04-25 09:00:19'),
(16, 'Form', NULL, NULL, '2024-04-25 09:00:38', '2024-04-25 09:01:02'),
(17, 'as', 'sa', NULL, '2024-04-25 09:01:43', '2024-04-25 09:01:48'),
(18, 'as', 'sa', 'sa', '2024-04-25 09:01:54', '2024-04-25 09:02:06'),
(19, 'Form', 'Form', NULL, '2024-04-25 09:04:10', NULL),
(20, 'Form', 'Form', 'Form', '2024-04-25 09:05:04', '2024-04-25 09:05:14'),
(21, NULL, NULL, NULL, '2024-04-25 09:05:59', '2024-04-25 09:06:22'),
(22, 'yash', 'solankui', 'r', '2024-04-25 12:20:42', '2024-04-25 12:20:46'),
(23, 'solanki', NULL, NULL, '2024-04-25 12:21:07', NULL),
(24, 'solanki', 'yash', NULL, '2024-04-25 12:21:36', NULL),
(25, 'solanki', 'yashs', 'kumar', '2024-04-25 12:22:05', NULL),
(26, 'solanki', 'yash', 'bhai', '2024-04-25 12:26:35', '2024-04-25 12:26:48'),
(27, 'suthar', 'yash', 'kumar', '2024-04-25 12:55:39', '2024-04-25 12:55:59'),
(28, 'yash', 'kumar', 'solanki', '2024-04-26 11:33:32', '2024-04-26 11:34:27'),
(29, 'kumar', 'yash', 'solanki', '2024-04-26 11:35:49', '2024-04-26 11:36:00'),
(30, 'yash', 'bhai', 'solanki', '2024-04-26 11:36:17', NULL),
(31, 'yash', 'kumar', NULL, '2024-04-29 12:53:16', '2024-04-29 12:53:21'),
(32, 'yash', 'kumarf', NULL, '2024-04-29 12:53:33', NULL),
(33, 'yash', 'kumar', 'bhai', '2024-04-29 12:53:57', NULL),
(34, 'yash', 'bhai', 'kumar', '2024-04-29 12:54:09', '2024-04-29 12:54:12'),
(35, 'yash', 'bhai', 'kumar', '2024-04-29 12:54:31', '2024-04-29 12:54:52');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2024_03_08_101712_create_product_table', 1),
(3, '2024_03_08_102116_create_category_table', 2),
(4, '2024_03_08_121611_add_category_id_to_product', 3),
(8, '2024_03_12_085231_create_subcategory_table', 4),
(9, '2024_04_24_151045_create_form_table', 5);

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
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `prod_name`, `prod_desc`, `subcategory_id`, `category_id`, `status`, `user_id`, `u_user_id`, `created_at`, `updated_at`) VALUES
(1, 'parle g updated', 'desc updated', 1, 14, '1', NULL, NULL, '2024-03-08 06:26:28', '2024-05-02 10:53:41'),
(2, 'monaco', 'desc updated', 2, 14, '1', NULL, NULL, '2024-03-08 06:26:57', '2024-05-02 10:53:41'),
(3, 'crack jack', 'desc updating', 3, 14, '1', NULL, NULL, '2024-03-08 06:30:09', '2024-05-02 10:49:22'),
(4, 'kaju katri', 'desc updated', 7, 3, '1', NULL, NULL, '2024-03-08 06:30:58', '2024-05-02 10:49:22'),
(5, 'peda', 'desc updated', 8, 3, '1', NULL, NULL, '2024-03-08 06:50:15', '2024-05-02 10:52:15'),
(6, 'fanta updated', 'desc updated', 4, 2, '1', NULL, NULL, '2024-03-08 06:50:26', '2024-05-02 10:52:15'),
(7, 'mazza', 'desc updated', 4, 2, '1', NULL, NULL, '2024-03-08 06:50:32', '2024-05-02 10:07:36'),
(8, 'cabbage', 'desc', 10, 11, '1', NULL, NULL, '2024-03-08 06:50:42', '2024-05-02 10:07:36'),
(9, 'chataka pataka', 'desc', 12, 1, '1', NULL, NULL, '2024-03-08 06:50:55', '2024-05-02 10:08:03'),
(10, 'wafer', 'desc', 13, 1, '1', NULL, NULL, '2024-03-08 06:51:04', '2024-05-02 10:08:03'),
(11, 'pop rings', 'description', 12, 1, '1', NULL, NULL, '2024-03-08 06:51:16', '2024-05-02 10:08:46'),
(12, 'dairy milk', 'desc', 5, 10, '1', NULL, NULL, '2024-03-08 06:51:24', '2024-05-02 10:08:46'),
(13, 'munch', 'description', 14, 10, '1', NULL, NULL, '2024-03-08 06:51:33', '2024-05-02 10:09:21'),
(14, 'perk', 'desc', 14, 10, '1', NULL, NULL, '2024-03-08 06:51:40', '2024-05-02 10:09:21'),
(15, 'happy happy', 'desc', 14, 14, '1', NULL, NULL, '2024-03-09 00:50:58', '2024-05-02 10:09:36'),
(16, 'kit kat', 'desc updated', 5, 10, '1', NULL, NULL, '2024-03-09 00:52:55', '2024-05-02 10:09:36'),
(17, 'pav', 'pav description', NULL, 15, '0', NULL, NULL, '2024-03-09 01:57:48', '2024-05-02 10:17:28'),
(18, 'bread', 'bread description', NULL, 15, '0', NULL, NULL, '2024-03-09 01:58:02', '2024-05-02 10:17:40'),
(19, 'parle g', 'asdf', 6, 1, '1', NULL, NULL, '2024-03-11 05:56:40', '2024-05-02 10:10:14'),
(20, 'crack jack', 'asfa', 9, 2, '1', NULL, NULL, '2024-03-11 05:59:10', '2024-03-14 00:01:43'),
(21, 'parle g updated', 'sdaf', 1, 14, '1', NULL, NULL, '2024-03-11 06:00:10', '2024-05-02 10:10:14'),
(22, 'kaju katri', 'sdf', 9, 1, '1', NULL, NULL, '2024-03-11 06:13:21', '2024-03-14 00:01:46'),
(23, 'peda', 'seryre', 8, 3, '0', NULL, NULL, '2024-03-11 06:13:44', '2024-05-02 10:55:03'),
(24, 'monaco', 'sd', 5, 10, '0', NULL, NULL, '2024-03-11 06:14:07', '2024-05-02 10:55:03'),
(25, 'ds', 'ds', 2, 1, '0', NULL, NULL, '2024-03-11 06:14:26', '2024-05-02 10:55:03'),
(26, 'fanta', 'zds', 4, 2, '0', NULL, NULL, '2024-03-11 06:53:45', '2024-05-02 10:55:03'),
(27, 'wafer', 'super salty and crunchy wafers', 12, 1, '1', NULL, NULL, '2024-03-11 07:11:28', '2024-05-02 10:10:22'),
(28, 'parle g updated', 'desc updating', 5, 14, '1', NULL, NULL, '2024-03-11 07:37:50', '2024-05-02 10:10:22'),
(29, 'parle', 'desc updating', 4, 1, '1', NULL, NULL, '2024-03-11 07:42:41', '2024-03-14 00:57:17'),
(30, 'parle sort', 'desc updating', 3, 14, '1', NULL, NULL, '2024-03-11 07:43:02', '2024-03-14 00:57:08'),
(31, 'monaco', 'aa biscuit che', 2, 14, '0', NULL, NULL, '2024-03-11 23:59:32', '2024-03-14 00:56:59'),
(33, 'parle g', 'this is a biscuit', 1, 14, '1', NULL, NULL, '2024-03-13 00:32:59', '2024-03-14 00:56:40'),
(34, 'parle g', 'ef', 1, 14, '1', NULL, NULL, '2024-03-13 02:32:01', '2024-05-02 10:01:04'),
(35, 'parle g', 'ef', 1, 14, '0', NULL, NULL, '2024-03-13 02:32:01', '2024-05-02 10:54:14'),
(36, 'grapes', 'this is a draksh known in gujarati', 16, 16, '1', NULL, NULL, '2024-03-14 10:52:52', '2024-04-29 10:14:40'),
(37, 'mango', 'famous of talala gir', 16, 16, '1', NULL, NULL, '2024-03-20 10:18:32', '2024-04-29 13:21:08'),
(38, 'sample', 'sample', 17, 16, '0', NULL, NULL, '2024-04-29 11:46:52', '2024-04-29 11:47:37');

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

DROP TABLE IF EXISTS `subcategory`;
CREATE TABLE IF NOT EXISTS `subcategory` (
  `subcategory_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `subcategory_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
(16, 'sweet', 16, 1, NULL, NULL, '2024-03-14 04:38:05', '2024-03-20 10:18:40'),
(17, 'sour', 16, 1, NULL, NULL, '2024-03-14 04:41:00', '2024-03-20 10:18:45');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
