-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 25, 2026 at 12:36 AM
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
-- Database: `moonbite`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(2, 'Morning Lunar Bites (Breakfast & Brunch)'),
(3, 'Star-Studded Light Meals (Wraps & Sandwiches)'),
(4, 'Earth & Sea Bowls (Salads & Grain Bowls)'),
(8, 'Cosmic Cravings & Fast Bites (Appetizers)'),
(9, 'Stellar Sips (Drinks & Desserts)');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `first_name`, `last_name`, `email`, `password`, `phone`, `address`) VALUES
(1, 'Admin', 'Test', 'admin@test.com', 'madhu123', '0771234567', 'Colombo'),
(2, 'Thusha', 'Mathivannan', 'Thusham@gmail.com', NULL, '0771254894', 'Batticaloa'),
(3, 'David', 'Thusha', 'david2003@gmail.com', 'david123', '0776552123', 'Kalmunai'),
(5, 'Test', 'Customer', 'test@gmail.com', 'test123', '0771231234', 'Kalmunai');

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `food_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `food_name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `availability` enum('Available','Unavailable') DEFAULT 'Available',
  `featured` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`food_id`, `category_id`, `food_name`, `description`, `price`, `image`, `availability`, `featured`) VALUES
(1, 2, 'Moonlight Pancakes', 'Fluffy buttermilk pancakes topped with local bee honey, fresh bananas, and toasted coconut flakes.', 300.00, 'moonlight_pancake.jpg', 'Available', 1),
(3, 3, 'Twilight Chicken Wrap', 'Grilled chicken tossed in a creamy cilantro-lime sauce, wrapped with crisp lettuce and roasted peppers.', 900.00, 'twilight_chickenwrap.jpg', 'Available', 0),
(4, 4, 'Apollo Salad', 'Crisp greens, grilled local prawns or chicken, tossed with mango, feta cheese, and a light citrus vinaigrette.', 1000.00, '1782209983_apollo_salad.jpg', 'Available', 0),
(5, 3, 'Eclipse Panini', 'Pan-seared halloumi or paneer with fresh pesto, ripe tomatoes, and rocket on pressed ciabatta.', 1400.00, '1782222929_eclipse_panini.jpg', 'Available', 0),
(6, 2, 'Avocado Starlight Toast', 'Sourdough topped with smashed avocado, a perfectly poached egg, and a drizzle of chili oil.', 1600.00, '1782222979_avocado_starlighttoast.jpg', 'Available', 0),
(7, 9, 'Midnight Lava Cake', 'A warm, decadent chocolate cake with a molten center, served with a scoop of vanilla ice cream.', 800.00, '1782223162_midnight_lava_cake.jpg', 'Available', 1),
(8, 9, 'The Blue Moon Latte', 'Signature iced latte featuring subtle vanilla and blue spirulina for a stunning visual effect.', 1200.00, '1782223283_blue_moon_latte.jpg', 'Available', 0),
(9, 8, 'Meteor Bites', 'Bite-sized, crispy chicken pops dusted with a sweet and spicy glaze.', 1000.00, '1782223508_chicken_pops.jpg', 'Available', 0),
(10, 8, 'Loaded Cosmic Fries', 'Golden fries topped with melted cheese, minced beef or chicken, and jalapenos.', 2200.00, '1782223599_cosmic_fries.jpg', 'Available', 1),
(11, 2, 'Cosmic Croissant Sandwich', 'Flaky croissant filled with scrambled eggs, melted cheddar, and crispy chicken bacon.', 1350.00, '1782242517_croissant_sandwich.jpg', 'Available', 0),
(12, 4, 'Midnight Glow Tomato Basil', 'Rich and comforting roasted tomato soup topped with toasted pine nuts and a basil drizzle.', 350.00, '1782242679_midnight_tomato_basil.jpg', 'Available', 0),
(13, 9, 'Cheesecake Parfaits', 'Layered graham cracker crumble, rich cheesecake filling, and seasonal fruit compote in a grab-and-go jar.', 950.00, '1782242808_cheesecake_parfaits.jpg', 'Available', 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `order_date` datetime DEFAULT current_timestamp(),
  `total_amount` decimal(10,2) NOT NULL,
  `status` enum('Pending','Accepted','Preparing','Ready','Completed','Rejected') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `customer_id`, `order_date`, `total_amount`, `status`) VALUES
(1, 1, '2026-06-23 01:58:27', 600.00, 'Accepted'),
(2, 2, '2026-06-23 14:09:23', 2100.00, 'Accepted'),
(3, 2, '2026-06-23 14:15:37', 2100.00, 'Pending'),
(5, 3, '2026-06-23 14:37:51', 300.00, 'Pending'),
(6, 5, '2026-06-23 15:52:14', 2000.00, 'Accepted'),
(7, 3, '2026-06-25 01:12:03', 2600.00, 'Pending'),
(8, 3, '2026-06-25 01:23:24', 2350.00, 'Pending'),
(9, 3, '2026-06-25 01:45:34', 1950.00, 'Pending'),
(10, 3, '2026-06-25 01:50:16', 1950.00, 'Accepted'),
(11, 3, '2026-06-25 02:42:34', 1000.00, 'Preparing'),
(12, 3, '2026-06-25 03:26:58', 1000.00, 'Pending'),
(13, 5, '2026-06-25 03:42:51', 3600.00, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`order_item_id`, `order_id`, `food_id`, `quantity`, `price`) VALUES
(1, 1, 1, 2, 300.00),
(2, 2, 1, 7, 300.00),
(3, 3, 3, 2, 900.00),
(4, 3, 1, 1, 300.00),
(7, 5, 1, 1, 300.00),
(8, 6, 4, 2, 1000.00),
(10, 10, 13, 1, 950.00),
(11, 10, 9, 1, 1000.00),
(12, 11, 4, 1, 1000.00),
(13, 12, 4, 1, 1000.00),
(14, 13, 9, 2, 1000.00),
(15, 13, 6, 1, 1600.00);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Admin','Staff') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `name`, `email`, `password`, `role`) VALUES
(1, 'Administrator', 'admin@moonbite.com', 'admin123', 'Admin'),
(2, 'David Thusha', 'david@moonbite.com', 'david123', 'Staff'),
(4, 'Peter Parker', 'peter@moonbite.com', 'peter123', 'Staff');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`food_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `food_id` (`food_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `food_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `food`
--
ALTER TABLE `food`
  ADD CONSTRAINT `food_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE;

--
-- Constraints for table `order_item`
--
ALTER TABLE `order_item`
  ADD CONSTRAINT `order_item_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_item_ibfk_2` FOREIGN KEY (`food_id`) REFERENCES `food` (`food_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
