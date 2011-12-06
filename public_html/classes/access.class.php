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
    if(mysql_num_rows($res) != 0){
      $_SESSION['isAuthorized'] = true;
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
  }

  public function logout(){
    /*
      log those bitchez out
    */
  }

  public function get_user_a_level(){
    /*
      query tables, return 0-3 indicating user's a_level
    */
  }

}
?>