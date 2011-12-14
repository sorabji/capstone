<link rel='stylesheet' type = 'text/css' href="../static/style.css"/>

<?php
//section numbers are linked wrong.

include_once('../header.php');

$link = connect();

echo ('<p>List of ALL grades<br/>');


echo('</p>');

$resource = mysql_query("select * from ass_grades inner join assignments on ass_grades.ass_id = assignments.id order by ass_grades.sec_id", $link);
$grades = new AssignmentGrade(true);
$grades->list_display($resource);


?>
<a href="grade_list.php">Back</a>
<?php
include_once('../footer.php');
?>