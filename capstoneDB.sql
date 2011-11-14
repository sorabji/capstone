## build phone list
## for mySQL

USE capstone;
DROP TABLE IF EXISTS questions;
DROP TABLE IF EXISTS quizzes;
DROP TABLE IF EXISTS instructors;
DROP TABLE IF EXISTS students;
DROP TABLE IF EXISTS people;
DROP TABLE IF EXISTS sections;
DROP TABLE IF EXISTS absences;
DROP TABLE IF EXISTS assignments;
DROP TABLE IF EXISTS submissions;
DROP TABLE IF EXISTS grades;
DROP TABLE IF EXISTS emails;
DROP TABLE IF EXISTS courses;

CREATE TABLE people (
       id INT(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
       first_name VARCHAR(15),
       last_name VARCHAR (15),
       address VARCHAR(50),
       email VARCHAR(20),
       phone VARCHAR(15),
       social INT(9),
       PRIMARY KEY(id))
       ENGINE=INNODB;

CREATE TABLE courses(
       id VARCHAR(6) NOT NULL,
       course_Desc VARCHAR(50),
       PRIMARY KEY (id))
       ENGINE=INNODB;

CREATE TABLE quizzes(
       id INT(10) unsigned zerofill NOT NULL,
       course_id VARCHAR(6) NOT NULL,
       isOpen INT(1) NOT NULL,
       FOREIGN KEY (course_id) REFERENCES courses(id),
       PRIMARY KEY (id, course_id))
       ENGINE=INNODB;

CREATE TABLE questions (
       quiz_id INT(10) unsigned zerofill NOT NULL,
       quest_num INT NOT NULL,
       quest_txt VARCHAR(200) NOT NULL,
       ansA VARCHAR(30),
       ansB VARCHAR(30),
       ansC VARCHAR(30),
       ansD VARCHAR(30),
       ansE VARCHAR(30),
       correctAnswer CHAR,
       FOREIGN KEY (quiz_id) REFERENCES quizzes(id),
       PRIMARY KEY (quiz_id, quest_num))
       ENGINE=INNODB;

CREATE TABLE sections(
       id INT(10) unsigned zerofill AUTO_INCREMENT NOT NULL
       course_id VARCHAR(6) NOT NULL,
       sec VARCHAR(6) NOT NULL,
       FOREIGN KEY (course_id) REFERENCES courses(id),
       PRIMARY KEY (course_id, sec))
       ENGINE=INNODB;

CREATE TABLE instructors (
       instructor_id INT(10) unsigned zerofill NOT NULL,
       sec_id 
       FOREIGN KEY (instructor_id) REFERENCES people(id),
       FOREIGN KEY (sec_id) REFERENCES sections(id),
       PRIMARY KEY (instructor_id, sec))
       ENGINE=INNODB;
       
CREATE TABLE students (
       student_id INT(10) unsigned zerofill NOT NULL,
       sec VARCHAR(6) NOT NULL,
       FOREIGN KEY (student_id) REFERENCES people(id),
       FOREIGN KEY (sec) REFERENCES sections(sec)
       PRIMARY KEY (student_id, sec))
       ENGINE=INNODB;

CREATE TABLE absences(
       sec VARCHAR(6) NOT NULL,
       student_id INT(10) unsigned zerofill NOT NULL,
       dates DATE,
       isAbsent INT(1),
       isExcused INT(1),
       FOREIGN KEY (sec) REFERENCES sections(sec),
       FOREIGN KEY (student_id) REFERENCES people(id),
       PRIMARY KEY (sec, student_id, dates))
       ENGINE=INNODB;

CREATE TABLE assignments(
       id VARCHAR(6) NOT NULL,
       course_id VARCHAR(6) NOT NULL,
       points_poss INT(10) NOT NULL,
       FOREIGN KEY (course_id) REFERENCES courses(id),
       PRIMARY KEY (course_id, id))
       ENGINE=INNODB;

CREATE TABLE submissions(
       sec VARCHAR(6) NOT NULL,
       ass_num VARCHAR(6) NOT NULL,
       student_id INT(10) unsigned zerofill NOT NULL,
       points_received INT(10),
       FOREIGN KEY (sec) REFERENCES sections(sec),
       FOREIGN KEY (student_id) REFERENCES people(id),
       FOREIGN KEY (ass_num) REFERENCES assignments(id),
       PRIMARY KEY (course_id, student_id, ass_num))
       ENGINE=INNODB;

CREATE TABLE grades(
       student_id INT(10) unsigned zerofill NOT NULL,
       sec VARCHAR(6) NOT NULL,
       points_poss INT(10),
       points_received INT(10)
       FOREIGN KEY (sec) REFERENCES sections(sec),
       FOREIGN KEY (student_id) REFERENCES people(id),
       PRIMARY KEY (student_id, sec))
       ENGINE=INNODB;

CREATE TABLE emails(
       id INT(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
       person_id INT(10) unsigned zerofill NOT NULL,
       parent INT(10) unsigned zerofill,
       isRead INT(1),
       bodyTxt VARCHAR(200),
       FOREIGN KEY (person_id) REFERENCES people(id),
       PRIMARY KEY (id, person_id))
       ENGINE=INNODB;

