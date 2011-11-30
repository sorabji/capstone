<?php
class Quiz{
    private $queries = array(
        "isOpen" => "select isOpen from quizzes where `id` = %d",
        "do_open_quiz" => "update quizzes set `isOpen` = 1 where `id` = '%s'"
        "do_close_quiz" => "update quizzes set `isOpen` = 0 where `id` = '%s'"
    );
    function __construct($quiz_id){
        $this->quiz_id = $quiz_id;
    }

    function open_quiz(){
        $res = mysql_query(sprintf($this->queries['do_open_quiz'],$this->quiz_id));
        $row = mysql_fetch_array($res);
        if(mysql_affected_rows()){
            return true;
        } else {
            return false;
        }
    }

    function close_quiz(){
        $res = mysql_query(sprintf($this->queries['do_close_quiz'],$this->quiz_id));
        $row = mysql_fetch_array($res);
        if(mysql_affected_rows()){
            return true;
        } else {
            return false;
        }

    }

    function check_open_quiz(){
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

    function start_quiz(){
    }
}
?>
