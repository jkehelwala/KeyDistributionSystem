-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 08, 2018 at 08:10 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `keydist`
--
CREATE DATABASE IF NOT EXISTS `keydist` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `keydist`;

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE IF NOT EXISTS `accounts` (
  `u_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_name` varchar(30) NOT NULL,
  `u_role` tinyint(1) NOT NULL,
  `u_pass` varchar(64) NOT NULL,
  PRIMARY KEY (`u_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`u_id`, `u_name`, `u_role`, `u_pass`) VALUES
(1, 'admin1', 0, '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918'),
(2, 'machine1', 2, 'bc020a35b7f9cb1382e7b534c68e3c531d849b119bf14f75ddead6cc45c3ccc1'),
(3, 'sysadmin1', 1, 'd577adc54e95f42f15de2e7c134669888b7d6fb74df97bd62cb4f5b73c281db4');

-- --------------------------------------------------------

--
-- Table structure for table `key_list`
--

CREATE TABLE IF NOT EXISTS `key_list` (
  `r_id` int(11) NOT NULL,
  `enc_key` text NOT NULL,
  `self_notes` varchar(300) NOT NULL,
  `key_hash` varchar(16) NOT NULL,
  PRIMARY KEY (`r_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `machines`
--

CREATE TABLE IF NOT EXISTS `machines` (
  `m_id` int(11) NOT NULL AUTO_INCREMENT,
  `m_name` varchar(30) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `sys_admin_id` int(11) NOT NULL,
  PRIMARY KEY (`m_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `machines`
--

INSERT INTO `machines` (`m_id`, `m_name`, `admin_id`, `sys_admin_id`) VALUES
(1, 'DockerVM', 1, 3),
(2, 'ProductionDB', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE IF NOT EXISTS `requests` (
  `r_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) NOT NULL,
  `m_id` int(11) NOT NULL,
  `key_type` set('UserAccount','NewPublicKey','GuestPublicKey') NOT NULL,
  `admin_u_id` int(11) NOT NULL,
  `admin_approved` tinyint(1) DEFAULT NULL,
  `key_issued` tinyint(1) NOT NULL,
  PRIMARY KEY (`r_id`),
  KEY `u_id` (`u_id`),
  KEY `admin_u_id` (`admin_u_id`),
  KEY `m_id` (`m_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
