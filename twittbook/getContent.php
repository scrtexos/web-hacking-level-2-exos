<?php
	header("Content-type:");
	$query = "SELECT * FROM shares s left join person p on p.id = s.person_id WHERE (s.person_id IN (select " . $_SESSION['user_id'] . " union select person2 from friends where person1=" . $_SESSION['user_id'] . " union select person1 from friends where person2=" . $_SESSION['user_id'] . ")) ORDER BY submission DESC LIMIT 0,10";
	$result = mysql_query($query) or die(mysql_error());
	$myShares = array();
	while($line = mysql_fetch_array($result)) {
		$newshare = array("time"=>$line['submission'], "person"=>$line['name'], "content"=>htmlentities($line['content']));
		array_push($myShares,$newshare);
		echo '<div class="share"><div class="share_time">'.$line['submission'] . '</div><div class="share_person">' . $line['name'] . '</div><div style="clear:both"></div> <div class="share_content">' . htmlentities($line['content']) . '</div></div>';
	}
	$xml = new SimpleXMLElement("<shares/>");
	array_walk_recursive($myShares, array($xml, 'addChild'));
	//print $xml->asXML();
	//echo json_encode($myShares);
?>
