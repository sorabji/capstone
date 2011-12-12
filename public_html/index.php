<?php 
include_once('header.php');

$a = new Access(1,$root);
//$a->logout();
$a->do_eet();

echo "<p>Welcome to Papa Bear</p>";


include_once('footer.php');
?>
