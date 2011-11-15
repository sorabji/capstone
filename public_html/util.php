<?php
function spit_table($headers, $resource){
  echo("<table border='1' >\n<tr>");
  foreach($headers as $head){
    echo("<th>$head</th>\n");
  }
  echo("</tr>");

  while($row = mysql_fetch_array($resource)){
    echo("<tr>\n");
    foreach($row as $key => $value) {
      $row[$key] = stripslashes($value);
    }
    foreach($cols as $val) {
      echo("<td valign='top'>$val</td");
    }
    echo("</tr>\n</table>");
  }
}
?>