<?php
if( !isset($_SESSION["login"] )
  {
    header("login.php");
  }
  else if( $_SESSION["login"] != "true" )
    {
      header("login.php");
    }
  else if( !isset($_SESSION["id"]) )
    {
      header("login.php");
    }
else
  {}

?>