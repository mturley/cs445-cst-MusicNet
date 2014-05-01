<div id="topimg"></div>
<div class="jumbotron slim floating">
  <div class="container">
    <h2 class="floatleft">Search for Music</h2>
    <div id="search-type" class="btn-group btn-group-lg floatleft">
      <button type="button" class="btn btn-primary" data-search-type="songs">Search Songs</button>
      <button type="button" class="btn btn-default" data-search-type="artists">Search Artists</button>
      <button type="button" class="btn btn-default" data-search-type="albums">Search Albums</button>
    </div>
    <!--<h2 class="floatleft">
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      Filter Results:&nbsp;
      <a class="btn btn-info filter-by-year">by Year</a>
    </h2>-->
  </div>
</div>

<div class="container">
  <form id="search-form" class="form-horizontal">
  <fieldset>

  <!-- Prepended text-->
  <div class="form-group">
    <div class="col-md-12">
      <div class="input-group search-group col-md-10">
        <span class="input-group-addon addonborder"><span class="glyphicon glyphicon-search bigicon"></span></span>
        <input id="searchinput" name="prependedtext" class="form-control" placeholder="Search for a Song" type="text">
      </div>
      <!--<h3 class="filters" style="display: none;">
        Filtering search <span class="filter-description">...</span>
        <a class="btn btn-default clear-filters" href="#">Remove Filter</a>
      </h3>-->
      <h2 class="press-enter" style="display: none;">(press enter to search)</h2>
      <div id="search-results" style="display: none;">
        <h2>
          <span class="search-type">...</span>
          matching your search: "<span class="search-term"></span>":
          <a class="btn pull-right btn-primary clear-search" href="#">
            <span class="glyphicon glyphicon-search"></span> New Search
          </a>
        </h2>
        <table class="results table"></table>
      </div>
    </div>
  </div>

  </fieldset>
  </form>

</div><br><br><br>
