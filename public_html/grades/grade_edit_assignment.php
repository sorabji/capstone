<?php
	include_once('../header.php');
	
	$connect = @mysql_connect('localhost', 'marcus', 'blank');
	
	if(!$connect)
	{
		exit('<p> Unable to connect to server....Try again!</p>');
	}
	
	if(!mysql_select_db('capstone')
	{
		exit ('<p> Unable to connect to database....try again!</p>');
	}
	
	if(isset($_POST['ass_id'])) //already updated
	{
		$ass_id = $_POST['ass_id'];
		$student_id = $_POST['student_id'];
		$sec_id = $_POST['sec_id'];
		$pts = $_POST['points_poss'];
		
		$sql = "update ass_grades set
		ass_id = '$ass_id',
		student_id = '$student_id',
		sec_id = '$sec_id',
		points_poss = '$pts'
		where ass_id = '$ass_id'";
		
		if(@mysql_query($sql)
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
		$ass_id = $_POST['ass_id'];
		
		$grade = @mysql_query("select * from ass_grades where ass_id = '$ass_id'");
		
		if(!$grade)
		{
			exit ('<p> Error getting assignment ' . mysql_error() . '</p>');
		}
		
		$grade = mysql_fetch_array($grade);
		
		$sec_id = $grade['sec_id'];
		$student_id = $grade['student_id'];
		$ass_id = $grade['ass_id'];
		$pts = $grade['points_poss'];
		
		$sec_id = htmlspecialchars($sec_id);
		$student_id = htmlspecialchars($student_id);
		$ass_id = htmlspecialchars($ass_id);
		$pts = htmlspecialchars($points_poss);
		
	}
?>




<?php
include_once('../footer.php');
?>