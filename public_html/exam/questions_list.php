
<?php

include_once('../header.php');
$a = new Access(2,$root);
//$a->do_eet();

?>
<link rel='stylesheet' type='text/css' href="<?php echo($root . 'static/quiz_styles.css');?>" />

<script type="text/javascript">
$(function() {
    $(".q_body").hide();
    $(".q_heading").click(function(){
        $(this).next(".q_body").slideToggle(500);
    });
});
</script>
<?php
$resource = mysql_query("select * from questions");
	   
$quest = new Question(true);
$quest->list_display($resource);


include_once('../footer.php');
?>
