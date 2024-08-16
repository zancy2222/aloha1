-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 26, 2024 at 10:27 AM
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
(20, 'STANDARD FAMILY ROOM', '2 BEDS'),
(21, 'DELUXE DOUBLE ROOM', '1 BED'),
(22, 'EXECUTIVE ROOM', '1 BED'),
(23, 'SUPERIOR FAMILY ROOM', '2 BEDS'),
(24, 'ADDITIONAL BED', 'EXTRA BED/PERSON');

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
(4, 'ALOHA', 6, '2024-01-04', '2024-01-19', 0, 0.5),
(9, 'VALENTINESLOVE', 8, '2024-01-23', '2024-02-14', 0, 0.1);

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

--
-- Dumping data for table `tblgallery`
--

INSERT INTO `tblgallery` (`GALLERYID`, `ROOMID`, `IMAGE_URL`, `DESCRIPTION`, `CREATED_AT`, `TITLE`) VALUES
(26, 33, '../uploads/img1.JPEG,../uploads/img2.jpg', '', '2024-01-26 00:17:08', 'STANDARD DOUBLE ROOM'),
(27, 38, '../uploads/img1.jpg', '', '2024-01-26 00:19:44', 'STANDARD DOUBLE ROOM'),
(28, 39, '../uploads/img1.jpeg,../uploads/img2.jpeg', '', '2024-01-26 00:20:18', 'SUPERIOR DOUBLE ROOM'),
(29, 47, '../uploads/img1.jpg', '', '2024-01-26 00:22:05', 'STANDARD FAMILY ROOM'),
(30, 49, '../uploads/img1.jpg,../uploads/img2.jpeg,../uploads/img3.jpg,../uploads/img4.jpeg,../uploads/img5.jpeg', '', '2024-01-26 00:22:52', 'DELUXE DOUBLE ROOM'),
(31, 50, '../uploads/img1.jpeg,../uploads/img2.jpg,../uploads/img3.jpeg,../uploads/img4.jpeg,../uploads/img5.jpg', '', '2024-01-26 00:23:15', 'DELUXE DOUBLE ROOM'),
(32, 51, '../uploads/img1.jpeg,../uploads/img2.jpeg,../uploads/img3.jpeg,../uploads/img4.jpg,../uploads/img5.jpeg,../uploads/img6.jpeg', '', '2024-01-26 00:23:57', 'EXECUTIVE ROOM'),
(33, 52, '../uploads/img1.jpeg,../uploads/img2.jpeg,../uploads/img3.jpg', '', '2024-01-26 00:24:44', 'SUPERIOR FAMILY ROOM');

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
  `LOCATION` varchar(125) NOT NULL,
  `emailaddress` varchar(255) DEFAULT NULL,
  `age` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblguest`
--

INSERT INTO `tblguest` (`GUESTID`, `REFNO`, `G_FNAME`, `G_LNAME`, `G_CITY`, `G_ADDRESS`, `DBIRTH`, `G_PHONE`, `G_NATIONALITY`, `G_COMPANY`, `G_CADDRESS`, `G_TERMS`, `G_UNAME`, `G_PASS`, `ZIP`, `LOCATION`, `emailaddress`, `age`) VALUES
(87, 0, 'Cyrus Tristan', 'Quia-eo', 'Currimao', 'Maglaoi Norte', '2024-01-10', '09457724980', 'filipino', '', 'Ilocos Norte', 1, 'tantan', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 2711, '', 'cyrustristanquiaeo@gmail.com', 20),
(88, 0, 'tmmyyy', 'deveraaa', 'Guinsiliban', 'Maac', '2024-01-15', '09457724981', 'fil', '', 'Camiguin', 1, 'admin', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 2711, '', 'tommyleedeveraq@gmail.com', 20),
(89, 0, 'Tommy', 'De Vera', 'Salcedo (Baugen)', 'Poblacion Norte', '2002-09-09', '09102901014', 'Filipino', '', 'Ilocos Sur', 1, 'Tommy', '5213715efe8b3a4f9b9b9739dcf7ffce6dad34e2', 2711, '', 'tommyleedeveraq@gmail.com', 21),
(90, 0, 'cyrus', 'quiaeo', 'Nueva Era', 'Santo Niño', '2024-01-02', '09457724981', 'Filipino', '', 'Ilocos Norte', 1, 'tantan', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 2711, '', 'cyrustristanquiaeo@gmail.com', 21);

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
(151, '2024-01-22 06:54:15', 'g4swtqr7', 1, 87, 700, 0, 'Checkedout', '', 0.00, 1),
(152, '2024-01-23 02:48:07', 'kym2kevm', 1, 89, 1400, 0, 'Checkedout', '', 0.00, 1),
(153, '2024-01-23 03:02:03', 'km26o6qj', 1, 89, 700, 0, 'Checkedout', '', 0.00, 1),
(154, '2024-01-23 05:03:23', 'vv5ii8ft', 1, 90, 995, 0, 'Pending', '', 0.00, 0),
(155, '2024-01-23 05:07:02', 'u3x5zvai', 1, 89, 900, 0, 'Pending', '', 0.00, 0),
(156, '2024-01-23 05:08:02', 's336qdub', 1, 89, 1990, 0, 'Pending', '', 0.00, 0);

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
(194, 'g4swtqr7', '2024-01-22', 32, '2024-01-22 00:00:00', '2024-01-22 00:00:00', 700, 87, 'Travel', 'Checkedout', '0000-00-00 00:00:00', '', 0, '65ae0307a0fcf_bg-frube.png', NULL, 0.00),
(195, 'kym2kevm', '2024-01-23', 32, '2024-01-24 00:00:00', '2024-01-26 00:00:00', 1400, 89, 'Travel', 'Checkedout', '0000-00-00 00:00:00', '', 0, '65afc396ef5e6_images.png', NULL, 0.00),
(196, 'km26o6qj', '2024-01-23', 32, '2024-01-23 00:00:00', '2024-01-23 00:00:00', 700, 89, 'Travel', 'Checkedout', '0000-00-00 00:00:00', '', 0, '65afc6db16a3a_images.png', NULL, 0.00),
(197, 'vv5ii8ft', '2024-01-23', 33, '2024-01-23 00:00:00', '2024-01-23 00:00:00', 995, 90, 'Travel', 'Pending', '0000-00-00 00:00:00', '', 0, '65afe34be2f60_1FRONT-SLIDER.png', NULL, 0.00),
(198, 'u3x5zvai', '2024-01-23', 38, '2024-01-23 00:00:00', '2024-01-23 00:00:00', 900, 89, 'Travel', 'Pending', '0000-00-00 00:00:00', '', 0, '65afe42655b6d_images.png', NULL, 0.00),
(199, 's336qdub', '2024-01-23', 33, '2024-01-23 00:00:00', '2024-01-25 00:00:00', 1990, 89, 'Travel', 'Pending', '0000-00-00 00:00:00', '', 0, '65afe46227f2a_images.png', NULL, 0.00);

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
(305, 89, 'I love the Hotel!', 5, '2024-01-23');

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
(32, 5, 16, 'ORDINARY ROOM', 'BUILDING 1', 2, 700, 'rooms/FB_IMG_1642169054706.jpg'),
(33, 10, 17, 'STANDARD DOUBLE ROOM', 'AIR CONDITIONED | BUILDING 2', 2, 995, 'rooms/STANDARDDOUBLEROOM.JPEG'),
(38, 5, 17, 'STANDARD DOUBLE ROOM', 'AIR CONDITIONED | BUILDING 1', 2, 900, 'rooms/STANDARDDOUBLEROOMBLG2.jpg'),
(39, 10, 18, 'SUPERIOR DOUBLE ROOM', 'AIR CONDITIONED | BUILDING 3', 2, 1400, 'rooms/SuperiorDR3.jpeg'),
(47, 8, 20, 'STANDARD FAMILY ROOM', 'AIR CONDITIONED | BUILDING 2', 4, 1700, 'rooms/StandardFRBLG2.jpg'),
(48, 10, 20, 'STANDARD FAMILY ROOM', 'AIR CONDITIONED | BUILDING 3', 4, 1900, 'rooms/StandardFR3.jpeg'),
(49, 3, 21, 'DELUXE DOUBLE ROOM', 'AIR CONDITIONED | BUILDING 4', 2, 3000, 'rooms/DELUXEDOUBLEROOMBLG4.jpg'),
(50, 2, 21, 'DELUXE DOUBLE ROOM', 'AIR CONDITIONED | BUILDING 3', 2, 3500, 'rooms/DDBR3.jpeg'),
(51, 1, 22, 'EXECUTIVE ROOM', 'AIR CONDITIONED | BUILDING 4', 3, 3500, 'rooms/EXRoom4.jpeg'),
(52, 5, 23, 'SUPERIOR FAMILY ROOM', 'AIR CONDITIONED | BUILDING 4', 4, 4000, 'rooms/SUPERIORFAMILYROOMBLG4.jpg'),
(54, 10, 24, 'EXTRA BED', 'EXTRA BED', 1, 200, 'rooms/170.jpg');

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
(4, 'admin', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Administrator', 2147483647),
(6, 'Receptionist', 'Aloha123', '7ed807db86e51048646fd306fe46afdc83526353', 'Guest In-charge', 2147483647);

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
  MODIFY `ACCOMID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tblamenities`
--
ALTER TABLE `tblamenities`
  MODIFY `AMENID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblcoupon`
--
ALTER TABLE `tblcoupon`
  MODIFY `COUPON_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tblcoupon_usage`
--
ALTER TABLE `tblcoupon_usage`
  MODIFY `COUPON_USAGE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tblgallery`
--
ALTER TABLE `tblgallery`
  MODIFY `GALLERYID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `tblguest`
--
ALTER TABLE `tblguest`
  MODIFY `GUESTID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `tblpayment`
--
ALTER TABLE `tblpayment`
  MODIFY `SUMMARYID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;

--
-- AUTO_INCREMENT for table `tblreservation`
--
ALTER TABLE `tblreservation`
  MODIFY `RESERVEID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=200;

--
-- AUTO_INCREMENT for table `tblreviews`
--
ALTER TABLE `tblreviews`
  MODIFY `REVIEWID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=306;

--
-- AUTO_INCREMENT for table `tblroom`
--
ALTER TABLE `tblroom`
  MODIFY `ROOMID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `tbluseraccount`
--
ALTER TABLE `tbluseraccount`
  MODIFY `USERID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
