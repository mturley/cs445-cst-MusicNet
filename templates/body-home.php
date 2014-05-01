<div id="topimg"></div>
      <?php
  if($logged_in) {
?>
    <div class="jumbotron floating">
      <div class="container">
        <h2>Welcome back, <span class="data-username">...</span>!</h2>
      </div>
    </div>

    <div class="container ">
      <div class="row feature-buttons">
        <div class="col-md-3">
          <a class="btn btn-block btn-primary" href="musicnet.php?page=search" role="button">
            <span class="glyphicon glyphicon-headphones"></span>&nbsp;&nbsp;Find Music
          </a>
        </div>
        <div class="col-md-3">
          <a class="btn btn-block btn-info" href="musicnet.php?page=shop" role="button">
            <span class="glyphicon glyphicon-shopping-cart"></span>&nbsp;&nbsp;Buy Music
          </a>
        </div>
        <div class="col-md-3">
          <a class="btn btn-block btn-success" href="musicnet.php?page=friends" role="button">
            <span class="glyphicon glyphicon-comment"></span>&nbsp;&nbsp;Find Friends
          </a>
        </div>
        <div class="col-md-3">
          <a class="btn btn-block btn-default" href="musicnet.php?page=concerts" role="button">
            <span class="glyphicon glyphicon-tag"></span>&nbsp;&nbsp;Find Concerts
          </a>
        </div>
      </div>
    </div>
<?php
    // logged in above
  } else {
    // logged out below
?>
    <div class="floating container">
      <h1>Welcome to MusicNet!</h1>
    </div>
    <div class="jumbotron">
      <div class="container">
        <p>
          MusicNet is a simple PHP / MySQL WebApp built by Mike Turley, Eric Smith and Xian Chen for CS445 in Spring 2014.
          It provides user authentication and an interface to browse and query an extensive database of Music data.
        </p>
        <h3>
          Ready to get started?&nbsp;&nbsp;
          <a class="btn btn-primary btn-lg" href="musicnet.php?page=register" role="button">
            Register an Account
          </a>
          &nbsp;or&nbsp;
          <a class="btn btn-primary btn-lg" href="musicnet.php?page=search" role="button">
            <span class="glyphicon glyphicon-search"></span> Search for Music
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
    <div class="col-md-3">
      <h2>Endless Music</h2>
      <p>Search of huge library of music by song, artist or album. MusicNet will help to find even the most obscure music using search by terms.</p>
      <!--<p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>-->
    </div>
    <div class="col-md-3">
      <h2>Build a Library</h2>
      <p>Browse various digital music stores and view the libraries they offer.  When searching for music, songs available for purchase will have a "Buy" button.</p>
      <!--<p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>-->
    </div>
    <div class="col-md-3">
      <h2>Make Friends</h2>
      <p>MusicNet has thousands of other users like you! Find friends with similar music taste and who go to the same shows you do!  </p>
      <!--<p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>-->
   </div>
    <div class="col-md-3">
      <h2>Buy Tickets</h2>
      <p>Is your favorite artist in town? MusicNet has the latest concert information for artists in your area! </p>
      <!--<p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>-->
    </div>
  </div>
</div> <!-- /container -->

<?php
  if($logged_in) {
?>
    <br /><br />
    <div class="jumbotron slim">
      <div class="container">
        <h2>Music Suggestions</h2>
        <div id="relsongs">Loading Suggestions...</div>
      </div>
    </div>
<?php
  }
?>

<br /><br />
