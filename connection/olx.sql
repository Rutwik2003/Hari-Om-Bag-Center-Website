-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2025 at 06:16 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `olx`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`) VALUES
(1, 'Shubham Bisht', 'admin@gmail.com', '$2y$10$7HsjHxPgaJtb3VPpiYs1Se9CG80a41qfTag2N/o4yCZc.B2v5uGxu');

-- --------------------------------------------------------

--
-- Table structure for table `advertisments`
--

CREATE TABLE `advertisments` (
  `AdsID` int(11) NOT NULL,
  `Date` date NOT NULL,
  `status` int(1) NOT NULL,
  `Details` varchar(200) NOT NULL,
  `Price` int(6) NOT NULL,
  `Image` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Title` varchar(50) NOT NULL,
  `UserID` int(11) NOT NULL,
  `CategoryID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `areas`
--

CREATE TABLE `areas` (
  `areaID` int(11) NOT NULL,
  `areaName` varchar(20) NOT NULL,
  `cityID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `areas`
--

INSERT INTO `areas` (`areaID`, `areaName`, `cityID`) VALUES
(1, 'Kalawad Road', 1),
(2, 'Mavdi', 1),
(3, 'Sadhu Vasvani Road', 1),
(4, 'Yagnik Road', 1),
(5, '150 Feet Ring Road', 1),
(6, 'Maninagar', 2),
(7, 'Navrangpura', 2),
(8, 'Satellite', 2),
(9, 'Thaltej', 2),
(10, 'Bopal', 2),
(11, 'Vesu', 3),
(12, 'Adajan', 3),
(13, 'Citylight', 3),
(14, 'Piplod', 3),
(15, 'Katargam', 3),
(16, 'Alkapuri', 4),
(17, 'Gotri', 4),
(18, 'Fatehgunj', 4),
(19, 'Karelibaug', 4),
(20, 'Manjalpur', 4),
(21, 'Indira Marg', 5),
(22, 'Patel Colony', 5),
(23, 'Ranjit Sagar Road', 5),
(24, 'Digjam Circle', 5),
(25, 'Park Colony', 5),
(26, 'Andheri', 6),
(27, 'Bandra', 6),
(28, 'Borivali', 6),
(29, 'Powai', 6),
(30, 'Dadar', 6),
(31, 'Connaught Place', 7),
(32, 'Dwarka', 7),
(33, 'Karol Bagh', 7),
(34, 'Rohini', 7),
(35, 'Saket', 7),
(36, 'Indiranagar', 8),
(37, 'Whitefield', 8),
(38, 'Koramangala', 8),
(39, 'Electronic City', 8),
(40, 'Jayanagar', 8),
(41, 'Banjara Hills', 9),
(42, 'Gachibowli', 9),
(43, 'Hitech City', 9),
(44, 'Kukatpally', 9),
(45, 'Begumpet', 9),
(46, 'T. Nagar', 10),
(47, 'Velachery', 10),
(48, 'Anna Nagar', 10),
(49, 'Mylapore', 10),
(50, 'Adyar', 10),
(51, 'Phase 1', 11),
(52, 'Phase 3B2', 11),
(53, 'Phase 7', 11),
(54, 'Sector 70', 11),
(55, 'Sector 80', 11),
(56, 'Salt Lake', 18),
(57, 'Park Street', 18),
(58, 'Gariahat', 18),
(59, 'Howrah', 18),
(60, 'Ballygunge', 18),
(61, 'Koregaon Park', 20),
(62, 'Baner', 20),
(63, 'Viman Nagar', 20),
(64, 'Hinjewadi', 20),
(65, 'Kothrud', 20),
(66, 'Malviya Nagar', 21),
(67, 'Vaishali Nagar', 21),
(68, 'Mansarovar', 21),
(69, 'Raja Park', 21),
(70, 'C-Scheme', 21),
(71, 'Hazratganj', 22),
(72, 'Gomti Nagar', 22),
(73, 'Indira Nagar', 22),
(74, 'Aliganj', 22),
(75, 'Aminabad', 22),
(76, 'Swaroop Nagar', 23),
(77, 'Tilak Nagar', 23),
(78, 'Arya Nagar', 23),
(79, 'Pandu Nagar', 23),
(80, 'Kakadeo', 23),
(81, 'Dharampeth', 24),
(82, 'Sadar', 24),
(83, 'Mahal', 24),
(84, 'Civil Lines', 24),
(85, 'Laxmi Nagar', 24),
(86, 'Vijay Nagar', 25),
(87, 'Rajwada', 25),
(88, 'Palasia', 25),
(89, 'Bhawarkua', 25),
(90, 'Sudama Nagar', 25),
(91, 'Naupada', 26),
(92, 'Majiwada', 26),
(93, 'Vartak Nagar', 26),
(94, 'Ghodbunder Road', 26),
(95, 'Kopri', 26);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `CategoryID` int(11) NOT NULL,
  `CategoryName` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`CategoryID`, `CategoryName`) VALUES
