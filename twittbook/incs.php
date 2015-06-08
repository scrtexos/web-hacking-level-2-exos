<?php
	$host = "localhost";
	$uname = "root";
	$upass = "root";
	$udb = "twittbook";
	mysql_connect($host,$uname,$upass) or die(mysql_error());
	mysql_select_db($udb) or die(mysql_error());
?>
