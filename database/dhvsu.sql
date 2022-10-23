-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 19, 2022 at 02:19 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dhvsu`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `userId` int(145) NOT NULL,
  `employeeId` varchar(145) DEFAULT NULL,
  `adminPosition` varchar(145) DEFAULT NULL,
  `adminFirst_Name` varchar(145) DEFAULT NULL,
  `adminMiddle_Name` varchar(145) DEFAULT NULL,
  `adminLast_Name` varchar(145) DEFAULT NULL,
  `adminEmail` varchar(145) DEFAULT NULL,
  `adminPassword` varchar(145) DEFAULT NULL,
  `adminStatus` enum('Y','N') DEFAULT 'N',
  `tokencode` varchar(145) DEFAULT NULL,
  `adminProfile` varchar(1145) NOT NULL DEFAULT 'profile-red.png',
  `uniqueId` varchar(145) DEFAULT NULL,
  `adminLocation` varchar(145) DEFAULT NULL,
  `account_status` enum('active','disabled') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`userId`, `employeeId`, `adminPosition`, `adminFirst_Name`, `adminMiddle_Name`, `adminLast_Name`, `adminEmail`, `adminPassword`, `adminStatus`, `tokencode`, `adminProfile`, `uniqueId`, `adminLocation`, `account_status`, `created_at`, `updated_at`) VALUES
(1, '201800616', 'INSTRUCTOR I', 'ARVIN', 'SANTOS', 'DABU', 'qsmartattendance@gmail.com', '42f749ade7f9e195bf475f37a44cafcb', 'Y', '8127291922e8f2ddfa6b027aa82b2873', 'profile-red.png', '98965b1d82b8023fd6bd4ba823353307', '3', 'active', '2022-07-26 01:49:52', '2022-10-18 00:58:11');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `email_config`
--

INSERT INTO `email_config` (`Id`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'qsmartattendance@gmail.com', 'jpnbnhlemrbrevfh', '2022-07-08 04:41:51', '2022-10-18 00:05:01');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `google_recaptcha_api`
--

INSERT INTO `google_recaptcha_api` (`Id`, `site_key`, `site_secret_key`, `created_at`, `updated_at`) VALUES
(1, '6LdiQZQhAAAAABpaNFtJpgzGpmQv2FwhaqNj2azh', '6LdiQZQhAAAAAByS6pnNjOs9xdYXMrrW2OeTFlrm', '2022-07-08 04:29:37', '2022-10-18 00:05:45');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `Id` int(145) NOT NULL,
  `location_name` varchar(145) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`Id`, `location_name`, `created_at`, `updated_at`) VALUES
(1, 'COMFORT ROOM', '2022-07-17 12:51:02', '2022-08-29 00:31:22'),
(2, 'ROOM 101', '2022-07-17 12:52:34', '2022-08-27 07:55:34'),
(3, 'ROOM 102', '2022-07-17 12:52:46', '2022-08-27 07:55:27'),
(4, 'ROOM 207', '2022-08-27 07:51:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `userId` int(145) NOT NULL,
  `studentId` varchar(145) DEFAULT NULL,
  `first_name` varchar(145) DEFAULT NULL,
  `middle_name` varchar(145) DEFAULT NULL,
  `last_name` varchar(145) DEFAULT NULL,
  `sex` varchar(145) DEFAULT NULL,
  `birth_date` varchar(145) DEFAULT NULL,
  `age` varchar(145) DEFAULT NULL,
  `place_of_birth` varchar(145) DEFAULT NULL,
  `civil_status` varchar(145) DEFAULT NULL,
  `nationality` varchar(145) DEFAULT NULL,
  `religion` varchar(145) DEFAULT NULL,
  `phone_number` varchar(145) DEFAULT NULL,
  `email` varchar(145) DEFAULT NULL,
  `password` varchar(145) DEFAULT NULL,
  `province` varchar(145) DEFAULT NULL,
  `city` varchar(145) DEFAULT NULL,
  `barangay` varchar(147) DEFAULT NULL,
  `emergency_contact_person` varchar(145) DEFAULT NULL,
  `emergency_address` varchar(145) DEFAULT NULL,
  `emergency_mobile_number` varchar(145) DEFAULT NULL,
  `qrcode` varchar(999) DEFAULT NULL,
  `status` enum('Y','N') NOT NULL DEFAULT 'N',
  `tokencode` varchar(145) DEFAULT NULL,
  `profile` varchar(145) DEFAULT 'profile-red.png',
  `account_status` enum('active','disabled') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `student_activity`
--

CREATE TABLE `student_activity` (
  `userId` int(145) NOT NULL,
  `employee_name` varchar(145) DEFAULT NULL,
  `employee_ID` varchar(145) DEFAULT NULL,
  `studentId` varchar(145) DEFAULT NULL,
  `first_name` varchar(145) DEFAULT NULL,
  `middle_name` varchar(145) DEFAULT NULL,
  `last_name` varchar(145) DEFAULT NULL,
  `sex` varchar(145) DEFAULT NULL,
  `birth_date` varchar(145) DEFAULT NULL,
  `age` varchar(145) DEFAULT NULL,
  `place_of_birth` varchar(145) DEFAULT NULL,
  `civil_status` varchar(145) DEFAULT NULL,
  `nationality` varchar(145) DEFAULT NULL,
  `religion` varchar(145) DEFAULT NULL,
  `phone_number` varchar(145) DEFAULT NULL,
  `email` varchar(145) DEFAULT NULL,
  `province` varchar(145) DEFAULT NULL,
  `city` varchar(145) DEFAULT NULL,
  `barangay` varchar(147) DEFAULT NULL,
  `emergency_contact_person` varchar(145) DEFAULT NULL,
  `emergency_address` varchar(145) DEFAULT NULL,
  `emergency_mobile_number` varchar(145) DEFAULT NULL,
  `qrcode` varchar(999) DEFAULT NULL,
  `activity` varchar(145) DEFAULT NULL,
  `date` varchar(145) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_activity`
