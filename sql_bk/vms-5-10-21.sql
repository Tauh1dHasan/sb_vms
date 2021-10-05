-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 05, 2021 at 08:15 AM
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
-- Table structure for table `admin_logs`
--

CREATE TABLE `admin_logs` (
  `log_id` int(11) NOT NULL,
  `log_type` tinyint(4) NOT NULL COMMENT '0=pending, 1=add, 2=update, 3=delete, 4=approved, 5=declined, 6=rescheduled',
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `visitor_type_id` int(11) DEFAULT NULL,
  `visitor_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `visitor_type_status` tinyint(1) DEFAULT NULL COMMENT '0=inactive, 1=active, 2=removed',
  `dept_id` int(11) DEFAULT NULL,
  `department_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department_status` tinyint(11) DEFAULT NULL COMMENT '1=active, 0=inactive, 2=removed',
  `designation_id` int(11) DEFAULT NULL,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designation_dept_id` int(11) DEFAULT NULL,
  `designation_status` tinyint(4) DEFAULT NULL,
  `entry_user_id` int(11) DEFAULT NULL,
  `entry_datetime` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0=removed, 1=displayed'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_logs`
--

INSERT INTO `admin_logs` (`log_id`, `log_type`, `description`, `visitor_type_id`, `visitor_type`, `visitor_type_status`, `dept_id`, `department_name`, `department_status`, `designation_id`, `designation`, `designation_dept_id`, `designation_status`, `entry_user_id`, `entry_datetime`, `status`) VALUES
(1, 0, '', 2, 'Official Employee', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2021-09-30 06:45:21', 1),
(2, 0, '', 2, 'Official Employees', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2021-09-30 07:02:38', 1),
(3, 0, '', NULL, NULL, NULL, 3, 'IT', 1, NULL, NULL, NULL, NULL, 1, '2021-09-30 11:26:40', 1),
(4, 0, '', NULL, NULL, NULL, 3, 'IT Department', 0, NULL, NULL, NULL, NULL, 1, '2021-09-30 11:27:36', 1),
(5, 0, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(6, 0, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(7, 0, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(8, 0, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(9, 0, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(10, 0, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(11, 0, '', NULL, NULL, NULL, NULL, NULL, NULL, 9, 'Executive', 3, 1, NULL, NULL, 1),
(12, 0, '', NULL, NULL, NULL, NULL, NULL, NULL, 9, 'Executive', 2, 1, 1, '2021-10-03 11:56:50', 1),
(13, 0, '', NULL, NULL, NULL, NULL, NULL, NULL, 9, 'Executives', 3, 1, 1, '2021-10-03 11:57:11', 1),
(14, 0, '', NULL, NULL, NULL, NULL, NULL, NULL, 9, 'Executive', 2, 1, 1, '2021-10-03 11:58:26', 1),
(15, 0, '', NULL, NULL, NULL, NULL, NULL, NULL, 20, 'Senior Analyst', 4, 1, 1, '2021-10-04 09:16:48', 1);

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
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `entry_user_id` int(11) DEFAULT NULL,
  `entry_datetime` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `modified_user_id` int(11) DEFAULT NULL,
  `modified_datetime` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0=inactive, 1=active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`dept_id`, `department_name`, `slug`, `entry_user_id`, `entry_datetime`, `modified_user_id`, `modified_datetime`, `status`) VALUES
(1, 'Business Development', 'business-development', NULL, '2021-09-30 06:45:21', NULL, NULL, 1),
(2, 'Human Resources', 'human-resources', NULL, '2021-09-30 06:45:21', NULL, NULL, 1),
(3, 'IT', 'it', NULL, '2021-09-30 06:45:21', 1, '2021-09-30 11:27:36', 1),
(4, 'Risk and Compliance', 'risk-and-compliance', 1, '2021-10-03 06:33:41', NULL, NULL, 1),
(5, 'Ad Opertaion', 'ad-opertaion', 1, '2021-10-03 06:37:57', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `designations`
--

CREATE TABLE `designations` (
  `designation_id` int(11) NOT NULL,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dept_id` int(11) NOT NULL,
  `entry_user_id` int(11) DEFAULT NULL,
  `entry_datetime` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `modified_user_id` int(11) DEFAULT NULL,
  `modified_datetime` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1 COMMENT '0=inactive, 1=active, 2=removed'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `designations`
--

INSERT INTO `designations` (`designation_id`, `designation`, `slug`, `dept_id`, `entry_user_id`, `entry_datetime`, `modified_user_id`, `modified_datetime`, `status`) VALUES
(1, 'Deputy General Manager', 'deputy-general-manager', 1, NULL, NULL, NULL, NULL, 1),
(2, 'Assistant Manager', 'assistant-manager', 1, NULL, NULL, NULL, NULL, 1),
(3, 'Senior Executive', 'senior-executive', 1, NULL, NULL, NULL, NULL, 1),
(4, 'Executive', 'executive', 1, NULL, NULL, NULL, NULL, 1),
(5, 'Software Developer', 'software-developer', 1, NULL, NULL, NULL, NULL, 1),
(6, 'Deputy General Manager', 'deputy-general-manager', 2, NULL, NULL, NULL, NULL, 1),
(7, 'Chief Human Resources Officer', 'chief-human-resources-officer', 2, NULL, NULL, NULL, NULL, 1),
(8, 'Senior Executive', 'senior-executive', 2, NULL, NULL, NULL, NULL, 1),
(9, 'Executive', 'executive', 2, NULL, NULL, 1, '2021-10-03 11:58:26', 1),
(10, 'System Administrator', 'system-administrator', 3, NULL, NULL, NULL, NULL, 1),
(11, 'Receptionist', 'receptionist', 1, NULL, NULL, NULL, NULL, 1),
(12, 'Receptionist', 'receptionist', 2, NULL, NULL, NULL, NULL, 1),
(13, 'Receptionist', 'receptionist', 3, NULL, NULL, NULL, NULL, 1),
(14, 'Senior Analyst', 'senior-analyst', 4, 1, '2021-10-04 09:06:43', NULL, NULL, 1),
(15, 'Senior Analyst', 'senior-analyst', 4, 1, '2021-10-04 09:07:41', NULL, NULL, 1),
(16, 'Senior Analyst', 'senior-analyst', 4, 1, '2021-10-04 09:08:57', NULL, NULL, 1),
(17, 'Senior Analyst', 'senior-analyst', 4, 1, '2021-10-04 09:10:12', NULL, NULL, 1),
(18, 'Senior Analyst', 'senior-analyst', 4, 1, '2021-10-04 09:11:47', NULL, NULL, 1),
(19, 'Senior Analyst', 'senior-analyst', 4, 1, '2021-10-04 09:14:37', NULL, NULL, 1),
(20, 'Senior Analyst', 'senior-analyst', 4, 1, '2021-10-04 09:16:48', NULL, NULL, 1);

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
  `nid_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passport_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `driving_license_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_hour` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `end_hour` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `building_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gate_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `floor_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `elevator_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `room_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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

INSERT INTO `employees` (`employee_id`, `user_id`, `user_type_id`, `first_name`, `last_name`, `slug`, `gender`, `dob`, `eid_no`, `dept_id`, `designation_id`, `mobile_no`, `email`, `address`, `photo`, `nid_no`, `passport_no`, `driving_license_no`, `start_hour`, `end_hour`, `building_no`, `gate_no`, `floor_no`, `elevator_no`, `room_no`, `entry_user_id`, `entry_datetime`, `modified_user_id`, `modified_datetime`, `availability`, `status`) VALUES
(1, 2, 2, 'Rayhan', 'Zaman', 'rayhan-zaman', 1, '2021-09-22', 1, 1, 5, '01521449100', 'rayhan.zaman2@sebpo.com', 'Dhaka', 'employee1632294289.jpg', '1234567891234567', '1234567891234567', '1234567891234567', '10:30', '18:30', NULL, NULL, NULL, NULL, NULL, NULL, '2021-09-22 07:04:49', NULL, NULL, 1, 1),
(2, 5, 2, 'Gazi Alim', 'Al Razy', 'gazi alim-al razy', 1, '2021-09-22', 3, 1, 1, '01711924545', 'rayhan.zaman3@sebpo.com', 'Dhaka', 'employee1632316311.jpg', '1234567891234567', '1234567891234567', '1234567891234567', '10:08', '19:00', NULL, NULL, NULL, NULL, NULL, NULL, '2021-09-22 13:11:51', NULL, NULL, 1, 1),
(3, 6, 2, 'Shirajul', 'Islam', 'shirajul-islam', 1, '1995-09-15', 12345, 3, 10, '78945612378', 'any@gmail.com', NULL, 'employee1632316656.jpg', NULL, NULL, NULL, '10:16', '22:16', NULL, NULL, NULL, NULL, NULL, NULL, '2021-09-22 13:17:36', NULL, NULL, 1, 1),
(4, 7, 2, 'Ashraful', 'Alam', 'ashraful-alam', 1, '1994-02-01', 2274, 1, 3, '01672548372', 'ashraful1@sebpo.com', 'Sector-4, Uttara, Bangladesh', 'employee1632317113.jpg', '19949329508000043', NULL, NULL, '10:30', '19:30', NULL, NULL, NULL, NULL, NULL, NULL, '2021-09-22 13:25:13', NULL, NULL, 1, 1),
(5, 8, 2, 'Didarul', 'Islam', 'didarul-islam', 1, NULL, 1234, 1, 2, '01742592926', 'didarul.islam1@sebpo.com', NULL, NULL, NULL, NULL, NULL, '10:00', '19:00', NULL, NULL, NULL, NULL, NULL, NULL, '2021-09-22 13:29:02', NULL, NULL, 1, 1),
(7, 12, 2, 'Rayhan', 'Zaman', 'rayhan-zaman', 1, '2021-09-27', 3297, 1, 5, '01521449109', 'rayhan.zaman4@sebpo.com', 'Dhaka', 'employee1632725583.jpg', '1234567890', '1234567890', '1234567890', '10:30', '18:30', 'West Building', 'Gate 1', '1st Floor', 'Elevator 1', 'Room 1', NULL, '2021-09-27 06:53:03', NULL, NULL, 1, 0),
(8, 15, 2, 'FTest29', 'LTest29', 'ftest29-ltest29', 1, '2021-09-28', 3297, 1, 5, '01521449358', 'rayhan.zaman29@sebpo.com', 'Dhaka', 'employee1632810249.jpg', '1234567891234567', '1234567891234567', '1234567891234567', '10:30', '18:30', 'West Building', 'Gate 1', '4th Floor', 'Elevator 1', 'Room 1', NULL, '2021-09-28 06:24:09', NULL, NULL, 1, 1),
(9, 16, 3, 'First Receptionist', 'Last Receptionist', 'first receptionist-last receptionist', NULL, NULL, 3297, 1, 11, '01955181456', 'rayhan.zaman30@sebpo.com', NULL, NULL, NULL, NULL, NULL, '07:15', '22:15', 'East Building', 'Gate 1', NULL, NULL, NULL, NULL, '2021-09-28 11:18:17', NULL, NULL, 1, 1);

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
(1, 3, 1, 1, 1, 'test', '2021-09-23 13:26:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(3, 9, 3, 2, 1, 'sdjsndfojs', '2021-09-23 10:40:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1),
(4, 10, 4, 4, 1, 'official', '2021-09-23 10:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 0, 1),
(5, 10, 4, 2, 1, 'Supplier', '2021-09-26 11:50:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 0, 1),
(6, 9, 3, 2, 1, 'sdjsndfojs', '2021-09-23 10:40:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1),
(7, 9, 3, 2, 1, 'sdjsndfojs', '2021-09-23 10:40:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1);

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
(1, 'Official Work', 'Official Work', NULL, NULL, NULL, NULL, 1),
(2, 'Others', 'Others', NULL, NULL, NULL, NULL, 1),
(3, 'Meeting', 'Meeting', NULL, NULL, NULL, NULL, 1),
(4, 'Job Interview', 'Job Interview', NULL, NULL, NULL, NULL, 1),
(5, 'Delivery', 'Delivery', NULL, NULL, NULL, NULL, 1),
(6, 'Contract Signing', 'Contract Signing', NULL, NULL, NULL, NULL, 1),
(7, 'Agreement Signing', 'Agreement Signing', NULL, NULL, NULL, NULL, 1),
(8, 'Audit', 'Audit', NULL, NULL, NULL, NULL, 1);

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
-- Table structure for table `reception_logs`
--

CREATE TABLE `reception_logs` (
  `log_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_type_id` int(11) NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` int(11) NOT NULL,
  `dob` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `eid_no` bigint(20) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `designation_id` int(11) NOT NULL,
  `mobile_no` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nid_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `passport_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `driving_license_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_hour` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `end_hour` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `building_no` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gate_no` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `floor_no` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `elevator_no` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `room_no` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `entry_user_id` int(11) NOT NULL,
  `entry_datetime` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `log_type` tinyint(10) NOT NULL COMMENT '0=pending, 1=add, 2=update, 3=delete',
  `status` int(11) NOT NULL COMMENT '0=removed, 1=desplay'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reception_logs`
--

INSERT INTO `reception_logs` (`log_id`, `employee_id`, `user_id`, `user_type_id`, `first_name`, `last_name`, `gender`, `dob`, `eid_no`, `dept_id`, `designation_id`, `mobile_no`, `email`, `address`, `photo`, `nid_no`, `passport_no`, `driving_license_no`, `start_hour`, `end_hour`, `building_no`, `gate_no`, `floor_no`, `elevator_no`, `room_no`, `entry_user_id`, `entry_datetime`, `description`, `log_type`, `status`) VALUES
(1, 15, 18, 3, 'New Receptionist updt', 'One updt', 1, '1990-01-01', 1234, 1, 11, '01577163339', 'tauhid.hasan1@sebpo.com', 'Karwarbazar', 'employee1632906228.jpg', '123456789', '123456789', '123456789', '10:00', '19:00', 'East Building', 'Gate 1', '1st Floor', 'Elevator 1', 'Room 1', 18, '2021-10-04 12:27:37', 'Reception profile update request', 2, 1),
(2, 15, 18, 3, 'New Receptionist updt', 'One', 1, '1990-01-01', 1234, 1, 11, '01577163339', 'tauhid.hasan1@sebpo.com', 'Karwarbazar', 'employee1632906228.jpg', '123456789', '123456789', '123456789', '10:00', '19:00', 'East Building', 'Gate 1', '1st Floor', 'Elevator 1', 'Room 1', 18, '2021-10-05 05:47:33', 'Reception profile update request', 2, 1);

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
  `mobile_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type_id` int(11) NOT NULL,
  `is_approved` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=pending, 1=approved, 2=declined',
  `entry_datetime` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `modified_datetime` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `mobile_no`, `email`, `password`, `user_type_id`, `is_approved`, `entry_datetime`, `modified_datetime`) VALUES
(1, '01234567890', 'rayhan.zaman@sebpo.com', '$2y$10$3P3lzrKVNNbjI9tEHB2DEOON.lz0UE28GUbMt4WOZ.lZpv7TUbrSi', 1, 1, '2021-09-22 07:04:49', NULL),
(2, '01521449100', 'rayhan.zaman2@sebpo.com', '$2y$10$3P3lzrKVNNbjI9tEHB2DEOON.lz0UE28GUbMt4WOZ.lZpv7TUbrSi', 2, 1, '2021-09-22 07:04:49', NULL),
(3, '01955181028', 'rayhan.zaman5@sebpo.com', '$2y$10$IHUpizB/DFRdmU78leYlUemaBue7YSysC7rNhBNu84Iondj/hT3FS', 4, 1, '2021-09-22 07:16:00', NULL),
(4, '01987456321', 'tauhid.hasan@sebpo.com', '$2y$10$KZfiHa8Fm5/Bfuw.kY2i5.ZlBPaPXqYnsCPBpF28k2glPdyDO7X9C', 4, 1, '2021-09-22 13:01:35', NULL),
(5, '01711924545', 'rayhan.zaman3@sebpo.com', '$2y$10$8BN.jNKHDqgT2PO0RlH6pulFKw7OKFr5.cBwZmaEdtr6YBe2HXP9q', 2, 1, '2021-09-22 13:11:51', NULL),
(6, '78945612378', 'any@gmail.com', '$2y$10$2mNAgIkwhVlQk4ivdCpGkehKToE1/06ak3kuwHu9Om2VUb5As/O5K', 2, 1, '2021-09-22 13:17:36', NULL),
(7, '01672548372', 'ashraful1@sebpo.com', '$2y$10$Zt9J91PuCVDfJ.e1MHJ8/O0XSds7TcSd7PTWUv4KMpakDjtMjuccC', 2, 1, '2021-09-22 13:25:13', NULL),
(8, '01742592926', 'didarul.islam@sebpo.com', '$2y$10$SmM5InZvRoUqv.5Wc2.WqO.wrTgiwTbo7mgP88tnWi3ic6iyzmgQC', 2, 1, '2021-09-22 13:29:02', NULL),
(9, '01794356471', 'ashraful@sebpo.com', '$2y$10$xmh555mZKaX5ObAKCYvWP.IQLcnqxB.SboV.WCzu0Y02KJ5tyH.Y.', 4, 1, '2021-09-22 13:33:09', NULL),
(10, '01914594422', 'didar.austcse@gmail.com', '$2y$10$ytxieMrF68H98OQnnAjjM.iJvL.6MMNDCKh7CSEvu0RE2yRudAD4u', 4, 1, '2021-09-22 13:35:17', NULL),
(12, '01521449109', 'rayhan.zaman4@sebpo.com', '$2y$10$BqdtYa/apc57ogAIW96Qge98MhwwUl4UATHGzpFeKnrtOyXgza0vK', 2, 0, '2021-09-27 06:53:03', NULL),
(13, '01521449123', 'rayhan.zaman1@sebpo.com', '$2y$10$iSjp1RlyKuQpx1u4Iyqm1.aYDisMpWq4JPpL3Lmvd.MhmbdFpcaqe', 4, 1, '2021-09-27 08:40:05', NULL),
(14, '01955181358', 'rayhan.zaman28@sebpo.com', '$2y$10$evmV/AWxNPleTEEKfTV0S.FFt6WoakKyVLZ1mdaMKAh7eGqgxb3cS', 4, 1, '2021-09-28 06:20:03', NULL),
(15, '01521449358', 'rayhan.zaman29@sebpo.com', '$2y$10$9u.8YQpeWb6OmRbXIsrwMuP4hnSjVepGQr8sK4CluKg.gSYLlhz3e', 2, 1, '2021-09-28 06:24:09', NULL),
(16, '01955181456', 'rayhan.zaman30@sebpo.com', '$2y$10$JJbAsgGMj2oLP6sVg/HJyeKVyCJvO9J6KDi2nXpSiM8phZeSNkMCS', 3, 1, '2021-09-28 11:18:17', NULL);

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
(2, 'Host', 1),
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
  `organization` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` int(11) DEFAULT NULL,
  `dob` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nid_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passport_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `driving_license_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `entry_user_id` int(11) DEFAULT NULL,
  `entry_datetime` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `modified_user_id` int(11) DEFAULT NULL,
  `modified_datetime` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `visitor_status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=deactivated, 1=active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `visitors`
--

INSERT INTO `visitors` (`visitor_id`, `user_id`, `visitor_type`, `first_name`, `last_name`, `slug`, `organization`, `designation`, `gender`, `dob`, `mobile_no`, `email`, `address`, `profile_photo`, `nid_no`, `passport_no`, `driving_license_no`, `entry_user_id`, `entry_datetime`, `modified_user_id`, `modified_datetime`, `visitor_status`) VALUES
(1, 3, 1, 'Rayhan', 'Zaman', 'rayhan-zaman', '', NULL, 1, '2021-09-22', '1955181028', 'rayhan.zaman5@sebpo.com', 'Dhaka', 'visitor1632294960.jpg', '1234567891234567', '1234567891234567', '1234567891234567', NULL, '2021-09-22 07:16:00', NULL, NULL, 1),
(2, 4, 2, 'Tauhid', 'Hasan', 'tauhid-hasan', '', NULL, 1, '1990-09-22', '1234567890', 'tauhid.hasan@sebpo.com', 'New visitor 001 address', 'visitor1632315695.jpg', '123456789012345', '123456789012345', '123456789012345', NULL, '2021-09-22 13:01:35', NULL, NULL, 1),
(3, 9, 2, 'Ashraful', 'Alam', 'ashraful-alam', '', NULL, 1, '1994-02-01', '1794356471', 'ashraful@sebpo.com', 'Holding No- 903, Village: Alowa Bhabani', 'visitor1632317589.jpg', '19949329508000043', NULL, NULL, NULL, '2021-09-22 13:33:09', NULL, NULL, 1),
(4, 10, 2, 'Romana', 'Tanzim', 'romana-tanzim', '', NULL, 2, NULL, '1914594422', 'didar.austcse@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, '2021-09-22 13:35:17', NULL, NULL, 1),
(5, 13, 2, 'Rayhan', 'Zaman', 'rayhan-zaman', 'SEBPO', 'Software Developer', 1, '2021-09-27', '1521449123', 'rayhan.zaman1@sebpo.com', 'Dhaka', 'visitor1632732005.jpg', '1234567891234567', '1234567891234567', '1234567891234567', NULL, '2021-09-27 08:40:05', NULL, NULL, 1),
(6, 14, 2, 'FTest28', 'LTest28', 'ftest28-ltest28', 'SEBPO', 'Software Developer', 1, '2021-09-28', '1955181358', 'rayhan.zaman28@sebpo.com', 'Dhaka', 'visitor1632810003.jpg', '1234567891234567', '1234567891234567', '1234567891234567', NULL, '2021-09-28 06:20:03', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `visitor_logs`
--

CREATE TABLE `visitor_logs` (
  `log_id` int(11) NOT NULL,
  `visitor_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `visitor_type` int(11) NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `organization` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` int(11) NOT NULL,
  `dob` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_no` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nid_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `passport_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `driving_license_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `entry_user_id` int(11) NOT NULL,
  `entry_datetime` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `log_type` int(11) NOT NULL COMMENT '0=pending, 1=add, 2=update, 3=delete',
  `status` int(11) NOT NULL COMMENT '0=removed, 1=display'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `visitor_type_status` int(11) NOT NULL DEFAULT 1 COMMENT '1=active, 0=inactive, 2=void',
  `entry_user_id` int(11) DEFAULT NULL,
  `entry_datetime` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `modified_user_id` int(11) DEFAULT NULL,
  `modified_datetime` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `visitor_types`
--

INSERT INTO `visitor_types` (`visitor_type_id`, `visitor_type`, `slug`, `visitor_type_status`, `entry_user_id`, `entry_datetime`, `modified_user_id`, `modified_datetime`) VALUES
(1, 'Media Personnel', 'media-personnel', 2, NULL, '2021-09-29 06:02:15', NULL, NULL),
(2, 'Official Employees', 'official employees', 2, NULL, '2021-09-29 06:02:15', 1, '2021-09-30 07:02:38'),
(4, 'Meeting Attendee', 'meeting-attendee', 2, NULL, '2021-09-29 06:02:15', NULL, NULL),
(5, 'Candidate', 'candidate', 2, NULL, '2021-09-29 06:02:15', NULL, NULL),
(6, 'Deliveryman', 'deliveryman', 1, NULL, '2021-09-29 06:02:15', NULL, NULL),
(7, 'Vendor', 'vendor', 1, NULL, '2021-09-29 06:02:15', NULL, NULL),
(8, 'Contractor', 'contractor', 1, NULL, '2021-09-29 06:02:15', NULL, NULL),
(9, 'Auditor', 'auditor', 1, NULL, '2021-09-29 06:02:15', NULL, NULL),
(10, 'Enquiry Personnel', 'enquiry-personnel', 1, NULL, '2021-09-29 06:02:15', NULL, NULL),
(11, 'Postman', 'postman', 1, NULL, '2021-09-29 06:02:15', NULL, NULL),
(12, 'Others', 'others', 1, 1, '2021-09-29 06:02:15', 1, '2021-09-29 10:09:55'),
(14, 'Stuff', 'stuff', 1, 1, '2021-09-29 06:02:15', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_logs`
--
ALTER TABLE `admin_logs`
  ADD PRIMARY KEY (`log_id`);

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
-- Indexes for table `reception_logs`
--
ALTER TABLE `reception_logs`
  ADD PRIMARY KEY (`log_id`);

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
-- AUTO_INCREMENT for table `admin_logs`
--
ALTER TABLE `admin_logs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `custom_messages`
--
ALTER TABLE `custom_messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `dept_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `designations`
--
ALTER TABLE `designations`
  MODIFY `designation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
  MODIFY `meeting_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `meeting_purposes`
--
ALTER TABLE `meeting_purposes`
  MODIFY `purpose_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

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
  MODIFY `user_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `visitor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `visitor_pass`
--
ALTER TABLE `visitor_pass`
  MODIFY `visitor_pass_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `visitor_types`
--
ALTER TABLE `visitor_types`
  MODIFY `visitor_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
