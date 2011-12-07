<?
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

  public function __construct($a_level=0){
    $this->a_level = $a_level;
  }

  public function log_in($user,$pass){
    //$pass = sha1($pass); 
    $user =stripslashes($user);
    $user =mysql_real_escape_string($user);

    $sql = "select `username`, `password` from people where username='".$user."' and password='".$pass."';";
    $res = mysql_query($sql);
    echo mysql_error();
    if(mysql_num_rows($res) != 0){
      $_SESSION['user'] = $user;
      header("Location: index.php");
      exit();
    } else {
      echo "Bad user/pass combo...seek help";
    }
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
      query tables, return 0-3 indicating user's a_level
    */
    if(!($this->is_logged_in())) return 0;
    $user = $_SESSION['user'];

    $lim = "( select `id` from people where `username` = $user );";
    $hrm = "select `id` from people where `username` = $user;";
    $three = "select `admin_id` from admins where `admin_id` = ";
    $two = "select `instructor_id` from instructors where `instructor_id` = ";
    $one = "select `student_id` from students where `student_id` = ";

    $b = mysql_query($hrm);
    echo($b);
    
    $res = mysql_query($three . $lim);
    if($res){
      return 3;
    } else {
      $res = mysql_query($two . $lim);
      if($res){
	return 2;
      } else {
	$res = mysql_query($one . $lim);
	if($res){
	  return 1;
	} else {
	  return 0;
	}
      }
    }
  }

  public function do_eet($root){
    $user_a_level = $this->get_user_a_level();
    echo $user_a_level;
    echo $this->get_user_a_level();
    echo $_SESSION['user'];
    if($this->a_level > $user_a_level){
      //header("Location: ".$root."login.php");
      //exit();
    }
  }
}
?>