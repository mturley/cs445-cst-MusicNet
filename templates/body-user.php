<div class="jumbotron slim">
  <div class="container">
    <h3>
      <span class="glyphicon glyphicon-search"></span>&nbsp;
      View User: <?php echo $_GET['user_id']; ?>
    </h3>
  </div>
</div>

<div class="container">
	<table width="90%"><tr><td width="250px" valign="top">
		User Information
		<hr>
		<div id="user-info">
			Loading...
		</div>
		</table>

    <button id="add-friend" class="btn btn-success">
      <span class="glyphicon glyphicon-plus"></span>
      Add Friend
    </button>
    <button id="remove-friend" class="btn btn-danger" style="display: none;">
      <span class="glyphicon glyphicon-minus"></span>
      Remove Friend
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
