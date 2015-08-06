-- phpMyAdmin SQL Dump
-- version 4.4.9
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Aug 05, 2015 at 03:02 PM
-- Server version: 5.5.42
-- PHP Version: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `allergen`
--

INSERT INTO `allergen` (`allergen_id`, `allergen_name`) VALUES
(8, 'cereals'),
(2, 'cow milk'),
(3, 'eggs'),
(4, 'fish or shellfish'),
(5, 'fruits'),
(6, 'peanuts'),
(1, 'soya'),
(7, 'tree nuts');

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
  `business_address` text,
  `business_address_lat` float(10,6) NOT NULL,
  `business_address_lng` float(10,6) NOT NULL,
  `cuisine_type_id` int(11) NOT NULL,
  `type` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `business`
--

INSERT INTO `business` (`business_id`, `business_name`, `create_time`, `business_contact`, `business_email`, `owner_id`, `business_type_id`, `business_area_id`, `business_address`, `business_address_lat`, `business_address_lng`, `cuisine_type_id`, `type`) VALUES
(2, 'g8food', '2015-08-01 13:33:08', 88882822, 'g8food@gmail.com', 30, 4, 2, '48 Blarney Street, Cork, Ireland', 51.901756, -8.483963, 5, 'bar'),
(3, 'Farmgate CafÃ©', '2015-08-01 14:15:02', 214278134, 'marketcafe@farmgate.ie', 31, 2, 2, 'English Market, Cork,Ireland', 51.897999, -8.474000, 3, 'restaurant'),
(4, 'Jackie Lennoxâ€™s', '2015-08-01 14:21:14', 214316118, 'jackielennoxs@gmail.com', 32, 1, 2, '137 Bandon Road, Cork, Ireland', 51.892258, -8.483498, 3, 'bar'),
(5, 'Electric', '2015-08-01 14:29:23', 214222990, 'Book@ElectricCork.com', 33, 2, 2, '41 South Mall, Cork, Ireland', 51.896145, -8.473382, 3, 'bar'),
(6, 'Jumbo Chinese Takeaway', '2015-08-01 14:35:37', 214395255, 'jumbocork@gmail.com', 34, 1, 2, '48 Shandon Street, Cork, Ireland', 51.902367, -8.478544, 1, 'restaurant'),
(8, 'Feed your Senses', '2015-08-01 14:44:26', 214274633, 'feedsensescork@gmail.com', 35, 2, 2, '27 Washington Street, Cork, Ireland', 51.897522, -8.479918, 7, 'restaurant'),
(9, 'Miyazaki', '2015-08-01 14:50:27', 214312716, 'miyazakicork@gmail.com', 36, 1, 2, '1A Evergreen Street, Cork, Ireland', 51.894611, -8.476372, 2, 'bar'),
(10, 'Subway Victoria', '2015-08-01 14:58:24', 214545444, 'subwayvictoria@gmail.com', 37, 5, 2, '2-6 Victoria Cross, Cork, Ireland', 51.892635, -8.504863, 4, 'restaurant'),
(11, 'Dreamfood', '2015-08-01 21:20:16', 877187387, 'dreamunicornchn@gmail.com', 38, 5, 2, '21 Blarney Street, Cork, Ireland', 51.902081, -8.480857, 1, 'bar');

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `business_type`
--

INSERT INTO `business_type` (`business_type_id`, `business_type_name`) VALUES
(1, 'takeaway'),
(2, 'restaurant'),
(3, 'delifood'),
(4, 'fastfood'),
(5, 'homemade');

-- --------------------------------------------------------

--
-- Table structure for table `cuisine_type`
--

