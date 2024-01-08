-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3311
-- Generation Time: Jan 08, 2024 at 06:20 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restaurantsystems`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `acc_id` int(11) NOT NULL,
  `acc_username` varchar(25) NOT NULL,
  `acc_password` varchar(25) NOT NULL,
  `acc_name` varchar(25) NOT NULL,
  `acc_lname` varchar(25) NOT NULL,
  `acc_img` text DEFAULT NULL,
  `acc_address` text NOT NULL,
  `acc_phone` varchar(10) NOT NULL,
  `date_create` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`acc_id`, `acc_username`, `acc_password`, `acc_name`, `acc_lname`, `acc_img`, `acc_address`, `acc_phone`, `date_create`) VALUES
(1, 'auntapza', '12345', 'Chatdanai', 'Khuntong', 'http://localhost/api/restaurantSystems/img/370226060_313813574932919_3611978131775752438_n.png', 'ดาวอังคาร', '1023409', '2024-01-08 21:55:11');

-- --------------------------------------------------------

--
-- Table structure for table `account_access`
--

CREATE TABLE `account_access` (
  `acc_id` int(11) NOT NULL,
  `access` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='0 = user, 1 = cashier, 2 = admin';

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `food_id` int(11) NOT NULL,
  `food_name` varchar(25) NOT NULL,
  `food_price` int(6) NOT NULL,
  `food_img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orderr`
--

CREATE TABLE `orderr` (
  `order_id` int(11) NOT NULL,
  `order_date` datetime NOT NULL,
  `acc_id` int(11) NOT NULL,
  `tb_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `order_id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `restable`
--

CREATE TABLE `restable` (
  `tb_id` int(11) NOT NULL,
  `tb_status` tinyint(4) NOT NULL,
  `tb_people` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='0 = empty, 1 = have reserve, 2 = unvalable';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`acc_id`);

--
-- Indexes for table `account_access`
--
ALTER TABLE `account_access`
  ADD PRIMARY KEY (`acc_id`),
  ADD KEY `acc_id` (`acc_id`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`food_id`);

--
-- Indexes for table `orderr`
--
ALTER TABLE `orderr`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `acc_id` (`acc_id`,`tb_id`),
  ADD KEY `tb_id` (`tb_id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`order_id`,`food_id`),
  ADD KEY `order_id` (`order_id`,`food_id`),
  ADD KEY `food_id` (`food_id`);

--
-- Indexes for table `restable`
--
ALTER TABLE `restable`
  ADD PRIMARY KEY (`tb_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `acc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `food_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orderr`
--
ALTER TABLE `orderr`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `restable`
--
ALTER TABLE `restable`
  MODIFY `tb_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account_access`
--
ALTER TABLE `account_access`
  ADD CONSTRAINT `account_access_ibfk_1` FOREIGN KEY (`acc_id`) REFERENCES `account` (`acc_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orderr`
--
ALTER TABLE `orderr`
  ADD CONSTRAINT `orderr_ibfk_1` FOREIGN KEY (`tb_id`) REFERENCES `restable` (`tb_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orderr_ibfk_2` FOREIGN KEY (`acc_id`) REFERENCES `account` (`acc_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `order_detail_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orderr` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_detail_ibfk_2` FOREIGN KEY (`food_id`) REFERENCES `food` (`food_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
