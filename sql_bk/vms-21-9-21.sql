-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 21, 2021 at 12:36 PM
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
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `dept_id` int(11) NOT NULL,
  `department_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `entry_user_id` int(11) DEFAULT NULL,
  `entry_datetime` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `modified_user_id` int(11) DEFAULT NULL,
  `modified_datetime` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0=inactive, 1=active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`dept_id`, `department_name`, `entry_user_id`, `entry_datetime`, `modified_user_id`, `modified_datetime`, `status`) VALUES
(1, 'Business Development', NULL, NULL, NULL, NULL, 1),
(2, 'Human Resources', NULL, NULL, NULL, NULL, 1),
(3, 'IT', NULL, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `designations`
--

CREATE TABLE `designations` (
  `designation_id` int(11) NOT NULL,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dept_id` int(11) NOT NULL,
  `entry_user_id` int(11) DEFAULT NULL,
  `entry_datetime` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `modified_user_id` int(11) DEFAULT NULL,
  `modified_datetime` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1 COMMENT '0=inactive, 1=active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `designations`
--

INSERT INTO `designations` (`designation_id`, `designation`, `dept_id`, `entry_user_id`, `entry_datetime`, `modified_user_id`, `modified_datetime`, `status`) VALUES
(1, 'Deputy General Manager', 1, NULL, NULL, NULL, NULL, 1),
(2, 'Assistant Manager', 1, NULL, NULL, NULL, NULL, 1),
(3, 'Senior Executive', 1, NULL, NULL, NULL, NULL, 1),
(4, 'Executive', 1, NULL, NULL, NULL, NULL, 1),
(5, 'Software Developer', 1, NULL, NULL, NULL, NULL, 1),
(6, 'Deputy General Manager', 2, NULL, NULL, NULL, NULL, 1),
(7, 'Chief Human Resources Officer', 2, NULL, NULL, NULL, NULL, 1),
(8, 'Senior Executive', 2, NULL, NULL, NULL, NULL, 1),
(9, 'Executive', 2, NULL, NULL, NULL, NULL, 1),
(10, 'System Administrator', 3, NULL, NULL, NULL, NULL, 1);

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
  `gender` int(11) DEFAULT NULL,
  `dob` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `eid_no` bigint(20) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `designation_id` int(11) NOT NULL,
  `mobile_no` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nid_no` bigint(20) DEFAULT NULL,
  `passport_no` bigint(20) DEFAULT NULL,
  `driving_license_no` bigint(20) DEFAULT NULL,
  `start_hour` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `end_hour` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `entry_user_id` int(11) DEFAULT NULL,
  `entry_datetime` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `modified_user_id` int(11) DEFAULT NULL,
  `modified_datetime` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `availability` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=available, 0=absent ',
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=pending, 1=approved, 2=declined'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`employee_id`, `user_id`, `user_type_id`, `first_name`, `last_name`, `slug`, `gender`, `dob`, `eid_no`, `dept_id`, `designation_id`, `mobile_no`, `email`, `address`, `photo`, `nid_no`, `passport_no`, `driving_license_no`, `start_hour`, `end_hour`, `entry_user_id`, `entry_datetime`, `modified_user_id`, `modified_datetime`, `availability`, `status`) VALUES
(1, 2, 2, 'Rayhan', 'Zaman', 'rayhan-zaman', 1, '2021-09-20', 3297, 1, 5, '01521449100', 'rayhan.zaman@sebpo.com', 'Dhaka', 'employee1632120918.png', 1234567891234567, 1234567891234567, 1234567891234567, '10:30', '18:30', NULL, NULL, NULL, NULL, 1, 0),
(2, 8, 2, 'New edit', 'Host edit', 'new-host', 1, '1990-01-01', 0, 3, 1, '12345678911', 'newhostedit@mail.com', 'New Host demo address edit', 'profile-7.jpg', 111122223333, 111122223333, 111122223333, '10:00', '19:30', NULL, NULL, NULL, NULL, 1, 0),
(3, 10, 2, 'New', 'employee two', 'new-employee two', 1, NULL, 11, 1, 5, '00011122233', NULL, NULL, NULL, NULL, NULL, NULL, '10:06', '19:06', NULL, NULL, NULL, NULL, 1, 0);

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
  `employee_id` int(11) NOT NULL,
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

INSERT INTO `meetings` (`meeting_id`, `user_id`, `visitor_id`, `employee_id`, `meeting_purpose_id`, `purpose_describe`, `meeting_datetime`, `meeting_start_time`, `meeting_end_time`, `entry_user_id`, `entry_datetime`, `modified_user_id`, `modified_datetime`, `cancel_reason`, `meeting_status`, `checkin_status`, `has_vehicle`) VALUES
(1, 1, 1, 0, 1, 'test', '2021-09-22 19:36:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0);

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
  `is_approved` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=pending, 1=approved, 2=declined',
  `entry_date_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `user_type_id`, `is_approved`, `entry_date_time`) VALUES
(1, '00123456789', '$2y$10$1fy9XKmlyOyJM4RFDZbRv.GOVy8WolgX8eSE9Bw9NGuK1kJwwRNIi', 4, 1, '2021-09-20 06:48:06'),
(8, '00112233445', '$2y$10$dIxb3D0.MYjBLeT7ZS84SOTFj7Qw46ZCC6QOqwSxiDrovb.LSXOqq', 2, 1, '2021-09-20 11:29:22'),
(10, '00011122233', '$2y$10$wZfEm/Vwkg2TIXpGvIgFaujW1rFbzNKE8PnDW.KQt1AZU4kSvAjfm', 2, 0, '2021-09-21 05:06:52');

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
(1, 'Admin', 1),
(2, 'Employee', 1),
(3, 'Receptionist', 1),
(4, 'Visitor', 1);

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
  `nid_no` bigint(20) DEFAULT NULL,
  `passport_no` bigint(20) DEFAULT NULL,
  `driving_license_no` bigint(20) DEFAULT NULL,
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
(1, 1, 1, 'Rayhan', 'Zaman', 'rayhan-zaman', 1, '2021-09-20', 1955181028, 'rayhan.zaman@sebpo.com', 'Dhaka', 'visitor1632120486.png', 1234567891234567, 1234567891234567, 1234567891234567, NULL, '2021-09-20 06:48:06', NULL, '2021-09-20 06:48:06', 1);

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
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`dept_id`);

--
-- Indexes for table `designations`
--
ALTER TABLE `designations`
  ADD PRIMARY KEY (`designation_id`);

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
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `dept_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `designations`
--
ALTER TABLE `designations`
  MODIFY `designation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `meeting_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
  MODIFY `visitor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
