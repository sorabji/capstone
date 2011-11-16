-- MySQL dump 10.13  Distrib 5.1.54, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: capstone
-- ------------------------------------------------------
-- Server version	5.1.54-1ubuntu4

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `absences`
--

DROP TABLE IF EXISTS `absences`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `absences` (
  `fk_absent_section` int(10) NOT NULL,
  `fk_absent_student` varchar(15) NOT NULL,
  `the_date` date NOT NULL,
  `isAbsent` int(1) NOT NULL,
  `isExcused` int(1) NOT NULL,
  PRIMARY KEY (`fk_absent_section`,`fk_absent_student`,`the_date`),
  KEY `fk_absent_student` (`fk_absent_student`),
  CONSTRAINT `absences_ibfk_2` FOREIGN KEY (`fk_absent_student`) REFERENCES `students` (`id`),
  CONSTRAINT `absences_ibfk_1` FOREIGN KEY (`fk_absent_section`) REFERENCES `sections` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `absences`
--

LOCK TABLES `absences` WRITE;
/*!40000 ALTER TABLE `absences` DISABLE KEYS */;
/*!40000 ALTER TABLE `absences` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admins` (
  `admin_id` int(10) NOT NULL,
  PRIMARY KEY (`admin_id`),
  CONSTRAINT `admins_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `people` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES (9);
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ass_grades`
--

DROP TABLE IF EXISTS `ass_grades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ass_grades` (
  `student_id` varchar(15) NOT NULL,
  `sec_id` int(10) NOT NULL,
  `ass_id` int(10) NOT NULL,
  `points_poss` int(11) NOT NULL,
  PRIMARY KEY (`student_id`,`sec_id`,`ass_id`),
  KEY `sec_id` (`sec_id`),
  KEY `ass_id` (`ass_id`),
  CONSTRAINT `ass_grades_ibfk_3` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`),
  CONSTRAINT `ass_grades_ibfk_1` FOREIGN KEY (`sec_id`) REFERENCES `sections` (`id`),
  CONSTRAINT `ass_grades_ibfk_2` FOREIGN KEY (`ass_id`) REFERENCES `assignments` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ass_grades`
--

LOCK TABLES `ass_grades` WRITE;
/*!40000 ALTER TABLE `ass_grades` DISABLE KEYS */;
/*!40000 ALTER TABLE `ass_grades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `assignments`
--

DROP TABLE IF EXISTS `assignments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `assignments` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `sec_id` int(10) NOT NULL,
  `title` varchar(20) NOT NULL,
  `points_poss` int(10) NOT NULL,
  PRIMARY KEY (`id`,`sec_id`),
  KEY `sec_id` (`sec_id`),
  CONSTRAINT `assignments_ibfk_1` FOREIGN KEY (`sec_id`) REFERENCES `sections` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assignments`
--

LOCK TABLES `assignments` WRITE;
/*!40000 ALTER TABLE `assignments` DISABLE KEYS */;
INSERT INTO `assignments` VALUES (1,6,'project 1',25),(2,6,'final project',50);
/*!40000 ALTER TABLE `assignments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `courses` (
  `id` varchar(6) NOT NULL,
  `course_Desc` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `courses`
--

LOCK TABLES `courses` WRITE;
/*!40000 ALTER TABLE `courses` DISABLE KEYS */;
INSERT INTO `courses` VALUES ('com267','mildly cool stuff'),('com279','awesome sweet course action here');
/*!40000 ALTER TABLE `courses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emails`
--

DROP TABLE IF EXISTS `emails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emails` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `person_id` int(10) NOT NULL,
  `parent` int(10) NOT NULL,
  PRIMARY KEY (`id`,`person_id`),
  KEY `parent` (`parent`),
  KEY `person_id` (`person_id`),
  CONSTRAINT `emails_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `people` (`id`),
  CONSTRAINT `emails_ibfk_2` FOREIGN KEY (`parent`) REFERENCES `emails` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emails`
--

LOCK TABLES `emails` WRITE;
/*!40000 ALTER TABLE `emails` DISABLE KEYS */;
/*!40000 ALTER TABLE `emails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `instructors`
--

DROP TABLE IF EXISTS `instructors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `instructors` (
  `instructor_id` int(10) NOT NULL,
  `sec_id` int(10) NOT NULL,
  PRIMARY KEY (`instructor_id`,`sec_id`),
  KEY `sec_id` (`sec_id`),
  CONSTRAINT `instructors_ibfk_2` FOREIGN KEY (`sec_id`) REFERENCES `sections` (`id`),
  CONSTRAINT `instructors_ibfk_1` FOREIGN KEY (`instructor_id`) REFERENCES `people` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `instructors`
--

LOCK TABLES `instructors` WRITE;
/*!40000 ALTER TABLE `instructors` DISABLE KEYS */;
/*!40000 ALTER TABLE `instructors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `people`
--

DROP TABLE IF EXISTS `people`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `people` (
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `people`
--

LOCK TABLES `people` WRITE;
/*!40000 ALTER TABLE `people` DISABLE KEYS */;
INSERT INTO `people` VALUES (6,'john','student','1234 happy way','john@student.com','3833833833','383838383','john','123qwe'),(7,'bill','instructor','5849 sad street','bill@instructor.com','9309389389','728738278','bill','123qwe'),(8,'frank','student','this and that ','frank@adams.com','3833839203','834374837','frank','123qwe'),(9,'bob','admin','sdlkfjdkjf','sdkfjskdjf','skdfsdkf','sdfsdf','bob','123qwe');
/*!40000 ALTER TABLE `people` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `questions` (
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
  CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questions`
--

LOCK TABLES `questions` WRITE;
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
INSERT INTO `questions` VALUES (1,1,'what is...','my ','this','shoe','planet','none of the above','b');
/*!40000 ALTER TABLE `questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quiz_grades`
--

DROP TABLE IF EXISTS `quiz_grades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quiz_grades` (
  `student_id` varchar(15) NOT NULL,
  `sec_id` int(10) NOT NULL,
  `quiz_id` int(10) NOT NULL,
  `points_received` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`student_id`,`sec_id`,`quiz_id`),
  KEY `sec_id` (`sec_id`),
  KEY `quiz_id` (`quiz_id`),
  CONSTRAINT `quiz_grades_ibfk_1` FOREIGN KEY (`sec_id`) REFERENCES `sections` (`id`),
  CONSTRAINT `quiz_grades_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`),
  CONSTRAINT `quiz_grades_ibfk_4` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quiz_grades`
--

LOCK TABLES `quiz_grades` WRITE;
/*!40000 ALTER TABLE `quiz_grades` DISABLE KEYS */;
/*!40000 ALTER TABLE `quiz_grades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quizzes`
--

DROP TABLE IF EXISTS `quizzes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quizzes` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `course_id` varchar(6) NOT NULL,
  `title` varchar(20) NOT NULL,
  `points_poss` int(10) NOT NULL,
  `isOpen` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`,`course_id`),
  KEY `course_id` (`course_id`),
  CONSTRAINT `quizzes_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quizzes`
--

LOCK TABLES `quizzes` WRITE;
/*!40000 ALTER TABLE `quizzes` DISABLE KEYS */;
INSERT INTO `quizzes` VALUES (1,'com279','practice quiz',25,0);
/*!40000 ALTER TABLE `quizzes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sections`
--

DROP TABLE IF EXISTS `sections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sections` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `course_id` varchar(6) NOT NULL,
  `sec` varchar(6) NOT NULL,
  PRIMARY KEY (`course_id`,`sec`),
  KEY `perfect_sec_id` (`id`),
  CONSTRAINT `sections_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sections`
--

LOCK TABLES `sections` WRITE;
/*!40000 ALTER TABLE `sections` DISABLE KEYS */;
INSERT INTO `sections` VALUES (5,'com279','1morn'),(6,'com279','1night');
/*!40000 ALTER TABLE `sections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `students` (
  `id` varchar(15) NOT NULL,
  `student_id` int(10) NOT NULL,
  `sec_id` int(10) NOT NULL,
  PRIMARY KEY (`student_id`,`sec_id`,`id`),
  KEY `sec_id` (`sec_id`),
  KEY `id` (`id`),
  CONSTRAINT `students_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `people` (`id`),
  CONSTRAINT `students_ibfk_2` FOREIGN KEY (`sec_id`) REFERENCES `sections` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `students`
--

LOCK TABLES `students` WRITE;
/*!40000 ALTER TABLE `students` DISABLE KEYS */;
INSERT INTO `students` VALUES ('cis7586',6,6),('gm837',8,6);
/*!40000 ALTER TABLE `students` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `submissions`
--

DROP TABLE IF EXISTS `submissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `submissions` (
  `sec_id` int(10) NOT NULL,
  `ass_id` int(10) NOT NULL,
  `student_id` varchar(15) NOT NULL,
  PRIMARY KEY (`sec_id`,`ass_id`,`student_id`),
  KEY `ass_id` (`ass_id`),
  KEY `student_id` (`student_id`),
  CONSTRAINT `submissions_ibfk_1` FOREIGN KEY (`sec_id`) REFERENCES `sections` (`id`),
  CONSTRAINT `submissions_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`),
  CONSTRAINT `submissions_ibfk_3` FOREIGN KEY (`ass_id`) REFERENCES `assignments` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `submissions`
--

LOCK TABLES `submissions` WRITE;
/*!40000 ALTER TABLE `submissions` DISABLE KEYS */;
INSERT INTO `submissions` VALUES (6,1,'cis7586');
/*!40000 ALTER TABLE `submissions` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2011-11-16 11:23:49
