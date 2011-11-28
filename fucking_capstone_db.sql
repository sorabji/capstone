-- phpMyAdmin SQL Dump
-- version 3.3.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 23, 2011 at 11:33 PM
-- Server version: 5.1.54
-- PHP Version: 5.3.5-1ubuntu7.3

--
-- damn emails
--
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `capstone`
--

-- --------------------------------------------------------

--
-- Table structure for table `absences`
--

DROP TABLE IF EXISTS `absences`;
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

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `admin_id` int(10) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`) VALUES
(9);

-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

DROP TABLE IF EXISTS `assignments`;
CREATE TABLE IF NOT EXISTS `assignments` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `sec_id` int(10) NOT NULL,
  `title` varchar(20) NOT NULL,
  `points_poss` int(10) NOT NULL,
  PRIMARY KEY (`id`,`sec_id`),
  KEY `sec_id` (`sec_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `assignments`
--

INSERT INTO `assignments` (`id`, `sec_id`, `title`, `points_poss`) VALUES
(1, 6, 'project 1', 25),
(2, 6, 'final project', 50);

-- --------------------------------------------------------

--
-- Table structure for table `ass_grades`
--

DROP TABLE IF EXISTS `ass_grades`;
CREATE TABLE IF NOT EXISTS `ass_grades` (
  `student_id` varchar(15) NOT NULL,
  `sec_id` int(10) NOT NULL,
  `ass_id` int(10) NOT NULL,
  `points_poss` int(11) NOT NULL,
  PRIMARY KEY (`student_id`,`sec_id`,`ass_id`),
  KEY `sec_id` (`sec_id`),
  KEY `ass_id` (`ass_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ass_grades`
--


-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
CREATE TABLE IF NOT EXISTS `courses` (
  `id` varchar(6) NOT NULL,
  `course_Desc` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_Desc`) VALUES
('com267', 'mildly cool stuff'),
('com279', 'awesome sweet course action here');

-- --------------------------------------------------------

--
-- Table structure for table `emails`
--

DROP TABLE IF EXISTS `emails`;
CREATE TABLE IF NOT EXISTS `emails` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `sender` int(10) NOT NULL,
  `recipient` int(10) NOT NULL,
  `subject` VARCHAR(255) NOT NULL,
  `message` TEXT NOT NULL,
  `from_viewed` int(1) NOT NULL,
  `to_viewed` int(1) NOT NULL,
  `from_deleted` int(1) NOT NULL,
  `to_deleted` int(1) NOT NULL,
  `from_vdate` DATETIME NULL,
  `to_vdate` DATETIME NULL,
  `from_ddate` DATETIME NULL,
  `to_ddate` DATETIME NULL,
  `created` DATETIME NULL,
  PRIMARY KEY (`id`,`sender`),
  KEY `subject` (`subject`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `emails`
--


-- --------------------------------------------------------

--
-- Table structure for table `instructors`
--

DROP TABLE IF EXISTS `instructors`;
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

DROP TABLE IF EXISTS `people`;
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `people`
--

INSERT INTO `people` (`id`, `first_name`, `last_name`, `address`, `email`, `phone`, `social`, `username`, `password`) VALUES
(6, 'john', 'student', '1234 happy way', 'john@student.com', '3833833833', '383838383', 'john', '123qwe'),
(7, 'bill', 'instructor', '5849 sad street', 'bill@instructor.com', '9309389389', '728738278', 'bill', '123qwe'),
(8, 'frank', 'student', 'this and that ', 'frank@adams.com', '3833839203', '834374837', 'frank', '123qwe'),
(9, 'bob', 'admin', 'sdlkfjdkjf', 'sdkfjskdjf', 'skdfsdkf', 'sdfsdf', 'bob', '123qwe');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
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
  PRIMARY KEY (`quiz_id`,`quest_num`),
  KEY `quest_num` (`quest_num`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`quiz_id`, `quest_num`, `quest_txt`, `ansA`, `ansB`, `ansC`, `ansD`, `ansE`, `correctAnswer`) VALUES
(1, 1, 'what is...', 'my ', 'this', 'shoe', 'planet', 'none of the above', 'b');

-- --------------------------------------------------------

--
-- Table structure for table `quizzes`
--

DROP TABLE IF EXISTS `quizzes`;
CREATE TABLE IF NOT EXISTS `quizzes` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `course_id` varchar(6) NOT NULL,
  `title` varchar(20) NOT NULL,
  `points_poss` int(10) NOT NULL,
  `isOpen` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`,`course_id`),
  KEY `course_id` (`course_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `quizzes`
--

INSERT INTO `quizzes` (`id`, `course_id`, `title`, `points_poss`, `isOpen`) VALUES
(1, 'com279', 'practice quiz', 25, 0);

-- --------------------------------------------------------

--
-- Table structure for table `quiz_grades`
--

DROP TABLE IF EXISTS `quiz_grades`;
CREATE TABLE IF NOT EXISTS `quiz_grades` (
  `student_id` varchar(15) NOT NULL,
  `sec_id` int(10) NOT NULL,
  `quiz_id` int(10) NOT NULL,
  `points_received` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`student_id`,`sec_id`,`quiz_id`),
  KEY `sec_id` (`sec_id`),
  KEY `quiz_id` (`quiz_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quiz_grades`
--


-- --------------------------------------------------------

--
-- Table structure for table `quiz_quest_grades`
--

DROP TABLE IF EXISTS `quiz_quest_grades`;
CREATE TABLE IF NOT EXISTS `quiz_quest_grades` (
  `quiz` int(10) NOT NULL,
  `question_number` int(11) NOT NULL,
  `stud_id` varchar(15) NOT NULL,
  `submit_answer` char(1) NOT NULL,
  PRIMARY KEY (`quiz`,`question_number`,`stud_id`),
  KEY `question_number` (`question_number`),
  KEY `stud_id` (`stud_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quiz_quest_grades`
--


-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

DROP TABLE IF EXISTS `sections`;
CREATE TABLE IF NOT EXISTS `sections` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `course_id` varchar(6) NOT NULL,
  `sec` varchar(6) NOT NULL,
  PRIMARY KEY (`course_id`,`sec`),
  KEY `perfect_sec_id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `course_id`, `sec`) VALUES
(5, 'com279', '1morn'),
(6, 'com279', '1night');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
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

INSERT INTO `students` (`id`, `student_id`, `sec_id`) VALUES
('cis7586', 6, 6),
('gm837', 8, 6);

-- --------------------------------------------------------

--
-- Table structure for table `submissions`
--

DROP TABLE IF EXISTS `submissions`;
CREATE TABLE IF NOT EXISTS `submissions` (
  `sec_id` int(10) NOT NULL,
  `ass_id` int(10) NOT NULL,
  `student_id` varchar(15) NOT NULL,
  PRIMARY KEY (`sec_id`,`ass_id`,`student_id`),
  KEY `ass_id` (`ass_id`),
  KEY `student_id` (`student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `submissions`
--

INSERT INTO `submissions` (`sec_id`, `ass_id`, `student_id`) VALUES
(6, 1, 'cis7586');

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
-- Constraints for table `ass_grades`
--
ALTER TABLE `ass_grades`
  ADD CONSTRAINT `ass_grades_ibfk_3` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`),
  ADD CONSTRAINT `ass_grades_ibfk_1` FOREIGN KEY (`sec_id`) REFERENCES `sections` (`id`),
  ADD CONSTRAINT `ass_grades_ibfk_2` FOREIGN KEY (`ass_id`) REFERENCES `assignments` (`id`);

--
-- Constraints for table `emails`
--
ALTER TABLE `emails`
  ADD CONSTRAINT `emails_ibfk_1` FOREIGN KEY (`sender`) REFERENCES `people` (`id`),
  ADD CONSTRAINT `emails_ibfk_2` FOREIGN KEY (`recipient`) REFERENCES `people` (`id`);

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
-- Constraints for table `quiz_grades`
--
ALTER TABLE `quiz_grades`
  ADD CONSTRAINT `quiz_grades_ibfk_1` FOREIGN KEY (`sec_id`) REFERENCES `sections` (`id`),
  ADD CONSTRAINT `quiz_grades_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`),
  ADD CONSTRAINT `quiz_grades_ibfk_4` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`);

--
-- Constraints for table `quiz_quest_grades`
--
ALTER TABLE `quiz_quest_grades`
  ADD CONSTRAINT `quiz_quest_grades_ibfk_3` FOREIGN KEY (`stud_id`) REFERENCES `students` (`id`),
  ADD CONSTRAINT `quiz_quest_grades_ibfk_1` FOREIGN KEY (`quiz`) REFERENCES `questions` (`quiz_id`),
  ADD CONSTRAINT `quiz_quest_grades_ibfk_2` FOREIGN KEY (`question_number`) REFERENCES `questions` (`quest_num`);

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
  ADD CONSTRAINT `submissions_ibfk_1` FOREIGN KEY (`sec_id`) REFERENCES `sections` (`id`),
  ADD CONSTRAINT `submissions_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`),
  ADD CONSTRAINT `submissions_ibfk_3` FOREIGN KEY (`ass_id`) REFERENCES `assignments` (`id`);
