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
-- Database: `thitishka`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` int(10) UNSIGNED NOT NULL,
  `log_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `subject_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `causer_id` int(11) DEFAULT NULL,
  `causer_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `properties` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`id`, `log_name`, `description`, `subject_id`, `subject_type`, `causer_id`, `causer_type`, `properties`, `created_at`, `updated_at`) VALUES
(2, 'default', 'created', 17, 'App\\Models\\MessageCounter', 1, 'App\\User', '{"attributes":{"id":17,"unread":0,"read":0,"total":0,"user_id":66,"created_at":"2019-03-18 00:20:14","updated_at":"2019-03-18 00:20:14","deleted_at":null}}', '2019-03-18 00:20:14', '2019-03-18 00:20:14'),
(3, 'default', 'created', 18, 'App\\Models\\MessageCounter', 1, 'App\\User', '{"attributes":{"id":18,"unread":0,"read":0,"total":0,"user_id":67,"created_at":"2019-03-18 00:24:42","updated_at":"2019-03-18 00:24:42","deleted_at":null}}', '2019-03-18 00:24:42', '2019-03-18 00:24:42'),
(4, 'default', 'created', 9, 'App\\Models\\Plan', 67, 'App\\User', '{"attributes":{"id":9,"name":"Silver Plan","tagline":"This is the description of this plan","max_organization":10,"max_sponsor_admin":5,"max_organization_user":10000,"max_department":5,"max_program_per_department":2,"max_grade":4,"max_subgrade_per_grade":2,"max_topic_per_grade":12,"max_subject_per_grade":11,"max_chapter_per_subject":10,"max_section_per_chapter":6,"max_storage":1024,"max_bandwidth":1000,"shared":1,"created_at":"2019-03-18 01:23:27","updated_at":"2019-03-18 01:23:27","deleted_at":null}}', '2019-03-18 01:23:27', '2019-03-18 01:23:27'),
(5, 'default', 'created', 14, 'App\\Models\\Sponsor', 67, 'App\\User', '{"attributes":{"id":14,"name":"Tata group","tagline":"Multinational conglomerate company","description":"Tata Group is an Indian multinational conglomerate holding company headquartered in Mumbai, Maharashtra, India. Founded in 1868 by Jamsetji Tata, the company gained international recognition after purchasing several global companies. One of India\'s largest conglomerates, Tata Group is owned by Tata Sons.","email":"nishant.2011in@gmail.com","email_verified":1,"mobile":9439416692,"mobile_verified":1,"address":"Jamshedpur, Jharkhand","plan_id":9,"stream_room":"065642","created_at":"2019-03-18 11:21:30","updated_at":"2019-03-18 11:21:30","deleted_at":null}}', '2019-03-18 11:21:30', '2019-03-18 11:21:30'),
(6, 'default', 'created', 1, 'App\\Models\\Organization', 67, 'App\\User', '{"attributes":{"id":1,"name":"Motilal Nehru Public School","tagline":"This is the taglinbe","description":"Motilal Nehru public school is an ICSE affiliated school situated at Northern Town, Bistupur, Jamshedpur","email":"nishant060990@gmail.com","email_verified":1,"mobile":9439416692,"mobile_verified":1,"is_school":1,"address":"Jamshedpur, Jharkhand","sponsor_id":14,"is_default":0,"stream_room":"525094","medium":0,"channel_id":null,"created_at":"2019-03-18 11:42:52","updated_at":"2019-03-18 11:42:52","deleted_at":null}}', '2019-03-18 11:42:52', '2019-03-18 11:42:52'),
(7, 'default', 'created', 1, 'App\\Models\\Department', 67, 'App\\User', '{"attributes":{"id":1,"name":"Motilal Nehru Public School_dept","is_default":1,"organization_id":1,"stream_room":"002102","created_at":"2019-03-18 11:42:52","updated_at":"2019-03-18 11:42:52","deleted_at":null}}', '2019-03-18 11:42:52', '2019-03-18 11:42:52'),
(8, 'default', 'created', 21, 'App\\Models\\Program', 67, 'App\\User', '{"attributes":{"id":21,"name":"Motilal Nehru Public School_prg","department_id":1,"stream_room":"330777","is_default":1,"created_at":"2019-03-18 11:42:52","updated_at":"2019-03-18 11:42:52","deleted_at":null}}', '2019-03-18 11:42:52', '2019-03-18 11:42:52'),
(9, 'default', 'created', 1, 'App\\Models\\Grade', 1, 'App\\User', '{"attributes":{"id":1,"name":"Grade 1","program_id":21,"stream_room":"333544","created_at":"2019-03-18 19:03:37","updated_at":"2019-03-18 19:03:37","deleted_at":null}}', '2019-03-18 19:03:37', '2019-03-18 19:03:37'),
(10, 'default', 'created', 1, 'App\\Models\\Subgrade', 1, 'App\\User', '{"attributes":{"id":1,"name":"Section A","grade_id":1,"stream_room":"079684","channel_id":null,"medium":0,"created_at":"2019-03-18 19:12:09","updated_at":"2019-03-18 19:12:09","deleted_at":null}}', '2019-03-18 19:12:09', '2019-03-18 19:12:09'),
(11, 'default', 'created', 2, 'App\\Models\\Subgrade', 1, 'App\\User', '{"attributes":{"id":2,"name":"Section B","grade_id":1,"stream_room":"306404","channel_id":null,"medium":0,"created_at":"2019-03-18 19:12:18","updated_at":"2019-03-18 19:12:18","deleted_at":null}}', '2019-03-18 19:12:18', '2019-03-18 19:12:18'),
(12, 'default', 'created', 3, 'App\\Models\\Subgrade', 1, 'App\\User', '{"attributes":{"id":3,"name":"Section C","grade_id":1,"stream_room":"825222","channel_id":null,"medium":0,"created_at":"2019-03-18 19:12:25","updated_at":"2019-03-18 19:12:25","deleted_at":null}}', '2019-03-18 19:12:25', '2019-03-18 19:12:25'),
(13, 'default', 'deleted', 1, 'App\\Models\\Subgrade', 1, 'App\\User', '{"attributes":{"id":1,"name":"Section A","grade_id":1,"stream_room":"079684","channel_id":null,"medium":0,"created_at":"2019-03-18 19:12:09","updated_at":"2019-03-19 01:31:39","deleted_at":"2019-03-19 01:31:39"}}', '2019-03-19 01:31:39', '2019-03-19 01:31:39'),
(14, 'default', 'updated', 9, 'App\\Models\\Plan', 66, 'App\\User', '{"attributes":{"id":9,"name":"Silver Plan","tagline":"This is the description of this plan","max_organization":10,"max_sponsor_admin":5,"max_organization_user":10000,"max_department":5,"max_program_per_department":2,"max_grade":10,"max_subgrade_per_grade":2,"max_topic_per_grade":12,"max_subject_per_grade":11,"max_chapter_per_subject":10,"max_section_per_chapter":6,"max_storage":1024,"max_bandwidth":1000,"shared":1,"created_at":"2019-03-18 01:23:27","updated_at":"2019-03-19 08:28:45","deleted_at":null},"old":{"id":9,"name":"Silver Plan","tagline":"This is the description of this plan","max_organization":10,"max_sponsor_admin":5,"max_organization_user":10000,"max_department":5,"max_program_per_department":2,"max_grade":4,"max_subgrade_per_grade":2,"max_topic_per_grade":12,"max_subject_per_grade":11,"max_chapter_per_subject":10,"max_section_per_chapter":6,"max_storage":1024,"max_bandwidth":1000,"shared":1,"created_at":"2019-03-18 01:23:27","updated_at":"2019-03-18 01:23:27","deleted_at":null}}', '2019-03-19 08:28:45', '2019-03-19 08:28:45'),
(15, 'default', 'created', 2, 'App\\Models\\Organization', 66, 'App\\User', '{"attributes":{"id":2,"name":"RVS Enginnering College","tagline":"Best private engineering college in Jharkhand","description":"Creation of Human Asset through employable education in contemporary technology. To be at par excellence Technical Education Centre. Education is universally recognized as an important investment in building human capital which is a driver for technological innovation and economic growth. Application of science and engineering.","email":"rvs@gmail.com","email_verified":1,"mobile":9110911010,"mobile_verified":1,"is_school":0,"address":"R.V.S.C.E.T, Binda Apartments, Mills Area,Behind Basant Cinema, Sakchi, Jamshedpur-831001","sponsor_id":14,"is_default":0,"stream_room":"780209","medium":0,"channel_id":null,"created_at":"2019-03-19 13:10:37","updated_at":"2019-03-19 13:10:37","deleted_at":null}}', '2019-03-19 13:10:37', '2019-03-19 13:10:37'),
(16, 'default', 'created', 2, 'App\\Models\\Department', 66, 'App\\User', '{"attributes":{"id":2,"name":"RVS Enginnering College_dept","is_default":1,"organization_id":2,"stream_room":"640790","created_at":"2019-03-19 13:10:37","updated_at":"2019-03-19 13:10:37","deleted_at":null}}', '2019-03-19 13:10:37', '2019-03-19 13:10:37'),
(17, 'default', 'created', 3, 'App\\Models\\Department', 66, 'App\\User', '{"attributes":{"id":3,"name":"Electrical","is_default":0,"organization_id":2,"stream_room":"079617","created_at":"2019-03-19 13:12:27","updated_at":"2019-03-19 13:12:27","deleted_at":null}}', '2019-03-19 13:12:27', '2019-03-19 13:12:27'),
(18, 'default', 'created', 22, 'App\\Models\\Program', 66, 'App\\User', '{"attributes":{"id":22,"name":"Electrical program","department_id":3,"stream_room":"255074","is_default":1,"created_at":"2019-03-19 13:12:27","updated_at":"2019-03-19 13:12:27","deleted_at":null}}', '2019-03-19 13:12:27', '2019-03-19 13:12:27'),
(19, 'default', 'created', 23, 'App\\Models\\Program', 66, 'App\\User', '{"attributes":{"id":23,"name":"Btech","department_id":3,"stream_room":"671839","is_default":0,"created_at":"2019-03-19 13:13:18","updated_at":"2019-03-19 13:13:18","deleted_at":null}}', '2019-03-19 13:13:18', '2019-03-19 13:13:18'),
(20, 'default', 'created', 2, 'App\\Models\\Grade', 66, 'App\\User', '{"attributes":{"id":2,"name":"1st year","program_id":23,"stream_room":"792422","created_at":"2019-03-19 13:13:34","updated_at":"2019-03-19 13:13:34","deleted_at":null}}', '2019-03-19 13:13:34', '2019-03-19 13:13:34'),
(21, 'default', 'created', 3, 'App\\Models\\Grade', 66, 'App\\User', '{"attributes":{"id":3,"name":"2nd Year","program_id":23,"stream_room":"615008","created_at":"2019-03-19 13:14:16","updated_at":"2019-03-19 13:14:16","deleted_at":null}}', '2019-03-19 13:14:16', '2019-03-19 13:14:16'),
(22, 'default', 'created', 4, 'App\\Models\\Grade', 66, 'App\\User', '{"attributes":{"id":4,"name":"3rd year","program_id":23,"stream_room":"901675","created_at":"2019-03-19 13:14:29","updated_at":"2019-03-19 13:14:29","deleted_at":null}}', '2019-03-19 13:14:29', '2019-03-19 13:14:29'),
(23, 'default', 'created', 5, 'App\\Models\\Grade', 66, 'App\\User', '{"attributes":{"id":5,"name":"4th year","program_id":23,"stream_room":"426684","created_at":"2019-03-19 13:14:42","updated_at":"2019-03-19 13:14:42","deleted_at":null}}', '2019-03-19 13:14:42', '2019-03-19 13:14:42'),
(24, 'default', 'created', 4, 'App\\Models\\Subgrade', 66, 'App\\User', '{"attributes":{"id":4,"name":"Class 123","grade_id":2,"stream_room":"849668","channel_id":null,"medium":0,"created_at":"2019-03-19 13:16:38","updated_at":"2019-03-19 13:16:38","deleted_at":null}}', '2019-03-19 13:16:38', '2019-03-19 13:16:38'),
(25, 'default', 'created', 5, 'App\\Models\\Subgrade', 66, 'App\\User', '{"attributes":{"id":5,"name":"class 124","grade_id":2,"stream_room":"771416","channel_id":null,"medium":0,"created_at":"2019-03-19 13:16:55","updated_at":"2019-03-19 13:16:55","deleted_at":null}}', '2019-03-19 13:16:55', '2019-03-19 13:16:55'),
(26, 'default', 'created', 19, 'App\\Models\\Subject', 66, 'App\\User', '{"attributes":{"id":19,"name":"Basic Electrical","grade_id":2,"created_at":"2019-03-21 08:29:16","updated_at":"2019-03-21 08:29:16","deleted_at":null}}', '2019-03-21 08:29:16', '2019-03-21 08:29:16'),
(27, 'default', 'created', 19, 'App\\Models\\MessageCounter', 66, 'App\\User', '{"attributes":{"id":19,"unread":0,"read":0,"total":0,"user_id":71,"created_at":"2019-03-21 08:32:46","updated_at":"2019-03-21 08:32:46","deleted_at":null}}', '2019-03-21 08:32:46', '2019-03-21 08:32:46'),
(28, 'default', 'created', 1, 'App\\Models\\ClassroomAssignedUser', 66, 'App\\User', '{"attributes":{"id":1,"subgrade_id":4,"user_id":71,"is_enabled":1,"is_teacher":1,"created_at":"2019-03-21 08:33:09","updated_at":"2019-03-21 08:33:09","deleted_at":null}}', '2019-03-21 08:33:09', '2019-03-21 08:33:09'),
(29, 'default', 'created', 3, 'App\\Models\\Organization', 1, 'App\\User', '{"attributes":{"id":3,"name":"Motilal Nehru Public School - Campus 2","tagline":"Codession","description":"Motilal Nehru public school is an ICSE affiliated school situated at Northern Town, Bistupur, Jamshedpur","email":"xyz@gmail.com","email_verified":1,"mobile":9234734567,"mobile_verified":1,"is_school":1,"address":"Motilal Nehru public school is an ICSE affiliated school situated at Northern Town, Bistupur, Jamshedpur","sponsor_id":14,"is_default":0,"stream_room":"265744","medium":0,"channel_id":null,"created_at":"2019-03-21 16:40:49","updated_at":"2019-03-21 16:40:49","deleted_at":null}}', '2019-03-21 16:40:49', '2019-03-21 16:40:49'),
(30, 'default', 'created', 4, 'App\\Models\\Department', 1, 'App\\User', '{"attributes":{"id":4,"name":"Motilal Nehru Public School - Campus 2_dept","is_default":1,"organization_id":3,"stream_room":"868336","created_at":"2019-03-21 16:40:50","updated_at":"2019-03-21 16:40:50","deleted_at":null}}', '2019-03-21 16:40:50', '2019-03-21 16:40:50'),
(31, 'default', 'created', 24, 'App\\Models\\Program', 1, 'App\\User', '{"attributes":{"id":24,"name":"Motilal Nehru Public School - Campus 2_prg","department_id":4,"stream_room":"875042","is_default":1,"created_at":"2019-03-21 16:40:50","updated_at":"2019-03-21 16:40:50","deleted_at":null}}', '2019-03-21 16:40:50', '2019-03-21 16:40:50'),
(32, 'default', 'updated', 9, 'App\\Models\\Plan', 66, 'App\\User', '{"attributes":{"id":9,"name":"Silver Plan","tagline":"This is the description of this plan","max_organization":10,"max_sponsor_admin":5,"max_organization_user":10000,"max_department":5,"max_program_per_department":2,"max_grade":10,"max_subgrade_per_grade":2,"max_topic_per_grade":12,"max_subject_per_grade":11,"max_chapter_per_subject":10,"max_section_per_chapter":6,"max_storage":1000,"max_bandwidth":2,"shared":1,"created_at":"2019-03-18 01:23:27","updated_at":"2019-03-24 05:04:00","deleted_at":null},"old":{"id":9,"name":"Silver Plan","tagline":"This is the description of this plan","max_organization":10,"max_sponsor_admin":5,"max_organization_user":10000,"max_department":5,"max_program_per_department":2,"max_grade":10,"max_subgrade_per_grade":2,"max_topic_per_grade":12,"max_subject_per_grade":11,"max_chapter_per_subject":10,"max_section_per_chapter":6,"max_storage":1024,"max_bandwidth":1000,"shared":1,"created_at":"2019-03-18 01:23:27","updated_at":"2019-03-19 08:28:45","deleted_at":null}}', '2019-03-24 05:04:00', '2019-03-24 05:04:00'),
(33, 'default', 'created', 10, 'App\\Models\\Plan', 1, 'App\\User', '{"attributes":{"id":10,"name":"Small Plan","tagline":"This Plan is suitable to manage 4 to 5 organizations","max_organization":5,"max_sponsor_admin":10,"max_organization_user":10000,"max_department":10,"max_program_per_department":10,"max_grade":10,"max_subgrade_per_grade":10,"max_topic_per_grade":10,"max_subject_per_grade":15,"max_chapter_per_subject":20,"max_section_per_chapter":50,"max_storage":1200,"max_bandwidth":2,"shared":1,"created_at":"2019-03-24 09:27:44","updated_at":"2019-03-24 09:27:44","deleted_at":null}}', '2019-03-24 09:27:44', '2019-03-24 09:27:44'),
(34, 'default', 'created', 11, 'App\\Models\\Plan', 1, 'App\\User', '{"attributes":{"id":11,"name":"Small Plan","tagline":"This Plan is suitable to manage 4 to 5 organizations","max_organization":5,"max_sponsor_admin":10,"max_organization_user":10000,"max_department":10,"max_program_per_department":10,"max_grade":10,"max_subgrade_per_grade":10,"max_topic_per_grade":10,"max_subject_per_grade":15,"max_chapter_per_subject":20,"max_section_per_chapter":50,"max_storage":1200,"max_bandwidth":2,"shared":1,"created_at":"2019-03-24 09:30:37","updated_at":"2019-03-24 09:30:37","deleted_at":null}}', '2019-03-24 09:30:37', '2019-03-24 09:30:37'),
(35, 'default', 'created', 12, 'App\\Models\\Plan', 1, 'App\\User', '{"attributes":{"id":12,"name":"Small Plan","tagline":"This Plan is suitable to manage 4 to 5 organizations","max_organization":5,"max_sponsor_admin":10,"max_organization_user":10000,"max_department":10,"max_program_per_department":10,"max_grade":10,"max_subgrade_per_grade":10,"max_topic_per_grade":10,"max_subject_per_grade":15,"max_chapter_per_subject":20,"max_section_per_chapter":50,"max_storage":1200,"max_bandwidth":2,"shared":1,"created_at":"2019-03-24 09:33:13","updated_at":"2019-03-24 09:33:13","deleted_at":null}}', '2019-03-24 09:33:13', '2019-03-24 09:33:13'),
(36, 'default', 'created', 15, 'App\\Models\\Sponsor', 66, 'App\\User', '{"attributes":{"id":15,"name":"Anjali Group","tagline":"Learn together , Grow together","description":"Best fot primary and secondary education","email":"contact.anjalisoftwares@gmail.com","email_verified":1,"mobile":9110918743,"mobile_verified":1,"address":"Patia Bhubaneshwar","plan_id":12,"stream_room":"026887","created_at":"2019-03-29 06:35:20","updated_at":"2019-03-29 06:35:20","deleted_at":null}}', '2019-03-29 06:35:20', '2019-03-29 06:35:20'),
(37, 'default', 'created', 4, 'App\\Models\\Organization', 66, 'App\\User', '{"attributes":{"id":4,"name":"Mamta school","tagline":"Best for Primary Education","description":"Only for Primary education till 10th std","email":"mamtamahato.contact@gmail.com","email_verified":1,"mobile":9110918744,"mobile_verified":1,"is_school":1,"address":"Patia , Shree vihar","sponsor_id":15,"is_default":0,"stream_room":"712651","medium":0,"channel_id":null,"created_at":"2019-03-29 07:06:47","updated_at":"2019-03-29 07:06:47","deleted_at":null}}', '2019-03-29 07:06:47', '2019-03-29 07:06:47'),
(38, 'default', 'created', 17, 'App\\Models\\Exam', 1, 'App\\User', '{"attributes":{"id":17,"name":"Exam 1 of basic electrical","start_date_time":"2019-03-30 03:30:47","end_date_time":"2019-03-30 06:46:59","exam_head":71,"total_marks":100,"is_confirmed":1,"is_over":0,"is_started":0,"is_upcoming":1,"result_announced":0,"grade_id":2,"for_all_classroom":0,"subgrade_id":4,"subject_id":19,"topic_id":null,"selected_set":null,"created_at":"2019-03-30 15:47:10","updated_at":"2019-03-30 15:47:10","deleted_at":null}}', '2019-03-30 15:47:10', '2019-03-30 15:47:10'),
(39, 'default', 'created', 18, 'App\\Models\\Exam', 66, 'App\\User', '{"attributes":{"id":18,"name":"first api","start_date_time":"2019-03-31 12:31:02","end_date_time":"2019-03-31 08:31:03","exam_head":71,"total_marks":100,"is_confirmed":1,"is_over":0,"is_started":0,"is_upcoming":1,"result_announced":0,"grade_id":2,"for_all_classroom":0,"subgrade_id":4,"subject_id":19,"topic_id":null,"selected_set":null,"created_at":"2019-03-31 00:31:29","updated_at":"2019-03-31 00:31:29","deleted_at":null}}', '2019-03-31 00:31:29', '2019-03-31 00:31:29'),
(40, 'default', 'created', 19, 'App\\Models\\Exam', 66, 'App\\User', '{"attributes":{"id":19,"name":"first api","start_date_time":"2019-03-31 12:32:22","end_date_time":"2019-03-31 03:32:25","exam_head":71,"total_marks":100,"is_confirmed":1,"is_over":0,"is_started":0,"is_upcoming":1,"result_announced":0,"grade_id":2,"for_all_classroom":0,"subgrade_id":4,"subject_id":19,"topic_id":null,"selected_set":null,"created_at":"2019-03-31 00:32:30","updated_at":"2019-03-31 00:32:30","deleted_at":null}}', '2019-03-31 00:32:30', '2019-03-31 00:32:30'),
(41, 'default', 'created', 20, 'App\\Models\\Exam', 66, 'App\\User', '{"attributes":{"id":20,"name":"first api","start_date_time":"2019-03-31 12:49:11","end_date_time":"2019-03-31 09:49:17","exam_head":71,"total_marks":100,"is_confirmed":1,"is_over":0,"is_started":0,"is_upcoming":1,"result_announced":0,"grade_id":2,"for_all_classroom":0,"subgrade_id":4,"subject_id":19,"topic_id":null,"selected_set":null,"created_at":"2019-03-31 00:49:32","updated_at":"2019-03-31 00:49:32","deleted_at":null}}', '2019-03-31 00:49:32', '2019-03-31 00:49:32'),
(42, 'default', 'created', 5, 'App\\Models\\Organization', 66, 'App\\User', '{"attributes":{"id":5,"name":"Test","tagline":"sub 1","description":"yjyg","email":"fgfg@bfbfg.hgj","email_verified":1,"mobile":7463024673,"mobile_verified":1,"is_school":0,"address":"ygjgy","sponsor_id":15,"is_default":0,"stream_room":"281357","medium":0,"channel_id":null,"created_at":"2019-03-31 15:35:24","updated_at":"2019-03-31 15:35:24","deleted_at":null}}', '2019-03-31 15:35:24', '2019-03-31 15:35:24'),
(43, 'default', 'created', 6, 'App\\Models\\Organization', 66, 'App\\User', '{"attributes":{"id":6,"name":"Test","tagline":"sub 1","description":"yjyg","email":"fgfg@bfbfg.hgj","email_verified":1,"mobile":7463024673,"mobile_verified":1,"is_school":0,"address":"ygjgy","sponsor_id":15,"is_default":0,"stream_room":"481665","medium":0,"channel_id":null,"created_at":"2019-03-31 15:36:58","updated_at":"2019-03-31 15:36:58","deleted_at":null}}', '2019-03-31 15:36:58', '2019-03-31 15:36:58'),
(44, 'default', 'created', 21, 'App\\Models\\Exam', 66, 'App\\User', '{"attributes":{"id":21,"name":"Recent exam","start_date_time":"2019-03-31 16:50:19","end_date_time":"2019-03-31 19:54:36","exam_head":71,"total_marks":100,"is_confirmed":1,"is_over":0,"is_started":0,"is_upcoming":1,"result_announced":0,"grade_id":2,"for_all_classroom":0,"subgrade_id":4,"subject_id":19,"topic_id":null,"selected_set":null,"created_at":"2019-03-31 16:54:48","updated_at":"2019-03-31 16:54:48","deleted_at":null}}', '2019-03-31 16:54:48', '2019-03-31 16:54:48'),
(45, 'default', 'created', 12, 'App\\Models\\ExamOrganizer', 70, 'App\\User', '[]', '2019-03-31 17:09:26', '2019-03-31 17:09:26'),
(46, 'default', 'created', 19, 'App\\Models\\QuestionSet', 71, 'App\\User', '{"attributes":{"id":19,"name":"Set A","is_submited":0,"is_selected":0,"user_id":71,"exam_id":21,"created_at":"2019-03-31 23:35:11","updated_at":"2019-03-31 23:35:11","deleted_at":null}}', '2019-03-31 23:35:11', '2019-03-31 23:35:11'),
(47, 'default', 'created', 12, 'App\\Models\\QuestionGroup', 71, 'App\\User', '[]', '2019-03-31 23:36:14', '2019-03-31 23:36:14'),
(48, 'default', 'created', 20, 'App\\Models\\Question', 71, 'App\\User', '{"attributes":{"id":20,"heading":"<p>Who is the father of nation?<\\/p>","type":"radio","marks":5,"answer":"1","question_group_id":12,"created_at":"2019-04-02 00:08:08","updated_at":"2019-04-02 00:08:08","deleted_at":null}}', '2019-04-02 00:08:08', '2019-04-02 00:08:08'),
(49, 'default', 'created', 9, 'App\\Models\\Option', 71, 'App\\User', '{"attributes":{"id":9,"first":"Mahatma Gandhi","second":"Jawaharlal Nehru","third":"Subhas chandra bose","fourth":"Bankim chandra chaterjee","right_answer":null,"question_id":20,"created_at":"2019-04-02 00:08:08","updated_at":"2019-04-02 00:08:08","deleted_at":null}}', '2019-04-02 00:08:08', '2019-04-02 00:08:08'),
(50, 'default', 'created', 13, 'App\\Models\\QuestionGroup', 71, 'App\\User', '[]', '2019-04-02 00:08:47', '2019-04-02 00:08:47'),
(51, 'default', 'created', 21, 'App\\Models\\Question', 71, 'App\\User', '{"attributes":{"id":21,"heading":"<p>National capital of India is ________ ?<\\/p>","type":"fill","marks":5,"answer":"New Delhi","question_group_id":13,"created_at":"2019-04-02 00:09:38","updated_at":"2019-04-02 00:09:38","deleted_at":null}}', '2019-04-02 00:09:38', '2019-04-02 00:09:38'),
(52, 'default', 'created', 22, 'App\\Models\\Question', 71, 'App\\User', '{"attributes":{"id":22,"heading":"<p>Capital of Jharkhand is _______?<\\/p>","type":"fill","marks":5,"answer":"Ranchi","question_group_id":12,"created_at":"2019-04-02 00:11:08","updated_at":"2019-04-02 00:11:08","deleted_at":null}}', '2019-04-02 00:11:08', '2019-04-02 00:11:08'),
(53, 'default', 'updated', 19, 'App\\Models\\QuestionSet', 71, 'App\\User', '{"attributes":{"id":19,"name":"Set A","is_submited":1,"is_selected":0,"user_id":71,"exam_id":21,"created_at":"2019-03-31 23:35:11","updated_at":"2019-04-02 00:11:33","deleted_at":null},"old":{"id":19,"name":"Set A","is_submited":0,"is_selected":0,"user_id":71,"exam_id":21,"created_at":"2019-03-31 23:35:11","updated_at":"2019-03-31 23:35:11","deleted_at":null}}', '2019-04-02 00:11:33', '2019-04-02 00:11:33'),
(54, 'default', 'created', 5, 'App\\Models\\Department', 66, 'App\\User', '{"attributes":{"id":5,"name":"Computer Science","is_default":0,"organization_id":6,"stream_room":"344534","created_at":"2019-04-02 00:32:24","updated_at":"2019-04-02 00:32:24","deleted_at":null}}', '2019-04-02 00:32:24', '2019-04-02 00:32:24'),
(55, 'default', 'created', 25, 'App\\Models\\Program', 66, 'App\\User', '{"attributes":{"id":25,"name":"Computer Science program","department_id":5,"stream_room":"738509","is_default":1,"created_at":"2019-04-02 00:32:24","updated_at":"2019-04-02 00:32:24","deleted_at":null}}', '2019-04-02 00:32:24', '2019-04-02 00:32:24'),
(56, 'default', 'created', 26, 'App\\Models\\Program', 66, 'App\\User', '{"attributes":{"id":26,"name":"MTech","department_id":5,"stream_room":"382159","is_default":0,"created_at":"2019-04-02 00:35:20","updated_at":"2019-04-02 00:35:20","deleted_at":null}}', '2019-04-02 00:35:20', '2019-04-02 00:35:20'),
(57, 'default', 'created', 6, 'App\\Models\\Grade', 66, 'App\\User', '{"attributes":{"id":6,"name":"1st Grade Mtech","program_id":26,"stream_room":"453758","created_at":"2019-04-02 00:37:28","updated_at":"2019-04-02 00:37:28","deleted_at":null}}', '2019-04-02 00:37:28', '2019-04-02 00:37:28'),
(58, 'default', 'created', 6, 'App\\Models\\Subgrade', 66, 'App\\User', '{"attributes":{"id":6,"name":"123","grade_id":6,"stream_room":"512636","channel_id":null,"medium":0,"created_at":"2019-04-02 00:37:57","updated_at":"2019-04-02 00:37:57","deleted_at":null}}', '2019-04-02 00:37:57', '2019-04-02 00:37:57'),
(59, 'default', 'created', 20, 'App\\Models\\Subject', 66, 'App\\User', '{"attributes":{"id":20,"name":"Mtech 1","grade_id":6,"created_at":"2019-04-02 00:38:06","updated_at":"2019-04-02 00:38:06","deleted_at":null}}', '2019-04-02 00:38:06', '2019-04-02 00:38:06'),
(60, 'default', 'deleted', 4, 'App\\Models\\Organization', 73, 'App\\User', '{"attributes":{"id":4,"name":"Mamta school","tagline":"Best for Primary Education","description":"Only for Primary education till 10th std","email":"mamtamahato.contact@gmail.com","email_verified":1,"mobile":9110918744,"mobile_verified":1,"is_school":1,"address":"Patia , Shree vihar","sponsor_id":15,"is_default":0,"stream_room":"712651","medium":0,"channel_id":null,"created_at":"2019-03-29 07:06:47","updated_at":"2019-04-02 08:42:48","deleted_at":"2019-04-02 08:42:48"}}', '2019-04-02 08:42:48', '2019-04-02 08:42:48'),
(61, 'default', 'created', 7, 'App\\Models\\Organization', 73, 'App\\User', '{"attributes":{"id":7,"name":"Mamta","tagline":"Best for Primary and Secondary Education","description":"Organization for providing Quality Education","email":"mamtamahato.contact@gmail.com","email_verified":1,"mobile":9110918743,"mobile_verified":1,"is_school":0,"address":"Patia Shree Vihar","sponsor_id":15,"is_default":0,"stream_room":"238765","medium":0,"channel_id":null,"created_at":"2019-04-02 09:23:41","updated_at":"2019-04-02 09:23:41","deleted_at":null}}', '2019-04-02 09:23:41', '2019-04-02 09:23:41'),
(62, 'default', 'created', 8, 'App\\Models\\Organization', 73, 'App\\User', '{"attributes":{"id":8,"name":"Mamta","tagline":"Best for Primary and Secondary Education","description":"Organization for providing Quality Education","email":"mamtamahato.contact@gmail.com","email_verified":1,"mobile":9110918743,"mobile_verified":1,"is_school":0,"address":"Patia Shree Vihar","sponsor_id":15,"is_default":0,"stream_room":"302963","medium":0,"channel_id":null,"created_at":"2019-04-02 09:30:14","updated_at":"2019-04-02 09:30:14","deleted_at":null}}', '2019-04-02 09:30:14', '2019-04-02 09:30:14'),
(63, 'default', 'created', 9, 'App\\Models\\Organization', 73, 'App\\User', '{"attributes":{"id":9,"name":"Mamta","tagline":"Best for Primary and Secondary Education","description":"Organization for providing Quality Education","email":"mamtamahato.contact@gmail.com","email_verified":1,"mobile":9110918743,"mobile_verified":1,"is_school":0,"address":"Patia Shree Vihar","sponsor_id":15,"is_default":0,"stream_room":"881189","medium":0,"channel_id":null,"created_at":"2019-04-02 09:32:06","updated_at":"2019-04-02 09:32:06","deleted_at":null}}', '2019-04-02 09:32:06', '2019-04-02 09:32:06'),
(64, 'default', 'created', 10, 'App\\Models\\Organization', 73, 'App\\User', '{"attributes":{"id":10,"name":"Mamta","tagline":"Best for Primary and Secondary Education","description":"Organization for providing Quality Education","email":"mamtamahato.contact@gmail.com","email_verified":1,"mobile":9110918743,"mobile_verified":1,"is_school":0,"address":"Patia Shree Vihar","sponsor_id":15,"is_default":0,"stream_room":"918158","medium":0,"channel_id":null,"created_at":"2019-04-02 09:35:13","updated_at":"2019-04-02 09:35:13","deleted_at":null}}', '2019-04-02 09:35:13', '2019-04-02 09:35:13'),
(65, 'default', 'created', 6, 'App\\Models\\Department', 73, 'App\\User', '{"attributes":{"id":6,"name":"Mamta_dept","is_default":1,"organization_id":10,"stream_room":"647371","created_at":"2019-04-02 09:35:13","updated_at":"2019-04-02 09:35:13","deleted_at":null}}', '2019-04-02 09:35:13', '2019-04-02 09:35:13'),
(66, 'default', 'created', 11, 'App\\Models\\Organization', 73, 'App\\User', '{"attributes":{"id":11,"name":"Mamta","tagline":"Best for Primary and Secondary Education","description":"Organization for providing Quality Education","email":"mamtamahato.contact@gmail.com","email_verified":1,"mobile":9110918743,"mobile_verified":1,"is_school":0,"address":"Patia Shree Vihar","sponsor_id":15,"is_default":0,"stream_room":"402920","medium":0,"channel_id":null,"created_at":"2019-04-02 09:39:44","updated_at":"2019-04-02 09:39:44","deleted_at":null}}', '2019-04-02 09:39:44', '2019-04-02 09:39:44'),
(67, 'default', 'created', 12, 'App\\Models\\Organization', 73, 'App\\User', '{"attributes":{"id":12,"name":"Mamta","tagline":"Best for Primary and Secondary Education","description":"Organization for providing Quality Education","email":"mamtamahato.contact@gmail.com","email_verified":1,"mobile":9110918743,"mobile_verified":1,"is_school":0,"address":"Patia Shree Vihar","sponsor_id":15,"is_default":0,"stream_room":"423272","medium":0,"channel_id":null,"created_at":"2019-04-02 09:41:51","updated_at":"2019-04-02 09:41:51","deleted_at":null}}', '2019-04-02 09:41:51', '2019-04-02 09:41:51'),
(68, 'default', 'created', 13, 'App\\Models\\Organization', 73, 'App\\User', '{"attributes":{"id":13,"name":"Mamta","tagline":"Best for Primary and Secondary Education","description":"Organization for providing Quality Education","email":"mamtamahato.contact@gmail.com","email_verified":1,"mobile":9110918743,"mobile_verified":1,"is_school":0,"address":"Patia Shree Vihar","sponsor_id":15,"is_default":0,"stream_room":"803251","medium":0,"channel_id":null,"created_at":"2019-04-02 09:42:46","updated_at":"2019-04-02 09:42:46","deleted_at":null}}', '2019-04-02 09:42:46', '2019-04-02 09:42:46'),
(69, 'default', 'created', 7, 'App\\Models\\Department', 73, 'App\\User', '{"attributes":{"id":7,"name":"Mamta_dept","is_default":1,"organization_id":13,"stream_room":"601868","created_at":"2019-04-02 09:42:46","updated_at":"2019-04-02 09:42:46","deleted_at":null}}', '2019-04-02 09:42:46', '2019-04-02 09:42:46'),
(70, 'default', 'created', 14, 'App\\Models\\Organization', 73, 'App\\User', '{"attributes":{"id":14,"name":"Mamta","tagline":"Best for Primary and Secondary Education","description":"Organization for providing Quality Education","email":"mamtamahato.contact@gmail.com","email_verified":1,"mobile":9110918743,"mobile_verified":1,"is_school":0,"address":"Patia Shree Vihar","sponsor_id":15,"is_default":0,"stream_room":"890945","medium":0,"channel_id":null,"created_at":"2019-04-02 09:45:52","updated_at":"2019-04-02 09:45:52","deleted_at":null}}', '2019-04-02 09:45:52', '2019-04-02 09:45:52'),
(71, 'default', 'created', 8, 'App\\Models\\Department', 73, 'App\\User', '{"attributes":{"id":8,"name":"Mamta_dept","is_default":1,"organization_id":14,"stream_room":"167855","created_at":"2019-04-02 09:45:52","updated_at":"2019-04-02 09:45:52","deleted_at":null}}', '2019-04-02 09:45:52', '2019-04-02 09:45:52'),
(72, 'default', 'created', 15, 'App\\Models\\Organization', 73, 'App\\User', '{"attributes":{"id":15,"name":"Mamta","tagline":"Best for Primary and Secondary Education","description":"Organization for providing Quality Education","email":"mamtamahato.contact@gmail.com","email_verified":1,"mobile":9110918743,"mobile_verified":1,"is_school":0,"address":"Patia Shree Vihar","sponsor_id":15,"is_default":0,"stream_room":"426639","medium":0,"channel_id":null,"created_at":"2019-04-02 09:46:29","updated_at":"2019-04-02 09:46:29","deleted_at":null}}', '2019-04-02 09:46:29', '2019-04-02 09:46:29'),
(73, 'default', 'created', 9, 'App\\Models\\Department', 73, 'App\\User', '{"attributes":{"id":9,"name":"Mamta_dept","is_default":1,"organization_id":15,"stream_room":"762585","created_at":"2019-04-02 09:46:29","updated_at":"2019-04-02 09:46:29","deleted_at":null}}', '2019-04-02 09:46:29', '2019-04-02 09:46:29'),
(74, 'default', 'created', 16, 'App\\Models\\Organization', 73, 'App\\User', '{"attributes":{"id":16,"name":"Demo org","tagline":"Best for primary and secondary education","description":"This is for demo only.","email":"demoorg@gmail.com","email_verified":1,"mobile":9110918743,"mobile_verified":1,"is_school":0,"address":"Patia Shree vihar","sponsor_id":15,"is_default":0,"stream_room":"980711","medium":0,"channel_id":null,"created_at":"2019-04-02 09:56:34","updated_at":"2019-04-02 09:56:34","deleted_at":null}}', '2019-04-02 09:56:34', '2019-04-02 09:56:34'),
(75, 'default', 'created', 17, 'App\\Models\\Organization', 73, 'App\\User', '{"attributes":{"id":17,"name":"Demo org","tagline":"Best for primary and secondary education","description":"This is for demo only.","email":"demoorg@gmail.com","email_verified":1,"mobile":9110918743,"mobile_verified":1,"is_school":0,"address":"Patia Shree vihar","sponsor_id":15,"is_default":0,"stream_room":"797551","medium":0,"channel_id":null,"created_at":"2019-04-02 09:58:55","updated_at":"2019-04-02 09:58:55","deleted_at":null}}', '2019-04-02 09:58:55', '2019-04-02 09:58:55'),
(76, 'default', 'created', 18, 'App\\Models\\Organization', 73, 'App\\User', '{"attributes":{"id":18,"name":"Demo org","tagline":"Best for primary and secondary education","description":"This is for demo only.","email":"demoorg@gmail.com","email_verified":1,"mobile":9110918743,"mobile_verified":1,"is_school":0,"address":"Patia Shree vihar","sponsor_id":15,"is_default":0,"stream_room":"141772","medium":0,"channel_id":null,"created_at":"2019-04-02 10:00:04","updated_at":"2019-04-02 10:00:04","deleted_at":null}}', '2019-04-02 10:00:04', '2019-04-02 10:00:04'),
(77, 'default', 'created', 10, 'App\\Models\\Department', 73, 'App\\User', '{"attributes":{"id":10,"name":"Demo org_dept","is_default":1,"organization_id":18,"stream_room":"264222","created_at":"2019-04-02 10:00:04","updated_at":"2019-04-02 10:00:04","deleted_at":null}}', '2019-04-02 10:00:04', '2019-04-02 10:00:04'),
(78, 'default', 'created', 20, 'App\\Models\\MessageCounter', 1, 'App\\User', '{"attributes":{"id":20,"unread":0,"read":0,"total":0,"user_id":79,"created_at":"2019-04-02 10:00:22","updated_at":"2019-04-02 10:00:22","deleted_at":null}}', '2019-04-02 10:00:22', '2019-04-02 10:00:22'),
(79, 'default', 'created', 2, 'App\\Models\\ClassroomAssignedUser', 1, 'App\\User', '{"attributes":{"id":2,"subgrade_id":2,"user_id":79,"is_enabled":1,"is_teacher":0,"created_at":"2019-04-02 10:00:48","updated_at":"2019-04-02 10:00:48","deleted_at":null}}', '2019-04-02 10:00:48', '2019-04-02 10:00:48'),
(80, 'default', 'created', 7, 'App\\Models\\Notice', 1, 'App\\User', '{"attributes":{"id":7,"title":"New Notice","body":"New notice details","subgrade_id":2,"deleted_at":null,"created_at":"2019-04-02 10:04:17","updated_at":"2019-04-02 10:04:17"}}', '2019-04-02 10:04:17', '2019-04-02 10:04:17'),
(81, 'default', 'created', 21, 'App\\Models\\Subject', 1, 'App\\User', '{"attributes":{"id":21,"name":"English","grade_id":1,"created_at":"2019-04-02 10:05:13","updated_at":"2019-04-02 10:05:13","deleted_at":null}}', '2019-04-02 10:05:13', '2019-04-02 10:05:13'),
(82, 'default', 'created', 22, 'App\\Models\\Subject', 1, 'App\\User', '{"attributes":{"id":22,"name":"\\u0b1c\\u0b40\\u0b2c \\u0b2c\\u0b3f\\u0b1c\\u0b4d\\u0b1e\\u0b3e\\u0b28","grade_id":1,"created_at":"2019-04-02 10:13:36","updated_at":"2019-04-02 10:13:36","deleted_at":null}}', '2019-04-02 10:13:36', '2019-04-02 10:13:36'),
(83, 'default', 'created', 9, 'App\\Models\\Introduction', 1, 'App\\User', '{"attributes":{"id":9,"text":"<p>1665 ci\\u00f2j\\u00fb\\u00f9e eaU\\u00f0 j\\u00eaK\\u00fe ^\\u00fbcK a\\u00e2\\u00f2U\\u00f2g \\u00f9a\\u00f7m\\u00fb^\\u00f2K GK KK\\u00f0e _Zk\\u00fb @\\u00f5gK\\u00ea @Y\\u00eaa\\u00falY<\\/p><p>~a\\u00f9e \\u00f9\\\\L\\u00f2 Z\\u00fbj\\u00fb \\u00f9K\\u00f9ZM\\u00eaW\\u00f2G \\u00f9K\\u00fbh\\u00f9e MV\\u00f2Z \\u00f9j\\u00fbA[\\u00f2a\\u00fb RY\\u00fbA\\u00f9f\\u00f6 \\u00f9ij\\u00f2 \\u00f9K\\u00fbhM\\u00eaW\\u00f2K<\\/p><p>cj\\u00ea\\u00f9`Y\\u00fb i\\\\\\u00e9g \\u00f9Q\\u00fbU \\u00f9K\\u00fbVe\\u00fa (P\\u00f2Z\\u00e2 - 1.1) bk\\u00f2 [\\u00f2f\\u00fb\\u00f6<\\/p><p>_\\u00e2\\u00f9Z\\u00fdK R\\u00faaK\\u00ea MV^ Ke\\u00ea[\\u00f2a\\u00fb \\u00f9c\\u00f8k\\u00f2K GKKK\\u00ea \\u2018\\u00f9K\\u00fbh\\u2019 K\\u00eaj\\u00fb~\\u00fbG\\u00f6 GK \\u00f9K\\u00fbh\\u00fa R\\u00faae<\\/p><p>@Y\\u00eaa\\u00falY ~a\\u00f9e<\\/p><p>MV^ \\u00f9M\\u00fbU\\u00f2G c\\u00fbZ\\u00e2 \\u00f9K\\u00fbhK\\u00ea \\u00f9^A \\u00f9j\\u00fbA[\\u00fbG (C\\\\\\u00fbjeY - Gc\\u00f2a\\u00fb)\\u00f6 \\u00f9ic\\u00f2Z\\u00f2 aj\\u00ea\\u00f9K\\u00fbh\\u00fa<\\/p><p>j\\u00eaK \\u0308 \\u00f9\\\\L\\u00f4[\\u00f4a\\u00fb \\u00f9K\\u00fbh<\\/p><p>R\\u00faage\\u00fae @\\u00f9^KM\\u00eaW\\u00f2G \\u00f9K\\u00fbh\\\\\\u00df\\u00fbe\\u00fb \\u00f9j\\u00fbA[\\u00fbG (C\\\\\\u00fbjeY - Z\\u00eac P\\u00fbe\\u00f2_U\\u00f9e [\\u00f2a\\u00fb<\\/p><p>(P\\u00f2Z\\u00e2 - 1.1)<\\/p><p>a\\u00e9lfZ\\u00fb, _g\\u00ea_l\\u00fa, cY\\u00f2h)\\u00f6<\\/p><p>R\\u00faaU\\u00f2G R^\\u00e0\\u00f9^\\u00f9f, \\u00f9i a\\u00f9X\\u00ff\\u00f6 \\u00f9i[\\u00f2_\\u00fbA\\u00f1 \\u00f9i L\\u00fb\\\\\\u00fd<\\/p><p>L\\u00fbG, Z\\u00fbK\\u00ea jRc K\\u00f9e\\u00f6 g\\u00df\\u00fbiK\\u00f2\\u00e2d\\u00fb i\\u03bc\\u00fb\\\\^ K\\u00f9e, @\\u00fbj\\u00eae\\u00f2<\\/p><p>@\\u00f9^K K\\u00fbc K\\u00f9e, Z\\u00fbV\\u00fbe\\u00ea @\\u00fbC \\u00f9M\\u00fbU\\u00f2G R\\u00faa R^\\u00e0<\\/p><p>^\\u00f2G\\u00f6 Gj\\u00f2_e\\u00f2 ia\\u00eaK\\u00fbc GK \\u00f9K\\u00fbh\\u00fa R\\u00faae \\u00f9M\\u00fbU\\u00f2G<\\/p><p>c\\u00fbZ\\u00e2 \\u00f9K\\u00fbh Ke\\u00f2[\\u00fbG\\u00f6 K\\u00f2\\u00ab\\u00ea aj\\u00ea\\u00f9K\\u00fbh\\u00fa R\\u00faae \\u00f9K\\u00fbh<\\/p><p>MV^\\u00f9e a\\u00f2b\\u00f2^\\u00dcZ\\u00fb \\u00f9\\\\L\\u00fb~\\u00fbG\\u00f6 C\\\\\\u00fbjeY \\u00cae\\u00ec_, c^\\u00eah\\u00fd<\\/p><p>eqKY\\u00f2K\\u00fb, c\\u00fb\\u00f5i\\u00f9_g\\u00fa I i\\u00dc\\u00fbd\\u00ea\\u00f9K\\u00fbh MV^\\u00f9e _\\u00fb[\\u00f0K\\u00fd<\\/p><p>@Q\\u00f2 (P\\u00f2Z\\u00e2 1.2A )\\u00f6 Gc\\u00f2Z\\u00f2 @\\u00f9^K _\\u00e2K\\u00fbee \\u00f9K\\u00fbh c^\\u00eah\\u00a5<\\/p><p>(P\\u00f2Z\\u00e2 - 1.2A ) a\\u00f2b ^<\\/p><p>\\u00f2 \\u00dc @\\u00fbK\\u00fbee \\u00f9K\\u00fbh<\\/p><p>\\u00f9\\\\j\\u00f9e [\\u00fbA R\\u00faa^ K\\u00e2 d<\\/p><p>\\u00f2 \\u00fb i\\u03bc\\u00fb\\\\^ Ke\\u00f2[\\u00fb\\u00ab\\u00f2\\u00f6<\\/p><p>\\u00f9K\\u00fbhe @\\u00fbdZ^ i\\u00fb]\\u00fbeYZ\\u00fc c\\u00fbAK\\u00e2^ (micron) \\u00f9e c_\\u00fb~\\u00fbG\\u00f6 100 c\\u00fbAK\\u00e2^ \\u0308e\\u00ea Kc\\u00fe @\\u00fbK\\u00fbe<\\/p><p>a\\u00f2g \\u00c1 \\u00f2 _\\\\\\u00fb[\\u00f0 @\\u00fbce i\\u00eai\\u00da @\\u00fbL\\u00f4K\\u00ea \\u00f9\\\\L\\u00fb~\\u00fbG ^\\u00fbj\\u00f3\\u00f6 GY\\u00ea Gj\\u00fbK\\u00ea \\u00f9\\\\L\\u00f2a\\u00fb _\\u00fbA\\u00f1 @Y\\u00eaa\\u00falY ~a \\\\eK\\u00fbe\\u00f6<\\/p><p>a\\u00faR\\u00fbY\\u00eau \\u00f9K\\u00fbh L\\u00eaa\\u00fe \\u00f9Q\\u00fbU\\u00f6 c\\u00fbZ\\u00e2 0.1 e\\u00ea 0.5 , c\\u00fbAK\\u00e2^ , &nbsp;\\u0308 \\u00f9ic\\u00fb\\u00f9^ c\\u00a4 GK\\u00f9K\\u00fbh\\u00fa\\u00f6 K\\u00f2\\u00ab\\u00ea \\u00f9M\\u00fbU\\u00f2G<\\/p><p>@\\u0160\\u00fbe \\u00f9K\\u00fbh L\\u00fbf\\u00f2 @\\u00fbL\\u00f2\\u00f9e \\u00c6\\u00c1 \\u00f9\\\\L\\u00fb~\\u00fbG (P\\u00f2Z\\u00e2 - 1.2B )\\u00f6<\\/p><p>W\\u00f2 \\u0301 \\u00f9K\\u00fbh<\\/p><p>(P\\u00f2Z\\u00e2 - 1.2B )<\\/p><p>i\\u00fb]\\u00fbeYZ\\u00fc \\u00f9K\\u00fbh S\\u00f2f \\u00fa \\u00e4 , \\u00f9K\\u00fbhR\\u00faaK<\\/p><p>I ^\\u00fd\\u00c1\\u00f2 K \\u00ea \\u00f9^A \\u00f9M\\u00fbU\\u00f2 G \\u00f9K\\u00fbh<\\/p><p>MV\\u00f2Z\\u00f6 \\u00f9K\\u00fbhR\\u00faaKe @\\u00f9^KM\\u00eaW G<\\/p><p>\\u00f2<\\/p><p>@w\\u00f2K\\u00fb [\\u00fbG\\u00f6 K\\u00f2\\u00ab\\u00ea Cn\\u00f2\\\\ \\u00f9K\\u00fbh\\u00f9e<\\/p><p>\\u00f9K\\u00fbhS\\u00f2 f \\u00e4 \\u00fa a\\u00fb \\u00f9K\\u00fbh _e\\\\\\u00fbe<\\/p><p>a\\u00fbj\\u00fbe_UK\\u00ea \\u00f9K\\u00fbhb\\u00f2\\u00a9\\u00f2 ^\\u00fbcK @\\u00fbC<\\/p><p>\\u00f9M\\u00fbU\\u00f2G a\\u00fbj\\u00fd @\\u00fbaeY [\\u00fbG\\u00f6<\\/p>","video":null,"video_type":null,"video_size":null,"videourl":null,"introductable_id":22,"introductable_type":"App\\\\Models\\\\Subject","created_at":"2019-04-02 10:18:38","updated_at":"2019-04-02 10:18:38","deleted_at":null}}', '2019-04-02 10:18:38', '2019-04-02 10:18:38'),
(84, 'default', 'updated', 9, 'App\\Models\\Introduction', 1, 'App\\User', '{"attributes":{"id":9,"text":null,"video":null,"video_type":null,"video_size":null,"videourl":null,"introductable_id":22,"introductable_type":"App\\\\Models\\\\Subject","created_at":"2019-04-02 10:18:38","updated_at":"2019-04-02 10:24:40","deleted_at":null},"old":{"id":9,"text":"<p>1665 ci\\u00f2j\\u00fb\\u00f9e eaU\\u00f0 j\\u00eaK\\u00fe ^\\u00fbcK a\\u00e2\\u00f2U\\u00f2g \\u00f9a\\u00f7m\\u00fb^\\u00f2K GK KK\\u00f0e _Zk\\u00fb @\\u00f5gK\\u00ea @Y\\u00eaa\\u00falY<\\/p><p>~a\\u00f9e \\u00f9\\\\L\\u00f2 Z\\u00fbj\\u00fb \\u00f9K\\u00f9ZM\\u00eaW\\u00f2G \\u00f9K\\u00fbh\\u00f9e MV\\u00f2Z \\u00f9j\\u00fbA[\\u00f2a\\u00fb RY\\u00fbA\\u00f9f\\u00f6 \\u00f9ij\\u00f2 \\u00f9K\\u00fbhM\\u00eaW\\u00f2K<\\/p><p>cj\\u00ea\\u00f9`Y\\u00fb i\\\\\\u00e9g \\u00f9Q\\u00fbU \\u00f9K\\u00fbVe\\u00fa (P\\u00f2Z\\u00e2 - 1.1) bk\\u00f2 [\\u00f2f\\u00fb\\u00f6<\\/p><p>_\\u00e2\\u00f9Z\\u00fdK R\\u00faaK\\u00ea MV^ Ke\\u00ea[\\u00f2a\\u00fb \\u00f9c\\u00f8k\\u00f2K GKKK\\u00ea \\u2018\\u00f9K\\u00fbh\\u2019 K\\u00eaj\\u00fb~\\u00fbG\\u00f6 GK \\u00f9K\\u00fbh\\u00fa R\\u00faae<\\/p><p>@Y\\u00eaa\\u00falY ~a\\u00f9e<\\/p><p>MV^ \\u00f9M\\u00fbU\\u00f2G c\\u00fbZ\\u00e2 \\u00f9K\\u00fbhK\\u00ea \\u00f9^A \\u00f9j\\u00fbA[\\u00fbG (C\\\\\\u00fbjeY - Gc\\u00f2a\\u00fb)\\u00f6 \\u00f9ic\\u00f2Z\\u00f2 aj\\u00ea\\u00f9K\\u00fbh\\u00fa<\\/p><p>j\\u00eaK \\u0308 \\u00f9\\\\L\\u00f4[\\u00f4a\\u00fb \\u00f9K\\u00fbh<\\/p><p>R\\u00faage\\u00fae @\\u00f9^KM\\u00eaW\\u00f2G \\u00f9K\\u00fbh\\\\\\u00df\\u00fbe\\u00fb \\u00f9j\\u00fbA[\\u00fbG (C\\\\\\u00fbjeY - Z\\u00eac P\\u00fbe\\u00f2_U\\u00f9e [\\u00f2a\\u00fb<\\/p><p>(P\\u00f2Z\\u00e2 - 1.1)<\\/p><p>a\\u00e9lfZ\\u00fb, _g\\u00ea_l\\u00fa, cY\\u00f2h)\\u00f6<\\/p><p>R\\u00faaU\\u00f2G R^\\u00e0\\u00f9^\\u00f9f, \\u00f9i a\\u00f9X\\u00ff\\u00f6 \\u00f9i[\\u00f2_\\u00fbA\\u00f1 \\u00f9i L\\u00fb\\\\\\u00fd<\\/p><p>L\\u00fbG, Z\\u00fbK\\u00ea jRc K\\u00f9e\\u00f6 g\\u00df\\u00fbiK\\u00f2\\u00e2d\\u00fb i\\u03bc\\u00fb\\\\^ K\\u00f9e, @\\u00fbj\\u00eae\\u00f2<\\/p><p>@\\u00f9^K K\\u00fbc K\\u00f9e, Z\\u00fbV\\u00fbe\\u00ea @\\u00fbC \\u00f9M\\u00fbU\\u00f2G R\\u00faa R^\\u00e0<\\/p><p>^\\u00f2G\\u00f6 Gj\\u00f2_e\\u00f2 ia\\u00eaK\\u00fbc GK \\u00f9K\\u00fbh\\u00fa R\\u00faae \\u00f9M\\u00fbU\\u00f2G<\\/p><p>c\\u00fbZ\\u00e2 \\u00f9K\\u00fbh Ke\\u00f2[\\u00fbG\\u00f6 K\\u00f2\\u00ab\\u00ea aj\\u00ea\\u00f9K\\u00fbh\\u00fa R\\u00faae \\u00f9K\\u00fbh<\\/p><p>MV^\\u00f9e a\\u00f2b\\u00f2^\\u00dcZ\\u00fb \\u00f9\\\\L\\u00fb~\\u00fbG\\u00f6 C\\\\\\u00fbjeY \\u00cae\\u00ec_, c^\\u00eah\\u00fd<\\/p><p>eqKY\\u00f2K\\u00fb, c\\u00fb\\u00f5i\\u00f9_g\\u00fa I i\\u00dc\\u00fbd\\u00ea\\u00f9K\\u00fbh MV^\\u00f9e _\\u00fb[\\u00f0K\\u00fd<\\/p><p>@Q\\u00f2 (P\\u00f2Z\\u00e2 1.2A )\\u00f6 Gc\\u00f2Z\\u00f2 @\\u00f9^K _\\u00e2K\\u00fbee \\u00f9K\\u00fbh c^\\u00eah\\u00a5<\\/p><p>(P\\u00f2Z\\u00e2 - 1.2A ) a\\u00f2b ^<\\/p><p>\\u00f2 \\u00dc @\\u00fbK\\u00fbee \\u00f9K\\u00fbh<\\/p><p>\\u00f9\\\\j\\u00f9e [\\u00fbA R\\u00faa^ K\\u00e2 d<\\/p><p>\\u00f2 \\u00fb i\\u03bc\\u00fb\\\\^ Ke\\u00f2[\\u00fb\\u00ab\\u00f2\\u00f6<\\/p><p>\\u00f9K\\u00fbhe @\\u00fbdZ^ i\\u00fb]\\u00fbeYZ\\u00fc c\\u00fbAK\\u00e2^ (micron) \\u00f9e c_\\u00fb~\\u00fbG\\u00f6 100 c\\u00fbAK\\u00e2^ \\u0308e\\u00ea Kc\\u00fe @\\u00fbK\\u00fbe<\\/p><p>a\\u00f2g \\u00c1 \\u00f2 _\\\\\\u00fb[\\u00f0 @\\u00fbce i\\u00eai\\u00da @\\u00fbL\\u00f4K\\u00ea \\u00f9\\\\L\\u00fb~\\u00fbG ^\\u00fbj\\u00f3\\u00f6 GY\\u00ea Gj\\u00fbK\\u00ea \\u00f9\\\\L\\u00f2a\\u00fb _\\u00fbA\\u00f1 @Y\\u00eaa\\u00falY ~a \\\\eK\\u00fbe\\u00f6<\\/p><p>a\\u00faR\\u00fbY\\u00eau \\u00f9K\\u00fbh L\\u00eaa\\u00fe \\u00f9Q\\u00fbU\\u00f6 c\\u00fbZ\\u00e2 0.1 e\\u00ea 0.5 , c\\u00fbAK\\u00e2^ , &nbsp;\\u0308 \\u00f9ic\\u00fb\\u00f9^ c\\u00a4 GK\\u00f9K\\u00fbh\\u00fa\\u00f6 K\\u00f2\\u00ab\\u00ea \\u00f9M\\u00fbU\\u00f2G<\\/p><p>@\\u0160\\u00fbe \\u00f9K\\u00fbh L\\u00fbf\\u00f2 @\\u00fbL\\u00f2\\u00f9e \\u00c6\\u00c1 \\u00f9\\\\L\\u00fb~\\u00fbG (P\\u00f2Z\\u00e2 - 1.2B )\\u00f6<\\/p><p>W\\u00f2 \\u0301 \\u00f9K\\u00fbh<\\/p><p>(P\\u00f2Z\\u00e2 - 1.2B )<\\/p><p>i\\u00fb]\\u00fbeYZ\\u00fc \\u00f9K\\u00fbh S\\u00f2f \\u00fa \\u00e4 , \\u00f9K\\u00fbhR\\u00faaK<\\/p><p>I ^\\u00fd\\u00c1\\u00f2 K \\u00ea \\u00f9^A \\u00f9M\\u00fbU\\u00f2 G \\u00f9K\\u00fbh<\\/p><p>MV\\u00f2Z\\u00f6 \\u00f9K\\u00fbhR\\u00faaKe @\\u00f9^KM\\u00eaW G<\\/p><p>\\u00f2<\\/p><p>@w\\u00f2K\\u00fb [\\u00fbG\\u00f6 K\\u00f2\\u00ab\\u00ea Cn\\u00f2\\\\ \\u00f9K\\u00fbh\\u00f9e<\\/p><p>\\u00f9K\\u00fbhS\\u00f2 f \\u00e4 \\u00fa a\\u00fb \\u00f9K\\u00fbh _e\\\\\\u00fbe<\\/p><p>a\\u00fbj\\u00fbe_UK\\u00ea \\u00f9K\\u00fbhb\\u00f2\\u00a9\\u00f2 ^\\u00fbcK @\\u00fbC<\\/p><p>\\u00f9M\\u00fbU\\u00f2G a\\u00fbj\\u00fd @\\u00fbaeY [\\u00fbG\\u00f6<\\/p>","video":null,"video_type":null,"video_size":null,"videourl":null,"introductable_id":22,"introductable_type":"App\\\\Models\\\\Subject","created_at":"2019-04-02 10:18:38","updated_at":"2019-04-02 10:18:38","deleted_at":null}}', '2019-04-02 10:24:40', '2019-04-02 10:24:40'),
(85, 'default', 'created', 7, 'App\\Models\\Subgrade', 1, 'App\\User', '{"attributes":{"id":7,"name":"Section A","grade_id":1,"stream_room":"582498","channel_id":null,"medium":0,"created_at":"2019-04-02 11:10:29","updated_at":"2019-04-02 11:10:29","deleted_at":null}}', '2019-04-02 11:10:29', '2019-04-02 11:10:29'),
(86, 'default', 'created', 8, 'App\\Models\\Subgrade', 1, 'App\\User', '{"attributes":{"id":8,"name":"Another","grade_id":0,"stream_room":"947527","channel_id":null,"medium":0,"created_at":"2019-04-02 11:29:48","updated_at":"2019-04-02 11:29:48","deleted_at":null}}', '2019-04-02 11:29:48', '2019-04-02 11:29:48'),
(87, 'default', 'created', 9, 'App\\Models\\Subgrade', 1, 'App\\User', '{"attributes":{"id":9,"name":"Another","grade_id":0,"stream_room":"639731","channel_id":null,"medium":0,"created_at":"2019-04-02 11:30:03","updated_at":"2019-04-02 11:30:03","deleted_at":null}}', '2019-04-02 11:30:03', '2019-04-02 11:30:03'),
(88, 'default', 'created', 10, 'App\\Models\\Subgrade', 1, 'App\\User', '{"attributes":{"id":10,"name":"Grade 3","grade_id":0,"stream_room":"717274","channel_id":null,"medium":0,"created_at":"2019-04-02 11:30:38","updated_at":"2019-04-02 11:30:38","deleted_at":null}}', '2019-04-02 11:30:38', '2019-04-02 11:30:38'),
(89, 'default', 'created', 11, 'App\\Models\\Subgrade', 1, 'App\\User', '{"attributes":{"id":11,"name":"Grade 45","grade_id":0,"stream_room":"295565","channel_id":null,"medium":0,"created_at":"2019-04-02 11:32:46","updated_at":"2019-04-02 11:32:46","deleted_at":null}}', '2019-04-02 11:32:46', '2019-04-02 11:32:46'),
(90, 'default', 'created', 12, 'App\\Models\\Subgrade', 1, 'App\\User', '{"attributes":{"id":12,"name":"Grade53","grade_id":0,"stream_room":"671044","channel_id":null,"medium":0,"created_at":"2019-04-02 11:33:44","updated_at":"2019-04-02 11:33:44","deleted_at":null}}', '2019-04-02 11:33:44', '2019-04-02 11:33:44'),
(91, 'default', 'created', 13, 'App\\Models\\Subgrade', 1, 'App\\User', '{"attributes":{"id":13,"name":"Grade53","grade_id":0,"stream_room":"047066","channel_id":null,"medium":0,"created_at":"2019-04-02 11:33:54","updated_at":"2019-04-02 11:33:54","deleted_at":null}}', '2019-04-02 11:33:54', '2019-04-02 11:33:54'),
(92, 'default', 'created', 14, 'App\\Models\\Subgrade', 66, 'App\\User', '{"attributes":{"id":14,"name":"Mtech 1","grade_id":1,"stream_room":"495843","channel_id":null,"medium":0,"created_at":"2019-04-02 11:38:59","updated_at":"2019-04-02 11:38:59","deleted_at":null}}', '2019-04-02 11:38:59', '2019-04-02 11:38:59'),
(93, 'default', 'created', 15, 'App\\Models\\Subgrade', 1, 'App\\User', '{"attributes":{"id":15,"name":"New","grade_id":0,"stream_room":"160622","channel_id":null,"medium":0,"created_at":"2019-04-02 11:54:48","updated_at":"2019-04-02 11:54:48","deleted_at":null}}', '2019-04-02 11:54:48', '2019-04-02 11:54:48'),
(94, 'default', 'created', 16, 'App\\Models\\Subgrade', 1, 'App\\User', '{"attributes":{"id":16,"name":"abcd","grade_id":0,"stream_room":"830831","channel_id":null,"medium":0,"created_at":"2019-04-02 11:56:10","updated_at":"2019-04-02 11:56:10","deleted_at":null}}', '2019-04-02 11:56:10', '2019-04-02 11:56:10'),
(95, 'default', 'created', 17, 'App\\Models\\Subgrade', 66, 'App\\User', '{"attributes":{"id":17,"name":"fff","grade_id":1,"stream_room":"747742","channel_id":null,"medium":0,"created_at":"2019-04-02 12:01:51","updated_at":"2019-04-02 12:01:51","deleted_at":null}}', '2019-04-02 12:01:51', '2019-04-02 12:01:51'),
(96, 'default', 'created', 18, 'App\\Models\\Subgrade', 1, 'App\\User', '{"attributes":{"id":18,"name":"New","grade_id":0,"stream_room":"935282","channel_id":null,"medium":0,"created_at":"2019-04-02 12:02:06","updated_at":"2019-04-02 12:02:06","deleted_at":null}}', '2019-04-02 12:02:06', '2019-04-02 12:02:06'),
(97, 'default', 'created', 19, 'App\\Models\\Subgrade', 1, 'App\\User', '{"attributes":{"id":19,"name":"abcd","grade_id":0,"stream_room":"655580","channel_id":null,"medium":0,"created_at":"2019-04-02 12:04:54","updated_at":"2019-04-02 12:04:54","deleted_at":null}}', '2019-04-02 12:04:54', '2019-04-02 12:04:54'),
(98, 'default', 'created', 20, 'App\\Models\\Subgrade', 1, 'App\\User', '{"attributes":{"id":20,"name":"abcd","grade_id":0,"stream_room":"104089","channel_id":null,"medium":0,"created_at":"2019-04-02 12:06:22","updated_at":"2019-04-02 12:06:22","deleted_at":null}}', '2019-04-02 12:06:22', '2019-04-02 12:06:22'),
(99, 'default', 'created', 21, 'App\\Models\\Subgrade', 1, 'App\\User', '{"attributes":{"id":21,"name":"abcd","grade_id":0,"stream_room":"396563","channel_id":null,"medium":0,"created_at":"2019-04-02 12:12:23","updated_at":"2019-04-02 12:12:23","deleted_at":null}}', '2019-04-02 12:12:23', '2019-04-02 12:12:23');
INSERT INTO `activity_log` (`id`, `log_name`, `description`, `subject_id`, `subject_type`, `causer_id`, `causer_type`, `properties`, `created_at`, `updated_at`) VALUES
(100, 'default', 'created', 1, 'App\\Models\\LessonPlan', 66, 'App\\User', '{"attributes":{"id":1,"title":"What are vowels?","description":"Vowels Lesson 1 hr important","subject_id":21,"subgrade_id":2,"for_date":"2019-04-02 16:15:16","created_at":"2019-04-02 12:15:26","updated_at":"2019-04-02 12:15:26","deleted_at":null}}', '2019-04-02 12:15:26', '2019-04-02 12:15:26'),
(101, 'default', 'created', 22, 'App\\Models\\Subgrade', 1, 'App\\User', '{"attributes":{"id":22,"name":"Grade53","grade_id":1,"stream_room":"671445","channel_id":null,"medium":0,"created_at":"2019-04-02 12:27:53","updated_at":"2019-04-02 12:27:53","deleted_at":null}}', '2019-04-02 12:27:53', '2019-04-02 12:27:53'),
(102, 'default', 'created', 2, 'App\\Models\\LessonPlan', 66, 'App\\User', '{"attributes":{"id":2,"title":"Articles","description":"Brief about Articles","subject_id":21,"subgrade_id":2,"for_date":"2019-04-02 13:30:03","created_at":"2019-04-02 12:30:10","updated_at":"2019-04-02 12:30:10","deleted_at":null}}', '2019-04-02 12:30:10', '2019-04-02 12:30:10'),
(103, 'default', 'deleted', 18, 'App\\Models\\Organization', 66, 'App\\User', '{"attributes":{"id":18,"name":"Demo org","tagline":"Best for primary and secondary education","description":"This is for demo only.","email":"demoorg@gmail.com","email_verified":1,"mobile":9110918743,"mobile_verified":1,"is_school":1,"address":"Patia Shree vihar","sponsor_id":15,"is_default":0,"stream_room":"141772","medium":0,"channel_id":null,"created_at":"2019-04-02 10:00:04","updated_at":"2019-04-02 12:40:03","deleted_at":"2019-04-02 12:40:03"}}', '2019-04-02 12:40:03', '2019-04-02 12:40:03'),
(104, 'default', 'created', 19, 'App\\Models\\Organization', 66, 'App\\User', '{"attributes":{"id":19,"name":"Demo Organization","tagline":"This is for demo","description":"For School Demo","email":"demoorg@gmail.com","email_verified":1,"mobile":9110918743,"mobile_verified":1,"is_school":1,"address":"Patia, Shree Vihar","sponsor_id":15,"is_default":0,"stream_room":"077930","medium":0,"channel_id":null,"created_at":"2019-04-02 12:49:39","updated_at":"2019-04-02 12:49:39","deleted_at":null}}', '2019-04-02 12:49:39', '2019-04-02 12:49:39'),
(105, 'default', 'created', 11, 'App\\Models\\Department', 66, 'App\\User', '{"attributes":{"id":11,"name":"Demo Organization_dept","is_default":1,"organization_id":19,"stream_room":"170969","created_at":"2019-04-02 12:49:39","updated_at":"2019-04-02 12:49:39","deleted_at":null}}', '2019-04-02 12:49:39', '2019-04-02 12:49:39'),
(106, 'default', 'created', 27, 'App\\Models\\Program', 66, 'App\\User', '{"attributes":{"id":27,"name":"Demo Organization_prg","department_id":11,"stream_room":"453360","is_default":1,"created_at":"2019-04-02 12:49:39","updated_at":"2019-04-02 12:49:39","deleted_at":null}}', '2019-04-02 12:49:39', '2019-04-02 12:49:39'),
(107, 'default', 'created', 23, 'App\\Models\\Subject', 1, 'App\\User', '{"attributes":{"id":23,"name":"Maths","grade_id":1,"created_at":"2019-04-02 12:50:48","updated_at":"2019-04-02 12:50:48","deleted_at":null}}', '2019-04-02 12:50:48', '2019-04-02 12:50:48'),
(108, 'default', 'created', 7, 'App\\Models\\Grade', 66, 'App\\User', '{"attributes":{"id":7,"name":"CLass 2","program_id":27,"stream_room":"138895","created_at":"2019-04-02 12:51:16","updated_at":"2019-04-02 12:51:16","deleted_at":null}}', '2019-04-02 12:51:16', '2019-04-02 12:51:16'),
(109, 'default', 'created', 23, 'App\\Models\\Subgrade', 66, 'App\\User', '{"attributes":{"id":23,"name":"123","grade_id":7,"stream_room":"682257","channel_id":null,"medium":0,"created_at":"2019-04-02 12:51:42","updated_at":"2019-04-02 12:51:42","deleted_at":null}}', '2019-04-02 12:51:42', '2019-04-02 12:51:42'),
(110, 'default', 'created', 24, 'App\\Models\\Subject', 66, 'App\\User', '{"attributes":{"id":24,"name":"General Knowlege","grade_id":7,"created_at":"2019-04-02 12:52:09","updated_at":"2019-04-02 12:52:09","deleted_at":null}}', '2019-04-02 12:52:09', '2019-04-02 12:52:09'),
(111, 'default', 'created', 21, 'App\\Models\\MessageCounter', 66, 'App\\User', '{"attributes":{"id":21,"unread":0,"read":0,"total":0,"user_id":81,"created_at":"2019-04-02 13:09:53","updated_at":"2019-04-02 13:09:53","deleted_at":null}}', '2019-04-02 13:09:53', '2019-04-02 13:09:53'),
(112, 'default', 'created', 22, 'App\\Models\\MessageCounter', 66, 'App\\User', '{"attributes":{"id":22,"unread":0,"read":0,"total":0,"user_id":82,"created_at":"2019-04-02 13:12:07","updated_at":"2019-04-02 13:12:07","deleted_at":null}}', '2019-04-02 13:12:07', '2019-04-02 13:12:07'),
(113, 'default', 'created', 23, 'App\\Models\\MessageCounter', 66, 'App\\User', '{"attributes":{"id":23,"unread":0,"read":0,"total":0,"user_id":83,"created_at":"2019-04-02 13:13:50","updated_at":"2019-04-02 13:13:50","deleted_at":null}}', '2019-04-02 13:13:50', '2019-04-02 13:13:50'),
(114, 'default', 'created', 24, 'App\\Models\\MessageCounter', 66, 'App\\User', '{"attributes":{"id":24,"unread":0,"read":0,"total":0,"user_id":84,"created_at":"2019-04-02 13:15:26","updated_at":"2019-04-02 13:15:26","deleted_at":null}}', '2019-04-02 13:15:26', '2019-04-02 13:15:26'),
(115, 'default', 'created', 3, 'App\\Models\\ClassroomAssignedUser', 66, 'App\\User', '{"attributes":{"id":3,"subgrade_id":23,"user_id":83,"is_enabled":1,"is_teacher":1,"created_at":"2019-04-02 13:15:48","updated_at":"2019-04-02 13:15:48","deleted_at":null}}', '2019-04-02 13:15:48', '2019-04-02 13:15:48'),
(116, 'default', 'created', 4, 'App\\Models\\ClassroomAssignedUser', 66, 'App\\User', '{"attributes":{"id":4,"subgrade_id":23,"user_id":84,"is_enabled":1,"is_teacher":1,"created_at":"2019-04-02 13:15:52","updated_at":"2019-04-02 13:15:52","deleted_at":null}}', '2019-04-02 13:15:52', '2019-04-02 13:15:52'),
(117, 'default', 'created', 22, 'App\\Models\\Exam', 66, 'App\\User', '{"attributes":{"id":22,"name":"General Knowledge test","start_date_time":"2019-04-02 18:22:39","end_date_time":"2019-04-02 20:22:45","exam_head":83,"total_marks":50,"is_confirmed":1,"is_over":0,"is_started":0,"is_upcoming":1,"result_announced":0,"grade_id":7,"for_all_classroom":1,"subgrade_id":null,"subject_id":24,"topic_id":null,"selected_set":null,"created_at":"2019-04-02 13:23:13","updated_at":"2019-04-02 13:23:13","deleted_at":null}}', '2019-04-02 13:23:13', '2019-04-02 13:23:13'),
(118, 'default', 'created', 13, 'App\\Models\\ExamOrganizer', 66, 'App\\User', '[]', '2019-04-02 13:40:16', '2019-04-02 13:40:16'),
(119, 'default', 'created', 20, 'App\\Models\\QuestionSet', 83, 'App\\User', '{"attributes":{"id":20,"name":"Set A","is_submited":0,"is_selected":0,"user_id":83,"exam_id":22,"created_at":"2019-04-02 13:42:28","updated_at":"2019-04-02 13:42:28","deleted_at":null}}', '2019-04-02 13:42:28', '2019-04-02 13:42:28'),
(120, 'default', 'created', 14, 'App\\Models\\QuestionGroup', 83, 'App\\User', '[]', '2019-04-02 13:42:46', '2019-04-02 13:42:46'),
(121, 'default', 'created', 15, 'App\\Models\\QuestionGroup', 83, 'App\\User', '[]', '2019-04-02 13:42:52', '2019-04-02 13:42:52'),
(122, 'default', 'created', 23, 'App\\Models\\Question', 83, 'App\\User', '{"attributes":{"id":23,"heading":"<p>Who is the current Prime Minister of India?<\\/p>","type":"radio","marks":10,"answer":"1","question_group_id":14,"created_at":"2019-04-02 13:44:43","updated_at":"2019-04-02 13:44:43","deleted_at":null}}', '2019-04-02 13:44:43', '2019-04-02 13:44:43'),
(123, 'default', 'created', 10, 'App\\Models\\Option', 83, 'App\\User', '{"attributes":{"id":10,"first":"Narendra Modi","second":"Nitish Kumar","third":"Arwind Kejriwal","fourth":"Rahul Gandhi","right_answer":null,"question_id":23,"created_at":"2019-04-02 13:44:43","updated_at":"2019-04-02 13:44:43","deleted_at":null}}', '2019-04-02 13:44:43', '2019-04-02 13:44:43'),
(124, 'default', 'created', 24, 'App\\Models\\Question', 83, 'App\\User', '{"attributes":{"id":24,"heading":"<p>Capital of India is _____ ?<\\/p>","type":"fill","marks":10,"answer":"Delhi","question_group_id":14,"created_at":"2019-04-02 13:45:12","updated_at":"2019-04-02 13:45:12","deleted_at":null}}', '2019-04-02 13:45:12', '2019-04-02 13:45:12'),
(125, 'default', 'created', 25, 'App\\Models\\Question', 83, 'App\\User', '{"attributes":{"id":25,"heading":"<p>WHich of these are gas<\\/p>","type":"checkbox","marks":10,"answer":"1,2","question_group_id":15,"created_at":"2019-04-02 13:49:44","updated_at":"2019-04-02 13:49:44","deleted_at":null}}', '2019-04-02 13:49:44', '2019-04-02 13:49:44'),
(126, 'default', 'created', 11, 'App\\Models\\Option', 83, 'App\\User', '{"attributes":{"id":11,"first":"Hydrogen","second":"Oxygen","third":"Soil","fourth":"Leaf","right_answer":null,"question_id":25,"created_at":"2019-04-02 13:49:44","updated_at":"2019-04-02 13:49:44","deleted_at":null}}', '2019-04-02 13:49:44', '2019-04-02 13:49:44'),
(127, 'default', 'created', 26, 'App\\Models\\Question', 83, 'App\\User', '{"attributes":{"id":26,"heading":"<p>Nation fruit of India is Mango?<\\/p>","type":"boolean","marks":10,"answer":"1","question_group_id":15,"created_at":"2019-04-02 13:52:35","updated_at":"2019-04-02 13:52:35","deleted_at":null}}', '2019-04-02 13:52:35', '2019-04-02 13:52:35'),
(128, 'default', 'created', 27, 'App\\Models\\Question', 83, 'App\\User', '{"attributes":{"id":27,"heading":"<p>National game of India is Cricket?<\\/p>","type":"boolean","marks":10,"answer":"0","question_group_id":15,"created_at":"2019-04-02 13:53:15","updated_at":"2019-04-02 13:53:15","deleted_at":null}}', '2019-04-02 13:53:15', '2019-04-02 13:53:15'),
(129, 'default', 'updated', 20, 'App\\Models\\QuestionSet', 83, 'App\\User', '{"attributes":{"id":20,"name":"Set A","is_submited":1,"is_selected":0,"user_id":83,"exam_id":22,"created_at":"2019-04-02 13:42:28","updated_at":"2019-04-02 13:53:27","deleted_at":null},"old":{"id":20,"name":"Set A","is_submited":0,"is_selected":0,"user_id":83,"exam_id":22,"created_at":"2019-04-02 13:42:28","updated_at":"2019-04-02 13:42:28","deleted_at":null}}', '2019-04-02 13:53:27', '2019-04-02 13:53:27'),
(130, 'default', 'updated', 22, 'App\\Models\\Exam', 80, 'App\\User', '{"attributes":{"id":22,"name":"General Knowledge test","start_date_time":"2019-04-02 18:22:39","end_date_time":"2019-04-02 20:22:45","exam_head":83,"total_marks":50,"is_confirmed":1,"is_over":0,"is_started":0,"is_upcoming":1,"result_announced":0,"grade_id":7,"for_all_classroom":1,"subgrade_id":null,"subject_id":24,"topic_id":null,"selected_set":20,"created_at":"2019-04-02 13:23:13","updated_at":"2019-04-02 13:59:26","deleted_at":null},"old":{"id":22,"name":"General Knowledge test","start_date_time":"2019-04-02 18:22:39","end_date_time":"2019-04-02 20:22:45","exam_head":83,"total_marks":50,"is_confirmed":1,"is_over":0,"is_started":0,"is_upcoming":1,"result_announced":0,"grade_id":7,"for_all_classroom":1,"subgrade_id":null,"subject_id":24,"topic_id":null,"selected_set":null,"created_at":"2019-04-02 13:23:13","updated_at":"2019-04-02 13:23:13","deleted_at":null}}', '2019-04-02 13:59:26', '2019-04-02 13:59:26'),
(131, 'default', 'created', 18, 'App\\Models\\ExamAppearance', 81, 'App\\User', '[]', '2019-04-02 14:27:09', '2019-04-02 14:27:09'),
(132, 'default', 'updated', 20, 'App\\Models\\QuestionSet', 80, 'App\\User', '{"attributes":{"id":20,"name":"Set A","is_submited":1,"is_selected":1,"user_id":83,"exam_id":22,"created_at":"2019-04-02 13:42:28","updated_at":"2019-04-02 14:33:13","deleted_at":null},"old":{"id":20,"name":"Set A","is_submited":1,"is_selected":0,"user_id":83,"exam_id":22,"created_at":"2019-04-02 13:42:28","updated_at":"2019-04-02 13:53:27","deleted_at":null}}', '2019-04-02 14:33:13', '2019-04-02 14:33:13'),
(133, 'default', 'created', 19, 'App\\Models\\ExamAppearance', 81, 'App\\User', '[]', '2019-04-02 14:33:28', '2019-04-02 14:33:28'),
(134, 'default', 'created', 6, 'App\\Models\\StudentAnswer', 81, 'App\\User', '[]', '2019-04-02 14:33:44', '2019-04-02 14:33:44'),
(135, 'default', 'created', 30, 'App\\Models\\Message', 1, 'App\\User', '{"attributes":{"id":30,"subject":"New Message","message":"<p>My new Message<\\/p>","user_id":1,"intended_model_type":"Organization","intended_model_subtype":"Admin","intended_model_id":"3","is_private":0,"private_receipent":null,"readBy":null,"deletedBy":null,"created_at":"2019-04-02 14:37:44","updated_at":"2019-04-02 14:37:44","deleted_at":null}}', '2019-04-02 14:37:44', '2019-04-02 14:37:44'),
(136, 'default', 'created', 31, 'App\\Models\\Message', 1, 'App\\User', '{"attributes":{"id":31,"subject":"Hello","message":"<p>Hello<\\/p><p><br><\\/p>","user_id":1,"intended_model_type":"Admin","intended_model_subtype":"Superadmin","intended_model_id":"0","is_private":0,"private_receipent":null,"readBy":null,"deletedBy":null,"created_at":"2019-04-02 15:36:43","updated_at":"2019-04-02 15:36:43","deleted_at":null}}', '2019-04-02 15:36:43', '2019-04-02 15:36:43'),
(137, 'default', 'created', 32, 'App\\Models\\Message', 1, 'App\\User', '{"attributes":{"id":32,"subject":"Motilal Nehru Public School","message":"<p>Hello<\\/p>","user_id":1,"intended_model_type":"Admin","intended_model_subtype":"SiteAdmin","intended_model_id":"0","is_private":0,"private_receipent":null,"readBy":null,"deletedBy":null,"created_at":"2019-04-02 15:38:17","updated_at":"2019-04-02 15:38:17","deleted_at":null}}', '2019-04-02 15:38:17', '2019-04-02 15:38:17'),
(138, 'default', 'created', 33, 'App\\Models\\Message', 1, 'App\\User', '{"attributes":{"id":33,"subject":"Test","message":"<p>Test<\\/p>","user_id":1,"intended_model_type":"Organization","intended_model_subtype":"Teacher","intended_model_id":"1","is_private":0,"private_receipent":null,"readBy":null,"deletedBy":null,"created_at":"2019-04-02 15:40:37","updated_at":"2019-04-02 15:40:37","deleted_at":null}}', '2019-04-02 15:40:37', '2019-04-02 15:40:37'),
(139, 'default', 'updated', 31, 'App\\Models\\Message', 1, 'App\\User', '{"attributes":{"id":31,"subject":"Hello","message":"<p>Hello<\\/p><p><br><\\/p>","user_id":1,"intended_model_type":"Admin","intended_model_subtype":"Superadmin","intended_model_id":"0","is_private":0,"private_receipent":null,"readBy":",1","deletedBy":null,"created_at":"2019-04-02 15:36:43","updated_at":"2019-04-02 17:01:44","deleted_at":null},"old":{"id":31,"subject":"Hello","message":"<p>Hello<\\/p><p><br><\\/p>","user_id":1,"intended_model_type":"Admin","intended_model_subtype":"Superadmin","intended_model_id":"0","is_private":0,"private_receipent":null,"readBy":null,"deletedBy":null,"created_at":"2019-04-02 15:36:43","updated_at":"2019-04-02 15:36:43","deleted_at":null}}', '2019-04-02 17:01:44', '2019-04-02 17:01:44'),
(140, 'default', 'updated', 1, 'App\\Models\\MessageCounter', 1, 'App\\User', '{"attributes":{"id":1,"unread":-1,"read":1,"total":0,"user_id":1,"created_at":"2019-01-09 13:17:46","updated_at":"2019-04-02 17:01:44","deleted_at":null},"old":{"id":1,"unread":0,"read":0,"total":0,"user_id":1,"created_at":"2019-01-09 13:17:46","updated_at":"2019-01-31 07:56:44","deleted_at":null}}', '2019-04-02 17:01:44', '2019-04-02 17:01:44'),
(141, 'default', 'created', 1, 'App\\Models\\Chapter', 66, 'App\\User', '{"attributes":{"id":1,"name":"Current Affairs","subject_id":24,"created_at":"2019-04-02 17:03:01","updated_at":"2019-04-02 17:03:01","deleted_at":null}}', '2019-04-02 17:03:01', '2019-04-02 17:03:01'),
(142, 'default', 'created', 2, 'App\\Models\\Chapter', 66, 'App\\User', '{"attributes":{"id":2,"name":"Environment","subject_id":24,"created_at":"2019-04-02 17:04:14","updated_at":"2019-04-02 17:04:14","deleted_at":null}}', '2019-04-02 17:04:14', '2019-04-02 17:04:14'),
(143, 'default', 'created', 10, 'App\\Models\\Introduction', 66, 'App\\User', '{"attributes":{"id":10,"text":"<h2><strong>What is Environmental Pollution?<\\/strong><\\/h2><p>The dictionary explains pollution as \\u201cthe presence in or introduction into the environment of a substance which has harmful or poisonous effects.\\u201d Wiki explains pollution as \\u201cthe introduction of contaminants into the natural environment that cause adverse change.\\u201d Simply put, Environmental Pollution is something that brings harm to our environment and in turn to the people who exist based on the environment.<\\/p>","video":null,"video_type":null,"video_size":null,"videourl":null,"introductable_id":2,"introductable_type":"App\\\\Models\\\\Chapter","created_at":"2019-04-02 17:08:06","updated_at":"2019-04-02 17:08:06","deleted_at":null}}', '2019-04-02 17:08:06', '2019-04-02 17:08:06'),
(144, 'default', 'created', 11, 'App\\Models\\Introduction', 66, 'App\\User', '{"attributes":{"id":11,"text":"<h2><strong>What is Environmental Pollution?<\\/strong><\\/h2><p>The dictionary explains pollution as \\u201cthe presence in or introduction into the environment of a substance which has harmful or poisonous effects.\\u201d Wiki explains pollution as \\u201cthe introduction of contaminants into the natural environment that cause adverse change.\\u201d Simply put, Environmental Pollution is something that brings harm to our environment and in turn to the people who exist based on the environment.<\\/p>","video":null,"video_type":null,"video_size":null,"videourl":null,"introductable_id":24,"introductable_type":"App\\\\Models\\\\Subject","created_at":"2019-04-02 17:09:10","updated_at":"2019-04-02 17:09:10","deleted_at":null}}', '2019-04-02 17:09:10', '2019-04-02 17:09:10'),
(145, 'default', 'created', 24, 'App\\Models\\Section', 66, 'App\\User', '{"attributes":{"id":24,"name":"Air Pollution","chapter_id":2,"love_reactant_id":null,"created_at":"2019-04-02 17:19:55","updated_at":"2019-04-02 17:19:55","deleted_at":null}}', '2019-04-02 17:19:55', '2019-04-02 17:19:55'),
(146, 'default', 'updated', 24, 'App\\Models\\Section', 66, 'App\\User', '{"attributes":{"id":24,"name":"Air Pollution","chapter_id":2,"love_reactant_id":6,"created_at":"2019-04-02 17:19:55","updated_at":"2019-04-02 17:19:55","deleted_at":null},"old":{"id":null,"name":null,"chapter_id":null,"love_reactant_id":null,"created_at":null,"updated_at":null,"deleted_at":null}}', '2019-04-02 17:19:55', '2019-04-02 17:19:55'),
(147, 'default', 'created', 5, 'App\\Models\\Videourl', 66, 'App\\User', '{"attributes":{"id":5,"videourl":"https:\\/\\/www.youtube.com\\/embed\\/L5B-JMnBIyQ","videourlable_id":24,"videourlable_type":"App\\\\Models\\\\Section","created_at":"2019-04-02 17:22:00","updated_at":"2019-04-02 17:22:00","deleted_at":null}}', '2019-04-02 17:22:00', '2019-04-02 17:22:00'),
(148, 'default', 'created', 1, 'App\\Models\\Document', 66, 'App\\User', '{"attributes":{"id":1,"document":"RI6BGbRrSzG0e7EaHyX0JX3p5LylEgYHDXymp6Y1.pdf","doc_name":"Tenderdocument_Directorate of Econimics & Stsstics.pdf","document_type":null,"document_size":null,"documentable_id":24,"documentable_type":"App\\\\Models\\\\Section","created_at":"2019-04-02 17:22:51","updated_at":"2019-04-02 17:22:51","deleted_at":null}}', '2019-04-02 17:22:51', '2019-04-02 17:22:51'),
(149, 'default', 'created', 28, 'App\\Models\\Text', 66, 'App\\User', '{"attributes":{"id":28,"text":"<p><strong>Air pollution<\\/strong> is a mix of particles and gases that can reach harmful concentrations both outside and indoors. Its effects can range from higher disease risks to rising temperatures. Soot, smoke, mold, pollen, methane, and carbon dioxide are a just few examples of common&nbsp;<strong>pollutants<\\/strong>&nbsp;<\\/p>","textable_id":24,"textable_type":"App\\\\Models\\\\Section","created_at":"2019-04-02 17:23:41","updated_at":"2019-04-02 17:23:41","deleted_at":null}}', '2019-04-02 17:23:41', '2019-04-02 17:23:41'),
(150, 'default', 'updated', 9, 'App\\Models\\Introduction', 1, 'App\\User', '{"attributes":{"id":9,"text":"<p>_\\u00e2\\u00f9Z\\u00fdK R\\u00faaK\\u00ea MV^ Ke\\u00ea[\\u00f2a\\u00fb \\u00f9c\\u00f8k\\u00f2K GKKK\\u00ea \\u2018\\u00f9K\\u00fbh\\u2019 K\\u00eaj\\u00fb~\\u00fbG\\u00f6 GK \\u00f9K\\u00fbh\\u00fa R\\u00faae<\\/p><p>@Y\\u00eaa\\u00falY ~a\\u00f9e<\\/p><p>MV^ \\u00f9M\\u00fbU\\u00f2G c\\u00fbZ\\u00e2 \\u00f9K\\u00fbhK\\u00ea \\u00f9^A \\u00f9j\\u00fbA[\\u00fbG (C\\\\\\u00fbjeY - Gc\\u00f2a\\u00fb)\\u00f6 \\u00f9ic\\u00f2Z\\u00f2 aj\\u00ea\\u00f9K\\u00fbh\\u00fa<\\/p><p>j\\u00eaK \\u0308 \\u00f9\\\\L\\u00f4[\\u00f4a\\u00fb \\u00f9K\\u00fbh<\\/p><p>R\\u00faage\\u00fae @\\u00f9^KM\\u00eaW\\u00f2G \\u00f9K\\u00fb<\\/p>","video":null,"video_type":null,"video_size":null,"videourl":null,"introductable_id":22,"introductable_type":"App\\\\Models\\\\Subject","created_at":"2019-04-02 10:18:38","updated_at":"2019-04-02 17:24:44","deleted_at":null},"old":{"id":9,"text":null,"video":null,"video_type":null,"video_size":null,"videourl":null,"introductable_id":22,"introductable_type":"App\\\\Models\\\\Subject","created_at":"2019-04-02 10:18:38","updated_at":"2019-04-02 10:24:40","deleted_at":null}}', '2019-04-02 17:24:44', '2019-04-02 17:24:44'),
(151, 'default', 'created', 25, 'App\\Models\\Section', 66, 'App\\User', '{"attributes":{"id":25,"name":"Water pollution","chapter_id":2,"love_reactant_id":null,"created_at":"2019-04-02 17:26:16","updated_at":"2019-04-02 17:26:16","deleted_at":null}}', '2019-04-02 17:26:16', '2019-04-02 17:26:16'),
(152, 'default', 'updated', 25, 'App\\Models\\Section', 66, 'App\\User', '{"attributes":{"id":25,"name":"Water pollution","chapter_id":2,"love_reactant_id":7,"created_at":"2019-04-02 17:26:16","updated_at":"2019-04-02 17:26:16","deleted_at":null},"old":{"id":null,"name":null,"chapter_id":null,"love_reactant_id":null,"created_at":null,"updated_at":null,"deleted_at":null}}', '2019-04-02 17:26:16', '2019-04-02 17:26:16'),
(153, 'default', 'created', 6, 'App\\Models\\Videourl', 66, 'App\\User', '{"attributes":{"id":6,"videourl":"https:\\/\\/www.youtube.com\\/embed\\/Om42Lppkd9w","videourlable_id":25,"videourlable_type":"App\\\\Models\\\\Section","created_at":"2019-04-02 17:30:34","updated_at":"2019-04-02 17:30:34","deleted_at":null}}', '2019-04-02 17:30:34', '2019-04-02 17:30:34'),
(154, 'default', 'created', 29, 'App\\Models\\Text', 66, 'App\\User', '{"attributes":{"id":29,"text":"<p><strong>Water pollution<\\/strong> is the&nbsp;<strong>contamination<\\/strong> of&nbsp;<strong>water<\\/strong>bodies, usually as a result of human activities.&nbsp;<strong>Water<\\/strong>bodies include for example lakes, rivers, oceans, aquifers and groundwater.&nbsp;<strong>Water pollution<\\/strong> results when contaminants are introduced into the natural environment. <\\/p>","textable_id":25,"textable_type":"App\\\\Models\\\\Section","created_at":"2019-04-02 17:32:06","updated_at":"2019-04-02 17:32:06","deleted_at":null}}', '2019-04-02 17:32:06', '2019-04-02 17:32:06'),
(155, 'default', 'updated', 9, 'App\\Models\\Introduction', 1, 'App\\User', '{"attributes":{"id":9,"text":"<p>_\\u00e2\\u00f9Z\\u00fdK R\\u00faaK\\u00ea MV^ Ke\\u00ea[\\u00f2a\\u00fb \\u00f9c\\u00f8k\\u00f2K GKKK\\u00ea \\u2018\\u00f9K\\u00fbh\\u2019 K\\u00eaj\\u00fb~\\u00fbG\\u00f6 GK \\u00f9K\\u00fbh\\u00fa R\\u00faae<\\/p><p>@Y\\u00eaa\\u00falY ~a\\u00f9e<\\/p><p>MV^ \\u00f9M\\u00fbU\\u00f2G c\\u00fbZ\\u00e2 \\u00f9K\\u00fbhK\\u00ea \\u00f9^A \\u00f9j\\u00fbA[\\u00fbG (C\\\\\\u00fbjeY - Gc\\u00f2a\\u00fb)\\u00f6 \\u00f9ic\\u00f2Z\\u00f2 aj\\u00ea\\u00f9K\\u00fbh\\u00fa<\\/p><p>j\\u00eaK \\u0308 \\u00f9\\\\L\\u00f4[\\u00f4a\\u00fb \\u00f9K\\u00fbh<\\/p><p>R\\u00faage\\u00fae @\\u00f9^KM\\u00eaW\\u00f2G \\u00f9K\\u00fb<\\/p><p><br><\\/p><p>&lt;iframe width=\\"600\\" height=\\"480\\" src=\\"https:\\/\\/www.youtube.com\\/embed\\/qe16dKCXXp4\\" frameborder=\\"0\\" allow=\\"accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture\\" allowfullscreen&gt;&lt;\\/iframe&gt;<\\/p><p><br><\\/p>","video":null,"video_type":null,"video_size":null,"videourl":null,"introductable_id":22,"introductable_type":"App\\\\Models\\\\Subject","created_at":"2019-04-02 10:18:38","updated_at":"2019-04-02 17:35:50","deleted_at":null},"old":{"id":9,"text":"<p>_\\u00e2\\u00f9Z\\u00fdK R\\u00faaK\\u00ea MV^ Ke\\u00ea[\\u00f2a\\u00fb \\u00f9c\\u00f8k\\u00f2K GKKK\\u00ea \\u2018\\u00f9K\\u00fbh\\u2019 K\\u00eaj\\u00fb~\\u00fbG\\u00f6 GK \\u00f9K\\u00fbh\\u00fa R\\u00faae<\\/p><p>@Y\\u00eaa\\u00falY ~a\\u00f9e<\\/p><p>MV^ \\u00f9M\\u00fbU\\u00f2G c\\u00fbZ\\u00e2 \\u00f9K\\u00fbhK\\u00ea \\u00f9^A \\u00f9j\\u00fbA[\\u00fbG (C\\\\\\u00fbjeY - Gc\\u00f2a\\u00fb)\\u00f6 \\u00f9ic\\u00f2Z\\u00f2 aj\\u00ea\\u00f9K\\u00fbh\\u00fa<\\/p><p>j\\u00eaK \\u0308 \\u00f9\\\\L\\u00f4[\\u00f4a\\u00fb \\u00f9K\\u00fbh<\\/p><p>R\\u00faage\\u00fae @\\u00f9^KM\\u00eaW\\u00f2G \\u00f9K\\u00fb<\\/p>","video":null,"video_type":null,"video_size":null,"videourl":null,"introductable_id":22,"introductable_type":"App\\\\Models\\\\Subject","created_at":"2019-04-02 10:18:38","updated_at":"2019-04-02 17:24:44","deleted_at":null}}', '2019-04-02 17:35:50', '2019-04-02 17:35:50'),
(156, 'default', 'created', 3, 'App\\Models\\Chapter', 1, 'App\\User', '{"attributes":{"id":3,"name":"R\\u00faa\\u00f9K\\u00fbh I Gj\\u00fbe iwV^","subject_id":22,"created_at":"2019-04-02 17:37:23","updated_at":"2019-04-02 17:37:23","deleted_at":null}}', '2019-04-02 17:37:23', '2019-04-02 17:37:23'),
(157, 'default', 'updated', 9, 'App\\Models\\Introduction', 1, 'App\\User', '{"attributes":{"id":9,"text":"<p>_\\u00e2\\u00f9Z\\u00fdK R\\u00faaK\\u00ea MV^ Ke\\u00ea[\\u00f2a\\u00fb \\u00f9c\\u00f8k\\u00f2K GKKK\\u00ea \\u2018\\u00f9K\\u00fbh\\u2019 K\\u00eaj\\u00fb~\\u00fbG\\u00f6 GK \\u00f9K\\u00fbh\\u00fa R\\u00faae<\\/p><p>@Y\\u00eaa\\u00falY ~a\\u00f9e<\\/p><p>MV^ \\u00f9M\\u00fbU\\u00f2G c\\u00fbZ\\u00e2 \\u00f9K\\u00fbhK\\u00ea \\u00f9^A \\u00f9j\\u00fbA[\\u00fbG (C\\\\\\u00fbjeY - Gc\\u00f2a\\u00fb)\\u00f6 \\u00f9ic\\u00f2Z\\u00f2 aj\\u00ea\\u00f9K\\u00fbh\\u00fa<\\/p><p>j\\u00eaK \\u0308 \\u00f9\\\\L\\u00f4[\\u00f4a\\u00fb \\u00f9K\\u00fbh<\\/p><p>R\\u00faage\\u00fae @\\u00f9^KM\\u00eaW\\u00f2G \\u00f9K\\u00fb<\\/p>","video":null,"video_type":null,"video_size":null,"videourl":null,"introductable_id":22,"introductable_type":"App\\\\Models\\\\Subject","created_at":"2019-04-02 10:18:38","updated_at":"2019-04-02 17:38:31","deleted_at":null},"old":{"id":9,"text":"<p>_\\u00e2\\u00f9Z\\u00fdK R\\u00faaK\\u00ea MV^ Ke\\u00ea[\\u00f2a\\u00fb \\u00f9c\\u00f8k\\u00f2K GKKK\\u00ea \\u2018\\u00f9K\\u00fbh\\u2019 K\\u00eaj\\u00fb~\\u00fbG\\u00f6 GK \\u00f9K\\u00fbh\\u00fa R\\u00faae<\\/p><p>@Y\\u00eaa\\u00falY ~a\\u00f9e<\\/p><p>MV^ \\u00f9M\\u00fbU\\u00f2G c\\u00fbZ\\u00e2 \\u00f9K\\u00fbhK\\u00ea \\u00f9^A \\u00f9j\\u00fbA[\\u00fbG (C\\\\\\u00fbjeY - Gc\\u00f2a\\u00fb)\\u00f6 \\u00f9ic\\u00f2Z\\u00f2 aj\\u00ea\\u00f9K\\u00fbh\\u00fa<\\/p><p>j\\u00eaK \\u0308 \\u00f9\\\\L\\u00f4[\\u00f4a\\u00fb \\u00f9K\\u00fbh<\\/p><p>R\\u00faage\\u00fae @\\u00f9^KM\\u00eaW\\u00f2G \\u00f9K\\u00fb<\\/p><p><br><\\/p><p>&lt;iframe width=\\"600\\" height=\\"480\\" src=\\"https:\\/\\/www.youtube.com\\/embed\\/qe16dKCXXp4\\" frameborder=\\"0\\" allow=\\"accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture\\" allowfullscreen&gt;&lt;\\/iframe&gt;<\\/p><p><br><\\/p>","video":null,"video_type":null,"video_size":null,"videourl":null,"introductable_id":22,"introductable_type":"App\\\\Models\\\\Subject","created_at":"2019-04-02 10:18:38","updated_at":"2019-04-02 17:35:50","deleted_at":null}}', '2019-04-02 17:38:31', '2019-04-02 17:38:31'),
(158, 'default', 'created', 4, 'App\\Models\\Video', 83, 'App\\User', '{"attributes":{"id":4,"video":"B2MWg22mv4MoKTDwE0Xi0rGJ8KVCfI9TgCN1I139.mp4","video_type":null,"video_size":null,"videoable_id":25,"videoable_type":"App\\\\Models\\\\Section","created_at":"2019-04-02 17:39:48","updated_at":"2019-04-02 17:39:48","deleted_at":null}}', '2019-04-02 17:39:48', '2019-04-02 17:39:48'),
(159, 'default', 'created', 5, 'App\\Models\\Video', 83, 'App\\User', '{"attributes":{"id":5,"video":"YvipcYhU8pm7mEymyB4wVAoo3qZjB3f2MCwBFHSo.mp4","video_type":null,"video_size":null,"videoable_id":24,"videoable_type":"App\\\\Models\\\\Section","created_at":"2019-04-02 17:40:39","updated_at":"2019-04-02 17:40:39","deleted_at":null}}', '2019-04-02 17:40:39', '2019-04-02 17:40:39'),
(160, 'default', 'updated', 9, 'App\\Models\\Introduction', 1, 'App\\User', '{"attributes":{"id":9,"text":"<p>1665 ci\\u00f2j\\u00fb\\u00f9e eaU\\u00f0 j\\u00eaK\\u00fe ^\\u00fbcK a\\u00e2\\u00f2U\\u00f2g \\u00f9a\\u00f7m\\u00fb^\\u00f2K GK KK\\u00f0e _Zk\\u00fb @\\u00f5gK\\u00ea @Y\\u00eaa\\u00falY<\\/p><p>~a\\u00f9e \\u00f9\\\\L\\u00f2 Z\\u00fbj\\u00fb \\u00f9K\\u00f9ZM\\u00eaW\\u00f2G \\u00f9K\\u00fbh\\u00f9e MV\\u00f2Z \\u00f9j\\u00fbA[\\u00f2a\\u00fb RY\\u00fbA\\u00f9f\\u00f6 \\u00f9ij\\u00f2 \\u00f9K\\u00fbhM\\u00eaW\\u00f2K<\\/p><p>cj\\u00ea\\u00f9`Y\\u00fb i\\\\\\u00e9g \\u00f9Q\\u00fbU \\u00f9K\\u00fbVe\\u00fa (P\\u00f2Z\\u00e2 - 1.1) bk\\u00f2 [\\u00f2f\\u00fb\\u00f6<\\/p><p>_\\u00e2\\u00f9Z\\u00fdK R\\u00faaK\\u00ea MV^ Ke\\u00ea[\\u00f2a\\u00fb \\u00f9c\\u00f8k\\u00f2K GKKK\\u00ea \\u2018\\u00f9K\\u00fbh\\u2019 K\\u00eaj\\u00fb~\\u00fbG\\u00f6 GK \\u00f9K\\u00fbh\\u00fa R\\u00faae<\\/p><p>@Y\\u00eaa\\u00falY ~a\\u00f9e<\\/p><p>MV^ \\u00f9M\\u00fbU\\u00f2G c\\u00fbZ\\u00e2 \\u00f9K\\u00fbhK\\u00ea \\u00f9^A \\u00f9j\\u00fbA[\\u00fbG (C\\\\\\u00fbjeY - Gc\\u00f2a\\u00fb)\\u00f6 \\u00f9ic\\u00f2Z\\u00f2 aj\\u00ea\\u00f9K\\u00fbh\\u00fa<\\/p><p>j\\u00eaK \\u0308 \\u00f9\\\\L\\u00f4[\\u00f4a\\u00fb \\u00f9K\\u00fbh<\\/p><p>R\\u00faage\\u00fae @\\u00f9^KM\\u00eaW\\u00f2G \\u00f9K\\u00fbh\\\\\\u00df\\u00fbe\\u00fb \\u00f9j\\u00fbA[\\u00fbG (C\\\\\\u00fbjeY - Z\\u00eac P\\u00fbe\\u00f2_U\\u00f9e [\\u00f2a\\u00fb<\\/p><p>(P\\u00f2Z\\u00e2 - 1.1)<\\/p><p>a\\u00e9lfZ\\u00fb, _g\\u00ea_l\\u00fa, cY\\u00f2h)\\u00f6<\\/p>","video":null,"video_type":null,"video_size":null,"videourl":null,"introductable_id":22,"introductable_type":"App\\\\Models\\\\Subject","created_at":"2019-04-02 10:18:38","updated_at":"2019-04-02 17:42:57","deleted_at":null},"old":{"id":9,"text":"<p>_\\u00e2\\u00f9Z\\u00fdK R\\u00faaK\\u00ea MV^ Ke\\u00ea[\\u00f2a\\u00fb \\u00f9c\\u00f8k\\u00f2K GKKK\\u00ea \\u2018\\u00f9K\\u00fbh\\u2019 K\\u00eaj\\u00fb~\\u00fbG\\u00f6 GK \\u00f9K\\u00fbh\\u00fa R\\u00faae<\\/p><p>@Y\\u00eaa\\u00falY ~a\\u00f9e<\\/p><p>MV^ \\u00f9M\\u00fbU\\u00f2G c\\u00fbZ\\u00e2 \\u00f9K\\u00fbhK\\u00ea \\u00f9^A \\u00f9j\\u00fbA[\\u00fbG (C\\\\\\u00fbjeY - Gc\\u00f2a\\u00fb)\\u00f6 \\u00f9ic\\u00f2Z\\u00f2 aj\\u00ea\\u00f9K\\u00fbh\\u00fa<\\/p><p>j\\u00eaK \\u0308 \\u00f9\\\\L\\u00f4[\\u00f4a\\u00fb \\u00f9K\\u00fbh<\\/p><p>R\\u00faage\\u00fae @\\u00f9^KM\\u00eaW\\u00f2G \\u00f9K\\u00fb<\\/p>","video":null,"video_type":null,"video_size":null,"videourl":null,"introductable_id":22,"introductable_type":"App\\\\Models\\\\Subject","created_at":"2019-04-02 10:18:38","updated_at":"2019-04-02 17:38:31","deleted_at":null}}', '2019-04-02 17:42:57', '2019-04-02 17:42:57'),
(161, 'default', 'updated', 9, 'App\\Models\\Introduction', 1, 'App\\User', '{"attributes":{"id":9,"text":"<p><br><\\/p><p><br><\\/p>","video":null,"video_type":null,"video_size":null,"videourl":null,"introductable_id":22,"introductable_type":"App\\\\Models\\\\Subject","created_at":"2019-04-02 10:18:38","updated_at":"2019-04-02 17:44:33","deleted_at":null},"old":{"id":9,"text":"<p>1665 ci\\u00f2j\\u00fb\\u00f9e eaU\\u00f0 j\\u00eaK\\u00fe ^\\u00fbcK a\\u00e2\\u00f2U\\u00f2g \\u00f9a\\u00f7m\\u00fb^\\u00f2K GK KK\\u00f0e _Zk\\u00fb @\\u00f5gK\\u00ea @Y\\u00eaa\\u00falY<\\/p><p>~a\\u00f9e \\u00f9\\\\L\\u00f2 Z\\u00fbj\\u00fb \\u00f9K\\u00f9ZM\\u00eaW\\u00f2G \\u00f9K\\u00fbh\\u00f9e MV\\u00f2Z \\u00f9j\\u00fbA[\\u00f2a\\u00fb RY\\u00fbA\\u00f9f\\u00f6 \\u00f9ij\\u00f2 \\u00f9K\\u00fbhM\\u00eaW\\u00f2K<\\/p><p>cj\\u00ea\\u00f9`Y\\u00fb i\\\\\\u00e9g \\u00f9Q\\u00fbU \\u00f9K\\u00fbVe\\u00fa (P\\u00f2Z\\u00e2 - 1.1) bk\\u00f2 [\\u00f2f\\u00fb\\u00f6<\\/p><p>_\\u00e2\\u00f9Z\\u00fdK R\\u00faaK\\u00ea MV^ Ke\\u00ea[\\u00f2a\\u00fb \\u00f9c\\u00f8k\\u00f2K GKKK\\u00ea \\u2018\\u00f9K\\u00fbh\\u2019 K\\u00eaj\\u00fb~\\u00fbG\\u00f6 GK \\u00f9K\\u00fbh\\u00fa R\\u00faae<\\/p><p>@Y\\u00eaa\\u00falY ~a\\u00f9e<\\/p><p>MV^ \\u00f9M\\u00fbU\\u00f2G c\\u00fbZ\\u00e2 \\u00f9K\\u00fbhK\\u00ea \\u00f9^A \\u00f9j\\u00fbA[\\u00fbG (C\\\\\\u00fbjeY - Gc\\u00f2a\\u00fb)\\u00f6 \\u00f9ic\\u00f2Z\\u00f2 aj\\u00ea\\u00f9K\\u00fbh\\u00fa<\\/p><p>j\\u00eaK \\u0308 \\u00f9\\\\L\\u00f4[\\u00f4a\\u00fb \\u00f9K\\u00fbh<\\/p><p>R\\u00faage\\u00fae @\\u00f9^KM\\u00eaW\\u00f2G \\u00f9K\\u00fbh\\\\\\u00df\\u00fbe\\u00fb \\u00f9j\\u00fbA[\\u00fbG (C\\\\\\u00fbjeY - Z\\u00eac P\\u00fbe\\u00f2_U\\u00f9e [\\u00f2a\\u00fb<\\/p><p>(P\\u00f2Z\\u00e2 - 1.1)<\\/p><p>a\\u00e9lfZ\\u00fb, _g\\u00ea_l\\u00fa, cY\\u00f2h)\\u00f6<\\/p>","video":null,"video_type":null,"video_size":null,"videourl":null,"introductable_id":22,"introductable_type":"App\\\\Models\\\\Subject","created_at":"2019-04-02 10:18:38","updated_at":"2019-04-02 17:42:57","deleted_at":null}}', '2019-04-02 17:44:33', '2019-04-02 17:44:33'),
(162, 'default', 'created', 7, 'App\\Models\\Videourl', 1, 'App\\User', '{"attributes":{"id":7,"videourl":"https:\\/\\/youtu.be\\/e6rglsLy1Ys","videourlable_id":24,"videourlable_type":"App\\\\Models\\\\Section","created_at":"2019-04-02 17:50:02","updated_at":"2019-04-02 17:50:02","deleted_at":null}}', '2019-04-02 17:50:02', '2019-04-02 17:50:02'),
(163, 'default', 'created', 6, 'App\\Models\\Video', 83, 'App\\User', '{"attributes":{"id":6,"video":"BR87EDdipOOXCtDfU0wRRMNtuYtF0QdbBuo6SsMA.mp4","video_type":null,"video_size":null,"videoable_id":24,"videoable_type":"App\\\\Models\\\\Section","created_at":"2019-04-02 17:58:04","updated_at":"2019-04-02 17:58:04","deleted_at":null}}', '2019-04-02 17:58:04', '2019-04-02 17:58:04'),
(164, 'default', 'created', 7, 'App\\Models\\Video', 83, 'App\\User', '{"attributes":{"id":7,"video":"daZSU7X9ESJ1nK9X46qGXuVv84TLsT3oMZwbmamU.mp4","video_type":null,"video_size":null,"videoable_id":25,"videoable_type":"App\\\\Models\\\\Section","created_at":"2019-04-02 17:58:51","updated_at":"2019-04-02 17:58:51","deleted_at":null}}', '2019-04-02 17:58:51', '2019-04-02 17:58:51'),
(165, 'default', 'created', 8, 'App\\Models\\Video', 83, 'App\\User', '{"attributes":{"id":8,"video":"9jAWkPv8rbevTTf7kO8qi95E7JHzbIcU3IT5AziJ.mp4","video_type":null,"video_size":null,"videoable_id":25,"videoable_type":"App\\\\Models\\\\Section","created_at":"2019-04-02 17:58:55","updated_at":"2019-04-02 17:58:55","deleted_at":null}}', '2019-04-02 17:58:55', '2019-04-02 17:58:55'),
(166, 'default', 'created', 8, 'App\\Models\\Videourl', 1, 'App\\User', '{"attributes":{"id":8,"videourl":"e6rglsLy1Ys","videourlable_id":24,"videourlable_type":"App\\\\Models\\\\Section","created_at":"2019-04-02 18:00:52","updated_at":"2019-04-02 18:00:52","deleted_at":null}}', '2019-04-02 18:00:52', '2019-04-02 18:00:52'),
(167, 'default', 'created', 20, 'App\\Models\\ExamAppearance', 81, 'App\\User', '[]', '2019-04-02 18:09:43', '2019-04-02 18:09:43'),
(168, 'default', 'created', 7, 'App\\Models\\StudentAnswer', 81, 'App\\User', '[]', '2019-04-02 18:09:49', '2019-04-02 18:09:49'),
(169, 'default', 'created', 28, 'App\\Models\\Question', 83, 'App\\User', '{"attributes":{"id":28,"heading":"<p>National Fruit of India is ____<\\/p>","type":"fill","marks":10,"answer":"Mango","question_group_id":14,"created_at":"2019-04-02 18:54:34","updated_at":"2019-04-02 18:54:34","deleted_at":null}}', '2019-04-02 18:54:34', '2019-04-02 18:54:34'),
(170, 'default', 'created', 29, 'App\\Models\\Question', 83, 'App\\User', '{"attributes":{"id":29,"heading":"<p>National Bird of India is peacock?<\\/p>","type":"boolean","marks":10,"answer":"1","question_group_id":14,"created_at":"2019-04-02 18:55:05","updated_at":"2019-04-02 18:55:05","deleted_at":null}}', '2019-04-02 18:55:05', '2019-04-02 18:55:05'),
(171, 'default', 'created', 30, 'App\\Models\\Question', 83, 'App\\User', '{"attributes":{"id":30,"heading":"<p>Who is called as Iron Man of India?<\\/p>","type":"radio","marks":10,"answer":"4","question_group_id":14,"created_at":"2019-04-02 18:57:35","updated_at":"2019-04-02 18:57:35","deleted_at":null}}', '2019-04-02 18:57:35', '2019-04-02 18:57:35'),
(172, 'default', 'created', 12, 'App\\Models\\Option', 83, 'App\\User', '{"attributes":{"id":12,"first":"Jawahar Lal Nehru","second":"Rajeev Gandhi","third":"PV Narsimha Rao","fourth":"Sardar Vallabhbhai Patel","right_answer":null,"question_id":30,"created_at":"2019-04-02 18:57:35","updated_at":"2019-04-02 18:57:35","deleted_at":null}}', '2019-04-02 18:57:35', '2019-04-02 18:57:35'),
(173, 'default', 'updated', 20, 'App\\Models\\QuestionSet', 83, 'App\\User', '{"attributes":{"id":20,"name":"Set A","is_submited":1,"is_selected":0,"user_id":83,"exam_id":22,"created_at":"2019-04-02 13:42:28","updated_at":"2019-04-02 19:00:54","deleted_at":null},"old":{"id":20,"name":"Set A","is_submited":0,"is_selected":0,"user_id":83,"exam_id":22,"created_at":"2019-04-02 13:42:28","updated_at":"2019-04-02 14:33:13","deleted_at":null}}', '2019-04-02 19:00:54', '2019-04-02 19:00:54'),
(174, 'default', 'updated', 22, 'App\\Models\\Exam', 80, 'App\\User', '{"attributes":{"id":22,"name":"General Knowledge test","start_date_time":"2019-04-02 14:00:39","end_date_time":"2019-04-02 23:22:45","exam_head":83,"total_marks":50,"is_confirmed":1,"is_over":0,"is_started":0,"is_upcoming":1,"result_announced":0,"grade_id":7,"for_all_classroom":1,"subgrade_id":null,"subject_id":24,"topic_id":null,"selected_set":20,"created_at":"2019-04-02 13:23:13","updated_at":"2019-04-02 19:02:25","deleted_at":null},"old":{"id":22,"name":"General Knowledge test","start_date_time":"2019-04-02 14:00:39","end_date_time":"2019-04-02 23:22:45","exam_head":83,"total_marks":50,"is_confirmed":1,"is_over":0,"is_started":0,"is_upcoming":1,"result_announced":0,"grade_id":7,"for_all_classroom":1,"subgrade_id":null,"subject_id":24,"topic_id":null,"selected_set":null,"created_at":"2019-04-02 13:23:13","updated_at":"2019-04-02 13:59:26","deleted_at":null}}', '2019-04-02 19:02:25', '2019-04-02 19:02:25'),
(175, 'default', 'updated', 20, 'App\\Models\\QuestionSet', 80, 'App\\User', '{"attributes":{"id":20,"name":"Set A","is_submited":1,"is_selected":1,"user_id":83,"exam_id":22,"created_at":"2019-04-02 13:42:28","updated_at":"2019-04-02 19:02:25","deleted_at":null},"old":{"id":20,"name":"Set A","is_submited":1,"is_selected":0,"user_id":83,"exam_id":22,"created_at":"2019-04-02 13:42:28","updated_at":"2019-04-02 19:00:54","deleted_at":null}}', '2019-04-02 19:02:25', '2019-04-02 19:02:25'),
(176, 'default', 'created', 21, 'App\\Models\\ExamAppearance', 81, 'App\\User', '[]', '2019-04-02 19:04:32', '2019-04-02 19:04:32'),
(177, 'default', 'created', 8, 'App\\Models\\StudentAnswer', 81, 'App\\User', '[]', '2019-04-02 19:04:38', '2019-04-02 19:04:38'),
(178, 'default', 'created', 7, 'App\\Models\\IndividualResult', 80, 'App\\User', '[]', '2019-04-02 19:08:11', '2019-04-02 19:08:11'),
(179, 'default', 'created', 2, 'App\\Models\\Result', 80, 'App\\User', '[]', '2019-04-02 19:08:11', '2019-04-02 19:08:11'),
(180, 'default', 'updated', 22, 'App\\Models\\Exam', 80, 'App\\User', '{"attributes":{"id":22,"name":"General Knowledge test","start_date_time":"2019-04-02 14:00:39","end_date_time":"2019-04-02 15:22:45","exam_head":83,"total_marks":50,"is_confirmed":1,"is_over":1,"is_started":0,"is_upcoming":0,"result_announced":1,"grade_id":7,"for_all_classroom":1,"subgrade_id":null,"subject_id":24,"topic_id":null,"selected_set":20,"created_at":"2019-04-02 13:23:13","updated_at":"2019-04-02 19:08:11","deleted_at":null},"old":{"id":22,"name":"General Knowledge test","start_date_time":"2019-04-02 14:00:39","end_date_time":"2019-04-02 15:22:45","exam_head":83,"total_marks":50,"is_confirmed":1,"is_over":1,"is_started":0,"is_upcoming":0,"result_announced":0,"grade_id":7,"for_all_classroom":1,"subgrade_id":null,"subject_id":24,"topic_id":null,"selected_set":20,"created_at":"2019-04-02 13:23:13","updated_at":"2019-04-02 19:02:25","deleted_at":null}}', '2019-04-02 19:08:11', '2019-04-02 19:08:11'),
(181, 'default', 'created', 23, 'App\\Models\\Exam', 80, 'App\\User', '{"attributes":{"id":23,"name":"Test2","start_date_time":"2019-04-02 19:09:18","end_date_time":"2019-04-02 21:09:23","exam_head":83,"total_marks":20,"is_confirmed":1,"is_over":0,"is_started":1,"is_upcoming":0,"result_announced":0,"grade_id":7,"for_all_classroom":0,"subgrade_id":null,"subject_id":24,"topic_id":null,"selected_set":null,"created_at":"2019-04-02 19:09:40","updated_at":"2019-04-02 19:09:40","deleted_at":null}}', '2019-04-02 19:09:40', '2019-04-02 19:09:40'),
(182, 'default', 'created', 14, 'App\\Models\\ExamOrganizer', 80, 'App\\User', '[]', '2019-04-02 19:10:13', '2019-04-02 19:10:13'),
(183, 'default', 'created', 21, 'App\\Models\\QuestionSet', 83, 'App\\User', '{"attributes":{"id":21,"name":"SET A","is_submited":0,"is_selected":0,"user_id":83,"exam_id":23,"created_at":"2019-04-02 19:13:30","updated_at":"2019-04-02 19:13:30","deleted_at":null}}', '2019-04-02 19:13:30', '2019-04-02 19:13:30'),
(184, 'default', 'created', 16, 'App\\Models\\QuestionGroup', 83, 'App\\User', '[]', '2019-04-02 19:13:50', '2019-04-02 19:13:50'),
(185, 'default', 'created', 31, 'App\\Models\\Question', 83, 'App\\User', '{"attributes":{"id":31,"heading":"<p>National Birl of India is Peacock?<\\/p>","type":"boolean","marks":10,"answer":"1","question_group_id":16,"created_at":"2019-04-02 19:16:28","updated_at":"2019-04-02 19:16:28","deleted_at":null}}', '2019-04-02 19:16:28', '2019-04-02 19:16:28'),
(186, 'default', 'updated', 21, 'App\\Models\\QuestionSet', 83, 'App\\User', '{"attributes":{"id":21,"name":"SET A","is_submited":1,"is_selected":0,"user_id":83,"exam_id":23,"created_at":"2019-04-02 19:13:30","updated_at":"2019-04-02 20:03:41","deleted_at":null},"old":{"id":21,"name":"SET A","is_submited":0,"is_selected":0,"user_id":83,"exam_id":23,"created_at":"2019-04-02 19:13:30","updated_at":"2019-04-02 19:13:30","deleted_at":null}}', '2019-04-02 20:03:41', '2019-04-02 20:03:41'),
(187, 'default', 'updated', 23, 'App\\Models\\Exam', 1, 'App\\User', '{"attributes":{"id":23,"name":"Test2","start_date_time":"2019-04-02 20:10:18","end_date_time":"2019-04-02 21:09:23","exam_head":83,"total_marks":20,"is_confirmed":1,"is_over":0,"is_started":0,"is_upcoming":1,"result_announced":0,"grade_id":7,"for_all_classroom":0,"subgrade_id":null,"subject_id":24,"topic_id":null,"selected_set":21,"created_at":"2019-04-02 19:09:40","updated_at":"2019-04-02 20:06:26","deleted_at":null},"old":{"id":23,"name":"Test2","start_date_time":"2019-04-02 20:10:18","end_date_time":"2019-04-02 21:09:23","exam_head":83,"total_marks":20,"is_confirmed":1,"is_over":0,"is_started":0,"is_upcoming":1,"result_announced":0,"grade_id":7,"for_all_classroom":0,"subgrade_id":null,"subject_id":24,"topic_id":null,"selected_set":null,"created_at":"2019-04-02 19:09:40","updated_at":"2019-04-02 19:09:40","deleted_at":null}}', '2019-04-02 20:06:26', '2019-04-02 20:06:26'),
(188, 'default', 'updated', 21, 'App\\Models\\QuestionSet', 1, 'App\\User', '{"attributes":{"id":21,"name":"SET A","is_submited":1,"is_selected":1,"user_id":83,"exam_id":23,"created_at":"2019-04-02 19:13:30","updated_at":"2019-04-02 20:06:26","deleted_at":null},"old":{"id":21,"name":"SET A","is_submited":1,"is_selected":0,"user_id":83,"exam_id":23,"created_at":"2019-04-02 19:13:30","updated_at":"2019-04-02 20:03:41","deleted_at":null}}', '2019-04-02 20:06:26', '2019-04-02 20:06:26'),
(189, 'default', 'updated', 31, 'App\\Models\\Message', 1, 'App\\User', '{"attributes":{"id":31,"subject":"Hello","message":"<p>Hello<\\/p><p><br><\\/p>","user_id":1,"intended_model_type":"Admin","intended_model_subtype":"Superadmin","intended_model_id":"0","is_private":0,"private_receipent":null,"readBy":",1","deletedBy":",1","created_at":"2019-04-02 15:36:43","updated_at":"2019-04-04 05:06:57","deleted_at":null},"old":{"id":31,"subject":"Hello","message":"<p>Hello<\\/p><p><br><\\/p>","user_id":1,"intended_model_type":"Admin","intended_model_subtype":"Superadmin","intended_model_id":"0","is_private":0,"private_receipent":null,"readBy":",1","deletedBy":null,"created_at":"2019-04-02 15:36:43","updated_at":"2019-04-02 17:01:44","deleted_at":null}}', '2019-04-04 05:06:58', '2019-04-04 05:06:58'),
(190, 'default', 'created', 4, 'App\\Models\\Event', 66, 'App\\User', '{"attributes":{"id":4,"title":"first api","tagline":"Mtech","description":"This is test Event only.","eventtype":"Pinned","model_id":19,"model_type":"Organization","start":"2019-04-06","end":"2019-04-06","is_complete":0,"is_started":0,"is_important":0,"organiser_id":83,"created_at":"2019-04-05 07:11:07","updated_at":"2019-04-05 07:11:07","deleted_at":null}}', '2019-04-05 07:11:07', '2019-04-05 07:11:07'),
(191, 'default', 'created', 5, 'App\\Models\\Event', 73, 'App\\User', '{"attributes":{"id":5,"title":"Apple","tagline":"orrange","description":"hfhfthfthf fdfdf","eventtype":"Pinned","model_id":19,"model_type":"Organization","start":"2019-04-06","end":"2019-04-06","is_complete":0,"is_started":0,"is_important":0,"organiser_id":83,"created_at":"2019-04-05 07:24:29","updated_at":"2019-04-05 07:24:29","deleted_at":null}}', '2019-04-05 07:24:29', '2019-04-05 07:24:29'),
(192, 'default', 'created', 6, 'App\\Models\\Event', 1, 'App\\User', '{"attributes":{"id":6,"title":"ABCDEF","tagline":"abcd","description":"lorem30;","eventtype":"Pinned","model_id":19,"model_type":"Organization","start":"2019-04-10","end":"2019-04-14","is_complete":0,"is_started":0,"is_important":0,"organiser_id":80,"created_at":"2019-04-05 10:12:53","updated_at":"2019-04-05 10:12:53","deleted_at":null}}', '2019-04-05 10:12:53', '2019-04-05 10:12:53'),
(193, 'default', 'created', 7, 'App\\Models\\Event', 1, 'App\\User', '{"attributes":{"id":7,"title":"ABCDEF","tagline":"abcd","description":"lorem30;","eventtype":"Pinned","model_id":19,"model_type":"Organization","start":"2019-04-10","end":"2019-04-14","is_complete":0,"is_started":0,"is_important":0,"organiser_id":80,"created_at":"2019-04-05 10:13:05","updated_at":"2019-04-05 10:13:05","deleted_at":null}}', '2019-04-05 10:13:05', '2019-04-05 10:13:05'),
(194, 'default', 'created', 8, 'App\\Models\\Event', 1, 'App\\User', '{"attributes":{"id":8,"title":"ABCDEF","tagline":"abcd","description":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam et fermentum dui. Ut orci quam, ornare sed lorem sed, hendrerit auctor dolor. Nulla viverra, nibh quis ultrices malesuada, ligula ipsum.","eventtype":"Pinned","model_id":19,"model_type":"Organization","start":"2019-04-16","end":"2019-04-18","is_complete":0,"is_started":0,"is_important":0,"organiser_id":80,"created_at":"2019-04-05 12:28:16","updated_at":"2019-04-05 12:28:16","deleted_at":null}}', '2019-04-05 12:28:16', '2019-04-05 12:28:16'),
(195, 'default', 'created', 24, 'App\\Models\\Exam', 1, 'App\\User', '{"attributes":{"id":24,"name":"New Examination","start_date_time":"2019-04-05 00:00:00","end_date_time":"2019-04-07 00:00:00","exam_head":71,"total_marks":100,"is_confirmed":1,"is_over":0,"is_started":1,"is_upcoming":0,"result_announced":0,"grade_id":2,"for_all_classroom":0,"subgrade_id":4,"subject_id":19,"topic_id":null,"selected_set":null,"created_at":"2019-04-05 14:11:56","updated_at":"2019-04-05 14:11:56","deleted_at":null}}', '2019-04-05 14:11:56', '2019-04-05 14:11:56'),
(196, 'default', 'created', 15, 'App\\Models\\ExamOrganizer', 1, 'App\\User', '[]', '2019-04-05 14:21:38', '2019-04-05 14:21:38'),
(197, 'default', 'created', 25, 'App\\Models\\Exam', 1, 'App\\User', '{"attributes":{"id":25,"name":"Newest test examination","start_date_time":"2019-04-07 00:00:00","end_date_time":"2019-04-11 00:00:00","exam_head":71,"total_marks":100,"is_confirmed":1,"is_over":0,"is_started":0,"is_upcoming":1,"result_announced":0,"grade_id":2,"for_all_classroom":0,"subgrade_id":4,"subject_id":19,"topic_id":null,"selected_set":null,"created_at":"2019-04-05 20:14:14","updated_at":"2019-04-05 20:14:14","deleted_at":null}}', '2019-04-05 20:14:14', '2019-04-05 20:14:14'),
(198, 'default', 'created', 16, 'App\\Models\\ExamOrganizer', 1, 'App\\User', '[]', '2019-04-05 20:14:32', '2019-04-05 20:14:32'),
(199, 'default', 'updated', 32, 'App\\Models\\Message', 66, 'App\\User', '{"attributes":{"id":32,"subject":"Motilal Nehru Public School","message":"<p>Hello<\\/p>","user_id":1,"intended_model_type":"Admin","intended_model_subtype":"SiteAdmin","intended_model_id":"0","is_private":0,"private_receipent":null,"readBy":",66","deletedBy":null,"created_at":"2019-04-02 15:38:17","updated_at":"2019-04-05 23:24:45","deleted_at":null},"old":{"id":32,"subject":"Motilal Nehru Public School","message":"<p>Hello<\\/p>","user_id":1,"intended_model_type":"Admin","intended_model_subtype":"SiteAdmin","intended_model_id":"0","is_private":0,"private_receipent":null,"readBy":null,"deletedBy":null,"created_at":"2019-04-02 15:38:17","updated_at":"2019-04-02 15:38:17","deleted_at":null}}', '2019-04-05 23:24:45', '2019-04-05 23:24:45'),
(200, 'default', 'updated', 17, 'App\\Models\\MessageCounter', 66, 'App\\User', '{"attributes":{"id":17,"unread":-1,"read":1,"total":0,"user_id":66,"created_at":"2019-03-18 00:20:14","updated_at":"2019-04-05 23:24:45","deleted_at":null},"old":{"id":17,"unread":0,"read":0,"total":0,"user_id":66,"created_at":"2019-03-18 00:20:14","updated_at":"2019-03-18 00:20:14","deleted_at":null}}', '2019-04-05 23:24:45', '2019-04-05 23:24:45'),
(201, 'default', 'created', 34, 'App\\Models\\Message', 66, 'App\\User', '{"attributes":{"id":34,"subject":"Testing","message":"<p>Hi Nishant,<\\/p><p>This one is a <strong>test message.&nbsp;<\\/strong> Please see if its fine.<\\/p><p>Regards,<\\/p><p>Aakash<\\/p>","user_id":66,"intended_model_type":"Admin","intended_model_subtype":"SiteAdmin","intended_model_id":"0","is_private":0,"private_receipent":null,"readBy":null,"deletedBy":null,"created_at":"2019-04-05 23:26:53","updated_at":"2019-04-05 23:26:53","deleted_at":null}}', '2019-04-05 23:26:53', '2019-04-05 23:26:53');
INSERT INTO `activity_log` (`id`, `log_name`, `description`, `subject_id`, `subject_type`, `causer_id`, `causer_type`, `properties`, `created_at`, `updated_at`) VALUES
(202, 'default', 'updated', 34, 'App\\Models\\Message', 66, 'App\\User', '{"attributes":{"id":34,"subject":"Testing","message":"<p>Hi Nishant,<\\/p><p>This one is a <strong>test message.&nbsp;<\\/strong> Please see if its fine.<\\/p><p>Regards,<\\/p><p>Aakash<\\/p>","user_id":66,"intended_model_type":"Admin","intended_model_subtype":"SiteAdmin","intended_model_id":"0","is_private":0,"private_receipent":null,"readBy":",66","deletedBy":null,"is_draft":0,"created_at":"2019-04-05 23:26:53","updated_at":"2019-04-06 00:26:28","deleted_at":null},"old":{"id":34,"subject":"Testing","message":"<p>Hi Nishant,<\\/p><p>This one is a <strong>test message.&nbsp;<\\/strong> Please see if its fine.<\\/p><p>Regards,<\\/p><p>Aakash<\\/p>","user_id":66,"intended_model_type":"Admin","intended_model_subtype":"SiteAdmin","intended_model_id":"0","is_private":0,"private_receipent":null,"readBy":null,"deletedBy":null,"is_draft":0,"created_at":"2019-04-05 23:26:53","updated_at":"2019-04-05 23:26:53","deleted_at":null}}', '2019-04-06 00:26:28', '2019-04-06 00:26:28'),
(203, 'default', 'updated', 17, 'App\\Models\\MessageCounter', 66, 'App\\User', '{"attributes":{"id":17,"unread":-2,"read":2,"total":0,"user_id":66,"created_at":"2019-03-18 00:20:14","updated_at":"2019-04-06 00:26:28","deleted_at":null},"old":{"id":17,"unread":-1,"read":1,"total":0,"user_id":66,"created_at":"2019-03-18 00:20:14","updated_at":"2019-04-05 23:24:45","deleted_at":null}}', '2019-04-06 00:26:28', '2019-04-06 00:26:28'),
(204, 'default', 'updated', 34, 'App\\Models\\Message', 66, 'App\\User', '{"attributes":{"id":34,"subject":"Testing","message":"<p>Hi Nishant,<\\/p><p>This one is a <strong>test message.&nbsp;<\\/strong> Please see if its fine.<\\/p><p>Regards,<\\/p><p>Aakash<\\/p>","user_id":66,"intended_model_type":"Admin","intended_model_subtype":"SiteAdmin","intended_model_id":"0","is_private":0,"private_receipent":null,"readBy":",66","deletedBy":",66","is_draft":0,"created_at":"2019-04-05 23:26:53","updated_at":"2019-04-06 00:30:50","deleted_at":null},"old":{"id":34,"subject":"Testing","message":"<p>Hi Nishant,<\\/p><p>This one is a <strong>test message.&nbsp;<\\/strong> Please see if its fine.<\\/p><p>Regards,<\\/p><p>Aakash<\\/p>","user_id":66,"intended_model_type":"Admin","intended_model_subtype":"SiteAdmin","intended_model_id":"0","is_private":0,"private_receipent":null,"readBy":",66","deletedBy":null,"is_draft":0,"created_at":"2019-04-05 23:26:53","updated_at":"2019-04-06 00:26:28","deleted_at":null}}', '2019-04-06 00:30:50', '2019-04-06 00:30:50'),
(205, 'default', 'updated', 34, 'App\\Models\\Message', 66, 'App\\User', '{"attributes":{"id":34,"subject":"Testing","message":"<p>Hi Nishant,<\\/p><p>This one is a <strong>test message.&nbsp;<\\/strong> Please see if its fine.<\\/p><p>Regards,<\\/p><p>Aakash<\\/p>","user_id":66,"intended_model_type":"Admin","intended_model_subtype":"SiteAdmin","intended_model_id":"0","is_private":0,"private_receipent":null,"readBy":",66","deletedBy":",66","is_draft":0,"created_at":"2019-04-05 23:26:53","updated_at":"2019-04-06 00:49:50","deleted_at":null},"old":{"id":34,"subject":"Testing","message":"<p>Hi Nishant,<\\/p><p>This one is a <strong>test message.&nbsp;<\\/strong> Please see if its fine.<\\/p><p>Regards,<\\/p><p>Aakash<\\/p>","user_id":66,"intended_model_type":"Admin","intended_model_subtype":"SiteAdmin","intended_model_id":"0","is_private":0,"private_receipent":null,"readBy":",66","deletedBy":null,"is_draft":0,"created_at":"2019-04-05 23:26:53","updated_at":"2019-04-06 00:30:50","deleted_at":null}}', '2019-04-06 00:49:50', '2019-04-06 00:49:50'),
(206, 'default', 'updated', 31, 'App\\Models\\Message', 66, 'App\\User', '{"attributes":{"id":31,"subject":"Hello","message":"<p>Hello<\\/p><p><br><\\/p>","user_id":1,"intended_model_type":"Admin","intended_model_subtype":"Superadmin","intended_model_id":"0","is_private":0,"private_receipent":null,"readBy":",1","deletedBy":",66","is_draft":0,"created_at":"2019-04-02 15:36:43","updated_at":"2019-04-06 01:25:19","deleted_at":null},"old":{"id":31,"subject":"Hello","message":"<p>Hello<\\/p><p><br><\\/p>","user_id":1,"intended_model_type":"Admin","intended_model_subtype":"Superadmin","intended_model_id":"0","is_private":0,"private_receipent":null,"readBy":",1","deletedBy":null,"is_draft":0,"created_at":"2019-04-02 15:36:43","updated_at":"2019-04-04 05:06:57","deleted_at":null}}', '2019-04-06 01:25:19', '2019-04-06 01:25:19'),
(207, 'default', 'updated', 33, 'App\\Models\\Message', 66, 'App\\User', '{"attributes":{"id":33,"subject":"Test","message":"<p>Test<\\/p>","user_id":1,"intended_model_type":"Organization","intended_model_subtype":"Teacher","intended_model_id":"1","is_private":0,"private_receipent":null,"readBy":null,"deletedBy":",66","is_draft":0,"created_at":"2019-04-02 15:40:37","updated_at":"2019-04-06 01:26:09","deleted_at":null},"old":{"id":33,"subject":"Test","message":"<p>Test<\\/p>","user_id":1,"intended_model_type":"Organization","intended_model_subtype":"Teacher","intended_model_id":"1","is_private":0,"private_receipent":null,"readBy":null,"deletedBy":null,"is_draft":0,"created_at":"2019-04-02 15:40:37","updated_at":"2019-04-02 15:40:37","deleted_at":null}}', '2019-04-06 01:26:09', '2019-04-06 01:26:09'),
(208, 'default', 'updated', 30, 'App\\Models\\Message', 66, 'App\\User', '{"attributes":{"id":30,"subject":"New Message","message":"<p>My new Message<\\/p>","user_id":1,"intended_model_type":"Organization","intended_model_subtype":"Admin","intended_model_id":"3","is_private":0,"private_receipent":null,"readBy":",66","deletedBy":null,"is_draft":0,"created_at":"2019-04-02 14:37:44","updated_at":"2019-04-06 01:30:08","deleted_at":null},"old":{"id":30,"subject":"New Message","message":"<p>My new Message<\\/p>","user_id":1,"intended_model_type":"Organization","intended_model_subtype":"Admin","intended_model_id":"3","is_private":0,"private_receipent":null,"readBy":null,"deletedBy":null,"is_draft":0,"created_at":"2019-04-02 14:37:44","updated_at":"2019-04-02 14:37:44","deleted_at":null}}', '2019-04-06 01:30:08', '2019-04-06 01:30:08'),
(209, 'default', 'updated', 17, 'App\\Models\\MessageCounter', 66, 'App\\User', '{"attributes":{"id":17,"unread":-3,"read":3,"total":0,"user_id":66,"created_at":"2019-03-18 00:20:14","updated_at":"2019-04-06 01:30:08","deleted_at":null},"old":{"id":17,"unread":-2,"read":2,"total":0,"user_id":66,"created_at":"2019-03-18 00:20:14","updated_at":"2019-04-06 00:26:28","deleted_at":null}}', '2019-04-06 01:30:08', '2019-04-06 01:30:08'),
(210, 'default', 'updated', 30, 'App\\Models\\Message', 66, 'App\\User', '{"attributes":{"id":30,"subject":"New Message","message":"<p>My new Message<\\/p>","user_id":1,"intended_model_type":"Organization","intended_model_subtype":"Admin","intended_model_id":"3","is_private":0,"private_receipent":null,"readBy":",66","deletedBy":",66","is_draft":0,"created_at":"2019-04-02 14:37:44","updated_at":"2019-04-06 01:30:11","deleted_at":null},"old":{"id":30,"subject":"New Message","message":"<p>My new Message<\\/p>","user_id":1,"intended_model_type":"Organization","intended_model_subtype":"Admin","intended_model_id":"3","is_private":0,"private_receipent":null,"readBy":",66","deletedBy":null,"is_draft":0,"created_at":"2019-04-02 14:37:44","updated_at":"2019-04-06 01:30:08","deleted_at":null}}', '2019-04-06 01:30:11', '2019-04-06 01:30:11'),
(211, 'default', 'updated', 32, 'App\\Models\\Message', 66, 'App\\User', '{"attributes":{"id":32,"subject":"Motilal Nehru Public School","message":"<p>Hello<\\/p>","user_id":1,"intended_model_type":"Admin","intended_model_subtype":"SiteAdmin","intended_model_id":"0","is_private":0,"private_receipent":null,"readBy":",66","deletedBy":",66","is_draft":0,"created_at":"2019-04-02 15:38:17","updated_at":"2019-04-06 01:30:18","deleted_at":null},"old":{"id":32,"subject":"Motilal Nehru Public School","message":"<p>Hello<\\/p>","user_id":1,"intended_model_type":"Admin","intended_model_subtype":"SiteAdmin","intended_model_id":"0","is_private":0,"private_receipent":null,"readBy":",66","deletedBy":null,"is_draft":0,"created_at":"2019-04-02 15:38:17","updated_at":"2019-04-05 23:24:45","deleted_at":null}}', '2019-04-06 01:30:18', '2019-04-06 01:30:18'),
(212, 'default', 'created', 35, 'App\\Models\\Message', 66, 'App\\User', '{"attributes":{"id":35,"subject":"Greetings","message":"<p>Hi Students,<\\/p><p>&nbsp;Welcome to our organization.<\\/p><p>Regards,<\\/p><p>Aakash<\\/p>","user_id":66,"intended_model_type":"Organization","intended_model_subtype":"Student","intended_model_id":"19","is_private":0,"private_receipent":null,"readBy":null,"deletedBy":null,"is_draft":0,"created_at":"2019-04-06 01:40:43","updated_at":"2019-04-06 01:40:43","deleted_at":null}}', '2019-04-06 01:40:43', '2019-04-06 01:40:43'),
(213, 'default', 'updated', 22, 'App\\Models\\MessageCounter', 66, 'App\\User', '{"attributes":{"id":22,"unread":1,"read":0,"total":1,"user_id":82,"created_at":"2019-04-02 13:12:07","updated_at":"2019-04-06 01:40:43","deleted_at":null},"old":{"id":22,"unread":0,"read":0,"total":0,"user_id":82,"created_at":"2019-04-02 13:12:07","updated_at":"2019-04-02 13:12:07","deleted_at":null}}', '2019-04-06 01:40:43', '2019-04-06 01:40:43'),
(214, 'default', 'updated', 21, 'App\\Models\\MessageCounter', 66, 'App\\User', '{"attributes":{"id":21,"unread":1,"read":0,"total":1,"user_id":81,"created_at":"2019-04-02 13:09:53","updated_at":"2019-04-06 01:40:43","deleted_at":null},"old":{"id":21,"unread":0,"read":0,"total":0,"user_id":81,"created_at":"2019-04-02 13:09:53","updated_at":"2019-04-02 13:09:53","deleted_at":null}}', '2019-04-06 01:40:43', '2019-04-06 01:40:43'),
(215, 'default', 'updated', 34, 'App\\Models\\Message', 66, 'App\\User', '{"attributes":{"id":34,"subject":"Testing","message":"<p>Hi Nishant,<\\/p><p>This one is a <strong>test message.&nbsp;<\\/strong> Please see if its fine.<\\/p><p>Regards,<\\/p><p>Aakash<\\/p>","user_id":66,"intended_model_type":"Admin","intended_model_subtype":"SiteAdmin","intended_model_id":"0","is_private":0,"private_receipent":null,"readBy":",66","deletedBy":",66","is_draft":0,"created_at":"2019-04-05 23:26:53","updated_at":"2019-04-07 09:26:37","deleted_at":null},"old":{"id":34,"subject":"Testing","message":"<p>Hi Nishant,<\\/p><p>This one is a <strong>test message.&nbsp;<\\/strong> Please see if its fine.<\\/p><p>Regards,<\\/p><p>Aakash<\\/p>","user_id":66,"intended_model_type":"Admin","intended_model_subtype":"SiteAdmin","intended_model_id":"0","is_private":0,"private_receipent":null,"readBy":",66","deletedBy":null,"is_draft":0,"created_at":"2019-04-05 23:26:53","updated_at":"2019-04-06 00:49:50","deleted_at":null}}', '2019-04-07 09:26:37', '2019-04-07 09:26:37'),
(216, 'default', 'updated', 32, 'App\\Models\\Message', 66, 'App\\User', '{"attributes":{"id":32,"subject":"Motilal Nehru Public School","message":"<p>Hello<\\/p>","user_id":1,"intended_model_type":"Admin","intended_model_subtype":"SiteAdmin","intended_model_id":"0","is_private":0,"private_receipent":null,"readBy":",66","deletedBy":null,"is_draft":0,"created_at":"2019-04-02 15:38:17","updated_at":"2019-04-07 09:54:08","deleted_at":null},"old":{"id":32,"subject":"Motilal Nehru Public School","message":"<p>Hello<\\/p>","user_id":1,"intended_model_type":"Admin","intended_model_subtype":"SiteAdmin","intended_model_id":"0","is_private":0,"private_receipent":null,"readBy":null,"deletedBy":null,"is_draft":0,"created_at":"2019-04-02 15:38:17","updated_at":"2019-04-06 01:30:18","deleted_at":null}}', '2019-04-07 09:54:08', '2019-04-07 09:54:08'),
(217, 'default', 'updated', 17, 'App\\Models\\MessageCounter', 66, 'App\\User', '{"attributes":{"id":17,"unread":-4,"read":4,"total":0,"user_id":66,"created_at":"2019-03-18 00:20:14","updated_at":"2019-04-07 09:54:08","deleted_at":null},"old":{"id":17,"unread":-3,"read":3,"total":0,"user_id":66,"created_at":"2019-03-18 00:20:14","updated_at":"2019-04-06 01:30:08","deleted_at":null}}', '2019-04-07 09:54:08', '2019-04-07 09:54:08'),
(218, 'default', 'created', 36, 'App\\Models\\Message', 66, 'App\\User', '{"attributes":{"id":36,"subject":"For teachers","message":"<p>Hi,<\\/p><p><br><\\/p><p>Testing teachers.<\\/p><p>Regards<\\/p>","user_id":66,"intended_model_type":"Organization","intended_model_subtype":"Teacher","intended_model_id":"19","is_private":0,"private_receipent":null,"readBy":null,"deletedBy":null,"is_draft":0,"created_at":"2019-04-07 09:55:20","updated_at":"2019-04-07 09:55:20","deleted_at":null}}', '2019-04-07 09:55:20', '2019-04-07 09:55:20'),
(219, 'default', 'updated', 23, 'App\\Models\\MessageCounter', 66, 'App\\User', '{"attributes":{"id":23,"unread":1,"read":0,"total":1,"user_id":83,"created_at":"2019-04-02 13:13:50","updated_at":"2019-04-07 09:55:20","deleted_at":null},"old":{"id":23,"unread":0,"read":0,"total":0,"user_id":83,"created_at":"2019-04-02 13:13:50","updated_at":"2019-04-02 13:13:50","deleted_at":null}}', '2019-04-07 09:55:20', '2019-04-07 09:55:20'),
(220, 'default', 'updated', 24, 'App\\Models\\MessageCounter', 66, 'App\\User', '{"attributes":{"id":24,"unread":1,"read":0,"total":1,"user_id":84,"created_at":"2019-04-02 13:15:26","updated_at":"2019-04-07 09:55:20","deleted_at":null},"old":{"id":24,"unread":0,"read":0,"total":0,"user_id":84,"created_at":"2019-04-02 13:15:26","updated_at":"2019-04-02 13:15:26","deleted_at":null}}', '2019-04-07 09:55:20', '2019-04-07 09:55:20'),
(221, 'default', 'created', 26, 'App\\Models\\Exam', 1, 'App\\User', '{"attributes":{"id":26,"name":"New Test Exam","start_date_time":"2019-04-20 11:18:16","end_date_time":"2019-04-26 11:18:25","exam_head":71,"total_marks":100,"is_confirmed":1,"is_over":0,"is_started":0,"is_upcoming":1,"result_announced":0,"grade_id":2,"for_all_classroom":0,"subgrade_id":4,"subject_id":19,"topic_id":null,"selected_set":null,"created_at":"2019-04-07 11:18:34","updated_at":"2019-04-07 11:18:34","deleted_at":null}}', '2019-04-07 11:18:34', '2019-04-07 11:18:34'),
(222, 'default', 'created', 17, 'App\\Models\\ExamOrganizer', 1, 'App\\User', '[]', '2019-04-07 11:20:04', '2019-04-07 11:20:04'),
(223, 'default', 'created', 22, 'App\\Models\\QuestionSet', 1, 'App\\User', '{"attributes":{"id":22,"name":"Set 1","is_submited":0,"is_selected":0,"user_id":1,"exam_id":26,"created_at":"2019-04-07 11:20:12","updated_at":"2019-04-07 11:20:12","deleted_at":null}}', '2019-04-07 11:20:12', '2019-04-07 11:20:12'),
(224, 'default', 'created', 23, 'App\\Models\\QuestionSet', 71, 'App\\User', '{"attributes":{"id":23,"name":"abcd","is_submited":0,"is_selected":0,"user_id":71,"exam_id":26,"created_at":"2019-04-07 11:25:09","updated_at":"2019-04-07 11:25:09","deleted_at":null}}', '2019-04-07 11:25:09', '2019-04-07 11:25:09'),
(225, 'default', 'created', 8, 'App\\Models\\Grade', 66, 'App\\User', '{"attributes":{"id":8,"name":"Test Grade","program_id":27,"stream_room":"962078","created_at":"2019-04-07 12:03:11","updated_at":"2019-04-07 12:03:11","deleted_at":null}}', '2019-04-07 12:03:11', '2019-04-07 12:03:11'),
(226, 'default', 'deleted', 8, 'App\\Models\\Grade', 66, 'App\\User', '{"attributes":{"id":8,"name":"Test Grade","program_id":27,"stream_room":"962078","created_at":"2019-04-07 12:03:11","updated_at":"2019-04-07 12:43:09","deleted_at":"2019-04-07 12:43:09"}}', '2019-04-07 12:43:09', '2019-04-07 12:43:09'),
(227, 'default', 'created', 9, 'App\\Models\\Grade', 66, 'App\\User', '{"attributes":{"id":9,"name":"Test 1","program_id":27,"stream_room":"957318","created_at":"2019-04-07 12:43:28","updated_at":"2019-04-07 12:43:28","deleted_at":null}}', '2019-04-07 12:43:28', '2019-04-07 12:43:28'),
(228, 'default', 'updated', 9, 'App\\Models\\Grade', 66, 'App\\User', '{"attributes":{"id":9,"name":"test2","program_id":27,"stream_room":"957318","created_at":"2019-04-07 12:43:28","updated_at":"2019-04-07 13:13:38","deleted_at":null},"old":{"id":9,"name":"Test 1","program_id":27,"stream_room":"957318","created_at":"2019-04-07 12:43:28","updated_at":"2019-04-07 12:43:28","deleted_at":null}}', '2019-04-07 13:13:38', '2019-04-07 13:13:38'),
(229, 'default', 'updated', 9, 'App\\Models\\Grade', 66, 'App\\User', '{"attributes":{"id":9,"name":"test3","program_id":27,"stream_room":"957318","created_at":"2019-04-07 12:43:28","updated_at":"2019-04-07 13:16:29","deleted_at":null},"old":{"id":9,"name":"test2","program_id":27,"stream_room":"957318","created_at":"2019-04-07 12:43:28","updated_at":"2019-04-07 13:13:38","deleted_at":null}}', '2019-04-07 13:16:29', '2019-04-07 13:16:29'),
(230, 'default', 'created', 12, 'App\\Models\\Department', 66, 'App\\User', '{"attributes":{"id":12,"name":"t1","is_default":0,"organization_id":6,"stream_room":"541071","created_at":"2019-04-07 13:17:10","updated_at":"2019-04-07 13:17:10","deleted_at":null}}', '2019-04-07 13:17:10', '2019-04-07 13:17:10'),
(231, 'default', 'created', 28, 'App\\Models\\Program', 66, 'App\\User', '{"attributes":{"id":28,"name":"t1 program","department_id":12,"stream_room":"282888","is_default":1,"created_at":"2019-04-07 13:17:10","updated_at":"2019-04-07 13:17:10","deleted_at":null}}', '2019-04-07 13:17:10', '2019-04-07 13:17:10'),
(232, 'default', 'deleted', 12, 'App\\Models\\Department', 66, 'App\\User', '{"attributes":{"id":12,"name":"t1","is_default":0,"organization_id":6,"stream_room":"541071","created_at":"2019-04-07 13:17:10","updated_at":"2019-04-07 13:17:15","deleted_at":"2019-04-07 13:17:15"}}', '2019-04-07 13:17:15', '2019-04-07 13:17:15'),
(233, 'default', 'created', 13, 'App\\Models\\Department', 66, 'App\\User', '{"attributes":{"id":13,"name":"t1","is_default":0,"organization_id":6,"stream_room":"282962","created_at":"2019-04-07 13:17:20","updated_at":"2019-04-07 13:17:20","deleted_at":null}}', '2019-04-07 13:17:20', '2019-04-07 13:17:20'),
(234, 'default', 'created', 29, 'App\\Models\\Program', 66, 'App\\User', '{"attributes":{"id":29,"name":"t1 program","department_id":13,"stream_room":"683682","is_default":1,"created_at":"2019-04-07 13:17:20","updated_at":"2019-04-07 13:17:20","deleted_at":null}}', '2019-04-07 13:17:20', '2019-04-07 13:17:20'),
(235, 'default', 'deleted', 17, 'App\\Models\\ExamOrganizer', 1, 'App\\User', '[]', '2019-04-07 16:22:29', '2019-04-07 16:22:29'),
(236, 'default', 'created', 18, 'App\\Models\\ExamOrganizer', 1, 'App\\User', '[]', '2019-04-07 16:23:44', '2019-04-07 16:23:44'),
(237, 'default', 'deleted', 18, 'App\\Models\\ExamOrganizer', 1, 'App\\User', '[]', '2019-04-07 16:32:44', '2019-04-07 16:32:44'),
(238, 'default', 'created', 19, 'App\\Models\\ExamOrganizer', 1, 'App\\User', '[]', '2019-04-07 16:33:20', '2019-04-07 16:33:20'),
(239, 'default', 'updated', 23, 'App\\Models\\QuestionSet', 71, 'App\\User', '{"attributes":{"id":23,"name":"abcd","is_submited":1,"is_selected":0,"user_id":71,"exam_id":26,"created_at":"2019-04-07 11:25:09","updated_at":"2019-04-07 17:15:43","deleted_at":null},"old":{"id":23,"name":"abcd","is_submited":0,"is_selected":0,"user_id":71,"exam_id":26,"created_at":"2019-04-07 11:25:09","updated_at":"2019-04-07 11:25:09","deleted_at":null}}', '2019-04-07 17:15:43', '2019-04-07 17:15:43'),
(240, 'default', 'created', 24, 'App\\Models\\QuestionSet', 71, 'App\\User', '{"attributes":{"id":24,"name":"efgh","is_submited":0,"is_selected":0,"user_id":71,"exam_id":26,"created_at":"2019-04-07 17:19:54","updated_at":"2019-04-07 17:19:54","deleted_at":null}}', '2019-04-07 17:19:54', '2019-04-07 17:19:54'),
(241, 'default', 'created', 25, 'App\\Models\\QuestionSet', 71, 'App\\User', '{"attributes":{"id":25,"name":"ijkl","is_submited":0,"is_selected":0,"user_id":71,"exam_id":26,"created_at":"2019-04-07 17:20:02","updated_at":"2019-04-07 17:20:02","deleted_at":null}}', '2019-04-07 17:20:02', '2019-04-07 17:20:02'),
(242, 'default', 'created', 26, 'App\\Models\\QuestionSet', 71, 'App\\User', '{"attributes":{"id":26,"name":"mnop","is_submited":0,"is_selected":0,"user_id":71,"exam_id":26,"created_at":"2019-04-07 17:20:07","updated_at":"2019-04-07 17:20:07","deleted_at":null}}', '2019-04-07 17:20:07', '2019-04-07 17:20:07'),
(243, 'default', 'created', 27, 'App\\Models\\QuestionSet', 71, 'App\\User', '{"attributes":{"id":27,"name":"qrst","is_submited":0,"is_selected":0,"user_id":71,"exam_id":26,"created_at":"2019-04-07 17:20:12","updated_at":"2019-04-07 17:20:12","deleted_at":null}}', '2019-04-07 17:20:12', '2019-04-07 17:20:12'),
(244, 'default', 'created', 17, 'App\\Models\\QuestionGroup', 71, 'App\\User', '[]', '2019-04-07 17:38:00', '2019-04-07 17:38:00'),
(245, 'default', 'created', 18, 'App\\Models\\QuestionGroup', 71, 'App\\User', '[]', '2019-04-07 19:59:46', '2019-04-07 19:59:46'),
(246, 'default', 'created', 32, 'App\\Models\\Question', 71, 'App\\User', '{"attributes":{"id":32,"heading":"<p>erferferf<\\/p>","type":"boolean","marks":34,"answer":"1","question_group_id":18,"created_at":"2019-04-07 20:03:54","updated_at":"2019-04-07 20:03:54","deleted_at":null}}', '2019-04-07 20:03:54', '2019-04-07 20:03:54'),
(247, 'default', 'created', 33, 'App\\Models\\Question', 71, 'App\\User', '{"attributes":{"id":33,"heading":"<p>Hello _______?<\\/p>","type":"fill","marks":34,"answer":"World","question_group_id":18,"created_at":"2019-04-07 20:04:40","updated_at":"2019-04-07 20:04:40","deleted_at":null}}', '2019-04-07 20:04:40', '2019-04-07 20:04:40'),
(248, 'default', 'updated', 13, 'App\\Models\\Department', 66, 'App\\User', '{"attributes":{"id":13,"name":"t2","is_default":0,"organization_id":6,"stream_room":"282962","created_at":"2019-04-07 13:17:20","updated_at":"2019-04-07 22:38:43","deleted_at":null},"old":{"id":13,"name":"t1","is_default":0,"organization_id":6,"stream_room":"282962","created_at":"2019-04-07 13:17:20","updated_at":"2019-04-07 13:17:20","deleted_at":null}}', '2019-04-07 22:38:43', '2019-04-07 22:38:43'),
(249, 'default', 'created', 30, 'App\\Models\\Program', 66, 'App\\User', '{"attributes":{"id":30,"name":"P1","department_id":13,"stream_room":"548265","is_default":0,"created_at":"2019-04-07 23:06:50","updated_at":"2019-04-07 23:06:50","deleted_at":null}}', '2019-04-07 23:06:50', '2019-04-07 23:06:50'),
(250, 'default', 'updated', 30, 'App\\Models\\Program', 66, 'App\\User', '{"attributes":{"id":30,"name":"P2","department_id":13,"stream_room":"548265","is_default":0,"created_at":"2019-04-07 23:06:50","updated_at":"2019-04-07 23:56:42","deleted_at":null},"old":{"id":30,"name":"P1","department_id":13,"stream_room":"548265","is_default":0,"created_at":"2019-04-07 23:06:50","updated_at":"2019-04-07 23:06:50","deleted_at":null}}', '2019-04-07 23:56:42', '2019-04-07 23:56:42'),
(251, 'default', 'created', 10, 'App\\Models\\Grade', 66, 'App\\User', '{"attributes":{"id":10,"name":"Grade 1","program_id":30,"stream_room":"183488","created_at":"2019-04-07 23:57:00","updated_at":"2019-04-07 23:57:00","deleted_at":null}}', '2019-04-07 23:57:00', '2019-04-07 23:57:00'),
(252, 'default', 'updated', 10, 'App\\Models\\Grade', 66, 'App\\User', '{"attributes":{"id":10,"name":"Grade 2","program_id":30,"stream_room":"183488","created_at":"2019-04-07 23:57:00","updated_at":"2019-04-07 23:57:07","deleted_at":null},"old":{"id":10,"name":"Grade 1","program_id":30,"stream_room":"183488","created_at":"2019-04-07 23:57:00","updated_at":"2019-04-07 23:57:00","deleted_at":null}}', '2019-04-07 23:57:07', '2019-04-07 23:57:07'),
(253, 'default', 'updated', 10, 'App\\Models\\Grade', 66, 'App\\User', '{"attributes":{"id":10,"name":"Grade 3","program_id":30,"stream_room":"183488","created_at":"2019-04-07 23:57:00","updated_at":"2019-04-08 00:00:36","deleted_at":null},"old":{"id":10,"name":"Grade 2","program_id":30,"stream_room":"183488","created_at":"2019-04-07 23:57:00","updated_at":"2019-04-07 23:57:07","deleted_at":null}}', '2019-04-08 00:00:36', '2019-04-08 00:00:36'),
(254, 'default', 'updated', 1, 'App\\Models\\Grade', 66, 'App\\User', '{"attributes":{"id":1,"name":"Grade 2","program_id":21,"stream_room":"333544","created_at":"2019-03-18 19:03:37","updated_at":"2019-04-08 00:06:08","deleted_at":null},"old":{"id":1,"name":"Grade 1","program_id":21,"stream_room":"333544","created_at":"2019-03-18 19:03:37","updated_at":"2019-03-18 19:03:37","deleted_at":null}}', '2019-04-08 00:06:08', '2019-04-08 00:06:08'),
(255, 'default', 'updated', 1, 'App\\Models\\Grade', 66, 'App\\User', '{"attributes":{"id":1,"name":"Grade 1","program_id":21,"stream_room":"333544","created_at":"2019-03-18 19:03:37","updated_at":"2019-04-08 00:06:26","deleted_at":null},"old":{"id":1,"name":"Grade 2","program_id":21,"stream_room":"333544","created_at":"2019-03-18 19:03:37","updated_at":"2019-04-08 00:06:08","deleted_at":null}}', '2019-04-08 00:06:26', '2019-04-08 00:06:26'),
(256, 'default', 'created', 34, 'App\\Models\\Question', 71, 'App\\User', '{"attributes":{"id":34,"heading":"<p>Who is the prime minister of India?<\\/p>","type":"fill","marks":20,"answer":"Narendra Modi","question_group_id":18,"created_at":"2019-04-09 00:51:32","updated_at":"2019-04-09 00:51:32","deleted_at":null}}', '2019-04-09 00:51:32', '2019-04-09 00:51:32'),
(257, 'default', 'created', 19, 'App\\Models\\QuestionGroup', 71, 'App\\User', '[]', '2019-04-09 00:55:35', '2019-04-09 00:55:35'),
(258, 'default', 'created', 35, 'App\\Models\\Question', 71, 'App\\User', '{"attributes":{"id":35,"heading":"<p>President of India?<\\/p>","type":"fill","marks":10,"answer":"Ram Nath Kovind","question_group_id":19,"created_at":"2019-04-09 00:56:08","updated_at":"2019-04-09 00:56:08","deleted_at":null}}', '2019-04-09 00:56:08', '2019-04-09 00:56:08'),
(259, 'default', 'created', 20, 'App\\Models\\QuestionGroup', 71, 'App\\User', '[]', '2019-04-09 00:57:00', '2019-04-09 00:57:00'),
(260, 'default', 'created', 21, 'App\\Models\\QuestionGroup', 71, 'App\\User', '[]', '2019-04-09 00:59:11', '2019-04-09 00:59:11'),
(261, 'default', 'created', 22, 'App\\Models\\QuestionGroup', 71, 'App\\User', '[]', '2019-04-09 01:00:36', '2019-04-09 01:00:36'),
(262, 'default', 'created', 23, 'App\\Models\\QuestionGroup', 71, 'App\\User', '[]', '2019-04-09 01:10:51', '2019-04-09 01:10:51'),
(263, 'default', 'created', 36, 'App\\Models\\Question', 71, 'App\\User', '{"attributes":{"id":36,"heading":"<p>Capital of India is?<\\/p>","type":"radio","marks":20,"answer":"2","question_group_id":19,"created_at":"2019-04-09 13:45:26","updated_at":"2019-04-09 13:45:26","deleted_at":null}}', '2019-04-09 13:45:26', '2019-04-09 13:45:26'),
(264, 'default', 'created', 13, 'App\\Models\\Option', 71, 'App\\User', '{"attributes":{"id":13,"first":"Mumbai","second":"New Delhi","third":"Kolkata","fourth":"Chennai","right_answer":null,"question_id":36,"created_at":"2019-04-09 13:45:26","updated_at":"2019-04-09 13:45:26","deleted_at":null}}', '2019-04-09 13:45:26', '2019-04-09 13:45:26'),
(265, 'default', 'updated', 27, 'App\\Models\\QuestionSet', 71, 'App\\User', '{"attributes":{"id":27,"name":"qrst","is_submited":1,"is_selected":0,"user_id":71,"exam_id":26,"created_at":"2019-04-07 17:20:12","updated_at":"2019-04-10 17:37:52","deleted_at":null},"old":{"id":27,"name":"qrst","is_submited":0,"is_selected":0,"user_id":71,"exam_id":26,"created_at":"2019-04-07 17:20:12","updated_at":"2019-04-07 17:20:12","deleted_at":null}}', '2019-04-10 17:37:52', '2019-04-10 17:37:52'),
(266, 'default', 'updated', 35, 'App\\Models\\Message', 81, 'App\\User', '{"attributes":{"id":35,"subject":"Greetings","message":"<p>Hi Students,<\\/p><p>&nbsp;Welcome to our organization.<\\/p><p>Regards,<\\/p><p>Aakash<\\/p>","user_id":66,"intended_model_type":"Organization","intended_model_subtype":"Student","intended_model_id":"19","is_private":0,"private_receipent":null,"readBy":null,"deletedBy":",81","is_draft":0,"created_at":"2019-04-06 01:40:43","updated_at":"2019-04-11 00:45:42","deleted_at":null},"old":{"id":35,"subject":"Greetings","message":"<p>Hi Students,<\\/p><p>&nbsp;Welcome to our organization.<\\/p><p>Regards,<\\/p><p>Aakash<\\/p>","user_id":66,"intended_model_type":"Organization","intended_model_subtype":"Student","intended_model_id":"19","is_private":0,"private_receipent":null,"readBy":null,"deletedBy":null,"is_draft":0,"created_at":"2019-04-06 01:40:43","updated_at":"2019-04-06 01:40:43","deleted_at":null}}', '2019-04-11 00:45:42', '2019-04-11 00:45:42'),
(267, 'default', 'created', 5, 'App\\Models\\ClassroomAssignedUser', 1, 'App\\User', '{"attributes":{"id":5,"subgrade_id":4,"user_id":81,"is_enabled":1,"is_teacher":0,"created_at":"2019-04-11 00:54:41","updated_at":"2019-04-11 00:54:41","deleted_at":null}}', '2019-04-11 00:54:41', '2019-04-11 00:54:41'),
(268, 'default', 'updated', 26, 'App\\Models\\QuestionSet', 71, 'App\\User', '{"attributes":{"id":26,"name":"mnop","is_submited":1,"is_selected":0,"user_id":71,"exam_id":26,"created_at":"2019-04-07 17:20:07","updated_at":"2019-04-11 00:55:31","deleted_at":null},"old":{"id":26,"name":"mnop","is_submited":0,"is_selected":0,"user_id":71,"exam_id":26,"created_at":"2019-04-07 17:20:07","updated_at":"2019-04-07 17:20:07","deleted_at":null}}', '2019-04-11 00:55:31', '2019-04-11 00:55:31'),
(269, 'default', 'updated', 26, 'App\\Models\\Exam', 70, 'App\\User', '{"attributes":{"id":26,"name":"New Test Exam","start_date_time":"2019-04-20 11:18:16","end_date_time":"2019-04-26 11:18:25","exam_head":71,"total_marks":100,"is_confirmed":1,"is_over":0,"is_started":0,"is_upcoming":1,"result_announced":0,"grade_id":2,"for_all_classroom":0,"subgrade_id":4,"subject_id":19,"topic_id":null,"selected_set":26,"created_at":"2019-04-07 11:18:34","updated_at":"2019-04-11 00:56:07","deleted_at":null},"old":{"id":26,"name":"New Test Exam","start_date_time":"2019-04-20 11:18:16","end_date_time":"2019-04-26 11:18:25","exam_head":71,"total_marks":100,"is_confirmed":1,"is_over":0,"is_started":0,"is_upcoming":1,"result_announced":0,"grade_id":2,"for_all_classroom":0,"subgrade_id":4,"subject_id":19,"topic_id":null,"selected_set":null,"created_at":"2019-04-07 11:18:34","updated_at":"2019-04-07 11:18:34","deleted_at":null}}', '2019-04-11 00:56:07', '2019-04-11 00:56:07'),
(270, 'default', 'updated', 26, 'App\\Models\\QuestionSet', 70, 'App\\User', '{"attributes":{"id":26,"name":"mnop","is_submited":1,"is_selected":1,"user_id":71,"exam_id":26,"created_at":"2019-04-07 17:20:07","updated_at":"2019-04-11 00:56:07","deleted_at":null},"old":{"id":26,"name":"mnop","is_submited":1,"is_selected":0,"user_id":71,"exam_id":26,"created_at":"2019-04-07 17:20:07","updated_at":"2019-04-11 00:55:31","deleted_at":null}}', '2019-04-11 00:56:07', '2019-04-11 00:56:07'),
(271, 'default', 'created', 22, 'App\\Models\\ExamAppearance', 81, 'App\\User', '[]', '2019-04-11 00:57:33', '2019-04-11 00:57:33'),
(272, 'default', 'created', 9, 'App\\Models\\StudentAnswer', 81, 'App\\User', '[]', '2019-04-12 20:45:23', '2019-04-12 20:45:23'),
(273, 'default', 'created', 10, 'App\\Models\\StudentAnswer', 81, 'App\\User', '[]', '2019-04-12 20:47:01', '2019-04-12 20:47:01'),
(274, 'default', 'created', 11, 'App\\Models\\StudentAnswer', 81, 'App\\User', '[]', '2019-04-12 20:47:54', '2019-04-12 20:47:54'),
(275, 'default', 'created', 12, 'App\\Models\\StudentAnswer', 81, 'App\\User', '[]', '2019-04-12 20:48:44', '2019-04-12 20:48:44'),
(276, 'default', 'created', 13, 'App\\Models\\StudentAnswer', 81, 'App\\User', '[]', '2019-04-12 20:50:40', '2019-04-12 20:50:40'),
(277, 'default', 'created', 14, 'App\\Models\\StudentAnswer', 81, 'App\\User', '[]', '2019-04-12 20:50:47', '2019-04-12 20:50:47'),
(278, 'default', 'created', 15, 'App\\Models\\StudentAnswer', 81, 'App\\User', '[]', '2019-04-12 20:50:50', '2019-04-12 20:50:50'),
(279, 'default', 'created', 16, 'App\\Models\\StudentAnswer', 81, 'App\\User', '[]', '2019-04-12 20:50:55', '2019-04-12 20:50:55'),
(280, 'default', 'created', 17, 'App\\Models\\StudentAnswer', 81, 'App\\User', '[]', '2019-04-12 20:51:58', '2019-04-12 20:51:58'),
(281, 'default', 'created', 18, 'App\\Models\\StudentAnswer', 81, 'App\\User', '[]', '2019-04-12 20:52:04', '2019-04-12 20:52:04'),
(282, 'default', 'created', 19, 'App\\Models\\StudentAnswer', 81, 'App\\User', '[]', '2019-04-12 20:52:06', '2019-04-12 20:52:06'),
(283, 'default', 'created', 20, 'App\\Models\\StudentAnswer', 81, 'App\\User', '[]', '2019-04-12 20:52:16', '2019-04-12 20:52:16'),
(284, 'default', 'created', 21, 'App\\Models\\StudentAnswer', 81, 'App\\User', '[]', '2019-04-12 20:52:24', '2019-04-12 20:52:24'),
(285, 'default', 'created', 8, 'App\\Models\\IndividualResult', 70, 'App\\User', '[]', '2019-04-12 20:54:32', '2019-04-12 20:54:32'),
(286, 'default', 'created', 3, 'App\\Models\\Result', 70, 'App\\User', '[]', '2019-04-12 20:54:32', '2019-04-12 20:54:32'),
(287, 'default', 'updated', 26, 'App\\Models\\Exam', 70, 'App\\User', '{"attributes":{"id":26,"name":"New Test Exam","start_date_time":"2019-04-10 11:18:16","end_date_time":"2019-04-11 11:18:25","exam_head":71,"total_marks":100,"is_confirmed":1,"is_over":1,"is_started":0,"is_upcoming":0,"result_announced":1,"grade_id":2,"for_all_classroom":0,"subgrade_id":4,"subject_id":19,"topic_id":null,"selected_set":26,"created_at":"2019-04-07 11:18:34","updated_at":"2019-04-12 20:54:32","deleted_at":null},"old":{"id":26,"name":"New Test Exam","start_date_time":"2019-04-10 11:18:16","end_date_time":"2019-04-11 11:18:25","exam_head":71,"total_marks":100,"is_confirmed":1,"is_over":1,"is_started":0,"is_upcoming":0,"result_announced":0,"grade_id":2,"for_all_classroom":0,"subgrade_id":4,"subject_id":19,"topic_id":null,"selected_set":26,"created_at":"2019-04-07 11:18:34","updated_at":"2019-04-11 00:56:07","deleted_at":null}}', '2019-04-12 20:54:32', '2019-04-12 20:54:32'),
(288, 'default', 'created', 27, 'App\\Models\\Exam', 1, 'App\\User', '{"attributes":{"id":27,"name":"2","start_date_time":"2019-04-21 03:46:46","end_date_time":"2019-05-05 03:47:00","exam_head":71,"total_marks":100,"is_confirmed":1,"is_over":0,"is_started":0,"is_upcoming":1,"result_announced":0,"grade_id":2,"for_all_classroom":0,"subgrade_id":4,"subject_id":19,"topic_id":null,"selected_set":null,"created_at":"2019-04-13 03:47:23","updated_at":"2019-04-13 03:47:23","deleted_at":null}}', '2019-04-13 03:47:23', '2019-04-13 03:47:23'),
(289, 'default', 'created', 20, 'App\\Models\\ExamOrganizer', 1, 'App\\User', '[]', '2019-04-13 03:48:20', '2019-04-13 03:48:20'),
(290, 'default', 'created', 28, 'App\\Models\\QuestionSet', 71, 'App\\User', '{"attributes":{"id":28,"name":"Set 1","is_submited":0,"is_selected":0,"user_id":71,"exam_id":27,"created_at":"2019-04-13 17:48:29","updated_at":"2019-04-13 17:48:29","deleted_at":null}}', '2019-04-13 17:48:29', '2019-04-13 17:48:29'),
(291, 'default', 'created', 29, 'App\\Models\\QuestionSet', 71, 'App\\User', '{"attributes":{"id":29,"name":"Set 2","is_submited":0,"is_selected":0,"user_id":71,"exam_id":27,"created_at":"2019-04-13 17:50:52","updated_at":"2019-04-13 17:50:52","deleted_at":null}}', '2019-04-13 17:50:53', '2019-04-13 17:50:53'),
(292, 'default', 'created', 30, 'App\\Models\\QuestionSet', 71, 'App\\User', '{"attributes":{"id":30,"name":"Set 3","is_submited":0,"is_selected":0,"user_id":71,"exam_id":27,"created_at":"2019-04-13 17:51:14","updated_at":"2019-04-13 17:51:14","deleted_at":null}}', '2019-04-13 17:51:14', '2019-04-13 17:51:14'),
(293, 'default', 'created', 31, 'App\\Models\\QuestionSet', 71, 'App\\User', '{"attributes":{"id":31,"name":"Set 4","is_submited":0,"is_selected":0,"user_id":71,"exam_id":27,"created_at":"2019-04-13 17:51:23","updated_at":"2019-04-13 17:51:23","deleted_at":null}}', '2019-04-13 17:51:23', '2019-04-13 17:51:23'),
(294, 'default', 'created', 24, 'App\\Models\\QuestionGroup', 71, 'App\\User', '[]', '2019-04-13 17:52:48', '2019-04-13 17:52:48'),
(295, 'default', 'created', 37, 'App\\Models\\Question', 71, 'App\\User', '{"attributes":{"id":37,"heading":"<p>Who among the following has been the Prime minister of India?<\\/p>","type":"checkbox","marks":20,"answer":"1,4","question_group_id":24,"created_at":"2019-04-13 17:55:19","updated_at":"2019-04-13 17:55:19","deleted_at":null}}', '2019-04-13 17:55:19', '2019-04-13 17:55:19'),
(296, 'default', 'created', 14, 'App\\Models\\Option', 71, 'App\\User', '{"attributes":{"id":14,"first":"Narendra Modi","second":"Pranab Mukherjee","third":"Sonia Gandhi","fourth":"Manmohan Singh","right_answer":null,"question_id":37,"created_at":"2019-04-13 17:55:19","updated_at":"2019-04-13 17:55:19","deleted_at":null}}', '2019-04-13 17:55:19', '2019-04-13 17:55:19'),
(297, 'default', 'updated', 28, 'App\\Models\\QuestionSet', 71, 'App\\User', '{"attributes":{"id":28,"name":"Set 1","is_submited":1,"is_selected":0,"user_id":71,"exam_id":27,"created_at":"2019-04-13 17:48:29","updated_at":"2019-04-13 17:56:36","deleted_at":null},"old":{"id":28,"name":"Set 1","is_submited":0,"is_selected":0,"user_id":71,"exam_id":27,"created_at":"2019-04-13 17:48:29","updated_at":"2019-04-13 17:48:29","deleted_at":null}}', '2019-04-13 17:56:36', '2019-04-13 17:56:36'),
(298, 'default', 'created', 25, 'App\\Models\\QuestionGroup', 71, 'App\\User', '[]', '2019-04-14 17:16:24', '2019-04-14 17:16:24'),
(299, 'default', 'updated', 17, 'App\\Models\\StudentAnswer', 81, 'App\\User', '[]', '2019-04-14 17:43:08', '2019-04-14 17:43:08'),
(300, 'default', 'updated', 17, 'App\\Models\\StudentAnswer', 81, 'App\\User', '[]', '2019-04-14 17:43:14', '2019-04-14 17:43:14'),
(301, 'default', 'updated', 17, 'App\\Models\\StudentAnswer', 81, 'App\\User', '[]', '2019-04-14 17:44:15', '2019-04-14 17:44:15'),
(302, 'default', 'updated', 17, 'App\\Models\\StudentAnswer', 81, 'App\\User', '[]', '2019-04-14 17:44:33', '2019-04-14 17:44:33'),
(303, 'default', 'created', 16, 'App\\Models\\Sponsor', 1, 'App\\User', '{"attributes":{"id":16,"name":"Sikhya Vikas Samiti","tagline":null,"description":"lorem30;","email":"nishant6639@gmail.com","email_verified":1,"mobile":9439416693,"mobile_verified":1,"address":"lorem30;","plan_id":9,"stream_room":"917713","created_at":"2019-04-15 14:23:47","updated_at":"2019-04-15 14:23:47","deleted_at":null}}', '2019-04-15 14:23:47', '2019-04-15 14:23:47'),
(304, 'default', 'created', 17, 'App\\Models\\Sponsor', 1, 'App\\User', '{"attributes":{"id":17,"name":"Sikhya Vikaas Samiti","tagline":null,"description":"lorem30;","email":"nishant6635@gmail.com","email_verified":1,"mobile":9439416694,"mobile_verified":1,"address":"lorem30;","plan_id":9,"stream_room":"061650","created_at":"2019-04-15 14:24:40","updated_at":"2019-04-15 14:24:40","deleted_at":null}}', '2019-04-15 14:24:40', '2019-04-15 14:24:40'),
(305, 'default', 'created', 20, 'App\\Models\\Organization', 1, 'App\\User', '{"attributes":{"id":20,"name":"OTET","tagline":"null","description":"lorem30;","email":"abcd@xyz.com","email_verified":1,"mobile":9876556789,"mobile_verified":1,"is_school":1,"address":"lorem30;","sponsor_id":17,"is_default":0,"stream_room":"975949","medium":0,"channel_id":null,"created_at":"2019-04-15 14:31:45","updated_at":"2019-04-15 14:31:45","deleted_at":null}}', '2019-04-15 14:31:45', '2019-04-15 14:31:45'),
(306, 'default', 'created', 14, 'App\\Models\\Department', 1, 'App\\User', '{"attributes":{"id":14,"name":"OTET_dept","is_default":1,"organization_id":20,"stream_room":"672738","created_at":"2019-04-15 14:31:45","updated_at":"2019-04-15 14:31:45","deleted_at":null}}', '2019-04-15 14:31:45', '2019-04-15 14:31:45'),
(307, 'default', 'created', 31, 'App\\Models\\Program', 1, 'App\\User', '{"attributes":{"id":31,"name":"OTET_prg","department_id":14,"stream_room":"166903","is_default":1,"created_at":"2019-04-15 14:31:45","updated_at":"2019-04-15 14:31:45","deleted_at":null}}', '2019-04-15 14:31:45', '2019-04-15 14:31:45'),
(308, 'default', 'created', 11, 'App\\Models\\Grade', 1, 'App\\User', '{"attributes":{"id":11,"name":"Grade X","program_id":31,"stream_room":"709211","created_at":"2019-04-15 14:32:19","updated_at":"2019-04-15 14:32:19","deleted_at":null}}', '2019-04-15 14:32:19', '2019-04-15 14:32:19'),
(309, 'default', 'created', 25, 'App\\Models\\Subject', 1, 'App\\User', '{"attributes":{"id":25,"name":"English","grade_id":11,"created_at":"2019-04-15 14:32:49","updated_at":"2019-04-15 14:32:49","deleted_at":null}}', '2019-04-15 14:32:49', '2019-04-15 14:32:49'),
(310, 'default', 'created', 12, 'App\\Models\\Introduction', 1, 'App\\User', '{"attributes":{"id":12,"text":"<p>\\u0b07\\u0b02\\u0b30\\u0b3e\\u0b1c\\u0b40 \\u0b0f\\u0b15 \\u0b17\\u0b41\\u0b30\\u0b41\\u0b24\\u0b4d\\u0b2c\\u0b2a\\u0b42\\u0b30\\u0b4d\\u0b23 \\u0b2d\\u0b3e\\u0b37\\u0b3e | <\\/p>","video":null,"video_type":null,"video_size":null,"videourl":null,"introductable_id":25,"introductable_type":"App\\\\Models\\\\Subject","created_at":"2019-04-15 14:46:03","updated_at":"2019-04-15 14:46:03","deleted_at":null}}', '2019-04-15 14:46:03', '2019-04-15 14:46:03'),
(311, 'default', 'created', 4, 'App\\Models\\Chapter', 1, 'App\\User', '{"attributes":{"id":4,"name":"Chapter 1","subject_id":25,"created_at":"2019-04-15 14:47:03","updated_at":"2019-04-15 14:47:03","deleted_at":null}}', '2019-04-15 14:47:03', '2019-04-15 14:47:03'),
(312, 'default', 'created', 13, 'App\\Models\\Introduction', 1, 'App\\User', '{"attributes":{"id":13,"text":null,"video":"QvHjBx6dkSedgvdgJ2ZcIGzEbD60ExaLrEamgsS7.mp4","video_type":"mp4","video_size":32338628,"videourl":null,"introductable_id":4,"introductable_type":"App\\\\Models\\\\Chapter","created_at":"2019-04-15 14:47:39","updated_at":"2019-04-15 14:47:39","deleted_at":null}}', '2019-04-15 14:47:39', '2019-04-15 14:47:39'),
(313, 'default', 'updated', 13, 'App\\Models\\Introduction', 1, 'App\\User', '{"attributes":{"id":13,"text":"null","video":"4SWgmrl7UzX0PlJK4FmDdocb8piMlkz7LkIp9zmm.mp4","video_type":"mp4","video_size":32338628,"videourl":null,"introductable_id":4,"introductable_type":"App\\\\Models\\\\Chapter","created_at":"2019-04-15 14:47:39","updated_at":"2019-04-15 14:56:24","deleted_at":null},"old":{"id":13,"text":null,"video":"QvHjBx6dkSedgvdgJ2ZcIGzEbD60ExaLrEamgsS7.mp4","video_type":"mp4","video_size":32338628,"videourl":null,"introductable_id":4,"introductable_type":"App\\\\Models\\\\Chapter","created_at":"2019-04-15 14:47:39","updated_at":"2019-04-15 14:47:39","deleted_at":null}}', '2019-04-15 14:56:24', '2019-04-15 14:56:24'),
(314, 'default', 'created', 26, 'App\\Models\\Section', 1, 'App\\User', '{"attributes":{"id":26,"name":"Section 1","chapter_id":4,"love_reactant_id":null,"created_at":"2019-04-15 15:02:59","updated_at":"2019-04-15 15:02:59","deleted_at":null}}', '2019-04-15 15:02:59', '2019-04-15 15:02:59'),
(315, 'default', 'updated', 26, 'App\\Models\\Section', 1, 'App\\User', '{"attributes":{"id":26,"name":"Section 1","chapter_id":4,"love_reactant_id":8,"created_at":"2019-04-15 15:02:59","updated_at":"2019-04-15 15:02:59","deleted_at":null},"old":{"id":null,"name":null,"chapter_id":null,"love_reactant_id":null,"created_at":null,"updated_at":null,"deleted_at":null}}', '2019-04-15 15:02:59', '2019-04-15 15:02:59'),
(316, 'default', 'created', 9, 'App\\Models\\Video', 1, 'App\\User', '{"attributes":{"id":9,"video":"xpGCiEhTf7jY0krSZiRfTLfmj1a7QCMqA8P5zWtZ.mp4","video_type":null,"video_size":null,"videoable_id":26,"videoable_type":"App\\\\Models\\\\Section","created_at":"2019-04-15 15:03:33","updated_at":"2019-04-15 15:03:33","deleted_at":null}}', '2019-04-15 15:03:33', '2019-04-15 15:03:33'),
(317, 'default', 'created', 27, 'App\\Models\\Section', 1, 'App\\User', '{"attributes":{"id":27,"name":"Section 2","chapter_id":4,"love_reactant_id":null,"created_at":"2019-04-15 15:07:03","updated_at":"2019-04-15 15:07:03","deleted_at":null}}', '2019-04-15 15:07:03', '2019-04-15 15:07:03'),
(318, 'default', 'updated', 27, 'App\\Models\\Section', 1, 'App\\User', '{"attributes":{"id":27,"name":"Section 2","chapter_id":4,"love_reactant_id":9,"created_at":"2019-04-15 15:07:03","updated_at":"2019-04-15 15:07:03","deleted_at":null},"old":{"id":null,"name":null,"chapter_id":null,"love_reactant_id":null,"created_at":null,"updated_at":null,"deleted_at":null}}', '2019-04-15 15:07:03', '2019-04-15 15:07:03'),
(319, 'default', 'created', 10, 'App\\Models\\Video', 1, 'App\\User', '{"attributes":{"id":10,"video":"OXJYXWLxvHvUcNmz59J8doo8qh9M5xeI1F9O90CS.mp4","video_type":null,"video_size":null,"videoable_id":27,"videoable_type":"App\\\\Models\\\\Section","created_at":"2019-04-15 15:07:55","updated_at":"2019-04-15 15:07:55","deleted_at":null}}', '2019-04-15 15:07:55', '2019-04-15 15:07:55'),
(320, 'default', 'created', 30, 'App\\Models\\Text', 1, 'App\\User', '{"attributes":{"id":30,"text":null,"textable_id":27,"textable_type":"App\\\\Models\\\\Section","created_at":"2019-04-15 15:08:06","updated_at":"2019-04-15 15:08:06","deleted_at":null}}', '2019-04-15 15:08:06', '2019-04-15 15:08:06'),
(321, 'default', 'created', 28, 'App\\Models\\Section', 1, 'App\\User', '{"attributes":{"id":28,"name":"Section 3","chapter_id":4,"love_reactant_id":null,"created_at":"2019-04-15 15:08:17","updated_at":"2019-04-15 15:08:17","deleted_at":null}}', '2019-04-15 15:08:17', '2019-04-15 15:08:17'),
(322, 'default', 'updated', 28, 'App\\Models\\Section', 1, 'App\\User', '{"attributes":{"id":28,"name":"Section 3","chapter_id":4,"love_reactant_id":10,"created_at":"2019-04-15 15:08:17","updated_at":"2019-04-15 15:08:17","deleted_at":null},"old":{"id":null,"name":null,"chapter_id":null,"love_reactant_id":null,"created_at":null,"updated_at":null,"deleted_at":null}}', '2019-04-15 15:08:17', '2019-04-15 15:08:17'),
(323, 'default', 'created', 11, 'App\\Models\\Video', 1, 'App\\User', '{"attributes":{"id":11,"video":"NgHbCiWQwK7u4XoaT3vVqapFHj7APzK4gJCE3kaB.mp4","video_type":null,"video_size":null,"videoable_id":28,"videoable_type":"App\\\\Models\\\\Section","created_at":"2019-04-15 15:09:21","updated_at":"2019-04-15 15:09:21","deleted_at":null}}', '2019-04-15 15:09:21', '2019-04-15 15:09:21'),
(324, 'default', 'created', 31, 'App\\Models\\Text', 1, 'App\\User', '{"attributes":{"id":31,"text":null,"textable_id":28,"textable_type":"App\\\\Models\\\\Section","created_at":"2019-04-15 15:09:42","updated_at":"2019-04-15 15:09:42","deleted_at":null}}', '2019-04-15 15:09:42', '2019-04-15 15:09:42'),
(325, 'default', 'created', 23, 'App\\Models\\ExamAppearance', 81, 'App\\User', '[]', '2019-04-23 23:27:07', '2019-04-23 23:27:07'),
(326, 'default', 'deleted', 17, 'App\\Models\\Subgrade', 1, 'App\\User', '{"attributes":{"id":17,"name":"fff","grade_id":1,"stream_room":"747742","channel_id":null,"medium":0,"created_at":"2019-04-02 12:01:51","updated_at":"2019-04-27 00:55:41","deleted_at":"2019-04-27 00:55:41"}}', '2019-04-27 00:55:41', '2019-04-27 00:55:41'),
(327, 'default', 'deleted', 14, 'App\\Models\\Subgrade', 1, 'App\\User', '{"attributes":{"id":14,"name":"Mtech 1","grade_id":1,"stream_room":"495843","channel_id":null,"medium":0,"created_at":"2019-04-02 11:38:59","updated_at":"2019-04-27 00:55:46","deleted_at":"2019-04-27 00:55:46"}}', '2019-04-27 00:55:46', '2019-04-27 00:55:46'),
(328, 'default', 'deleted', 22, 'App\\Models\\Subgrade', 1, 'App\\User', '{"attributes":{"id":22,"name":"Grade53","grade_id":1,"stream_room":"671445","channel_id":null,"medium":0,"created_at":"2019-04-02 12:27:53","updated_at":"2019-04-27 00:55:50","deleted_at":"2019-04-27 00:55:50"}}', '2019-04-27 00:55:50', '2019-04-27 00:55:50'),
(329, 'default', 'created', 18, 'App\\Models\\Sponsor', 1, 'App\\User', '{"attributes":{"id":18,"name":"Demo Sponsor","tagline":"This is a demo sponsor for demonstration purpose.","description":"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui","email":"demo@codession.com","email_verified":1,"mobile":9876543210,"mobile_verified":1,"address":"123, Patia, Bhubaneswar, India","plan_id":9,"stream_room":"906512","created_at":"2019-04-27 08:27:05","updated_at":"2019-04-27 08:27:05","deleted_at":null}}', '2019-04-27 08:27:05', '2019-04-27 08:27:05'),
(330, 'default', 'created', 21, 'App\\Models\\Organization', 1, 'App\\User', '{"attributes":{"id":21,"name":"New Demo Organization","tagline":"This is a demo organization for demonstration purpose.","description":"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui","email":"demo_org@codession.com","email_verified":1,"mobile":9876543210,"mobile_verified":1,"is_school":1,"address":"123, Patia, Bhubaneswar.","sponsor_id":18,"is_default":0,"stream_room":"280237","medium":0,"channel_id":null,"created_at":"2019-04-27 08:29:19","updated_at":"2019-04-27 08:29:19","deleted_at":null}}', '2019-04-27 08:29:19', '2019-04-27 08:29:19'),
(331, 'default', 'created', 15, 'App\\Models\\Department', 1, 'App\\User', '{"attributes":{"id":15,"name":"New Demo Organization_dept","is_default":1,"organization_id":21,"stream_room":"084839","created_at":"2019-04-27 08:29:19","updated_at":"2019-04-27 08:29:19","deleted_at":null}}', '2019-04-27 08:29:19', '2019-04-27 08:29:19'),
(332, 'default', 'created', 32, 'App\\Models\\Program', 1, 'App\\User', '{"attributes":{"id":32,"name":"New Demo Organization_prg","department_id":15,"stream_room":"781775","is_default":1,"created_at":"2019-04-27 08:29:19","updated_at":"2019-04-27 08:29:19","deleted_at":null}}', '2019-04-27 08:29:19', '2019-04-27 08:29:19'),
(333, 'default', 'created', 12, 'App\\Models\\Grade', 1, 'App\\User', '{"attributes":{"id":12,"name":"Grade 7","program_id":32,"stream_room":"876413","created_at":"2019-04-27 08:29:45","updated_at":"2019-04-27 08:29:45","deleted_at":null}}', '2019-04-27 08:29:45', '2019-04-27 08:29:45'),
(334, 'default', 'created', 26, 'App\\Models\\Subject', 1, 'App\\User', '{"attributes":{"id":26,"name":"Physics","grade_id":12,"created_at":"2019-04-27 08:29:58","updated_at":"2019-04-27 08:29:58","deleted_at":null}}', '2019-04-27 08:29:58', '2019-04-27 08:29:58');
INSERT INTO `activity_log` (`id`, `log_name`, `description`, `subject_id`, `subject_type`, `causer_id`, `causer_type`, `properties`, `created_at`, `updated_at`) VALUES
(335, 'default', 'created', 24, 'App\\Models\\Subgrade', 1, 'App\\User', '{"attributes":{"id":24,"name":"Section A","grade_id":12,"stream_room":"354900","channel_id":null,"medium":0,"created_at":"2019-04-27 08:30:07","updated_at":"2019-04-27 08:30:07","deleted_at":null}}', '2019-04-27 08:30:07', '2019-04-27 08:30:07'),
(336, 'default', 'created', 6, 'App\\Models\\ClassroomAssignedUser', 1, 'App\\User', '{"attributes":{"id":6,"subgrade_id":24,"user_id":86,"is_enabled":1,"is_teacher":1,"created_at":"2019-04-27 08:37:59","updated_at":"2019-04-27 08:37:59","deleted_at":null}}', '2019-04-27 08:37:59', '2019-04-27 08:37:59'),
(337, 'default', 'created', 7, 'App\\Models\\ClassroomAssignedUser', 1, 'App\\User', '{"attributes":{"id":7,"subgrade_id":24,"user_id":71,"is_enabled":1,"is_teacher":1,"created_at":"2019-04-27 08:41:59","updated_at":"2019-04-27 08:41:59","deleted_at":null}}', '2019-04-27 08:41:59', '2019-04-27 08:41:59'),
(338, 'default', 'created', 5, 'App\\Models\\Chapter', 66, 'App\\User', '{"attributes":{"id":5,"name":"Motion and Time","subject_id":26,"created_at":"2019-04-27 09:37:27","updated_at":"2019-04-27 09:37:27","deleted_at":null}}', '2019-04-27 09:37:27', '2019-04-27 09:37:27'),
(339, 'default', 'created', 14, 'App\\Models\\Introduction', 66, 'App\\User', '{"attributes":{"id":14,"text":"<p>Physics is one of the crucial sub-subjects of Science. In ICSE Class 7, Physics is a combination of theoretical and practical knowledge. TopperLearning provides study materials for ICSE Class 7 Physics which will help you to effectively prepare for your final examination. Our study materials for Physics are prepared by subject experts and will help you with a detailed understanding of Physics. <\\/p>","video":null,"video_type":null,"video_size":null,"videourl":null,"introductable_id":5,"introductable_type":"App\\\\Models\\\\Chapter","created_at":"2019-04-27 09:38:52","updated_at":"2019-04-27 09:38:52","deleted_at":null}}', '2019-04-27 09:38:52', '2019-04-27 09:38:52'),
(340, 'default', 'updated', 14, 'App\\Models\\Introduction', 66, 'App\\User', '{"attributes":{"id":14,"text":"<p>Physics is one of the crucial sub-subjects of Science. In ICSE Class 7, Physics is a combination of theoretical and practical knowledge. TopperLearning provides study materials for ICSE Class 7 Physics which will help you to effectively prepare for your final examination. Our study materials for Physics are prepared by subject experts and will help you with a detailed understanding of Physics. <\\/p>","video":"nBB8hz74fapFQNrbgWlsmEYwc6YCO3XuT9XNTSPd.txt","video_type":"ram","video_size":60,"videourl":null,"introductable_id":5,"introductable_type":"App\\\\Models\\\\Chapter","created_at":"2019-04-27 09:38:52","updated_at":"2019-04-27 09:44:08","deleted_at":null},"old":{"id":14,"text":"<p>Physics is one of the crucial sub-subjects of Science. In ICSE Class 7, Physics is a combination of theoretical and practical knowledge. TopperLearning provides study materials for ICSE Class 7 Physics which will help you to effectively prepare for your final examination. Our study materials for Physics are prepared by subject experts and will help you with a detailed understanding of Physics. <\\/p>","video":null,"video_type":null,"video_size":null,"videourl":null,"introductable_id":5,"introductable_type":"App\\\\Models\\\\Chapter","created_at":"2019-04-27 09:38:52","updated_at":"2019-04-27 09:38:52","deleted_at":null}}', '2019-04-27 09:44:08', '2019-04-27 09:44:08'),
(341, 'default', 'updated', 14, 'App\\Models\\Introduction', 66, 'App\\User', '{"attributes":{"id":14,"text":"<p>Physics is one of the crucial sub-subjects of Science. In ICSE Class 7, Physics is a combination of theoretical and practical knowledge. TopperLearning provides study materials for ICSE Class 7 Physics which will help you to effectively prepare for your final examination. Our study materials for Physics are prepared by subject experts and will help you with a detailed understanding of Physics. <\\/p>","video":"1kmE4kQgM8OKiLj6aGj8p07O5Z3C2xibVIlfffuz.txt","video_type":"ram","video_size":60,"videourl":null,"introductable_id":5,"introductable_type":"App\\\\Models\\\\Chapter","created_at":"2019-04-27 09:38:52","updated_at":"2019-04-27 09:45:04","deleted_at":null},"old":{"id":14,"text":"<p>Physics is one of the crucial sub-subjects of Science. In ICSE Class 7, Physics is a combination of theoretical and practical knowledge. TopperLearning provides study materials for ICSE Class 7 Physics which will help you to effectively prepare for your final examination. Our study materials for Physics are prepared by subject experts and will help you with a detailed understanding of Physics. <\\/p>","video":"nBB8hz74fapFQNrbgWlsmEYwc6YCO3XuT9XNTSPd.txt","video_type":"ram","video_size":60,"videourl":null,"introductable_id":5,"introductable_type":"App\\\\Models\\\\Chapter","created_at":"2019-04-27 09:38:52","updated_at":"2019-04-27 09:44:08","deleted_at":null}}', '2019-04-27 09:45:04', '2019-04-27 09:45:04'),
(342, 'default', 'created', 15, 'App\\Models\\Introduction', 66, 'App\\User', '{"attributes":{"id":15,"text":"<p>While physics can be a fascinating subject, some of the concepts it presents aren\'t always the easiest for&nbsp;<a href=\\"https:\\/\\/www.onlinecolleges.net\\/\\">students<\\/a>to understand or for teachers to convey to their classes. That\'s where the web can come to the rescue. Here you\'ll find a list of some great videos that both clearly demonstrate the major ideas of physics for beginners, as well as provide insights in more complex topics for those who are more familiar with the subject matter, like students in engineering. <\\/p>","video":null,"video_type":null,"video_size":null,"videourl":null,"introductable_id":26,"introductable_type":"App\\\\Models\\\\Subject","created_at":"2019-04-27 09:53:57","updated_at":"2019-04-27 09:53:57","deleted_at":null}}', '2019-04-27 09:53:57', '2019-04-27 09:53:57'),
(343, 'default', 'created', 29, 'App\\Models\\Section', 66, 'App\\User', '{"attributes":{"id":29,"name":"SLOW OR FAST","chapter_id":5,"love_reactant_id":null,"created_at":"2019-04-27 09:54:57","updated_at":"2019-04-27 09:54:57","deleted_at":null}}', '2019-04-27 09:54:57', '2019-04-27 09:54:57'),
(344, 'default', 'updated', 29, 'App\\Models\\Section', 66, 'App\\User', '{"attributes":{"id":29,"name":"SLOW OR FAST","chapter_id":5,"love_reactant_id":11,"created_at":"2019-04-27 09:54:57","updated_at":"2019-04-27 09:54:57","deleted_at":null},"old":{"id":null,"name":null,"chapter_id":null,"love_reactant_id":null,"created_at":null,"updated_at":null,"deleted_at":null}}', '2019-04-27 09:54:57', '2019-04-27 09:54:57'),
(345, 'default', 'created', 32, 'App\\Models\\Text', 66, 'App\\User', '{"attributes":{"id":32,"text":"<p>We know that some vehicles move faster than others. Even the same vehicle may move faster or slower at different times.<\\/p><p>Make a list of ten objects moving along a straight path. Group the motion of these objects as slow and fast. How did<\\/p><p>you decide which object is moving slow and which one is moving fast. If vehicles are moving on a road in the same direction, we can easily tell which one of them is moving faster than the other<\\/p>","textable_id":29,"textable_type":"App\\\\Models\\\\Section","created_at":"2019-04-27 09:55:40","updated_at":"2019-04-27 09:55:40","deleted_at":null}}', '2019-04-27 09:55:40', '2019-04-27 09:55:40'),
(346, 'default', 'updated', 14, 'App\\Models\\Introduction', 66, 'App\\User', '{"attributes":{"id":14,"text":"<p><strong>In <\\/strong>Class VI, you learnt about different types of motions. You learnt that a<\\/p><p>motion could be along a straight line,<\\/p><p>it could be circular or periodic. Can you<\\/p><p>recall these three types of motions?<\\/p><p>Table 13.1 gives some common<\\/p><p>examples of motions. Identify the type<\\/p><p>of motion in each case.<\\/p>","video":"1kmE4kQgM8OKiLj6aGj8p07O5Z3C2xibVIlfffuz.txt","video_type":"ram","video_size":60,"videourl":null,"introductable_id":5,"introductable_type":"App\\\\Models\\\\Chapter","created_at":"2019-04-27 09:38:52","updated_at":"2019-04-27 09:59:38","deleted_at":null},"old":{"id":14,"text":"<p>Physics is one of the crucial sub-subjects of Science. In ICSE Class 7, Physics is a combination of theoretical and practical knowledge. TopperLearning provides study materials for ICSE Class 7 Physics which will help you to effectively prepare for your final examination. Our study materials for Physics are prepared by subject experts and will help you with a detailed understanding of Physics. <\\/p>","video":"1kmE4kQgM8OKiLj6aGj8p07O5Z3C2xibVIlfffuz.txt","video_type":"ram","video_size":60,"videourl":null,"introductable_id":5,"introductable_type":"App\\\\Models\\\\Chapter","created_at":"2019-04-27 09:38:52","updated_at":"2019-04-27 09:45:04","deleted_at":null}}', '2019-04-27 09:59:38', '2019-04-27 09:59:38'),
(347, 'default', 'created', 9, 'App\\Models\\Videourl', 66, 'App\\User', '{"attributes":{"id":9,"videourl":"https:\\/\\/youtu.be\\/MWx947B4Mpk","videourlable_id":29,"videourlable_type":"App\\\\Models\\\\Section","created_at":"2019-04-27 10:02:49","updated_at":"2019-04-27 10:02:49","deleted_at":null}}', '2019-04-27 10:02:49', '2019-04-27 10:02:49'),
(348, 'default', 'created', 10, 'App\\Models\\Videourl', 66, 'App\\User', '{"attributes":{"id":10,"videourl":"https:\\/\\/www.youtube.com\\/embed\\/MWx947B4Mpk","videourlable_id":29,"videourlable_type":"App\\\\Models\\\\Section","created_at":"2019-04-27 10:03:49","updated_at":"2019-04-27 10:03:49","deleted_at":null}}', '2019-04-27 10:03:49', '2019-04-27 10:03:49'),
(349, 'default', 'created', 30, 'App\\Models\\Section', 66, 'App\\User', '{"attributes":{"id":30,"name":"SPEED","chapter_id":5,"love_reactant_id":null,"created_at":"2019-04-27 10:06:00","updated_at":"2019-04-27 10:06:00","deleted_at":null}}', '2019-04-27 10:06:00', '2019-04-27 10:06:00'),
(350, 'default', 'updated', 30, 'App\\Models\\Section', 66, 'App\\User', '{"attributes":{"id":30,"name":"SPEED","chapter_id":5,"love_reactant_id":12,"created_at":"2019-04-27 10:06:00","updated_at":"2019-04-27 10:06:00","deleted_at":null},"old":{"id":null,"name":null,"chapter_id":null,"love_reactant_id":null,"created_at":null,"updated_at":null,"deleted_at":null}}', '2019-04-27 10:06:00', '2019-04-27 10:06:00'),
(351, 'default', 'created', 31, 'App\\Models\\Section', 66, 'App\\User', '{"attributes":{"id":31,"name":"SPEED","chapter_id":5,"love_reactant_id":null,"created_at":"2019-04-27 10:07:58","updated_at":"2019-04-27 10:07:58","deleted_at":null}}', '2019-04-27 10:07:58', '2019-04-27 10:07:58'),
(352, 'default', 'updated', 31, 'App\\Models\\Section', 66, 'App\\User', '{"attributes":{"id":31,"name":"SPEED","chapter_id":5,"love_reactant_id":13,"created_at":"2019-04-27 10:07:58","updated_at":"2019-04-27 10:07:58","deleted_at":null},"old":{"id":null,"name":null,"chapter_id":null,"love_reactant_id":null,"created_at":null,"updated_at":null,"deleted_at":null}}', '2019-04-27 10:07:58', '2019-04-27 10:07:58'),
(353, 'default', 'created', 33, 'App\\Models\\Text', 66, 'App\\User', '{"attributes":{"id":33,"text":"<p>You are probably familiar with the word speed. In the nexamples given above, a higher speed seems to indicate that a given distance has been covered in a shorter time, or a larger distance covered in a given time.<\\/p><p>The most convenient way to find out which of the two or more objects is moving faster is to compare the distances moved by them in a unit time. &nbsp;Thus, if we know the distance covered by two buses in one hour, we can tell which one is slower. We call the distance covered by an object in a unit time as the speed of the object.<\\/p><p><br><\\/p><p>When we say that a car is moving with a speed of 50 kilometres per hour, it implies that it will cover a distance of<\\/p><p><span style=\\"background-color: transparent;\\">&nbsp;50 kilometres in one hour. However, a car seldom moves with a constant speed for one hour. In fact, it starts moving slowly and then picks up speed. So, when we say that the car has a speed of 50 kilometres per hour, we usually consider only the total distance covered by it in one hour.&nbsp;<\\/span><\\/p><p><br><\\/p><p>Fig. 13.2 Position of vehicles shown in<\\/p><p>Fig. 13.1 Vehicles moving in the same direction on a road<\\/p>","textable_id":30,"textable_type":"App\\\\Models\\\\Section","created_at":"2019-04-27 10:11:16","updated_at":"2019-04-27 10:11:16","deleted_at":null}}', '2019-04-27 10:11:16', '2019-04-27 10:11:16'),
(354, 'default', 'created', 2, 'App\\Models\\Document', 66, 'App\\User', '{"attributes":{"id":2,"document":"cf8lsqNfHvjneIYqnP25CBd4VbYL8FctQYS3Am1Q.pdf","doc_name":"Ch_13.pdf","document_type":null,"document_size":null,"documentable_id":30,"documentable_type":"App\\\\Models\\\\Section","created_at":"2019-04-27 10:13:39","updated_at":"2019-04-27 10:13:39","deleted_at":null}}', '2019-04-27 10:13:39', '2019-04-27 10:13:39'),
(355, 'default', 'updated', 31, 'App\\Models\\Section', 66, 'App\\User', '{"attributes":{"id":31,"name":"MEASUREMENT OF TIME","chapter_id":5,"love_reactant_id":13,"created_at":"2019-04-27 10:07:58","updated_at":"2019-04-27 10:14:14","deleted_at":null},"old":{"id":31,"name":"SPEED","chapter_id":5,"love_reactant_id":13,"created_at":"2019-04-27 10:07:58","updated_at":"2019-04-27 10:07:58","deleted_at":null}}', '2019-04-27 10:14:14', '2019-04-27 10:14:14'),
(356, 'default', 'created', 34, 'App\\Models\\Text', 66, 'App\\User', '{"attributes":{"id":34,"text":"<p>If you did not have a clock, how would<\\/p><p>you decide what time of the day it is?<\\/p><p>Have you ever wondered how our elders<\\/p><p>could tell the approximate time of the<\\/p><p>day by just looking at shadows?<\\/p>","textable_id":31,"textable_type":"App\\\\Models\\\\Section","created_at":"2019-04-27 10:14:14","updated_at":"2019-04-27 10:14:14","deleted_at":null}}', '2019-04-27 10:14:14', '2019-04-27 10:14:14'),
(357, 'default', 'created', 12, 'App\\Models\\Video', 66, 'App\\User', '{"attributes":{"id":12,"video":"i3rixejxXP2qRFhWbo9sy7uYrnQoRFXRcYVaJiiR.mp4","video_type":null,"video_size":null,"videoable_id":30,"videoable_type":"App\\\\Models\\\\Section","created_at":"2019-04-27 10:15:37","updated_at":"2019-04-27 10:15:37","deleted_at":null}}', '2019-04-27 10:15:37', '2019-04-27 10:15:37'),
(358, 'default', 'updated', 30, 'App\\Models\\Section', 66, 'App\\User', '{"attributes":{"id":30,"name":"MEASUREMENT OF TIME","chapter_id":5,"love_reactant_id":12,"created_at":"2019-04-27 10:06:00","updated_at":"2019-04-27 10:15:45","deleted_at":null},"old":{"id":30,"name":"SPEED","chapter_id":5,"love_reactant_id":12,"created_at":"2019-04-27 10:06:00","updated_at":"2019-04-27 10:06:00","deleted_at":null}}', '2019-04-27 10:15:45', '2019-04-27 10:15:45'),
(359, 'default', 'updated', 32, 'App\\Models\\Message', 66, 'App\\User', '{"attributes":{"id":32,"subject":"Motilal Nehru Public School","message":"<p>Hello<\\/p>","user_id":1,"intended_model_type":"Admin","intended_model_subtype":"SiteAdmin","intended_model_id":"0","is_private":0,"private_receipent":null,"readBy":",66","deletedBy":",66","is_draft":0,"created_at":"2019-04-02 15:38:17","updated_at":"2019-06-15 21:21:26","deleted_at":null},"old":{"id":32,"subject":"Motilal Nehru Public School","message":"<p>Hello<\\/p>","user_id":1,"intended_model_type":"Admin","intended_model_subtype":"SiteAdmin","intended_model_id":"0","is_private":0,"private_receipent":null,"readBy":",66","deletedBy":null,"is_draft":0,"created_at":"2019-04-02 15:38:17","updated_at":"2019-04-07 09:54:08","deleted_at":null}}', '2019-06-15 21:21:26', '2019-06-15 21:21:26'),
(360, 'default', 'created', 6, 'App\\Models\\Chapter', 66, 'App\\User', '{"attributes":{"id":6,"name":"fff","subject_id":19,"created_at":"2019-06-15 21:22:11","updated_at":"2019-06-15 21:22:11","deleted_at":null}}', '2019-06-15 21:22:11', '2019-06-15 21:22:11'),
(361, 'default', 'created', 32, 'App\\Models\\Section', 66, 'App\\User', '{"attributes":{"id":32,"name":"gff","chapter_id":6,"love_reactant_id":null,"created_at":"2019-06-15 21:22:30","updated_at":"2019-06-15 21:22:30","deleted_at":null}}', '2019-06-15 21:22:30', '2019-06-15 21:22:30'),
(362, 'default', 'updated', 32, 'App\\Models\\Section', 66, 'App\\User', '{"attributes":{"id":32,"name":"gff","chapter_id":6,"love_reactant_id":14,"created_at":"2019-06-15 21:22:30","updated_at":"2019-06-15 21:22:30","deleted_at":null},"old":{"id":null,"name":null,"chapter_id":null,"love_reactant_id":null,"created_at":null,"updated_at":null,"deleted_at":null}}', '2019-06-15 21:22:30', '2019-06-15 21:22:30'),
(363, 'default', 'created', 7, 'App\\Models\\Chapter', 66, 'App\\User', '{"attributes":{"id":7,"name":"hhh","subject_id":19,"created_at":"2019-06-15 21:22:49","updated_at":"2019-06-15 21:22:49","deleted_at":null}}', '2019-06-15 21:22:49', '2019-06-15 21:22:49'),
(364, 'default', 'created', 33, 'App\\Models\\Section', 66, 'App\\User', '{"attributes":{"id":33,"name":"jj j","chapter_id":7,"love_reactant_id":null,"created_at":"2019-06-15 21:23:02","updated_at":"2019-06-15 21:23:02","deleted_at":null}}', '2019-06-15 21:23:02', '2019-06-15 21:23:02'),
(365, 'default', 'updated', 33, 'App\\Models\\Section', 66, 'App\\User', '{"attributes":{"id":33,"name":"jj j","chapter_id":7,"love_reactant_id":15,"created_at":"2019-06-15 21:23:02","updated_at":"2019-06-15 21:23:02","deleted_at":null},"old":{"id":null,"name":null,"chapter_id":null,"love_reactant_id":null,"created_at":null,"updated_at":null,"deleted_at":null}}', '2019-06-15 21:23:02', '2019-06-15 21:23:02'),
(366, 'default', 'created', 16, 'App\\Models\\Introduction', 66, 'App\\User', '{"attributes":{"id":16,"text":"<p>cdc<\\/p>","video":null,"video_type":null,"video_size":null,"videourl":null,"introductable_id":7,"introductable_type":"App\\\\Models\\\\Chapter","created_at":"2019-06-15 21:25:40","updated_at":"2019-06-15 21:25:40","deleted_at":null}}', '2019-06-15 21:25:40', '2019-06-15 21:25:40'),
(367, 'default', 'updated', 32, 'App\\Models\\Message', 67, 'App\\User', '{"attributes":{"id":32,"subject":"Motilal Nehru Public School","message":"<p>Hello<\\/p>","user_id":1,"intended_model_type":"Admin","intended_model_subtype":"SiteAdmin","intended_model_id":"0","is_private":0,"private_receipent":null,"readBy":",66","deletedBy":",66,67","is_draft":0,"created_at":"2019-04-02 15:38:17","updated_at":"2019-06-26 03:31:48","deleted_at":null},"old":{"id":32,"subject":"Motilal Nehru Public School","message":"<p>Hello<\\/p>","user_id":1,"intended_model_type":"Admin","intended_model_subtype":"SiteAdmin","intended_model_id":"0","is_private":0,"private_receipent":null,"readBy":",66","deletedBy":",66","is_draft":0,"created_at":"2019-04-02 15:38:17","updated_at":"2019-06-15 21:21:26","deleted_at":null}}', '2019-06-26 03:31:48', '2019-06-26 03:31:48'),
(368, 'default', 'created', 2, 'App\\Models\\ForumTopic', 66, 'App\\User', '[]', '2019-06-27 08:52:43', '2019-06-27 08:52:43'),
(369, 'default', 'created', 1, 'App\\Models\\ForumComment', 66, 'App\\User', '[]', '2019-06-27 10:10:04', '2019-06-27 10:10:04'),
(370, 'default', 'created', 2, 'App\\Models\\ForumComment', 66, 'App\\User', '[]', '2019-06-27 10:12:04', '2019-06-27 10:12:04'),
(371, 'default', 'updated', 34, 'App\\Models\\Message', 67, 'App\\User', '{"attributes":{"id":34,"subject":"Testing","message":"<p>Hi Nishant,<\\/p><p>This one is a <strong>test message.&nbsp;<\\/strong> Please see if its fine.<\\/p><p>Regards,<\\/p><p>Aakash<\\/p>","user_id":66,"intended_model_type":"Admin","intended_model_subtype":"SiteAdmin","intended_model_id":"0","is_private":0,"private_receipent":null,"readBy":null,"deletedBy":",66,67","is_draft":0,"created_at":"2019-04-05 23:26:53","updated_at":"2019-06-27 14:29:04","deleted_at":null},"old":{"id":34,"subject":"Testing","message":"<p>Hi Nishant,<\\/p><p>This one is a <strong>test message.&nbsp;<\\/strong> Please see if its fine.<\\/p><p>Regards,<\\/p><p>Aakash<\\/p>","user_id":66,"intended_model_type":"Admin","intended_model_subtype":"SiteAdmin","intended_model_id":"0","is_private":0,"private_receipent":null,"readBy":null,"deletedBy":",66","is_draft":0,"created_at":"2019-04-05 23:26:53","updated_at":"2019-04-07 09:26:37","deleted_at":null}}', '2019-06-27 14:29:04', '2019-06-27 14:29:04'),
(372, 'default', 'created', 13, 'App\\Models\\Grade', 67, 'App\\User', '{"attributes":{"id":13,"name":"Grade 2","program_id":21,"organization_id":1,"stream_room":"172305","created_at":"2019-06-29 01:05:57","updated_at":"2019-06-29 01:05:57","deleted_at":null}}', '2019-06-29 01:05:57', '2019-06-29 01:05:57'),
(373, 'default', 'created', 25, 'App\\Models\\Subgrade', 67, 'App\\User', '{"attributes":{"id":25,"name":"Section B","grade_id":6,"stream_room":"146400","channel_id":null,"medium":0,"created_at":"2019-06-29 02:05:02","updated_at":"2019-06-29 02:05:02","deleted_at":null}}', '2019-06-29 02:05:02', '2019-06-29 02:05:02'),
(374, 'default', 'created', 28, 'App\\Models\\Exam', 67, 'App\\User', '{"attributes":{"id":28,"name":"New","start_date_time":"2019-06-30 20:00:55","end_date_time":"2019-06-29 23:01:10","exam_head":71,"total_marks":200,"is_confirmed":1,"is_over":0,"is_started":0,"is_upcoming":1,"result_announced":0,"grade_id":12,"for_all_classroom":0,"subgrade_id":24,"subject_id":26,"topic_id":null,"selected_set":null,"created_at":"2019-06-29 20:01:24","updated_at":"2019-06-29 20:01:24","deleted_at":null}}', '2019-06-29 20:01:25', '2019-06-29 20:01:25');

-- --------------------------------------------------------

--
-- Table structure for table `chapters`
--

CREATE TABLE `chapters` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chapters`
--

INSERT INTO `chapters` (`id`, `name`, `subject_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Current Affairs', 24, '2019-04-02 17:03:01', '2019-04-02 17:03:01', NULL),
(2, 'Environment', 24, '2019-04-02 17:04:14', '2019-04-02 17:04:14', NULL),
(3, 'RúaùKûh I Gjûe iwV^', 22, '2019-04-02 17:37:23', '2019-04-02 17:37:23', NULL),
(4, 'Chapter 1', 25, '2019-04-15 14:47:03', '2019-04-15 14:47:03', NULL),
(5, 'Motion and Time', 26, '2019-04-27 09:37:27', '2019-04-27 09:37:27', NULL),
(6, 'fff', 19, '2019-06-15 21:22:11', '2019-06-15 21:22:11', NULL),
(7, 'hhh', 19, '2019-06-15 21:22:49', '2019-06-15 21:22:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `classroom_assigned_subjects`
--

CREATE TABLE `classroom_assigned_subjects` (
  `id` int(10) UNSIGNED NOT NULL,
  `subgrade_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `is_enabled` tinyint(1) NOT NULL DEFAULT '1',
  `subject_teacher` int(11) DEFAULT NULL,
  `is_commpulsory` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `classroom_assigned_subjects`
--

INSERT INTO `classroom_assigned_subjects` (`id`, `subgrade_id`, `subject_id`, `is_enabled`, `subject_teacher`, `is_commpulsory`, `created_at`, `updated_at`, `deleted_at`) VALUES
(35, 24, 26, 1, NULL, 1, '2019-04-27 08:43:43', '2019-04-27 08:43:43', NULL),
(34, 23, 24, 1, NULL, 1, '2019-04-02 13:08:18', '2019-04-02 13:08:18', NULL),
(33, 2, 23, 1, NULL, 1, '2019-04-02 12:51:32', '2019-04-02 12:51:32', NULL),
(32, 2, 22, 1, NULL, 1, '2019-04-02 10:50:28', '2019-04-02 10:50:28', NULL),
(31, 2, 21, 1, NULL, 1, '2019-04-02 10:47:30', '2019-04-02 10:47:30', NULL),
(30, 4, 19, 1, NULL, 1, '2019-03-21 08:33:25', '2019-03-21 08:33:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `classroom_assigned_users`
--

CREATE TABLE `classroom_assigned_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `subgrade_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_enabled` tinyint(1) NOT NULL DEFAULT '1',
  `is_teacher` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `classroom_assigned_users`
--

INSERT INTO `classroom_assigned_users` (`id`, `subgrade_id`, `user_id`, `is_enabled`, `is_teacher`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 4, 71, 1, 1, '2019-03-21 08:33:09', '2019-03-21 08:33:09', NULL),
(2, 2, 79, 1, 0, '2019-04-02 10:00:48', '2019-04-02 10:00:48', NULL),
(3, 23, 83, 1, 1, '2019-04-02 13:15:48', '2019-04-02 13:15:48', NULL),
(4, 23, 84, 1, 1, '2019-04-02 13:15:52', '2019-04-02 13:15:52', NULL),
(5, 4, 81, 1, 0, '2019-04-11 00:54:41', '2019-04-11 00:54:41', NULL),
(7, 24, 71, 1, 1, '2019-04-27 08:41:59', '2019-04-27 08:41:59', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `commentable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `commentable_id` bigint(20) UNSIGNED NOT NULL,
  `creator_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `creator_id` bigint(20) UNSIGNED NOT NULL,
  `_lft` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `_rgt` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `title`, `body`, `commentable_type`, `commentable_id`, `creator_type`, `creator_id`, `_lft`, `_rgt`, `parent_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(18, 'Main Sources', '<p>Industries are the main sources of Air pollution.</p>', 'App\\Models\\Section', 24, 'App\\User', 83, 2, 3, 17, '2019-04-02 17:35:39', '2019-04-02 17:35:39', NULL),
(17, 'This is a question', '<p>What are main sources of Air pollution?</p>', 'App\\Models\\Section', 24, 'App\\User', 66, 1, 4, NULL, '2019-04-02 17:33:18', '2019-04-02 17:33:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  `organization_id` int(10) UNSIGNED NOT NULL,
  `stream_room` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `is_default`, `organization_id`, `stream_room`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Motilal Nehru Public School_dept', 1, 1, '002102', '2019-03-18 11:42:52', '2019-03-18 11:42:52', NULL),
(2, 'RVS Enginnering College_dept', 1, 2, '640790', '2019-03-19 13:10:37', '2019-03-19 13:10:37', NULL),
(3, 'Electrical', 0, 2, '079617', '2019-03-19 13:12:27', '2019-03-19 13:12:27', NULL),
(4, 'Motilal Nehru Public School - Campus 2_dept', 1, 3, '868336', '2019-03-21 16:40:50', '2019-03-21 16:40:50', NULL),
(5, 'Computer Science', 0, 6, '344534', '2019-04-02 00:32:24', '2019-04-02 00:32:24', NULL),
(6, 'Mamta_dept', 1, 10, '647371', '2019-04-02 09:35:13', '2019-04-02 09:35:13', NULL),
(7, 'Mamta_dept', 1, 13, '601868', '2019-04-02 09:42:46', '2019-04-02 09:42:46', NULL),
(8, 'Mamta_dept', 1, 14, '167855', '2019-04-02 09:45:52', '2019-04-02 09:45:52', NULL),
(9, 'Mamta_dept', 1, 15, '762585', '2019-04-02 09:46:29', '2019-04-02 09:46:29', NULL),
(10, 'Demo org_dept', 1, 18, '264222', '2019-04-02 10:00:04', '2019-04-02 10:00:04', NULL),
(11, 'Demo Organization_dept', 1, 19, '170969', '2019-04-02 12:49:39', '2019-04-02 12:49:39', NULL),
(12, 't1', 0, 6, '541071', '2019-04-07 13:17:10', '2019-04-07 13:17:15', '2019-04-07 13:17:15'),
(13, 't2', 0, 6, '282962', '2019-04-07 13:17:20', '2019-04-07 22:38:43', NULL),
(14, 'OTET_dept', 1, 20, '672738', '2019-04-15 14:31:45', '2019-04-15 14:31:45', NULL),
(15, 'New Demo Organization_dept', 1, 21, '084839', '2019-04-27 08:29:19', '2019-04-27 08:29:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `disk_usages`
--

CREATE TABLE `disk_usages` (
  `id` int(10) UNSIGNED NOT NULL,
  `used_space` double NOT NULL DEFAULT '0',
  `allowed_space` double NOT NULL DEFAULT '1000',
  `organization_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` int(10) UNSIGNED NOT NULL,
  `document` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `doc_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `document_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `document_size` bigint(20) DEFAULT NULL,
  `documentable_id` int(10) UNSIGNED NOT NULL,
  `documentable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `document`, `doc_name`, `document_type`, `document_size`, `documentable_id`, `documentable_type`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'RI6BGbRrSzG0e7EaHyX0JX3p5LylEgYHDXymp6Y1.pdf', 'Tenderdocument_Directorate of Econimics & Stsstics.pdf', NULL, NULL, 24, 'App\\Models\\Section', '2019-04-02 17:22:51', '2019-04-02 17:22:51', NULL),
(2, 'cf8lsqNfHvjneIYqnP25CBd4VbYL8FctQYS3Am1Q.pdf', 'Ch_13.pdf', NULL, NULL, 30, 'App\\Models\\Section', '2019-04-27 10:13:39', '2019-04-27 10:13:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tagline` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `eventtype` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Normal',
  `model_id` int(11) DEFAULT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL,
  `is_complete` tinyint(1) NOT NULL DEFAULT '0',
  `is_started` tinyint(1) NOT NULL DEFAULT '0',
  `is_important` tinyint(1) NOT NULL DEFAULT '0',
  `organiser_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `tagline`, `description`, `eventtype`, `model_id`, `model_type`, `start`, `end`, `is_complete`, `is_started`, `is_important`, `organiser_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, 'first api', 'Mtech', 'This is test Event only.', 'Pinned', 19, 'Organization', '2019-04-06', '2019-04-06', 0, 0, 0, 83, '2019-04-05 07:11:07', '2019-04-05 07:11:07', NULL),
(5, 'Apple', 'orrange', 'hfhfthfthf fdfdf', 'Pinned', 19, 'Organization', '2019-04-06', '2019-04-06', 0, 0, 0, 83, '2019-04-05 07:24:29', '2019-04-05 07:24:29', NULL),
(6, 'ABCDEF', 'abcd', 'lorem30;', 'Pinned', 19, 'Organization', '2019-04-10', '2019-04-14', 0, 0, 0, 80, '2019-04-05 10:12:53', '2019-04-05 10:12:53', NULL),
(7, 'ABCDEF', 'abcd', 'lorem30;', 'Pinned', 19, 'Organization', '2019-04-10', '2019-04-14', 0, 0, 0, 80, '2019-04-05 10:13:05', '2019-04-05 10:13:05', NULL),
(8, 'ABCDEF', 'abcd', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam et fermentum dui. Ut orci quam, ornare sed lorem sed, hendrerit auctor dolor. Nulla viverra, nibh quis ultrices malesuada, ligula ipsum.', 'Pinned', 19, 'Organization', '2019-04-16', '2019-04-18', 0, 0, 0, 80, '2019-04-05 12:28:16', '2019-04-05 12:28:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date_time` datetime NOT NULL,
  `end_date_time` datetime NOT NULL,
  `exam_head` int(11) NOT NULL,
  `total_marks` int(11) NOT NULL,
  `is_confirmed` tinyint(1) NOT NULL DEFAULT '1',
  `is_over` tinyint(1) NOT NULL DEFAULT '0',
  `is_started` tinyint(1) NOT NULL DEFAULT '0',
  `is_upcoming` tinyint(1) NOT NULL DEFAULT '1',
  `result_announced` tinyint(1) NOT NULL DEFAULT '0',
  `grade_id` int(11) UNSIGNED NOT NULL,
  `for_all_classroom` tinyint(1) NOT NULL DEFAULT '0',
  `subgrade_id` int(10) UNSIGNED DEFAULT NULL,
  `subject_id` int(10) UNSIGNED NOT NULL,
  `topic_id` int(10) UNSIGNED DEFAULT NULL,
  `selected_set` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`id`, `name`, `start_date_time`, `end_date_time`, `exam_head`, `total_marks`, `is_confirmed`, `is_over`, `is_started`, `is_upcoming`, `result_announced`, `grade_id`, `for_all_classroom`, `subgrade_id`, `subject_id`, `topic_id`, `selected_set`, `created_at`, `updated_at`, `deleted_at`) VALUES
(28, 'New', '2019-06-30 20:00:55', '2019-06-29 23:01:10', 71, 200, 1, 0, 0, 1, 0, 12, 0, 24, 26, NULL, NULL, '2019-06-29 20:01:24', '2019-06-29 20:01:24', NULL),
(27, '2', '2019-04-21 03:46:46', '2019-05-05 03:47:00', 71, 100, 1, 0, 0, 1, 0, 2, 0, 4, 19, NULL, NULL, '2019-04-13 03:47:23', '2019-04-13 03:47:23', NULL),
(26, 'New Test Exam', '2019-04-10 11:18:16', '2019-04-30 11:18:25', 71, 100, 1, 0, 0, 1, 0, 2, 0, 4, 19, NULL, 26, '2019-04-07 11:18:34', '2019-04-12 20:54:32', NULL),
(25, 'Newest test examination', '2019-04-07 00:00:00', '2019-04-11 00:00:00', 71, 100, 1, 0, 0, 1, 0, 2, 0, 4, 19, NULL, NULL, '2019-04-05 20:14:14', '2019-04-05 20:14:14', NULL),
(24, 'New Examination', '2019-04-05 00:00:00', '2019-04-07 00:00:00', 71, 100, 1, 0, 1, 0, 0, 2, 0, 4, 19, NULL, NULL, '2019-04-05 14:11:56', '2019-04-05 14:11:56', NULL),
(23, 'Test2', '2019-04-02 20:10:18', '2019-04-02 21:09:23', 83, 20, 1, 0, 0, 1, 0, 7, 0, NULL, 24, NULL, 21, '2019-04-02 19:09:40', '2019-04-02 20:06:26', NULL),
(21, 'Recent exam', '2019-04-01 09:10:19', '2019-04-01 12:54:36', 71, 100, 1, 0, 0, 1, 0, 2, 0, 4, 19, NULL, NULL, '2019-03-31 16:54:48', '2019-03-31 16:54:48', NULL),
(22, 'General Knowledge test', '2019-04-02 14:00:39', '2019-04-02 15:22:45', 83, 50, 1, 1, 0, 0, 1, 7, 1, NULL, 24, NULL, 20, '2019-04-02 13:23:13', '2019-04-02 19:08:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `exam_appearances`
--

CREATE TABLE `exam_appearances` (
  `id` int(10) UNSIGNED NOT NULL,
  `exam_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `in_progress` tinyint(1) NOT NULL DEFAULT '0',
  `completed` tinyint(1) NOT NULL DEFAULT '0',
  `marks_obtained` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exam_appearances`
--

INSERT INTO `exam_appearances` (`id`, `exam_id`, `user_id`, `in_progress`, `completed`, `marks_obtained`, `created_at`, `updated_at`, `deleted_at`) VALUES
(23, 27, 81, 1, 0, NULL, '2019-04-23 23:27:07', '2019-04-23 23:27:07', NULL),
(22, 26, 81, 1, 0, NULL, '2019-04-11 00:57:33', '2019-04-11 00:57:33', NULL),
(21, 22, 81, 1, 0, NULL, '2019-04-02 19:04:32', '2019-04-02 19:04:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `exam_organizers`
--

CREATE TABLE `exam_organizers` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `exam_id` int(10) UNSIGNED DEFAULT NULL,
  `set_question` tinyint(1) NOT NULL DEFAULT '0',
  `publish_result` tinyint(1) NOT NULL DEFAULT '0',
  `view_all_sets` tinyint(1) NOT NULL DEFAULT '0',
  `select_exam_question_set` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exam_organizers`
--

INSERT INTO `exam_organizers` (`id`, `user_id`, `exam_id`, `set_question`, `publish_result`, `view_all_sets`, `select_exam_question_set`, `created_at`, `updated_at`, `deleted_at`) VALUES
(20, 71, 27, 0, 0, 0, 0, '2019-04-13 03:48:20', '2019-04-13 03:48:20', NULL),
(19, 71, 26, 0, 0, 0, 0, '2019-04-07 16:33:20', '2019-04-07 16:33:20', NULL),
(18, 71, 26, 0, 0, 0, 0, '2019-04-07 16:23:44', '2019-04-07 16:32:44', '2019-04-07 16:32:44'),
(17, 71, 26, 0, 0, 0, 0, '2019-04-07 11:20:04', '2019-04-07 16:22:29', '2019-04-07 16:22:29'),
(16, 71, 25, 0, 0, 0, 0, '2019-04-05 20:14:32', '2019-04-05 20:14:32', NULL),
(15, 71, 24, 0, 0, 0, 0, '2019-04-05 14:21:38', '2019-04-05 14:21:38', NULL),
(14, 83, 23, 0, 0, 0, 0, '2019-04-02 19:10:13', '2019-04-02 19:10:13', NULL),
(13, 83, 22, 0, 0, 0, 0, '2019-04-02 13:40:16', '2019-04-02 13:40:16', NULL),
(12, 71, 21, 0, 0, 0, 0, '2019-03-31 17:09:26', '2019-03-31 17:09:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `forum_comments`
--

CREATE TABLE `forum_comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `post` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `forum_topic_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `forum_comments`
--

INSERT INTO `forum_comments` (`id`, `post`, `is_active`, `forum_topic_id`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'this is first comment', 1, 2, 66, '2019-06-27 10:10:04', '2019-06-27 10:10:04', NULL),
(2, 'my second test', 1, 2, 66, '2019-06-27 10:12:04', '2019-06-27 10:12:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `forum_topics`
--

CREATE TABLE `forum_topics` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `post` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `forum_topics`
--

INSERT INTO `forum_topics` (`id`, `title`, `post`, `is_active`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'new Forum topic', 'this is test  please check.', 1, 66, '2019-06-26 02:16:02', '2019-06-26 02:16:02', NULL),
(2, 'Mtech', 'fvdvdf', 1, 66, '2019-06-27 08:52:43', '2019-06-27 08:52:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `program_id` int(10) UNSIGNED NOT NULL,
  `organization_id` int(11) DEFAULT NULL,
  `stream_room` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `medium` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`id`, `name`, `program_id`, `organization_id`, `stream_room`, `medium`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Grade 1', 21, NULL, '333544', 1, '2019-03-18 19:03:37', '2019-04-08 00:06:26', NULL),
(2, '1st year', 23, NULL, '792422', 0, '2019-03-19 13:13:34', '2019-03-19 13:13:34', NULL),
(3, '2nd Year', 23, NULL, '615008', 0, '2019-03-19 13:14:16', '2019-03-19 13:14:16', NULL),
(4, '3rd year', 23, NULL, '901675', 0, '2019-03-19 13:14:29', '2019-03-19 13:14:29', NULL),
(5, '4th year', 23, NULL, '426684', 0, '2019-03-19 13:14:42', '2019-03-19 13:14:42', NULL),
(6, '1st Grade Mtech', 26, NULL, '453758', 0, '2019-04-02 00:37:28', '2019-04-02 00:37:28', NULL),
(7, 'CLass 2', 27, NULL, '138895', 0, '2019-04-02 12:51:16', '2019-04-02 12:51:16', NULL),
(8, 'Test Grade', 27, NULL, '962078', 0, '2019-04-07 12:03:11', '2019-04-07 12:43:09', '2019-04-07 12:43:09'),
(9, 'test3', 27, NULL, '957318', 0, '2019-04-07 12:43:28', '2019-04-07 13:16:29', NULL),
(10, 'Grade 3', 30, NULL, '183488', 0, '2019-04-07 23:57:00', '2019-04-08 00:00:36', NULL),
(11, 'Grade X', 31, NULL, '709211', 0, '2019-04-15 14:32:19', '2019-04-15 14:32:19', NULL),
(12, 'Grade 7', 32, NULL, '876413', 0, '2019-04-27 08:29:45', '2019-04-27 08:29:45', NULL),
(13, 'Grade 2', 21, 1, '172305', 0, '2019-06-29 01:05:57', '2019-06-29 01:05:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `individual_results`
--

CREATE TABLE `individual_results` (
  `id` int(10) UNSIGNED NOT NULL,
  `score` int(11) NOT NULL,
  `percentage` double NOT NULL,
  `exam_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `wrong_answers` int(11) NOT NULL,
  `correct_answers` int(11) NOT NULL,
  `exam_appearance_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `individual_results`
--

INSERT INTO `individual_results` (`id`, `score`, `percentage`, `exam_id`, `user_id`, `wrong_answers`, `correct_answers`, `exam_appearance_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(8, 118, 118, 26, 81, 0, 5, 22, '2019-04-12 20:54:32', '2019-04-12 20:54:32', NULL),
(7, 10, 20, 22, 81, 0, 1, 21, '2019-04-02 19:08:11', '2019-04-02 19:08:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `introductions`
--

CREATE TABLE `introductions` (
  `id` int(10) UNSIGNED NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci,
  `video` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video_size` bigint(20) DEFAULT NULL,
  `videourl` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `introductable_id` int(10) UNSIGNED NOT NULL,
  `introductable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `introductions`
--

INSERT INTO `introductions` (`id`, `text`, `video`, `video_type`, `video_size`, `videourl`, `introductable_id`, `introductable_type`, `created_at`, `updated_at`, `deleted_at`) VALUES
(10, '<h2><strong>What is Environmental Pollution?</strong></h2><p>The dictionary explains pollution as “the presence in or introduction into the environment of a substance which has harmful or poisonous effects.” Wiki explains pollution as “the introduction of contaminants into the natural environment that cause adverse change.” Simply put, Environmental Pollution is something that brings harm to our environment and in turn to the people who exist based on the environment.</p>', NULL, NULL, NULL, NULL, 2, 'App\\Models\\Chapter', '2019-04-02 17:08:06', '2019-04-02 17:08:06', NULL),
(11, '<h2><strong>What is Environmental Pollution?</strong></h2><p>The dictionary explains pollution as “the presence in or introduction into the environment of a substance which has harmful or poisonous effects.” Wiki explains pollution as “the introduction of contaminants into the natural environment that cause adverse change.” Simply put, Environmental Pollution is something that brings harm to our environment and in turn to the people who exist based on the environment.</p>', NULL, NULL, NULL, NULL, 24, 'App\\Models\\Subject', '2019-04-02 17:09:10', '2019-04-02 17:09:10', NULL),
(9, '<p><br></p><p><br></p>', NULL, NULL, NULL, NULL, 22, 'App\\Models\\Subject', '2019-04-02 10:18:38', '2019-04-02 17:44:33', NULL),
(12, '<p>ଇଂରାଜୀ ଏକ ଗୁରୁତ୍ବପୂର୍ଣ ଭାଷା | </p>', NULL, NULL, NULL, NULL, 25, 'App\\Models\\Subject', '2019-04-15 14:46:03', '2019-04-15 14:46:03', NULL),
(13, 'null', '4SWgmrl7UzX0PlJK4FmDdocb8piMlkz7LkIp9zmm.mp4', 'mp4', 32338628, NULL, 4, 'App\\Models\\Chapter', '2019-04-15 14:47:39', '2019-04-15 14:56:24', NULL),
(14, '<p><strong>In </strong>Class VI, you learnt about different types of motions. You learnt that a</p><p>motion could be along a straight line,</p><p>it could be circular or periodic. Can you</p><p>recall these three types of motions?</p><p>Table 13.1 gives some common</p><p>examples of motions. Identify the type</p><p>of motion in each case.</p>', '1kmE4kQgM8OKiLj6aGj8p07O5Z3C2xibVIlfffuz.txt', 'ram', 60, NULL, 5, 'App\\Models\\Chapter', '2019-04-27 09:38:52', '2019-04-27 09:59:38', NULL),
(16, '<p>cdc</p>', NULL, NULL, NULL, NULL, 7, 'App\\Models\\Chapter', '2019-06-15 21:25:40', '2019-06-15 21:25:40', NULL),
(15, '<p>While physics can be a fascinating subject, some of the concepts it presents aren\'t always the easiest for&nbsp;<a href="https://www.onlinecolleges.net/">students</a>to understand or for teachers to convey to their classes. That\'s where the web can come to the rescue. Here you\'ll find a list of some great videos that both clearly demonstrate the major ideas of physics for beginners, as well as provide insights in more complex topics for those who are more familiar with the subject matter, like students in engineering. </p>', NULL, NULL, NULL, NULL, 26, 'App\\Models\\Subject', '2019-04-27 09:53:57', '2019-04-27 09:53:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lesson_plans`
--

CREATE TABLE `lesson_plans` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_id` int(11) NOT NULL,
  `subgrade_id` int(11) NOT NULL,
  `for_date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lesson_plans`
--

INSERT INTO `lesson_plans` (`id`, `title`, `description`, `subject_id`, `subgrade_id`, `for_date`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'What are vowels?', 'Vowels Lesson 1 hr important', 21, 2, '2019-04-02 16:15:16', '2019-04-02 12:15:26', '2019-04-02 12:15:26', NULL),
(2, 'Articles', 'Brief about Articles', 21, 2, '2019-04-02 13:30:03', '2019-04-02 12:30:10', '2019-04-02 12:30:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `love_reactants`
--

CREATE TABLE `love_reactants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `love_reactants`
--

INSERT INTO `love_reactants` (`id`, `type`, `created_at`, `updated_at`) VALUES
(9, 'App\\Models\\Section', '2019-04-15 15:07:03', '2019-04-15 15:07:03'),
(8, 'App\\Models\\Section', '2019-04-15 15:02:59', '2019-04-15 15:02:59'),
(7, 'App\\Models\\Section', '2019-04-02 17:26:16', '2019-04-02 17:26:16'),
(6, 'App\\Models\\Section', '2019-04-02 17:19:55', '2019-04-02 17:19:55'),
(10, 'App\\Models\\Section', '2019-04-15 15:08:17', '2019-04-15 15:08:17'),
(11, 'App\\Models\\Section', '2019-04-27 09:54:57', '2019-04-27 09:54:57'),
(12, 'App\\Models\\Section', '2019-04-27 10:06:00', '2019-04-27 10:06:00'),
(13, 'App\\Models\\Section', '2019-04-27 10:07:58', '2019-04-27 10:07:58'),
(14, 'App\\Models\\Section', '2019-06-15 21:22:30', '2019-06-15 21:22:30'),
(15, 'App\\Models\\Section', '2019-06-15 21:23:02', '2019-06-15 21:23:02');

-- --------------------------------------------------------

--
-- Table structure for table `love_reactant_reaction_counters`
--

CREATE TABLE `love_reactant_reaction_counters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reactant_id` bigint(20) UNSIGNED NOT NULL,
  `reaction_type_id` bigint(20) UNSIGNED NOT NULL,
  `count` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `weight` bigint(20) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `love_reactant_reaction_counters`
--

INSERT INTO `love_reactant_reaction_counters` (`id`, `reactant_id`, `reaction_type_id`, `count`, `weight`, `created_at`, `updated_at`) VALUES
(6, 6, 1, 2, 2, '2019-04-02 17:35:49', '2019-04-05 23:16:19');

-- --------------------------------------------------------

--
-- Table structure for table `love_reactant_reaction_totals`
--

CREATE TABLE `love_reactant_reaction_totals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reactant_id` bigint(20) UNSIGNED NOT NULL,
  `count` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `weight` bigint(20) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `love_reactant_reaction_totals`
--

INSERT INTO `love_reactant_reaction_totals` (`id`, `reactant_id`, `count`, `weight`, `created_at`, `updated_at`) VALUES
(4, 6, 2, 2, '2019-04-02 17:35:49', '2019-04-05 23:16:19');

-- --------------------------------------------------------

--
-- Table structure for table `love_reacters`
--

CREATE TABLE `love_reacters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `love_reacters`
--

INSERT INTO `love_reacters` (`id`, `type`, `created_at`, `updated_at`) VALUES
(33, 'App\\User', '2019-04-02 13:09:53', '2019-04-02 13:09:53'),
(32, 'App\\User', '2019-04-02 12:49:39', '2019-04-02 12:49:39'),
(31, 'App\\User', '2019-04-02 10:00:22', '2019-04-02 10:00:22'),
(30, 'App\\User', '2019-04-02 10:00:04', '2019-04-02 10:00:04'),
(29, 'App\\User', '2019-04-02 09:46:29', '2019-04-02 09:46:29'),
(28, 'App\\User', '2019-04-02 09:45:52', '2019-04-02 09:45:52'),
(27, 'App\\User', '2019-04-02 09:42:46', '2019-04-02 09:42:46'),
(26, 'App\\User', '2019-04-02 09:35:13', '2019-04-02 09:35:13'),
(25, 'App\\User', '2019-03-29 06:35:21', '2019-03-29 06:35:21'),
(24, 'App\\User', '2019-03-21 16:40:50', '2019-03-21 16:40:50'),
(23, 'App\\User', '2019-03-21 08:32:46', '2019-03-21 08:32:46'),
(22, 'App\\User', '2019-03-19 13:10:37', '2019-03-19 13:10:37'),
(21, 'App\\User', '2019-03-18 11:42:52', '2019-03-18 11:42:52'),
(20, 'App\\User', '2019-03-18 11:21:31', '2019-03-18 11:21:31'),
(19, 'App\\User', '2019-03-18 00:24:42', '2019-03-18 00:24:42'),
(18, 'App\\User', '2019-03-18 00:20:14', '2019-03-18 00:20:14'),
(34, 'App\\User', '2019-04-02 13:12:07', '2019-04-02 13:12:07'),
(35, 'App\\User', '2019-04-02 13:13:50', '2019-04-02 13:13:50'),
(36, 'App\\User', '2019-04-02 13:15:26', '2019-04-02 13:15:26'),
(37, 'App\\User', '2019-04-08 08:29:31', '2019-04-08 08:29:31'),
(38, 'App\\User', '2019-04-08 08:33:02', '2019-04-08 08:33:02'),
(39, 'App\\User', '2019-04-15 14:24:41', '2019-04-15 14:24:41'),
(40, 'App\\User', '2019-04-15 14:31:45', '2019-04-15 14:31:45'),
(41, 'App\\User', '2019-04-27 08:27:05', '2019-04-27 08:27:05'),
(42, 'App\\User', '2019-04-27 08:29:19', '2019-04-27 08:29:19');

-- --------------------------------------------------------

--
-- Table structure for table `love_reactions`
--

CREATE TABLE `love_reactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reactant_id` bigint(20) UNSIGNED NOT NULL,
  `reacter_id` bigint(20) UNSIGNED NOT NULL,
  `reaction_type_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `love_reactions`
--

INSERT INTO `love_reactions` (`id`, `reactant_id`, `reacter_id`, `reaction_type_id`, `created_at`, `updated_at`) VALUES
(27, 6, 18, 1, '2019-04-05 23:16:19', '2019-04-05 23:16:19'),
(26, 6, 35, 1, '2019-04-02 17:35:49', '2019-04-02 17:35:49');

-- --------------------------------------------------------

--
-- Table structure for table `love_reaction_types`
--

CREATE TABLE `love_reaction_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `weight` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `love_reaction_types`
--

INSERT INTO `love_reaction_types` (`id`, `name`, `weight`, `created_at`, `updated_at`) VALUES
(1, 'Like', 1, NULL, NULL),
(2, 'Dislike', -1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  `collection_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disk` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` int(10) UNSIGNED NOT NULL,
  `manipulations` json NOT NULL,
  `custom_properties` json NOT NULL,
  `responsive_images` json NOT NULL,
  `order_column` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `model_type`, `model_id`, `collection_name`, `name`, `file_name`, `mime_type`, `disk`, `size`, `manipulations`, `custom_properties`, `responsive_images`, `order_column`, `created_at`, `updated_at`) VALUES
(85, 'App\\Models\\Introduction', 9, 'intro_img', 'intro', 'intro.jpg', 'image/jpeg', 'public', 23483, '[]', '{"custom_headers": []}', '[]', 20, '2019-04-02 10:18:38', '2019-04-02 10:18:38'),
(84, 'App\\User', 79, 'user_avatar', 'pp', 'pp.jpeg', 'image/jpeg', 'public', 26881, '[]', '{"custom_headers": []}', '[]', 19, '2019-04-02 10:00:22', '2019-04-02 10:00:22'),
(83, 'App\\Models\\Organization', 18, 'organization_logo', '34872687_1277603395703002_73985969929322496_n', '34872687_1277603395703002_73985969929322496_n.jpg', 'image/jpeg', 'public', 72022, '[]', '{"custom_headers": []}', '[]', 18, '2019-04-02 10:00:04', '2019-04-02 10:00:04'),
(82, 'App\\Models\\Organization', 17, 'organization_logo', '34872687_1277603395703002_73985969929322496_n', '34872687_1277603395703002_73985969929322496_n.jpg', 'image/jpeg', 'public', 72022, '[]', '{"custom_headers": []}', '[]', 17, '2019-04-02 09:58:55', '2019-04-02 09:58:55'),
(81, 'App\\Models\\Organization', 16, 'organization_logo', '34872687_1277603395703002_73985969929322496_n', '34872687_1277603395703002_73985969929322496_n.jpg', 'image/jpeg', 'public', 72022, '[]', '{"custom_headers": []}', '[]', 16, '2019-04-02 09:56:34', '2019-04-02 09:56:34'),
(80, 'App\\Models\\Organization', 15, 'organization_logo', 'download', 'download.jpg', 'image/jpeg', 'public', 6383, '[]', '{"custom_headers": []}', '[]', 15, '2019-04-02 09:46:29', '2019-04-02 09:46:29'),
(79, 'App\\Models\\Organization', 14, 'organization_logo', 'download', 'download.jpg', 'image/jpeg', 'public', 6383, '[]', '{"custom_headers": []}', '[]', 14, '2019-04-02 09:45:52', '2019-04-02 09:45:52'),
(78, 'App\\Models\\Organization', 13, 'organization_logo', 'download', 'download.jpg', 'image/jpeg', 'public', 6383, '[]', '{"custom_headers": []}', '[]', 13, '2019-04-02 09:42:46', '2019-04-02 09:42:46'),
(77, 'App\\Models\\Organization', 12, 'organization_logo', 'download', 'download.jpg', 'image/jpeg', 'public', 6383, '[]', '{"custom_headers": []}', '[]', 12, '2019-04-02 09:41:51', '2019-04-02 09:41:51'),
(75, 'App\\Models\\Organization', 10, 'organization_logo', 'download', 'download.jpg', 'image/jpeg', 'public', 6383, '[]', '{"custom_headers": []}', '[]', 10, '2019-04-02 09:35:13', '2019-04-02 09:35:13'),
(76, 'App\\Models\\Organization', 11, 'organization_logo', 'download', 'download.jpg', 'image/jpeg', 'public', 6383, '[]', '{"custom_headers": []}', '[]', 11, '2019-04-02 09:39:44', '2019-04-02 09:39:44'),
(74, 'App\\Models\\Organization', 9, 'organization_logo', 'download', 'download.jpg', 'image/jpeg', 'public', 6383, '[]', '{"custom_headers": []}', '[]', 9, '2019-04-02 09:32:06', '2019-04-02 09:32:06'),
(72, 'App\\Models\\Organization', 7, 'organization_logo', 'download', 'download.jpg', 'image/jpeg', 'public', 6383, '[]', '{"custom_headers": []}', '[]', 7, '2019-04-02 09:23:41', '2019-04-02 09:23:41'),
(97, 'App\\Models\\Sponsor', 16, 'sponsor_logo', 'avatar', 'avatar.png', 'image/png', 'public', 24903, '[]', '{"custom_headers": []}', '[]', 32, '2019-04-15 14:23:47', '2019-04-15 14:23:47'),
(73, 'App\\Models\\Organization', 8, 'organization_logo', 'download', 'download.jpg', 'image/jpeg', 'public', 6383, '[]', '{"custom_headers": []}', '[]', 8, '2019-04-02 09:30:14', '2019-04-02 09:30:14'),
(98, 'App\\Models\\Sponsor', 17, 'sponsor_logo', 'avatar', 'avatar.png', 'image/png', 'public', 24903, '[]', '{"custom_headers": []}', '[]', 33, '2019-04-15 14:24:40', '2019-04-15 14:24:40'),
(69, 'App\\Models\\Organization', 6, 'organization_logo', 'download', 'download.jpg', 'image/jpeg', 'public', 6383, '[]', '{"custom_headers": []}', '[]', 6, '2019-03-31 15:36:58', '2019-03-31 15:36:58'),
(68, 'App\\Models\\Organization', 5, 'organization_logo', 'download', 'download.jpg', 'image/jpeg', 'public', 6383, '[]', '{"custom_headers": []}', '[]', 5, '2019-03-31 15:35:24', '2019-03-31 15:35:24'),
(66, 'App\\User', 71, 'user_avatar', 'pexels-photo-712521', 'pexels-photo-712521.jpeg', 'image/jpeg', 'public', 145964, '[]', '{"custom_headers": []}', '[]', 3, '2019-03-21 08:32:46', '2019-03-21 08:32:46'),
(67, 'App\\Models\\Sponsor', 15, 'sponsor_logo', '34872687_1277603395703002_73985969929322496_n', '34872687_1277603395703002_73985969929322496_n.jpg', 'image/jpeg', 'public', 72022, '[]', '{"custom_headers": []}', '[]', 4, '2019-03-29 06:35:20', '2019-03-29 06:35:20'),
(65, 'App\\User', 67, 'user_avatar', '51014065_10156500802996939_665491129382207488_n', '51014065_10156500802996939_665491129382207488_n.jpg', 'image/jpeg', 'public', 36318, '[]', '{"custom_headers": []}', '[]', 2, '2019-03-18 00:24:42', '2019-03-18 00:24:42'),
(64, 'App\\User', 66, 'user_avatar', '402417_253218604745767_1490811321_n', '402417_253218604745767_1490811321_n.jpg', 'image/jpeg', 'public', 28078, '[]', '{"custom_headers": []}', '[]', 1, '2019-03-18 00:20:14', '2019-03-18 00:20:14'),
(86, 'App\\Models\\Organization', 19, 'organization_logo', 'download', 'download.jpg', 'image/jpeg', 'public', 6383, '[]', '{"custom_headers": []}', '[]', 21, '2019-04-02 12:49:39', '2019-04-02 12:49:39'),
(87, 'App\\User', 81, 'user_avatar', 'DSC_1450', 'DSC_1450.jpg', 'image/jpeg', 'public', 36757, '[]', '{"custom_headers": []}', '[]', 22, '2019-04-02 13:09:53', '2019-04-02 13:09:53'),
(88, 'App\\User', 82, 'user_avatar', 'IMG_20150815_163231', 'IMG_20150815_163231.jpg', 'image/jpeg', 'public', 837577, '[]', '{"custom_headers": []}', '[]', 23, '2019-04-02 13:12:07', '2019-04-02 13:12:07'),
(89, 'App\\User', 83, 'user_avatar', 'IMG-20161008-WA0009', 'IMG-20161008-WA0009.jpg', 'image/jpeg', 'public', 46567, '[]', '{"custom_headers": []}', '[]', 24, '2019-04-02 13:13:50', '2019-04-02 13:13:50'),
(90, 'App\\User', 84, 'user_avatar', 'IMG-20160510-WA0007', 'IMG-20160510-WA0007.jpg', 'image/jpeg', 'public', 154640, '[]', '{"custom_headers": []}', '[]', 25, '2019-04-02 13:15:26', '2019-04-02 13:15:26'),
(91, 'App\\Models\\Introduction', 11, 'intro_img', 'environmental-protection-326923__340', 'environmental-protection-326923__340.jpg', 'image/jpeg', 'public', 51480, '[]', '{"custom_headers": []}', '[]', 26, '2019-04-02 17:12:52', '2019-04-02 17:12:52'),
(92, 'App\\Models\\Introduction', 10, 'intro_img', 'download (1)', 'download-(1).jpg', 'image/jpeg', 'public', 6075, '[]', '{"custom_headers": []}', '[]', 27, '2019-04-02 17:19:11', '2019-04-02 17:19:11'),
(93, 'App\\Models\\Section', 24, 'section_img', 'download (1)', 'download-(1).jpg', 'image/jpeg', 'public', 6075, '[]', '{"custom_headers": []}', '[]', 28, '2019-04-02 17:24:06', '2019-04-02 17:24:06'),
(94, 'App\\Models\\Section', 24, 'section_img', 'India_Smog_pollution_Delhi.0', 'India_Smog_pollution_Delhi.0.jpg', 'image/jpeg', 'public', 132517, '[]', '{"custom_headers": []}', '[]', 29, '2019-04-02 17:25:16', '2019-04-02 17:25:16'),
(95, 'App\\Models\\Section', 25, 'section_img', 'water', 'water.jpg', 'image/jpeg', 'public', 11092, '[]', '{"custom_headers": []}', '[]', 30, '2019-04-02 17:31:00', '2019-04-02 17:31:00'),
(96, 'App\\Models\\Section', 25, 'section_img', 'watrer', 'watrer.jpg', 'image/jpeg', 'public', 221655, '[]', '{"custom_headers": []}', '[]', 31, '2019-04-02 17:31:14', '2019-04-02 17:31:14'),
(99, 'App\\Models\\Organization', 20, 'organization_logo', 'banner2', 'banner2.jpg', 'image/jpeg', 'public', 195796, '[]', '{"custom_headers": []}', '[]', 34, '2019-04-15 14:31:45', '2019-04-15 14:31:45'),
(100, 'App\\Models\\Introduction', 12, 'intro_img', 'unnamed', 'unnamed.png', 'image/png', 'public', 21356, '[]', '{"custom_headers": []}', '[]', 35, '2019-04-15 14:46:03', '2019-04-15 14:46:03'),
(101, 'App\\Models\\Sponsor', 18, 'sponsor_logo', 'museum', 'museum.png', 'image/png', 'public', 23290, '[]', '{"custom_headers": []}', '[]', 36, '2019-04-27 08:27:05', '2019-04-27 08:27:05'),
(102, 'App\\Models\\Organization', 21, 'organization_logo', 'museum', 'museum.png', 'image/png', 'public', 23290, '[]', '{"custom_headers": []}', '[]', 37, '2019-04-27 08:29:19', '2019-04-27 08:29:19'),
(108, 'App\\Models\\Section', 30, 'section_img', 'Instantaneous-Speed', 'Instantaneous-Speed.jpg', 'image/jpeg', 'public', 23660, '[]', '{"custom_headers": []}', '[]', 42, '2019-04-27 10:12:30', '2019-04-27 10:12:30'),
(107, 'App\\Models\\Introduction', 14, 'intro_img', 'table13', 'table13.png', 'image/png', 'public', 24226, '[]', '{"custom_headers": []}', '[]', 41, '2019-04-27 10:01:16', '2019-04-27 10:01:16'),
(105, 'App\\Models\\Introduction', 15, 'intro_img', 'images2', 'images2.jpg', 'image/jpeg', 'public', 9820, '[]', '{"custom_headers": []}', '[]', 39, '2019-04-27 09:53:57', '2019-04-27 09:53:57'),
(106, 'App\\Models\\Section', 29, 'section_img', 'moving', 'moving.png', 'image/png', 'public', 213573, '[]', '{"custom_headers": []}', '[]', 40, '2019-04-27 09:57:49', '2019-04-27 09:57:49'),
(109, 'App\\Models\\Introduction', 16, 'intro_img', 'images', 'images.jpeg', 'image/jpeg', 'public', 13885, '[]', '{"custom_headers": []}', '[]', 43, '2019-06-15 21:25:40', '2019-06-15 21:25:40');

-- --------------------------------------------------------

--
-- Table structure for table `medialibrary_attachable`
--

CREATE TABLE `medialibrary_attachable` (
  `file_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attachable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attachable_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `medialibrary_categories`
--

CREATE TABLE `medialibrary_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `owner_id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `medialibrary_files`
--

CREATE TABLE `medialibrary_files` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner_id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `caption` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `properties` text COLLATE utf8mb4_unicode_ci,
  `width` smallint(6) DEFAULT NULL,
  `height` smallint(6) DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `disk` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `filename` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `extension` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` int(11) NOT NULL,
  `is_hidden` tinyint(1) NOT NULL DEFAULT '0',
  `completed` tinyint(1) NOT NULL DEFAULT '0',
  `group` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `medialibrary_transformations`
--

CREATE TABLE `medialibrary_transformations` (
  `id` int(10) UNSIGNED NOT NULL,
  `file_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `properties` text COLLATE utf8mb4_unicode_ci,
  `width` smallint(6) DEFAULT NULL,
  `height` smallint(6) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `extension` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` int(11) NOT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `intended_model_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `intended_model_subtype` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `intended_model_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_private` tinyint(1) NOT NULL DEFAULT '0',
  `private_receipent` int(11) DEFAULT NULL,
  `readBy` text COLLATE utf8mb4_unicode_ci,
  `deletedBy` text COLLATE utf8mb4_unicode_ci,
  `is_draft` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `subject`, `message`, `user_id`, `intended_model_type`, `intended_model_subtype`, `intended_model_id`, `is_private`, `private_receipent`, `readBy`, `deletedBy`, `is_draft`, `created_at`, `updated_at`, `deleted_at`) VALUES
(34, 'Testing', '<p>Hi Nishant,</p><p>This one is a <strong>test message.&nbsp;</strong> Please see if its fine.</p><p>Regards,</p><p>Aakash</p>', 66, 'Admin', 'SiteAdmin', '0', 0, NULL, NULL, '', 0, '2019-04-05 23:26:53', '2019-06-27 14:29:04', NULL),
(32, 'Motilal Nehru Public School', '<p>Hello</p>', 1, 'Admin', 'SiteAdmin', '0', 0, NULL, '', '', 0, '2019-04-02 15:38:17', '2019-06-26 03:31:48', NULL),
(33, 'Test', '<p>Test</p>', 1, 'Organization', 'Teacher', '1', 0, NULL, NULL, NULL, 0, '2019-04-02 15:40:37', '2019-04-06 01:26:09', NULL),
(31, 'Hello', '<p>Hello</p><p><br></p>', 1, 'Admin', 'Superadmin', '0', 0, NULL, '', NULL, 0, '2019-04-02 15:36:43', '2019-04-06 01:25:19', NULL),
(30, 'New Message', '<p>My new Message</p>', 1, 'Organization', 'Admin', '3', 0, NULL, NULL, NULL, 0, '2019-04-02 14:37:44', '2019-04-06 01:30:11', NULL),
(35, 'Greetings', '<p>Hi Students,</p><p>&nbsp;Welcome to our organization.</p><p>Regards,</p><p>Aakash</p>', 66, 'Organization', 'Student', '19', 0, NULL, NULL, '', 0, '2019-04-06 01:40:43', '2019-04-11 00:45:42', NULL),
(36, 'For teachers', '<p>Hi,</p><p><br></p><p>Testing teachers.</p><p>Regards</p>', 66, 'Organization', 'Teacher', '19', 0, NULL, NULL, NULL, 0, '2019-04-07 09:55:20', '2019-04-07 09:55:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `message_counters`
--

CREATE TABLE `message_counters` (
  `id` int(10) UNSIGNED NOT NULL,
  `unread` int(11) NOT NULL DEFAULT '0',
  `read` int(11) NOT NULL DEFAULT '0',
  `total` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `message_counters`
--

INSERT INTO `message_counters` (`id`, `unread`, `read`, `total`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, -1, 1, 0, 1, '2019-01-09 13:17:46', '2019-04-02 17:01:44', NULL),
(24, 1, 0, 1, 84, '2019-04-02 13:15:26', '2019-04-07 09:55:20', NULL),
(23, 1, 0, 1, 83, '2019-04-02 13:13:50', '2019-04-07 09:55:20', NULL),
(22, 1, 0, 1, 82, '2019-04-02 13:12:07', '2019-04-06 01:40:43', NULL),
(21, 1, 0, 1, 81, '2019-04-02 13:09:53', '2019-04-06 01:40:43', NULL),
(20, 0, 0, 0, 79, '2019-04-02 10:00:22', '2019-04-02 10:00:22', NULL),
(19, 0, 0, 0, 71, '2019-03-21 08:32:46', '2019-03-21 08:32:46', NULL),
(18, 0, 0, 0, 67, '2019-03-18 00:24:42', '2019-03-18 00:24:42', NULL),
(17, -4, 4, 0, 66, '2019-03-18 00:20:14', '2019-04-07 09:54:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0000_00_00_000000_create_taggable_table', 1),
(2, '2014_10_11_100002_create_users_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2015_09_11_130834_create_medialibrary_categories_table', 1),
(5, '2015_09_11_130835_create_medialibrary_files_table', 1),
(6, '2015_09_11_130836_create_medialibrary_transformations_table', 1),
(7, '2015_09_11_130837_create_medialibrary_attachable_table', 1),
(8, '2015_11_26_000003_renamed_hidden_to_is_hidden_medialibrary_files_table', 1),
(9, '2016_02_11_000001_add_group_medialibrary_files_table', 1),
(10, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(11, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(12, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(13, '2016_06_01_000004_create_oauth_clients_table', 1),
(14, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(15, '2016_09_02_153301_create_love_likes_table', 1),
(16, '2016_09_02_163301_create_love_like_counters_table', 1),
(17, '2018_04_23_000001_create_medialibrary_attachable_index', 1),
(18, '2018_04_23_000002_create_permission_tables', 1),
(19, '2018_04_23_000003_create_activity_log_table', 1),
(20, '2018_06_09_194552_create_plans_table', 1),
(21, '2018_06_09_194553_create_sponsors_table', 1),
(22, '2018_06_09_194554_create_organizations_table', 1),
(23, '2018_06_09_194555_create_departments_table', 1),
(24, '2018_06_09_194556_create_programs_table', 1),
(25, '2018_06_09_194557_create_grades_table', 1),
(26, '2018_06_09_194558_create_subgrades_table', 1),
(27, '2018_06_09_194559_create_subjects_table', 1),
(28, '2018_06_09_194560_create_chapters_table', 1),
(29, '2018_06_09_194561_create_sections_table', 1),
(30, '2018_06_11_095810_create_introductions_table', 1),
(31, '2018_06_12_163528_create_topics_table', 1),
(32, '2018_06_12_184035_create_texts_table', 1),
(33, '2018_06_12_184230_create_videos_table', 1),
(34, '2018_06_12_184301_create_videourls_table', 1),
(35, '2018_06_24_115758_create_documents_table', 1),
(36, '2018_07_03_094114_create_media_table', 1),
(37, '2018_10_07_180227_create_ratings_table', 1),
(38, '2018_10_07_180248_create_tags_table', 1),
(39, '2018_10_25_035251_create_events_table', 1),
(40, '2018_11_04_142743_create_classroom_assigned_subjects_table', 1),
(41, '2018_11_07_185715_create_exams_table', 1),
(42, '2018_11_07_185716_create_question_groups_table', 1),
(43, '2018_11_08_171138_create_classroom_assigned_users_table', 1),
(44, '2018_11_11_073754_create_questions_table', 1),
(45, '2018_11_11_112100_create_options_table', 1),
(46, '2018_11_11_115118_create_text_answers_table', 1),
(64, '2019_02_28_010604_create_comments_table', 8),
(48, '2018_11_30_175055_create_exam_organizers_table', 1),
(49, '2018_12_05_081907_create_exam_appearances_table', 1),
(50, '2018_12_05_101217_create_student_answers_table', 1),
(51, '2018_12_09_010253_create_results_table', 1),
(52, '2018_12_09_014647_create_individual_results_table', 1),
(53, '2018_12_18_001553_create_question_sets_table', 2),
(54, '2018_12_24_000359_create_messages_table', 3),
(55, '2018_12_25_022930_create_message_counters_table', 4),
(56, '2019_02_16_181910_create_registered_users_table', 5),
(57, '2019_02_22_051524_create_notifications_table', 6),
(58, '2018_07_22_000100_create_love_reacters_table', 7),
(59, '2018_07_22_001000_create_love_reactants_table', 7),
(60, '2018_07_22_001500_create_love_reaction_types_table', 7),
(61, '2018_07_22_002000_create_love_reactions_table', 7),
(62, '2018_07_25_000000_create_love_reactant_reaction_counters_table', 7),
(63, '2018_07_25_001000_create_love_reactant_reaction_totals_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\User', 1),
(2, 'App\\User', 66),
(2, 'App\\User', 67),
(3, 'App\\User', 68),
(3, 'App\\User', 73),
(3, 'App\\User', 87),
(3, 'App\\User', 89),
(5, 'App\\User', 69),
(5, 'App\\User', 70),
(5, 'App\\User', 72),
(5, 'App\\User', 74),
(5, 'App\\User', 75),
(5, 'App\\User', 76),
(5, 'App\\User', 77),
(5, 'App\\User', 78),
(5, 'App\\User', 80),
(5, 'App\\User', 88),
(5, 'App\\User', 90),
(7, 'App\\User', 71),
(7, 'App\\User', 83),
(7, 'App\\User', 84),
(7, 'App\\User', 86),
(8, 'App\\User', 79),
(8, 'App\\User', 81),
(8, 'App\\User', 82),
(8, 'App\\User', 85);

-- --------------------------------------------------------

--
-- Table structure for table `notices`
--

CREATE TABLE `notices` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subgrade_id` int(10) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notices`
--

INSERT INTO `notices` (`id`, `title`, `body`, `subgrade_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(7, 'New Notice', 'New notice details', 2, NULL, '2019-04-02 10:04:17', '2019-04-02 10:04:17');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('bf638229-8cbf-42bc-810c-1cf439f4a295', 'App\\Notifications\\NewUserRegistered', 'App\\User', 66, '{"data":"Registration Successfull, Your password is : Gfns5ryz"}', '2019-03-18 00:30:43', '2019-03-18 00:20:19', '2019-03-18 00:30:43'),
('7a65eb45-beb4-40a9-80e5-6648dcb7ba01', 'App\\Notifications\\NewUserRegistered', 'App\\User', 67, '{"data":"Registration Successfull, Your password is : PF10Bxha"}', NULL, '2019-03-18 00:24:45', '2019-03-18 00:24:45'),
('192a05eb-248b-4b50-a23c-d08bbc295a1a', 'App\\Notifications\\MessageNotification', 'App\\User', 69, '{"data":"New classroom added For grade Grade 1"}', NULL, '2019-03-18 19:12:09', '2019-03-18 19:12:09'),
('92c69b91-34a5-4dc1-a484-f8c6479fbd1a', 'App\\Notifications\\MessageNotification', 'App\\User', 69, '{"data":"New classroom added For grade Grade 1"}', NULL, '2019-03-18 19:12:18', '2019-03-18 19:12:18'),
('7442cf55-a06f-48f0-b431-2e9f8599fb7f', 'App\\Notifications\\MessageNotification', 'App\\User', 69, '{"data":"New classroom added For grade Grade 1"}', NULL, '2019-03-18 19:12:25', '2019-03-18 19:12:25'),
('087ce7e5-7012-409f-97f7-1b483da320cb', 'App\\Notifications\\MessageNotification', 'App\\User', 70, '{"data":"New classroom added For grade 1st year"}', NULL, '2019-03-19 13:16:38', '2019-03-19 13:16:38'),
('4af0f091-9e9d-4fce-9997-49c1539d7b2b', 'App\\Notifications\\MessageNotification', 'App\\User', 70, '{"data":"New classroom added For grade 1st year"}', NULL, '2019-03-19 13:16:55', '2019-03-19 13:16:55'),
('d0a83a42-100b-42a9-b8e8-c6ff8af9f4cb', 'App\\Notifications\\NewUserRegistered', 'App\\User', 71, '{"data":"Registration Successfull, Your password is : FayFOQ7V"}', '2019-04-02 00:27:44', '2019-03-21 08:32:51', '2019-04-02 00:27:44'),
('a164944d-375d-4763-8110-7a763c1d4cc8', 'App\\Notifications\\MessageNotification', 'App\\User', 1, '{"data":"New Plan added Small Plan"}', '2019-04-04 04:05:50', '2019-03-24 09:33:13', '2019-04-04 04:05:50'),
('9379986e-6936-43e3-ad1a-8048f0394f50', 'App\\Notifications\\MessageNotification', 'App\\User', 66, '{"data":"New Plan added Small Plan"}', '2019-03-24 09:33:57', '2019-03-24 09:33:13', '2019-03-24 09:33:57'),
('08a81247-2937-43a8-ab15-79181f14d335', 'App\\Notifications\\MessageNotification', 'App\\User', 67, '{"data":"New Plan added Small Plan"}', NULL, '2019-03-24 09:33:13', '2019-03-24 09:33:13'),
('904b2bac-43aa-4f07-ad0d-6a2607de7872', 'App\\Notifications\\MessageNotification', 'App\\User', 1, '{"data":"New Sponsor added Anjali Group"}', '2019-04-04 04:05:51', '2019-03-29 06:35:21', '2019-04-04 04:05:51'),
('cd3a4220-1cb3-4f7a-9069-aaab998171ee', 'App\\Notifications\\MessageNotification', 'App\\User', 66, '{"data":"New Sponsor added Anjali Group"}', NULL, '2019-03-29 06:35:21', '2019-03-29 06:35:21'),
('6c23be94-9b36-4c08-aa0b-67ebfd1fa965', 'App\\Notifications\\MessageNotification', 'App\\User', 67, '{"data":"New Sponsor added Anjali Group"}', '2019-06-26 03:31:26', '2019-03-29 06:35:21', '2019-06-26 03:31:26'),
('78190be7-ca87-496a-80b8-f6de4d047461', 'App\\Notifications\\NewUserRegistered', 'App\\User', 73, '{"data":"Sponsor has been created, You are the Super admin User."}', NULL, '2019-03-29 06:35:25', '2019-03-29 06:35:25'),
('4a243d9e-de07-4339-b8d8-fdac161ab831', 'App\\Notifications\\MessageNotification', 'App\\User', 73, '{"data":"New Organization added For Sponsor Anjali Group"}', NULL, '2019-04-02 09:42:46', '2019-04-02 09:42:46'),
('ea50a476-a269-411a-8fa0-f09ab89084d2', 'App\\Notifications\\MessageNotification', 'App\\User', 1, '{"data":"New Organization added For Sponsor Anjali Group"}', '2019-04-04 04:05:47', '2019-04-02 09:42:46', '2019-04-04 04:05:47'),
('6405e49d-1fa3-42ec-b713-604a75078ae0', 'App\\Notifications\\MessageNotification', 'App\\User', 66, '{"data":"New Organization added For Sponsor Anjali Group"}', NULL, '2019-04-02 09:42:46', '2019-04-02 09:42:46'),
('1b748e58-a5b5-47d7-890e-10ff6e4f8539', 'App\\Notifications\\MessageNotification', 'App\\User', 67, '{"data":"New Organization added For Sponsor Anjali Group"}', '2019-06-26 03:31:26', '2019-04-02 09:42:46', '2019-06-26 03:31:26'),
('9e2c59ae-2a7f-49a5-97c2-9a760f53ac2a', 'App\\Notifications\\MessageNotification', 'App\\User', 73, '{"data":"New Organization added For Sponsor Anjali Group"}', NULL, '2019-04-02 09:45:52', '2019-04-02 09:45:52'),
('cdcbddac-2234-4d34-8709-4cec5fa99646', 'App\\Notifications\\MessageNotification', 'App\\User', 1, '{"data":"New Organization added For Sponsor Anjali Group"}', '2019-04-04 04:05:53', '2019-04-02 09:45:52', '2019-04-04 04:05:53'),
('2031d63c-e200-4e25-9755-9f63dd1b2a8a', 'App\\Notifications\\MessageNotification', 'App\\User', 66, '{"data":"New Organization added For Sponsor Anjali Group"}', NULL, '2019-04-02 09:45:52', '2019-04-02 09:45:52'),
('942a95e0-9c28-416c-b961-fe8e3238f772', 'App\\Notifications\\MessageNotification', 'App\\User', 67, '{"data":"New Organization added For Sponsor Anjali Group"}', '2019-06-26 03:31:25', '2019-04-02 09:45:52', '2019-06-26 03:31:25'),
('9d06de14-7a08-4ef2-a127-d33b38d735a8', 'App\\Notifications\\MessageNotification', 'App\\User', 73, '{"data":"New Organization added For Sponsor Anjali Group"}', NULL, '2019-04-02 09:46:29', '2019-04-02 09:46:29'),
('5a47b6b9-6453-4840-bc93-45665d49c286', 'App\\Notifications\\MessageNotification', 'App\\User', 1, '{"data":"New Organization added For Sponsor Anjali Group"}', '2019-04-04 04:05:46', '2019-04-02 09:46:29', '2019-04-04 04:05:46'),
('f7457233-85b4-454c-927a-df149457b746', 'App\\Notifications\\MessageNotification', 'App\\User', 66, '{"data":"New Organization added For Sponsor Anjali Group"}', NULL, '2019-04-02 09:46:29', '2019-04-02 09:46:29'),
('3c43e0fe-716c-464c-a394-b5b0b2c4a38a', 'App\\Notifications\\MessageNotification', 'App\\User', 67, '{"data":"New Organization added For Sponsor Anjali Group"}', '2019-06-26 03:31:25', '2019-04-02 09:46:29', '2019-06-26 03:31:25'),
('f49085b1-fb9d-4d5e-b426-0d5bcb019277', 'App\\Notifications\\NewUserRegistered', 'App\\User', 77, '{"data":"Organization has been added, You are the Super admin User."}', NULL, '2019-04-02 09:46:33', '2019-04-02 09:46:33'),
('befec55d-44eb-4b89-8b6f-04d4eeab594c', 'App\\Notifications\\MessageNotification', 'App\\User', 73, '{"data":"New Organization added For Sponsor Anjali Group"}', NULL, '2019-04-02 10:00:04', '2019-04-02 10:00:04'),
('cbc6e66d-5fe0-41f1-ae2c-ac81cab48b9b', 'App\\Notifications\\MessageNotification', 'App\\User', 1, '{"data":"New Organization added For Sponsor Anjali Group"}', '2019-04-04 04:33:42', '2019-04-02 10:00:04', '2019-04-04 04:33:42'),
('ec6be50a-c913-43d5-8e24-02b0fe165156', 'App\\Notifications\\MessageNotification', 'App\\User', 66, '{"data":"New Organization added For Sponsor Anjali Group"}', NULL, '2019-04-02 10:00:04', '2019-04-02 10:00:04'),
('e283ea08-ec0c-4dfb-ad60-cda96500c0a2', 'App\\Notifications\\MessageNotification', 'App\\User', 67, '{"data":"New Organization added For Sponsor Anjali Group"}', '2019-06-26 03:31:24', '2019-04-02 10:00:04', '2019-06-26 03:31:24'),
('0c21d60f-f8d8-44c8-b900-da2d9759aa9b', 'App\\Notifications\\NewUserRegistered', 'App\\User', 78, '{"data":"Organization has been added, You are the Super admin User."}', NULL, '2019-04-02 10:00:08', '2019-04-02 10:00:08'),
('e414df76-9f26-414b-aeba-2df6fc6a0e74', 'App\\Notifications\\NewUserRegistered', 'App\\User', 79, '{"data":"Registration Successfull, Your password is : WfwOWwzf"}', NULL, '2019-04-02 10:00:25', '2019-04-02 10:00:25'),
('974d9704-256c-41d8-ba3a-1077fcce453f', 'App\\Notifications\\MessageNotification', 'App\\User', 69, '{"data":"New classroom added For grade Grade 1"}', NULL, '2019-04-02 11:10:29', '2019-04-02 11:10:29'),
('1c45ec4b-182a-439b-960f-2f26e0e6256a', 'App\\Notifications\\MessageNotification', 'App\\User', 69, '{"data":"New classroom added For grade Grade 1"}', NULL, '2019-04-02 11:39:00', '2019-04-02 11:39:00'),
('8e1ec79a-64f9-442f-8f50-56a02c4ab785', 'App\\Notifications\\MessageNotification', 'App\\User', 69, '{"data":"New classroom added For grade Grade 1"}', NULL, '2019-04-02 12:01:51', '2019-04-02 12:01:51'),
('d36fb660-4988-4e56-9337-57ef4175dd33', 'App\\Notifications\\MessageNotification', 'App\\User', 69, '{"data":"New classroom added For grade Grade 1"}', NULL, '2019-04-02 12:27:53', '2019-04-02 12:27:53'),
('0bcac2db-7b48-4170-839a-b20f587943db', 'App\\Notifications\\MessageNotification', 'App\\User', 73, '{"data":"New Organization added For Sponsor Anjali Group"}', NULL, '2019-04-02 12:49:39', '2019-04-02 12:49:39'),
('e6936588-ebc0-4eb7-9560-752fd83c83e3', 'App\\Notifications\\MessageNotification', 'App\\User', 1, '{"data":"New Organization added For Sponsor Anjali Group"}', '2019-04-04 04:05:44', '2019-04-02 12:49:39', '2019-04-04 04:05:44'),
('7473fde1-5b72-47c9-975e-510187de79cd', 'App\\Notifications\\MessageNotification', 'App\\User', 66, '{"data":"New Organization added For Sponsor Anjali Group"}', NULL, '2019-04-02 12:49:39', '2019-04-02 12:49:39'),
('18e7b7b9-9f12-41ce-a941-20f7fa618f18', 'App\\Notifications\\MessageNotification', 'App\\User', 67, '{"data":"New Organization added For Sponsor Anjali Group"}', '2019-06-26 03:31:24', '2019-04-02 12:49:39', '2019-06-26 03:31:24'),
('58716b06-835b-4952-b979-b8cdc011decb', 'App\\Notifications\\NewUserRegistered', 'App\\User', 80, '{"data":"Organization has been added, You are the Super admin User."}', NULL, '2019-04-02 12:49:43', '2019-04-02 12:49:43'),
('a3dd82a7-c36f-4b20-9c80-5bcd054231d6', 'App\\Notifications\\MessageNotification', 'App\\User', 80, '{"data":"New classroom added For grade CLass 2"}', NULL, '2019-04-02 12:51:42', '2019-04-02 12:51:42'),
('90aa3743-35df-4fed-adb5-296f5a7a7736', 'App\\Notifications\\NewUserRegistered', 'App\\User', 81, '{"data":"Registration Successfull, Your password is : c55CM99E"}', NULL, '2019-04-02 13:09:57', '2019-04-02 13:09:57'),
('c6a5dc2c-2787-4655-83f9-e91ce304b0f4', 'App\\Notifications\\NewUserRegistered', 'App\\User', 82, '{"data":"Registration Successfull, Your password is : ZkpCVFO7"}', NULL, '2019-04-02 13:12:10', '2019-04-02 13:12:10'),
('87f7e72b-4e8b-42c3-af07-c643220d5b61', 'App\\Notifications\\NewUserRegistered', 'App\\User', 83, '{"data":"Registration Successfull, Your password is : 5QQmtqdB"}', NULL, '2019-04-02 13:13:54', '2019-04-02 13:13:54'),
('28d122e9-ccd0-47dc-85fe-813bb74a3b88', 'App\\Notifications\\NewUserRegistered', 'App\\User', 84, '{"data":"Registration Successfull, Your password is : Dm3kVEOp"}', NULL, '2019-04-02 13:15:29', '2019-04-02 13:15:29'),
('7742c6e8-fa11-45bb-80ff-4d1cb38f2b9f', 'App\\Notifications\\NewUserRegistered', 'App\\User', 85, '{"data":"Registration Successfull"}', NULL, '2019-04-08 08:29:36', '2019-04-08 08:29:36'),
('e1deb608-05e2-4b05-8028-5eb6a22a7494', 'App\\Notifications\\NewUserRegistered', 'App\\User', 86, '{"data":"Registration Successfull"}', NULL, '2019-04-08 08:33:06', '2019-04-08 08:33:06'),
('7df590bd-4553-420a-bd2b-676661cfdc88', 'App\\Notifications\\MessageNotification', 'App\\User', 1, '{"data":"New Sponsor added Sikhya Vikaas Samiti"}', '2019-04-15 16:53:05', '2019-04-15 14:24:41', '2019-04-15 16:53:05'),
('3f574060-7297-471c-bb40-4c1b5d740d35', 'App\\Notifications\\MessageNotification', 'App\\User', 66, '{"data":"New Sponsor added Sikhya Vikaas Samiti"}', NULL, '2019-04-15 14:24:41', '2019-04-15 14:24:41'),
('7e5a5830-6c37-43bd-bc52-c797ffdec167', 'App\\Notifications\\MessageNotification', 'App\\User', 67, '{"data":"New Sponsor added Sikhya Vikaas Samiti"}', '2019-06-26 03:31:23', '2019-04-15 14:24:41', '2019-06-26 03:31:23'),
('13ff9cb5-523e-4d0a-b49c-0523ba7b8fc5', 'App\\Notifications\\NewUserRegistered', 'App\\User', 87, '{"data":"Sponsor has been created, You are the Super admin User."}', NULL, '2019-04-15 14:24:45', '2019-04-15 14:24:45'),
('f4ec2659-2b5e-4612-80e1-e9f0644ae959', 'App\\Notifications\\MessageNotification', 'App\\User', 87, '{"data":"New Organization added For Sponsor Sikhya Vikaas Samiti"}', NULL, '2019-04-15 14:31:45', '2019-04-15 14:31:45'),
('b03967c5-0a69-4805-b123-d9aa15291046', 'App\\Notifications\\MessageNotification', 'App\\User', 1, '{"data":"New Organization added For Sponsor Sikhya Vikaas Samiti"}', '2019-04-15 16:53:07', '2019-04-15 14:31:45', '2019-04-15 16:53:07'),
('13077df3-88c8-4bf2-8780-6835fc6fab15', 'App\\Notifications\\MessageNotification', 'App\\User', 66, '{"data":"New Organization added For Sponsor Sikhya Vikaas Samiti"}', NULL, '2019-04-15 14:31:45', '2019-04-15 14:31:45'),
('00f4ec3c-f55c-4f99-88d2-edb55fba7c6a', 'App\\Notifications\\MessageNotification', 'App\\User', 67, '{"data":"New Organization added For Sponsor Sikhya Vikaas Samiti"}', '2019-06-26 03:31:22', '2019-04-15 14:31:45', '2019-06-26 03:31:22'),
('d8365a56-84e6-44c5-870d-37e322bfaaf0', 'App\\Notifications\\NewUserRegistered', 'App\\User', 88, '{"data":"Organization has been added, You are the Super admin User."}', NULL, '2019-04-15 14:31:49', '2019-04-15 14:31:49'),
('f22ecf0e-533b-4c78-92cf-51d72edc54c6', 'App\\Notifications\\MessageNotification', 'App\\User', 1, '{"data":"New Sponsor added Demo Sponsor"}', NULL, '2019-04-27 08:27:05', '2019-04-27 08:27:05'),
('8c36181d-9743-4d85-968f-5da4093d492f', 'App\\Notifications\\MessageNotification', 'App\\User', 66, '{"data":"New Sponsor added Demo Sponsor"}', NULL, '2019-04-27 08:27:05', '2019-04-27 08:27:05'),
('89c85d66-e667-4649-a822-48270d445ec2', 'App\\Notifications\\MessageNotification', 'App\\User', 67, '{"data":"New Sponsor added Demo Sponsor"}', '2019-06-26 03:31:21', '2019-04-27 08:27:05', '2019-06-26 03:31:21'),
('adf9abdb-0319-46dc-baa4-4557d0838776', 'App\\Notifications\\NewUserRegistered', 'App\\User', 89, '{"data":"Sponsor has been created, You are the Super admin User."}', NULL, '2019-04-27 08:27:09', '2019-04-27 08:27:09'),
('a50b7529-1daf-42a7-9726-ab05bb5ead9e', 'App\\Notifications\\MessageNotification', 'App\\User', 89, '{"data":"New Organization added For Sponsor Demo Sponsor"}', NULL, '2019-04-27 08:29:19', '2019-04-27 08:29:19'),
('b1f30ec5-84bc-4371-be9f-8565a2c368d1', 'App\\Notifications\\MessageNotification', 'App\\User', 1, '{"data":"New Organization added For Sponsor Demo Sponsor"}', NULL, '2019-04-27 08:29:19', '2019-04-27 08:29:19'),
('0b790d47-bc1b-47dc-9bba-348f79ac2a21', 'App\\Notifications\\MessageNotification', 'App\\User', 66, '{"data":"New Organization added For Sponsor Demo Sponsor"}', NULL, '2019-04-27 08:29:19', '2019-04-27 08:29:19'),
('2e2a15b5-ee45-4db4-9cfb-18115ff22f8e', 'App\\Notifications\\MessageNotification', 'App\\User', 67, '{"data":"New Organization added For Sponsor Demo Sponsor"}', '2019-06-26 03:31:20', '2019-04-27 08:29:19', '2019-06-26 03:31:20'),
('73a567c2-c647-4523-a087-bf29204b6c3e', 'App\\Notifications\\NewUserRegistered', 'App\\User', 90, '{"data":"Organization has been added, You are the Super admin User."}', NULL, '2019-04-27 08:29:22', '2019-04-27 08:29:22'),
('d16cdd2f-580b-414b-a6bb-285ae9863176', 'App\\Notifications\\MessageNotification', 'App\\User', 90, '{"data":"New classroom added For grade Grade 7"}', NULL, '2019-04-27 08:30:07', '2019-04-27 08:30:07');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('117c94391b3d59b4e4348539c294f6f216a3a4cefaaa5a4fa211a1f72126737980d754325fbac11f', 1, 3, 'MyApp', '[]', 1, '2019-03-18 00:19:23', '2019-03-18 00:19:23', '2020-03-18 00:19:23'),
('1656ec5ea2a2635932a4d210bc899aa87dfd161d8215f0d3bfe08658435627c2c29cfbe1f9c55c25', 1, 3, 'MyApp', '[]', 1, '2019-03-18 00:21:35', '2019-03-18 00:21:35', '2020-03-18 00:21:35'),
('dc58755720a4b2d4356050ab6a7050f1c5dff616c9d23fa096138f9ae1318409d393149d71906fe2', 66, 3, 'MyApp', '[]', 1, '2019-03-18 00:28:11', '2019-03-18 00:28:11', '2020-03-18 00:28:11'),
('7fee1dcc6a563d585ab7b971a45096882d66a875e0771f99609c9b6621b33d341d9440d50fb55db0', 67, 3, 'MyApp', '[]', 1, '2019-03-18 00:45:15', '2019-03-18 00:45:15', '2020-03-18 00:45:15'),
('3cb5a7ac59cc8d66d0b24ef809d2bbc68890adfae4030228d8eef8ceb6354adc0bfbe62d39e5b283', 67, 3, 'MyApp', '[]', 1, '2019-03-18 15:21:26', '2019-03-18 15:21:26', '2020-03-18 15:21:26'),
('0103fec92800d3918b9509cf25c291bf351d9403c3959c27e4f1a2d783b750d5ecacd96b07f5b724', 67, 3, 'MyApp', '[]', 1, '2019-03-18 16:12:12', '2019-03-18 16:12:12', '2020-03-18 16:12:12'),
('f568b16d42e0d5a0a146670b791232210a63ad0f7bb8288b8873bb3a86778dd46393843751762156', 67, 3, 'MyApp', '[]', 1, '2019-03-18 18:13:30', '2019-03-18 18:13:30', '2020-03-18 18:13:30'),
('c53f83afbe24d39a715f1f886dd0e847f3c90538113cb070d466a82cc0273cc8203dc320570d176d', 67, 3, 'MyApp', '[]', 1, '2019-03-18 18:13:41', '2019-03-18 18:13:41', '2020-03-18 18:13:41'),
('99763418d462174dff07fda86795df9e5252fe2e3e05e14f3221521062932998a759c7fbed0b92f0', 69, 3, 'MyApp', '[]', 1, '2019-03-18 18:18:12', '2019-03-18 18:18:12', '2020-03-18 18:18:12'),
('7cac67b9d083ecd0dcbbd9046719ee7863c920a6f725484237fb97bfe31b218512d2e6b2f5fc599f', 67, 3, 'MyApp', '[]', 1, '2019-03-18 18:35:24', '2019-03-18 18:35:24', '2020-03-18 18:35:24'),
('97b5677c95a07d0e12c7ba64214ef845ed7be0f5fe799a253c0c4cd40b3ec5ad9c256db89b1b44b9', 1, 3, 'MyApp', '[]', 1, '2019-03-18 19:03:17', '2019-03-18 19:03:17', '2020-03-18 19:03:17'),
('bf9d4cd4980ecd1c7d2fba9037fa7a97eb4888cdb200b628b1714732bb135bc1ec1fb22937c35781', 1, 3, 'MyApp', '[]', 1, '2019-03-19 16:40:12', '2019-03-19 16:40:12', '2020-03-19 16:40:12'),
('7dd21773d4521d91d4882088fbc49f26dfe0b05a0bfbbc797840c792c295f294ac254ffb4c8051bc', 66, 3, 'MyApp', '[]', 1, '2019-03-19 18:36:55', '2019-03-19 18:36:55', '2020-03-19 18:36:55'),
('98befa5d6b75296dbfd55e5124a4c675f4ca37740b9dfcbfb9234ab2b7f6a7dd8c368c86a2e43835', 66, 3, 'MyApp', '[]', 1, '2019-03-22 22:55:44', '2019-03-22 22:55:44', '2020-03-22 22:55:44'),
('3d90736d936b758a089e5658b76318af57164a9423a6fbcd4d361a8aa9bdf11fabbc43b936c4c826', 1, 3, 'MyApp', '[]', 1, '2019-03-24 09:21:00', '2019-03-24 09:21:00', '2020-03-24 09:21:00'),
('42bac968be1e074073820d5aecdb95003ef84a798e58c3d2b8b4b5a49a4053e50632bd9ba0558b8a', 1, 3, 'MyApp', '[]', 1, '2019-03-24 20:36:05', '2019-03-24 20:36:05', '2020-03-24 20:36:05'),
('9153fd540806e1bf53bf12ee05ef5092774926713b3883d126d80de20272fdb0038569b479300275', 1, 3, 'MyApp', '[]', 1, '2019-03-24 21:15:05', '2019-03-24 21:15:05', '2020-03-24 21:15:05'),
('b8294f400370ec49797974b76e042e59fec00a939df0026e27e65d5a39f8ef3776784138536a8856', 1, 3, 'MyApp', '[]', 1, '2019-03-30 02:14:07', '2019-03-30 02:14:07', '2020-03-30 02:14:07'),
('f24d0d53d3e12e4915e2ccb50cfb26a9ff11eda9f0a34509072ab3fe63d8b789c5e75125914f3005', 70, 3, 'MyApp', '[]', 1, '2019-03-30 15:51:19', '2019-03-30 15:51:19', '2020-03-30 15:51:19'),
('5700a35c5e6ba81614bddb28edcd0aa29d881858b1c82e56d51ad9d13df2f70850b80c5c19d1f878', 1, 3, 'MyApp', '[]', 1, '2019-03-30 19:24:04', '2019-03-30 19:24:04', '2020-03-30 19:24:04'),
('04f7be27184224a75a61943e73b17ca3d7bb53b0bb186488ff1d92871b29180d77cfe0a0fb04f511', 70, 3, 'MyApp', '[]', 1, '2019-03-31 17:08:28', '2019-03-31 17:08:28', '2020-03-31 17:08:28'),
('519b0df389171f1a50092535d67d7303343aadc6b47f5fd59d40e2b7e82e576a050e8cf8f68d754e', 71, 3, 'MyApp', '[]', 1, '2019-03-31 17:24:34', '2019-03-31 17:24:34', '2020-03-31 17:24:34'),
('afe081d62cfe532c163e44d4e2901520fc93ab5b3120b56e57126067a171b5701d043eb0a97b260d', 1, 3, 'MyApp', '[]', 1, '2019-03-31 17:47:47', '2019-03-31 17:47:47', '2020-03-31 17:47:47'),
('7f73795d9a55df9d101f886b3d429460718c4145be799a3f9cec4c0ce2c51670b7ec48f46b00eef6', 66, 3, 'MyApp', '[]', 1, '2019-03-31 23:42:03', '2019-03-31 23:42:03', '2020-03-31 23:42:03'),
('fdf6fc96c99643e78e96f7889352a795db8d8adeffd2a5b9ee09210a5a4d49b5b5fa156ff9d60934', 1, 3, 'MyApp', '[]', 1, '2019-04-01 13:41:27', '2019-04-01 13:41:27', '2020-04-01 13:41:27'),
('07c3cba788c2a570740192681257d74417aa866cd25b38804337f693a51fe708c1d88d9dc2f97bb0', 1, 3, 'MyApp', '[]', 1, '2019-04-01 14:02:39', '2019-04-01 14:02:39', '2020-04-01 14:02:39'),
('a35f034b0d9975c3d82b8cb592bfa072931c21fd332a4b4b5489450537b0d1f2a64013840600a791', 1, 3, 'MyApp', '[]', 1, '2019-04-02 00:35:14', '2019-04-02 00:35:14', '2020-04-02 00:35:14'),
('bdf3d3dbfd5ed9ff2c8b57b4c9157aeb49896a73333f57fb602562870e66da4e941e70b55e595f3f', 1, 3, 'MyApp', '[]', 1, '2019-04-02 00:42:58', '2019-04-02 00:42:58', '2020-04-02 00:42:58'),
('7a2e2cd43d628f4d9ab947df55a148e0d2066307bd47939fce1fbfc21f5d23e8bd05b58d6d468739', 1, 3, 'MyApp', '[]', 1, '2019-04-02 00:44:47', '2019-04-02 00:44:47', '2020-04-02 00:44:47'),
('84ab5033cd26911e4d82d80104b85ac6169051640a8bd7b9f0a74ec2970654f3df6fa976d202ed5b', 1, 3, 'MyApp', '[]', 1, '2019-04-02 00:45:38', '2019-04-02 00:45:38', '2020-04-02 00:45:38'),
('210b39ab7b75e6121f461103293d195b02cfa1533cb8e4b035e61187a65507229763a6e88f50f361', 1, 3, 'MyApp', '[]', 1, '2019-04-02 02:30:03', '2019-04-02 02:30:03', '2020-04-02 02:30:03'),
('df5c00942b65955852500484976515efa669cf5fd68f8d02c1420624a7acb17350179b324805cf62', 66, 3, 'MyApp', '[]', 1, '2019-04-02 07:26:49', '2019-04-02 07:26:49', '2020-04-02 07:26:49'),
('206d6d521d1a6137d9409aa6114b66b8c84233d437417d4b845a559051928141f494ed6e2c55ebbe', 73, 3, 'MyApp', '[]', 1, '2019-04-02 07:29:19', '2019-04-02 07:29:19', '2020-04-02 07:29:19'),
('403ae45b92c5ce8831bcb0f582442dea479ed7d5c8b1b5948926fa2d0e03c251576122d1cfb6abca', 78, 3, 'MyApp', '[]', 1, '2019-04-02 10:15:57', '2019-04-02 10:15:57', '2020-04-02 10:15:57'),
('84c013b69bb2e30581ab11dd3876848f818af101414ee5db001020c0cb2cef8275ad5c10cf8500ae', 66, 3, 'MyApp', '[]', 1, '2019-04-02 10:45:52', '2019-04-02 10:45:52', '2020-04-02 10:45:52'),
('31aa4e922c398b2fb8a3836e0253687f86cc31eab0801db5dc894b7f7648ed326eb15f8eff893358', 83, 3, 'MyApp', '[]', 1, '2019-04-02 13:42:04', '2019-04-02 13:42:04', '2020-04-02 13:42:04'),
('bc2160ccce773c22c47acd4eb7a7f22d71fbf744ea9f822c572949cb5ce5b246a2c80f7c8ae11139', 80, 3, 'MyApp', '[]', 1, '2019-04-02 13:59:04', '2019-04-02 13:59:04', '2020-04-02 13:59:04'),
('fa192887db85171cf1aab1ace70951fc7be10a03475e059f66bd077c08760f294bf52a2fcc8d8bc1', 81, 3, 'MyApp', '[]', 1, '2019-04-02 14:07:13', '2019-04-02 14:07:13', '2020-04-02 14:07:13'),
('83eadf13cc44e8f95a7af91acccf6b767a6316fea371aad210fd793c8d42010554cbab0f87b62191', 1, 3, 'MyApp', '[]', 1, '2019-04-02 15:42:33', '2019-04-02 15:42:33', '2020-04-02 15:42:33'),
('b827235ff353b673db9357afc1e60707758a8aebb8139ba55cbcae099cfb689752c19593311c352e', 66, 3, 'MyApp', '[]', 1, '2019-04-02 17:00:50', '2019-04-02 17:00:50', '2020-04-02 17:00:50'),
('4e409c5747760c3002dc5d7c921f97610da999db00e203974eb244edd7a5408a78011092090c4afc', 66, 3, 'MyApp', '[]', 1, '2019-04-02 17:17:22', '2019-04-02 17:17:22', '2020-04-02 17:17:22'),
('55700d9c4f7d4d2b4f4686fe0c43aac1e41c6d2fcb15629ec67b7d348578dadf86eae4b9f084d7e5', 83, 3, 'MyApp', '[]', 1, '2019-04-02 17:34:31', '2019-04-02 17:34:31', '2020-04-02 17:34:31'),
('90d50cefb15b7303d43a7bde5f0422ead8f93841ace2ad61894a5d4bfc457ef30880e41ed3c87838', 81, 3, 'MyApp', '[]', 1, '2019-04-02 18:09:36', '2019-04-02 18:09:36', '2020-04-02 18:09:36'),
('44e1339d1baa2036a497d9b7adddc5b92dae56b1942a8b48356d334d2151375935362d4500a595ac', 1, 3, 'MyApp', '[]', 1, '2019-04-02 18:50:09', '2019-04-02 18:50:09', '2020-04-02 18:50:09'),
('75d923173a0fd6a1de3720522be93992a103ec2a4c2b5b7d8de4ceeb584d43953b70e10f1160ec37', 83, 3, 'MyApp', '[]', 1, '2019-04-02 18:52:55', '2019-04-02 18:52:55', '2020-04-02 18:52:55'),
('68fe062ee28bef61edf955653fae9e823869d0e5f58fa099bebff757d050667f6cb3cfddd36ab31e', 1, 3, 'MyApp', '[]', 1, '2019-04-02 18:59:37', '2019-04-02 18:59:37', '2020-04-02 18:59:37'),
('4cef86659e67b5818d5e9004f62982ccf00e9b7675e77ba6ca3adb59c7435cbebb9a97ad513b5a3b', 66, 3, 'MyApp', '[]', 1, '2019-04-02 19:00:11', '2019-04-02 19:00:11', '2020-04-02 19:00:11'),
('60ca790360cc42b57adc1d2976d6ca1151be78799829d4cc1257d06242487c6ecab50eec3250af7c', 80, 3, 'MyApp', '[]', 1, '2019-04-02 19:02:00', '2019-04-02 19:02:00', '2020-04-02 19:02:00'),
('3bf43a13c64614af4ca78493d4846aca8b09269ec8dde1675682a2cd1bc581502d323a58ce18ebf8', 81, 3, 'MyApp', '[]', 1, '2019-04-02 19:02:57', '2019-04-02 19:02:57', '2020-04-02 19:02:57'),
('a65ae9ce10034e8c2b75ff626e3c4b66697f39a16bc1ba24a253f291293d7bdc7f5953f54761d7bf', 80, 3, 'MyApp', '[]', 1, '2019-04-02 19:07:58', '2019-04-02 19:07:58', '2020-04-02 19:07:58'),
('d83a5bdbd344e9285e6db2e913b124f2573a5bc524c72e909a0dc2710cb028df238ff484fba02b3d', 83, 3, 'MyApp', '[]', 1, '2019-04-02 19:10:36', '2019-04-02 19:10:36', '2020-04-02 19:10:36'),
('69007286eba2005ec812ee7d1942342abac9df646160d41e068a171777d5068baa4026c47e24e686', 66, 3, 'MyApp', '[]', 1, '2019-04-02 19:17:54', '2019-04-02 19:17:54', '2020-04-02 19:17:54'),
('943afad4ca6fce260ff490e90eef483cfdf64ca9755f0f6273016bbf99413883fed9687ed8de00bc', 80, 3, 'MyApp', '[]', 1, '2019-04-02 20:01:51', '2019-04-02 20:01:51', '2020-04-02 20:01:51'),
('127d26509db47662a70391c41a92cb5d6cecd282a6baf50e3d785f77fca161d86ec4a8b1c06bd0c4', 83, 3, 'MyApp', '[]', 1, '2019-04-02 20:02:42', '2019-04-02 20:02:42', '2020-04-02 20:02:42'),
('52c960f488653eb1685b28995e5a03b45ab01c62986ddfa713a0d634eb5abedd43a31b730ccf5389', 80, 3, 'MyApp', '[]', 1, '2019-04-02 20:03:56', '2019-04-02 20:03:56', '2020-04-02 20:03:56'),
('c332c83ba5f3285a6c95f8befa73bf89c9833e8dda0b1ec8a6675139df03b7fbce0be962a485046a', 1, 3, 'MyApp', '[]', 1, '2019-04-02 20:04:58', '2019-04-02 20:04:58', '2020-04-02 20:04:58'),
('a5e7eb454d98c15c73a8820f0c814ee8e4ee2b0afb9cf63554f8ff1fa281a33cadc5dee1292d65aa', 1, 3, 'MyApp', '[]', 1, '2019-04-02 20:09:15', '2019-04-02 20:09:15', '2020-04-02 20:09:15'),
('9980f01dc3b14509eefe1002c02cf16429ec7c5dd9800b2a5eb321d70eebfb598b7bbfd63f014c35', 1, 3, 'MyApp', '[]', 1, '2019-04-02 20:11:51', '2019-04-02 20:11:51', '2020-04-02 20:11:51'),
('076128ca7f3c07447362be473ae613516deb96927b0e2c251c38af17d89a982e567b56cc7b3611e2', 66, 3, 'MyApp', '[]', 1, '2019-04-02 20:12:15', '2019-04-02 20:12:15', '2020-04-02 20:12:15'),
('20d583d56d9d8aba34273c868cd9899d4cba1a5bc228a04be56fb76213692efede7bba57971fb69a', 1, 3, 'MyApp', '[]', 1, '2019-04-02 20:13:00', '2019-04-02 20:13:00', '2020-04-02 20:13:00'),
('196e194b6101d351c70c1f6d0e9c2ebfeebd41672c18a81e33c8940f9cd07477836ce6c8a48f4c00', 1, 3, 'MyApp', '[]', 1, '2019-04-02 20:40:48', '2019-04-02 20:40:48', '2020-04-02 20:40:48'),
('1f2430d47305f706d9eaa7634e101e6f2a36026fc7a633acb5d791f155fb2c890dc5f71478454ee2', 81, 3, 'MyApp', '[]', 1, '2019-04-02 20:56:05', '2019-04-02 20:56:05', '2020-04-02 20:56:05'),
('870388efc084dff072cc6be714dbe4964884711b883a732006d78b71f384fe5ef1deeaea3cb1bd1b', 1, 3, 'MyApp', '[]', 1, '2019-04-02 20:57:38', '2019-04-02 20:57:38', '2020-04-02 20:57:38'),
('516ace10a025b9f4229ddf62447fd6de6f2d14677efecc8c91a1b2765ad507113fca394b1306b2e9', 1, 3, 'MyApp', '[]', 1, '2019-04-03 20:06:04', '2019-04-03 20:06:04', '2020-04-03 20:06:04'),
('8841d77c6cc401d3dd2dc314da9f828e279bf240148bea79f2e92d3d291b40be440147e45e11f2ac', 1, 3, 'MyApp', '[]', 1, '2019-04-04 01:04:06', '2019-04-04 01:04:06', '2020-04-04 01:04:06'),
('d8fb80f5fbc5cba7114b4dd0318f8e965a67363956c3f63a0761b41408a40ddde15a71e518e2ae73', 66, 3, 'MyApp', '[]', 1, '2019-04-04 02:55:23', '2019-04-04 02:55:23', '2020-04-04 02:55:23'),
('8d4ecf760f14a6e017cbf745d97baf4bf41cc49c44cba81cc7e23988b72c78284e29516fc0079fdc', 1, 3, 'MyApp', '[]', 1, '2019-04-04 02:59:51', '2019-04-04 02:59:51', '2020-04-04 02:59:51'),
('449c1bbc478c6d96a4920e8f9ab0ad0252a8e0450f7250aeca504d3a40c1e74cba7c772369b0a5af', 1, 3, 'MyApp', '[]', 1, '2019-04-04 03:40:25', '2019-04-04 03:40:25', '2020-04-04 03:40:25'),
('da2e51e5773d3a23ebcecba433fc59e82c111538b9f50af9711a312f6cc83ced43e7c7e569be5a74', 1, 3, 'MyApp', '[]', 1, '2019-04-04 03:44:06', '2019-04-04 03:44:06', '2020-04-04 03:44:06'),
('2952b59c32658537124508fc40ded7b5ba2ab37fdd750ff6d459b50b785866724a5553a1097ec750', 66, 3, 'MyApp', '[]', 1, '2019-04-04 08:37:15', '2019-04-04 08:37:15', '2020-04-04 08:37:15'),
('04fe24acc34ec9d2e0f5eeb2cda065476d0d17e501295dbe51e9c8e31dd2910d7e17482d14b07132', 1, 3, 'MyApp', '[]', 1, '2019-04-04 11:12:20', '2019-04-04 11:12:20', '2020-04-04 11:12:20'),
('c3825757a91fb9540fceea9363bcbeb61ef72c082714404fac3ec47541e39759d4c8828788971d05', 1, 3, 'MyApp', '[]', 1, '2019-04-04 17:10:30', '2019-04-04 17:10:30', '2020-04-04 17:10:30'),
('7f6e06ed3a72dafb528ba01c470f0c0e1bd79016dc489a9c635ce22883f24dd1856d4a34c31f2dc4', 1, 3, 'MyApp', '[]', 1, '2019-04-05 01:11:26', '2019-04-05 01:11:26', '2020-04-05 01:11:26'),
('570d744e40603c7245aa79b308976f38cbed2a0555a03090bab04f96d5b3df0fdf2645644142c68e', 66, 3, 'MyApp', '[]', 1, '2019-04-05 05:06:19', '2019-04-05 05:06:19', '2020-04-05 05:06:19'),
('5f6c27e65c790c139892be68a1ca31ddf3008d5195090a768a9f61d6b8e770272fdb0a67584a8070', 73, 3, 'MyApp', '[]', 1, '2019-04-05 07:24:02', '2019-04-05 07:24:02', '2020-04-05 07:24:02'),
('cfc1315b4e36cc2759a3d4bc319e61cfcc06a661224365bf808bc5103b19546519c6cc0e9040ab0a', 81, 3, 'MyApp', '[]', 1, '2019-04-05 07:28:00', '2019-04-05 07:28:00', '2020-04-05 07:28:00'),
('e3a4a8d978fbced218eebd79ab8057789156745c0790162d2a72b7c6da0d7fad30b35175e5560105', 66, 3, 'MyApp', '[]', 1, '2019-04-05 08:33:34', '2019-04-05 08:33:34', '2020-04-05 08:33:34'),
('f98edcbacabf34cd0604143fef9a5ea15019d71e7e12e76a92ba7b61e20011267853f04761962bdb', 1, 3, 'MyApp', '[]', 1, '2019-04-05 10:09:24', '2019-04-05 10:09:24', '2020-04-05 10:09:24'),
('59195e09e9c84223d9f44e04333f7fe7247d2c4dec2cba01599d1d888520f2e6d015385abcd92fb3', 1, 3, 'MyApp', '[]', 1, '2019-04-05 12:38:38', '2019-04-05 12:38:38', '2020-04-05 12:38:38'),
('028d99969ffae76e320872bc70b99c46ab1ecb17e32d6978e112dccd3a573c672c53b69c0da84861', 1, 3, 'MyApp', '[]', 1, '2019-04-05 13:16:34', '2019-04-05 13:16:34', '2020-04-05 13:16:34'),
('36ec95866b00f9414c4e84862cfa602dab5c86f30e0d7a3c46085071b661ed017fa0d15dc0406f1b', 71, 3, 'MyApp', '[]', 1, '2019-04-07 11:20:54', '2019-04-07 11:20:54', '2020-04-07 11:20:54'),
('2bfa72312bb2ee84a62b11c8bde1e330c0c5be6fe747a8d25c6549dd8709c3bb85685022c831357e', 1, 3, 'MyApp', '[]', 1, '2019-04-07 11:33:17', '2019-04-07 11:33:17', '2020-04-07 11:33:17'),
('cc81518137656f66476f4091532a7538f4a541f1f884383f5199c2cc93d15e5ab657878711da877e', 71, 3, 'MyApp', '[]', 1, '2019-04-07 14:39:00', '2019-04-07 14:39:00', '2020-04-07 14:39:00'),
('8ce3092f9bf8a3fdbb09736550a05679a3b7a6400b0cbaa6e35486fe345b745dd1aa59e50d3c4372', 1, 3, 'MyApp', '[]', 1, '2019-04-07 14:39:21', '2019-04-07 14:39:21', '2020-04-07 14:39:21'),
('46190df37b41e7104539bc539796fa392e1b57c87465ba3776e4cd4dd71ef40c4577df3f56682b22', 71, 3, 'MyApp', '[]', 1, '2019-04-07 16:52:49', '2019-04-07 16:52:49', '2020-04-07 16:52:49'),
('700044b0b8606dd1ad4107ee18c668bef528d3fe5fba8aed2a47d5386e7ae84d127cc759004f7ce3', 1, 3, 'MyApp', '[]', 1, '2019-04-08 01:15:21', '2019-04-08 01:15:21', '2020-04-08 01:15:21'),
('afe3a6b35ee521d1ad36ec3d37660976fede8dd7767dd20ae69c507fc0229137040dea3e28fc846e', 71, 3, 'MyApp', '[]', 1, '2019-04-08 01:16:45', '2019-04-08 01:16:45', '2020-04-08 01:16:45'),
('ec48de1d557dee1015b3360e65d5af0dd43b9afc5347b3a0350b1a190567f620c8c9ad681d758644', 80, 3, 'MyApp', '[]', 1, '2019-04-08 08:34:28', '2019-04-08 08:34:28', '2020-04-08 08:34:28'),
('e5b3d9966c3ca2db8f6aac3e93b005e5457664e72b5ca60aab14d104004c881625a0502d0c097531', 71, 3, 'MyApp', '[]', 1, '2019-04-08 10:03:03', '2019-04-08 10:03:03', '2020-04-08 10:03:03'),
('587be07002703e1d4a9e4b145ffbf637b0628ac8e9a40b2091b71eba79407cafba255c829c6131ac', 71, 3, 'MyApp', '[]', 1, '2019-04-08 12:42:35', '2019-04-08 12:42:35', '2020-04-08 12:42:35'),
('c1d4a3546e6915bcffb5e505b95a6e608f5e62b6d32ffff00653c74e274235317a4108c6a0ba498b', 71, 3, 'MyApp', '[]', 1, '2019-04-09 04:54:38', '2019-04-09 04:54:38', '2020-04-09 04:54:38'),
('5eae2c9d586f0b27e47b20c01611c3e2741d07a35f5ae04d1d8e01f3fe2b0f8f49c8122a258a2a4f', 71, 3, 'MyApp', '[]', 1, '2019-04-09 13:47:48', '2019-04-09 13:47:48', '2020-04-09 13:47:48'),
('14e444089e40e3805a7995d8468b06aceb75d3455b21192ee8665cb71545aea7abd2e7ce3a08ff99', 71, 3, 'MyApp', '[]', 1, '2019-04-09 14:25:26', '2019-04-09 14:25:26', '2020-04-09 14:25:26'),
('b94eb0ccaf694209192cb5a06d01d2c38e5ea7159cc0213abc6f7ca804e252078155771801f75ae9', 1, 3, 'MyApp', '[]', 1, '2019-04-09 15:28:50', '2019-04-09 15:28:50', '2020-04-09 15:28:50'),
('079ec80a69c854427e566da65c3670e5d50a4e4747ee5c39acf07b8a4a05b1fc0b3f26eb7df5f0ac', 71, 3, 'MyApp', '[]', 1, '2019-04-09 17:53:56', '2019-04-09 17:53:56', '2020-04-09 17:53:56'),
('3be7bcf15e95f9320bf8656375ec0a71e7c90c98f037447ef0a0b807a5fdcf0da4cc7ac2976fcbe9', 1, 3, 'MyApp', '[]', 1, '2019-04-09 17:58:43', '2019-04-09 17:58:43', '2020-04-09 17:58:43'),
('e990d6659bd5fa56a1f74d76c31e29cd52aef740e8d2fca77f98c1d23fa5364eb1173c9e7a053087', 1, 3, 'MyApp', '[]', 1, '2019-04-10 10:09:39', '2019-04-10 10:09:39', '2020-04-10 10:09:39'),
('adaef4ae8ee0c8d501c54009f8fb7bfde9bf1b5f7d9472421c2fb0fa90a560719397cfd49db967ac', 71, 3, 'MyApp', '[]', 1, '2019-04-10 10:14:00', '2019-04-10 10:14:00', '2020-04-10 10:14:00'),
('384386a084d7f919d3f88034ee6ac390dc1da2429648b1d867b6962f05659f794dca1f3116cd6332', 71, 3, 'MyApp', '[]', 1, '2019-04-10 12:03:27', '2019-04-10 12:03:27', '2020-04-10 12:03:27'),
('5b2312123c627f079cbc83b9fff5e1232cd137a479ef8eed30e598f7c21b62bdaddfb4dd7ab9d3ef', 71, 3, 'MyApp', '[]', 1, '2019-04-10 17:34:42', '2019-04-10 17:34:42', '2020-04-10 17:34:42'),
('13b5ca8f7ced7b9e0d02f86d308fda1401b74a07fa9158fad6b50b5c6292b90c882b2587fa16ccca', 80, 3, 'MyApp', '[]', 1, '2019-04-10 17:57:03', '2019-04-10 17:57:03', '2020-04-10 17:57:03'),
('e179b0b33c3645681a96bd86961b372306e7839e30547a1b7cb3ec0d309314a7369c31902374d3df', 70, 3, 'MyApp', '[]', 1, '2019-04-10 17:57:30', '2019-04-10 17:57:30', '2020-04-10 17:57:30'),
('17e80934d077a8b0119ed95850033ffac21ba0d6246ca82bea01e41e2bc796d8860d753ffef34297', 71, 3, 'MyApp', '[]', 1, '2019-04-10 18:15:44', '2019-04-10 18:15:44', '2020-04-10 18:15:44'),
('613ad17b74f488acfbbb64dd8c98a53fc287c7924fe87650d063fc0ee5d69895dcf78d823281d860', 81, 3, 'MyApp', '[]', 1, '2019-04-11 00:45:06', '2019-04-11 00:45:06', '2020-04-11 00:45:06'),
('c84e11ab1aecfb0463bd666a64419462cf21689aa66be78475476ee4b4e2e4f26dfdf945078399e0', 85, 3, 'MyApp', '[]', 1, '2019-04-11 00:49:23', '2019-04-11 00:49:23', '2020-04-11 00:49:23'),
('a2431e4955ec03d3d94182c2b5040e448fea07d5728cdac186bf7b3a99c668f113cbc7a52d56afb0', 81, 3, 'MyApp', '[]', 1, '2019-04-11 00:51:22', '2019-04-11 00:51:22', '2020-04-11 00:51:22'),
('d0b3b6f2e627abbe4867ebc24519b3dd6799f9b0e54a9c3ed0bf9b34b91ed35dd2795f003353913b', 70, 3, 'MyApp', '[]', 1, '2019-04-11 00:51:39', '2019-04-11 00:51:39', '2020-04-11 00:51:39'),
('c03a8a9873e436cb5abccefacade5338c9d5ab5b047ee2f81c86802071d576bcbd4b2828a8e25e8d', 1, 3, 'MyApp', '[]', 1, '2019-04-11 00:53:47', '2019-04-11 00:53:47', '2020-04-11 00:53:47'),
('2c7297192a1b99b43c4b17a2c602aca700d72dd26e5b0ca4e15356426774c988ff91582bbd216f33', 81, 3, 'MyApp', '[]', 1, '2019-04-11 00:54:53', '2019-04-11 00:54:53', '2020-04-11 00:54:53'),
('0d24c908ad861c24f409d90c4214cd5dd7a0742ec4a044d68171fcc39e99ff0dbdd84f61d499787b', 71, 3, 'MyApp', '[]', 1, '2019-04-11 00:55:19', '2019-04-11 00:55:19', '2020-04-11 00:55:19'),
('e1a282e7ac902866d8a0ab1ac900e0a192e1353ba68c4b39ff264300e4af386e95b32c9bb65c65c5', 70, 3, 'MyApp', '[]', 1, '2019-04-11 00:55:55', '2019-04-11 00:55:55', '2020-04-11 00:55:55'),
('4d95d815c53fb947e7993266645b0f5ddfb877dff111481d5d5be58a7b402c82faf80205b8455fc5', 81, 3, 'MyApp', '[]', 1, '2019-04-11 00:56:24', '2019-04-11 00:56:24', '2020-04-11 00:56:24'),
('ae3ea2c961281dad5b126356c04f70e4a41dccbd43240a364a769554bcac8b3462b1aa1ffd995244', 70, 3, 'MyApp', '[]', 1, '2019-04-12 20:53:00', '2019-04-12 20:53:00', '2020-04-12 20:53:00'),
('ca7942569f16afa682c6cea67723844fcc18329b9fbfa41a0e4dcc3fddce85f1c31a5692480b820f', 71, 3, 'MyApp', '[]', 1, '2019-04-12 20:53:15', '2019-04-12 20:53:15', '2020-04-12 20:53:15'),
('4428f11f1759d047fcc30a739bcca8e20e4147d5b2c0b69fc0eb5532be03617cd11ba5ebfe745bc6', 71, 3, 'MyApp', '[]', 1, '2019-04-12 20:54:17', '2019-04-12 20:54:17', '2020-04-12 20:54:17'),
('a352d4f8bb2e043d2f7d769ea1dd75d6fdfd11aaf83769f1751ffeea379becfb94063fbf0e9641fc', 70, 3, 'MyApp', '[]', 1, '2019-04-12 20:54:27', '2019-04-12 20:54:27', '2020-04-12 20:54:27'),
('df17b4242515d8353ea571e2030a08c8fb05f2ee8d403cfdbf8d4f4f7e06adf4983e82a87f54c0bb', 81, 3, 'MyApp', '[]', 1, '2019-04-12 20:55:07', '2019-04-12 20:55:07', '2020-04-12 20:55:07'),
('9264749c54972d6f89739e5c8956ac8939e94a714dfb4ff72905a6e084162a92005b2ae9dd434ca9', 81, 3, 'MyApp', '[]', 1, '2019-04-12 21:57:54', '2019-04-12 21:57:54', '2020-04-12 21:57:54'),
('025b28a02e0eb418182b05f8e6a88e3d05b40a4cda7c1a6ec5f1881a63c050f63ef069e18a4de527', 81, 3, 'MyApp', '[]', 1, '2019-04-13 00:56:07', '2019-04-13 00:56:07', '2020-04-13 00:56:07'),
('1017e31260a8162b52f18923a2627a7130f4f383fae9013cd8a40a4b50878aebc9ec2e6b08e60a22', 1, 3, 'MyApp', '[]', 1, '2019-04-13 02:14:16', '2019-04-13 02:14:16', '2020-04-13 02:14:16'),
('c2b45f852c7ec18e8763b17303d0e377b42bbad097071511bd47340dda02a53b5c7191b9fb360630', 66, 3, 'MyApp', '[]', 1, '2019-04-13 15:38:04', '2019-04-13 15:38:04', '2020-04-13 15:38:04'),
('47706d16f76de24b8ec38f53807ea4ee335050404824046a268db15f0d9268b82d374aa80f3d5b3d', 81, 3, 'MyApp', '[]', 1, '2019-04-13 15:40:18', '2019-04-13 15:40:18', '2020-04-13 15:40:18'),
('61a9010983255989c2a8425c6d350bf173fd53e67f6836a64a79a021c0b2a90700e1013f6f79c0b3', 1, 3, 'MyApp', '[]', 1, '2019-04-13 16:11:35', '2019-04-13 16:11:35', '2020-04-13 16:11:35'),
('ecbc70ed9c25fda7130bf18272d2515d6645249a8220197d25b8bb47f9146989abfed7a7f6f66f80', 1, 3, 'MyApp', '[]', 1, '2019-04-13 17:05:39', '2019-04-13 17:05:39', '2020-04-13 17:05:39'),
('91517f96d64b691368b6b5d06c6e215519acf34ae988c3b4f0498c76a9a806ec45fb2daa1eb71e06', 1, 3, 'MyApp', '[]', 1, '2019-04-13 17:06:46', '2019-04-13 17:06:46', '2020-04-13 17:06:46'),
('32b07d31b20ce6e814a4f46ad21c22590523a5bb60a9ab443dcb9c3fb5dc17b87320ec2b617212a7', 71, 3, 'MyApp', '[]', 1, '2019-04-13 17:48:12', '2019-04-13 17:48:12', '2020-04-13 17:48:12'),
('6f6304cbb78fcbad77eb08795274c162afd001e2304e6e52081e02adf17b2d76271dcc37c95d541e', 1, 3, 'MyApp', '[]', 1, '2019-04-13 17:56:43', '2019-04-13 17:56:43', '2020-04-13 17:56:43'),
('90905b4dabd560271353dae366695709df82e89e1fcc691165a2c5f54e9dd21492c4a8e2ac461ec8', 81, 3, 'MyApp', '[]', 1, '2019-04-13 18:21:03', '2019-04-13 18:21:03', '2020-04-13 18:21:03'),
('3a1ffe33470837c939720f502ed012444fceb7ebf3a62c4308814b6670c8b6c114ba0924e04ce94e', 71, 3, 'MyApp', '[]', 1, '2019-04-14 17:15:51', '2019-04-14 17:15:51', '2020-04-14 17:15:51'),
('a5e3d490e0e4f2e1c052e650a1c369432c5b96b72f3cf37c03fc0d539ee5163035aac65eef0c4f4e', 81, 3, 'MyApp', '[]', 1, '2019-04-14 17:28:06', '2019-04-14 17:28:06', '2020-04-14 17:28:06'),
('797890615ae410e3f30ec2a2cbcbe91d549b7553efbd110d233ae35d9721b70e959a5bcb4f5270a9', 1, 3, 'MyApp', '[]', 1, '2019-04-14 18:53:41', '2019-04-14 18:53:41', '2020-04-14 18:53:41'),
('877e2af2a2c0ed9628e401201fd42274ac9ea355cb976fdb94853fc57bd3dd0551cdf19efa158e7e', 71, 3, 'MyApp', '[]', 1, '2019-04-15 11:55:19', '2019-04-15 11:55:19', '2020-04-15 11:55:19'),
('57de8b391c97a5e7cd1dea75ae819f4c2154ea6302a46f952ec7dbcb97c0499cf14fe3a5a3fe0f16', 1, 3, 'MyApp', '[]', 1, '2019-04-15 11:57:24', '2019-04-15 11:57:24', '2020-04-15 11:57:24'),
('17d1b75b4e335e616d8fe4f39c09c95e4ffc507bb37be8ebcbc66195328132f1f1baafc58930c750', 1, 3, 'MyApp', '[]', 1, '2019-04-15 15:57:22', '2019-04-15 15:57:22', '2020-04-15 15:57:22'),
('2d75f9472c9465e0de4a578da765620d8a7d11a05515ec29eb27363de98785cbfa1a4503811420e0', 71, 3, 'MyApp', '[]', 1, '2019-04-15 16:59:48', '2019-04-15 16:59:48', '2020-04-15 16:59:48'),
('838bb300e6880087ef1f8aa4aec01d6e8f6f90621bdb387d35e4af037e31aba323e8622214d15097', 1, 3, 'MyApp', '[]', 1, '2019-04-15 16:59:58', '2019-04-15 16:59:58', '2020-04-15 16:59:58'),
('e8679cf1483fda3b036ba0caa047658cd133297a87e3a14f10ee6d9dad864dcc6ac63b6196100567', 1, 3, 'MyApp', '[]', 1, '2019-04-15 23:39:09', '2019-04-15 23:39:09', '2020-04-15 23:39:09'),
('87147808d1f9cfef87a748764ad3317f8230fc897d8f959605f0db66c07fa362dcf4d5189ea1eaf5', 71, 3, 'MyApp', '[]', 1, '2019-04-16 01:01:32', '2019-04-16 01:01:32', '2020-04-16 01:01:32'),
('a73606ebb438292590695f2223c2952947412771a46c7bcc8f8812bf8e16dc6e1be42dac9f28dbe5', 81, 3, 'MyApp', '[]', 1, '2019-04-16 01:01:45', '2019-04-16 01:01:45', '2020-04-16 01:01:45'),
('571fcdd2271c686639b6e1cdfacb7f4c5a1a02aed53abe7f98cca4ecfb8ae81c6b3c11cc41c0dcbe', 70, 3, 'MyApp', '[]', 1, '2019-04-16 01:02:12', '2019-04-16 01:02:12', '2020-04-16 01:02:12'),
('65f0352fcd8b7beb9ca5143d28f19d87d6f3dd2e669afb79e2536293d5d39c8a2eba696280c10966', 1, 3, 'MyApp', '[]', 1, '2019-04-16 01:12:53', '2019-04-16 01:12:53', '2020-04-16 01:12:53'),
('542da7f3d73a858be3133d394c26c6224040c900ba52103848b82aa907af70f1d425be22c70b27f4', 1, 3, 'MyApp', '[]', 1, '2019-04-16 14:46:14', '2019-04-16 14:46:14', '2020-04-16 14:46:14'),
('3f852a23b7925c91239bed4f1ac0ac49bb3ba8d367dc7121d79c9ad874c8cf822b277fd8cc649d45', 1, 3, 'MyApp', '[]', 1, '2019-04-16 17:07:30', '2019-04-16 17:07:30', '2020-04-16 17:07:30'),
('1fc4f90bba7b706491b0c1a7a773acbc165836751fbca56a5cad173d1eb44a7a9e56795254947887', 1, 3, 'MyApp', '[]', 1, '2019-04-16 17:08:55', '2019-04-16 17:08:55', '2020-04-16 17:08:55'),
('29905cad021e0060110317f6d7539db7dfea2432c3324745f00af9f0d82875d18d80382875e86d4a', 71, 3, 'MyApp', '[]', 1, '2019-04-17 02:04:19', '2019-04-17 02:04:19', '2020-04-17 02:04:19'),
('70a17910144446b9f1c9038ff17519da2916da51d3a41863bfcd5231af5332eada2ad7ab2e38b9f3', 1, 3, 'MyApp', '[]', 1, '2019-04-17 02:12:44', '2019-04-17 02:12:44', '2020-04-17 02:12:44'),
('215d56a8a9eaff57a46f468a4f12d875abc13dc3c276544449dc659c3e1509dbe822e1035d4119ab', 71, 3, 'MyApp', '[]', 1, '2019-04-17 03:07:20', '2019-04-17 03:07:20', '2020-04-17 03:07:20'),
('7548338e269946527533f8b77ca10e976f9954d3de47820afbc473a01db14d21811160d5c7a846f5', 1, 3, 'MyApp', '[]', 1, '2019-04-17 03:11:13', '2019-04-17 03:11:13', '2020-04-17 03:11:13'),
('f49994f3d5c1574d1d776357fcdd60949becd3bfc50139ffffd34fe8b51cf11e823ac5ceb72326c4', 71, 3, 'MyApp', '[]', 1, '2019-04-17 03:26:49', '2019-04-17 03:26:49', '2020-04-17 03:26:49'),
('c30bb7edcabd1231245549a9444b732ab77451de1f2f34b5ae65eeef7fc182a2c69470ad5605ecbc', 1, 3, 'MyApp', '[]', 1, '2019-04-17 03:28:13', '2019-04-17 03:28:13', '2020-04-17 03:28:13'),
('c2bf24c8821b68ce9c13b3dd664c74d0cb9de41ef97bd9b3b514b75f199f00a4c5a45958898ef9aa', 71, 3, 'MyApp', '[]', 1, '2019-04-17 03:38:33', '2019-04-17 03:38:33', '2020-04-17 03:38:33'),
('c0e76c793da7b318c9a1d1191537db8fc1f87b45e16646e1857545d2116c8973b7f410f97f71705e', 1, 3, 'MyApp', '[]', 1, '2019-04-17 03:45:18', '2019-04-17 03:45:18', '2020-04-17 03:45:18'),
('6230e47e7ae056634b8723a0f4e010b07e59afb6e9dcd8815c4d64fea674ed0a13480eace88f9874', 66, 3, 'MyApp', '[]', 1, '2019-04-17 08:49:36', '2019-04-17 08:49:36', '2020-04-17 08:49:36'),
('33b6b9b76e85fb6f80f67e8a23e1e58644dc30b91e41b7ed6bacaf6c47e181f8349ad2aad683689d', 70, 3, 'MyApp', '[]', 1, '2019-04-17 14:17:43', '2019-04-17 14:17:43', '2020-04-17 14:17:43'),
('d07644be8c9b4cf8b2cbf0049ffef3dd09f1c277735a716235cce96e3b62d6e9c267f9aeb86c8a57', 71, 3, 'MyApp', '[]', 1, '2019-04-17 14:17:52', '2019-04-17 14:17:52', '2020-04-17 14:17:52'),
('a1eabe4b0091dc2e12b920cc6915f8f955ba1497f703d6a271cbc69250dbc1363dbd0f25cf86ba07', 1, 3, 'MyApp', '[]', 1, '2019-04-17 14:18:33', '2019-04-17 14:18:33', '2020-04-17 14:18:33'),
('19c1dfb850f0e3f101d2ea0c6f421cfbb1a8e7ea50749f1c2abef1a0f2c55c46e219c265f26ec8ab', 71, 3, 'MyApp', '[]', 1, '2019-04-17 15:10:09', '2019-04-17 15:10:09', '2020-04-17 15:10:09'),
('04435aa512fa045d7e553a0c39e5b9482447587737f55be9f39cf61f1f0a10a368597664359f2621', 1, 3, 'MyApp', '[]', 1, '2019-04-17 15:19:33', '2019-04-17 15:19:33', '2020-04-17 15:19:33'),
('9bbdafd83ee4c57777c0373caada9ae6b25ad878696ab7b6e54bda61d0583b2bd3697fd340dd98d7', 1, 3, 'MyApp', '[]', 1, '2019-04-18 14:57:42', '2019-04-18 14:57:42', '2020-04-18 14:57:42'),
('d1508d594941baa19f0dc2804c3962dd9373e9a6602cf89f0eb4fa839167c0159cf3349359fbab59', 1, 3, 'MyApp', '[]', 1, '2019-04-23 11:51:37', '2019-04-23 11:51:37', '2020-04-23 11:51:37'),
('3259a4fc3b0d9e2896274294a9235f755aebdfa9fea8e6302652e2b8f0a7cb9c6ca563cfdbe15a61', 81, 3, 'MyApp', '[]', 1, '2019-04-23 12:36:12', '2019-04-23 12:36:12', '2020-04-23 12:36:12'),
('b16ee75fe7275e771f172c4311ec0cd87c2fb06e4622d2531eeba459f8213342804eb6bb1ecf5fa7', 1, 3, 'MyApp', '[]', 1, '2019-04-23 19:05:43', '2019-04-23 19:05:43', '2020-04-23 19:05:43'),
('78a9c12b008655206e3d248c44949cb3fdd57d9e72d731f80432c56b8a93c87f4a08478c6c549a80', 66, 3, 'MyApp', '[]', 1, '2019-04-23 23:41:10', '2019-04-23 23:41:10', '2020-04-23 23:41:10'),
('61b9769839d568b58a484b63d08737e8fec8761304468440636b6262e00a1dd3d17a282c702440e1', 1, 3, 'MyApp', '[]', 1, '2019-04-27 01:29:00', '2019-04-27 01:29:00', '2020-04-27 01:29:00'),
('c58bfda26b0a11ced6fcf7b507f3b5c52c6030c98465801fe8578bff780046aa4e3f947a7aa93e0b', 1, 3, 'MyApp', '[]', 1, '2019-05-02 16:20:59', '2019-05-02 16:20:59', '2020-05-02 16:20:59'),
('2efdb0995bc14580375d5c5b16339afaf9761e5e66d62661d6267c8f6b2b34beee75336995d3c442', 1, 3, 'MyApp', '[]', 1, '2019-05-07 12:04:45', '2019-05-07 12:04:45', '2020-05-07 12:04:45'),
('5956e7a0a441b83ead00001804d812ba37eb53e678a220bfab2255af19a0c1015efb97c48ad2529c', 1, 3, 'MyApp', '[]', 1, '2019-05-07 12:20:58', '2019-05-07 12:20:58', '2020-05-07 12:20:58'),
('0b85625a167160a77b1e5cd9d4ad3b163c5b3429288549b3b10362d00e841455df89edd4d696e647', 1, 3, 'MyApp', '[]', 1, '2019-05-07 14:32:08', '2019-05-07 14:32:08', '2020-05-07 14:32:08'),
('219b7590ad882880c25d0f1c7b60ab165526c4263c6044d5114e98bb97d93e510c0594e415767066', 1, 3, 'MyApp', '[]', 1, '2019-05-07 17:34:41', '2019-05-07 17:34:41', '2020-05-07 17:34:41'),
('499ea21c4a6354cd351c0e73783a1dbf5198428792e9f7666d10c0aa7d94aca845fc1beafc56a474', 1, 3, 'MyApp', '[]', 1, '2019-05-07 17:34:54', '2019-05-07 17:34:54', '2020-05-07 17:34:54'),
('691c3392eaef6514b92a50dd7a240e3ddfc5824b4f345a8833e10807c7afd89b026460b174756c7d', 1, 3, 'MyApp', '[]', 1, '2019-05-07 17:43:07', '2019-05-07 17:43:07', '2020-05-07 17:43:07'),
('c9a6836abbfac415a2c6e60b41f57686d2ab9c32e1dc932eb629b964da2340513edcf4f9f7aea46e', 1, 3, 'MyApp', '[]', 1, '2019-05-07 18:49:42', '2019-05-07 18:49:42', '2020-05-07 18:49:42'),
('ce5d34173be12bf3eaba3c4ca6c843d3608fbd65aebb327d74221d79249377ca943f5aeb6272c20c', 1, 3, 'MyApp', '[]', 1, '2019-05-08 20:00:17', '2019-05-08 20:00:17', '2020-05-08 20:00:17'),
('73326778e2c9bf03a99676d056bdba704cc6a0bf356d79d3b77f7cb41bf54e42f60aab66702333f8', 1, 3, 'MyApp', '[]', 1, '2019-05-09 01:22:54', '2019-05-09 01:22:54', '2020-05-09 01:22:54'),
('d529f700818b4eaf2b041a4f7a18e450e4e1fa48a0dbbfadf56a6e1f177879807c1bd9a9b9eeee06', 1, 3, 'MyApp', '[]', 1, '2019-05-13 09:55:20', '2019-05-13 09:55:20', '2020-05-13 09:55:20'),
('9ca7cb5ccb2e7645566b69c036313e34dbb0533a7efa490df23245770cdf1623d95a49bc314fb2e8', 1, 3, 'MyApp', '[]', 1, '2019-05-13 09:55:26', '2019-05-13 09:55:26', '2020-05-13 09:55:26'),
('65ea33dd5a6eda954a8278ee80ea059ae40a9fc113a8c2277c9fffdbeeea8fada200d7678a5ad126', 1, 3, 'MyApp', '[]', 1, '2019-05-15 14:22:15', '2019-05-15 14:22:15', '2020-05-15 14:22:15'),
('36c94bb8a099945282dd98fbd3c3f9f731f67242a5824e614e30eafdc86286dad746bfb0a08e4eb8', 66, 3, 'MyApp', '[]', 1, '2019-06-15 20:55:32', '2019-06-15 20:55:32', '2020-06-15 20:55:32'),
('a7c80e92496a2c240942bb958f4a8e014e302d4bf4f7bf302f8a5fde78fcacdf14c227581cc1f49d', 67, 3, 'MyApp', '[]', 1, '2019-06-25 01:22:21', '2019-06-25 01:22:21', '2020-06-25 01:22:21'),
('a2776df3bec0e2974674d626f12f0ff91e23be8911c2b13f08a2b380854d7dfe2f52390713d6d081', 67, 3, 'MyApp', '[]', 1, '2019-06-25 11:39:13', '2019-06-25 11:39:13', '2020-06-25 11:39:13'),
('12266415f510b1effa10e1d2606e9989cade12e8cbc1d63ced57cd27d93de4a2930c1299675491e3', 67, 3, 'MyApp', '[]', 1, '2019-06-25 11:39:13', '2019-06-25 11:39:13', '2020-06-25 11:39:13'),
('3475af12bd30bd62490300935b689d9ead8bfa47f2899013f0483d74bd30ee16150090bdad6c4e28', 67, 3, 'MyApp', '[]', 1, '2019-06-25 11:40:35', '2019-06-25 11:40:35', '2020-06-25 11:40:35'),
('5c0e1bb2ebd0623c171e20f0ed7da64f296884812016ad97f75450195c80277e72be09005776ebf6', 67, 3, 'MyApp', '[]', 1, '2019-06-25 22:25:44', '2019-06-25 22:25:44', '2020-06-25 22:25:44'),
('8e332111b0e6e2fb1373d4836e4257b1a0bcb3955ab475cf736dfd91c607a180464eeb6eca01b329', 67, 3, 'MyApp', '[]', 1, '2019-06-26 00:48:32', '2019-06-26 00:48:32', '2020-06-26 00:48:32'),
('0916ab66f1b287b19c1c302507734d921d0566a2b368e926df162d1eb2a46c6d2eeca7329793667f', 81, 3, 'MyApp', '[]', 1, '2019-06-26 07:01:21', '2019-06-26 07:01:21', '2020-06-26 07:01:21'),
('bf4ad64fba608a37ff4b51f05c57c8b835699f1b396c1f0d2aad813f8b64ead03c855291bffa5f8e', 66, 3, 'MyApp', '[]', 1, '2019-06-27 06:46:10', '2019-06-27 06:46:10', '2020-06-27 06:46:10'),
('0276abf92eb24818bb6a4d08e91a901937facbe513f1883f177a9f15b55a5df7a0b95cc4b783c735', 71, 3, 'MyApp', '[]', 1, '2019-06-27 15:21:55', '2019-06-27 15:21:55', '2020-06-27 15:21:55'),
('495951ef78d1849093f4ac5b135da135e1ef5fe915d8feb04919f6146d160b3cb07d3138a3a46c28', 67, 3, 'MyApp', '[]', 1, '2019-06-27 15:26:14', '2019-06-27 15:26:14', '2020-06-27 15:26:14'),
('166dcf5b8e89ab3136e14e4d7cea8d22270a6b8af21643dc2a8b7a531a2a052ef75a85d61b2d8610', 81, 3, 'MyApp', '[]', 0, '2019-06-28 10:00:44', '2019-06-28 10:00:44', '2020-06-28 10:00:44'),
('fdfac03453f5921d76836a2f0c816b37faa91a0436d5e7d6eacd9f11c2436c95e80a9caa9f432176', 67, 3, 'MyApp', '[]', 1, '2019-06-28 23:44:24', '2019-06-28 23:44:24', '2020-06-28 23:44:24'),
('d9f6637bde62906009d2db416b17d0a862253c1435e028791989ba354e076958056ff28e4b746cff', 67, 3, 'MyApp', '[]', 1, '2019-06-28 23:44:33', '2019-06-28 23:44:33', '2020-06-28 23:44:33'),
('430ddcfb544b77e0bee7e0d69d728e6d40afd501181c1c5ab6868355ed670d4ada2b62ae9a7683bd', 1, 3, 'MyApp', '[]', 0, '2019-06-29 02:37:39', '2019-06-29 02:37:39', '2020-06-29 02:37:39'),
('c20e7c3976ad366ebad014902732efcafd4b1381eb4676877c41058309d04cc50841aa4abc9f1d3a', 67, 3, 'MyApp', '[]', 0, '2019-06-29 19:09:56', '2019-06-29 19:09:56', '2020-06-29 19:09:56');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Laravel Personal Access Client', '8IHZW2gBYV3LHuQL1MSBUmGBOJqBTn6KMMEG4e4u', 'http://localhost', 1, 0, 0, '2018-10-12 23:56:09', '2018-10-12 23:56:09'),
(2, NULL, 'Laravel Password Grant Client', 'VG1gBHmufOBgdD1hFHqLIp0Yc5X9ayLYMvalGJwS', 'http://localhost', 0, 1, 0, '2018-10-12 23:56:09', '2018-10-12 23:56:09'),
(3, NULL, 'Laravel Personal Access Client', 'G4XZlRJqAONXutbF4ItQ53DqXZhBCatyHXcUsBvl', 'http://localhost', 1, 0, 0, '2018-10-17 06:55:36', '2018-10-17 06:55:36'),
(4, NULL, 'Laravel Password Grant Client', 'vZGrCsNVRs0WcjjLXrph4IJaSb6JLcXQdlVzCsDp', 'http://localhost', 0, 1, 0, '2018-10-17 06:55:36', '2018-10-17 06:55:36');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2018-10-12 23:56:09', '2018-10-12 23:56:09'),
(2, 3, '2018-10-17 06:55:36', '2018-10-17 06:55:36');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` int(10) UNSIGNED NOT NULL,
  `first` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `second` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `third` text COLLATE utf8mb4_unicode_ci,
  `fourth` text COLLATE utf8mb4_unicode_ci,
  `right_answer` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `question_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `first`, `second`, `third`, `fourth`, `right_answer`, `question_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(10, 'Narendra Modi', 'Nitish Kumar', 'Arwind Kejriwal', 'Rahul Gandhi', NULL, 23, '2019-04-02 13:44:43', '2019-04-02 13:44:43', NULL),
(9, 'Mahatma Gandhi', 'Jawaharlal Nehru', 'Subhas chandra bose', 'Bankim chandra chaterjee', NULL, 20, '2019-04-02 00:08:08', '2019-04-02 00:08:08', NULL),
(11, 'Hydrogen', 'Oxygen', 'Soil', 'Leaf', NULL, 25, '2019-04-02 13:49:44', '2019-04-02 13:49:44', NULL),
(12, 'Jawahar Lal Nehru', 'Rajeev Gandhi', 'PV Narsimha Rao', 'Sardar Vallabhbhai Patel', NULL, 30, '2019-04-02 18:57:35', '2019-04-02 18:57:35', NULL),
(13, 'Mumbai', 'New Delhi', 'Kolkata', 'Chennai', NULL, 36, '2019-04-09 13:45:26', '2019-04-09 13:45:26', NULL),
(14, 'Narendra Modi', 'Pranab Mukherjee', 'Sonia Gandhi', 'Manmohan Singh', NULL, 37, '2019-04-13 17:55:19', '2019-04-13 17:55:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `organizations`
--

CREATE TABLE `organizations` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tagline` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified` tinyint(1) NOT NULL DEFAULT '1',
  `mobile` bigint(20) NOT NULL,
  `mobile_verified` tinyint(1) NOT NULL DEFAULT '1',
  `is_school` tinyint(1) NOT NULL DEFAULT '0',
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `sponsor_id` int(10) UNSIGNED NOT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  `stream_room` text COLLATE utf8mb4_unicode_ci,
  `medium` tinyint(4) DEFAULT '0',
  `channel_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `organizations`
--

INSERT INTO `organizations` (`id`, `name`, `tagline`, `description`, `email`, `email_verified`, `mobile`, `mobile_verified`, `is_school`, `address`, `sponsor_id`, `is_default`, `stream_room`, `medium`, `channel_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Motilal Nehru Public School', 'This is the taglinbe', 'Motilal Nehru public school is an ICSE affiliated school situated at Northern Town, Bistupur, Jamshedpur', 'nishant060990@gmail.com', 1, 9439416692, 1, 1, 'Jamshedpur, Jharkhand', 14, 0, '525094', 1, NULL, '2019-03-18 11:42:52', '2019-03-18 11:42:52', NULL),
(2, 'RVS Enginnering College', 'Best private engineering college in Jharkhand', 'Creation of Human Asset through employable education in contemporary technology. To be at par excellence Technical Education Centre. Education is universally recognized as an important investment in building human capital which is a driver for technological innovation and economic growth. Application of science and engineering.', 'rvs@gmail.com', 1, 9110911010, 1, 0, 'R.V.S.C.E.T, Binda Apartments, Mills Area,Behind Basant Cinema, Sakchi, Jamshedpur-831001', 14, 0, '780209', 0, NULL, '2019-03-19 13:10:37', '2019-03-19 13:10:37', NULL),
(3, 'Motilal Nehru Public School - Campus 2', 'Codession', 'Motilal Nehru public school is an ICSE affiliated school situated at Northern Town, Bistupur, Jamshedpur', 'xyz@gmail.com', 1, 9234734567, 1, 1, 'Motilal Nehru public school is an ICSE affiliated school situated at Northern Town, Bistupur, Jamshedpur', 14, 0, '265744', 0, NULL, '2019-03-21 16:40:49', '2019-03-21 16:40:49', NULL),
(19, 'Demo Organization', 'This is for demo', 'For School Demo', 'demoorg@gmail.com', 1, 9110918743, 1, 1, 'Patia, Shree Vihar', 15, 0, '077930', 0, NULL, '2019-04-02 12:49:39', '2019-04-02 12:49:39', NULL),
(6, 'Test', 'sub 1', 'yjyg', 'fgfg@bfbfg.hgj', 1, 7463024673, 1, 0, 'ygjgy', 15, 0, '481665', 0, NULL, '2019-03-31 15:36:58', '2019-03-31 15:36:58', NULL),
(20, 'OTET', 'null', 'lorem30;', 'abcd@xyz.com', 1, 9876556789, 1, 1, 'lorem30;', 17, 0, '975949', 0, NULL, '2019-04-15 14:31:45', '2019-04-15 14:31:45', NULL),
(21, 'New Demo Organization', 'This is a demo organization for demonstration purpose.', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui', 'demo_org@codession.com', 1, 9876543210, 1, 1, '123, Patia, Bhubaneswar.', 18, 0, '280237', 0, NULL, '2019-04-27 08:29:19', '2019-04-27 08:29:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tagline` text COLLATE utf8mb4_unicode_ci,
  `max_organization` int(11) NOT NULL,
  `max_sponsor_admin` int(11) NOT NULL,
  `max_organization_user` int(11) NOT NULL,
  `max_department` int(11) NOT NULL,
  `max_program_per_department` int(11) NOT NULL,
  `max_grade` int(11) NOT NULL,
  `max_subgrade_per_grade` int(11) NOT NULL,
  `max_topic_per_grade` int(11) NOT NULL,
  `max_subject_per_grade` int(11) NOT NULL,
  `max_chapter_per_subject` int(11) NOT NULL,
  `max_section_per_chapter` int(11) NOT NULL,
  `max_storage` int(11) NOT NULL,
  `max_bandwidth` int(11) NOT NULL,
  `shared` int(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`id`, `name`, `tagline`, `max_organization`, `max_sponsor_admin`, `max_organization_user`, `max_department`, `max_program_per_department`, `max_grade`, `max_subgrade_per_grade`, `max_topic_per_grade`, `max_subject_per_grade`, `max_chapter_per_subject`, `max_section_per_chapter`, `max_storage`, `max_bandwidth`, `shared`, `created_at`, `updated_at`, `deleted_at`) VALUES
(9, 'Silver Plan', 'This is the description of this plan', 10, 5, 10000, 5, 2, 10, 2, 12, 11, 10, 6, 1000, 2, 1, '2019-03-18 01:23:27', '2019-03-24 05:04:00', NULL),
(12, 'Small Plan', 'This Plan is suitable to manage 4 to 5 organizations', 5, 10, 10000, 10, 10, 10, 10, 10, 15, 20, 50, 1200, 2, 1, '2019-03-24 09:33:13', '2019-03-24 09:33:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE `programs` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_id` int(10) UNSIGNED NOT NULL,
  `stream_room` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`id`, `name`, `department_id`, `stream_room`, `is_default`, `created_at`, `updated_at`, `deleted_at`) VALUES
(26, 'MTech', 5, '382159', 0, '2019-04-02 00:35:20', '2019-04-02 00:35:20', NULL),
(25, 'Computer Science program', 5, '738509', 1, '2019-04-02 00:32:24', '2019-04-02 00:32:24', NULL),
(24, 'Motilal Nehru Public School - Campus 2_prg', 4, '875042', 1, '2019-03-21 16:40:50', '2019-03-21 16:40:50', NULL),
(23, 'Btech', 3, '671839', 0, '2019-03-19 13:13:18', '2019-03-19 13:13:18', NULL),
(22, 'Electrical program', 3, '255074', 1, '2019-03-19 13:12:27', '2019-03-19 13:12:27', NULL),
(21, 'Motilal Nehru Public School_prg', 1, '330777', 1, '2019-03-18 11:42:52', '2019-03-18 11:42:52', NULL),
(27, 'Demo Organization_prg', 11, '453360', 1, '2019-04-02 12:49:39', '2019-04-02 12:49:39', NULL),
(28, 't1 program', 12, '282888', 1, '2019-04-07 13:17:10', '2019-04-07 13:17:10', NULL),
(29, 't1 program', 13, '683682', 1, '2019-04-07 13:17:20', '2019-04-07 13:17:20', NULL),
(30, 'P2', 13, '548265', 0, '2019-04-07 23:06:50', '2019-04-07 23:56:42', NULL),
(31, 'OTET_prg', 14, '166903', 1, '2019-04-15 14:31:45', '2019-04-15 14:31:45', NULL),
(32, 'New Demo Organization_prg', 15, '781775', 1, '2019-04-27 08:29:19', '2019-04-27 08:29:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(10) UNSIGNED NOT NULL,
  `heading` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `marks` int(11) NOT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci,
  `question_group_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `heading`, `type`, `marks`, `answer`, `question_group_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(37, '<p>Who among the following has been the Prime minister of India?</p>', 'checkbox', 20, '1,4', 24, '2019-04-13 17:55:19', '2019-04-13 17:55:19', NULL),
(36, '<p>Capital of India is?</p>', 'radio', 20, '2', 19, '2019-04-09 13:45:26', '2019-04-09 13:45:26', NULL),
(35, '<p>President of India?</p>', 'fill', 10, 'Ram Nath Kovind', 19, '2019-04-09 00:56:08', '2019-04-09 00:56:08', NULL),
(32, '<p>erferferf</p>', 'boolean', 34, '1', 18, '2019-04-07 20:03:54', '2019-04-07 20:03:54', NULL),
(33, '<p>Hello _______?</p>', 'fill', 34, 'World', 18, '2019-04-07 20:04:40', '2019-04-07 20:04:40', NULL),
(34, '<p>Who is the prime minister of India?</p>', 'fill', 20, 'Narendra Modi', 18, '2019-04-09 00:51:32', '2019-04-09 00:51:32', NULL),
(29, '<p>National Bird of India is peacock?</p>', 'boolean', 10, '1', 14, '2019-04-02 18:55:05', '2019-04-02 18:55:05', NULL),
(30, '<p>Who is called as Iron Man of India?</p>', 'radio', 10, '4', 14, '2019-04-02 18:57:35', '2019-04-02 18:57:35', NULL),
(31, '<p>National Bird of India is Peacock?</p>', 'boolean', 10, '1', 16, '2019-04-02 19:16:28', '2019-04-02 19:16:28', NULL),
(26, '<p>Nation fruit of India is Mango?</p>', 'boolean', 10, '1', 15, '2019-04-02 13:52:35', '2019-04-02 13:52:35', NULL),
(27, '<p>National game of India is Cricket?</p>', 'boolean', 10, '0', 15, '2019-04-02 13:53:15', '2019-04-02 13:53:15', NULL),
(28, '<p>National Fruit of India is ____</p>', 'fill', 10, 'Mango', 14, '2019-04-02 18:54:34', '2019-04-02 18:54:34', NULL),
(23, '<p>Who is the current Prime Minister of India?</p>', 'radio', 10, '1', 14, '2019-04-02 13:44:43', '2019-04-02 13:44:43', NULL),
(24, '<p>Capital of India is _____ ?</p>', 'fill', 10, 'Delhi', 14, '2019-04-02 13:45:12', '2019-04-02 13:45:12', NULL),
(25, '<p>WHich of these are gas</p>', 'checkbox', 10, '1,2', 15, '2019-04-02 13:49:44', '2019-04-02 13:49:44', NULL),
(21, '<p>National capital of India is ________ ?</p>', 'fill', 5, 'New Delhi', 13, '2019-04-02 00:09:38', '2019-04-02 00:09:38', NULL),
(22, '<p>Capital of Jharkhand is _______?</p>', 'fill', 5, 'Ranchi', 12, '2019-04-02 00:11:08', '2019-04-02 00:11:08', NULL),
(20, '<p>Who is the father of nation?</p>', 'radio', 5, '1', 12, '2019-04-02 00:08:08', '2019-04-02 00:08:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `question_groups`
--

CREATE TABLE `question_groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_set_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `question_groups`
--

INSERT INTO `question_groups` (`id`, `name`, `question_set_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(21, 'New Group', 26, '2019-04-09 00:59:11', '2019-04-09 00:59:11', NULL),
(20, 'New Group', 26, '2019-04-09 00:57:00', '2019-04-09 00:57:00', NULL),
(19, 'New Group', 26, '2019-04-09 00:55:35', '2019-04-09 00:55:35', NULL),
(18, 'Please attempt all the questions', 26, '2019-04-07 19:59:46', '2019-04-07 19:59:46', NULL),
(14, 'Group A', 20, '2019-04-02 13:42:46', '2019-04-02 13:42:46', NULL),
(17, 'New Group', 27, '2019-04-07 17:38:00', '2019-04-07 17:38:00', NULL),
(16, 'Group A', 21, '2019-04-02 19:13:50', '2019-04-02 19:13:50', NULL),
(22, 'Group123456', 26, '2019-04-09 01:00:36', '2019-04-09 01:00:36', NULL),
(23, 'Group45678', 26, '2019-04-09 01:10:51', '2019-04-09 01:10:51', NULL),
(24, 'Multiple choice questions', 28, '2019-04-13 17:52:48', '2019-04-13 17:52:48', NULL),
(25, 'Group 1', 29, '2019-04-14 17:16:24', '2019-04-14 17:16:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `question_sets`
--

CREATE TABLE `question_sets` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_submited` tinyint(1) NOT NULL DEFAULT '0',
  `is_selected` tinyint(1) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `exam_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `question_sets`
--

INSERT INTO `question_sets` (`id`, `name`, `is_submited`, `is_selected`, `user_id`, `exam_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(30, 'Set 3', 0, 0, 71, 27, '2019-04-13 17:51:14', '2019-04-13 17:51:14', NULL),
(29, 'Set 2', 0, 0, 71, 27, '2019-04-13 17:50:52', '2019-04-13 17:50:52', NULL),
(28, 'Set 1', 1, 0, 71, 27, '2019-04-13 17:48:29', '2019-04-13 17:56:36', NULL),
(27, 'qrst', 1, 0, 71, 26, '2019-04-07 17:20:12', '2019-04-10 17:37:52', NULL),
(26, 'mnop', 1, 1, 71, 26, '2019-04-07 17:20:07', '2019-04-11 00:56:07', NULL),
(25, 'ijkl', 0, 0, 71, 26, '2019-04-07 17:20:02', '2019-04-07 17:20:02', NULL),
(24, 'efgh', 0, 0, 71, 26, '2019-04-07 17:19:54', '2019-04-07 17:19:54', NULL),
(23, 'abcd', 0, 0, 71, 26, '2019-04-07 11:25:09', '2019-04-07 17:15:43', NULL),
(22, 'Set 1', 0, 0, 1, 26, '2019-04-07 11:20:12', '2019-04-07 11:20:12', NULL),
(21, 'SET A', 1, 1, 83, 23, '2019-04-02 19:13:30', '2019-04-02 20:06:26', NULL),
(20, 'Set A', 1, 1, 83, 22, '2019-04-02 13:42:28', '2019-04-02 19:02:25', NULL),
(19, 'Set A', 0, 0, 71, 21, '2019-03-31 23:35:11', '2019-04-02 00:11:33', NULL),
(31, 'Set 4', 0, 0, 71, 27, '2019-04-13 17:51:23', '2019-04-13 17:51:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `registered_users`
--

CREATE TABLE `registered_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `organization_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roll_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `other_details` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Draft',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `id` int(10) UNSIGNED NOT NULL,
  `toppers` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `top_score` double NOT NULL,
  `top_percentage` double NOT NULL,
  `exam_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`id`, `toppers`, `top_score`, `top_percentage`, `exam_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, '81', 10, 20, 22, '2019-04-02 19:08:11', '2019-04-02 19:08:11', NULL),
(3, '81', 118, 118, 26, '2019-04-12 20:54:32', '2019-04-12 20:54:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'superadmin', 'api', '2018-10-12 23:53:29', '2018-10-12 23:53:29', NULL),
(2, 'site-admin', 'api', '2018-10-12 23:53:29', '2018-10-12 23:53:29', NULL),
(3, 'prime', 'api', '2018-10-12 23:53:29', '2018-10-12 23:53:29', NULL),
(4, 'sponsor-admin', 'api', '2018-10-12 23:53:29', '2018-10-12 23:53:29', NULL),
(5, 'org-superadmin', 'api', '2018-10-12 23:53:29', '2018-10-12 23:53:29', NULL),
(6, 'org-admin', 'api', '2018-10-12 23:53:29', '2018-10-12 23:53:29', NULL),
(7, 'teacher', 'api', '2018-10-12 23:53:29', '2018-10-12 23:53:29', NULL),
(8, 'student', 'api', '2018-10-12 23:53:29', '2018-10-12 23:53:29', NULL),
(9, 'general', 'api', '2018-10-12 23:53:29', '2018-10-12 23:53:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `chapter_id` int(10) UNSIGNED NOT NULL,
  `love_reactant_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `name`, `chapter_id`, `love_reactant_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(30, 'Speed', 5, 12, '2019-04-27 10:06:00', '2019-04-27 10:15:45', NULL),
(29, 'SLOW OR FAST', 5, 11, '2019-04-27 09:54:57', '2019-04-27 09:54:57', NULL),
(28, 'Section 3', 4, 10, '2019-04-15 15:08:17', '2019-04-15 15:08:17', NULL),
(27, 'Section 2', 4, 9, '2019-04-15 15:07:03', '2019-04-15 15:07:03', NULL),
(26, 'Section 1', 4, 8, '2019-04-15 15:02:59', '2019-04-15 15:02:59', NULL),
(25, 'Water pollution', 2, 7, '2019-04-02 17:26:16', '2019-04-02 17:26:16', NULL),
(24, 'Air Pollution', 2, 6, '2019-04-02 17:19:55', '2019-04-02 17:19:55', NULL),
(31, 'MEASUREMENT OF TIME', 5, 13, '2019-04-27 10:07:58', '2019-04-27 10:14:14', NULL),
(32, 'gff', 6, 14, '2019-06-15 21:22:30', '2019-06-15 21:22:30', NULL),
(33, 'jj j', 7, 15, '2019-06-15 21:23:02', '2019-06-15 21:23:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sponsors`
--

CREATE TABLE `sponsors` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tagline` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified` tinyint(1) NOT NULL DEFAULT '0',
  `mobile` bigint(20) NOT NULL,
  `mobile_verified` tinyint(1) NOT NULL DEFAULT '0',
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `plan_id` int(10) UNSIGNED NOT NULL,
  `stream_room` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sponsors`
--

INSERT INTO `sponsors` (`id`, `name`, `tagline`, `description`, `email`, `email_verified`, `mobile`, `mobile_verified`, `address`, `plan_id`, `stream_room`, `created_at`, `updated_at`, `deleted_at`) VALUES
(14, 'Tata group', 'Multinational conglomerate company', 'Tata Group is an Indian multinational conglomerate holding company headquartered in Mumbai, Maharashtra, India. Founded in 1868 by Jamsetji Tata, the company gained international recognition after purchasing several global companies. One of India\'s largest conglomerates, Tata Group is owned by Tata Sons.', 'nishant.2011in@gmail.com', 1, 9439416692, 1, 'Jamshedpur, Jharkhand', 9, '065642', '2019-03-18 11:21:30', '2019-03-18 11:21:30', NULL),
(15, 'Anjali Group', 'Learn together , Grow together', 'Best fot primary and secondary education', 'contact.anjalisoftwares@gmail.com', 1, 9110918743, 1, 'Patia Bhubaneshwar', 12, '026887', '2019-03-29 06:35:20', '2019-03-29 06:35:20', NULL),
(16, 'Sikhya Vikas Samiti', NULL, 'lorem30;', 'nishant6639@gmail.com', 1, 9439416693, 1, 'lorem30;', 9, '917713', '2019-04-15 14:23:47', '2019-04-15 14:23:47', NULL),
(17, 'Sikhya Vikaas Samiti', NULL, 'lorem30;', 'nishant6635@gmail.com', 1, 9439416694, 1, 'lorem30;', 9, '061650', '2019-04-15 14:24:40', '2019-04-15 14:24:40', NULL),
(18, 'Demo Sponsor', 'This is a demo sponsor for demonstration purpose.', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui', 'demo@codession.com', 1, 9876543210, 1, '123, Patia, Bhubaneswar, India', 9, '906512', '2019-04-27 08:27:05', '2019-04-27 08:27:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `student_answers`
--

CREATE TABLE `student_answers` (
  `id` int(10) UNSIGNED NOT NULL,
  `question_id` int(11) NOT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `exam_appearance_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_answers`
--

INSERT INTO `student_answers` (`id`, `question_id`, `answer`, `exam_appearance_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(20, 33, 'World', 22, '2019-04-12 20:52:16', '2019-04-12 20:52:16', NULL),
(19, 32, '1', 22, '2019-04-12 20:52:06', '2019-04-12 20:52:06', NULL),
(18, 35, 'Ram Nath Kovind', 22, '2019-04-12 20:52:04', '2019-04-12 20:52:04', NULL),
(17, 36, '2', 22, '2019-04-12 20:51:58', '2019-04-14 17:44:33', NULL),
(21, 34, 'Narendra Modi', 22, '2019-04-12 20:52:24', '2019-04-12 20:52:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subgrades`
--

CREATE TABLE `subgrades` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `grade_id` int(10) UNSIGNED NOT NULL,
  `stream_room` text COLLATE utf8mb4_unicode_ci,
  `channel_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `medium` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subgrades`
--

INSERT INTO `subgrades` (`id`, `name`, `grade_id`, `stream_room`, `channel_id`, `medium`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Section A', 1, '079684', NULL, 0, '2019-03-18 19:12:09', '2019-03-19 01:31:39', '2019-03-19 01:31:39'),
(2, 'Section B', 1, '306404', 'nSpt3pnabTc', 1, '2019-03-18 19:12:18', '2019-03-18 19:12:18', NULL),
(3, 'Section C', 1, '825222', NULL, 0, '2019-03-18 19:12:25', '2019-03-18 19:12:25', NULL),
(4, 'Class 123', 2, '849668', NULL, 1, '2019-03-19 13:16:38', '2019-03-19 13:16:38', NULL),
(5, 'class 124', 2, '771416', NULL, 0, '2019-03-19 13:16:55', '2019-03-19 13:16:55', NULL),
(6, '123', 6, '512636', NULL, 0, '2019-04-02 00:37:57', '2019-04-02 00:37:57', NULL),
(7, 'Section A', 1, '582498', NULL, 0, '2019-04-02 11:10:29', '2019-04-02 11:10:29', NULL),
(8, 'Another', 0, '947527', NULL, 0, '2019-04-02 11:29:48', '2019-04-02 11:29:48', NULL),
(9, 'Another', 0, '639731', NULL, 0, '2019-04-02 11:30:03', '2019-04-02 11:30:03', NULL),
(10, 'Grade 3', 0, '717274', NULL, 0, '2019-04-02 11:30:38', '2019-04-02 11:30:38', NULL),
(11, 'Grade 45', 0, '295565', NULL, 0, '2019-04-02 11:32:46', '2019-04-02 11:32:46', NULL),
(12, 'Grade53', 0, '671044', NULL, 0, '2019-04-02 11:33:44', '2019-04-02 11:33:44', NULL),
(13, 'Grade53', 0, '047066', NULL, 0, '2019-04-02 11:33:54', '2019-04-02 11:33:54', NULL),
(14, 'Mtech 1', 1, '495843', NULL, 0, '2019-04-02 11:38:59', '2019-04-27 00:55:46', '2019-04-27 00:55:46'),
(15, 'New', 0, '160622', NULL, 0, '2019-04-02 11:54:48', '2019-04-02 11:54:48', NULL),
(16, 'abcd', 0, '830831', NULL, 0, '2019-04-02 11:56:10', '2019-04-02 11:56:10', NULL),
(17, 'fff', 1, '747742', NULL, 0, '2019-04-02 12:01:51', '2019-04-27 00:55:41', '2019-04-27 00:55:41'),
(18, 'New', 0, '935282', NULL, 0, '2019-04-02 12:02:06', '2019-04-02 12:02:06', NULL),
(19, 'abcd', 0, '655580', NULL, 0, '2019-04-02 12:04:54', '2019-04-02 12:04:54', NULL),
(20, 'abcd', 0, '104089', NULL, 0, '2019-04-02 12:06:22', '2019-04-02 12:06:22', NULL),
(21, 'abcd', 0, '396563', NULL, 0, '2019-04-02 12:12:23', '2019-04-02 12:12:23', NULL),
(22, 'Grade53', 1, '671445', NULL, 0, '2019-04-02 12:27:53', '2019-04-27 00:55:50', '2019-04-27 00:55:50'),
(23, '123', 7, '682257', NULL, 0, '2019-04-02 12:51:42', '2019-04-02 12:51:42', NULL),
(24, 'Section A', 12, '354900', NULL, 0, '2019-04-27 08:30:07', '2019-04-27 08:30:07', NULL),
(25, 'Section B', 6, '146400', NULL, 0, '2019-06-29 02:05:02', '2019-06-29 02:05:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `grade_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `name`, `grade_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(24, 'General Knowlege', 7, '2019-04-02 12:52:09', '2019-04-02 12:52:09', NULL),
(23, 'Maths', 1, '2019-04-02 12:50:48', '2019-04-02 12:50:48', NULL),
(22, 'ଜୀବ ବିଜ୍ଞାନ', 1, '2019-04-02 10:13:36', '2019-04-02 10:13:36', NULL),
(21, 'English', 1, '2019-04-02 10:05:13', '2019-04-02 10:05:13', NULL),
(20, 'Mtech 1', 6, '2019-04-02 00:38:06', '2019-04-02 00:38:06', NULL),
(19, 'Basic Electrical', 2, '2019-03-21 08:29:16', '2019-03-21 08:29:16', NULL),
(25, 'English', 11, '2019-04-15 14:32:49', '2019-04-15 14:32:49', NULL),
(26, 'Physics', 12, '2019-04-27 08:29:58', '2019-04-27 08:29:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `taggable_taggables`
--

CREATE TABLE `taggable_taggables` (
  `tag_id` int(10) UNSIGNED NOT NULL,
  `taggable_id` int(10) UNSIGNED NOT NULL,
  `taggable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `taggable_tags`
--

CREATE TABLE `taggable_tags` (
  `tag_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `normalized` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `texts`
--

CREATE TABLE `texts` (
  `id` int(10) UNSIGNED NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci,
  `textable_id` int(10) UNSIGNED NOT NULL,
  `textable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `texts`
--

INSERT INTO `texts` (`id`, `text`, `textable_id`, `textable_type`, `created_at`, `updated_at`, `deleted_at`) VALUES
(34, '<p>If you did not have a clock, how would</p><p>you decide what time of the day it is?</p><p>Have you ever wondered how our elders</p><p>could tell the approximate time of the</p><p>day by just looking at shadows?</p>', 31, 'App\\Models\\Section', '2019-04-27 10:14:14', '2019-04-27 10:14:14', NULL),
(33, '<p>You are probably familiar with the word speed. In the nexamples given above, a higher speed seems to indicate that a given distance has been covered in a shorter time, or a larger distance covered in a given time.</p><p>The most convenient way to find out which of the two or more objects is moving faster is to compare the distances moved by them in a unit time. &nbsp;Thus, if we know the distance covered by two buses in one hour, we can tell which one is slower. We call the distance covered by an object in a unit time as the speed of the object.</p><p><br></p><p>When we say that a car is moving with a speed of 50 kilometres per hour, it implies that it will cover a distance of</p><p><span style="background-color: transparent;">&nbsp;50 kilometres in one hour. However, a car seldom moves with a constant speed for one hour. In fact, it starts moving slowly and then picks up speed. So, when we say that the car has a speed of 50 kilometres per hour, we usually consider only the total distance covered by it in one hour.&nbsp;</span></p><p><br></p><p>Fig. 13.2 Position of vehicles shown in</p><p>Fig. 13.1 Vehicles moving in the same direction on a road</p>', 30, 'App\\Models\\Section', '2019-04-27 10:11:16', '2019-04-27 10:11:16', NULL),
(28, '<p><strong>Air pollution</strong> is a mix of particles and gases that can reach harmful concentrations both outside and indoors. Its effects can range from higher disease risks to rising temperatures. Soot, smoke, mold, pollen, methane, and carbon dioxide are a just few examples of common&nbsp;<strong>pollutants</strong>&nbsp;</p>', 24, 'App\\Models\\Section', '2019-04-02 17:23:41', '2019-04-02 17:23:41', NULL),
(29, '<p><strong>Water pollution</strong> is the&nbsp;<strong>contamination</strong> of&nbsp;<strong>water</strong>bodies, usually as a result of human activities.&nbsp;<strong>Water</strong>bodies include for example lakes, rivers, oceans, aquifers and groundwater.&nbsp;<strong>Water pollution</strong> results when contaminants are introduced into the natural environment. </p>', 25, 'App\\Models\\Section', '2019-04-02 17:32:06', '2019-04-02 17:32:06', NULL),
(30, NULL, 27, 'App\\Models\\Section', '2019-04-15 15:08:06', '2019-04-15 15:08:06', NULL),
(31, NULL, 28, 'App\\Models\\Section', '2019-04-15 15:09:42', '2019-04-15 15:09:42', NULL),
(32, '<p>We know that some vehicles move faster than others. Even the same vehicle may move faster or slower at different times.</p><p>Make a list of ten objects moving along a straight path. Group the motion of these objects as slow and fast. How did</p><p>you decide which object is moving slow and which one is moving fast. If vehicles are moving on a road in the same direction, we can easily tell which one of them is moving faster than the other</p>', 29, 'App\\Models\\Section', '2019-04-27 09:55:40', '2019-04-27 09:55:40', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `text_answers`
--

CREATE TABLE `text_answers` (
  `id` int(10) UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `grade_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` bigint(20) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `email_verified` tinyint(1) NOT NULL DEFAULT '0',
  `mobile_verified` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `approved` tinyint(1) NOT NULL DEFAULT '0',
  `preferred_lang` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en',
  `organization_id` int(10) UNSIGNED DEFAULT NULL,
  `roll_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emp_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_mobile` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sponsor_id` int(10) UNSIGNED DEFAULT NULL,
  `subgrade_id` int(11) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verify_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_otp` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_otp` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_otp_generated` datetime DEFAULT NULL,
  `mobile_otp_generated` datetime DEFAULT NULL,
  `other_details` text COLLATE utf8mb4_unicode_ci,
  `love_reacter_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `mobile`, `email_verified_at`, `email_verified`, `mobile_verified`, `is_active`, `approved`, `preferred_lang`, `organization_id`, `roll_no`, `emp_id`, `parent_name`, `parent_mobile`, `parent_email`, `sponsor_id`, `subgrade_id`, `remember_token`, `verify_code`, `email_otp`, `mobile_otp`, `email_otp_generated`, `mobile_otp_generated`, `other_details`, `love_reacter_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Nishant', 'nishantsuper@gmail.com', '$2y$10$wpHE3bhwyik2JdGom.wsQeRusyJNy72pryjzZA46eEl2M3CPaIba2', NULL, NULL, 1, 1, 1, 1, 'en', 2, NULL, NULL, NULL, NULL, NULL, 2, 1, 'gGldTkdzY0EWcqDdgHoyd9gfWfWfCKnbpRYNCMjjOOrxSxFCxwNTEZHqLB8b', '', '', '', NULL, NULL, NULL, 3, '2018-10-12 23:53:29', '2019-05-02 16:35:09', NULL),
(82, 'Abhishek', 'std2@gmail.com', '$2y$10$wpHE3bhwyik2JdGom.wsQeRusyJNy72pryjzZA46eEl2M3CPaIba2', 9110000101, NULL, 1, 1, 1, 1, 'en', 19, NULL, NULL, NULL, NULL, NULL, NULL, 23, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 34, '2019-04-02 13:12:07', '2019-04-02 13:12:07', NULL),
(83, 'Avinash', 'teacher1@gmail.com', '$2y$10$wpHE3bhwyik2JdGom.wsQeRusyJNy72pryjzZA46eEl2M3CPaIba2', 9100100111, NULL, 1, 1, 1, 1, 'en', 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 35, '2019-04-02 13:13:50', '2019-04-02 13:13:50', NULL),
(81, 'Aakash', 'std1@gmail.com', '$2y$10$wpHE3bhwyik2JdGom.wsQeRusyJNy72pryjzZA46eEl2M3CPaIba2', 9110000100, NULL, 1, 1, 1, 1, 'en', 2, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, '2019-04-02 13:09:53', '2019-04-13 00:54:32', NULL),
(71, 'Prity', 'prity@gmail.com', '$2y$10$wpHE3bhwyik2JdGom.wsQeRusyJNy72pryjzZA46eEl2M3CPaIba2', 8951538990, NULL, 1, 1, 1, 1, 'en', 21, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23, '2019-03-21 08:32:46', '2019-03-21 08:32:46', NULL),
(72, 'Motilal Nehru Public School - Campus 2 Admin', 'xyz@gmail.com', '$2y$10$dlwIQHsUDVTfAT80QgnQnePiqJKulHQBAfzeaVCIIOHpFIRds2lhK', NULL, NULL, 0, 0, 1, 0, 'en', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 24, '2019-03-21 16:40:50', '2019-03-21 16:40:50', NULL),
(73, 'Anjali Group Admin', 'contact.anjalisoftwares@gmail.com', '$2y$10$wpHE3bhwyik2JdGom.wsQeRusyJNy72pryjzZA46eEl2M3CPaIba2', NULL, NULL, 1, 1, 1, 0, 'en', NULL, NULL, NULL, NULL, NULL, NULL, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25, '2019-03-29 06:35:21', '2019-03-29 06:35:21', NULL),
(80, 'Demo Organization Admin', 'demoorg@gmail.com', '$2y$10$wpHE3bhwyik2JdGom.wsQeRusyJNy72pryjzZA46eEl2M3CPaIba2', NULL, NULL, 1, 0, 1, 0, 'en', 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 32, '2019-04-02 12:49:39', '2019-04-02 12:49:39', NULL),
(79, 'Nishant Kumar', 'nishant.2010in@gmail.com', '$2y$10$d5r0zJ8c2aFTwIkNSTKeIelYe61VhDV12MRmqOWhtQWso9mll4Al6', 9439416692, NULL, 1, 1, 1, 1, 'en', 1, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 31, '2019-04-02 10:00:22', '2019-04-02 10:00:22', NULL),
(66, 'Aakash Kumar', 'aakash141991@gmail.com', '$2y$10$SkLbEKfSDpGTyM7VLdFg0.opYaBmhZCh8k8gKITySBZVOL2vL02eG', 7463024673, NULL, 1, 1, 1, 1, 'en', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, '2019-03-18 00:20:14', '2019-03-31 23:43:30', NULL),
(70, 'RVS Enginnering College Admin', 'rvs@gmail.com', '$2y$10$wpHE3bhwyik2JdGom.wsQeRusyJNy72pryjzZA46eEl2M3CPaIba2', NULL, NULL, 1, 0, 1, 0, 'en', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 22, '2019-03-19 13:10:37', '2019-03-19 13:10:37', NULL),
(67, 'Nishant Kumar', 'nishant6639@gmail.com', '$2y$10$SkLbEKfSDpGTyM7VLdFg0.opYaBmhZCh8k8gKITySBZVOL2vL02eG', 8249100846, NULL, 1, 1, 1, 1, 'en', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 19, '2019-03-18 00:24:42', '2019-06-26 00:32:42', NULL),
(68, 'Tata group Admin', 'nishant.2011in@gmail.com', '$2y$10$ByswN1exxfu1pCS5TitVKOOoRKDSNEWCaoD7N2wzMeDccVGj1glDG', NULL, NULL, 1, 1, 1, 0, 'en', NULL, NULL, NULL, NULL, NULL, NULL, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 20, '2019-03-18 11:21:31', '2019-03-18 11:21:31', NULL),
(69, 'Motilal Nehru Public School Admin', 'nishant060990@gmail.com', '$2y$10$ucXZYz1Dah6aS42cYpOFJ..KfqzLetgLfo6UGcwR95qJ/CtQNrN5K', NULL, NULL, 1, 0, 1, 0, 'en', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 21, '2019-03-18 11:42:52', '2019-03-18 11:42:52', NULL),
(84, 'Usha', 'teacher2@gmail.com', '$2y$10$wpHE3bhwyik2JdGom.wsQeRusyJNy72pryjzZA46eEl2M3CPaIba2', 7463024676, NULL, 1, 1, 1, 1, 'en', 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 36, '2019-04-02 13:15:26', '2019-04-02 13:15:26', NULL),
(85, 'std5', 'std5@gmail.com', '$2y$10$wpHE3bhwyik2JdGom.wsQeRusyJNy72pryjzZA46eEl2M3CPaIba2', 9004004004, NULL, 1, 0, 1, 0, 'en', 2, '001', '', 'guard1', '9005005005', 'guard1@gmail.com', NULL, NULL, NULL, NULL, '093830', '7162', '2019-04-08 08:29:31', '2019-04-08 08:29:31', 'grade 5', 37, '2019-04-08 08:29:31', '2019-04-08 08:29:31', NULL),
(86, 'New Demo Teacher', 'tchr5@gmail.com', '$2y$10$/4BNLx3YP8INI6JXR7SeHuwfnZALCfTJZkFKKQPfQ/TesUaAARHw6', 9009009009, NULL, 0, 0, 0, 0, 'en', 21, '', 'Emp4006', '', '', '', NULL, NULL, NULL, NULL, '855629', '3528', '2019-04-08 08:33:02', '2019-04-08 08:33:02', 'grade 5', 38, '2019-04-08 08:33:02', '2019-04-08 08:33:02', NULL),
(87, 'Sikhya Vikaas Samiti Admin', 'nishant6635@gmail.com', '$2y$10$4EyT7ChmLIy3XXfFNyZR2.ccs1WXOoBYeCooetTGXw1lbyqubF2te', NULL, NULL, 1, 1, 1, 0, 'en', NULL, NULL, NULL, NULL, NULL, NULL, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 39, '2019-04-15 14:24:41', '2019-04-15 14:24:41', NULL),
(88, 'OTET Admin', 'abcd@xyz.com', '$2y$10$DHJKO2WqZYASFfMEaLQXqulKpbIriT.u9X2/qcEeqosh.Et66IGYW', NULL, NULL, 0, 0, 1, 0, 'en', 20, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 40, '2019-04-15 14:31:45', '2019-04-15 14:31:45', NULL),
(89, 'Demo Sponsor Admin', 'demo@codession.com', '$2y$10$2tVWpZAfbS0ncS6coSWszuqwjY13jST/dS8Oghzov.QpFmB.NS4km', NULL, NULL, 1, 1, 1, 0, 'en', NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 41, '2019-04-27 08:27:05', '2019-04-27 08:27:05', NULL),
(90, 'New Demo Organization Admin', 'demo_org@codession.com', '$2y$10$/6pRDKCFH7vHR9MVQJ6L9OsD3Sp3nHc59Q8s1wX1jMTwUYNhwlZle', NULL, NULL, 0, 0, 1, 0, 'en', 21, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 42, '2019-04-27 08:29:19', '2019-04-27 08:29:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` int(10) UNSIGNED NOT NULL,
  `video` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video_size` bigint(20) DEFAULT NULL,
  `videoable_id` int(10) UNSIGNED NOT NULL,
  `videoable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `video`, `video_type`, `video_size`, `videoable_id`, `videoable_type`, `created_at`, `updated_at`, `deleted_at`) VALUES
(7, 'daZSU7X9ESJ1nK9X46qGXuVv84TLsT3oMZwbmamU.mp4', NULL, NULL, 25, 'App\\Models\\Section', '2019-04-02 17:58:51', '2019-04-02 17:58:51', NULL),
(6, 'BR87EDdipOOXCtDfU0wRRMNtuYtF0QdbBuo6SsMA.mp4', NULL, NULL, 24, 'App\\Models\\Section', '2019-04-02 17:58:04', '2019-04-02 17:58:04', NULL),
(8, '9jAWkPv8rbevTTf7kO8qi95E7JHzbIcU3IT5AziJ.mp4', NULL, NULL, 25, 'App\\Models\\Section', '2019-04-02 17:58:55', '2019-04-02 17:58:55', NULL),
(9, 'xpGCiEhTf7jY0krSZiRfTLfmj1a7QCMqA8P5zWtZ.mp4', NULL, NULL, 26, 'App\\Models\\Section', '2019-04-15 15:03:33', '2019-04-15 15:03:33', NULL),
(10, 'OXJYXWLxvHvUcNmz59J8doo8qh9M5xeI1F9O90CS.mp4', NULL, NULL, 27, 'App\\Models\\Section', '2019-04-15 15:07:55', '2019-04-15 15:07:55', NULL),
(11, 'NgHbCiWQwK7u4XoaT3vVqapFHj7APzK4gJCE3kaB.mp4', NULL, NULL, 28, 'App\\Models\\Section', '2019-04-15 15:09:21', '2019-04-15 15:09:21', NULL),
(12, 'i3rixejxXP2qRFhWbo9sy7uYrnQoRFXRcYVaJiiR.mp4', NULL, NULL, 30, 'App\\Models\\Section', '2019-04-27 10:15:37', '2019-04-27 10:15:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `videourls`
--

CREATE TABLE `videourls` (
  `id` int(10) UNSIGNED NOT NULL,
  `videourl` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `videourlable_id` int(10) UNSIGNED NOT NULL,
  `videourlable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `videourls`
--

INSERT INTO `videourls` (`id`, `videourl`, `videourlable_id`, `videourlable_type`, `created_at`, `updated_at`, `deleted_at`) VALUES
(10, 'MWx947B4Mpk', 29, 'App\\Models\\Section', '2019-04-27 10:03:49', '2019-04-27 10:03:49', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activity_log_log_name_index` (`log_name`);

--
-- Indexes for table `chapters`
--
ALTER TABLE `chapters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chapters_subject_id_foreign` (`subject_id`);

--
-- Indexes for table `classroom_assigned_subjects`
--
ALTER TABLE `classroom_assigned_subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classroom_assigned_users`
--
ALTER TABLE `classroom_assigned_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_commentable_type_commentable_id_index` (`commentable_type`,`commentable_id`),
  ADD KEY `comments_creator_type_creator_id_index` (`creator_type`,`creator_id`),
  ADD KEY `comments__lft__rgt_parent_id_index` (`_lft`,`_rgt`,`parent_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `departments_organization_id_foreign` (`organization_id`);

--
-- Indexes for table `disk_usages`
--
ALTER TABLE `disk_usages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exams_subgrade_id_foreign` (`subgrade_id`),
  ADD KEY `exams_subject_id_foreign` (`subject_id`),
  ADD KEY `exams_topic_id_foreign` (`topic_id`);

--
-- Indexes for table `exam_appearances`
--
ALTER TABLE `exam_appearances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam_organizers`
--
ALTER TABLE `exam_organizers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_organizers_exam_id_foreign` (`exam_id`);

--
-- Indexes for table `forum_comments`
--
ALTER TABLE `forum_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `forum_comments_forum_topic_id_foreign` (`forum_topic_id`);

--
-- Indexes for table `forum_topics`
--
ALTER TABLE `forum_topics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `forum_topics_user_id_foreign` (`user_id`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `grades_program_id_foreign` (`program_id`);

--
-- Indexes for table `individual_results`
--
ALTER TABLE `individual_results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `individual_results_exam_appearance_id_foreign` (`exam_appearance_id`);

--
-- Indexes for table `introductions`
--
ALTER TABLE `introductions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lesson_plans`
--
ALTER TABLE `lesson_plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `love_reactants`
--
ALTER TABLE `love_reactants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `love_reactants_type_index` (`type`);

--
-- Indexes for table `love_reactant_reaction_counters`
--
ALTER TABLE `love_reactant_reaction_counters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `love_reactant_reaction_counters_reactant_id_index` (`reactant_id`),
  ADD KEY `love_reactant_reaction_counters_reaction_type_id_index` (`reaction_type_id`),
  ADD KEY `love_reactant_reaction_counters_reactant_reaction_type_index` (`reactant_id`,`reaction_type_id`);

--
-- Indexes for table `love_reactant_reaction_totals`
--
ALTER TABLE `love_reactant_reaction_totals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `love_reactant_reaction_totals_reactant_id_index` (`reactant_id`);

--
-- Indexes for table `love_reacters`
--
ALTER TABLE `love_reacters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `love_reacters_type_index` (`type`);

--
-- Indexes for table `love_reactions`
--
ALTER TABLE `love_reactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `love_reactions_reactant_id_index` (`reactant_id`),
  ADD KEY `love_reactions_reacter_id_index` (`reacter_id`),
  ADD KEY `love_reactions_reaction_type_id_index` (`reaction_type_id`),
  ADD KEY `love_reactions_reactant_id_reaction_type_id_index` (`reactant_id`,`reaction_type_id`),
  ADD KEY `love_reactions_reactant_id_reacter_id_reaction_type_id_index` (`reactant_id`,`reacter_id`,`reaction_type_id`),
  ADD KEY `love_reactions_reactant_id_reacter_id_index` (`reactant_id`,`reacter_id`),
  ADD KEY `love_reactions_reacter_id_reaction_type_id_index` (`reacter_id`,`reaction_type_id`);

--
-- Indexes for table `love_reaction_types`
--
ALTER TABLE `love_reaction_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `love_reaction_types_name_index` (`name`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `media_model_type_model_id_index` (`model_type`,`model_id`);

--
-- Indexes for table `medialibrary_attachable`
--
ALTER TABLE `medialibrary_attachable`
  ADD KEY `medialibrary_attachable_file_id_foreign` (`file_id`),
  ADD KEY `medialibrary_attachable_attachable_id_attachable_type_index` (`attachable_id`,`attachable_type`);

--
-- Indexes for table `medialibrary_categories`
--
ALTER TABLE `medialibrary_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `medialibrary_categories_owner_id_foreign` (`owner_id`),
  ADD KEY `medialibrary_categories_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `medialibrary_files`
--
ALTER TABLE `medialibrary_files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `medialibrary_files_owner_id_foreign` (`owner_id`),
  ADD KEY `medialibrary_files_category_id_foreign` (`category_id`);

--
-- Indexes for table `medialibrary_transformations`
--
ALTER TABLE `medialibrary_transformations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `medialibrary_transformations_file_id_foreign` (`file_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message_counters`
--
ALTER TABLE `message_counters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `notices`
--
ALTER TABLE `notices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notices_subgrade_id_foreign` (`subgrade_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_personal_access_clients_client_id_index` (`client_id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `options_question_id_foreign` (`question_id`);

--
-- Indexes for table `organizations`
--
ALTER TABLE `organizations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `organizations_name_unique` (`name`),
  ADD UNIQUE KEY `organizations_email_unique` (`email`),
  ADD UNIQUE KEY `organizations_mobile_unique` (`mobile`),
  ADD KEY `organizations_sponsor_id_foreign` (`sponsor_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `plans_name_unique` (`name`);

--
-- Indexes for table `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `programs_department_id_foreign` (`department_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `questions_question_group_id_foreign` (`question_group_id`);

--
-- Indexes for table `question_groups`
--
ALTER TABLE `question_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question_sets`
--
ALTER TABLE `question_sets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_sets_exam_id_foreign` (`exam_id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registered_users`
--
ALTER TABLE `registered_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `results_exam_id_foreign` (`exam_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sections_chapter_id_foreign` (`chapter_id`);

--
-- Indexes for table `sponsors`
--
ALTER TABLE `sponsors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sponsors_name_unique` (`name`),
  ADD UNIQUE KEY `sponsors_email_unique` (`email`),
  ADD UNIQUE KEY `sponsors_mobile_unique` (`mobile`),
  ADD KEY `sponsors_plan_id_foreign` (`plan_id`);

--
-- Indexes for table `student_answers`
--
ALTER TABLE `student_answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subgrades`
--
ALTER TABLE `subgrades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subgrades_grade_id_foreign` (`grade_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subjects_subgrade_id_foreign` (`grade_id`);

--
-- Indexes for table `taggable_taggables`
--
ALTER TABLE `taggable_taggables`
  ADD KEY `i_taggable_fwd` (`tag_id`,`taggable_id`),
  ADD KEY `i_taggable_rev` (`taggable_id`,`tag_id`),
  ADD KEY `i_taggable_type` (`taggable_type`);

--
-- Indexes for table `taggable_tags`
--
ALTER TABLE `taggable_tags`
  ADD PRIMARY KEY (`tag_id`),
  ADD KEY `taggable_tags_normalized_index` (`normalized`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `texts`
--
ALTER TABLE `texts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `text_answers`
--
ALTER TABLE `text_answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `text_answers_question_id_foreign` (`question_id`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `topics_grade_id_foreign` (`grade_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_mobile_unique` (`mobile`),
  ADD KEY `users_organization_id_foreign` (`organization_id`),
  ADD KEY `users_sponsor_id_foreign` (`sponsor_id`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `videourls`
--
ALTER TABLE `videourls`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=375;
--
-- AUTO_INCREMENT for table `chapters`
--
ALTER TABLE `chapters`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `classroom_assigned_subjects`
--
ALTER TABLE `classroom_assigned_subjects`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `classroom_assigned_users`
--
ALTER TABLE `classroom_assigned_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `disk_usages`
--
ALTER TABLE `disk_usages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `exam_appearances`
--
ALTER TABLE `exam_appearances`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `exam_organizers`
--
ALTER TABLE `exam_organizers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `forum_comments`
--
ALTER TABLE `forum_comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `forum_topics`
--
ALTER TABLE `forum_topics`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `individual_results`
--
ALTER TABLE `individual_results`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `introductions`
--
ALTER TABLE `introductions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `lesson_plans`
--
ALTER TABLE `lesson_plans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `love_reactants`
--
ALTER TABLE `love_reactants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `love_reactant_reaction_counters`
--
ALTER TABLE `love_reactant_reaction_counters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `love_reactant_reaction_totals`
--
ALTER TABLE `love_reactant_reaction_totals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `love_reacters`
--
ALTER TABLE `love_reacters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `love_reactions`
--
ALTER TABLE `love_reactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `love_reaction_types`
--
ALTER TABLE `love_reaction_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;
--
-- AUTO_INCREMENT for table `medialibrary_categories`
--
ALTER TABLE `medialibrary_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `medialibrary_transformations`
--
ALTER TABLE `medialibrary_transformations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `message_counters`
--
ALTER TABLE `message_counters`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
--
-- AUTO_INCREMENT for table `notices`
--
ALTER TABLE `notices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `organizations`
--
ALTER TABLE `organizations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `question_groups`
--
ALTER TABLE `question_groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `question_sets`
--
ALTER TABLE `question_sets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `registered_users`
--
ALTER TABLE `registered_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `sponsors`
--
ALTER TABLE `sponsors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `student_answers`
--
ALTER TABLE `student_answers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `subgrades`
--
ALTER TABLE `subgrades`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `taggable_tags`
--
ALTER TABLE `taggable_tags`
  MODIFY `tag_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `texts`
--
ALTER TABLE `texts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `text_answers`
--
ALTER TABLE `text_answers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;
--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `videourls`
--
ALTER TABLE `videourls`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
