-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 30, 2019 at 04:04 AM
-- Server version: 5.7.25-0ubuntu0.16.04.2
-- PHP Version: 7.2.13-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `insh`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `address1` text NOT NULL,
  `address2` text NOT NULL,
  `address3` text NOT NULL,
  `landmark` varchar(255) NOT NULL,
  `locality_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `pincode` int(11) NOT NULL,
  `main` int(11) NOT NULL DEFAULT '0',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `user_id`, `address1`, `address2`, `address3`, `landmark`, `locality_id`, `city_id`, `pincode`, `main`, `updated_at`, `created_at`) VALUES
(7, 1, '311, 6th Avenue', 'Shree Vihar', 'Damana', 'Indian Oil Office', 2, 1, 751024, 0, '2017-11-28 13:55:40', '2017-11-28 13:55:40'),
(27, 1, '102, Kailsah Dham', 'Dimna Road', 'Mango', 'MGM Medical College', 2, 1, 831018, 0, '2017-12-13 23:08:44', '2017-12-13 23:08:44'),
(28, 1, 'Test Test', 'Line', 'Add3', 'JH', 1, 1, 831018, 0, '2017-12-23 21:55:10', '2017-12-14 01:30:00'),
(29, 1, 'Test Test', 'Line2', 'Line3', 'JH', 1, 1, 831018, 0, '2018-01-09 03:31:52', '2018-01-09 03:31:52'),
(30, 1, 'Test Test', 'Line2', 'Line3', 'JH', 1, 1, 831018, 0, '2018-01-09 03:31:53', '2018-01-09 03:31:53'),
(31, 1, 'Test Test', 'Line2', 'Line3', 'JH', 1, 1, 831018, 0, '2018-01-09 03:54:42', '2018-01-09 03:54:42'),
(32, 1, 'Test Test', 'sdsad', 'sdgfdfgdfc', 'JH', 1, 1, 831018, 0, '2018-01-09 03:59:19', '2018-01-09 03:59:19'),
(33, 1, 'Test Test', 'sdsad', 'sdgfdfgdfc', 'JH', 1, 1, 831018, 0, '2018-01-09 04:26:10', '2018-01-09 04:26:10'),
(34, 1, 'Test Test', 'sdsad', 'sdgfdfgdfc', 'JH', 1, 1, 831018, 0, '2018-01-09 04:26:10', '2018-01-09 04:26:10'),
(35, 1, 'Test Test', 'sdsad', 'sdgfdfgdfc', 'JH', 1, 1, 831018, 0, '2018-01-09 04:26:10', '2018-01-09 04:26:10'),
(36, 1, 'Test Test', 'sdsad', 'sdgfdfgdfc', 'JH', 1, 1, 831018, 0, '2018-01-09 04:26:11', '2018-01-09 04:26:11'),
(37, 1, 'Test Test', 'sdsad', 'sdgfdfgdfc', 'JH', 1, 1, 831018, 0, '2018-01-09 04:26:11', '2018-01-09 04:26:11'),
(38, 1, 'Test Test', 'sdsad', 'sdgfdfgdfc', 'JH', 1, 1, 831018, 0, '2018-01-09 04:47:01', '2018-01-09 04:47:01'),
(39, 1, 'Test Test', 'Line2', 'Line3', 'JH', 1, 1, 831018, 0, '2018-01-15 04:22:12', '2018-01-15 04:22:12'),
(40, 1, '311, 6th Avenue', 'test', 'Khurda', 'Odisha', 1, 1, 721024, 0, '2018-09-15 03:35:02', '2018-09-15 03:35:02');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT '1',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `parent` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`id`, `name`, `slug`, `parent`, `updated_at`, `created_at`) VALUES
(1, 'Bhubaneswar', 'bhubaneswar', 1, '2017-12-23 06:39:39', '2017-12-23 06:39:39'),
(2, 'Jamshedpur', 'jamshedpur', 2, '2017-12-23 06:39:39', '2017-12-23 06:39:39'),
(3, 'Sydney', 'sydney', 3, '2018-01-09 03:28:41', '2018-01-09 03:28:41');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `name`, `updated_at`, `created_at`) VALUES
(1, 'India', '2017-12-24 03:27:43', '2017-12-24 08:57:29'),
(2, 'Australia', '2018-01-09 08:58:15', '2018-01-09 08:58:15'),
(3, '', '2018-07-18 06:00:22', '2018-07-18 06:00:22');

-- --------------------------------------------------------

--
-- Table structure for table `data_rows`
--

CREATE TABLE `data_rows` (
  `id` int(10) UNSIGNED NOT NULL,
  `data_type_id` int(10) UNSIGNED NOT NULL,
  `field` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `required` tinyint(1) NOT NULL DEFAULT '0',
  `browse` tinyint(1) NOT NULL DEFAULT '1',
  `read` tinyint(1) NOT NULL DEFAULT '1',
  `edit` tinyint(1) NOT NULL DEFAULT '1',
  `add` tinyint(1) NOT NULL DEFAULT '1',
  `delete` tinyint(1) NOT NULL DEFAULT '1',
  `details` text COLLATE utf8mb4_unicode_ci,
  `order` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `data_rows`
--

INSERT INTO `data_rows` (`id`, `data_type_id`, `field`, `type`, `display_name`, `required`, `browse`, `read`, `edit`, `add`, `delete`, `details`, `order`) VALUES
(1, 1, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, '', 1),
(2, 1, 'author_id', 'text', 'Author', 1, 0, 1, 1, 0, 1, '', 2),
(3, 1, 'category_id', 'text', 'Category', 1, 0, 1, 1, 1, 0, '', 3),
(4, 1, 'title', 'text', 'Title', 1, 1, 1, 1, 1, 1, '', 4),
(5, 1, 'excerpt', 'text_area', 'excerpt', 1, 0, 1, 1, 1, 1, '', 5),
(6, 1, 'body', 'rich_text_box', 'Body', 1, 0, 1, 1, 1, 1, '', 6),
(7, 1, 'image', 'image', 'Post Image', 0, 1, 1, 1, 1, 1, '{"resize":{"width":"1000","height":"null"},"quality":"70%","upsize":true,"thumbnails":[{"name":"medium","scale":"50%"},{"name":"small","scale":"25%"},{"name":"cropped","crop":{"width":"300","height":"250"}}]}', 7),
(8, 1, 'slug', 'text', 'slug', 1, 0, 1, 1, 1, 1, '{"slugify":{"origin":"title","forceUpdate":true}}', 8),
(9, 1, 'meta_description', 'text_area', 'meta_description', 1, 0, 1, 1, 1, 1, '', 9),
(10, 1, 'meta_keywords', 'text_area', 'meta_keywords', 1, 0, 1, 1, 1, 1, '', 10),
(11, 1, 'status', 'select_dropdown', 'status', 1, 1, 1, 1, 1, 1, '{"default":"DRAFT","options":{"PUBLISHED":"published","DRAFT":"draft","PENDING":"pending"}}', 11),
(12, 1, 'created_at', 'timestamp', 'created_at', 0, 1, 1, 0, 0, 0, '', 12),
(13, 1, 'updated_at', 'timestamp', 'updated_at', 0, 0, 0, 0, 0, 0, '', 13),
(14, 2, 'id', 'number', 'id', 1, 0, 0, 0, 0, 0, '', 1),
(15, 2, 'author_id', 'text', 'author_id', 1, 0, 0, 0, 0, 0, '', 2),
(16, 2, 'title', 'text', 'title', 1, 1, 1, 1, 1, 1, '', 3),
(17, 2, 'excerpt', 'text_area', 'excerpt', 1, 0, 1, 1, 1, 1, '', 4),
(18, 2, 'body', 'rich_text_box', 'body', 1, 0, 1, 1, 1, 1, '', 5),
(19, 2, 'slug', 'text', 'slug', 1, 0, 1, 1, 1, 1, '{"slugify":{"origin":"title"}}', 6),
(20, 2, 'meta_description', 'text', 'meta_description', 1, 0, 1, 1, 1, 1, '', 7),
(21, 2, 'meta_keywords', 'text', 'meta_keywords', 1, 0, 1, 1, 1, 1, '', 8),
(22, 2, 'status', 'select_dropdown', 'status', 1, 1, 1, 1, 1, 1, '{"default":"INACTIVE","options":{"INACTIVE":"INACTIVE","ACTIVE":"ACTIVE"}}', 9),
(23, 2, 'created_at', 'timestamp', 'created_at', 1, 1, 1, 0, 0, 0, '', 10),
(24, 2, 'updated_at', 'timestamp', 'updated_at', 1, 0, 0, 0, 0, 0, '', 11),
(25, 2, 'image', 'image', 'image', 0, 1, 1, 1, 1, 1, '', 12),
(26, 3, 'id', 'number', 'id', 1, 0, 0, 0, 0, 0, '', 1),
(27, 3, 'name', 'text', 'name', 1, 1, 1, 1, 1, 1, '', 2),
(28, 3, 'email', 'text', 'email', 1, 1, 1, 1, 1, 1, '', 3),
(29, 3, 'password', 'password', 'password', 0, 0, 0, 1, 1, 0, '', 4),
(30, 3, 'user_belongsto_role_relationship', 'relationship', 'Role', 0, 1, 1, 1, 1, 0, '{"model":"TCG\\\\Voyager\\\\Models\\\\Role","table":"roles","type":"belongsTo","column":"role_id","key":"id","label":"name","pivot_table":"roles","pivot":"0"}', 10),
(31, 3, 'remember_token', 'text', 'remember_token', 0, 0, 0, 0, 0, 0, '', 5),
(32, 3, 'created_at', 'timestamp', 'created_at', 0, 1, 1, 0, 0, 0, '', 6),
(33, 3, 'updated_at', 'timestamp', 'updated_at', 0, 0, 0, 0, 0, 0, '', 7),
(34, 3, 'avatar', 'image', 'avatar', 0, 1, 1, 1, 1, 1, '', 8),
(35, 5, 'id', 'number', 'id', 1, 0, 0, 0, 0, 0, '', 1),
(36, 5, 'name', 'text', 'name', 1, 1, 1, 1, 1, 1, '', 2),
(37, 5, 'created_at', 'timestamp', 'created_at', 0, 0, 0, 0, 0, 0, '', 3),
(38, 5, 'updated_at', 'timestamp', 'updated_at', 0, 0, 0, 0, 0, 0, '', 4),
(39, 4, 'id', 'number', 'id', 1, 0, 0, 0, 0, 0, NULL, 1),
(40, 4, 'parent_id', 'select_dropdown', 'parent_id', 0, 0, 1, 1, 1, 1, '{"default":"","null":"","options":{"":"-- None --"},"relationship":{"key":"id","label":"name"}}', 2),
(41, 4, 'order', 'text', 'order', 1, 1, 1, 1, 1, 1, '{"default":1}', 3),
(42, 4, 'name', 'text', 'name', 1, 1, 1, 1, 1, 1, NULL, 4),
(43, 4, 'slug', 'text', 'slug', 1, 1, 1, 1, 1, 1, '{"slugify":{"origin":"name"}}', 5),
(44, 4, 'created_at', 'timestamp', 'created_at', 0, 0, 0, 0, 0, 0, NULL, 6),
(45, 4, 'updated_at', 'timestamp', 'updated_at', 0, 0, 0, 0, 0, 0, NULL, 7),
(46, 6, 'id', 'number', 'id', 1, 0, 0, 0, 0, 0, '', 1),
(47, 6, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, '', 2),
(48, 6, 'created_at', 'timestamp', 'created_at', 0, 0, 0, 0, 0, 0, '', 3),
(49, 6, 'updated_at', 'timestamp', 'updated_at', 0, 0, 0, 0, 0, 0, '', 4),
(50, 6, 'display_name', 'text', 'Display Name', 1, 1, 1, 1, 1, 1, '', 5),
(51, 1, 'seo_title', 'text', 'seo_title', 0, 1, 1, 1, 1, 1, '', 14),
(52, 1, 'featured', 'checkbox', 'featured', 1, 1, 1, 1, 1, 1, '', 15),
(53, 3, 'role_id', 'text', 'role_id', 1, 1, 1, 1, 1, 1, '', 9),
(54, 10, 'id', 'checkbox', 'Id', 1, 0, 0, 0, 0, 0, NULL, 1),
(55, 10, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, NULL, 2),
(56, 12, 'id', 'number', 'Id', 1, 0, 0, 0, 0, 0, NULL, 1),
(57, 12, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, NULL, 2),
(58, 12, 'slug', 'text', 'Slug', 1, 1, 1, 1, 1, 1, NULL, 3),
(59, 12, 'default_locality', 'checkbox', 'Default Locality', 1, 0, 0, 0, 0, 0, NULL, 4),
(60, 12, 'parent', 'select_dropdown', 'Parent', 1, 1, 1, 1, 1, 1, NULL, 5),
(61, 12, 'updated_at', 'timestamp', 'Updated At', 1, 0, 0, 0, 0, 0, NULL, 6),
(62, 12, 'created_at', 'timestamp', 'Created At', 1, 1, 1, 1, 0, 1, NULL, 7),
(63, 13, 'id', 'checkbox', 'Id', 1, 0, 0, 0, 0, 0, NULL, 1),
(64, 13, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, NULL, 2),
(65, 13, 'brand_id', 'select_dropdown', 'Brand', 1, 1, 1, 1, 1, 1, '{"default":"","null":"","option":{"":"-- None --"},"relationship":{"key":"id","label":"name"}}', 3),
(66, 13, 'category', 'select_dropdown', 'Category', 1, 1, 1, 1, 1, 1, '{"default":"","null":"","option":{"":"-- None --"},"relationship":{"key":"id","label":"name"}}', 4),
(67, 13, 'qty', 'number', 'Quantity', 1, 1, 1, 1, 1, 1, NULL, 5),
(68, 13, 'qty_unit', 'select_dropdown', 'Unit', 1, 1, 1, 1, 1, 1, '{"default":"","null":"","options":{"":"-- None --"},"relationship":{"key":"id","label":"name"}}', 6),
(69, 13, 'has_description', 'checkbox', 'Has Description', 1, 1, 1, 1, 1, 1, NULL, 7),
(70, 13, 'slug', 'text', 'Slug', 1, 1, 1, 1, 1, 1, '{"slugify":{"origin":"name"}}', 8),
(72, 10, 'created_at', 'timestamp', 'Created At', 1, 1, 1, 1, 0, 1, NULL, 3),
(73, 10, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, NULL, 4),
(77, 13, 'updated_at', 'timestamp', 'Updated At', 1, 0, 0, 0, 0, 0, NULL, 9),
(78, 13, 'created_at', 'timestamp', 'Created At', 1, 1, 1, 1, 0, 1, NULL, 10),
(80, 13, 'product_belongsto_product_category_relationship', 'relationship', 'product_category', 0, 1, 1, 1, 1, 1, '{"model":"App\\\\ProductCategory","table":"product_category","type":"belongsTo","column":"category","key":"id","label":"name","pivot_table":"addresses","pivot":"0"}', 12),
(81, 13, 'product_belongsto_qty_unit_relationship', 'relationship', 'qty_units', 0, 1, 1, 1, 1, 1, '{"model":"App\\\\QtyUnits","table":"qty_units","type":"belongsTo","column":"qty_unit","key":"id","label":"name","pivot_table":"addresses","pivot":"0"}', 13),
(82, 12, 'city_belongsto_state_relationship', 'relationship', 'state', 0, 1, 1, 1, 1, 1, '{"model":"App\\\\State","table":"state","type":"belongsTo","column":"parent","key":"id","label":"name","pivot_table":"addresses","pivot":"0"}', 8),
(83, 13, 'product_belongsto_product_brand_relationship', 'relationship', 'product_brands', 0, 1, 1, 1, 1, 1, '{"model":"App\\\\ProductBrand","table":"product_brands","type":"belongsTo","column":"brand_id","key":"id","label":"name","pivot_table":"addresses","pivot":"0"}', 14),
(84, 14, 'id', 'checkbox', 'Id', 1, 0, 0, 0, 0, 0, NULL, 1),
(85, 14, 'user_id', 'select_dropdown', 'User Id', 1, 1, 1, 1, 1, 1, '{"default":"","null":"","option":{"":"-- None --"},"relationship":{"key":"id","label":"name"}}', 2),
(86, 14, 'address1', 'text', 'Address1', 1, 1, 1, 1, 1, 1, NULL, 3),
(87, 14, 'address2', 'text', 'Address2', 1, 1, 1, 1, 1, 1, NULL, 4),
(88, 14, 'address3', 'text', 'Address3', 1, 1, 1, 1, 1, 1, NULL, 5),
(89, 14, 'landmark', 'text', 'Landmark', 1, 1, 1, 1, 1, 1, NULL, 6),
(90, 14, 'locality_id', 'select_dropdown', 'Locality Id', 1, 1, 1, 1, 1, 1, '{"default":"","null":"","option":{"":"-- None --"},"relationship":{"key":"id","label":"name"}}', 7),
(91, 14, 'city_id', 'select_dropdown', 'City Id', 1, 1, 1, 1, 1, 1, '{"default":"","null":"","option":{"":"-- None --"},"relationship":{"key":"id","label":"name"}}', 8),
(92, 14, 'pincode', 'text', 'Pincode', 1, 1, 1, 1, 1, 1, NULL, 9),
(93, 14, 'main', 'checkbox', 'Main', 1, 0, 0, 0, 0, 0, NULL, 10),
(94, 14, 'updated_at', 'timestamp', 'Updated At', 1, 0, 0, 0, 0, 0, NULL, 11),
(95, 14, 'created_at', 'timestamp', 'Created At', 1, 1, 1, 1, 0, 1, NULL, 12),
(96, 14, 'address_belongsto_user_relationship', 'relationship', 'users', 0, 1, 1, 1, 1, 1, '{"model":"App\\\\User","table":"users","type":"belongsTo","column":"user_id","key":"id","label":"name","pivot_table":"addresses","pivot":"0"}', 13),
(97, 14, 'address_belongsto_locality_relationship', 'relationship', 'localities', 0, 1, 1, 1, 1, 1, '{"model":"App\\\\Locality","table":"localities","type":"belongsTo","column":"locality_id","key":"id","label":"name","pivot_table":"addresses","pivot":"0"}', 14),
(98, 14, 'address_belongsto_city_relationship', 'relationship', 'city', 0, 1, 1, 1, 1, 1, '{"model":"App\\\\City","table":"city","type":"belongsTo","column":"city_id","key":"id","label":"name","pivot_table":"addresses","pivot":"0"}', 15),
(99, 16, 'id', 'checkbox', 'Id', 1, 0, 0, 0, 0, 0, NULL, 1),
(100, 16, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, NULL, 2),
(101, 17, 'id', 'checkbox', 'Id', 1, 0, 0, 0, 0, 0, NULL, 1),
(102, 17, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, NULL, 2),
(103, 17, 'slug', 'text', 'Slug', 1, 1, 1, 1, 1, 1, '{"slugify":{"origin":"name"}}', 3),
(104, 17, 'parent', 'select_dropdown', 'Parent', 1, 1, 1, 1, 1, 1, '{"default":"","null":"","options":{"":"-- None --"},"relationship":{"key":"id","label":"name"}}', 4),
(105, 17, 'locality_belongsto_city_relationship', 'relationship', 'city', 0, 1, 1, 1, 1, 1, '{"model":"App\\\\City","table":"city","type":"belongsTo","column":"parent","key":"id","label":"name","pivot_table":"addresses","pivot":"0"}', 5),
(108, 19, 'id', 'checkbox', 'Id', 1, 0, 0, 0, 0, 0, NULL, 1),
(109, 19, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, NULL, 2),
(110, 19, 'updated_at', 'checkbox', 'Updated At', 0, 0, 0, 0, 0, 0, NULL, 3),
(111, 19, 'created_at', 'checkbox', 'Created At', 0, 0, 0, 0, 0, 0, NULL, 4),
(112, 22, 'id', 'checkbox', 'Id', 1, 0, 0, 0, 0, 0, NULL, 1),
(113, 22, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, NULL, 2),
(114, 22, 'short_form', 'text', 'Short Form', 1, 1, 1, 1, 1, 1, NULL, 3),
(115, 22, 'plural_name', 'text', 'Plural Name', 1, 1, 1, 1, 1, 1, NULL, 4),
(116, 22, 'plural_short_form', 'text', 'Plural Short Form', 1, 1, 1, 1, 1, 1, NULL, 5),
(117, 22, 'updated_at', 'checkbox', 'Updated At', 1, 0, 0, 0, 0, 0, NULL, 6),
(118, 22, 'created_at', 'checkbox', 'Created At', 1, 0, 0, 0, 0, 0, NULL, 7),
(119, 23, 'id', 'checkbox', 'Id', 1, 0, 0, 0, 0, 0, NULL, 1),
(120, 23, 'category_name', 'text', 'Category Name', 1, 1, 1, 1, 1, 1, NULL, 2),
(121, 23, 'description', 'text', 'Description', 1, 1, 1, 1, 1, 1, NULL, 3),
(122, 23, 'slug', 'text', 'Slug', 1, 1, 1, 1, 1, 1, '{"slugify":{"origin":"name"}}', 4),
(123, 23, 'updated_at', 'checkbox', 'Updated At', 1, 0, 0, 0, 0, 0, NULL, 5),
(124, 23, 'created_at', 'checkbox', 'Created At', 1, 0, 0, 0, 0, 0, NULL, 6),
(125, 24, 'id', 'checkbox', 'Id', 1, 0, 0, 0, 0, 0, NULL, 1),
(126, 24, 'shop_id', 'select_dropdown', 'Shop Id', 1, 1, 1, 1, 1, 1, '{"default":"","null":"","options":{"":"-- None --"},"relationship":{"key":"id","label":"name"}}', 2),
(127, 24, 'locality_id', 'select_dropdown', 'Locality Id', 1, 1, 1, 1, 1, 1, '{"default":"","null":"","options":{"":"-- None --"},"relationship":{"key":"id","label":"name"}}', 3),
(128, 24, 'updated_at', 'checkbox', 'Updated At', 1, 0, 0, 0, 0, 0, NULL, 4),
(129, 24, 'created_at', 'checkbox', 'Created At', 1, 0, 0, 0, 0, 0, NULL, 5),
(130, 24, 'shop_delivers_to_belongsto_shop_relationship', 'relationship', 'shops', 0, 1, 1, 1, 1, 1, '{"model":"App\\\\Shops","table":"shops","type":"belongsTo","column":"shop_id","key":"id","label":"name","pivot_table":"addresses","pivot":"0"}', 6),
(131, 24, 'shop_delivers_to_belongsto_locality_relationship', 'relationship', 'localities', 0, 1, 1, 1, 1, 1, '{"model":"App\\\\Locality","table":"localities","type":"belongsTo","column":"locality_id","key":"id","label":"name","pivot_table":"addresses","pivot":"0"}', 7),
(138, 26, 'id', 'checkbox', 'Id', 1, 0, 0, 0, 0, 0, NULL, 1),
(139, 26, 'shop_id', 'select_dropdown', 'Shop Id', 1, 1, 1, 1, 1, 1, '{"default":"","null":"","option":{"":"-- None --"},"relationship":{"key":"id","label":"name"}}', 2),
(140, 26, 'product_id', 'select_dropdown', 'Product Id', 1, 1, 1, 1, 1, 1, '{"default":"","null":"","option":{"":"-- None --"},"relationship":{"key":"id","label":"name"}}', 3),
(141, 26, 'mrp', 'number', 'Mrp', 1, 1, 1, 1, 1, 1, NULL, 4),
(142, 26, 'cp', 'number', 'Cp', 1, 1, 1, 1, 1, 1, NULL, 5),
(143, 26, 'sp', 'number', 'Sp', 1, 1, 1, 1, 1, 1, NULL, 6),
(144, 26, 'updated_at', 'checkbox', 'Updated At', 1, 0, 0, 0, 0, 0, NULL, 7),
(145, 26, 'created_at', 'checkbox', 'Created At', 1, 0, 0, 0, 0, 0, NULL, 8),
(146, 26, 'shop_product_belongsto_product_relationship', 'relationship', 'products', 0, 1, 1, 1, 1, 1, '{"model":"App\\\\Product","table":"products","type":"belongsTo","column":"product_id","key":"id","label":"name","pivot_table":"addresses","pivot":"0"}', 9),
(147, 26, 'shop_product_belongsto_shop_relationship', 'relationship', 'shops', 0, 1, 1, 1, 1, 1, '{"model":"App\\\\Shops","table":"shops","type":"belongsTo","column":"shop_id","key":"id","label":"name","pivot_table":"addresses","pivot":"0"}', 10),
(148, 27, 'id', 'checkbox', 'Id', 1, 0, 0, 0, 0, 0, NULL, 1),
(149, 27, 'shop_id', 'select_dropdown', 'Shop Id', 1, 1, 1, 1, 1, 1, '{"default":"","null":"","option":{"":"-- None --"},"relationship":{"key":"id","label":"name"}}', 2),
(150, 27, 'start', 'text', 'Start', 1, 1, 1, 1, 1, 1, NULL, 3),
(151, 27, 'end', 'text', 'End', 1, 1, 1, 1, 1, 1, NULL, 4),
(152, 27, 'break_start', 'text', 'Break Start', 1, 1, 1, 1, 1, 1, NULL, 5),
(153, 27, 'break_end', 'text', 'Break End', 1, 1, 1, 1, 1, 1, NULL, 6),
(154, 27, 'updated_at', 'checkbox', 'Updated At', 1, 0, 0, 0, 0, 0, NULL, 7),
(155, 27, 'created_at', 'checkbox', 'Created At', 1, 0, 0, 0, 0, 0, NULL, 8),
(156, 27, 'shop_timing_belongsto_shop_relationship', 'relationship', 'shops', 0, 1, 1, 1, 1, 1, '{"model":"App\\\\Shops","table":"shops","type":"belongsTo","column":"shop_id","key":"id","label":"name","pivot_table":"addresses","pivot":"0"}', 9),
(157, 28, 'id', 'checkbox', 'Id', 1, 0, 0, 0, 0, 0, NULL, 1),
(158, 28, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, NULL, 2),
(159, 28, 'address', 'text_area', 'Address', 1, 1, 1, 1, 1, 1, NULL, 3),
(160, 28, 'city_id', 'select_dropdown', 'City Id', 1, 1, 1, 1, 1, 1, '{"default":"","null":"","option":{"":"-- None --"},"relationship":{"key":"id","label":"name"}}', 4),
(161, 28, 'locality_id', 'select_dropdown', 'Locality Id', 1, 1, 1, 1, 1, 1, '{"default":"","null":"","option":{"":"-- None --"},"relationship":{"key":"id","label":"name"}}', 5),
(162, 28, 'cat_id', 'select_dropdown', 'Cat Id', 1, 1, 1, 1, 1, 1, '{"default":"","null":"","option":{"":"-- None --"},"relationship":{"key":"id","label":"category_name"}}', 6),
(163, 28, 'total_sale', 'text', 'Total Sale', 1, 1, 1, 1, 1, 1, NULL, 7),
(164, 28, 'slug', 'text', 'Slug', 1, 1, 1, 1, 1, 1, '{"slugify":{"origin":"name"}}', 8),
(165, 28, 'type', 'number', 'Type', 1, 1, 1, 1, 1, 1, NULL, 9),
(166, 28, 'delivery_charges', 'number', 'Delivery Charges', 1, 1, 1, 1, 1, 1, NULL, 10),
(167, 28, 'shop_closed_on', 'text', 'Shop Closed On', 1, 1, 1, 1, 1, 1, NULL, 11),
(168, 28, 'updated_at', 'checkbox', 'Updated At', 1, 0, 0, 0, 0, 0, NULL, 12),
(169, 28, 'created_at', 'checkbox', 'Created At', 1, 0, 0, 0, 0, 0, NULL, 13),
(170, 28, 'shop_belongsto_city_relationship', 'relationship', 'city', 0, 1, 1, 1, 1, 1, '{"model":"App\\\\City","table":"city","type":"belongsTo","column":"city_id","key":"id","label":"name","pivot_table":"addresses","pivot":"0"}', 14),
(171, 28, 'shop_belongsto_locality_relationship', 'relationship', 'localities', 0, 1, 1, 1, 1, 1, '{"model":"App\\\\Locality","table":"localities","type":"belongsTo","column":"locality_id","key":"id","label":"name","pivot_table":"addresses","pivot":"0"}', 15),
(172, 28, 'shop_belongsto_shop_category_relationship', 'relationship', 'shop_category', 0, 1, 1, 1, 1, 1, '{"model":"App\\\\ShopCategory","table":"shop_category","type":"belongsTo","column":"cat_id","key":"id","label":"category_name","pivot_table":"addresses","pivot":"0"}', 16),
(173, 29, 'id', 'checkbox', 'Id', 1, 0, 0, 0, 0, 0, NULL, 1),
(174, 29, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, NULL, 2),
(175, 29, 'parent', 'select_dropdown', 'Parent', 1, 1, 1, 1, 1, 1, '{"default":"","null":"","option":{"":"-- None --"},"relationship":{"key":"id","label":"name"}}', 3),
(176, 29, 'updated_at', 'checkbox', 'Updated At', 1, 0, 0, 0, 0, 0, NULL, 4),
(177, 29, 'created_at', 'checkbox', 'Created At', 1, 0, 0, 0, 0, 0, NULL, 5),
(178, 29, 'state_belongsto_country_relationship', 'relationship', 'country', 0, 1, 1, 1, 1, 1, '{"model":"App\\\\Country","table":"country","type":"belongsTo","column":"parent","key":"id","label":"name","pivot_table":"addresses","pivot":"0"}', 6),
(179, 30, 'id', 'checkbox', 'Id', 1, 0, 0, 0, 0, 0, NULL, 1),
(180, 30, 'begin_slot', 'text', 'Begin Slot', 1, 1, 1, 1, 1, 1, NULL, 2),
(181, 30, 'end_slot', 'text', 'End Slot', 1, 1, 1, 1, 1, 1, NULL, 3),
(182, 30, 'updated_at', 'checkbox', 'Updated At', 1, 0, 0, 0, 0, 0, NULL, 4),
(183, 30, 'created_at', 'checkbox', 'Created At', 1, 0, 0, 0, 0, 0, NULL, 5),
(184, 31, 'id', 'checkbox', 'Id', 1, 0, 0, 0, 0, 0, NULL, 1),
(185, 31, 'product_id', 'select_dropdown', 'Product Id', 1, 1, 1, 1, 1, 1, '{"default":"","null":"","option":{"":"-- None --"},"relationship":{"key":"id","label":"name"}}', 2),
(186, 31, 'filename', 'text', 'Filename', 1, 1, 1, 1, 1, 1, NULL, 3),
(187, 31, 'cover', 'checkbox', 'Cover', 1, 1, 1, 1, 1, 1, NULL, 4),
(188, 31, 'updated_at', 'checkbox', 'Updated At', 1, 0, 0, 0, 0, 0, NULL, 5),
(189, 31, 'created_at', 'checkbox', 'Created At', 1, 0, 0, 0, 0, 0, NULL, 6),
(190, 31, 'product_img_belongsto_product_relationship', 'relationship', 'products', 0, 1, 1, 1, 1, 1, '{"model":"App\\\\Product","table":"products","type":"belongsTo","column":"product_id","key":"id","label":"name","pivot_table":"addresses","pivot":"0"}', 7),
(191, 32, 'id', 'checkbox', 'Id', 1, 0, 0, 0, 0, 0, NULL, 1),
(192, 32, 'shop_id', 'select_dropdown', 'Shop Id', 1, 1, 1, 1, 1, 1, '{"default":"","null":"","option":{"":"-- None --"},"relationship":{"key":"id","label":"name"}}', 2),
(193, 32, 'filename', 'text', 'Filename', 1, 1, 1, 1, 1, 1, NULL, 3),
(194, 32, 'cover', 'checkbox', 'Cover', 1, 1, 1, 1, 1, 1, NULL, 4),
(195, 32, 'updated_at', 'checkbox', 'Updated At', 1, 0, 0, 0, 0, 0, NULL, 5),
(196, 32, 'created_at', 'checkbox', 'Created At', 1, 0, 0, 0, 0, 0, NULL, 6),
(197, 32, 'shop_img_belongsto_shop_relationship', 'relationship', 'shops', 0, 1, 1, 1, 1, 1, '{"model":"App\\\\Shops","table":"shops","type":"belongsTo","column":"shop_id","key":"id","label":"name","pivot_table":"addresses","pivot":"0"}', 7);

-- --------------------------------------------------------

--
-- Table structure for table `data_types`
--

CREATE TABLE `data_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name_singular` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name_plural` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `policy_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `controller` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `generate_permissions` tinyint(1) NOT NULL DEFAULT '0',
  `server_side` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `data_types`
--

INSERT INTO `data_types` (`id`, `name`, `slug`, `display_name_singular`, `display_name_plural`, `icon`, `model_name`, `policy_name`, `controller`, `description`, `generate_permissions`, `server_side`, `created_at`, `updated_at`) VALUES
(1, 'posts', 'posts', 'Post', 'Posts', 'voyager-news', 'TCG\\Voyager\\Models\\Post', 'TCG\\Voyager\\Policies\\PostPolicy', '', '', 1, 0, '2017-12-23 00:43:12', '2017-12-23 00:43:12'),
(2, 'pages', 'pages', 'Page', 'Pages', 'voyager-file-text', 'TCG\\Voyager\\Models\\Page', NULL, '', '', 1, 0, '2017-12-23 00:43:12', '2017-12-23 00:43:12'),
(3, 'users', 'users', 'User', 'Users', 'voyager-person', 'TCG\\Voyager\\Models\\User', 'TCG\\Voyager\\Policies\\UserPolicy', '', '', 1, 0, '2017-12-23 00:43:12', '2017-12-23 00:43:12'),
(4, 'categories', 'categories', 'Category', 'Categories', 'voyager-categories', 'TCG\\Voyager\\Models\\Category', NULL, NULL, NULL, 1, 0, '2017-12-23 00:43:12', '2017-12-23 21:59:49'),
(5, 'menus', 'menus', 'Menu', 'Menus', 'voyager-list', 'TCG\\Voyager\\Models\\Menu', NULL, '', '', 1, 0, '2017-12-23 00:43:12', '2017-12-23 00:43:12'),
(6, 'roles', 'roles', 'Role', 'Roles', 'voyager-lock', 'TCG\\Voyager\\Models\\Role', NULL, '', '', 1, 0, '2017-12-23 00:43:12', '2017-12-23 00:43:12'),
(10, 'product_category', 'product-category', 'Product Category', 'Product Categories', NULL, 'App\\ProductCategory', NULL, NULL, NULL, 1, 1, '2017-12-23 01:07:29', '2017-12-23 01:07:29'),
(12, 'city', 'city', 'City', 'Cities', NULL, 'App\\City', NULL, NULL, NULL, 1, 0, '2017-12-23 01:11:24', '2017-12-23 01:11:24'),
(13, 'products', 'products', 'Product', 'Products', NULL, 'App\\Product', NULL, NULL, NULL, 1, 1, '2017-12-23 01:17:15', '2017-12-23 01:17:15'),
(14, 'addresses', 'addresses', 'Address', 'Addresses', NULL, 'App\\Address', NULL, NULL, NULL, 1, 0, '2017-12-23 21:48:39', '2017-12-23 21:48:39'),
(16, 'country', 'country', 'Country', 'Countries', NULL, 'App\\Country', NULL, NULL, NULL, 1, 0, '2017-12-23 21:56:32', '2017-12-23 21:56:32'),
(17, 'localities', 'localities', 'Locality', 'Localities', NULL, 'App\\Locality', NULL, NULL, NULL, 1, 0, '2017-12-23 21:59:13', '2017-12-23 21:59:13'),
(19, 'product_brands', 'product-brands', 'Product Brand', 'Product Brands', NULL, 'App\\ProductBrand', NULL, NULL, NULL, 1, 0, '2017-12-23 22:04:09', '2017-12-23 22:04:09'),
(22, 'qty_units', 'qty-units', 'Qty Unit', 'Qty Units', NULL, 'App\\QtyUnits', NULL, NULL, NULL, 1, 0, '2017-12-23 22:23:34', '2017-12-23 22:23:34'),
(23, 'shop_category', 'shop-category', 'Shop Category', 'Shop Categories', NULL, 'App\\ShopCategory', NULL, NULL, NULL, 1, 0, '2017-12-23 22:26:40', '2017-12-23 22:26:40'),
(24, 'shop_delivers_to', 'shop-delivers-to', 'Shop Delivers To', 'Shop Delivers Tos', NULL, 'App\\ShopDelivery', NULL, NULL, NULL, 1, 0, '2017-12-23 22:29:37', '2017-12-23 22:29:37'),
(26, 'shop_products', 'shop-products', 'Shop Product', 'Shop Products', NULL, 'App\\ShopProduct', NULL, NULL, NULL, 1, 0, '2017-12-23 22:38:09', '2017-12-23 22:38:09'),
(27, 'shop_timings', 'shop-timings', 'Shop Timing', 'Shop Timings', NULL, 'App\\ShopTiming', NULL, NULL, NULL, 1, 0, '2017-12-23 22:44:09', '2017-12-23 22:44:09'),
(28, 'shops', 'shops', 'Shop', 'Shops', NULL, 'App\\Shops', NULL, NULL, NULL, 1, 0, '2017-12-23 22:48:54', '2017-12-23 22:48:54'),
(29, 'state', 'state', 'State', 'States', NULL, 'App\\State', NULL, NULL, NULL, 1, 0, '2017-12-23 22:55:01', '2017-12-23 22:55:01'),
(30, 'time_slots', 'time-slots', 'Time Slot', 'Time Slots', NULL, 'App\\TimeSlot', NULL, NULL, NULL, 1, 0, '2017-12-23 22:59:11', '2017-12-23 22:59:11'),
(31, 'product_imgs', 'product-imgs', 'Product Img', 'Product Imgs', NULL, 'App\\ProductImg', NULL, NULL, NULL, 1, 0, '2017-12-23 23:03:09', '2017-12-23 23:03:09'),
(32, 'shop_imgs', 'shop-imgs', 'Shop Img', 'Shop Imgs', NULL, 'App\\ShopImg', NULL, NULL, NULL, 1, 0, '2017-12-23 23:06:48', '2017-12-23 23:06:48');

-- --------------------------------------------------------

--
-- Table structure for table `localities`
--

CREATE TABLE `localities` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `parent` int(11) NOT NULL,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `localities`
--

INSERT INTO `localities` (`id`, `name`, `slug`, `parent`, `updated_at`, `created_at`) VALUES
(1, 'Patia', 'patia', 1, '2017-12-24 03:31:46', '2017-12-24 09:00:37'),
(2, 'Damana', 'damana', 1, '2017-12-24 09:00:37', '2017-12-24 09:00:37'),
(3, 'Chandrasekharpur', 'chandrasekharpur', 1, '2017-12-24 09:00:37', '2017-12-24 09:00:37'),
(4, 'Jaydev Vihar', 'jaydev-vihar', 1, '2017-12-24 09:00:37', '2017-12-24 09:00:37'),
(5, 'New Street', 'new-street', 3, '2018-01-09 08:59:38', '2018-01-09 08:59:38');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `log_msg` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2017-12-23 00:43:14', '2017-12-23 00:43:14');

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

CREATE TABLE `menu_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `menu_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `target` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '_self',
  `icon_class` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `order` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `route` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parameters` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu_items`
--

INSERT INTO `menu_items` (`id`, `menu_id`, `title`, `url`, `target`, `icon_class`, `color`, `parent_id`, `order`, `created_at`, `updated_at`, `route`, `parameters`) VALUES
(1, 1, 'Dashboard', '', '_self', 'voyager-boat', NULL, NULL, 1, '2017-12-23 00:43:14', '2017-12-23 00:43:14', 'voyager.dashboard', NULL),
(2, 1, 'Media', '', '_self', 'voyager-images', NULL, NULL, 7, '2017-12-23 00:43:14', '2017-12-23 02:38:25', 'voyager.media.index', NULL),
(3, 1, 'Posts', '', '_self', 'voyager-news', NULL, NULL, 8, '2017-12-23 00:43:14', '2017-12-23 02:38:25', 'voyager.posts.index', NULL),
(4, 1, 'Users', '', '_self', 'voyager-person', NULL, NULL, 6, '2017-12-23 00:43:15', '2017-12-23 02:38:25', 'voyager.users.index', NULL),
(5, 1, 'Categories', '', '_self', 'voyager-categories', NULL, NULL, 3, '2017-12-23 00:43:15', '2017-12-23 02:38:25', 'voyager.categories.index', NULL),
(6, 1, 'Pages', '', '_self', 'voyager-file-text', NULL, NULL, 9, '2017-12-23 00:43:15', '2017-12-23 02:38:25', 'voyager.pages.index', NULL),
(7, 1, 'Roles', '', '_self', 'voyager-lock', NULL, NULL, 5, '2017-12-23 00:43:15', '2017-12-23 02:38:25', 'voyager.roles.index', NULL),
(8, 1, 'Tools', '', '_self', 'voyager-tools', NULL, NULL, 10, '2017-12-23 00:43:15', '2017-12-23 02:38:25', NULL, NULL),
(9, 1, 'Menu Builder', '', '_self', 'voyager-list', NULL, 8, 1, '2017-12-23 00:43:15', '2017-12-23 02:22:13', 'voyager.menus.index', NULL),
(10, 1, 'Database', '', '_self', 'voyager-data', NULL, 8, 2, '2017-12-23 00:43:15', '2017-12-23 02:22:13', 'voyager.database.index', NULL),
(11, 1, 'Compass', '', '_self', 'voyager-compass', NULL, 8, 3, '2017-12-23 00:43:15', '2017-12-23 02:22:13', 'voyager.compass.index', NULL),
(12, 1, 'Hooks', '', '_self', 'voyager-hook', NULL, 8, 4, '2017-12-23 00:43:15', '2017-12-23 02:22:13', 'voyager.hooks', NULL),
(13, 1, 'Settings', '', '_self', 'voyager-settings', NULL, NULL, 11, '2017-12-23 00:43:15', '2017-12-23 02:38:25', 'voyager.settings.index', NULL),
(14, 1, 'Product Categories', '/admin/product-category', '_self', NULL, NULL, 17, 2, '2017-12-23 01:07:29', '2017-12-23 02:38:24', NULL, NULL),
(15, 1, 'Cities', '/admin/city', '_self', 'voyager-location', '#ffffff', 18, 1, '2017-12-23 01:11:24', '2017-12-23 02:38:25', NULL, ''),
(16, 1, 'All Products', '/admin/products', '_self', NULL, '#000000', 17, 1, '2017-12-23 01:17:15', '2017-12-23 02:28:35', NULL, ''),
(17, 1, 'Products', '', '_self', 'voyager-archive', '#000000', NULL, 4, '2017-12-23 02:28:05', '2017-12-23 02:38:25', NULL, ''),
(18, 1, 'Locations', '', '_self', 'voyager-location', '#000000', NULL, 2, '2017-12-23 02:38:09', '2017-12-23 02:38:24', NULL, ''),
(19, 1, 'Addresses', '/admin/addresses', '_self', NULL, NULL, NULL, 12, '2017-12-23 21:48:39', '2017-12-23 21:48:39', NULL, NULL),
(20, 1, 'Countries', '/admin/country', '_self', NULL, NULL, NULL, 13, '2017-12-23 21:56:33', '2017-12-23 21:56:33', NULL, NULL),
(21, 1, 'Localities', '/admin/localities', '_self', NULL, NULL, NULL, 14, '2017-12-23 21:59:13', '2017-12-23 21:59:13', NULL, NULL),
(22, 1, 'Product Brands', '/admin/product-brands', '_self', NULL, NULL, NULL, 15, '2017-12-23 22:04:09', '2017-12-23 22:04:09', NULL, NULL),
(23, 1, 'Qty Units', '/admin/qty-units', '_self', NULL, NULL, NULL, 16, '2017-12-23 22:23:34', '2017-12-23 22:23:34', NULL, NULL),
(24, 1, 'Shop Categories', '/admin/shop-category', '_self', NULL, NULL, NULL, 17, '2017-12-23 22:26:40', '2017-12-23 22:26:40', NULL, NULL),
(25, 1, 'Shop Delivers Tos', '/admin/shop-delivers-to', '_self', NULL, NULL, NULL, 18, '2017-12-23 22:29:37', '2017-12-23 22:29:37', NULL, NULL),
(26, 1, 'Shop Products', '/admin/shop-products', '_self', NULL, NULL, NULL, 19, '2017-12-23 22:38:09', '2017-12-23 22:38:09', NULL, NULL),
(27, 1, 'Shop Timings', '/admin/shop-timings', '_self', NULL, NULL, NULL, 20, '2017-12-23 22:44:09', '2017-12-23 22:44:09', NULL, NULL),
(28, 1, 'Shops', '/admin/shops', '_self', NULL, NULL, NULL, 21, '2017-12-23 22:48:54', '2017-12-23 22:48:54', NULL, NULL),
(29, 1, 'States', '/admin/state', '_self', NULL, NULL, NULL, 22, '2017-12-23 22:55:01', '2017-12-23 22:55:01', NULL, NULL),
(30, 1, 'Time Slots', '/admin/time-slots', '_self', NULL, NULL, NULL, 23, '2017-12-23 22:59:11', '2017-12-23 22:59:11', NULL, NULL),
(31, 1, 'Product Imgs', '/admin/product-imgs', '_self', NULL, NULL, NULL, 24, '2017-12-23 23:03:10', '2017-12-23 23:03:10', NULL, NULL),
(32, 1, 'Shop Imgs', '/admin/shop-imgs', '_self', NULL, NULL, NULL, 25, '2017-12-23 23:06:49', '2017-12-23 23:06:49', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2017_12_11_185516_create_addresses_table', 0),
(4, '2017_12_11_185516_create_city_table', 0),
(5, '2017_12_11_185516_create_country_table', 0),
(6, '2017_12_11_185516_create_localities_table', 0),
(7, '2017_12_11_185516_create_orders_table', 0),
(8, '2017_12_11_185516_create_password_resets_table', 0),
(9, '2017_12_11_185516_create_product_brands_table', 0),
(10, '2017_12_11_185516_create_product_category_table', 0),
(11, '2017_12_11_185516_create_product_imgs_table', 0),
(12, '2017_12_11_185516_create_products_table', 0),
(13, '2017_12_11_185516_create_qty_units_table', 0),
(14, '2017_12_11_185516_create_shop_category_table', 0),
(15, '2017_12_11_185516_create_shop_delivers_to_table', 0),
(16, '2017_12_11_185516_create_shop_imgs_table', 0),
(17, '2017_12_11_185516_create_shop_order_content_table', 0),
(18, '2017_12_11_185516_create_shop_products_table', 0),
(19, '2017_12_11_185516_create_shop_rating_replies_table', 0),
(20, '2017_12_11_185516_create_shop_ratings_table', 0),
(21, '2017_12_11_185516_create_shop_timings_table', 0),
(22, '2017_12_11_185516_create_shops_table', 0),
(23, '2017_12_11_185516_create_state_table', 0),
(24, '2017_12_11_185516_create_time_slots_table', 0),
(25, '2017_12_11_185516_create_users_table', 0),
(26, '2016_01_01_000000_add_voyager_user_fields', 2),
(27, '2016_01_01_000000_create_data_types_table', 2),
(28, '2016_01_01_000000_create_pages_table', 2),
(29, '2016_01_01_000000_create_posts_table', 2),
(30, '2016_02_15_204651_create_categories_table', 2),
(31, '2016_05_19_173453_create_menu_table', 2),
(32, '2016_10_21_190000_create_roles_table', 2),
(33, '2016_10_21_190000_create_settings_table', 2),
(34, '2016_11_30_135954_create_permission_table', 2),
(35, '2016_11_30_141208_create_permission_role_table', 2),
(36, '2016_12_26_201236_data_types__add__server_side', 2),
(37, '2017_01_13_000000_add_route_to_menu_items_table', 2),
(38, '2017_01_14_005015_create_translations_table', 2),
(39, '2017_01_15_000000_add_permission_group_id_to_permissions_table', 2),
(40, '2017_01_15_000000_create_permission_groups_table', 2),
(41, '2017_01_15_000000_make_table_name_nullable_in_permissions_table', 2),
(42, '2017_03_06_000000_add_controller_to_data_types_table', 2),
(43, '2017_04_11_000000_alter_post_nullable_fields_table', 2),
(44, '2017_04_21_000000_add_order_to_data_rows_table', 2),
(45, '2017_07_05_210000_add_policyname_to_data_types_table', 2),
(46, '2017_08_05_000000_add_group_to_settings_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `transaction_id` text,
  `fullname` varchar(255) NOT NULL,
  `phn` bigint(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `address_id` int(11) NOT NULL,
  `del_type` int(11) NOT NULL,
  `date` date NOT NULL,
  `time_slot` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `transaction_id`, `fullname`, `phn`, `user_id`, `address_id`, `del_type`, `date`, `time_slot`, `updated_at`, `created_at`) VALUES
(5, '736457846', 'Nishant', 9439416692, 1, 7, 1, '2017-12-02', 3, '2017-11-28 13:55:40', '2017-11-28 13:55:40'),
(6, '356969750', 'Test Test', 9439416692, 1, 38, 1, '2018-01-31', 3, '2018-01-09 04:47:01', '2018-01-09 04:47:01'),
(7, '266577811', 'Nishant', 9439416692, 1, 39, 1, '2018-01-25', 4, '2018-01-15 04:22:13', '2018-01-15 04:22:13'),
(8, '661985834', 'Nishant Kumar', 1234567890, 1, 40, 1, '2018-09-19', 1, '2018-09-15 03:35:02', '2018-09-15 03:35:02');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `author_id` int(11) NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `excerpt` text COLLATE utf8mb4_unicode_ci,
  `body` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci,
  `status` enum('ACTIVE','INACTIVE') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'INACTIVE',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('nishant6639@gmail.com', '$2y$10$bZT/RHVl7b12WGpsxRnahOEFwmmthga1jsD/lMiIb4SZoUi4Sx1bW', '2018-01-08 22:59:43');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `table_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `permission_group_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `key`, `table_name`, `created_at`, `updated_at`, `permission_group_id`) VALUES
(1, 'browse_admin', NULL, '2017-12-23 00:43:15', '2017-12-23 00:43:15', NULL),
(2, 'browse_database', NULL, '2017-12-23 00:43:15', '2017-12-23 00:43:15', NULL),
(3, 'browse_media', NULL, '2017-12-23 00:43:15', '2017-12-23 00:43:15', NULL),
(4, 'browse_compass', NULL, '2017-12-23 00:43:15', '2017-12-23 00:43:15', NULL),
(5, 'browse_menus', 'menus', '2017-12-23 00:43:15', '2017-12-23 00:43:15', NULL),
(6, 'read_menus', 'menus', '2017-12-23 00:43:15', '2017-12-23 00:43:15', NULL),
(7, 'edit_menus', 'menus', '2017-12-23 00:43:15', '2017-12-23 00:43:15', NULL),
(8, 'add_menus', 'menus', '2017-12-23 00:43:15', '2017-12-23 00:43:15', NULL),
(9, 'delete_menus', 'menus', '2017-12-23 00:43:16', '2017-12-23 00:43:16', NULL),
(10, 'browse_pages', 'pages', '2017-12-23 00:43:16', '2017-12-23 00:43:16', NULL),
(11, 'read_pages', 'pages', '2017-12-23 00:43:16', '2017-12-23 00:43:16', NULL),
(12, 'edit_pages', 'pages', '2017-12-23 00:43:16', '2017-12-23 00:43:16', NULL),
(13, 'add_pages', 'pages', '2017-12-23 00:43:16', '2017-12-23 00:43:16', NULL),
(14, 'delete_pages', 'pages', '2017-12-23 00:43:16', '2017-12-23 00:43:16', NULL),
(15, 'browse_roles', 'roles', '2017-12-23 00:43:16', '2017-12-23 00:43:16', NULL),
(16, 'read_roles', 'roles', '2017-12-23 00:43:16', '2017-12-23 00:43:16', NULL),
(17, 'edit_roles', 'roles', '2017-12-23 00:43:16', '2017-12-23 00:43:16', NULL),
(18, 'add_roles', 'roles', '2017-12-23 00:43:16', '2017-12-23 00:43:16', NULL),
(19, 'delete_roles', 'roles', '2017-12-23 00:43:16', '2017-12-23 00:43:16', NULL),
(20, 'browse_users', 'users', '2017-12-23 00:43:16', '2017-12-23 00:43:16', NULL),
(21, 'read_users', 'users', '2017-12-23 00:43:16', '2017-12-23 00:43:16', NULL),
(22, 'edit_users', 'users', '2017-12-23 00:43:16', '2017-12-23 00:43:16', NULL),
(23, 'add_users', 'users', '2017-12-23 00:43:16', '2017-12-23 00:43:16', NULL),
(24, 'delete_users', 'users', '2017-12-23 00:43:16', '2017-12-23 00:43:16', NULL),
(25, 'browse_posts', 'posts', '2017-12-23 00:43:16', '2017-12-23 00:43:16', NULL),
(26, 'read_posts', 'posts', '2017-12-23 00:43:16', '2017-12-23 00:43:16', NULL),
(27, 'edit_posts', 'posts', '2017-12-23 00:43:16', '2017-12-23 00:43:16', NULL),
(28, 'add_posts', 'posts', '2017-12-23 00:43:16', '2017-12-23 00:43:16', NULL),
(29, 'delete_posts', 'posts', '2017-12-23 00:43:16', '2017-12-23 00:43:16', NULL),
(30, 'browse_categories', 'categories', '2017-12-23 00:43:16', '2017-12-23 00:43:16', NULL),
(31, 'read_categories', 'categories', '2017-12-23 00:43:17', '2017-12-23 00:43:17', NULL),
(32, 'edit_categories', 'categories', '2017-12-23 00:43:17', '2017-12-23 00:43:17', NULL),
(33, 'add_categories', 'categories', '2017-12-23 00:43:17', '2017-12-23 00:43:17', NULL),
(34, 'delete_categories', 'categories', '2017-12-23 00:43:17', '2017-12-23 00:43:17', NULL),
(35, 'browse_settings', 'settings', '2017-12-23 00:43:17', '2017-12-23 00:43:17', NULL),
(36, 'read_settings', 'settings', '2017-12-23 00:43:17', '2017-12-23 00:43:17', NULL),
(37, 'edit_settings', 'settings', '2017-12-23 00:43:17', '2017-12-23 00:43:17', NULL),
(38, 'add_settings', 'settings', '2017-12-23 00:43:17', '2017-12-23 00:43:17', NULL),
(39, 'delete_settings', 'settings', '2017-12-23 00:43:17', '2017-12-23 00:43:17', NULL),
(40, 'browse_product_category', 'product_category', '2017-12-23 01:07:29', '2017-12-23 01:07:29', NULL),
(41, 'read_product_category', 'product_category', '2017-12-23 01:07:29', '2017-12-23 01:07:29', NULL),
(42, 'edit_product_category', 'product_category', '2017-12-23 01:07:29', '2017-12-23 01:07:29', NULL),
(43, 'add_product_category', 'product_category', '2017-12-23 01:07:29', '2017-12-23 01:07:29', NULL),
(44, 'delete_product_category', 'product_category', '2017-12-23 01:07:29', '2017-12-23 01:07:29', NULL),
(45, 'browse_city', 'city', '2017-12-23 01:11:24', '2017-12-23 01:11:24', NULL),
(46, 'read_city', 'city', '2017-12-23 01:11:24', '2017-12-23 01:11:24', NULL),
(47, 'edit_city', 'city', '2017-12-23 01:11:24', '2017-12-23 01:11:24', NULL),
(48, 'add_city', 'city', '2017-12-23 01:11:24', '2017-12-23 01:11:24', NULL),
(49, 'delete_city', 'city', '2017-12-23 01:11:24', '2017-12-23 01:11:24', NULL),
(50, 'browse_products', 'products', '2017-12-23 01:17:15', '2017-12-23 01:17:15', NULL),
(51, 'read_products', 'products', '2017-12-23 01:17:15', '2017-12-23 01:17:15', NULL),
(52, 'edit_products', 'products', '2017-12-23 01:17:15', '2017-12-23 01:17:15', NULL),
(53, 'add_products', 'products', '2017-12-23 01:17:15', '2017-12-23 01:17:15', NULL),
(54, 'delete_products', 'products', '2017-12-23 01:17:15', '2017-12-23 01:17:15', NULL),
(55, 'browse_addresses', 'addresses', '2017-12-23 21:48:39', '2017-12-23 21:48:39', NULL),
(56, 'read_addresses', 'addresses', '2017-12-23 21:48:39', '2017-12-23 21:48:39', NULL),
(57, 'edit_addresses', 'addresses', '2017-12-23 21:48:39', '2017-12-23 21:48:39', NULL),
(58, 'add_addresses', 'addresses', '2017-12-23 21:48:39', '2017-12-23 21:48:39', NULL),
(59, 'delete_addresses', 'addresses', '2017-12-23 21:48:39', '2017-12-23 21:48:39', NULL),
(60, 'browse_country', 'country', '2017-12-23 21:56:33', '2017-12-23 21:56:33', NULL),
(61, 'read_country', 'country', '2017-12-23 21:56:33', '2017-12-23 21:56:33', NULL),
(62, 'edit_country', 'country', '2017-12-23 21:56:33', '2017-12-23 21:56:33', NULL),
(63, 'add_country', 'country', '2017-12-23 21:56:33', '2017-12-23 21:56:33', NULL),
(64, 'delete_country', 'country', '2017-12-23 21:56:33', '2017-12-23 21:56:33', NULL),
(65, 'browse_localities', 'localities', '2017-12-23 21:59:13', '2017-12-23 21:59:13', NULL),
(66, 'read_localities', 'localities', '2017-12-23 21:59:13', '2017-12-23 21:59:13', NULL),
(67, 'edit_localities', 'localities', '2017-12-23 21:59:13', '2017-12-23 21:59:13', NULL),
(68, 'add_localities', 'localities', '2017-12-23 21:59:13', '2017-12-23 21:59:13', NULL),
(69, 'delete_localities', 'localities', '2017-12-23 21:59:13', '2017-12-23 21:59:13', NULL),
(70, 'browse_product_brands', 'product_brands', '2017-12-23 22:04:09', '2017-12-23 22:04:09', NULL),
(71, 'read_product_brands', 'product_brands', '2017-12-23 22:04:09', '2017-12-23 22:04:09', NULL),
(72, 'edit_product_brands', 'product_brands', '2017-12-23 22:04:09', '2017-12-23 22:04:09', NULL),
(73, 'add_product_brands', 'product_brands', '2017-12-23 22:04:09', '2017-12-23 22:04:09', NULL),
(74, 'delete_product_brands', 'product_brands', '2017-12-23 22:04:09', '2017-12-23 22:04:09', NULL),
(75, 'browse_qty_units', 'qty_units', '2017-12-23 22:23:34', '2017-12-23 22:23:34', NULL),
(76, 'read_qty_units', 'qty_units', '2017-12-23 22:23:34', '2017-12-23 22:23:34', NULL),
(77, 'edit_qty_units', 'qty_units', '2017-12-23 22:23:34', '2017-12-23 22:23:34', NULL),
(78, 'add_qty_units', 'qty_units', '2017-12-23 22:23:34', '2017-12-23 22:23:34', NULL),
(79, 'delete_qty_units', 'qty_units', '2017-12-23 22:23:34', '2017-12-23 22:23:34', NULL),
(80, 'browse_shop_category', 'shop_category', '2017-12-23 22:26:40', '2017-12-23 22:26:40', NULL),
(81, 'read_shop_category', 'shop_category', '2017-12-23 22:26:40', '2017-12-23 22:26:40', NULL),
(82, 'edit_shop_category', 'shop_category', '2017-12-23 22:26:40', '2017-12-23 22:26:40', NULL),
(83, 'add_shop_category', 'shop_category', '2017-12-23 22:26:40', '2017-12-23 22:26:40', NULL),
(84, 'delete_shop_category', 'shop_category', '2017-12-23 22:26:40', '2017-12-23 22:26:40', NULL),
(85, 'browse_shop_delivers_to', 'shop_delivers_to', '2017-12-23 22:29:37', '2017-12-23 22:29:37', NULL),
(86, 'read_shop_delivers_to', 'shop_delivers_to', '2017-12-23 22:29:37', '2017-12-23 22:29:37', NULL),
(87, 'edit_shop_delivers_to', 'shop_delivers_to', '2017-12-23 22:29:37', '2017-12-23 22:29:37', NULL),
(88, 'add_shop_delivers_to', 'shop_delivers_to', '2017-12-23 22:29:37', '2017-12-23 22:29:37', NULL),
(89, 'delete_shop_delivers_to', 'shop_delivers_to', '2017-12-23 22:29:37', '2017-12-23 22:29:37', NULL),
(90, 'browse_shop_products', 'shop_products', '2017-12-23 22:38:09', '2017-12-23 22:38:09', NULL),
(91, 'read_shop_products', 'shop_products', '2017-12-23 22:38:09', '2017-12-23 22:38:09', NULL),
(92, 'edit_shop_products', 'shop_products', '2017-12-23 22:38:09', '2017-12-23 22:38:09', NULL),
(93, 'add_shop_products', 'shop_products', '2017-12-23 22:38:09', '2017-12-23 22:38:09', NULL),
(94, 'delete_shop_products', 'shop_products', '2017-12-23 22:38:09', '2017-12-23 22:38:09', NULL),
(95, 'browse_shop_timings', 'shop_timings', '2017-12-23 22:44:09', '2017-12-23 22:44:09', NULL),
(96, 'read_shop_timings', 'shop_timings', '2017-12-23 22:44:09', '2017-12-23 22:44:09', NULL),
(97, 'edit_shop_timings', 'shop_timings', '2017-12-23 22:44:09', '2017-12-23 22:44:09', NULL),
(98, 'add_shop_timings', 'shop_timings', '2017-12-23 22:44:09', '2017-12-23 22:44:09', NULL),
(99, 'delete_shop_timings', 'shop_timings', '2017-12-23 22:44:09', '2017-12-23 22:44:09', NULL),
(100, 'browse_shops', 'shops', '2017-12-23 22:48:54', '2017-12-23 22:48:54', NULL),
(101, 'read_shops', 'shops', '2017-12-23 22:48:54', '2017-12-23 22:48:54', NULL),
(102, 'edit_shops', 'shops', '2017-12-23 22:48:54', '2017-12-23 22:48:54', NULL),
(103, 'add_shops', 'shops', '2017-12-23 22:48:54', '2017-12-23 22:48:54', NULL),
(104, 'delete_shops', 'shops', '2017-12-23 22:48:54', '2017-12-23 22:48:54', NULL),
(105, 'browse_state', 'state', '2017-12-23 22:55:01', '2017-12-23 22:55:01', NULL),
(106, 'read_state', 'state', '2017-12-23 22:55:01', '2017-12-23 22:55:01', NULL),
(107, 'edit_state', 'state', '2017-12-23 22:55:01', '2017-12-23 22:55:01', NULL),
(108, 'add_state', 'state', '2017-12-23 22:55:01', '2017-12-23 22:55:01', NULL),
(109, 'delete_state', 'state', '2017-12-23 22:55:01', '2017-12-23 22:55:01', NULL),
(110, 'browse_time_slots', 'time_slots', '2017-12-23 22:59:11', '2017-12-23 22:59:11', NULL),
(111, 'read_time_slots', 'time_slots', '2017-12-23 22:59:11', '2017-12-23 22:59:11', NULL),
(112, 'edit_time_slots', 'time_slots', '2017-12-23 22:59:11', '2017-12-23 22:59:11', NULL),
(113, 'add_time_slots', 'time_slots', '2017-12-23 22:59:11', '2017-12-23 22:59:11', NULL),
(114, 'delete_time_slots', 'time_slots', '2017-12-23 22:59:11', '2017-12-23 22:59:11', NULL),
(115, 'browse_product_imgs', 'product_imgs', '2017-12-23 23:03:09', '2017-12-23 23:03:09', NULL),
(116, 'read_product_imgs', 'product_imgs', '2017-12-23 23:03:09', '2017-12-23 23:03:09', NULL),
(117, 'edit_product_imgs', 'product_imgs', '2017-12-23 23:03:09', '2017-12-23 23:03:09', NULL),
(118, 'add_product_imgs', 'product_imgs', '2017-12-23 23:03:09', '2017-12-23 23:03:09', NULL),
(119, 'delete_product_imgs', 'product_imgs', '2017-12-23 23:03:09', '2017-12-23 23:03:09', NULL),
(120, 'browse_shop_imgs', 'shop_imgs', '2017-12-23 23:06:49', '2017-12-23 23:06:49', NULL),
(121, 'read_shop_imgs', 'shop_imgs', '2017-12-23 23:06:49', '2017-12-23 23:06:49', NULL),
(122, 'edit_shop_imgs', 'shop_imgs', '2017-12-23 23:06:49', '2017-12-23 23:06:49', NULL),
(123, 'add_shop_imgs', 'shop_imgs', '2017-12-23 23:06:49', '2017-12-23 23:06:49', NULL),
(124, 'delete_shop_imgs', 'shop_imgs', '2017-12-23 23:06:49', '2017-12-23 23:06:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permission_groups`
--

