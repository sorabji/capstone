<?php
class Question extends Table{


  private $list_headers = array(
    "Quiz",
    "Question #",
    "Question",
    "A",
    "B",
    "C",
    "D",
    "E",
    "Answer");

  private $list_table_cols = array(
    "quiz_id",
    "quest_num",
    "quest_txt",
    "ansA",
    "ansB",
    "ansC",
    "ansD",
    "ansE",
    "correctAnswer" );

  private $new_labels = array(
    "Quiz",
    "Question #",
    "Question",
    "A",
    "B",
    "C",
    "D",
    "E",
    "Answer");

  private $new_post_vars = array(
    "quiz_id",
    "quest_num",
    "quest_txt",
    "ansA",
    "ansB",
    "ansC",
    "ansD",
    "ansE",
    "correctAnswer" );

  private $new_help_txt = array(
    "quiz_id",
    "quest_num",
    "quest_txt",
    "ansA",
    "ansB",
    "ansC",
    "ansD",
    "ansE",
    "correctAnswer" );

  private $ID = array("quiz_id", "quest_num"); // what's the id field of this table?

  public function __construct($ed_flag){
    $this->ed_flag = $ed_flag; // want to update/delete?
  }

  public function list_display($resource){
    echo "<ul>\n";
    while($row = mysql_fetch_array($resource)){
      echo "<li>\n<table width='80%' border='1'>\n";
      if($this->ed_flag){
	echo("<a href=question_edit.php?quiz={$row[$this->ID[0]]}" . 
	  "&quest={$row[$this->ID[1]]}>Edit</a><br />\n");
	echo("<a href=question_delete.php?quiz={$row[$this->ID[0]]}" . 
	  "&quest={$row[$this->ID[1]]}>Delete</a><br />\n");
      }
      foreach($this->list_headers as $key => $val){
    	$row[$key] = $this->prep_sql($row[$key]);
    	echo "<tr><td>{$this->list_headers[$key]}</td>\n";
    	echo "<td>$row[$key]</td>\n";
      }
      echo "</table></li>\n";
    }
    echo "</ul>\n";
  }

  public function new_display(){
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

      if ( (strcmp($this->new_post_vars[$key], "password") == 0) |
	strcmp($this->new_post_vars[$key], "password_2") == 0 ){

      	echo "<input class='inputPassword' type='password' name='{$this->new_post_vars[$key]}' id='{$this->new_post_vars[$key]}' />\n";
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
    foreach($_POST AS $key => $value) { $_POST[$key] = $this->prep_sql($value); }

    $base = "INSERT INTO `people` ( `first_name` ,  `last_name` ,  `address` ";
    $base .= ",  `email` ,  `phone` ,  `social` ,  `username` , `password` ) ";
    $fmt_str = "VALUES( '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s' );";
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
