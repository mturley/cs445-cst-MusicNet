<div class="jumbotron slim">
  <div class="container">
    <h2 class="floatleft">Find Concerts</h2>
    <div id="search-type" class="btn-group btn-group-lg floatleft">
    <button type="button" class="btn btn-primary" data-search-type="artist">Search by Artist</button>
    <button type="button" class="btn btn-default" data-search-type="location">Search by Location</button>
    <button type="button" class="btn btn-default" data-search-type="date">Search by Date</button>
    </div>
  </div>
</div>

<div class="container">
  <p>
	<form class="form-horizontal">
  	<fieldset>
	  <div class="form-group">
      <label class="col-md-1 control-label" for="prependedtext"></label>
	    <div class="col-md-8">
        <div class="input-group search-group">
             <span class="input-group-addon addonborder"><span class="glyphicon glyphicon-search bigicon"></span></span>
	             <input id="searchinput" name="searchinput" type="search" placeholder="Search by Artist" class="form-control input-md">
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
