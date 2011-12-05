<link rel='stylesheet' type='text/css' href="../static/style.css" />


<?php



include_once('../header.php');

$link = connect();
$resource = mysql_query("select * from absences", $link);
	   
$absence = new Absences(true);
$absence->list_display($resource);

include_once('../footer.php');
?>
