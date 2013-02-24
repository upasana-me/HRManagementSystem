<?php

if( isset( $_SESSION["id"] ) )
  {
    if(isset($_SESSION["login"]) && $_SESSION["login"] == "true" && $_SESSION["access"] == 0 )
      {
	header("Location: profilepage.php");
      }
    else if( isset($_SESSION["login"]) && $_SESSION["login"] == "true" && $_SESSION["access"] == 1 )
      {
	header("Location: adminprofile.php");
      }
    else
      {
	$_SESSION["login"] = "false";
	initialiseTables();
      }
  }
else
  {
    $_SESSION["login"] = "false";
    initialiseTables();
  }

if( isset($_COOKIE["login"] ) && $_COOKIE["login"] == "true" && isset($_COOKIE["id"]) && isset($_COOKIE["access"]) && $_COOKIE["id"] != "" )
  {
    $id = $_COOKIE["id"];
    $access = $_COOKIE["access"];
    $_SESSION["id"] = $id;
    $_SESSION["access"] = $access;
    $_SESSION["login"] = "true";
    if( isset( $_COOKIE["sup"] ) && $_COOKIE["sup"] == "true" )
      {
	$_SESSION["sup"] = 1;
	header("Location: supAdminProfile.php");
      }
    else
      {
	header("Location: profilepage.php");
      }
  }
else
 {
    $expire = time() + ( 24 * 30 * 60 * 60 );
    setcookie( "id", "", $expire );
    setcookie( "access", "", $expire );
    setcookie( "login", "", $expire);
  }


?>