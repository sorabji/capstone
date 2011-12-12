<?PHP

include_once('../header.php');
$a = new Access(2,$root);
$a->do_eet();


if (isset($_POST['submit'])) {
  
  $q = new Question(true, $root);
  $sql = $q->get_update_qry($_POST);

  mysql_query($sql) or die(mysql_error());
  echo (mysql_affected_rows()) ? "Edited row.<br />" : "Nothing changed. <br />";
  echo "<a href='list.php'>Back To Listing</a>";
} else {
  if (!isset($_GET['quest']) and isset($_GET['quiz']) ) {
    echo "<p class='error'>figure it out wanker</p>";
  } else {
    $quiz = $_GET['quiz'];
    $quest = $_GET['quest'];
    $row = mysql_fetch_assoc( mysql_query("SELECT * FROM `questions` WHERE `quiz_id` = $quiz and `quest_num` = $quest "));
    //do_dump($row, $var_name='row');    
    $q = new Question(true, $root);
    $q->edit_display($row);
  }
}

include_once('../footer.php');

?>
