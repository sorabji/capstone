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
  abstract protected function new_display2();
  abstract protected function edit_display($id);
  abstract protected function get_update_qry($vals);
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

  public $new_help_txt = array(
    "",
    "",
    "",
    "",
    "",
    "",
    "The desired login name",
    "minimum of 7 chars",
    "and again, for papa bear" );

  const ID = "id"; // what's the id field of this table?

  

  public function __construct($ed_flag){
    $this->ed_flag = $ed_flag; // want to update/delete?
  }

  public function list_display($resource){
    echo("<table border='1' >\n<tr>");
    foreach($this->list_headers as $head){
      echo("<th>$head</th>\n");
    }
    echo("</tr>");
    
    while($row = mysql_fetch_array($resource)){
      echo("<tr>\n");
      foreach($row as $key => $value) {
	$row[$key] = stripslashes($value);
      }
      foreach($this->list_table_cols as $val) {
	echo("<td valign='top'>$row[$val]</td>");
      }
      if($this->ed_flag){
	echo("<td valign='top'><a href=people_edit.php?id={$row[$this->ID]}>Edit</a></td>\n");
	echo("<td valign='top'><a href=people_delete.php?id={$row[$this->ID]}>Delete</a></td>\n");
      }
      
    }
    echo("</tr>\n</table>");
  }

  public function new_display(){
    echo("<div id='f_style' class='mah_form'>\n");
    echo("<form id='form' name='form' action='' method='POST'>\n");
    echo("<h1>New Person Form</h1>\n");
    echo("<p>Enter the new person's deets</p>\n");
    foreach($this->new_labels as $key => $val){
      //echo("<fieldset>\n");
      $str = "<label for='{$this->new_post_vars[$key]}'>";
      $str .= $this->new_labels[$key];
      // can echo into <span class='small'>helpful text</span>...
      // form_help_txt...like new_post_vars
      
      $str .= "<span class='small'>{$this->new_help_txt[$key]}</span>\n</label>\n";

      
      if ( (strcmp($this->new_post_vars[$key], "password") == 0) | strcmp($this->new_post_vars[$key], "password_2") == 0 ){
      	$str .= "<input type='password' name='{$this->new_post_vars[$key]}' id='{$this->new_post_vars[$key]}' />\n";
      } else {
	$str .= "<input type='text' name='{$this->new_post_vars[$key]}' id='{$this->new_post_vars[$key]}' />\n";
      }
      echo($str);
      //echo("</fieldset>\n");
    }
    echo("<input type='submit' id='submit' name='submit' value='Add Person' />\n");
    echo("</form>");
    echo("<div id='spacer'></div>");
    //echo("<br />");
  }

  public function new_display2(){
    echo "<form id='form' name='form' action='' method='POST'>\n";
    echo "<p>All fields are required</p>\n";
    echo "<fieldset><legend>Person Info</legend>\n";
    echo "<div class='notes'>\n";
    echo "<h4>notes</h4>\n";
    echo "<p class='last'>fill it out properly...all of it damnit!</p>\n</div>\n";

    foreach($this->new_labels as $key => $val){
      echo "<div class='required'>\n";
      echo "<label for='{$this->new_post_vars[$key]}'>";
      echo $this->new_labels[$key];
      echo "</label>\n";
      
      if ( (strcmp($this->new_post_vars[$key], "password") == 0) | strcmp($this->new_post_vars[$key], "password_2") == 0 ){
      	echo "<input class='inputPassword type='password' name='{$this->new_post_vars[$key]}' id='{$this->new_post_vars[$key]}' />\n";
      } else {
	echo "<input class='inputText' type='text' name='{$this->new_post_vars[$key]}' id='{$this->new_post_vars[$key]}' />\n";
      }
    }
    echo "<div class='submit'>\n";
    echo "<div><input type='submit' id='submit' name='submit' class='inputSubmit' value='Add Person' />\n";
    echo "</div>\n</div>\n</fieldset>\n</form>";
    echo($ret);
  }

  public function edit_display($id){
    return 0;
  }

  public function get_update_qry($vals){

    // don't forget to hash the damn passwords
    foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
    
    $base = "INSERT INTO `people` ( `first_name` ,  `last_name` ,  `address` ";
    $base .= ",  `email` ,  `phone` ,  `social` ,  `username` , `password` ) ";
    $fmt_str = "VALUES( `%s`, `%s`, `%s`, `%s`, `%s`, `%s`, `%s`, `%s` );";
    $res = sprintf($fmt_str, // can't just unpack?...hrm
	   $vals[$this->new_post_vars[0]],
    	   $vals[$this->new_post_vars[1]],
    	   $vals[$this->new_post_vars[2]],
    	   $vals[$this->new_post_vars[3]],
    	   $vals[$this->new_post_vars[4]],
    	   $vals[$this->new_post_vars[5]],
    	   $vals[$this->new_post_vars[6]],
    	   $vals[$this->new_post_vars[7]]);
    $fin = $base . $res;
    return $fin;
  }

}


?>