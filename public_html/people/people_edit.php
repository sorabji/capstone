<?php
include_once('../header.php');
$a = new Access(3,$root);
$a->do_eet();


if (isset($_POST['submit'])) {
  
  $q = new People(true, $root);
  $sql = $q->get_update_qry_real($_POST);
  
  mysql_query($sql) or die(mysql_error());
  echo (mysql_affected_rows()) ? "Edited row.<br />" : "Nothing changed. <br />";
  echo "<a href='".$root."people/people_list.php'>Back To Listing</a>";
} else {
  if (!isset($_GET['id']) ){
    echo "<p class='error'>figure it out wanker</p>";
  } else {
    $id = $_GET['id'];
    $query = "select * from people where id = %d";

    $row = mysql_fetch_assoc( mysql_query(sprintf($query, $id)));

    $q = new People(true, $root);
    $q->edit_display($row);
  }
}

include_once('../footer.php');


