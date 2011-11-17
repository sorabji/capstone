<link rel='stylesheet' type='text/css' href="../static/style.css" />

<?php
include('../header.php');
include('../config.php'); 
include('../util.php');
/* use sprintf(query, values**) to build query */
$peeps = new People_Table($ed_flag=true);

if (isset($_POST['submit'])) { 
//if (false){

  $fin = $peeps->get_update_qry($_POST);
  echo($fin);
  
  echo("<p>hi i'm here</p>");
  //mysql_query($sql) or die(mysql_error()); 
  /* $res = $peeps->do_insert($_POST); */
  /* if($res){ */
  /*   echo "Added row.<br />";  */
  /*   echo "<a href='list.php'>Back To Listing</a>";  */
  /* } else { */
  /*   echo("nothing added"); */
  /* } */
} else {
  $peeps->new_display();

}
include('../footer.php');
?>
