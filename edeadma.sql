-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 10, 2022 at 02:50 PM
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
  `cemetery_map_img` varchar(120) DEFAULT NULL,
  PRIMARY KEY (`cemetery_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cemetery`
--

INSERT INTO `cemetery` (`cemetery_id`, `cemetery_name`, `street`, `city`, `zip`, `cemetery_type`, `pass_code`, `cemetery_map_img`) VALUES
(2, 'Triumphant', 'dapdap', 'carcar', '6099', 'PRIVATE', '12345', NULL),
(3, 'Manila Memorial', 'San Jose Street', 'Lapu-Lapu', '8712', 'PUBLIC', '12345', 'D:/WAMP/www/edeadma/maps/16680915692ekoyndx71151.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `cemetery_deed`
--

DROP TABLE IF EXISTS `cemetery_deed`;
CREATE TABLE IF NOT EXISTS `cemetery_deed` (
  `deed_id` int(11) NOT NULL AUTO_INCREMENT,
  `plot_id` int(11) NOT NULL,
  `document` varchar(120) DEFAULT NULL,
  PRIMARY KEY (`deed_id`),
  UNIQUE KEY `plot_id` (`plot_id`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cemetery_deed`
--

INSERT INTO `cemetery_deed` (`deed_id`, `plot_id`, `document`) VALUES
(60, 27, 'D:/WAMP/www/edeadma/documents/1667916521Assignment 2.pdf'),
(61, 28, 'D:/WAMP/www/edeadma/documents/1667913984Assignment 1.pdf'),
(62, 29, 'D:/WAMP/www/edeadma/documents/1667914003Story Analysis.pdf'),
(63, 36, 'D:/WAMP/www/edeadma/documents/1667914113Finals.pdf'),
(64, 30, 'D:/WAMP/www/edeadma/documents/1667914193Story Analysis.pdf'),
(65, 31, 'D:/WAMP/www/edeadma/documents/1667914216Data Dictionary.pdf'),
(66, 34, 'D:/WAMP/www/edeadma/documents/1667916496ERDFinal.pdf');

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
(2, 1, 3, 'Jacky', 'Luv', 'A', '2022-02-04', '2022-11-30', 'Single', 21, 'To God be all the glory'),
(3, 2, 3, 'Tom', 'Innit', 'Q', '2022-01-01', '2022-12-31', 'Married', 67, 'In loving memory'),
(4, 2, 3, 'Galg', 'Jeager', 'F', '2022-10-01', '2022-10-29', 'Separated', 19, 'Holy'),
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grave_location`
--

INSERT INTO `grave_location` (`grave_id`, `cemetery_id`, `x1`, `y1`, `x2`, `y2`, `x3`, `y3`, `x4`, `y4`) VALUES
(1, 3, '904', '527', '925', '598', '974', '585', '544', '495'),
(2, 3, '904', '527', '925', '598', '1004', '585', '106', '989');

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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `owner`
--

INSERT INTO `owner` (`owner_id`, `fname`, `lname`, `mi`, `street`, `city`, `zip`, `phone_no`, `email`) VALUES
(12, 'Recardo', 'Ronaldo', 'F', 'San Roque St.', 'Argao City', '2131', '988716211', 'recardo@example.com'),
(13, 'Fejard', 'Fajardo', 'M', 'St. August st.', 'Sibonga', '1872', '922121131', 'Fejard@example.com'),
(14, 'Hanny', 'Enriquez', 'R', 'San Vicente St.', 'Carcar City', '9211', '98872124', 'Hanny@example.com'),
(15, 'Flippa', 'Martha', 'O', 'St. Elizabeth st.', 'Cebu City', '9821', '988721241', 'Flippa@example.com'),
(16, 'George', 'Found', 'H', 'St. Francis st.', 'Naga City', '21313', '988212311', 'George@example.com'),
(17, 'Santa', 'Clause', 'G', 'St. Nicolas street', 'Artic', '1212', '3123123123', 'santa@example.com'),
(18, 'Marzi', 'Filma', 'G', 'st. nicolas street', 'Cebu', '12313', '123123', '@example.com');

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
  `ownership_status` varchar(20) NOT NULL,
  `square_meters` varchar(20) DEFAULT '2.5 x 8',
  PRIMARY KEY (`plot_id`),
  KEY `grave_id` (`grave_id`),
  KEY `owner_id` (`owner_id`),
  KEY `cemetery_id` (`cemetery_id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `plot_ownership`
--

INSERT INTO `plot_ownership` (`plot_id`, `grave_id`, `owner_id`, `cemetery_id`, `date_purchased`, `purchase_price`, `ownership_status`, `square_meters`) VALUES
(27, 1, 12, 3, '2022-11-01', 111, 'active', 'sqr1'),
(28, 2, 12, 3, '2022-11-01', 11111, 'active', 'sqr11'),
(29, NULL, 13, 3, '2022-11-02', 222, 'active', 'sqr2'),
(30, NULL, 13, 3, '2022-11-02', 22222, 'active', 'sqr22'),
(31, NULL, 14, 3, '2022-11-03', 333, 'active', 'sqr3'),
(32, NULL, 14, 3, '2022-11-03', 33333, 'active', 'sqr33'),
(33, NULL, 15, 3, '2022-11-04', 444, 'active', 'sqr4'),
(34, NULL, 15, 3, '2022-11-04', 44444, 'active', 'sqr44'),
(35, NULL, 16, 3, '2022-11-05', 555, 'active', 'sqr5'),
(36, NULL, 12, 3, '2022-11-19', 123, 'active', '2.6 x 9 meters'),
(37, NULL, 17, 2, '2022-12-30', 6969, 'active', '2.6 x 9 meters'),
(38, NULL, 17, 2, '2022-11-12', 1212, 'active', '2.6 x 9 meters'),
(39, NULL, 18, 2, '2022-11-19', 12312312, 'active', '2.6 x 9 meters'),
(40, NULL, 18, 2, '2022-11-18', 11111, 'active', '2.5 x 8 meters');

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
