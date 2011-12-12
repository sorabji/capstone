<link rel='stylesheet' type = 'text/css' href="../static/style.css"/>

<?php

include_once('../header.php');
include_once('../util.php');

$link = connect();

echo('<p>View grades by section:');//dropbox of sections
	$resource = mysql_query("select id, course_id, sec from sections order by course_id", $link);
	echo('<select>');
	while($row = mysql_fetch_array($resource))
	{
		echo("<option value = '" . $row['id'] ."'>" . $row['course_id'] . " | " .$row['sec'] ."</option>");
	}
	echo('</select> <input type="button" value="Go"/>');
	
echo('</p>');
echo ('<p>View grades by student:');//dropbox of students
$resource = mysql_query("SELECT first_name, last_name, people.id from people INNER JOIN students ON people.id = students.student_id", $link);
echo ('<select>');
while($row = mysql_fetch_array($resource))
{
	echo("<option value = '" . $row['people.id'] ."'>" . $row['first_name'] ." " .$row['last_name'] ."</option>");
}
echo('</select> <input type="button" value="Go" />');


//stuff!!!!


echo ('<p>List of assignment grades<br/>');


$resource = mysql_query("select * from ass_grades", $link);
echo('</p>');

$grades = new AssignmentGrade(true);
$grades->list_display($resource);


?>

<?php	
include_once('../footer.php');
?>