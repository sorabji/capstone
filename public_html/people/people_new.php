<html>
<head>
</head>
<body>
<? 
include('../config.php'); 
include('../util.php');
/* use sprintf(query, values**) to build query */
$peeps = new People_Table($ed_flag=true);

if (isset($_POST['submitted'])) { 
  $res = $peeps->do_insert($_POST);
  if($res){
    echo "Added row.<br />"; 
    echo "<a href='list.php'>Back To Listing</a>"; 
  } else {
    echo("nothing added");
  }
} else {
  $peeps->new_display();
}
?>

</body>
</html>