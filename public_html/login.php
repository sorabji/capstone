<?php
//include_once('util.php');
include_once('header.php');

if(isset($_POST['submit'])):
  $a = new Access(0,$root);
  $b = $a->log_in($_POST['user'],$_POST['pass']);

  if($b){
    $a->to_index();
  } else {
    echo "<p class='error'>Bad username/pass</p>";
  }
//echo "user: " .$_POST['user']. " pass: " .$_POST['pass'];
//echo $root;
endif;

?>


<script type="text/javascript">
<!--

function validate_form (){
	valid=true;
	user=document.forms['login_form'].elements['user'];
	pass=document.forms['login_form'].elements['pass'];
	
	if(user.value==""){
	  alert ("please enter your username");
	  valid=false;
	}
	else if(pass.value==""){
	  alert ("please enter your password");
	  valid=false;
	}
	return valid;
}
//-->
</script>

<form id='login_form' name='login_form' method='POST' action=''>
  <p>Come Inside Papa Bear</p>
  <fieldset>
    <legend>login infoz</legend>
    <div class='required'>
      <div class='clear'></div>
      <label for='user' class='required'>username</label>
      <input class='inputText' type='text' name='user' id='user' />
      <div class='clear'></div>
      <label for='pass' class='required'>password</label>
      <input class='inputPassword' type='password' name='pass' id='pass' />
    </div> <!-- ends 'required' -->

    <div class='submit'>
      <input type='reset' id='clear' name='clear' class='inputSubmit' value='clear all' />
      <input type='submit' id='submit' name='submit' class='inputSubmit' value='submit' />
    </div> <!-- ends 'submit' -->

  </fieldset>
</form>


<?php

include_once('footer.php');
?>