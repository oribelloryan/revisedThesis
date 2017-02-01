-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2016 at 11:45 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `interceptor_db`
--
CREATE DATABASE IF NOT EXISTS `interceptor_db` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `interceptor_db`;

-- --------------------------------------------------------

--
-- Table structure for table `plotting`
--

CREATE TABLE IF NOT EXISTS `plotting` (
  `plotting_id` int(5) NOT NULL AUTO_INCREMENT,
  `operation_id` int(5) NOT NULL,
  `target_location` varchar(50) NOT NULL,
  `checkpoint_targets` mediumtext NOT NULL,
  PRIMARY KEY (`plotting_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `plotting`
--

INSERT INTO `plotting` (`plotting_id`, `operation_id`, `target_location`, `checkpoint_targets`) VALUES
(1, 4, '{"lat":14.603181460273655,"lng":121.0342526435852}', '[{"latlng":{"lat":14.608181460273656,"lng":121.0342526435852}},{"latlng":{"lat":14.604599771200972,"lng":121.02945802221188}},{"latlng":{"lat":14.598986102628272,"lng":121.03153253803077}},{"latlng":{"lat":14.599383020709361,"lng":121.03750408278597}},{"latlng":{"lat":14.605221870582723,"lng":121.03881736983885}},{"latlng":{"lat":14.608137474332972,"lng":121.03359088483467}},{"latlng":{"lat":14.603952717523093,"lng":121.02931248546474}},{"latlng":{"lat":14.598662999248198,"lng":121.03211173023772}},{"latlng":{"lat":14.599846769965394,"lng":121.03797820938757}},{"latlng":{"lat":14.605808070217744,"lng":121.03850716120792}},{"latlng":{"lat":14.608006290416116,"lng":121.03294076931661}},{"latlng":{"lat":14.603292094054964,"lng":121.02925386771835}},{"latlng":{"lat":14.598419395371579,"lng":121.03272859047968}},{"latlng":{"lat":14.600369191017464,"lng":121.03838678698264}},{"latlng":{"lat":14.606348056289086,"lng":121.03812209699299}},{"latlng":{"lat":14.607790216622279,"lng":121.032313735'),
(2, 5, '{"lat":14.604058109157766,"lng":121.03968143463135', '[{"latlng":{"lat":14.610058109157766,"lng":121.03968143463135}},{"latlng":{"lat":14.605760082270544,"lng":121.03392788898338}},{"latlng":{"lat":14.599023679983308,"lng":121.03641730796608}},{"latlng":{"lat":14.599499981680612,"lng":121.04358316167236}},{"latlng":{"lat":14.606506601528647,"lng":121.04515910613577}},{"latlng":{"lat":14.610005326028947,"lng":121.03888732413077}},{"latlng":{"lat":14.60498361785709,"lng":121.03375324488684}},{"latlng":{"lat":14.598635955927216,"lng":121.0371123386144}},{"latlng":{"lat":14.600056480787853,"lng":121.04415211359424}},{"latlng":{"lat":14.607210041090672,"lng":121.04478685577851}},{"latlng":{"lat":14.609847905328719,"lng":121.03810718550915}},{"latlng":{"lat":14.604190869695337,"lng":121.03368290359117}},{"latlng":{"lat":14.598343631275275,"lng":121.03785257090476}},{"latlng":{"lat":14.600683386050337,"lng":121.04464240670836}},{"latlng":{"lat":14.607858024376284,"lng":121.04432477872069}},{"latlng":{"lat":14.609588616776113,"lng":121.03735474481891}},{"latlng":{"lat":14.603395785694731,"lng":121.03371810270778}},{"latlng":{"lat":14.598151849297402,"lng":121.03862498091166}},{"latlng":{"lat":14.601369667460991,"lng":121.04504541461301}},{"latlng":{"lat":14.608439150523735,"lng":121.04378100491977}},{"latlng":{"lat":14.609232022391492,"lng":121.03664324078466}},{"latlng":{"lat":14.602612354862348,"lng":121.03385822293012}},{"latlng":{"lat":14.598063984277879,"lng":121.03941597856283}},{"latlng":{"lat":14.602103250326445,"lng":121.04535404663557}},{"latlng":{"lat":14.608943194980926,"lng":121.04316510173658}},{"latlng":{"lat":14.60878439623063,"lng":121.0359851918762}},{"latlng":{"lat":14.601854361175038,"lng":121.03410079893024}},{"latlng":{"lat":14.598081582146918,"lng":121.04021164674805}},{"latlng":{"lat":14.60287122771374,"lng":121.045562872588}},{"latlng":{"lat":14.609361289400017,"lng":121.0424879056036}},{"latlng":{"lat":14.608253613996636,"lng":121.03539217605362}},{"latlng":{"lat":14.601135141058945,"lng":121.03444156273463}},{"latlng":{"lat":14.598204333280995,"lng":121.04099798618165}},{"latlng":{"lat":14.603660087539751,"lng":121.04566821830804}},{"latlng":{"lat":14.609686077670482,"lng":121.04176133136434}},{"latlng":{"lat":14.60764901447185,"lng":121.03487462706028}},{"latlng":{"lat":14.600467348743418,"lng":121.03487451881688}},{"latlng":{"lat":14.598430077950464,"lng":121.04176116171197}},{"latlng":{"lat":14.604455950307877,"lng":121.04566823030336}},{"latlng":{"lat":14.609911845345282,"lng":121.04099816263931}},{"latlng":{"lat":14.606981235207808,"lng":121.03444165084807}},{"latlng":{"lat":14.599862733617728,"lng":121.03539204958474}},{"latlng":{"lat":14.598754844318671,"lng":121.04248774574148}},{"latlng":{"lat":14.605244813309108,"lng":121.04556290836308}},{"latlng":{"lat":14.610034620182995,"lng":121.04021182690622}},{"latlng":{"lat":14.606262025364147,"lng":121.03410086536337}},{"latlng":{"lat":14.599331933507896,"lng":121.03598504940703}},{"latlng":{"lat":14.599172918323934,"lng":121.04316495447733}},{"latlng":{"lat":14.606012796990976,"lng":121.04535410556082}},{"latlng":{"lat":14.610052242036932,"lng":121.03941615925191}},{"latlng":{"lat":14.605504038989478,"lng":121.03385826651413}},{"latlng":{"lat":14.59888428751078,"lng":121.03664308482178}},{"latlng":{"lat":14.599676944214892,"lng":121.04378087285431}},{"latlng":{"lat":14.60674638915961,"lng":121.04504549565183}},{"latlng":{"lat":14.60996440086156,"lng":121.03862515895253}},{"latlng":{"lat":14.604720612381284,"lng":121.03371812267585}},{"latlng":{"lat":14.59852767167849,"lng":121.03735457810637}},{"latlng":{"lat":14.60025805397037,"lng":121.04432466417256}},{"latlng":{"lat":14.607432682718366,"lng":121.04464250843489}},{"latlng":{"lat":14.609772642167576,"lng":121.03785274316488}},{"latlng":{"lat":14.603925529442094,"lng":121.0336828995919}},{"latlng":{"lat":14.598268360444166,"lng":121.03810701098018}},{"latlng":{"lat":14.600906023326672,"lng":121.04478676076326}},{"latlng":{"lat":14.608059602760134,"lng":121.0441522342187}},{"latlng":{"lat":14.60948033982959,"lng":121.03711250206288}},{"latlng":{"lat":14.603132779160306,"lng":121.03375321699059}},{"latlng":{"lat":14.598110916227235,"lng":121.03888714485606}},{"latlng":{"lat":14.601609451667132,"lng":121.04515903232505}},{"latlng":{"lat":14.608616119017809,"lng":121.04358329907234}},{"latlng":{"lat":14.609092636724924,"lng":121.03641745972709}},{"latlng":{"lat":14.602356309482673,"lng":121.03392783768118}},{"latlng":{"lat":14.598058109160492,"lng":121.03968125376525}}]');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_operations`
--

CREATE TABLE IF NOT EXISTS `tbl_operations` (
  `operation_id` int(11) NOT NULL AUTO_INCREMENT,
  `operation_name` varchar(100) NOT NULL,
  `operation_password` varchar(50) NOT NULL,
  `date_plan` date NOT NULL,
  `date_execute` date NOT NULL,
  `num_officers` int(11) NOT NULL,
  PRIMARY KEY (`operation_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tbl_operations`
--

INSERT INTO `tbl_operations` (`operation_id`, `operation_name`, `operation_password`, `date_plan`, `date_execute`, `num_officers`) VALUES
(1, 'Operation Tukhang', 'pass1234567', '2016-11-12', '2016-11-18', 25),
(2, 'Operation Drugs', 'pass1234567', '2016-11-12', '2016-11-18', 25),
(3, 'RelationArtes', 'asdfgh', '2016-11-12', '2016-11-28', 74),
(4, 'Operation DrugDen', 'qwerty', '2016-11-13', '2016-11-23', 9),
(5, 'Operation Tiklo', 'Tikboy', '2016-11-14', '2016-11-25', 14),
(6, 'Operation Dimasalang', '1234', '2016-11-14', '2016-11-30', 45);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
