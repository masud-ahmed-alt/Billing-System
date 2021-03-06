-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 22, 2022 at 07:12 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `selldb`
--

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE `bill` (
  `bill_id` varchar(50) NOT NULL,
  `total_amount` decimal(10,0) NOT NULL,
  `total_gst` decimal(10,0) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cid` int(11) NOT NULL,
  `ctitle` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cid`, `ctitle`) VALUES
(8, 'Dairy'),
(9, 'Beauty'),
(10, 'Cosmetics'),
(11, 'Grocery'),
(12, 'Dry Food'),
(13, 'Phone');

-- --------------------------------------------------------

--
-- Table structure for table `employe`
--

CREATE TABLE `employe` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` text NOT NULL,
  `address` text NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employe`
--

INSERT INTO `employe` (`id`, `user_id`, `username`, `password`, `address`, `image`) VALUES
(2, 2, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Dhubri', '1644087671OIP (1).jpg');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `iid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `qnt_in_hand` int(11) NOT NULL,
  `sell_price` decimal(10,0) NOT NULL,
  `buy_price` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`iid`, `pid`, `qnt_in_hand`, `sell_price`, `buy_price`) VALUES
(11, 7, 4, '220', '180'),
(12, 8, 10, '60', '55'),
(13, 9, 13, '210', '200'),
(14, 10, 50, '130', '100');

-- --------------------------------------------------------

--
-- Table structure for table `inv_supplier`
--

CREATE TABLE `inv_supplier` (
  `id` int(11) NOT NULL,
  `supplier` int(11) NOT NULL,
  `inv_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `qnt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `pid` int(11) NOT NULL,
  `pname` varchar(50) NOT NULL,
  `pcat` int(11) NOT NULL,
  `barcode` int(11) DEFAULT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pid`, `pname`, `pcat`, `barcode`, `description`) VALUES
(7, 'Mustured Oil', 11, NULL, '1L Fortune'),
(8, 'Coconut Oil', 9, NULL, '100g Parachut'),
(9, 'Arabian Dates', 12, NULL, '500g Packet.'),
(10, 'oil', 9, NULL, '100ml of bottle');

-- --------------------------------------------------------

--
-- Table structure for table `sell_product`
--

CREATE TABLE `sell_product` (
  `bill_id` varchar(50) NOT NULL,
  `product_id` varchar(25) NOT NULL,
  `qnt` int(11) NOT NULL,
  `desc` text NOT NULL,
  `sell_price` decimal(10,0) NOT NULL,
  `buy_price` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `user_id`, `address`) VALUES
(4, 18, 'Guwahati'),
(5, 19, 'Dhubri');

-- --------------------------------------------------------

--
-- Table structure for table `temp_product`
--

CREATE TABLE `temp_product` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `session_id` text NOT NULL,
  `qnt` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `mobile`, `email`) VALUES
(2, 'Masud Ahmed', '9876543210', 'abc@abc.com'),
(18, 'Surya Grocery', '9876543210', 'surya@surya.com'),
(19, 'JDB Store', '9876543211', 'jdb@jdb.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`bill_id`),
  ADD KEY `bill_ibfk_1` (`emp_id`),
  ADD KEY `bill_ibfk_2` (`customer_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `employe`
--
ALTER TABLE `employe`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employe_ibfk_1` (`user_id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`iid`),
  ADD KEY `pid` (`pid`);

--
-- Indexes for table `inv_supplier`
--
ALTER TABLE `inv_supplier`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inv_id` (`inv_id`),
  ADD KEY `supplier` (`supplier`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pid`),
  ADD KEY `pcat` (`pcat`);

--
-- Indexes for table `sell_product`
--
ALTER TABLE `sell_product`
  ADD PRIMARY KEY (`bill_id`,`product_id`,`qnt`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `temp_product`
--
ALTER TABLE `temp_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `employe`
--
ALTER TABLE `employe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `iid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `inv_supplier`
--
ALTER TABLE `inv_supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `temp_product`
--
ALTER TABLE `temp_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bill`
--
ALTER TABLE `bill`
  ADD CONSTRAINT `bill_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `bill_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `employe`
--
ALTER TABLE `employe`
  ADD CONSTRAINT `employe_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `products` (`pid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inv_supplier`
--
ALTER TABLE `inv_supplier`
  ADD CONSTRAINT `inv_supplier_fk` FOREIGN KEY (`supplier`) REFERENCES `supplier` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `inv_supplier_ibfk_1` FOREIGN KEY (`inv_id`) REFERENCES `inventory` (`iid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`pcat`) REFERENCES `category` (`cid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `supplier`
--
ALTER TABLE `supplier`
  ADD CONSTRAINT `supplier_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `temp_product`
--
ALTER TABLE `temp_product`
  ADD CONSTRAINT `temp_product_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`pid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
