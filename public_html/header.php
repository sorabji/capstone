<?php include_once('util.php'); ?>
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
       $('#nav').droppy({speed: 50});
     });
</script>
<script type="text/javascript">
   $(function(){
       $('#nav2').droppy({speed: 50});
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
   <li><a href="index.php">Home</a></li>
   <li><a href="#" class="selected">People</a>
     <ul>
     <li><a href="<?php echo($root . 'people/people_new.php');?>">New Person</a></li>
     <li><a href="<?php echo($root . 'people/people_edit.php');?>">Edit a Person</a></li>
     <li><a href="<?php echo($root . 'people/people_delete.php');?>">Delete some peeps</a></li>
     <li><a href="<?php echo($root . 'people/people_list.php');?>">View all peeps</a></li>
     </ul>
     <div class="clear"></div>
   </li>
   <li><a href="#" >Courses</a>
     <ul>
     <li><a href="<?php echo($root . 'people/people_new.php');?>">New Person</a></li>
     <li><a href="<?php echo($root . 'people/people_edit.php');?>">Edit a Person</a></li>
     <li><a href="<?php echo($root . 'people/people_delete.php');?>">Delete some peeps</a></li>
     <li><a href="<?php echo($root . 'people/people_list.php');?>">View all peeps</a></li>
     </ul>
     <div class="clear"></div>
   </li>
   </ul>
   <div class="clear"></div>

   <div class='right_menu'>

   </div>

<hr />
<!--<img class='fuck' alt='logo' src="<?php echo($root . 'static/logo.jpg');?>" >-->
  </div>
</div>
</div>
<div class='page'>
