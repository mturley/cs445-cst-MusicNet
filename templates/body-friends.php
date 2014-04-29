<div class="jumbotron slim">
  <div class="container">
     <h2 class="floatleft">Find Friends</h2>
    <div id="search-type" class="btn-group btn-group-lg floatleft">
    <button type="button" class="btn btn-primary" data-search-type="friends-username">Search by Username</button>
    <button type="button" class="btn btn-default" data-search-type="friends-location">Search by Location</button>
    </div>
  </div>
</div>

<div class="container">
	<p>
	<form class="form-horizontal" id="search-form">
  	<fieldset>
	  <div class="form-group">
      <div class="col-md-1"></div>
	    <div class="col-md-8">
	    	<div class="input-group search-group">
	       		 <span class="input-group-addon addonborder"><span class="glyphicon glyphicon-search bigicon"></span></span>
		      <input id="searchinput" name="searchinput" type="search" placeholder="Search by Username" class="form-control input-md">
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
        <h2>Friend Suggestions</h2>
        <div id="sugFriends">Loading Suggestions...</div>
      </div>
    </div>
