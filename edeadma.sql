-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 28, 2022 at 03:33 PM
-- Server version: 5.7.31
-- PHP Version: 7.4.9

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
(1, 2, 'unavailable', 'unavailable', 'Phil', 'Thor', 'M', 'San Vicente Dr.', 'Carcar City, Cebu', '6019', 'ADMIN'),
(2, 3, 'user3', 'user3', 'Newton', 'Gab', 'M', 'San Vicente', 'Carcar City', '6019', 'ADMIN'),
(3, 3, 'user4', 'user4', 'Tron', 'Newman', 'R', '6 Argyll St', 'London', '6019', 'ADMIN'),
(4, NULL, 'notsetcemetery', 'notsetcemetery', 'asdf', 'asdf', 'a', 'asdf', 'asdf', 'asdf', 'ADMIN');

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
(2, 'Triumphant', 'dapdap', 'carcar', '6099', 'PRIVATE', '12345', 'D:/WAMP/www/edeadma/maps/1668170636Screenshot (433).png'),
(3, 'Manila Memorial', 'San Jose Street', 'Lapu-Lapu', '8712', 'PUBLIC', '12345', 'D:/WAMP/www/edeadma/maps/1668851861st martha.png');

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cemetery_deed`
--

INSERT INTO `cemetery_deed` (`deed_id`, `plot_id`, `document`) VALUES
(10, 102, 'D:/WAMP/www/edeadma/documents/166886065419882448231.pdf'),
(11, 103, 'D:/WAMP/www/edeadma/documents/166887261019882448231.pdf');

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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `deceased`
--

INSERT INTO `deceased` (`deceased_id`, `grave_id`, `cemetery_id`, `fname`, `lname`, `mi`, `burial_date`, `birth_date`, `marital_status`, `age`, `epitaph`) VALUES
(11, NULL, 3, 'SAMPLE', 'Sample', 'O', '2022-11-12', '2022-11-29', '', 20, 'Rest in Peace'),
(12, 83, 3, 'death', 'death', 'D', '2022-11-04', '2022-11-26', 'Separated', 12, 'Rest in Peace'),
(13, 83, 3, 'Doroth', 'Gremmy', 'Y', '2022-11-05', '2022-11-22', 'Married', 22, 'Rest in peace'),
(14, 92, 3, 'Harry', 'Potter', 'D', '2022-12-03', '2022-11-28', 'Widowed', 12, 'Holy'),
(15, 87, 3, 'men', 'men', 'm', '2022-11-07', '2022-11-26', 'Married', 60, 'Holy'),
(16, 77, 3, 'woman', 'woman', 'F', '2022-11-12', '2022-11-05', 'Married', 66, 'Holy'),
(17, 82, 3, 'Kenny', 'Mato', 'Q', '2022-11-11', '2022-11-05', 'Widowed', 12, 'Holy'),
(18, 79, 3, 'old', 'old', 'G', '2013-12-12', '2022-11-19', 'Widowed', 23, 'Holy'),
(19, NULL, 3, 'hon', 'ney', 'q', '2022-11-12', '2022-11-12', 'Widowed', 77, 'Holy'),
(20, NULL, 3, 'Jame', 'Morgen', 'Q', '2014-03-07', '2022-11-30', 'Single', 9, 'Holy'),
(21, NULL, 3, 'Kira', 'Yoshikage', 'M', '2022-11-12', '2022-11-30', 'Single', 11, 'In loving memory');

-- --------------------------------------------------------

--
-- Table structure for table `entry_journal`
--

DROP TABLE IF EXISTS `entry_journal`;
CREATE TABLE IF NOT EXISTS `entry_journal` (
  `journal_id` int(11) NOT NULL AUTO_INCREMENT,
  `report_id` int(11) NOT NULL,
  `entry_date` date NOT NULL,
  `account` varchar(30) NOT NULL,
  `ledger` varchar(40) NOT NULL,
  `debit` double(10,2) DEFAULT NULL,
  `credit` double(10,2) DEFAULT NULL,
  `description` varchar(120) DEFAULT NULL,
  PRIMARY KEY (`journal_id`),
  KEY `report_id` (`report_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `entry_journal`
--

INSERT INTO `entry_journal` (`journal_id`, `report_id`, `entry_date`, `account`, `ledger`, `debit`, `credit`, `description`) VALUES
(2, 3, '2022-03-11', 'EXPENSE', 'INTERNET', 1999.59, 0.00, 'PLDT bill'),
(3, 2, '2022-02-01', 'EXPENSE', 'ELECTRIC', 1000.00, 0.00, 'Electricity bill'),
(4, 4, '2022-04-29', 'EXPENSE', 'WATER', 196.00, 0.00, 'Water bill'),
(5, 1, '2022-01-22', 'EXPENSE', 'CONTRACTED_SERVICES', 2000.00, 0.00, 'Contracted burial service'),
(6, 1, '2022-01-31', 'REVENUE', 'SALES', 0.00, 5000.00, 'sold one of the burial plots'),
(7, 5, '2022-05-01', 'REVENUE', 'COMMISSION_EARNED', 0.00, 2500.00, 'Commissioned a burial '),
(8, 2, '2022-02-11', 'REVENUE', 'SALES', 0.00, 6000.00, 'Sold a burial plot'),
(9, 6, '2022-01-08', 'REVENUE', 'SERVICES_SALES', 0.00, 7000.00, 'Sold a burial plot at triumphant'),
(10, 6, '2022-01-22', 'EXPENSE', 'WATER', 169.00, 0.00, 'paid water bill for the month of january'),
(11, 6, '2022-01-22', 'EXPENSE', 'INSURANCE', 1400.00, 0.00, 'Insurance '),
(12, 6, '2022-01-15', 'REVENUE', 'SERVICE_REVENUE', 0.00, 1600.00, 'Sold burial service'),
(13, 7, '2022-06-10', 'EXPENSE', 'MAINTENANCE_EQUIPMENT', 4000.00, 0.00, 'Maintenance of vehicle'),
(16, 3, '2022-03-18', 'REVENUE', 'SALES', 0.00, 3000.00, 'Sold a burial plot'),
(17, 8, '2022-07-07', 'REVENUE', 'SERVICES_SALES', 0.00, 5000.00, 'Sold burial plot');