(1, 'Handbags'),
(2, 'Backpacks'),
(3, 'Sling Bags'),
(4, 'Tote Bags'),
(5, 'Laptop Bags'),
(6, 'Travel Bags'),
(7, 'Duffel Bags'),
(8, 'Wallets & Clutches'),
(9, 'School Bags'),
(10, 'Messenger Bags');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `cityID` int(11) NOT NULL,
  `cityName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`cityID`, `cityName`) VALUES
(1, 'Rajkot'),
(2, 'Ahmedabad'),
(3, 'Surat'),
(4, 'Baroda'),
(5, 'Jamnagar'),
(6, 'Mumbai'),
(7, 'Delhi'),
(8, 'Bangalore'),
(9, 'Hyderabad'),
(10, 'Chennai'),
(11, 'Mohali'),
(12, 'Mumbai'),
(13, 'Delhi'),
(14, 'Bangalore'),
(15, 'Hyderabad'),
(16, 'Ahmedabad'),
(17, 'Chennai'),
(18, 'Kolkata'),
(19, 'Surat'),
(20, 'Pune'),
(21, 'Jaipur'),
(22, 'Lucknow'),
(23, 'Kanpur'),
(24, 'Nagpur'),
(25, 'Indore'),
(26, 'Thane'),
(27, 'Bhopal'),
(28, 'Visakhapatnam'),
(29, 'Pimpri-Chinchwad'),
(30, 'Patna'),
(31, 'Vadodara'),
(32, 'Ghaziabad'),
(33, 'Ludhiana'),
(34, 'Agra'),
(35, 'Nashik'),
(36, 'Faridabad'),
(37, 'Meerut'),
(38, 'Rajkot'),
(39, 'Kalyan-Dombivli'),
(40, 'Vasai-Virar'),
(41, 'Varanasi'),
(42, 'Srinagar'),
(43, 'Aurangabad'),
(44, 'Dhanbad'),
(45, 'Amritsar'),
(46, 'Navi Mumbai'),
(47, 'Allahabad'),
(48, 'Ranchi'),
(49, 'Howrah'),
(50, 'Coimbatore'),
(51, 'Jabalpur'),
(52, 'Gwalior'),
(53, 'Vijayawada'),
(54, 'Jodhpur'),
(55, 'Madurai'),
(56, 'Raipur'),
(57, 'Kota'),
(58, 'Chandigarh'),
(59, 'Guwahati'),
(60, 'Solapur'),
(61, 'Hubballi-Dharwad'),
(62, 'Mysore'),
(63, 'Tiruchirappalli'),
(64, 'Bareilly'),
(65, 'Aligarh'),
(66, 'Tiruppur'),
(67, 'Moradabad'),
(68, 'Jalandhar'),
(69, 'Bhubaneswar'),
(70, 'Salem'),
(71, 'Warangal'),
(72, 'Mira-Bhayandar'),
(73, 'Thiruvananthapuram'),
(74, 'Bhiwandi'),
(75, 'Saharanpur'),
(76, 'Guntur'),
(77, 'Amravati'),
(78, 'Bikaner'),
(79, 'Noida'),
(80, 'Jamshedpur'),
(81, 'Bhilai'),
(82, 'Cuttack'),
(83, 'Firozabad'),
(84, 'Kochi'),
(85, 'Nellore'),
(86, 'Bhavnagar'),
(87, 'Dehradun'),
(88, 'Durgapur'),
(89, 'Asansol'),
(90, 'Rourkela'),
(91, 'Nanded'),
(92, 'Kolhapur'),
(93, 'Ajmer'),
(94, 'Akola'),
(95, 'Gulbarga'),
(96, 'Jamnagar'),
(97, 'Ujjain'),
(98, 'Loni'),
(99, 'Siliguri'),
(100, 'Jhansi'),
(101, 'Ulhasnagar'),
(102, 'Nellore'),
(103, 'Jammu'),
(104, 'Sangli-Miraj & Kupwa'),
(105, 'Belgaum'),
(106, 'Mangalore'),
(107, 'Ambattur'),
(108, 'Tirunelveli'),
(109, 'Malegaon'),
(110, 'Gaya'),
(111, 'Jalgaon');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `commentID` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Status` int(1) NOT NULL,
  `Details` varchar(100) NOT NULL,
  `UserID` int(11) NOT NULL,
  `AdsID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `first_name` varchar(40) NOT NULL,
  `last_name` varchar(40) NOT NULL,
  `email_address` varchar(50) NOT NULL,
  `comment` varchar(170) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`first_name`, `last_name`, `email_address`, `comment`) VALUES
('', '', '', ''),
('hawraa', 'atat', 'hawraa@gmail.com', 'hi'),
('hawraa', 'atat', 'hawraa@gmail.com', 'hi'),
('Shubham', 'Bisht', 'shiv.bisht20@gmail.com', 'i want you to add catogories into the home page it showing only 2\r\n'),
('Shubham', 'Bisht', 'shiv.bisht20@gmail.com', 'test of feed back\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `jobapply`
--

CREATE TABLE `jobapply` (
  `uploadID` int(11) NOT NULL,
  `userName` varchar(250) DEFAULT NULL,
  `userEmail` varchar(200) DEFAULT NULL,
  `userAge` varchar(20) DEFAULT NULL,
  `userBiography` varchar(1000) DEFAULT NULL,
  `userJob` varchar(100) DEFAULT NULL,
  `userInterests` varchar(250) DEFAULT NULL,
  `image_path` varchar(50) DEFAULT NULL,
  `image_size` varchar(20) DEFAULT NULL,
  `image_type` varchar(30) DEFAULT NULL,
  `image_ext` varchar(4) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT current_timestamp(),
  `isDeleted` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `UserID` int(11) NOT NULL,
  `AdsID` int(11) NOT NULL,
  `details` varchar(100) NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `userlikead`
--

CREATE TABLE `userlikead` (
  `userId` int(5) NOT NULL,
  `adsId` int(5) NOT NULL,
  `likedIf1` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `userlikead`
--

INSERT INTO `userlikead` (`userId`, `adsId`, `likedIf1`) VALUES
(18, 82, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `UserName` varchar(30) NOT NULL,
  `Email` varchar(40) NOT NULL,
  `Password` varchar(60) NOT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `type` int(1) NOT NULL,
  `Status` int(1) DEFAULT NULL,
  `areaId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `UserName`, `Email`, `Password`, `phone`, `type`, `Status`, `areaId`) VALUES
