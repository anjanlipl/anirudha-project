-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 30, 2019 at 04:05 AM
-- Server version: 5.7.25-0ubuntu0.16.04.2
-- PHP Version: 7.2.13-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toup`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `name`, `created_at`, `updated_at`, `status`) VALUES
(1, 'JUBA', '2019-05-09 01:29:52', '2019-05-09 21:42:34', 1),
(2, 'Safari', '2019-05-09 21:48:04', '2019-05-09 21:48:04', 1),
(3, 'Fargo', '2019-05-11 21:14:54', '2019-05-11 21:14:54', 1),
(4, 'MMI WIRELESS SERVICES', '2019-05-21 19:10:55', '2019-05-21 19:10:55', 1),
(5, 'Yonis account', '2019-05-22 00:30:12', '2019-05-22 00:30:22', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cashs`
--

CREATE TABLE `cashs` (
  `id` int(11) NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `date` date NOT NULL,
  `note` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` int(11) DEFAULT NULL COMMENT '0-in,1-out',
  `created_by` int(11) NOT NULL,
  `account` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cashs`
--

INSERT INTO `cashs` (`id`, `amount`, `date`, `note`, `type`, `created_by`, `account`, `created_at`, `updated_at`) VALUES
(2, '95', '2019-04-29', 'ba', 0, 4, 1, '2019-05-11 00:11:15', '2019-05-11 00:11:15'),
(3, '200', '2019-04-30', NULL, 0, 4, 1, '2019-05-11 00:11:33', '2019-05-11 00:11:33'),
(4, '170', '2019-05-01', NULL, 0, 4, 1, '2019-05-11 00:11:49', '2019-05-11 00:11:49'),
(5, '184', '2019-05-02', NULL, 0, 4, 1, '2019-05-11 00:12:04', '2019-05-11 00:12:04'),
(6, '240', '2019-05-03', NULL, 0, 4, 1, '2019-05-11 00:12:21', '2019-05-11 00:12:21'),
(7, '240', '2019-05-04', NULL, 0, 4, 1, '2019-05-11 00:12:28', '2019-05-11 00:12:28'),
(8, '274', '2019-05-05', NULL, 0, 4, 1, '2019-05-11 00:12:47', '2019-05-11 00:12:47'),
(9, '110', '2019-05-06', NULL, 0, 4, 1, '2019-05-11 00:15:27', '2019-05-11 00:15:27'),
(10, '25', '2019-05-07', NULL, 0, 4, 1, '2019-05-11 00:15:43', '2019-05-11 00:15:43'),
(11, '60', '2019-05-08', NULL, 0, 4, 1, '2019-05-11 00:15:55', '2019-05-11 00:15:55'),
(12, '390', '2019-05-05', 'caasha', 1, 4, 1, '2019-05-11 00:16:49', '2019-05-11 00:16:49'),
(13, '500', '2019-05-05', 'Fadumo', 1, 4, 1, '2019-05-11 00:17:14', '2019-05-11 00:17:14'),
(14, '708', '2019-05-10', 'lacagta waxaa lagu bixiyay kirada', 1, 4, 1, '2019-05-11 00:34:52', '2019-05-11 00:34:52'),
(16, '89', '2019-05-10', NULL, 0, 4, 1, '2019-05-17 05:31:40', '2019-05-17 05:31:40'),
(17, '127', '2019-05-16', '5/12- 5/16', 0, 4, 1, '2019-05-17 05:45:58', '2019-05-17 05:45:58'),
(18, '4', '2019-05-16', NULL, 0, 4, 1, '2019-05-17 05:48:50', '2019-05-17 05:48:50'),
(19, '100', '2019-05-18', 'cash', 0, 4, 1, '2019-05-19 06:06:57', '2019-05-19 06:06:57'),
(20, '320', '2019-05-18', 'cash is taken out for Tax payment by Abdi', 1, 4, 1, '2019-05-19 06:07:38', '2019-05-19 06:07:38'),
(21, '5', '2019-05-19', 'canjeero', 1, 4, 1, '2019-05-20 02:11:10', '2019-05-20 02:11:10'),
(22, '400', '2019-05-21', NULL, 0, 4, 1, '2019-05-21 11:39:02', '2019-05-21 11:39:02'),
(23, '200', '2019-05-21', NULL, 1, 4, 1, '2019-05-21 11:47:08', '2019-05-21 11:47:08'),
(24, '500', '2019-06-20', 'girl', 0, 10, 5, '2019-06-20 15:33:11', '2019-06-20 15:33:11'),
(25, '20', '2019-06-20', 'gg', 1, 10, 5, '2019-06-20 15:33:46', '2019-06-20 15:33:46');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `balance` decimal(10,2) DEFAULT '0.00',
  `account` int(11) NOT NULL,
  `credit_limit` decimal(10,2) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`, `phone`, `address`, `created_by`, `balance`, `account`, `credit_limit`, `created_at`, `updated_at`) VALUES
(1, 'demo customer', '123456', 'abc', 1, '0.00', 1, '300.00', '2019-05-09 08:02:55', '2019-06-24 04:52:18'),
(2, 'Fatuma Ali/ Abdi Muse', '6052515419', NULL, 4, '141.48', 1, '300.00', '2019-05-09 21:03:19', '2019-05-10 20:02:07'),
(3, 'Mama Khalid', '6052158901', NULL, 4, '61.00', 1, '300.00', '2019-05-09 21:11:02', '2019-05-15 23:05:49'),
(4, 'Zeinaba Oromo', '6053608767', NULL, 4, '10.00', 1, '300.00', '2019-05-09 21:11:54', '2019-05-09 21:11:54'),
(5, 'Rumiya oromo', '6052017827', NULL, 4, '81.00', 1, '300.00', '2019-05-09 21:12:42', '2019-05-09 21:13:03'),
(6, 'Nasriya  abdalla', '6052480704', NULL, 4, '72.50', 1, '300.00', '2019-05-09 21:14:40', '2019-05-22 21:07:12'),
(7, 'Najib oromo', '6053708393', NULL, 4, '20.00', 1, '300.00', '2019-05-09 21:16:42', '2019-05-09 21:16:42'),
(8, 'Saciido Abdullahi', '6057289617', NULL, 4, '138.94', 1, '300.00', '2019-05-09 21:17:26', '2019-05-22 21:05:48'),
(9, 'Abdirahman Kafanta', '6059618307', NULL, 4, '19.00', 1, '300.00', '2019-05-09 21:19:27', '2019-05-09 21:19:27'),
(10, 'Fartun Adow', '6059409497', NULL, 4, '85.00', 1, '300.00', '2019-05-09 21:20:53', '2019-05-09 21:20:53'),
(11, 'Nuurto Aden', '6054009161', NULL, 4, '99.86', 1, '300.00', '2019-05-09 21:21:51', '2019-05-15 23:06:46'),
(12, 'Mohamed Ali', '6056791690', NULL, 4, '28.00', 1, '300.00', '2019-05-09 21:22:30', '2019-05-09 21:22:30'),
(13, 'Fatumo Arres', '6053210677', '1911 S west st', 4, '107.00', 1, '300.00', '2019-05-09 21:23:38', '2019-05-21 14:34:55'),
(14, 'Basha Oromo', '6054962398', NULL, 4, '22.00', 1, '300.00', '2019-05-09 21:25:10', '2019-05-09 21:25:10'),
(15, 'Badriya oromo', '6055214837', NULL, 4, '9.00', 1, '300.00', '2019-05-09 21:25:40', '2019-05-09 21:25:40'),
(16, 'luul hoyadey', '6055537867', NULL, 4, '35.00', 1, '300.00', '2019-05-10 16:57:08', '2019-05-10 16:57:08'),
(17, 'zakariya   afkhanistan', '6052121927', NULL, 4, '0.00', 1, '300.00', '2019-05-10 23:11:00', '2019-05-19 01:00:14'),
(18, 'Ifrah Abdi', '6054009056', NULL, 4, '0.00', 1, '300.00', '2019-05-11 19:31:57', '2019-05-11 19:34:17'),
(19, 'sane kunama', '6053238088', NULL, 4, '23.00', 1, '300.00', '2019-05-11 21:21:57', '2019-05-11 21:21:57'),
(20, 'Nasir Abdi', '6053604046', NULL, 4, '0.00', 1, '300.00', '2019-05-12 22:19:48', '2019-05-12 22:23:27'),
(21, 'raaho rople', '6052013654', NULL, 4, '17.00', 1, '300.00', '2019-05-13 00:01:10', '2019-05-13 00:01:10'),
(22, 'Zainab Boku', '6053608767', NULL, 4, '33.00', 1, '300.00', '2019-05-13 23:44:52', '2019-05-13 23:44:52'),
(23, 'Salman', '03320685434', 'House no 333', 4, '20.00', 2, '100.00', '2019-05-20 11:32:11', '2019-05-20 11:32:11'),
(24, 'Fadumo Mohamed Farah', '6053609947', NULL, 4, '24.00', 1, '300.00', '2019-05-21 19:17:29', '2019-05-21 19:17:29'),
(25, 'John Doe', '9187654358', 'lorem ipsum, dolor, sit, amet', 10, '-2401.00', 5, '10000.00', '2019-06-20 11:41:50', '2019-06-20 16:00:36');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('amarathunga.npp@gmail.com', '$2y$10$d4fwBr9iXOLoQ2wrcB2IvOnq4MdpUQY8jK2UF.eMkf7tEQl.Ppv0S', '2019-05-10 10:25:21'),
('shire325@gmail.com', '$2y$10$5Rj9xxAIQ9Pt7Jm7tyRN5OYJDPj7Sp0vGSQJhJLZhmCn.WhpIbC4K', '2019-05-12 02:19:04'),
('kuruurug@hotmail.com', '$2y$10$HFdEgWDddowUPhTZiZ572OYGmxmHAX1AOj/7LNoVpsLyHs/KFF9dK', '2019-05-22 00:11:44'),
('iphonesandsamsungs@hotmail.com', '$2y$10$RaLxV7DrelgagGScF7T16OT2JxAyFXbRWOkYQzZsLL5um6tKXglKK', '2019-05-22 05:31:58');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `date` date NOT NULL,
  `note` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `account` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `amount`, `date`, `note`, `created_by`, `account`, `created_at`, `updated_at`) VALUES
(3, '20', '2019-05-09', 'perfume iyo catar', 4, 1, '2019-05-10 02:34:08', '2019-05-10 02:34:08'),
(5, '5', '2019-05-10', 'boss', 4, 1, '2019-05-10 21:27:41', '2019-05-10 21:27:41'),
(6, '15', '2019-05-10', 'Thermos', 4, 1, '2019-05-10 22:21:07', '2019-05-10 22:21:07'),
(7, '38', '2019-05-10', 'telephon   33   boss  5', 4, 1, '2019-05-11 06:13:14', '2019-05-11 06:13:14'),
(8, '10', '2019-05-11', 'kaar  boss', 4, 1, '2019-05-11 22:44:38', '2019-05-11 22:44:38'),
(10, '10', '2019-05-12', 'uunsi', 4, 1, '2019-05-13 02:50:37', '2019-05-13 02:50:37'),
(11, '4', '2019-05-11', 'caano', 4, 1, '2019-05-13 02:51:39', '2019-05-13 02:51:39'),
(12, '23', '2019-05-12', 'h20 20', 4, 1, '2019-05-13 03:11:40', '2019-05-13 03:11:40'),
(14, '33', '2019-05-12', 'kaar', 4, 1, '2019-05-13 04:33:30', '2019-05-13 04:33:30'),
(15, '5', '2019-05-12', 'boss', 4, 1, '2019-05-13 04:56:07', '2019-05-13 04:56:07'),
(16, '33', '2019-05-15', 'cadar iyo canjeero ethiopian', 4, 1, '2019-05-16 01:58:03', '2019-05-16 01:58:03'),
(17, '4', '2019-05-15', 'kaar', 4, 1, '2019-05-16 02:21:09', '2019-05-16 02:21:09'),
(18, '5', '2019-05-15', 'boss', 4, 1, '2019-05-16 04:38:46', '2019-05-16 04:38:46'),
(19, '10', '2019-05-17', 'Boss', 4, 1, '2019-05-18 03:23:10', '2019-05-18 03:23:10'),
(20, '3', '2019-05-18', 'vegeta', 4, 1, '2019-05-19 00:47:42', '2019-05-19 00:47:42'),
(21, '10', '2019-05-18', 'kaar', 4, 1, '2019-05-19 03:15:04', '2019-05-19 03:15:04'),
(22, '10', '2019-05-18', 'bariis', 4, 1, '2019-05-19 04:10:50', '2019-05-19 04:10:50'),
(23, '30', '2019-05-18', 'Sign Mashallah', 4, 1, '2019-05-19 04:40:20', '2019-05-19 04:40:20'),
(24, '30', '2019-05-18', 'kaar', 4, 1, '2019-05-19 06:01:05', '2019-05-19 06:01:05'),
(25, '4', '2019-05-19', 'sambusa foolyo', 4, 1, '2019-05-20 00:13:28', '2019-05-20 00:13:28'),
(26, '4', '2019-05-19', 'baasto', 4, 1, '2019-05-20 01:39:04', '2019-05-20 01:39:04'),
(27, '11', '2019-05-19', '2 canjeero and iyo foolyo', 4, 1, '2019-05-20 02:09:16', '2019-05-20 02:09:16'),
(28, '11', '2019-05-19', 'baasto iyo marak digaag', 4, 1, '2019-05-20 02:36:49', '2019-05-20 02:36:49'),
(29, '4', '2019-05-19', 'foolyo', 4, 1, '2019-05-20 05:58:29', '2019-05-20 05:58:29'),
(31, '10', '2019-05-20', 'uunsi', 4, 1, '2019-05-20 22:59:41', '2019-05-20 22:59:41'),
(32, '20', '2019-05-20', 'boss revolution iyo timir', 4, 1, '2019-05-21 05:31:47', '2019-05-21 05:31:47'),
(33, '38', '2019-05-20', 'h20 35', 4, 1, '2019-05-21 06:07:45', '2019-05-21 06:07:45'),
(41, '33', '2019-05-21', 'tell', 4, 1, '2019-05-22 04:18:08', '2019-05-22 04:18:08'),
(36, '10', '2019-05-21', 'boss', 4, 1, '2019-05-21 21:24:50', '2019-05-21 21:24:50'),
(37, '5', '2019-05-21', 'catar', 4, 1, '2019-05-21 21:25:06', '2019-05-21 21:25:06'),
(38, '12', '2019-05-21', 'timir', 4, 1, '2019-05-21 21:25:26', '2019-05-21 21:25:26'),
(39, '33', '2019-05-21', 'tell', 4, 1, '2019-05-21 21:59:41', '2019-05-21 21:59:41'),
(40, '27', '2019-05-21', 'ADEEG', 4, 1, '2019-05-21 23:12:18', '2019-05-21 23:12:18');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `date` date NOT NULL,
  `note` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` int(11) DEFAULT NULL COMMENT '0-in,1-out',
  `created_by` int(11) NOT NULL,
  `account` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `customer_id`, `amount`, `date`, `note`, `type`, `created_by`, `account`, `created_at`, `updated_at`) VALUES
