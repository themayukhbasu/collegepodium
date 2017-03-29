-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 29, 2017 at 07:36 PM
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

--
-- Dumping data for table `data`
--

INSERT INTO `data` (`ID`, `userid`, `username`, `userrealname`, `primtag`, `privacy`, `time`, `file`, `title`, `post`, `is_op`, `op_id`, `type`, `sectag`, `tertag`, `votecount`) VALUES
(315, 1, 'basugames@gmail.com', 'Mayukh Basu', '1', 'public', '2015-12-20 10:29:11', 'uploads/depositphotos_25850121-top-secret-stamp.jpg', 'Moderators Needed', 'Anyone interested to be a moderator for the College Podium Site, please contact me.\r\nWork includes checking/banning posts or comments. Banning members for trash talk in chat rooms etc.', 1, '0', 'notice', 1, 1, 1),
(316, 1, 'basugames@gmail.com', 'Mayukh Basu', '1', 'public', '2015-12-20 15:33:19', 'NONE', 'Moderators Needed', 'hi', 0, '315', 'notice', 1, 1, 0),
(332, 1, 'basugames@gmail.com', 'Mayukh Basu', '1', 'public', '2016-03-04 19:18:45', 'NONE', 'usnal;zdonv rseka b.', 'v klrsd.xgbsaOfvoik', 1, '0', 'notice', 1, 1, 0),
(318, 1, 'basugames@gmail.com', 'Mayukh Basu', '1', 'public', '2016-01-12 06:49:46', 'NONE', 'What is the speed of light?', 'Please tell me the speed of light', 1, '0', 'query', 1, 1, 0),
(319, 1, 'basugames@gmail.com', 'Mayukh Basu', '1', 'public', '2016-01-13 22:33:20', 'uploads/Capture.PNG', 'test', 'asrbvgdrfbnd', 1, '0', 'query', 1, 1, 0),
(320, 1, 'basugames@gmail.com', 'Mayukh Basu', '1', 'public', '2016-01-13 22:33:20', 'uploads/Capture.PNG', 'test', 'asrbvgdrfbnd', 1, '0', 'query', 1, 1, 0),
(321, 1, 'basugames@gmail.com', 'Mayukh Basu', '1', 'public', '2016-01-13 22:34:15', 'uploads/Capture.PNG', 'dgbxgfn', 'fgn fn', 1, '0', 'notice', 1, 1, 0),
(322, 1, 'basugames@gmail.com', 'Mayukh Basu', '1', 'public', '2016-01-13 22:35:46', 'uploads/Capture.PNG', 'dbfdnfgmn', 'dfnfghm,', 1, '0', 'discuss', 1, 1, 0),
(323, 1, 'basugames@gmail.com', 'Mayukh Basu', '1', 'public', '2016-01-14 06:59:09', 'uploads/b79d6c44dbaa301c95d1be818b94f6831e87912c6eac7f557ea3f447145974bd7dbfd469b7be443eCapture.PNG', 'testing', 'testing', 1, '0', 'notice', 1, 1, 0),
(324, 1, 'basugames@gmail.com', 'Mayukh Basu', '1', 'public', '2016-01-14 07:05:28', 'uploads/6dd633612a1b950321ef7cb5121f632f3d8672deebce27b6842d166d708e2fe85397bc0f3e1c59e7Capture.PNG', 'sgbdhnghfn', 'dyhnfghmjfjhm', 1, '0', 'query', 1, 1, 0),
(325, 1, 'basugames@gmail.com', 'Mayukh Basu', '1', 'public', '2016-01-14 10:04:36', 'uploads/Capture.PNG', 'test', 'fghnhnghmn', 1, '0', 'notice', 1, 1, 0),
(326, 1, 'basugames@gmail.com', 'Mayukh Basu', '1', 'public', '2016-01-14 10:05:10', 'uploads/Capture.PNG', 'cvgnjcghjgh', 'fygkjguyhgkuihh', 1, '0', 'notice', 1, 1, 2),
(327, 1, 'basugames@gmail.com', 'Mayukh Basu', '1', 'public', '2016-01-14 10:07:45', 'uploads/07aef4487a4b12532accc2d71cefd7920351b47b269803991283eddbc7435eab00f7195053f4cd77Capture.PNG', 'vhmvgh,mvhj', 'yfghmju', 1, '0', 'discuss', 1, 1, 0),
(328, 1, 'basugames@gmail.com', 'Mayukh Basu', '1', 'public', '2016-01-14 17:38:41', 'uploads/3d59338b45f7a04b9187299690f2482a89e50f0543eef27b4a35f0cd3f6a66395009122fb1dad91010608216_1119198701424582_7294630162185100936_o.jpg', 'Say Hello', 'Whatsup???', 1, '0', 'notice', 1, 1, 2),
(329, 1, 'basugames@gmail.com', 'Mayukh Basu', '1', 'public', '2016-01-14 17:39:28', 'NONE', '&lt;script&gt;alert(&quot;Hello&quot;);&lt;/script&gt;', 'hey', 1, '0', 'notice', 1, 1, 2),
(330, 1, 'basugames@gmail.com', 'Mayukh Basu', '1', 'public', '2016-01-17 14:36:04', 'uploads/f2b6917a2c69ce42215a9b2dc8259141b7bc08814cb2a20ceb29f2e6889b490101f38aa05b45aacdroutine.jpg', 'what is the best book for java', 'same as above', 1, '0', 'query', 1, 1, 1),
(331, 1, 'basugames@gmail.com', 'Mayukh Basu', '1', 'public', '2016-01-17 14:39:37', 'NONE', 'what is the best book for java', 'Herbert Schildt is the best book', 0, '330', 'query', 1, 1, -1),
(333, 1, 'basugames@gmail.com', 'Mayukh Basu', '1', 'public', '2016-03-05 05:38:51', 'NONE', 'dfbdklhbjkbnljn', 'ubhfgkljbdnslkjndgklb', 1, '0', 'notice', 1, 1, 0),
(334, 1, 'basugames@gmail.com', 'Mayukh Basu', '1', 'public', '2016-03-05 05:40:18', 'NONE', 'test', 'test', 1, '0', 'notice', 1, 1, 0),
(335, 1, 'basugames@gmail.com', 'Mayukh Basu', '1', 'public', '2016-03-05 05:42:04', 'NONE', 'hey people', 'sfvbgdsb', 1, '0', 'discuss', 1, 1, 0),
(336, 1, 'basugames@gmail.com', 'Mayukh Basu', '1', 'public', '2016-03-05 05:43:46', 'NONE', 'All posts without file works', 'All posts without file worksAll posts without file worksAll posts without file worksAll posts without file worksAll posts without file worksAll posts without file worksAll posts without file worksAll posts without file works', 1, '0', 'discuss', 1, 1, 1),
(337, 1, 'basugames@gmail.com', 'Mayukh Basu', '1', 'public', '2016-03-05 06:15:51', 'NONE', 'Hello', 'When are results coming out?', 1, '0', 'discuss', 1, 1, 0),
(338, 1, 'basugames@gmail.com', 'Mayukh Basu', '1', 'public', '2016-03-06 16:37:07', 'NONE', 'dtfhg', 'gbhn', 1, '0', 'notice', 1, 1, 0),
(339, 1, 'basugames@gmail.com', 'Mayukh Basu', '1', 'public', '2016-03-07 16:01:25', 'NONE', 'Hello', 'World', 1, '0', 'query', 1, 1, 0),
(340, 1, 'basugames@gmail.com', 'Mayukh Basu', '1', 'public', '2016-03-07 20:45:40', 'uploads/608318f90ff4d3d6d99acb75314f1e4f1b2435ecce2f52f628b2c87c425b531bb85353ad47c68b891.png', 'dsghf', 'dsgh', 1, '0', 'query', 1, 1, 0),
(341, 1, 'basugames@gmail.com', 'Mayukh Basu', '1', 'public', '2016-03-07 20:46:20', 'uploads/01c727ea18cdb7488a156ac814b77a8d5c5fd468b6ea5500fbf480bf1ab7e2baebb413d0bc23feafArka_Mukherjee _SRM University_541462.pdf', 'HELLO', 'CP', 1, '0', 'discuss', 1, 1, 0),
(342, 1, 'basugames@gmail.com', 'Mayukh Basu', '1', 'public', '2016-03-07 20:46:54', 'uploads/f950af467983c5404b3a210761640669a28dbfb18a477964cb4d3b33dd1dac051cfb8909cf55dc2912672038_990098531071738_3238951290442778741_o.png', 'fgh', 'dfghndyfn', 1, '0', 'notice', 1, 1, 0),
(343, 1, 'basugames@gmail.com', 'Mayukh Basu', '1', 'public', '2016-03-07 21:25:16', 'NONE', 'fgh', 'Hello', 0, '342', 'notice', 1, 1, 0),
(344, 1, 'basugames@gmail.com', 'Mayukh Basu', '1', 'public', '2016-03-07 21:25:28', 'NONE', 'fgh', 'Comments working fine', 0, '342', 'notice', 1, 1, 0),
(345, 4, 'demo@demo.com', 'demo', '1', 'public', '2016-03-08 11:52:01', 'uploads/086e00a2595b4295994bf38ec83f632d2b9ea80a6112a50f5dc922cc74277e4f9864962bfcb8a8751.png', 'sfvf', 'dfvb', 1, '0', 'discuss', 1, 1, 0),
(346, 4, 'demo@demo.com', 'demo', '1', 'public', '2016-03-08 11:53:03', 'NONE', 'Congratulations', 'Congratulations on the website :)', 1, '0', 'notice', 1, 1, 2),
(347, 1, 'basugames@gmail.com', 'Mayukh Basu', '1', 'public', '2016-03-08 11:54:48', 'NONE', 'Congratulations', 'sdfvg', 0, '346', 'notice', 1, 1, 0),
(348, 1, 'basugames@gmail.com', 'Mayukh Basu', '1', 'public', '2016-03-08 12:37:10', 'uploads/f7cbfcf863b23db5da7da1baa7332cfb12b893c062cdafb702f011b50bfbb1cce9827e27c1e8c43bSurvey.docx', 'cxgbn', 'dgb', 1, '0', 'notice', 1, 1, -1),
(349, 1, 'basugames@gmail.com', 'Mayukh Basu', '1', 'public', '2016-03-08 12:37:59', 'uploads/1df91e1619800622d9ca972e6cbc81c423db63d54f81dc20e43055450d8327bb7e9dc73121de646cIT_Final_Upto_4th_Year Syllabus_14.03.14.pdf', 'dfgh', 'dfgh', 1, '0', 'query', 1, 1, 0),
(350, 1, 'basugames@gmail.com', 'Mayukh Basu', '1', 'public', '2016-03-12 17:17:25', 'NONE', 'Congratulations', 'Comment.', 0, '346', 'notice', 1, 1, 0),
(351, 1, 'basugames@gmail.com', 'Mayukh Basu', '1', 'public', '2016-03-16 09:41:34', 'uploads/44788f889e8e3cf0bd56678039e8d221269518d41bcac683f641ab4a78798b849669251c43791358Sunset.jpg', 'Hello Whats up', 'sdvfjkbklbxfsv', 1, '0', 'notice', 1, 1, 0),
(352, 1, 'basugames@gmail.com', 'Mayukh Basu', '1', 'public', '2016-03-16 10:17:41', 'NONE', 'Tomorrow no class', 'hey haloo', 1, '0', 'notice', 1, 1, 0);

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

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`ID`, `state`, `userID`, `userName`, `title`, `summary`, `component`, `file`, `time`) VALUES
(1, 0, 5, 'Mayukh Basu', 'test', 'Test', 'others', 'NONE', '2016-01-13 20:00:00'),
(2, 1, 5, 'Mayukh Basu', 'kbhscvlkhbdlvf', 'arsbgrtshdynthn', 'notes-display', 'NONE', '2016-01-14 13:11:14'),
(3, 0, 1, 'Mayukh Basu', 'Can I send feedback?', 'Yes', 'notes-display', 'NONE', '2016-02-15 10:14:08'),
(4, 0, 1, 'Mayukh Basu', 'fvgsd', 'dfgdgv', 'notes-display', 'NONE', '2016-03-06 16:40:35');

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