-- --------------------------------------------------------

--
-- Table structure for table `financial_report`
--

DROP TABLE IF EXISTS `financial_report`;
CREATE TABLE IF NOT EXISTS `financial_report` (
  `report_id` int(11) NOT NULL AUTO_INCREMENT,
  `cemetery_id` int(11) NOT NULL,
  `date_from` date NOT NULL,
  `date_to` date NOT NULL,
  `total_revenue` double(10,2) DEFAULT NULL,
  `total_expense` double(10,2) DEFAULT NULL,
  PRIMARY KEY (`report_id`),
  KEY `cemetery_id` (`cemetery_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `financial_report`
--

INSERT INTO `financial_report` (`report_id`, `cemetery_id`, `date_from`, `date_to`, `total_revenue`, `total_expense`) VALUES
(1, 3, '2022-01-01', '2022-01-31', 5000.00, 2000.00),
(2, 3, '2022-02-01', '2022-02-28', 6000.00, 1000.00),
(3, 3, '2022-03-01', '2022-03-31', 3000.00, 1999.59),
(4, 3, '2022-04-01', '2022-04-30', 0.00, 196.00),
(5, 3, '2022-05-01', '2022-05-31', 2500.00, 0.00),
(6, 2, '2022-01-01', '2022-01-31', 8600.00, 1569.00),
(7, 3, '2022-06-01', '2022-06-30', 0.00, 4000.00),
(8, 3, '2022-07-01', '2022-07-31', 5000.00, 0.00);

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
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grave_location`
--

INSERT INTO `grave_location` (`grave_id`, `cemetery_id`, `x1`, `y1`, `x2`, `y2`, `x3`, `y3`, `x4`, `y4`) VALUES
(73, 3, '348', '6', '348', '6', '348', '6', '348', '6'),
(77, 3, '554', '345', '548', '362', '570', '368', '577', '351'),
(79, 3, '446', '309', '434', '331', '451', '343', '463', '317'),
(81, 3, '425', '276', '422', '287', '442', '296', '447', '281'),
(82, 3, '374', '288', '365', '310', '381', '320', '391', '298'),
(83, 3, '375', '230', '389', '240', '374', '268', '361', '263'),
(85, 3, '342', '214', '355', '221', '340', '250', '330', '243'),
(86, 3, '316', '261', '327', '265', '317', '282', '306', '279'),
(87, 3, '272', '236', '314', '255', '292', '292', '251', '271'),
(92, 3, '422', '63', '437', '67', '423', '101', '410', '95'),
(103, 3, '391', '162', '426', '174', '416', '201', '386', '190'),
(104, 3, '407', '309', '422', '318', '407', '346', '392', '337');

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
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `owner`
--

INSERT INTO `owner` (`owner_id`, `fname`, `lname`, `mi`, `street`, `city`, `zip`, `phone_no`, `email`) VALUES
(40, 'Beth', 'Amber', 'T', 'street', 'City', '111', '09882133', '@examplecom'),
(41, 'Cameron', 'Blue', 'G', 'St. john street', 'New York', '2313', '09882122231', '@example.com'),
(42, 'tom', 'Dam', 'D', 'san vicente drive', 'Carcar city', '6019', '09221313', '@example.com'),
(43, 'Jason', 'Mae', 'M', 'street', 'city', '123213', '09123', 'email');

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
  UNIQUE KEY `grave_id` (`grave_id`),
  KEY `owner_id` (`owner_id`),
  KEY `cemetery_id` (`cemetery_id`)
) ENGINE=InnoDB AUTO_INCREMENT=114 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `plot_ownership`
--

INSERT INTO `plot_ownership` (`plot_id`, `grave_id`, `owner_id`, `cemetery_id`, `date_purchased`, `purchase_price`, `ownership_status`, `square_meters`) VALUES
(102, 85, 40, 3, '2022-11-05', 12321, 'active', '2.6 x 9 meters'),
(103, NULL, 40, 3, '2022-11-05', 21000, 'active', '2.6 x 9 meters'),
(105, 87, 42, 3, '2022-11-29', 1, 'active', '2.6 x 9 meters'),
(106, NULL, 40, 3, '2022-11-11', 12, 'active', '2.6 x 9 meters'),
(107, NULL, 42, 3, '2022-11-05', 213, 'active', '2.6 x 9 meters'),
(110, NULL, 40, 3, '2022-11-12', 1111, 'active', '2.6 x 9 meters'),
(111, NULL, 42, 3, '2022-11-05', 99, 'active', '2.6 x 9 meters'),
(112, NULL, 40, 3, '2022-11-02', 213, 'active', '2.5 x 8 meters'),
(113, NULL, 41, 3, '2022-11-05', 1, 'active', '2.6 x 9 meters');

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
-- Constraints for table `entry_journal`
--
ALTER TABLE `entry_journal`
  ADD CONSTRAINT `entry_journal_ibfk_1` FOREIGN KEY (`report_id`) REFERENCES `financial_report` (`report_id`);

--
-- Constraints for table `financial_report`
--
ALTER TABLE `financial_report`
  ADD CONSTRAINT `financial_report_ibfk_1` FOREIGN KEY (`cemetery_id`) REFERENCES `cemetery` (`cemetery_id`);

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
