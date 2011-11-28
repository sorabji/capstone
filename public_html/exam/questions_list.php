
<?php

include_once('../util.php');
include_once('../header.php');

$link = connect();
$resource = mysql_query("select * from questions", $link);
	   
$quest = new Question(true);
$quest->list_display($resource);


include_once('../footer.php');
?>
