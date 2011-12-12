<link rel='stylesheet' type = 'text/css' href="../static/style.css"/>

<?php
include_once('../header.php');
include_once('../util.php');

if(isset($_POST['id']))
{
	$sql = "SELECT * from ass_grades INNER JOIN sections ON sections.id = ass_grades.sec_id";
	
	if(@mysql_query($sql))
	{
		$grades = new AssignmentGrade(true);
		$grades ->list_display_($resource);
	}
	else
	{
		echo('<p>Error' . mysql_error() . '</p>');
	}
	
}




/*
echo ('<p>List of assignment grades<br/>');

$link = connect();
$resource = mysql_query("select * from ass_grades", $link);
echo('</p>');

$grades = new AssignmentGrade(true);
$grades->list_display($resource);
?> */

<?php	
include_once('../footer.php');
?>