--
-- Dumping data for table `globaltag`
--

INSERT INTO `globaltag` (`ID`, `gtType`, `gtName`, `gtFilePath`, `gtCity`, `gtState`, `gtCountry`, `time`) VALUES
(1, 'University', 'West Bengal University of Technology', 'pri54e9e9c25ede48.60462997.json', 'Kolkata', 'Kolkata', 'India', '2015-02-22 14:37:54');

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

--
-- Dumping data for table `notefile`
--

INSERT INTO `notefile` (`ID`, `note_id`, `note_file`, `time`) VALUES
(76, 164, 'uploads/Zonal_Head_details.pdf', '2016-01-07 18:53:12'),
(77, 164, 'uploads/atm.pdf', '2016-01-07 18:53:12'),
(78, 164, 'uploads/10608216_1119198701424582_7294630162185100936_o.jpg', '2016-01-07 18:53:12'),
(79, 165, 'uploads/a1.jpg', '2016-01-07 18:59:43'),
(80, 169, 'uploads/d76666e2d88fc4dfe975b2029edff0290b39d65e9e8fd1c18f001b787dadaccb9c17d8c375f68fdbCapture2.PNG', '2016-01-14 07:10:09'),
(81, 169, 'uploads/65d7b70364efd93117d1a979b66cc78f477383385f008072bab9b29efdff3fe2e7743b355cf0c9fa20150902063048.jpg', '2016-01-14 07:10:09'),
(82, 169, 'uploads/6fe4bf572892e5ebe41b770244a568deb051f112cd1a8a6f89e6ea4fca840ec1fec7058606435d6d20150902063043.jpg', '2016-01-14 07:10:09'),
(83, 169, 'uploads/9a3ccccae4e5da077b7229fcfa82587a142b769324aa4f6bf7274fcaf8b003827c553fbc438cf0612.jpg', '2016-01-14 07:10:09'),
(84, 169, 'uploads/fa78c03d4e5fb5606aa9e0fb88909c726f9b53ceb69aca58523446e074f3e6bdb2b3f9ecf3a3510820150902063031.jpg', '2016-01-14 07:10:09'),
(85, 170, 'uploads/71c2839612bb06950812d57bcb76233a0ba7b8dd753889e49a0de341c50c23ab4dc6b8ab7bf4223fZonal_Head_details.pdf', '2016-01-14 17:41:00'),
(86, 170, 'uploads/4060346f012229dd8afd4556b5caddc648e20048372ff0c626fec75db415d8196f65625addc1a284fb-schema.jpg', '2016-01-14 17:41:00'),
(87, 171, 'uploads/d7836f8962f943092b45581b5250292200b14969e7853a1730672b0c6f1fde84399fafdaced26419bts.jpg', '2016-03-07 21:03:43'),
(88, 172, 'uploads/75a1cc3d2d993e2a3ce56815ea3d746a031da1a02bf115a3fac7a92f39b844a1ace734dbd84ffec9dataass.PNG', '2016-03-07 21:04:41'),
(89, 172, 'uploads/4bbd85a914a559c2c4d3d292f07efa5547ac4ac0058fd9bf79755e284d3dec0314a968908a1c3beedn.jpg', '2016-03-07 21:04:42'),
(90, 172, 'uploads/c95d54494f5d9565039c740eaea51ec12fb2665542f4e286c029cc2d2bb0d249c5b686c38308c455donald.jpg', '2016-03-07 21:04:42'),
(91, 173, 'uploads/020486f602820277ee5282582bdca1d16895d14073196ea2b2caf4cb62ece2acbcd4a10280b7dbe53319081.jpg', '2016-03-07 21:24:43'),
(92, 173, 'uploads/156aaa6d6ce5ce16d252b00e3eb588b4c5e7c5eaf9fc90ed1de760c413f75144664564b05ed7ee46bbgivcsgo.jpg', '2016-03-07 21:24:43'),
(93, 173, 'uploads/4d50a84ce3dbb60c6e6410ab524eba336c4529c78274f0d5b6f7a62c4c8c26217f61b95751e69eeabf2016.jpg', '2016-03-07 21:24:43'),
(94, 173, 'uploads/f436bbe9af03e7e021887ec03ceaa97382e5bc2e173c4fc785a02882413a6202306005b306efa542crisiscore.jpg', '2016-03-07 21:24:43'),
(95, 175, 'uploads/bd3d5f63b9ee71a109e402e5ca300285c0864c48b8938a8bf15b4e131d199ddbfa0bf72595e9134812767435_1150134931693860_293710394_n.jpg', '2016-03-08 11:56:27'),
(96, 176, 'uploads/6c0c55520f0d47198eb969d60b29c0fe2fdc8e2c51c5fe39c0a76c73d48a06cd13bbe69e6376256dHiragana Katakana Worksheet.pdf', '2016-03-12 17:14:36');

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

