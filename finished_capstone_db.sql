-- phpMyAdmin SQL Dump
-- version 3.3.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 14, 2011 at 05:41 PM
-- Server version: 5.1.54
-- PHP Version: 5.3.5-1ubuntu7.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `junk`
--

-- --------------------------------------------------------

--
-- Table structure for table `absences`
--

CREATE TABLE IF NOT EXISTS `absences` (
  `fk_absent_section` int(10) NOT NULL,
  `fk_absent_student` varchar(15) NOT NULL,
  `the_date` date NOT NULL,
  `isAbsent` int(1) NOT NULL,
  `isExcused` int(1) NOT NULL,
  PRIMARY KEY (`fk_absent_section`,`fk_absent_student`,`the_date`),
  KEY `fk_absent_student` (`fk_absent_student`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `absences`
--


-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `admin_id` int(10) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--


-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

CREATE TABLE IF NOT EXISTS `assignments` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `sec_id` int(10) NOT NULL,
  `title` varchar(20) NOT NULL,
  `points_poss` int(10) NOT NULL,
  PRIMARY KEY (`id`,`sec_id`),
  KEY `sec_id` (`sec_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `assignments`
--


-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE IF NOT EXISTS `courses` (
  `id` varchar(6) NOT NULL,
  `course_Desc` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--


-- --------------------------------------------------------

--
-- Table structure for table `emails`
--

CREATE TABLE IF NOT EXISTS `emails` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `person_id` int(10) NOT NULL,
  `parent` int(10) NOT NULL,
  PRIMARY KEY (`id`,`person_id`),
  KEY `parent` (`parent`),
  KEY `person_id` (`person_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `emails`
--


-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE IF NOT EXISTS `grades` (
  `student_id` varchar(15) NOT NULL,
  `sec_id` int(10) NOT NULL,
  `ass_id` int(10) NOT NULL DEFAULT '0',
  `quiz_id` int(10) NOT NULL,
  `points_poss` int(10) NOT NULL,
  `points_received` int(11) NOT NULL,
  PRIMARY KEY (`student_id`,`sec_id`,`ass_id`,`quiz_id`),
  KEY `sec_id` (`sec_id`),
  KEY `ass_id_2` (`ass_id`),
  KEY `quiz_id` (`quiz_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grades`
--


-- --------------------------------------------------------

--
-- Table structure for table `instructors`
--

CREATE TABLE IF NOT EXISTS `instructors` (
  `instructor_id` int(10) NOT NULL,
  `sec_id` int(10) NOT NULL,
  PRIMARY KEY (`instructor_id`,`sec_id`),
  KEY `sec_id` (`sec_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `instructors`
--


-- --------------------------------------------------------

--
-- Table structure for table `people`
--

CREATE TABLE IF NOT EXISTS `people` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(15) DEFAULT NULL,
  `last_name` varchar(15) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `email` varchar(20) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `social` varchar(9) DEFAULT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `people`
--


-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `quiz_id` int(10) NOT NULL,
  `quest_num` int(11) NOT NULL,
  `quest_txt` varchar(200) NOT NULL,
  `ansA` varchar(30) DEFAULT NULL,
  `ansB` varchar(30) DEFAULT NULL,
  `ansC` varchar(30) DEFAULT NULL,
  `ansD` varchar(30) DEFAULT NULL,
  `ansE` varchar(30) DEFAULT NULL,
  `correctAnswer` char(1) DEFAULT NULL,
  PRIMARY KEY (`quiz_id`,`quest_num`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--


-- --------------------------------------------------------

--
-- Table structure for table `quizzes`
--

CREATE TABLE IF NOT EXISTS `quizzes` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `course_id` varchar(6) NOT NULL,
  `title` varchar(20) NOT NULL,
  `isOpen` int(1) NOT NULL,
  PRIMARY KEY (`id`,`course_id`),
  KEY `course_id` (`course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `quizzes`
--


-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE IF NOT EXISTS `sections` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `course_id` varchar(6) NOT NULL,
  `sec` varchar(6) NOT NULL,
  PRIMARY KEY (`course_id`,`sec`),
  KEY `perfect_sec_id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `sections`
--


-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE IF NOT EXISTS `students` (
  `id` varchar(15) NOT NULL,
  `student_id` int(10) NOT NULL,
  `sec_id` int(10) NOT NULL,
  PRIMARY KEY (`student_id`,`sec_id`,`id`),
  KEY `sec_id` (`sec_id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--


-- --------------------------------------------------------

--
-- Table structure for table `submissions`
--

CREATE TABLE IF NOT EXISTS `submissions` (
  `sec_id` int(10) NOT NULL,
  `ass_id` int(10) NOT NULL,
  `student_id` varchar(15) NOT NULL,
  `points_received` int(10) NOT NULL,
  PRIMARY KEY (`sec_id`,`ass_id`,`student_id`),
  KEY `ass_id` (`ass_id`),
  KEY `student_id` (`student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `submissions`
--


--
-- Constraints for dumped tables
--

--
-- Constraints for table `absences`
--
ALTER TABLE `absences`
  ADD CONSTRAINT `absences_ibfk_2` FOREIGN KEY (`fk_absent_student`) REFERENCES `students` (`id`),
  ADD CONSTRAINT `absences_ibfk_1` FOREIGN KEY (`fk_absent_section`) REFERENCES `sections` (`id`);

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `people` (`id`);

--
-- Constraints for table `assignments`
--
ALTER TABLE `assignments`
  ADD CONSTRAINT `assignments_ibfk_1` FOREIGN KEY (`sec_id`) REFERENCES `sections` (`id`);

--
-- Constraints for table `emails`
--
ALTER TABLE `emails`
  ADD CONSTRAINT `emails_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `people` (`id`),
  ADD CONSTRAINT `emails_ibfk_2` FOREIGN KEY (`parent`) REFERENCES `emails` (`id`);

--
-- Constraints for table `grades`
--
ALTER TABLE `grades`
  ADD CONSTRAINT `grades_ibfk_4` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`),
  ADD CONSTRAINT `grades_ibfk_1` FOREIGN KEY (`sec_id`) REFERENCES `sections` (`id`),
  ADD CONSTRAINT `grades_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`),
  ADD CONSTRAINT `grades_ibfk_3` FOREIGN KEY (`ass_id`) REFERENCES `assignments` (`id`);

--
-- Constraints for table `instructors`
--
ALTER TABLE `instructors`
  ADD CONSTRAINT `instructors_ibfk_2` FOREIGN KEY (`sec_id`) REFERENCES `sections` (`id`),
  ADD CONSTRAINT `instructors_ibfk_1` FOREIGN KEY (`instructor_id`) REFERENCES `people` (`id`);

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`);

--
-- Constraints for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD CONSTRAINT `quizzes_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`);

--
-- Constraints for table `sections`
--
ALTER TABLE `sections`
  ADD CONSTRAINT `sections_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`);

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `people` (`id`),
  ADD CONSTRAINT `students_ibfk_2` FOREIGN KEY (`sec_id`) REFERENCES `sections` (`id`);

--
-- Constraints for table `submissions`
--
ALTER TABLE `submissions`
  ADD CONSTRAINT `submissions_ibfk_3` FOREIGN KEY (`ass_id`) REFERENCES `assignments` (`id`),
  ADD CONSTRAINT `submissions_ibfk_1` FOREIGN KEY (`sec_id`) REFERENCES `sections` (`id`),
  ADD CONSTRAINT `submissions_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`);
