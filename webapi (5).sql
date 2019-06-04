-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2019 at 07:07 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webapi`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(6) NOT NULL,
  `username` varchar(10) NOT NULL,
  `pass_w` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `pass_w`) VALUES
(123458, 'pam', '25f9e794323b453885f5181f1b624d0b'),
(123459, 'noon', '25f9e794323b453885f5181f1b624d0b'),
(123460, 'kao', 'e10adc3949ba59abbe56e057f20f883e');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `emp_id` int(6) NOT NULL,
  `username` varchar(10) NOT NULL,
  `pass_w` varchar(40) NOT NULL,
  `full_name` varchar(15) DEFAULT NULL,
  `location_id` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `location_id` int(6) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(40) NOT NULL,
  `working_site` varchar(10) NOT NULL,
  `api_port` int(5) DEFAULT NULL,
  `ip_address` varchar(15) NOT NULL,
  `cus_id` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`location_id`, `username`, `password`, `working_site`, `api_port`, `ip_address`, `cus_id`) VALUES
(1, 'korkit', '12345', 'front', 9000, '172.20.10.5', 551168);

-- --------------------------------------------------------

--
-- Table structure for table `orderpd`
--

CREATE TABLE `orderpd` (
  `order_id` int(6) NOT NULL,
  `total_cash` int(10) NOT NULL,
  `appointment` date NOT NULL,
  `product_id` int(6) NOT NULL,
  `cus_id` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orderpd`
--

INSERT INTO `orderpd` (`order_id`, `total_cash`, `appointment`, `product_id`, `cus_id`) VALUES
(2, 1000, '2019-04-17', 2, 551168),
(3, 500, '2019-04-18', 1, 551169),
(4, 500, '2019-04-17', 1, 551170),
(5, 1000, '2019-04-17', 2, 551189),
(6, 1000, '2019-04-16', 2, 551190),
(7, 500, '2019-04-16', 1, 551188),
(19, 500, '2019-05-22', 1, 551223);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(6) NOT NULL,
  `payment_at` varchar(15) NOT NULL,
  `transfer_date` date NOT NULL,
  `amount` int(15) NOT NULL,
  `slip_name` varchar(40) NOT NULL,
  `paid` int(2) NOT NULL,
  `order_id` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `payment_at`, `transfer_date`, `amount`, `slip_name`, `paid`, `order_id`) VALUES
(2, 'กรุงไทย', '2019-04-14', 1000, '2', 1, 2),
(3, 'กรุงไทย', '2019-04-16', 500, '3', 0, 3),
(4, 'กรุงไทย', '2019-04-17', 500, 'chaba-1234.jpg', 0, 4),
(5, 'กรุงไทย', '2019-04-16', 500, 'somdee-4450.jpg', 0, 5),
(6, 'กรุงไทย', '2019-04-18', 500, 'vichaichan-5560.jpg', 1, 6),
(7, 'กรุงไทย', '2019-04-17', 1000, '2', 1, 7),
(9, '?????-?????????', '2019-05-19', 500, 'korkit-6022.jpg', 1, 19);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(6) NOT NULL,
  `product_name` varchar(15) NOT NULL,
  `price` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `price`) VALUES
(1, 'Packet A', 500),
(2, 'Packet B', 1000);

-- --------------------------------------------------------

--
-- Table structure for table `siteadmin`
--

CREATE TABLE `siteadmin` (
  `cus_id` int(6) NOT NULL,
  `username` varchar(10) NOT NULL,
  `pass_w` varchar(40) NOT NULL,
  `add_ress` varchar(20) DEFAULT NULL,
  `work_phone` varchar(10) NOT NULL,
  `e_mail` varchar(40) DEFAULT NULL,
  `site_name` varchar(10) NOT NULL,
  `full_name` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `siteadmin`
--

INSERT INTO `siteadmin` (`cus_id`, `username`, `pass_w`, `add_ress`, `work_phone`, `e_mail`, `site_name`, `full_name`) VALUES
(551168, 'jam', '25f9e794323b453885f5181f1b624d0b', NULL, '950244237', NULL, 'stun', NULL),
(551169, 'chaiyax', '827ccb0eea8a706c4c34a16891f84e7b', NULL, '950244255', NULL, 'bangkok', NULL),
(551170, 'chabax', '25f9e794323b453885f5181f1b624d0b', NULL, '950244239', NULL, 'trang', NULL),
(551188, 'vichaimeex', '25f9e794323b453885f5181f1b624d0b', '15/6', '940255511', 'vichaimee_s@hot', 'bangkok', 'vichaimee somma'),
(551189, 'somdeex', '25f9e794323b453885f5181f1b624d0b', '15/6', '950244789', 'somdee@gmail.co', 'bangkok', 'somdee mechai'),
(551190, 'vichaichan', '25f9e794323b453885f5181f1b624d0b', '15/6', '940255562', 'vichaiyut_s@hot', 'bangkok', 'vichai sommad'),
(551223, 'jaideex', '827ccb0eea8a706c4c34a16891f84e7b', '15/6', '0244234', 'kokig_kao@hotma', 'trang', '?????????????');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`emp_id`),
  ADD KEY `location_id` (`location_id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`location_id`),
  ADD KEY `cus_id` (`cus_id`);

--
-- Indexes for table `orderpd`
--
ALTER TABLE `orderpd`
  ADD PRIMARY KEY (`order_id`),
  ADD UNIQUE KEY `cus_id` (`cus_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `siteadmin`
--
ALTER TABLE `siteadmin`
  ADD PRIMARY KEY (`cus_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123461;
--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `emp_id` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `location_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `orderpd`
--
ALTER TABLE `orderpd`
  MODIFY `order_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `siteadmin`
--
ALTER TABLE `siteadmin`
  MODIFY `cus_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=551224;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `location` (`location_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `location`
--
ALTER TABLE `location`
  ADD CONSTRAINT `location_ibfk_1` FOREIGN KEY (`cus_id`) REFERENCES `siteadmin` (`cus_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orderpd`
--
ALTER TABLE `orderpd`
  ADD CONSTRAINT `orderpd_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orderpd_ibfk_2` FOREIGN KEY (`cus_id`) REFERENCES `siteadmin` (`cus_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orderpd` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
