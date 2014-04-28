<?php
  define('RES_PATH', '/groups/cst/www');
  $page = 'home';
  if(isset($_GET['page'])) $page = $_GET['page'];

  session_start();
  $logged_in = false;
  if(isset($_SESSION['user_id'])) $logged_in = true;

  require('templates/header.php');
  require('templates/body-'.$page.'.php');
  require('templates/footer.php');
?>
