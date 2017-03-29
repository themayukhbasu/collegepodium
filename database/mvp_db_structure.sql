-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 29, 2017 at 07:37 PM
-- Server version: 5.7.13-0ubuntu0.16.04.2
-- PHP Version: 7.0.15-0ubuntu0.16.04.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mvp_db`
--
CREATE DATABASE IF NOT EXISTS `mvp_db` DEFAULT CHARACTER SET ascii COLLATE ascii_bin;
USE `mvp_db`;

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `test`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `test` ()  BEGIN
SELECT * FROM register;
END$$

DROP PROCEDURE IF EXISTS `ulDisplay`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `ulDisplay` ()  NO SQL
SELECT * FROM mvp_db.register$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `data`
--
-- Creation: Aug 05, 2016 at 05:54 AM
-- Last update: Aug 05, 2016 at 05:54 AM
--

DROP TABLE IF EXISTS `data`;
CREATE TABLE `data` (
  `ID` int(30) NOT NULL,
  `userid` int(11) NOT NULL,
  `username` varchar(30) COLLATE ascii_bin NOT NULL,
  `userrealname` varchar(2000) COLLATE ascii_bin NOT NULL,
  `primtag` varchar(200) COLLATE ascii_bin NOT NULL,
  `privacy` varchar(200) COLLATE ascii_bin NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `file` varchar(2000) COLLATE ascii_bin NOT NULL,
  `title` varchar(105) COLLATE ascii_bin NOT NULL,
  `post` varchar(20000) COLLATE ascii_bin NOT NULL,
  `is_op` tinyint(1) NOT NULL,
  `op_id` varchar(200) COLLATE ascii_bin NOT NULL,
  `type` varchar(10) COLLATE ascii_bin NOT NULL,
  `sectag` int(11) NOT NULL,
  `tertag` int(11) NOT NULL,
  `votecount` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=ascii COLLATE=ascii_bin;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--
-- Creation: Aug 05, 2016 at 05:54 AM
--

DROP TABLE IF EXISTS `feedback`;
CREATE TABLE `feedback` (
  `ID` int(11) NOT NULL,
  `state` int(11) NOT NULL DEFAULT '0',
  `userID` int(11) NOT NULL,
  `userName` varchar(300) COLLATE ascii_bin NOT NULL,
  `title` varchar(500) COLLATE ascii_bin NOT NULL,
  `summary` varchar(2500) COLLATE ascii_bin NOT NULL,
  `component` varchar(500) COLLATE ascii_bin NOT NULL,
  `file` varchar(2500) COLLATE ascii_bin NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=ascii COLLATE=ascii_bin;

-- --------------------------------------------------------

--
-- Table structure for table `globaltag`
--
-- Creation: Aug 05, 2016 at 05:54 AM
-- Last update: Aug 05, 2016 at 05:54 AM
--

DROP TABLE IF EXISTS `globaltag`;
CREATE TABLE `globaltag` (
  `ID` int(11) NOT NULL,
  `gtType` varchar(2000) COLLATE ascii_bin NOT NULL,
  `gtName` varchar(20000) COLLATE ascii_bin NOT NULL,
  `gtFilePath` varchar(2000) COLLATE ascii_bin NOT NULL,
  `gtCity` varchar(2000) COLLATE ascii_bin NOT NULL,
  `gtState` varchar(2000) COLLATE ascii_bin NOT NULL,
  `gtCountry` varchar(2000) COLLATE ascii_bin NOT NULL,
  `time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=ascii COLLATE=ascii_bin;

-- --------------------------------------------------------

--
-- Table structure for table `notefile`
--
-- Creation: Aug 05, 2016 at 05:54 AM
-- Last update: Aug 05, 2016 at 05:54 AM
--

