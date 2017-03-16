-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 06, 2017 at 04:19 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `interceptor`
--

-- --------------------------------------------------------

--
-- Table structure for table `breached`
--

CREATE TABLE IF NOT EXISTS `breached` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `checkpoint_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `lat` text COLLATE utf8_unicode_ci NOT NULL,
  `lng` text COLLATE utf8_unicode_ci NOT NULL,
  `time_happened` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `breached`
--

INSERT INTO `breached` (`id`, `checkpoint_id`, `lat`, `lng`, `time_happened`) VALUES
(1, '8', '14.6601926', '121.02949149999999', '2017-03-01 17:56:53'),
(2, '8', '14.6601926', '121.02949149999999', '2017-03-01 17:58:54'),
(3, '8', '14.6602933', '121.0294737', '2017-03-01 18:08:58'),
(4, '8', '14.6602933', '121.0294737', '2017-03-01 18:11:16'),
(5, '8', '14.6602933', '121.0294737', '2017-03-01 18:20:11'),
(6, '8', '14.6602933', '121.0294737', '2017-03-01 18:23:05'),
(7, '8', '14.6602933', '121.0294737', '2017-03-01 18:27:52'),
(8, '11', '14.6604242', '121.02959720000001', 'Thu Mar 02 2017 05:42:04 GMT+0800 (Malay Peninsula'),
(9, '13', '14.6604618', '121.02959150000001', 'Thu Mar 02 2017 06:08:33 GMT+0800 (Malay Peninsula');

-- --------------------------------------------------------

--
-- Table structure for table `breached_checkpoint`
--

CREATE TABLE IF NOT EXISTS `breached_checkpoint` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `lat` text COLLATE utf8_unicode_ci NOT NULL,
  `lng` text COLLATE utf8_unicode_ci NOT NULL,
  `operation_id` int(20) NOT NULL,
  `checkpoint_id` int(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `breached_checkpoint`
--

INSERT INTO `breached_checkpoint` (`id`, `name`, `lat`, `lng`, `operation_id`, `checkpoint_id`) VALUES
(1, 'chcpt1', '14.660768530209', '121.02701326137', 6, 8),
(2, 'chcpt1', '14.661581871404', '121.02741872679', 6, 8),
(3, 'chcpt1', '14.661229689363', '121.02699239536', 7, 11),
(4, 'chcpt1', '14.662655082851', '121.02843342452', 7, 11),
(5, 'chcpt1', '14.662876854184', '121.03060966276', 7, 11),
(6, 'chcpt1', '14.661111358471', '121.03214548936', 7, 11),
(7, 'chcpt1', '14.661502925693', '121.02752335633', 8, 13);

-- --------------------------------------------------------

--
-- Table structure for table `checkpoints`
--

CREATE TABLE IF NOT EXISTS `checkpoints` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `operation_id` int(11) NOT NULL,
  `name` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `lat` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `lng` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `location` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `has_composition` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=31 ;

--
-- Dumping data for table `checkpoints`
--

INSERT INTO `checkpoints` (`id`, `operation_id`, `name`, `lat`, `lng`, `location`, `has_composition`) VALUES
(1, 1, 'chcpt1', '14.605634378398', '121.04650588489', '47 Buchanan, San Juan, 1503 Metro Manila, Philippines', ''),
(2, 1, 'chcpt2', '14.604716896548', '121.0466571572', 'Polk, San Juan, Metro Manila, Philippines', ''),
(3, 1, 'chcpt3', '14.603115748094', '121.04790731196', '7 Club Filipino Avenue, San Juan, Metro Manila, Philippines', ''),
(4, 2, 'chcpt1', '14.606507666447', '121.04636708859', '1419 Johnson, San Juan, 1504 Metro Manila, Philippines', 'yes'),
(5, 2, 'chcpt2', '14.603729707915', '121.04755431371', 'Hayes, San Juan, Metro Manila, Philippines', 'yes'),
(6, 3, 'chcpt1', '14.59982370761', '121.0367531702', '404 P. Guevarra St, San Juan, Metro Manila, Philippines', 'yes'),
(7, 4, 'chcpt1', '14.607675586202', '121.04811832742', '37 Eisenhower, Manila, Metro Manila, Philippines', 'no'),
(8, 6, 'chcpt1', '14.607158604014', '121.04577711517', '106 Kennedy, San Juan, Metro Manila, Philippines', 'yes'),
(9, 6, 'chcpt2', '14.605116979614', '121.04596946286', '46 Roosevelt, San Juan, 1502 Metro Manila, Philippines', 'no'),
(10, 6, 'chcpt3', '14.603798555571', '121.04763068846', 'Hayes, San Juan, Metro Manila, Philippines', 'no'),
(11, 7, 'chcpt1', '14.60616676136', '121.04601874002', '1419 Johnson, San Juan, 1504 Metro Manila, Philippines', 'yes'),
(12, 7, 'chcpt2', '14.604381194935', '121.04729329829', 'Polk, San Juan, Metro Manila, Philippines', 'yes'),
(13, 8, 'chcpt1', '14.607377711539', '121.04593474694', '106 Kennedy, San Juan, Metro Manila, Philippines', 'yes'),
(14, 9, 'chcpt1', '14.606480136763', '121.04633038233', '1419 Johnson, San Juan, 1504 Metro Manila, Philippines', 'yes'),
(15, 9, 'chcpt2', '14.604107870013', '121.04817582234', '25 Buchanan, San Juan, 1503 Metro Manila, Philippines', 'yes'),
(16, 9, 'chcpt3', '14.608780562087', '121.04856673423', '12 3rd West Crame, San Juan, Metro Manila, Philippines', 'yes'),
(17, 10, 'chcpt1', '14.601862324379', '121.03086292998', '8 J. P. Rizal, San Juan, 1500 Metro Manila, Philippines', 'yes'),
(18, 11, 'chcpt1', '14.606462157068', '121.04544444901', '30 Buchanan, San Juan, Metro Manila, Philippines', 'no'),
(19, 11, 'chcpt2', '14.604016951542', '121.04647399771', '51 Van Buren, San Juan, 1503 Metro Manila, Philippines', 'no'),
(20, 12, 'chcpt1', '14.60649949393', '121.04635619189', '1419 Johnson, San Juan, 1504 Metro Manila, Philippines', 'no'),
(21, 12, 'chcpt2', '14.60426070284', '121.04526242218', '46 Roosevelt, San Juan, 1502 Metro Manila, Philippines', 'no'),
(22, 12, 'chcpt3', '14.602600273221', '121.04748159702', '7 Club Filipino Avenue, San Juan, Metro Manila, Philippines', 'no'),
(23, 14, 'chcpt1', '14.607285031536', '121.04651099992', '1419 Johnson, San Juan, 1504 Metro Manila, Philippines', 'no'),
(24, 14, 'chcpt2', '14.604611573768', '121.04783455707', '25 Buchanan, San Juan, 1503 Metro Manila, Philippines', 'no'),
(25, 14, 'chcpt3', '14.604861999438', '121.05067422861', '6 Rd 7, San Juan, 1504 Metro Manila, Philippines', 'no'),
(26, 14, 'chcpt4', '14.608672032229', '121.04865253127', '12 3rd West Crame, San Juan, Metro Manila, Philippines', 'no'),
(27, 15, 'chcpt1', '14.606179695555', '121.04603011875', '1419 Johnson, San Juan, 1504 Metro Manila, Philippines', 'no'),
(28, 15, 'chcpt2', '14.604375704005', '121.04724005539', 'Polk, San Juan, Metro Manila, Philippines', 'no'),
(29, 15, 'chcpt3', '14.603996626132', '121.04919804445', '7 Club Filipino Avenue, San Juan, Metro Manila, Philippines', 'no'),
(30, 15, 'chcpt4', '14.604702215407', '121.05073858904', '6 Rd 7, San Juan, 1504 Metro Manila, Philippines', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `checkpoint_composition`
--

CREATE TABLE IF NOT EXISTS `checkpoint_composition` (
  `checkpoint_id` int(5) NOT NULL,
  `police_id` int(4) NOT NULL,
  `designation` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `marked_vehicle` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `checkpoint_composition`
--

INSERT INTO `checkpoint_composition` (`checkpoint_id`, `police_id`, `designation`, `marked_vehicle`) VALUES
(1, 0, 'Team Leader', 'MC 4567'),
(1, 0, 'Investigating', 'MC 4567'),
(2, 0, 'Team Leader', 'SD 0953'),
(2, 0, 'Checkpoint Position', 'SD 0953'),
(3, 0, 'Team Leader', 'MC 4563'),
(3, 0, 'Investigating', 'MC 4563'),
(4, 0, 'Team Leader', 'DH 4324'),
(4, 0, 'Investigating', 'DH 4324'),
(5, 0, 'Team Leader', 'ZX 4231'),
(5, 0, 'Search', 'ZX 4231'),
(6, 0, 'Team Leader', 'KC 1234'),
(6, 0, 'Spokeperson', 'KC 1234'),
(8, 0, 'Team Leader', 'MC 4563'),
(8, 0, 'Investigating', 'MC 4563'),
(11, 0, 'Team Leader', 'MD 4212'),
(11, 0, 'Investigating', 'MD 4212'),
(12, 0, 'Team Leader', 'MC 4563'),
(12, 0, 'Search', 'MC 4563'),
(13, 0, 'Team Leader', 'MD 4212'),
(13, 0, 'Investigating', 'MD 4212'),
(16, 0, 'Team Leader', 'MD 4212'),
(16, 0, 'Investigating', ''),
(14, 0, 'Team Leader', 'MD 4212'),
(14, 0, 'Investigating', ''),
(15, 0, 'Team Leader', 'MD 2342'),
(15, 0, 'Spokeperson', ''),
(17, 0, 'Team Leader', 'LP 3241'),
(17, 0, 'Investigating', '');

-- --------------------------------------------------------

--
-- Table structure for table `criminal_profiling`
--

CREATE TABLE IF NOT EXISTS `criminal_profiling` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `height` int(11) NOT NULL,
  `age` int(3) NOT NULL,
  `gender` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `crime` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `image` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `operation_id` int(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;

--
-- Dumping data for table `criminal_profiling`
--

INSERT INTO `criminal_profiling` (`id`, `name`, `height`, `age`, `gender`, `crime`, `image`, `operation_id`) VALUES
(1, 'Jose', 134, 30, 'Male', 'Drug Possession', 'images/criminals/1.jpg', 1),
(2, 'Marwen Alcantara', 154, 21, 'Male', 'Rape', 'images/criminals/2.png', 2),
(3, 'Marwen Alcantara', 145, 21, 'Male', 'Rape', 'images/criminals/3.png', 3),
(4, 'sasd', 23, 3123, 'Male', 'Kidnapping', 'images/criminals/4.png', 4),
(5, 'Imaw Malzahar', 154, 30, 'Male', 'Kidnapping', 'images/criminals/6.PNG', 6),
(6, 'Jeff Nubla', 156, 30, 'Select Gen', 'Select Crime', 'images/criminals/7.jpg', 7),
(7, 'du', 231, 32, 'Male', 'Kidnapping', 'images/criminals/8.jpg', 8),
(8, 'Rihanna On The Floor', 145, 23, 'Male', 'Murder', 'images/criminals/9.jpg', 9),
(9, 'Molly Poly', 156, 21, 'Male', 'Drug Possession', 'images/criminals/10.jpg', 10),
(10, 'asdasd', 123, 12, 'Male', 'Rape', 'images/criminals/11.jpg', 11),
(11, 'Kokak', 156, 21, 'Male', 'Kidnapping', 'images/criminals/12.jpg', 12),
(12, 'ddf', 156, 23, 'Male', 'Kidnapping', 'images/criminals/14.JPG', 14),
(13, 'dsadsa', 156, 23, 'Male', 'Kidnapping', 'images/criminals/15.png', 15),
(14, 'Paloma de Amor', 156, 24, 'Male', 'Kidnapping', 'images/criminals/16.png', 16);

-- --------------------------------------------------------

--
-- Table structure for table `on_going_operation`
--

CREATE TABLE IF NOT EXISTS `on_going_operation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `checkpoint_id` int(11) NOT NULL,
  `lat` text COLLATE utf8_unicode_ci NOT NULL,
  `lng` text COLLATE utf8_unicode_ci NOT NULL,
  `time_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `counter` int(50) NOT NULL,
  `breached` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `on_going_operation`
--

INSERT INTO `on_going_operation` (`id`, `checkpoint_id`, `lat`, `lng`, `time_updated`, `counter`, `breached`) VALUES
(1, 4, '14.6601193', '121.0295325', '0000-00-00 00:00:00', 0, 'no'),
(2, 6, '14.660157300000002', '121.02953289999999', '0000-00-00 00:00:00', 215, 'no'),
(3, 8, '14.6602346', '121.0295397', '0000-00-00 00:00:00', 0, 'no'),
(4, 11, '14.6604242', '121.02959720000001', '0000-00-00 00:00:00', 428, 'no'),
(5, 13, '14.6604618', '121.02959150000001', '0000-00-00 00:00:00', 23, 'no'),
(6, 17, '14.660426800000002', '121.02957950000001', '0000-00-00 00:00:00', 142, 'no');

-- --------------------------------------------------------

--
-- Table structure for table `police_profiling`
--

CREATE TABLE IF NOT EXISTS `police_profiling` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `last_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `middle_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `birthday` date NOT NULL,
  `height` int(11) NOT NULL,
  `gender` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `position` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `police_profiling`
--

INSERT INTO `police_profiling` (`id`, `last_name`, `first_name`, `middle_name`, `birthday`, `height`, `gender`, `position`, `image`) VALUES
(1, 'Oribello', 'Ryan Karl', 'Renosa', '1995-02-12', 156, 'Male', 'PSINSP', 'images/polices/1.jpg'),
(2, 'Lazarte', 'Daybee', 'Gallano', '1995-12-22', 156, 'Female', 'SPO4', 'images/polices/2.jpg'),
(3, 'Espano', 'Ronnel', 'Blanko', '1978-08-22', 145, 'Male', 'PO2', 'images/polices/3.jpg'),
(4, 'Javier', 'Joane April', 'Daro', '1996-04-12', 156, 'Female', 'PINSP', 'images/polices/4.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `target`
--

CREATE TABLE IF NOT EXISTS `target` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `operation_id` int(11) NOT NULL,
  `lat` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `lng` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `radius` int(5) NOT NULL,
  `location` tinytext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

--
-- Dumping data for table `target`
--

INSERT INTO `target` (`id`, `operation_id`, `lat`, `lng`, `radius`, `location`) VALUES
(1, 1, '14.605345498372', '121.04897260666', 300, 'Westwood Tower Condominium, 23 Eisenhower, San Juan, Metro Manila, Philippines'),
(2, 2, '14.606134539648', '121.04850053787', 300, '26 Eisenhower, San Juan, 1503 Metro Manila, Philippines'),
(3, 3, '14.600071307656', '121.03931665421', 300, '234 V. Ibanez, Maynila, Kalakhang Maynila, Philippines'),
(4, 4, '14.606176068058', '121.04845762253', 300, '14 Arthur, San Juan, 1503 Metro Manila, Philippines'),
(5, 6, '14.605926897481', '121.0479426384', 300, '14 Arthur, San Juan, Metro Manila, Philippines'),
(6, 7, '14.60596842593', '121.0483288765', 300, '22 Filmore, San Juan, 1503 Metro Manila, Philippines'),
(7, 8, '14.606674408363', '121.04815721512', 300, 'Roosevelt, San Juan, Metro Manila, Philippines'),
(8, 9, '14.60630065324', '121.04905843735', 300, 'Rd 11, San Juan, Metro Manila, Philippines'),
(9, 10, '14.60098495605', '121.03309392929', 300, '278 J. P. Rizal, San Juan, Metro Manila, Philippines'),
(10, 11, '14.60609301123', '121.04807138443', 300, '14 Arthur, San Juan, 1503 Metro Manila, Philippines'),
(11, 12, '14.60513785546', '121.04781389236', 300, '6 Filmore, San Juan, 1503 Metro Manila, Philippines'),
(12, 14, '14.606425238352', '121.04897260666', 300, 'Rd 11, San Juan, Metro Manila, Philippines'),
(13, 15, '14.606466766707', '121.04875802994', 300, '35 Eisenhower, San Juan, 1503 Metro Manila, Philippines');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_operations`
--

