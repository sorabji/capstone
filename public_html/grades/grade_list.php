<link rel='stylesheet' type = 'text/css' href="../static/style.css"/>

<?php
include_once('../header.php');

?>
<p>Grades:<br/></p>
<p><a href = "<?php echo ('grade_list_assignment.php');?>">Assignment Grades</a><br/>
<a href = "<?php echo ('grade_list_quiz.php');?>">Quiz Grades</a><br/>
<a href = "<?php echo ('grade_list_quiz_question.php');?>">Quiz Question Grades</a><br/></p>
	
<?php
include_once('../footer.php');
?>