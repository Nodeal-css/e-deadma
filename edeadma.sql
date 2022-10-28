-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 28, 2022 at 12:03 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `edeadma`
--

-- --------------------------------------------------------

--
-- Table structure for table `authorized_account`
--

DROP TABLE IF EXISTS `authorized_account`;
CREATE TABLE IF NOT EXISTS `authorized_account` (
  `account_id` int(11) NOT NULL AUTO_INCREMENT,
  `cemetery_id` int(11) DEFAULT NULL,
  `username` varchar(30) NOT NULL,
  `acc_password` varchar(30) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `mi` varchar(15) DEFAULT NULL,
  `street` varchar(30) NOT NULL,
  `city` varchar(30) NOT NULL,
  `zip` varchar(10) NOT NULL,
  `account_type` varchar(15) NOT NULL DEFAULT 'ADMIN',
  PRIMARY KEY (`account_id`),
  KEY `cemetery_id` (`cemetery_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `authorized_account`
--

INSERT INTO `authorized_account` (`account_id`, `cemetery_id`, `username`, `acc_password`, `fname`, `lname`, `mi`, `street`, `city`, `zip`, `account_type`) VALUES
(1, 2, 'user1', 'user1', 'Phil', 'Thor', 'M', 'San Vicente Dr.', 'Carcar City, Cebu', '6019', 'ADMIN'),
(2, 3, 'user3', 'user3', 'Newton', 'Gab', 'M', 'San Vicente', 'Carcar City', '6019', 'ADMIN'),
(3, 3, 'user4', 'user4', 'Tron', 'Newman', 'R', '6 Argyll St', 'London', '6019', 'ADMIN'),
(4, NULL, 'user22', 'user22', 'asdf', 'asdf', 'a', 'asdf', 'asdf', 'asdf', 'ADMIN');

-- --------------------------------------------------------

--
-- Table structure for table `cemetery`
--

DROP TABLE IF EXISTS `cemetery`;
CREATE TABLE IF NOT EXISTS `cemetery` (
  `cemetery_id` int(11) NOT NULL AUTO_INCREMENT,
  `cemetery_name` varchar(30) NOT NULL,
  `street` varchar(30) NOT NULL,
  `city` varchar(30) NOT NULL,
  `zip` varchar(10) NOT NULL,
  `cemetery_type` varchar(20) NOT NULL,
  `pass_code` varchar(30) NOT NULL,
  `cemetery_map_img` blob,
  `map_height` int(11) DEFAULT NULL,
  `map_width` int(11) DEFAULT NULL,
  PRIMARY KEY (`cemetery_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cemetery`
--

INSERT INTO `cemetery` (`cemetery_id`, `cemetery_name`, `street`, `city`, `zip`, `cemetery_type`, `pass_code`, `cemetery_map_img`, `map_height`, `map_width`) VALUES
(2, 'Triumphant', 'dapdap', 'carcar', '6099', 'PRIVATE', '12345', NULL, NULL, NULL),
(3, 'Manila Memorial', 'San Jose Street', 'Lapu-Lapu', '8712', 'PUBLIC', '12345', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cemetery_deed`
--

DROP TABLE IF EXISTS `cemetery_deed`;
CREATE TABLE IF NOT EXISTS `cemetery_deed` (
  `deed_id` int(11) NOT NULL AUTO_INCREMENT,
  `plot_id` int(11) NOT NULL,
  `document` blob,
  PRIMARY KEY (`deed_id`),
  KEY `plot_id` (`plot_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `deceased`
--

DROP TABLE IF EXISTS `deceased`;
CREATE TABLE IF NOT EXISTS `deceased` (
  `deceased_id` int(11) NOT NULL AUTO_INCREMENT,
  `grave_id` int(11) DEFAULT NULL,
  `cemetery_id` int(11) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `mi` varchar(15) DEFAULT NULL,
  `burial_date` date NOT NULL,
  `birth_date` date NOT NULL,
  `marital_status` varchar(30) DEFAULT NULL,
  `age` int(9) NOT NULL,
  `epitaph` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`deceased_id`),
  KEY `grave_id` (`grave_id`),
  KEY `cemetery_id` (`cemetery_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `deceased`
--

INSERT INTO `deceased` (`deceased_id`, `grave_id`, `cemetery_id`, `fname`, `lname`, `mi`, `burial_date`, `birth_date`, `marital_status`, `age`, `epitaph`) VALUES
(1, NULL, 2, 'Hamon', 'user', 'R', '2022-10-07', '2022-10-28', 'Divorced', 66, 'Rest in Peace'),
(2, NULL, 3, 'Jacky', 'Luv', 'A', '2022-02-04', '2022-11-30', 'Single', 21, 'To God be all the glory'),
(3, NULL, 3, 'Tom', 'Innit', 'Q', '2022-01-01', '2022-12-31', 'Married', 67, 'In loving memory'),
(4, NULL, 3, 'Galg', 'Jeager', 'F', '2022-10-01', '2022-10-29', 'Separated', 19, 'Holy'),
(5, NULL, 3, 'Hosha', 'Shin', 'T', '2022-10-14', '2022-10-07', 'Widowed', 44, 'Holy'),
(6, NULL, 3, 'Ann', 'Greek', 'D', '2022-10-06', '2022-10-28', 'Married', 11, 'Rest in Peace');

-- --------------------------------------------------------

--
-- Table structure for table `grave_location`
--

DROP TABLE IF EXISTS `grave_location`;
CREATE TABLE IF NOT EXISTS `grave_location` (
  `grave_id` int(11) NOT NULL AUTO_INCREMENT,
  `cemetery_id` int(11) NOT NULL,
  `x1` varchar(15) NOT NULL,
  `y1` varchar(15) NOT NULL,
  `x2` varchar(15) NOT NULL,
  `y2` varchar(15) NOT NULL,
  `x3` varchar(15) NOT NULL,
  `y3` varchar(15) NOT NULL,
  `x4` varchar(15) NOT NULL,
  `y4` varchar(15) NOT NULL,
  PRIMARY KEY (`grave_id`),
  KEY `cemetery_id` (`cemetery_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `owner`
--

DROP TABLE IF EXISTS `owner`;
CREATE TABLE IF NOT EXISTS `owner` (
  `owner_id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `mi` varchar(15) DEFAULT NULL,
  `street` varchar(30) NOT NULL,
  `city` varchar(30) NOT NULL,
  `zip` varchar(10) NOT NULL,
  `phone_no` varchar(15) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`owner_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `plot_ownership`
--

DROP TABLE IF EXISTS `plot_ownership`;
CREATE TABLE IF NOT EXISTS `plot_ownership` (
  `plot_id` int(11) NOT NULL AUTO_INCREMENT,
  `grave_id` int(11) DEFAULT NULL,
  `owner_id` int(11) NOT NULL,
  `cemetery_id` int(11) NOT NULL,
  `date_purchased` date NOT NULL,
  `purchase_price` int(11) DEFAULT NULL,
  `burial_fee` int(11) DEFAULT NULL,
  `amount_paid` int(11) DEFAULT NULL,
  `ownership_status` varchar(20) NOT NULL,
  `square_meters` varchar(11) DEFAULT '2.5 x 8',
  PRIMARY KEY (`plot_id`),
  KEY `grave_id` (`grave_id`),
  KEY `owner_id` (`owner_id`),
  KEY `cemetery_id` (`cemetery_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `authorized_account`
--
ALTER TABLE `authorized_account`
  ADD CONSTRAINT `authorized_account_ibfk_1` FOREIGN KEY (`cemetery_id`) REFERENCES `cemetery` (`cemetery_id`);

--
-- Constraints for table `cemetery_deed`
--
ALTER TABLE `cemetery_deed`
  ADD CONSTRAINT `cemetery_deed_ibfk_1` FOREIGN KEY (`plot_id`) REFERENCES `plot_ownership` (`plot_id`);

--
-- Constraints for table `deceased`
--
ALTER TABLE `deceased`
  ADD CONSTRAINT `deceased_ibfk_1` FOREIGN KEY (`grave_id`) REFERENCES `grave_location` (`grave_id`),
  ADD CONSTRAINT `deceased_ibfk_2` FOREIGN KEY (`cemetery_id`) REFERENCES `cemetery` (`cemetery_id`);

--
-- Constraints for table `grave_location`
--
ALTER TABLE `grave_location`
  ADD CONSTRAINT `grave_location_ibfk_1` FOREIGN KEY (`cemetery_id`) REFERENCES `cemetery` (`cemetery_id`);

--
-- Constraints for table `plot_ownership`
--
ALTER TABLE `plot_ownership`
  ADD CONSTRAINT `plot_ownership_ibfk_1` FOREIGN KEY (`grave_id`) REFERENCES `grave_location` (`grave_id`),
  ADD CONSTRAINT `plot_ownership_ibfk_2` FOREIGN KEY (`owner_id`) REFERENCES `owner` (`owner_id`),
  ADD CONSTRAINT `plot_ownership_ibfk_3` FOREIGN KEY (`cemetery_id`) REFERENCES `cemetery` (`cemetery_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
