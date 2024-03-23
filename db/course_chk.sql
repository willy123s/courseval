-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 22, 2024 at 10:32 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `course_chk`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `course` varchar(150) NOT NULL,
  `description` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course`, `description`) VALUES
(1, 'IT', 'Information Technology'),
(4, 'BA', 'Bachelor of Business Administration'),
(5, 'BPA', 'Bachelor of Public Administration');

-- --------------------------------------------------------

--
-- Table structure for table `curriculumdetails`
--

CREATE TABLE `curriculumdetails` (
  `id` int(11) NOT NULL,
  `currId` int(11) NOT NULL,
  `subId` int(11) NOT NULL,
  `yearId` int(11) NOT NULL,
  `semId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `curriculumdetails`
--

INSERT INTO `curriculumdetails` (`id`, `currId`, `subId`, `yearId`, `semId`) VALUES
(1, 1, 5, 1, 1),
(2, 1, 6, 1, 1),
(3, 1, 7, 1, 1),
(4, 1, 8, 1, 1),
(5, 1, 9, 1, 1),
(6, 1, 10, 1, 1),
(7, 1, 11, 1, 1),
(8, 1, 12, 1, 2),
(9, 1, 13, 1, 2),
(10, 1, 14, 1, 2),
(11, 1, 15, 1, 2),
(12, 1, 16, 1, 2),
(13, 1, 17, 1, 2),
(14, 1, 18, 1, 2),
(15, 1, 19, 1, 2),
(16, 1, 20, 1, 2),
(17, 1, 21, 2, 1),
(18, 1, 22, 2, 1),
(19, 1, 23, 2, 1),
(20, 1, 24, 2, 1),
(21, 1, 25, 2, 1),
(22, 1, 26, 2, 1),
(23, 1, 27, 2, 1),
(24, 1, 28, 2, 2),
(25, 1, 29, 2, 2),
(26, 1, 30, 2, 2),
(27, 1, 31, 2, 2),
(28, 1, 32, 2, 2),
(29, 1, 33, 2, 2),
(30, 1, 34, 2, 2),
(31, 1, 35, 2, 2),
(32, 1, 36, 2, 3),
(33, 1, 37, 2, 3),
(34, 1, 38, 2, 3),
(35, 1, 39, 3, 1),
(36, 1, 40, 3, 1),
(37, 1, 41, 3, 1),
(38, 1, 42, 3, 1),
(39, 1, 43, 3, 1),
(40, 1, 44, 3, 1),
(41, 1, 45, 3, 2),
(42, 1, 46, 3, 2),
(43, 1, 47, 3, 2),
(44, 1, 48, 3, 2),
(45, 1, 49, 3, 2),
(46, 1, 50, 3, 2),
(47, 1, 51, 3, 2),
(48, 1, 52, 4, 1),
(49, 1, 53, 4, 1),
(50, 1, 54, 4, 1),
(51, 1, 55, 4, 1),
(52, 1, 56, 4, 1),
(53, 1, 57, 4, 1),
(54, 1, 58, 4, 1),
(57, 3, 5, 1, 1),
(58, 4, 11, 1, 1),
(61, 1, 59, 4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `curriculums`
--

CREATE TABLE `curriculums` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `course_id` int(11) NOT NULL,
  `sy` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `curriculums`
--

INSERT INTO `curriculums` (`id`, `name`, `course_id`, `sy`) VALUES
(1, 'BSIT 2022-2023', 1, '3'),
(2, 'IT Curriculum 2021 - 2022', 1, '2'),
(3, 'BA-2023', 4, '4'),
(4, 'BPA 2023-2024', 5, '4');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `department` varchar(200) NOT NULL,
  `description` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `department`, `description`) VALUES
(1, 'IT', 'Information Technology Department'),
(2, 'PA', 'Public Administration'),
(3, 'BA', 'Business Administration');

-- --------------------------------------------------------

