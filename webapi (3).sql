-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2019 at 10:37 AM
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
  `username` varchar(10) CHARACTER SET utf8 NOT NULL,
  `pass_w` varchar(40) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `pass_w`) VALUES
(123458, 'pam', '25f9e794323b453885f5181f1b624d0b'),
(123459, 'noon', '25f9e794323b453885f5181f1b624d0b'),
(123460, 'kao', '827ccb0eea8a706c4c34a16891f84e7b');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `emp_id` int(6) NOT NULL,
  `username` varchar(10) CHARACTER SET utf8 NOT NULL,
  `pass_w` varchar(40) CHARACTER SET utf8 NOT NULL,
  `full_name` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `location_id` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`emp_id`, `username`, `pass_w`, `full_name`, `location_id`) VALUES
(1, 'jo', '827ccb0eea8a706c4c34a16891f84e7b', 'jody mando', 1),
(2, 'zj12345', '00c66aaf5f2c3f49946f15c1ad2ea0d3', 'Zj', 1),
(3, 'kao', 'b4b076f048e58188bedeeda26ffb6c6b', 'à¸à¹ˆà¸­à¸à¸´', 1);

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `location_id` int(6) NOT NULL,
  `username` varchar(10) CHARACTER SET utf8 NOT NULL,
  `password` varchar(40) CHARACTER SET utf8 NOT NULL,
  `working_site` varchar(10) CHARACTER SET utf8 NOT NULL,
  `api_port` int(5) DEFAULT NULL,
  `ip_address` varchar(15) CHARACTER SET utf8 NOT NULL,
  `cus_id` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`location_id`, `username`, `password`, `working_site`, `api_port`, `ip_address`, `cus_id`) VALUES
(1, 'korkit', '12345', 'front', 9000, '172.20.10.5', 551167);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orderpd`
--

INSERT INTO `orderpd` (`order_id`, `total_cash`, `appointment`, `product_id`, `cus_id`) VALUES
(1, 500, '2019-04-15', 1, 551167),
(2, 1000, '2019-04-17', 2, 551168),
(3, 500, '2019-04-18', 1, 551169),
(4, 500, '2019-04-17', 1, 551170),
(5, 1000, '2019-04-17', 2, 551189),
(6, 1000, '2019-04-16', 2, 551190),
(7, 500, '2019-04-16', 1, 551188);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(6) NOT NULL,
  `payment_at` varchar(15) CHARACTER SET utf8 NOT NULL,
  `transfer_date` date NOT NULL,
  `amount` int(15) NOT NULL,
  `slip` varchar(10) CHARACTER SET utf8 NOT NULL,
  `paid` int(2) NOT NULL,
  `order_id` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `payment_at`, `transfer_date`, `amount`, `slip`, `paid`, `order_id`) VALUES
(1, 'ไทยพาณิชย์', '2019-04-08', 500, '1', 1, 1),
(2, 'กรุงไทย', '2019-04-14', 1000, '2', 1, 2),
(3, 'กรุงไทย', '2019-04-16', 500, '3', 1, 3),
(4, 'กรุงไทย', '2019-04-17', 500, '4', 0, 4),
(5, 'กรุงไทย', '2019-04-16', 500, '5', 0, 5),
(6, 'กรุงไทย', '2019-04-18', 500, '6', 0, 6);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(6) NOT NULL,
  `product_name` varchar(15) CHARACTER SET utf8 NOT NULL,
  `price` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `username` varchar(10) CHARACTER SET utf8 NOT NULL,
  `pass_w` varchar(40) CHARACTER SET utf8 NOT NULL,
  `add_ress` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `work_phone` int(10) NOT NULL,
  `e_mail` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `site_name` varchar(10) CHARACTER SET utf8 NOT NULL,
  `full_name` varchar(15) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siteadmin`
--

