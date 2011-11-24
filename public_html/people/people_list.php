<link rel='stylesheet' type='text/css' href="../static/style.css" />


<?php



include_once('../header.php');

$link = connect();
$resource = mysql_query("select * from people", $link);
	   
$peeps = new People(true);
$peeps->list_display($resource);

include_once('../footer.php');
?>
