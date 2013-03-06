-- phpMyAdmin SQL Dump
-- version 3.4.5deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 04, 2012 at 10:34 AM
-- Server version: 5.1.63
-- PHP Version: 5.3.6-13ubuntu3.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `NewCal`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE IF NOT EXISTS `announcements` (
  `announcementid` int(5) NOT NULL AUTO_INCREMENT,
  `announcement` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `start_datetime` int(11) DEFAULT NULL,
  `end_datetime` int(11) DEFAULT NULL,
  `important` tinyint(1) NOT NULL,
  PRIMARY KEY (`announcementid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`announcementid`, `announcement`, `start_datetime`, `end_datetime`, `important`) VALUES
(1, '"Please keep a note of the START and END time of the GIS process such that the next user can start his/her work accordingly"-RAITH 150 TWO', NULL, NULL, 0),
(2, 'Nonauthorized users of optical lithography plz do not book slots for Tuesday & Thurday', NULL, NULL, 1),
(3, 'Maximum slot booking for characterization in a week is 84hrs only', NULL, NULL, 1),
(4, 'For characterization slots are reserved for INUP from Monday to Friday(2pm -5pm).If any CEN user wants book these slots please contact char lab RAs 2hrs in advance.', NULL, NULL, 1),
(5, 'For characterization lab slot booking please go through the pdf containing the rules that has been followed.', NULL, NULL, 0),
(6, 'When any instruments goes down during downtime slot that have been booked get cancelled automatically any one needs rebook their slots again.', NULL, NULL, 1),
(7, 'Users(apart from AU/SO)who need to get their deposition done on 4 target Electron Beam Evaporator,Please consult with AU/SO and tell them to book the slot for you', NULL, NULL, 1),
(8, 'DSA Users Plz Mention authorized user name while slot booking', NULL, NULL, 1),
(10, 'aaaaaaaaaaaaaaa', 1344364200, 1345055400, 0);

-- --------------------------------------------------------

--
-- Table structure for table `cancel_reservation`
--

CREATE TABLE IF NOT EXISTS `cancel_reservation` (
  `resid` int(11) NOT NULL DEFAULT '0',
  `memberid` int(11) NOT NULL,
  `machid` int(11) NOT NULL,
  `startdate` int(11) NOT NULL,
  `enddate` int(11) NOT NULL,
  `starttime` int(11) NOT NULL,
  `endtime` int(11) NOT NULL,
  `invite_users` varchar(5) NOT NULL DEFAULT 'no',
  `summary` text NOT NULL,
  `datetime` int(11) NOT NULL,
  `activation_status` smallint(1) NOT NULL DEFAULT '1',
  `isblackout` int(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `eachdetail`
--

CREATE TABLE IF NOT EXISTS `eachdetail` (
  `slotno` int(10) NOT NULL,
  `startdate` varchar(20) NOT NULL,
  `enddate` varchar(20) NOT NULL,
  `slotyear` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `equipment`
--

CREATE TABLE IF NOT EXISTS `equipment` (
  `srno` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) NOT NULL,
  PRIMARY KEY (`srno`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `equipment`
--

INSERT INTO `equipment` (`srno`, `name`) VALUES
(1, 'Projector'),
(2, 'Mice'),
(3, 'System'),
(4, 'Markar and board'),
(5, 'chock'),
(7, 'Santosh');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE IF NOT EXISTS `event` (
  `srno` int(11) NOT NULL AUTO_INCREMENT,
  `eventname` varchar(200) NOT NULL,
  PRIMARY KEY (`srno`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`srno`, `eventname`) VALUES
(1, 'SEMINARS'),
(2, 'TALK'),
(3, 'COLLOQUIA'),
(4, 'SYMPOSIUM'),
(5, 'CONFERENCE'),
(6, 'VIVA'),
(14, 'FINE'),
(13, 'MEETINGS'),
(25, 'Journal club'),
(11, 'CONFERENCE'),
(15, 'DRAMA'),
(16, 'THEATRE'),
(18, 'MUSIC'),
(19, 'EXHIBITION'),
(20, 'SPORTS'),
(21, 'CLUBS'),
(22, 'SOCIAL'),
(23, 'OTHER');

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE IF NOT EXISTS `faculty` (
  `member_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `empid` varchar(20) NOT NULL,
  `mobno` varchar(20) NOT NULL,
  `email` varchar(80) NOT NULL,
  `nikname` varchar(5) NOT NULL,
  PRIMARY KEY (`member_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`member_id`, `firstname`, `lastname`, `empid`, `mobno`, `email`, `nikname`) VALUES
(3, 'S', 'Arunkumar', 'P10987', '9890984632', 'sak@cse.iitb.ac.in', 'SAK');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `memberid` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(75) COLLATE utf8_unicode_ci NOT NULL,
  `password` char(32) COLLATE utf8_unicode_ci NOT NULL,
  `fname` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `lname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `position` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_admin` smallint(6) DEFAULT '0',
  `rollno` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `course` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `department` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `supervisor` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `cosupervisor` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `project` text COLLATE utf8_unicode_ci,
  `mobile` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `date` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `time` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`memberid`),
  KEY `login_email` (`email`),
  KEY `login_password` (`password`),
  KEY `memberid` (`memberid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=37637 ;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`memberid`, `email`, `password`, `fname`, `lname`, `position`, `is_admin`, `rollno`, `course`, `department`, `supervisor`, `cosupervisor`, `project`, `mobile`, `date`, `time`) VALUES
(1, 'cherishsantosh@gmail.com', 'fcea920f7412b5da7be0cf42b8c93759', 'Shingare', 'Santosh Madhukar', 'aa', 2, 'A4628', 'EE basics', 'EE', '', '', '', '9890984632', '', ''),
(3756, 'nmahesh5@gmail.com', 'fcea920f7412b5da7be0cf42b8c93759', 'Mahesh', 'N', 'ijh', 1, '912839', 'kh', 'bsbe', '', '', '', '8888888888', '09/12/2012', '14:31:54'),
(3755, 'satpute.harish@gmail.com', 'fcea920f7412b5da7be0cf42b8c93759', 'Harish', 'Satpute', 'RA', 1, 'P10987', 'Btech', 'EE', '', '', '', '9619609637', '09/12/2012', '11:12:50');

-- --------------------------------------------------------

--
-- Table structure for table `moreinfo`
--

CREATE TABLE IF NOT EXISTS `moreinfo` (
  `email` varchar(50) NOT NULL,
  `info` varchar(800) NOT NULL,
  `flag` int(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `moreinfo`
--

INSERT INTO `moreinfo` (`email`, `info`, `flag`) VALUES
('36', 'ABCD', 1);

-- --------------------------------------------------------

--
-- Table structure for table `moreinfoevent`
--

CREATE TABLE IF NOT EXISTS `moreinfoevent` (
  `resid` varchar(50) NOT NULL,
  `info` varchar(800) NOT NULL,
  `flag` int(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE IF NOT EXISTS `position` (
  `srno` int(11) NOT NULL AUTO_INCREMENT,
  `position` varchar(50) NOT NULL,
  PRIMARY KEY (`srno`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`srno`, `position`) VALUES
(1, 'Professor'),
(2, 'Associate Professor'),
(3, 'Assistant Professor'),
(4, 'Adjunct Professor'),
(5, 'Visiting Professor'),
(6, 'Staff'),
(7, 'PostDoc'),
(8, 'Research Associate'),
(9, 'Project Engineer'),
(10, 'PhD'),
(11, 'M. Tech'),
(12, 'B.Tech'),
(13, 'M.Sc');

-- --------------------------------------------------------

--
-- Table structure for table `rejectlogin`
--

CREATE TABLE IF NOT EXISTS `rejectlogin` (
  `memberid` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(75) COLLATE utf8_unicode_ci NOT NULL,
  `password` char(32) COLLATE utf8_unicode_ci NOT NULL,
  `fname` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `lname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `position` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_admin` smallint(6) DEFAULT '0',
  `rollno` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `course` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `department` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `supervisor` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `cosupervisor` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `project` text COLLATE utf8_unicode_ci,
  `mobile` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `date` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `time` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `remark` varchar(800) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`memberid`),
  KEY `login_email` (`email`),
  KEY `login_password` (`password`),
  KEY `memberid` (`memberid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `rejectlogin`
--

INSERT INTO `rejectlogin` (`memberid`, `email`, `password`, `fname`, `lname`, `position`, `is_admin`, `rollno`, `course`, `department`, `supervisor`, `cosupervisor`, `project`, `mobile`, `date`, `time`, `remark`) VALUES
(7, 'aa@gmail.com', '4124bc0a9335c27f086f24ba207a4912', 'aa', 'aa', 'a', 1, 'aa', 'aa', 'a', 'a', 'a', 'a', '9890985643', '09/29/2012', '10:16:45', '  aaaaaaaaa');

-- --------------------------------------------------------

--
-- Table structure for table `rejectreservations`
--

CREATE TABLE IF NOT EXISTS `rejectreservations` (
  `resid` int(11) NOT NULL AUTO_INCREMENT,
  `memberid` int(11) NOT NULL,
  `machid` int(11) NOT NULL,
  `startdate` int(11) NOT NULL,
  `enddate` int(11) NOT NULL,
  `starttime` varchar(11) NOT NULL,
  `endtime` varchar(11) NOT NULL,
  `speakername` varchar(50) NOT NULL,
  `type` varchar(30) NOT NULL,
  `title` varchar(500) NOT NULL,
  `capacity` int(10) NOT NULL,
  `priority` int(5) NOT NULL,
  `invite_users` varchar(5) NOT NULL DEFAULT 'no',
  `summary` text NOT NULL,
  `datetime` int(11) DEFAULT NULL,
  `activation_status` smallint(1) NOT NULL DEFAULT '1',
  `isblackout` int(1) NOT NULL DEFAULT '1',
  `remark` varchar(800) NOT NULL DEFAULT 'no',
  KEY `resid` (`resid`,`memberid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE IF NOT EXISTS `reservations` (
  `resid` int(11) NOT NULL AUTO_INCREMENT,
  `memberid` int(11) NOT NULL,
  `machid` int(11) NOT NULL,
  `startdate` int(11) NOT NULL,
  `enddate` int(11) NOT NULL,
  `starttime` varchar(11) NOT NULL,
  `endtime` varchar(11) NOT NULL,
  `speakername` varchar(50) NOT NULL,
  `type` varchar(30) NOT NULL,
  `title` varchar(500) NOT NULL,
  `capacity` int(10) NOT NULL,
  `priority` int(5) NOT NULL,
  `invite_users` varchar(5) NOT NULL DEFAULT 'no',
  `summary` text NOT NULL,
  `datetime` int(11) DEFAULT NULL,
  `activation_status` smallint(1) NOT NULL DEFAULT '1',
  `isblackout` int(1) NOT NULL DEFAULT '1',
  KEY `resid` (`resid`,`memberid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6067 ;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`resid`, `memberid`, `machid`, `startdate`, `enddate`, `starttime`, `endtime`, `speakername`, `type`, `title`, `capacity`, `priority`, `invite_users`, `summary`, `datetime`, `activation_status`, `isblackout`) VALUES
(6064, 1, 1, 1349289000, 1349289000, '15:00', '16:00', '1111111', 'OTHER', '11111111111', 30, 5, '', '111111111111111', 0, 1, 1),
(6065, 1, 1, 1349375400, 1349375400, '09:30', '10:00', '22222222222', 'SYMPOSIUM', '222222222222', 30, 5, '', '22222222222222', 0, 1, 1),
(6066, 1, 1, 1349375400, 1349375400, '17:30', '18:30', '333333333', 'OTHER', '333333333333', 30, 5, '', '33333333333333333333333333', 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `resources`
--

CREATE TABLE IF NOT EXISTS `resources` (
  `machid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(75) COLLATE utf8_unicode_ci NOT NULL,
  `make` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `model` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `serial_number` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `local_agent_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `local_agent_contact` text COLLATE utf8_unicode_ci,
  `actual_vendor_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `actual_vendor_contact` text COLLATE utf8_unicode_ci,
  `installation_date` int(11) DEFAULT NULL,
  `footprint` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tool_sop` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `policy_documents` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `standard_recipies` text COLLATE utf8_unicode_ci,
  `tool_facilites_requirements` text COLLATE utf8_unicode_ci,
  `isworking` int(11) NOT NULL DEFAULT '0',
  `schedule_config` int(11) NOT NULL DEFAULT '30',
  `activationtime_config` int(11) NOT NULL DEFAULT '30',
  `cost_of_usage` int(11) DEFAULT NULL,
  `location` varchar(800) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rphone` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `relay_ipaddress` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `relay_switch_number` smallint(6) DEFAULT NULL,
  `activation_status` smallint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`machid`),
  KEY `rs_name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=70 ;

--
-- Dumping data for table `resources`
--

INSERT INTO `resources` (`machid`, `name`, `make`, `model`, `serial_number`, `local_agent_name`, `local_agent_contact`, `actual_vendor_name`, `actual_vendor_contact`, `installation_date`, `footprint`, `tool_sop`, `policy_documents`, `standard_recipies`, `tool_facilites_requirements`, `isworking`, `schedule_config`, `activationtime_config`, `cost_of_usage`, `location`, `rphone`, `relay_ipaddress`, `relay_switch_number`, `activation_status`) VALUES
(1, 'GG3031', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 30, 60, NULL, 'Projector,Mice,System,Markar and board,chock,Santosh', '4411', '10.107.111.111', 1, 1),
(2, 'LCT31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 30, 50, NULL, 'Projector,Markar and board', '4411', '', 0, 1),
(3, 'Venue - 3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 30, 40, NULL, 'Markar and board', '4405', '', 0, 1),
(4, 'Venue - 4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 30, 30, NULL, 'Mice,Markar and board', '4464', '', 0, 1),
(5, 'Venue - 5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 30, 100, NULL, 'Projector', '4405', '', 0, 1),
(69, 'CC120', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 30, 45, NULL, 'Mice,System', NULL, NULL, NULL, 1),
(68, 'LCH36', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 30, 350, NULL, 'Projector,System', NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `slotdefine`
--

CREATE TABLE IF NOT EXISTS `slotdefine` (
  `day` varchar(20) NOT NULL,
  `slothour` varchar(20) NOT NULL,
  `starttime` varchar(20) NOT NULL,
  `endtime` varchar(20) NOT NULL,
  `slotno` int(10) NOT NULL,
  `slotyear` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `SubjectCodeName`
--

CREATE TABLE IF NOT EXISTS `SubjectCodeName` (
  `srno` int(10) NOT NULL AUTO_INCREMENT,
  `subcode` varchar(50) NOT NULL,
  `subname` varchar(200) NOT NULL,
  PRIMARY KEY (`srno`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `SubjectCodeName`
--

INSERT INTO `SubjectCodeName` (`srno`, `subcode`, `subname`) VALUES
(1, 'BM601', 'Biomathematics'),
(2, 'BM603', 'Physiology for Engineers'),
(3, 'BM627', 'Virtual Instrumentation in Biomedical Engg'),
(4, 'BM651', 'Cell Physiology and Biopotentials'),
(5, 'BM653', 'Medical Imaging Physics'),
(6, 'BM655', 'Biomaterials'),
(7, 'BM659', 'Elements of Circuits'),
(8, 'BM661', 'Signals and Systems in BME'),
(9, 'BM665', 'Medical Sensors'),
(11, 'BM100', 'Bio Advance Engi');

-- --------------------------------------------------------

--
-- Table structure for table `subscriber`
--

CREATE TABLE IF NOT EXISTS `subscriber` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(400) NOT NULL,
  `u_type` varchar(10) NOT NULL,
  `r_id` varchar(50) NOT NULL,
  `email_id` varchar(200) NOT NULL,
  `m_number` int(10) NOT NULL,
  `events` varchar(2000) NOT NULL DEFAULT ',',
  `auth` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

-- --------------------------------------------------------

--
-- Table structure for table `templogin`
--

CREATE TABLE IF NOT EXISTS `templogin` (
  `memberid` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(75) COLLATE utf8_unicode_ci NOT NULL,
  `password` char(32) COLLATE utf8_unicode_ci NOT NULL,
  `fname` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `lname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `position` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_admin` smallint(6) DEFAULT '0',
  `rollno` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `course` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `department` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `supervisor` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `cosupervisor` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `project` text COLLATE utf8_unicode_ci,
  `mobile` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `date` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `time` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`memberid`),
  KEY `login_email` (`email`),
  KEY `login_password` (`password`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=39 ;

--
-- Dumping data for table `templogin`
--

INSERT INTO `templogin` (`memberid`, `email`, `password`, `fname`, `lname`, `position`, `is_admin`, `rollno`, `course`, `department`, `supervisor`, `cosupervisor`, `project`, `mobile`, `date`, `time`) VALUES
(38, 'aa@gmail.com', '4124bc0a9335c27f086f24ba207a4912', 'aa', 'aa', 'Professor', 1, 'aa', 'NULL', 'aa', 'aa', 'aa', 'aa', '', '10/02/2012', '19:11:53');

-- --------------------------------------------------------

--
-- Table structure for table `tempreservations`
--

CREATE TABLE IF NOT EXISTS `tempreservations` (
  `resid` int(11) NOT NULL AUTO_INCREMENT,
  `memberid` int(11) NOT NULL,
  `machid` int(11) NOT NULL,
  `startdate` int(11) NOT NULL,
  `enddate` int(11) NOT NULL,
  `starttime` varchar(11) NOT NULL,
  `endtime` varchar(11) NOT NULL,
  `speakername` varchar(50) NOT NULL,
  `type` varchar(30) NOT NULL,
  `title` varchar(500) NOT NULL,
  `capacity` int(10) NOT NULL,
  `priority` int(5) NOT NULL,
  `invite_users` varchar(5) NOT NULL DEFAULT 'no',
  `summary` text NOT NULL,
  `datetime` int(11) DEFAULT NULL,
  `activation_status` smallint(1) NOT NULL DEFAULT '1',
  `isblackout` int(1) NOT NULL DEFAULT '1',
  KEY `resid` (`resid`,`memberid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