(1, 1, '50', '2019-05-09', NULL, 0, 1, 1, '2019-05-09 13:03:14', '2019-05-09 13:03:14'),
(2, 1, '10', '2019-05-09', 'caano', 0, 4, 1, '2019-05-09 16:25:36', '2019-05-09 16:25:36'),
(3, 1, '15', '2019-05-09', NULL, 1, 4, 1, '2019-05-09 16:25:57', '2019-05-09 16:25:57'),
(4, 1, '100', '2019-05-09', NULL, 1, 4, 1, '2019-05-09 16:28:31', '2019-05-09 16:28:31'),
(5, 2, '16', '2019-04-03', NULL, 1, 4, 1, '2019-05-10 02:04:00', '2019-05-10 02:04:00'),
(6, 2, '10', '2019-05-05', 'kaar', 1, 4, 1, '2019-05-10 02:04:38', '2019-05-10 02:04:38'),
(7, 2, '29', '2019-05-08', '2 foolyo, hilib shiishiid, heel iyo qorfo', 1, 4, 1, '2019-05-10 02:05:15', '2019-05-10 02:05:15'),
(8, 5, '33', '2019-05-09', 'telefoon', 1, 4, 1, '2019-05-10 02:13:03', '2019-05-10 02:13:03'),
(9, 6, '11', '2019-05-04', 'malay cabitan', 1, 4, 1, '2019-05-10 02:15:44', '2019-05-10 02:15:44'),
(10, 8, '23', '2019-05-09', 'malaay,  heel iyo qorfo', 1, 4, 1, '2019-05-10 02:18:14', '2019-05-10 02:18:14'),
(11, 1, '305', '2019-05-09', NULL, 0, 4, 1, '2019-05-10 02:27:25', '2019-05-10 02:27:25'),
(12, 1, '201', '2019-05-09', NULL, 1, 4, 1, '2019-05-10 02:29:08', '2019-05-10 02:29:08'),
(13, 1, '210', '2019-05-09', NULL, 0, 4, 1, '2019-05-10 02:30:07', '2019-05-10 02:30:07'),
(14, 1, '9', '2019-05-09', NULL, 1, 4, 1, '2019-05-10 02:30:22', '2019-05-10 02:30:22'),
(15, 1, '301', '2019-05-09', 'moos iyo biyo', 1, 4, 1, '2019-05-10 09:43:24', '2019-05-10 09:43:24'),
(16, 1, '301', '2019-05-09', NULL, 0, 4, 1, '2019-05-10 09:43:40', '2019-05-10 09:43:40'),
(17, 2, '66', '2019-05-10', 'telephone 02', 1, 4, 1, '2019-05-11 01:02:07', '2019-05-11 01:02:07'),
(18, 11, '21', '2019-05-11', 'maraq digaag, vimto iyo foolyo saambuus', 1, 4, 1, '2019-05-12 00:29:48', '2019-05-12 00:29:48'),
(19, 18, '2', '2019-05-11', 'paid', 0, 4, 1, '2019-05-12 00:34:17', '2019-05-12 00:34:17'),
(20, 8, '23', '2019-05-12', 'card lyca mobile', 1, 4, 1, '2019-05-13 03:16:58', '2019-05-13 03:16:58'),
(21, 20, '10', '2019-05-12', 'drinks', 1, 4, 1, '2019-05-13 03:21:26', '2019-05-13 03:21:26'),
(22, 20, '30', '2019-05-12', 'paid', 0, 4, 1, '2019-05-13 03:23:27', '2019-05-13 03:23:27'),
(23, 11, '20', '2019-05-15', 'h2o wireless top up', 1, 4, 1, '2019-05-16 01:51:33', '2019-05-16 01:51:33'),
(24, 8, '18', '2019-05-15', 'malaay', 1, 4, 1, '2019-05-16 02:00:21', '2019-05-16 02:00:21'),
(25, 3, '43', '2019-05-15', 'page plus', 1, 4, 1, '2019-05-16 04:05:49', '2019-05-16 04:05:49'),
(26, 11, '3', '2019-05-15', 'h2o reminder', 1, 4, 1, '2019-05-16 04:06:46', '2019-05-16 04:06:46'),
(27, 17, '20', '2019-05-18', 'paid', 0, 4, 1, '2019-05-19 06:00:14', '2019-05-19 06:00:14'),
(28, 8, '18', '2019-05-20', 'qaxwo banaadir iyo timir', 1, 4, 1, '2019-05-21 05:35:02', '2019-05-21 05:35:02'),
(29, 13, '55', '2019-05-21', NULL, 1, 4, 1, '2019-05-21 19:34:55', '2019-05-21 19:34:55'),
(30, 1, '301', '2019-05-21', NULL, 1, 4, 1, '2019-05-22 02:12:40', '2019-05-22 02:12:40'),
(31, 1, '10', '2019-05-21', NULL, 1, 4, 1, '2019-05-22 02:14:19', '2019-05-22 02:14:19'),
(32, 1, '10', '2019-05-21', NULL, 0, 4, 1, '2019-05-22 02:14:34', '2019-05-22 02:14:34'),
(33, 1, '301', '2019-05-21', '00', 0, 4, 1, '2019-05-22 05:11:54', '2019-05-22 05:11:54'),
(34, 1, '200', '2019-05-21', NULL, 1, 6, 1, '2019-05-22 05:19:53', '2019-05-22 05:19:53'),
(35, 1, '101', '2019-05-21', NULL, 1, 6, 1, '2019-05-22 05:20:15', '2019-05-22 05:20:15'),
(36, 1, '301', '2019-05-21', NULL, 0, 6, 1, '2019-05-22 05:20:30', '2019-05-22 05:20:30'),
(37, 8, '47', '2019-05-22', 'malay  basto cabitan', 1, 6, 1, '2019-05-23 02:05:48', '2019-05-23 02:05:48'),
(38, 6, '31', '2019-05-22', 'malay', 1, 6, 1, '2019-05-23 02:07:12', '2019-05-23 02:07:12'),
(39, 1, '1', '2019-06-17', 'j', 1, 4, 1, '2019-06-17 05:16:11', '2019-06-17 05:16:11'),
(40, 25, '300', '2019-06-20', NULL, 1, 10, 5, '2019-06-20 11:42:15', '2019-06-20 16:00:36'),
(41, 25, '5000', '2019-06-20', NULL, 1, 10, 5, '2019-06-20 11:42:26', '2019-06-20 11:42:26'),
(42, 25, '10000', '2019-06-20', NULL, 0, 10, 5, '2019-06-20 11:53:58', '2019-06-20 11:53:58'),
(43, 25, '340', '2019-06-20', 'Abdira', 1, 10, 5, '2019-06-20 15:59:12', '2019-06-20 15:59:12'),
(44, 25, '15', '2019-06-20', 'yes', 0, 10, 5, '2019-06-20 15:59:37', '2019-06-20 15:59:37'),
(45, 25, '25', '2019-06-20', 'jj', 0, 10, 5, '2019-06-20 15:59:49', '2019-06-20 15:59:49'),
(46, 25, '1', '2019-06-20', NULL, 0, 10, 5, '2019-06-20 15:59:59', '2019-06-20 15:59:59'),
(47, 1, '67', '2019-06-20', NULL, 1, 4, 1, '2019-06-20 16:13:30', '2019-06-20 16:13:30'),
(48, 1, '68', '2019-06-23', 'test', 0, 4, 1, '2019-06-24 04:52:18', '2019-06-24 04:52:18');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `account` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `type` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `account`, `status`, `type`) VALUES
(1, 'Sajith Abeyrathne', 'sajith.smd@gmail.com', '$2y$10$/n3cqxkH0aIfKMsTLQCdyem5pLFXj3wVcFIDqZBLnRA6BZMNZakFq', 'PhDK7IhUBDdTMIkI9aV2LpIYElpOtjzaOGoGdfJOA4Y5yaZDnP2uC7eJcPw8', NULL, '2019-05-22 10:04:50', NULL, 1, 1),
(2, 'Sajith Abeyrathne', 'paypal.sajith@gmail.com', '$2y$10$LXKgIqgS99xQB7jalJRE0edIyYaalgm6Q.qCF3pZg7iwN0WdCQEiC', 'q07gISRMIh9vHg5EFy2ZlZBTppudl9Tk3MRX1JfIxA5QeHQXQIRlRmVFh4ky', '2019-05-09 13:11:10', '2019-05-10 02:31:07', 1, 0, 2),
(3, 'Nadeera', 'amarathunga.npp@gmail.com', '$2y$10$X9WXpITrcN15tp1rIlqY.eo117dRjOXebZK0DSIQxBjjnWNrCudYS', 'pk34wGQFi09VIU010VBl82VkLwqT4su0CPIjhB2NDwM87uUjVPoiMOsGDttv', '2019-05-09 13:19:41', '2019-05-10 02:31:19', 1, 0, 3),
(4, 'Ifrah Abdi', 'ajmaljawab@gmail.com', '$2y$10$APkoW0PkF9Xxzbskv4MH3.e6Pz0vK.1MTxQDSyBTBryZvK23HvQhC', 'aU40lkLk84KGWeZFXFTil20mU7hC5hiVFzfy4rDb9EwcCjnWpTjsITKjW4Wa', NULL, '2019-05-22 05:12:43', NULL, 1, 1),
(5, 'Nassir Abdi', 'firstchoicehomecaresd@gmail.com', '$2y$10$BAsgWvtGBYENjGvgBpXGJutQ5Q8PJLRwxQ6PHdgb.TeCg6Vyu/dUq', 'qHubLNurXspNhDwwYs844wyTVve7yStE8isrgUE7OqkyGBXQEg6Ete5632CZ', '2019-05-09 16:18:32', '2019-05-18 04:03:25', 1, 1, 2),
(6, 'Mohamed Ali', 'jubarestaurantsd@gmail.com', '$2y$10$T.P4Ci4itfyqe1.Vyo9SI..j16ZdMuf6E8tb0ZFZZ88mCxSsBESU.', 'oUUyoljHSWUsFoTJN2Mrs270UzO3fBg5sgmXmNM8ACghH5d71eUlCQqgtEwv', '2019-05-10 02:37:53', '2019-05-22 05:16:29', 1, 1, 2),
(7, 'Kaahiye fargo', 'shire325@gmail.com', '$2y$10$hiNMZWmteUZTjhDPfoXUx./8HD.oMBnxmJ9IZzmD/Mhw6kT85miUm', NULL, '2019-05-12 02:19:04', '2019-05-12 02:19:04', 3, 1, 2),
(8, 'Mohamud Deerow', 'kuruurug@hotmail.com', '$2y$10$RdGypLaX5grpvdMDaJkhCeAbLwCLRvfpUjzbL6Mho.tt4Z3Hk1lvm', NULL, '2019-05-22 00:11:43', '2019-05-22 00:11:43', 4, 1, 2),
(9, 'caasho garatay', 'mhhsoffice@gmail.com', '$2y$10$Dnmfmojzr4CSQVQ9kWRjVexDQLTjHn485rmXR1ah7xjLYckRLsf7G', 'C2HxrZDp9SRkGtNuxIKxzYfyY1MGFhKtUlWuQJmFlzew9kqNaZDWPMPw4GmC', '2019-05-22 05:13:50', '2019-05-22 05:14:56', 3, 1, 2),
(10, 'Demo employee', 'kifaayo2018@gmail.com', '$2y$10$7LzibUL9xQhEthBeydA49uUfnGcDqfrChGAdiCgJDv9lUcOYr1YIu', 'Y6Dw9AqOlOta6TbTuryO95SnuRJNtPnA2vH9CforjIpOY1KOXDopXdwTflGq', '2019-05-22 05:31:20', '2019-05-22 05:33:52', 5, 1, 2),
(11, 'Yonis', 'iphonesandsamsungs@hotmail.com', '$2y$10$cwbq1/mKGCjhBZcdTOh6Pu4IKi6KldE9j1urdNMJxQ7Kqt1JuYyNO', NULL, '2019-05-22 05:31:58', '2019-05-22 05:31:58', 5, 1, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cashs`
--
ALTER TABLE `cashs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `cashs`
--
ALTER TABLE `cashs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
