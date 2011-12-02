<?php

include_once('../header.php');

?>

<script type="text/javascript">
$(document).ready(function() {
    $(".q_body").hide();
    $(".q_heading").click(function(){
        $(this).next(".q_body").slideToggle(500);
    });
});

$(function(){
    $(':radio').click(function(){
        var ID = this.id;
        $('#bg_changer_'+ID.substr(4)).css('background','cyan');
    });

    $(':button').click(function(){
        var ID = this.id;
        $('#ans_'+ID.substr(4)).attr('checked',false);
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
