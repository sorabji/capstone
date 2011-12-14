<?php
if(!isset($_GET['quiz'])){
  echo "<p>no good, need the quiz id</p>";
} else {
  if(!isset($_GET['quest'])){
    echo "<p>no good, need a question number</p>";
  } else {
    $quiz = $_GET['quiz'];
    $quest = $_GET['quest'];
    $sql = "delete from questions where quiz_id = %d and quest_num = %d";
    $res = mysql_query(sprintf($sql, $quiz, $quest));
    echo (mysql_affected_rows()) ? "<p>Deleted row.</p>" : "<p>No good.</p>";
    echo "<a href='".$root."exam/questions_list.php?q_id=".$_POST['quiz_id']."'>Back To Listing</a>";
  }
}

?>