INSERT INTO `siteadmin` (`cus_id`, `username`, `pass_w`, `add_ress`, `work_phone`, `e_mail`, `site_name`, `full_name`) VALUES
(551167, 'ho', '827ccb0eea8a706c4c34a16891f84e7b', NULL, 950244236, NULL, 'trang', NULL),
(551168, 'bam', '25f9e794323b453885f5181f1b624d0b', NULL, 950244237, NULL, 'stun', NULL),
(551169, 'chaiya', '827ccb0eea8a706c4c34a16891f84e7b', NULL, 950244255, NULL, 'bangkok', NULL),
(551170, 'chaba', '25f9e794323b453885f5181f1b624d0b', NULL, 950244239, NULL, 'trang', NULL),
(551171, 'vichai', '25f9e794323b453885f5181f1b624d0b', 'ladw', 940255562, 'vichai_s@hotmai', 'bangkok', 'vichai sommad'),
(551172, 'vichaiyut', '25f9e794323b453885f5181f1b624d0b', 'monjam', 940255564, 'vichaiyut_s@hot', 'changmai', 'vichaiyut somma'),
(551184, 'vichaichan', '25f9e794323b453885f5181f1b624d0b', '15/6', 940255588, 'vichaichan_s@ho', 'changmai', 'vichaichan somm'),
(551185, 'vichaichan', '25f9e794323b453885f5181f1b624d0b', '15/6', 800000000, 'vichaichan_s@ho', 'changmai', 'vichaichan somm'),
(551186, 'vichaiyan', '25f9e794323b453885f5181f1b624d0b', '15/6', 940255577, 'vichaiyan_s@hot', 'changmai', 'vichaiyan somma'),
(551187, 'vichaichon', '25f9e794323b453885f5181f1b624d0b', '15/6', 940255555, 'vichaichon_s@ho', 'bangkok', 'vichaichon somm'),
(551188, 'vichaimee', '25f9e794323b453885f5181f1b624d0b', '15/6', 940255511, 'vichaimee_s@hot', 'bangkok', 'vichaimee somma'),
(551189, 'somdee', '25f9e794323b453885f5181f1b624d0b', '15/6', 950244789, 'somdee@gmail.co', 'bangkok', 'somdee mechai'),
(551190, 'vichaichan', '25f9e794323b453885f5181f1b624d0b', '15/6', 940255562, 'vichaiyut_s@hot', 'bangkok', 'vichai sommad'),
(551192, 'rr', '123456789', NULL, 95084567, NULL, 'rrt', NULL),
(551193, 'vichaichan', '037b02f21d877dfa5fc5bf220d47471b', 'bdgb', 0, 'gbd', 'fbfb', 'sfbsb'),
(551194, 'vichaichan', '037b02f21d877dfa5fc5bf220d47471b', 'bdgb', 0, 'gbd', 'fbfb', 'sfbsb'),
(551195, 'vichaichan', '037b02f21d877dfa5fc5bf220d47471b', 'bdgb', 0, 'gbd', 'fbfb', 'sfbsb'),
(551196, 'vichaichan', '037b02f21d877dfa5fc5bf220d47471b', 'bdgb', 0, 'gbd', 'fbfb', 'sfbsb'),
(551197, 'vichaichan', '037b02f21d877dfa5fc5bf220d47471b', 'bdgb', 0, 'gbd', 'fbfb', 'sfbsb'),
(551198, 'vichaichan', '037b02f21d877dfa5fc5bf220d47471b', 'bdgb', 0, 'gbd', 'fbfb', 'sfbsb'),
(551199, 'vichaichan', '037b02f21d877dfa5fc5bf220d47471b', 'bdgb', 0, 'gbd', 'fbfb', 'sfbsb'),
(551200, 'vichaichan', '037b02f21d877dfa5fc5bf220d47471b', 'bdgb', 0, 'gbd', 'fbfb', 'sfbsb'),
(551201, 'vichaichan', '037b02f21d877dfa5fc5bf220d47471b', 'bdgb', 0, 'gbd', 'fbfb', 'sfbsb'),
(551202, 'heth', 'f4842dcb685d490e2a43212b8072a6fe', 'vv', 0, 'bdn', 'dgngg', 'dgnh'),
(551203, 'bgb', 'a2229799d787afc15a7a7d1a64035bc7', 'dgbdg', 0, 'kuttuku', 'rhrh', 'gbbnnb'),
(551204, 'bgb', 'a2229799d787afc15a7a7d1a64035bc7', 'dgbdg', 0, 'kuttuku', 'rhrh', 'gbbnnb'),
(551205, 'bgb', 'a2229799d787afc15a7a7d1a64035bc7', 'dgbdg', 0, 'kuttuku', 'rhrh', 'gbbnnb'),
(551206, 'bgb', 'a2229799d787afc15a7a7d1a64035bc7', 'dgbdg', 0, 'kuttuku', 'rhrh', 'gbbnnb'),
(551207, 'dee', '25f9e794323b453885f5181f1b624d0b', '15/6', 244234, 'kokig_kao@hotma', 'zxcvbnn', 'fffff'),
(551208, 'dee', 'a21075a36eeddd084e17611a238c7101', '15/6', 244234, 'kokig_kao@hotma', 'zxcvbnn', 'fffff'),
(551209, 'jan', '827ccb0eea8a706c4c34a16891f84e7b', '15/6', 244234, 'kokig_kao@hotma', 'fbfb', 'à¸à¹ˆà¸­à¸à¸´'),
(551210, 'jan', '827ccb0eea8a706c4c34a16891f84e7b', '15/6', 244234, 'kokig_kao@hotma', 'fbfb', 'à¸à¹ˆà¸­à¸à¸´'),
(551211, 'jan', '827ccb0eea8a706c4c34a16891f84e7b', '15/6', 244234, 'kokig_kao@hotma', 'fbfb', 'à¸à¹ˆà¸­à¸à¸´');

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
  ADD KEY `product_id` (`product_id`),
  ADD KEY `cus_id` (`cus_id`);

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
  MODIFY `emp_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `location_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `orderpd`
--
ALTER TABLE `orderpd`
  MODIFY `order_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `siteadmin`
--
ALTER TABLE `siteadmin`
  MODIFY `cus_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=551212;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `location` (`location_id`);

--
-- Constraints for table `location`
--
ALTER TABLE `location`
  ADD CONSTRAINT `location_ibfk_1` FOREIGN KEY (`cus_id`) REFERENCES `siteadmin` (`cus_id`);

--
-- Constraints for table `orderpd`
--
ALTER TABLE `orderpd`
  ADD CONSTRAINT `orderpd_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`),
  ADD CONSTRAINT `orderpd_ibfk_2` FOREIGN KEY (`cus_id`) REFERENCES `siteadmin` (`cus_id`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orderpd` (`order_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