--
-- Dumping data for table `noteintended`
--

INSERT INTO `noteintended` (`ID`, `note_id`, `note_tag`, `note_tag_level`, `time`) VALUES
(49, 163, 1, 2, '2016-01-07 18:52:14'),
(50, 164, 1, 2, '2016-01-07 18:53:12'),
(51, 165, 1, 2, '2016-01-07 18:59:43'),
(52, 166, 1, 2, '2016-01-08 05:21:16'),
(53, 167, 1, 2, '2016-01-12 06:53:39'),
(54, 168, 1, 2, '2016-01-14 07:09:45'),
(55, 169, 1, 2, '2016-01-14 07:10:09'),
(56, 170, 1, 2, '2016-01-14 17:41:00'),
(57, 171, 1, 2, '2016-03-07 21:03:43'),
(58, 172, 1, 2, '2016-03-07 21:04:41'),
(59, 173, 1, 2, '2016-03-07 21:24:43'),
(60, 174, 1, 2, '2016-03-08 11:56:13'),
(61, 175, 1, 2, '2016-03-08 11:56:27'),
(62, 176, 1, 2, '2016-03-12 17:14:36');

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

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`ID`, `userid`, `username`, `userrealname`, `time`, `title`, `data`, `privacy`, `is_op`, `op_id`, `type`, `teacher`, `subject`, `period`, `refs`, `hash`, `file`) VALUES
(163, 5, 'basugames@gmail.com', 'Mayukh Basu', '2016-01-07 18:52:14', 'xyz', 'xyz', 0, 1, '0', '', 'dgfdnf', 4, '', NULL, '5ea932e7ae124c2dbf83f94316909146558ab7ba07e1af2f1b07a569fe1627261f1511b3ab3b66a3', 0),
(164, 5, 'basugames@gmail.com', 'Mayukh Basu', '2016-01-07 18:53:12', 'Test 123', 'Lets have some fun', 0, 1, '0', '', '', 4, '', NULL, '5aca234dc32c6a30d0ea5087edbd583196965ed24760854bc2a1c688b987863dd28da9b063e71fcb', 1),
(165, 5, 'basugames@gmail.com', 'Mayukh Basu', '2016-01-07 18:59:43', 'Isn\'t this much simpler?', 'So simple .... its awesome', 0, 1, '0', '', 'Pagla', 5, 'Dance', NULL, '00b7e7f73cfd16349c16bc78c13c8979ebf5651eafe4ab48370aee9a83800fe614e57561186675bb', 1),
(166, 5, 'basugames@gmail.com', 'Mayukh Basu', '2016-01-08 05:21:16', 'Heya folks', 'test test', 0, 1, '0', '', 'Khepa', 6, '1', NULL, '220dece1277953621921c94bfb907c7481283b09f0ec70b1937cc02aedb58572c4c1fdfdb37bd0d1', 0),
(167, 5, 'basugames@gmail.com', 'Mayukh Basu', '2016-01-12 06:53:39', 'test', 'test', 0, 1, '0', '', '', 5, '', NULL, '83b3896dcb4d6e4cf766c8e99bbaf296d74fa32d2e391dbfeb6039cda26731771c22942d80e98732', 0),
(168, 5, 'basugames@gmail.com', 'Mayukh Basu', '2016-01-14 07:09:45', 'test', 'etdbhyn,mhjui,.hibo.k', 0, 1, '0', '', '', 4, '', NULL, 'a0c7d5b6bec3d889e03a87f26b2a2a06b2d8b51464bdf1608f809bc4450feece2e39cb407abeabaf', 0),
(169, 5, 'basugames@gmail.com', 'Mayukh Basu', '2016-01-14 07:10:09', 'Test with file', 'With file', 0, 1, '0', '', '', 4, '', NULL, '49fcd6c321a024c20cbdef3d1502b0446bc0ab13b4edd79f8e34ce828e9ae39842a49c00da607dfc', 1),
(170, 5, 'basugames@gmail.com', 'Mayukh Basu', '2016-01-14 17:41:00', 'New Note', 'kyswbrvbvsbvu', 0, 1, '0', '', 'sfavdsb', 5, 'sdfbgb', NULL, 'b953a15f333605fc1d23840fa0e135f269255da6011d0d5958c19a0c5b90b87465c7675a18181d18', 1),
(171, 1, 'basugames@gmail.com', 'Mayukh Basu', '2016-03-07 21:03:43', 'Notes', 'Notes for EC', 0, 1, '0', '', 'Teacher', 4, '33', NULL, 'dd434804de22f019c462f724894421496717538fbda87838e39a27e4b94f59d2d7525eb57b87450f', 1),
(172, 1, 'basugames@gmail.com', 'Mayukh Basu', '2016-03-07 21:04:41', 'Gaming', 'Notes for notes Notes for notes Notes for notes', 0, 1, '0', '', 'Light', 6, '3', NULL, '60c7f400e0b5433308def7adbdc9a252910c55e349a1f0df4d87bc5236656bffa8490a98682a9c63', 1),
(173, 1, 'basugames@gmail.com', 'Mayukh Basu', '2016-03-07 21:24:43', 'Notes for Final Fantasy', 'Sensei', 0, 1, '0', '', 'Lord', 6, 'FightCLub', NULL, '37f63606d88f8f9933f459064064129f52fcf98d90462fe1fabef12757da3f087fea7f9a12b295d7', 1),
(174, 1, 'basugames@gmail.com', 'Mayukh Basu', '2016-03-08 11:56:13', 'gbhn', 'dfgn', 0, 1, '0', '', 'dsgb', 4, '', NULL, '216f12fabab96574026f761709998f38965d93518a5d026237c700290065d972409b980e31771a25', 0),
(175, 4, 'demo@demo.com', 'demo', '2016-03-08 11:56:27', 'TRY', 'TRIAL UPLOAD', 0, 1, '0', '', '', 4, '', NULL, 'f0fca288f78f0722e4140e8d228c027ee97447e5a70a527b147f599a0afed768e150c201ad338cf2', 1),
(176, 1, 'basugames@gmail.com', 'Mayukh Basu', '2016-03-12 17:14:36', 'Japanese', 'Kanji', 0, 1, '0', '', 'Mr Jpan', 5, '2', NULL, '60772432338095f0e74b0a310bd13ca10cff3af49569e7a64c15dd758af792037512a4d09a3f7efe', 1);

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