CREATE TABLE `permission_groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(52, 1),
(53, 1),
(54, 1),
(55, 1),
(56, 1),
(57, 1),
(58, 1),
(59, 1),
(60, 1),
(61, 1),
(62, 1),
(63, 1),
(64, 1),
(65, 1),
(66, 1),
(67, 1),
(68, 1),
(69, 1),
(70, 1),
(71, 1),
(72, 1),
(73, 1),
(74, 1),
(75, 1),
(76, 1),
(77, 1),
(78, 1),
(79, 1),
(80, 1),
(81, 1),
(82, 1),
(83, 1),
(84, 1),
(85, 1),
(86, 1),
(87, 1),
(88, 1),
(89, 1),
(90, 1),
(91, 1),
(92, 1),
(93, 1),
(94, 1),
(95, 1),
(96, 1),
(97, 1),
(98, 1),
(99, 1),
(100, 1),
(101, 1),
(102, 1),
(103, 1),
(104, 1),
(105, 1),
(106, 1),
(107, 1),
(108, 1),
(109, 1),
(110, 1),
(111, 1),
(112, 1),
(113, 1),
(114, 1),
(115, 1),
(116, 1),
(117, 1),
(118, 1),
(119, 1),
(120, 1),
(121, 1),
(122, 1),
(123, 1),
(124, 1);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `author_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `seo_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `excerpt` text COLLATE utf8mb4_unicode_ci,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci,
  `status` enum('PUBLISHED','DRAFT','PENDING') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'DRAFT',
  `featured` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `qty_unit` int(11) NOT NULL,
  `has_description` tinyint(4) NOT NULL DEFAULT '0',
  `description` text,
  `has_specifics` tinyint(4) NOT NULL DEFAULT '0',
  `specifics` text,
  `slug` varchar(255) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `brand_id`, `category`, `qty`, `qty_unit`, `has_description`, `description`, `has_specifics`, `specifics`, `slug`, `updated_at`, `created_at`) VALUES
(1, 'Maggi Noodles', 1, 1, 500, 1, 0, NULL, 0, NULL, 'maggi-noodles', '2017-12-23 06:50:59', '2017-12-23 06:50:59'),
(2, 'Maggi Noodles', 1, 1, 1000, 1, 0, NULL, 0, NULL, 'maggi-noodles', '2017-12-23 06:50:59', '2017-12-23 06:50:59'),
(4, 'Home Lite Matches', 11, 5, 10, 4, 0, 'Nulla quis lorem ut libero malesuada feugiat. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Nulla quis lorem ut libero malesuada feugiat. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem.', 1, '{"ghi":"jkl","y":"z"}', 'home-lite-matches', '2018-01-09 03:04:24', '2018-01-09 03:04:24'),
(5, 'hssfbas1', 1, 1, 500, 1, 0, 'Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Vivamus suscipit tortor eget felis porttitor volutpat. Quisque velit nisi, pretium ut lacinia in, elementum id enim. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi.', 1, '{"abc":"def","ghi":"jkl","mno":"pqr","stu":"vwx"}', 'hssfbas1', '2018-01-09 03:51:28', '2018-01-09 03:51:28');

-- --------------------------------------------------------

--
-- Table structure for table `product_brands`
--

CREATE TABLE `product_brands` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_brands`
--

