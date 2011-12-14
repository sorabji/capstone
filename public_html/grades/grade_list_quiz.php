<link rel='stylesheet' type = 'text/css' href="../static/style.css"/>

<?php

include_once('../header.php');


	$link = connect();
	
	
	$resource = mysql_query("select * from quiz_grades inner join quizzes on quiz_grades.quiz_id = quizzes.id", $link);
	
	echo('<p>List of ALL quizzes<br/>');
	
	$list = new AssignmentGrade(true);
	$list->quizList($resource);
	
	echo('</p>');





?>
<a href="grade_list.php">Back</a>
<?php	
include_once('../footer.php');
?>