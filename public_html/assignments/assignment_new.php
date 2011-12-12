<?php

include('../util.php'); 
include_once('../header.php');

$assignment = new Assignment(true);

if(isset($_POST['submit'])) //if user has submitted form
{
	
	connect();
	$fin = $assignment->get_update_qry($_POST); //get insert statement
	mysql_query($fin) or die (mysql_error()); //insert to database
	
	if($fin)
	{
		echo('Added assignment');
		echo ('<br/><a href="assignment_list.php">Back To Assignments</a>');
	}
	else
	{
		echo('error');
	}
}
else //first visit, generate form with new_display()
{
	$assignment->new_display();
	
}

include_once('../footer.php');
?>