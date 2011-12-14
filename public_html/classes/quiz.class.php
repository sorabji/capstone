<?php
class Quiz extends Table{
  private $queries = array(
    "isOpen" => "select isOpen from quizzes where `id` = %d",
    "do_open_quiz" => "update quizzes set `isOpen` = 1 where `id` = %d",
    "do_close_quiz" => "update quizzes set `isOpen` = 0 where `id` = %d",
    "get_quiz_title" => "select title from quizzes where `id`=%d;",
    "isVirgin" => "select * from quiz_quest_grades where `stud_id` = %s and `quiz` = %s"
  );

  private $multi_choice = array(
    "A"=>"ansA",
    "B"=>"ansB",
    "C"=>"ansC",
    "D"=>"ansD",
    "E"=>"ansE");

  public function __construct($stud_id, $quiz_id){
    $this->stud_id = $this->prep_sql($stud_id);
    //$this->quiz_id = $this->prep_sql($quiz_id); // fucking beats me why this turns to 0
    $this->quiz_id = $quiz_id;
  }

  protected function list_display($res){}
  protected function new_display(){}
  protected function edit_display($id){}
  protected function get_update_qry($vals){}

  public function get_quiz_title(){
    $res = mysql_query(sprintf($this->queries['get_quiz_title'],$this->quiz_id));
    /* echo sprintf($this->queries['get_quiz_title'],$this->quiz_id); */
    /* echo "<br />"; */
    $row = mysql_fetch_assoc($res);
    return $row['title'];
  }

  public function open_quiz(){
    $res = mysql_query(sprintf($this->queries['do_open_quiz'],$this->quiz_id));
    if(mysql_affected_rows()){
      return true;
    } else {
      return false;
    }
  }

  public function close_quiz(){
    $res = mysql_query(sprintf($this->queries['do_close_quiz'],$this->quiz_id));
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
      return true;
    } else {
      return false;
    }
  }

  public function start_quiz(){
    if(!($this->check_open_quiz())){
      echo "<p>whoops, seems the test you asked for is not available</p>";
    } else {
      $str = sprintf($this->queries['isVirgin'],$this->stud_id,$this->quiz_id);
      $res = mysql_query($str);
      $row = mysql_fetch_array($res);
      if($row){
	echo "<p>it seems you have already taken this test.</p>";
      } else {
	$this->present_questions();
      }
    }
  }

  public function do_question($quest){
    $q_num = $quest['quest_num'];
    echo "<p class='q_heading' id='bg_changer_$q_num'>Question #$q_num</p>\n";
    echo "<div class='q_body'>\n";

    echo "<p>{$quest['quest_txt']}</p>\n";
    foreach($this->multi_choice as $key=>$val){
      echo "<label for='{$q_num}_{$key}' class='labelRadio compact'>\n";

      echo "<input type='radio' name='ans_$q_num' id='{$q_num}_{$key}'";
      echo " class='inputRadio, an_$q_num' value='$key' />\n";
            echo "$key. {$quest[$val]}\n</label><br />\n";
    }

    echo "<input type='button' id='btn_$q_num' name='btn_$q_num' value='clear' />\n";
    echo "</div> <!-- ends 'q_body' -->\n</form>\n";
  }

  public function present_questions(){

      echo("<h2>answer all the questions</h2>\n");
      echo("<p>click submit when you're happy with everything</p>\n");
      echo "<a href='#' id='collapse' name='collapse'>toggle collapse</a>";
      echo "<br />";

      echo "<form id='form' name='form' action='' method='POST'>\n";
      $qry = "select * from questions where `quiz_id` = $this->quiz_id";
      $res = mysql_query($qry);

      // for tabbed awesome
      echo("<div class='layer1'>\n");

      while ($row = mysql_fetch_assoc($res)){
          $this->do_question($row);
      }
      
      echo "<div class='submit'>\n";
      echo "<p id='num_complete'></p>\n";
      echo "<input type='button' id='clear' name='clear' class='inputSubmit' value='clear all' />\n";
      echo "<input type='submit' id='submit' name='submit' class='inputSubmit' value='submit' />\n";
      echo "</div> <!-- ends 'submit' -->\n</form>\n";
      echo "</div> <!-- ends 'layer1' -->\n";
  }

  public function insert_answers($ans){

    $base = "INSERT INTO `quiz_quest_grades` ( `quiz` ,  `question_number` ,  `stud_id` ";
    $base .= ",  `submit_answer` ) VALUES ( $this->quiz_id, %d, 'cis7586', %s );";

    $i = 1;
    foreach($ans AS $key => $value) {
      if(!(strcmp($key,'submit') == 0)){
	$ans[$key] = $this->prep_sql($value);
	$res = sprintf($base, $i, $ans[$key]);
	$hrm = mysql_query($res);
	/* echo("<br />"); */
	/* echo($res); */
	/* echo("<br />"); */
	$i = $i + 1;
      }
    }
    $num_correct = $this->calc_correct();
    $fin_success = $this->insert_final_grade($num_correct);
    if($fin_success){
      return array(
	'status'=>'good',
	'num_correct'=>$num_correct);
    } else {
      return array(
	'status'=>'bad',
	'num_correct'=>$num_correct);
    }
  }

  public function insert_final_grade($cor){
    $crazy = "select id from sections where course_id = (select course_id from quizzes where id = ";
    $crazy .= $this->quiz_id." ) and id = (select sec_id from students where id=";
    $crazy .= $this->stud_id.")";

    $b = mysql_query($crazy);
    $row = mysql_fetch_assoc($b);
    
    $insert = "insert into quiz_grades ( student_id, sec_id, quiz_id, points_received ) values ";
    $insert .= "( ".$this->stud_id;
    $insert .= ", ".$row['id'];
    $insert .= ", ".$this->quiz_id;
    $insert .= ", ".$cor." )";

    $res = mysql_query($insert);
    if(mysql_affected_rows()){
      return true;
    } else {
      return false;
    }
  }

  public function calc_correct(){
    $sub = "select question_number, submit_answer from quiz_quest_grades where quiz=";
    $sub .= $this->quiz_id." and stud_id=".$this->stud_id." order by question_number";

    $correct = "select quest_num, correctAnswer from questions where ";
    $correct .= "quiz_id = ".$this->quiz_id." order by quest_num;";
    
    $sub = mysql_query($sub);
    $correct = mysql_query($correct);

    $num_correct = 0;

    if($sub and $correct){
      while($studs = mysql_fetch_assoc($sub)){
	$keys = mysql_fetch_assoc($correct);
	$stud_ans = strtoupper($studs['submit_answer']);
	$cor_ans = strtoupper($keys['correctAnswer']);

	if(0 == strcmp($stud_ans, $cor_ans)){
	  $num_correct++;
	}
      }
    }
    return $num_correct;
  }

}
?>
