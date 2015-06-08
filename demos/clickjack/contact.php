<?php


  if(isset($_POST['token']) && $_POST['token'] === $_SESSION['token']) {
    if(isset($_POST['message'])) {
      //call 
      preg_match_all('#\bhttps?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#', $_POST['message'], $match);
     // print_r($match);
      if($match[0][0] !== NULL) {
	pclose(popen("phantomjs superphantomjsstuff.pjs " . escapeshellarg($match[0][0]) . " &","r"));
      }
    }
   
  }

$token = md5(uniqid("asdf"));
$_SESSION['token'] = $token;

?>
<!DOCTYPE html>
<html lang="en">
<head>

<link rel="stylesheet" href="bootstrap.min.css">
</head>
<body>
<script src="bootstrap.min.js"></script>
<script src="jquery-2.1.1.min.js"></script>
    <div class="container">

    <nav class="navbar navbar-inverse">
<div class="container">

          <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li><a href="index.php">News</a></li>
              <li><a href="profile.php">Profile</a></li>
              <li class="active"><a href="contact.php">Contact</a></li>
              <li><a href="admin.php">Admin</a></li>
	      <?php
              if(isset($_SESSION['userid']) && $_SESSION['userid'] !== 0) {
              ?>
               <li><a href="logout.php">Logout</a></li>
               <?php
               }
               else {
               ?>
               <li><a href="login.php">Login</a></li>
               <?php }?>
	      </li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
        </nav>
      

        <p id="main">       
	  <form action="" method="POST">
	  <input type="hidden" name="token" value="<?php echo $token;?>"/>
	  <table class="table table-striped" style="width: 60%">
            <tbody>
              <tr>
                <td>Contact an admin:</td>
                </tr>
                <tr>
                <td><textarea name="message"></textarea></td>
              </tr>
              <tr>
              <td><input type="submit" value="Send"/></td>
              </tr>
            </tbody>
          </table>
          </form>
        </p>




      

      <footer class="footer">
        <p>&copy; Insomni'hack 2015</p>
      </footer>

    </div> <!-- /container -->

</body>
</html>