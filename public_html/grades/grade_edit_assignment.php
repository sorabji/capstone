<?php
	//works
	include_once('../header.php');
		
	if(isset($_POST['submitted'])) //already updated
	{
		$ass_id = $_POST['ass_id'];
		$student_id = $_POST['student_id'];
		$sec_id = $_POST['sec_id'];
		$points = $_POST['points'];
		$points_poss = $_POST['points_poss'];
		
		$sql = "update ass_grades set
		ass_id = '$ass_id',
		student_id = '$student_id',
		sec_id = '$sec_id',
		points = '$points_poss'
		where ass_id = '$ass_id'";
		
		if(@mysql_query($sql))
		{
			echo ('<p>Assignment grade updated.</p>');
		}
		else
		{
			echo('<p>Error updating' . mysql_error() . '</p>');
		}
		echo('<p><a href="grade_list_assignment.php">Return to list</a></p>');
	}
	else //needs to be updated
	{
		$ass_id = $_GET['id'];
		
		$grade = @mysql_query("select * from ass_grades inner join assignments on ass_grades.ass_id = assignments.id where ass_id = '$ass_id'");
		
		if(!$grade)
		{
			exit ('<p> Error getting assignment ' . mysql_error() . '</p>');
		}
		
		$grade = mysql_fetch_array($grade);
		
		$sec_id = $grade['sec_id'];
		$student_id = $grade['student_id'];
		$ass_id = $grade['ass_id'];
		$points_poss = $grade['points_poss'];
		$points = $grade['points'];
		
		$sec_id = htmlspecialchars($sec_id);
		$student_id = htmlspecialchars($student_id);
		$ass_id = htmlspecialchars($ass_id);
		$points_poss = htmlspecialchars($points_poss);
		$points = htmlspecialchars($points);
		
	}
?>
<p>Edit a student's grade:
<form action='' method='POST'>
	<b>Section ID: </b><input type='text' name='sec_id' value='<?php echo $sec_id ?>' readonly='true'/> <br/>
	<b>Student ID: </b><input type='text' name='student_id' value='<?php echo $student_id?>'readonly='true' /><br/>
	<b>Assignment ID: </b><input type='text' name='ass_id' value='<?php echo $ass_id ?>' readonly='true'/><br/>
	<b>Points: </b><input type='text' name='points' value='<?php echo $points ?>' /><br/>
	<b>Points Possible: </b><input type='text' name='points_poss' value='<?php echo $points_poss ?>'readonly='true' /><br/>
	<input type='submit' value='Submit'/><input type='hidden' value='1' name='submitted'/><br/>
	<a href="grade_list_assignment.php">Back to list</a>
</form>
</p>


<?php
include_once('../footer.php');
?>