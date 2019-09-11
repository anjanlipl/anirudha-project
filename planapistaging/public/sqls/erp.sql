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
-- Database: `erp`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `dates_absent` text,
  `dates_half` text,
  `extra_present` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `emp_id`, `month`, `year`, `dates_absent`, `dates_half`, `extra_present`) VALUES
(1, 615, 4, 2019, '2019-06-10', '2019-04-28', NULL),
(3, 634, 4, 2019, NULL, '2019-04-08,2019-04-25', NULL),
(4, 624, 4, 2019, NULL, '', NULL),
(5, 626, 4, 2019, NULL, NULL, ''),
(6, 615, 5, 2019, '2019-06-22', '', NULL),
(7, 616, 4, 2019, '2019-05-31,2019-04-01', '', NULL),
(8, 625, 4, 2019, '2019-04-01,2019-04-02,2019-04-03,2019-04-04,2019-04-05,2019-04-06,2019-04-16,2019-04-15,2019-04-08,2019-04-09,2019-04-10,2019-04-11,2019-04-12,2019-04-13,2019-04-07,2019-04-14,2019-04-21,2019-04-28,2019-04-17', NULL, NULL),
(9, 620, 4, 2019, '2019-04-01', NULL, NULL),
(10, 625, 5, 2019, '2019-05-01', NULL, NULL),
(11, 619, 4, 2019, '2019-04-01', NULL, NULL),
(12, 635, 4, 2019, '2019-04-08', NULL, NULL),
(13, 636, 4, 2019, '2019-04-01,2019-04-08,2019-04-29', NULL, NULL),
(14, 642, 4, 2019, '2019-04-01,2019-04-02,2019-04-08,2019-04-09,2019-04-10,2019-04-11,2019-04-12,2019-04-13,2019-04-14,2019-04-15,2019-04-16,2019-04-17,2019-04-18,2019-04-19,2019-04-20,2019-04-21,2019-04-22,2019-04-23,2019-04-24,2019-04-25,2019-04-26,2019-04-27,2019-04-28,2019-04-29,2019-04-30', '2019-04-24', NULL),
(15, 629, 4, 2019, '2019-04-15,2019-04-23,2019-04-17', NULL, NULL),
(16, 622, 4, 2019, '2019-04-15', NULL, NULL),
(17, 618, 4, 2019, '2019-04-20', '2019-04-16', NULL),
(18, 615, 6, 2019, '', '', NULL),
(19, 616, 6, 2019, NULL, '', NULL),
(20, 627, 4, 2019, '2019-04-03,2019-04-10,2019-04-24', NULL, NULL),
(21, 628, 4, 2019, '2019-04-15', NULL, NULL),
(22, 621, 4, 2019, '2019-04-05', NULL, '2019-06-10,2019-04-07'),
(23, 619, 6, 2019, '', NULL, NULL),
(24, 632, 4, 2019, '2019-04-20,2019-04-18', NULL, NULL),
(25, 630, 4, 2019, '2019-04-02,2019-04-03,2019-04-05,2019-04-17,2019-04-23', NULL, '2019-06-10,2019-04-14,2019-04-21,2019-04-28,2019-04-07'),
(26, 640, 4, 2019, '2019-06-10', '2019-04-25', NULL),
(27, 639, 4, 2019, '2019-04-09,2019-04-11,2019-04-22,2019-04-23,2019-04-24,2019-04-25,2019-04-26,2019-04-27,2019-04-28,2019-04-29,2019-04-30', '2019-04-08,2019-04-15,2019-04-21', NULL),
(28, 643, 4, 2019, '2019-04-30,2019-04-22', NULL, NULL),
(29, 638, 4, 2019, '2019-04-03,2019-04-12,2019-04-13', NULL, NULL),
(30, 641, 4, 2019, '2019-04-12,2019-04-13,2019-04-15', NULL, NULL),
(31, 633, 4, 2019, '2019-04-03,2019-04-04,2019-04-05,2019-04-06,2019-04-07,2019-04-08,2019-04-09,2019-04-10,2019-04-11,2019-04-12,2019-04-13', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cash`
--

CREATE TABLE `cash` (
  `id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `amnt` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cash`
--

INSERT INTO `cash` (`id`, `emp_id`, `month`, `year`, `amnt`) VALUES
(1, 635, 4, 2019, 1810),
(2, 636, 4, 2019, 3500),
(3, 637, 4, 2019, 419),
(4, 638, 4, 2019, 3293),
(5, 639, 4, 2019, 0),
(6, 640, 4, 2019, 187),
(7, 641, 4, 2019, 444),
(8, 642, 4, 2019, 0),
(9, 643, 4, 2019, 5000),
(10, 615, 4, 2019, 0),
(11, 616, 4, 2019, 901),
(12, 617, 4, 2019, 6086),
(13, 618, 4, 2019, 6563),
(14, 619, 4, 2019, 3222),
(15, 620, 4, 2019, 9288),
(16, 621, 4, 2019, 334),
(17, 622, 4, 2019, 1437),
(18, 623, 4, 2019, 4398),
(19, 624, 4, 2019, 1311),
(20, 615, 6, 2019, 0),
(21, 616, 6, 2019, 901),
(22, 617, 6, 2019, 6086),
(23, 618, 6, 2019, 6563),
(24, 619, 6, 2019, 3222),
(25, 620, 6, 2019, 9288),
(26, 621, 6, 2019, 334),
(27, 622, 6, 2019, 1437),
(28, 623, 6, 2019, 4398),
(29, 624, 6, 2019, 1311),
(30, 625, 6, 2019, 1311),
(31, 626, 6, 2019, 2327),
(32, 627, 6, 2019, 1251),
(33, 628, 6, 2019, 3000),
(34, 629, 6, 2019, 1439),
(35, 630, 6, 2019, 2231),
(36, 631, 6, 2019, 1000),
(37, 632, 6, 2019, 1000),
(38, 633, 6, 2019, 0),
(39, 634, 6, 2019, 0),
(40, 635, 6, 2019, 1810),
(41, 636, 6, 2019, 3500),
(42, 637, 6, 2019, 419),
(43, 638, 6, 2019, 3293),
(44, 639, 6, 2019, 0),
(45, 640, 6, 2019, 187),
(46, 641, 6, 2019, 444),
(47, 642, 6, 2019, 0),
(48, 643, 6, 2019, 5000),
(49, 625, 4, 2019, 1316),
(50, 626, 4, 2019, 2327),
(51, 627, 4, 2019, 1251),
(52, 628, 4, 2019, 3000),
(53, 629, 4, 2019, 1439),
(54, 630, 4, 2019, 2231),
(55, 631, 4, 2019, 1000),
(56, 632, 4, 2019, 1000),
(57, 633, 4, 2019, 0),
(58, 634, 4, 2019, 0);

-- --------------------------------------------------------

--
-- Table structure for table `daily_attendance`
--

CREATE TABLE `daily_attendance` (
  `id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `dates_absent` text,
  `dates_half` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `daily_employees`
--

CREATE TABLE `daily_employees` (
  `id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `gender` tinyint(4) NOT NULL DEFAULT '1',
  `dob` datetime DEFAULT NULL,
  `address` text,
  `phone` varchar(11) DEFAULT NULL,
  `doj` datetime DEFAULT NULL,
  `wage` double DEFAULT NULL,
  `work_hrs` int(11) NOT NULL DEFAULT '9',
  `photo` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `daily_employees`
--

INSERT INTO `daily_employees` (`id`, `emp_id`, `name`, `gender`, `dob`, `address`, `phone`, `doj`, `wage`, `work_hrs`, `photo`, `created_at`, `updated_at`) VALUES
(43, 30, 'MOJAHID KHAN', 1, NULL, NULL, NULL, NULL, 290, 8, NULL, '2019-05-01 17:00:58', '2019-05-01 17:00:58'),
(44, 31, 'TANMAYA ROUT', 1, NULL, NULL, NULL, NULL, 260, 8, NULL, '2019-05-01 17:00:58', '2019-05-01 17:00:58'),
(45, 32, 'JANAKI SAHOO', 1, NULL, NULL, NULL, NULL, 260, 8, NULL, '2019-05-01 17:00:58', '2019-05-01 17:00:58');

-- --------------------------------------------------------

--
-- Table structure for table `daily_ot`
--

CREATE TABLE `daily_ot` (
  `id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `hrs` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `electricity`
--

CREATE TABLE `electricity` (
  `id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `prev` double NOT NULL,
  `current` double NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `electricity`
--

INSERT INTO `electricity` (`id`, `emp_id`, `prev`, `current`, `month`, `year`) VALUES
(1, 615, 0, 0, 5, 2019),
(2, 616, 0, 0, 5, 2019),
(3, 620, 0, 0, 5, 2019),
(4, 622, 0, 0, 5, 2019),
(5, 615, 2365, 2434, 6, 2019),
(6, 616, 3009, 3128, 6, 2019),
(7, 620, 150, 197, 6, 2019),
(8, 622, 1656, 1719, 6, 2019),
(9, 615, 2365, 2434, 4, 2019),
(10, 616, 3009, 3128, 4, 2019),
(11, 620, 150, 197, 4, 2019),
(12, 622, 1656, 1719, 4, 2019);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `emp_id` varchar(20) NOT NULL,
  `name` text NOT NULL,
  `gender` tinyint(4) NOT NULL DEFAULT '1',
  `dob` datetime DEFAULT NULL,
  `address` text,
  `phone` varchar(11) DEFAULT NULL,
  `doj` datetime DEFAULT NULL,
  `gross` double DEFAULT NULL,
  `electricity` tinyint(4) NOT NULL DEFAULT '0',
  `mobile` tinyint(4) NOT NULL DEFAULT '0',
  `leave_type` int(11) NOT NULL DEFAULT '1',
  `leave_days` int(11) NOT NULL DEFAULT '0',
  `work_hrs` int(11) NOT NULL DEFAULT '9',
  `weekly_leave` varchar(200) NOT NULL DEFAULT 'sunday',
  `esi_epf` tinyint(4) NOT NULL DEFAULT '0',
  `photo` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `emp_id`, `name`, `gender`, `dob`, `address`, `phone`, `doj`, `gross`, `electricity`, `mobile`, `leave_type`, `leave_days`, `work_hrs`, `weekly_leave`, `esi_epf`, `photo`, `created_at`, `updated_at`) VALUES
(615, '1', 'SHYAMAL SEN', 1, '1970-01-01 00:00:00', NULL, NULL, NULL, 13000, 1, 0, 1, 12, 12, 'sunday', 0, NULL, '2019-05-01 16:47:16', '2019-05-01 16:47:16'),
(616, '2', 'MANOJ MOHANTY', 1, NULL, NULL, NULL, NULL, 18000, 1, 0, 2, 0, 12, 'sunday', 1, NULL, '2019-05-01 16:47:16', '2019-05-01 16:47:16'),
(617, '3', 'YUNUS MOHAMMAD', 1, '1970-01-01 00:00:00', NULL, NULL, NULL, 11000, 0, 0, 2, 0, 12, 'sunday', 1, NULL, '2019-05-01 16:47:16', '2019-05-01 16:47:16'),
(618, '4', 'BALARAM PRADHAN', 1, NULL, NULL, NULL, NULL, 11000, 0, 0, 2, 0, 12, 'sunday', 1, NULL, '2019-05-01 16:47:16', '2019-05-01 16:47:16'),
(619, '5', 'MANORANJAN DAS', 1, NULL, NULL, NULL, NULL, 8800, 0, 0, 2, 0, 8, 'sunday', 1, NULL, '2019-05-01 16:47:16', '2019-05-01 16:47:16'),
(620, '6', 'MANOJ YADAV', 1, NULL, NULL, NULL, NULL, 7500, 1, 0, 2, 0, 8, 'sunday', 1, NULL, '2019-05-01 16:47:16', '2019-05-01 16:47:16'),
(621, '7', 'SARAT KUMAR PANDA', 1, NULL, NULL, NULL, NULL, 10000, 0, 0, 2, 0, 8, 'sunday', 1, NULL, '2019-05-01 16:47:16', '2019-05-01 16:47:16'),
(622, '8', 'SUBASH NAIK', 1, NULL, NULL, NULL, NULL, 8950, 1, 0, 2, 0, 8, 'sunday', 1, NULL, '2019-05-01 16:47:16', '2019-05-01 16:47:16'),
(623, '9', 'SK.MD. SAMIM', 1, NULL, NULL, NULL, NULL, 10800, 0, 0, 2, 0, 8, 'sunday', 1, NULL, '2019-05-01 16:47:16', '2019-05-01 16:47:16'),
(624, '10', 'SANGRAM KU NAYAK ', 1, NULL, NULL, NULL, NULL, 7000, 0, 0, 2, 0, 8, 'sunday', 1, NULL, '2019-05-01 16:47:16', '2019-05-01 16:47:16'),
(625, '11', 'LOKNATH DAS', 1, NULL, NULL, NULL, NULL, 7100, 0, 0, 2, 0, 8, 'sunday', 1, NULL, '2019-05-01 16:47:16', '2019-05-01 16:47:16'),
(626, '12', 'MOBARAK ALLI', 1, NULL, NULL, NULL, NULL, 7600, 0, 0, 2, 0, 8, 'friday', 0, NULL, '2019-05-01 16:47:16', '2019-05-01 16:47:16'),
(627, '13', 'BASANT KUMAR BISOI', 1, NULL, NULL, NULL, NULL, 8700, 0, 0, 2, 0, 8, 'sunday', 1, NULL, '2019-05-01 16:47:16', '2019-05-01 16:47:16'),
(628, '14', 'JAWED KHAN ', 1, NULL, NULL, NULL, NULL, 7000, 0, 0, 2, 0, 8, 'sunday', 0, NULL, '2019-05-01 16:47:16', '2019-05-01 16:47:16'),
(629, '15', 'RABINDRA SWAIN', 1, NULL, NULL, NULL, NULL, 11000, 0, 0, 2, 0, 12, 'sunday', 1, NULL, '2019-05-01 16:47:16', '2019-05-01 16:47:16'),
(630, '16', 'SUKANTA KANUNGO', 1, NULL, NULL, NULL, NULL, 6500, 0, 0, 2, 0, 12, 'sunday', 1, NULL, '2019-05-01 16:47:16', '2019-05-01 16:47:16'),
(631, '17', 'SUBAL NATH', 1, NULL, NULL, NULL, NULL, 10000, 0, 0, 2, 0, 12, 'sunday', 0, NULL, '2019-05-01 16:47:16', '2019-05-01 16:47:16'),
(632, '18', 'DEBADATTA BEHERA', 1, NULL, NULL, NULL, NULL, 10000, 0, 0, 2, 0, 12, 'sunday', 0, NULL, '2019-05-01 16:47:16', '2019-05-01 16:47:16'),
(633, '19', 'JAGANNATH RATH', 1, NULL, NULL, NULL, NULL, 30000, 0, 0, 2, 2, 8, 'sunday', 0, NULL, '2019-05-01 16:47:16', '2019-05-01 16:47:16'),
(634, '20', 'SONALI BISWAL', 2, NULL, NULL, NULL, NULL, 13000, 0, 0, 2, 0, 8, 'sunday', 0, NULL, '2019-05-01 16:47:16', '2019-05-01 16:47:16'),
(635, '21', 'ASWINI KUMAR TARAI', 1, NULL, NULL, NULL, NULL, 17000, 0, 0, 2, 0, 12, 'sunday', 0, NULL, '2019-05-01 16:47:16', '2019-05-01 16:47:16'),
(636, '22', 'AMIT BEHERA', 1, NULL, NULL, NULL, NULL, 7500, 0, 0, 2, 0, 12, 'sunday', 1, NULL, '2019-05-01 16:47:16', '2019-05-01 16:47:16'),
(637, '23', 'BISWARANJAN BEHERA', 1, NULL, NULL, NULL, NULL, 10500, 0, 0, 2, 0, 12, 'sunday', 1, NULL, '2019-05-01 16:47:16', '2019-05-01 16:47:16'),
(638, '24', 'SANGRAM DAS', 1, NULL, NULL, NULL, NULL, 11000, 0, 0, 2, 0, 12, 'sunday', 1, NULL, '2019-05-01 16:47:16', '2019-05-01 16:47:16'),
(639, '25', 'JINI DIGAL', 2, NULL, NULL, NULL, NULL, 5500, 0, 0, 2, 0, 8, '', 1, NULL, '2019-05-01 16:47:16', '2019-05-01 16:47:16'),
(640, '26', 'LAKITA JENA', 2, '1970-01-01 00:00:00', NULL, NULL, NULL, 7000, 0, 1, 2, 2, 8, 'sunday', 1, NULL, '2019-05-01 16:47:16', '2019-05-01 16:47:16'),
(641, '27', 'SANJULATA APAT', 2, NULL, NULL, NULL, NULL, 10000, 0, 0, 2, 0, 8, 'sunday', 1, NULL, '2019-05-01 16:47:16', '2019-05-01 16:47:16'),
(642, '28', 'ABINASH BARIK', 1, NULL, NULL, NULL, NULL, 9000, 0, 0, 2, 0, 12, 'sunday', 0, NULL, '2019-05-01 16:47:16', '2019-05-01 16:47:16'),
(643, '29', 'JAMILUR REHEMAN KHAN', 1, NULL, NULL, NULL, NULL, 20000, 0, 0, 2, 0, 12, 'sunday', 0, NULL, '2019-05-01 16:47:16', '2019-05-01 16:47:16');

-- --------------------------------------------------------

--
-- Table structure for table `esi_epf`
--

CREATE TABLE `esi_epf` (
  `id` int(11) NOT NULL,
  `emp_id` varchar(200) NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `days_present` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `esi_epf`
--

INSERT INTO `esi_epf` (`id`, `emp_id`, `month`, `year`, `days_present`) VALUES
(1, '616', 4, 2019, 31),
(2, '617', 4, 2019, 31),
(3, '618', 4, 2019, 29),
(4, '619', 4, 2019, 27),
(5, '620', 4, 2019, 34),
(6, '621', 4, 2019, 29),
(7, '622', 4, 2019, 29),
(8, '623', 4, 2019, 35),
(9, '624', 4, 2019, 32),
(10, '625', 4, 2019, 11),
(11, '627', 4, 2019, 27),
(12, '629', 4, 2019, 27),
(13, '630', 4, 2019, 31),
(14, '636', 4, 2019, 26),
(15, '637', 4, 2019, 31),
(16, '638', 4, 2019, 27),
(17, '639', 4, 2019, 18),
(18, '640', 4, 2019, 32),
(19, '641', 4, 2019, 29);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mobile`
--

CREATE TABLE `mobile` (
  `id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `amnt` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mobile`
--

INSERT INTO `mobile` (`id`, `emp_id`, `month`, `year`, `amnt`) VALUES
(1, 640, 6, 2019, 100);

-- --------------------------------------------------------

--
-- Table structure for table `ot`
--

CREATE TABLE `ot` (
  `id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `hrs` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ot`
--

INSERT INTO `ot` (`id`, `emp_id`, `date`, `month`, `year`, `hrs`) VALUES
(1, 615, 1, 4, 2019, 12),
(2, 615, 25, 5, 2019, 12),
(3, 634, 1, 4, 2019, 8.5),
(4, 634, 4, 4, 2019, 8.5),
(5, 634, 5, 4, 2019, 8.5),
(6, 634, 9, 4, 2019, 8.5),
(7, 634, 10, 4, 2019, 8.5),
(8, 634, 13, 4, 2019, 8.5),
(9, 634, 15, 4, 2019, 8.5),
(10, 634, 11, 4, 2019, 7),
(11, 634, 17, 4, 2019, 7),
(12, 634, 1, 5, 2019, 8.5),
(13, 641, 1, 5, 2019, 8.5),
(14, 640, 1, 5, 2019, 9),
(15, 615, 1, 5, 2019, 12),
(16, 618, 1, 4, 2019, 12),
(17, 642, 1, 4, 2019, 12),
(18, 616, 1, 4, 2019, 12),
(19, 615, 8, 4, 2019, 12),
(20, 615, 9, 4, 2019, 12),
(21, 615, 28, 4, 2019, 12),
(22, 619, 15, 4, 2019, 8),
(23, 626, 3, 4, 2019, 11),
(24, 626, 4, 4, 2019, 11),
(25, 627, 6, 4, 2019, 11),
(26, 626, 18, 4, 2019, 11),
(27, 626, 12, 4, 2019, 8),
(28, 616, 12, 4, 2019, 12),
(29, 622, 6, 4, 2019, 11),
(30, 622, 8, 4, 2019, 11),
(31, 622, 12, 4, 2019, 11),
(32, 622, 15, 4, 2019, 10),
(33, 622, 16, 4, 2019, 11),
(34, 622, 19, 4, 2019, 11),
(35, 622, 22, 4, 2019, 11),
(36, 622, 20, 4, 2019, 11),
(37, 622, 23, 4, 2019, 11),
(38, 622, 26, 4, 2019, 11),
(39, 622, 27, 4, 2019, 11),
(40, 622, 29, 4, 2019, 11),
(41, 622, 30, 4, 2019, 9),
(42, 621, 4, 4, 2019, 9),
(43, 621, 6, 4, 2019, 11),
(44, 621, 9, 4, 2019, 11),
(45, 621, 12, 4, 2019, 11),
(46, 621, 15, 4, 2019, 11),
(47, 621, 16, 4, 2019, 11),
(48, 621, 17, 4, 2019, 11),
(49, 621, 18, 4, 2019, 11),
(50, 621, 19, 4, 2019, 9),
(51, 621, 22, 4, 2019, 11),
(52, 621, 25, 4, 2019, 11),
(53, 621, 7, 4, 2019, 4),
(54, 619, 4, 4, 2019, 11),
(55, 619, 5, 4, 2019, 8),
(56, 619, 8, 4, 2019, 11),
(57, 619, 11, 4, 2019, 11),
(58, 619, 16, 4, 2019, 11),
(59, 619, 18, 4, 2019, 11),
(60, 619, 20, 4, 2019, 11),
(61, 619, 6, 4, 2019, 11),
(62, 638, 30, 4, 2019, 15),
(63, 638, 5, 4, 2019, 15),
(64, 638, 8, 4, 2019, 15),
(65, 638, 12, 4, 2019, 15),
(66, 638, 15, 4, 2019, 15),
(67, 638, 16, 4, 2019, 15),
(68, 638, 17, 4, 2019, 15),
(69, 638, 18, 4, 2019, 15),
(70, 638, 19, 4, 2019, 15),
(71, 638, 22, 4, 2019, 15),
(72, 638, 26, 4, 2019, 15),
(73, 638, 23, 4, 2019, 15),
(74, 638, 24, 4, 2019, 15),
(75, 638, 25, 4, 2019, 15),
(76, 641, 1, 4, 2019, 8.5),
(77, 641, 5, 4, 2019, 8.5),
(78, 641, 8, 4, 2019, 7),
(79, 641, 9, 4, 2019, 8.5),
(80, 641, 10, 4, 2019, 8.5),
(81, 641, 11, 4, 2019, 8.5),
(82, 641, 16, 4, 2019, 8.5),
(83, 641, 17, 4, 2019, 8.5),
(84, 641, 18, 4, 2019, 7.5),
(85, 641, 22, 4, 2019, 9),
(86, 641, 23, 4, 2019, 9),
(87, 641, 25, 4, 2019, 9),
(88, 641, 27, 4, 2019, 9),
(89, 641, 30, 4, 2019, 8.5),
(90, 640, 10, 4, 2019, 8.5),
(91, 640, 5, 4, 2019, 8.5),
(92, 640, 4, 4, 2019, 8.5),
(93, 640, 2, 4, 2019, 8.5),
(94, 640, 1, 4, 2019, 9),
(95, 640, 6, 4, 2019, 7),
(96, 615, 10, 6, 2019, 12),
(97, 615, 22, 4, 2019, 112.5);

-- --------------------------------------------------------

--
-- Table structure for table `others`
--

CREATE TABLE `others` (
  `id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `amnt` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `salary_settings`
--

CREATE TABLE `salary_settings` (
  `id` int(11) NOT NULL,
  `sett_key` varchar(200) NOT NULL,
  `sett_value` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `salary_settings`
--

INSERT INTO `salary_settings` (`id`, `sett_key`, `sett_value`) VALUES
(1, 'esi_emp', '1.75'),
(2, 'esi_empr', '4.75'),
(3, 'epf_emp', '12'),
(4, 'epf_empr', '13.61'),
(5, 'elec_unit', '5');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Nishant Kumar', 'nishant6639@gmail.com', NULL, '$2y$10$FGob4nTutUKEOD1tCiTtJeNk.1xNsCE4BhcmFvm72ABxyjmQxUp2O', 'hH750EfmtDHOZqtp8x9xkhYUtySx6jpfgChirBvxpyYNeHBg72DFsqImVOdP', '2019-03-07 12:58:53', '2019-03-07 12:58:53'),
(2, 'Srishti Mega Infra India', 'info.smilgroup2@gmail.com', NULL, '$2y$10$kt.KHN2LUye8403T2NxK7.7PHoANA7Wem8Xpv4QXCbQTzMhJSotUK', 'CVlTCG6VJIwypsrQ4vkEbESMxft7xwXCAJ57TUb5iaCcwuoZZteTSo11u0ck', '2019-04-01 12:11:58', '2019-04-01 12:11:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cash`
--
ALTER TABLE `cash`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `daily_attendance`
--
ALTER TABLE `daily_attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `daily_employees`
--
ALTER TABLE `daily_employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `daily_ot`
--
ALTER TABLE `daily_ot`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `electricity`
--
ALTER TABLE `electricity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `esi_epf`
--
ALTER TABLE `esi_epf`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mobile`
--
ALTER TABLE `mobile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ot`
--
ALTER TABLE `ot`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `others`
--
ALTER TABLE `others`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `salary_settings`
--
ALTER TABLE `salary_settings`
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
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `cash`
--
ALTER TABLE `cash`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
--
-- AUTO_INCREMENT for table `daily_attendance`
--
ALTER TABLE `daily_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `daily_employees`
--
ALTER TABLE `daily_employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `daily_ot`
--
ALTER TABLE `daily_ot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `electricity`
--
ALTER TABLE `electricity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=644;
--
-- AUTO_INCREMENT for table `esi_epf`
--
ALTER TABLE `esi_epf`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mobile`
--
ALTER TABLE `mobile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ot`
--
ALTER TABLE `ot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;
--
-- AUTO_INCREMENT for table `others`
--
ALTER TABLE `others`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `salary_settings`
--
ALTER TABLE `salary_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
