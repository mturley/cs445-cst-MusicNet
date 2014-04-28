<div class="jumbotron slim">
  <div class="container">
    <h2 class="floatleft">Search for Music</h2>
    <div id="search-type" class="btn-group btn-group-lg floatleft">
      <button type="button" class="btn btn-primary" data-search-type="songs">Search Songs</button>
      <button type="button" class="btn btn-default" data-search-type="artists">Search Artists</button>
      <button type="button" class="btn btn-default" data-search-type="albums">Search Albums</button>
    </div>
  </div>
</div>

<div class="container">
  <form class="form-horizontal">
  <fieldset>

  <!-- Search input-->
  <div class="form-group">
    <label class="col-md-4 control-label" for="searchinput"><span class="glyphicon glyphicon-search bigicon"></span></label>
    <div class="col-md-6">
      <input id="searchinput" name="searchinput" type="search" placeholder="placeholder" class="form-control input-md">

    </div>
  </div>

  <!-- Prepended text-->
  <div class="form-group">
    <label class="col-md-4 control-label" for="prependedtext"></label>
    <div class="col-md-6">
      <div class="input-group">
        <span class="input-group-addon">prepend</span>
        <input id="prependedtext" name="prependedtext" class="form-control" placeholder="Search" type="text">
      </div>

    </div>
  </div>

  </fieldset>
  </form>

</div>
