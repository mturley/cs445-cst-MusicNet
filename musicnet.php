<?php
  define('RES_PATH', '/groups/cst/www');
  $page = 'home';
  if(isset($_GET['page'])) $page = $_GET['page'];
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
          <a class="navbar-brand" href="musicnet.php"><strong>MusicNet&nbsp;&nbsp;|&nbsp;&nbsp;</strong>All the Music. All the Net.</a>
          <img id="please-wait" src="<?php echo RES_PATH; ?>/img/loading.gif" style="display: none;" />
        </div>
        <div class="navbar-collapse collapse">
          <form class="navbar-form navbar-right" role="form">
            <div class="form-group">
              <input type="text" placeholder="User ID" class="form-control" name="user_id">
            </div>
            <div class="form-group">
              <input type="password" placeholder="Password" class="form-control" name="password">
            </div>
            <button type="submit" class="btn btn-success">Sign in</button>
            <a href="musicnet.php?page=register" class="btn btn-info">Register</a>
          </form>
        </div><!--/.navbar-collapse -->
      </div>
    </div>

    <?php
      if($page == 'home') {
    ?>

      <!-- Main jumbotron for a primary marketing message or call to action -->
      <div class="jumbotron">
        <div class="container">
          <h1>Hello, world!</h1>
          <p>This is a template for a simple marketing or informational website. It includes a large callout called a jumbotron and three supporting pieces of content. Use it as a starting point to create something more unique.</p>
          <p><a class="btn btn-primary btn-lg" role="button">Learn more &raquo;</a></p>
        </div>
      </div>

      <div class="container">
        <!-- Example row of columns -->
        <div class="row">
          <div class="col-md-4">
            <h2>Heading</h2>
            <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
            <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
          </div>
          <div class="col-md-4">
            <h2>Heading</h2>
            <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
            <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
         </div>
          <div class="col-md-4">
            <h2>Heading</h2>
            <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
            <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
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
    ?>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="<?php echo RES_PATH; ?>/js/vendor/jquery-1.11.0.min.js"><\/script>')</script>

    <script src="<?php echo RES_PATH; ?>/js/vendor/bootstrap.min.js"></script>

    <script src="<?php echo RES_PATH; ?>/js/plugins.js"></script>
    <script src="<?php echo RES_PATH; ?>/js/main.js"></script>
  </body>
</html>