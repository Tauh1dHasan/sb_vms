-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 24, 2021 at 07:23 AM
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
-- Database: `vmsdb`
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
(1, 'Business Development', 'business-development', NULL, NULL, NULL, NULL, 1),
(2, 'Human Resources', 'human-resources', NULL, NULL, NULL, NULL, 1),
(3, 'IT', 'it', NULL, NULL, NULL, NULL, 1);

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
  `status` tinyint(1) DEFAULT 1 COMMENT '0=inactive, 1=active'
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
(9, 'Executive', 'executive', 2, NULL, NULL, NULL, NULL, 1),
(10, 'System Administrator', 'system-administrator', 3, NULL, NULL, NULL, NULL, 1),
(11, 'Receptionist', 'receptionist', 1, NULL, NULL, NULL, NULL, 1),
(12, 'Receptionist', 'receptionist', 2, NULL, NULL, NULL, NULL, 1),
(13, 'Receptionist', 'receptionist', 3, NULL, NULL, NULL, NULL, 1);

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
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=pending, 1=approved, 2=declined\r\n3=changed'
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
(7, 12, 2, 'Rayhan', 'Zaman', 'rayhan-zaman', 1, '2021-09-27', 3297, 1, 5, '01521449109', 'rayhan.zaman4@sebpo.com', 'Dhaka', 'employee1632725583.jpg', '1234567890', '1234567890', '1234567890', '10:30', '18:30', 'West Building', 'Gate 1', '1st Floor', 'Elevator 1', 'Room 1', NULL, '2021-09-27 06:53:03', NULL, NULL, 1, 1),
(8, 15, 2, 'FTest29', 'LTest29', 'ftest29-ltest29', 1, '2021-09-28', 3297, 1, 5, '01521449358', 'rayhan.zaman29@sebpo.com', 'Dhaka', 'employee1632810249.jpg', '1234567891234567', '1234567891234567', '1234567891234567', '10:30', '18:30', 'West Building', 'Gate 1', '4th Floor', 'Elevator 1', 'Room 1', NULL, '2021-09-28 06:24:09', NULL, NULL, 1, 1),
(12, 17, 2, 'Host Tauhid', 'Hasan', 'host tauhid-hasan', 1, '1996-01-07', 3298, 1, 5, '01677163339', 'tauhid.hasan@sebpo.com', 'Abbas garden road', 'employee1632818730.jpg', '1234567891234567', '0123456789012345', '0123456789012345', '10:30', '19:00', 'East Building', 'Gate 1', '1st Floor', 'Elevator 1', 'Room 1', 17, '2021-09-28 08:46:44', 17, '2021-09-28 08:46:44', 1, 1),
(15, 18, 3, 'New Receptionist', 'One', 'new receptionist-one', 1, '1990-01-01', 1234, 1, 11, '01577163339', 'tauhid.hasan1@sebpo.com', 'Karwarbazar', 'employee1632906228.jpg', '123456789', '123456789', '123456789', '10:00', '19:00', 'East Building', 'Gate 1', '1st Floor', 'Elevator 1', 'Room 1', 18, '2021-10-03 08:42:47', 18, '2021-10-03 08:42:47', 1, 1);

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
-- Table structure for table `forgot_passwords`
--

