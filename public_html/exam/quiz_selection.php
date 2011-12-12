
<?php

include_once('../header.php');
$a = new Access(2,$root);
$a->do_eet();

if(isset($_POST['submit'])):
  header("Location: ".$root."exam/questions_list.php?q_id=".$_POST['q_id']);
else:
  if(isset($_GET['c_id'])){
    $c_id = $_GET['c_id'];
  } else {
    $c_id = false;
  }
if(!$c_id):
  echo "<p class='error'>you must select a course before you select a quiz</p>";
  echo "<p>Go to the quiz selection <a href='".$root."exam/course_selection.php'>page</a> and try again</p>";
else:
  $sql = "select id, title from quizzes where course_id = '$c_id'";
?>
<p>Select the Quiz</p>
<form id='form' method='POST' action=''>
  <div class='required'>
  <select id='q_id' name='q_id'>

<?php

  $res = mysql_query($sql);
  while($row = mysql_fetch_array($res)){
    echo "<option value='{$row['id']}'>{$row['title']}</option>\n";
  }
?>
  </select>
</div>
<div class='submit'>
  <input type='submit' id='submit' name='submit' class='inputSubmit' value='View Questions' />
</div>
</form>

<?php
  endif;
  endif;
  include_once('../footer.php');
?>
