-- phpMyAdmin SQL Dump
-- version 3.1.1
-- http://www.phpmyadmin.net
--
-- Host: ovid.u.washington.edu:94582
-- Generation Time: Oct 29, 2009 at 11:24 AM
-- Server version: 5.0.45
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tmplgen`
--

-- --------------------------------------------------------

--
-- Table structure for table `footer`
--

CREATE TABLE IF NOT EXISTS `footer` (
  `id` int(11) NOT NULL auto_increment,
  `selected` binary(1) NOT NULL default '1',
  `blockw` binary(1) NOT NULL default '0',
  `wordmark` binary(1) NOT NULL default '1',
  `patch` enum('purple','gold','0') NOT NULL default 'purple',
  `static` binary(1) NOT NULL default '0',
  `created_date` datetime default NULL,
  `last_modified` datetime default NULL,
  `account_id` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `footer`
--

INSERT INTO `footer` (`id`, `selected`, `blockw`, `wordmark`, `patch`, `static`, `created_date`, `last_modified`, `account_id`) VALUES
(1, '1', '0', '0', 'gold', '0', '2009-10-29 07:46:04', '2009-10-29 08:29:31', 1),
(2, '1', '1', '1', '0', '0', '2009-10-29 08:56:07', '2009-10-29 08:56:20', 5),
(3, '1', '1', '1', '0', '0', '2009-10-29 08:56:18', '0000-00-00 00:00:00', 6),
(4, '1', '0', '0', '0', '1', '2009-10-29 08:56:46', '0000-00-00 00:00:00', 4),
(5, '0', '0', '0', '0', '0', '2009-10-29 08:57:08', '0000-00-00 00:00:00', 11),
(6, '1', '1', '1', '0', '0', '2009-10-29 08:57:26', '0000-00-00 00:00:00', 10),
(7, '1', '0', '0', '0', '1', '2009-10-29 09:00:27', '2009-10-29 09:03:45', 18),
(8, '1', '1', '1', '0', '0', '2009-10-29 09:01:18', '0000-00-00 00:00:00', 19),
(9, '1', '0', '0', '0', '1', '2009-10-29 09:01:59', '2009-10-29 09:27:48', 21),
(10, '1', '0', '0', '0', '1', '2009-10-29 09:05:31', '0000-00-00 00:00:00', 22),
(11, '1', '1', '1', '0', '0', '2009-10-29 09:10:38', '2009-10-29 09:10:39', 27),
(12, '1', '0', '0', 'purple', '0', '2009-10-29 09:11:08', '0000-00-00 00:00:00', 28),
(13, '1', '0', '1', '0', '0', '2009-10-29 09:12:27', '0000-00-00 00:00:00', 26);
