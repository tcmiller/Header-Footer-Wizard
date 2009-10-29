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
-- Table structure for table `header`
--

CREATE TABLE IF NOT EXISTS `header` (
  `id` int(11) NOT NULL auto_increment,
  `selection` enum('strip','no-hdr','static','sink') NOT NULL default 'strip',
  `blockw` binary(1) NOT NULL default '1',
  `patch` binary(1) NOT NULL default '1',
  `wordmark` binary(1) NOT NULL default '1',
  `color` enum('purple','gold') NOT NULL default 'purple',
  `search` enum('basic','no','super-inline','super-tab') NOT NULL default 'basic',
  `created_date` datetime default NULL,
  `last_modified` datetime default NULL,
  `account_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `header`
--

INSERT INTO `header` (`id`, `selection`, `blockw`, `patch`, `wordmark`, `color`, `search`, `created_date`, `last_modified`, `account_id`) VALUES
(1, 'strip', '1', '0', '1', 'purple', 'basic', '2009-10-29 07:46:00', '2009-10-29 08:29:27', 1),
(2, 'strip', '1', '1', '1', 'gold', 'basic', '2009-10-29 08:55:46', '2009-10-29 08:56:02', 5),
(3, 'strip', '1', '1', '1', 'purple', 'basic', '2009-10-29 08:56:02', '2009-10-29 08:56:09', 6),
(4, 'static', '1', '1', '1', 'gold', 'basic', '2009-10-29 08:56:14', '0000-00-00 00:00:00', 4),
(5, 'strip', '1', '1', '1', 'purple', 'no', '2009-10-29 08:56:50', '2009-10-29 09:02:22', 11),
(6, 'no-hdr', '1', '1', '1', 'gold', 'basic', '2009-10-29 08:57:01', '0000-00-00 00:00:00', 10),
(7, 'strip', '1', '1', '1', 'gold', 'basic', '2009-10-29 08:57:35', '2009-10-29 08:58:04', 13),
(8, 'strip', '1', '1', '1', 'purple', 'basic', '2009-10-29 08:57:44', '2009-10-29 09:02:13', 15),
(9, 'strip', '1', '0', '1', 'purple', 'basic', '2009-10-29 08:58:49', '2009-10-29 08:58:58', 17),
(10, 'static', '1', '0', '1', 'gold', 'basic', '2009-10-29 08:59:54', '2009-10-29 09:03:34', 18),
(11, 'strip', '1', '1', '1', 'gold', 'basic', '2009-10-29 09:00:32', '2009-10-29 09:01:04', 19),
(12, 'static', '1', '1', '1', 'gold', 'basic', '2009-10-29 09:01:11', '2009-10-29 09:01:52', 20),
(13, 'static', '1', '1', '1', 'gold', 'basic', '2009-10-29 09:01:32', '2009-10-29 09:27:33', 21),
(14, 'static', '1', '1', '1', 'gold', 'basic', '2009-10-29 09:05:05', '0000-00-00 00:00:00', 22),
(15, 'strip', '1', '1', '1', 'gold', 'basic', '2009-10-29 09:10:01', '2009-10-29 09:10:31', 27),
(16, 'strip', '1', '1', '1', 'gold', 'basic', '2009-10-29 09:10:27', '2009-10-29 09:11:02', 28),
(17, 'strip', '1', '1', '1', 'purple', 'no', '2009-10-29 09:10:53', '2009-10-29 09:12:20', 26);
