-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2024 at 04:19 PM
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
-- Database: `employee_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(15) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `dob` varchar(15) DEFAULT NULL,
  `password` varchar(75) NOT NULL,
  `dp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `gender`, `dob`, `password`, `dp`) VALUES
(1, 'abid', 'admin@gmail.com', 'Male', '2000-12-31', '1234', '660047e7d79f58.9217565265f1f7061f52a6.31645201a4.jpg'),
(13, 'Abrar', 'abrarahmaed@gmail.com', 'Male', '2015-08-25', '1234', '');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(15) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `dob` varchar(255) DEFAULT NULL,
  `password` varchar(75) NOT NULL,
  `Position` varchar(255) NOT NULL,
  `salary` int(10) NOT NULL,
  `dp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `name`, `email`, `gender`, `dob`, `password`, `Position`, `salary`, `dp`) VALUES
(13, 'emp1', 'employee1@gmail.com', 'Male', '31/1/2000', '1234', 'employee', 20000, ''),
(18, 'abrar ahmed', 'abrar@gmail.com', 'Male', '', '1234', 'Sr Employee', 25000, ''),
(19, 'employee2', 'employee@gmail.com', 'Female', '', '1234', 'Sr Employee', 25000, ''),
(20, 'employee3', 'employe3@gmail.com', 'Male', '', '1234', 'employee', 20000, ''),
(21, 'employee4', 'employe3@gmail.co4', 'Female', '', '1234', 'employee', 20000, ''),
(22, 'Hasan', 'abidhasanstudent20@gmail.com', 'Male', '12/2/1999', '1234', 'IT Manager', 25000, '6608607adb1691.09461319logo.png'),
(23, 'employee5', 'employe5@gmail.com', 'Female', '', '1234', 'marketing', 15000, '');

-- --------------------------------------------------------

--
-- Table structure for table `emp_leave`
--

CREATE TABLE `emp_leave` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `LeaveType` varchar(255) DEFAULT NULL,
  `reason` varchar(500) NOT NULL,
  `start_date` varchar(24) NOT NULL,
  `last_date` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emp_leave`
--

INSERT INTO `emp_leave` (`id`, `name`, `LeaveType`, `reason`, `start_date`, `last_date`, `email`, `status`) VALUES
(3, 'Hasan', 'Personal Time Off', 'I need leave ', '2024-04-18', '2024-04-19', 'abidhasanstudent20@gmail.com', 'Accepted'),
(4, 'abrar ahmed', 'Casual Leave', 'I need leave ', '2024-04-15', '2024-04-16', 'abrar@gmail.com', 'Accepted'),
(5, 'employee2', 'Casual Leave', 'I need leave ', '2024-04-16', '2024-04-17', 'employee@gmail.com', 'Accepted'),
(6, 'employee2', 'Restricted Holiday', 'please I need leave', '2024-04-19', '2024-04-19', 'employee@gmail.com', 'Accepted'),
(7, 'employee2', 'Medical Leave', ' suffering fever', '2024-04-20', '2024-04-21', 'employee@gmail.com', 'Accepted');

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `id` int(55) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` varchar(30) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `emp_name` varchar(200) NOT NULL,
  `emp_email` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `sub_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`id`, `name`, `description`, `status`, `start_date`, `end_date`, `emp_name`, `emp_email`, `date_created`, `sub_date`) VALUES
(2, 'collect client info', 'collect all client info and do separate file', 'Done', '2024-04-20', '2024-04-21', 'Hasan', 'abidhasanstudent20@gmail.com', '2024-04-20 23:42:05', '2024-04-20 23:53:28'),
(4, 'please make a account form', 'make a form-\r\ndetails of account', 'Done', '2024-04-22', '2024-04-23', 'Hasan', 'abidhasanstudent20@gmail.com', '2024-04-21 00:06:15', '2024-04-21 00:12:34');

-- --------------------------------------------------------

--
-- Table structure for table `tblleavetype`
--

CREATE TABLE `tblleavetype` (
  `Id` int(22) NOT NULL,
  `LeaveType` varchar(255) DEFAULT NULL,
  `Description` mediumtext DEFAULT NULL,
  `CreationDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblleavetype`
--

INSERT INTO `tblleavetype` (`Id`, `LeaveType`, `Description`, `CreationDate`) VALUES
(1, 'Casual Leave', 'Provided for urgent or unforeseen matters to the employees.', '2024-03-26 15:58:50'),
(2, 'Medical Leave', 'Related to Health Problems of Employee', '2024-03-26 15:58:50'),
(3, 'Restricted Holiday', 'Holiday that is optional', '2024-03-26 15:58:50'),
(4, 'Paternity Leave', 'To take care of newborns', '2024-03-26 15:58:50'),
(5, 'Bereavement Leave', 'Grieve their loss of losing loved ones', '2024-03-26 15:58:50'),
(6, 'Compensatory Leave', 'For Overtime Workers', '2024-03-29 14:29:19'),
(8, 'Maternity Leave', 'Taking care of newborn, recoveries', '2024-03-30 18:41:03'),
(9, 'Adverse Weather Leave', 'In terms of extreme weather conditions', '2024-03-30 18:42:52'),
(10, 'Voting Leave', 'For official election day', '2024-03-30 18:43:36'),
(12, 'Religious Holidays', 'Based on employees followed religion', '2024-03-30 18:46:41'),
(13, 'Self-Quarantine Leave', 'Related to COVID-19 issues', '2024-03-30 18:47:07'),
(14, 'Personal Time Off', 'To manage some private matters', '2024-03-30 18:47:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emp_leave`
--
ALTER TABLE `emp_leave`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblleavetype`
--
ALTER TABLE `tblleavetype`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `emp_leave`
--
ALTER TABLE `emp_leave`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `id` int(55) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tblleavetype`
--
ALTER TABLE `tblleavetype`
  MODIFY `Id` int(22) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
