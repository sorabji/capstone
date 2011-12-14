<?php

	include('../util.php');
	include('../header.php');
	echo "<p>Beginning of Table</p>";
	
	//List Class
	$link = connect();

	$course_query = mysql_query("SELECT * FROM sections", $link);
	$courses = new Absent(true);
	$courses->get_courses($course_query);


	$resource = mysql_query("SELECT * FROM absences, students, people WHERE students.id = absences.fk_absent_student AND students.student_id = people.id AND absences.the_date = '2011-12-06';", $link);	
	$absences = new Absent(true);
	$absences->new_list_display($resource);
	//$att = new Absent(true);
	
	if (isset($_POST['submit'])) {
		//if (false){
		$fin = $absences->get_update_qry($_POST);
		mysql_query($fin) or die(mysql_error()); 
		//echo($fin);
		if($fin){
			echo "<p>Records Updated.</p><br />";
			echo "<a href='record_list.php'>View Attendance Records</a>";
		} else
			echo("nothing added");
	} else
		$absences->new_record();
		
	echo "<p>End of Table</p>";
	include('../footer.php');
?>
