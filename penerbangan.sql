-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2025 at 03:38 AM
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
-- Database: `penerbangan`
--

-- --------------------------------------------------------

--
-- Table structure for table `atc_users`
--

CREATE TABLE `atc_users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `shift` enum('morning','afternoon','night') DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `atc_users`
--

INSERT INTO `atc_users` (`id`, `username`, `password`, `name`, `shift`, `created_at`) VALUES
(1, 'akmal7', 'akmal1234', 'akmal', 'morning', '2025-06-12 23:43:14'),
(2, 'akumaru', 'akumaru1234', 'akmalu', 'afternoon', '2025-06-17 21:31:01');

-- --------------------------------------------------------

--
-- Table structure for table `flights`
--

CREATE TABLE `flights` (
  `id` int(11) NOT NULL,
  `plane_id` int(11) NOT NULL,
  `runway_id` int(11) NOT NULL,
  `atc_id` int(11) NOT NULL,
  `departure` datetime NOT NULL,
  `arrival` datetime NOT NULL,
  `departure_place` varchar(100) NOT NULL,
  `destination` varchar(100) DEFAULT NULL,
  `status` enum('Scheduled','departed','arrived','cancelled') DEFAULT 'Scheduled'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `flights`
--

INSERT INTO `flights` (`id`, `plane_id`, `runway_id`, `atc_id`, `departure`, `arrival`, `departure_place`, `destination`, `status`) VALUES
(1, 11, 1, 1, '2025-06-13 02:42:40', '2025-06-13 02:42:40', 'Jakarta', 'Chiba', 'Scheduled'),
(4, 11, 1, 1, '2025-06-13 01:04:00', '2025-06-14 13:04:00', 'Changi', 'Kuala Lumpur', 'Scheduled'),
(5, 3, 1, 2, '2025-06-19 21:33:00', '2025-06-20 10:34:00', 'Jogja', 'Madrid', 'Scheduled');

-- --------------------------------------------------------

--
-- Table structure for table `flight_requests`
--

CREATE TABLE `flight_requests` (
  `id` int(11) NOT NULL,
  `plane_id` int(11) NOT NULL,
  `requested_runway_id` int(11) NOT NULL,
  `request_time` datetime DEFAULT current_timestamp(),
  `status` enum('Requested','Accepted','Rejected') DEFAULT 'Requested',
  `response_time` datetime DEFAULT NULL,
  `handled_by` int(11) DEFAULT NULL,
  `departure_place` varchar(100) DEFAULT NULL,
  `destination` varchar(100) DEFAULT NULL,
  `departure_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `flight_requests`
--

INSERT INTO `flight_requests` (`id`, `plane_id`, `requested_runway_id`, `request_time`, `status`, `response_time`, `handled_by`, `departure_place`, `destination`, `departure_date`) VALUES
(12, 3, 1, '2025-06-17 21:22:36', 'Rejected', '2025-06-17 21:28:22', 1, 'Jakarta', 'Chiba', '2025-06-18'),
(13, 11, 1, '2025-06-17 21:29:33', 'Accepted', '2025-06-17 21:29:44', 1, 'Jakarta', 'Chiba', '2025-06-18'),
(14, 3, 3, '2025-06-17 21:31:37', 'Rejected', '2025-06-17 21:31:50', 2, 'Changi', 'Kuala Lumpur', '2025-06-18'),
(15, 3, 3, '2025-06-17 22:03:44', 'Accepted', '2025-06-17 22:04:05', 1, 'Jogja', 'Chiba', '2025-06-18');

-- --------------------------------------------------------

--
-- Table structure for table `pilot_users`
--

CREATE TABLE `pilot_users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `license_number` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pilot_users`
--

INSERT INTO `pilot_users` (`id`, `username`, `password`, `name`, `license_number`, `created_at`) VALUES
(1, 'irham16', 'irham1234', 'irham', '512', '2025-06-12 23:43:55'),
(2, 'hamzey12', 'hamzey1234', 'hamzey', '116', '2025-06-13 06:07:44'),
(3, 'lenta', 'lenta1234', 'hyolenta', '1232', '2025-06-13 13:14:25'),
(4, 'arky', 'arkyster', 'naufal', '4212', '2025-06-13 13:14:57');

