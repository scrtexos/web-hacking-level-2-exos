<?php
$_SESSION['userid'] = 0;
session_destroy();
header("Location: login.php");
die();
?>