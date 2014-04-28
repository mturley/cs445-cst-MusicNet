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
  <form id="search-form" class="form-horizontal">
  <fieldset>

  <!-- Search input-->
  <!--
  <div class="form-group">
    <label class="col-md-4 control-label" for="searchinput"><span class="glyphicon glyphicon-search bigicon"></span></label>
    <div class="col-md-6">
      <input id="searchinput" name="searchinput" type="search" placeholder="placeholder" class="form-control input-md">

    </div>
  </div>
-->

  <!-- Prepended text-->
  <div class="form-group">
    <label class="col-md-2 control-label" for="prependedtext"></label>
    <div class="col-md-8">
      <div class="search-margin">&nbsp;</div>
      <div class="input-group search-group">
        <span class="input-group-addon addonborder"><span class="glyphicon glyphicon-search bigicon"></span></span>
        <input id="searchinput" name="prependedtext" class=."form-control" placeholder="Search for a Song" type="text">
      </div>
      <h2 class="press-enter" style="display: none;">(press enter to search)</h2>
      <div class="search-margin">&nbsp;</div>
      <div id="search-results" style="display: none;">
        <h2>Search results for: "<span class="term"></span>":</h2>
        <table class="results">
        </table>
      </div>
    </div>
  </div>

  </fieldset>
  </form>

</div>
