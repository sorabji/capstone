<?php

	include('../util.php');
	include('../header.php');
	
	$link = connect();

	echo '<h3>Select a course and section.</h3>';
	echo '<Form Name ="form_select_course" Method ="post" ACTION = "poop.php">';	
	//Drop-Down form, Group By courses
	$qry = mysql_query("SELECT course_id FROM sections GROUP BY course_id");
	echo '<select name="course_nums[]"><option value="">Course</option>';
	while($dat = mysql_fetch_assoc($qry))
	echo '<option value="' . $dat['course_id'] . '">' . $dat['course_id'] . '</option>';
	echo'</select><br />';
	
	//Drop-Down form, Group By courses
	$qry = mysql_query("SELECT sec FROM sections GROUP BY sec");
	echo '<select  name="sections[]"><option value="">Section</option>';
	while($dat = mysql_fetch_assoc($qry))
	echo '<option value="' . $dat['sec'] . '">' . $dat['sec'] . '</option>';
	echo'</select><br />';	
		
	echo '<input type = "Submit" name = "submit_course" value = "Submit Course"></form>';
	
	
	
	if (isset($_POST['submit_course'])) {
		//declaring variables to use when 'submit_course' is pressed

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
					
					$resource = mysql_query("SELECT people.last_name, people.first_name, students.id
						FROM people, students
						INNER JOIN absences, sections
						WHERE sections.id = absences.fk_absent_section
						AND people.id = students.student_id
						AND absences.fk_absent_section = students.sec_id
						AND sections.course_id = '$cn' AND sections.sec = '$sx'
						GROUP BY students.student_id
						ORDER BY people.last_name, people.first_name", $link);	
					$absences = new Absent(true);
					$absences->new_list_display($resource);
						
				}else
					echo "";
					//$section_id = $_GET['sec'];


			}
		}else
			echo "";
		
	
//		if( is_array($course_nums)){
//			if( is_array($sections)){
			
//			}
		
//		}
		}else
			echo "";
//		$fin = $absences->get_qry($_POST);
//		mysql_query($fin) or die(mysql_error()); 
//		//echo($fin);
//		if($fin){
//			echo "<p>Records Updated.</p><br />";
//			echo "<a href='record_list.php'>View Attendance Records</a>";
//		} else
//			echo("nothing added");
//	} else
//		$absences->new_record();
	
	
	
	
	
	//When the form is POSTed, do:
	//while ($dat = mysql_fetch_assoc($absence_qry))
	//$tm = strtotime($_POST['fk_absent_section']);
	//foreach($_POST['absences'] as $id)
	//mysql_query("INSERT INTO absences (the_date,fk_absent_student) VALUES ($tm,$id)"); 
	
	//When the form is POSTed, do:
//	$tm = strtotime($_POST['the_date']);
//	foreach($_POST['absences'] as $id)
//	mysql_query("INSERT INTO absences (the_date,fk_absent_student) VALUES ($tm,$id)"); 
	
	
	//echo '<select name="absences[]" value="' . $dat['fk_absent_section'] . '">' . $dat['fk_absent_student']; 
	//echo "<option size =30 selected>Select</option>";
	//if(get_courses($vals)) 
	//{ 
	//	while($row = get_courses($vals))
	//		echo "<option>$row[name]</option>"; 
	//} 
	
?>