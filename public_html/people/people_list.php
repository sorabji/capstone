


<?php
include_once('../util.php');
include_once('../header.php');

$resource = mysql_query("select * from people");
	   
$peeps = new People(true);
$peeps->list_display($resource);

include_once('../footer.php');
?>