DROP TABLE IF EXISTS `notefile`;
CREATE TABLE `notefile` (
  `ID` int(11) NOT NULL,
  `note_id` int(11) NOT NULL,
  `note_file` text COLLATE ascii_bin NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=ascii COLLATE=ascii_bin;

-- --------------------------------------------------------

--
-- Table structure for table `noteintended`
--
-- Creation: Aug 05, 2016 at 05:54 AM
-- Last update: Aug 05, 2016 at 05:54 AM
--

DROP TABLE IF EXISTS `noteintended`;
CREATE TABLE `noteintended` (
  `ID` int(11) NOT NULL,
  `note_id` int(11) NOT NULL,
  `note_tag` int(11) NOT NULL,
  `note_tag_level` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=ascii COLLATE=ascii_bin;

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--
-- Creation: Aug 05, 2016 at 05:54 AM
-- Last update: Aug 05, 2016 at 05:54 AM
--

DROP TABLE IF EXISTS `notes`;
CREATE TABLE `notes` (
  `ID` int(30) NOT NULL,
  `userid` int(11) NOT NULL,
  `username` varchar(30) COLLATE ascii_bin NOT NULL,
  `userrealname` varchar(2000) COLLATE ascii_bin NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `title` varchar(2000) COLLATE ascii_bin NOT NULL,
  `data` mediumtext COLLATE ascii_bin NOT NULL,
  `privacy` int(11) NOT NULL,
  `is_op` tinyint(1) NOT NULL,
  `op_id` varchar(200) COLLATE ascii_bin NOT NULL,
  `type` varchar(10) COLLATE ascii_bin NOT NULL,
  `teacher` varchar(50) COLLATE ascii_bin NOT NULL,
  `subject` int(50) NOT NULL,
  `period` varchar(50) COLLATE ascii_bin DEFAULT NULL,
  `refs` varchar(2000) COLLATE ascii_bin DEFAULT NULL,
  `hash` varchar(20000) COLLATE ascii_bin NOT NULL,
  `file` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=ascii COLLATE=ascii_bin;

-- --------------------------------------------------------

--
-- Table structure for table `quartag`
--
-- Creation: Mar 17, 2016 at 09:34 AM
-- Last update: Mar 17, 2016 at 09:34 AM
--

DROP TABLE IF EXISTS `quartag`;
CREATE TABLE `quartag` (
  `ID` int(11) NOT NULL,
  `qtName` varchar(20000) COLLATE ascii_bin NOT NULL,
  `qtParentID` int(11) NOT NULL,
  `qtParentName` varchar(2000) COLLATE ascii_bin NOT NULL,
  `qtCity` varchar(2000) COLLATE ascii_bin NOT NULL,
  `qtState` varchar(2000) COLLATE ascii_bin NOT NULL,
  `qtCountry` varchar(2000) COLLATE ascii_bin NOT NULL,
  `qtType` varchar(2000) COLLATE ascii_bin NOT NULL,
  `qtFilePath` varchar(2000) COLLATE ascii_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=ascii COLLATE=ascii_bin;

-- --------------------------------------------------------

--
-- Table structure for table `questionbank`
--
-- Creation: Aug 05, 2016 at 05:54 AM
--

DROP TABLE IF EXISTS `questionbank`;
CREATE TABLE `questionbank` (
  `qID` int(11) NOT NULL,
  `stream` varchar(500) COLLATE ascii_bin NOT NULL,
  `subject` varchar(200) COLLATE ascii_bin NOT NULL,
  `chapter` varchar(500) COLLATE ascii_bin NOT NULL,
  `questionType` varchar(40) COLLATE ascii_bin NOT NULL,
  `question` varchar(3000) COLLATE ascii_bin NOT NULL,
  `answer` varchar(3000) COLLATE ascii_bin NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=ascii COLLATE=ascii_bin;

-- --------------------------------------------------------

--
-- Table structure for table `register`
--
-- Creation: Aug 05, 2016 at 05:54 AM
-- Last update: Aug 05, 2016 at 05:54 AM
--

DROP TABLE IF EXISTS `register`;
CREATE TABLE `register` (
  `ID` int(11) NOT NULL,
  `email` varchar(100) COLLATE ascii_bin NOT NULL,
  `password` varchar(200) COLLATE ascii_bin NOT NULL,
  `userlevel` int(11) NOT NULL DEFAULT '0',
  `country` varchar(2000) COLLATE ascii_bin NOT NULL,
  `dob` date NOT NULL,
  `sex` varchar(200) COLLATE ascii_bin NOT NULL,
  `name` varchar(2000) COLLATE ascii_bin NOT NULL,
  `contactno` int(20) NOT NULL,
  `salt` varchar(40) COLLATE ascii_bin NOT NULL,
  `level0tag` varchar(200) COLLATE ascii_bin NOT NULL,
  `level1tag` varchar(200) COLLATE ascii_bin NOT NULL,
  `level2tag` varchar(200) COLLATE ascii_bin NOT NULL,
  `level3tag` varchar(200) COLLATE ascii_bin NOT NULL,
  `time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=ascii COLLATE=ascii_bin;

-- --------------------------------------------------------

--
-- Table structure for table `report`
--
-- Creation: Aug 05, 2016 at 05:54 AM
--

DROP TABLE IF EXISTS `report`;
CREATE TABLE `report` (
  `reportID` int(11) NOT NULL,
  `state` int(11) NOT NULL DEFAULT '0',
  `userID` int(11) NOT NULL,
  `postID` int(11) NOT NULL,
  `postType` varchar(200) COLLATE ascii_bin NOT NULL,
  `comment` varchar(1000) COLLATE ascii_bin NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=ascii COLLATE=ascii_bin;

-- --------------------------------------------------------

--
-- Table structure for table `savenotes`
--
-- Creation: Aug 05, 2016 at 05:54 AM
-- Last update: Aug 05, 2016 at 05:54 AM
--

DROP TABLE IF EXISTS `savenotes`;
CREATE TABLE `savenotes` (
  `ID` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `note_id` int(11) NOT NULL,
  `priority` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=ascii COLLATE=ascii_bin;

-- --------------------------------------------------------

--
-- Table structure for table `sectag`
--
-- Creation: Mar 17, 2016 at 09:34 AM
-- Last update: Mar 17, 2016 at 09:34 AM
--

DROP TABLE IF EXISTS `sectag`;
CREATE TABLE `sectag` (
  `ID` int(11) NOT NULL,
  `stName` varchar(20000) COLLATE ascii_bin NOT NULL,
  `stParentID` int(11) NOT NULL,
  `stParentName` varchar(2000) COLLATE ascii_bin NOT NULL,
  `stCity` varchar(2000) COLLATE ascii_bin NOT NULL,
  `stState` varchar(2000) COLLATE ascii_bin NOT NULL,
  `stCountry` varchar(2000) COLLATE ascii_bin NOT NULL,
  `stType` varchar(2000) COLLATE ascii_bin NOT NULL,
  `stFilePath` varchar(2000) COLLATE ascii_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=ascii COLLATE=ascii_bin;

-- --------------------------------------------------------

--
-- Table structure for table `subjectlist`
--
-- Creation: Mar 17, 2016 at 09:34 AM
-- Last update: Mar 17, 2016 at 09:34 AM
--

DROP TABLE IF EXISTS `subjectlist`;
CREATE TABLE `subjectlist` (
  `ID` int(11) NOT NULL,
  `name` varchar(20000) COLLATE ascii_bin NOT NULL,
  `collegeid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=ascii COLLATE=ascii_bin;

-- --------------------------------------------------------

--
-- Table structure for table `terttag`
--
-- Creation: Mar 17, 2016 at 11:01 AM
-- Last update: Mar 17, 2016 at 11:03 AM
--

DROP TABLE IF EXISTS `terttag`;
CREATE TABLE `terttag` (
  `ID` int(11) NOT NULL,
  `ttName` varchar(20000) COLLATE ascii_bin NOT NULL,
  `ttParentID` int(11) NOT NULL,
  `ttParentName` varchar(2000) COLLATE ascii_bin NOT NULL,
  `ttCity` varchar(2000) COLLATE ascii_bin NOT NULL,
  `ttState` varchar(2000) COLLATE ascii_bin NOT NULL,
  `ttCountry` varchar(2000) COLLATE ascii_bin NOT NULL,
  `ttType` varchar(2000) COLLATE ascii_bin NOT NULL,
  `ttFilePath` varchar(2000) COLLATE ascii_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=ascii COLLATE=ascii_bin;

-- --------------------------------------------------------

--
-- Table structure for table `uniquecode`
--
-- Creation: Aug 05, 2016 at 05:54 AM
--

DROP TABLE IF EXISTS `uniquecode`;
CREATE TABLE `uniquecode` (
  `ID` int(11) NOT NULL,
  `code` varchar(100) COLLATE ascii_bin NOT NULL,
  `userLevel` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=ascii COLLATE=ascii_bin;

-- --------------------------------------------------------

--
-- Table structure for table `usersubject`
--
-- Creation: Aug 05, 2016 at 05:54 AM
-- Last update: Aug 05, 2016 at 05:54 AM
--

DROP TABLE IF EXISTS `usersubject`;
CREATE TABLE `usersubject` (
  `ID` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `subjectid` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=ascii COLLATE=ascii_bin;

-- --------------------------------------------------------

--
-- Table structure for table `votedata`
--
-- Creation: Aug 05, 2016 at 05:54 AM
-- Last update: Aug 05, 2016 at 05:54 AM
--

DROP TABLE IF EXISTS `votedata`;
CREATE TABLE `votedata` (
  `ID` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `vote_val` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=ascii COLLATE=ascii_bin;

-- --------------------------------------------------------

--
-- Table structure for table `votenote`
--
-- Creation: Aug 05, 2016 at 05:54 AM
-- Last update: Aug 05, 2016 at 05:54 AM
--

DROP TABLE IF EXISTS `votenote`;
CREATE TABLE `votenote` (
  `ID` int(11) NOT NULL,
  `note_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `vote_val` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=ascii COLLATE=ascii_bin;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data`
--
ALTER TABLE `data`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `globaltag`
--
ALTER TABLE `globaltag`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `notefile`
--
ALTER TABLE `notefile`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `noteintended`
--
ALTER TABLE `noteintended`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `quartag`
--
ALTER TABLE `quartag`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `questionbank`
--
ALTER TABLE `questionbank`
  ADD PRIMARY KEY (`qID`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`reportID`);

--
-- Indexes for table `savenotes`
--
ALTER TABLE `savenotes`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `sectag`
--
ALTER TABLE `sectag`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `subjectlist`
--
ALTER TABLE `subjectlist`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `terttag`
--
ALTER TABLE `terttag`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `uniquecode`
--
ALTER TABLE `uniquecode`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `usersubject`
--
ALTER TABLE `usersubject`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `votedata`
--
ALTER TABLE `votedata`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `votenote`
--
ALTER TABLE `votenote`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data`
--
ALTER TABLE `data`
  MODIFY `ID` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=353;
--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `globaltag`
--
ALTER TABLE `globaltag`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `notefile`
--
ALTER TABLE `notefile`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;
--
-- AUTO_INCREMENT for table `noteintended`
--
ALTER TABLE `noteintended`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `ID` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=177;
--
-- AUTO_INCREMENT for table `quartag`
--
ALTER TABLE `quartag`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `questionbank`
--
ALTER TABLE `questionbank`
  MODIFY `qID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `reportID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `savenotes`
--
ALTER TABLE `savenotes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `sectag`
--
ALTER TABLE `sectag`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `subjectlist`
--
ALTER TABLE `subjectlist`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `terttag`
--
ALTER TABLE `terttag`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `uniquecode`
--
ALTER TABLE `uniquecode`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `usersubject`
--
ALTER TABLE `usersubject`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `votedata`
--
ALTER TABLE `votedata`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;
--
-- AUTO_INCREMENT for table `votenote`
--
ALTER TABLE `votenote`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
