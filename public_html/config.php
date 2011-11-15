<?php 
// connect to db
$link = mysql_connect('localhost', 't3st3r', '123qwe123qwe');
if (!$link) {
  die('Not connected : ' . mysql_error());
} else {
  //echo("fucking fuck");
}

if (! mysql_select_db('capstone') ) {
  die ('Can\'t use capstone : ' . mysql_error());
}?>