<div class="jumbotron slim">
  <div class="container">
    <h2>
      <span class="glyphicon glyphicon-search"></span>&nbsp;
      View User: <?php echo $_GET['user_id']; ?>
       <?php include("templates/dropdown.php") ?>
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
