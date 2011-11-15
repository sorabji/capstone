<? 
include('config.php'); 
if (isset($_POST['submitted'])) { 
  foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
  $sql = "INSERT INTO `people` ( `first_name` ,  `last_name` ,  `address` ,  `email` ,  `phone` ,  `social` ,  `username` , `password` ) VALUES(  '{$_POST['first_name']}' ,  '{$_POST['last_name']}' ,  '{$_POST['address']}' ,  '{$_POST['email']}' ,  '{$_POST['phone']}' ,  '{$_POST['social']}' ,  '{$_POST['username']}' , '{$_POST['password']}'  ) "; 
  mysql_query($sql) or die(mysql_error()); 
  echo "Added row.<br />"; 
  echo "<a href='list.php'>Back To Listing</a>"; 
} 
?>

<form action='' method='POST'> 
  <p><b>first_name:</b><br /><input type='text' name='first_name'/> 
  <p><b>last_name:</b><br /><input type='text' name='last_name'/> 
  <p><b>address:</b><br /><input type='text' name='address'/> 
  <p><b>email:</b><br /><input type='text' name='email'/> 
  <p><b>phone:</b><br /><input type='text' name='phone'/> 
  <p><b>social:</b><br /><input type='text' name='social'/> 
  <p><b>username:</b><br /><input type='text' name='username'/> 
  <p><b>password:</b><br /><input type='password' name='password'/> 
<p><input type='submit' value='Add Row' /><input type='hidden' value='1' name='submitted' /> 
</form> 



