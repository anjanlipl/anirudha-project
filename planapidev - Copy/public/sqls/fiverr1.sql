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
-- Database: `fiverr1`
--

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
(2, '2014_10_12_100000_create_password_resets_table', 1);

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
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` text,
  `category_id` int(11) DEFAULT NULL,
  `moderator` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `start_date` datetime DEFAULT NULL,
  `start_month` int(11) NOT NULL,
  `start_year` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `name`, `description`, `category_id`, `moderator`, `status`, `start_date`, `start_month`, `start_year`, `created_at`, `updated_at`) VALUES
(1, 'New Project', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam et fermentum dui. Ut orci quam, ornare sed lorem sed, hendrerit auctor dolor. Nulla viverra, nibh quis ultrices malesuada, ligula ipsum vulputate diam, aliquam egestas nibh ante vel dui. Sed in tellus interdum eros vulputate placerat sed non enim. Pellentesque eget justo porttitor urna dictum fermentum sit amet sed mauris. Praesent.', 0, 6, 50, '2019-05-23 00:00:00', 5, 2019, '2019-04-28 08:29:21', '2019-04-28 08:29:21'),
(2, 'Another Project', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam et fermentum dui. Ut orci quam, ornare sed lorem sed, hendrerit auctor dolor. Nulla viverra, nibh quis ultrices malesuada, ligula ipsum vulputate diam, aliquam egestas nibh ante vel dui. Sed in tellus interdum eros vulputate placerat sed non enim. Pellentesque eget justo porttitor urna dictum fermentum sit amet sed mauris. Praesent molestie vestibulum erat ac rhoncus. Aenean nunc risus, accumsan nec ipsum et, convallis sollicitudin dui. Proin dictum quam a semper.', 1, 3, 65, '2019-05-15 00:00:00', 5, 2019, '2019-04-28 08:47:38', '2019-05-01 21:38:55'),
(4, 'Project 3', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam et fermentum dui. Ut orci quam, ornare sed lorem sed, hendrerit auctor dolor. Nulla viverra, nibh quis ultrices malesuada, ligula ipsum vulputate diam, aliquam egestas nibh ante vel dui. Sed in tellus interdum eros vulputate placerat sed non enim. Pellentesque eget justo porttitor urna dictum fermentum sit amet sed mauris. Praesent.', NULL, 1, 0, '2019-06-04 00:00:00', 6, 2019, '2019-04-30 06:53:31', '2019-04-30 06:53:31'),
(5, 'The "Pulse" video series', 'A series of candid converastions with locals.', 9, 7, 84, '2019-06-15 00:00:00', 6, 2019, '2019-05-08 19:20:25', '2019-05-08 19:58:06');

-- --------------------------------------------------------

--
-- Table structure for table `project_category`
--

CREATE TABLE `project_category` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project_category`
--

INSERT INTO `project_category` (`id`, `name`, `created_at`, `updated_at`) VALUES
(9, 'Film Projects', '2019-05-08 19:13:44', '2019-05-08 19:13:44'),
(10, 'Photo Projects', '2019-05-08 19:14:26', '2019-05-08 19:14:26'),
(11, 'Dance Projects', '2019-05-08 19:14:35', '2019-05-08 19:14:35'),
(12, 'Theatre Projects', '2019-05-08 19:14:48', '2019-05-08 19:14:48');

-- --------------------------------------------------------

--
-- Table structure for table `project_users`
--

CREATE TABLE `project_users` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_moderator` int(11) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project_users`
--

INSERT INTO `project_users` (`id`, `project_id`, `user_id`, `is_moderator`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 0, NULL, NULL),
(2, 2, 6, 0, NULL, '2019-04-28 14:58:34'),
(3, 2, 3, 1, '2019-04-28 14:18:29', '2019-04-28 14:58:34'),
(4, 2, 1, 0, '2019-04-28 14:41:20', '2019-04-28 14:58:34'),
(5, 1, 6, 1, '2019-04-28 15:19:36', '2019-04-28 15:19:36'),
(6, 3, 1, 1, '2019-04-30 06:51:36', '2019-04-30 06:51:36'),
(7, 4, 1, 1, '2019-04-30 06:53:31', '2019-04-30 06:53:31'),
(8, 4, 6, 0, '2019-04-30 06:54:26', '2019-04-30 06:54:26'),
(9, 4, 3, 0, '2019-04-30 06:55:37', '2019-04-30 06:55:37'),
(10, 5, 7, 1, '2019-05-08 19:20:25', '2019-05-08 19:20:25');

