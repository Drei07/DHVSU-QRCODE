-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 26, 2022 at 03:37 AM
-- Server version: 10.4.24-MariaDB
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
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_activity_98965b1d82b8023fd6bd4ba823353307`
--

INSERT INTO `student_activity_98965b1d82b8023fd6bd4ba823353307` (`userId`, `employee_name`, `employee_ID`, `studentId`, `first_name`, `middle_name`, `last_name`, `sex`, `birth_date`, `age`, `place_of_birth`, `civil_status`, `nationality`, `religion`, `phone_number`, `email`, `province`, `city`, `barangay`, `emergency_contact_person`, `emergency_address`, `emergency_mobile_number`, `qrcode`, `activity`, `created_at`, `updated_at`) VALUES
(7, 'Viscayno, Andrei', '724758478978497', '2018006164', 'Andrei', 'Manalansan', 'Viscayno', 'Male', '2000-01-07', '22', 'Lubao, Pampanga', 'Single', 'Philippines', 'Roman Catholic', '9776621929', 'andreishania07012000@gmail.com', 'Bataan', 'Hermosa', 'Saba', 'Nolita Viscayno', 'Saba, Hermosa, Bataan', '9776621929', '672b0479d1ae67bbcf9b2ac09c9c2ae6', 'Entered in Comfort Room', '2022-07-23 14:23:04', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `student_activity_98965b1d82b8023fd6bd4ba823353307`
--
ALTER TABLE `student_activity_98965b1d82b8023fd6bd4ba823353307`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `student_activity_98965b1d82b8023fd6bd4ba823353307`
--
ALTER TABLE `student_activity_98965b1d82b8023fd6bd4ba823353307`
  MODIFY `userId` int(145) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
