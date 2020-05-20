-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2020 at 06:48 PM
-- Server version: 10.2.10-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `members`
--

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `mobile_no` bigint(12) NOT NULL,
  `email` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `address` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `first_name`, `last_name`, `mobile_no`, `email`, `dob`, `address`) VALUES
(1, 'sdfsd', 'sdf', 91332323333, 'sdfd@dfcf.dsf', '1990-05-13', 'dsfffdsfsfsdsdffsd'),
(2, 'sdfsd', 'sdf', 91332323333, 'sdfd@dfcf.dsf', '1990-05-13', 'dsfffdsfsfsdsdffsd'),
(3, 'sdfsd', 'sdf', 91332323333, 'sdfd@dfcf.dsf', '1990-05-13', 'dsfffdsfsfsdsdffsd'),
(4, 'sdfsd', 'sdf', 91332323333, 'sdfd@dfcf.dsf', '1990-05-13', 'dsfffdsfsfsdsdffsd'),
(5, 'sdfsd', 'sdf', 91332323333, 'sdfd@dfcf.dsf', '1990-05-13', 'dsfffdsfsfsdsdffsd'),
(6, 'sdfsd', 'sdf', 91332323333, 'sdfd@dfcf.dsf', '1990-05-13', 'dsfffdsfsfsdsdffsd'),
(7, 'sdfsd', 'sdf', 91332323333, 'sdfd@dfcf.dsf', '1990-05-13', 'dsfffdsfsfsdsdffsd'),
(8, 'sdfsd', 'sdf', 91332323333, 'sdfd@dfcf.dsf', '2020-05-02', 'dsfffdsfsfsdsdffsd'),
(9, 'sdfsd', 'sdf', 8343232392, 'sdfd@dfcf.dsf', '1990-05-13', 'dsfffdsfsfsdsdffsd'),
(10, 'sdfsd', 'sdf', 91332323333, 'sdfd@dfcf.dsf', '1990-05-13', 'dsfffdsfsfsdsdffsd'),
(11, 'sdfsd', 'sdf', 91332323333, 'sdfd@dfcf.dsf', '1990-05-13', 'dsfffdsfsfsdsdffsd'),
(12, 'sdfsd', 'sdf', 91332323333, 'sdfd@dfcf.dsf', '1990-05-13', 'dsfffdsfsfsdsdffsd'),
(13, 'sdfsd', 'sdf', 91332323333, 'sdfd@dfcf.dsf', '1990-05-13', 'dsfffdsfsfsdsdffsd'),
(14, 'sdfsd', 'sdf', 91332323333, 'sdfd@dfcf.dsf', '1990-05-13', 'dsfffdsfsfsdsdffsd'),
(15, 'sdfsd', 'sdf', 91332323333, 'sdfd@dfcf.dsf', '1990-05-13', 'dsfffdsfsfsdsdffsd'),
(16, 'fgdgdfgf', 'gdfgfdgf', 913323244444, 'sdfd@dfcf.dsf', '1990-05-12', 'dsfffdsfsfsfsdsdsddsf'),
(18, 'sdffs', 'sdfdfdsfd', 23342443423, 'sdfsd@sdfs.dfg', '2020-05-14', 'zfzcf'),
(19, 'sdfs', 'sdfs', 9222222222, 'dfsf@dfdsf.sdg', '2020-05-03', 'sdfsdsd');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
