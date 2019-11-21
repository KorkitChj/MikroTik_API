-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2019 at 08:40 AM
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
  `pass_w` varchar(40) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `pass_w`, `image`) VALUES
(123458, 'pam', '25f9e794323b453885f5181f1b624d0b', ''),
(123459, 'noon', '25f9e794323b453885f5181f1b624d0b', ''),
(123460, 'kao', '25f9e794323b453885f5181f1b624d0b', '2104530995.png');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `emp_id` int(6) NOT NULL,
  `username` varchar(10) NOT NULL,
  `pass_w` varchar(40) NOT NULL,
  `pass_router` varchar(40) NOT NULL,
  `full_name` varchar(15) DEFAULT NULL,
  `location_id` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`emp_id`, `username`, `pass_w`, `pass_router`, `full_name`, `location_id`) VALUES
(12, 'sukum', '2a4a3ea4095c1f5453b5463c3a746c99', '44076', 'sukum', 8),
(13, 'reception', '2a4a3ea4095c1f5453b5463c3a746c99', '44337', 'reception', 8);

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `location_id` int(6) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(40) NOT NULL,
  `working_site` varchar(255) NOT NULL,
  `api_port` int(5) DEFAULT NULL,
  `image_site` varchar(100) NOT NULL,
  `ip_address` varchar(20) NOT NULL,
  `cus_id` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`location_id`, `username`, `password`, `working_site`, `api_port`, `image_site`, `ip_address`, `cus_id`) VALUES
(5, 'korkit', '12345', 'tranga', 9000, '1080705153.png', '172.20.148.18', 22),
(6, 'korkit', '12345', 'trang', 9000, '1664097328.jpg', '172.20.10.7', 35),
(7, 'korkit', '12345', 'กรุงเทพ', 9000, '1250900821.jpg', '172.20.10.8', 48),
(8, 'korkit', '12345', 'aw', 9000, '725489347.png', '172.20.10.5', 56);

-- --------------------------------------------------------

--
-- Table structure for table `login_details`
--

CREATE TABLE `login_details` (
  `login_details_id` int(11) NOT NULL,
  `last_activity` datetime NOT NULL,
  `cus_id` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login_details`
--

INSERT INTO `login_details` (`login_details_id`, `last_activity`, `cus_id`) VALUES
(1, '2019-11-07 12:50:15', 35),
(2, '2019-11-07 12:50:22', 35),
(3, '2019-11-07 12:54:54', 35),
(4, '2019-11-07 12:54:56', 35),
(6, '2019-11-08 00:38:58', 35);

-- --------------------------------------------------------

--
-- Table structure for table `orderpd`
--

CREATE TABLE `orderpd` (
  `order_id` int(6) NOT NULL,
  `total_cash` int(10) NOT NULL,
  `appointment` datetime NOT NULL,
  `product_id` int(6) NOT NULL,
  `cus_id` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orderpd`
--

INSERT INTO `orderpd` (`order_id`, `total_cash`, `appointment`, `product_id`, `cus_id`) VALUES
(9, 300, '2019-10-16 20:32:34', 4, 22),
(13, 300, '2019-11-08 06:30:33', 4, 35),
(21, 1500, '2019-11-10 04:45:53', 10, 44),
(22, 1500, '2019-11-10 05:13:46', 10, 45),
(23, 2000, '2019-11-10 10:57:54', 11, 46),
(25, 1500, '2019-11-10 15:34:28', 10, 48),
(26, 300, '2019-11-17 10:20:37', 4, 49),
(27, 1500, '2019-11-18 12:42:16', 10, 56),
(29, 300, '2019-11-18 17:45:04', 4, 58);

-- --------------------------------------------------------

--
-- Table structure for table `packet_update`
--

CREATE TABLE `packet_update` (
  `puID` int(40) NOT NULL,
  `payment_at` varchar(255) NOT NULL,
  `transfer_date` datetime NOT NULL,
  `amount` int(15) NOT NULL,
  `slip_name` varchar(40) NOT NULL,
  `time_required` varchar(40) NOT NULL,
  `cus_id` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(6) NOT NULL,
  `payment_at` varchar(15) NOT NULL,
  `transfer_date` datetime NOT NULL,
  `expired_date` datetime NOT NULL,
  `amount` int(15) NOT NULL,
  `slip_name` varchar(40) NOT NULL,
  `paid` int(2) NOT NULL,
  `order_id` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `payment_at`, `transfer_date`, `expired_date`, `amount`, `slip_name`, `paid`, `order_id`) VALUES
(6, 'ไทยพาญิชย์', '2019-10-10 10:10:00', '2020-01-11 10:10:00', 300, 'IMG_1166.PNG', 1, 9),
(7, 'ไทยพาญิชย์', '2019-11-07 07:08:00', '2021-02-25 11:39:00', 1000, '1458092521.PNG', 1, 13),
(8, 'กรุงไทย', '2019-11-09 14:50:00', '2021-05-10 14:50:00', 1500, 'IMG_1115.PNG', 1, 22),
(9, 'ไทยพาญิชย์', '2019-11-09 09:00:00', '2021-11-08 09:00:00', 2000, 'IMG_1257.JPG', 1, 23),
(10, 'ไทยพาญิชย์', '2019-11-09 05:07:00', '2021-05-10 05:07:00', 1500, 'IMG_1053.PNG', 1, 21),
(12, 'ไทยพาญิชย์', '2019-11-09 03:02:00', '2021-05-10 03:02:00', 1500, 'IMG_1226.JPG', 1, 25),
(13, 'ไทยพาญิชย์', '2019-11-14 12:00:00', '2020-03-03 12:00:00', 300, 'IMG_1226-9803.JPG', 1, 26),
(14, 'กรุงไทย', '2019-11-17 12:00:00', '2021-05-18 12:00:00', 1500, 'IMG_1129.PNG', 1, 27),
(15, 'กรุงไทย', '2019-11-17 13:03:00', '2020-03-06 13:03:00', 300, 'IMG_1298.PNG', 1, 29);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(6) NOT NULL,
  `product_name` varchar(15) NOT NULL,
  `price` int(100) NOT NULL,
  `title` varchar(255) NOT NULL,
  `function` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `price`, `title`, `function`, `image`) VALUES
