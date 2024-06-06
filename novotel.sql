-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 24, 2024 at 06:57 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `novotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `room_id` int DEFAULT NULL,
  `check_in_date` datetime DEFAULT NULL,
  `check_out_date` datetime DEFAULT NULL,
  `adult_count` int DEFAULT '0',
  `child_count` int DEFAULT '0',
  `room_count` int DEFAULT '0',
  `total_price` float DEFAULT '0',
  `reserve_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `reserve_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int NOT NULL,
  `roomname` varchar(255) NOT NULL DEFAULT '0',
  `price` float NOT NULL,
  `count` int NOT NULL DEFAULT '0',
  `photo` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `roomname`, `price`, `count`, `photo`, `description`) VALUES
(1, 'Superior', 4987.5, 10, '66251dde8f6cc9.52273230.jpg', 'Choose a Superior Room for your holiday in Quezon City. With a bright modern décor, a host of special features and space for up to two adults and two children (under 16), these rooms are designed for your comfort and convenience.<br />\r\n<br />\r\nThe walls’ cheerful colors and geometric patterns set off the crisp white sheets on your Live N Dream bed. Dive in and relax, or get some work done at the ergonomic desk and chair. After making a fresh cup of tea or coffee, put your feet up on the chaise lounge by the window and admire the view of Quezon City or the hotel pool and garden.<br />\r\n<br />\r\nAll rooms come with complimentary WiFi and a modern bathroom with motorized privacy curtains.'),
(2, 'Deluxe', 5462.5, 10, '66267fefd5ce57.19637803.jpg', 'Families, couples and solo travelers find everything they need – and so much more – in a Novotel Deluxe Room. Natural daylight floods this welcoming space. In the evening, let the glittering skyline mesmerize you as you reach higher levels of relaxation. Work at the spacious desk, unwind in the cozy chaise longue or simply take in your surroundings from the comfortable vantage point of your Live N Dream bed. Whether you’re in Quezon City for business or leisure, Novotel is your home.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  `phone` varchar(255) NOT NULL DEFAULT '',
  `usertype` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `phone`, `usertype`) VALUES
(1, 'admin', 'admin@group6.com', '$2y$10$2Ze1d.8QiCk8bfGQl6EK4eBCmYWBGHGTR/pp2FXG/AJsjXlfdKppK', '09123456789', 0),
(2, 'Juan Dela Cruz', 'juandelacruz@sample.com', '$2y$10$6CQ2YfWEsd6Nn3FWLE.L..pVeWRlso.6eAno18bcHra1R.9aNbdlK', '09123456789', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
