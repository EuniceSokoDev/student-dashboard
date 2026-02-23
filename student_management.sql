-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 23, 2026 at 08:23 AM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `student_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `deleted_students`
--

DROP TABLE IF EXISTS `deleted_students`;
CREATE TABLE IF NOT EXISTS `deleted_students` (
  `id` int NOT NULL AUTO_INCREMENT,
  `full_name` varchar(100) NOT NULL,
  `student_id` varchar(20) NOT NULL,
  `email` varchar(10) NOT NULL,
  `date_of_birth` date NOT NULL,
  `course_of_study` varchar(100) NOT NULL,
  `enrollment_date` date NOT NULL,
  `status` varchar(20) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
CREATE TABLE IF NOT EXISTS `students` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'Unique ID for each record',
  `full_name` varchar(100) NOT NULL COMMENT 'Student''s full name',
  `student_id` varchar(20) NOT NULL COMMENT 'Student ID',
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Student''s email address',
  `date_of_birth` date NOT NULL COMMENT 'Date of birth',
  `course_of_study` varchar(100) NOT NULL COMMENT 'Course name',
  `enrollment_date` date NOT NULL COMMENT 'Date of enrollment',
  `status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL COMMENT 'Academic status',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `full_name`, `student_id`, `email`, `date_of_birth`, `course_of_study`, `enrollment_date`, `status`) VALUES
(1, 'Eunice Soko', 'ST001', 'eunicesk@gmail.com', '2001-05-10', 'Systems Development', '2023-02-01', 'Active'),
(2, 'Arjun Mango', 'ST002', 'arjunM@gmail.com', '2002-05-07', 'Data Analytics', '2022-02-01', 'Active'),
(3, 'Britney Kale', 'ST003', 'britney@gmail.com', '2005-01-04', 'Data Analytics', '2025-01-14', 'Pending'),
(8, 'Manel Kwazi', 'ST006', 'manel@gmail.com', '2002-02-27', 'Pastel Accounting', '2022-02-01', 'Inactive'),
(9, 'Manesh Modeli', 'ST005', 'manesh23@yahoo.com', '2005-10-11', 'Bcom Law', '2024-07-02', 'Active'),
(10, 'Brandon Syke', 'ST004', 'brandom@gmail.com', '2006-04-21', 'Digital Marketing', '2025-10-16', 'Pending'),
(15, 'Kelly Hashmuk', 'ST008', 'kellyHash@gmail.com', '2003-10-22', 'Paralegal', '2025-02-03', 'Active'),
(23, 'Carol Valion', 'ST0012', 'carolV@gmail.com', '2001-05-23', 'Applied Science', '2024-07-29', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','student') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
