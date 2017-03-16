-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 02, 2017 at 03:03 AM
-- Server version: 10.1.20-MariaDB
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id517868_interceptor`
--

-- --------------------------------------------------------

--
-- Table structure for table `checkpoints`
--

CREATE TABLE `checkpoints` (
  `id` int(11) NOT NULL,
  `operation_id` int(11) NOT NULL,
  `name` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `lat` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `lng` mediumtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `checkpoints`
--

INSERT INTO `checkpoints` (`id`, `operation_id`, `name`, `lat`, `lng`) VALUES
(1, 1, 'test', '14.606182665321', '121.03003455589'),
(2, 1, 'test2', '14.607846894341', '121.02946258992'),
(3, 1, 'test3', '14.608119851008', '121.02934967095'),
(4, 1, 'test4', '14.608378475308', '121.02913404287'),
(5, 1, 'test4', '14.60866775461', '121.02857648787'),
(6, 1, 'test5', '14.609120514126', '121.02746751214'),
(7, 4, '', '14.607608843871', '121.03106859735'),
(8, 4, '', '14.605915322506', '121.03020279301'),
(9, 4, 'pinaglabana', '14.603823033792', '121.03096930256'),
(10, 4, 'ibuna', '14.603030870518', '121.03341838692'),
(11, 4, '', '14.604945447623', '121.03535902847'),
(12, 4, '', '14.60754627338', '121.0345159588'),
(13, 5, '', '14.605956700079', '121.03683127957'),
(14, 5, 'artiaga', '14.605956700079', '121.03683127957'),
(15, 5, '', '14.602174387101', '121.03550328566'),
(16, 5, 'test', '14.602174387101', '121.03550328566'),
(17, 5, '', '14.605038455768', '121.03224032476'),
(18, 5, 'bagiua', '14.605038455768', '121.03224032476'),
(19, 6, '', '14.603190220559', '121.04038814883'),
(20, 6, '', '14.603190220559', '121.04038814883'),
(21, 6, '', '14.603190220559', '121.04038814883'),
(22, 6, 'xavier', '14.603190220559', '121.04038814883'),
(23, 6, '', '14.603960905264', '121.03897107126'),
(24, 6, 'xavier1', '14.603960905264', '121.03897107126'),
(25, 7, '', '14.60652852681', '121.03669251003'),
(26, 7, '', '14.60652852681', '121.03669251003'),
(27, 7, '', '14.603119095706', '121.04051830533'),
(28, 7, 'label1', '14.603119095706', '121.04051830533'),
(29, 7, '', '14.605637975184', '121.04189449488'),
(30, 7, '', '14.605637975184', '121.04189449488'),
(31, 8, '', '14.602213245635', '121.03547854316'),
(32, 8, '', '14.602213245635', '121.03547854316'),
(33, 8, '', '14.604930498044', '121.03572039973'),
(34, 8, 'marwen', '14.604930498044', '121.03572039973'),
(35, 8, '', '14.606676281526', '121.03159499855'),
(36, 8, '', '14.606676281526', '121.03159499855'),
(37, 8, '', '14.604323398011', '121.02974909342'),
(38, 8, '', '14.604323398011', '121.02974909342'),
(39, 8, '', '14.601945944034', '121.03035897242'),
(40, 8, '', '14.601945944034', '121.03035897242'),
(41, 9, '', '14.598900422705', '121.02866095383'),
(42, 9, '', '14.602193221098', '121.0298076807'),
(43, 9, '', '14.602839322816', '121.02685416576'),
(44, 9, '', '14.601382479299', '121.02567508404'),
(45, 9, '', '14.60289625445', '121.02840937425');

-- --------------------------------------------------------

--
-- Table structure for table `markers`
--

CREATE TABLE `markers` (
  `id` int(11) NOT NULL,
  `name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `lat` float(10,6) NOT NULL,
  `lng` float(10,6) NOT NULL,
  `type` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `markers`
--

INSERT INTO `markers` (`id`, `name`, `address`, `lat`, `lng`, `type`) VALUES
(1, 'Best Bar Ever', '123 Main St', -37.123451, 122.123451, 'bar'),
(2, 'Data', '43 Bar', 37.433296, -122.145653, 'bar');

-- --------------------------------------------------------

--
-- Table structure for table `on_going_operation`
--

