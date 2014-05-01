<div class="jumbotron slim">
  <div class="container">
    <h2 class="floatleft">Find Concerts</h2>
    <div id="search-type" class="btn-group btn-group-lg floatleft">
      <button type="button" class="btn btn-primary" data-search-type="concert-artist">Search by Artist</button>
      <button type="button" class="btn btn-default" data-search-type="concert-location">Search by Location</button>
      <button type="button" class="btn btn-default" data-search-type="concert-date">Search by Date</button>
    </div>
    <?php include("templates/dropdown.php") ?>
  </div>
</div>

<div class="container">
  <p>
	<form class="form-horizontal" id="search-form">
  	<fieldset>
	  <div class="form-group">
      <label class="col-md-1 control-label" for="prependedtext"></label>
	    <div class="col-md-8">
        <div class="input-group search-group">
             <span class="input-group-addon addonborder"><span class="glyphicon glyphicon-search bigicon"></span></span>
	             <input id="searchinput" name="searchinput" type="search" placeholder="Search by Artist" class="form-control input-md">
        </div>
        <h2 class="press-enter" style="display: none;">(press enter to search)</h2>
        <div id="search-results" style="display: none;">
          <h2><span class="type">...</span> matching your search: "<span class="term"></span>":</h2>
          <table class="results table"></table>
        </div>
	    </div>
	  </div>
	</fieldset>
  </form>
</p>
</div>

<div class="jumbotron slim">
      <div class="container">
        <h2>Concerts Near You</h2>
        <div id="sugConcerts">Loading Suggestions...</div>
      </div>
    </div>
