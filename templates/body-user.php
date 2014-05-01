<div class="jumbotron slim">
  <div class="container">
    <h3>
      <span class="glyphicon glyphicon-search"></span>&nbsp;
      View User: <?php echo $_GET['user_id']; ?>
    </h3>
  </div>
</div>

<div class="container">
	<table width="90%"><tr><td width="250px">
		User Information
		<hr>
		<div id="user-info">
			Loading...
		</div>

    <button id="add_friend" class="btn btn-success">
      <span class="glyphicon glyphicon-plus"></span>
      Add Friend
    </button>

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
