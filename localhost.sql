-- phpMyAdmin SQL Dump
-- version 4.4.9
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Jul 27, 2015 at 03:25 PM
-- Server version: 5.5.42
-- PHP Version: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Summer_project`
--
--
-- Database: `spdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `allergen`
--

CREATE TABLE `allergen` (
  `allergen_id` int(11) NOT NULL,
  `allergen_name` varchar(32) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `allergen`
--

INSERT INTO `allergen` (`allergen_id`, `allergen_name`) VALUES
(2, 'milk'),
(1, 'soya');

-- --------------------------------------------------------

--
-- Table structure for table `business`
--

CREATE TABLE `business` (
  `business_id` int(11) NOT NULL,
  `business_name` varchar(32) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `business_contact` int(11) DEFAULT NULL,
  `business_email` varchar(64) DEFAULT NULL,
  `owner_id` int(11) NOT NULL,
  `business_type_id` int(11) NOT NULL,
  `business_area_id` int(11) NOT NULL,
  `business_address` text
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `business`
--

INSERT INTO `business` (`business_id`, `business_name`, `create_time`, `business_contact`, `business_email`, `owner_id`, `business_type_id`, `business_area_id`, `business_address`) VALUES
(5, 'shusiking', '2015-07-23 19:28:53', 3332222, 'greg@gmail.com', 3, 2, 2, ''),
(6, 'Gregfood', '2015-07-23 19:31:22', 2147483647, 'greglee@gmail.com', 4, 2, 2, '21 Blarney Street, Cork, Ireland'),
(11, 'Jumbo', '2015-07-23 23:39:45', 21223322, 'jumbo@gmail.com', 8, 1, 2, '22 Shandon Street, Cork, Ireland');

-- --------------------------------------------------------

--
-- Table structure for table `business_city`
--

CREATE TABLE `business_city` (
  `business_area_id` int(11) NOT NULL,
  `business_area_name` varchar(32) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `business_city`
--

INSERT INTO `business_city` (`business_area_id`, `business_area_name`) VALUES
(2, 'Cork'),
(1, 'Dublin'),
(3, 'Galway'),
(4, 'Limerick'),
(5, 'Waterford');

-- --------------------------------------------------------

--
-- Table structure for table `business_type`
--

CREATE TABLE `business_type` (
  `business_type_id` int(11) NOT NULL,
  `business_type_name` varchar(32) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `business_type`
--

INSERT INTO `business_type` (`business_type_id`, `business_type_name`) VALUES
(1, 'takeaway'),
(2, 'restaurant'),
(3, 'delifood'),
(4, 'fastfood');

-- --------------------------------------------------------

--
-- Table structure for table `job_ranger`
--

CREATE TABLE `job_ranger` (
  `job_ranger_id` int(11) NOT NULL,
  `job_ranger_mobile` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `job_ranger_available` tinyint(1) NOT NULL,
  `job_ranger_pricerate` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `meal`
--

CREATE TABLE `meal` (
  `meal_id` int(11) NOT NULL,
  `meal_name` varchar(255) NOT NULL,
  `meal_available` tinyint(1) NOT NULL,
  `meal_price` int(11) NOT NULL,
  `meal_prepare_time` datetime NOT NULL,
  `mealcol` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `meal_allergen`
--

CREATE TABLE `meal_allergen` (
  `meal_allergen_id` int(11) NOT NULL,
  `allergen_id` int(11) NOT NULL,
  `meal_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `business_id` int(11) NOT NULL,
  `order_placed_time` datetime NOT NULL,
  `delivery_address_note` varchar(45) NOT NULL,
  `dispatch_time` datetime NOT NULL,
  `delivery_request` tinyint(1) NOT NULL,
  `create_time` datetime NOT NULL,
  `order_amount_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `owner_business`
--

CREATE TABLE `owner_business` (
  `owner_id` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(32) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `owner_fullname` varchar(32) NOT NULL,
  `owner_contact` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `owner_business`
--

INSERT INTO `owner_business` (`owner_id`, `username`, `email`, `password`, `create_time`, `owner_fullname`, `owner_contact`) VALUES
(1, '', 'gduagduadu@gmail.com', 'qqqq', '2015-07-22 14:55:49', 'jack lee', 2345645),
(2, 'dddd', 'ahdsuahdu@gmail.com', 'qqqq', '2015-07-22 14:58:07', 'fffee', 23444333),
(3, 'dream', 'yelp@gmail.com', 'qqqq', '2015-07-22 14:59:26', 'wwee', 122333433),
(4, 'greg', 'greg@gmail.com', '1111', '2015-07-22 15:41:44', 'greg lee', 566446),
(5, 'zhonglai', 'greglee@gmail.com', '1111', '2015-07-23 10:43:03', 'wwww wwww', 233444),
(6, 'btest1', 'businesstest1@gmail.com', 'test', '2015-07-23 23:13:32', 'business test', 122233322),
(7, 'businesstest2', 'businesstest2@gmail.com', 'test2', '2015-07-23 23:19:05', 'business test2', 1221211111),
(8, 'btest3', 'businesstest3@gmail.com', 'test3', '2015-07-23 23:38:32', 'business test3', 12211222),
(9, 'bt1', 'bt1@gmail.com', 'qqqq', '2015-07-24 00:58:42', 'bt1', 1111),
(10, 'bt3', 'bt3@gmail.com', 'test3', '2015-07-24 08:24:25', 'bt3', 2111111);

-- --------------------------------------------------------

--
-- Table structure for table `timestamps`
--

CREATE TABLE `timestamps` (
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_mobile` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `email`, `password`, `create_time`, `user_mobile`) VALUES
(1, 'dream', 'dreamunicornchn@gmail.com', 'bb900412', '2015-07-19 14:52:50', 838024695),
(2, 'mjsmsjs', 'mjskssk', 'password', '2015-07-19 15:44:28', NULL),
(3, 'asasasa', 'email', 'password', '2015-07-19 16:03:55', NULL),
(4, 'asasasa222', 'email', 'password', '2015-07-19 16:04:40', NULL),
(5, 'eeeee', 'dwwww', 'qqqq', '2015-07-19 22:33:57', NULL),
(6, 'dd', 'ddd', 'dd', '2015-07-21 12:14:10', NULL),
(8, 'www', 'wwww', 'ww', '2015-07-21 12:18:15', NULL),
(9, 'qqq', 'qqqq', 'qq', '2015-07-21 12:19:08', NULL),
(10, 'rrr', 'rrrr', 'rr', '2015-07-21 12:26:46', NULL),
(11, 'eee', 'eeee', 'ee', '2015-07-21 12:27:43', NULL),
(12, 'ttt', 'tttt', 'tt', '2015-07-21 13:06:40', NULL),
(13, 'yyy', 'yyyy', 'yy', '2015-07-21 13:18:25', NULL),
(14, 'uuu', 'uuuu', 'uu', '2015-07-21 13:24:08', NULL),
(15, 'iii', 'iiii', 'ii', '2015-07-21 13:25:24', NULL),
(16, 'ooo', 'oooo', 'oo', '2015-07-21 13:26:57', NULL),
(17, 'ppp', 'pppp', 'pp', '2015-07-21 13:29:29', NULL),
(18, 'aaa', 'aaaa', 'aa', '2015-07-21 13:34:38', NULL),
(19, 'sss', 'ssss', 'ss', '2015-07-21 13:37:29', NULL),
(20, 'sss', 'ssss', 'ss', '2015-07-21 14:10:40', NULL),
(21, 'fff', 'ffff', 'ff', '2015-07-22 12:01:16', NULL),
(22, 'yelp', 'yelp@gmail.com', 'qqqq', '2015-07-23 22:58:39', NULL),
(24, 'testuser1', 'test1@gmail.com', 'test', '2015-07-23 23:11:39', NULL),
(25, 'tom', 'tom@gmail.com', '1111', '2015-07-24 10:17:24', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `allergen`
--
ALTER TABLE `allergen`
  ADD PRIMARY KEY (`allergen_id`),
  ADD UNIQUE KEY `allergen_name_UNIQUE` (`allergen_name`),
  ADD UNIQUE KEY `allergen_id_UNIQUE` (`allergen_id`);

--
-- Indexes for table `business`
--
ALTER TABLE `business`
  ADD PRIMARY KEY (`business_id`,`business_type_id`,`business_area_id`),
  ADD UNIQUE KEY `username_UNIQUE` (`business_name`),
  ADD UNIQUE KEY `business_id_UNIQUE` (`business_id`),
  ADD UNIQUE KEY `owner_id_UNIQUE` (`owner_id`),
  ADD UNIQUE KEY `business_email_UNIQUE` (`business_email`),
  ADD UNIQUE KEY `business_contact_UNIQUE` (`business_contact`),
  ADD KEY `business_type_id_idx` (`business_type_id`),
  ADD KEY `business_area_id_idx` (`business_area_id`);

--
-- Indexes for table `business_city`
--
ALTER TABLE `business_city`
  ADD PRIMARY KEY (`business_area_id`),
  ADD UNIQUE KEY `business_area_id_UNIQUE` (`business_area_id`),
  ADD UNIQUE KEY `business_area_name_UNIQUE` (`business_area_name`);

--
-- Indexes for table `business_type`
--
ALTER TABLE `business_type`
  ADD PRIMARY KEY (`business_type_id`),
  ADD UNIQUE KEY `business_type_id_UNIQUE` (`business_type_id`);

--
-- Indexes for table `job_ranger`
--
ALTER TABLE `job_ranger`
  ADD PRIMARY KEY (`job_ranger_id`),
  ADD UNIQUE KEY `job_ranger_id_UNIQUE` (`job_ranger_id`),
  ADD KEY `user_id_idx` (`user_id`);

--
-- Indexes for table `meal`
--
ALTER TABLE `meal`
  ADD PRIMARY KEY (`meal_id`),
  ADD UNIQUE KEY `meal_id_UNIQUE` (`meal_id`),
  ADD UNIQUE KEY `meal_name_UNIQUE` (`meal_name`),
  ADD UNIQUE KEY `meal_price_UNIQUE` (`meal_price`);

--
-- Indexes for table `meal_allergen`
--
ALTER TABLE `meal_allergen`
  ADD PRIMARY KEY (`allergen_id`,`meal_id`,`meal_allergen_id`),
  ADD UNIQUE KEY `dish_allergen_id_UNIQUE` (`meal_allergen_id`),
  ADD KEY `dish_id_idx` (`meal_id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`order_id`,`order_amount_id`,`user_id`,`business_id`),
  ADD UNIQUE KEY `order_id_UNIQUE` (`order_id`),
  ADD KEY `user_id_idx` (`user_id`),
  ADD KEY `business_id_idx` (`business_id`);

--
-- Indexes for table `owner_business`
--
ALTER TABLE `owner_business`
  ADD PRIMARY KEY (`owner_id`),
  ADD UNIQUE KEY `user_id_UNIQUE` (`owner_id`),
  ADD UNIQUE KEY `owner_contact_UNIQUE` (`owner_contact`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_id_UNIQUE` (`user_id`),
  ADD UNIQUE KEY `user_contact_UNIQUE` (`user_mobile`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `allergen`
--
ALTER TABLE `allergen`
  MODIFY `allergen_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `business`
--
ALTER TABLE `business`
  MODIFY `business_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `business_city`
--
ALTER TABLE `business_city`
  MODIFY `business_area_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `business_type`
--
ALTER TABLE `business_type`
  MODIFY `business_type_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `job_ranger`
--
ALTER TABLE `job_ranger`
  MODIFY `job_ranger_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `meal`
--
ALTER TABLE `meal`
  MODIFY `meal_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `meal_allergen`
--
ALTER TABLE `meal_allergen`
  MODIFY `meal_allergen_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `owner_business`
--
ALTER TABLE `owner_business`
  MODIFY `owner_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `business`
--
ALTER TABLE `business`
  ADD CONSTRAINT `business_area_id` FOREIGN KEY (`business_area_id`) REFERENCES `business_city` (`business_area_id`),
  ADD CONSTRAINT `business_type_id` FOREIGN KEY (`business_type_id`) REFERENCES `business_type` (`business_type_id`),
  ADD CONSTRAINT `owner_id` FOREIGN KEY (`owner_id`) REFERENCES `owner_business` (`owner_id`);

--
-- Constraints for table `meal_allergen`
--
ALTER TABLE `meal_allergen`
  ADD CONSTRAINT `allergen_id` FOREIGN KEY (`allergen_id`) REFERENCES `allergen` (`allergen_id`),
  ADD CONSTRAINT `meal_id` FOREIGN KEY (`meal_id`) REFERENCES `meal` (`meal_id`);

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `business_id` FOREIGN KEY (`business_id`) REFERENCES `business` (`business_id`),
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
