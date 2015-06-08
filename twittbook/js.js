function GetXmlHttpObject()
{
var xmlHttp=null;
try
  {
  // Firefox, Opera 8.0+, Safari
  xmlHttp=new XMLHttpRequest();
  }
catch (e)
  {
  // Internet Explorer
  try
    {
    xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
    }
  catch (e)
    {
    xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
  }
return xmlHttp;
}


function getContent()
{
	xmlHttpContent=GetXmlHttpObject();
	if (xmlHttpContent==null)
	  {
	  alert ("Your browser does not support AJAX!");
	  return;
	  } 
	var url="getContent.php";
	url=url+"?sid="+Math.random();
	xmlHttpContent.onreadystatechange=getContentReturn;
	xmlHttpContent.open("GET",url,true);
	xmlHttpContent.send(null);
/*
	$.get("getContent.php?sid="+Math.random(),function(data){handle(data)});
	function handle(data) {
		eval("myShares="+data);
		$("#content").empty();
		for(i = 0; i < myShares.length; i++) {
			$("#content").append("<div class='share'><div class='share_time'>"+myShares[i].time+ "</div><div class='share_person'>" + myShares[i].person + "</div><div style='clear:both'></div> <div class='share_content'>" + myShares[i].content + "</div></div>");
		}
		//alert(data);
		
	}*/
}

function getContentReturn() {
	if(xmlHttpContent.readyState == 4) {
		document.getElementById('content').innerHTML = xmlHttpContent.responseText;
	}
}

function updateContent() {
	getContent();
	setInterval('getContent()',2000);
}

function getFriends()
{
	xmlHttpFriend=GetXmlHttpObject();
	if (xmlHttpFriend==null)
	  {
	  alert ("Your browser does not support AJAX!");
	  return;
	  } 
	var url="getFriends.php";
	url=url+"?sid="+Math.random();
	xmlHttpFriend.onreadystatechange=getFriendsReturn;
	xmlHttpFriend.open("GET",url,true);
	xmlHttpFriend.send(null);
}

function getFriendsReturn() {
	if(xmlHttpFriend.readyState == 4) {
		document.getElementById('right').innerHTML = xmlHttpFriend.responseText;
	}
}

function updateFriends() {
	getFriends();
	setInterval('getFriends()',1000);
}

function share()
{
	
		xmlHttpShare=GetXmlHttpObject();
		if (xmlHttpShare==null)
		  {
		  alert ("Your browser does not support AJAX!");
		  return;
		  } 
		var url="share.php";
		url=url+"?sid="+Math.random();
		url=url+"&content="+encodeURIComponent(document.getElementById('talk').value);
		xmlHttpShare.onreadystatechange=shareReturn;
		xmlHttpShare.open("GET",url,true);
		xmlHttpShare.send(null);
	
}

function shareReturn() {
	if(xmlHttpShare.readyState == 4) {
		document.getElementById('talk').value=xmlHttpShare.responseText;
		
		getContent();
	}
}

function shareit(e) {
var characterCode;if(e && e.which){e = e;characterCode = e.which;}else{e = event;characterCode = e.keyCode;}if(characterCode == 13){share()}
}

function setStatus(e)
{
	var characterCode;

	if(e && e.which){ //if which property of event object is supported (NN4)
	e = e;
	characterCode = e.which; //character code is contained in NN4's which property
	}
	else{
	e = event;
	characterCode = e.keyCode; //character code is contained in IE's keyCode property
	}
	if(characterCode == 13) {
	xmlHttpStatus=GetXmlHttpObject();
	if (xmlHttpStatus==null)
	  {
	  alert ("Your browser does not support AJAX!");
	  return;
	  } 
	var url="setStatus.php";
	url=url+"?sid="+Math.random();
	url=url+"&status="+escape(document.getElementById('status').value);
	xmlHttpStatus.onreadystatechange=setStatusReturn;
	xmlHttpStatus.open("GET",url,true);
	xmlHttpStatus.send(null);
	}
}

function setStatusReturn() {
	if(xmlHttpStatus.readyState == 4) {
		//document.getElementById('talk').value="";
		getContent();
	}
}

function deleteme() {
	xmlHttpDelete=GetXmlHttpObject();
	if (xmlHttpDelete==null)
	  {
	  alert ("Your browser does not support AJAX!");
	  return;
	  } 
	var url="delete.php";
	url=url+"?sid="+Math.random();
	xmlHttpDelete.onreadystatechange=deletereturn;
	xmlHttpDelete.open("GET",url,true);
	xmlHttpDelete.send(null);
}

function deletereturn() {

	   if(xmlHttpDelete.readyState==4) {
	    location="login.php";
	   }
}