-- --------------------------------------------------------

--
-- Table structure for table `planes`
--

CREATE TABLE `planes` (
  `id` int(11) NOT NULL,
  `pilot_id` int(11) NOT NULL,
  `plane_code` varchar(20) NOT NULL,
  `model` varchar(50) DEFAULT NULL,
  `airline` varchar(50) DEFAULT NULL,
  `status` enum('ready','maintenance','inactive') DEFAULT 'ready',
  `tail_no` varchar(20) DEFAULT NULL,
  `flight_number` varchar(20) DEFAULT NULL,
  `call_sign` varchar(20) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `range_miles` int(11) DEFAULT NULL,
  `first_flight` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `planes`
--

INSERT INTO `planes` (`id`, `pilot_id`, `plane_code`, `model`, `airline`, `status`, `tail_no`, `flight_number`, `call_sign`, `age`, `range_miles`, `first_flight`) VALUES
(3, 4, '122', 'destroyer', 'indonesianAir', 'ready', '23', '2', 'LoliHunter', 5, 10000, '2025-06-13'),
(11, 1, '512', 'geminijett', 'koreanair', 'ready', '2', '15', 'Rogers', 5, 160203, '2016-06-01');

-- --------------------------------------------------------

--
-- Table structure for table `runways`
--

CREATE TABLE `runways` (
  `id` int(11) NOT NULL,
  `code` varchar(20) NOT NULL,
  `length` int(11) DEFAULT NULL,
  `status` enum('available','occupied','closed') DEFAULT 'available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `runways`
--

INSERT INTO `runways` (`id`, `code`, `length`, `status`) VALUES
(1, '4312', 10, 'available'),
(2, '1212', 10, 'occupied'),
(3, '1112', 10, 'available');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `atc_users`
--
ALTER TABLE `atc_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `flights`
--
ALTER TABLE `flights`
  ADD PRIMARY KEY (`id`),
  ADD KEY `plane_id` (`plane_id`),
  ADD KEY `runway_id` (`runway_id`),
  ADD KEY `atc_id` (`atc_id`);

--
-- Indexes for table `flight_requests`
--
ALTER TABLE `flight_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `plane_id` (`plane_id`),
  ADD KEY `requested_runway_id` (`requested_runway_id`),
  ADD KEY `handled_by` (`handled_by`);

--
-- Indexes for table `pilot_users`
--
ALTER TABLE `pilot_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `planes`
--
ALTER TABLE `planes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `plane_code` (`plane_code`),
  ADD KEY `pilot_id` (`pilot_id`);

--
-- Indexes for table `runways`
--
ALTER TABLE `runways`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `atc_users`
--
ALTER TABLE `atc_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `flights`
--
ALTER TABLE `flights`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `flight_requests`
--
ALTER TABLE `flight_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `pilot_users`
--
ALTER TABLE `pilot_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `planes`
--
ALTER TABLE `planes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `runways`
--
ALTER TABLE `runways`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `flights`
--
ALTER TABLE `flights`
  ADD CONSTRAINT `flights_ibfk_1` FOREIGN KEY (`plane_id`) REFERENCES `planes` (`id`),
  ADD CONSTRAINT `flights_ibfk_2` FOREIGN KEY (`runway_id`) REFERENCES `runways` (`id`),
  ADD CONSTRAINT `flights_ibfk_3` FOREIGN KEY (`atc_id`) REFERENCES `atc_users` (`id`);

--
-- Constraints for table `flight_requests`
--
ALTER TABLE `flight_requests`
  ADD CONSTRAINT `flight_requests_ibfk_1` FOREIGN KEY (`plane_id`) REFERENCES `planes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `flight_requests_ibfk_2` FOREIGN KEY (`requested_runway_id`) REFERENCES `runways` (`id`),
  ADD CONSTRAINT `flight_requests_ibfk_3` FOREIGN KEY (`handled_by`) REFERENCES `atc_users` (`id`);

--
-- Constraints for table `planes`
--
ALTER TABLE `planes`
  ADD CONSTRAINT `planes_ibfk_1` FOREIGN KEY (`pilot_id`) REFERENCES `pilot_users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
