<!-- Main jumbotron for a primary marketing message or call to action -->
<div class="jumbotron slim">
  <div class="container">
    <h2>
      <img src="<?php echo RES_PATH; ?>/img/artist_icon.png" class="obj-icon-lg" />
      View Artist: <strong class="artist_name">...</strong>
      <a class="btn btn-primary pull-right" href="musicnet.php?page=search">
        <span class="glyphicon glyphicon-search"></span>
        New Search
      </a>
    </h2>
  </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-md-4">
      <div id="artist-info">
        Loading...
      </div>
    </div>
    <div class="col-md-8">
      <h3>Albums by this Artist:</h3>
      <table id="artist-albums" class="table">
        <tr><td>Loading...</td></tr>
      </table>
    </div>
  </div>
</div>
