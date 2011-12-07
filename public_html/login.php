<?php
include_once('util.php');
connect();
if(isset($_POST['submit'])):
  $a = new Access(0,$root);
$b = $a->log_in($_POST['user'],$_POST['pass']);
echo $b;
//echo "user: " .$_POST['user']. " pass: " .$_POST['pass'];
//echo $root;
else:
include_once('header.php');
?>

<form id='form' name='form' method='POST' action=''>
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
endif;
include_once('footer.php');
?>