--
-- Dumping data for table `quartag`
--

INSERT INTO `quartag` (`ID`, `qtName`, `qtParentID`, `qtParentName`, `qtCity`, `qtState`, `qtCountry`, `qtType`, `qtFilePath`) VALUES
(1, 'dsgxf', 3, 'NONE', 'qsgf', 'qsgf', '1gerht', 'sdgf', 'qua54c51362bee581.71171885.json');

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

--
-- Dumping data for table `questionbank`
--

INSERT INTO `questionbank` (`qID`, `stream`, `subject`, `chapter`, `questionType`, `question`, `answer`, `time`) VALUES
(1, 'test', 'test', 'test', 'test', 'Question:', 'Answer:', '2016-01-13 15:20:46'),
(2, 'test', 'test', 'test', 'test', 'Question:', 'Answer:', '2016-01-13 15:21:04'),
(3, 'test', 'test', 'test', 'test', 'Question:', 'Answer:', '2016-01-13 15:21:11'),
(4, 'all', 'test', 'rofl', 'p', 'easy question', 'no answer', '2016-01-13 16:36:01');

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

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`ID`, `email`, `password`, `userlevel`, `country`, `dob`, `sex`, `name`, `contactno`, `salt`, `level0tag`, `level1tag`, `level2tag`, `level3tag`, `time`) VALUES
(1, 'basugames@gmail.com', '231e8c3f92ebc8c2b2eb88bf635689d712d0a630c0f813a1ecf208263b6f2f7a', 1, 'india', '2011-01-01', 'male', 'Mayukh Basu', 111111, 'b35ee', '1', '1', '1', '1', '2016-02-11 07:02:42'),
(3, 'test@test.com', '7dcaf3a425820b2fa73fb86a8dcc2028472a26a37464b8cae85e9cc6f91b26c1', 0, 'india', '0001-01-01', 'male', 'test', 1, '2b61d', '1', '1', '1', '1', '2016-02-11 07:23:23'),
(4, 'demo@demo.com', '3272ac09be3637ce7d4a4e82b517dc26fb1fc3e3c91dad39a2ce03307ba9d10e', 0, 'india', '0001-01-01', 'male', 'demo', 1, 'bb899', '1', '1', '1', '1', '2016-03-04 17:14:28'),
(5, 'basugames1@gmail.com', '96fba20d3679465dcfa327d968f673f15128345d67dae0c5d9b14fb2bf568d4e', 0, 'none', '0000-00-00', 'male', '', 0, '4a86f', '1', '1', '1', '', '2016-03-17 11:06:18');

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

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`reportID`, `state`, `userID`, `postID`, `postType`, `comment`, `time`) VALUES
(1, 0, 5, 163, 'post', 'please change this shit', '2016-01-14 12:16:06'),
(2, 0, 5, 163, 'post', 'this is shit', '2016-01-14 12:17:23'),
(3, 0, 5, 163, 'post', 'this is shit', '2016-01-14 12:18:49'),
(4, 0, 5, 163, 'post', 'this is shit', '2016-01-14 12:18:49'),
(5, 0, 5, 163, 'post', 'hbrvfhjsbdvlbds;', '2016-01-14 12:22:07'),
(6, 0, 5, 163, 'post', 'dstbdfhnfugjmk,uik', '2016-01-14 12:22:35'),
(7, 0, 5, 163, 'post', 'bdvgbhgfngfjmn', '2016-01-14 12:24:40'),
(8, 0, 5, 163, 'post', 'sgbdynftnmyfum', '2016-01-14 12:27:35'),
(9, 0, 5, 327, 'post', 'fbdgfbghfnfghn', '2016-01-14 12:55:19'),
(10, 0, 5, 330, 'post', 'test1234', '2016-02-09 15:38:26'),
(11, 0, 1, 329, 'post', 'test 1234', '2016-02-15 10:13:14'),
(12, 0, 1, 348, 'post', 'there is some problem with this post', '2016-03-08 12:38:44');

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

