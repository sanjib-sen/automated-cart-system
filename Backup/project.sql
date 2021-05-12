-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2021 at 11:21 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `added_to`
--

CREATE TABLE `added_to` (
  `product_id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `added_to`
--

INSERT INTO `added_to` (`product_id`, `cart_id`, `quantity`) VALUES
(16, 1, 2),
(16, 2, 1),
(16, 3, 2),
(16, 4, 1),
(16, 5, 2),
(16, 6, 1),
(16, 7, 2),
(16, 8, 2),
(16, 9, 4),
(16, 10, 4),
(16, 11, 52),
(16, 12, 7),
(24, 2, 4),
(24, 5, 3),
(24, 7, 3),
(24, 8, 11),
(24, 10, 10),
(24, 12, 1),
(30, 12, 1);

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `user_id` varchar(30) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`user_id`, `password`) VALUES
('sanjib', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `billing`
--

CREATE TABLE `billing` (
  `made_for` int(11) NOT NULL,
  `bill_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `billing`
--

INSERT INTO `billing` (`made_for`, `bill_id`) VALUES
(2, 24),
(3, 25),
(4, 26),
(5, 27),
(6, 28),
(7, 29),
(8, 30),
(10, 31),
(11, 32),
(12, 33);

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `customer_id` int(11) NOT NULL,
  `bill_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bills`
--

INSERT INTO `bills` (`customer_id`, `bill_id`) VALUES
(14, 24),
(14, 25),
(14, 26),
(14, 27),
(15, 28),
(15, 29),
(16, 30),
(17, 31),
(17, 32),
(17, 33);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`) VALUES
(1),
(2),
(3),
(4),
(5),
(6),
(7),
(8),
(9),
(10),
(11),
(12);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone_no` varchar(14) NOT NULL,
  `join_date` datetime NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `name`, `phone_no`, `join_date`, `password`) VALUES
(14, 'Sanjib Kumar Sen', '1', '2021-05-08 14:54:14', '1'),
(15, 'Sanjib Kumar Sen', '01706968232', '2021-05-08 17:43:49', '12345'),
(16, 'Afroza', '111222', '2021-05-08 17:55:05', '12'),
(17, 'Andromeda Galaxy', '017', '2021-05-08 18:23:02', '1');

-- --------------------------------------------------------

--
-- Table structure for table `does`
--

CREATE TABLE `does` (
  `bill_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `does`
--

INSERT INTO `does` (`bill_id`, `customer_id`) VALUES
(24, 14),
(25, 14),
(26, 14),
(27, 14),
(28, 15),
(29, 15),
(30, 16),
(31, 17),
(32, 17),
(33, 17);

-- --------------------------------------------------------

--
-- Table structure for table `manages`
--

CREATE TABLE `manages` (
  `user_id` varchar(30) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `manages`
--

INSERT INTO `manages` (`user_id`, `product_id`) VALUES
('sanjib', 30);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `bill_id` int(11) NOT NULL,
  `payment_method` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`bill_id`, `payment_method`) VALUES
(24, 'nagad'),
(25, 'rocket'),
(26, 'bkash'),
(27, 'card'),
(28, 'nagad'),
(29, 'cash'),
(30, 'nagad'),
(31, 'nagad'),
(32, 'cash'),
(33, 'card');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `image` varchar(255) NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `description`, `price`, `image`, `category`, `stock`) VALUES
(16, 'Dell Laptop', 'core i5, 4 GB RAM', '1000', '0_sHL6zZcjCuVoSHy9.jfif60958ce01213c3.42073781', 'Tech', 50),
(24, 'Catto', 'Nice cat', '12', '87170886_544910046118068_4566536806815760384_n.jpg60968c233a29d8.75904110', 'Pet', 12),
(30, 'Hiii', 'Ok', '122', '182404023_4152483094802995_4202213613729721194_n.jpg6096bbe408f2c9.48752302', 'Pet', 12);

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `customer_id` int(11) NOT NULL,
  `user_id` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`customer_id`, `user_id`) VALUES
(14, 'sanjib'),
(15, 'sanjib'),
(16, 'sanjib'),
(17, 'sanjib');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `added_to`
--
ALTER TABLE `added_to`
  ADD PRIMARY KEY (`product_id`,`cart_id`),
  ADD KEY `cart_id_for_cart` (`cart_id`) USING BTREE;

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`user_id`) USING BTREE;

--
-- Indexes for table `billing`
--
ALTER TABLE `billing`
  ADD PRIMARY KEY (`made_for`,`bill_id`),
  ADD KEY `bill_id_forbilling` (`bill_id`);

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`customer_id`,`bill_id`),
  ADD KEY `bill_id_forbillings` (`bill_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`) USING BTREE;

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD UNIQUE KEY `customer_id` (`customer_id`) USING BTREE;

--
-- Indexes for table `does`
--
ALTER TABLE `does`
  ADD PRIMARY KEY (`bill_id`) USING BTREE;

--
-- Indexes for table `manages`
--
ALTER TABLE `manages`
  ADD PRIMARY KEY (`user_id`,`product_id`),
  ADD KEY `product_id_manages` (`product_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`bill_id`,`payment_method`) USING BTREE;

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`) USING BTREE;

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`customer_id`,`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `does`
--
ALTER TABLE `does`
  MODIFY `bill_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `added_to`
--
ALTER TABLE `added_to`
  ADD CONSTRAINT `cart_id_for_addingProducts` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`cart_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_id_toCart` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `billing`
--
ALTER TABLE `billing`
  ADD CONSTRAINT `bill_id_forbilling` FOREIGN KEY (`bill_id`) REFERENCES `does` (`bill_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_id_for_biling` FOREIGN KEY (`made_for`) REFERENCES `cart` (`cart_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bills`
--
ALTER TABLE `bills`
  ADD CONSTRAINT `bill_id_forbillings` FOREIGN KEY (`bill_id`) REFERENCES `does` (`bill_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `customer_id_bill` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `does`
--
ALTER TABLE `does`
  ADD CONSTRAINT `Customer` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `manages`
--
ALTER TABLE `manages`
  ADD CONSTRAINT `Admin_manages` FOREIGN KEY (`user_id`) REFERENCES `admin` (`user_id`),
  ADD CONSTRAINT `Product` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `bill_id_inPayment` FOREIGN KEY (`bill_id`) REFERENCES `does` (`bill_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `register`
--
ALTER TABLE `register`
  ADD CONSTRAINT `customer_id` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `admin` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
