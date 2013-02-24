<?php
include("config.php");
session_start();

if( !isset($_SESSION["login"]) || $_SESSION["login"] != "true" )
  {
    header("Location: login.php");
  }
else if(!isset( $_SESSION["id"] ) )
  {
    header("Location: login.php");
  }
?>

<html>
<head>

<title>
<?php
  include("config.php");
  $con = mysql_connect( $db_server, $db_username, $db_password );
if( !$con )
  {
      die ("<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Error in connecting to database :".mysql_error()."\");}</script>");   
  }

$res = mysql_select_db( $db_name, $con );
if( !$res )
  {
    die ("<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Error in mysql_select_db : ".mysql_error()."\");}</script>");
  }

if( $_SESSION["id"] == 0 )
  {
    $query2 = $retrieveCompName;
    $res2 = mysql_query( $query2 );
    if( $res2 )
      {
	$row2 = mysql_fetch_array( $res2 );
	if( $row2["CompanyName"] != "" )
	  {
	    echo "Administartor@".$row2["CompanyName"];
	  }
	else
	  {
	    echo "Administrator@HRMS";
	  }
      }
    else
      {
	echo "Administrator@HRMS";
      }
  }
else
  {
    $query = $retrieveFname.mysql_real_escape_string( $_SESSION["id"] )."'";
    $res = mysql_query( $query, $con );
    if( $res )
      {
	$row = mysql_fetch_array( $res );
	$query2 = $retrieveCompName;
	$res2 = mysql_query( $query2 );
	if( $res2 )
	  {
	    $row2 = mysql_fetch_array( $res2 );
	    if( $row2["CompanyName"] != "" )
	      {
		echo $row["Fname"]."@".$row2["CompanyName"];
	      }
	    else
	      {
		echo $row["Fname"]."@HRMS";
	      }
	  }
	else
	  {
	    echo $row["Fname"]."@HRMS";
	  }
      }
  }
?>
</title>

<script type="text/javascript">

function validateForm()
{
  var x = document.forms["form"]["op"].value;
  var y = document.forms["form"]["np"].value;
  var z = document.forms["form"]["cnp"].value;
  if (x==null || x=="" || y == null || y == "" || z == null || z == "" )
    {
      alert("Please fill all three fields");
      return false;
    }
  if( y.length < 6 || y.length > 20 || z.length < 6 || z.length > 20 )
    {
      alert("New password must be six to twenty characters in length");
      return false;
    }
}

</script>

<style>

h1
{
font-size:200%;
color:RED;
text-align:center;
}

h2
{
font-size:175%;
color:red;
text-align:center;
}

body
{
background-color:black;
}

th
{
color:white;
font-size:150%;
}

td
{
color:white;
font-size:100%;
}

label
{
color:black;
}

</style>
</head>

<body>
<img src="hrms.php" height="15%" width="15%" style="float:left;" />

<h1>
HRMS Administrator Login
</h1>

<h2>
Welcome
<?php
  include("config.php");
$con = mysql_connect( $db_server, $db_username, $db_password );
if( !$con )
  {
    die ("<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Error in connecting to database :".mysql_error()."\");}</script>");   
  }
$res = mysql_select_db( $db_name, $con );
if( !$res )
  {
    die ("<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Error in mysql_select_db : ".mysql_error()."\");}</script>");
  }

if( $_SESSION["sup"] == 1 )
  {
    echo "Admin!";
  }
else
  {
    $query = $retrieveFname.mysql_real_escape_string( $_SESSION["id"] )."'";
    $res = mysql_query( $query, $con );
    if( $res )
      {
	$row = mysql_fetch_array( $res );
	echo $row["Fname"]."!";
      }
  }
?>
</h2>


<nav style="float:right;" >

<a style="color:white;" 

<?php
  if( $_SESSION["id"] == 0 )
    {
      echo "href=\"supAdminProfile.php\"";
    }
  else if( $_SESSION["access"] == 1 )
    {
      echo "href=\"adminprofile.php\"";
    }
  else if( $_SESSION["access"] == 0 )
    {
      echo "href=\"profilepage.php\"";
    }

?>
>Profile Page |
</a>

<a href="logout.php" style="color:white;">
Logout
</a>

</nav>

<br />
<hr />

<table style="float:centre;background-color:white;" cellpadding="5" cellspacing="2" align="center" >
<form name="form" id="cpform" method="post" action="ChangePassword.php" onsubmit="return validateForm()">

<th colspan="2" style="background-color:black;color:white;text-align:left;font-size:120%">

<strong>
Change Password
</strong>
</th>

<tr>
<td style="font-size:120%">
<label>
Old Password
</label>
</td>
<td>
<input type="password" maxlength="20" action="login.php" name="op" id="op" size="25%"> 
</td>
</tr>

<tr>
<td style="font-size:120%">
<label>
New Password
</label>
</td>
<td>
<input type="password" maxlength="20" action="login.php" name="np"  id="np" size="25%">
</td>
</tr>
<tr>
<td style="font-size:120%">
<label>
Confirm New Password
</label>
</td>
<td>
<input type="password" maxlength="20" action="login.php" name="cnp" id="cnp" size="25%">
</td>
</tr>


<tr>
<td colspan="2" >
<input style="align:center" type="submit" value="Change Password">
</td>
</tr>
</form>

</table>


</body>
</html>

<?php
include("config.php");
if ((isset($_POST["op"]))and(isset($_POST["np"]))and(isset($_POST["cnp"])))
{
  $old = $_POST["op"];
  $new = $_POST["np"];
  $cnfrm = $_POST["cnp"];

  if( $new != $cnfrm )
    {
      die("<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"New password and confirrm password do not match.\");}</script>");      
    }

  $query = $retrieveInfo.mysql_real_escape_string( $_SESSION['id'] )."'";

  $res = mysql_query( $query, $con );
  $row = mysql_fetch_array( $res );

  $oldpass = $row['Password'];
  $hash=$oldpass;

  $username = $row['Username'];  	
  $saltn = substr($hash, 0, 64);
 
  $hashn = $saltn . $old;
  
  for ( $i = 0; $i < 100000; $i ++ )
    {
      $hashn = hash('sha256', $hashn);
    }
 
  $hashdec = $saltn . $hashn;
  $old = $hashdec;
	
  if ($oldpass != $old)
    {
      die( "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Old Password is incorrect :\");}</script>");
    }
	
  $salt = hash('sha256', uniqid(mt_rand(), true) . 'something random' . strtolower($username));
 
  $hash = $salt . $new;
 
  for ( $i = 0; $i < 100000; $i ++ )
    {
      $hash = hash('sha256', $hash);
    }
 
  $new = $salt . $hash;

  $query = sprintf("UPDATE USERS SET Password = '%s' WHERE Username = '%s'",
		   mysql_real_escape_string($new),mysql_real_escape_string($username));
  $res= mysql_query( $query );
  if( !$res )
    {
      die("<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Error in changing password.Please try later.\");}</script>");
    }
}
?>