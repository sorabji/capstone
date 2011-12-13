
<?php

include_once('../header.php');
$a = new Access(2,$root);
//$a->logout();
$a->do_eet();

?>
<script type="text/javascript">
  function set_headers(){
  var radios = $(':radio').get();
  for(var i=0;i<radios.length;i++){
    var ID = radios[i].id;
    if(radios[i].checked){
      if(1 == radios[i].value){
	$('#bg_changer_'+ID).css('background','green');
      } else {
	$('#bg_changer_'+ID).css('background','$c30');
      }
    }
  }
}
  $(function() {
      set_headers();
      $(".q_body").hide();
      $(".q_heading").click(function(){
	  $(this).next(".q_body").slideToggle(500);
	});
      $('#collapse').click(function(){
	  $(".q_body").slideToggle(500);	
	});
      $(':radio').click(function(){
	  var ID = (this.id).substr();
	  if(1 == this.value){
	    $('#bg_changer_'+ID).css('background','green');
	  } else {
	    $('#bg_changer_'+ID).css('background','$c30');
	  }
	});
    });
</script>
<link rel='stylesheet' type='text/css' href="<?php echo($root . 'static/quiz_styles.css');?>" />
<link rel='stylesheet' type='text/css' href="<?php echo($root . 'form_testing.css');?>" />

<?php
if(isset($_POST['submit'])){
  echo "<ul>";
  foreach($_POST as $key=>$value){
    if( !( 0 == strcmp($key, 'submit'))){
      $b = new Quiz(0,$key);
      $title = $b->get_quiz_title();

      if(1 == $value){
	$succ = $b->open_quiz();
	if($succ){
      echo "<li>";
	  echo "<p>'$title' was opened</p";
	}
      } elseif(0 == $value){
	$succ = $b->close_quiz();
	if($succ){
      echo "<li>";
	  echo "<p>'$title' was closed</p";
	}
      }
    }
    echo "</li>";
  }
  echo "</ul";
  echo "<p>Great Success</p>";
} else {
  echo "<p>quiz management winning</p>";
  echo "<form id='form' method='POST' action=''>";
  echo "<a href='#' id='collapse'>toggle collapse</a>";

  $res = mysql_query("select id,course_id,title, isOpen from quizzes order by course_id");
  while($row = mysql_fetch_assoc($res)){
    echo "<div name='bg_changer_".$row['id']."' id='bg_changer_".$row['id']."' class='q_heading'>";
    echo "{$row['course_id']} :: {$row['title']}";
    echo "<div class='clear'></div>";
    echo "</div>";
    echo "<div class='q_body'>";
  
    echo "<fieldset><legend>is open</legend>";
    echo "<label for='{$row['id']}_0' class='labelRadio compact'>\n";
    echo "<input type='radio' name='{$row['id']}' id='{$row['id']}'";

    if($row['isOpen'] == 0){ echo "checked='checked'"; }
 
    echo " class='inputRadio' value='0' />\n";
    echo "Not Open \n</label><br />\n";
    echo "<label for='{$row['id']}_0' class='labelRadio compact'>\n";
    echo "<input type='radio' name='{$row['id']}' id='{$row['id']}'";

    if($row['isOpen'] == 1){ echo "checked='checked'"; }
  
    echo " class='inputRadio' value='1' />\n";
    echo "Totally Open \n</label><br />\n";

    echo "</fieldset>";
    echo "</div>";
  }

  echo "<div class='submit'>\n";
  echo "<div><input type='submit' id='submit' name='submit' class='inputSubmit' value='Save Changes' />\n";
  echo "</div>\n</div>\n</fieldset></form>";
  echo "<div class='clear'></div>";
}

include_once('../footer.php');
?>
