<?php
	$login = isset($_POST['login']) ? mysql_real_escape_string($_POST['login']) : "";
	$pass = isset($_POST['pass']) ? mysql_real_escape_string($_POST['pass']) : "";
	$pass2 = isset($_POST['pass2']) ? mysql_real_escape_string($_POST['pass2']) : "";
	$baduser = 0;
	if($login !== "" and $pass !== "" and $pass2 !== "") {
		if($pass == $pass2) {
			$query = "SELECT * FROM person WHERE name = '$login'";
			$result = mysql_query($query) or die(mysql_error());
			if(mysql_num_rows($result) == 0) {
				$query = "INSERT INTO person (name,password) VALUES('$login',sha1('truite||".$pass."'))";
				mysql_query($query) or die(mysql_error());
				$query2 = "INSERT INTO friends (person1,person2) values (2," . mysql_insert_id() . ")";
                                mysql_query($query2) or die(mysql_error());

				header("Location: index.php");
			}
			else {
				$baduser = 1;
			}
		}
		else {
			$baduser = 2;
		}
	}


?>
<html>
<head>
	<title>TwittBook registration</title>
	<link rel="stylesheet" type="text/css" href="styles.css"/>
</head>
<body>
<center>
<br/>
<?php if($baduser == 1) echo "User already exists.";?>
<?php if($baduser == 2) echo "Passwords do not match.";?>
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
			<td>
				Confirm : 
			</td>
			<td>
				<input type="password" name="pass2"/>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<br/>
				<input type="Submit" value="Créer"/>
			</td>
		</tr>
	</table>
</form>
<a href="login.php">Return to login</a>
</center>
</body>
</html>
