<?php

  // backend.php
  // this file should NOT be loaded in the browser.  instead, it should be queried via AJAX from the frontend.
  // this script will take GET and POST pg_parameter_status()s as input and output strings of JSON for handling by the AJAX callback.

  define('MYSQL_HOST', 'cs445sql');
  define('MYSQL_DATABASE', 'cst');
  define('MYSQL_CHARSET', 'utf8');
  define('MYSQL_USERNAME', 'mturley');
  define('MYSQL_PASSWORD', 'EL950mtu');

  function error($errNo, $errMessage) {
    header($_SERVER['SERVER_PROTOCOL'] . ' '.$errNo.' '.$errMessage, true, $errNo);
  }

  $response = new stdClass(); // an empty generic object we will use to contain our response data

  // Establish what function is being requested (designated by the 'fn' parameter).  Error 400 if fn is unspecified.

  $fn = NULL;
  if(isset($_GET['fn'])) $fn = $_GET['fn'];
  if(isset($_POST['fn'])) $fn = $_POST['fn'];
  if($fn == NULL) {
    $response->message = "Bad Request";
    $response->details = "No 'fn' value was specified, script has no instructions to follow";
    error(400,"Bad Request");
  }
  
  // Attempt to connect to the mysql database.  Error 500 if connection fails.

  $db = NULL;
  try {
    $db = new PDO('mysql:host='.MYSQL_HOST.';dbname='.MYSQL_DATABASE.';charset='.MYSQL_CHARSET, MYSQL_USERNAME, MYSQL_PASSWORD);
  } catch(PDOException $e) {
    $response->message = "Failed to Connect to the MySQL Database!";
    $response->details = $e->getMessage();
    error(500,"Internal Server Error");
  }

  // Perform whatever operations are necessary for this request

  if($fn == 'register_new_user') {
    $response->message = "TODO: register user! (nothing was actually changed, but the routing works)";
    $response->user_id = $_POST['user_id'];
  }

  // Output the response object as a JSON-encoded string
  echo json_encode($response);

?>