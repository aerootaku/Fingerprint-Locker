-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 23, 2018 at 12:44 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lockerdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_client`
--

CREATE TABLE `tbl_client` (
  `id` int(11) NOT NULL,
  `fp_template` varchar(250) NOT NULL,
  `locker_no` text NOT NULL,
  `pin_no` varchar(50) NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `email` text NOT NULL,
  `contact` text NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `address` text NOT NULL,
  `status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_client`
--

INSERT INTO `tbl_client` (`id`, `fp_template`, `locker_no`, `pin_no`, `firstname`, `lastname`, `email`, `contact`, `gender`, `address`, `status`) VALUES
(1, '2', '1', '7r1jlpsxOw', 'x', 'x', 'x@email.com', '09215388860', 'Male', '8th Street Balimbing\r\nNorth Signal Village', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_fp`
--

CREATE TABLE `tbl_fp` (
  `id` int(11) NOT NULL,
  `fp_template` text NOT NULL,
  `fp_blob` blob NOT NULL,
  `dtcreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_fp`
--

INSERT INTO `tbl_fp` (`id`, `fp_template`, `fp_blob`, `dtcreated`) VALUES
(1, '2', '', '2018-06-23 10:02:41');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_locker`
--

CREATE TABLE `tbl_locker` (
  `id` int(11) NOT NULL,
  `locker_no` text NOT NULL,
  `status` enum('Active','Occupied') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_locker`
--

INSERT INTO `tbl_locker` (`id`, `locker_no`, `status`) VALUES
(1, '1', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_locker_logs`
--

CREATE TABLE `tbl_locker_logs` (
  `id` int(11) NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `time` time NOT NULL,
  `date` date NOT NULL,
  `remarks` text NOT NULL,
  `dtcreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `email` text NOT NULL,
  `gender` text NOT NULL,
  `contact_no` text NOT NULL,
  `status` text NOT NULL,
  `role` enum('Client','Admin','Super Admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `username`, `password`, `firstname`, `lastname`, `email`, `gender`, `contact_no`, `status`, `role`) VALUES
(1, 'superadmin', '$2y$10$ZC2kBJWuGwiXoLSJKcD.meXo/1LRPMrYqwV8qhhcnix.FS4Ev37qy', 'Super User', 'Admin', 'superadmin@email.com', 'Male', '09123456789', 'Active', 'Super Admin'),
(3, 'asd', '$2y$10$0XuNlp1siUSXnlJeABKuN.d3Ypnh0QPHP4zrLCvoAklJLLC23XGzy', 'asd', 'asd111', 'admin@email.com', 'Male', '9215388860', 'Active', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_client`
--
ALTER TABLE `tbl_client`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_fp`
--
ALTER TABLE `tbl_fp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_locker`
--
ALTER TABLE `tbl_locker`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_locker_logs`
--
ALTER TABLE `tbl_locker_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_client`
--
ALTER TABLE `tbl_client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_fp`
--
ALTER TABLE `tbl_fp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_locker`
--
ALTER TABLE `tbl_locker`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_locker_logs`
--
ALTER TABLE `tbl_locker_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
