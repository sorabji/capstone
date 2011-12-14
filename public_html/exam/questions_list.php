
<?php

include_once('../header.php');
$a = new Access(2,$root);
$a->do_eet();

?>
<link rel='stylesheet' type='text/css' href="<?php echo($root . 'static/quiz_styles.css');?>" />

<script type="text/javascript">
$(function() {
    $(".q_body").hide();
    $(".q_heading").click(function(){
        $(this).next(".q_body").slideToggle(500);
    });
    $("#collapse").click(function(){
	$(".q_body").slideToggle(500);	
    });
});
</script>
<?php

if(isset($_GET['q_id'])){
  $q_id = $_GET['q_id'];
} else {
  $q_id = false;
}

// pass quiz id w/ get_var
if($q_id){
  $resource = mysql_query("select * from questions where quiz_id=$q_id");
  $quest = new Question(true, $root);
  $res = mysql_fetch_assoc(mysql_query("select title, course_id from quizzes where id=$q_id"));
  echo "<p>Questions from \"".$res['course_id']." :: ".$res['title']."\"</p>";
  echo "<a id='collapse' href='#'>toggle collapse</a>";
  $quest->list_display($resource);
} else {
  echo "<p class='error'>You must select a quiz</p>";
  echo "<p>Go to the quiz selection <a href='".$root."exam/questions_search.php'>page</a> and try again</p>";
}

include_once('../footer.php');
?>