INSERT INTO `product_brands` (`id`, `name`, `updated_at`, `created_at`) VALUES
(1, 'Nestle', '2017-12-24 09:03:02', '2017-12-24 09:03:02'),
(2, 'Hyundai', '2018-01-04 07:42:03', '2018-01-04 07:42:03'),
(3, 'Dabur', '2018-01-04 07:45:16', '2018-01-04 07:45:16'),
(4, 'Cadbury', '2018-01-04 07:45:54', '2018-01-04 07:45:54'),
(5, 'abcd', '2018-01-04 07:49:00', '2018-01-04 07:49:00'),
(6, 'Hyundai', '2018-01-04 07:49:18', '2018-01-04 07:49:18'),
(7, 'abcd', '2018-01-04 07:49:35', '2018-01-04 07:49:35'),
(8, 'abcd', '2018-01-04 07:50:57', '2018-01-04 07:50:57'),
(9, 'Dabur', '2018-01-04 07:53:44', '2018-01-04 07:53:44'),
(10, 'abcd', '2018-01-04 07:53:58', '2018-01-04 07:53:58'),
(11, 'WIMCO', '2018-01-09 06:02:18', '2018-01-09 06:02:18');

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Noodles', '2017-12-23 06:38:00', '2017-12-23 22:04:32'),
(2, 'Mobiles', '2018-01-04 02:12:19', '2018-01-04 02:12:19'),
(3, 'Chocolates', '2018-01-04 02:16:08', '2018-01-04 02:16:08'),
(4, 'Edible oils', '2018-01-04 02:29:22', '2018-01-04 02:29:22'),
(5, 'Matches', '2018-01-09 00:32:26', '2018-01-09 00:32:26');

