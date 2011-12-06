<?php
session_start();

$root = '/coleman/capstone/'; // devvz
//$root = '/~capstone/'; // coleman
//$root = '/Capstone/';
//$root = '/Capstone/public_html/';


function connect(){
  // connect to db
  $link = mysql_connect('localhost', 't3st3r', '123qwe');
  if (!$link) {
    die('Not connected : ' . mysql_error());
  } else {
    //echo("fucking fuck");
  }

  if (! mysql_select_db('capstone') ) {
    die ('Can\'t use capstone : ' . mysql_error());
  }
  return $link;
}


// Your custom class dir
define('CLASS_DIR', '../classes/');
define('CLASS_DIR2', 'classes/');

// Add your class dir to include path
set_include_path(get_include_path().PATH_SEPARATOR.CLASS_DIR);
set_include_path(get_include_path().PATH_SEPARATOR.CLASS_DIR2);

spl_autoload_extensions('.class.php');

// Use default autoload implementation
spl_autoload_register();

?>
