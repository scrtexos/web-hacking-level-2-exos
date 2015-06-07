<?php
$find = preg_match('#/([0-9-]+)/#',$_SERVER['REQUEST_URI'],$ex_num);
if($find){
  $num = $ex_num[1];
}
else{
  $num = '0';
}
?>
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li <?php if($num=='0') { echo 'class="active"'; } ?>><a href="/">Home</a></li>
            <li <?php if($num=='2') { echo 'class="active"'; } ?>><a href="/2/">Exercice 2</a></li>
            <li <?php if($num=='3') { echo 'class="active"'; } ?>><a href="/3/">Exercice 3</a></li>
            <li <?php if($num=='4') { echo 'class="active"'; } ?>><a href="/4/">Exercice 4</a></li>
            <li <?php if($num=='5') { echo 'class="active"'; } ?>><a href="/5/">Exercice 5</a></li>
            <li <?php if($num=='6') { echo 'class="active"'; } ?>><a href="/6/">uXSS</a></li>
            <li <?php if($num=='7') { echo 'class="active"'; } ?>><a href="/7/">Exercice 7</a></li>
            <li <?php if($num=='8') { echo 'class="active"'; } ?>><a href="http://twittbook.formation.scrt/">Exercice 8</a></li>
	    <li <?php if($num=='9') { echo 'class="active"'; } ?>><a href="/9/">Exercice 9</a></li>
          </ul>
        </div><!--/.nav-collapse -->
