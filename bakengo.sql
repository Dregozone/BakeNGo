-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2020 at 01:44 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bakengo`
--

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE `discounts` (
  `id` int(11) NOT NULL,
  `orderId` int(11) NOT NULL,
  `totalSavings` float NOT NULL,
  `totalPayment` float NOT NULL,
  `dateDiscountApplied` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Record discounts at an item level';

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `name` varchar(55) NOT NULL,
  `email` varchar(55) NOT NULL,
  `message` text NOT NULL,
  `dateAdded` datetime NOT NULL,
  `resolved` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Record user inputs from contacts page';

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `name`, `email`, `message`, `dateAdded`, `resolved`) VALUES
(5, 'Anders', 'a@b.net', 'test2', '2020-01-10 21:43:17', 0),
(6, 'Anders', 'a@b.net', 'another msg', '2020-01-10 21:44:58', 0),
(7, 'Anders', 'a@b.net', 'new message test', '2020-01-12 10:15:14', 0),
(8, 'Anders', 'a@b.net', 'remote session', '2020-01-16 17:15:11', 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `productQty` int(11) NOT NULL,
  `discountUsed` tinyint(1) NOT NULL,
  `orderPlacedDate` datetime NOT NULL,
  `orderComplete` tinyint(1) NOT NULL,
  `orderCompleteDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `userId`, `productId`, `productQty`, `discountUsed`, `orderPlacedDate`, `orderComplete`, `orderCompleteDate`) VALUES
(1, 1, 1, 2, 0, '2020-01-10 10:00:00', 0, '0000-00-00 00:00:00'),
(1, 1, 2, 2, 0, '2020-01-10 10:00:00', 0, '0000-00-00 00:00:00'),
(1, 1, 2, 2, 0, '2020-01-10 10:00:00', 0, '0000-00-00 00:00:00'),
(2, 1, 3, 3, 0, '2020-01-10 00:00:00', 0, '0000-00-00 00:00:00'),
(2, 1, 2, 9, 0, '2020-01-10 00:00:00', 0, '0000-00-00 00:00:00'),
(3, 1, 1, 0, 1, '2020-01-12 12:12:54', 0, '1900-01-01 00:00:00'),
(3, 1, 2, 0, 1, '2020-01-12 12:12:54', 0, '1900-01-01 00:00:00'),
(3, 1, 3, 0, 0, '2020-01-12 12:12:54', 0, '1900-01-01 00:00:00'),
(4, 1, 1, 2, 1, '2020-01-12 12:15:35', 0, '1900-01-01 00:00:00'),
(4, 1, 2, 2, 1, '2020-01-12 12:15:35', 0, '1900-01-01 00:00:00'),
(4, 1, 3, 2, 0, '2020-01-12 12:15:35', 0, '1900-01-01 00:00:00'),
(5, 1, 1, 6, 0, '2020-01-12 12:22:53', 0, '1900-01-01 00:00:00'),
(5, 1, 2, 5, 0, '2020-01-12 12:22:53', 0, '1900-01-01 00:00:00'),
(5, 1, 3, 7, 0, '2020-01-12 12:22:53', 0, '1900-01-01 00:00:00'),
(6, 2, 2, 1, 1, '2020-01-12 12:28:11', 0, '1900-01-01 00:00:00'),
(7, 1, 1, 1, 1, '2020-01-16 17:17:56', 0, '1900-01-01 00:00:00'),
(7, 1, 2, 2, 1, '2020-01-16 17:17:56', 0, '1900-01-01 00:00:00'),
(7, 1, 3, 3, 0, '2020-01-16 17:17:56', 0, '1900-01-01 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(55) NOT NULL,
  `qtyAvailable` int(11) NOT NULL,
  `discountEligible` tinyint(1) NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `qtyAvailable`, `discountEligible`, `image`, `price`) VALUES
(1, 'Red Velvet Cake', 5, 1, 'Red Velvet Cake.jpg', 10),
(2, 'Cupcakes', 100, 1, 'Cupcakes.jpg', 8),
(3, 'Sesame Bread', 10, 0, 'Sesame Bread.jpg', 3.5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(55) NOT NULL,
  `password` varchar(55) NOT NULL,
  `email` varchar(55) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `memberSince` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `email`, `phone`, `memberSince`) VALUES
(1, 'Anders', 'abc1', 'a@b.net', '01234567891', '2019-12-30 05:07:19'),
(2, 'Emma', '', 'zzz@b.com', '321', '2019-12-30 16:15:50');

-- --------------------------------------------------------

--
-- Table structure for table `vouchers`
--

CREATE TABLE `vouchers` (
  `id` int(11) NOT NULL,
  `code` varchar(55) NOT NULL,
  `expiry` datetime NOT NULL,
  `numberOfUses` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vouchers`
--

INSERT INTO `vouchers` (`id`, `code`, `expiry`, `numberOfUses`) VALUES
(1, 'voucher', '2020-03-31 00:00:00', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vouchers`
--
ALTER TABLE `vouchers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vouchers`
--
ALTER TABLE `vouchers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
