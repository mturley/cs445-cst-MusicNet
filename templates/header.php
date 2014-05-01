
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
      <script> window.resPath = "<?php echo RES_PATH; ?>"; </script>
  </head>
  <body>
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
            <strong>MusicNet</strong>&nbsp;&nbsp;
            <span class="glyphicon glyphicon-music"></span>
            All the Music.&nbsp;&nbsp;
            <span class="glyphicon glyphicon-globe"></span>
            All the Net.
            <?php if($page != "home") { ?>
            <?php } ?>
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
          
              <ul class="nav nav-pills">
                <li class="active"><a href="musicnet.php">Home</a></li>
                <div class="dropdown floatright">
                 <a class="dropdown-toggle" data-toggle="dropdown" href="#">Search <span class="caret"></span>
                 </a>
                  <ul class="dropdown-menu">
                    <li role="presentation" class="dropdown-header"><a href="?page=search">Music</a></li>
                    <li role="presentation" class="dropdown-header"><a href="?page=friends">People</a></li>
                    <li role="presentation" class="dropdown-header"><a href="?page=concerts">Events</a></li>
                  </ul>
                </div>
                <li><a href="musicnet.php?page=user&user_id=<?php echo $_SESSION['user_id']; ?>">...</a></li>
                <li><a href="musicnet.php?page=logout" class="btn btn-info">Sign Out</a></li>
              </ul>
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
