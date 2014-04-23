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
    try {
      $q = $db->prepare("insert into Users (user_id, username, password, age, gender, location) VALUES (:user_id, :username, :password, :age, :gender, :location)");
      $q->execute(array(':user_id'  => $_POST['user_id'],
                        ':username' => $_POST['username'],
                        ':password' => $_POST['password'],
                        ':age'      => $_POST['age'],
                        ':gender'   => $_POST['gender'],
                        ':location' => $_POST['location']));
      if($q->rowCount() != 1) throw new PDOException();
      $response->message = "User ID ".$_POST['user_id']." has been registered successfully.";
      $response->user_id = $_POST['user_id'];
    } catch(PDOException $e) {
      $response->message = "User Registration Failed!  Maybe there was already a user with that user ID?";
      $response->details = $e->getMessage();
      error(500,"Internal Server Error");
    }
  }

  if($fn == 'get_user_by_id') {
    try {
      $q = $db->prepare("select * from Users where user_id = :user_id");
      $q->execute(array(':user_id' => $_GET['user_id']));
      $response = $q->fetchObject();
    } catch(PDOException $e) {
      $response->message = "Failed to Select the User with that user_id!";
      $response->details = $e->getMessage();
      error(500,"Internal Server Error");
    }
  }

  // Output the response object as a JSON-encoded string
  echo json_encode($response);

?>
