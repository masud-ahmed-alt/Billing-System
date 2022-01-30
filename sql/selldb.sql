-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 30, 2022 at 08:02 PM
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

--
-- Dumping data for table `bill`
--

INSERT INTO `bill` (`bill_id`, `total_amount`, `total_gst`, `customer_id`, `emp_id`, `date`) VALUES
('OD20221643555957', '5940', '1069', 7, 2, '2022-01-30 20:49:17'),
('OD20221643556191', '5940', '1069', 7, 2, '2022-01-30 20:53:11'),
('OD20221643556254', '11308', '2035', 2, 2, '2022-01-30 20:54:14'),
('OD20221643556477', '22', '4', 7, 2, '2022-01-30 20:57:57'),
('OD20221643556558', '22', '4', 7, 2, '2022-01-30 20:59:18'),
('OD20221643556624', '5500', '990', 2, 2, '2022-01-30 21:00:24'),
('OD20221643557214', '660', '119', 11, 2, '2022-01-30 21:10:14'),
('OD20221643559355', '16720', '3010', 12, 2, '2022-01-30 21:45:55');

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
(1, 'Dairy'),
(2, 'Grocery'),
(3, 'Perfumes'),
(5, 'Foods');

-- --------------------------------------------------------

--
-- Table structure for table `employe`
--

CREATE TABLE `employe` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` text NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employe`
--

INSERT INTO `employe` (`id`, `user_id`, `username`, `password`, `address`) VALUES
(1, 1, 'shahid', '81dc9bdb52d04dc20036dbd8313ed055', 'Dhubri, Assam'),
(2, 2, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Dhubri');

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
(2, 2, 845, '22', '444'),
(3, 3, 45, '5500', '5000'),
(4, 1, 75, '5500', '5000'),
(5, 4, 50, '220', '180');

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

--
-- Dumping data for table `inv_supplier`
--

INSERT INTO `inv_supplier` (`id`, `supplier`, `inv_id`, `date`, `qnt`) VALUES
(1, 2, 2, '2022-01-22 19:34:14', 200),
(14, 2, 2, '2022-01-23 07:24:50', 400),
(15, 2, 5, '2022-01-29 19:31:27', 50);

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
(1, 'LavaPhone', 1, NULL, '35g of pack'),
(2, 'Dove Shampoo', 2, NULL, '35g of pack'),
(3, 'Coconut Oil', 3, NULL, '100ml of bottle'),
(4, 'Mustured Oil', 2, NULL, '1L Fortune');

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

--
-- Dumping data for table `sell_product`
--

INSERT INTO `sell_product` (`bill_id`, `product_id`, `qnt`, `desc`, `sell_price`, `buy_price`) VALUES
('OD20221643555957', '3', 1, '100ml of bottle', '5500', '5000'),
('OD20221643555957', '4', 2, '1L Fortune', '220', '180'),
('OD20221643556191', '3', 1, '100ml of bottle', '5500', '5000'),
('OD20221643556191', '4', 2, '1L Fortune', '220', '180'),
('OD20221643556254', '1', 2, '35g of pack', '5500', '5000'),
('OD20221643556254', '2', 4, '35g of pack', '22', '444'),
('OD20221643556254', '4', 1, '1L Fortune', '220', '180'),
('OD20221643556477', '2', 1, '35g of pack', '22', '444'),
('OD20221643556558', '2', 1, '35g of pack', '22', '444'),
('OD20221643556624', '3', 1, '100ml of bottle', '5500', '5000'),
('OD20221643557214', '4', 3, '1L Fortune', '220', '180'),
('OD20221643559355', '1', 1, '35g of pack', '5500', '5000'),
('OD20221643559355', '3', 2, '100ml of bottle', '5500', '5000'),
('OD20221643559355', '4', 1, '1L Fortune', '220', '180');

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
(2, 5, 'Ghy');

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
(1, 'shahid siddique', '7002198549', 'shahid@gmail.com'),
(2, 'Masud Ahmed', '9101743618', 'ma7332125@gmail.com'),
(5, 'Surya Grocery', '9876543210', 'surya@su.com'),
(7, 'Masud Ahmed', '8822915901', NULL),
(10, 'Inzamul', '8402098761', NULL),
(11, 'Inzamul2', '8402098762', NULL),
(12, 'Sample Name', '8402098763', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`bill_id`),
  ADD KEY `bill_ibfk_1` (`emp_id`),
  ADD KEY `customer_id` (`customer_id`);

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
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `employe`
--
ALTER TABLE `employe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `iid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `inv_supplier`
--
ALTER TABLE `inv_supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `temp_product`
--
ALTER TABLE `temp_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
  ADD CONSTRAINT `inv_supplier_fk` FOREIGN KEY (`supplier`) REFERENCES `supplier` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `inv_supplier_ibfk_1` FOREIGN KEY (`inv_id`) REFERENCES `inventory` (`iid`) ON DELETE CASCADE ON UPDATE NO ACTION;

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
