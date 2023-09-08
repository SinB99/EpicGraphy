-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 08, 2023 at 11:17 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fyp`
--

-- --------------------------------------------------------

--
-- Table structure for table `artwork`
--

CREATE TABLE `artwork` (
  `artworkID` int(8) NOT NULL,
  `photographerID` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `artwork_image` longblob NOT NULL,
  `date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `artwork`
--

INSERT INTO `artwork` (`artworkID`, `photographerID`, `artwork_image`, `date_time`) VALUES
(33, 'syafiq', 0x454153544d414e2035323037202837292e4a5047, '0000-00-00 00:00:00'),
(38, 'syafiq', 0x4b4f44414b204742323030202838292e4a5047, '0000-00-00 00:00:00'),
(46, 'syafiq', 0x454153544d414e203532303720283238292e4a5047, '0000-00-00 00:00:00'),
(48, 'aini', 0x454153544d414e203532303720283334292e4a5047, '0000-00-00 00:00:00'),
(49, 'aini', 0x454153544d414e203532303720283332292e4a5047, '0000-00-00 00:00:00'),
(50, 'aini', 0x4b4f44414b204742323030202837292e4a5047, '0000-00-00 00:00:00'),
(51, 'aini', 0x454153544d414e203532313920283336292e6a7067, '0000-00-00 00:00:00'),
(52, 'aini', 0x454153544d414e2035323139202834292e6a7067, '0000-00-00 00:00:00'),
(57, 'syahmi', 0x454153544d414e203532303720283335292e4a5047, '0000-00-00 00:00:00'),
(58, 'syahmi', 0x454153544d414e203532303720283231292e4a5047, '0000-00-00 00:00:00'),
(60, 'syafiq', 0x454153544d414e203532313920283336292e6a7067, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `message_id` int(11) NOT NULL,
  `sender_id` varchar(20) NOT NULL,
  `receiver_id` varchar(20) NOT NULL,
  `message` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_read` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`message_id`, `sender_id`, `receiver_id`, `message`, `timestamp`, `is_read`) VALUES
(28, 'syafiq', 'aini', 'hello', '2023-06-14 22:01:16', 0),
(29, 'aini', 'syafiq', 'Hello back', '2023-06-14 22:01:40', 0),
(30, 'syafiq', 'aini', 'Can I help miss?', '2023-06-26 20:57:40', 0),
(31, 'syafiq', 'aini', 'Yes', '2023-06-28 16:25:54', 0),
(32, 'aini', 'syafiq', 'Hello', '2023-07-02 19:25:33', 0),
(39, 'alif', 'syafiq', 'Hello', '2023-07-04 20:00:34', 0),
(40, 'syafiq', 'alif', 'Test', '2023-07-04 20:25:22', 0),
(41, 'syafiq', 'alif', 'Test data', '2023-07-05 09:24:18', 0);

-- --------------------------------------------------------

--
-- Table structure for table `photographer`
--

CREATE TABLE `photographer` (
  `photographerID` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phonenumber` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_picture` blob NOT NULL,
  `registration_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `photographer`
--

INSERT INTO `photographer` (`photographerID`, `name`, `email`, `phonenumber`, `address`, `password`, `profile_picture`, `registration_date`) VALUES
('aini', 'Siti Nur Aini', 'aini@gmail.com', '0139587432', 'Muar, Johor', '123', 0x70726f66696c655f70696374757265732f3230333738313036305f343136363836323236333339323534325f343534363332363634373638383639313234305f6e2e6a7067, '2023-06-13 20:47:02'),
('alif', 'Alif Aiman', 'alif@gmail.com', '0179542365', 'Kuantan, Pahang', '123', 0x70726f66696c655f70696374757265732f4b4f44414b20474232303020283334292e4a5047, '2023-07-05 00:54:37'),
('syafiq', 'Muhammad Syafiq Bin Romli', 'syafiq@gmail.com', '01126431464', 'Manjung Perak', '123', 0x70726f66696c655f70696374757265732f70617373706f72742e6a7067, '2023-06-13 20:43:45'),
('syahmi', 'Muhammad Syahmi', 'syahmi@gmail.com', '0126804504', 'Manjung, Perak', '123', 0x70726f66696c655f70696374757265732f70617373706f72742e6a7067, '2023-06-13 01:01:42');

-- --------------------------------------------------------

--
-- Table structure for table `serviceadvertizing`
--

CREATE TABLE `serviceadvertizing` (
  `serviceID` int(8) NOT NULL,
  `photographerID` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `detail` varchar(10000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `serviceadvertizing`
--

INSERT INTO `serviceadvertizing` (`serviceID`, `photographerID`, `service`, `detail`, `location`, `price`, `date_time`) VALUES
(14, 'syafiq', 'Wedding', 'Wedding Ceremony', 'Perak', 800.00, '2023-06-07 10:44:37'),
(15, 'aini', 'Graduation', 'Graduation Day Celebration', 'Kuala Lumpur', 600.00, '2023-06-07 10:45:29'),
(16, 'syafiq', 'Event', 'Sport Event', 'Pahang', 500.00, '2023-06-07 16:32:33'),
(17, 'syafiq', 'Birthday Party', 'Birtday party photography service.', 'Kuala Lumpur', 1000.00, '2023-06-07 16:37:14'),
(18, 'syahmi', 'Wedding', 'TEST SYAHMI', 'Perak', 123.00, '2023-06-13 20:09:34'),
(19, 'syafiq', 'Wedding', 'TEST SYAFIQ', 'Sarawak', 123.00, '2023-06-13 20:34:17'),
(20, 'syafiq', 'Graduation', 'Photography service for graduation ceremony', 'Kuala Lumpur', 700.00, '2023-06-15 05:56:44'),
(21, 'syafiq', 'Event', 'Any Ocassion', 'Kuala Lumpur', 500.00, '2023-07-05 17:04:37');

-- --------------------------------------------------------

--
-- Table structure for table `service_requests`
--

CREATE TABLE `service_requests` (
  `requestID` int(8) NOT NULL,
  `photographerID` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `serviceID` int(18) NOT NULL,
  `userID` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` int(20) NOT NULL,
  `event_date` date NOT NULL,
  `event_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_requests`
--

INSERT INTO `service_requests` (`requestID`, `photographerID`, `serviceID`, `userID`, `name`, `email`, `phone`, `event_date`, `event_type`, `location`, `message`, `status`, `created_at`) VALUES
(49, 'syafiq', 14, '', 'Alif Aiman', 'alif@gmail.com', 1126431464, '2023-06-29', 'Test', 'Sabah', 'Test', 'completed', '2023-06-07 03:39:46'),
(50, 'syafiq', 17, '', 'Alif Aiman', 'alif@gmail.com', 19873522, '2023-06-23', 'Sport', 'Negeri Sembilan', 'Test', 'completed', '2023-06-07 08:56:26'),
(51, 'syahmi', 19, '', 'Syahmi', 'syahmi@gmail.com', 126804504, '2023-06-30', 'Pre Weeding', 'Melaka', 'TEST SYAHMI', 'completed', '2023-06-13 19:06:52'),
(52, 'syafiq', 18, '', 'Muhammad Syafiq', 'muhammadsyafiq6@gmail.com', 1126431464, '2023-06-22', 'Engagement', 'Pahang', 'TEST SYAFIQ', 'completed', '2023-06-13 20:31:00'),
(53, 'syahmi', 18, '', 'Muhammad Syafiq', 'muhammadsyafiq6@gmail.com', 1126431464, '2023-06-29', 'Event', 'Kelantan', 'Test 3.06', 'completed', '2023-06-13 19:06:57'),
(54, 'syafiq', 20, '', 'Siti Nur Aini', 'aini@gmail.com', 123654789, '2023-06-28', 'Graduation', 'Kuala Lumpur', 'TEST', 'completed', '2023-06-14 22:00:29'),
(55, 'syafiq', 20, '', 'Alif Aiman', 'alif@gmail.com', 136987452, '2023-08-02', 'Event', 'Kuala Lumpur', 'Car Meet', 'completed', '2023-07-04 20:14:40'),
(56, 'syafiq', 20, '', 'Mior Muaz', 'muaz@gmail.com', 198746512, '2023-07-20', 'Wedding', 'Perak', 'Looking forward to discussing further details and potentially collaborating with you.', 'completed', '2023-07-05 05:33:49'),
(57, 'syafiq', 21, '', 'Alif', 'alif@gmail.com', 14698746, '2023-07-07', 'Engagement', 'Kelantan', 'Test data', 'completed', '2023-07-05 09:22:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artwork`
--
ALTER TABLE `artwork`
  ADD PRIMARY KEY (`artworkID`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `photographer`
--
ALTER TABLE `photographer`
  ADD PRIMARY KEY (`photographerID`);

--
-- Indexes for table `serviceadvertizing`
--
ALTER TABLE `serviceadvertizing`
  ADD PRIMARY KEY (`serviceID`);

--
-- Indexes for table `service_requests`
--
ALTER TABLE `service_requests`
  ADD PRIMARY KEY (`requestID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `artwork`
--
ALTER TABLE `artwork`
  MODIFY `artworkID` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `serviceadvertizing`
--
ALTER TABLE `serviceadvertizing`
  MODIFY `serviceID` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `service_requests`
--
ALTER TABLE `service_requests`
  MODIFY `requestID` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
