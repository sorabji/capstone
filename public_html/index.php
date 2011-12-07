<?php 

include_once('header.php');
connect();
$a = new Access(1);
$a->do_eet($root);

echo "<p>Welcome to Papa Bear</p>";


include_once('footer.php');
?>
