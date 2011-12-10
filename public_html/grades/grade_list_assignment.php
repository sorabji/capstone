<link rel='stylesheet' type = 'text/css' href="../static/style.css"/>

<?php
include_once('../header.php');
include_once('../util.php');

echo ('<p>List of assignment grades<br/>');

$link = connect();
$resource = mysql_query("select * from ass_grades", $link);
echo('</p>');

$grades = new AssignmentGrade(true);
$grades->list_display($resource);
?>

<?php	
include_once('../footer.php');
?>