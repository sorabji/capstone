<script>
function addDate(){
date = new Date();
var month = date.getMonth()+1;
var day = date.getDate();
var year = date.getFullYear();

if (document.getElementById('date').value == ''){
document.getElementById('date').value = year + '-' + month + '-' + day;
}
}
</script>
<body onload="addDate();">


<?php

include('../header.php');
$res = $_SESSION['attendance_resource'];
$res = mysql_query($res);


if (isset($_POST['submit_course_date_view'])) {
	echo "<h1 style='color:red'>submit_course_date_view isset called</h1>";
		//declaring variables to use when 'submit_course_view' is pressed

		$the_dates = $_POST['the_dates'];

		if( is_array($the_dates)){
			while (list ($key, $val) = each ($the_dates)) {
				$td = $val;
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
				GROUP BY $td
				ORDER BY people.last_name, people.first_name, $td";	
			$_SESSION['attendance_resource'] = $e_resource;
			header('Location: '.$root.'attendance/view_by_course.php');
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
	$absences = new Absent(true);
	$absences->edit_list_display($res);
}

	var_dump($_POST);
	echo '<h3>Select a course and section.</h3>';
	echo '<Form Name ="form_select_date" Method ="post" ACTION = "view_by_course.php">';
	//Drop-Down form, Group By DATE
	$qry = mysql_query("SELECT the_date FROM absences GROUP BY the_date");
	echo '<select name="the_dates[]"><option value="">Date</option>';
	while($dat = mysql_fetch_assoc($qry))
	echo '<option value="' . $dat['the_date'] . '">' . $dat['the_date'] . '</option>';
	echo'</select><br />';
	
	echo '<input type = "Submit" name = "submit_course_date_view" value = "View Attendance for This Class"></form>';