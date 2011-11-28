
<?php

include_once('../util.php');
include_once('../header.php');

$link = connect();

if(!empty($_POST['submit'])){
  // insert answer in quiz_quest_grades
} else if(!empty($_POST['skip'])){
  // append to skipped array in $_SESSION[]
} 

if(!empty($_SESSION['cur_quest'])){
  $_SESSION['cur_quest'] .= 1;
  $cur_quest = mysql_fetch_array(mysql_query("select * from questions where " . 
		 "`quiz_id` = 1 and `quest_num` = `{$_SESSION['cur_quest']}`"));
} else {
  $_SESSION['cur_quest'] = 1;
  $cur_quest = mysql_fetch_array(mysql_query("select * from questions where " . 
		 "`quiz_id` = 1 and `quest_num` = {$_SESSION['cur_quest']}", $link));
  echo(mysql_error());
}


$cur_quest = mysql_query('select * from questions where `quiz_id` = 1 and `quest_num` = 1', $link);
$quiz = new Question(true);

echo(mysql_error());
if($cur_quest){
  $cur_quest = mysql_fetch_array($cur_quest);
  $quiz->do_question($cur_quest);
} else {
  // done w/ test...wat?
}


include_once('../footer.php');
?>
