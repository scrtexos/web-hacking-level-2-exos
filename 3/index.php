<?php 
$entityBody = file_get_contents('php://input');
if($entityBody != ''){
	$myXSLT ='<?xml version="1.0"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
  <xsl:output method="text"/>
  <xsl:template match="/">
  	&lt;p&gt;<xsl:value-of select="/root/quantity"/> awesome <xsl:value-of select="/root/product"/>&lt;p&gt;
    &lt;img src="<xsl:value-of select="/root/picture"/>"/&gt;
  </xsl:template>
</xsl:stylesheet>';
$xslt = new XSLTProcessor();
$xslt->importStylesheet(new SimpleXMLElement($myXSLT));
	try{
		$product = simplexml_load_string($entityBody, null, LIBXML_NOENT);
		echo $xslt->transformToXml($product);
	} catch (Exception $e) {
		echo 'Error';
	}
}
else{
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Exercices</title>

    <!-- Bootstrap core CSS -->
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="style.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../bootstrap/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../bootstrap/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <?php include('../menu.php'); ?>
      </div>
    </div>

    <div class="container">

      <div class="starter-template">
        <h1>Exercice 3 - XXE</h1>
        <p class="lead">Access admin panel</p>
        <form id="my_form" method="POST" action="">
          <div class="form-group">
            <label for="product" class="col-sm-2 control-label">Product</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="product" name="product" placeholder="Product">
            </div>
            <label for="picture" class="col-sm-2 control-label">Picture url</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="picture" name="picture" placeholder="http://...">
            </div>
          </div>
          <div class="form-group">
            <label for="quantity" class="col-sm-2 control-label">Quantity</label>
            <div class="col-sm-10">
            	<select class="form-control" id="quantity" name="quantity">
            		<option id="1">1</option>
            		<option id="2">2</option>
            		<option id="3">3</option>
            		<option id="4">4</option>
            	</select>
            </div>
          </div>
          <div class="form-group">
            <button type="button" class="btn btn-default" onclick="submitMy_form()">Submit</button>
          </div>
        </form>
        <div id="result"></div>
      </div>

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../bootstrap/js/jquery.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../bootstrap/js/ie10-viewport-bug-workaround.js"></script>
    <script>
    var json2xml = (function (undefined) {
    "use strict";
    var tag = function (name, closing) {
        return "<" + (closing ? "/" : "") + name + ">";
    };
    return function (obj, rootname) {
        var xml = "";
        for (var i in obj) {
            if (obj.hasOwnProperty(i)) {
                var value = obj[i],
                    type = typeof value;
                if (value instanceof Array && type == 'object') {
                    for (var sub in value) {
                        xml += json2xml(value[sub]);
                    }
                } else if (value instanceof Object && type == 'object') {
                    xml += tag(i) + json2xml(value) + tag(i, 1);
                } else {
                    xml += tag(i) + value + tag(i, {
                        closing: 1
                    });
                }
            }
        }

        return rootname ? tag(rootname) + xml + tag(rootname, 1) : xml;
    };
})(json2xml || {});
function getFormData($form){
    var unindexed_array = $form.serializeArray();
    var indexed_array = {};

    $.map(unindexed_array, function(n, i){
        indexed_array[n['name']] = n['value'];
    });

    return indexed_array;
}
    function submitMy_form(){
		var formjson = getFormData($('#my_form'));
  		var formxml = json2xml(formjson);
  		console.log(formxml)
  		$.post("", "<?xml version='1.0' standalone='yes'?><root>"+formxml+"</root>", function(data){ 
    		$("#result").html(data);
  		});
  		return false;
	}
    </script>
  </body>
</html>
<?php
}
?>