CREATE TABLE `forgot_passwords` (
  `forgot_password_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `issue_datetime` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `use_datetime` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL COMMENT '1=active, 0=inactive '
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `forgot_passwords`
--

INSERT INTO `forgot_passwords` (`forgot_password_id`, `user_id`, `token`, `issue_datetime`, `use_datetime`, `status`) VALUES
(6, 17, '20211019041012db957ef99d0a6d0b00b58d3fd756be42', '2021-10-19 16:10:12', NULL, 0),
(7, 17, '20211019041133cba283e9199ed64e2dbad5ff1b6855a2', '2021-10-19 16:11:33', NULL, 0),
(8, 17, '20211019042907d59d0dac30091664acbd15a4b84701bd', '2021-10-19 16:29:07', '2021-10-19 16:29:27', 0),
(9, 17, '20211019045353ade7444d2caa05e2a7c291606f7fc1ef', '2021-10-19 16:53:53', '2021-10-19 16:54:49', 0);

-- --------------------------------------------------------

--
-- Table structure for table `host_logs`
--

CREATE TABLE `host_logs` (
  `log_id` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_type_id` int(11) DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` int(11) DEFAULT NULL,
  `dob` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `eid_no` int(11) DEFAULT NULL,
  `dept_id` int(11) DEFAULT NULL,
  `designation_id` int(11) DEFAULT NULL,
  `mobile_no` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nid_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passport_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `driving_license_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_hour` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `end_hour` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `building_no` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gate_no` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `floor_no` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `elevator_no` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `room_no` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `availability` tinyint(1) DEFAULT NULL,
  `entry_user_id` int(11) DEFAULT NULL,
  `entry_datetime` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `modified_user_id` int(11) DEFAULT NULL,
  `modified_datetime` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `log_type` int(11) DEFAULT NULL COMMENT '0=pending, 1=add, 2=profile_update, 3=delete, 4=profile_update_accept, 5=profile_update_declined',
  `status` int(11) DEFAULT NULL COMMENT '0=removed, 1=desplay'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `host_logs`
--

INSERT INTO `host_logs` (`log_id`, `employee_id`, `user_id`, `user_type_id`, `first_name`, `last_name`, `gender`, `dob`, `eid_no`, `dept_id`, `designation_id`, `mobile_no`, `email`, `address`, `photo`, `nid_no`, `passport_no`, `driving_license_no`, `start_hour`, `end_hour`, `building_no`, `gate_no`, `floor_no`, `elevator_no`, `room_no`, `availability`, `entry_user_id`, `entry_datetime`, `modified_user_id`, `modified_datetime`, `description`, `log_type`, `status`) VALUES
(6, 12, 17, 2, 'Host Tauhid updt', 'Hasan', 1, '1996-01-07', NULL, 1, 5, '01677163339', 'tauhid.hasan@sebpo.com', 'Abbas garden road', 'employee1632818730.jpg', '1234567891234567', '0123456789012345', '0123456789012345', '10:30', '19:00', 'East Building', 'Gate 1', '1st Floor', 'Elevator 1', 'Room 1', 1, 17, '2021-10-18 14:59:34', NULL, NULL, 'Host profile update request', 2, 1);

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
-- Table structure for table `login_lockdowns`
--

CREATE TABLE `login_lockdowns` (
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
  `attendees_no` int(11) NOT NULL,
  `meeting_start_time` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meeting_end_time` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `entry_user_id` int(11) DEFAULT NULL,
  `entry_datetime` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `modified_user_id` int(11) DEFAULT NULL,
  `modified_datetime` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cancel_reason` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meeting_status` int(11) NOT NULL DEFAULT 0 COMMENT '0=pending, 1=approved, 2=declined, 3=rescheduled, 4=canceled, 11=on going, 12=end meeting',
  `checkin_status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=not arrived, 1=checkin,\r\n2=checkout',
  `has_vehicle` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=no, 1=yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `meetings`
--

INSERT INTO `meetings` (`meeting_id`, `user_id`, `visitor_id`, `employee_id`, `meeting_purpose_id`, `purpose_describe`, `meeting_datetime`, `attendees_no`, `meeting_start_time`, `meeting_end_time`, `entry_user_id`, `entry_datetime`, `modified_user_id`, `modified_datetime`, `cancel_reason`, `meeting_status`, `checkin_status`, `has_vehicle`) VALUES
(1, 3, 1, 1, 1, 'test', '2021-09-23 13:26:00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(3, 9, 3, 2, 1, 'sdjsndfojs', '2021-09-23 10:40:00', 0, '2021-10-11 10:39:39', '2021-10-11 12:36:32', NULL, NULL, NULL, NULL, NULL, 12, 2, 1),
(4, 10, 4, 4, 1, 'official', '2021-09-23 10:00:00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 0, 1),
(5, 10, 4, 2, 1, 'Supplier', '2021-09-26 11:50:00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 0, 1),
(11, 18, 10, 12, 1, 'Project meeting 001 4/10/21', '2021-10-04 12:00:00', 0, NULL, NULL, 18, '2021-10-04 05:05:21', NULL, NULL, NULL, 0, 0, 0),
(12, 18, 9, 12, 1, 'Project Meeting', '2021-10-06 13:00:00', 0, '2021-10-11 10:28:58', '2021-10-14 13:55:26', 18, '2021-10-05 10:04:03', NULL, NULL, NULL, 12, 2, 0),
(13, 18, 9, 12, 1, 'Project Meeting', '2021-10-10 15:35:00', 0, NULL, NULL, 18, '2021-10-05 10:05:13', NULL, NULL, NULL, 3, 0, 0),
(14, 16, 9, 12, 3, 'Project meeting with other developers', '2021-10-08 15:22:00', 0, NULL, NULL, 16, '2021-10-07 09:22:34', NULL, NULL, NULL, 0, 0, 0),
(15, 16, 9, 12, 3, 'Project meeting with other developers', '2021-10-08 15:22:00', 0, NULL, NULL, 16, '2021-10-07 09:23:17', 16, '2021-10-07 10:42:06', 'Time is not suitable', 4, 0, 0),
(16, 16, 9, 1, 1, 'Official meeting', '2021-10-13 01:00:00', 0, NULL, NULL, 16, '2021-10-10 10:01:34', NULL, NULL, NULL, 0, 0, 0),
(17, 16, 9, 12, 1, 'Office meeting', '2021-10-12 16:10:00', 0, '2021-10-11 10:18:06', '2021-10-11 12:36:12', 16, '2021-10-10 10:06:50', NULL, NULL, NULL, 12, 2, 0),
(18, 16, 9, 12, 3, 'Project meeting for VMS', '2021-10-12 01:00:00', 0, '2021-10-12 10:38:07', '2021-10-12 10:38:26', 16, '2021-10-11 13:01:51', NULL, NULL, NULL, 12, 2, 0),
(19, 16, 9, 12, 4, 'Job interview', '2021-10-13 13:30:00', 0, '2021-10-17 17:20:24', NULL, 16, '2021-10-12 15:36:43', NULL, NULL, NULL, 11, 1, 0),
(20, 1, 9, 12, 6, 'Project contract signing ceremony', '2021-10-14 12:15:00', 0, NULL, NULL, 1, '2021-10-13 12:15:22', NULL, NULL, NULL, 0, 0, 0),
(21, 1, 9, 12, 6, 'Project contract signing ceremony', '2021-10-14 12:15:00', 0, NULL, NULL, 1, '2021-10-13 12:20:10', NULL, NULL, NULL, 0, 0, 0),
(22, 18, 9, 12, 5, 'From delivery service', '2021-10-17 12:23:00', 0, NULL, NULL, 18, '2021-10-13 12:24:03', NULL, NULL, NULL, 0, 0, 0),
(23, 16, 9, 12, 2, 'Office visiting with four others', '2021-10-21 12:00:00', 4, NULL, NULL, 16, '2021-10-18 11:16:04', NULL, NULL, NULL, 1, 0, 0),
(24, 18, 9, 12, 6, 'Signing ceremony of new project', '2021-10-24 12:00:00', 5, NULL, NULL, 18, '2021-10-18 12:11:59', NULL, NULL, NULL, 0, 0, 1),
(25, 25, 16, 12, 3, NULL, '2021-10-25 01:00:00', 2, NULL, NULL, 18, '2021-10-21 17:51:42', NULL, NULL, NULL, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `meeting_logs`
--

CREATE TABLE `meeting_logs` (
  `log_id` int(11) NOT NULL,
  `meeting_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `visitor_id` int(11) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `meeting_purpose_id` int(11) DEFAULT NULL,
  `purpose_describe` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meeting_datetime` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attendees_no` int(11) NOT NULL,
  `meeting_start_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meeting_end_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cancel_reason` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meeting_status` int(11) DEFAULT NULL COMMENT '0=pending, 1=approved, 2=declined, 3=rescheduled, 4=canceled, 11=on going, 12=end meeting	',
  `checkin_status` int(11) DEFAULT NULL,
  `has_vehicle` int(11) DEFAULT NULL,
  `entry_user_id` int(11) DEFAULT NULL,
  `entry_datetime` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `log_type` int(11) DEFAULT NULL COMMENT '0=pending \r\n1=approved \r\n2=declined \r\n3=rescheduled\r\n4=canceled, \r\n5=appointment_placed_by_reception\r\n6=appointment_placed_by_visitor\r\n11=on going\r\n12=end meeting	\r\n',
  `status` int(11) DEFAULT NULL COMMENT '0=removed, 1=display'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `meeting_logs`
--

INSERT INTO `meeting_logs` (`log_id`, `meeting_id`, `user_id`, `visitor_id`, `employee_id`, `meeting_purpose_id`, `purpose_describe`, `meeting_datetime`, `attendees_no`, `meeting_start_time`, `meeting_end_time`, `cancel_reason`, `meeting_status`, `checkin_status`, `has_vehicle`, `entry_user_id`, `entry_datetime`, `description`, `log_type`, `status`) VALUES
(1, 13, 18, 9, 12, 1, 'Project Meeting', '2021/10/06 13:00', 0, NULL, NULL, NULL, 0, NULL, 0, 18, '2021-10-05 10:05:13', 'Appointment placed from reception panel', 5, 1),
(2, 13, 17, 9, 12, 1, 'Project Meeting', '2021-10-06 13:00:00', 0, NULL, NULL, NULL, 2, 0, 0, 17, '2021-10-06 09:25:01', 'Appointment declined by host', 2, 1),
(3, 8, 17, 7, 12, 3, 'Project Meeting', '2021-10-08 13:00:00', 0, NULL, NULL, NULL, 2, 0, 0, 17, '2021-10-06 09:25:53', 'Appointment declined by host', 2, 1),
(4, 13, 17, 9, 12, 1, 'Project Meeting', '2021-10-06 13:00:00', 0, NULL, NULL, NULL, 1, 0, 0, 17, '2021-10-06 09:28:00', 'Appointment approved by host', 1, 1),
(5, 13, 17, 9, 12, 1, 'Project Meeting', '2021-10-10T15:30', 0, NULL, NULL, NULL, 3, 0, 0, 17, '2021-10-06 09:31:04', 'Appointment Re-scheduled by host', 3, 1),
(6, 13, 17, 9, 12, 1, 'Project Meeting', '2021/10/10 15:35', 0, NULL, NULL, NULL, 3, 0, 0, 17, '2021-10-06 09:32:23', 'Appointment Re-scheduled by host', 3, 1),
(7, 15, 16, 9, 12, 3, 'Project meeting with other developers', '2021/10/08 15:22', 0, NULL, NULL, NULL, 0, NULL, 0, 16, '2021-10-07 09:23:17', 'Appointment placed from visitor panel', 6, 1),
(8, 15, 16, 9, 12, 3, 'Project meeting with other developers', '2021-10-08 15:22:00', 0, NULL, NULL, 'Time is not suitable', 4, NULL, 0, 16, '2021-10-07 10:42:06', 'Appointment canceled by visitor', 4, 1),
(9, 16, 16, 9, 1, 1, 'Official meeting', '2021/10/13 01:00', 0, NULL, NULL, NULL, 0, NULL, 0, 16, '2021-10-10 10:01:34', 'Appointment placed from visitor panel', 6, 1),
(10, 17, 16, 9, 12, 1, 'Office meeting', '2021/10/12 16:10', 0, NULL, NULL, NULL, 0, NULL, 0, 16, '2021-10-10 10:06:50', 'Appointment placed from visitor panel', 6, 1),
(11, 17, 17, 9, 12, 1, 'Office meeting', '2021-10-12 16:10:00', 0, NULL, NULL, NULL, 1, 0, 0, 17, '2021-10-10 10:07:58', 'Appointment approved by host', 1, 1),
(12, 18, 16, 9, 12, 3, 'Project meeting for VMS', '2021/10/12 01:00', 0, NULL, NULL, NULL, 0, NULL, 0, 16, '2021-10-11 13:01:51', 'Appointment placed from visitor panel', 6, 1),
(13, 18, 17, 9, 12, 3, 'Project meeting for VMS', '2021-10-12 01:00:00', 0, NULL, NULL, NULL, 1, 0, 0, 17, '2021-10-11 13:02:22', 'Appointment approved by host', 1, 1),
(14, 19, 16, 9, 12, 4, 'Job interview', '2021/10/13 13:30', 0, NULL, NULL, NULL, 0, NULL, 0, 16, '2021-10-12 15:36:43', 'Appointment placed from visitor panel', 6, 1),
(15, 19, 17, 9, 12, 4, 'Job interview', '2021-10-13 13:30:00', 0, NULL, NULL, NULL, 1, 0, 0, 17, '2021-10-12 15:37:14', 'Appointment approved by host', 1, 1),
(16, 20, 1, 9, 12, 6, 'Project contract signing ceremony', '2021/10/14 12:15', 0, NULL, NULL, NULL, 0, NULL, 0, 1, '2021-10-13 12:15:22', 'Appointment placed from Admin panel', 5, 1),
(17, 21, 1, 9, 12, 6, 'Project contract signing ceremony', '2021/10/14 12:15', 0, NULL, NULL, NULL, 0, NULL, 0, 1, '2021-10-13 12:20:10', 'Appointment placed from Admin panel', 5, 1),
(18, 22, 18, 9, 12, 5, 'From delivery service', '2021/10/17 12:23', 0, NULL, NULL, NULL, 0, NULL, 0, 18, '2021-10-13 12:24:03', 'Appointment placed from reception panel', 5, 1),
(19, 23, 16, 9, 12, 2, 'Office visiting with four others', '2021/10/21 12:00', 4, NULL, NULL, NULL, 0, NULL, 0, 16, '2021-10-18 11:16:04', 'Appointment placed from visitor panel', 6, 1),
(20, 24, 18, 9, 12, 6, 'Signing ceremony of new project', '2021/10/24 12:00', 5, NULL, NULL, NULL, 0, NULL, 1, 18, '2021-10-18 12:11:59', 'Appointment placed from reception panel', 5, 1),
(21, 23, 17, 9, 12, 2, 'Office visiting with four others', '2021-10-21 12:00:00', 4, NULL, NULL, NULL, 1, 0, 0, 17, '2021-10-21 10:48:55', 'Appointment approved by host', 1, 1),
(22, 25, 25, 16, 12, 3, NULL, '2021/10/25 01:00', 2, NULL, NULL, NULL, 0, NULL, 0, 18, '2021-10-21 17:51:42', 'Appointment placed from reception panel', 5, 1);

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

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`permission_id`, `permission_title`, `permission_status`) VALUES
(1, 'Manage Hosts', 1),
(2, 'Manage Receptionists', 1),
(3, 'Manage Visitors', 1),
(4, 'Manage Appointments', 1),
(5, 'Manage Departments & Designations', 1),
(6, 'Send Message', 1),
(7, 'Manage Roles & Permissions', 1),
(8, 'Manage Activity Log', 1),
(9, 'Settings', 1),
(10, 'All Appointments', 1),
(11, 'Today\'s Appointments', 1),
(12, 'Approved Appointments', 1),
(13, 'Pending Appointments', 1),
(14, 'Declined Appointments', 1),
(15, 'Rescheduled Appointments', 1),
(16, 'Edit Profile', 1),
(17, 'Create Appointment', 1),
(18, 'Create Visitor', 1),
(19, 'All Visitors', 1),
(20, 'Current Checked-in List', 1),
(21, 'Checked-out List', 1),
(22, 'Today\'s Checked-in', 1),
(23, 'Today\'s Checked-out', 1),
(24, 'Dashboard', 1);

-- --------------------------------------------------------

--
-- Table structure for table `reception_logs`
--

CREATE TABLE `reception_logs` (
  `log_id` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_type_id` int(11) DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` int(11) DEFAULT NULL,
  `dob` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `eid_no` bigint(20) DEFAULT NULL,
  `dept_id` int(11) DEFAULT NULL,
  `designation_id` int(11) DEFAULT NULL,
  `mobile_no` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nid_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passport_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `driving_license_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_hour` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `end_hour` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `building_no` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gate_no` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `floor_no` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `elevator_no` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `room_no` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `entry_user_id` int(11) DEFAULT NULL,
  `entry_datetime` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `modified_user_id` int(11) DEFAULT NULL,
  `modified_datetime` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `log_type` tinyint(10) DEFAULT NULL COMMENT '0=pending, 1=add, 2=update, 3=delete',
  `status` int(11) DEFAULT NULL COMMENT '0=removed, 1=desplay'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reception_logs`
--

INSERT INTO `reception_logs` (`log_id`, `employee_id`, `user_id`, `user_type_id`, `first_name`, `last_name`, `gender`, `dob`, `eid_no`, `dept_id`, `designation_id`, `mobile_no`, `email`, `address`, `photo`, `nid_no`, `passport_no`, `driving_license_no`, `start_hour`, `end_hour`, `building_no`, `gate_no`, `floor_no`, `elevator_no`, `room_no`, `entry_user_id`, `entry_datetime`, `modified_user_id`, `modified_datetime`, `description`, `log_type`, `status`) VALUES
(3, 15, 18, 3, 'New Receptionist updt', 'One', 1, '1990-01-01', NULL, 1, 11, '01577163339', 'tauhid.hasan1@sebpo.com', 'Karwarbazar', 'employee1632906228.jpg', '123456789', '123456789', '123456789', '10:00', '19:00', 'East Building', 'Gate 1', '1st Floor', 'Elevator 1', 'Room 1', 18, '2021-10-18 14:02:46', NULL, NULL, 'Reception profile update request', 2, 1);

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
(5, '01711924545', 'rayhan.zaman3@sebpo.com', '$2y$10$8BN.jNKHDqgT2PO0RlH6pulFKw7OKFr5.cBwZmaEdtr6YBe2HXP9q', 2, 1, '2021-09-22 13:11:51', NULL),
(6, '078945612378', 'any@gmail.com', '$2y$10$2mNAgIkwhVlQk4ivdCpGkehKToE1/06ak3kuwHu9Om2VUb5As/O5K', 2, 1, '2021-09-22 13:17:36', NULL),
(7, '01672548372', 'ashraful1@sebpo.com', '$2y$10$Zt9J91PuCVDfJ.e1MHJ8/O0XSds7TcSd7PTWUv4KMpakDjtMjuccC', 2, 1, '2021-09-22 13:25:13', NULL),
(8, '01742592926', 'didarul.islam@sebpo.com', '$2y$10$SmM5InZvRoUqv.5Wc2.WqO.wrTgiwTbo7mgP88tnWi3ic6iyzmgQC', 2, 1, '2021-09-22 13:29:02', NULL),
(9, '01794356471', 'ashraful@sebpo.com', '$2y$10$xmh555mZKaX5ObAKCYvWP.IQLcnqxB.SboV.WCzu0Y02KJ5tyH.Y.', 4, 1, '2021-09-22 13:33:09', NULL),
(10, '01914594422', 'didar.austcse@gmail.com', '$2y$10$ytxieMrF68H98OQnnAjjM.iJvL.6MMNDCKh7CSEvu0RE2yRudAD4u', 4, 1, '2021-09-22 13:35:17', NULL),
(12, '01521449109', 'rayhan.zaman4@sebpo.com', '$2y$10$BqdtYa/apc57ogAIW96Qge98MhwwUl4UATHGzpFeKnrtOyXgza0vK', 2, 1, '2021-09-27 06:53:03', NULL),
(13, '01521449123', 'rayhan.zaman1@sebpo.com', '$2y$10$iSjp1RlyKuQpx1u4Iyqm1.aYDisMpWq4JPpL3Lmvd.MhmbdFpcaqe', 4, 1, '2021-09-27 08:40:05', NULL),
(14, '01955181358', 'rayhan.zaman28@sebpo.com', '$2y$10$evmV/AWxNPleTEEKfTV0S.FFt6WoakKyVLZ1mdaMKAh7eGqgxb3cS', 4, 1, '2021-09-28 06:20:03', NULL),
(15, '01521449358', 'rayhan.zaman29@sebpo.com', '$2y$10$9u.8YQpeWb6OmRbXIsrwMuP4hnSjVepGQr8sK4CluKg.gSYLlhz3e', 2, 1, '2021-09-28 06:24:09', NULL),
(16, '01537152126', 'm.tah69@gmail.com', '$2y$10$P.SWc1v1l5CNwBvSTaNSMuqu1YvCJ69HwX2aXw00o3pRlMMLlOSwW', 4, 1, '2021-09-28 06:58:31', '2021-09-29 08:50:56'),
(17, '01677163339', 'tauhid.hasan@sebpo.com', '$2y$10$U5QP/dC79tNUF0W2t5OTCeK1OofCb7OlkQLipf6H7nqtDsExkkenm', 2, 1, '2021-09-28 07:01:09', '2021-10-19 16:54:49'),
(18, '01577163339', 'tauhid.hasan1@sebpo.com', '$2y$10$P.SWc1v1l5CNwBvSTaNSMuqu1YvCJ69HwX2aXw00o3pRlMMLlOSwW', 3, 1, '2021-09-29 09:03:48', '2021-10-03 07:53:42'),
(19, '01123456789', 'recepvisitor1@sebpo.com', '$2y$10$nzmZvwyQ3CHl76oOskRj8OMIBuWd2jn3ZNPdNCvaZBFNvo62/lFmu', 4, 1, '2021-10-03 09:30:28', NULL),
(20, '01122345678', 'recepvisitor2@sebpo.com', '$2y$10$VSSGMsTB0lV4Qgr58eHL7ecoSuzegVrhDRUKCx/ptTrOOC/T5n9Bq', 4, 2, '2021-10-03 10:02:25', NULL),
(22, '01122234566', 'visitorfromreception@gmail.com', '$2y$10$V/DOJHHWKNMnqzQ/r/PkWeoNsCFRRjVx5e5msxc4KM2H1Q9W9.dXC', 4, 0, '2021-10-05 08:39:21', NULL),
(23, '01112223334', 'visitorfromadmin@mail.com', '$2y$10$sTJ0AdVNiPXCvknXd5TyFuOmx2TAl.KJ4Ssv27fjG1jS95Pa7F2f6', 4, 1, '2021-10-17 11:15:19', NULL),
(25, '00011122223', 'wow@mail.com', '$2y$10$9vNgI9t.wdXH85YlV2oL4OMYxqvtXY2sdlVU5GL7927JPTx/tXUm.', 4, 0, '2021-10-21 17:51:39', NULL);

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
  `entry_user_id` int(11) NOT NULL,
  `entry_datetime` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `modified_user_id` int(11) NOT NULL,
  `modified_datetime` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type_status` int(11) NOT NULL DEFAULT 1 COMMENT '1=active, 0=deactivate'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_types`
--

INSERT INTO `user_types` (`user_type_id`, `user_type_name`, `entry_user_id`, `entry_datetime`, `modified_user_id`, `modified_datetime`, `user_type_status`) VALUES
(1, 'Admin', 0, '', 0, '', 1),
(2, 'Host', 0, '', 0, '', 1),
(3, 'Receptionist', 0, '', 0, '', 1),
(4, 'Visitor', 0, '', 0, '', 1);

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
  `visitor_status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=pending, 1=approved, 2=Blocked'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `visitors`
--

INSERT INTO `visitors` (`visitor_id`, `user_id`, `visitor_type`, `first_name`, `last_name`, `slug`, `organization`, `designation`, `gender`, `dob`, `mobile_no`, `email`, `address`, `profile_photo`, `nid_no`, `passport_no`, `driving_license_no`, `entry_user_id`, `entry_datetime`, `modified_user_id`, `modified_datetime`, `visitor_status`) VALUES
(1, 3, 1, 'Rayhan', 'Zaman', 'rayhan-zaman', 'SEBPO', 'Software Developer', 1, '2021-09-22', '01955181028', 'rayhan.zaman5@sebpo.com', 'Dhaka', 'visitor1632294960.jpg', '1234567891234567', '1234567891234567', '1234567891234567', NULL, '2021-09-22 07:16:00', NULL, NULL, 1),
(3, 9, 2, 'Ashraful', 'Alam', 'ashraful-alam', 'SEBPO', 'Sr. Executive', 1, '1994-02-01', '01794356471', 'ashraful@sebpo.com', 'Holding No- 903, Village: Alowa Bhabani', 'visitor1632317589.jpg', '19949329508000043', NULL, NULL, NULL, '2021-09-22 13:33:09', NULL, NULL, 1),
(4, 10, 2, 'Romana', 'Tanzim', 'romana-tanzim', 'SEBPO', 'Officer', 2, NULL, '01914594422', 'didar.austcse@gmail.com', NULL, 'employee1632900339.jpg', NULL, NULL, NULL, NULL, '2021-09-22 13:35:17', NULL, NULL, 1),
(5, 13, 2, 'Rayhan', 'Zaman', 'rayhan-zaman', 'SEBPO', 'Software Developer', 1, '2021-09-27', '01521449123', 'rayhan.zaman1@sebpo.com', 'Dhaka', 'visitor1632732005.jpg', '1234567891234567', '1234567891234567', '1234567891234567', NULL, '2021-09-27 08:40:05', NULL, NULL, 1),
(6, 14, 2, 'FTest28', 'LTest28', 'ftest28-ltest28', 'SEBPO', 'Software Developer', 1, '2021-09-28', '01955181358', 'rayhan.zaman28@sebpo.com', 'Dhaka', 'visitor1632810003.jpg', '1234567891234567', '1234567891234567', '1234567891234567', NULL, '2021-09-28 06:20:03', NULL, NULL, 1),
(9, 16, 2, 'Visitor Tauhid', 'Hasan', 'visitor tauhid-hasan', 'Abdul Monem Ltd.', 'Software Engineer', 1, '1996-01-07', '01537152126', 'm.tah69@gmail.com', 'Abbas garden road', 'employee1632900339.jpg', '1234567891234567', '0123456789012345', '0123456789012345', NULL, NULL, 16, '2021-10-07 06:28:54', 1),
(10, 19, 1, 'reception', 'visitor one', 'reception-visitor one', 'Abdul Monem Ltd.', 'Software Engineer', 1, '1990-10-04', '01123456789', 'recepvisitor1@sebpo.com', NULL, 'visitor1633253428.jpg', NULL, NULL, NULL, NULL, '2021-10-03 09:30:28', NULL, NULL, 1),
(11, 20, 2, 'reception', 'Visitor two', 'reception-visitor two', 'Abdul Monem Ltd.2', 'Software Engineer2', 1, '0180-10-03', '01122345678', 'recepvisitor2@sebpo.com', 'reception visitor 2 address', 'visitor1633255345.jpg', NULL, NULL, NULL, NULL, '2021-10-03 10:02:25', NULL, NULL, 2),
(13, 22, 1, 'Visitor from', 'reception', 'visitor from-reception', 'Abdul Monem Ltd.', 'Software Engineer', 1, '1990-10-06', '01122234566', 'visitorfromreception@gmail.com', 'Karwanbazar', 'visitor1634021221.jpg', '12345678912345', '0123456789012345', '0123456789012345', 18, '2021-10-05 08:39:21', 1, '2021-10-12 12:47:01', 0),
(14, 23, 1, 'visitor form', 'admin panel', 'visitor form-admin panel', 'Abdul Monem Ltd.', 'Software Engineer', 1, '1990-10-01', '01112223334', 'visitorfromadmin@mail.com', 'Karwanbazar', 'visitor1634447719.jpg', '01234567890123456', '01234567890123456', '01234567890123456', 1, '2021-10-17 11:15:19', NULL, NULL, 1),
(16, 25, 4, 'visitor two', 'from reception', 'visitor two-from reception', 'Abdul Monem Ltd.', 'Software Engineer', 1, NULL, '00011122223', 'wow@mail.com', NULL, 'visitor1634817099.jpg', NULL, NULL, NULL, 18, '2021-10-21 17:51:39', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `visitor_logs`
--

CREATE TABLE `visitor_logs` (
  `log_id` int(11) NOT NULL,
  `visitor_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `visitor_type` int(11) DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `organization` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` int(11) DEFAULT NULL,
  `dob` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_no` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nid_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passport_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `driving_license_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `entry_user_id` int(11) DEFAULT NULL,
  `entry_datetime` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `log_type` int(11) DEFAULT NULL COMMENT '0=pending, 1=add, 2=update, 3=delete',
  `status` int(11) DEFAULT NULL COMMENT '0=removed, 1=display'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `visitor_logs`
--

INSERT INTO `visitor_logs` (`log_id`, `visitor_id`, `user_id`, `visitor_type`, `first_name`, `last_name`, `organization`, `designation`, `gender`, `dob`, `mobile_no`, `email`, `address`, `profile_photo`, `nid_no`, `passport_no`, `driving_license_no`, `entry_user_id`, `entry_datetime`, `description`, `log_type`, `status`) VALUES
(1, 13, 22, 1, 'Visitor from', 'reception', 'Abdul Monem Ltd.', 'Software Engineer', 1, '1990-10-06', '01122234567', 'visitorfromreception@gmail.com', 'Karwanbazar', 'visitor1633423161.jpg', '12345678912345', '0123456789012345', '0123456789012345', 18, '2021-10-05 08:39:25', 'Visitor account created form reception panel', 1, 1),
(5, 9, 16, 2, 'Visitor Tauhid', 'Hasan', 'Abdul Monem Ltd.', 'Software Engineer', 1, '1996-01-07', '01537152126', 'm.tah69@gmail.com', 'Abbas garden road', 'employee1632900339.jpg', '1234567891234567', '0123456789012345', '0123456789012345', 16, '2021-10-07 06:28:31', 'Visitor previous profile data', 2, 1),
(6, 9, 16, 2, 'Visitor Tauhid updt', 'Hasan updt', 'Abdul Monem Ltd.', 'Software Engineer', 1, '1996-01-07', '01537152126', 'm.tah69@gmail.com', 'Abbas garden road', 'employee1632900339.jpg', '1234567891234567', '0123456789012345', '0123456789012345', 16, '2021-10-07 06:28:54', 'Visitor previous profile data', 2, 1),
(7, 13, 22, 1, 'Visitor from', 'reception', 'Abdul Monem Ltd.', 'Software Engineer', 1, '1990-10-06', '01122234567', 'visitorfromreception@gmail.com', 'Karwanbazar', 'visitor1633423161.jpg', '12345678912345', '0123456789012345', '0123456789012345', 1, '2021-10-12 12:44:43', 'Visitor previous profile data', 2, 1),
(8, 13, 22, 1, 'Visitor from', 'reception', 'Abdul Monem Ltd.', 'Software Engineer', 1, '1990-10-06', '01122234566', 'visitorfromreception1@gmail.com', 'Karwanbazar', 'visitor1633423161.jpg', '12345678912345', '0123456789012345', '0123456789012345', 1, '2021-10-12 12:47:01', 'Visitor previous profile data', 2, 1),
(9, 14, 23, 1, 'visitor form', 'admin panel', 'Abdul Monem Ltd.', 'Software Engineer', 1, '1990-10-01', '01112223334', 'visitorfromadmin@mail.com', 'Karwanbazar', 'visitor1634447719.jpg', '01234567890123456', '01234567890123456', '01234567890123456', 1, '2021-10-17 11:15:24', 'Visitor account created form admin panel', 1, 1),
(11, 16, 25, 4, 'visitor two', 'from reception', 'Abdul Monem Ltd.', 'Software Engineer', 1, NULL, '00011122223', 'wow@mail.com', NULL, 'visitor1634817099.jpg', NULL, NULL, NULL, 18, '2021-10-21 17:51:42', 'Visitor account created form reception panel', 1, 1);

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
  `card_no` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `visitor_photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `entry_user_id` int(11) DEFAULT NULL,
  `modified_user_id` int(11) DEFAULT NULL,
  `visitor_pass_status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=active, 0=expired'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `visitor_pass`
--

INSERT INTO `visitor_pass` (`visitor_pass_id`, `visitor_id`, `meeting_id`, `checkin_time`, `checkout_time`, `card_no`, `visitor_photo`, `entry_user_id`, `modified_user_id`, `visitor_pass_status`) VALUES
(1, 3, 3, '2021-10-11 09:59:03', '2021-10-11 12:36:32', '0001', '1633946343.png', 18, 18, 0),
(2, 9, 17, '2021-10-11 10:01:06', '2021-10-11 12:36:12', '002', '1633946466.png', 18, 18, 0),
(8, 9, 12, '2021-10-11 10:28:58', '2021-10-14 13:55:26', 'aass', '1633948138.png', 18, 18, 0),
(10, 9, 18, '2021-10-12 10:38:07', '2021-10-12 10:38:26', '005', '1634013487.png', 18, 18, 0),
(11, 9, 19, '2021-10-17 17:20:24', NULL, 'A001', 'visitor1634469624.png', 18, NULL, 1);

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
(1, 'Media Personnel', 1),
(2, 'Official Employee', 1),
(4, 'Meeting Attendee', 1),
(5, 'Candidate', 1),
(6, 'Deliveryman', 1),
(7, 'Vendor', 1),
(8, 'Contractor', 1),
(9, 'Auditor', 1),
(10, 'Enquiry Personnel', 1),
(11, 'Postman', 1),
(12, 'Others', 1);

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
-- Indexes for table `forgot_passwords`
--
ALTER TABLE `forgot_passwords`
  ADD PRIMARY KEY (`forgot_password_id`);

--
-- Indexes for table `host_logs`
--
ALTER TABLE `host_logs`
  ADD PRIMARY KEY (`log_id`);

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
-- Indexes for table `login_lockdowns`
--
ALTER TABLE `login_lockdowns`
  ADD PRIMARY KEY (`login_lockdown_id`);

--
-- Indexes for table `meetings`
--
ALTER TABLE `meetings`
  ADD PRIMARY KEY (`meeting_id`);

--
-- Indexes for table `meeting_logs`
--
ALTER TABLE `meeting_logs`
  ADD PRIMARY KEY (`log_id`);

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
-- Indexes for table `visitor_logs`
--
ALTER TABLE `visitor_logs`
  ADD PRIMARY KEY (`log_id`);

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
  MODIFY `dept_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `designations`
--
ALTER TABLE `designations`
  MODIFY `designation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `failed_logins`
--
ALTER TABLE `failed_logins`
  MODIFY `failed_login_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `forgot_passwords`
--
ALTER TABLE `forgot_passwords`
  MODIFY `forgot_password_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `host_logs`
--
ALTER TABLE `host_logs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
-- AUTO_INCREMENT for table `login_lockdowns`
--
ALTER TABLE `login_lockdowns`
  MODIFY `login_lockdown_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `meetings`
--
ALTER TABLE `meetings`
  MODIFY `meeting_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `meeting_logs`
--
ALTER TABLE `meeting_logs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `meeting_purposes`
--
ALTER TABLE `meeting_purposes`
  MODIFY `purpose_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `permission_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `reception_logs`
--
ALTER TABLE `reception_logs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

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
  MODIFY `visitor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `visitor_logs`
--
ALTER TABLE `visitor_logs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `visitor_pass`
--
ALTER TABLE `visitor_pass`
  MODIFY `visitor_pass_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `visitor_types`
--
ALTER TABLE `visitor_types`
  MODIFY `visitor_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
