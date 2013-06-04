-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 04, 2013 at 10:41 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.4.3

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `testly`
--

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

DROP TABLE IF EXISTS `answer`;
CREATE TABLE IF NOT EXISTS `answer` (
  `question_id` int(10) unsigned NOT NULL,
  `answer` text NOT NULL,
  `deleted` tinyint(3) unsigned NOT NULL DEFAULT '0',
  KEY `question_id` (`question_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `group`
--

DROP TABLE IF EXISTS `group`;
CREATE TABLE IF NOT EXISTS `group` (
  `group_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group_name` varchar(255) NOT NULL,
  `student_id` int(10) unsigned NOT NULL,
  `deleted` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`group_id`),
  KEY `student_id` (`student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

DROP TABLE IF EXISTS `question`;
CREATE TABLE IF NOT EXISTS `question` (
  `question_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `test_id` int(10) unsigned NOT NULL,
  `question_text` text NOT NULL,
  `question_type_id` tinyint(4) unsigned NOT NULL,
  `deleted` tinyint(4) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`question_id`),
  KEY `test_id` (`test_id`),
  KEY `question_type_id` (`question_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`question_id`, `test_id`, `question_text`, `question_type_id`, `deleted`) VALUES
(2, 1, 'küsimus', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `question_type`
--

DROP TABLE IF EXISTS `question_type`;
CREATE TABLE IF NOT EXISTS `question_type` (
  `question_type_id` tinyint(10) unsigned NOT NULL AUTO_INCREMENT,
  `question_type` varchar(25) NOT NULL,
  `deleted` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`question_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `question_type`
--

INSERT INTO `question_type` (`question_type_id`, `question_type`, `deleted`) VALUES
(1, 'tõene/väär', 0),
(2, 'üks õige', 0),
(3, 'mitu õiget', 0),
(4, 'täida lünk', 0);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `student_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `student_name` varchar(255) NOT NULL,
  `e-mail` varchar(255) NOT NULL,
  `deleted` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

DROP TABLE IF EXISTS `test`;
CREATE TABLE IF NOT EXISTS `test` (
  `test_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `introduction` varchar(255) NOT NULL,
  `conclusion` varchar(255) NOT NULL,
  `passcode` int(10) unsigned NOT NULL,
  `deleted` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`test_id`),
  KEY `user_id` (`user_id`),
  KEY `user_id_2` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`test_id`, `name`, `user_id`, `date`, `introduction`, `conclusion`, `passcode`, `deleted`) VALUES
(1, 'test_1', 1, '2013-04-17 21:00:00', '', '', 0, 0),
(2, 'test 3', 1, '2013-04-19 08:25:25', '', '', 0, 0),
(3, 'tes_1', 1, '2013-04-19 11:44:46', '', '', 0, 0),
(4, 'test_2', 1, '2013-04-19 11:44:58', '', '', 0, 0),
(5, 'test_3', 1, '2013-04-19 11:45:10', 'blaöö', 'blaõõ', 123, 0),
(6, 'uus-test', 1, '2013-04-25 14:40:17', 'aaa', 'bbb', 123, 0),
(7, 'a', 1, '2013-04-29 11:23:29', '', '', 0, 0),
(8, 'uus', 1, '2013-04-29 11:31:10', '', '', 0, 0),
(9, 'a', 1, '2013-05-10 12:24:41', '', '', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(25) NOT NULL,
  `deleted` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `status`, `deleted`) VALUES
(1, 'demo', 'demo', 'teacher', 0),
(2, 'demo2', 'demo2', 'student', 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answer`
--
ALTER TABLE `answer`
  ADD CONSTRAINT `answer_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `question` (`question_id`);

--
-- Constraints for table `group`
--
ALTER TABLE `group`
  ADD CONSTRAINT `group_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`);

--
-- Constraints for table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `question_ibfk_1` FOREIGN KEY (`test_id`) REFERENCES `test` (`test_id`),
  ADD CONSTRAINT `question_ibfk_2` FOREIGN KEY (`question_type_id`) REFERENCES `question_type` (`question_type_id`);

--
-- Constraints for table `test`
--
ALTER TABLE `test`
  ADD CONSTRAINT `test_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);
SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