--
-- Dumping data for table `savenotes`
--

INSERT INTO `savenotes` (`ID`, `user_id`, `note_id`, `priority`, `time`) VALUES
(10, 5, 164, 1, '2016-01-14 11:14:00'),
(11, 5, 169, 1, '2016-01-14 11:11:27'),
(12, 5, 166, 1, '2016-01-14 11:13:57'),
(13, 1, 170, -1, '2016-03-13 18:24:57');

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

--
-- Dumping data for table `sectag`
--

INSERT INTO `sectag` (`ID`, `stName`, `stParentID`, `stParentName`, `stCity`, `stState`, `stCountry`, `stType`, `stFilePath`) VALUES
(1, 'Techno India College of Technology', 1, 'West Bengal University of Technology', 'Kolkata', 'West Bengal', 'India', 'College', 'sec54e9ea8ccaeb78.58008004.json');

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

--
-- Dumping data for table `terttag`
--

INSERT INTO `terttag` (`ID`, `ttName`, `ttParentID`, `ttParentName`, `ttCity`, `ttState`, `ttCountry`, `ttType`, `ttFilePath`) VALUES
(1, 'Information Technology (IT)', 1, 'Techno India College Of Technology', 'Kolkata', 'West Bengal', 'India', '', ''),
(2, 'Applied Electronics & Instrumentation Engineering (AEIE)', 1, 'Techno India College Of Technology', 'Kolkata', 'West Bengal', 'India', '', ''),
(3, 'Computer Science Engineering (CSE)', 1, 'Techno India College Of Technology', 'Kolkata', 'West Bengal', 'India', '', ''),
(4, 'Electronics & Communication Engineering (ECE)', 1, 'Techno India College Of Technology', 'Kolkata', 'West Bengal', 'India', '', ''),
(5, 'Electrical Engineering (EE)', 1, 'Techno India College Of Technology', 'Kolkata', 'West Bengal', 'India', '', ''),
(6, 'Civil Engineering (CE)', 1, 'Techno India College Of Technology', 'Kolkata', 'West Bengal', 'India', '', ''),
(7, 'Mechanical Engineering (ME)', 1, 'Techno India College Of Technology', 'Kolkata', 'West Bengal', 'India', '', '');

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

