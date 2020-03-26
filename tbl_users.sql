-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2020 at 02:20 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lawangs`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `user_id` int(11) NOT NULL,
  `user_ip_address` varchar(15) DEFAULT NULL,
  `user_username` varchar(20) NOT NULL,
  `user_password` text NOT NULL,
  `user_fullname` varchar(100) NOT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `user_level` varchar(1) NOT NULL,
  `user_session` text DEFAULT NULL,
  `user_is_active` enum('0','1') NOT NULL DEFAULT '1',
  `user_create_by` varchar(20) NOT NULL,
  `user_create_dt` datetime NOT NULL DEFAULT current_timestamp(),
  `user_modify_by` varchar(20) DEFAULT NULL,
  `user_modify_dt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `user_ip_address`, `user_username`, `user_password`, `user_fullname`, `user_email`, `user_level`, `user_session`, `user_is_active`, `user_create_by`, `user_create_dt`, `user_modify_by`, `user_modify_dt`) VALUES
(1, NULL, 'admin', '$2y$10$Ljtq4r2.nIQhundygrRXXOU6Nkul6PQj76yqk0fnNxCgVvz4cUIsa', 'Administrator', NULL, '1', NULL, '1', 'lawangs', '2020-03-25 18:54:00', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_username` (`user_username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
