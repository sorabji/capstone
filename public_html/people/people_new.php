<html>
<head>
</head>
<body>
<?php
include('../config.php'); 
include('../util.php');
/* use sprintf(query, values**) to build query */
$peeps = new People_Table($ed_flag=true);

if (isset($_POST['submitted'])) { 
//if (false){

  // obviously, do more validation
  
  foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 

  $sql = "INSERT INTO `people` ( `first_name` ,  `last_name` ,  `address` ,  `email` ,  `phone` ,  `social` ,  `username` , `password` ) VALUES(  '{$_POST['first_name']}' ,  '{$_POST['last_name']}' ,  '{$_POST['address']}' ,  '{$_POST['email']}' ,  '{$_POST['phone']}' ,  '{$_POST['social']}' ,  '{$_POST['username']}' , '{$_POST['password']}'  ) "; 
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
?>

</body>
</html>