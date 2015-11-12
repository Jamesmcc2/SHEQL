-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 25, 2014 at 02:12 PM
-- Server version: 5.5.40-36.1-log
-- PHP Version: 5.4.23

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `findnpco_sheqlnew`
--

-- --------------------------------------------------------

--
-- Table structure for table `sn_favorites`
--

DROP TABLE IF EXISTS `sn_favorites`;
CREATE TABLE IF NOT EXISTS `sn_favorites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pic_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `sn_favorites`
--

INSERT INTO `sn_favorites` (`id`, `pic_id`, `user_id`) VALUES
(1, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `sn_images`
--

DROP TABLE IF EXISTS `sn_images`;
CREATE TABLE IF NOT EXISTS `sn_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file` varchar(200) NOT NULL,
  `picture_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `sn_images`
--

INSERT INTO `sn_images` (`id`, `file`, `picture_id`) VALUES
(1, '1416177776637BridgeIMG_1188.JPG', 1),
(2, '141617792243mapts.png', 2),
(3, '1416796669778Knee_HospA.jpg', 4);

-- --------------------------------------------------------

--
-- Table structure for table `sn_pictures`
--

DROP TABLE IF EXISTS `sn_pictures`;
CREATE TABLE IF NOT EXISTS `sn_pictures` (
  `pic_id` int(11) NOT NULL AUTO_INCREMENT,
  `description` text NOT NULL,
  `medical_code` text NOT NULL,
  `facility` text NOT NULL,
  `facility_zip_code` varchar(5) NOT NULL,
  `icd9` varchar(11) NOT NULL,
  `icd10` varchar(11) NOT NULL,
  `zip` varchar(10) NOT NULL,
  `file` varchar(250) NOT NULL,
  `user_id` int(11) NOT NULL,
  `keywords` text NOT NULL,
  `type` varchar(250) NOT NULL,
  `summary` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `amount` varchar(11) NOT NULL,
  `institution` varchar(250) NOT NULL,
  `physician` varchar(250) NOT NULL,
  `cost` varchar(11) NOT NULL,
  `cost2` varchar(11) NOT NULL,
  `state` varchar(5) NOT NULL,
  PRIMARY KEY (`pic_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `sn_pictures`
--

INSERT INTO `sn_pictures` (`pic_id`, `description`, `medical_code`, `facility`, `facility_zip_code`, `icd9`, `icd10`, `zip`, `file`, `user_id`, `keywords`, `type`, `summary`, `date`, `amount`, `institution`, `physician`, `cost`, `cost2`, `state`) VALUES
(1, 'First fill', '1234', 'Mr. Smith', '23232', '', '', '', '', 1, 'bike, bill, 234', '', '', '2014-10-30 06:00:00', '', '', 'John Doe', '232', '', ''),
(2, 'Second bill', '23232', 'Peter Doe', '23232', '', '', '', '', 2, 'database, map, second bill, 33', '', '', '2014-11-21 07:00:00', '', '', 'Luke Strom', '22', '', ''),
(4, 'testbill1', '11111', 'SHMC', '97477', '', '', '', '', 3, 'knee, surgery, katz, springfield', '', '', '2014-11-23 07:00:00', '', '', 'Katx', '$100', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `sn_users`
--

DROP TABLE IF EXISTS `sn_users`;
CREATE TABLE IF NOT EXISTS `sn_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `password` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `middlename` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `address` varchar(200) NOT NULL,
  `zip` varchar(250) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `unique_id` int(8) NOT NULL,
  `super` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `sn_users`
--

INSERT INTO `sn_users` (`user_id`, `password`, `email`, `firstname`, `middlename`, `lastname`, `address`, `zip`, `status`, `unique_id`, `super`) VALUES
(1, '0b4e7a0e5fe84ad35fb5f95b9ceeac79', 'iequals10@gmail.com', '', '', '', '', '', 2, 67359233, 0),
(2, '0b4e7a0e5fe84ad35fb5f95b9ceeac79', 'testEmail@gmail.com', '', '', '', '', '', 2, 65470341, 0),
(3, '5a105e8b9d40e1329780d62ea2265d8a', 'mcclellandorama@gmail.com', '', '', '', '', '', 2, 87884059, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
