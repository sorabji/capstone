<?php

include_once('../header.php');

?>

<script type="text/javascript">
$(document).ready(function() {
    $(".q_body").hide();
    //toggle the componenet with class msg_body
    $(".q_heading").click(function()
        {
            $(this).next(".q_body").slideToggle(500);
        });
});
</script>

<link rel='stylesheet' type='text/css' href="<?php echo($root . 'static/quiz_styles.css');?>" />

<?php

$link = connect();
$quiz = new Quiz(1); // need to start the quiz properly

if(!empty($_POST['submit'])){
    // insert answers in quiz_quest_grades
    $quiz->insert_answers($_POST);
} else {

    $quiz->present_questions();
}

include_once('../footer.php');
?>