CREATE TABLE IF NOT EXISTS `tbl_operations` (
  `operation_id` int(11) NOT NULL AUTO_INCREMENT,
  `operation_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `operation_password` text COLLATE utf8_unicode_ci NOT NULL,
  `date_plan` date NOT NULL,
  `date_execute` date NOT NULL,
  `num_officers` int(11) NOT NULL,
  `mission_status` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `mission_completed` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`operation_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

--
-- Dumping data for table `tbl_operations`
--

INSERT INTO `tbl_operations` (`operation_id`, `operation_name`, `operation_password`, `date_plan`, `date_execute`, `num_officers`, `mission_status`, `mission_completed`) VALUES
(1, 'Druga', '$2y$11$kSp53HsNcFlRO3ioSLL0kuTdL9qE7EBrRsoEAvHIehS6LFsLLmV/W', '2017-02-28', '2017-02-28', 3, 'not done', ''),
(2, 'Tukhang', '$2y$11$yK8WvI6zk.7w/X0st3neDu5ohm78.rGXYabfIWyk2wV9F0/4z5rmq', '2017-03-01', '2017-03-01', 2, 'finished', ''),
(3, 'Tukhang 1', '$2y$11$Kb3/.XqoAgUgIbyLUbtbYuSlyaCl37v5g1zrgf6k7i1bDUIoJIih.', '2017-03-01', '2017-03-01', 1, 'finished', 'Wed Mar 01 2017 08:56:47 GMT+0800 (Malay Peninsula Standard Time)'),
(4, 'polygon', '$2y$11$6qAY96X5zksg1scsujEI2..EhnRI4nIUZEi1epR/NJVpSYBVoeDym', '2017-03-01', '2017-03-01', 1, 'finished', 'Wed Mar 01 2017 08:39:54 GMT+0800 (Malay Peninsula Standard Time)'),
(5, 'sample', '$2y$11$UX3KInHEejCCcNftfGsRLuSUb7Oq2Ci8h99nI.9iJsekNhLWc3ha6', '2017-03-02', '2017-03-02', 0, 'finished', 'Thu Mar 02 2017 05:10:18 GMT+0800 (Malay Peninsula Standard Time)'),
(6, 'sample', '$2y$11$R/HpNiwsKvU4.HhSioRXDOlw0p27hOjOslFRaA6dJkiyLRX.zDezy', '2017-03-02', '2017-03-02', 3, 'finished', 'Thu Mar 02 2017 01:28:44 GMT+0800 (Malay Peninsula Standard Time)'),
(7, 'Opera', '$2y$11$yDPSEXcOvsLyhH4I0DXkBeUDSHY3hjl3oekw1ksL2OdN2tA8Y6/F.', '2017-03-02', '2017-03-02', 2, 'finished', 'Thu Mar 02 2017 05:43:50 GMT+0800 (Malay Peninsula Standard Time)'),
(8, 'du', '$2y$11$dlKUmkRaAdk/oDxWRglSruqpbD4R44QgsUfXiOZz.YXMWScQ/4S5y', '2017-03-02', '2017-03-02', 1, 'finished', 'Thu Mar 02 2017 06:09:38 GMT+0800 (Malay Peninsula Standard Time)'),
(9, 'Tokhangang', '$2y$11$GmoVvkDY4TF/3UAqXSyrSuyv0gibZ7om/rl5mseonexOJ.fN8T7Fi', '2017-03-03', '2017-03-03', 3, 'not done', ''),
(10, 'asd', '$2y$11$dSbe5nOJ160dJcrkZa/9uup0j4pR8JO60WLnTCAy1JqUVeJQL.sWu', '2017-03-03', '2017-03-03', 1, 'finished', 'Fri Mar 03 2017 06:56:41 GMT+0800 (Malay Peninsula Standard Time)'),
(11, 'dasd', '$2y$11$yahcBnCoEEYmd.eki0ie.eFIjHBPjvaEiUxREjpYDx.R9ab.buJJe', '2017-03-04', '2017-03-04', 2, 'not done', ''),
(12, 'Titulo', '$2y$11$cFImoq2tEj7p4fmqKqRY6uUgR8qsGW0AosDaOt2RPcHk3z3QJWNBe', '2017-03-05', '2017-03-05', 3, 'not done', ''),
(13, 'sad', '$2y$11$w6ziih2Ubfmg6I9yPcwBbufwHfoueacl7h/I4c87E6Tso.5f7W2wm', '2017-03-05', '2017-03-05', 0, 'not done', ''),
(14, 'sdsffdfg', '$2y$11$2UXm6g7HrrhzHhBZzFHbO.u4nIc1b4RFlRhChbGd4JPZL2lMVADfO', '2017-03-05', '2017-03-05', 4, 'not done', ''),
(15, 'sdsad', '$2y$11$IAFmQ8OKVobYseimVZ0AJuOhA.fqCAWW93VT0CdoGm9hVftE8B64K', '2017-03-05', '2017-03-05', 4, 'not done', ''),
(16, 'Paloma', '$2y$11$o7wZ8AqmkcXC8/a6ma57xupA75qpVHkmnM4YI6j7Cds/zWMJCenWi', '2017-03-06', '2017-03-06', 0, 'not done', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