-- --------------------------------------------------------

--
-- Table structure for table `urls`
--

CREATE TABLE `urls` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `url` text NOT NULL,
  `image` text NOT NULL,
  `category` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `urls`
--

INSERT INTO `urls` (`id`, `title`, `description`, `url`, `image`, `category`, `created_at`, `updated_at`) VALUES
(4, 'Navigate your next', 'Infosys, a global leader in technology services & consulting, helps clients in more than 50 countries to create & execute digital transformation strategies.', 'https://www.infosys.com', 'https://www.infosys.com/SiteCollectionImages/navigate-the-next-03.jpg', 1, '2019-04-28 18:07:23', '2019-04-28 18:07:23'),
(9, 'Flaticon, the largest database of free vector icons', '1,685,000+ Free vector icons in SVG, PSD, PNG, EPS format or as ICON FONT. Thousands of free icons in the largest database of free vector icons!', 'https://flaticon.com', 'https://image.flaticon.com/share/flaticon-generic.jpg', 2, '2019-05-01 22:06:03', '2019-05-01 22:06:03'),
(15, 'Clutch - B2B Ratings & Reviews', 'Ratings and reviews of leading IT, marketing, and business services companies. Clutch is your data-driven field guide for B2B buying and hiring decisions.', 'http://CLUTCH.CO', '/uploads/urls/1557342480.png', 6, '2019-05-08 19:08:02', '2019-05-08 19:08:02'),
(17, 'Art Gallery | Arts Council of Wayne County | United States', 'The Arts Council of Wayne County is a nonprofit ensuring the thrive of art in the community! We have a rental space, an art gallery, and studios. The Art Market is a spot for artists to sell their own work. We offer voice, music, and art lessons. Check us out!', 'https://www.artsinwayne.org', '/uploads/urls/1557342602.png', 7, '2019-05-08 19:10:03', '2019-05-08 19:10:03'),
(18, 'Responsive web design tool, CMS, and hosting platform | Webflow', 'Build responsive websites in your browser, then host with us or export your code to host wherever. Discover the professional website builder made for designers.', 'https://webflow.com', '/uploads/urls/1557366072.png', 2, '2019-05-09 01:41:13', '2019-05-09 01:41:13'),
(20, 'Monday - team management software | monday.com', 'Monday.com is a tool that simplifies the way teams work together - Manage workload, track projects, move work forward, communicate with people - Adopt a management tool that people actually love to use, one that\'s fast, beautiful, easy to use and makes their work easier - start now for free!', 'https://monday.com', 'https://s3.amazonaws.com/general-assets/monday-120x120.png', 8, '2019-05-14 06:08:49', '2019-05-14 06:08:49'),
(21, 'ArtStation', 'ArtStation is the leading showcase platform for games, film, media & entertainment artists.', 'http://Artstation.com', 'https://www.artstation.com/images/facebook.jpg', 9, '2019-05-14 06:10:08', '2019-05-14 06:10:08'),
(24, 'Fiverr - Freelance Services Marketplace for The Lean Entrepreneur', 'Fiverr is the world\'s largest freelance services marketplace for lean entrepreneurs to focus on growth & create a successful business at affordable costs', 'http://fiverr.com', 'https://fiverr-res.cloudinary.com/q_auto,f_auto,w_496,dpr_1.0/general_assets/logged_out_homepage/assets/hero/900-darren2x.png', 2, '2019-05-14 18:23:22', '2019-05-14 18:23:22');

-- --------------------------------------------------------

--
-- Table structure for table `url_category`
--

CREATE TABLE `url_category` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `url_category`
--

