-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 28, 2022 at 11:04 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `covid`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `sno` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `phoneno` varchar(10) NOT NULL,
  `city` varchar(30) NOT NULL,
  `adminid` varchar(10) NOT NULL,
  `createdat` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`sno`, `username`, `password`, `phoneno`, `city`, `adminid`, `createdat`) VALUES
(1, 'ashok_presidio', '$2y$10$Lfr8O93ewckw.V9.Q3uwq.iU19TzxKbWxtnkKT7U7Xc/mxIWx52Oq', '8973942855', 'Erode', '19ITR013', '2022-03-28 16:19:49');

-- --------------------------------------------------------

--
-- Table structure for table `slotbook`
--

CREATE TABLE `slotbook` (
  `sno` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `vaccinename` varchar(50) NOT NULL,
  `slotdate` varchar(30) NOT NULL,
  `accepted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `slotbook`
--

INSERT INTO `slotbook` (`sno`, `username`, `vaccinename`, `slotdate`, `accepted`) VALUES
(3, 'ashok_user', 'Covaxin', '30-03-2022', 1);

-- --------------------------------------------------------

--
-- Table structure for table `slots`
--

CREATE TABLE `slots` (
  `sno` int(11) NOT NULL,
  `vaccinename` varchar(50) NOT NULL,
  `slotdate` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `slots`
--

INSERT INTO `slots` (`sno`, `vaccinename`, `slotdate`) VALUES
(1, 'Covaxin', '30-03-2022'),
(2, 'Covishield', '31-03-2022');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `sno` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `phoneno` varchar(10) NOT NULL,
  `city` varchar(30) NOT NULL,
  `createdat` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`sno`, `username`, `password`, `phoneno`, `city`, `createdat`) VALUES
(1, 'ashok_user', '$2y$10$2kZZcSzUI1vViqG4AkRulOuxwbtHZMQVcau5IUT.L9d11YJcKmR3O', '8973942855', 'Erode', '2022-03-28 17:15:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `slotbook`
--
ALTER TABLE `slotbook`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `slots`
--
ALTER TABLE `slots`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`sno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `slotbook`
--
ALTER TABLE `slotbook`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `slots`
--
ALTER TABLE `slots`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
