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
					
					if (isset($_POST['submit_absences'])) {
						//dummy value
						//$_POST['submit_absences'] = "undefine";
						$selected_radio = $_POST['isAbsent'];
						if ($selected_radio=='0')
							$student_present = 'checked';
						else if ($selected_radio=='1')
							$student_absent = 'checked';

							$fk_absent_section = $_POST['fk_absent_section'];
							$fk_absent_student = $_POST['fk_absent_student'];
							$the_date = $_POST['the_date'];
							$isAbsent = $_POST['isAbsent'];
							$isExcused = $_POST['isExcused'];
							$fin = $absences->update_qry($_POST);
							
							 if(!isset($isAbsent)){
								echo("<p>Please record data for all students.</p>\n");
							  }
							
							mysql_query($fin) or die(mysql_error()); 
							//echo($fin);
							if($fin){
								echo "<p>Records Updated.</p><br />";
								echo "<a href='record_list.php'>View Attendance Records</a>";
							} else
								echo("nothing added");
						}
					
					
				}else
					echo "";
					//$section_id = $_GET['sec'];
			}
		}else
			echo "";
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
	


/*from the class*/ /*	//list display to add new records
	public function new_list_display($resource){
		//$selected_radio = $_POST['isAbsent'];
		//print $selected_radio;
		$student_present = 'unchecked';
		$student_absent = 'unchecked';
		if (isset($_POST['submit'])) {
			//dummy value
			$_POST['submit'] = "undefine";
			$selected_radio = $_POST['isAbsent'];
			if ($selected_radio=='0')
				$student_present = 'checked';
			else if ($selected_radio=='1')
				$student_absent = 'checked';
		}
		echo("<table border='1' >\n<tr>");
		foreach($this->list_headers as $head)
			echo("<th>$head</th>\n");
		if($this->ed_flag)
			echo("<th>Student Present?</th><th>Excused?</th>\n");
		echo("</tr>");
		while($row = mysql_fetch_array($resource)){
			echo("<tr>\n");
			foreach($row as $key => $value)
				$row[$key] = stripslashes($value);
			foreach($this->list_table_cols as $val)
				echo("<td valign='top'>$row[$val]</td>");
			if($this->ed_flag){
				echo ("<td valign='top' width='175px' height='20px'>
					<Input type = 'radio' Name ='{$row['fk_absent_student']}_isPresent' id='radio_pres' value= '0' />	<?PHP print $student_present; ?>Yes&nbsp;
					<Input type = 'radio' Name ='{$row['fk_absent_student']}_isPresent' id='radio_abs' value= '1' /> <?PHP print $student_absent; ?>No
					</td>\n");
				echo("<td valign='top' width='175px' height='20px'>
					<Input type = 'radio' Name ='{$row['fk_absent_student']}_isExcused' id='radio_ex' value= '1' />	<?PHP print $student_absent; ?>Yes&nbsp;
					<Input type = 'radio' Name ='{$row['fk_absent_student']}_isExcused' id='radio_nex' value= '0' /> <?PHP print $student_present; ?>No
					</td>\n"); //Adds "isExcused" radio buttons
			}
		}
		echo "<div class='submit'>\n";
      echo "<input type='button' id='clear' name='clear' class='inputSubmit' value='clear all' />\n";
      echo "<input type='submit' id='submit' name='submit' class='inputSubmit' value='submit' />\n";
		echo "</div>\n</div>\n</form>";
	}//end new list display*/
?>

