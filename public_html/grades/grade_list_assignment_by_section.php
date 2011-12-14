<link rel='stylesheet' type = 'text/css' href="../static/style.css"/>

<?php

include_once('../header.php');


if(isset($_POST['submitted'])) //something has been selected, display it.
{
	$link = connect();
	//get all of the grades for the selected section.
	
	$id = $_POST['id'];
	
	$resource = mysql_query("select * from ass_grades inner join assignments on ass_grades.ass_id = assignments.id where ass_grades.sec_id = $id order by ass_grades.sec_id", $link);
	
	$list = new AssignmentGrade(true);
	$list->secList($resource);
	
	
	
	
}
else
{
	$link = connect();
	echo('View grades by section:');
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
$list_headers = array
	(
		"Student Id",
		"Section Id",
		"Assignment Id",
		"Points",
		"Title",
		"Points Possible"
	);
	

?>