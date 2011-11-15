<? 
include('config.php'); 
if (isset($_GET['id']) ) { 
  $id = (int) $_GET['id']; 
  if (isset($_POST['submitted'])) { 
    foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
    $sql = "UPDATE `Array` SET  `name` =  '{$_POST['name']}' ,  `indication` =  '{$_POST['indication']}' ,  `counsler` =  '{$_POST['counsler']}' ,  `date` =  '{$_POST['date']}' ,  `diagnosticProcedure` =  '{$_POST['diagnosticProcedure']}' ,  `race` =  '{$_POST['race']}' ,  `site` =  '{$_POST['site']}'   WHERE `id` = '$id' "; 
    mysql_query($sql) or die(mysql_error()); 
    echo (mysql_affected_rows()) ? "Edited row.<br />" : "Nothing changed. <br />"; 
    echo "<a href='list.php'>Back To Listing</a>"; 
  } 
  $row = mysql_fetch_array ( mysql_query("SELECT * FROM `Array` WHERE `id` = '$id' ")); 
?>

<form action='' method='POST'> 
<p><b>Name:</b><br /><input type='text' name='name' value='<?= stripslashes($row['name']) ?>' /> 
   <p><b>Indication:</b><br /><input type='text' name='indication' value='<?= stripslashes($row['indication']) ?>' /> 
   <p><b>Counsler:</b><br /><input type='text' name='counsler' value='<?= stripslashes($row['counsler']) ?>' /> 
   <p><b>Date:</b><br /><input type='text' name='date' value='<?= stripslashes($row['date']) ?>' /> 
   <p><b>DiagnosticProcedure:</b><br /><input type='text' name='diagnosticProcedure' value='<?= stripslashes($row['diagnosticProcedure']) ?>' /> 
   <p><b>Race:</b><br /><input type='text' name='race' value='<?= stripslashes($row['race']) ?>' /> 
   <p><b>Site:</b><br /><input type='text' name='site' value='<?= stripslashes($row['site']) ?>' /> 
<p><input type='submit' value='Edit Row' /><input type='hidden' value='1' name='submitted' /> 
</form> 
   <? } ?> 