CREATE TABLE `cuisine_type` (
  `cuisine_type_id` int(11) NOT NULL,
  `cuisine_name` varchar(32) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cuisine_type`
--

INSERT INTO `cuisine_type` (`cuisine_type_id`, `cuisine_name`) VALUES
(1, 'Chinese'),
(2, 'Japanese'),
(3, 'Irish'),
(4, 'American'),
(5, 'French'),
(6, 'Italian'),
(7, 'Spanish'),
(8, 'Thai'),
(9, 'Mexican'),
(10, 'Indian'),
(11, 'Turkish'),
(12, 'Middle East');

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
-- Table structure for table `markers`
--

CREATE TABLE `markers` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `address` varchar(80) NOT NULL,
  `lat` float(10,6) NOT NULL,
  `lng` float(10,6) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `markers`
--

INSERT INTO `markers` (`id`, `name`, `address`, `lat`, `lng`) VALUES
(1, 'Frankie Johnnie & Luigo Too', '939 W El Camino Real, Mountain View, CA', 37.386337, -122.085823),
(2, 'Amici''s East Coast Pizzeria', '790 Castro St, Mountain View, CA', 37.387138, -122.083237),
(3, 'Kapp''s Pizza Bar & Grill', '191 Castro St, Mountain View, CA', 37.393887, -122.078918),
(4, 'Round Table Pizza: Mountain View', '570 N Shoreline Blvd, Mountain View, CA', 37.402653, -122.079353),
(5, 'Tony & Alba''s Pizza & Pasta', '619 Escuela Ave, Mountain View, CA', 37.394012, -122.095528),
(6, 'Oregano''s Wood-Fired Pizza', '4546 El Camino Real, Los Altos, CA', 37.401726, -122.114647);

-- --------------------------------------------------------

--
-- Table structure for table `meal`
--

CREATE TABLE `meal` (
  `meal_id` int(11) NOT NULL,
  `meal_name` varchar(255) NOT NULL,
  `meal_available` tinyint(1) NOT NULL,
  `meal_price` float NOT NULL,
  `meal_prepare_time` datetime NOT NULL,
  `meal_description` varchar(255) DEFAULT NULL,
  `meal_allergen_id` int(11) NOT NULL,
  `meal_image_route` varchar(255) NOT NULL
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
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `owner_business`
--

INSERT INTO `owner_business` (`owner_id`, `username`, `email`, `password`, `create_time`, `owner_fullname`, `owner_contact`) VALUES
(30, 'g8', 'g8@gmail.com', 'qq', '2015-08-01 13:27:21', 'g8', 888888),
(31, 'Dave Farmgate', 'g1@gmail.com', 'qqqq', '2015-08-01 14:08:07', 'Farmgate CafÃ© Boss', 1111111),
(32, 'Dave Lennox', 'g2@gmail.com', 'qqqq', '2015-08-01 14:16:52', 'Dave Lennox', 2222222),
(33, 'Dave Elec', 'g3@gmail.com', 'qqqq', '2015-08-01 14:23:32', 'Electic boss', 3333333),
(34, 'Jumbo boss', 'g4@gmail.com', 'qqqq', '2015-08-01 14:32:39', 'Dave Jumbo', 1234567),
(35, 'Feed sense boss', 'g5@gmail.com', 'qqqq', '2015-08-01 14:38:59', 'Dave Feed Sense', 5555555),
(36, 'Miyaza boss', 'g6@gmail.com', 'qqqq', '2015-08-01 14:46:43', 'Jack Miyaza', 6666666),
(37, 'Subway boss', 'g7@gmail.com', 'qqqq', '2015-08-01 14:56:02', 'john Subway', 7777777),
(38, 'Coin', 'g9@gmail.com', 'qqqq', '2015-08-01 21:19:03', 'Coin Green', 877187387),
(39, 'g10user', 'g10@gmail.com', 'qqqq', '2015-08-03 20:37:05', 'g10food', 110000110),
(40, '', '', '', '2015-08-05 00:34:10', '', 0);

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
  ADD KEY `business_area_id_idx` (`business_area_id`),
  ADD KEY `cuisine_type_id` (`cuisine_type_id`);

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
-- Indexes for table `cuisine_type`
--
ALTER TABLE `cuisine_type`
  ADD PRIMARY KEY (`cuisine_type_id`),
  ADD UNIQUE KEY `cuisine_type_id_UNIQUE` (`cuisine_type_id`),
  ADD KEY `cuisine_type_id` (`cuisine_type_id`);

--
-- Indexes for table `job_ranger`
--
ALTER TABLE `job_ranger`
  ADD PRIMARY KEY (`job_ranger_id`),
  ADD UNIQUE KEY `job_ranger_id_UNIQUE` (`job_ranger_id`),
  ADD KEY `user_id_idx` (`user_id`);

--
-- Indexes for table `markers`
--
ALTER TABLE `markers`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `allergen_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
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
  MODIFY `business_type_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `cuisine_type`
--
ALTER TABLE `cuisine_type`
  MODIFY `cuisine_type_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `job_ranger`
--
ALTER TABLE `job_ranger`
  MODIFY `job_ranger_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `markers`
--
ALTER TABLE `markers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
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
  MODIFY `owner_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=41;
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
  ADD CONSTRAINT `cuisine_type_id` FOREIGN KEY (`cuisine_type_id`) REFERENCES `cuisine_type` (`cuisine_type_id`),
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
