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
<?php
  if(3 == $navver){
    include('nav_admin.php'); /* admin's navbar */
  } elseif(2 == $navver){
    include('nav_instructor.php'); /* instructor's navbar */
  } elseif(1 == $navver){
    include('nav_stud.php'); /* student's navbar */
  } else {
    /* default navbar (not logged in) */
    /* blank is just fine i think */
  }
?>
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
