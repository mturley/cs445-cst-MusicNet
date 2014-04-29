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
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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

  } else if($fn == 'get_current_user') {

    session_start();
    if(isset($_SESSION['user_id'])) {
      try {
        $q = $db->prepare("select * from Users where user_id = :user_id");
        $q->execute(array(':user_id' => $_SESSION['user_id']));
        $response->logged_in = true;
        $response->user = $q->fetchObject();
      } catch(PDOException $e) {
        $response->logged_in = false;
        $response->message = "Failed to Select the User with that user_id!";
        $response->details = $e->getMessage();
        error(500,"Internal Server Error");
      }
    } else {
      $response->logged_in = false;
    }

  } else if($fn == 'get_object_by_id') {

    $type = $_GET['type'];
    try {
      $sql = "";
      if($type == 'user') {
        $sql = "select user_id, username, age, gender, location, super_user"
              ." from Users where user_id = :user_id";
      } else if($type == 'song') {
        $sql = "select s.song_id, s.title, s.year, s.duration, s.loudness, al.album_id, al.album_name, ar.artist_id, ar_artist_name"
              ." from Songs s, SFrom sf, Albums al, AlbumBy ab, Artists ar"
              ." where s.song_id = sf.song_id and sf.album_id = al.album_id"
              ." and al.album_id = ab.album_id and ab.artist_id = ar.artist_id"
              ." and s.song_id = :song_id";
      } else if($type == 'artist') {
        $sql = "select ar.artist_id, ar.artist_name, count(ab.album_id) as album_count"
              ." from Artists ar, AlbumBy ab"
              ." where ar.artist_id = :artist_id"
              ." and ab.artist_id = ar.artist_id"
              ." group by ar.artist_id";
      } else if($type == 'album') {
        $sql = "select al.album_id, al.album_name, ar.artist_id, ar.artist_name, count(sf.song_id) as song_count"
              ." from Albums al, SFrom sf, AlbumBy ab, Artists ar"
              ." where al.album_id = :album_id and al.album_id = ab.album_id"
              ." and al.album_id = sf.album_id and ab.artist_id = ar.artist_id"
              ." group by al.album_id";
      }
      $q = $db->prepare($sql);
      $q->execute(array(':'.$type.'_id' => $_GET[$type.'_id']));
      $response = $q->fetchObject();
    } catch(PDOException $e) {
      $response->message = "Failed to Select the User with that user_id!";
      $response->details = $e->getMessage();
      error(500,"Internal Server Error");
    }

  } else if($fn == 'search') {

    $type = $_GET['searchType'];
    $term = "%".$_GET['term']."%";
    $results_per_page = 50;
    $page = $_GET['page'];
    $offset = $page*$results_per_page;
    try {
      $sql = "";
      if($type == 'songs') {
        $sql = "select s.song_id, s.title, s.year, s.duration, s.loudness, al.album_id, al.album_name, ar.artist_id, ar.artist_name"
              ." from Songs s, SFrom sf, Albums al, AlbumBy ab, Artists ar"
              ." where title like :term and s.song_id = sf.song_id"
              ." and sf.album_id = al.album_id and al.album_id = ab.album_id"
              ." and ab.artist_id = ar.artist_id";
      } else if($type == 'artists') {
        $sql = "select ar.artist_id, ar.artist_name, count(ab.album_id) as album_count"
              ." from Artists ar, AlbumBy ab"
              ." where ar.artist_name like :term"
              ." and ab.artist_id = ar.artist_id"
              ." group by ar.artist_id";
      } else if($type == 'albums') {
        $sql = "select al.album_id, al.album_name, ar.artist_id, ar.artist_name, count(sf.song_id) as song_count"
              ." from Albums al, SFrom sf, AlbumBy ab, Artists ar"
              ." where album_name like :term and al.album_id = ab.album_id"
              ." and al.album_id = sf.album_id and ab.artist_id = ar.artist_id"
              ." group by al.album_id";
      } else if($type == 'concert-artist') {
        $sql = "select * from Concerts where name like :term";
      } else if($type == 'concert-location') {
        $sql = "select * from Concerts where location like :term";
      } else if($type == 'concert-date') {
        $sql = "select * from Concerts where date like :term";
      }else if($type == 'friends-username') {
        $sql = "select * from Users where username like :term";
      } else if($type == 'friends-location') {
        $sql = "select * from Users where location like :term";
      }

      $q = $db->prepare($sql." limit $results_per_page offset $offset");
      $response->term = $term;
      $q->execute(array(':term' => $term));
      $r = $db->query("select FOUND_ROWS() as totalrows");
      $response->message = "Search Successful";
      $response->page = $_GET['page'];
      $response->results = $q->fetchAll();
    } catch(PDOException $e) {
      $response->message = "Failed to Select from the Songs table!";
      $response->details = $e->getMessage();
      error(500,"Internal Server Error");
    }
    // end of $fn == 'search'

  } else if($fn == 'get_ads') {

    session_start();
    if(!isset($_GET['num_ads'])) {
      $response->message = "No num_ads field specified.  Number of ads to return is a required field.";
    } else {
      $num_ads = $_GET['num_ads'];
      $user_id = $_SESSION['user_id'];
      $q = $db->prepare("select * from Ads a, Searches s where (a.term_id=s.term_id) and (s.user_id=:user_id) limit $num_ads");
      $q->execute(array(':user_id' => $user_id));
      $response->results = $q->fetchAll();
      $response->message = "Ads returned in results field.";
    }

  } else if($fn == 'get_suggested_songs') {

    session_start();
    if(!isset($_GET['num_songs'])) {
      $response->message = "No num_songs field specified.  Number of songs to return is a required field.";
    } else {
      $num_songs = $_GET['num_songs'];
      $user_id = $_SESSION['user_id'];
      // THIS QUERY IS A F**KING MONSTER.  But it works??
      $q = $db->prepare("select d.song_id, so.title, al.album_name, ar.artist_name"
                       ." from Searches se, Describes d, Songs so, SFrom sf, Albums al, AlbumBy ab, Artists ar"
                       ." where se.user_id=:user_id and se.term_id=d.term_id"
                       ." and d.song_id = so.song_id and sf.song_id = so.song_id"
                       ." and sf.album_id = al.album_id and al.album_id = ab.album_id"
                       ." and ab.artist_id = ar.artist_id limit $num_songs");
      $q->execute(array(':user_id' => $user_id));
      $response->results = $q->fetchAll();
      $response->message = "Songs returned in results field.";
    }

  } else if($fn == 'get_suggested_friends') {

    session_start();
    if(!isset($_GET['num_friends'])) {
      $response->message = "No num_friends field specified.  Number of songs to return is a required field.";
    } else {
      $num_friends = $_GET['num_friends'];
      $user_id = $_SESSION['user_id'];
      // get a list of terms from current user

      $q = $db->prepare("select distinct u.username, u.age, u.location from Searches se, Users u where se.user_id=u.user_id and se.term_id IN (select s.term_id from Searches s where s.user_id=:user_id)");
      $q->execute(array(':user_id' => $user_id));
      $response->results = $q->fetchAll();
      $response->message = "Friends returned in results field.";
    }

  } else if($fn == 'get_suggested_concerts') {

    session_start();
    if(!isset($_GET['num_concerts'])) {
      $response->message = "No num_concerts field specified.  Number of songs to return is a required field.";
    } else {
      $num_concerts = $_GET['num_concerts'];
      $user_id = $_SESSION['user_id'];
      // get a list of terms from current user

      $q = $db->prepare("select c.name, c.venue, c.location, c.date from Concerts c, Users u where u.user_id=:user_id and c.location=u.location");
      $q->execute(array(':user_id' => $user_id));
      $response->results = $q->fetchAll();
      $response->message = "Concerts returned in results field.";
    }

  }

  // Output the response object as a JSON-encoded string
  echo json_encode($response);

?>
