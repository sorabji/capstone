<link rel='stylesheet' type='text/css' href="../static/style.css" />


<?php



include('../header.php');
include('../util.php');
$link = connect();
$resource = mysql_query("select * from people", $link);
	   
$peeps = new People_Table(true);
$peeps->list_display($resource);

include('../footer.php');
?>
