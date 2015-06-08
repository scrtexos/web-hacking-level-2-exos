<?php
  echo $_SESSION['id'];
  if(isset($_SESSION['user_id'])) {
    $delete = "DELETE FROM person WHERE id = '" . $_SESSION['user_id'] . "'";
    mysql_query($delete) or die(mysql_error());
    session_destroy();
  }
  
?>