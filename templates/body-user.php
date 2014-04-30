<div class="container">
 <div class="dropdown">
  <button class="btn dropdown-toggle sr-only" type="button" id="dropdownMenu1" data-toggle="dropdown">
    Dropdown
    <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Action</a></li>
    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another action</a></li>
    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Something else here</a></li>
    <li role="presentation" class="divider"></li>
    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Separated link</a></li>
  </ul>
</div>
</div>

<div class="jumbotron slim">
  <div class="container">
    <h2>
      <span class="glyphicon glyphicon-search"></span>&nbsp;
      View User: <?php echo $_GET['user_id']; ?>
      <div id="drop" style="text-align: right"> drop down&nbsp; link &nbsp;link</div>
    </h2>
  </div>
</div>

<div class="container">
	<table width="90%"><tr><td width="250px">
		User Information
		<hr>
		<div id="user-info">
			Loading...
		</div>
		</td><td valign="top">
		User Activity
		<hr>
		<div id="userActivity">
			USER ACTIVITY FEED HERE...<br>
			USER ACTIVITY FEED HERE...<br>
		</div>
	</td></tr></table>
</div>
<br><br>
