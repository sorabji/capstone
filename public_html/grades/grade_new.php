<link rel='stylesheet' type = 'text/css' href="../static/style.css"/>

<?php
include_once('../header.php');

function popBox()
{
	
}



if(isset($_POST['submitted']))
{
	$link = connect();
	
	$id = $_POST['id'];
	
	
	
}
else
{
	$link = connect();
	echo('Pick a section');
	$resource = mysql_query("select id, course_id, sec from sections order by course_id", $link);
	echo('<form action="" method="POST"> <select name="id">');
	
	while($row = mysql_fetch_array($resource))
	{
		echo("<option name = 'id' value = '" . $row['id'] ."'>" . $row['course_id'] . " | " .$row['sec'] ."</option>");
	}	
	
	echo('<input type="hidden" value="1" name="submitted"/>');
	$selected = 
}

?>
<select name="students" id="students"/>
<?php
	$sql = ""
</select>
</form>
<a href="grade_list.php">Back</a>

<?php

include_once('../footer.php');
?>