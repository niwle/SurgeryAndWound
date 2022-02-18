-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 04, 2022 at 11:58 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `surgerymonitoring`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `a_id` int(11) NOT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `apoinment_date` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`a_id`, `patient_id`, `doctor_id`, `description`, `apoinment_date`, `created_at`) VALUES
(2, 51, 52, 'Please Come for here ', '2022-01-20 18:12:00', '2022-01-20 00:07:50'),
(3, 54, 61, 'Check up day', '2022-02-06 05:15:00', '2022-02-05 00:10:26'),
(4, 54, 61, 'Meet up for counseling session', '2022-01-20 05:15:00', '2022-02-05 08:10:33'),
(5, 54, 61, 'x-ray at 5.15', '2022-02-05 05:15:00', '2022-02-05 08:10:33');

-- --------------------------------------------------------

--
-- Table structure for table `progress_book_entry`
--

CREATE TABLE `progress_book_entry` (
  `entryID` int(11) NOT NULL,
  `masterUserid_fk` int(11) DEFAULT NULL,
  `progressImage` varchar(255) DEFAULT NULL,
  `progressTitle` varchar(50) DEFAULT NULL,
  `progressDescription` varchar(255) DEFAULT NULL,
  `quesPain` varchar(45) DEFAULT NULL,
  `quesFluid` varchar(10) DEFAULT NULL,
  `quesRedness` varchar(10) DEFAULT NULL,
  `quesSwelling` varchar(10) DEFAULT NULL,
  `quesOdour` varchar(10) DEFAULT NULL,
  `quesFever` varchar(100) DEFAULT NULL,
  `dcotor_replied` int(11) DEFAULT NULL,
  `flag` int(1) NOT NULL DEFAULT 2 COMMENT '0: delete \n1: archived\n2: show',
  `view_by` longtext NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `progress_book_entry`
--

INSERT INTO `progress_book_entry` (`entryID`, `masterUserid_fk`, `progressImage`, `progressTitle`, `progressDescription`, `quesPain`, `quesFluid`, `quesRedness`, `quesSwelling`, `quesOdour`, `quesFever`, `dcotor_replied`, `flag`, `view_by`, `created_at`, `updated_at`) VALUES
(52, 51, '1.61b22e62f16725.25469564.jpg', 'xcx212', 'Look\'s good 1v34', '2', 'Yes', 'better', 'some', 'Not Sure', 'Yes', 52, 2, '|61', '2021-11-27 00:45:44', '2021-12-19 23:44:55'),
(53, 54, 'banff-national-park-canada-1525041.61a1b90385b8f2.13387712.jpg', 'test update 3.2', 'description 3', '5', 'Not Sure', 'some', 'some', 'No', 'Yes', 52, 2, '', '2021-11-27 12:50:11', '2021-11-27 13:50:56'),
(54, 51, 'autumn-autumn-leaves-blur-close-up-589840.61a1c5e53c2b60.15860318.jpg', 'title 3', 'description3v2', '0', 'Yes', 'worse', 'worse', 'Yes', 'No', 52, 2, '|61', '2021-11-27 13:45:09', '2021-11-27 13:45:09'),
(55, 51, '657227.61a77b6536e0f8.04357994.jpg', 'TEST 1', 'DEs 1', '2.5', 'Yes', 'worse', 'worse', 'Yes', 'No', 53, 2, '|61', '2021-12-01 21:40:53', '2021-12-01 21:40:53'),
(61, 51, '1BkIgGM.61bbe868121cc1.59855636.jpg', 'Text monitor', 'Monitor 1', '2', 'No', 'better', 'some', 'No', 'Yes', NULL, 2, '', '2021-12-17 09:31:20', '2021-12-20 00:46:13'),
(62, 51, 'coding.61bf507e29a1e3.30618099.jpg', 'Monitor 1v2', 'Monitor description v2', '4', 'Not Sure', 'better', 'better', 'Not Sure', 'No', NULL, 0, '|61', '2021-12-19 23:32:14', '2021-12-19 23:32:51'),
(63, 51, 'coding.61bf5420215396.79583901.jpg', 'Monitor 3', 'Monitor desciption 45', '3', 'Not Sure', 'some', 'some', 'No', 'Yes', NULL, 0, '|61', '2021-12-19 23:47:44', '2021-12-19 23:48:38'),
(64, 51, 'coding.61bf62ff8b2ff2.77029896.jpg', 'Monitor 5', 'MOnitor session', '3', 'No', 'better', 'worse', 'Yes', 'Yes', NULL, 0, '', '2021-12-20 00:51:11', '2021-12-20 00:52:18'),
(65, 51, 'Happy_icon.61e8d862654db3.41682815.png', 'test image reduce2', 'etst image reduce2', '3', 'Not Sure', 'better', 'better', 'Not Sure', 'Yes', NULL, 2, '', '2022-01-20 11:34:58', '2022-01-29 12:52:36'),
(66, 57, 'cute excited boy.61e8d8ef2bc2a5.19349660.png', 'test image 3', 'deded', '3', 'No', 'some', 'some', 'No', 'Yes', NULL, 2, '', '2022-01-20 11:37:19', '2022-01-20 11:37:19'),
(67, 57, 'customer support.61e8d922836655.93812524.jpg', 'sdsd', 'sdsd', '3', 'Not Sure', 'better', 'better', 'No', 'Yes', NULL, 2, '', '2022-01-20 11:38:10', '2022-01-20 11:38:10'),
(68, 54, 'climb.61fcfdd4c46eb4.67892644.png', 'viva 13', 'viva 223', '3', 'No', 'better', 'better', 'No', 'Yes', NULL, 2, '', '2022-02-04 18:20:04', '2022-02-04 18:20:18'),
(69, 54, 'crowd.61fcfe9c9872f2.61567112.png', 'Viva 2', 'Viva test 12345', '3', 'No', 'some', 'better', 'No', 'Yes', NULL, 0, '', '2022-02-04 18:23:24', '2022-02-04 18:23:46');

-- --------------------------------------------------------

--
-- Table structure for table `user_master`
--

CREATE TABLE `user_master` (
  `m_id` int(11) NOT NULL,
  `m_name` longtext NOT NULL,
  `m_identity` longtext DEFAULT NULL,
  `m_regis_id` varchar(255) DEFAULT NULL,
  `m_gender` varchar(45) DEFAULT NULL,
  `m_type` varchar(45) NOT NULL COMMENT 'p: patient\\nd: doctor\\ndop: department of pathology\\n',
  `password` longtext NOT NULL,
  `flag` int(11) NOT NULL DEFAULT 1 COMMENT '0: do not show (meaning delete from user perspective)\\\\n1: show',
  `email` longtext NOT NULL,
  `phone` longtext NOT NULL,
  `doctor_inCharge` int(11) NOT NULL DEFAULT 0,
  `m_dob` date DEFAULT NULL,
  `m_age` varchar(255) DEFAULT NULL,
  `m_address` varchar(255) DEFAULT NULL,
  `m_city` varchar(255) DEFAULT NULL,
  `m_state` varchar(255) DEFAULT NULL,
  `m_zipcode` varchar(255) DEFAULT NULL,
  `token` longtext NOT NULL,
  `tokenExpire` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_master`
--

INSERT INTO `user_master` (`m_id`, `m_name`, `m_identity`, `m_regis_id`, `m_gender`, `m_type`, `password`, `flag`, `email`, `phone`, `doctor_inCharge`, `m_dob`, `m_age`, `m_address`, `m_city`, `m_state`, `m_zipcode`, `token`, `tokenExpire`, `created_at`, `updated_at`) VALUES
(50, 'admin', '990407125901', '123', NULL, 'A', '$2y$10$HlW1HUDpqCp.2wNXvs3u/eUN369ld/pgGXh.5OQKEo1dBQjpVi.4e', 1, 'admin@gmail.com', '0142772957', 0, NULL, NULL, '', '', '', '', 'f8b4783a585cffae610301abbd46418c0803473d', '2021-12-31 09:18:13', '2021-06-16 01:13:30', '2021-11-28 03:25:46'),
(51, 'patient_monitor', '990407125901', '12345', 'male', 'P', '$2y$10$HBMXdKPeqQ1LMTpKEmmVf.DAQx9sfL2xqj0/qeI4U5cUiMBlPbgTC', 1, 'elwinvon.ev@gmail.com', '014277234', 61, '1999-12-09', NULL, '', '', '', '', '', '0000-00-00 00:00:00', '2021-06-16 01:13:30', '2021-12-08 23:37:50'),
(52, 'doctor1234', '990407125940', '345', 'female', 'D', '$2y$10$gtJHMoRKWI2TWxCxPlwimev6coaNNrv0YQ9wY/VmDyNf9Yk9Rti6m', 1, 'elwinvond.ev@gmail.com', '0142772956', 0, '1993-12-15', NULL, '', '', '', '', '', NULL, '2021-06-16 01:13:30', '2022-02-04 18:03:30'),
(53, 'doctor2', '990407125901', '7878', NULL, 'D', '$2y$10$gtJHMoRKWI2TWxCxPlwimev6coaNNrv0YQ9wY/VmDyNf9Yk9Rti6m', 1, 'elwinvond1.ev@gmail.com', '0142772957', 0, NULL, NULL, '', '', '', '', '', NULL, '2021-06-16 01:13:30', '2021-06-16 01:13:30'),
(54, 'patient2233', '990407125901', '12346', 'male', 'P', '$2y$10$gtJHMoRKWI2TWxCxPlwimev6coaNNrv0YQ9wY/VmDyNf9Yk9Rti6m', 1, 'elwinvond2.ev@gmail.com', '01427729574', 53, '2021-12-09', NULL, '1111', 'test 2', 'sdd', '44', '', NULL, '2021-06-16 01:13:30', '2022-02-04 18:01:55'),
(55, 'admin_233', '990407125901', '9098', NULL, 'A', '$2y$10$gtJHMoRKWI2TWxCxPlwimev6coaNNrv0YQ9wY/VmDyNf9Yk9Rti6m', 1, 'admin2@gmail.com', '0142772944', 0, '1999-01-14', NULL, '', '', '', '', '', '0000-00-00 00:00:00', '2021-06-16 01:13:30', '2021-11-28 03:25:46'),
(56, 'elwin', '990407-12-5901', '2323', 'male', '', '$2y$10$gtJHMoRKWI2TWxCxPlwimev6coaNNrv0YQ9wY/VmDyNf9Yk9Rti6m', 1, ' elwinvoan @gmail.com ', ' 1123123123 ', 0, '0000-00-00', ' 22 ', ' 1234 ', ' asd ', ' Pahang ', ' 44444 ', '', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(57, 'elwin', '12312312', '12347', 'female', 'P', '$2y$10$gtJHMoRKWI2TWxCxPlwimev6coaNNrv0YQ9wY/VmDyNf9Yk9Rti6m', 1, 'elwin@gmail.com', '01432323', 53, '2021-12-23', '12', '123123', '123123', '', '', '', NULL, '2021-12-08 00:00:00', '2021-12-08 00:00:00'),
(58, 'ewewe', '1231234', '12348', 'male', 'P', '$2y$10$gtJHMoRKWI2TWxCxPlwimev6coaNNrv0YQ9wY/VmDyNf9Yk9Rti6m', 1, 'elwinvoww@gmail.com', '12312314', 52, '2021-12-15', '22', 'qwerrt', '1234', 'Selangor', '12345', '', NULL, '2021-12-08 19:05:25', '2021-12-08 19:05:25'),
(59, 'Elwin Von', '990407-125901', '12349', 'male', 'P', '$2y$10$gtJHMoRKWI2TWxCxPlwimev6coaNNrv0YQ9wY/VmDyNf9Yk9Rti6m', 1, 'elwinvonaa@gmail.com', '0143772957', 52, '1999-04-07', '22', '1234 mainstreet', 'kota kinabalu', 'Melaka', '5000', '', NULL, '2021-12-08 20:44:10', '2021-12-08 20:44:10'),
(60, 'elwinvon', '990407-12-5901', '12350', 'male', 'P', '$2y$10$gtJHMoRKWI2TWxCxPlwimev6coaNNrv0YQ9wY/VmDyNf9Yk9Rti6m', 1, 'elwinvonaa@gmail.com', '0143772957', 61, '1999-04-07', '22', '1234', '12312', 'Pulau Pinang', '3333333333333', '', NULL, '2021-12-08 20:49:27', '2021-12-08 23:32:30'),
(61, 'doctor3monitor', '990407125921', '12399', 'male', 'D', '$2y$10$2UG02wfEZ0AMEUj.AxbmS.Swd0AMIQMRYPIwVzQpoHFuAeK8Rgh3y', 1, 'elwinvond22.ev@gmail.com', '0142772957', 0, '2007-11-14', NULL, '', '', '', '', '', NULL, '2021-06-16 01:13:30', '2021-12-19 23:15:17'),
(62, 'admin2', NULL, '2324', NULL, 'A', '$2y$10$gtJHMoRKWI2TWxCxPlwimev6coaNNrv0YQ9wY/VmDyNf9Yk9Rti6m', 1, 'admin23@gmail.com', '', 0, NULL, NULL, '', '', '', '', '', NULL, '2021-12-09 11:25:38', '2021-12-09 11:25:38'),
(63, 'research123', '', '2323', 'female', 'R', '$2y$10$IuJzRemjU0tqR5/pSGR1V.b255cXE0ENdlDzE1JpG9CqdgJA2kmbm', 1, 'research123@gmail.com', '0143772956', 0, '2018-11-15', NULL, 'test', '1', '3', '2', '', NULL, '2021-12-09 11:25:38', '2022-01-28 16:06:26'),
(77, 'Elwin Von', '990407-12-5901', '12351', 'male', 'P', '$2y$10$gtJHMoRKWI2TWxCxPlwimev6coaNNrv0YQ9wY/VmDyNf9Yk9Rti6m', 1, 'elwinvona@gmail.com', '0143772957', 61, '2000-07-11', '21', '', '', '', '', '', NULL, '2021-12-16 23:05:35', '2021-12-16 23:05:35'),
(79, 'Elwin Von', '990407-12-5901', '12352', 'male', 'P', '$2y$10$gtJHMoRKWI2TWxCxPlwimev6coaNNrv0YQ9wY/VmDyNf9Yk9Rti6m', 0, 'elwinvonaass@gmail.com', '0143772957', 61, '2001-03-08', '20', '', '', '', '', '', NULL, '2021-12-17 07:46:41', '2021-12-17 07:46:41'),
(81, 'admin_monitoring12', NULL, '2323', NULL, 'A', '$2y$10$gtJHMoRKWI2TWxCxPlwimev6coaNNrv0YQ9wY/VmDyNf9Yk9Rti6m', 1, 'admin_monitoring@gmail.com', '0143772957', 0, '2022-01-07', NULL, NULL, NULL, NULL, NULL, '', NULL, '2021-12-17 11:00:52', '2021-12-17 11:00:52'),
(94, 'elwinadmin', '990407-12-5901', '3436', 'male', 'D', '$2y$10$gtJHMoRKWI2TWxCxPlwimev6coaNNrv0YQ9wY/VmDyNf9Yk9Rti6m', 1, 'elwinvon.ev6555@gmail.com', '0143772957', 0, '2005-02-10', '16', '', '', '', '', '', NULL, '2021-12-19 14:03:07', '2021-12-19 14:03:07'),
(95, 'doctor_monitor', '990407-12-5901', '3344', 'male', 'D', '$2y$10$gtJHMoRKWI2TWxCxPlwimev6coaNNrv0YQ9wY/VmDyNf9Yk9Rti6m', 1, 'elwinvonaamonitor@gmail.com', '0143772957', 0, '2000-02-08', '21', '', '', '', '', '', NULL, '2021-12-19 14:27:08', '2021-12-19 14:27:08'),
(96, 'doctor_monitor', '990407-12-5901', '999', 'female', 'D', '$2y$10$gtJHMoRKWI2TWxCxPlwimev6coaNNrv0YQ9wY/VmDyNf9Yk9Rti6m', 1, 'elwinvonaamonitor22@gmail.com', '0143772957', 0, '2000-06-14', '21', '', '', '', '', '', NULL, '2021-12-19 22:47:04', '2021-12-19 22:47:04'),
(97, 'doctor_monitor', '990407-12-5901', '6666', 'male', 'D', '$2y$10$gtJHMoRKWI2TWxCxPlwimev6coaNNrv0YQ9wY/VmDyNf9Yk9Rti6m', 1, 'elwinvon.ev655555@gmail.com', '0143772957', 0, '2000-01-10', '21', '', '', '', '', '', NULL, '2021-12-19 22:57:47', '2021-12-19 22:57:47'),
(98, 'doctor_monitor 3', '990407-12-5901', '7777', 'female', 'D', '$2y$10$gtJHMoRKWI2TWxCxPlwimev6coaNNrv0YQ9wY/VmDyNf9Yk9Rti6m', 1, 'elswin@gmail.com', '0143772957', 0, '2001-06-21', '20', '', '', '', '', '', NULL, '2021-12-19 23:17:33', '2021-12-19 23:17:33'),
(99, 'Patient Monitoring 2', '990407-12-5901', '1234562', 'male', 'P', '$2y$10$gtJHMoRKWI2TWxCxPlwimev6coaNNrv0YQ9wY/VmDyNf9Yk9Rti6m', 1, 'patient12345@gmail.com', '0143772957', 0, '2000-06-20', '21', '', '', '', '', '', NULL, '2021-12-19 23:20:16', '2021-12-19 23:20:16'),
(135, 'admintest12', NULL, NULL, NULL, 'A', '$2y$10$8Fx4UUPQlKRVkHOeUhpfuun7OkRJGZPB3XBiq5Z2PLnoXGERLgBqq', 1, 'admintest12@gmail.com', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '2022-01-31 15:18:41', '2022-01-31 15:18:41'),
(136, 'Research Team 2343', '990407125901', 'rt1234', 'male', 'R', '$2y$10$kP16litpQvClmY.80VZtmOd8KkzLkSCMPwd/deRPXVmLYBAURuDjC', 1, 'research1234@gmail.com', '+601437729577', 0, '2017-07-04', '5', 'LOT 102 TAMAN RICHDAR', 'wwwwww', 'Sabah', '88450', '', NULL, '2022-01-31 15:32:21', '2022-01-31 15:32:21'),
(137, 'rearchteam123', '990407125901', 'rt1234', 'male', 'R', '$2y$10$hjEiSi1bT5wtuoNe1epiU.zaI82vfciGH94yhdHag6iXlcnJ30XFO', 1, 'elwinvon.ev0407333@gmail.com', '0143772957', 0, '2017-05-08', '5', 'NO.295, JLN17/6, SEKSYEN 17, 46400 PETALING JAYA SELANGOR', 'sdds', 'Kuala Lumpur', '46400', '', NULL, '2022-01-31 15:39:00', '2022-01-31 15:39:00'),
(138, 'viva 1', '9999111111111', 'viva1234', 'male', 'P', '$2y$10$Otb/n/vV2vyvVbtJPBb8SOU8ZamIjZpFniev/6EpZ4Y7xEnwt5k7u', 1, 'elwinvon.ev040755555@gmail.com', '0143772957', 0, '1997-06-25', '25', 'NO.295, JLN17/6, SEKSYEN 17, 46400 PETALING JAYA SELANGOR', '', '', '46400', '', NULL, '2022-02-04 18:04:40', '2022-02-04 18:04:40'),
(139, 'Ada\'m Yong', '990407125901', 'aa1234', 'male', 'P', '$2y$10$o6AKZx0F7ra6nV6aOqrziOZwiM6MHgf7aUnJsnCIGykNKRfj/H5cC', 1, 'adamp@gmail.com', '60143772957', 0, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '2022-02-04 18:05:58', '2022-02-04 18:05:58'),
(140, 'Elwin Von', '990407125902', 'aa1235', 'male', 'A', '$2y$10$d/195HDBrGhsvdEcchw8eeRjYL/xi7kHWe0UYMXfwIGRKcvX3IXYW', 1, 'elwina@gmail.com', '60143772958', 0, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '2022-02-04 18:05:58', '2022-02-04 18:05:58');

-- --------------------------------------------------------

--
-- Table structure for table `wound_image_feedback`
--

CREATE TABLE `wound_image_feedback` (
  `f_id` int(11) NOT NULL,
  `progress_entry_id` int(11) NOT NULL,
  `feedback_text` varchar(255) NOT NULL,
  `doctor_inCharge` int(11) NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT current_timestamp(),
  `flag` int(1) NOT NULL DEFAULT 1,
  `view` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wound_image_feedback`
--

INSERT INTO `wound_image_feedback` (`f_id`, `progress_entry_id`, `feedback_text`, `doctor_inCharge`, `dateCreated`, `flag`, `view`) VALUES
(3, 52, 'Look\'s good2 2', 62, '2021-11-29 08:26:29', 1, 1),
(11, 54, 'Check this out', 61, '2021-12-16 02:52:13', 1, 1),
(12, 52, 'New feedback', 61, '2021-12-19 17:11:12', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`a_id`);

--
-- Indexes for table `progress_book_entry`
--
ALTER TABLE `progress_book_entry`
  ADD PRIMARY KEY (`entryID`);

--
-- Indexes for table `user_master`
--
ALTER TABLE `user_master`
  ADD PRIMARY KEY (`m_id`);

--
-- Indexes for table `wound_image_feedback`
--
ALTER TABLE `wound_image_feedback`
  ADD PRIMARY KEY (`f_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `progress_book_entry`
--
ALTER TABLE `progress_book_entry`
  MODIFY `entryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `user_master`
--
ALTER TABLE `user_master`
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- AUTO_INCREMENT for table `wound_image_feedback`
--
ALTER TABLE `wound_image_feedback`
  MODIFY `f_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
