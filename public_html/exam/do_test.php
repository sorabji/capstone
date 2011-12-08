<?php

include_once('../header.php');

?>

<script type="text/javascript">
$(function() {
    $(".q_body").hide();
    $(".q_heading").click(function(){
        $(this).next(".q_body").slideToggle(500);
    });
});

function clean_up_radio_group(grp){
  for(var i = 0;i<grp.length; i++){
    grp[i].checked = false;
  }
}

function calc_complete(){
  var grp = $(':radio').get();
  var total = $('.q_heading').size();
  var complete = 0;
  for(var i = 0;i<grp.length; i++){
    if(grp[i].checked){
      complete += 1;
      var ID = grp[i].getAttribute('id').substr(0,1);
      $('#bg_changer_'+ID).css('background','green');
    }
  }
  $('#num_complete').text('completed '+complete+' out of '+total);
}

$(function(){
    calc_complete();
    $(':radio').click(function(){
        var ID = (this.id).substr(0,1);
        $('#bg_changer_'+ID).css('background','green');
	calc_complete();
    });

    $(':button').click(function(){
        var ID = (this.id).substr(4);
	$('#bg_changer_'+ID).css('background','#c30');
	clean_up_radio_group( $('.an_' + ID).get() );
	calc_complete();
    });

    $('#clear').click(function(){
	$('.q_heading').css('background','#c30');
	clean_up_radio_group( $('input[class*="an_"]').get() );
	calc_complete();
    });

    $('#collapse').click(function(){
	$(".q_body").slideToggle(500);	
    });

    
});
</script>

<link rel='stylesheet' type='text/css' href="<?php echo($root . 'static/quiz_styles.css');?>" />

<?php
if(isset($_GET['q_id'])){
  $q_id = $_GET['q_id'];
} else {
  $q_id = false;
}

// pass quiz id w/ get_var
if($q_id){
  $quiz = new Quiz('cis7586', 1);
} else {
  $quiz = new Quiz('cis7586');
}
$quiz->open_quiz();
if(!empty($_POST['submit'])){
  // insert answers in quiz_quest_grades
  $quiz->insert_answers($_POST);
} else {
  $quiz->start_quiz();
}

include_once('../footer.php');
?>
