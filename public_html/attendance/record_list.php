<?php
	include_once('../util.php');
	include_once('../header.php');

	echo ("<p><a href=\"#\">View by Date<a></p>");
	echo ("<p><a href=\"#\">View by Class<a></p>");	
	echo ("<p><a href=\"#\">View by Student<a></p>");
	
	echo ("<p><a href=\"#\">Records by Date<a></p>");
	$link = connect();
	//$resource = mysql_query("select * from absences, people", $link);
	$resource = mysql_query("SELECT * FROM absences, students WHERE students.id = absences.fk_absent_student AND students.student_id = 6;", $link);
		   
	$absences = new Absent(true);
	$absences->list_display($resource);
	
	include_once('../footer.php');
?>
