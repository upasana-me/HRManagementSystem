<?php
session_start();
include_once("connection.php");
if( isset($_COOKIE["login"] ) && $_COOKIE["login"] == "true" && isset($_COOKIE["id"]) && isset($_COOKIE["access"]) && $_COOKIE["id"] != "" )
  {
    echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Bad username/password 1\") }</script>";
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
   echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Bad username/password 2\") }</script>";
    $expire = time() + ( 24 * 30 * 60 * 60 );
    setcookie( "id", "", $expire );
    setcookie( "access", "", $expire );
    setcookie( "login", "", $expire);
  }

if( isset( $_SESSION["id"] ) )
  {
    if(isset($_SESSION["login"]) && $_SESSION["login"]=="true" && $_SESSION["access"] == 0 )
      {
	echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Bad username/password 3\") }</script>";
	header("Location: profilepage.php");
      }
    else if( isset($_SESSION["login"]) && $_SESSION["login"]=="true" && $_SESSION["access"] == 1 )
      {
	echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Bad username/password 4\") }</script>";
	header("Location: adminprofile.php");
      }
    else
      {
	$_SESSION["login"] = "false";
	echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Bad username/password 5\") }</script>";
	include_once "initialise_tables.php";
      }
  }
else
  {
    echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Bad username/password 6\") }</script>";
    $_SESSION["login"] = "false";
    include_once "initialise_tables.php";
  }

?>

<html>
<head>

<script type="text/javascript" src="../../login.js">
</script>

<link rel="stylesheet" type="text/css" href="../../hrms_style_sheet.css" />

<?php
  include_once "header.php";
?>

</head>

<body>


<table style="float:right;background-color:white;" cellpadding="5" cellspacing="2" >

<th colspan="2" style="background-color:black;color:white;text-align:left;font-size:120%">
<strong>
Sign in
</strong>
</th>

<form name="form" id="form" method="post" action="login.php" onsubmit="return validateForm()">

<tr>
<td style="font-size:120%">
Username
</td>
<td>
<input type="text" maxlength="20" name="username" id="username" size="25%"> 
</td>
</tr>

<tr>
<td style="font-size:120%">
Password
</td>
<td>
<input type="password" name="pwd" id="pwd" maxlength="20" size="25%">
</td>
</tr>

<tr>
<td colspan="2" style="font-size:120%" >
<input type="checkbox" name="staySignedIn" id="staySignedIn" />
Stay signed in
</td>
</tr>

<tr>
<td>
<input type="hidden" name="action">
<input type="submit" value="Login" name="login">
</td>
<td>
<input type="reset" value="Reset" name="reset">
</td>
</tr>

</form>

<tr>
<td colspan="2">
<a href="ForgotPassword.php">
Forgot password
</a>
 </td>
</tr>

</table>

</body>
</html>

<?php

include("config.php");

if( isset( $_POST["action"] )) 
{
  $username = $_POST["username"]; 
  $password = $_POST["pwd"];
  $staySignedIn = "";

  if( isset($_POST["staySignedIn"] ) )
    {
      $staySignedIn = $_POST["staySignedIn"];
      $_SESSION["staySignedIn"] = $staySignedIn;
    }

  /* $con = mysql_connect( $db_server, $db_username, $db_password ); */
  /* if ( !$con ) */
  /*   {        */
  /*     die ("<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Error in connecting to database :".mysql_error()."\");}</script>"); */
  /*   } */
  /* $res = mysql_select_db( $db_name, $con ); */
  /* if( !$res ) */
  /*   { */
  /*     die ("<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Error in mysql_select_db : ".mysql_error()."\");}</script>"); */
  /*   } */
  /* else */
  /*   { */
      $rp = sprintf("SELECT Password FROM USERS
    WHERE Username='%s'",
		    mysql_real_escape_string($username));
      $res= mysql_query( $rp, $con );
      $row = mysql_fetch_array( $res );
      $hash = $row['Password'];
      $saltn = substr($hash, 0, 64);
 
      $hashn = $saltn . $password;
 
      for ( $i = 0; $i < 100000; $i ++ )
	{
	  $hashn = hash('sha256', $hashn);
	}
      
      $hashdec = $saltn . $hashn;

      if ( $hash != $hashdec )
	{
	  echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Bad username/password\") }</script>";
	}
      else
	{
	  include("config.php");
	  $_SESSION["login"] = "true";
	  $query = $retrieveID_access.mysql_real_escape_string($username)."'";
	  $res = mysql_query( $query, $con );
	  $row = mysql_fetch_array( $res );	 

	  $id = $row['ID'];
	  $access = $row["Access"];
	  $_SESSION["id"] = $id;      
	  
	  $expire = time() + ( 24 * 30 * 60 * 60 );
	  $staySignedIn = strtoupper( $staySignedIn);
	  if( $staySignedIn != "ON" )
	    {
	      $expire = time() - 3600;
	      setcookie("id", "", $expire );
	      setcookie("access","", $expire);
	      setcookie("login","false",$expire);
	      unset($_COOKIE["id"]);
	      unset($_COOKIE["access"]);
	      unset($_COOKIE["login"]);	     
	      unset($_COOKIE["sup"]);
	    }
	  else 
	    {
	      setcookie("id", $id, $expire );
	      setcookie("access", $access, $expire );
	      setcookie("login","true",$expire);
	    }

	  if( $access != 1 )
	    {
	      $_SESSION["access"] = 0;
	      header("Location: profilepage.php");
	    }
	  else
	    {
	      $_SESSION["access"] = 1;
	      if( $row["ID"] == 0 )
		{
		  $_SESSION["sup"] = 1;
		  setcookie("sup","true", $expire );
		  header("Location: supAdminProfile.php");
		}
	      else
		{		  
		  header("Location: adminprofile.php");
		}
	    }
	}
#    } 
#  mysql_close( $con );
}



/* not working properly, will see later if requred
function displayMessage($message)
{
  echo "<script type=\"text/javscript\"> try { throw \"err\" } catch(err) { alert(\"".$message."\");}</script>";
}
*/

?>

