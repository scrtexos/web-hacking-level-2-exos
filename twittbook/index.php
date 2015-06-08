<html>
<head>
<title>TwittBook 2.0</title>
<link rel="StyleSheet" href="styles.css" type="text/css"/>
<script src="js.js"></script>
<!--<script src="jquery.js"></script>-->
</head>
<body onload="document.getElementById('talk').focus()">
<center>
<div id="global">
<div id="header">
TwittBook 2.0!
</div>
<div id="top">
<a href="logout.php">Logout</a><br/>
Say something here : <input id="talk" type="text" onkeyup="shareit(event)"/><input type="submit" id="talk2" value="share" onclick="share()"/>
</div>
<div id="left">
<div class="profile">
	<?php 
		$query = "SELECT * FROM person WHERE id = " . $_SESSION['user_id'];
		$result = mysql_query($query) or die(mysql_error());
		$line = mysql_fetch_array($result);
	?>
	Your Profile<br/><br/>
	<div class="profile_pic"><img src="blah.gif" width=140 height=100/></div>
	<div class="profile_desc"><b>Name :</b><?php echo $line['name'];?><br/>
	<b>Birthday :</b> 12-12-1912<br/>
	<b>Sex :</b> Male<br/>
	<b>Status :</b><?php echo $line['status'];?> <input type="text" id="status" onkeyup="setStatus(event)"/>
	<center><input type="submit" value="Delete profile" style="background-color: red; color: white;" onclick="deleteme()"/></center>
	</div>
</div>
</div>
<div id="content">

</div>
<div id="right">

</div>
<br/>
<div id="footer">
&copy; SCRT Information Technology 2009
</div>
</div>
<script>
	updateContent();
	updateFriends();
	/*$.get("getContent.php",function(data){handle(data)});
	function handle(data) {
		eval("myShares="+data);
		for(i = 0; i < myShares.length; i++) {
			$("#content").append("<div class='share'><div class='share_time'>"+myShares[i].time+ "</div><div class='share_person'>" + myShares[i].person + "</div><div style='clear:both'></div> <div class='share_content'>" + myShares[i].content + "</div></div>");
		}
		//alert(data);
		
	}*/
</script>

</center>
</body>
</html>