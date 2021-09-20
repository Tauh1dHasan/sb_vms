-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 15, 2021 at 12:25 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vms`
--

-- --------------------------------------------------------

--
-- Table structure for table `custom_messages`
--

CREATE TABLE `custom_messages` (
  `message_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message_subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message_body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `entry_datetime` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `employee_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_type_id` int(11) NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` int(11) NOT NULL,
  `date_of_birth` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `eid_no` int(11) NOT NULL,
  `department` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_no` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `working_hour` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `entry_user_id` int(11) DEFAULT NULL,
  `entry_datetime` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `modified_user_id` int(11) DEFAULT NULL,
  `modified_datetime` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `availability` int(11) NOT NULL DEFAULT 1 COMMENT '1=available, 0=absent ',
  `is_approved` int(11) NOT NULL DEFAULT 1 COMMENT '1=approved, 0=declined'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`employee_id`, `user_id`, `user_type_id`, `first_name`, `last_name`, `slug`, `gender`, `date_of_birth`, `eid_no`, `department`, `designation`, `mobile_no`, `email`, `address`, `photo`, `working_hour`, `entry_user_id`, `entry_datetime`, `modified_user_id`, `modified_datetime`, `availability`, `is_approved`) VALUES
(1, 21, 1, 'A', 'B', 'a-b', 1, '', 1122, 'Business', 'SD', '01955181028', 'rayhan@mail.com', 'dhaka', NULL, '10.00-6.00', NULL, NULL, NULL, NULL, 1, 1),
(2, 22, 1, 'C', 'D', 'c-d', 1, '', 2233, 'BD', 'SD', '01955181028', 'ray@mail.com', 'dhaka', NULL, '10.00-6.00', NULL, NULL, NULL, NULL, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `failed_logins`
--

CREATE TABLE `failed_logins` (
  `failed_login_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `login_id` int(11) NOT NULL,
  `failed_login_datetime` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `login_activitys`
--

CREATE TABLE `login_activitys` (
  `activity_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `login_datetime` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logout_datetime` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `login_ip` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `login_attempt_id` int(11) NOT NULL,
  `user_login_id` int(11) NOT NULL,
  `attempt_datetime` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempt_ip` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `login _lockdowns`
--

CREATE TABLE `login _lockdowns` (
  `login_lockdown_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_login_id` int(11) NOT NULL,
  `locked_ip` int(11) NOT NULL,
  `lockdown_datetime` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `release_datetime` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `meetings`
--

CREATE TABLE `meetings` (
  `meeting_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `visitor_id` int(11) NOT NULL,
  `employee_info` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meeting_purpose_id` int(11) NOT NULL,
  `purpose_describe` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meeting_datetime` datetime NOT NULL,
  `meeting_start_time` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meeting_end_time` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `entry_user_id` int(11) DEFAULT NULL,
  `entry_datetime` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `modified_user_id` int(11) DEFAULT NULL,
  `modified_datetime` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cancel_reason` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meeting_status` int(11) NOT NULL DEFAULT 0 COMMENT '0=pending, 1=approved, 2=declined, 3=rescheduled, 4=canceled, 11=on going, 12=end meeting',
  `checkin_status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=checkout, 1=checkin',
  `has_vehicle` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=no, 1=yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `meetings`
--

INSERT INTO `meetings` (`meeting_id`, `user_id`, `visitor_id`, `employee_info`, `meeting_purpose_id`, `purpose_describe`, `meeting_datetime`, `meeting_start_time`, `meeting_end_time`, `entry_user_id`, `entry_datetime`, `modified_user_id`, `modified_datetime`, `cancel_reason`, `meeting_status`, `checkin_status`, `has_vehicle`) VALUES
(1, 9, 5, '1', 1, NULL, '2021-09-14 11:41:43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(2, 10, 6, '2', 1, NULL, '2021-09-14 11:41:43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(3, 1, 1, 'A B (SD, Business)', 1, 'test', '2021-09-15 16:23:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `meeting_purposes`
--

CREATE TABLE `meeting_purposes` (
  `purpose_id` int(11) NOT NULL,
  `purpose_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `purpose_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `entry_user_id` int(11) DEFAULT NULL,
  `entry_datetime` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `modified_user_id` int(11) DEFAULT NULL,
  `modified_datetime` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `purpose_status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0=deactivated, 1=active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `meeting_purposes`
--

INSERT INTO `meeting_purposes` (`purpose_id`, `purpose_name`, `purpose_description`, `entry_user_id`, `entry_datetime`, `modified_user_id`, `modified_datetime`, `purpose_status`) VALUES
(1, 'official', NULL, NULL, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `permission_id` int(11) NOT NULL,
  `permission_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permission_status` int(11) NOT NULL DEFAULT 1 COMMENT '1=active, 0=deactivate'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `title` int(11) NOT NULL,
  `meta_title` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `primary_mbl` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alt_mbl` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `primary_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alt_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `office_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `factory_address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fb_link` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin_link` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter_link` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube_link` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type_id` int(11) NOT NULL,
  `entry_date_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `user_type_id`, `entry_date_time`) VALUES
(1, '01955181028', '$2y$10$hIeoWwxfhx7cxEWyd4PmJ.GgQa/.XaNs8y8ssjOLu6NXCrwGjkMJS', 4, '2021-09-13 09:40:08'),
(2, '01955181028', '$2y$10$3VA53Gn6MifO2nqIu6FCxOZ/htXZJCRPL2z1dUrgOfUl8RVqDEN7K', 4, '2021-09-13 09:40:33'),
(3, '01955181028', '$2y$10$WB1.RtmdPght8PAbZY4TRuMkErB2Nf50eTGOyx5z0oGcwREIiQTDW', 4, '2021-09-13 09:42:46'),
(4, '01955181028', '$2y$10$F25NOS0s/dl7o1jUZRMOTONo/nooXnlJCCmBRi2NoNkF4z4PasO0y', 4, '2021-09-13 09:54:10'),
(5, '01955181028', '$2y$10$N2pu4UH51zd1Vv01Do0hNO5OukdxMdQHhCR7u8xalpdNSNe3KOR9K', 4, '2021-09-13 09:59:37'),
(6, '019551810281', '$2y$10$WlDK2AC1STpv3Pye4oynD.Y54EKLTwpsqbxwpbr/jhVi8U9lE/pXi', 4, '2021-09-13 10:04:42'),
(7, '019551810281', '$2y$10$vZASQbi6opS7GxEr0sHTNOdyZgMYm6rx.DBi7vj4RXKnit2Gc6tdy', 4, '2021-09-13 10:05:08'),
(8, '01955181021', '$2y$10$EjTb3ICtSN6ys.pUOsIe/euGnFreD7/H49n0HO4rvVv9NpeDyD5Hu', 4, '2021-09-13 10:05:26'),
(9, '01955181021', '$2y$10$ZoV89Jy1RWQCsgaWoBzri.RAhzXSWeca1SE1T6SM7tQDv2mdLsdSy', 4, '2021-09-13 10:07:02'),
(10, '01955181028', '$2y$10$yFxKNYd0RFW0gkf6rwYToOgM/DfAwwz.eYFDQFvfNm6rYzhOACmY2', 4, '2021-09-13 12:54:05'),
(11, '01955181028', '$2y$10$WNqy7Zw2n/RyH3D1Ot7exex0Ei/2l2sEVKuLczD9aOLv5h0lNRF82', 4, '2021-09-14 05:30:23'),
(12, '01955181028', '$2y$10$5KhXmxrLC67bJXt2gzu.9uWj3EPbZBJt7xpAgjcapOlkOgoPyyXjm', 4, '2021-09-14 05:37:11'),
(13, '01955181028', '$2y$10$il8kVS1JPjaLbi9E9Zh5LuB8ox/u2LDy.xkjCh1gUaDPdSOCzMl8i', 4, '2021-09-14 05:39:17'),
(14, '01955181028', '$2y$10$KuCJNqb3em.G08kF6GmBeuHFerZ1zUDPNoIt5cyIusdDiuQvUMPCK', 4, '2021-09-14 05:42:45'),
(15, '01955181028', '$2y$10$7omk/ZcJBvFgFD2GDi.WPuXalnxXFvo8Bgykydv2IZO58XfO7uknK', 4, '2021-09-14 05:44:41'),
(16, '01955181028', '$2y$10$sihZ107zZnbTNaPQvGKmiejpiIq7lnxY8VaMugXkQPfwEeX29ZXxy', 4, '2021-09-14 05:45:34'),
(17, '01955181028', '$2y$10$/3nwR.vSXRt5vIV2wvzePOva15kenZmkpwE6Agmx3h.yPaXHey6nG', 4, '2021-09-14 05:46:09'),
(18, '01955181028', '$2y$10$72t2WDACbJkVea4u5xeb7OCowN9hLLySuvfp4govm93IeBoQrCPUK', 4, '2021-09-14 05:48:31'),
(19, '01955181028', '$2y$10$/nW3jTf1oE7jScGeO5P/N.lVrmCm8kvrAmRca9sA6JkII9Emo2GmC', 4, '2021-09-15 05:34:58'),
(20, '01955181028', '$2y$10$6BtFBvDfB/3qbQpsk9Pe9utWpUb1Qh7lodDbynuk8X2sF69I20H.a', 4, '2021-09-15 06:34:13'),
(21, '01955181028', '$2y$10$RLAqQuBdxCFH9taUB99n7elBdnxEXBsY3hRW8pxjtUtE/AIGIGrI2', 4, '2021-09-15 06:35:28'),
(22, '01955181028', '$2y$10$V3jsbeHLjbQDnosRDDba4OkzCf/UzdmCIInGvz3Nj8RtmpPRkbgau', 4, '2021-09-15 06:37:52'),
(23, '01955181028', '$2y$10$omCZUw9cuVUwLvOTaB1M0eOfB0XzzAR6xzjRpmPvpMVz6lkQ3pwyi', 4, '2021-09-15 06:42:17'),
(24, '01955181023', '$2y$10$EvBzbjutm7CBbngqVw33IuREMDSozRYog36U3/BDmn8sNIA0G2aja', 4, '2021-09-15 06:46:57'),
(25, '01955181022', '$2y$10$eKzxtE1HZPMAdbpwbAQWp.DBvVqk9Mo08xD7dVcfNW1CRsaxbisRm', 4, '2021-09-15 07:17:36'),
(26, '01955181033', '$2y$10$Plbp9Kq5Qadz54u4iaIZCe8IAZMz7opZ5Nm3gVWd0tIZfuee4HPaS', 4, '2021-09-15 07:22:31'),
(27, '01955181099', '$2y$10$4vFOblZQWTOonklyAq5GIear0IZfAdAosyp.0/RWgqEadIC0IL.mm', 4, '2021-09-15 08:11:20'),
(28, '01955181055', '$2y$10$8TM12DBJGIRngP3T.3yqo.8Yo5dnfpOMr0Zs8sR5/hAmb41dYcZ8i', 4, '2021-09-15 08:13:27'),
(29, '01955181056', '$2y$10$9AyWA0vdJvxDZ7nvISACr.c4TRBIwdW2LFCfDWKTRonnuADECXP9e', 4, '2021-09-15 08:14:30');

-- --------------------------------------------------------

--
-- Table structure for table `user_permissions`
--

CREATE TABLE `user_permissions` (
  `user_permission_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `user_permission_status` int(11) NOT NULL DEFAULT 1 COMMENT '1=active, 0=deactivate'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_status`
--

CREATE TABLE `user_status` (
  `user_status_id` int(11) NOT NULL,
  `status_title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

CREATE TABLE `user_types` (
  `user_type_id` int(11) NOT NULL,
  `user_type_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type_status` int(11) NOT NULL DEFAULT 1 COMMENT '1=active, 0=deactivate'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_types`
--

INSERT INTO `user_types` (`user_type_id`, `user_type_name`, `user_type_status`) VALUES
(1, 'Super Admin', 1),
(2, 'Admin', 1),
(3, 'Employee', 1),
(4, 'Visitor', 1),
(5, 'Receptionist', 1);

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE `visitors` (
  `visitor_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `visitor_type` int(11) NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` int(11) DEFAULT NULL,
  `dob` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_no` int(50) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nid_no` int(11) DEFAULT NULL,
  `passport_no` int(11) DEFAULT NULL,
  `driving_license_no` int(11) DEFAULT NULL,
  `entry_user_id` int(11) DEFAULT NULL,
  `entry_date_time` timestamp NULL DEFAULT current_timestamp(),
  `modified_user_id` int(11) DEFAULT NULL,
  `modified_date_time` timestamp NULL DEFAULT current_timestamp(),
  `visitor_status` int(11) NOT NULL DEFAULT 1 COMMENT '0=deactivated, 1=active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `visitors`
--

INSERT INTO `visitors` (`visitor_id`, `user_id`, `visitor_type`, `first_name`, `last_name`, `slug`, `gender`, `dob`, `mobile_no`, `email`, `address`, `profile_photo`, `nid_no`, `passport_no`, `driving_license_no`, `entry_user_id`, `entry_date_time`, `modified_user_id`, `modified_date_time`, `visitor_status`) VALUES
(1, 0, 1, 'first', 'last', NULL, 1, '2021-09-13', 1955181028, 'rayhan.zaman333@gmail.com', 'dhaka', 'logo.jpg', 123456, 123456, 123456, NULL, '2021-09-13 09:42:46', NULL, '2021-09-13 09:42:46', 1),
(2, 123456, 1, 'first', 'last', NULL, 1, '2021-09-13', 1955181028, 'rayhan.zaman333@gmail.com', 'dhaka', 'logo.jpg', 123456, 123456, 123456, NULL, '2021-09-13 09:54:10', NULL, '2021-09-13 09:54:10', 1),
(3, 123456, 3, 'first', 'last', NULL, 1, '2021-09-09', 1955181028, 'rayhan.zaman333@gmail.com', 'dhaka', 'logo.jpg', 123456, 123456, 123456, NULL, '2021-09-13 09:59:37', NULL, '2021-09-13 09:59:37', 1),
(4, 123456, 2, 'first1', 'last1', NULL, 2, '2021-09-03', 1955181021, 'rayhan.zaman333@gmail.com', 'dhaka', 'logo.jpg', 123456, 123456, 123456, NULL, '2021-09-13 10:05:26', NULL, '2021-09-13 10:05:26', 1),
(5, 9, 2, 'first1', 'last1', NULL, 2, '2021-09-03', 1955181021, 'rayhan.zaman333@gmail.com', 'dhaka', 'logo.jpg', 123456, 123456, 123456, NULL, '2021-09-13 10:07:02', NULL, '2021-09-13 10:07:02', 1),
(6, 10, 3, 'first', 'last', NULL, 1, '2021-09-23', 1955181028, 'rayhan.zaman333@gmail.com', 'dhaka', 'logo.jpg', 123456, 123456, 123456, NULL, '2021-09-13 12:54:05', NULL, '2021-09-13 12:54:05', 1),
(7, 11, 2, 'first', 'last', NULL, 1, '2021-09-17', 1955181028, 'rayhan.zaman333@gmail.com', 'dhaka', 'logo.jpg', 123456, 123456, 123456, NULL, '2021-09-14 05:30:23', NULL, '2021-09-14 05:30:23', 1),
(8, 12, 2, 'first', 'last', NULL, 1, '2021-09-17', 1955181028, 'rayhan.zaman333@gmail.com', 'dhaka', 'SEBPO_LOGO.png', 123456, 123456, 123456, NULL, '2021-09-14 05:37:11', NULL, '2021-09-14 05:37:11', 1),
(9, 13, 2, 'first', 'last', NULL, 1, '2021-09-17', 1955181028, 'rayhan.zaman333@gmail.com', 'dhaka', NULL, 123456, 123456, 123456, NULL, '2021-09-14 05:39:17', NULL, '2021-09-14 05:39:17', 1),
(10, 14, 2, 'first', 'last', NULL, 1, '2021-09-17', 1955181028, 'rayhan.zaman333@gmail.com', 'dhaka', 'SEBPO_LOGO.png', 123456, 123456, 123456, NULL, '2021-09-14 05:42:45', NULL, '2021-09-14 05:42:45', 1),
(11, 17, 2, 'first', 'last', NULL, 1, '2021-09-17', 1955181028, 'rayhan.zaman333@gmail.com', 'dhaka', 'SEBPO_LOGO.png', 123456, 123456, 123456, NULL, '2021-09-14 05:46:09', NULL, '2021-09-14 05:46:09', 1),
(12, 18, 2, 'first', 'last', NULL, 1, '2021-09-17', 1955181028, 'rayhan.zaman333@gmail.com', 'dhaka', 'SEBPO_LOGO.png', 123456, 123456, 123456, NULL, '2021-09-14 05:48:31', NULL, '2021-09-14 05:48:31', 1),
(13, 19, 1, 'first', 'last', NULL, NULL, NULL, 1955181028, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-09-15 05:34:58', NULL, '2021-09-15 05:34:58', 1),
(14, 20, 2, 'first', 'last', NULL, NULL, NULL, 1955181028, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-09-15 06:34:13', NULL, '2021-09-15 06:34:13', 1),
(15, 21, 2, 'first', 'last', NULL, NULL, NULL, 1955181028, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-09-15 06:35:28', NULL, '2021-09-15 06:35:28', 1),
(16, 22, 2, 'first', 'last', NULL, NULL, NULL, 1955181028, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-09-15 06:37:52', NULL, '2021-09-15 06:37:52', 1),
(17, 23, 2, 'first', 'last', NULL, NULL, NULL, 1955181028, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-09-15 06:42:17', NULL, '2021-09-15 06:42:17', 1),
(18, 24, 2, 'first', 'last', NULL, NULL, NULL, 1955181023, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-09-15 06:46:57', NULL, '2021-09-15 06:46:57', 1),
(19, 25, 2, 'first', 'last', NULL, NULL, NULL, 1955181022, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-09-15 07:17:36', NULL, '2021-09-15 07:17:36', 1),
(20, 26, 3, 'first', 'last', 'first', NULL, NULL, 1955181033, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-09-15 07:22:31', NULL, '2021-09-15 07:22:31', 1),
(21, 27, 2, 'first', 'last', 'first-last', NULL, NULL, 1955181099, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-09-15 08:11:20', NULL, '2021-09-15 08:11:20', 1),
(22, 28, 2, 'First', 'Last', 'first-last', NULL, NULL, 1955181055, NULL, NULL, 'SEBPO_LOGO.png', NULL, NULL, NULL, NULL, '2021-09-15 08:13:27', NULL, '2021-09-15 08:13:27', 1),
(23, 29, 2, 'First', 'Last', 'first-last', NULL, NULL, 1955181056, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-09-15 08:14:30', NULL, '2021-09-15 08:14:30', 1);

-- --------------------------------------------------------

--
-- Table structure for table `visitor_pass`
--

CREATE TABLE `visitor_pass` (
  `visitor_pass_id` int(11) NOT NULL,
  `visitor_id` int(11) NOT NULL,
  `meeting_id` int(11) NOT NULL,
  `checkin_time` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `checkout_time` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `visitor_pass_status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=active, 0=expired'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `visitor_types`
--

CREATE TABLE `visitor_types` (
  `visitor_type_id` int(11) NOT NULL,
  `visitor_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `visitor_type_status` int(11) NOT NULL DEFAULT 1 COMMENT '1=active, 0=deactivate'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `visitor_types`
--

INSERT INTO `visitor_types` (`visitor_type_id`, `visitor_type`, `visitor_type_status`) VALUES
(1, 'Media', 1),
(2, 'Official', 1),
(3, 'Others', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `custom_messages`
--
ALTER TABLE `custom_messages`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `failed_logins`
--
ALTER TABLE `failed_logins`
  ADD PRIMARY KEY (`failed_login_id`);

--
-- Indexes for table `login_activitys`
--
ALTER TABLE `login_activitys`
  ADD PRIMARY KEY (`activity_id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`login_attempt_id`);

--
-- Indexes for table `login _lockdowns`
--
ALTER TABLE `login _lockdowns`
  ADD PRIMARY KEY (`login_lockdown_id`);

--
-- Indexes for table `meetings`
--
ALTER TABLE `meetings`
  ADD PRIMARY KEY (`meeting_id`);

--
-- Indexes for table `meeting_purposes`
--
ALTER TABLE `meeting_purposes`
  ADD PRIMARY KEY (`purpose_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`permission_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_permissions`
--
ALTER TABLE `user_permissions`
  ADD PRIMARY KEY (`user_permission_id`);

--
-- Indexes for table `user_status`
--
ALTER TABLE `user_status`
  ADD PRIMARY KEY (`user_status_id`);

--
-- Indexes for table `user_types`
--
ALTER TABLE `user_types`
  ADD PRIMARY KEY (`user_type_id`);

--
-- Indexes for table `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`visitor_id`);

--
-- Indexes for table `visitor_pass`
--
ALTER TABLE `visitor_pass`
  ADD PRIMARY KEY (`visitor_pass_id`);

--
-- Indexes for table `visitor_types`
--
ALTER TABLE `visitor_types`
  ADD PRIMARY KEY (`visitor_type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `custom_messages`
--
ALTER TABLE `custom_messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_logins`
--
ALTER TABLE `failed_logins`
  MODIFY `failed_login_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `login_activitys`
--
ALTER TABLE `login_activitys`
  MODIFY `activity_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `login_attempt_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `login _lockdowns`
--
ALTER TABLE `login _lockdowns`
  MODIFY `login_lockdown_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `meetings`
--
ALTER TABLE `meetings`
  MODIFY `meeting_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `meeting_purposes`
--
ALTER TABLE `meeting_purposes`
  MODIFY `purpose_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `permission_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `user_permissions`
--
ALTER TABLE `user_permissions`
  MODIFY `user_permission_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_status`
--
ALTER TABLE `user_status`
  MODIFY `user_status_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_types`
--
ALTER TABLE `user_types`
  MODIFY `user_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `visitor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `visitor_pass`
--
ALTER TABLE `visitor_pass`
  MODIFY `visitor_pass_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `visitor_types`
--
ALTER TABLE `visitor_types`
  MODIFY `visitor_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
