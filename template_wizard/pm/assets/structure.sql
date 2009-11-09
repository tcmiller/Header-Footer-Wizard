-- phpMyAdmin SQL Dump
-- version 3.1.1
-- http://www.phpmyadmin.net
--
-- Host: ovid.u.washington.edu:94582
-- Generation Time: Nov 05, 2009 at 09:51 AM
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=123 ;

-- --------------------------------------------------------

--
-- Table structure for table `footer`
--

CREATE TABLE IF NOT EXISTS `footer` (
  `id` int(11) NOT NULL auto_increment,
  `owner` varchar(50) NOT NULL,
  `selected` binary(1) NOT NULL default '1',
  `blockw` binary(1) NOT NULL default '0',
  `wordmark` binary(1) NOT NULL default '1',
  `patch` enum('purple','gold','0') NOT NULL default 'purple',
  `static` binary(1) NOT NULL default '0',
  `created_date` datetime default NULL,
  `last_modified` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=123 ;

-- --------------------------------------------------------

--
-- Table structure for table `header`
--

CREATE TABLE IF NOT EXISTS `header` (
  `id` int(11) NOT NULL auto_increment,
  `owner` varchar(50) NOT NULL,
  `selection` enum('strip','no-hdr','static','sink') NOT NULL default 'strip',
  `blockw` binary(1) NOT NULL default '1',
  `patch` binary(1) NOT NULL default '1',
  `wordmark` binary(1) NOT NULL default '1',
  `color` enum('purple','gold') NOT NULL default 'purple',
  `search` enum('basic','no','super-inline','super-tab') NOT NULL default 'basic',
  `created_date` datetime default NULL,
  `last_modified` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=123 ;
