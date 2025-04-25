-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2025 at 10:35 PM
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
-- Database: `mvc_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `created_at`) VALUES
(8, 4, '2025-04-24 19:15:23'),
(9, 8, '2025-04-24 19:25:11'),
(10, 7, '2025-04-24 21:38:52');

-- --------------------------------------------------------

--
-- Table structure for table `cart_product`
--

CREATE TABLE `cart_product` (
  `id` int(11) NOT NULL,
  `cart_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart_product`
--

INSERT INTO `cart_product` (`id`, `cart_id`, `product_id`, `quantity`) VALUES
(76, 8, 26, 3),
(77, 8, 25, 5),
(78, 8, 27, 1),
(79, 8, 28, 1),
(81, 8, 38, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(4, 'Apple'),
(5, 'Samsung'),
(6, 'Xiaomi'),
(7, 'Google Pixel');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `guest_name` varchar(100) DEFAULT NULL,
  `guest_email` varchar(100) DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `guest_name`, `guest_email`, `total_price`, `created_at`) VALUES
(24, NULL, 'Aleksandar', 'aca@gmail.com', 15499.87, '2025-04-25 15:23:36'),
(25, 4, NULL, NULL, 3399.97, '2025-04-25 15:29:02'),
(26, NULL, 'Bojana', 'Bojana123@gmail.com', 13099.94, '2025-04-25 15:29:51'),
(27, NULL, 'Aleksandar', 'aca@gmail.com', 1099.99, '2025-04-25 15:33:31'),
(28, NULL, 'Aleksandar', 'fakafkaf@gmail.com', 2299.98, '2025-04-25 20:16:16');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(40, 24, 25, 1, 1099.00),
(41, 24, 26, 12, 1199.00),
(42, 25, 25, 2, 1099.00),
(43, 25, 26, 1, 1199.00),
(44, 26, 25, 1, 1099.00),
(45, 26, 27, 5, 2399.00),
(46, 27, 25, 1, 1099.00),
(47, 28, 25, 1, 1099.00),
(48, 28, 26, 1, 1199.00);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `category_id`) VALUES
(25, 'Apple iPhone 13', 'Newest iPhone model with great performance 128GB', 1099.99, 4),
(26, 'Apple iPhone 13 Pro', 'Pro version of iPhone 13 with advanced features', 1199.99, 4),
(27, 'Apple MacBook Pro 16\" M1', 'Powerful laptop with Apple M1 chip', 2399.99, 4),
(28, 'Apple iPad Pro 12.9\"', 'Large tablet with stunning display and performance', 1099.99, 4),
(29, 'Apple Watch Series 7', 'The latest Apple Watch with a new design', 399.99, 4),
(30, 'Apple AirPods Pro', 'Wireless earbuds with noise cancellation', 249.99, 4),
(31, 'Apple MacBook Air M1', 'Lightweight laptop with Apple M1 chip', 999.99, 4),
(32, 'Apple iPhone 12', 'Previous generation iPhone with solid features', 799.99, 4),
(33, 'Apple iPhone 12 Mini', 'Compact iPhone with powerful specs', 699.99, 4),
(34, 'Apple AirPods 3rd Gen', 'Wireless earbuds with improved sound', 179.99, 4),
(35, 'Samsung Galaxy S21', 'Flagship Samsung phone with powerful features', 799.99, 5),
(36, 'Samsung Galaxy S21 Ultra', 'Premium version with top-end features', 1199.99, 5),
(37, 'Samsung Galaxy Note 20 Ultra', 'Smartphone with large screen and S-Pen', 1099.99, 5),
(38, 'Samsung Galaxy Z Fold 3', 'Innovative foldable phone', 1799.99, 5),
(39, 'Samsung Galaxy Z Flip 3', 'Compact foldable phone with advanced features', 999.99, 5),
(40, 'Samsung Galaxy A52', 'Affordable phone with solid performance', 399.99, 5),
(41, 'Samsung Galaxy A72', 'Mid-range phone with great camera', 499.99, 5),
(42, 'Samsung Galaxy Tab S7', 'High-performance tablet for work and entertainment', 649.99, 5),
(43, 'Samsung Galaxy Watch 4', 'Latest Samsung smart watch', 249.99, 5),
(44, 'Samsung Galaxy Buds Pro', 'Wireless earbuds with excellent sound', 199.99, 5),
(45, 'Apple iPhone 13', 'The latest iPhone with improved camera and performance.', 999.99, 4),
(46, 'Apple MacBook Pro', 'Powerful laptop for professionals with M1 chip.', 1999.99, 4),
(47, 'Apple AirPods Pro', 'Noise cancelling wireless earbuds with superior sound quality.', 249.99, 4),
(48, 'Apple Watch Series 7', 'Smartwatch with advanced health features and fitness tracking.', 399.99, 4),
(49, 'Apple iPad Air', 'Lightweight tablet with A14 Bionic chip for faster performance.', 599.99, 4),
(50, 'Samsung Galaxy S21', 'Latest flagship phone with powerful camera and display.', 799.99, 5),
(51, 'Samsung Galaxy Note 20', 'High-end smartphone with stylus support and large display.', 999.99, 5),
(52, 'Samsung Galaxy Buds Pro', 'Wireless earbuds with amazing sound and noise cancellation.', 199.99, 5),
(53, 'Samsung Galaxy Watch 4', 'Smartwatch with health and fitness tracking.', 249.99, 5),
(54, 'Samsung Galaxy Tab S7', 'Premium Android tablet with a large screen and high performance.', 649.99, 5),
(55, 'Xiaomi Mi 11', 'Flagship phone with excellent camera and display.', 699.99, 6),
(56, 'Xiaomi Redmi Note 10', 'Affordable phone with great performance and battery life.', 199.99, 6),
(57, 'Xiaomi Mi Watch', 'Smartwatch with long battery life and fitness features.', 129.99, 6),
(58, 'Xiaomi Mi Band 6', 'Fitness tracker with AMOLED display and heart rate monitoring.', 49.99, 6),
(59, 'Xiaomi Mi Air Purifier', 'Air purifier with smart control for cleaner air at home.', 149.99, 6),
(60, 'Google Pixel 6', 'Flagship phone with advanced camera and AI features.', 899.99, 7),
(61, 'Google Pixel 5a', 'Affordable smartphone with great performance and Google integration.', 499.99, 7),
(62, 'Google Nest Mini', 'Smart speaker with Google Assistant integration.', 49.99, 7),
(63, 'Google Pixel Buds', 'Wireless earbuds with great sound and Google Assistant.', 179.99, 7),
(64, 'Google Pixelbook Go', 'Premium Chromebook with excellent performance and design.', 649.99, 7),
(65, 'Apple iPhone 15 Pro Max', 'Latest iPhone with A17 Bionic chip, Dynamic Island, and upgraded cameras.', 1199.99, 4),
(66, 'Apple iPhone 15', 'Affordable iPhone with the A16 Bionic chip and better battery life.', 999.99, 4),
(67, 'Apple iPhone 16 Pro Max', 'Next-generation iPhone with A18 Bionic chip and groundbreaking camera features.', 1299.99, 4),
(68, 'Apple MacBook Pro M3', 'Laptop with Apple M3 chip for pro users, improved performance and efficiency.', 2399.99, 4),
(69, 'Apple iPad Pro 2023', 'Powerful tablet with M3 chip, ideal for creative professionals and heavy tasks.', 1199.99, 4),
(70, 'Apple Watch Series 9', 'Latest Apple Watch with improved health features and extended battery life.', 399.99, 4),
(71, 'Samsung Galaxy S25 Ultra', 'Flagship phone with Snapdragon 8 Gen 3 and 200MP camera.', 1499.99, 5),
(72, 'Samsung Galaxy S25+', 'Next-gen phone with 120Hz Dynamic AMOLED display and powerful performance.', 1199.99, 5),
(73, 'Samsung Galaxy Z Fold 5', 'Foldable phone with an even larger display and multitasking features.', 1799.99, 5),
(74, 'Samsung Galaxy Z Flip 5', 'Compact foldable phone with improved hinge and display quality.', 999.99, 5),
(75, 'Samsung Galaxy Buds Pro 2', 'Premium earbuds with noise cancellation and enhanced sound quality.', 249.99, 5),
(76, 'Samsung Galaxy Watch 6', 'Smartwatch with new health features and improved performance.', 399.99, 5),
(77, 'Xiaomi 14 Pro', 'Flagship smartphone with Snapdragon 8 Gen 3 and Leica camera system.', 949.99, 6),
(78, 'Xiaomi Redmi Note 13 Pro', 'Affordable smartphone with great performance and a 200MP camera.', 499.99, 6),
(79, 'Xiaomi Mi 12 Ultra', 'Top-tier smartphone with advanced AI and fast charging capabilities.', 799.99, 6),
(80, 'Xiaomi Mi Band 8', 'Fitness tracker with AMOLED display and advanced health tracking features.', 49.99, 6),
(81, 'Xiaomi Electric Scooter 5', 'Latest electric scooter with better range and performance.', 699.99, 6),
(82, 'Xiaomi Watch 2 Pro', 'Smartwatch with advanced fitness tracking and 14-day battery life.', 199.99, 6),
(83, 'Google Pixel 8 Pro', 'Flagship phone with Tensor G3 chip and exceptional camera performance.', 999.99, 7),
(84, 'Google Pixel 8', 'Affordable Pixel phone with great performance and software optimization.', 799.99, 7),
(85, 'Google Pixel Fold', 'Foldable phone with Tensor chip and high-end display for multitasking.', 1799.99, 7),
(92, 'iPhone 13', 'Apple iPhone 13 sa 128GB memorije', 899.99, 4),
(93, 'iPhone 13 Pro', 'Apple iPhone 13 Pro sa vrhunskim kamerama', 1099.99, 4),
(94, 'iPhone 14', 'Apple iPhone 14 najnovije generacije', 999.99, 4),
(95, 'iPhone 14 Pro Max', 'Najmoćniji Apple telefon sa velikim ekranom', 1299.99, 4),
(96, 'iPhone SE 2022', 'Kompaktan i brz iPhone SE', 429.99, 4),
(97, 'iPhone 12 Mini', 'Mali ali snažan iPhone', 599.99, 4),
(98, 'iPhone 11', 'Pouzdan iPhone 11 sa odličnim performansama', 499.99, 4),
(99, 'iPhone XR', 'iPhone XR sa odličnim ekranom', 399.99, 4),
(100, 'iPhone XS Max', 'Premium iPhone iz prošle generacije', 649.99, 4),
(101, 'iPhone 15 Pro', 'Najnoviji iPhone sa titanijumskim okvirom', 1399.99, 4),
(102, 'Samsung Galaxy S21', 'Samsung flagship telefon', 799.99, 5),
(103, 'Samsung Galaxy S22', 'Nova generacija Galaxy S serije', 899.99, 5),
(104, 'Samsung Galaxy S22 Ultra', 'Snažan telefon sa S Pen-om', 1199.99, 5),
(105, 'Samsung Galaxy A52', 'Popularan srednji segment', 349.99, 5),
(106, 'Samsung Galaxy A72', 'Veliki ekran i dobra kamera', 449.99, 5),
(107, 'Samsung Galaxy M32', 'Baterijski šampion', 299.99, 5),
(108, 'Samsung Galaxy Z Flip 3', 'Preklopni telefon sa stilom', 999.99, 5),
(109, 'Samsung Galaxy Z Fold 4', 'Futuristički telefon sa velikim ekranom', 1599.99, 5),
(110, 'Samsung Galaxy S20 FE', 'Odličan balans cene i performansi', 599.99, 5),
(111, 'Samsung Galaxy Note 20', 'Veliki ekran i S Pen za produktivnost', 799.99, 5),
(112, 'Google Pixel 6', 'Google Pixel sa Tensor čipom', 699.99, 7),
(113, 'Google Pixel 6 Pro', 'Pro verzija sa boljim kamerama', 899.99, 7),
(114, 'Google Pixel 7', 'Novi dizajn i još bolji softver', 749.99, 7),
(115, 'Google Pixel 7 Pro', 'Vrhunska kamera i Android iskustvo', 949.99, 7),
(116, 'Google Pixel 5', 'Kompaktan i brz telefon', 599.99, 7),
(117, 'Google Pixel 4a', 'Odličan budžetski telefon', 349.99, 7),
(118, 'Google Pixel 3 XL', 'Stariji model sa velikim ekranom', 299.99, 7),
(119, 'Google Pixel Fold', 'Prvi sklopivi Pixel', 1599.99, 7),
(120, 'Google Pixel 8', 'Najnovija generacija Google telefona', 899.99, 7),
(121, 'Google Pixel 8 Pro', 'Profesionalni model sa naprednim AI funkcijama', 1099.99, 7),
(122, 'Iphone 17 Air', 'Slim Iphone 512GB', 1799.99, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `created_at`) VALUES
(4, 'aleksandar03', 'aleksandar3@gmail.com', '$2y$10$p0z9mlvHIaMd2fzPx0zhgufOTjd8R5Rqxfjo82phLn8Ty7Mu1A/mi', 'user', '2025-04-17 21:54:14'),
(6, 'admin1', 'admin@gmail.com', '$2y$10$k5EOVqhdAB4xv.XlgskBL.jyb1PKHMc3jnRoh4X9Qn.PSy2N3vOtm', 'admin', '2025-04-17 21:56:19'),
(7, 'bojan11', 'bojan@gmail.com', '$2y$10$J8CkCDDDk3m.J1KzXIwQhuOdo8E3k6I7j53Z.qMFobJUcr.TFIrBG', 'user', '2025-04-17 22:10:11'),
(8, 'bojana', 'bojana@gmail.com', '$2y$10$H8MG/WKRUEsNGEegMug3q.lKzBry8GcSnvz0F6f/PI.2uPUXuLNQC', 'user', '2025-04-18 09:03:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `cart_product`
--
ALTER TABLE `cart_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_id` (`cart_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `cart_product`
--
ALTER TABLE `cart_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `cart_product`
--
ALTER TABLE `cart_product`
  ADD CONSTRAINT `cart_product_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`id`),
  ADD CONSTRAINT `cart_product_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
