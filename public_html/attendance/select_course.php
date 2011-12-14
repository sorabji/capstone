
<?php

	include('../util.php');
	include('../header.php');
	$link = connect();

//////////////TO SUBMIT NEW ATTENDANCE RECORDS
	if (isset($_POST['submit_course_new'])) {
		//declaring variables to use when 'submit_course_new' is pressed

		$course_nums = $_POST['course_nums'];
		$sections = $_POST['sections'];
		if( is_array($course_nums)){
			while (list ($key, $val) = each ($course_nums)) {
			$cn = $val;
			echo "$val <br />";
			if( is_array($sections)){
					while (list ($key, $val) = each ($sections)) {
					$sx = $val;
					echo "$val <br />";
					}
					$resource = "SELECT people.last_name, people.first_name, students.id as stud_string_id, students.student_id as stud_num_id, sections.id, sections.sec, sections.course_id
						FROM people, students, sections
						INNER JOIN absences
						WHERE sections.id = absences.fk_absent_section
						AND people.id = students.student_id
						AND absences.fk_absent_section = students.sec_id
						AND sections.course_id = '$cn' AND sections.sec = '$sx'
						GROUP BY students.student_id
						ORDER BY people.last_name, people.first_name";	
					$_SESSION['attendance_resource'] = $resource;
					header('Location: '.$root.'attendance/record_new.php');
				}else
					echo "";
					//$section_id = $_GET['sec'];
			}
		}else
			echo "";
	}
	
/////////////TO VIEW EXISTING RECORDS:	
		else if (isset($_POST['submit_course_date_view'])) {
		//declaring variables to use when 'submit_course_view' is pressed

		$course_nums = $_POST['course_nums'];
		$sections = $_POST['sections'];
	/*	$the_dates = $_POST['the_dates'];

		if( is_array($the_dates)){
			while (list ($key, $val) = each ($the_dates)) {
			$td = $val;
			echo "$val <br />";
			}
		}
	*/
		
		if( is_array($course_nums)){
			while (list ($key, $val) = each ($course_nums)) {
			$cn = $val;
			echo "$val <br />";
			if( is_array($sections)){
					while (list ($key, $val) = each ($sections)) {
					$sx = $val;
					echo "$val <br />";
					}
					$e_resource = "SELECT people.last_name, people.first_name, students.id as stud_string_id, students.student_id as stud_num_id, sections.id, sections.sec, sections.course_id, absences.isAbsent, absences.isExcused, absences.the_date
						FROM people, students, sections
						INNER JOIN absences
						WHERE sections.id = absences.fk_absent_section
						AND people.id = students.student_id
						AND absences.fk_absent_section = students.sec_id
						AND sections.course_id = '$cn' AND sections.sec = '$sx'
						AND absences.the_date = '$td'
						ORDER BY absences.the_date, people.last_name, people.first_name";	
					$_SESSION['attendance_resource'] = $e_resource;
					header('Location: '.$root.'attendance/view_by_course.php');
				}else
					echo "";
					//$section_id = $_GET['sec'];
			}
		}else
			echo "";
	}
	
	
	
	////////////
	
	else
		echo "";	
//
	echo '<h3>Select a course and section.</h3>';
	echo '<Form Name ="form_select_course" Method ="post" ACTION = "select_course.php">';

	//Drop-Down form, Group By courses
	$qry = mysql_query("SELECT course_id FROM sections GROUP BY course_id");
	echo '<select name="course_nums[]"><option value="">Course</option>';
	while($dat = mysql_fetch_assoc($qry))
	echo '<option value="' . $dat['course_id'] . '">' . $dat['course_id'] . '</option>';
	echo'</select><br />';
	
	//Drop-Down form, Group By sections
	$qry = mysql_query("SELECT sec FROM sections GROUP BY sec");
	echo '<select  name="sections[]"><option value="">Section</option>';
	while($dat = mysql_fetch_assoc($qry))
	echo '<option value="' . $dat['sec'] . '">' . $dat['sec'] . '</option>';
	echo'</select><br />';

	
	echo '<input type = "Submit" name = "submit_course_new" value = "Enter Attendance for This Class">';
	echo '<input type = "Submit" name = "submit_course_date_view" value = "View Attendance Records for This Class"></form>';
	
?>