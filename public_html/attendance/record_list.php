<?php
	include_once('../util.php');
	include_once('../header.php');

	$link = connect();
	$resource = mysql_query("select * from absences, people", $link);
		   
	$absences = new Absent(true);
	$absences->list_display($resource);

	include_once('../footer.php');
?>
