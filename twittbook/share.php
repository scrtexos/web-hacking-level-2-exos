<?php
	$query = "SELECT timestampdiff(second,submission,now()) as t from shares WHERE person_id = " . $_SESSION['user_id'] . " ORDER BY submission DESC LIMIT 1";
	$result = mysql_query($query) or die(mysql_error());
	$line = mysql_fetch_array($result);
	if(mysql_num_rows($result) > 0 && $line['t'] < 2) {
		die("You cannot post that fast!");
	}
	$content = isset($_GET['content']) ? mysql_real_escape_string($_GET['content']) : "";
	if($content !== "") {
		$query = "insert into shares (person_id,content,submission) VALUES (" . $_SESSION['user_id'] . ",'$content',now())";
		mysql_query($query) or die(mysql_error());
	}
?>