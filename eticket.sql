-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 13, 2017 at 06:22 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `eticket`
--

-- --------------------------------------------------------

--
-- Table structure for table `buses`
--

CREATE TABLE IF NOT EXISTS `buses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `bus_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `bus_name` (`bus_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `buses`
--

INSERT INTO `buses` (`id`, `bus_name`) VALUES
(3, 'Agomoni Paribahan'),
(7, 'Asif Enterprise'),
(4, 'Eagle Paribahan'),
(6, 'Greenline'),
(1, 'Hanif Enterprise'),
(2, 'Shyamoli Paribahan'),
(5, 'TR Travels');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE IF NOT EXISTS `cities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `city_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `city_name` (`city_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `city_name`) VALUES
(19, 'Bagerhat'),
(13, 'Barisal'),
(9, 'Bogra'),
(2, 'Chittagong'),
(10, 'Comilla'),
(11, 'Coxsbazar'),
(1, 'Dhaka'),
(6, 'Kustia'),
(8, 'Naoga'),
(5, 'Nator'),
(18, 'Nilphamari'),
(15, 'Noakhali'),
(17, 'Potia'),
(3, 'Rajshahi'),
(16, 'Ramu'),
(12, 'Rangpur'),
(4, 'Sylhet'),
(7, 'Thakurgaon'),
(14, 'Vola'),
(21, 'Vurungamari');

-- --------------------------------------------------------

--
-- Table structure for table `reserved`
--

CREATE TABLE IF NOT EXISTS `reserved` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `selected_bus_id` varchar(20) NOT NULL,
  `selected_bus_name` varchar(255) NOT NULL,
  `seat_number` varchar(20) NOT NULL,
  `datetime_travel` varchar(255) NOT NULL,
  `reservation_id` varchar(255) NOT NULL,
  `ticket_print` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=49 ;

--
-- Dumping data for table `reserved`
--

INSERT INTO `reserved` (`id`, `email`, `selected_bus_id`, `selected_bus_name`, `seat_number`, `datetime_travel`, `reservation_id`, `ticket_print`) VALUES
(41, 'admin@gmail.com', '3', 'Agomoni Paribahan', 'A3', 'March 14, 2017-10:00am', 'A39kd23', 1),
(43, 'admin@gmail.com', '12', 'Asif Enterprise', 'A1', 'March 15, 2017-10:00pm', 'A1isl1012', 1),
(44, 'admin@gmail.com', '12', 'Asif Enterprise', 'A2', 'March 15, 2017-10:00pm', 'A2wkW1012', 1),
(47, 'customer@gmail.com', '3', 'Agomoni Paribahan', 'A4', 'March 14, 2017-10:00am', 'A4RvnM03', 1),
(48, 'customer@gmail.com', '1', 'Hanif Enterprise', 'A2', 'March 14, 2017-7:00am', 'A2GaQC01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE IF NOT EXISTS `tickets` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fromEntry` varchar(255) NOT NULL,
  `toEntry` varchar(255) NOT NULL,
  `busEntry` varchar(255) NOT NULL,
  `dateEntry` timestamp NOT NULL,
  `timeEntry` varchar(255) NOT NULL,
  `seatEntry` text NOT NULL,
  `priceEntry` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `fromEntry`, `toEntry`, `busEntry`, `dateEntry`, `timeEntry`, `seatEntry`, `priceEntry`, `created_at`) VALUES
(1, 'Dhaka', 'Chittagong', 'Hanif Enterprise', '2017-03-13 18:00:00', '7:00am', 'A3,A4,B1,B2,B3,B4,C1,C2,C3,C4,D1,D1,D1,D1,E1,E2,E3,E4,F1,F2,F3,F4,G1,G2,G3,G4,H1,H2,H3,H4,I1,I2,I3,I4,J1,J2,J3,J4,', '600', '2017-03-12 21:21:39'),
(2, 'Dhaka', 'Chittagong', 'Shyamoli Paribahan', '2017-03-13 18:00:00', '8:00am', 'A1,A2,A3,A4,B1,B2,B3,B4,C1,C2,C3,C4,D1,D1,D1,D1,E1,E2,E3,E4,F1,F2,F3,F4,G1,G2,G3,G4,H1,H2,H3,H4,I1,I2,I3,I4,J1,J2,J3,J4,', '600', '2017-03-12 21:22:37'),
(3, 'Dhaka', 'Chittagong', 'Agomoni Paribahan', '2017-03-13 18:00:00', '10:00am', 'B1,B2,B3,B4,C1,C2,C3,C4,D1,D1,D1,D1,E1,E2,E3,E4,F1,F2,F3,F4,G1,G2,G3,G4,H1,H2,H3,H4,I1,I2,I3,I4,J1,J2,J3,J4,', '700', '2017-03-12 21:35:46'),
(4, 'Dhaka', 'Thakurgaon', 'Hanif Enterprise', '2017-03-13 18:00:00', '9:30pm', 'A1,A2,A3,A4,B1,B2,B3,B4,C1,C2,C3,C4,D1,D1,D1,D1,E1,E2,E3,E4,F1,F2,F3,F4,G1,G2,G3,G4,H1,H2,H3,H4,I1,I2,I3,I4,J1,J2,J3,J4,', '600', '2017-03-12 21:36:56'),
(9, 'Dhaka', 'Sylhet', 'TR Travels', '2017-03-14 18:00:00', '8:00am', 'A1,A2,A3,A4,B1,B2,B3,B4,C1,C2,C3,C4,D1,D1,D1,D1,E1,E2,E3,E4,F1,F2,F3,F4,G1,G2,G3,G4,H1,H2,H3,H4,I1,I2,I3,I4,J1,J2,J3,J4,', '600', '2017-03-12 22:04:02'),
(10, 'Chittagong', 'Dhaka', 'Hanif Enterprise', '2017-03-14 18:00:00', '9:00am', 'A1,A2,A3,A4,B1,B2,B3,B4,C1,C2,C3,C4,D1,D1,D1,D1,E1,E2,E3,E4,F1,F2,F3,F4,G1,G2,G3,G4,H1,H2,H3,H4,I1,I2,I3,I4,J1,J2,J3,J4,', '600', '2017-03-13 10:20:32'),
(11, 'Dhaka', 'Thakurgaon', 'Greenline', '2017-03-14 18:00:00', '10:00pm', 'A1,A2,A3,A4,B1,B2,B3,B4,C1,C2,C3,C4,D1,D1,D1,D1,E1,E2,E3,E4,F1,F2,F3,F4,G1,G2,G3,G4,H1,H2,H3,H4,I1,I2,I3,I4,J1,J2,J3,J4,', '700', '2017-03-13 11:09:39'),
(12, 'Dhaka', 'Vurungamari', 'Asif Enterprise', '2017-03-14 18:00:00', '10:00pm', 'A3,A4,B1,B2,B3,B4,C1,C2,C3,C4,D1,D1,D1,D1,E1,E2,E3,E4,F1,F2,F3,F4,G1,G2,G3,G4,H1,H2,H3,H4,I1,I2,I3,I4,J1,J2,J3,J4,', '700', '2017-03-13 16:58:24');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`,`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(32, 'admin', 'admin@gmail.com', 'admin', 'admin', '2017-03-11 23:10:22', '2017-03-11 23:10:22'),
(33, 'manager', 'manager@gmail.com', 'manager', 'manager', '2017-03-11 23:11:38', '2017-03-11 23:11:38'),
(34, 'customer', 'customer@gmail.com', 'customer', 'customer', '2017-03-11 23:12:31', '2017-03-11 23:12:31');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
