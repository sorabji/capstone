
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
	class Poop extends Table{

	
		//Viewing list column headers
	  private $list_headers = array(
		"Date",
		"Section",
		"Student Number",
		//"First Name",
		//"Last Name",
		"Absent",
		"Excused");

		//Viewing list column variables
	  private $list_table_cols = array(
		"the_date",
		"fk_absent_section",
		"fk_absent_student",
		//"first_name",
		//"last_name",
		"isAbsent",
		"isExcused");

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


	//list display to add new records
	public function new_list_display($resource){
		//$selected_radio = $_POST['isAbsent'];
		//print $selected_radio;
		$student_present = 'unchecked';
		$student_absent = 'unchecked';
		if (isset($_POST['submit_absences'])) {
			//dummy value
			$_POST['submit_absences'] = "undefine";
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
      echo "<input type='submit' id='submit' name='submit_absences' class='inputSubmit' value='submit' />\n";
		echo "</div>\n</div>\n</form>";
	}//end new list display

	  
	//original list display, with flag to add "edit" or "delete" buttons
	public function list_display($resource){
		echo("<table border='1' >\n<tr>");
		foreach($this->list_headers as $head){
			echo("<th>$head</th>\n");
		}
		if($this->ed_flag){
			echo("<th colspan='2'>Admin</th>\n");
		}
		echo("</tr>");
		while($row = mysql_fetch_array($resource)){
				echo("<tr>\n");
				foreach($row as $key => $value) {
				$row[$key] = stripslashes($value);
			}
			foreach($this->list_table_cols as $val) {
				echo("<td valign='top'>$row[$val]</td>");
			}
			if($this->ed_flag){
				echo("<td valign='top'><a href=attendance.php?id={$row[$this->ID]}>Edit</a></td>\n"); //Adds Edit button to end of display table
				echo("<td valign='top'><a href=attendance.php?id={$row[$this->ID]}>Delete</a></td>\n"); //Adds Delete button to end of display table
			}
		}
		echo("</tr>\n</table>");
	}//end orig list display
	
	public function new_record(){
		echo "<form id='form' name='form' action='' method='POST'>\n";
	}

	public function new_display(){
		echo "<form id='form' name='form' action='' method='POST'>\n";
		echo "<p>All fields are required</p>\n";
		echo "<fieldset><legend>Attendance Records</legend>\n";

		echo "<div class='required'>\n";

		//???
		foreach($this->new_labels as $key => $val){
			echo "<div class='clear'></div>";
			echo "<label for='{$this->new_post_vars[$key]}'>";
			echo $this->new_labels[$key];
			echo "</label>\n";
			if ( (strcmp($this->new_post_vars[$key], "password") == 0) | strcmp($this->new_post_vars[$key], "password_2") == 0 ){
				echo "<input class='inputPassword' type='password' name='{$this->new_post_vars[$key]}' id='{$this->new_post_vars[$key]}' />\n";
			} else {
				echo "<input class='inputText' type='text' name='{$this->new_post_vars[$key]}' id='{$this->new_post_vars[$key]}' />\n";
			}
		}
		echo "<div class='submit'>\n";
		echo "<div><input type='submit' id='submit' name='submit' class='inputSubmit' value='Add Record' />\n";
		echo "</div>\n</div>\n</fieldset>\n</form>";
		//echo($ret);
	}

	  public function edit_display($id){
		return 0;
	  }

	  //get classes to populate dropdown menu
	  public function get_courses($vals){
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

	  	  
	  public function get_update_qry($vals){

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