
<?php

include_once('../header.php');

$resource = mysql_query("select * from questions");
	   
$quest = new Question(true);
$quest->list_display($resource);


include_once('../footer.php');
?>
