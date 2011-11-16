<?php

function connect(){
  // connect to db
  $link = mysql_connect('localhost', 't3st3r', '123qwe');
  if (!$link) {
    die('Not connected : ' . mysql_error());
  } else {
    //echo("fucking fuck");
  }

  if (! mysql_select_db('capstone') ) {
    die ('Can\'t use capstone : ' . mysql_error());
  }
  return $link;
}

abstract class Table {
  abstract protected function list_display($res);
  abstract protected function new_display();
  abstract protected function edit_display($id);
}

class People_Table extends Table{

  public $list_headers = array(
    "First",
    "Last",
    "Address",
    "Email",
    "Phone",
    "username");

  public $list_table_cols = array(
    "first_name",
    "last_name",
    "address",
    "email",
    "phone",
    "username" );

  public $new_labels = array(
    "First Name",
    "Last Name",
    "Address",
    "Email",
    "Phone",
    "Social Security",
    "Username",
    "Password",
    "Confirm Pasword" );

  public $new_post_vars = array(
    "first_name",
    "last_name",
    "address",
    "email",
    "phone",
    "social",
    "username",
    "password",
    "password_2" );

  const ID = "id";

  public function __construct($ed_flag=false){
    $this->$ed_flag = $ed_flag;
  }

  public function list_display($resource){
    echo("<table border='1' >\n<tr>");
    foreach($this::$list_headers as $head){
      echo("<th>$head</th>\n");
    }
    echo("</tr>");

    $resource = mysql_query("select * from people", $link);
    while($row = mysql_fetch_array($resource)){
      echo("<tr>\n");
      foreach($row as $key => $value) {
	$row[$key] = stripslashes($value);
      }
      foreach($this::$list_table_cols as $val) {
	echo("<td valign='top'>$val</td>");
      }
      if($ed_flag){
	echo("<td valign='top'><a href=people_edit.php?id={$row[$this->ID]}>Edit</a></td>\n");
	echo("<td valign='top'><a href=people_delete.php?id={$row[$this->ID]}>Delete</a></td>\n");
      }
      echo("</tr>\n</table>");
    }
  }

  public function new_display(){
    echo("<form action='' method='POST'>\n");
    foreach($this->new_labels as $key => $val){
      echo("<fieldset>\n");
      $str = "<label for='{$this->new_post_vars[$key]}'>";
      $str .= $this->new_labels[$key] . "</label>\n";
      if ( (strcmp($this->new_post_vars[$key], "password") == 0) | strcmp($this->new_post_vars[$key], "password_2") == 0 ){
      	$str .= "<input type='password' name='{$this->new_post_vars[$key]}' id='{$this->new_post_vars[$key]}' />\n";
      } else {
	$str .= "<input type='text' name='{$this->new_post_vars[$key]}' id='{$this->new_post_vars[$key]}' />\n";
      }
      echo($str);
      echo("</fieldset>\n");
    }
    echo("<input type='submit' value='Add Person' />\n");
    echo("</form>");
  }

  public function edit_display($id){
    return 0;
  }


}


?>