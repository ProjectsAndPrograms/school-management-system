-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2024 at 01:43 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `_sms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `s_no` int(20) NOT NULL,
  `id` varchar(30) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `dob` varchar(20) NOT NULL,
  `image` varchar(40) NOT NULL DEFAULT '1701517055user.png',
  `phone` varchar(20) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `address` varchar(700) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`s_no`, `id`, `fname`, `lname`, `dob`, `image`, `phone`, `gender`, `address`) VALUES
(2, 'A9876543210', 'Admin', 'Kumar', '12/11/2024', 'A98765432101718792069.png', '1234567890', 'male', 'no where');

-- --------------------------------------------------------

--
-- Table structure for table `attendence`
--

CREATE TABLE `attendence` (
  `s_no` int(20) NOT NULL,
  `student_id` varchar(40) NOT NULL,
  `attendence` varchar(10) NOT NULL,
  `class` varchar(30) NOT NULL,
  `section` varchar(5) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendence`
--

INSERT INTO `attendence` (`s_no`, `student_id`, `attendence`, `class`, `section`, `date`) VALUES
(1, 'S1718791292', '1', '12c', 'A', '2024-06-19 15:32:37');

-- --------------------------------------------------------

--
-- Table structure for table `buses`
--

CREATE TABLE `buses` (
  `s_no` int(11) NOT NULL,
  `bus_id` varchar(20) NOT NULL,
  `bus_title` varchar(100) NOT NULL,
  `bus_number` varchar(20) NOT NULL,
  `request` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `buses`
--

INSERT INTO `buses` (`s_no`, `bus_id`, `bus_title`, `bus_number`, `request`) VALUES
(10, '1718791847', 'Bus 1', 'XXXXXX', ''),
(11, '1718791949', 'Bus 2', '999999', ''),
(12, '1718791984', 'Another bus', 'OOOOOOOO', '');

-- --------------------------------------------------------

--
-- Table structure for table `bus_root`
--

CREATE TABLE `bus_root` (
  `s_no` int(11) NOT NULL,
  `bus_id` varchar(20) NOT NULL,
  `location` varchar(255) NOT NULL,
  `arrival_time` varchar(20) NOT NULL,
  `serial` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bus_root`
--

INSERT INTO `bus_root` (`s_no`, `bus_id`, `location`, `arrival_time`, `serial`) VALUES
(7, '1718791847', 'Stop 1', '06:50 AM', 1),
(8, '1718791847', 'Stop 2', '07:00 AM', 2),
(9, '1718791847', 'Stop 3', '07:10 AM', 3),
(10, '1718791847', 'SCHOOL', '10:00 AM', 4),
(13, '1718791949', 'Stop z', '06:35 AM', 1),
(14, '1718791949', 'SCHOOL', '10:00 AM', 2),
(15, '1718791984', 'Stop x', '06:45 AM', 1),
(16, '1718791984', 'SCHOOL', '10:00 AM', 2);

-- --------------------------------------------------------

--
-- Table structure for table `bus_staff`
--

CREATE TABLE `bus_staff` (
  `s_no` int(11) NOT NULL,
  `id` varchar(20) NOT NULL,
  `bus_id` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `contact` varchar(10) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bus_staff`
--

INSERT INTO `bus_staff` (`s_no`, `id`, `bus_id`, `name`, `contact`, `role`) VALUES
(1, 'B1718791847', '1718791847', 'driver ', '8080808080', 'driver'),
(2, 'B1718791847', '1718791847', 'helper ', '0000000000', 'helper'),
(3, 'B1718791949', '1718791949', 'driver 2', '7897898988', 'driver'),
(4, 'B1718791949', '1718791949', 'helper', '7897898988', 'helper'),
(5, 'B1718791984', '1718791984', 'another driver', '7897897898', 'driver'),
(6, 'B1718791984', '1718791984', 'another helper', '7894568796', 'helper');

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `s_no` int(10) NOT NULL,
  `class` varchar(20) NOT NULL,
  `section` varchar(1) NOT NULL,
  `fees` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `s_no` int(20) NOT NULL,
  `exam_id` varchar(40) NOT NULL,
  `exam_title` varchar(512) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `class` varchar(30) NOT NULL,
  `section` varchar(10) NOT NULL,
  `total_marks` varchar(10) NOT NULL,
  `passing_marks` varchar(10) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`s_no`, `exam_id`, `exam_title`, `subject`, `class`, `section`, `total_marks`, `passing_marks`, `timestamp`) VALUES
(3, 'E17187917486672ae442b976', 'Monthly test ', 'ALL', '12c', 'A', '100', '33', '2024-06-19 15:39:08'),
(4, 'E17187928006672b26095672', 'Hindi exam result', 'Hindi', '12c', 'A', '100', '33', '2024-06-19 15:56:40'),
(5, 'E17187929656672b305cbb25', 'sldfj', 'ALL', '12c', 'A', '100', '33', '2024-06-19 15:59:25');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `s_no` int(11) NOT NULL,
  `sender_id` varchar(20) NOT NULL,
  `receiver_id` varchar(20) NOT NULL,
  `msg` varchar(500) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`s_no`, `sender_id`, `receiver_id`, `msg`, `timestamp`) VALUES