--
-- Table structure for table `enrollmentdetails`
--

CREATE TABLE `enrollmentdetails` (
  `id` int(11) NOT NULL,
  `enrollmentId` int(11) NOT NULL,
  `currDetId` int(11) NOT NULL,
  `addedBy` int(11) NOT NULL,
  `addedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `enrollments`
--

CREATE TABLE `enrollments` (
  `id` int(11) NOT NULL,
  `studId` int(11) NOT NULL,
  `syId` int(11) NOT NULL,
  `semId` int(11) NOT NULL,
  `createdBy` int(11) NOT NULL,
  `createdAt` datetime NOT NULL,
  `status` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `graderange`
--

CREATE TABLE `graderange` (
  `id` int(11) NOT NULL,
  `grade` varchar(50) NOT NULL,
  `description` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `graderange`
--

INSERT INTO `graderange` (`id`, `grade`, `description`) VALUES
(1, '1.00', '1.00'),
(2, '1.25', '1.25'),
(3, '1.50', '1.50'),
(4, '1.75', '1.75'),
(5, '2.00', '2.00'),
(6, '2.25', '2.25'),
(7, '2.50', '2.50'),
(8, '2.75', '2.75'),
(9, '3.00', '3.00'),
(10, 'INC', 'Incomplete'),
(11, '5.00', 'Failed'),
(12, 'W', 'Widrawn'),
(13, 'Drop', 'Droped');

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `id` int(11) NOT NULL,
  `studId` int(11) NOT NULL,
  `currDetailsId` int(11) NOT NULL,
  `grade` varchar(15) NOT NULL,
  `semester` int(11) NOT NULL,
  `schoolyear` int(11) NOT NULL,
  `isConfirmed` int(11) NOT NULL COMMENT '0 not confirmed, 1 Confirmed'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prerequisites`
--

CREATE TABLE `prerequisites` (
  `id` int(11) NOT NULL,
  `currDetailsId` int(11) NOT NULL,
  `prereq` int(11) NOT NULL COMMENT 'Curriculum Details Id',
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prerequisites`
--

INSERT INTO `prerequisites` (`id`, `currDetailsId`, `prereq`, `type`) VALUES
(4, 10, 2, 'Pre'),
(6, 11, 1, 'Pre'),
(7, 15, 6, 'Pre'),
(10, 16, 5, 'Pre'),
(13, 8, 7, 'Pre'),
(14, 17, 10, 'Pre'),
(15, 21, 10, 'Pre'),
(16, 22, 15, 'Pre'),
(17, 23, 10, 'Pre'),
(18, 25, 17, 'Pre'),
(19, 26, 21, 'Pre'),
(20, 27, 22, 'Pre'),
(21, 28, 17, 'Pre'),
(22, 29, 11, 'Pre'),
(23, 30, 23, 'Pre'),
(24, 31, 17, 'Pre');

-- --------------------------------------------------------

--
-- Table structure for table `proofs`
--

CREATE TABLE `proofs` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `yearid` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `filename` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schoolyears`
--

CREATE TABLE `schoolyears` (
  `id` int(11) NOT NULL,
  `schoolyear` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schoolyears`
--

INSERT INTO `schoolyears` (`id`, `schoolyear`, `status`) VALUES
(1, '2020-2021', ''),
(2, '2021-2022', ''),
(3, '2022-2023', ''),
(4, '2023-2024', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `semesters`
--

CREATE TABLE `semesters` (
  `id` int(11) NOT NULL,
  `sem` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `semesters`
--

INSERT INTO `semesters` (`id`, `sem`, `status`) VALUES
(1, '1st Semester', 'Active'),
(2, '2nd Semester', ''),
(3, 'Summer', '');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `studNo` varchar(50) NOT NULL,
  `fname` varchar(150) NOT NULL,
  `lname` varchar(150) NOT NULL,
  `mname` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `courseId` int(11) NOT NULL,
  `currId` int(11) NOT NULL,
  `password` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `subjectCode` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `units` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `subjectCode`, `description`, `units`) VALUES
(5, 'CC 101', 'Introduction to Computing (CO)', 3),
(6, 'CC 102', 'Fundamentals of Programming (CO)', 3),
(7, 'GE 5', 'The Contemporary World', 3),
(8, 'GE 6', 'Science and Technology and Society', 3),
(9, 'GE 7', 'Mathematics in the Modern World', 3),
(10, 'PE1', 'Movement Enhancement', 2),
(11, 'NSTP1 - CWTS', 'CWTS', 3),
(12, 'NSTP2', 'ROTC/CWTS/LTS 2', 3),
(13, 'GEE 3', 'Reading Visual Arts', 3),
(14, 'CC103', 'Intermediate Programming (CO)', 3),
(15, 'CO101', 'Computer Organization (CO)', 3),
(16, 'GE 2', 'Readings in Philippine History', 3),
(17, 'GE 3', 'Art Appreciation', 3),
(18, 'GE 1', 'Understanding the Self', 3),
(19, 'PE 2', 'Physical Activity towards Health and Fitness 2 (Movement Patterns: Exercised-Based)', 2),
(20, 'MS101', 'Discrete Mathematics', 3),
(21, 'CC 104', 'Data Structure and Algorithm (CO)', 3),
(22, 'GE 4', 'Purposive Communicaton', 3),
(23, 'GEE 1', 'Living in the IT Era', 3),
(24, 'GEE 4', 'Global Citizenship', 3),
(25, 'HCI 101', 'HUMAN COMPUTER INTERACTION I (CO)', 3),
(26, 'PE3', 'Physical Activity Towards Health and Fitness 1', 2),
(27, 'OOP 101', 'OBJECT ORIENTED PROGRAMMING', 3),
(28, 'GE 9', 'The Life and Works of Rizal', 3),
(29, 'CC 105', 'Information Management 1 (CO)', 3),
(30, 'HCI 102', 'Human Interaction 2 (CO)', 3),
(31, 'PE 104', 'Physical Activity Towards Health and Fitness 4', 2),
(32, 'MT 101', 'Multimedia Technologies (CO)', 3),
(33, 'NET 101', 'Networking 1 (Fundamentals of Networking) (CO)', 3),
(34, 'SAD 101', 'System Analysis and Design', 3),
(35, 'WD 101', 'Web Development (CO)', 3),
(36, 'GE 9', 'Ethics', 3),
(37, 'IM 102', 'Information Management 2 (Advance Database Systems) (CO)', 3),
(38, 'LIT 2', 'Global Currents and World Literature', 3),
(39, 'CC 106', 'Application Development and Emerging Technologies', 3),
(40, 'MD 101', 'Mobile Application Development 1 (CO)', 3),
(41, 'MS 102', 'Quantitative Methods', 3),
(42, 'NET 102', 'Networking 2 (Advance Networking) (CO)', 3),
(43, 'SP 101', 'Social and Professional Issues', 3),
(44, 'WS 101', 'Web Systems and Technologies 1 (CO)', 3),
(45, 'CAP 101', 'Capstone Project 1', 3),
(46, 'IPT 101', 'Integrative Programming and Technologies (CO)', 3),
(47, 'PERDEV', 'Personality Development', 3),
(48, 'ELEC 2', 'Elective 2 (Mobile Application Development 2) (CO)', 3),
(49, 'ELEC1', 'Elective 1 (Web Systems and Technologies 2) (CO)', 3),
(50, 'OS 101', 'Operating Systems Application (CO)', 3),
(51, 'TECH101', 'Technoprenuership', 3),
(52, 'FIL2', 'Filipino sa Iba\'t Ibang Disiplina', 3),
(53, 'CAP 2', 'Capstone Project 2', 3),
(54, 'IAS 102', 'Information Assurance and Security 2 (CO)', 3),
(55, 'ELEC 3', 'Elective 3 (Special Topics on Data Analytics 1) (CO)', 3),
(56, 'ELEC 4', 'Elective 4 (Special Topics on Data Analytics 2) (CO)', 3),
(57, 'SA 101', 'System Administration and Maintenance (CO)', 3),
(58, 'SIA 101', 'Systems Integration and Architecture (CO)', 3),
(59, 'INTERN 101', 'Internship (OJT/ PRACTICUM)', 6),
(60, 'IT1000', 'Test', 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `empno` varchar(50) NOT NULL,
  `fname` varchar(150) NOT NULL,
  `lname` varchar(150) NOT NULL,
  `mname` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `courseId` int(11) NOT NULL,
  `userType` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `empno`, `fname`, `lname`, `mname`, `email`, `password`, `courseId`, `userType`) VALUES
(1, 'SC-0000', 'Admin', 'Admin', 'Admin', 'admin@gmail.com', '$2y$10$qNaipG9W5pggblLxTTUCF.iJK.4NWBnk6b4Z6Dgi6.kPWaO/Q47Wu', 1, 'Admin'),
(2, 'SC-0001', 'Faculty', 'Faculty', 'Faculty', 'faculty@gmail.com', '$2y$10$6nrZRs1aiRbHhSjURK9Au.8wZZV0XZkaahRW/2W0ndgDq7cbWpFFq', 1, 'Instructor'),
(3, 'SC-0002', 'Second', 'Lastname', 'Middle', 'sc0002@gmail.com', '$2y$10$8DFTb4x/HiQljLqPAoo0iun8.1qoX7bDsC0CzbBk09rnUT.HN96FW', 1, 'Instructor');

-- --------------------------------------------------------

--
-- Table structure for table `usertypes`
--

CREATE TABLE `usertypes` (
  `id` int(11) NOT NULL,
  `utype` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usertypes`
--

INSERT INTO `usertypes` (`id`, `utype`) VALUES
(1, 'Admin'),
(2, 'Chairman'),
(3, 'Instructor');

-- --------------------------------------------------------

--
-- Table structure for table `yearlevels`
--

CREATE TABLE `yearlevels` (
  `id` int(11) NOT NULL,
  `year` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `yearlevels`
--

INSERT INTO `yearlevels` (`id`, `year`) VALUES
(1, 'First Year'),
(2, 'Second Year'),
(3, 'Third Year'),
(4, 'Fourth Year');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `curriculumdetails`
--
ALTER TABLE `curriculumdetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `curriculums`
--
ALTER TABLE `curriculums`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enrollmentdetails`
--
ALTER TABLE `enrollmentdetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `graderange`
--
ALTER TABLE `graderange`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prerequisites`
--
ALTER TABLE `prerequisites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `proofs`
--
ALTER TABLE `proofs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schoolyears`
--
ALTER TABLE `schoolyears`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `semesters`
--
ALTER TABLE `semesters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `studNo` (`studNo`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `empno` (`empno`);

--
-- Indexes for table `usertypes`
--
ALTER TABLE `usertypes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `yearlevels`
--
ALTER TABLE `yearlevels`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `curriculumdetails`
--
ALTER TABLE `curriculumdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `curriculums`
--
ALTER TABLE `curriculums`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `enrollmentdetails`
--
ALTER TABLE `enrollmentdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `enrollments`
--
ALTER TABLE `enrollments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `graderange`
--
ALTER TABLE `graderange`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prerequisites`
--
ALTER TABLE `prerequisites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `proofs`
--
ALTER TABLE `proofs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `schoolyears`
--
ALTER TABLE `schoolyears`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `semesters`
--
ALTER TABLE `semesters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `usertypes`
--
ALTER TABLE `usertypes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `yearlevels`
--
ALTER TABLE `yearlevels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
