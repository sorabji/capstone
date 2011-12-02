<?php
class Quiz extends Table{
  private $queries = array(
    "isOpen" => "select isOpen from quizzes where `id` = %d",
    "do_open_quiz" => "update quizzes set `isOpen` = 1 where `id` = '%s'",
    "do_close_quiz" => "update quizzes set `isOpen` = 0 where `id` = '%s'"
  );

  private $multi_choice = array(
    "A"=>"ansA",
    "B"=>"ansB",
    "C"=>"ansC",
    "D"=>"ansD",
    "E"=>"ansE");

  public function __construct($quiz_id){
    $this->quiz_id = $quiz_id;
  }

  protected function list_display($res){}
  protected function new_display(){}
  protected function edit_display($id){}

  protected function get_update_qry($vals){}

  public function open_quiz(){
    $res = mysql_query(sprintf($this->queries['do_open_quiz'],$this->quiz_id));
    $row = mysql_fetch_array($res);
    if(mysql_affected_rows()){
      return true;
    } else {
      return false;
    }
  }

  public function close_quiz(){
    $res = mysql_query(sprintf($this->queries['do_close_quiz'],$this->quiz_id));
    $row = mysql_fetch_array($res);
    if(mysql_affected_rows()){
      return true;
    } else {
      return false;
    }

  }

  public function check_open_quiz(){
    $res = mysql_query(sprintf($this->queries['isOpen'],$this->quiz_id));
    $row = mysql_fetch_array($res);
    if($row['isOpen']){
      $_SESSION['cur_quiz'] = $quiz_id;
      return true;
    } else {
      $_SESSION['cur_quiz'] = 0;
      return false;
    }
  }

  public function start_quiz(){
  }

  public function do_question($quest){
    $q_num = $quest['quest_num'];
    echo "<p class='q_heading' id='bg_changer_$q_num'>Question #$q_num</p>";
    echo "<div class='q_body'>";

    echo "<p>{$quest['quest_txt']}</p>";

    foreach($this->multi_choice as $key=>$val){
      echo "<label for='$val' class='labelRadio compact'>";
      echo "<input type='radio' name='ans_$q_num' id='ans_$q_num' class='inputRadio' value='$key' ";
      echo "<p>$key. {$quest[$val]}</label><br />\n";
    }

    echo "</fieldset>";
    echo "<input type='button' id='btn_$q_num' name='btn_$q_num' value='clear' />";
    echo "</div>\n</fieldset>\n</form>";
  }

  public function present_questions(){

      echo("<h2>answer all the questions</h2>");
      echo("<p>click submit when you're happy with everything</p>");

      echo "<form id='form' name='form' action='' method='POST'>\n";
      $qry = "select * from questions where `quiz_id` = $this->quiz_id";
      $res = mysql_query($qry);

      // for tabbed awesome
      echo("<div class='layer1'>");

      while ($row = mysql_fetch_assoc($res)){
          $this->do_question($row);
      }

      echo "<div class='submit'>\n";
      echo "<input type='submit' id='submit' name='submit' class='inputSubmit' value='submit' />\n";
      echo "</div>\n\n\n</form>";
      echo "<p id='num_complete'>fuck</p>";
  }

  public function insert_answers($ans){

    $base = "INSERT INTO `quiz_quest_grades` ( `quiz` ,  `question_number` ,  `stud_id` ";
    $base .= ",  `submit_answer` VALUES ( $this->quiz_id, %d, 'cis7586', %s );";

    $i = 1;
    foreach($ans AS $key => $value) {
        if(!(strcmp($value,'submit') == 0)){
            $ans[$key] = $this->prep_sql($value);
            $res = sprintf($base, $i, $ans[$key]);
            echo("<br />");
            echo($res);
            echo("<br />");
            $i = $i + 1;
        }
    }

  }

}
?>
