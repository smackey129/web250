<?php

  ob_start(); // turn on output buffering

  // session_start(); // turn on sessions if needed

  // Assign file paths to PHP constants
  // __FILE__ returns the current path to this file
  // dirname() returns the path to the parent directory
  define("PRIVATE_PATH", dirname(__FILE__));
  define("PROJECT_PATH", dirname(PRIVATE_PATH));
  //define("PUBLIC_PATH", PROJECT_PATH);
  define("SHARED_PATH", PRIVATE_PATH . '/shared');

  // TODO: Fix so not hard coded
  // +4 for sab
  // + 11 for webhost -- web250/sab

  $public_end = strpos($_SERVER['SCRIPT_NAME'], '') +4;
  $doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $public_end);
  define("WWW_ROOT", $doc_root);

  require_once('functions.php');
  require_once('status_error_functions.php');
  require_once('db_credentials.php');
  require_once('database_functions.php');
  require_once('validation_functions.php');

  // -> All classes in directory
  foreach(glob('classes/*.class.php') as $file) {
    require_once($file);
  }

  // Autoload class definitions
  function my_autoload($class) {
    if(preg_match('/\A\w+\Z/', $class)) {
      include('classes/' . $class . '.class.php');
    }
  }
  spl_autoload_register('my_autoload');

  $database = db_connect();
  Bird::set_database($database);
//TODO : Probably don't need this line
  User::set_database($database);
  $session = new Session;
?>
