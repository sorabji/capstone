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

----------------------------------------------------------
----------------------------------------------------------
----------------------------------------------------------

<link rel='stylesheet' type='text/css' href="../static/style.css" />
<!--<link rel='stylesheet' type='text/css' href="../form_testing.css" />-->

<?php
include('../header.php');
include('../config.php'); 
include('../util.php');


$att = new Daily_Record(true);

if (isset($_POST['submit'])) { 
//if (false){

  connect();

  $fin = $att->get_update_qry($_POST);

  mysql_query($fin) or die(mysql_error()); 
  //echo($fin);
  if($fin){
    echo "<p>Records Updated.</p><br />";
    echo "<a href='record_list.php'>Back To Attendance Records</a>";
  } else {
    echo("nothing added");
  }
} else {
  $att->new_display();

}
//include('../footer.php');
?>