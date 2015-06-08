<?php
  header("Access-Control-Allow-Origin: http://*.formation.scrt");
  header("Access-Control-Allow-Methods: GET");
  header("Access-Control-Allow-Credentials: true");
	session_start();
	if($_SERVER['PHP_SELF'] !== "/twittbook/login.php" and $_SERVER['PHP_SELF'] !== "/twittbook/register.php" and (!isset($_SESSION['logged_in']) or $_SESSION['logged_in'] != 1)) {
		header("Location: /twittbook/login.php");
	}
	mysql_connect("localhost","root","") or die(mysql_error());
	mysql_select_db("twittbook") or die(mysql_error());
?>
