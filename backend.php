<?php

  // backend.php
  // this file should NOT be loaded in the browser.  instead, it should be queried via AJAX from the frontend.
  // this script will take GET and POST parameters as input and output strings of JSON for handling by the AJAX callback.

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
      $q = $db->prepare("insert into Users (user_id, username, password, age, gender, location) values (:user_id, :username, :password, :age, :gender, :location)");
      $q->execute(array(':user_id'  => $_POST['user_id'],
                        ':username' => $_POST['username'],
                        ':password' => $_POST['password'],
                        ':age'      => $_POST['age'],
                        ':gender'   => $_POST['gender'],
                        ':location' => $_POST['location']));
      if($q->rowCount() != 1) throw new PDOException();
      session_start();
      $_SESSION['user_id'] = $_POST['user_id']; // store the user_id as a session token to log in.
      $response->message = "User ID ".$_POST['user_id']." has been registered successfully.";
      $response->user_id = $_POST['user_id'];
    } catch(PDOException $e) {
      $response->message = "User Registration Failed!  Maybe there was already a user with that user ID?";
      $response->details = $e->getMessage();
      error(500,"Internal Server Error");
    }


  } else if($fn == 'user_login') {


    session_start();
    if(isset($_SESSION['user_id'])) {
      $response->message = "You're already logged in.";
      break;
    }
    if(!isset($_POST['user_id'], $_POST['password'])) {
      $response->message = "Login failed! Please enter a valid username and password.";
      error(401,"Unauthorized");
    }
    $user_id = filter_var($_POST['user_id'], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
    try {
      $q = $db->prepare("select user_id, password from Users where user_id = :user_id and password = :password");
      $q->execute(array(':user_id' => $user_id,':password' => $password));
      $user_id = $q->fetchColumn();
      if($user_id == false) {
        $response->message = "Login failed! Please enter a valid username and password.";
        error(401,"Unauthorized");
      } else {
        $_SESSION['user_id'] = $user_id; // store the user_id as a session token to log in.
        $response->message = "Login Successful!";
      }
    } catch(PDOException $e) {
      $response->message = "Login failed due to database error!";
      $response->details = $e->getMessage();
      error(500,"Internal Server Error");
    }


  } else if($fn == 'user_logout') {


    session_start();
    unset($_SESSION['user_id']); // remove the user_id session token to logout.
    $response->message = "Logout complete";


  } else if($fn == 'get_user_by_id') {


    try {
      $q = $db->prepare("select * from Users where user_id = :user_id");
      $q->execute(array(':user_id' => $_GET['user_id']));
      $response = $q->fetchObject();
    } catch(PDOException $e) {
      $response->message = "Failed to Select the User with that user_id!";
      $response->details = $e->getMessage();
      error(500,"Internal Server Error");
    }


  } else if($fn == 'search_songs') {

    $term = "'%".$_GET['term']."%'";
    $results_per_page = 50;
    $page = $_GET['page'];
    $offset = $page*$results_per_page;
    try {
      // WHAT'S THE DEAL HERE?
      // Warning: PDOStatement::execute(): SQLSTATE[HY093]: Invalid parameter number: number of bound variables does not match number of tokens
      $q = $db->prepare("select song_id, title, year, duration, loudness from Songs where title like :term limit :rpp offset :offset");
      $q->bindParam(':term', $term);
      $q->bindParam(':rpp', $results_per_page);
      $q->bindParam(':offset', $offset);
      $q->execute();
      $response->message = "Search Successful";
      $response->page = $_GET['page'];
      $response->results = array();
      $response->row = $q->fetchObject();
      $row = -1;
      $i = 0;
      while($row != NULL) {
        $row = $q->fetchObject();
        $response->results[$i] = $row;
        $i++;
      }
    } catch(PDOException $e) {
      $response->message = "Failed to Select from the Songs table!";
      $response->details = $e->getMessage();
      error(500,"Internal Server Error");
    }


  } else if($fn == 'search_artists') {

    $term = "'%".$_GET['term']."%'";
    $results_per_page = 50;
    $page = $_GET['page'];
    $offset = $page*$results_per_page;
    try {
      $q = $db->prepare("select artist_id, artist_name from Artists where artist_name like :term limit :rpp offset :offset");
      $q->bindParam(':term', $term);
      $q->bindParam(':rpp', $results_per_page);
      $q->bindParam(':offset', $offset);
      $q->execute();
      $response->message = "Search Successful";
      $response->page = $_GET['page'];
      $response->results = $q->fetchAll();
    } catch(PDOException $e) {
      $response->message = "Failed to Select from the Artists table!";
      $response->details = $e->getMessage();
      error(500,"Internal Server Error");
    }


  } else if($fn == 'search_albums') {

    $term = "'%".$_GET['term']."%'";
    $page = $_GET['page'];
    $results_per_page = 50;
    $offset = $page*$results_per_page;
    try {
      $q = $db->prepare("select album_id, album_name from Albums where album_name like :term limit :rpp offset :offset");
      $q->bindParam(':term', $term);
      $q->bindParam(':rpp', $results_per_page);
      $q->bindParam(':offset', $offset);
      $q->execute();
      $response->message = "Search Successful";
      $response->page = $_GET['page'];
      $response->results = $q->fetchAll();
    } catch(PDOException $e) {
      $response->message = "Failed to Select from the Albums table!";
      $response->details = $e->getMessage();
      error(500,"Internal Server Error");
    }


  }

  // Output the response object as a JSON-encoded string
  echo json_encode($response);

?>
