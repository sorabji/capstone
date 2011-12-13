<?php 
include_once('util.php');
connect();
$a = new Access();
$navver = $a->get_user_a_level();
unset($a);

?>

<html>

<head>
<link rel='stylesheet' type='text/css' href="<?php echo($root . 'static/style.css');?>" />
   <link rel='stylesheet' type='text/css' href="<?php echo($root . 'form_testing.css');?>" />
   <link rel='stylesheet' type='text/css' href="<?php echo($root . 'static/droppy.css');?>" />

   <script type="text/javascript"
     src="//ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
   <script type="text/javascript"
     src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.10/jquery-ui.min.js"></script>
   <script type="text/javascript" src="<?php echo($root . 'js/jquery.droppy.js');?>"></script>

<script type="text/javascript">
$(function(){
    $('#nav').droppy({speed: 250});
});

$(function(){
    $('#nav2').droppy({speed: 250});
});
</script>

<title>Papa Bear</title>
</head>
<body>
<div class='head'>

   <h1>Papa Bear</h1>
   <div class='metanav'>

   <div class='left_menu'>
   <ul id="nav">
<?php if(3 == $navver): /* admin's navbar */ ?>

  <li><a href="#" class="selected">Site</a>
    <ul>
      <li><a href="<?php echo($root . 'index.php');?>">Home</a></li>
      <li><a href="<?php echo($root . 'logout.php');?>">Logout</a></li>
    </ul>
    <div class="clear"></div>
  </li>
  <li><a href="#" class="selected">People</a>
    <ul>
      <li><a href="<?php echo($root . 'people/people_new.php');?>">New Person</a></li>
      <li><a href="<?php echo($root . 'people/people_edit.php');?>">Edit Person</a></li>
      <li><a href="<?php echo($root . 'people/people_delete.php');?>">Delete Person</a></li>
      <li><a href="<?php echo($root . 'people/people_list.php');?>">View Persons</a></li>
    </ul>
    <div class="clear"></div>
  </li>
  <li><a href="#" >Courses</a>
    <ul>
      <li><a href="<?php echo($root . 'courses/course_new.php');?>">New Course</a></li>
      <li><a href="<?php echo($root . '#');?>">Edit Course</a></li>
      <li><a href="<?php echo($root . '#');?>">Delete Course</a></li>
      <li><a href="<?php echo($root . '#');?>">View Courses</a></li>
    </ul>
    <div class="clear"></div>
  </li>
  <li><a href="#" >Grades</a>
    <ul>
      <li><a href="<?php echo($root . '#');?>">New Record</a></li>
      <li><a href="<?php echo($root . '#');?>">Edit Record</a></li>
      <li><a href="<?php echo($root . '#');?>">Delete Record</a></li>
      <li><a href="<?php echo($root . '#');?>">View Grades</a></li>
    </ul>
    <div class="clear"></div>
  </li>
  <li><a href="#" >Attendance</a>
    <ul>
      <li><a href="<?php echo($root . 'attendance/record_new.php');?>">New Record</a></li>
      <li><a href="<?php echo($root . 'attendance/record_edit.php');?>">Edit Record</a></li>
      <li><a href="<?php echo($root . 'attendance/record_delete.php');?>">Delete Record</a></li>
      <li><a href="<?php echo($root . 'attendance/record_list.php');?>">View Records</a></li>
    </ul>
    <div class="clear"></div>
  </li>
  <li><a href="#" >Assignments</a>
    <ul>
      <li><a href="<?php echo($root . 'attendance/assignment_new.php');?>">New Assignment</a></li>
      <li><a href="<?php echo($root . '#');?>">Edit Record</a></li>
      <li><a href="<?php echo($root . '#');?>">Delete Record</a></li>
      <li><a href="<?php echo($root . 'attendance/assignment_list.php');?>">View Assignments</a></li>
    </ul>
    <div class="clear"></div>
  </li>
  <li><a href="#" >Quizzes</a>
    <ul>
      <li><a href="<?php echo($root . 'exam/manage_quizzes.php');?>">Manage Quizzes</a></li>
      <li><a href="<?php echo($root . 'exam/course_selection.php');?>">Examine Questions</a></li>
      <li><a href="<?php echo($root . 'exam/do_test.php');?>">Take a Quiz</a></li>
    </ul>
    <div class="clear"></div>
  </li>

<?php elseif(2 == $navver): /* instructor's navbar */ ?>

  <li><a href="#" class="selected">Site</a>
    <ul>
      <li><a href="<?php echo($root . 'index.php');?>">Home</a></li>
      <li><a href="<?php echo($root . 'logout.php');?>">Logout</a></li>
    </ul>
    <div class="clear"></div>
  </li>
  <li><a href="#" class="selected">Exams</a>
    <ul>
      <li><a href="<?php echo($root . 'exam/manage_quizzes.php');?>">Manage</a></li>
      <li><a href="<?php echo($root . 'exam/questions_list.php');?>">View</a></li>
      <li><a href="<?php echo($root . 'exam/questions_search.php');?>">Search</a></li>
    </ul>
    <div class="clear"></div>
  </li>

<?php elseif(1 == $navver): /* student's navbar */ ?>
<?php
  $sql = "select id, isOpen from quizzes where course_id = (select course_id from sections where id = (select sec_id from students where id='".$_SESSION['user']."'))";
$res = mysql_query($sql);
$open_quizzes = array();

while($row = mysql_fetch_assoc($res)){
  if(1 == $row['isOpen']){
    array_push($open_quizzes,$row['id']);
  }
}
?>

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
  <?php if(count($open_quizzes)): ?>
  <li><a href="#" class="selected">Quizzes</a>
    <ul>
      <li><a href="<?php echo($root . 'index.php');?>">Home</a></li>
      <li><a href="<?php echo($root . 'logout.php');?>">Logout</a></li>
    </ul>
    <div class="clear"></div>
  </li>
  <?php endif; ?>
<?php else: /* default navbar (not logged in) */ ?>

<?php endif; ?>
</ul>
<div class="clear"></div>   
</div> <!-- ends 'left_menu' -->
   <div class='right_menu'>

   </div>

   <hr />
   <!--<img class='fuck' alt='logo' src="<?php echo($root . 'static/logo.jpg');?>" />-->
   </div> <!-- ends 'metanav' -->
   </div> <!-- ends 'head' -->
   <div class='page'>
