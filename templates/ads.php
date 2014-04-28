<?php 
	$con = mysql_connect("cs445sql", "mturley","EL950mtu");

	if (!$con){
		die('Could not conect: ' . mysql_error());
	}
		
	mysql_select_db("cst", $con);
	$userid=$_SESSION['user_id'];
	//$userid= "'".$_SESSION['user_id']."'";
	echo $userid;
	$sql = "SELECT * FROM Ads a";
	//$sql = "SELECT * FROM Ads a, Searches u where (a.term_id=u.term_id) and (u.user_id='.$userid.')";
	$rs_result = mysql_query ($sql,$con); 

	?>

	<center>
	
	<? while ($row = mysql_fetch_assoc($rs_result)) { ?>
		<img src="<? echo $row["ad_img_src"]; ?>" class="ad">
		
	<? } ?>
	</center>