CREATE TABLE `on_going_operation` (
  `id` int(11) NOT NULL,
  `checkpoint_id` int(11) NOT NULL,
  `lat` text COLLATE utf8_unicode_ci NOT NULL,
  `lng` text COLLATE utf8_unicode_ci NOT NULL,
  `time_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `counter` int(50) NOT NULL,
  `breached` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `on_going_operation`
--

INSERT INTO `on_going_operation` (`id`, `checkpoint_id`, `lat`, `lng`, `time_updated`, `counter`, `breached`) VALUES
(1, 0, '', '', '2017-01-31 03:26:55', 0, ''),
(2, 100, '', '', '2017-01-31 03:30:46', 0, 'no'),
(3, 1, '14.609350099999999', '121.08801059999998', '0000-00-00 00:00:00', 203, 'yes'),
(4, 10, '14.6262913', '121.0589671', '0000-00-00 00:00:00', 17, 'no'),
(5, 28, '14.6094007', '121.0878786', '0000-00-00 00:00:00', 32, 'yes'),
(6, 34, '14.6260645', '121.0625779', '0000-00-00 00:00:00', 228, 'no'),
(7, 2, '14.734519', '121.1302672', '0000-00-00 00:00:00', 3619, 'no');

-- --------------------------------------------------------

--
-- Table structure for table `plotting`
--

CREATE TABLE `plotting` (
  `plotting_id` int(5) NOT NULL,
  `operation_id` int(5) NOT NULL,
  `target_location` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `checkpoint_targets` mediumtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `target`
--

CREATE TABLE `target` (
  `id` int(11) NOT NULL,
  `operation_id` int(11) NOT NULL,
  `lat` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `lng` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `radius` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `target`
--

INSERT INTO `target` (`id`, `operation_id`, `lat`, `lng`, `radius`) VALUES
(1, 1, '14.606425238352', '121.02727890015', 300),
(2, 4, '14.605594669607', '121.0328578949', 300),
(3, 5, '14.604577218619', '121.03474617004', 300),
(4, 6, '14.601603353697', '121.03811502457', 300),
(5, 7, '14.605299427617', '121.03910207748', 300),
(6, 8, '14.603821265059', '121.03283643723', 350),
(7, 9, '14.600938884382', '121.02790117264', 250);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_operations`
--

CREATE TABLE `tbl_operations` (
  `operation_id` int(11) NOT NULL,
  `operation_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `operation_password` varchar(50) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `date_plan` date NOT NULL,
  `date_execute` date NOT NULL,
  `num_officers` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_operations`
--

INSERT INTO `tbl_operations` (`operation_id`, `operation_name`, `operation_password`, `date_plan`, `date_execute`, `num_officers`) VALUES
(1, 'test', 'test', '2017-01-31', '2017-02-03', 7),
(2, 'Sample', 'Sample', '2017-01-31', '2017-02-02', 0),
(3, 'Testing123', 'sample', '2017-01-31', '2017-02-02', 0),
(4, 'sampling', 'sampling', '2017-01-31', '2017-02-02', 7),
(5, 'tukhang', 'tukhang', '2017-01-31', '2017-02-03', 7),
(6, 'sample123', 'sample123', '2017-01-31', '2017-02-02', 7),
(7, 'javier', 'tandoc', '2017-01-31', '2017-02-14', 7),
(8, 'marwen', 'marwen', '2017-02-01', '2017-02-23', 11),
(9, 'Drugden', 'drugs', '2017-02-01', '2017-02-09', 6),
(10, 'asa', 'dasd', '2017-02-01', '2017-02-16', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `checkpoints`
--
ALTER TABLE `checkpoints`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `markers`
--
ALTER TABLE `markers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `on_going_operation`
--
ALTER TABLE `on_going_operation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plotting`
--
ALTER TABLE `plotting`
  ADD PRIMARY KEY (`plotting_id`);

--
-- Indexes for table `target`
--
ALTER TABLE `target`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_operations`
--
ALTER TABLE `tbl_operations`
  ADD PRIMARY KEY (`operation_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `checkpoints`
--
ALTER TABLE `checkpoints`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `markers`
--
ALTER TABLE `markers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `on_going_operation`
--
ALTER TABLE `on_going_operation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `plotting`
--
ALTER TABLE `plotting`
  MODIFY `plotting_id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `target`
--
ALTER TABLE `target`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tbl_operations`
--
ALTER TABLE `tbl_operations`
  MODIFY `operation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