(7, 'T1718791191', 'S1718791292', 'Hello student', '2024-06-19 15:46:58'),
(8, 'T1718791191', 'S1718791292', 'You are so naughty\n', '2024-06-19 15:47:11');

-- --------------------------------------------------------

--
-- Table structure for table `fee_record`
--

CREATE TABLE `fee_record` (
  `s_no` int(11) NOT NULL,
  `id` varchar(20) NOT NULL,
  `month` varchar(20) NOT NULL,
  `other_collection` int(5) NOT NULL,
  `total` int(5) NOT NULL,
  `paid` int(5) NOT NULL,
  `balance` int(5) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `leaves`
--

CREATE TABLE `leaves` (
  `s_no` int(10) NOT NULL,
  `sender_id` varchar(20) NOT NULL,
  `send_date` datetime NOT NULL DEFAULT current_timestamp(),
  `leave_type` varchar(100) NOT NULL,
  `leave_desc` varchar(255) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `leaves`
--

INSERT INTO `leaves` (`s_no`, `sender_id`, `send_date`, `leave_type`, `leave_desc`, `start_date`, `end_date`, `status`) VALUES
(12, 'T1718791191', '2024-06-19 15:48:43', 'Medical Leave', 'accept my leave otherwise ....... ', '2024-06-20 00:00:00', '2024-06-27 00:00:00', 'pending'),
(13, 'T1718791191', '2024-06-19 15:49:23', 'Casual Leave', 'I want some rest please give me leave', '2024-06-29 00:00:00', '2024-07-03 00:00:00', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `marks`
--

CREATE TABLE `marks` (
  `s_no` int(20) NOT NULL,
  `exam_id` varchar(40) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `student_id` varchar(40) NOT NULL,
  `marks` varchar(10) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `marks`
--

INSERT INTO `marks` (`s_no`, `exam_id`, `subject`, `student_id`, `marks`) VALUES
(1, 'E17187917486672ae442b976', 'Hindi', 'S1718791292', '86'),
(2, 'E17187917486672ae442b976', 'Commerce', 'S1718791292', '62'),
(3, 'E17187917486672ae442b976', 'English', 'S1718791292', '59'),
(4, 'E17187928006672b26095672', 'Hindi', 'S1718791292', '33'),
(5, 'E17187929656672b305cbb25', 'Hindi', 'S1718791292', '55'),
(6, 'E17187929656672b305cbb25', 'Commerce', 'S1718791292', '55'),
(7, 'E17187929656672b305cbb25', 'English', 'S1718791292', '21');

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `s_no` int(20) NOT NULL,
  `sender_id` varchar(40) NOT NULL,
  `editor_id` varchar(40) NOT NULL,
  `class` varchar(50) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `comment` varchar(1000) NOT NULL,
  `file` varchar(50) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`s_no`, `sender_id`, `editor_id`, `class`, `subject`, `title`, `comment`, `file`, `timestamp`) VALUES
(1, 'A9876543210', 'A9876543210', '12c', 'Hindi', 'Hindi Homework ', 'do this on time', 'A98765432101718791715.png', '2024-06-19 15:38:35');

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE `notice` (
  `s_no` int(20) NOT NULL,
  `sender_id` varchar(40) NOT NULL,
  `editor_id` varchar(40) NOT NULL,
  `title` varchar(100) NOT NULL,
  `body` varchar(1000) NOT NULL,
  `file` varchar(100) NOT NULL,
  `importance` varchar(5) NOT NULL DEFAULT '1',
  `timestamp` datetime NOT NULL DEFAULT current_timestamp(),
  `role` varchar(11) NOT NULL,
  `class` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notice`
--

INSERT INTO `notice` (`s_no`, `sender_id`, `editor_id`, `title`, `body`, `file`, `importance`, `timestamp`, `role`, `class`) VALUES
(51, 'A9876543210', 'A9876543210', 'Notice title', 'body', 'A98765432101718791385.png', '2', '2024-06-19 15:33:05', '', ''),
(52, 'A9876543210', 'A9876543210', 'Title 2', 'body 2', 'A98765432101718791411.png', '3', '2024-06-19 15:33:31', '', ''),
(53, 'A9876543210', 'A9876543210', 'Holiday notice', 'enjoy your holidays', 'A98765432101718791447.png', '1', '2024-06-19 15:34:07', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `s_no` int(20) NOT NULL,
  `sender_id` varchar(40) NOT NULL,
  `class` varchar(30) NOT NULL,
  `section` varchar(10) NOT NULL,
  `type` varchar(10) NOT NULL,
  `title` varchar(100) NOT NULL,
  `message` varchar(1000) NOT NULL,
  `file` varchar(50) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payroll`
--

CREATE TABLE `payroll` (
  `s_no` int(11) NOT NULL,
  `id` varchar(30) NOT NULL,
  `amount` int(11) NOT NULL,
  `date` varchar(30) NOT NULL,
  `name` varchar(50) NOT NULL,
  `account_no` varchar(40) NOT NULL,
  `ifsc_code` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reminders`
--

CREATE TABLE `reminders` (
  `s_no` int(20) NOT NULL,
  `id` varchar(40) NOT NULL,
  `message` varchar(2000) NOT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `reminders`
--

INSERT INTO `reminders` (`s_no`, `id`, `message`, `status`) VALUES
(68, 'T1718791191', 'Post a homework daily', 'completed'),
(69, 'T1718791191', 'principal meeting', 'pending'),
(70, 'A9876543210', 'Reminder for myself : have a good day', 'pending'),
(71, 'A9876543210', '\nBest of luck', 'completed');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `s_no` int(20) NOT NULL,
  `id` varchar(40) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `father` varchar(200) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `class` varchar(20) NOT NULL,
  `section` varchar(50) NOT NULL,
  `dob` varchar(15) NOT NULL,
  `image` varchar(50) NOT NULL DEFAULT '1701517055user.png',
  `phone` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(200) NOT NULL,
  `city` varchar(50) NOT NULL,
  `zip` varchar(20) NOT NULL,
  `state` varchar(50) NOT NULL,
  `request_date` varchar(30) NOT NULL,
  `request_time` varchar(30) NOT NULL,
  `request` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`s_no`, `id`, `fname`, `lname`, `father`, `gender`, `class`, `section`, `dob`, `image`, `phone`, `email`, `address`, `city`, `zip`, `state`, `request_date`, `request_time`, `request`) VALUES
(1, 'S1718791292', 'Student', 'kumar', 'father G', 'Male', '12c', 'A', '19-06-2024', 'S17187912921718791292.png', '7894561230', 'student@gmail.com', 'near teachers house', 'home town', '789654', 'Panjab', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `student_guardian`
--

CREATE TABLE `student_guardian` (
  `s_no` int(20) NOT NULL,
  `id` varchar(40) NOT NULL,
  `gname` varchar(200) NOT NULL,
  `gphone` varchar(20) NOT NULL,
  `gaddress` varchar(200) NOT NULL,
  `gcity` varchar(100) NOT NULL,
  `gzip` varchar(50) NOT NULL,
  `relation` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_guardian`
--

INSERT INTO `student_guardian` (`s_no`, `id`, `gname`, `gphone`, `gaddress`, `gcity`, `gzip`, `relation`) VALUES
(1, 'S1718791292', 'Regan Clemons', '4567894562', 'Eum sit et laboriosa', 'Abbot', 'Hunter', 'Culpa odio laboriosa');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `s_no` int(20) NOT NULL,
  `subject_id` varchar(40) NOT NULL,
  `subject_name` varchar(100) NOT NULL,
  `class` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`s_no`, `subject_id`, `subject_name`, `class`) VALUES
(1, '12c6672ac911a253', 'Hindi', '12c'),
(2, '12c6672ac9c45d68', 'Commerce', '12c'),
(3, '12c6672aca78c3c7', 'English', '12c');

-- --------------------------------------------------------

--
-- Table structure for table `syllabus`
--

CREATE TABLE `syllabus` (
  `s_no` int(20) NOT NULL,
  `class` varchar(50) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `file` varchar(100) NOT NULL DEFAULT '-1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `syllabus`
--

INSERT INTO `syllabus` (`s_no`, `class`, `subject`, `file`) VALUES
(12, '12c', 'Hindi', 'T17187911911718792274.png'),
(13, '12c', 'English', 'T17187911911718792285.png');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `s_no` int(20) NOT NULL,
  `id` varchar(40) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `father` varchar(150) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `dob` varchar(20) NOT NULL,
  `image` varchar(30) NOT NULL DEFAULT '1701517055user.png',
  `phone` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(512) NOT NULL,
  `city` varchar(50) NOT NULL,
  `zip` varchar(20) NOT NULL,
  `state` varchar(50) NOT NULL,
  `class` varchar(20) NOT NULL,
  `section` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`s_no`, `id`, `fname`, `lname`, `father`, `subject`, `gender`, `dob`, `image`, `phone`, `email`, `address`, `city`, `zip`, `state`, `class`, `section`) VALUES
(1, 'T1718791191', 'teacher', 'kumar', '', 'Hindi', 'Male', '19-06-2024', 'T17187911911718792416.png', '7896541230', 'teacher@gmail.com', 'near admins house', 'home town', '478548', 'Delhi', '12c', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_guardian`
--

CREATE TABLE `teacher_guardian` (
  `s_no` int(20) NOT NULL,
  `id` varchar(40) NOT NULL,
  `gname` varchar(256) NOT NULL,
  `gphone` varchar(20) NOT NULL,
  `gaddress` varchar(256) NOT NULL,
  `gcity` varchar(50) NOT NULL,
  `gzip` varchar(20) NOT NULL,
  `relation` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `teacher_guardian`
--

INSERT INTO `teacher_guardian` (`s_no`, `id`, `gname`, `gphone`, `gaddress`, `gcity`, `gzip`, `relation`) VALUES
(1, 'T1718791191', 'Velma Walker', '1234567895', 'Sit voluptas nisi v', 'Maggie', 'Mckee', 'Consequatur Volupta');

-- --------------------------------------------------------

--
-- Table structure for table `time_table`
--

CREATE TABLE `time_table` (
  `s_no` int(20) NOT NULL,
  `class` varchar(50) NOT NULL,
  `section` varchar(10) NOT NULL,
  `start_time` varchar(20) NOT NULL,
  `end_time` varchar(20) NOT NULL,
  `mon` varchar(30) NOT NULL,
  `tue` varchar(30) NOT NULL,
  `wed` varchar(30) NOT NULL,
  `thu` varchar(30) NOT NULL,
  `fri` varchar(30) NOT NULL,
  `sat` varchar(30) NOT NULL,
  `editor_id` varchar(40) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `time_table`
--

INSERT INTO `time_table` (`s_no`, `class`, `section`, `start_time`, `end_time`, `mon`, `tue`, `wed`, `thu`, `fri`, `sat`, `editor_id`, `timestamp`) VALUES
(1, '12c', 'A', '07:00', '08:00', 'Hindi', '', '', '', '', '', 'A9876543210', '2024-06-19 15:37:37'),
(2, '12c', 'A', '08:00', '09:00', 'English', '', '', '', '', '', 'A9876543210', '2024-06-19 15:37:37'),
(3, '12c', 'A', '09:00', '10:00', 'Math', '', '', '', '', '', 'A9876543210', '2024-06-19 15:37:37'),
(4, '12c', 'A', '10:00', '11:00', 'Hindi', '', '', '', '', '', 'A9876543210', '2024-06-19 15:37:37'),
(5, '12c', 'A', '11:00', '12:00', 'English', '', '', '', '', '', 'A9876543210', '2024-06-19 15:37:37'),
(6, '12c', 'A', '12:00', '01:00', 'Commerce', '', '', '', '', '', 'A9876543210', '2024-06-19 15:37:37'),
(7, '12c', 'A', '01:00', '02:00', 'Commerce', '', '', '', '', '', 'A9876543210', '2024-06-19 15:37:37'),
(8, '12c', 'A', '02:00', '03:00', 'Hindi', '', '', '', '', '', 'A9876543210', '2024-06-19 15:37:37');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `s_no` int(15) NOT NULL,
  `id` varchar(40) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password_hash` varchar(700) NOT NULL,
  `role` varchar(20) NOT NULL,
  `theme` varchar(20) NOT NULL DEFAULT 'light'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`s_no`, `id`, `email`, `password_hash`, `role`, `theme`) VALUES
(1, 'A9876543210', 'admin@gmail.com', '$2y$10$2MrhbQa30mll8mKG6LPyjuI7CQPC4abCvqrSvczxXVRu4RVueRfoe', 'admin', 'light'),
(2, 'T1718791191', 'teacher@gmail.com', '$2y$10$2MrhbQa30mll8mKG6LPyjuI7CQPC4abCvqrSvczxXVRu4RVueRfoe', 'teacher', 'light'),
(3, 'S1718791292', 'student@gmail.com', '$2y$10$2MrhbQa30mll8mKG6LPyjuI7CQPC4abCvqrSvczxXVRu4RVueRfoe', 'student', 'light'),
(4, 'O7898987845', 'owner@gmail.com', '$2y$10$2MrhbQa30mll8mKG6LPyjuI7CQPC4abCvqrSvczxXVRu4RVueRfoe', 'owner', 'light');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`s_no`);

--
-- Indexes for table `attendence`
--
ALTER TABLE `attendence`
  ADD PRIMARY KEY (`s_no`);

--
-- Indexes for table `buses`
--
ALTER TABLE `buses`
  ADD PRIMARY KEY (`s_no`);

--
-- Indexes for table `bus_root`
--
ALTER TABLE `bus_root`
  ADD PRIMARY KEY (`s_no`);

--
-- Indexes for table `bus_staff`
--
ALTER TABLE `bus_staff`
  ADD PRIMARY KEY (`s_no`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`s_no`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`s_no`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`s_no`);

--
-- Indexes for table `fee_record`
--
ALTER TABLE `fee_record`
  ADD PRIMARY KEY (`s_no`);

--
-- Indexes for table `leaves`
--
ALTER TABLE `leaves`
  ADD PRIMARY KEY (`s_no`);

--
-- Indexes for table `marks`
--
ALTER TABLE `marks`
  ADD PRIMARY KEY (`s_no`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`s_no`);

--
-- Indexes for table `notice`
--
ALTER TABLE `notice`
  ADD PRIMARY KEY (`s_no`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`s_no`);

--
-- Indexes for table `payroll`
--
ALTER TABLE `payroll`
  ADD PRIMARY KEY (`s_no`);

--
-- Indexes for table `reminders`
--
ALTER TABLE `reminders`
  ADD PRIMARY KEY (`s_no`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`s_no`);

--
-- Indexes for table `student_guardian`
--
ALTER TABLE `student_guardian`
  ADD PRIMARY KEY (`s_no`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`s_no`);

--
-- Indexes for table `syllabus`
--
ALTER TABLE `syllabus`
  ADD PRIMARY KEY (`s_no`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`s_no`);

--
-- Indexes for table `teacher_guardian`
--
ALTER TABLE `teacher_guardian`
  ADD PRIMARY KEY (`s_no`);

--
-- Indexes for table `time_table`
--
ALTER TABLE `time_table`
  ADD PRIMARY KEY (`s_no`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`s_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `s_no` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `attendence`
--
ALTER TABLE `attendence`
  MODIFY `s_no` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `buses`
--
ALTER TABLE `buses`
  MODIFY `s_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `bus_root`
--
ALTER TABLE `bus_root`
  MODIFY `s_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `bus_staff`
--
ALTER TABLE `bus_staff`
  MODIFY `s_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `s_no` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `s_no` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `s_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `fee_record`
--
ALTER TABLE `fee_record`
  MODIFY `s_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `leaves`
--
ALTER TABLE `leaves`
  MODIFY `s_no` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `marks`
--
ALTER TABLE `marks`
  MODIFY `s_no` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `s_no` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `notice`
--
ALTER TABLE `notice`
  MODIFY `s_no` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `s_no` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payroll`
--
ALTER TABLE `payroll`
  MODIFY `s_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reminders`
--
ALTER TABLE `reminders`
  MODIFY `s_no` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `s_no` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student_guardian`
--
ALTER TABLE `student_guardian`
  MODIFY `s_no` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `s_no` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `syllabus`
--
ALTER TABLE `syllabus`
  MODIFY `s_no` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `s_no` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `teacher_guardian`
--
ALTER TABLE `teacher_guardian`
  MODIFY `s_no` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `time_table`
--
ALTER TABLE `time_table`
  MODIFY `s_no` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `s_no` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
