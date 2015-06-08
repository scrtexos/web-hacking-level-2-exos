<?php
	if(isset($_SESSION['logged_in']) and $_SESSION['logged_in'] == 1) {
		header("Location: index.php");
	}
	$login = isset($_POST['login']) ? mysql_real_escape_string($_POST['login']) : "";
	$pass = isset($_POST['pass']) ? mysql_real_escape_string($_POST['pass']) : "";
	$badpass = 0;
	if($login !== "" and $pass !== "") {
		$query = "SELECT * FROM person WHERE name = '$login' AND password = '" . sha1("truite||" . $pass) . "'";
		$result = mysql_query($query) or die(mysql_error());
		if(mysql_num_rows($result) == 1) {
			//login successfull
			$line = mysql_fetch_array($result);
			$_SESSION['logged_in'] = 1;
			$_SESSION['user_id'] = $line['id'];
			header("Location: index.php");
		}
		else {
			$badpass = 1;
		}
	}
?>
<html>
<head>
	<title>TwittBook login</title>
	<link rel="stylesheet" type="text/css" href="styles.css"/>
</head>
<body>
<center>
<br/>
<?php if($badpass == 1) echo "Bad username/password combination.";?>
<br/><br/>
<form name="login" method="POST">
	<table class="login">
		<tr>
			<td>
				Name : 
			</td>
			<td>
				<input type="text" name="login"/>
			</td>
		</tr>
		<tr>
			<td>
				Password : 
			</td>
			<td>
				<input type="password" name="pass"/>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<br/>
				<input type="Submit" value="Connexion"/>
			</td>
		</tr>
	</table>
</form>
<a href="register.php">Create a new user</a>
</center>
</body>
</html>