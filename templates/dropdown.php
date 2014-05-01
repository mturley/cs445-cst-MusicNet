<div id="drop" style="float: right; v-align:top; margin-right:30px">
<ul class="nav nav-pills">
	<li class="active"><a href="#">Home</a></li>
  <li class="dropdown">
   <a class="dropdown-toggle" data-toggle="dropdown" href="#">Search <span class="caret"></span>
    </a>
    <ul class="dropdown-menu">
    	<li role="presentation" class="dropdown-header"><a href="?page=search">Music</a></li>
    	<li role="presentation" class="dropdown-header"><a href="?page=friends">People</a></li>
    	<li role="presentation" class="dropdown-header"><a href="?page=concerts">Events</a></li>
    </ul>
  </li>
<li><a href="#"><a class="data-username" href="musicnet.php?page=user&user_id=<?php echo $_SESSION['user_id']; ?>">...</a></li>
<li><a href="musicnet.php?page=logout" class="btn btn-info">Sign Out</a></li>
</ul>
</div>
