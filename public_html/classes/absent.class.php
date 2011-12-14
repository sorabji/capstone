
<!--
//would-be script to gray out "Excused?" radio buttons
<script language="javascript" type="text/javascript">
	function radioDisable(){
			if(document.getElementById('radio_abs').checked) {
			document.getElementById('radio_ex').disabled = false;
			document.getElementById('radio_nex').disabled = false;
			}
			if(!document.getElementById('radio_abs').checked) {
			document.getElementById('radio_ex').disabled = true;
			document.getElementById('radio_nex').disabled = true;
			}
		}
	radioDisable();
</script> -->


<?php
	class Absent extends Table{
		

	
		//Creating new record by COURSE list column HEADERS
	  private $list_headers = array(
		"Last Name",
		"First Name",
		"Student ID");

		//Creating new record by COURSE list column VALUES
	  private $list_table_cols = array(
		"last_name",
		"first_name",
		"stud_string_id");
		
	//Editing by COURSE list column HEADERS
	  private $edit_by_course_headers = array(
		"Last Name",
		"First Name",
		"Student ID",
		"Present?",
		"Excused?",
		"Date");
		
	//Editing by COURSE list column VALUES
	  private $edit_by_course_vals = array(
		"last_name",
		"first_name",
		"stud_string_id",
		"isAbsent",
		"isExcused",
		"the_date");
		
		///////////////
		//Labels when posting new records
	  private $new_labels = array(
		"Date",
		"Section",
		"Student Number",
		//"First Name",
		//"Last Name",
		"Absent",
		"Excused");

		//variables when posting new records
	  private $new_post_vars = array(
		"fk_absent_section",
		"fk_absent_student",
		"the_date",
		"isAbsent",
		"isExcused",
		"first_name",
		"last_name");

		//Helpful hints
	  private $new_help_txt = array(
		"Class Section Number",
		"Student Numero",
		"",
		"Are they absent today?",
		"Is the absence excused?",
		"",
		"");

	  private $ID = "id"; // what's the id field of this table?

	  public function __construct($ed_flag){
		$this->ed_flag = $ed_flag; // want to update/delete as Admin?
	  }

	//List Display CREATE by COURSE - adds "Present" and "Excused" radio buttons
	public function new_list_display($resource){
		echo "<h1 style='color:red'>new_list_display called</h1>";		
		//$selected_radio = $_POST['isAbsent'];
		//print $selected_radio;
		$student_present = 'unchecked';
		$student_absent = 'unchecked';		
		echo("<table border='1' >\n<tr>");
		echo "<form id='form' name='form' action='' method='POST'>\n";
		foreach($this->list_headers as $head){
			echo("<th>$head</th>\n");
		}
		if($this->ed_flag){
			echo("<th>Student Present?</th><th>Excused?</th>\n");
		}
		echo("</tr>");
		while($row = mysql_fetch_array($resource)){
			echo("<tr>\n");
			foreach($row as $key => $value){
				$row[$key] = stripslashes($value);
			}
			foreach($this->list_table_cols as $val){
				echo("<td valign='top'>$row[$val]</td>");
			}
			if($this->ed_flag){
				echo ("<td valign='top' width='175px' height='20px'>
				<Input type = 'radio' Name ='{$row['stud_num_id']}_isPresent' id='radio_pres' value= '0' />	<?PHP print $student_present; ?>Yes&nbsp;
				<Input type = 'radio' Name ='{$row['stud_num_id']}_isPresent' id='radio_abs' value= '1' /> <?PHP print $student_absent; ?>No
				</td>\n");
				echo("<td valign='top' width='175px' height='20px'>
				<Input type = 'radio' Name ='{$row['stud_num_id']}_isExcused' id='radio_ex' value= '1' />	<?PHP print $student_absent; ?>Yes&nbsp;
				<Input type = 'radio' Name ='{$row['stud_num_id']}_isExcused' id='radio_nex' value= '0' /> <?PHP print $student_present; ?>No
				</td>\n"); //Adds "isExcused" radio buttons
			}
		}
		echo "</tr>\n</table><div>\n";
		echo "Date: <input type='text' id='date' name='date'>";
		echo "<input type='submit' id='submit' name='submit_absences' value='Submit Absences' />\n";
		echo "</div>\n</div>\n</form>";	
	}//End CREATE by COURSE List Display		

	
	public function new_display(){}
	public function list_display($resource){}
	//public function new_display(){}
	  
	  
	//List Display VIEW/EDIT by COURSE - adds "edit" and "delete" buttons
	public function edit_list_display($e_resource){
		echo "<h1 style='color:red'>edit_list_display called</h1>";
		echo("<table border='1' >\n<tr>");
		foreach($this->edit_by_course_headers as $head){
			echo("<th>$head</th>\n");
		}
		if($this->ed_flag){
			echo("<th colspan='2'>Admin</th>\n");
		}
		echo("</tr>");
		while($row = mysql_fetch_array($e_resource)){
				echo("<tr>\n");
				foreach($row as $key => $value) {
				$row[$key] = stripslashes($value);
			}
			foreach($this->edit_by_course_vals as $val) {
				
				if($row[$val] == '1'){
					echo("<td valign='top'>Yes</td>");
				}
				else if($row[$val] == '0'){
					echo("<td valign='top'>NOO!!</td>");
				}
				else
					echo("<td valign='top'>$row[$val]</td>");
				
			}
			if($this->ed_flag){
				echo("<td valign='top'><a href=attendance.php?id={$row[$this->ID]}>Edit</a></td>\n"); //Adds Edit button to end of display table
				echo("<td valign='top'><a href=attendance.php?id={$row[$this->ID]}>Delete</a></td>\n"); //Adds Delete button to end of display table
			}
		}
		echo("</tr>\n</table>");
	}//end EDIT by COURSE List Display
	
	  public function edit_display($id){
		return 0;
	  }

/*	  //get COURSEs to populate dropdown menu
	  public function get_courses($vals){
		echo "<h1 style='color:red'>get_courses called</h1>";
		foreach($_POST AS $key => $value) { $_POST[$key] = $this->prep_sql($value); }
		$base = "SELECT * FROM `sections` ( `id` ,  `course_id` ,  `sec` ) ";
		$fmt_str = "VALUES( '%s', '%s', '%s' );";
		$res = sprintf($fmt_str, // can't just unpack?...hrm //(???)
		$vals[$this->new_post_vars[0]],
		$vals[$this->new_post_vars[1]],
		$vals[$this->new_post_vars[2]]);
		$fin = $base . $res;
		return $fin;
	  } 
	  	
		//dropdown
		public function populate_dropdown($course_query){
			echo "<h1 style='color:red'>populate_dropdown called</h1>";
			echo "<select name='course_id'>"; 
			echo "<option size =30 selected>Select</option>";
			if(get_courses($vals)) 
			{ 
				while($row = get_courses($vals))
					echo "<option>$row[name]</option>"; 
			} 
			else
				echo "<option>No Names Present</option>";
		}
			//end dropdown
*/


	  public function get_qry($vals){
		echo "<h1 style='color:red'>get_qry called</h1>";
	  // don't forget to hash the damn passwords
		foreach($_POST AS $key => $value) { $_POST[$key] = $this->prep_sql($value); }
//		$base = "INSERT INTO `absences` ( `fk_absent_section ` ,  `fk_absent_student` ,  `the_date`,  `isAbsent` ,  `isExcused` ) ";
		$base = "SELECT people.last_name, people.first_name, students.id
							FROM people, students
							INNER JOIN absences
							WHERE people.id = students.student_id
							AND absences.fk_absent_section = students.sec_id
							GROUP BY students.student_id
							ORDER BY people.last_name, people.first_name";
		$fmt_str = "VALUES( '%s', '%s', '%s' );";
		$res = sprintf($fmt_str, // (???)
		   $vals[$this->new_post_vars[0]],
			   $vals[$this->new_post_vars[1]],
			   $vals[$this->new_post_vars[2]]);
		$fin = $base . $res;
		return $fin;
	}

/////////////to GET for EDIT By COURSE	
	  public function get_qry_edit_by_course($vals){
		echo "<h1 style='color:red'>get_qry_edit_by_course called</h1>";
	  // don't forget to hash the damn passwords
		foreach($_POST AS $key => $value) { $_POST[$key] = $this->prep_sql($value); }
		$base = "SELECT people.last_name, people.first_name, students.id, absences.isAbsent, absences.isExcused, absences.the_date
							FROM people, students
							INNER JOIN absences
							WHERE people.id = students.student_id
							AND absences.fk_absent_section = students.sec_id
							GROUP BY students.student_id
							ORDER BY people.last_name, people.first_name";
		$fmt_str = "VALUES( '%s', '%s', '%s', '%s', '%s', '%s' );";
		$res = sprintf($fmt_str, // (???)
		   $vals[$this->new_post_vars[0]],
			   $vals[$this->new_post_vars[1]],
			   $vals[$this->new_post_vars[2]],
			   $vals[$this->new_post_vars[3]],
			   $vals[$this->new_post_vars[4]],
			   $vals[$this->new_post_vars[5]]);
		$fin = $base . $res;
		return $fin;
	}

	
  public function update_qry($vals){
		echo "<h1 style='color:red'>update_qry called</h1>";
		// don't forget to hash the damn passwords
		foreach($_POST AS $key => $value) { $_POST[$key] = $this->prep_sql($value); }
		
		$base = "INSERT INTO `absences` ( `fk_absent_section ` ,  `fk_absent_student` ,  `the_date`,  `isAbsent` ,  `isExcused` ) ";
		$fmt_str = "VALUES( '%s', '%s', '%s', '%s', '%s' );";
		$res = sprintf($fmt_str, // can't just unpack?...hrm //(???)
		   $vals[$this->new_post_vars[0]],
			   $vals[$this->new_post_vars[1]],
			   $vals[$this->new_post_vars[2]],
			   $vals[$this->new_post_vars[3]],
			   $vals[$this->new_post_vars[4]]);
		$fin = $base . $res;
		return $fin;
	}

	
	public function get_update_qry($vals){
		echo "<h1 style='color:red'>get_update_qry called</h1>";
		// don't forget to hash the damn passwords
		foreach($_POST AS $key => $value) { $_POST[$key] = $this->prep_sql($value); }
		
		$base = "INSERT INTO `absences` ( `fk_absent_section ` ,  `fk_absent_student` ,  `the_date`,  `isAbsent` ,  `isExcused` ) ";
		$fmt_str = "VALUES( '%s', '%s', '%s', '%s', '%s' );";
		$res = sprintf($fmt_str, // can't just unpack?...hrm //(???)
		   $vals[$this->new_post_vars[0]],
			   $vals[$this->new_post_vars[1]],
			   $vals[$this->new_post_vars[2]],
			   $vals[$this->new_post_vars[3]],
			   $vals[$this->new_post_vars[4]],
			   $vals[$this->new_post_vars[5]],
			   $vals[$this->new_post_vars[6]]);
		$fin = $base . $res;
		return $fin;
	}
	}
?>