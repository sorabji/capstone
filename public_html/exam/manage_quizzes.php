
<?php

include_once('../header.php');
$a = new Access(2,$root);
//$a->logout();
$a->do_eet();

?>
<script type="text/javascript" 
  src="lib/jquery.tablesorter/jquery.tablesorter.js"></script> 
<script type="text/javascript" 
  src="lib/jquery.tablesorter/addons/pager/jquery.tablesorter.pager.js"></script>

<script type="text/javascript">
  $(document).ready(function(){
      $(".tablesorter").tablesorter({
	    sortList: [[0,0]],
	    debug: true
	    }).tablesorterPager({
	      container: $("#pager")});
      $(".tablesorter").bind("sortEnd", function() {
	  $(".tablesorter tr").removeClass("alt");
	  $(".tablesorter tr:even").addClass("alt");
	});
      $(".tablesorter tr").mouseover(function(){
	  $(this).addClass("over");
	}).mouseout(function(){
	    $(this).removeClass("over");
	  });
    });  
</script>
<table border=1 class='tablesorter' id='results'>
<thead>
<tr>
  <th>Indication</th>
  <th>Counsler</th>
  <th>Date</th>
  <th>DiagnosticProcedure</th>
  <th>Race</th>
  <th>Site</th>
  <th colspan='2'>Admin</th>
</tr>
</thead>
<tbody>

<?php
if(isset($_GET['search'])){
  $qry = $_SESSION['search'];
}else {
  $qry = "select * from `patience`";
}
$result = mysql_query($qry) or trigger_error(mysql_error()); 

while($row = mysql_fetch_array($result)){ 
  foreach($row AS $key => $value) { 
    $row[$key] = stripslashes($value);
  } 

  echo "\t\t<tr>\n";
  echo "\t\t\t<td valign='top'>" . nl2br( $row['indication']) . "</td>\n";  
  echo "\t\t\t<td valign='top'>" . nl2br( $row['counsler']) . "</td>\n";  
  echo "\t\t\t<td valign='top'>" . nl2br( $row['date']) . "</td>\n";  
  echo "\t\t\t<td valign='top'>" . nl2br( $row['diagnosticProcedure']) . "</td>\n";  
  echo "\t\t\t<td valign='top'>" . nl2br( $row['race']) . "</td>\n";  
  echo "\t\t\t<td valign='top'>" . nl2br( $row['site']) . "</td>\n";  
  echo "\t\t\t<td valign='top'>\n\t\t\t\t<a href=edit.php?id={$row['id']}>Edit</a>\n\t\t\t</td>\n";
  echo "\t\t\t<td>\n\t\t\t\t<a href=delete.php?id={$row['id']} onclick='return sure_delete(\n);'>Delete</a>\n\t\t\t</td>\n"; 
  echo "\t\t</tr>\n"; 
}
echo "\t</tbody>\n";
echo "</table>\n"; 
?>
<br />
<div id="pager" class="pager">
  <form>
  <img src="lib/jquery.tablesorter/addons/pager/icons/first.png" class="first"/>
  <img src="lib/jquery.tablesorter/addons/pager/icons/prev.png" class="prev"/>
  <input type="text" class="pagedisplay"/>
  <img src="lib/jquery.tablesorter/addons/pager/icons/next.png" class="next"/>
  <img src="lib/jquery.tablesorter/addons/pager/icons/last.png" class="last"/>
  <select class="pagesize center ui-state-default ui-corner-all">
  <option selected="selected"  value="10">10</option>
  <option value="20">20</option>
  <option value="30">30</option>
  <option  value="40">40</option>
  </select>
  </form>
</div>
<?php
echo '<p>If you want, you may <a href="patience_export.php">export</a> this to a csv file, which can then be opened in Excel or any other spreadsheet program</p>';
?>
</div>
<?php
include_once('../footer.php');
?>