INSERT INTO `url_category` (`id`, `name`, `created_at`, `updated_at`) VALUES
(2, 'Technology', '2019-04-28 00:00:00', '2019-04-28 00:00:00'),
(3, 'Instagram Marketing', '2019-05-02 23:48:12', '2019-05-02 23:48:12'),
(4, 'Business Plans', '2019-05-08 19:05:43', '2019-05-08 19:05:43'),
(6, 'Have Software Built', '2019-05-08 19:06:43', '2019-05-08 19:06:43'),
(7, 'Local Arts Organizations', '2019-05-08 19:08:42', '2019-05-08 19:08:42'),
(8, 'Project Management Tools', '2019-05-11 20:01:44', '2019-05-11 20:01:44'),
(9, 'Illustration', '2019-05-14 06:09:54', '2019-05-14 06:09:54'),
(10, 'Videogames', '2019-05-14 06:10:27', '2019-05-14 06:10:27'),
(11, 'Stock Music', '2019-05-14 06:38:01', '2019-05-14 06:38:01');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bio` text COLLATE utf8mb4_unicode_ci,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_plain` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_admin` tinyint(4) NOT NULL DEFAULT '0',
  `category_id` int(11) DEFAULT '0',
  `is_guest` tinyint(4) NOT NULL DEFAULT '0',
  `mobile` text COLLATE utf8mb4_unicode_ci,
  `image` text COLLATE utf8mb4_unicode_ci,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `bio`, `email`, `password`, `password_plain`, `is_admin`, `category_id`, `is_guest`, `mobile`, `image`, `remember_token`, `created_at`, `updated_at`) VALUES
(7, 'J. M. Moore', 'J.M.Moore', 'jeramymoore1234@gmail.com', '$2y$10$wdag6leRIq45xgh0zI1TmO/zM1uFWfX7XQPSXuWtWJPseMs4hc5te', '7vuSV.[C', 1, 0, 0, '8043144936', '1557814530.jpg', 'ixbBi1YMbHOXhbQyyqWEvH7LywCR7cGppF5fu4IAcNu4KJedl4tpXds9XUxJ', '2019-05-02 20:16:42', '2019-05-14 06:15:30'),
(8, 'Nishant Kumar', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam et fermentum dui. Ut orci quam, ornare sed lorem sed, hendrerit auctor dolor.', 'nishant6639@gmail.com', '$2y$10$FGob4nTutUKEOD1tCiTtJeNk.1xNsCE4BhcmFvm72ABxyjmQxUp2O', '', 1, 1, 0, '9322233432', '1557810884.jpeg', '4WpBUwP35RQuarqEttGPjCCtWpcW5xfNj8kqSwiB9J3WIaUtLVYbJag4cSe2', NULL, '2019-05-14 05:14:44'),
(11, 'Guest', NULL, 'guest@guest.com', '$2y$10$FGob4nTutUKEOD1tCiTtJeNk.1xNsCE4BhcmFvm72ABxyjmQxUp2O', 'september6', 0, 0, 1, NULL, NULL, 'VD2CRtBCRAaUfMFTtf0MFkzi0skls6Tl6p0cj4YqIGkyQtNBPEfb6uox7lgR', '2019-05-07 05:55:52', '2019-05-07 05:55:52'),
(12, 'Dale fey', NULL, 'dlfey@waynecc.edu', '$2y$10$UCrxOEYqDYg7m1lDMdaruu8zkIKm.G.bXf9lldXEU79mg8FPlk/Gm', 'Marshall&44', 1, 0, 0, NULL, NULL, NULL, '2019-05-08 19:55:37', '2019-05-11 19:52:14'),
(14, 'Lara Landers', NULL, 'laral@waynecountychamber.com', '$2y$10$oSBowBxIZgf6uUc3pKZBPe0U1OVa1ShVAuJafVtF9e77n84km7po6', 'chamber', 0, 0, 0, '919-920-5949', NULL, NULL, '2019-05-10 14:35:44', '2019-05-10 14:36:28');

-- --------------------------------------------------------

--
-- Table structure for table `user_category`
--

CREATE TABLE `user_category` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_category`
--

INSERT INTO `user_category` (`id`, `name`, `created_at`, `updated_at`) VALUES
(3, 'Models', '2019-05-11 19:58:39', '2019-05-11 19:58:39'),
(4, 'Woodworkers', '2019-05-11 19:58:48', '2019-05-11 19:58:48'),
(5, 'Carpenters', '2019-05-11 19:58:56', '2019-05-11 19:58:56'),
(6, 'Musicians', '2019-05-11 19:59:51', '2019-05-11 19:59:51'),
(7, 'Videographers', '2019-05-11 20:00:08', '2019-05-11 20:00:08'),
(8, 'Painters', '2019-05-11 20:00:15', '2019-05-11 20:00:15'),
(9, 'Blacksmiths', '2019-05-11 20:00:25', '2019-05-11 20:00:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_category`
--
ALTER TABLE `project_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_users`
--
ALTER TABLE `project_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `urls`
--
ALTER TABLE `urls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `url_category`
--
ALTER TABLE `url_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_category`
--
ALTER TABLE `user_category`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `project_category`
--
ALTER TABLE `project_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `project_users`
--
ALTER TABLE `project_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `urls`
--
ALTER TABLE `urls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `url_category`
--
ALTER TABLE `url_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `user_category`
--
ALTER TABLE `user_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
