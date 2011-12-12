<link rel='stylesheet' type = 'text/css' href="../static/style.css"/>

<?php
include_once('../header.php');
include_once('../util.php');

if(isset($_POST['people.id']))
{
	$first = $_POST['first_name'];
	$last = $_POST['last_name'];
	$id = $_POST['people.id'];
	
	
}
else
{
	echo('<p>Error.');
}




/*echo ('<p>List of assignment grades<br/>');

$link = connect();
$resource = mysql_query("select * from ass_grades", $link);
echo('</p>');

$grades = new AssignmentGrade(true);
$grades->list_display($resource);
*/
?>

<?php	
include_once('../footer.php');
?>