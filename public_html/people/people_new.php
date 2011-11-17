<link rel='stylesheet' type='text/css' href="../static/style.css" />
<!--<link rel='stylesheet' type='text/css' href="../form_testing.css" />-->

<?php
include('../header.php');
include('../config.php'); 
include('../util.php');


$peeps = new People_Table(true);

if (isset($_POST['submit'])) { 
//if (false){

  connect();

  $fin = $peeps->get_update_qry($_POST);

  mysql_query($fin) or die(mysql_error()); 
  //echo($fin);
  if($fin){
    echo "<p>Added Person.</p><br />";
    echo "<a href='people_list.php'>Back To People Listing</a>";
  } else {
    echo("nothing added");
  }
} else {
  $peeps->new_display();

}
//include('../footer.php');
?>
