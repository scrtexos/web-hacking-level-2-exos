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
        <?php
        $db = new SQLite3('db/db.sqlite');
        $results = $db->query('select * from posts p left join users u on p.userid = u.rowid LIMIT 10');
        while($row = $results->fetchArray()) {
        
        
        ?>
        <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title"><b><?php echo $row['title'] . "</b> by <i><a href='profile.php?id=" . $row['userid'] . "'>" . $row['username'] . "</a></i> (" . $row['date'] . ")";?></h3>
            </div>
            <div class="panel-body">
              <?php echo $row['content'];?>
            </div>
          </div>
          
        <?php } ?>
        </p>




      

      <footer class="footer">
        <p>&copy; Insomni'hack 2015</p>
      </footer>

    </div> <!-- /container -->

</body>
</html>