-- --------------------------------------------------------

--
-- Table structure for table `product_imgs`
--

CREATE TABLE `product_imgs` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `cover` int(11) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_imgs`
--

INSERT INTO `product_imgs` (`id`, `product_id`, `filename`, `cover`, `updated_at`, `created_at`) VALUES
(1, 1, 'maggi.jpg', 1, '2017-12-24 04:34:29', '2017-12-24 10:02:30'),
(2, 2, 'maggi.jpg', 1, '2017-12-24 10:02:30', '2017-12-24 10:02:30'),
(3, 4, '1515486864.jpg', 1, '2018-01-09 08:34:24', '2018-01-09 08:34:24'),
(5, 5, '1515489688.jpg', 1, '2018-01-09 09:21:28', '2018-01-09 09:21:28'),
(6, 5, '1515489688.png', 0, '2018-01-09 09:21:28', '2018-01-09 09:21:28');

-- --------------------------------------------------------

--
-- Table structure for table `qty_units`
--

CREATE TABLE `qty_units` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `short_form` varchar(10) NOT NULL,
  `plural_name` varchar(20) NOT NULL,
  `plural_short_form` varchar(10) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `qty_units`
--

INSERT INTO `qty_units` (`id`, `name`, `short_form`, `plural_name`, `plural_short_form`, `updated_at`, `created_at`) VALUES
(1, 'Gram', 'gm', 'Grams', 'gms', '2017-12-24 03:53:56', '2017-12-24 09:20:32'),
(2, 'Metre', 'm', 'Metres', 'metres', '2018-01-04 07:42:45', '2018-01-04 07:42:45'),
(3, 'Kilometre', 'km', 'Kilometers', 'kms', '2018-01-04 07:46:32', '2018-01-04 07:46:32'),
(4, 'Piece', 'pc', 'Pieces', 'pcs', '2018-01-09 06:02:53', '2018-01-09 06:02:53');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Administrator', '2017-12-23 00:43:15', '2017-12-23 00:43:15'),
(2, 'user', 'Normal User', '2017-12-23 00:43:15', '2017-12-23 00:43:15');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int(11) NOT NULL DEFAULT '1',
  `group` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `display_name`, `value`, `details`, `type`, `order`, `group`) VALUES
(1, '.site_title', 'Site Title', 'Inshopia', NULL, 'text', 0, NULL),
(2, '.logo', 'Logo', '', NULL, 'image', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shops`
--

