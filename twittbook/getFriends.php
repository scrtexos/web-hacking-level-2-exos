Friends<br/><br/>
<?php
	$query = "SELECT * FROM person WHERE id IN (SELECT person2 FROM friends WHERE person1 = " . $_SESSION['user_id'] . " UNION ALL SELECT person1 FROM friends WHERE person2 = " . $_SESSION['user_id'] . ") OR id = " . $_SESSION['user_id'];
	$result = mysql_query($query) or die(mysql_error());
	while($line = mysql_fetch_array($result)) {
	?>
	

	<div class="friend">
	
	<div class="friend_pic"><img src="blah.gif" width=60 height=40/></div>
	<div class="friend_status"><b><?php echo $line['name'];?></b><br/>is <i><?php echo $line['status'];?></i></div>
	<div style="clear: both"></div>
</div>
<?php } ?>