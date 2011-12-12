
<?php

include_once('../header.php');
$a = new Access(2,$root);
//$a->logout();
$a->do_eet();

$resource = mysql_query("select * from questions");
	   
$quest = new Question(true);
$quest->list_display($resource);


include_once('../footer.php');
?>