CREATE TABLE `shops` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `address` text NOT NULL,
  `city_id` int(11) NOT NULL,
  `locality_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `slug` text NOT NULL,
  `type` int(11) NOT NULL COMMENT '0 for listing, 1 for takeaway, 2 for delivery',
  `delivery_charges` int(11) NOT NULL,
  `shop_closed_on` varchar(100) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shops`
--

INSERT INTO `shops` (`id`, `name`, `address`, `city_id`, `locality_id`, `cat_id`, `slug`, `type`, `delivery_charges`, `shop_closed_on`, `updated_at`, `created_at`) VALUES
(1, 'Sonu Store', '311, 6th Avenue, Shree vihar, Near Indian Oil Office, Patia', 1, 1, 1, 'sonu-store', 2, 20, '1,2', '2017-12-27 17:57:14', '2017-12-24 09:45:52'),
(2, 'National Electronics 2', '311, 6th Avenue, Shree vihar, Near Indian Oil Office, Patia', 1, 2, 2, 'national-electronics-2', 1, 30, '2,3', '2017-12-24 09:45:52', '2017-12-24 09:45:52'),
(3, 'National Electronics 3', '311, 6th Avenue, Shree vihar, Near Indian Oil Office, Patia', 1, 2, 2, 'national-electronics-3', 2, 30, '3,4', '2017-12-24 04:23:24', '2017-12-24 09:45:52'),
(5, 'Patra Electronics', '102, kailash dham, Damana', 1, 1, 2, 'patra-electronics', 2, 30, '0', '2017-12-28 06:15:41', '2017-12-26 07:22:23'),
(6, 'New Store', 'Test Test', 1, 3, 3, 'new-store', 2, 30, '0', '2017-12-27 21:17:33', '2017-12-27 21:17:33');