--

INSERT INTO `student_activity` (`userId`, `employee_name`, `employee_ID`, `studentId`, `first_name`, `middle_name`, `last_name`, `sex`, `birth_date`, `age`, `place_of_birth`, `civil_status`, `nationality`, `religion`, `phone_number`, `email`, `province`, `city`, `barangay`, `emergency_contact_person`, `emergency_address`, `emergency_mobile_number`, `qrcode`, `activity`, `date`, `created_at`, `updated_at`) VALUES
(1, 'DABU, ARVIN', '98965b1d82b8023fd6bd4ba823353307', '2019989741', 'Tracy Anne', 'Lagman', 'Dizon', 'Female', '2001-03-09', '21', 'Guagua Pampanga', 'Single', 'Philippines', 'Roman Catholic', '9076455712', 'dizontracyanne@gmail.com', 'Pampanga', 'Lubao', 'Concepcion', 'cecil dizon', 'concepcion lubao pampanga', '0946911099', 'e859d1a7943b63c0c3fedcab272104a4', '3', '2022-10-18', '2022-10-18 01:27:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `student_activity_98965b1d82b8023fd6bd4ba823353307`
--

CREATE TABLE `student_activity_98965b1d82b8023fd6bd4ba823353307` (
  `userId` int(145) NOT NULL,
  `employee_name` varchar(145) DEFAULT NULL,
  `employee_ID` varchar(145) DEFAULT NULL,
  `studentId` varchar(145) DEFAULT NULL,
  `first_name` varchar(145) DEFAULT NULL,
  `middle_name` varchar(145) DEFAULT NULL,
  `last_name` varchar(145) DEFAULT NULL,
  `sex` varchar(145) DEFAULT NULL,
  `birth_date` varchar(145) DEFAULT NULL,
  `age` varchar(145) DEFAULT NULL,
  `place_of_birth` varchar(145) DEFAULT NULL,
  `civil_status` varchar(145) DEFAULT NULL,
  `nationality` varchar(145) DEFAULT NULL,
  `religion` varchar(145) DEFAULT NULL,
  `phone_number` varchar(145) DEFAULT NULL,
  `email` varchar(145) DEFAULT NULL,
  `province` varchar(145) DEFAULT NULL,
  `city` varchar(145) DEFAULT NULL,
  `barangay` varchar(147) DEFAULT NULL,
  `emergency_contact_person` varchar(145) DEFAULT NULL,
  `emergency_address` varchar(145) DEFAULT NULL,
  `emergency_mobile_number` varchar(145) DEFAULT NULL,
  `qrcode` varchar(999) DEFAULT NULL,
  `activity` varchar(145) DEFAULT NULL,
  `date` varchar(145) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_activity_98965b1d82b8023fd6bd4ba823353307`
--

INSERT INTO `student_activity_98965b1d82b8023fd6bd4ba823353307` (`userId`, `employee_name`, `employee_ID`, `studentId`, `first_name`, `middle_name`, `last_name`, `sex`, `birth_date`, `age`, `place_of_birth`, `civil_status`, `nationality`, `religion`, `phone_number`, `email`, `province`, `city`, `barangay`, `emergency_contact_person`, `emergency_address`, `emergency_mobile_number`, `qrcode`, `activity`, `date`, `created_at`, `updated_at`) VALUES
(1, 'DABU, ARVIN', '98965b1d82b8023fd6bd4ba823353307', '2019989741', 'Tracy Anne', 'Lagman', 'Dizon', 'Female', '2001-03-09', '21', 'Guagua Pampanga', 'Single', 'Philippines', 'Roman Catholic', '9076455712', 'dizontracyanne@gmail.com', 'Pampanga', 'Lubao', 'Concepcion', 'cecil dizon', 'concepcion lubao pampanga', '0946911099', 'e859d1a7943b63c0c3fedcab272104a4', '3', '2022-10-18', '2022-10-18 01:27:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `superadmin`
--

CREATE TABLE `superadmin` (
  `superadminId` int(145) NOT NULL,
  `name` varchar(145) DEFAULT NULL,
  `email` varchar(145) DEFAULT NULL,
  `password` varchar(145) DEFAULT NULL,
  `tokencode` varchar(145) DEFAULT NULL,
  `profile` varchar(1145) NOT NULL DEFAULT 'profile-red.png',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `superadmin`
--

INSERT INTO `superadmin` (`superadminId`, `name`, `email`, `password`, `tokencode`, `profile`, `created_at`, `updated_at`) VALUES
(1, 'JUAN, SANTOS', 'qsmartattendance@gmail.com', '42f749ade7f9e195bf475f37a44cafcb', 'cf3d41ef87dbd96fe6b963af1eb9c0f6', 'DHVSU_logo.png', '2022-07-03 00:09:13', '2022-10-19 00:04:09');

-- --------------------------------------------------------

--
-- Table structure for table `system_config`
--

CREATE TABLE `system_config` (
  `Id` int(14) NOT NULL,
  `system_name` varchar(145) DEFAULT NULL,
  `system_number` varchar(145) DEFAULT NULL,
  `system_email` varchar(145) DEFAULT NULL,
  `copy_right` varchar(145) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `system_config`
--

INSERT INTO `system_config` (`Id`, `system_name`, `system_number`, `system_email`, `copy_right`, `created_at`, `updated_at`) VALUES
(1, 'DHVSU SMART ATTENDANCE SYSTEM', '9776621929', 'qsmartattendance@gmail.com', 'Copyright 2022 DHVSU SMART ATTENDANCE SYSTEM. All right reserved', '2022-07-08 12:38:28', '2022-10-18 00:06:41');

-- --------------------------------------------------------

--
-- Table structure for table `system_logo`
--

CREATE TABLE `system_logo` (
  `Id` int(145) NOT NULL,
  `logo` varchar(1145) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `system_logo`
--

INSERT INTO `system_logo` (`Id`, `logo`, `created_at`, `updated_at`) VALUES
(1, 'DHVSU_logo.png', '2022-07-08 08:11:27', '2022-07-15 00:20:59');

-- --------------------------------------------------------

--
-- Table structure for table `tb_logs`
--

CREATE TABLE `tb_logs` (
  `activityId` int(100) NOT NULL,
  `user` varchar(100) NOT NULL,
  `email` varchar(145) NOT NULL,
  `activity` varchar(145) NOT NULL,
  `date` varchar(145) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_logs`
--

INSERT INTO `tb_logs` (`activityId`, `user`, `email`, `activity`, `date`) VALUES
(1, 'Customer Andrei', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2021-11-20 01:08:43 PM'),
(2, 'Customer Andrei', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2021-11-20 01:08:59 PM'),
(3, 'Customer Andrei', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2021-11-20 01:09:12 PM'),
(4, 'Customer Andrei', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2021-11-20 01:09:24 PM'),
(5, 'Customer Andrei', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2021-11-20 01:11:05 PM'),
(6, 'Customer Andrei', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2021-11-20 01:17:15 PM'),
(7, 'Customer Shania', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2021-11-20 01:17:40 PM'),
(8, 'Customer Andrei', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2021-11-20 01:30:24 PM'),
(9, 'Customer Andrei', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2021-11-20 01:33:01 PM'),
(10, 'Customer Andrei', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2021-11-20 01:33:21 PM'),
(11, 'Customer Shania', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2021-11-20 01:34:05 PM'),
(12, 'Customer Andrei', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2021-11-20 01:35:39 PM'),
(13, 'Customer Andrei', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2021-11-20 01:36:08 PM'),
(14, 'Customer Andrei', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2021-11-20 01:36:39 PM'),
(15, 'Customer Shania', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2021-11-20 01:37:16 PM'),
(16, 'Admin andrei', 'andrei@gmail.com', 'Has successfully signed in', '2021-11-20 08:19:03 PM'),
(17, 'Customer Andrei', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2021-11-20 08:19:55 PM'),
(18, 'Admin andrei', 'andrei@gmail.com', 'Has successfully signed in', '2021-11-20 08:20:19 PM'),
(19, 'Admin andrei', 'andrei@gmail.com', 'Has successfully signed in', '2021-11-21 07:16:21 AM'),
(20, 'Admin Jollibee', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2021-11-21 11:15:25 AM'),
(21, 'Admin andrei', 'andrei@gmail.com', 'Has successfully signed in', '2021-11-21 12:22:57 PM'),
(22, 'Admin Mcdo', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2021-11-21 02:32:39 PM'),
(23, 'Admin andrei', 'andrei@gmail.com', 'Has successfully signed in', '2021-11-21 08:23:49 PM'),
(24, 'Admin Mcdo', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2021-11-21 08:26:17 PM'),
(25, 'Customer Andrei', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2021-11-24 11:02:44 PM'),
(26, 'Customer Andrei', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2021-11-25 09:34:11 AM'),
(27, 'Customer Andrei', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2021-11-25 09:56:43 AM'),
(28, 'Admin Mcdo', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2021-11-28 09:26:43 AM'),
(29, 'Admin Jollibee', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2021-12-01 09:26:07 AM'),
(30, 'Admin Jollibee', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2021-12-05 07:37:34 AM'),
(31, 'Admin Jollibee', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2021-12-05 08:06:58 AM'),
(32, 'Admin Jollibee', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2021-12-08 08:17:55 AM'),
(33, 'Customer Shania', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2021-12-08 09:57:24 PM'),
(34, 'Admin Jollibee', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2021-12-09 02:33:18 PM'),
(35, 'Admin Jollibee', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2021-12-10 04:48:44 PM'),
(36, 'Customer Shania', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2021-12-13 09:06:17 AM'),
(37, 'Customer Shania', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2021-12-13 01:40:46 PM'),
(38, 'Admin Jollibee', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2021-12-22 03:19:25 PM'),
(39, 'Customer Shania', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2021-12-24 09:33:37 AM'),
(40, 'Customer Shania', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2021-12-24 12:50:46 PM'),
(41, 'Admin Jollibee', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2021-12-24 08:32:36 PM'),
(42, 'Admin Jollibee', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2021-12-28 04:16:33 PM'),
(43, 'Admin Jollibee', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2021-12-28 04:50:24 PM'),
(44, 'Customer Shania', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2021-12-28 08:33:37 PM'),
(45, 'Admin Jollibee', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2021-12-29 09:45:52 AM'),
(46, 'Admin Jollibee Dinalupihan', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-01-03 08:21:50 AM'),
(47, 'Admin Jollibee Dinalupihan', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-01-03 09:38:23 AM'),
(48, 'Customer Shania', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-01-03 09:39:26 AM'),
(49, 'Admin Jollibee Dinalupihan', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-01-03 09:58:49 AM'),
(50, 'Admin Jollibee Dinalupihan', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-01-03 09:59:21 AM'),
(51, 'Admin Jollibee Dinalupihan', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-01-03 09:59:30 AM'),
(52, 'Customer Shania', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-01-03 09:59:59 AM'),
(53, 'Customer Shania', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-01-03 10:40:26 AM'),
(54, 'Admin Jollibee Hermosa', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2022-01-03 10:42:14 AM'),
(55, 'Customer Shania', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-01-03 10:43:10 AM'),
(56, 'Customer Shania', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-01-03 05:47:43 PM'),
(57, 'Customer Shania', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-01-04 10:12:06 AM'),
(58, 'Customer Shania', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-01-04 10:53:54 AM'),
(59, 'Customer Shania', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-01-04 12:50:00 PM'),
(60, 'Admin Jollibee Dinalupihan', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-01-05 11:35:33 AM'),
(61, 'Admin Jollibee Dinalupihan', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-01-05 12:55:56 PM'),
(62, 'Admin BDO Lubao, Pampanga', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2022-01-06 05:15:44 PM'),
(63, 'Admin BDO Lubao, Pampanga', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2022-01-07 09:04:43 AM'),
(64, 'Admin BDO Lubao Pampanga', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2022-01-07 09:08:40 AM'),
(65, 'Admin BDO Lubao Pampanga', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2022-01-07 09:09:24 AM'),
(66, 'Admin BDO Lubao Pampanga', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2022-01-07 09:12:39 AM'),
(67, 'Admin BDO Lubao Pampanga', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2022-01-07 09:14:13 AM'),
(68, 'Customer Shania', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-01-07 01:44:10 PM'),
(69, 'Admin Cebuana Lhuillier Pawnshop Lubao', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-01-07 03:19:50 PM'),
(70, 'Customer Shania', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-01-07 03:20:39 PM'),
(71, 'Customer andrei@gmail.com', 'andrei@gmail.com', 'Has successfully signed in', '2022-06-30 09:03:00 PM'),
(72, 'Customer andrei@gmail.com', 'andrei@gmail.com', 'Has successfully signed in', '2022-06-30 09:04:36 PM'),
(73, 'Customer andrei@gmail.com', 'andrei@gmail.com', 'Has successfully signed in', '2022-06-30 09:09:04 PM'),
(74, 'Customer andrei@gmail.com', 'andrei@gmail.com', 'Has successfully signed in', '2022-06-30 09:11:25 PM'),
(75, 'Customer andrei@gmail.com', 'andrei@gmail.com', 'Has successfully signed in', '2022-06-30 09:12:02 PM'),
(76, 'Customer andrei@gmail.com', 'andrei@gmail.com', 'Has successfully signed in', '2022-06-30 09:25:20 PM'),
(77, 'Customer andrei@gmail.com', 'andrei@gmail.com', 'Has successfully signed in', '2022-07-01 08:19:01 AM'),
(78, 'Customer andrei@gmail.com', 'andrei@gmail.com', 'Has successfully signed in', '2022-07-01 09:00:51 AM'),
(79, 'Customer andrei@gmail.com', 'andrei@gmail.com', 'Has successfully signed in', '2022-07-01 09:02:56 AM'),
(80, 'Customer andrei@gmail.com', 'andrei@gmail.com', 'Has successfully signed in', '2022-07-01 09:05:08 AM'),
(81, 'Customer andrei@gmail.com', 'andrei@gmail.com', 'Has successfully signed in', '2022-07-01 09:16:14 AM'),
(82, 'Customer andrei@gmail.com', 'andrei@gmail.com', 'Has successfully signed in', '2022-07-01 09:23:13 AM'),
(83, 'Customer andrei@gmail.com', 'andrei@gmail.com', 'Has successfully signed in', '2022-07-01 09:44:05 AM'),
(84, 'Customer andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-01 10:53:12 AM'),
(85, 'Customer andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-01 10:53:37 AM'),
(86, 'Customer andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-01 03:15:00 PM'),
(87, 'Customer andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-02 07:14:23 AM'),
(88, 'Customer andreishania07012000@gmail.com', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2022-07-02 07:54:30 AM'),
(89, 'Customer andreishania07012000@gmail.com', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2022-07-02 08:19:01 AM'),
(90, 'Customer andreishania07012000@gmail.com', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2022-07-02 08:25:52 AM'),
(91, 'Customer andreishania07012000@gmail.com', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2022-07-02 09:43:49 AM'),
(92, 'Customer andreishania07012000@gmail.com', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2022-07-02 09:55:58 PM'),
(93, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-03 08:17:19 AM'),
(94, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-03 08:21:05 AM'),
(95, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-03 08:22:03 AM'),
(96, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-03 08:22:37 AM'),
(97, 'Customer andreishania07012000@gmail.com', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2022-07-03 08:24:52 AM'),
(98, 'Customer andreishania07012000@gmail.com', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2022-07-03 08:25:26 AM'),
(99, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-03 08:25:48 AM'),
(100, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-03 08:26:09 AM'),
(101, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-03 08:26:24 AM'),
(102, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-03 08:27:41 AM'),
(103, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-03 08:31:00 AM'),
(104, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-03 08:31:11 AM'),
(105, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-03 08:32:01 AM'),
(106, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-03 08:34:00 AM'),
(107, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-03 08:45:58 AM'),
(108, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-03 09:16:38 AM'),
(109, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-03 09:14:33 PM'),
(110, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-04 06:57:22 AM'),
(111, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-04 01:25:00 PM'),
(112, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-04 07:22:34 PM'),
(113, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-04 07:27:44 PM'),
(114, 'Customer andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-04 11:43:38 PM'),
(115, 'Customer andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-04 11:44:48 PM'),
(116, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-05 09:43:19 AM'),
(117, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-05 09:50:00 AM'),
(118, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-05 10:28:15 AM'),
(119, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-05 11:38:02 AM'),
(120, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-05 11:46:38 AM'),
(121, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-05 01:04:39 PM'),
(122, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-05 04:59:30 PM'),
(123, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-05 07:35:18 PM'),
(124, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-06 06:55:27 AM'),
(125, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-06 08:12:32 AM'),
(126, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-07 11:47:49 AM'),
(127, 'Customer andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-07 02:26:52 PM'),
(128, 'Customer andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-07 02:27:18 PM'),
(129, 'Customer andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-07 02:29:26 PM'),
(130, 'Customer andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-07 02:30:50 PM'),
(131, 'Customer andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-07 02:32:06 PM'),
(132, 'Customer andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-07 02:33:53 PM'),
(133, 'Customer andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-07 02:34:33 PM'),
(134, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-07 02:34:50 PM'),
(135, 'Customer andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-07 02:35:40 PM'),
(136, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-07 02:35:55 PM'),
(137, 'Customer andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-07 02:37:43 PM'),
(138, 'Customer andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-07 02:38:00 PM'),
(139, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-07 02:40:03 PM'),
(140, 'Customer andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-07 02:41:26 PM'),
(141, 'Customer andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-07 02:41:52 PM'),
(142, 'Customer andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-07 02:42:45 PM'),
(143, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-07 02:43:14 PM'),
(144, 'Customer andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-07 02:43:41 PM'),
(145, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-07 02:44:04 PM'),
(146, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-07 02:47:16 PM'),
(147, 'Customer andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-07 02:47:37 PM'),
(148, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-07 02:48:33 PM'),
(149, 'Customer andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-07 02:48:42 PM'),
(150, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-07 04:25:41 PM'),
(151, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-07 04:35:32 PM'),
(152, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-07 04:36:20 PM'),
(153, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-07 07:57:00 PM'),
(154, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-08 10:10:04 AM'),
(155, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-08 11:34:42 AM'),
(156, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-08 07:38:41 PM'),
(157, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-09 07:46:27 AM'),
(158, 'Customer andreishania07012000@gmail.com', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2022-07-09 08:45:13 PM'),
(159, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-10 07:11:34 AM'),
(160, 'Customer andreishania07012000@gmail.com', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2022-07-10 07:11:52 AM'),
(161, 'Customer andreishania07012000@gmail.com', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2022-07-10 09:17:21 AM'),
(162, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-10 10:44:13 AM'),
(163, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-11 07:42:58 AM'),
(164, 'Customer andreishania07012000@gmail.com', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2022-07-11 07:43:10 AM'),
(165, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-11 10:57:13 AM'),
(166, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-12 07:51:51 AM'),
(167, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-12 09:06:48 PM'),
(168, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-12 09:08:14 PM'),
(169, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-15 08:26:35 AM'),
(170, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-15 09:20:58 AM'),
(171, 'Customer andreishania07012000@gmail.com', 'andreishania07012000@gmail.com', 'Has successfully signed in', '2022-07-15 11:56:59 AM'),
(172, 'Customer andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-15 04:19:15 PM'),
(173, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-15 09:14:03 PM'),
(174, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-16 07:23:06 AM'),
(175, 'Customer andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-16 07:32:17 AM'),
(176, 'Customer andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-16 07:58:16 AM'),
(177, 'Customer andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-16 08:25:26 PM'),
(178, 'Customer andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-17 10:19:38 AM'),
(179, 'Customer andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-17 11:28:42 AM'),
(180, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-17 08:47:02 PM'),
(181, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-19 08:45:21 PM'),
(182, 'Customer andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-20 11:39:27 AM'),
(183, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-20 11:42:51 AM'),
(184, 'Customer andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-21 08:12:57 AM'),
(185, 'Customer andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-21 12:02:06 PM'),
(186, 'Customer andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-22 02:17:31 PM'),
(187, 'Customer andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-23 09:10:08 PM'),
(188, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-23 09:10:43 PM'),
(189, 'Customer andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-26 08:39:16 AM'),
(190, 'Customer andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-26 08:40:41 AM'),
(191, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-26 08:41:48 AM'),
(192, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-26 08:50:46 AM'),
(193, 'Customer andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-26 09:06:22 AM'),
(194, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-26 09:48:00 AM'),
(195, 'Customer andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-26 09:51:08 AM'),
(196, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-07-28 04:41:01 PM'),
(197, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-08-21 09:17:57 AM'),
(198, 'Customer andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-08-21 11:32:42 AM'),
(199, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-08-21 11:51:09 AM'),
(200, 'Customer andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-08-24 07:29:15 PM'),
(201, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-08-24 07:30:22 PM'),
(202, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-08-24 07:42:32 PM'),
(203, 'Customer andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-08-24 07:47:53 PM'),
(204, 'Customer andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-08-24 07:48:02 PM'),
(205, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-08-24 07:49:13 PM'),
(206, 'Customer andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-08-24 08:28:14 PM'),
(207, 'Customer andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-08-26 06:12:41 PM'),
(208, 'Customer andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-08-27 07:58:54 AM'),
(209, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-08-27 07:59:32 AM'),
(210, 'Customer andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-08-29 08:02:31 AM'),
(211, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-08-29 02:04:17 PM'),
(212, 'Customer andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-09-03 06:55:58 PM'),
(213, 'Customer andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-09-15 02:29:53 PM'),
(214, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-09-15 02:30:04 PM'),
(215, 'Customer andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-09-17 01:40:47 PM'),
(216, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-09-17 01:41:11 PM'),
(217, 'Student andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-09-17 07:46:26 PM'),
(218, 'Customer andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-09-19 09:19:48 PM'),
(219, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-09-19 09:19:58 PM'),
(220, 'Student andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-09-19 09:29:18 PM'),
(221, 'Superadmin andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-10-18 07:57:11 AM'),
(222, 'Customer andrei.m.viscayno@gmail.com', 'andrei.m.viscayno@gmail.com', 'Has successfully signed in', '2022-10-18 08:07:18 AM'),
(223, 'Student dizontracyanne@gmail.com', 'dizontracyanne@gmail.com', 'Has successfully signed in', '2022-10-18 09:24:19 AM'),
(224, 'Customer qsmartattendance@gmail.com', 'qsmartattendance@gmail.com', 'Has successfully signed in', '2022-10-18 09:25:39 AM'),
(225, 'Customer qsmartattendance@gmail.com', 'qsmartattendance@gmail.com', 'Has successfully signed in', '2022-10-19 08:02:05 AM'),
(226, 'Superadmin qsmartattendance@gmail.com', 'qsmartattendance@gmail.com', 'Has successfully signed in', '2022-10-19 08:04:28 AM');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `email_config`
--
ALTER TABLE `email_config`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `google_recaptcha_api`
--
ALTER TABLE `google_recaptcha_api`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `student_activity`
--
ALTER TABLE `student_activity`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `student_activity_98965b1d82b8023fd6bd4ba823353307`
--
ALTER TABLE `student_activity_98965b1d82b8023fd6bd4ba823353307`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `superadmin`
--
ALTER TABLE `superadmin`
  ADD PRIMARY KEY (`superadminId`);

--
-- Indexes for table `system_config`
--
ALTER TABLE `system_config`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `system_logo`
--
ALTER TABLE `system_logo`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tb_logs`
--
ALTER TABLE `tb_logs`
  ADD PRIMARY KEY (`activityId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `userId` int(145) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `email_config`
--
ALTER TABLE `email_config`
  MODIFY `Id` int(145) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `google_recaptcha_api`
--
ALTER TABLE `google_recaptcha_api`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `Id` int(145) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `userId` int(145) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `student_activity`
--
ALTER TABLE `student_activity`
  MODIFY `userId` int(145) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student_activity_98965b1d82b8023fd6bd4ba823353307`
--
ALTER TABLE `student_activity_98965b1d82b8023fd6bd4ba823353307`
  MODIFY `userId` int(145) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `superadmin`
--
ALTER TABLE `superadmin`
  MODIFY `superadminId` int(145) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `system_config`
--
ALTER TABLE `system_config`
  MODIFY `Id` int(14) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `system_logo`
--
ALTER TABLE `system_logo`
  MODIFY `Id` int(145) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tb_logs`
--
ALTER TABLE `tb_logs`
  MODIFY `activityId` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=227;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
