<?php
include_once('util.php');
$a = new Access();
$a->logout();

header("Location: ".$root."login.php");
exit();
?>