<html>
<head>
</head>
<body>
<?php
include('config.php');
include('util.php');

$resource = mysql_query("select * from people");
	   
$peeps = new People_Table($ed_id=true);
$peeps->do_list($resource);
?>
</body>
</html>