-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 06, 2025 at 09:38 AM
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
-- Database: `olxpersonnalshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `liked_products`
--

CREATE TABLE `liked_products` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderId` varchar(200) NOT NULL,
  `ProductId` int(11) NOT NULL,
  `Price` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `DateOfOrder` varchar(100) NOT NULL,
  `clientId` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderId`, `ProductId`, `Price`, `Quantity`, `DateOfOrder`, `clientId`) VALUES
('19182251773248323349137251159227241297273312712497', 85, 150, 1, '2021-11-23', 31),
('33969286734923752635953243388469277473415329894354', 88, 2400, 1, '2021-11-11', 31),
('57381463935439838572337152196961794134136441122421', 85, 2500, 1, '2021-11-04', 31),
('15332273265113859341774955957275656173489169584753', 80, 150, 1, '2021-12-15', 31),
('35699116436632662385282247771844617781393355917388', 80, 100, 1, '2021-12-20', 32),
('53659853717958245133314234471415768628513841796965', 89, 3600, 1, '2021-12-20', 32),
('78546564824339686141274333311892531643135512431772', 80, 100, 1, '2021-12-20', 32),
('57142699218387157457481629575766853746665198582268', 85, 1500, 3, '2021-12-20', 32),
('84634157665616353788278616837215858134792762445151', 80, 100, 1, '2023-10-29', 31),
('26254993927441617576738627542761912963583144952489', 80, 500, 5, '2023-10-30', 48),
('55632848237692389161994956881151871691611799553839', 81, 0, 2, '2025-04-06', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ProductId` int(30) NOT NULL,
  `Title` varchar(30) NOT NULL,
  `Description` varchar(300) NOT NULL,
  `IsAvailable` varchar(10) NOT NULL DEFAULT 'AVAILABLE',
  `Price` int(30) NOT NULL,
  `ImgPath` varchar(300) NOT NULL,
  `Rating` int(11) NOT NULL,
  `Brand` varchar(30) NOT NULL,
  `Size` varchar(30) NOT NULL,
  `Specification` varchar(200) NOT NULL,
  `Categories` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ProductId`, `Title`, `Description`, `IsAvailable`, `Price`, `ImgPath`, `Rating`, `Brand`, `Size`, `Specification`, `Categories`) VALUES
(80, 'Product 1', 'Description 1', 'AVAILABLE', 100, 'ProductImages/1_bag.jpeg', 1, 'Goodland', 'L', 'Bag', 'F'),
(81, 'Product 2', 'Description 2', 'AVAILABLE', 200, 'ProductImages/1 (18).jpeg', 2, 'Addidas', 'XL', 'Bag', 'F'),
(83, 'Product 3', 'Description 3', 'AVAILABLE', 300, 'ProductImages/1 (25).jpeg', 4, 'Jeep BULO', 'S', 'Bag', 'F'),
(84, 'Product 4', 'Description 4', 'AVAILABLE', 400, 'ProductImages/1 (4).jpeg', 5, 'ADIDAS', 'XXL', 'Sweather', 'F'),
(85, 'Product 5', 'Description 5', 'AVAILABLE', 500, 'ProductImages/1 (13).jpeg', 4, 'NIKE', 'XS', 'Sweather', 'M'),
(86, 'Product 6', 'Description 6', 'AVAILABLE', 600, 'ProductImages/1 (14).jpeg', 3, 'ADIDAS', 'M', 'Sweather', 'M'),
(87, 'Product 7', 'Description 7', 'AVAILABLE', 700, 'ProductImages/1 (20).jpeg', 2, 'NIKE', 'L', 'Sunglass', 'M'),
(88, 'Product 8', 'Description 8', 'AVAILABLE', 800, 'ProductImages/1 (21).jpeg', 1, 'ADIDAS', 'XL', 'Sunglass', 'M'),
(89, 'Product 9', 'Description 9', 'AVAILABLE', 900, 'ProductImages/1 (7).jpeg', 0, 'NIKE', 'XXXL', 'Bag', 'M'),
(90, 'Classic Leather Backpack', 'Stylish and spacious bag for everyday use.', 'AVAILABLE', 2499, 'https://images.unsplash.com/photo-1600185365925-3fbc4b2d2c52', 5, 'UrbanPack', 'Medium', '100% leather build, Laptop safe, Anti-theft design', 'B'),
(91, 'Waterproof Laptop Bag', 'Waterproof and lightweight, perfect for travel.', 'AVAILABLE', 1899, 'https://images.unsplash.com/photo-1623387641166-84a152b2a9b5', 4, 'GearMax', 'Large', 'Polyester, Water-resistant, Multi-pocket', 'L'),
(92, 'Travel Duffel', 'Expandable storage with airline cabin compatibility.', 'AVAILABLE', 2199, 'https://images.unsplash.com/photo-1522338140262-f46f591361d9', 5, 'Safari', 'Large', 'Expandable, Cabin-friendly, Shoulder strap', 'T'),
(93, 'Kids School Bag', 'Cartoon printed lightweight school bag.', 'AVAILABLE', 899, 'https://images.unsplash.com/photo-1598032898858-52b1c410b879', 4, 'Wildcraft', 'Small', 'Reflective, Lightweight, Zippered', 'S'),
(94, 'Canvas Messenger Bag', 'Durable and sleek for daily commute.', 'AVAILABLE', 1299, 'https://images.unsplash.com/photo-1565372910386-e6c4f1db849b', 4, 'Skybags', 'Medium', 'Detachable strap, Easy to clean, Stylish', 'M'),
(95, 'Vintage Shoulder Bag', 'Trendy and durable for office wear.', 'AVAILABLE', 1599, 'https://images.unsplash.com/photo-1544717305-996b815c338c', 4, 'UrbanPack', 'Medium', 'Vintage look, Leather material, Stylish finish', 'S'),
(96, 'Gym Duffle Bag', 'Spacious and perfect for fitness.', 'AVAILABLE', 1399, 'https://images.unsplash.com/photo-1611892440504-42a792e24d32', 5, 'TravelPro', 'Large', 'Shoe section, Water resistant, Multi-compartment', 'G'),
(97, 'Trolley Travel Bag', 'Spacious and trolley supported for trips.', 'AVAILABLE', 2999, 'https://images.unsplash.com/photo-1534447677768-be436bb09401', 5, 'American Tourister', 'Large', 'Wheeled, Expandable, Cabin-size', 'T'),
(98, 'Casual Daypack', 'Compact and lightweight for outings.', 'AVAILABLE', 999, 'https://images.unsplash.com/photo-1623183924532-1b8041a6a56d', 4, 'GearMax', 'Small', 'Casual style, Light fabric, Adjustable straps', 'B'),
(99, 'Anti-Theft Laptop Backpack', 'Secure and comfy laptop bag.', 'AVAILABLE', 1699, 'https://images.unsplash.com/photo-1510074377623-8cf13fb90f14', 5, 'Skybags', 'Medium', 'USB port, Hidden zippers, Cushioned back', 'L');

-- --------------------------------------------------------

--
-- Table structure for table `product_ratings`
--

CREATE TABLE `product_ratings` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shoppingcart`
--

CREATE TABLE `shoppingcart` (
  `ShoppingCartId` int(11) NOT NULL,
  `ProductId` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Price` int(11) NOT NULL,
  `clientId` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `shoppingcart`
--

INSERT INTO `shoppingcart` (`ShoppingCartId`, `ProductId`, `Quantity`, `Price`, `clientId`) VALUES
(51, 83, 3, 900, 32),
(59, 83, 1, 0, 1),
(60, 80, 2, 0, 1),
(61, 85, 1, 0, 1),
(62, 88, 1, 0, 1),
(63, 95, 1, 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `liked_products`
--
ALTER TABLE `liked_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderId`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ProductId`);

--
-- Indexes for table `product_ratings`
--
ALTER TABLE `product_ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shoppingcart`
--
ALTER TABLE `shoppingcart`
  ADD PRIMARY KEY (`ShoppingCartId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `liked_products`
--
ALTER TABLE `liked_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ProductId` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `product_ratings`
--
ALTER TABLE `product_ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shoppingcart`
--
ALTER TABLE `shoppingcart`
  MODIFY `ShoppingCartId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
