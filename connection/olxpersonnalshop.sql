-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2025 at 06:44 PM
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
-- Table structure for table `orderdetails`
--

CREATE TABLE `orderdetails` (
  `id` int(11) NOT NULL,
  `orderId` varchar(200) NOT NULL,
  `ProductId` int(11) NOT NULL,
  `Price` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orderdetails`
--

INSERT INTO `orderdetails` (`id`, `orderId`, `ProductId`, `Price`, `Quantity`) VALUES
(1, '17439291849427', 89, 900, 1),
(2, '17439291849427', 87, 700, 1),
(3, '17439291849427', 86, 600, 2),
(4, '17439291849427', 83, 300, 2),
(5, '17439291849427', 81, 200, 2),
(6, '17439552597451', 99, 1699, 5),
(7, '17439564778967', 81, 200, 5),
(8, '17439564778967', 80, 100, 4),
(9, '17439567604983', 80, 100, 1),
(10, '17439569133620', 85, 500, 1),
(11, '17439569133620', 83, 300, 1),
(12, '17439569133620', 80, 100, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderId` varchar(200) NOT NULL,
  `clientId` int(11) NOT NULL,
  `Price` int(11) NOT NULL,
  `DateOfOrder` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderId`, `clientId`, `Price`, `DateOfOrder`) VALUES
('17439291849427', 1, 3800, '2025-04-06'),
('17439552597451', 1, 8495, '2025-04-06'),
('17439564778967', 1, 1400, '2025-04-06'),
('17439567604983', 1, 100, '2025-04-06'),
('17439569133620', 1, 900, '2025-04-06');

-- --------------------------------------------------------

--
-- Table structure for table `order_tracking`
--

CREATE TABLE `order_tracking` (
  `TrackingId` int(11) NOT NULL,
  `OrderId` varchar(50) NOT NULL,
  `Status` varchar(100) NOT NULL,
  `Location` varchar(255) NOT NULL,
  `UpdatedAt` datetime DEFAULT current_timestamp(),
  `Notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(80, 'Product 1', 'Description 1', 'AVAILABLE', 100, 'ProductImages/1_bag.jpeg', 1, 'Goodland', 'L', 'Bag', '2'),
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
(99, 'Anti-Theft Laptop Backpack', 'Secure and comfy laptop bag.', 'AVAILABLE', 1699, 'https://images.unsplash.com/photo-1510074377623-8cf13fb90f14', 5, 'Skybags', 'Medium', 'USB port, Hidden zippers, Cushioned back', 'L'),
(100, 'bag add test', 'test', 'AVAILABLE', 5000, 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.khadims.com%2F30700276190&psig=AOvVaw2xab3sAVm3CqTpizGy7gsu&ust=1744128576713000&source=images&cd=vfe&opi=89978449&ved=0CBQQjRxqFwoTCICYlrOnxowDFQAAAAAdAAAAABAJ', 5, 'adad', '30L', 'asd', '2');
INSERT INTO `products` (`ProductId`, `Title`, `Description`, `IsAvailable`, `Price`, `ImgPath`, `Rating`, `Brand`, `Size`, `Specification`, `Categories`) VALUES
(104, 'Urban Laptop Bag', 'Sleek and professional design for work and travel', '1', 1300, 'https://www.google.com/imgres?q=urban%20laptop%20bag&imgurl=https%3A%2F%2Fm.media-amazon.com%2Fimages%2FI%2F7175XAoQUZL._AC_UF1000%2C1000_QL80_.jpg&imgrefurl=https%3A%2F%2Fwww.amazon.in%2FBusiness-Casual-Compartment-Resistant-Backpack%2Fdp%2FB08N6HSJJ5&docid=VxtC1gZUVCVGvM&tbnid=X_q--VjgpkAeoM&vet=12ahUKEwiHgZzyg-KMAxW2i2MGHRo6MLcQM3oECBYQAA..i&w=751&h=1000&hcb=2&ved=2ahUKEwiHgZzyg-KMAxW2i2MGHRo6MLcQM3oECBYQAA', 5, 'BagForge', '15-inch', 'Waterproof, Padded Laptop Sleeve', '2'),
(105, 'Classic School Bag', 'Durable with multiple compartments', '1', 799, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQOj1gcR8Z9VJXS_q3cw2y9n-Z7u18pmCFWlg&s', 4, 'EduCarry', 'Medium', 'Ergonomic straps, Lightweight', '1'),
(106, 'Chic Handbag', 'Stylish and compact for daily use', '1', 1100, 'https://cdn.trendhunterstatic.com/thumbs/513/bellroy-venture-duffel-55l.jpeg?auto=webp', 5, 'UrbanStyle', 'Small', 'Faux Leather, Zip Closure', '3'),
(107, 'Minimal Duffel Bag', 'Perfect for gym and short trips', '1', 1450, 'https://www.google.com/imgres?q=Minimal%20Duffel%20Bag&imgurl=https%3A%2F%2Fcdn.trendhunterstatic.com%2Fthumbs%2F513%2Fbellroy-venture-duffel-55l.jpeg%3Fauto%3Dwebp&imgrefurl=https%3A%2F%2Falfalahuniversity.edu.in%2F%3Fa%3D204330914&docid=VRTXxKn7lTa_HM&tbnid=uvBIInkKFNWeDM&vet=12ahUKEwiJ5I_whOKMAxVOzDgGHVWEFrUQM3oECBoQAA..i&w=800&h=599&hcb=2&itg=1&ved=2ahUKEwiJ5I_whOKMAxVOzDgGHVWEFrUQM3oECBoQAA', 4, 'FitPack', 'Large', 'Ventilated compartment, Adjustable strap', '5'),
(108, 'Eco Tote Bag', 'Reusable and sustainable shopping tote', '1', 500, 'https://encrypted-tbn2.gstatic.com/shopping?q=tbn:ANd9GcTob6Rgy52-palcLQ2MpWbaEhbmHnzmnEjuJwUAK3L94IwgGMKhPXApajQa_gelfTF8Ac0ikq5KjTwMFhklNX4nphKURDyJg2KBpWNcPs_bdRU_0DQcLvV80yg', 5, 'GreenCarry', 'One Size', 'Canvas, Foldable', '6'),
(109, 'Bold Backpack', 'Ideal for college and travel', '1', 899, 'https://encrypted-tbn2.gstatic.com/shopping?q=tbn:ANd9GcRd-K4yDmMRqrE0U5UwgA0T09bBl03UeCmNCNjS7x6NAX7mQZneB6QJUq8hzSsPwc7IpQTBYFXuL8OnAs4u4vOUAXDNgltnxvJ_JHe2Q5C7poqg2Z7Y3x5o', 4, 'TrailGear', 'Large', 'Laptop sleeve, Waterproof', '1'),
(110, 'Vintage Shoulder Bag', 'Retro vibes with modern functionality', '1', 1200, 'https://encrypted-tbn3.gstatic.com/shopping?q=tbn:ANd9GcQc_5X9hmjDpGAnCT4rrr_uTurxE_HGdFuYVIg4FCClDOtVewmtn_xWk1hpQmYasNGj5aLkFf-13Wx6_QANSji6E-geIs0G7zzZXHXkxOII7c9zGfiMJq-dMg', 4, 'OldSoul', 'Medium', 'Magnetic flap, Leatherette', '3'),
(111, 'Sporty Gym Bag', 'Spacious and tough for workouts', '1', 999, 'https://encrypted-tbn1.gstatic.com/shopping?q=tbn:ANd9GcT94jWgqx6vrMhQmS-EaMBmnvXn1Gph7r3ufdwhtPlBNGAio92JpBjNr7iBTmWgC6FtqFTg226C1SkgPRIp_1O6MAoQenvwD-J_Iwp-mR68hH1ib9UQ4k1H', 5, 'FitPack', 'Large', 'Shoe compartment, Nylon fabric', '5'),
(112, 'Smart Messenger Bag', 'Tech-ready with USB charging port', '1', 1599, 'https://www.google.com/imgres?q=bags&imgurl=https%3A%2F%2Fassets.ajio.com%2Fmedias%2Fsys_master%2Froot%2F20230628%2F9hYw%2F649bd227eebac147fc2100f3%2F-473Wx593H-465916723-rosegold-MODEL.jpg&imgrefurl=https%3A%2F%2Fwww.ajio.com%2Fromeing-set-of-3-trolley-bags-with-tsa-lock%2Fp%2F465916723_rosegold&docid=r1Sam__fQAeLFM&tbnid=rqjXG1_Kd-BQmM&vet=12ahUKEwiykZzwhuKMAxVsT2wGHWDpHxMQM3oECBsQAA..i&w=473&h=593&hcb=2&ved=2ahUKEwiykZzwhuKMAxVsT2wGHWDpHxMQM3oECBsQAA', 5, 'BagForge', '15-inch', 'Anti-theft, USB Charging', '2'),
(113, 'Elegant Handbag', 'Luxurious design with ample space', '1', 1899, 'https://www.google.com/imgres?q=bags&imgurl=http%3A%2F%2Ficon.in%2Fcdn%2Fshop%2Ffiles%2F1_f4e239e5-e089-4185-98fd-8fd7238275fe.jpg%3Fv%3D1735286514&imgrefurl=https%3A%2F%2Ficon.in%2Fproducts%2Ficonic-backpack&docid=qwZvUY8ViAnCSM&tbnid=bHCHYwvTTSSs5M&vet=12ahUKEwiykZzwhuKMAxVsT2wGHWDpHxMQM3oECGYQAA..i&w=1200&h=1200&hcb=2&ved=2ahUKEwiykZzwhuKMAxVsT2wGHWDpHxMQM3oECGYQAA', 5, 'UrbanStyle', 'Medium', 'Premium leather, Inner pockets', '3'),
(114, 'Compact Sling Bag', 'Perfect for daily essentials', '1', 699, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSb4VMlZ4GIJz8umoy6JoJyeCzBR2KP528xYA&s', 4, 'SlingShot', 'Small', 'Crossbody strap, Minimalist', '4'),
(115, 'Trendy Laptop Bag', 'Fashion-forward yet functional', '1', 1399, 'https://www.google.com/imgres?q=bags&imgurl=http%3A%2F%2Ficon.in%2Fcdn%2Fshop%2Ffiles%2F1_f4e239e5-e089-4185-98fd-8fd7238275fe.jpg%3Fv%3D1735286514&imgrefurl=https%3A%2F%2Ficon.in%2Fproducts%2Ficonic-backpack&docid=qwZvUY8ViAnCSM&tbnid=bHCHYwvTTSSs5M&vet=12ahUKEwiykZzwhuKMAxVsT2wGHWDpHxMQM3oECGYQAA..i&w=1200&h=1200&hcb=2&ved=2ahUKEwiykZzwhuKMAxVsT2wGHWDpHxMQM3oECGYQAA', 4, 'StyleByte', '15-inch', 'Shockproof, Slim', '2'),
(116, 'Sleek Travel Bag', 'Lightweight and easy to carry', '1', 1300, 'https://www.google.com/imgres?q=bags&imgurl=https%3A%2F%2Fhips.hearstapps.com%2Fhmg-prod%2Fimages%2Fclassic-designer-bags-of-all-time-6632b1321f554.jpg%3Fcrop%3D0.388xw%3A0.776xh%3B0.298xw%2C0.0962xh%26resize%3D640%3A*&imgrefurl=https%3A%2F%2Fwww.townandcountrymag.com%2Fstyle%2Ffashion-trends%2Fg60660520%2Fbest-designer-bags%2F&docid=kgYuz4yVY4pS1M&tbnid=9h0oqAyCgC1TGM&vet=12ahUKEwiykZzwhuKMAxVsT2wGHWDpHxMQM3oECH8QAA..i&w=640&h=640&hcb=2&ved=2ahUKEwiykZzwhuKMAxVsT2wGHWDpHxMQM3oECH8QAA', 5, 'GoRoam', 'Large', 'Expandable, TSA Lock', '5'),
(117, 'Urban School Bag', 'Bold colors and strong build', '1', 849, 'https://www.google.com/imgres?q=bags&imgurl=https%3A%2F%2Fcdn.khadims.com%2Fimage%2Ftr%3Ae-sharpen-01%2Ch-822%2Cw-940%2Ccm-pad_resize%2Fdata%2Fkhadims%2F19sept2023%2F34834734833_1.JPG&imgrefurl=https%3A%2F%2Fwww.khadims.com%2F34834734833&docid=CJAkCnKJ5VG6QM&tbnid=KU3v7gIlCzXOsM&vet=12ahUKEwiykZzwhuKMAxVsT2wGHWDpHxMQM3oECDIQAA..i&w=940&h=822&hcb=2&ved=2ahUKEwiykZzwhuKMAxVsT2wGHWDpHxMQM3oECDIQAA', 4, 'EduCarry', 'Medium', 'Organizer, Padded back', '1'),
(118, 'Modern Handbag', 'Designed for comfort and style', '1', 1150, 'https://www.google.com/imgres?q=bags&imgurl=https%3A%2F%2Fimages-cdn.ubuy.co.in%2F6538723e9cdcd87a947e4a71-womens-purses-and-handbags-shoulder-bags.jpg&imgrefurl=https%3A%2F%2Fwww.ubuy.co.in%2Fproduct%2F2C7O4B2U-womens-purses-and-handbags-shoulder-bags-ladies-designer-top-handle-satchel-tote-bag&docid=XlRJkJzTl98dyM&tbnid=WaVqFwQaWA1upM&vet=12ahUKEwiykZzwhuKMAxVsT2wGHWDpHxMQM3oFCIMBEAA..i&w=873&h=977&hcb=2&ved=2ahUKEwiykZzwhuKMAxVsT2wGHWDpHxMQM3oFCIMBEAA', 5, 'UrbanStyle', 'Medium', 'Magnetic closure, Faux leather', '3'),
(119, 'Casual Backpack', 'All-rounder bag for daily use', '1', 950, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQLvEu4TcKG0at0RcmxELER1lCs1DmlRfDV0A&s', 4, 'EveryDayCarry', 'Large', 'Multi-pocket, Durable', '1'),
(120, 'Premium Laptop Bag', 'Top-tier protection for devices', '1', 1799, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRIAw2duKWWi7vNrroCkle6zb05UgskB1_iSQ&s', 5, 'BagForge', '15-inch', 'Hard shell, USB port', '2'),
(121, 'Versatile Tote Bag', 'Work or casual — fits all moods', '1', 999, 'https://www.google.com/imgres?q=Versatile%20Tote%20Bag&imgurl=https%3A%2F%2Ficon.in%2Fcdn%2Fshop%2Ffiles%2F1_45230852-344f-40bb-9d8a-67441390fba6.jpg%3Fv%3D1729260828&imgrefurl=https%3A%2F%2Ficon.in%2Fproducts%2Fversatile-tote-bag&docid=jbatxK3Ef5XzIM&tbnid=d6hH512fbZ0BTM&vet=12ahUKEwiz89mih-KMAxUVSmwGHdnnIdoQM3oECGcQAA..i&w=2000&h=2000&hcb=2&ved=2ahUKEwiz89mih-KMAxUVSmwGHdnnIdoQM3oECGcQAA', 4, 'GreenCarry', 'One Size', 'Zipper top, Water-resistant', '6'),
(122, 'Chic Shoulder Bag', 'Goes with every outfit', '1', 900, 'data:image/jpeg;base64,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', 5, 'SlingShot', 'Small', 'Chain strap, Sleek finish', '3'),
(123, 'Smart Gym Bag', 'Everything you need in one place', '1', 1199, 'data:image/jpeg;base64,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', 4, 'FitPack', 'Large', 'Wet/dry section, Anti-odor', '5'),
(124, 'Classic Laptop Bag', 'For professionals on the move', '1', 1299, 'data:image/jpeg;base64,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', 4, 'StyleByte', '15-inch', 'Padded, Anti-theft pocket', '2'),
(125, 'Compact School Bag', 'Small but spacious', '1', 799, 'https://example.com/images/bag22.jpg', 4, 'EduCarry', 'Small', 'Strong zippers, Reflective strip', '1'),
(126, 'Everyday Handbag', 'Carry-all for daily use', '1', 1050, 'https://example.com/images/bag23.jpg', 4, 'UrbanStyle', 'Medium', 'Water-repellent, Organizer slots', '3'),
(127, 'Rugged Duffel Bag', 'Rough use? No problem.', '1', 1499, 'https://example.com/images/bag24.jpg', 4, 'TrailGear', 'Large', 'Tear-resistant, Handles + straps', '5'),
(128, 'Slim Messenger Bag', 'Flat, compact, organized', '1', 1100, 'https://example.com/images/bag25.jpg', 5, 'BagForge', '13-inch', 'Slim build, Secure flap', '2'),
(129, 'Eco Mini Tote', 'Small and sustainable', '1', 459, 'https://example.com/images/bag26.jpg', 5, 'GreenCarry', 'Mini', 'Handmade, 100% cotton', '6'),
(130, 'Luxury Handbag', 'Elegance with function', '1', 2099, 'https://example.com/images/bag27.jpg', 5, 'UrbanStyle', 'Medium', 'Gold accents, Detachable strap', '3'),
(131, 'Sport Duffel Bag', 'Built for the athlete in you', '1', 1200, 'https://example.com/images/bag28.jpg', 4, 'FitPack', 'Large', 'Quick-access pockets, Dry zone', '5'),
(132, 'Urban Sling Bag', 'City life essential', '1', 799, 'https://example.com/images/bag29.jpg', 4, 'SlingShot', 'Small', 'Hidden zipper, RFID-safe', '4'),
(133, 'Trendy Shoulder Bag', 'Street-style approved', '1', 950, 'https://example.com/images/bag30.jpg', 5, 'SlingShot', 'Medium', 'Bold colors, Adjustable strap', '3'),
(134, 'Minimalist Laptop Bag', 'For clean looks and function', '1', 1399, 'https://example.com/images/bag31.jpg', 5, 'BagForge', '15-inch', 'Slim profile, Easy-access', '2'),
(135, 'Durable School Bag', 'Lasts all year long', '1', 859, 'https://example.com/images/bag32.jpg', 4, 'EduCarry', 'Medium', 'Reinforced base, Organizer', '1'),
(136, 'Lightweight Handbag', 'Carry with ease', '1', 949, 'https://example.com/images/bag33.jpg', 4, 'UrbanStyle', 'Medium', 'Feather-light, Sleek design', '3'),
(137, 'Large Duffel Bag', 'Pack more, stress less', '1', 1599, 'https://example.com/images/bag34.jpg', 4, 'TrailGear', 'XL', 'Max capacity, Weatherproof', '5'),
(138, 'Sleek Shoulder Bag', 'Understated and cool', '1', 999, 'https://example.com/images/bag35.jpg', 4, 'SlingShot', 'Medium', 'Zippered compartments, Stylish cut', '3'),
(139, 'Everyday Gym Bag', 'Basic but tough', '1', 999, 'https://example.com/images/bag36.jpg', 4, 'FitPack', 'Medium', 'Mesh sides, Strong handles', '5'),
(140, 'Work Messenger Bag', 'Designed for your hustle', '1', 1199, 'https://example.com/images/bag37.jpg', 5, 'BagForge', '15-inch', 'Quick stash front, Magnetic close', '2'),
(141, 'Street Tote', 'Bold and useful', '1', 849, 'https://example.com/images/bag38.jpg', 4, 'GreenCarry', 'One Size', 'Wipe-clean, Graphic print', '6'),
(142, 'Tech Laptop Bag', 'Gadget ready', '1', 1499, 'https://example.com/images/bag39.jpg', 5, 'StyleByte', '15-inch', 'Cable organizer, RFID-safe', '2'),
(143, 'Designer Handbag', 'Head-turning style', '1', 1999, 'https://example.com/images/bag40.jpg', 5, 'UrbanStyle', 'Medium', 'Premium build, Inner clutch', '3'),
(144, 'Tough School Bag', 'Built like a tank', '1', 899, 'https://example.com/images/bag41.jpg', 4, 'EduCarry', 'Large', 'Waterproof, Thick straps', '1'),
(145, 'Daily Tote', 'Throw in and go', '1', 699, 'https://example.com/images/bag42.jpg', 4, 'GreenCarry', 'One Size', 'Zippered, Strong handle', '6'),
(146, 'Convertible Backpack', 'Use it your way', '1', 1399, 'https://example.com/images/bag43.jpg', 5, 'EveryDayCarry', 'Medium', 'Backpack + Duffel', '1'),
(147, 'Casual Sling Bag', 'Laid-back vibes', '1', 749, 'https://example.com/images/bag44.jpg', 4, 'SlingShot', 'Small', 'Secure pocket, Breathable', '4'),
(148, 'Executive Laptop Bag', 'Boss mode on', '1', 1599, 'https://example.com/images/bag45.jpg', 5, 'BagForge', '15-inch', 'Leather finish, Powerbank pocket', '2'),
(149, 'Luxury School Bag', 'For students with taste', '1', 999, 'https://example.com/images/bag46.jpg', 4, 'EduCarry', 'Medium', 'Designer straps, Organizer', '1'),
(150, 'Hybrid Travel Bag', 'Backpack + Duffel', '1', 1499, 'https://example.com/images/bag47.jpg', 5, 'GoRoam', 'Large', 'Converts easily, Huge space', '5'),
(151, 'Streetwise Handbag', 'Edgy and urban', '1', 1099, 'https://example.com/images/bag48.jpg', 5, 'UrbanStyle', 'Small', 'Zipper style, Soft touch', '3'),
(152, 'XL Gym Bag', 'Carry all the gains', '1', 1399, 'https://example.com/images/bag49.jpg', 4, 'FitPack', 'XL', 'Wide opening, Built-in bottle holder', '5'),
(153, 'Eco Utility Tote', 'Green and strong', '1', 749, 'https://example.com/images/bag50.jpg', 5, 'GreenCarry', 'One Size', 'Heavy canvas, Double stitched', '6');


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
(51, 83, 2, 300, 32),
(85, 81, 1, 200, 1);

--
-- Triggers `shoppingcart`
--
DELIMITER $$
CREATE TRIGGER `update_cart_price` BEFORE INSERT ON `shoppingcart` FOR EACH ROW BEGIN
    SET NEW.Price = (SELECT Price FROM products WHERE ProductId = NEW.ProductId);
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `liked_products`
--
ALTER TABLE `liked_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orderId` (`orderId`),
  ADD KEY `ProductId` (`ProductId`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderId`);

--
-- Indexes for table `order_tracking`
--
ALTER TABLE `order_tracking`
  ADD PRIMARY KEY (`TrackingId`);

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
-- AUTO_INCREMENT for table `orderdetails`
--
ALTER TABLE `orderdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `order_tracking`
--
ALTER TABLE `order_tracking`
  MODIFY `TrackingId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ProductId` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;

--
-- AUTO_INCREMENT for table `product_ratings`
--
ALTER TABLE `product_ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shoppingcart`
--
ALTER TABLE `shoppingcart`
  MODIFY `ShoppingCartId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD CONSTRAINT `orderdetails_ibfk_1` FOREIGN KEY (`orderId`) REFERENCES `orders` (`orderId`) ON DELETE CASCADE,
  ADD CONSTRAINT `orderdetails_ibfk_2` FOREIGN KEY (`ProductId`) REFERENCES `products` (`ProductId`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
