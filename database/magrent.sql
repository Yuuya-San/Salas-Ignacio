-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 13, 2024 at 05:12 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `magrent`
--

-- --------------------------------------------------------

--
-- Table structure for table `amenities`
--

CREATE TABLE `amenities` (
  `id` int(11) NOT NULL,
  `amenities` varchar(145) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `amenities`
--

INSERT INTO `amenities` (`id`, `amenities`, `created_at`, `updated_at`) VALUES
(1, 'Air Conditioned', '2023-12-04 04:07:09', NULL),
(2, 'Swimming Pool', '2023-12-04 04:07:18', '2023-12-04 04:08:04'),
(3, 'Washer & Dryer', '2023-12-04 04:07:09', '2023-12-04 04:08:13'),
(4, 'Washing Machine', '2023-12-04 04:07:18', '2023-12-04 04:08:20'),
(5, 'Gym', '2023-12-04 04:07:09', '2023-12-04 04:08:30'),
(6, 'Basketball Court', '2023-12-04 04:07:18', '2023-12-04 04:08:37'),
(7, 'Refrigerator', '2023-12-04 04:07:09', '2023-12-04 04:08:44'),
(8, 'Internet', '2023-12-04 04:07:18', '2023-12-04 04:08:50'),
(9, 'Kithchen', '2023-12-04 04:07:09', '2023-12-04 04:08:56'),
(10, 'Closet', '2023-12-04 04:07:18', '2023-12-04 04:09:04'),
(11, 'Dining Table', '2023-12-04 04:07:09', '2023-12-04 04:09:11'),
(12, 'Smart TV', '2023-12-04 04:07:18', '2023-12-04 04:09:17');

-- --------------------------------------------------------

--
-- Table structure for table `business_hours`
--

CREATE TABLE `business_hours` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `visitation_hours_from` time DEFAULT NULL,
  `visitation_hours_to` time DEFAULT NULL,
  `visitation_days` varchar(145) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `business_hours`
--

INSERT INTO `business_hours` (`id`, `user_id`, `visitation_hours_from`, `visitation_hours_to`, `visitation_days`, `created_at`, `updated_at`) VALUES
(1, 17, '13:08:00', '00:03:00', '1, 2, 3, 5', '2024-03-08 02:04:15', '2024-03-08 02:23:42');

-- --------------------------------------------------------

--
-- Table structure for table `day`
--

CREATE TABLE `day` (
  `id` int(14) NOT NULL,
  `day` varchar(145) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `day`
--

INSERT INTO `day` (`id`, `day`, `created_at`, `updated_at`) VALUES
(1, 'Monday', '2023-12-10 01:22:38', NULL),
(2, 'Tuesday', '2023-12-10 01:22:38', '2023-12-10 01:23:06'),
(3, 'Wednesday', '2023-12-10 01:22:38', '2023-12-10 01:23:13'),
(4, 'Thursday', '2023-12-10 01:22:38', '2023-12-10 01:23:19'),
(5, 'Friday', '2023-12-10 01:22:38', '2023-12-10 01:23:23'),
(6, 'Saturday', '2023-12-10 01:22:38', '2023-12-10 01:23:28'),
(7, 'Sunday', '2023-12-10 01:22:38', '2023-12-10 01:23:31');

-- --------------------------------------------------------

--
-- Table structure for table `email_config`
--

CREATE TABLE `email_config` (
  `Id` int(145) NOT NULL,
  `email` varchar(145) DEFAULT NULL,
  `password` varchar(145) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `email_config`
--

INSERT INTO `email_config` (`Id`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'ecket2023@gmail.com', 'vnvbophnoxickore\n', '2023-02-20 03:25:24', '2023-07-12 02:41:39');

-- --------------------------------------------------------

--
-- Table structure for table `google_maps_api`
--

CREATE TABLE `google_maps_api` (
  `id` int(145) NOT NULL,
  `api` varchar(145) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `google_maps_api`
--

INSERT INTO `google_maps_api` (`id`, `api`, `created_at`, `updated_at`) VALUES
(1, 'AIzaSyCzYdQJTyqPkzfTsVEwzJSSgQhe_Qg9OLI', '2023-12-03 08:39:56', '2023-12-03 14:10:34');

-- --------------------------------------------------------

--
-- Table structure for table `google_recaptcha_api`
--

CREATE TABLE `google_recaptcha_api` (
  `Id` int(11) NOT NULL,
  `site_key` varchar(145) DEFAULT NULL,
  `site_secret_key` varchar(145) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `google_recaptcha_api`
--

INSERT INTO `google_recaptcha_api` (`Id`, `site_key`, `site_secret_key`, `created_at`, `updated_at`) VALUES
(1, '6LdiQZQhAAAAABpaNFtJpgzGpmQv2FwhaqNj2azh', '6LdiQZQhAAAAAByS6pnNjOs9xdYXMrrW2OeTFlrm', '2023-02-19 16:57:18', '2023-08-12 16:48:04');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `activity` varchar(145) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `user_id`, `activity`, `created_at`, `updated_at`) VALUES
(1, 12, 'Has successfully signed in', '2023-11-25 05:01:25', NULL),
(2, 1, 'Has successfully signed in', '2023-12-01 11:55:36', NULL),
(3, 1, 'Has successfully signed in', '2023-12-01 12:36:26', NULL),
(4, 13, 'Has successfully signed in', '2023-12-04 05:33:35', NULL),
(5, 1, 'Has successfully signed in', '2023-12-07 06:29:35', NULL),
(6, 1, 'Has successfully signed in', '2023-12-09 12:37:19', NULL),
(7, 13, 'Has successfully signed in', '2023-12-12 14:31:00', NULL),
(8, 13, 'Has successfully signed in', '2023-12-12 14:41:17', NULL),
(9, 13, 'Has successfully signed in', '2023-12-12 23:21:09', NULL),
(10, 13, 'Has successfully signed in', '2023-12-14 03:45:44', NULL),
(11, 13, 'Has successfully signed in', '2023-12-14 03:52:29', NULL),
(12, 13, 'Has successfully signed in', '2023-12-14 10:06:52', NULL),
(13, 12, 'Has successfully signed in', '2023-12-15 02:38:33', NULL),
(14, 1, 'Has successfully signed in', '2023-12-16 13:58:54', NULL),
(15, 13, 'Has successfully signed in', '2023-12-16 14:39:10', NULL),
(16, 15, 'Has successfully signed in', '2023-12-17 14:23:35', NULL),
(17, 16, 'Has successfully signed in', '2023-12-18 04:23:10', NULL),
(18, 16, 'Has successfully signed in', '2023-12-18 04:25:12', NULL),
(19, 15, 'Has successfully signed in', '2023-12-18 04:27:11', NULL),
(20, 16, 'Has successfully signed in', '2023-12-19 06:52:44', NULL),
(21, 1, 'Has successfully signed in', '2023-12-19 23:55:05', NULL),
(22, 16, 'Has successfully signed in', '2023-12-20 00:01:56', NULL),
(23, 16, 'Has successfully signed in', '2024-01-21 10:51:09', NULL),
(24, 17, 'Has successfully signed in', '2024-01-21 10:52:47', NULL),
(25, 1, 'Has successfully signed in', '2024-01-22 02:19:03', NULL),
(26, 1, 'Has successfully signed in', '2024-01-27 06:02:28', NULL),
(27, 1, 'Has successfully signed in', '2024-02-05 13:22:11', NULL),
(28, 1, 'Has successfully signed in', '2024-02-08 12:59:39', NULL),
(29, 1, 'Has successfully signed in', '2024-02-09 03:32:29', NULL),
(30, 16, 'Has successfully signed in', '2024-03-02 00:40:41', NULL),
(31, 1, 'Has successfully signed in', '2024-03-02 00:40:54', NULL),
(32, 16, 'Has successfully signed in', '2024-03-02 01:16:46', NULL),
(33, 16, 'Has successfully signed in', '2024-03-02 01:56:49', NULL),
(34, 16, 'Has successfully signed in', '2024-03-02 04:10:58', NULL),
(35, 16, 'Has successfully signed in', '2024-03-02 04:11:11', NULL),
(36, 16, 'Has successfully signed in', '2024-03-02 04:11:27', NULL),
(37, 15, 'Has successfully signed in', '2024-03-02 04:11:45', NULL),
(38, 17, 'Has successfully signed in', '2024-03-03 01:48:46', NULL),
(39, 17, 'Has successfully signed in', '2024-03-07 07:00:05', NULL),
(40, 16, 'Has successfully signed in', '2024-03-09 00:55:43', NULL),
(41, 17, 'Has successfully signed in', '2024-03-10 02:00:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `package`
--

CREATE TABLE `package` (
  `id` int(11) NOT NULL,
  `package` varchar(145) DEFAULT NULL,
  `price` varchar(145) DEFAULT NULL,
  `number_of_post` varchar(145) DEFAULT NULL,
  `status` enum('active','disabled') NOT NULL DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `package`
--

INSERT INTO `package` (`id`, `package`, `price`, `number_of_post`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Basic', '0', '3', 'active', '2023-12-15 13:57:20', '2024-01-22 06:41:32'),
(2, 'Bronze', '399', '5', 'active', '2023-12-15 13:57:20', NULL),
(3, 'Silver', '699', '10', 'active', '2023-12-15 13:57:20', '2023-12-15 13:58:24'),
(4, 'Gold', '999', '20', 'active', '2023-12-15 13:57:20', '2023-12-17 04:57:19');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `package_id` int(11) DEFAULT NULL,
  `reference_number` varchar(145) DEFAULT NULL,
  `proof_of_payment` varchar(145) DEFAULT NULL,
  `start_date` varchar(145) DEFAULT NULL,
  `end_date` varchar(145) DEFAULT NULL,
  `status` enum('accept','decline','pending') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `property`
--

CREATE TABLE `property` (
  `id` int(14) NOT NULL,
  `user_id` int(14) DEFAULT NULL,
  `property_name` varchar(145) DEFAULT NULL,
  `units` int(14) DEFAULT NULL,
  `property_price` varchar(145) DEFAULT NULL,
  `property_contact_details` varchar(145) DEFAULT NULL,
  `bedrooms` int(11) DEFAULT NULL,
  `bathrooms` int(11) DEFAULT NULL,
  `property_type` int(11) DEFAULT NULL,
  `parking` int(11) DEFAULT NULL,
  `property_size` varchar(145) DEFAULT NULL,
  `garage_size` varchar(145) DEFAULT NULL,
  `allowed_pets` varchar(145) DEFAULT NULL,
  `property_description` longtext DEFAULT NULL,
  `amenities` varchar(145) DEFAULT NULL,
  `status` enum('available','not_available','disabled') NOT NULL DEFAULT 'available',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `property_floor_plan`
--

CREATE TABLE `property_floor_plan` (
  `id` int(11) NOT NULL,
  `property_id` int(11) DEFAULT NULL,
  `first_floor` varchar(145) DEFAULT NULL,
  `second_floor` varchar(145) DEFAULT NULL,
  `third_floor` varchar(145) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `property_gallery`
--

CREATE TABLE `property_gallery` (
  `id` int(11) NOT NULL,
  `property_id` int(11) DEFAULT NULL,
  `picture_1` varchar(445) DEFAULT NULL,
  `picture_2` varchar(445) DEFAULT NULL,
  `picture_3` varchar(445) DEFAULT NULL,
  `picture_4` varchar(445) DEFAULT NULL,
  `picture_5` varchar(445) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `property_location`
--

CREATE TABLE `property_location` (
  `id` int(11) NOT NULL,
  `property_id` int(11) DEFAULT NULL,
  `address` varchar(145) DEFAULT NULL,
  `latitude` varchar(145) DEFAULT NULL,
  `longitude` varchar(145) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `property_rating`
--

CREATE TABLE `property_rating` (
  `id` int(11) NOT NULL,
  `user_id` int(14) DEFAULT NULL,
  `property_id` int(11) DEFAULT NULL,
  `rating` varchar(145) DEFAULT NULL,
  `review` varchar(145) DEFAULT NULL,
  `datetime` varchar(145) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `property_reservation`
--

CREATE TABLE `property_reservation` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `agent_id` int(14) DEFAULT NULL,
  `property_id` int(11) DEFAULT NULL,
  `user_name` varchar(145) DEFAULT NULL,
  `user_phone_number` varchar(145) DEFAULT NULL,
  `booking_start_date` date DEFAULT NULL,
  `booking_end_date` date DEFAULT NULL,
  `message` longtext DEFAULT NULL,
  `status` enum('pending','accept','send_email','decline','waiting') NOT NULL DEFAULT 'pending',
  `accept_date` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `property_viewing_time`
--

CREATE TABLE `property_viewing_time` (
  `id` int(11) NOT NULL,
  `property_id` int(11) DEFAULT NULL,
  `visiting_rules` varchar(145) DEFAULT NULL,
  `visitation_hours_from` time DEFAULT NULL,
  `visitation_hours_to` time DEFAULT NULL,
  `visitation_days` varchar(145) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `system_config`
--

CREATE TABLE `system_config` (
  `id` int(14) NOT NULL,
  `system_name` varchar(145) DEFAULT NULL,
  `system_phone_number` varchar(145) DEFAULT NULL,
  `system_email` varchar(145) DEFAULT NULL,
  `system_logo` varchar(145) DEFAULT NULL,
  `system_favicon` varchar(145) DEFAULT NULL,
  `system_address` varchar(145) DEFAULT NULL,
  `system_facebook` varchar(145) DEFAULT NULL,
  `system_instagram` varchar(145) DEFAULT NULL,
  `system_copy_right` varchar(145) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system_config`
--

INSERT INTO `system_config` (`id`, `system_name`, `system_phone_number`, `system_email`, `system_logo`, `system_favicon`, `system_address`, `system_facebook`, `system_instagram`, `system_copy_right`, `created_at`, `updated_at`) VALUES
(1, 'MAGRENT', '+639126842485', 'magrentofficial@gmail.com', '', 'favicon.ico', 'Brgy. San Isidro, Safragemc Village, San Francisco, Agusan Del Sur, 8501', 'https://www.facebook.com/rhey.timario', 'https://www.facebook.com/rhey.timario', 'COPYRIGHT © 2023 - MAGRENT. ALL RIGHTS RESERVED.', '2023-11-19 13:03:25', '2023-12-12 14:54:47');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(145) DEFAULT NULL,
  `middle_name` varchar(145) DEFAULT NULL,
  `last_name` varchar(145) DEFAULT NULL,
  `sex` varchar(145) DEFAULT NULL COMMENT 'male=1, female=2',
  `date_of_birth` varchar(145) DEFAULT NULL,
  `age` varchar(145) DEFAULT NULL,
  `civil_status` varchar(145) DEFAULT NULL,
  `phone_number` varchar(145) DEFAULT NULL,
  `email` varchar(145) DEFAULT NULL,
  `password` varchar(145) DEFAULT NULL,
  `profile` varchar(1145) NOT NULL DEFAULT 'profile.png',
  `valid_id` varchar(1500) DEFAULT NULL,
  `package_id` int(20) DEFAULT NULL,
  `status` enum('Y','N','D') DEFAULT 'N',
  `tokencode` varchar(145) DEFAULT NULL,
  `account_status` enum('active','disabled') NOT NULL DEFAULT 'active',
  `user_type` varchar(14) DEFAULT NULL COMMENT 'superadmin=0,\r\nadmin=1,\r\nagent=2,\r\nuser=3',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `middle_name`, `last_name`, `sex`, `date_of_birth`, `age`, `civil_status`, `phone_number`, `email`, `password`, `profile`, `valid_id`, `package_id`, `status`, `tokencode`, `account_status`, `user_type`, `created_at`, `updated_at`) VALUES
(1, 'Rhey', 'Timario', 'Timario', 'MALE', NULL, NULL, NULL, '9776621929', 'magrent2023@gmail.com', '42f749ade7f9e195bf475f37a44cafcb', 'profile.png', NULL, NULL, 'Y', '174b66675b0e6170e83b8f4fbd7ba02f', 'active', '1', '2023-11-20 04:14:08', '2023-12-17 13:44:25'),
(17, 'Andrei', 'Timario', 'Viscayno', 'MALE', '', '', NULL, '9776621929', 'masgrent20w23@gmail.com', '42f749ade7f9e195bf475f37a44cafcb', 'profile.png', '61k+xMg3I7L.jpg', 1, 'Y', '174b66675b0e6170e83b8f4fbd7ba02f', 'active', '2', '2023-11-20 04:14:08', '2024-03-08 02:04:15');

-- --------------------------------------------------------

--
-- Table structure for table `user_payment`
--

CREATE TABLE `user_payment` (
  `id` int(14) NOT NULL,
  `user_id` int(14) NOT NULL,
  `bank` varchar(145) DEFAULT NULL,
  `account_name` varchar(145) DEFAULT NULL,
  `account_number` varchar(145) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `amenities`
--
ALTER TABLE `amenities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `business_hours`
--
ALTER TABLE `business_hours`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `day`
--
ALTER TABLE `day`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_config`
--
ALTER TABLE `email_config`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `google_maps_api`
--
ALTER TABLE `google_maps_api`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `google_recaptcha_api`
--
ALTER TABLE `google_recaptcha_api`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package`
--
ALTER TABLE `package`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `package_id` (`package_id`);

--
-- Indexes for table `property`
--
ALTER TABLE `property`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `property_floor_plan`
--
ALTER TABLE `property_floor_plan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `property_id` (`property_id`);

--
-- Indexes for table `property_gallery`
--
ALTER TABLE `property_gallery`
  ADD PRIMARY KEY (`id`),
  ADD KEY `property_id` (`property_id`);

--
-- Indexes for table `property_location`
--
ALTER TABLE `property_location`
  ADD PRIMARY KEY (`id`),
  ADD KEY `property_id` (`property_id`);

--
-- Indexes for table `property_rating`
--
ALTER TABLE `property_rating`
  ADD PRIMARY KEY (`id`),
  ADD KEY `property_id` (`property_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `property_reservation`
--
ALTER TABLE `property_reservation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `property_id` (`property_id`),
  ADD KEY `agent_id` (`agent_id`);

--
-- Indexes for table `property_viewing_time`
--
ALTER TABLE `property_viewing_time`
  ADD PRIMARY KEY (`id`),
  ADD KEY `property_id` (`property_id`);

--
-- Indexes for table `system_config`
--
ALTER TABLE `system_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `package_id` (`package_id`);

--
-- Indexes for table `user_payment`
--
ALTER TABLE `user_payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `amenities`
--
ALTER TABLE `amenities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `business_hours`
--
ALTER TABLE `business_hours`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `day`
--
ALTER TABLE `day`
  MODIFY `id` int(14) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `email_config`
--
ALTER TABLE `email_config`
  MODIFY `Id` int(145) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `google_maps_api`
--
ALTER TABLE `google_maps_api`
  MODIFY `id` int(145) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `google_recaptcha_api`
--
ALTER TABLE `google_recaptcha_api`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `package`
--
ALTER TABLE `package`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `property`
--
ALTER TABLE `property`
  MODIFY `id` int(14) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `property_floor_plan`
--
ALTER TABLE `property_floor_plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `property_gallery`
--
ALTER TABLE `property_gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `property_location`
--
ALTER TABLE `property_location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `property_rating`
--
ALTER TABLE `property_rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `property_reservation`
--
ALTER TABLE `property_reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `property_viewing_time`
--
ALTER TABLE `property_viewing_time`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `system_config`
--
ALTER TABLE `system_config`
  MODIFY `id` int(14) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `user_payment`
--
ALTER TABLE `user_payment`
  MODIFY `id` int(14) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `business_hours`
--
ALTER TABLE `business_hours`
  ADD CONSTRAINT `business_hours_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `payment_ibfk_2` FOREIGN KEY (`package_id`) REFERENCES `package` (`id`);

--
-- Constraints for table `property`
--
ALTER TABLE `property`
  ADD CONSTRAINT `property_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `property_floor_plan`
--
ALTER TABLE `property_floor_plan`
  ADD CONSTRAINT `property_floor_plan_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `property` (`id`);

--
-- Constraints for table `property_gallery`
--
ALTER TABLE `property_gallery`
  ADD CONSTRAINT `property_gallery_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `property` (`id`);

--
-- Constraints for table `property_location`
--
ALTER TABLE `property_location`
  ADD CONSTRAINT `property_location_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `property` (`id`);

--
-- Constraints for table `property_rating`
--
ALTER TABLE `property_rating`
  ADD CONSTRAINT `property_rating_ibfk_2` FOREIGN KEY (`property_id`) REFERENCES `property` (`id`),
  ADD CONSTRAINT `property_rating_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `property_reservation`
--
ALTER TABLE `property_reservation`
  ADD CONSTRAINT `property_reservation_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `property_reservation_ibfk_2` FOREIGN KEY (`property_id`) REFERENCES `property` (`id`),
  ADD CONSTRAINT `property_reservation_ibfk_3` FOREIGN KEY (`agent_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `property_viewing_time`
--
ALTER TABLE `property_viewing_time`
  ADD CONSTRAINT `property_viewing_time_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `property` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`package_id`) REFERENCES `package` (`id`);

--
-- Constraints for table `user_payment`
--
ALTER TABLE `user_payment`
  ADD CONSTRAINT `user_payment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