--
-- Dumping data for table `uniquecode`
--

INSERT INTO `uniquecode` (`ID`, `code`, `userLevel`, `time`) VALUES
(1, 'cpalpha', 0, '2016-01-14 09:52:40');

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

--
-- Dumping data for table `usersubject`
--

INSERT INTO `usersubject` (`ID`, `userid`, `subjectid`, `time`) VALUES
(1, 4, 5, '2015-02-23 09:00:28'),
(2, 5, 5, '2015-02-23 09:00:28'),
(3, 5, 6, '2015-02-23 09:02:21'),
(4, 5, 4, '2015-02-23 09:10:15'),
(5, 4, 5, '2015-02-23 10:24:15'),
(6, 35, 7, '2016-01-07 05:55:12'),
(7, 42, 4, '2016-01-14 14:05:49'),
(8, 43, 4, '2016-01-14 16:40:06'),
(9, 43, 6, '2016-01-14 16:40:06'),
(10, 1, 5, '2016-03-07 21:01:52'),
(11, 4, 4, '2016-03-08 12:17:52');

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

--
-- Dumping data for table `votedata`
--

INSERT INTO `votedata` (`ID`, `post_id`, `user_id`, `vote_val`, `time`) VALUES
(1, 69, 5, 1, '2015-02-07 13:14:11'),
(2, 67, 5, 1, '2015-02-07 13:14:23'),
(3, 68, 17, 1, '2015-02-07 13:18:01'),
(4, 69, 17, 1, '2015-02-07 13:18:12'),
(5, 67, 17, 1, '2015-02-07 13:18:17'),
(6, 70, 17, 1, '2015-02-07 13:22:43'),
(7, 46, 5, 1, '2015-02-07 13:30:42'),
(8, 49, 5, 1, '2015-02-07 13:32:50'),
(9, 72, 17, -1, '2015-02-09 09:04:35'),
(10, 73, 5, -1, '2015-02-18 16:40:36'),
(11, 71, 5, -1, '2015-02-10 08:52:13'),
(12, 70, 5, -1, '2015-02-10 08:52:16'),
(13, 0, 5, 1, '2015-02-08 14:49:22'),
(14, 66, 5, -1, '2015-02-09 09:03:30'),
(15, 65, 5, -1, '2015-02-09 09:03:29'),
(16, 64, 5, -1, '2015-02-09 09:03:29'),
(17, 63, 5, -1, '2015-02-09 09:03:28'),
(18, 62, 5, -1, '2015-02-09 09:03:25'),
(19, 60, 5, -1, '2015-02-09 09:03:24'),
(20, 59, 5, -1, '2015-02-09 09:03:23'),
(21, 58, 5, -1, '2015-02-09 09:03:21'),
(22, 53, 5, -1, '2015-02-09 09:03:31'),
(23, 45, 5, -1, '2015-02-08 15:04:04'),
(24, 52, 5, 1, '2015-02-08 15:14:01'),
(25, 74, 5, -1, '2015-02-10 08:07:05'),
(26, 73, 17, 1, '2015-02-09 09:04:53'),
(27, 74, 17, 1, '2015-02-09 09:05:18'),
(28, 72, 5, 1, '2015-02-16 10:37:49'),
(29, 61, 5, -1, '2015-02-09 09:03:25'),
(30, 75, 5, 1, '2015-02-15 02:33:53'),
(31, 80, 5, 1, '2015-02-16 10:51:50'),
(32, 80, 18, 1, '2015-02-16 11:03:00'),
(33, 81, 18, 1, '2015-02-16 11:04:04'),
(34, 82, 5, -1, '2015-02-18 16:40:02'),
(35, 83, 5, 1, '2015-02-18 16:40:21'),
(36, 93, 5, 1, '2015-02-20 16:22:30'),
(37, 95, 5, -1, '2015-02-20 16:23:07'),
(38, 96, 5, 1, '2015-02-23 09:22:17'),
(39, 94, 5, 1, '2015-02-23 09:22:08'),
(40, 97, 5, 1, '2015-02-23 09:22:50'),
(41, 100, 5, 1, '2015-02-25 16:44:42'),
(42, 99, 5, 1, '2015-02-25 16:45:24'),
(43, 121, 5, 1, '2015-03-02 14:02:28'),
(44, 126, 5, -1, '2015-03-06 10:34:47'),
(45, 128, 5, 1, '2015-03-05 12:56:08'),
(46, 129, 5, -1, '2015-03-05 12:56:09'),
(47, 144, 5, -1, '2015-03-14 12:39:43'),
(48, 143, 5, 1, '2015-03-14 15:52:08'),
(49, 199, 5, -1, '2015-03-19 12:02:52'),
(50, 216, 5, -1, '2015-04-03 07:35:57'),
(51, 217, 5, 1, '2015-04-02 17:34:00'),
(52, 219, 5, 1, '2015-04-03 07:53:32'),
(53, 218, 5, 1, '2015-04-04 12:21:23'),
(54, 194, 5, -1, '2015-04-04 12:22:31'),
(55, 227, 5, -1, '2015-04-08 14:32:29'),
(56, 211, 5, -1, '2015-04-08 14:41:57'),
(57, 225, 5, 1, '2015-04-08 15:36:14'),
(58, 230, 5, 1, '2015-04-08 17:17:45'),
(59, 226, 5, 1, '2015-04-08 18:29:57'),
(60, 242, 5, 1, '2015-04-09 13:29:32'),
(61, 242, 32, 1, '2015-04-09 13:29:43'),
(62, 251, 5, 1, '2015-04-09 18:21:30'),
(63, 254, 5, -1, '2015-04-11 12:30:06'),
(64, 259, 5, 1, '2015-04-14 16:16:32'),
(65, 270, 5, 1, '2015-04-14 17:06:44'),
(66, 280, 5, 1, '2015-04-30 08:48:49'),
(67, 282, 5, 1, '2015-04-30 08:47:22'),
(68, 292, 5, 1, '2015-05-23 06:52:27'),
(69, 284, 5, 1, '2015-05-23 06:52:33'),
(70, 296, 5, 1, '2015-05-23 06:52:38'),
(71, 298, 5, 1, '2015-09-18 07:26:59'),
(72, 299, 5, -1, '2015-06-06 09:46:43'),
(73, 306, 5, -1, '2015-06-06 10:05:59'),
(74, 305, 5, -1, '2015-06-06 10:06:00'),
(75, 308, 5, 1, '2015-09-18 07:41:26'),
(76, 309, 5, 1, '2015-09-18 07:41:27'),
(77, 310, 5, -1, '2015-09-18 07:41:28'),
(78, 314, 5, -1, '2015-10-03 16:34:27'),
(79, 312, 5, 1, '2015-10-03 16:34:57'),
(80, 324, 40, 1, '2016-01-14 10:02:14'),
(81, 324, 5, 1, '2016-01-14 10:02:25'),
(82, 324, 42, 1, '2016-01-14 14:04:21'),
(83, 328, 5, 1, '2016-01-21 15:13:54'),
(84, 330, 5, -1, '2016-02-11 06:13:31'),
(85, 331, 5, -1, '2016-02-09 15:38:38'),
(86, 330, 46, 1, '2016-02-09 16:04:06'),
(87, 329, 5, 1, '2016-02-10 02:21:32'),
(88, 329, 1, 1, '2016-02-11 08:52:59'),
(89, 326, 3, 1, '2016-02-11 14:56:50'),
(90, 330, 1, 1, '2016-02-11 18:24:14'),
(91, 315, 3, 1, '2016-02-12 14:07:43'),
(92, 328, 1, 1, '2016-02-18 10:41:48'),
(93, 326, 1, 1, '2016-02-18 10:41:50'),
(94, 346, 1, 1, '2016-03-08 11:54:31'),
(95, 346, 4, 1, '2016-03-08 12:18:13'),
(96, 348, 1, -1, '2016-03-08 12:38:53'),
(97, 336, 4, 1, '2016-03-14 13:56:16');

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
