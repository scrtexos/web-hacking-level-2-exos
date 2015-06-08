<?php
if(isset($_POST['username']) && isset($_POST['password'])) {
  $db = new SQLite3('db/db.sqlite');
  $stmt = $db->prepare("select rowid id from users where username = :username");
  $stmt->bindValue(":username",$_POST['username'],SQLITE3_TEXT);
  $result = $stmt->execute();
  $row = $result->fetchArray();
  //var_dump($row);
  if($row['id'] != 0 ) {
    die("User already exists...");
  }
  else {
  $stmt = $db->prepare("insert into users (username,password,admin) values (:username,:password,0)");
  $stmt->bindValue(":username",$_POST['username'],SQLITE3_TEXT);
  $stmt->bindValue(":password",$_POST['password'],SQLITE3_TEXT);
  $stmt->execute();
  header("Location: login.php");
  die();
  }

}


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
              <li class="active"><a href="index.php">News</a></li>
              <li><a href="profile.php">Profile</a></li>
              <li><a href="contact.php">Contact</a></li>
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
	  <table class="table table-striped" style="width: 60%">
            <tbody>
              <tr>
                <td>Username</td>
                <td><input type="text" name="username"/></td>
              </tr>
              <tr>
                <td>Password</td>
                <td><input type="password" name="password"/></td>
              </tr>
              <tr>
                <td colspan="2"><input type="submit" value="Register"/></td>
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