<?php


  if(isset($_POST['token']) && $_POST['token'] === $_SESSION['token']) {
    $admin = 0;
    //print "token ok";
    if($_SESSION['admin'] === 1 && isset($_POST['admin']) && $_POST['admin'] === "on") {
      $admin=1;
      //print "admin!";
    }
    $id = $_SESSION['userid'];
    if(isset($_GET['id'])) {
      $id = $_GET['id'];
    }
    if($id === $_SESSION['userid'] || $_SESSION['admin'] === 1) {
      $db = new SQLite3('db/db.sqlite');
      $stmt = $db->prepare('update users set admin=:admin where rowid = :id');
      $stmt->bindValue(":id",$id,SQLITE3_INTEGER);
      $stmt->bindValue(":admin",$admin,SQLITE3_INTEGER);
      $result = $stmt->execute();
      if(isset($_POST['password']) && $_POST['password'] !== "") {
	$stmt = $db->prepare('update users set password=:password where rowid = :id');
	$stmt->bindValue(":id",$_SESSION['userid'],SQLITE3_INTEGER);
	$stmt->bindValue(":password",$_POST['password'],SQLITE3_TEXT);
	$stmt->execute();
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
<script src="jquery-2.1.1.min.js"></script>
<script src="bootstrap.min.js"></script>

    <div class="container">

    <nav class="navbar navbar-inverse">
<div class="container">

          <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li><a href="index.php">News</a></li>
              <li class="active"><a href="profile.php">Profile</a></li>
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
	  <?php
	    $db = new SQLite3('db/db.sqlite');
	    $id = $_SESSION['userid'];
	    if(isset($_GET['id'])) {
	      $id = intval($_GET['id']);
	    }
	    $stmt = $db->prepare('select rowid r,* from users where r = :id');
	    $stmt->bindValue(":id",$id,SQLITE3_INTEGER);
	    $result = $stmt->execute();
	    $row = $result->fetchArray();
	  ?>
	  <form action="" method="POST">
	  <input type="hidden" name="token" value="<?php echo $token;?>"/>
	  <table class="table table-striped" style="width: 60%">
            <tbody>
              <tr>
                <td>Username</td>
                <td><?php echo htmlentities($row['username']);?></td>
              </tr>

              <tr>
                <td>Password</td>
                <td><input type="password" name="password" <?php if($_SESSION['userid'] !== $id) { echo "disabled";}?>/></td>
              </tr>
              <tr>
                <td># Posts</td>
                <td><?php if($id === 1) {print "2";} else { print "0";}?></td>
              </tr>
              <tr>
                <td>Admin</td>
                <td><input name="admin" type="checkbox" <?php if($_SESSION['admin'] !== 1) { echo " disabled ";} if($row['admin'] == 1) {echo " checked ";}?> alt="Only for admins"/></td>
              </tr>
              <tr>
                <td colspan="2"><input type="submit" value="Update"  <?php if($_SESSION['admin'] !== 1 && $_SESSION['userid'] !== $id) { echo "disabled";}?>/></td>
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