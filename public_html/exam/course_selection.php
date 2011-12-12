
<?php

include_once('../header.php');
$a = new Access(2,$root);
$a->do_eet();

if(isset($_POST['submit'])):
  header("Location: ".$root."exam/quiz_selection.php?c_id=".$_POST['course_id']);
else:
?>

<form id='form' method='POST' action=''>
   <p>Select the course</p>
  <div class='required'>
  <select id='course_id' name='course_id'>

<?php
  $res = mysql_query("select id from courses;");
  while($row = mysql_fetch_array($res)){
    echo "<option value='{$row['id']}'>{$row['id']}</option>\n";
  }
?>
  </select>
</div>
<div class='submit'>
  <input type='submit' id='submit' name='submit' class='inputSubmit' value='View Quizzes' />
</div>
</form>

<?php
  endif;
  include_once('../footer.php');
?>
