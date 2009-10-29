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
-- Table structure for table `account`
--

CREATE TABLE IF NOT EXISTS `account` (
  `id` int(11) NOT NULL auto_increment,
  `owner` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `site_url` varchar(150) NOT NULL,
  `active` binary(1) NOT NULL,
  `code_pref` enum('copy-paste','include','both') NOT NULL default 'copy-paste',
  `created_date` datetime default NULL,
  `modified_date` datetime default NULL,
  `last_accessed` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `owner`, `email`, `site_url`, `active`, `code_pref`, `created_date`, `modified_date`, `last_accessed`) VALUES
(1, 'tcmiller', 'tcmiller@uw.edu', 'http://www.cnn.com/', '1', 'copy-paste', '2009-10-29 07:45:28', '2009-10-29 08:12:27', '0000-00-00 00:00:00'),
(2, 'kilianf', '', '', '0', 'copy-paste', '2009-10-29 08:54:58', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'sagtarap', '', '', '0', 'copy-paste', '2009-10-29 08:55:15', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'rells', 'rells@uw.edu', 'http://www.washington.edu/itconnect/', '1', 'include', '2009-10-29 08:55:18', '2009-10-29 08:58:49', '0000-00-00 00:00:00'),
(5, 'wisher', 'wisher@u.washington.edu', 'geomapnw.ess.washington.edu', '1', '', '2009-10-29 08:55:23', '2009-10-29 08:56:32', '0000-00-00 00:00:00'),
(6, 'cajames', 'cajames@u.washington.edu', 'depts.washington.edu/pharm', '1', 'copy-paste', '2009-10-29 08:55:30', '2009-10-29 08:56:28', '0000-00-00 00:00:00'),
(7, 'pkeyes', '', '', '0', 'copy-paste', '2009-10-29 08:55:41', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'kkeithly', '', '', '0', 'copy-paste', '2009-10-29 08:55:44', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 'mwinkle', '', '', '0', 'copy-paste', '2009-10-29 08:55:46', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 'norbert', 'norbert@u.washington.edu', 'www.bioeng.washington.edu/home', '1', 'copy-paste', '2009-10-29 08:56:08', '2009-10-29 08:57:51', '0000-00-00 00:00:00'),
(11, 'molliet', 'molliet@u.washington.edu', 'http://www.ocean.washington.edu', '1', 'copy-paste', '2009-10-29 08:56:25', '2009-10-29 09:02:43', '0000-00-00 00:00:00'),
(12, 'sypark', '', '', '0', 'copy-paste', '2009-10-29 08:56:35', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 'brucefm', 'brucefm@uw.edu', 'http:www.washington.edu/admin/hr', '0', '', '2009-10-29 08:56:57', '2009-10-29 08:57:29', '0000-00-00 00:00:00'),
(14, 'jdrew', '', '', '0', 'copy-paste', '2009-10-29 08:57:28', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 'cheiland', 'cheiland@uw.edu', 'example.net', '0', '', '2009-10-29 08:57:28', '2009-10-29 08:57:41', '0000-00-00 00:00:00'),
(16, 'spencer9', '', '', '0', 'copy-paste', '2009-10-29 08:57:49', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 'jyetman', 'research@u.washington.edu', 'http://www.washington.edu/research/', '0', '', '2009-10-29 08:58:14', '2009-10-29 09:02:26', '0000-00-00 00:00:00'),
(18, 'rlglass', 'rlglass@uw.edu', 'https://depts.washington.edu/techtran', '1', 'both', '2009-10-29 08:59:07', '2009-10-29 09:03:51', '0000-00-00 00:00:00'),
(19, 'jimh', 'jimh@u.washington.edu', 'http://open.washington.edu', '0', '', '2009-10-29 08:59:45', '2009-10-29 09:00:25', '0000-00-00 00:00:00'),
(20, 'larsenal', 'larsenal@uw.edu', 'www.washington.edu/research/gca', '1', 'both', '2009-10-29 08:59:53', '2009-10-29 09:03:14', '0000-00-00 00:00:00'),
(21, 'peggyf', 'veteran@u.washington.edu', 'www.washington.edu/students/veteran', '1', 'copy-paste', '2009-10-29 09:01:00', '2009-10-29 09:27:54', '0000-00-00 00:00:00'),
(22, 'sbush', 'sbush@uw.edu', 'http://registrar.washington.edu/', '1', 'both', '2009-10-29 09:03:12', '2009-10-29 09:05:39', '0000-00-00 00:00:00'),
(23, 'lchung', '', '', '0', 'copy-paste', '2009-10-29 09:03:58', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(24, 'marc', '', '', '0', 'copy-paste', '2009-10-29 09:06:54', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(25, 'marc', '', '', '0', 'copy-paste', '2009-10-29 09:07:33', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(26, 'boerm', 'boerm@uw.edu', 'http://nnlm.gov/pnr/uwmhg/', '1', 'copy-paste', '2009-10-29 09:09:14', '2009-10-29 09:12:40', '0000-00-00 00:00:00'),
(27, 'chanhong', 'chanhong@uw.edu', 'http://voyager.uwmcacct.washington.edu', '1', 'copy-paste', '2009-10-29 09:09:27', '2009-10-29 09:11:59', '0000-00-00 00:00:00'),
(28, 'rluk', '?', '?', '1', 'copy-paste', '2009-10-29 09:09:54', '2009-10-29 09:11:23', '0000-00-00 00:00:00'),
(29, 'dgassner', '', '', '0', 'copy-paste', '2009-10-29 09:11:48', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(30, 'jtate', '', '', '0', 'copy-paste', '2009-10-29 09:12:14', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(31, 'hlh6', '', '', '0', 'copy-paste', '2009-10-29 09:14:03', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(32, 'peggyf', 'veteran@u.washington.edu', 'www.washington.edu/students/veteran', '1', 'copy-paste', '2009-10-29 09:23:11', '2009-10-29 09:27:54', '0000-00-00 00:00:00');