(4, 'สินค้าราคา 300', 300, 'ระบบจัดการ Router MikroTik แบบ 3 เดือน', 'ใช้งานง่าย\r\n/รองรับการจัดการเจ้าของไซต์\r\n/รองรับการจัดการพนักงานได้ไม่จำกัด\r\n/ราคา 300 บาท\r\n/ระยะเวลา 3 เดือน\r\n/ให้คำปรึกษาฟรี\r\n/อัพเกรดระยะเวลาใช้งานได้\r\n/สามารถจัดการเราเตอร์หรือเปลี่ยนรหัสผ่านได้\r\n/หน้า Dashboard แสดงผมด้วย Chart ที่สวยงาม', 'd.png'),
(10, 'สินค้าราคา 1500', 1500, 'ระบบจัดการ Router MikroTik แบบ 1ปี 5 เดือน', 'ใช้งานง่าย\r\n/รองรับการจัดการเจ้าของไซต์\r\n/รองรับการจัดการพนักงานได้ไม่จำกัด\r\n/ราคา 1500 บาท\r\n/ระยะเวลา 10 ปี 5 เดือน\r\n/ให้คำปรึกษาฟรี\r\n/อัพเกรดระยะเวลาใช้งานได้\r\n/สามารถจัดการเราเตอร์หรือเปลี่ยนรหัสผ่านได้\r\n/หน้า Dashboard แสดงผมด้วย Chart ที่สวยงาม', 'j.png'),
(11, 'สินค้าราคา 2000', 2000, 'ระบบจัดการ Router MikroTik แบบ 2 ปี', 'รองรับการจัดการเจ้าของไซต์/\r\nรองรับการจัดการพนักงานได้ไม่จำกัด/\r\nราคา 2000 บาท/\r\nระยะเวลา 2 ปี/\r\nให้คำปรึกษาฟรี/\r\nอัพเกรดระยะเวลาใช้งานได้/\r\nสามารถจัดการเราเตอร์หรือเปลี่ยนรหัสผ่านได้/\r\nหน้า Dashboard แสดงผมด้วย Chart ที่สวยงาม', '1884857117.png'),
(12, 'สินค้าราคา 600 ', 600, 'ระบบจัดการ Router MikroTik แบบ 6 เดือน', 'รองรับการจัดการเจ้าของไซต์/\r\nรองรับการจัดการพนักงานได้ไม่จำกัด/\r\nราคา 600 บาท/\r\nระยะเวลา 6 เดือน/\r\nให้คำปรึกษาฟรี/\r\nอัพเกรดระยะเวลาใช้งานได้/\r\nสามารถจัดการเราเตอร์หรือเปลี่ยนรหัสผ่านได้/\r\nหน้า Dashboard แสดงผมด้วย Chart ที่สวยงาม', '1170749152.png'),
(13, 'test', 3000, 'test', 'ใช้งานง่าย/\r\nรองรับการจัดการเจ้าของไซต์/\r\nรองรับการจัดการพนักงานได้ไม่จำกัด/\r\nราคา 300 บาท', '1056592174.png');

-- --------------------------------------------------------

--
-- Table structure for table `siteadmin`
--

