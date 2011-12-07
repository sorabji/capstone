<?php

include('../util.php'); 
include_once('../header.php');


connect();

$id = $_GET['id']; 

$qry = "DELETE FROM assignments WHERE id = '$id'"; //delete statement

mysql_query($qry) or die(mysql_error()); //delete command
if(mysql_affected_rows())
{
	
	echo "Assignment deleted";
}
else
{
	echo "Nothing deleted";
}
?>
<br/>
<a href="<?php echo ($root . 'assignments/assignment_list.php');?>">Back to listing</a>
<?php
include_once('../footer.php');
?>