-- --------------------------------------------------------

--
-- Table structure for table `shop_category`
--

CREATE TABLE `shop_category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `slug` varchar(255) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shop_category`
--

INSERT INTO `shop_category` (`id`, `category_name`, `description`, `slug`, `updated_at`, `created_at`) VALUES
(1, 'Grocery', 'desc', 'grocery', '2017-12-24 03:57:05', '2017-12-24 09:24:31'),
(2, 'Electronics', '', 'electronics', '2017-12-24 09:24:31', '2017-12-24 09:24:31'),
(3, 'Snacks And Sweets', '', 'snacks-and-sweets', '2017-12-24 09:24:31', '2017-12-24 09:24:31');

-- --------------------------------------------------------

--
-- Table structure for table `shop_delivers_to`
--

CREATE TABLE `shop_delivers_to` (
  `id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `locality_id` int(11) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shop_delivers_to`
--

INSERT INTO `shop_delivers_to` (`id`, `shop_id`, `locality_id`, `updated_at`, `created_at`) VALUES
(4, 2, 2, '2017-12-24 09:31:03', '2017-12-24 09:31:03'),
(6, 2, 4, '2017-12-24 09:31:03', '2017-12-24 09:31:03'),
(7, 3, 2, '2017-12-24 09:31:03', '2017-12-24 09:31:03'),
(8, 3, 3, '2017-12-24 09:31:03', '2017-12-24 09:31:03'),
(9, 2, 3, '2017-12-24 09:31:03', '2017-12-24 09:31:03'),
(27, 1, 1, '2017-12-27 17:57:14', '2017-12-27 17:57:14'),
(28, 1, 2, '2017-12-27 17:57:14', '2017-12-27 17:57:14'),
(29, 6, 1, '2017-12-27 21:17:33', '2017-12-27 21:17:33'),
(30, 6, 2, '2017-12-27 21:17:33', '2017-12-27 21:17:33'),
(43, 5, 2, '2017-12-28 06:15:42', '2017-12-28 06:15:42'),
(44, 5, 3, '2017-12-28 06:15:42', '2017-12-28 06:15:42');

-- --------------------------------------------------------

--
-- Table structure for table `shop_imgs`
--

CREATE TABLE `shop_imgs` (
  `id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `filename` text NOT NULL,
  `cover` tinyint(4) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shop_imgs`
--

INSERT INTO `shop_imgs` (`id`, `shop_id`, `filename`, `cover`, `updated_at`, `created_at`) VALUES
(2, 2, 'banner.jpg', 1, '2017-12-24 10:06:07', '2017-12-24 10:06:07'),
(3, 3, 'banner.jpg', 1, '2017-12-24 10:06:07', '2017-12-24 10:06:07'),
(5, 5, '1514272943.jpg', 1, '2017-12-26 07:22:23', '2017-12-26 07:22:23'),
(10, 1, '1514397434.jpg', 1, '2017-12-27 17:57:14', '2017-12-27 17:57:14'),
(11, 6, '1514409453.jpg', 1, '2017-12-27 21:17:33', '2017-12-27 21:17:33');

-- --------------------------------------------------------

--
-- Table structure for table `shop_order_content`
--

CREATE TABLE `shop_order_content` (
  `id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `cost_to_inshopia` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `inshopia_commission` int(11) NOT NULL,
  `delivery` int(11) NOT NULL,
  `order_content` text NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shop_order_content`
--

INSERT INTO `shop_order_content` (`id`, `shop_id`, `order_id`, `cost_to_inshopia`, `subtotal`, `inshopia_commission`, `delivery`, `order_content`, `updated_at`, `created_at`) VALUES
(18, 1, 5, 244, 296, 52, 20, '{"1":{"qty":"8","cp":8,"sp":10},"2":{"qty":"12","cp":15,"sp":18}}', '2017-12-14 01:30:23', '2017-12-14 01:30:23'),
(19, 1, 6, 160, 180, 20, 20, '{"9":{"qty":"2","cp":80,"sp":90}}', '2018-01-09 04:47:01', '2018-01-09 04:47:01'),
(20, 1, 7, 54, 60, 6, 20, '{"1":{"qty":"6","cp":9,"sp":10}}', '2018-01-15 04:22:13', '2018-01-15 04:22:13'),
(21, 1, 8, 72, 80, 8, 20, '{"1":{"qty":"8","cp":9,"sp":10}}', '2018-09-15 03:35:03', '2018-09-15 03:35:03');

-- --------------------------------------------------------

--
-- Table structure for table `shop_products`
--

CREATE TABLE `shop_products` (
  `id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `mrp` int(11) NOT NULL,
  `cp` int(11) NOT NULL COMMENT 'Cost price for inshopia',
  `sp` int(11) NOT NULL COMMENT 'Selling price shown on web',
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shop_products`
--

INSERT INTO `shop_products` (`id`, `shop_id`, `product_id`, `mrp`, `cp`, `sp`, `updated_at`, `created_at`) VALUES
(1, 1, 1, 13, 9, 10, '2017-12-24 04:10:10', '2017-12-24 09:34:51'),
(2, 1, 2, 22, 15, 18, '2017-12-24 09:34:51', '2017-12-24 09:34:51'),
(3, 2, 1, 12, 8, 10, '2017-12-24 09:34:51', '2017-12-24 09:34:51'),
(4, 2, 2, 22, 15, 18, '2017-12-24 09:34:51', '2017-12-24 09:34:51'),
(5, 3, 1, 12, 8, 10, '2017-12-24 09:34:51', '2017-12-24 09:34:51'),
(6, 3, 2, 22, 15, 18, '2017-12-24 09:34:51', '2017-12-24 09:34:51'),
(7, 5, 1, 100, 80, 90, '2018-01-02 21:15:53', '2018-01-02 21:15:53'),
(8, 1, 3, 100, 80, 90, '2018-01-09 08:35:53', '2018-01-09 08:35:53'),
(9, 1, 4, 100, 80, 90, '2018-01-09 08:42:33', '2018-01-09 08:42:33'),
(10, 1, 4, 100, 80, 90, '2018-01-09 09:22:00', '2018-01-09 09:22:00');

-- --------------------------------------------------------

--
-- Table structure for table `shop_ratings`
--

CREATE TABLE `shop_ratings` (
  `id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `review` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `liked` text,
  `replied_to` int(11) NOT NULL DEFAULT '0',
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shop_ratings`
--

INSERT INTO `shop_ratings` (`id`, `rating`, `review`, `user_id`, `shop_id`, `liked`, `replied_to`, `updated_at`, `created_at`) VALUES
(1, 3, 'hghfg hjgh vtyvbcg bv f fg t v h gf g g fg gc ', 1, 1, '1', 0, '2017-12-10 00:16:08', '2017-12-10 00:16:08'),
(2, 0, 'Donec rutrum congue leo eget malesuada. Nulla quis lorem ut libero malesuada feugiat. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Nulla porttitor accumsan tincidunt.', 1, 1, '1', 1, '2017-12-10 02:28:35', '2017-12-10 02:28:35'),
(3, 0, 'Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Donec rutrum congue leo eget malesuada. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula.', 1, 1, '1', 1, '2017-12-10 11:47:13', '2017-12-10 11:47:13'),
(4, 4, 'This is a very good store\r\n', 1, 1, '', 0, '2018-01-15 04:21:15', '2018-01-15 04:21:15'),
(5, 3, '', 1, 1, '1,3', 0, '2018-01-15 04:21:20', '2018-01-15 04:21:20'),
(6, 3, '', 1, 1, NULL, 0, '2018-01-15 04:21:20', '2018-01-15 04:21:20'),
(7, 0, 'Hello World', 1, 1, '', 4, '2018-01-15 04:21:37', '2018-01-15 04:21:37'),
(8, 4, 'lorem ipsum;', 1, 1, '1', 0, '2018-09-15 03:37:52', '2018-09-15 03:37:52'),
(9, 0, 'lorem ipsum\r\n', 1, 1, NULL, 8, '2018-09-15 03:38:02', '2018-09-15 03:38:02');

-- --------------------------------------------------------

--
-- Table structure for table `shop_rating_replies`
--

CREATE TABLE `shop_rating_replies` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating_id` int(11) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `shop_timings`
--

CREATE TABLE `shop_timings` (
  `id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `start` time NOT NULL,
  `end` time NOT NULL,
  `break_start` time NOT NULL,
  `break_end` time NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shop_timings`
--

INSERT INTO `shop_timings` (`id`, `shop_id`, `start`, `end`, `break_start`, `break_end`, `updated_at`, `created_at`) VALUES
(1, 1, '09:00:00', '22:00:00', '13:00:00', '14:00:00', '2017-12-24 04:15:08', '2017-12-24 09:42:10');

-- --------------------------------------------------------

--
-- Table structure for table `shop_user_favs`
--

CREATE TABLE `shop_user_favs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `parent` int(11) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`id`, `name`, `parent`, `updated_at`, `created_at`) VALUES
(1, 'Odisha', 1, '2017-12-24 09:53:59', '2017-12-24 09:53:59'),
(2, 'Jharkhand', 1, '2017-12-24 09:53:59', '2017-12-24 09:53:59'),
(3, 'New South Wales', 2, '2018-01-09 08:58:34', '2018-01-09 08:58:34'),
(4, 'Maharashtra', 1, '2018-07-18 06:00:45', '2018-07-18 06:00:45');

-- --------------------------------------------------------

--
-- Table structure for table `time_slots`
--

CREATE TABLE `time_slots` (
  `id` int(11) NOT NULL,
  `begin_slot` time NOT NULL,
  `end_slot` time NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `time_slots`
--

INSERT INTO `time_slots` (`id`, `begin_slot`, `end_slot`, `updated_at`, `created_at`) VALUES
(1, '10:00:00', '12:00:00', '2017-12-24 09:58:26', '2017-12-24 09:58:26'),
(2, '12:00:00', '14:00:00', '2017-12-24 09:58:26', '2017-12-24 09:58:26'),
(3, '14:00:00', '16:00:00', '2017-12-24 09:58:26', '2017-12-24 09:58:26'),
(4, '16:00:00', '18:00:00', '2017-12-24 09:58:26', '2017-12-24 09:58:26'),
(5, '18:00:00', '20:00:00', '2017-12-24 09:58:26', '2017-12-24 09:58:26');

-- --------------------------------------------------------

--
-- Table structure for table `translations`
--

CREATE TABLE `translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `table_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `column_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foreign_key` int(10) UNSIGNED NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'users/default.png',
  `phn` bigint(20) NOT NULL,
  `gender` tinyint(4) NOT NULL,
  `age` tinyint(11) NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type` tinyint(4) NOT NULL,
  `is_admin` tinyint(4) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `email`, `avatar`, `phn`, `gender`, `age`, `password`, `user_type`, `is_admin`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'Nishant Kumar', 'nishant6639@gmail.com', 'users/December2017/gSguWUau0gf3u0vmOyXC.jpg', 9439416692, 1, 27, '$2y$10$yriZ66XlTwBkJ/YOTdpF4ex2CkXJvRlTPc4gA.0PjTXE17fXFexpK', 1, 1, 'Bs9Ip4D0TRKcKrNP72l1QMvp6ziMW78m6PnCa1azeZlXVsf8QEyqlkHy08WM', '2017-10-15 03:40:39', '2018-01-03 00:28:56'),
(3, 2, 'Nishant Kumar', 'nishant060990@gmail.com', 'users/default.png', 0, 1, 0, '$2y$10$DdSbWETSYlxcm0J6m4afiO4Bu5WRqx8jSl7Es7xELRKeJXmI/1YL2', 2, 0, 'WAE1uhFT6COOszGhU9qmY7TDxPhyRVkxlXEvcG1IJo3jf6VofnI2VEPtCdmR', '2017-10-15 03:40:39', '2017-12-23 02:36:56'),
(4, NULL, 'Vishal Kumar', 'nishant.2011in@gmail.com', 'users/default.png', 0, 1, 0, '$2y$10$DdSbWETSYlxcm0J6m4afiO4Bu5WRqx8jSl7Es7xELRKeJXmI/1YL2', 2, 0, 'R2h6pr2CwpGQJgigBwDy2KZeeMkQGLX9ChCvGEJDPbQYCos4XxcJr5z6oKr8', '2017-10-15 03:40:39', '2017-10-15 03:40:39'),
(5, NULL, 'Nishant Kumar', 'nishant.2010in@gmail.com', 'users/default.png', 0, 1, 0, '$2y$10$DdSbWETSYlxcm0J6m4afiO4Bu5WRqx8jSl7Es7xELRKeJXmI/1YL2', 2, 0, '2IBv4l52hftG81Un8evprSdvrpvwNiHMmCNm4fanPi1hllRIge6t3BOgwb2g', '2017-10-15 03:40:39', '2017-10-15 03:40:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`),
  ADD KEY `categories_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_rows`
--
ALTER TABLE `data_rows`
  ADD PRIMARY KEY (`id`),
  ADD KEY `data_rows_data_type_id_foreign` (`data_type_id`);

--
-- Indexes for table `data_types`
--
ALTER TABLE `data_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `data_types_name_unique` (`name`),
  ADD UNIQUE KEY `data_types_slug_unique` (`slug`);

--
-- Indexes for table `localities`
--
ALTER TABLE `localities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `menus_name_unique` (`name`);

--
-- Indexes for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_items_menu_id_foreign` (`menu_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pages_slug_unique` (`slug`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permissions_key_index` (`key`);

--
-- Indexes for table `permission_groups`
--
ALTER TABLE `permission_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permission_groups_name_unique` (`name`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_permission_id_index` (`permission_id`),
  ADD KEY `permission_role_role_id_index` (`role_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `posts_slug_unique` (`slug`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_brands`
--
ALTER TABLE `product_brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_imgs`
--
ALTER TABLE `product_imgs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `qty_units`
--
ALTER TABLE `qty_units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`);

--
-- Indexes for table `shops`
--
ALTER TABLE `shops`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_category`
--
ALTER TABLE `shop_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_delivers_to`
--
ALTER TABLE `shop_delivers_to`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_imgs`
--
ALTER TABLE `shop_imgs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `shop_order_content`
--
ALTER TABLE `shop_order_content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_products`
--
ALTER TABLE `shop_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_ratings`
--
ALTER TABLE `shop_ratings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `shop_rating_replies`
--
ALTER TABLE `shop_rating_replies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_timings`
--
ALTER TABLE `shop_timings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_user_favs`
--
ALTER TABLE `shop_user_favs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `time_slots`
--
ALTER TABLE `time_slots`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `translations`
--
ALTER TABLE `translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `translations_table_name_column_name_foreign_key_locale_unique` (`table_name`,`column_name`,`foreign_key`,`locale`);

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
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `data_rows`
--
ALTER TABLE `data_rows`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=198;
--
-- AUTO_INCREMENT for table `data_types`
--
ALTER TABLE `data_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `localities`
--
ALTER TABLE `localities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;
--
-- AUTO_INCREMENT for table `permission_groups`
--
ALTER TABLE `permission_groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `product_brands`
--
ALTER TABLE `product_brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `product_imgs`
--
ALTER TABLE `product_imgs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `qty_units`
--
ALTER TABLE `qty_units`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `shops`
--
ALTER TABLE `shops`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `shop_category`
--
ALTER TABLE `shop_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `shop_delivers_to`
--
ALTER TABLE `shop_delivers_to`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT for table `shop_imgs`
--
ALTER TABLE `shop_imgs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `shop_order_content`
--
ALTER TABLE `shop_order_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `shop_products`
--
ALTER TABLE `shop_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `shop_ratings`
--
ALTER TABLE `shop_ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `shop_rating_replies`
--
ALTER TABLE `shop_rating_replies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `shop_timings`
--
ALTER TABLE `shop_timings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `shop_user_favs`
--
ALTER TABLE `shop_user_favs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `time_slots`
--
ALTER TABLE `time_slots`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `translations`
--
ALTER TABLE `translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `data_rows`
--
ALTER TABLE `data_rows`
  ADD CONSTRAINT `data_rows_data_type_id_foreign` FOREIGN KEY (`data_type_id`) REFERENCES `data_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD CONSTRAINT `menu_items_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
