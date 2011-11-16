<html>
<head>
</head>
<body>
<?php
include('../config.php');
include('../util.php');
$link = connect();
$resource = mysql_query("select * from people", $link);
	   
$peeps = new People_Table($ed_id=true);
//$peeps->list_display();

echo("<table border='1' >\n<tr>");
    foreach($peeps->list_headers as $head){
      echo("<th>$head</th>\n");
    }
    echo("</tr>");

    $resource = mysql_query("select * from people", $link);
    while($row = mysql_fetch_array($resource)){
      echo("<tr>\n");
      foreach($row as $key => $value) {
	$row[$key] = stripslashes($value);
      }
      foreach($peeps->list_table_cols as $val) {
	echo("<td valign='top'>{$row[$val]}</td>");
      }
      if($ed_flag){
	echo("<td valign='top'><a href=people_edit.php?id={$row[$this->ID]}>Edit</a></td>\n");
	echo("<td valign='top'><a href=people_delete.php?id={$row[$this->ID]}>Delete</a></td>\n");
      }
      echo("</tr>\n</table>");
    }
?>
</body>
</html>