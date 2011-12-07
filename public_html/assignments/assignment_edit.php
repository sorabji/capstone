<?php

include('../util.php');
include_once('../header.php');

echo "<p>Edit existing assignments</p>";

if (isset($_GET['id'])) //updated
{
	$nId = $assignment['id'];
	$secId = $assignment['sec_id'];
	$assignmentTitle = $assignment['title'];
	$points = $assignment['points_poss'];
	
	
	
	
	//$row = mysql_fetch_array(mysql_query("select * from 'Array' where 'id = '$id' "));
	
	$id = $_GET['id'];
	
	$assignment = @mysql_query("select id, sec_id, title, points_poss from assignments where id = '$id'");
	if (!$assignment)
	{
		exit('<p>Error fetching assignment details: ' . mysql_error() . '</p>');
	}
	
	
	
	
	
	
	
	
}
else
	{
		
	}
?>

<form action='' method='POST'>
	<b>Assignment ID: </b><input type='text' name='ass_id' value='<?php $row['id'] ?>' readonly='true'/><br/>
	<b>Section ID: </b><input type='text' name='section_id' value='' /><br/>
	<b>Assignment Title: </b><input type='text' name='title' value='' /><br/>
	<b>Points Possible: </b><input type='text' name='points' value='' /><br/>
	<input type='submit' value='Submit'/><input type='hidden' value='1' name='submitted'/>
</form>

<?php
include_once('../footer.php');
?>