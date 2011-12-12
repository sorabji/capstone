
<?php
include_once('../header.php');

$a = new Access(3,$root);
//$a->logout();
$a->do_eet();

$peeps = new People(true);

if (isset($_POST['submit'])) { 
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
include('../footer.php');
?>
