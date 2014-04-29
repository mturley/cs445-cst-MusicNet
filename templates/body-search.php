<div class="jumbotron slim">
  <div class="container">
    <h2 class="floatleft">Search for Music</h2>
    <div id="search-type" class="btn-group btn-group-lg floatleft">
      <button type="button" class="btn btn-primary" data-search-type="songs">Search Songs</button>
      <button type="button" class="btn btn-default" data-search-type="artists">Search Artists</button>
      <button type="button" class="btn btn-default" data-search-type="albums">Search Albums</button>
    </div>
    <h2 class="floatleft">Filter Results</h2>
    <div id="filters">
      <a class="btn btn-info filter-by-year">by Year</a>
    </div>
  </div>
</div>

<div class="container">
  <form id="search-form" class="form-horizontal">
  <fieldset>

  <!-- Prepended text-->
  <div class="form-group">
    <label class="col-md-2 control-label" for="prependedtext"></label>
    <div class="col-md-8">
      <div class="input-group search-group">
        <span class="input-group-addon addonborder"><span class="glyphicon glyphicon-search bigicon"></span></span>
        <input id="searchinput" name="prependedtext" class=."form-control" placeholder="Search for a Song" type="text">
      </div>
      <h2 class="press-enter" style="display: none;">(press enter to search)</h2>
      <div id="search-results" style="display: none;">
        <h2>
          <span class="search-type">...</span>
          matching your search: "<span class="search-term"></span>":
          <a class="btn pull-right btn-default clear-search" href="#">New Search</a>
        </h2>
        <table class="results table"></table>
      </div>
    </div>
  </div>

  </fieldset>
  </form>

</div><br><br><br>
