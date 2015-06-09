<?php
	$status = isset($_GET['status']) ? mysql_real_escape_string(urldecode($_GET['status'])) : "";
	//if($status !== "") {
		$query = "update person set status = '$status' where id = " . $_SESSION['user_id'];
		mysql_query($query) or die(mysql_error());
	//}
?>
