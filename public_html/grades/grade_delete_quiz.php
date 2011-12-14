<?php

include('../header.php');

connect();

$quiz_id = $_GET['id'];

$sql = "DELETE FROM quiz_grades WHERE quiz_id = '$quiz_id'";

mysql_query($sql) or die (mysql_error());

if(mysql_affected_rows()) echo "Quiz Deleted.";
else echo "Nothing deleted.";

?>

<br/>
<a href = "<?php echo ($root . 'grades/grade_list_quiz.php');?>">Back to grade list</a>

<?php
include_once('../footer.php');
?>