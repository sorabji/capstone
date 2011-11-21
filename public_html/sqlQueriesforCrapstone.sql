--These are all of the querys we will be needing for the project.  
--THIS IS A ROUGH COPY, WE WILL HAVE A COMPLETED COPY NEXT WEEK, BE PREPARED.
--Hugs and Kisses <3

-----------------------------ABSENCES/ATTENDENCE----------------------------------
--Populate the student list for attendence.

SELECT * FROM students WHERE sec_id=##that;
--Updating the absences table n stuff
UPDATE absences SET isAbsent=1 WHERE fk_absent_student=##studentId;
UPDATE absences SET the_date=##TheDate WHERE fk_absent_student=##studentId;
--Are they excused?
UPDATE absences SET isExcused=1 WHERE fk_absent_student=##studentId;
UPDATE absences SET the_date=##TheDate WHERE fk_absent_student=##studentId;
--Mistakenly marked absent?
UPDATE absences SET isAbsent=0 WHERE fk_absent_student=##studentId;
--Mistakenly excused?
UPDATE absences SET isExcused=0 WHERE fk_absent_student=##studentId;

-----------------------------------GRADES-----------------------------------------
--adding assignments to the grading table
UPDATE grades SET points_possible=##points_poss WHERE sec_id=##sec_id AND student_id=##studentId AND ass_id=assId;
--Populate a list of students for grading purposes
SELECT * FROM students WHERE sec_id=##that_again;
--Adding a grade for an assignment for a student
UPDATE submissions SET points_received=##pointsRcvd WHERE student_id=##studentId AND sec_id=##sectionId AND ass_id=##assId;
--When this is called, should we auto-update the grades table? Or what.
--Discuss that.



