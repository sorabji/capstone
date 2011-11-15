<? 
include('config.php'); 
echo "<table border=1 >"; 
echo "<tr>"; 
echo "<td><b>first_name</b></td>"; 
echo "<td><b>last_name</b></td>"; 
echo "<td><b>address</b></td>"; 
echo "<td><b>email</b></td>"; 
echo "<td><b>phone</b></td>"; 
echo "<td><b>username</b></td>"; 
//echo "<td><b>Race</b></td>"; 
//echo "<td><b>Site</b></td>"; 
echo "</tr>"; 
$result = mysql_query("SELECT * FROM `people`") or trigger_error(mysql_error()); 
while($row = mysql_fetch_array($result)){ 
  foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 
  echo "<tr>";  
  echo "<td valign='top'>" . nl2br( $row['first_name']) . "</td>";  
  echo "<td valign='top'>" . nl2br( $row['last_name']) . "</td>";  
  echo "<td valign='top'>" . nl2br( $row['address']) . "</td>";  
  echo "<td valign='top'>" . nl2br( $row['email']) . "</td>";  
  echo "<td valign='top'>" . nl2br( $row['phone']) . "</td>";  
  echo "<td valign='top'>" . nl2br( $row['username']) . "</td>";  
  //echo "<td valign='top'>" . nl2br( $row['race']) . "</td>";  
  //echo "<td valign='top'>" . nl2br( $row['site']) . "</td>";  
  echo "<td valign='top'><a href=edit.php?id={$row['id']}>Edit</a></td><td><a href=delete.php?id={$row['id']}>Delete</a></td> "; 
  echo "</tr>"; 
} 
echo "</table>"; 
echo "<a href=new.php>New Row</a>"; 
?>