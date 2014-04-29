<!-- Main jumbotron for a primary marketing message or call to action -->
<div class="jumbotron slim">
  <div class="container">
    <h2>
      <img src="<?php echo RES_PATH; ?>/img/album_icon.png" class="obj-icon-lg" />
      View Album:
      <strong class="album_name">...</strong>
      by
      <a href="#" class="artist_link">...</a>
    </h2>
  </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-md-4">
      <div id="album-art">
        <img src="<?php echo RES_PATH; ?>/img/album_placeholder.png" />
      </div>
      <div id="album-info">
        Loading...
      </div>
    </div>
    <div class="col-md-8">
      <h3>Songs on this Album:</h3>
      <table id="album-songs" class="table">
        <tr><td>Loading...</td></tr>
      </table>
    </div>
  </div>
</div>
