<?php
session_name(session_name().'_exo2_5');
session_start();
if(isset($_GET['logout'])){
  unset($_SESSION['logged']);
  session_destroy();
  header('Location: ./');
}
$dbname = 'db/.htdb.db';
$admin_password = 'TFIrxfjqaBNogntSnyiVtMbi8GYxvue9';
$admin_username = 'admin';
$message = 'Forgotten password';

function create_user_if_not_exist($username, $password){
  global $dbname;
  $db = new SQLite3($dbname);
  $safe_username = $db->escapeString($username);
  $password_hash = hash("sha256", $password);
  $query = "SELECT id FROM users WHERE username='".$safe_username."'";
  $result = (int)$db->querySingle($query);
  if($result == 0){
    $query = "INSERT INTO users (username, password) VALUES ('".$safe_username."', '".$password_hash."')";
    $db->exec($query);
  }
  $db->close();
}

$tbl_users = "CREATE TABLE IF NOT EXISTS users (id INTEGER PRIMARY KEY AUTOINCREMENT UNIQUE NOT NULL, username TEXT, password TEXT, token TEXT);";

$db = new SQLite3($dbname);
$db->exec($tbl_users);
$db->close();
create_user_if_not_exist($admin_username, $admin_password);

if(isset($_POST['username'])){
  $db = new SQLite3($dbname);
  $safe_username = $db->escapeString($_POST['username']);
  $query = "UPDATE users SET token='".generate_random_token()."' WHERE username = '".$safe_username."'";
  $db->exec($query);
  $db->close();
  $message = 'Mail sent with reset link.';
}

if(isset($_GET['token']) && !empty($_GET['token'])){
  $db = new SQLite3($dbname);
  $safe_token = $db->escapeString($_GET['token']);
  $query = "SELECT username FROM users WHERE token = '".$safe_token."'";
  $username = $db->querySingle($query);
  if($username){
    $message = 'Reset password';
  }
  else{
    $message = 'Invalid Token';
  }
  $db->close();
}

function generate_random_token(){
  $chars = 'abcdefghijkmnopqrstuvwxyz023456789!@#$';
  srand(time());
  $passwd = '';
  $chars_length = strlen($chars) - 1;
  
  for ($i = 0; $i < 10; $i++){
    $passwd .= substr($chars, (rand() % $chars_length), 1);
  }

  return md5($passwd);
}

?>
<!--
function generate_random_token(){
    $chars = 'abcdefghijkmnopqrstuvwxyz023456789!@#$';
    srand(time());
    $passwd = '';
    $chars_length = strlen($chars) - 1;
    
    for ($i = 0; $i < 10; $i++){
        $passwd .= substr($chars, (rand() % $chars_length), 1);
    }

    return md5($passwd);
}
!-->

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
        <h1>Exercice 5 - PRNG</h1>
        <p class="lead">Access admin account</p>
        <p><?php echo $message; ?></p>
        <?php 
        if($username){
          $db = new SQLite3($dbname);
          $safe_username = $db->escapeString($username);
          $query = "UPDATE users SET token='' WHERE username = '".$safe_username."'";
          $db->exec($query);
          $db->close();
          echo '<p>Congratz, you got token to reset '.htmlentities($username).' password</p>';
        }
        else{
          ?>
        <form id="my_form" method="POST" action="">
          <div class="form-group">
            <label for="username" class="col-sm-2 control-label">Username</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="username" name="username" placeholder="Username">
            </div>
          <div class="form-group">
            <button type="submit" class="btn btn-default">Submit</button>
          </div>
        </form>
        <?php
        }
        ?>
      </div>

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../bootstrap/js/jquery.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../bootstrap/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
