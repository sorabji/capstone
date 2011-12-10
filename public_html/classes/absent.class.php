<?php
	class Absent extends Table{

	
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
		"the_date",
		"fk_absent_section",
		"fk_absent_student",
		"first_name",
		"last_name",
		"isAbsent",
		"isExcused");

		//Helpful hints
	  private $new_help_txt = array(
		"",
		"Class Section Number",
		"Student Numero",
		"",
		"",
		"Are they absent today?",
		"Is the absence excused?");

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
		if (isset($_POST['submit'])) {
			$selected_radio = $_POST['isAbsent'];
			if ($selected_radio=='0') {
				$student_present = 'checked';
			}
			else if ($selected_radio=='1') {
				$student_absent = 'checked';
			}
		}
 
		echo("<FORM name='form1' method='post' action=''><table border='1' >\n<tr>");
		foreach($this->list_headers as $head){
		  echo("<th>$head</th>\n");
		}
		if($this->ed_flag){
			echo("<th>Absent?</th><th>Excused?</th>\n");
		}
		echo("</tr>");

		while($row = mysql_fetch_array($resource)){
		/*
		  echo("<tr>\n");
		  foreach($row as $key => $value) {
			$row[$key] = stripslashes($value);
		  }
		  foreach($this->list_table_cols as $val) {
			echo("<td valign='top'>$row[$val]</td>");
		  }
		  if($this->ed_flag){
				echo ("<td valign='top' width='175px' height='20px'>
						<fieldset><Input type = 'radio' Name ='isAbsent' value= '1'	<?PHP print $student_absent; ?>Y&nbsp;
						<Input type = 'radio' Name ='isAbsent' value= '0' <?PHP print $student_present; ?>N</fieldset>
				     </td>\n");
				echo("<td valign='top' width='175px' height='20px'>
						<fieldset><Input type = 'radio' Name ='isExcused' value= '1'	<?PHP print $student_absent; ?>Y&nbsp;
						<Input type = 'radio' Name ='isExcused' value= '0' <?PHP print $student_present; ?>N</fieldset>
				     </td>\n"); //Adds "isExcused" radio buttons

				
		  }
*/
	echo(var_dump($row));
		}
		echo("</tr>\n</table></FORM>");
		var_dump($resource);
	  }

	  
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
	  }

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

		  if ( (strcmp($this->new_post_vars[$key], "password") == 0) |
		strcmp($this->new_post_vars[$key], "password_2") == 0 ){

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