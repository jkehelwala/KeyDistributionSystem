-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 21, 2018 at 04:15 PM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

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

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `u_id` int(11) NOT NULL,
  `u_name` varchar(30) NOT NULL,
  `u_role` tinyint(1) NOT NULL,
  `u_pass` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `key_list` (
  `r_id` int(11) NOT NULL,
  `enc_key` text NOT NULL,
  `self_notes` text,
  `key_hash` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `key_list`
--

INSERT INTO `key_list` (`r_id`, `enc_key`, `self_notes`, `key_hash`) VALUES
(4, 'vwBEjsQdlQ==', 'these are the notes for the new key.', '	m2±pŸAœšT\rˆ'),
(5, 'ugBKjskXnlkoa21m63OCRVQUPLUD2tzCwQ==', 'notes for the production db.', 'n.lŒ0ëœä(jCÍÄÝ'),
(6, 'ug5Y', 'kkk', 'æ†Án(>„#A–ÙØ');

-- --------------------------------------------------------

--
-- Table structure for table `machines`
--

CREATE TABLE `machines` (
  `m_id` int(11) NOT NULL,
  `m_name` varchar(30) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `sys_admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `requests` (
  `r_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `m_id` int(11) NOT NULL,
  `key_type` set('UserAccount','NewPublicKey','GuestPublicKey') NOT NULL,
  `admin_u_id` int(11) NOT NULL,
  `admin_approved` tinyint(1) DEFAULT NULL,
  `key_issued` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`r_id`, `u_id`, `m_id`, `key_type`, `admin_u_id`, `admin_approved`, `key_issued`) VALUES
(4, 2, 1, 'UserAccount', 1, 1, 1),
(5, 2, 2, 'UserAccount', 1, 1, 1),
(6, 2, 1, 'NewPublicKey', 1, 1, 1),
(7, 2, 1, 'UserAccount', 1, NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`u_id`);

--
-- Indexes for table `key_list`
--
ALTER TABLE `key_list`
  ADD PRIMARY KEY (`r_id`);

--
-- Indexes for table `machines`
--
ALTER TABLE `machines`
  ADD PRIMARY KEY (`m_id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`r_id`),
  ADD KEY `u_id` (`u_id`),
  ADD KEY `admin_u_id` (`admin_u_id`),
  ADD KEY `m_id` (`m_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `machines`
--
ALTER TABLE `machines`
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
