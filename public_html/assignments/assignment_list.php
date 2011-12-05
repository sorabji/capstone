<link rel='stylesheet' type='text/css' href="../static/style.css" />

<?php


include_once('../header.php');

echo('<p>List of assignments by section number.<br/>');

$link = connect();
$resource = mysql_query("select * from assignments order by sec_id", $link);
echo('<p>');
$assignments = new Assignment(true);
$assignments->list_display($resource);



include_once('../footer.php');
?>