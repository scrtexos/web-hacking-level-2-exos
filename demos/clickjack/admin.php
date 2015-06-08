
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
              <li><a href="contact.php">Contact</a></li>
              <li class="active"><a href="admin.php">Admin</a></li>
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
	    if(isset($_SESSION['admin']) && $_SESSION['admin'] === 1) {
	      echo "INS15{Who_Said_You_Cant_Sploit_Clickjacking}";
	    }
	    else {
	      echo "Admins only. Go away.";
	    }
	  ?>

        </p>




      

      <footer class="footer">
        <p>&copy; Insomni'hack 2015</p>
      </footer>

    </div> <!-- /container -->

</body>
</html>