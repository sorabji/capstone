<?php
//works but double check after list is fixed.

include('../header.php');

connect();

$ass_id = $_GET['id'];

$sql = "DELETE FROM ass_grades WHERE ass_id = '$ass_id'";

mysql_query($sql) or die (mysql_error());

if(mysql_affected_rows()) echo "Assignment Deleted.";
else echo "Nothing deleted.";

?>

<br/>
<a href = "<?php echo ($root . 'grades/grade_list_assignment.php');?>">Back to grade list</a>

<?php
include_once('../footer.php');
?>