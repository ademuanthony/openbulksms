-- phpMyAdmin SQL Dump
-- version 4.3.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 19, 2015 at 02:30 AM
-- Server version: 5.5.40-36.1
-- PHP Version: 5.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `billioss_tywenjy`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `userName` varchar(128) NOT NULL,
  `password` varchar(265) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bulksms`
--

CREATE TABLE IF NOT EXISTS `bulksms` (
  `id` int(11) NOT NULL,
  `loginId` varchar(50) NOT NULL,
  `sender` varchar(18) NOT NULL,
  `message` text NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL,
  `count` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=346 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cards`
--

CREATE TABLE IF NOT EXISTS `cards` (
  `id` int(11) NOT NULL,
  `serialNumber` varchar(5) NOT NULL,
  `pin` varchar(128) NOT NULL,
  `unit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(11) NOT NULL,
  `groupId` int(11) NOT NULL,
  `number` varchar(18) NOT NULL,
  `name` varchar(128) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=187 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `contents`
--

CREATE TABLE IF NOT EXISTS `contents` (
  `id` int(11) NOT NULL,
  `name` varchar(265) NOT NULL,
  `secured` varchar(4) NOT NULL,
  `body` text NOT NULL,
  `imageSrc` varchar(265) NOT NULL,
  `lastModificationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(50) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `draft`
--

CREATE TABLE IF NOT EXISTS `draft` (
  `id` int(11) NOT NULL,
  `loginId` varchar(128) NOT NULL,
  `recepient` text NOT NULL,
  `message` varchar(1500) NOT NULL,
  `sender` varchar(18) NOT NULL,
  `deliveryType` varchar(18) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `group`
--

CREATE TABLE IF NOT EXISTS `group` (
  `id` int(11) NOT NULL,
  `loginId` varchar(128) NOT NULL,
  `name` varchar(128) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `logins`
--

CREATE TABLE IF NOT EXISTS `logins` (
  `id` int(11) NOT NULL,
  `loginId` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(265) COLLATE utf8_unicode_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `passwordresettoken`
--

CREATE TABLE IF NOT EXISTS `passwordresettoken` (
  `id` int(11) NOT NULL,
  `token` varchar(265) NOT NULL,
  `emailId` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sms`
--

CREATE TABLE IF NOT EXISTS `sms` (
  `id` int(11) NOT NULL,
  `bulkSMSId` int(11) NOT NULL,
  `number` varchar(18) NOT NULL,
  `message` text NOT NULL,
  `sender` varchar(18) NOT NULL,
  `status` int(11) NOT NULL,
  `refId` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=26664 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE IF NOT EXISTS `transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `amount` double NOT NULL,
  `unit` INT NOT NULL,
  `status` varchar(64) NOT NULL,
  `description` varchar(265) NOT NULL,
  `paymentMethod` varchar(24) NOT NULL,
  `type` VARCHAR(16) NOT NULL,
  `committed` TINYINT NOT NULL DEFAULT '0',
  `loginId` varchar(128) NOT NULL,
  `date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `usedcards`
--

CREATE TABLE IF NOT EXISTS `usedcards` (
  `id` int(11) NOT NULL,
  `cardId` int(11) NOT NULL,
  `loginId` varchar(28) NOT NULL,
  `dateUsed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `loginId` varchar(128) NOT NULL,
  `password` varchar(265) NOT NULL,
  `name` varchar(128) NOT NULL,
  `address` varchar(128) NOT NULL,
  `mobileNo` varchar(18) NOT NULL,
  `emailId` varchar(128) NOT NULL,
  `balance` double NOT NULL,
  `status` varchar(16) NOT NULL DEFAULT 'active',
  `role` varchar(16) NOT NULL DEFAULT 'user',
  `dateRegistered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`userName`);

--
-- Indexes for table `bulksms`
--
ALTER TABLE `bulksms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cards`
--
ALTER TABLE `cards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `draft`
--
ALTER TABLE `draft`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group`
--
ALTER TABLE `group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logins`
--
ALTER TABLE `logins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `passwordresettoken`
--
ALTER TABLE `passwordresettoken`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms`
--
ALTER TABLE `sms`
  ADD PRIMARY KEY (`id`);


--
-- Indexes for table `usedcards`
--
ALTER TABLE `usedcards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`loginId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bulksms`
--
ALTER TABLE `bulksms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=346;
--
-- AUTO_INCREMENT for table `cards`
--
ALTER TABLE `cards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=187;
--
-- AUTO_INCREMENT for table `group`
--
ALTER TABLE `group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `logins`
--
ALTER TABLE `logins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `sms`
--
ALTER TABLE `sms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26664;
--
-- AUTO_INCREMENT for table `usedcards`
--
ALTER TABLE `usedcards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
