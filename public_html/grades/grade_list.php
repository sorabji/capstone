<link rel='stylesheet' type = 'text/css' href="../static/style.css"/>

<?php
//works

include_once('../header.php');

?>
<p>Grades:<br/></p>

<p>
	<a href = "<?php echo ('grade_list_assignment.php');?>">All Assignment Grades</a>
	<li>
		<a href="grade_list_assignment_by_section.php">View grades by Section</a>
	</li>
	<li>
		<a href="grade_list_assignment_by_student.php">View grades by Student</a>
	</li>
	<li>
		<a href="grade_new.php">Grade an assignment</a>
	</li>
</p>

<p>
	<a href = "<?php echo ('grade_list_quiz.php');?>">All Quiz Grades</a><br/>
	<li>
		<a href="grade_list_quiz_by_section.php">View quizzes by Section</a>
	</li>
	<li>
		<a href="grade_list_quiz_by_student.php">View quizzes by Student</a>
	</li>
	
</p>

	
<?php
include_once('../footer.php');
?>