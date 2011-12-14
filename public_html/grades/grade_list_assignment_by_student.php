<link rel='stylesheet' type = 'text/css' href="../static/style.css"/>

<?php
include_once('../header.php');



if(isset($_POST['submitted']))
{
	$link = connect();
	

	$id = $_POST['id'];
	
	$resource = mysql_query("select * from ass_grades inner join assignments on ass_grades.ass_id = assignments.id where ass_grades.student_id = $id  order by ass_grades.sec_id", $link);
	
	$list = new AssignmentGrade(true);
	$list->studentList($resource);
	
}
else
{
	$link = connect();
	echo('View grades by student');
	$resource = mysql_query("SELECT first_name, last_name, people.id from people INNER JOIN students ON people.id = students.student_id", $link);
	echo ('<form name="student_form" action="grade_list_assignment_by_student.php" method="_POST"><br/><p>View grades by student:');//dropbox of students

	echo ('<select>');
	while($row = mysql_fetch_array($resource))
	{
		echo("<option value = '" . $row['people.id'] ."'>" . $row['first_name'] ." " .$row['last_name'] ."</option>");
	}
	
	echo('</select> <input type="submit" value="Go" />');
	echo('</p><input type="hidden" value = "1" name="submitted/>"</form>');
	
}




?>

<?php	
include_once('../footer.php');
?>