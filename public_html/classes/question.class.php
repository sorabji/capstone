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

  private $multi_choice = array(
    "A"=>"ansA",
    "B"=>"ansB",
    "C"=>"ansC",
    "D"=>"ansD",
    "E"=>"ansE");

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

  public function __construct($ed_flag, $root){
    $this->ed_flag = $ed_flag; // want to update/delete?
  }

  public function list_display($resource){
    while($row = mysql_fetch_array($resource)){
      echo "<div class='q_heading'>";
      echo "#{$row['quest_num']}.) {$row['quest_txt']}";
      echo "</div>";
      echo "<div class='q_body'>\n";
      echo "<table width='80%' border='1'>\n";
      
      foreach($this->list_headers as $key => $val){
    	$row[$key] = $this->prep_sql($row[$key]);
    	echo "<tr><td>{$this->list_headers[$key]}</td>\n";
    	echo "<td>$row[$key]</td>\n";
      }

      if($this->ed_flag){
    	echo "<p>you can ";
    	echo "<a href=".$root."questions_edit.php?quiz={$row[$this->ID[0]]}" .
    	  "&quest={$row[$this->ID[1]]}>edit</a>";
    	echo " or ";
    	echo "<a href=".$root."questions_delete.php?quiz={$row[$this->ID[0]]}" .
    	  "&quest={$row[$this->ID[1]]}>delete</a>";
    	echo " this question</p>";
      }
      echo "</table></li>\n";
      echo "</div><!-- ends 'q_body' -->";
    }
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

  public function edit_display($row){
    $q_num = $row['quest_num'];
    echo "<form id='form' name='form' action='' method='POST'>\n";
    echo "<p>All fields are required</p>\n";
    echo "<fieldset><legend>Edit Question #$q_num</legend>\n";
    echo "<div class='notes'>\n";
    echo "<h4>notes</h4>\n";
    echo "<p class='last'>fill it out properly...all of it damnit!</p>\n</div>\n";
	
    foreach($this->new_labels as $key => $val){
      if ( (strcmp($this->new_post_vars[$key], 'correctAnswer') == 0) ){
	echo "<div class='required'>\n";
	echo "<fieldset><legend>Answer</legend>";

	foreach($this->multi_choice as $key=>$val){
	  echo "<label for='{$q_num}_{$key}' class='labelRadio compact'>\n";
	  echo "<input type='radio' name='correctAnswer' id='correctAnswer'";

	  if($row['correctAnswer'] == $key){
	    echo "checked='checked'";
	  }
	  echo " class='inputRadio, an_$q_num' value='$key' />\n";
	  echo "$key. \n</label><br />\n";
	}
	echo "</fieldset>";
      } else {
	echo "<div class='required'>\n";
	echo "<label for='{$this->new_post_vars[$key]}'>";
	echo $this->new_labels[$key];
	echo "</label>\n";
	echo "<input class='inputText' type='text' ";
	echo "name='{$this->new_post_vars[$key]}' id='{$this->new_post_vars[$key]}' ";
	echo "value='".$row[$this->new_post_vars[$key]]."' /></div>\n";
      }
    }

    echo "</div><div class='submit'>\n";
    echo "<div><input type='submit' id='submit' name='submit' class='inputSubmit' value='Save Changes' />\n";
    echo "</div>\n</div>\n</fieldset>\n</form>";
  }

  public function get_update_qry($vals){

    foreach($vals AS $key => $value) { $vals[$key] = $this->prep_sql($value); }

    $sql = "update questions set quiz_id=%s, quest_num=%s, quest_txt=%s, ansA=%s, ";
    $sql .= "ansB=%s, ansC=%s, ansD=%s, ansE=%s, correctAnswer=%s ";
    $sql .= "where quiz_id=".$vals['quiz_id']." and quest_num=".$vals['quest_num'];

    $res = sprintf($sql, // can't just unpack?...hrm
	   $vals[$this->new_post_vars[0]],
    	   $vals[$this->new_post_vars[1]],
    	   $vals[$this->new_post_vars[2]],
    	   $vals[$this->new_post_vars[3]],
    	   $vals[$this->new_post_vars[4]],
    	   $vals[$this->new_post_vars[5]],
    	   $vals[$this->new_post_vars[6]],
	   $vals[$this->new_post_vars[7]],
    	   $vals[$this->new_post_vars[8]]);
    $fin = $base . $res;
    return $fin;
  }

}
?>
