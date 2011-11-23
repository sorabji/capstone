<link rel='stylesheet' type='text/css' href="../static/style.css" />
<!--<link rel='stylesheet' type='text/css' href="../form_testing.css" />-->

<?php
include('../header.php');
include('../util.php');


$c = new Course(true);

if (isset($_POST['submit'])) { 
//if (false){

  connect();

  $fin = $c->get_update_qry($_POST);

  mysql_query($fin) or die(mysql_error()); 
  //echo($fin);
  if($fin){
    echo "<p>Added Course.</p><br />";
    echo "<a href='course_list.php'>Back To Course Listing</a>";
  } else {
    echo("nothing added");
  }
} else {
  $c->new_display();

}
//include('../footer.php');
?>
