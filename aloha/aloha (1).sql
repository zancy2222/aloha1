-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 16, 2024 at 01:18 PM
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
-- Database: `aloha`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblaccomodation`
--

CREATE TABLE `tblaccomodation` (
  `ACCOMID` int(11) NOT NULL,
  `ACCOMODATION` varchar(30) NOT NULL,
  `ACCOMDESC` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblaccomodation`
--

INSERT INTO `tblaccomodation` (`ACCOMID`, `ACCOMODATION`, `ACCOMDESC`) VALUES
(16, 'ORDINARY DOUBLE ROOM', '1 BED'),
(17, 'STANDARD DOUBLE ROOM', '1 BED'),
(18, 'SUPERIOR DOUBLE ROOM', '1 BED'),
(19, 'STANDARD FAMILY ROOM (VIP)', '1 BED'),
(20, 'STANDARD FAMILY ROOM', '2 BEDS'),
(21, 'DELUXE DOUBLE ROOM', '1 BED'),
(22, 'EXECUTIVE ROOM', '1 BED'),
(23, 'SUPERIOR FAMILY ROOM', '2 BEDS');

-- --------------------------------------------------------

--
-- Table structure for table `tblamenities`
--

CREATE TABLE `tblamenities` (
  `AMENID` int(11) NOT NULL,
  `AMENNAME` varchar(125) NOT NULL,
  `AMENDECS` varchar(125) NOT NULL,
  `AMENIMAGE` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblcoupon`
--

CREATE TABLE `tblcoupon` (
  `COUPON_ID` int(11) NOT NULL,
  `COUPON_CODE` varchar(50) NOT NULL,
  `MAX_USAGE` int(11) NOT NULL,
  `START_DATE` date NOT NULL,
  `END_DATE` date NOT NULL,
  `CURRENT_USAGE` int(11) DEFAULT 0,
  `DISCOUNT` float DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblcoupon`
--

INSERT INTO `tblcoupon` (`COUPON_ID`, `COUPON_CODE`, `MAX_USAGE`, `START_DATE`, `END_DATE`, `CURRENT_USAGE`, `DISCOUNT`) VALUES
(4, 'ALOHA', 2, '2024-01-04', '2024-01-19', 0, 0.5),
(5, 'CYRUS', 9, '2024-01-09', '2024-01-09', 0, 0.25);

-- --------------------------------------------------------

--
-- Table structure for table `tblcoupon_usage`
--

CREATE TABLE `tblcoupon_usage` (
  `COUPON_USAGE_ID` int(11) NOT NULL,
  `COUPON_CODE` varchar(50) NOT NULL,
  `GUEST_ID` int(11) NOT NULL,
  `USAGE_DATE` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblcoupon_usage`
--

INSERT INTO `tblcoupon_usage` (`COUPON_USAGE_ID`, `COUPON_CODE`, `GUEST_ID`, `USAGE_DATE`) VALUES
(16, 'ALOHA', 77, '2024-01-08 01:03:50'),
(17, 'aloha', 79, '2024-01-12 05:39:37');

-- --------------------------------------------------------

--
-- Table structure for table `tblgallery`
--

CREATE TABLE `tblgallery` (
  `GALLERYID` int(11) NOT NULL,
  `ROOMID` int(11) DEFAULT NULL,
  `IMAGE_URL` varchar(255) NOT NULL,
  `DESCRIPTION` text DEFAULT NULL,
  `CREATED_AT` timestamp NOT NULL DEFAULT current_timestamp(),
  `TITLE` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblguest`
--

CREATE TABLE `tblguest` (
  `GUESTID` int(11) NOT NULL,
  `REFNO` int(11) NOT NULL,
  `G_FNAME` varchar(30) NOT NULL,
  `G_LNAME` varchar(30) NOT NULL,
  `G_CITY` varchar(90) NOT NULL,
  `G_ADDRESS` varchar(90) NOT NULL,
  `DBIRTH` date NOT NULL,
  `G_PHONE` varchar(20) NOT NULL,
  `G_NATIONALITY` varchar(30) NOT NULL,
  `G_COMPANY` varchar(90) NOT NULL,
  `G_CADDRESS` varchar(90) NOT NULL,
  `G_TERMS` tinyint(4) NOT NULL,
  `G_UNAME` varchar(255) NOT NULL,
  `G_PASS` varchar(255) NOT NULL,
  `ZIP` int(11) NOT NULL,
  `LOCATION` varchar(125) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblguest`
--

INSERT INTO `tblguest` (`GUESTID`, `REFNO`, `G_FNAME`, `G_LNAME`, `G_CITY`, `G_ADDRESS`, `DBIRTH`, `G_PHONE`, `G_NATIONALITY`, `G_COMPANY`, `G_CADDRESS`, `G_TERMS`, `G_UNAME`, `G_PASS`, `ZIP`, `LOCATION`) VALUES
(75, 0, 'Janry', 'Octavio', 'Kabankalan City', 'Coloso Street', '1989-11-07', '09123586545', 'Filipino', 'Snappy Trends', 'Coloso Street', 1, 'customer', 'b39f008e318efd2bb988d724a161b61c6909677f', 6111, 'guest/photos/hqdefault.jpg'),
(76, 0, 'Junjie', 'Villanueva', '', 'Coloso Street', '2015-10-15', '09123586545', 'Filipino', 'Snappy Trends', 'Coloso Street', 1, 'junjie', '84c73452a1e22cdaa2964e6302f1883e13cc2715', 6111, ''),
(77, 0, 'Cyrus Tristan', 'Quia-eo', 'Salcedo', '1st street, San Gaspar, Salcedo, Ilocos Sur', '2024-01-02', '09457724980', 'Philippines', 'N/A', '1st street, San Gaspar, Salcedo, Ilocos Sur', 1, 'tantan', '54f8e646c2e9bc1bf732d02b02df0ce949daf103', 2711, 'guest/photos/WIN_20230401_01_19_41_Pro.jpg'),
(78, 0, 'tristan', 'Quia-eo', 'Salcedo', 'San gaspar', '2024-01-11', '09457724980', 'Philippines', 'N/A', 'ilocos sur', 1, 'cyrus', 'cc1b6155bfaf42229490bff4af55f42611eb41ef', 2711, ''),
(79, 0, 'Juan', 'Delacruz', 'Salcedo', 'San gaspar', '2024-01-03', '+639457724981', 'filipino', 'N/A', 'ilocos sur', 1, 'tantan', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 2711, '');

-- --------------------------------------------------------

--
-- Table structure for table `tblpayment`
--

CREATE TABLE `tblpayment` (
  `SUMMARYID` int(11) NOT NULL,
  `TRANSDATE` datetime NOT NULL,
  `CONFIRMATIONCODE` varchar(30) NOT NULL,
  `PQTY` int(11) NOT NULL,
  `GUESTID` int(11) NOT NULL,
  `SPRICE` double NOT NULL,
  `MSGVIEW` tinyint(1) NOT NULL,
  `STATUS` varchar(30) NOT NULL,
  `COUPON_CODE` varchar(50) DEFAULT NULL,
  `initial_payment` decimal(10,2) DEFAULT NULL,
  `BALANCE` decimal(10,2) GENERATED ALWAYS AS (`SPRICE` - `initial_payment`) STORED,
  `is_archived` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblpayment`
--

INSERT INTO `tblpayment` (`SUMMARYID`, `TRANSDATE`, `CONFIRMATIONCODE`, `PQTY`, `GUESTID`, `SPRICE`, `MSGVIEW`, `STATUS`, `COUPON_CODE`, `initial_payment`, `is_archived`) VALUES
(74, '2024-01-12 04:30:06', 'kohnrejo', 1, 79, 995, 0, 'Cancelled', '', 500.00, 1),
(75, '2024-01-12 06:12:44', '7myjdshz', 1, 79, 3500, 0, 'Cancelled', '', 200.00, 0),
(76, '2024-01-12 06:37:09', 'jy2uh4j7', 2, 79, 3790, 0, 'Confirmed', '', 500.00, 0),
(77, '2024-01-12 06:39:48', 'rg6d4mfz', 1, 79, 450, 0, 'Cancelled', 'aloha', 100.00, 1),
(78, '2024-01-12 06:54:07', 'qi6fagug', 1, 79, 900, 0, 'Cancelled', 'aloha', 100.00, 1),
(80, '2024-01-16 11:43:04', 'jxciygh5', 1, 79, 900, 0, 'Pending', '', 0.00, 0),
(81, '2024-01-16 11:51:13', 'xjka2d3g', 1, 79, 900, 0, 'Pending', '', 0.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblreservation`
--

CREATE TABLE `tblreservation` (
  `RESERVEID` int(11) NOT NULL,
  `CONFIRMATIONCODE` varchar(50) NOT NULL,
  `TRANSDATE` date NOT NULL,
  `ROOMID` int(11) NOT NULL,
  `ARRIVAL` datetime NOT NULL,
  `DEPARTURE` datetime NOT NULL,
  `RPRICE` double NOT NULL,
  `GUESTID` int(11) NOT NULL,
  `PRORPOSE` varchar(30) NOT NULL,
  `STATUS` varchar(11) NOT NULL,
  `BOOKDATE` datetime NOT NULL,
  `REMARKS` text NOT NULL,
  `USERID` int(11) NOT NULL,
  `proof_of_transaction` varchar(255) DEFAULT NULL,
  `remaining_balance` double DEFAULT NULL,
  `BALANCE` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblreservation`
--

INSERT INTO `tblreservation` (`RESERVEID`, `CONFIRMATIONCODE`, `TRANSDATE`, `ROOMID`, `ARRIVAL`, `DEPARTURE`, `RPRICE`, `GUESTID`, `PRORPOSE`, `STATUS`, `BOOKDATE`, `REMARKS`, `USERID`, `proof_of_transaction`, `remaining_balance`, `BALANCE`) VALUES
(87, 'kohnrejo', '2024-01-12', 32, '2024-01-12 00:00:00', '2024-01-12 00:00:00', 995, 79, 'Travel', 'Cancelled', '0000-00-00 00:00:00', '', 0, '65a0b23eda25d_FB_IMG_1642169060716.jpg', NULL, 0.00),
(88, '7myjdshz', '2024-01-12', 38, '2024-01-12 00:00:00', '2024-01-12 00:00:00', 3500, 79, 'Travel', 'Cancelled', '0000-00-00 00:00:00', '', 0, '65a0ca4c59461_FB_IMG_1642169051756.jpg', NULL, 0.00),
(89, 'jy2uh4j7', '2024-01-12', 33, '2024-01-12 00:00:00', '2024-01-12 00:00:00', 1895, 79, 'Travel', 'Pending', '0000-00-00 00:00:00', '', 0, '65a0d005a7ad0_FB_IMG_1642169049153.jpg', NULL, 0.00),
(90, 'jy2uh4j7', '2024-01-12', 32, '2024-01-12 00:00:00', '2024-01-12 00:00:00', 1895, 79, 'Travel', 'Pending', '0000-00-00 00:00:00', '', 0, NULL, NULL, 0.00),
(91, 'rg6d4mfz', '2024-01-12', 33, '2024-01-12 00:00:00', '2024-01-12 00:00:00', 450, 79, 'Travel', 'Cancelled', '0000-00-00 00:00:00', '', 0, '65a0d0a4e7018_20220114_133929.jpg', NULL, 350.00),
(92, 'qi6fagug', '2024-01-12', 33, '2024-01-12 00:00:00', '2024-01-12 00:00:00', 900, 79, 'Travel', 'Cancelled', '0000-00-00 00:00:00', '', 0, '65a0d3ff9bbec_20220114_133522.jpg', NULL, 800.00),
(93, 'jqifwm5m', '2024-01-16', 39, '2024-01-16 00:00:00', '2024-01-16 00:00:00', 3500, 79, 'Travel', 'Pending', '0000-00-00 00:00:00', '', 0, '65a65cc1827b8_orange-1705317341926.png', NULL, 0.00),
(94, 'jxciygh5', '2024-01-16', 33, '2024-01-16 00:00:00', '2024-01-16 00:00:00', 900, 79, 'Travel', 'Pending', '0000-00-00 00:00:00', '', 0, '65a65db824432_apple-1705317276867.png', NULL, 0.00),
(95, 'xjka2d3g', '2024-01-16', 33, '2024-01-16 00:00:00', '2024-01-16 00:00:00', 900, 79, 'Travel', 'Pending', '0000-00-00 00:00:00', '', 0, '65a65fa1acee9_apple-1705317276867.png', NULL, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `tblreviews`
--

CREATE TABLE `tblreviews` (
  `REVIEWID` int(11) NOT NULL,
  `GUESTID` int(11) DEFAULT NULL,
  `REVIEW_TEXT` text DEFAULT NULL,
  `RATING` int(11) DEFAULT NULL,
  `REVIEW_DATE` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblreviews`
--

INSERT INTO `tblreviews` (`REVIEWID`, `GUESTID`, `REVIEW_TEXT`, `RATING`, `REVIEW_DATE`) VALUES
(303, 79, 'Hotel is Very Elegant', 5, '2024-01-16');

-- --------------------------------------------------------

--
-- Table structure for table `tblroom`
--

CREATE TABLE `tblroom` (
  `ROOMID` int(11) NOT NULL,
  `ROOMNUM` int(11) NOT NULL,
  `ACCOMID` int(11) NOT NULL,
  `ROOM` varchar(30) NOT NULL,
  `ROOMDESC` varchar(255) NOT NULL,
  `NUMPERSON` int(11) NOT NULL,
  `PRICE` double NOT NULL,
  `ROOMIMAGE` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblroom`
--

INSERT INTO `tblroom` (`ROOMID`, `ROOMNUM`, `ACCOMID`, `ROOM`, `ROOMDESC`, `NUMPERSON`, `PRICE`, `ROOMIMAGE`) VALUES
(31, 10, 16, 'ELECTRIC FAN ROOM', 'BLDG 1', 2, 700, 'rooms/20220114_133929.jpg'),
(32, 10, 17, 'AIR-CONDITIONED ROOM 1', 'BLDG 2', 2, 995, 'rooms/FB_IMG_1642169054706.jpg'),
(33, 13, 17, 'AIR-CONDITIONED ROOM 2', 'BLDG 2', 2, 900, 'rooms/IMG_20220817_083834.jpg'),
(34, 2, 18, 'Double VIP Room', 'BLDG 3', 2, 1400, 'rooms/FB_IMG_1642169049153.jpg'),
(35, 5, 20, 'Standard Family Room 1', 'BLDG 2', 2, 1700, 'rooms/FB_IMG_1642169051756.jpg'),
(36, 5, 20, 'Standard Family Room 2', 'BLDG 3', 2, 1900, 'rooms/IMG_20220817_083938.jpg'),
(37, 2, 21, 'Deluxe Double Room 1', 'BLDG 4', 2, 3000, 'rooms/IMG_20220817_083938.jpg'),
(38, 11, 21, 'Deluxe Double Room 2', 'BLDG 3', 2, 3500, 'rooms/IMG_20220817_084021.jpg'),
(39, 10, 22, 'Executive Room', 'BLDG 4', 2, 3500, 'rooms/FB_IMG_1642169051756.jpg'),
(40, 2, 23, 'Superior Family Room', 'BLDG 4', 4, 4000, 'rooms/20220114_133929.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbluseraccount`
--

CREATE TABLE `tbluseraccount` (
  `USERID` int(11) NOT NULL,
  `UNAME` varchar(30) NOT NULL,
  `USER_NAME` varchar(30) NOT NULL,
  `UPASS` varchar(90) NOT NULL,
  `ROLE` varchar(30) NOT NULL,
  `PHONE` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbluseraccount`
--

INSERT INTO `tbluseraccount` (`USERID`, `UNAME`, `USER_NAME`, `UPASS`, `ROLE`, `PHONE`) VALUES
(3, 'tantan', 'admin', 'admin', 'Administrator', 12),
(4, 'admin', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Administrator', 2147483647);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblaccomodation`
--
ALTER TABLE `tblaccomodation`
  ADD PRIMARY KEY (`ACCOMID`);

--
-- Indexes for table `tblamenities`
--
ALTER TABLE `tblamenities`
  ADD PRIMARY KEY (`AMENID`);

--
-- Indexes for table `tblcoupon`
--
ALTER TABLE `tblcoupon`
  ADD PRIMARY KEY (`COUPON_ID`),
  ADD UNIQUE KEY `COUPON_CODE` (`COUPON_CODE`);

--
-- Indexes for table `tblcoupon_usage`
--
ALTER TABLE `tblcoupon_usage`
  ADD PRIMARY KEY (`COUPON_USAGE_ID`),
  ADD KEY `fk_coupon_usage` (`COUPON_CODE`),
  ADD KEY `fk_guest_usage` (`GUEST_ID`);

--
-- Indexes for table `tblgallery`
--
ALTER TABLE `tblgallery`
  ADD PRIMARY KEY (`GALLERYID`),
  ADD KEY `ROOMID` (`ROOMID`);

--
-- Indexes for table `tblguest`
--
ALTER TABLE `tblguest`
  ADD PRIMARY KEY (`GUESTID`);

--
-- Indexes for table `tblpayment`
--
ALTER TABLE `tblpayment`
  ADD PRIMARY KEY (`SUMMARYID`),
  ADD UNIQUE KEY `CONFIRMATIONCODE` (`CONFIRMATIONCODE`),
  ADD KEY `GUESTID` (`GUESTID`);

--
-- Indexes for table `tblreservation`
--
ALTER TABLE `tblreservation`
  ADD PRIMARY KEY (`RESERVEID`),
  ADD KEY `ROOMID` (`ROOMID`),
  ADD KEY `GUESTID` (`GUESTID`),
  ADD KEY `CONFIRMATIONCODE` (`CONFIRMATIONCODE`);

--
-- Indexes for table `tblreviews`
--
ALTER TABLE `tblreviews`
  ADD PRIMARY KEY (`REVIEWID`),
  ADD KEY `GUESTID` (`GUESTID`);

--
-- Indexes for table `tblroom`
--
ALTER TABLE `tblroom`
  ADD PRIMARY KEY (`ROOMID`),
  ADD KEY `ACCOMID` (`ACCOMID`);

--
-- Indexes for table `tbluseraccount`
--
ALTER TABLE `tbluseraccount`
  ADD PRIMARY KEY (`USERID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblaccomodation`
--
ALTER TABLE `tblaccomodation`
  MODIFY `ACCOMID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tblamenities`
--
ALTER TABLE `tblamenities`
  MODIFY `AMENID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblcoupon`
--
ALTER TABLE `tblcoupon`
  MODIFY `COUPON_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tblcoupon_usage`
--
ALTER TABLE `tblcoupon_usage`
  MODIFY `COUPON_USAGE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tblgallery`
--
ALTER TABLE `tblgallery`
  MODIFY `GALLERYID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tblguest`
--
ALTER TABLE `tblguest`
  MODIFY `GUESTID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `tblpayment`
--
ALTER TABLE `tblpayment`
  MODIFY `SUMMARYID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `tblreservation`
--
ALTER TABLE `tblreservation`
  MODIFY `RESERVEID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `tblreviews`
--
ALTER TABLE `tblreviews`
  MODIFY `REVIEWID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=304;

--
-- AUTO_INCREMENT for table `tblroom`
--
ALTER TABLE `tblroom`
  MODIFY `ROOMID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `tbluseraccount`
--
ALTER TABLE `tbluseraccount`
  MODIFY `USERID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblcoupon_usage`
--
ALTER TABLE `tblcoupon_usage`
  ADD CONSTRAINT `fk_coupon_usage` FOREIGN KEY (`COUPON_CODE`) REFERENCES `tblcoupon` (`COUPON_CODE`),
  ADD CONSTRAINT `fk_guest_usage` FOREIGN KEY (`GUEST_ID`) REFERENCES `tblguest` (`GUESTID`);

--
-- Constraints for table `tblgallery`
--
ALTER TABLE `tblgallery`
  ADD CONSTRAINT `tblgallery_ibfk_1` FOREIGN KEY (`ROOMID`) REFERENCES `tblroom` (`ROOMID`) ON DELETE CASCADE;

--
-- Constraints for table `tblreservation`
--
ALTER TABLE `tblreservation`
  ADD CONSTRAINT `tblreservation_ibfk_1` FOREIGN KEY (`ROOMID`) REFERENCES `tblroom` (`ROOMID`),
  ADD CONSTRAINT `tblreservation_ibfk_2` FOREIGN KEY (`GUESTID`) REFERENCES `tblguest` (`GUESTID`);

--
-- Constraints for table `tblreviews`
--
ALTER TABLE `tblreviews`
  ADD CONSTRAINT `tblreviews_ibfk_1` FOREIGN KEY (`GUESTID`) REFERENCES `tblguest` (`GUESTID`);

--
-- Constraints for table `tblroom`
--
ALTER TABLE `tblroom`
  ADD CONSTRAINT `tblroom_ibfk_1` FOREIGN KEY (`ACCOMID`) REFERENCES `tblaccomodation` (`ACCOMID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