CREATE TABLE `siteadmin` (
  `cus_id` int(6) NOT NULL,
  `username` varchar(40) NOT NULL,
  `pass_w` varchar(40) NOT NULL,
  `add_ress` varchar(100) NOT NULL,
  `work_phone` varchar(10) NOT NULL,
  `e_mail` varchar(40) NOT NULL,
  `site_name` varchar(40) NOT NULL,
  `full_name` varchar(40) NOT NULL,
  `image` varchar(100) NOT NULL,
  `regis_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `siteadmin`
--

INSERT INTO `siteadmin` (`cus_id`, `username`, `pass_w`, `add_ress`, `work_phone`, `e_mail`, `site_name`, `full_name`, `image`, `regis_date`) VALUES
(22, 'user7', '25d55ad283aa400af464c76d713c07ad', '443 ', '0123587035', 'test@hotmail.com', 'trang', 'testtest', '89947461.png', '2019-10-10 01:32:33'),
(35, 'user10', '2a4a3ea4095c1f5453b5463c3a746c99', '116/4 psu trang ต.ควนปลิง อ.เมือง จ.ตรัง 92000', '0950244234', 'somchai@psu.ac.th', 'psu trang', 'Somchai PP', '', '2019-11-07 12:20:46'),
(44, 'user11', '2a4a3ea4095c1f5453b5463c3a746c99', '55/5 ต.ควนปลิง อ.เมือง จ.ตรัง', '012345678', 'davthai@psu.ac.th', 'psutrang', 'ababi zza', '', '2019-11-09 10:45:37'),
(45, 'test', '2a4a3ea4095c1f5453b5463c3a746c99', '15/6', '0850244234', 'test_55@hotmail.com', 'trang', 'test test', '', '2019-11-09 11:13:08'),
(46, 'tawan', '2a4a3ea4095c1f5453b5463c3a746c99', '22/5 อ.จอมทอง ต.แม่สอย จ.เชียงใหม่', '0680250231', 'tawan@hotmail.com', 'chiangmai', 'ตะวัน คงดี', '', '2019-11-09 16:57:44'),
(48, 'somchai', '2a4a3ea4095c1f5453b5463c3a746c99', '55/5 ', '0950244789', 'somchai.u@hotmail.com', 'กรุงเทพมหา', 'somchai jj', '', '2019-11-09 21:34:15'),
(49, 'tets2', '2a4a3ea4095c1f5453b5463c3a746c99', '15/6', '0950245891', 'madee@hotmail.com', 'trang', 'madee', '', '2019-11-14 16:18:11'),
(56, 'user8', 'a7693c35e2e3d2911543a9f609d546a1', '223/45', '0872311536', 'kokig_kao@hotmail.com', 'อาคาร บีวั', 'pepo haha', '', '2019-11-15 18:39:31'),
(58, 'user12', '2a4a3ea4095c1f5453b5463c3a746c99', '15/6', '0950244234', 'user12@hotmail.com', 'trang', 'panda naruk', '', '2019-11-15 23:42:44');

-- --------------------------------------------------------

--
-- Table structure for table `video`
--

CREATE TABLE `video` (
  `id` int(50) NOT NULL,
  `url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `video`
--

INSERT INTO `video` (`id`, `url`) VALUES
(1, 'https://www.youtube.com/embed/wIthMFZGNsE');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `admin_id` (`admin_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`emp_id`),
  ADD UNIQUE KEY `emp_id` (`emp_id`),
  ADD KEY `location_id` (`location_id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`location_id`),
  ADD UNIQUE KEY `ip_address` (`ip_address`),
  ADD UNIQUE KEY `location_id` (`location_id`),
  ADD KEY `cus_id` (`cus_id`);

--
-- Indexes for table `login_details`
--
ALTER TABLE `login_details`
  ADD PRIMARY KEY (`login_details_id`),
  ADD UNIQUE KEY `login_details_id` (`login_details_id`),
  ADD KEY `cus_id` (`cus_id`);

--
-- Indexes for table `orderpd`
--
ALTER TABLE `orderpd`
  ADD PRIMARY KEY (`order_id`),
  ADD UNIQUE KEY `cus_id` (`cus_id`),
  ADD UNIQUE KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `packet_update`
--
ALTER TABLE `packet_update`
  ADD PRIMARY KEY (`puID`),
  ADD KEY `cus_id` (`cus_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD UNIQUE KEY `payment_id` (`payment_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD UNIQUE KEY `product_id` (`product_id`);

--
-- Indexes for table `siteadmin`
--
ALTER TABLE `siteadmin`
  ADD PRIMARY KEY (`cus_id`),
  ADD UNIQUE KEY `cus_id` (`cus_id`),
  ADD UNIQUE KEY `e_mail` (`e_mail`);

--
-- Indexes for table `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `emp_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `location_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `login_details`
--
ALTER TABLE `login_details`
  MODIFY `login_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `orderpd`
--
ALTER TABLE `orderpd`
  MODIFY `order_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `packet_update`
--
ALTER TABLE `packet_update`
  MODIFY `puID` int(40) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `siteadmin`
--
ALTER TABLE `siteadmin`
  MODIFY `cus_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
--
-- AUTO_INCREMENT for table `video`
--
ALTER TABLE `video`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
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
-- Constraints for table `login_details`
--
ALTER TABLE `login_details`
  ADD CONSTRAINT `login_details_ibfk_1` FOREIGN KEY (`cus_id`) REFERENCES `siteadmin` (`cus_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orderpd`
--
ALTER TABLE `orderpd`
  ADD CONSTRAINT `orderpd_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orderpd_ibfk_2` FOREIGN KEY (`cus_id`) REFERENCES `siteadmin` (`cus_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `packet_update`
--
ALTER TABLE `packet_update`
  ADD CONSTRAINT `packet_update_ibfk_1` FOREIGN KEY (`cus_id`) REFERENCES `siteadmin` (`cus_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orderpd` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
