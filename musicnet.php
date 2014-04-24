<?php
  define('RES_PATH', '/groups/cst/www');
  $page = 'home';
  if(isset($_GET['page'])) $page = $_GET['page'];

  session_start();
  $logged_in = false;
  if(isset($_SESSION['user_id'])) $logged_in = true;
?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
  <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
      <title></title>
      <meta name="description" content="">
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <link rel="stylesheet" href="<?php echo RES_PATH; ?>/css/bootstrap.min.css">
      <style>
          body {
              padding-top: 50px;
              padding-bottom: 20px;
          }
      </style>
      <link rel="stylesheet" href="<?php echo RES_PATH; ?>/css/bootstrap-theme.min.css">
      <link rel="stylesheet" href="<?php echo RES_PATH; ?>/css/main.css">

      <script src="<?php echo RES_PATH; ?>/js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
  </head>
  <body class="<?php echo $page; ?>-page">
    <!--[if lt IE 7]>
        <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="musicnet.php">
            <strong>MusicNet&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-music"></span>&nbsp;&nbsp;&nbsp;</strong>
            All the Music. All the Net.
          </a>
          <div class="please-wait" id="floatingBarsG" style="display: none;">
            <div class="blockG" id="rotateG_01">
            </div>
            <div class="blockG" id="rotateG_02">
            </div>
            <div class="blockG" id="rotateG_03">
            </div>
            <div class="blockG" id="rotateG_04">
            </div>
            <div class="blockG" id="rotateG_05">
            </div>
            <div class="blockG" id="rotateG_06">
            </div>
            <div class="blockG" id="rotateG_07">
            </div>
            <div class="blockG" id="rotateG_08">
            </div>
          </div>
        </div>
        <div class="navbar-collapse collapse">
          <?php
            if($logged_in) {
          ?>
            <div class="navbar-form navbar-right" style="color: white;">
              <big>
                Signed In As:&nbsp;
                <a class="data-username" href="musicnet.php?page=user&user_id=<?php echo $_SESSION['user_id']; ?>">...</a>
              </big>&nbsp;&nbsp;
              <a href="musicnet.php?page=logout" class="btn btn-info">Sign Out</a>
            </div>
          <?php
            } else {
          ?>
          <form class="navbar-form navbar-right" role="form" id="login-form">
            <div class="form-group">
              <input type="text" placeholder="User ID" class="form-control" name="user_id">
            </div>
            <div class="form-group">
              <input type="password" placeholder="Password" class="form-control" name="password">
            </div>
            <button type="submit" class="btn btn-success">Sign in</button>
            <a href="musicnet.php?page=register" class="btn btn-info">Register</a>
          </form>
          <?php
            }
          ?>
        </div><!--/.navbar-collapse -->
      </div>
    </div>

    <?php
      if($page == 'home') {
        if($logged_in) {
    ?>
          <div class="jumbotron slim">
            <div class="container">
              <h3>Welcome back, <?php echo $_SESSION['user_id']; ?>!</h3>
            </div>
          </div>
          <div class="container">
            <div class="row feature-buttons">
              <div class="col-md-4">
                <a class="btn btn-block btn-primary" href="musicnet.php?page=search" role="button">
                  <span class="glyphicon glyphicon-search"></span>&nbsp;&nbsp;Search for Music
                </a>
              </div>
              <div class="col-md-4">
                <a class="btn btn-block btn-default" href="musicnet.php?page=friends" role="button">
                  <span class="glyphicon glyphicon-comment"></span>&nbsp;&nbsp;Make Friends
                </a>
             </div>
              <div class="col-md-4">
                <a class="btn btn-block btn-default" href="musicnet.php?page=concerts" role="button">
                  <span class="glyphicon glyphicon-tag"></span>&nbsp;&nbsp;Find Concerts
                </a>
              </div>
            </div>
          </div>
    <?php
        } else {
    ?>
          <div class="jumbotron">
            <div class="container">
              <h1>Welcome to MusicNet!</h1>
              <p>
                MusicNet is a simple PHP / MySQL WebApp built by Mike Turley, Eric Smith and Xian Chen for CS445 in Spring 2014.
                It provides user authentication and an interface to browse and query an extensive database of Music data.
                We should write a better introductory blurb here. meow.
              </p>
              <h3>
                Ready to get started?&nbsp;&nbsp;
                <a class="btn btn-primary btn-lg" href="musicnet.php?page=register" role="button">
                  Register an Account
                </a>
                &nbsp;or sign in above!
              </h3>
            </div>
          </div>
    <?php
        }
    ?>

      <div class="container">
        <!-- Example row of columns -->
        <div class="row">
          <div class="col-md-4">
            <h2>Feature 1</h2>
            <p>We can talk about individual features of the app here, in these little blurb thingies.  Very cool!</p>
            <!--<p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>-->
          </div>
          <div class="col-md-4">
            <h2>Feature 2</h2>
            <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
            <!--<p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>-->
         </div>
          <div class="col-md-4">
            <h2>Feature 3</h2>
            <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
            <!--<p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>-->
          </div>
        </div>
      </div> <!-- /container -->

    <?php
      } // $page == 'home'
      if($page == 'register') {
    ?>

      <!-- Main jumbotron for a primary marketing message or call to action -->
      <div class="jumbotron slim">
        <div class="container">
          <h2>New User Registration</h2>
        </div>
      </div>

      <div class="container">
        <form class="form-horizontal" id="registration-form">
        <fieldset>

        <!-- Form Name -->
        <legend>Please enter your information below to register a new MusicNet user account.</legend>

        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="user_id">User ID</label>
          <div class="col-md-3">
          <input id="user_id" name="user_id" type="text" placeholder="john_doe" class="form-control input-md" required="">

          </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="username">Name</label>
          <div class="col-md-3">
          <input id="username" name="username" type="text" placeholder="John Doe" class="form-control input-md" required="">

          </div>
        </div>

        <!-- Password input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="password">Password</label>
          <div class="col-md-3">
            <input id="password" name="password" type="password" placeholder="" class="form-control input-md" required="">

          </div>
        </div>

        <!-- Password input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="password_confirm">Confirm Password</label>
          <div class="col-md-3">
            <input id="password_confirm" name="password_confirm" type="password" placeholder="" class="form-control input-md" required="">

          </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="age">Age</label>
          <div class="col-md-1">
          <input id="age" name="age" type="text" placeholder="" class="form-control input-md">

          </div>
        </div>

        <!-- Select Basic -->
        <div class="form-group">
          <label class="col-md-4 control-label" for="gender">Gender</label>
          <div class="col-md-2">
            <select id="gender" name="gender" class="form-control">
              <option value="Male">Male</option>
              <option value="Female">Female</option>
            </select>
          </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="location">Location</label>
          <div class="col-md-3">
          <input id="location" name="location" type="text" placeholder="" class="form-control input-md">

          </div>
        </div>

        <!-- Button (Double) -->
        <div class="form-group">
          <label class="col-md-4 control-label" for="submit"></label>
          <div class="col-md-8">
            <button id="register-submit" name="submit" class="btn btn-success">Complete Registration</button>
            <button id="register-cancel" name="cancel" class="btn btn-danger">Cancel</button>
          </div>
        </div>

        </fieldset>
        </form>

      </div> <!-- /container -->

    <?php
      } // $page == 'register'
      if($page == 'user') {
    ?>

      <!-- Main jumbotron for a primary marketing message or call to action -->
      <div class="jumbotron slim">
        <div class="container">
          <h2>View User: <?php echo $_GET['user_id']; ?></h2>
        </div>
      </div>

      <div class="container">
        <h2>User Profile Information:</h2>
        <div id="user-info">
          Loading...
        </div>
      </div>

    <?php
      } // $page == 'user'
      if($page == 'search') {
    ?>

        <div class="jumbotron slim">
          <div class="container">
            <h2>Search for Music</h2>
          </div>
        </div>

        <div class="container">
          <h2>TODO: build query features into this page</h2>
        </div>

        <div class="btn-group btn-group-lg">
          <button type="button" class="btn btn-default">Search Songs</button>
          <button type="button" class="btn btn-default">Middle</button>
          <button type="button" class="btn btn-default">Right</button>
        </div>

    <?php
      } // $page == 'search'
      if($page == 'friends') {
    ?>

        <div class="jumbotron slim">
          <div class="container">
            <h2>Find Friends</h2>
          </div>
        </div>

        <div class="container">
          <h2>TODO: build friend-request and communication features into this page</h2>
        </div>

    <?php
      } // $page == 'friends'
      if($page == 'concerts') {
    ?>

        <div class="jumbotron slim">
          <div class="container">
            <h2>Find Concerts</h2>
          </div>
        </div>

        <div class="container">
          <h2>TODO: build concert aggregator features into this page</h2>
        </div>

    <?php
      } // $page == 'concerts'
    ?>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="<?php echo RES_PATH; ?>/js/vendor/jquery-1.11.0.min.js"><\/script>')</script>

    <script src="<?php echo RES_PATH; ?>/js/vendor/bootstrap.min.js"></script>

    <script src="<?php echo RES_PATH; ?>/js/plugins.js"></script>
    <script src="<?php echo RES_PATH; ?>/js/main.js"></script>

    <?php
      if($logged_in) {
    ?>
        <script>
          $(document).ready(function() {

            // load the profile data for the logged in user

            $(".please-wait").show();
            $.ajax({
              type: 'GET',
              url: 'backend.php',
              data: {
                fn: 'get_user_by_id',
                user_id: '<?php echo $_SESSION['user_id'] ?>'
              },
              success: function(response) {
                $(".please-wait").hide();
                var r = $.parseJSON(response);
                $(".data-username").html(r.username);
              },
              error: function(response) {
                $(".please-wait").hide();
                bootbox.alert("Failed to load user data!  Error Message: "+$.parseJSON(response.responseText).message);
              }
            });

          });
        </script>
    <?php
      }
    ?>

  </body>
</html>
