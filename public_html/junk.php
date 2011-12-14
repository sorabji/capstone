<?php
include('header.php');

$a = new Quiz('cis7586',1);
$a->calc_correct();

include('footer.php');
?>