<link rel='stylesheet' type='text/css' href="../static/style.css" />
<!--<link rel='stylesheet' type='text/css' href="../form_testing.css" />-->

<?php
include('../header.php');
include('../config.php'); 
include('../util.php');

echo "<p>Beginning of Table</p>";

$att = new Daily_Record(true);

if (isset($_POST['submit'])) { 
//if (false){

  connect();

  $fin = $att->get_update_qry($_POST);

  mysql_query($fin) or die(mysql_error()); 
  //echo($fin);
  if($fin){
    echo "<p>Records Updated.</p><br />";
    echo "<a href='record_list.php'>Back To Attendance Records</a>";
  } else {
    echo("nothing added");
  }
} else {
  $att->new_display();

}
echo "<p>End of Table</p>";
//include('../footer.php');
?>
