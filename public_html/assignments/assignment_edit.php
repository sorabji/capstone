<?php
include('../util.php');
include_once('../header.php');

$connect = @mysql_connect('localhost', 'marcus', 'blank');

if (!$connect)
{
	exit ('<p> unable to connect to server.</p>');
}

if(!mysql_select_db('capstone'))
{
	exit ('<p>unable to locate database</p>');
}

if (isset($_POST['id'])) //assignment has been updated
{
	$id = $_POST['id'];
	$sid = $_POST['sid'];
	$title = $_POST['title'];
	$points = $_POST['points'];
	
	$sql = "UPDATE assignments SET
	id = '$id',
	sec_id = '$sid',
	title = '$title',
	points_poss = '$points'
	WHERE id = '$id'";
	
	if(@mysql_query($sql))
	{
		echo '<p>Assignment updated</p>';
	}
	else
	{
		echo '<p>Error updating ' . mysql_error() . '</p>';
	}
	echo '<p><a href = "assignment_list.php">Return to Assignment List</a></p>';
}
	

else //user can update assignment
{
	$id = $_GET['id'];
		
	$assignment = @mysql_query("SELECT id, sec_id, title, points_poss FROM assignments WHERE id = '$id'");
	
	if(!$assignment)
	{
		exit ('<p>Error getting assignment. ' .mysql_error() . '.</p>');
	}
	
	$assignment = mysql_fetch_array($assignment);
	
	$id = $assignment['id'];
	$sid = $assignment['sec_id'];
	$title = $assignment['title'];
	$points = $assignment['points_poss'];
	
	$id = htmlspecialchars($id);
	$sid = htmlspecialchars($sid);
	$title = htmlspecialchars($title);
	$points = htmlspecialchars($points);
	
}
?>



<form action='' method='POST'>
	<b>Assignment ID: </b><input type='text' name='id' value='<?php echo $id ?>' readonly='true'/> Cannot edit Assignment ID<br/>
	<b>Section ID: </b><input type='text' name='sid' value='<?php echo $sid?>' /><br/>
	<b>Assignment Title: </b><input type='text' name='title' value='<?php echo $title ?>' /><br/>
	<b>Points Possible: </b><input type='text' name='points' value='<?php echo $points ?>' /><br/>
	<input type='submit' value='Submit'/><input type='hidden' value='1' name='submitted'/>
</form>

<?php
include_once('../footer.php');

?>