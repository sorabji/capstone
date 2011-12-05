<?php

include('../util.php'); 
include_once('../header.php');

$assignment = new Assignment(true);

if(isset($_POST['submit']))
{
	connect();
	$fin = $assignment->get_update_qry($_POST);
	mysql_query($fin) or die (mysql_error());
	
	if($fin)
	{
		echo('Added assignment');
		echo ('<a href="assignment_list.php">Back To Assignments</a>');
	}
	else
	{
		echo('error');
	}
}
else
{
	$assignment->new_display();
	
}

include_once('../footer.php');
?>