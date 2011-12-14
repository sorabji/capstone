<?php
  $sql = "select title, id, isOpen from quizzes where course_id = (select course_id from sections where id = (select sec_id from students where id='".$_SESSION['user']."')) and isOpen = 1";

$res = mysql_query($sql);
$open_quizzes = array();

while($row = mysql_fetch_assoc($res)){
    $vals = array(
      'id'=>$row['id'],
      'title'=>$row['title']);
    array_push($open_quizzes,$vals);
}
?>
<script type='text/javascript'>
  $(function (){
      $('#quiz_awesome').css('background','#c30');
    });
</script>

  <li><a href="#" class="selected">Site</a>
    <ul>
      <li><a href="<?php echo($root . 'index.php');?>">Home</a></li>
      <li><a href="<?php echo($root . 'logout.php');?>">Logout</a></li>
    </ul>
    <div class="clear"></div>
  </li>
  <li><a href="#" class="selected">Grades</a>
    <ul>
      <li><a href="<?php echo($root . 'index.php');?>">Home</a></li>
      <li><a href="<?php echo($root . 'logout.php');?>">Logout</a></li>
    </ul>
    <div class="clear"></div>
  </li>
  <li><a href="#" class="selected">Attendance</a>
    <ul>
      <li><a href="<?php echo($root . 'index.php');?>">Home</a></li>
      <li><a href="<?php echo($root . 'logout.php');?>">Logout</a></li>
    </ul>
    <div class="clear"></div>
  </li>
  <li><a href="#" class="selected">Assignments</a>
    <ul>
      <li><a href="<?php echo($root . 'index.php');?>">Home</a></li>
      <li><a href="<?php echo($root . 'logout.php');?>">Logout</a></li>
    </ul>
    <div class="clear"></div>
  </li>
  <li><a href="#" >Messages</a>
    <ul>
      <li><a href="<?php echo($root . 'email/emails.php');?>">View Messages</a></li>
    </ul>
    <div class="clear"></div>
  </li>
  <?php if(count($open_quizzes)): ?>
  <li><a href="#" class="selected" id='quiz_awesome' >OPEN QUIZZES!</a>
    <ul>
<?php
foreach($open_quizzes as $key=>$value){
  echo "<li><a href='".$root."exam/do_test.php?q_id=";
  echo $value['id']."'>".$value['title']."</a></li>";
}
?>
    </ul>
    <div class="clear"></div>
  </li>
  <?php endif; ?>