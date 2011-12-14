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

function twice_pop($arraij){
	$val_1 = array_pop($arraij);
	$val_2 = array_pop($arraij);
	if(!$val_1){
		return array($val_1,$val_2);
	} else {
		return array($val_1,$val_2);
	}
}

if (isset($_POST['submit_absences'])) {
	echo "<h1 style='color:red'>submit_absences isset called</h1>";
//dummy value
//$_POST['submit_absences'] = "undefine";
//			$selected_radio = $_POST['isAbsent'];
//			if ($selected_radio=='0')
//			$student_present = 'checked';
//			else if ($selected_radio=='1')
//				$student_absent = 'checked';
/*	array_pop($_POST);
	$date = array_pop($_POST);
	while($hrm = twice_pop($_POST)){
		var_dump($hrm);
	}
	
	
	while($isPresent = array_pop($_POST)){
		$isExcused = array_pop($_POST);
		echo($isPresent);
		echo($isExcused);
	}*/
	
	
	/*  $insert_vars = array(
		"fk_absent_section",
		"fk_absent_student",
		"the_date",
		"isAbsent",
		"isExcused");
	
	
	$fk_absent_section = $_POST['fk_absent_section'];
	$fk_absent_student = $_POST['fk_absent_student'];
	$the_date = $_POST['the_date'];
	$isAbsent = $_POST['isAbsent'];
	$isExcused = $_POST['isExcused'];*/

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
	}
	var_dump($_POST);
} else {
	$absences = new Absent(true);
	$absences->new_list_display($res);
}
?>
