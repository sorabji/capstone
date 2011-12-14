<link rel='stylesheet' type = 'text/css' href="../static/style.css"/>

<?php
include_once('../header.php');

if(isset($_POST['submitted']))
{
	$link = connect();
	
	$id = $_POST['id'];
	
	$resource = mysql_query("select * from quiz_grades inner join quizzes on quiz_grades.quiz_id = quizzes.id where quiz_grades.sec_id = '$id'", $link);
	
	$list=new AssignmentGrade(true);
	$list->quizList($resource);
}
else
{
	$link = connect();
	echo('View quiz grades by section:');
	$resource = mysql_query("select id, course_id, sec from sections order by course_id", $link);
	echo('<form action="" method="POST"> <select name="id">');
	
	while($row = mysql_fetch_array($resource))
	{
		echo("<option name = 'id' value = '" . $row['id'] ."'>" . $row['course_id'] . " | " .$row['sec'] ."</option>");
	}	
	
	echo('</select> <input type="submit" value="Go"/></p><input type="hidden" value="1" name="submitted"/></form>');
	
}
	
?> 

<?php	
include_once('../footer.php');
?>