(1, 'test33', 'shiv.bisht20@gmail.com', '$2y$10$cJ1bcKIEAaa3UsVvP0XUFODWhc4uhaXbauI3TRbwjnvTektyaG9F6', '9855551122', 1, 1, 1),
(2, 'test4', 'shiv.bisht203@gmail.com', '$2y$10$kkF2wElqrX6jOumrktS98eT4.RZw6Vw3ttRER.uoLwn9VZ2vxe.mC', '9999999999', 1, NULL, 52),
(3, 'shadow2', 'shiv.bisht2022@gmail.com', '$2y$10$eBT6k5bvsICbZjphKdq9QuUsy.gESIfZVWR5MPkTLGT7X.gHrGbqi', '9855551121', 1, NULL, 59),
(4, 'shadow88', 'shiv.bisht258@gmail.com', '$2y$10$S1H6ExSHog9AObI7o1Yj2.//9Pu3BKQZb7slAkSHzDwezDPj5WrEC', '9855551489', 1, NULL, 1662);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `advertisments`
--
ALTER TABLE `advertisments`
  ADD PRIMARY KEY (`AdsID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `CategoryID` (`CategoryID`);

--
-- Indexes for table `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`areaID`),
  ADD KEY `cityID` (`cityID`),
  ADD KEY `cityID_2` (`cityID`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`CategoryID`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`cityID`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`commentID`),
  ADD KEY `AdsID` (`AdsID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `jobapply`
--
ALTER TABLE `jobapply`
  ADD PRIMARY KEY (`uploadID`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`UserID`,`AdsID`),
  ADD KEY `adsidFK` (`AdsID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `UserName` (`UserName`),
  ADD UNIQUE KEY `zipCode` (`UserID`),
  ADD UNIQUE KEY `Phone` (`phone`),
  ADD KEY `areaID` (`areaId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `advertisments`
--
ALTER TABLE `advertisments`
  MODIFY `AdsID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `CategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `cityID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `commentID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobapply`
--
ALTER TABLE `jobapply`
  MODIFY `uploadID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `advertisments`
--
ALTER TABLE `advertisments`
  ADD CONSTRAINT `catidFK` FOREIGN KEY (`CategoryID`) REFERENCES `categories` (`CategoryID`),
  ADD CONSTRAINT `useridFK` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `AdsFK` FOREIGN KEY (`AdsID`) REFERENCES `advertisments` (`AdsID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `userFK` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `Userridfk` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `adsidFK` FOREIGN KEY (`AdsID`) REFERENCES `advertisments` (`AdsID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
