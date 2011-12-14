
<?php

include('../header.php');
$res = $_SESSION['attendance_resource'];
$res = mysql_query($res);


if (isset($_POST['submit_course_stud_view'])) {
	echo "<h1 style='color:red'>submit_course_stud_view isset called</h1>";
		//declaring variables to use when 'submit_course_view' is pressed

		$students = $_POST['students'];

		if( is_array($students)){
			while (list ($key, $val) = each ($students)) {
				$std = $val;
				echo "$val <br />";
			}
			$std_resource = "SELECT people.last_name, people.first_name, students.id as stud_string_id, students.student_id as stud_num_id, sections.id, sections.sec, sections.course_id, absences.isAbsent, absences.isExcused, absences.the_date
				FROM people, students, sections
				INNER JOIN absences
				WHERE sections.id = absences.fk_absent_section
				AND people.id = students.student_id
				AND absences.fk_absent_section = students.sec_id
				AND stud_num_id = '$std'
				GROUP BY $std
				ORDER BY people.last_name, people.first_name, $std";	
			$_SESSION['attendance_resource'] = $std_resource;
			header('Location: '.$root.'attendance/view_by_student.php');
			//$section_id = $_GET['sec'];

		}else{
			echo "";
		}
/*
	$ins_qry = mysql_query("INSERT INTO absences ('fk_absent_section', 'fk_absent_student', 'the_date', 'isAbsent', 'isExcused')
					VALUES (''$fk_absent_student', '$fk_absent_section', '$the_date', '$isAbsent', 'isExcused');", $link);	
	$absences = new Absent(true);
	$absences->update_qry($ins_qry);
	$fin = $absences->update_qry($_POST);
	if(!isset($isAbsent)){
		echo("<p style=\"color:red\";>Please record data for all students.</p>\n");
	}
	else{
		mysql_query($fin) or die(mysql_error()); 
		//echo($fin);
		if($fin){
			echo "<p>Records Updated.</p><br />";
			echo "<a href='record_list.php'>View Attendance Records</a>";
		} else {
			echo("nothing added");
		}
	}*/
} else {
	echo '<center><div>';
	echo '<h3>Select a Student.</h3>';
	echo '<br /><Form Name ="form_select_course_by_student" Method ="post" ACTION = "view_by_student.php">';
	
	////////!!!!!!!!!NEED TO PASS IN absences.fk_absent_section FROM PREVIOUS PAGE!!!!!!!!
	//Drop-Down form, Group By STUDENT
	$qry = mysql_query("SELECT people.last_name, students.id, sections.id, absences.fk_absent_student, students.student_id
						FROM people, students, sections, absences
						WHERE people.id = students.student_id
						AND  students.id = absences.fk_absent_student
						AND sections.id = fk_absent_section
						AND fk_absent_section = 5
						GROUP BY absences.fk_absent_student
						ORDER BY people.last_name, absences.fk_absent_student");
	echo '<select name="the_dates[]"><option value="">Student Name</option>';
	while($dat = mysql_fetch_assoc($qry))
	echo '<option value="' . $dat['fk_absent_student'] . '">' . $dat['absences.fk_absent_student'] . ' ' . $dat['last_name'] . '</option>';
	echo'</select><br /><br />';
	
	echo '<input type = "Submit" name = "submit_course_stud_view" value = "View Attendance for This Class"></form></div><br />';
	$absences = new Absent(true);
	$absences->edit_list_display($res);
	var_dump($_POST);
	}
?>