<?php
	//works
	include_once('../header.php');
		
	if(isset($_POST['submitted'])) //already updated
	{
		$quiz_id = $_POST['quiz_id'];
		$student_id = $_POST['student_id'];
		$sec_id = $_POST['sec_id'];
		$points_received = $_POST['points_received'];
		$points_poss = $_POST['points_poss'];
		
		$sql = "update quiz_grades set
		points_received = '$points_received'
		where student_id = '$student_id'";
		
		
		if(@mysql_query($sql))
		{
			echo ('<p>Quiz grade updated.</p>');
		}
		else
		{
			echo('<p>Error updating ' . mysql_error() . '</p>');
		}
		echo('<p><a href="grade_list_quiz.php">Return to list</a></p>');
	}
	else //needs to be updated
	{
		$quiz_id = $_GET['id'];
		
		$grade = @mysql_query("select * from quiz_grades inner join quizzes on quiz_grades.quiz_id = quizzes.id where quiz_id = '$quiz_id'");
		
		if(!$grade)
		{
			exit ('<p> Error getting quiz ' . mysql_error() . '</p>');
		}
		
		$grade = mysql_fetch_array($grade);
		
		$sec_id = $grade['sec_id'];
		$student_id = $grade['student_id'];
		$quiz_id = $grade['quiz_id'];
		$points_poss = $grade['points_poss'];
		$points_received = $grade['points_received'];
		
		$sec_id = htmlspecialchars($sec_id);
		$student_id = htmlspecialchars($student_id);
		$quiz_id = htmlspecialchars($quiz_id);
		$points_poss = htmlspecialchars($points_poss);
		$points_received = htmlspecialchars($points_received);
		
	}
?>
<p>Edit a student's grade:
<form action='' method='POST'>
	<b>Section ID: </b><input type='text' name='sec_id' value='<?php echo $sec_id ?>' readonly='true'/> Not editable<br/>
	<b>Student ID: </b><input type='text' name='student_id' value='<?php echo $student_id?>'readonly='true' /> Not editable<br/>
	<b>Assignment ID: </b><input type='text' name='quiz_id' value='<?php echo $quiz_id ?>' readonly='true'/> Not editable<br/>
	<b>Points: </b><input type='text' name='points_received' value='<?php echo $points_received ?>' /><br/>
	<b>Points Possible: </b><input type='text' name='points_poss' value='<?php echo $points_poss ?>'readonly='true' /> Not editable<br/>
	<input type='submit' value='Submit'/><input type='hidden' value='1' name='submitted'/><br/>
	<a href="grade_list_assignment_by_section.php">Back to list</a>
</form>
</p>


<?php
include_once('../footer.php');
?>