<?php
class Access{
  /*
    this class manages access on a per page basis. after including
    header.php, create a new instance of this class, passing a single
    integer to indicate the access level for that page, as follows:
    0: login not required, public
    1: student accessible
    2: instructor accessible
    3: admins only

    permission implies all lower levels.  user w/ level 3 access can
    of course view level 1 pages.
  */

  public function __construct($a_level=0, $root=""){
    /*
      we need $root so we know how to redirect to stuff. $a_level is
      the desired access level for the page.
     */
    $this->a_level = $a_level;
    $this->root = $root;
  }

  public function log_in($user,$pass){
    //$pass = sha1($pass); 
    /* $user =stripslashes($user); */
    /* $user =mysql_real_escape_string($user); */

    $errorMessage = "";

    if(0 == strcmp('',$user)){
      $errorMessage .= "<li>You forgot to enter a username!</li>";
    }
    if(0 == strcmp('',$pass)){
      $errorMessage .= "<li>You forgot to enter a password!</li>";
    }
    if(!ctype_alnum($user)){
      $errorMessage .= "<li>Username can only be alphanumeric!</li>";
    }

    if(empty($errorMessage)){
      $user=stripslashes($user);
      $user=mysql_real_escape_string($user);


      //$pass = sha1($pass); // some passes aren't hashed yet...

      //return $pass;

      $sql = "select `username`, `password` from people where username='".$user."' and password='".$pass."'";	 
      $select_user=mysql_query($sql);
	 
      if(mysql_num_rows($select_user)!=0){
	$_SESSION['user'] = $user;
	return true;
      } else {
	return false;
      }
    }
  }

  public function to_index(){
    header("Location: ".$this->root."index.php");
    exit();
  }

  public function is_logged_in(){
    /*
      check if they logged in
     */
    return (isset($_SESSION['user'])) ? true : false;
  }

  public function logout(){
    /*
      log those bitchez out
    */
    unset($_SESSION['user']);
  }

  public function get_user_a_level(){
    /*
      figures out the current user's access karma, be they admin? oder ein Lehrer? sind Studenten?
    */
    if(!($this->is_logged_in())) return 0;
    $user = $_SESSION['user'];

    $lim = "( select `id` from people where username='$user' )";
    
    $three = "select `admin_id` from admins where admin_id=";
    $two = "select `instructor_id` from instructors where instructor_id=";
    $one = "select `student_id` from students where student_id=";
    
    $res = mysql_query($three . $lim);
    if(mysql_num_rows($res)!=0){
      return 3; // admin ftw
    } else {
      $foo = mysql_query($two . $lim);
      if(mysql_num_rows($foo)!=0){
	return 2; // teachers are cool too
      } else {
	$baz = mysql_query($one . $lim);
	if(mysql_num_rows($baz)!=0){
	  return 1; // students suck
	} else {
	  return 0; // you are nobody
	}
      }
    }
  }

  public function do_eet(){
    /*
      does eet.  if user doesn't have high enough access karma to view
      the page, bitchez be redirected to the login page so they can
      handle their shit.
     */
    $user_a_level = $this->get_user_a_level();

    /* echo "page level: " .$this->a_level. "<br />"; */
    /* echo "user's level: " .$user_a_level. "<br />"; */
    /* echo "logged in as: " .$_SESSION['user']. "<br />"; */

    if($this->a_level > $user_a_level){
      header("Location: ".$this->root."login.php");
      exit();
    }
  }
}
?>