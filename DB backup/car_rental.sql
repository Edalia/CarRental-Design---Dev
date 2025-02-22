-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 22, 2025 at 02:05 AM
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
-- Database: `car_rental`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

DROP TABLE IF EXISTS `booking`;
CREATE TABLE IF NOT EXISTS `booking` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `user_id` int(255) NOT NULL,
  `pickup_id` int(255) NOT NULL,
  `pickup_date` date NOT NULL,
  `return_id` int(255) NOT NULL,
  `return_date` date NOT NULL,
  `car_id` int(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `pickup_id` (`pickup_id`,`return_id`,`car_id`),
  KEY `return_id` (`return_id`),
  KEY `car_id` (`car_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `car`
--

DROP TABLE IF EXISTS `car`;
CREATE TABLE IF NOT EXISTS `car` (
  `car_id` int(255) NOT NULL AUTO_INCREMENT,
  `car_model` varchar(255) NOT NULL,
  `car_gear` varchar(255) NOT NULL,
  `car_seat` int(255) NOT NULL,
  `car_price` int(255) NOT NULL,
  `car_img_path` varchar(255) NOT NULL,
  PRIMARY KEY (`car_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `car`
--

INSERT INTO `car` (`car_id`, `car_model`, `car_gear`, `car_seat`, `car_price`, `car_img_path`) VALUES
(1, 'Volvo xc60', 'Auto', 4, 30, 'img/volvo.jpg'),
(2, 'Mazda 3', 'Auto', 4, 10, 'img/mazda3.jpg'),
(3, 'Ford Ranger', 'Auto', 4, 90, 'img/ranger.jpg'),
(4, 'Nissan Juke', 'Auto', 4, 25, 'img/juke.jpg'),
(5, '2008 VW Golf', 'Manual', 4, 30, 'img/golf08.jpg'),
(6, 'Audi A4', 'Auto', 4, 40, 'img/audia4.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

DROP TABLE IF EXISTS `location`;
CREATE TABLE IF NOT EXISTS `location` (
  `location_id` int(255) NOT NULL AUTO_INCREMENT,
  `location_city` varchar(255) NOT NULL,
  `branch_name` varchar(255) NOT NULL,
  PRIMARY KEY (`location_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`location_id`, `location_city`, `branch_name`) VALUES
(1, 'London', 'L Branch'),
(2, 'Nottingham', 'N Branch'),
(3, 'Birmingham', 'B Branch');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(255) NOT NULL AUTO_INCREMENT,
  `user_fname` varchar(255) NOT NULL,
  `user_sname` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_fname`, `user_sname`, `user_email`, `user_password`) VALUES
(53, 'Mike', 'Edalia', 'mike@gmail.com', '$2y$10$ri4rCBnycW13bLqwlMe.aulCl5kt.N2YvU.GClvvtXlGEfNNsRMTC'),
(54, 'Test', 'Test', 'test@gmail', '$2y$10$cf90m1KhVOhCJMiMyn6NYuVxtm7pmyaCdt5gWs60NYFjCHhlvDML6');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`pickup_id`) REFERENCES `location` (`location_id`),
  ADD CONSTRAINT `booking_ibfk_3` FOREIGN KEY (`return_id`) REFERENCES `location` (`location_id`),
  ADD CONSTRAINT `booking_ibfk_4` FOREIGN KEY (`car_id`) REFERENCES `car` (`car_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
