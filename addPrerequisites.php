<?php
include("config.php");
session_start();

if( !isset($_SESSION["login"]) || $_SESSION["login"] != "true" )
  {
    header("Location: login.php");
  }
else if(!isset( $_SESSION["id"] ) || !isset($_SESSION["access"]) || $_SESSION["access"] != 1 )
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

$query = $retrieveFname.mysql_real_escape_string( $_SESSION["id"] )."'";
$res = mysql_query( $query, $con );
$row = mysql_fetch_array( $res );
echo $row["Fname"]."@HRMS";
mysql_close( $con );
?>
</title>



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

</style>
</head>

<body>
<img src="hrms.php" height="15%" width="15%" style="float:left;" />

<h1>
Add Pre-requisites
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

$query = $retrieveFname.mysql_real_escape_string( $_SESSION["id"] )."'";
$res = mysql_query( $query, $con );
if( $res )
  {
    $row = mysql_fetch_array( $res );
    echo $row["Fname"]."!";
  }
mysql_close( $con );
?>
</h2>

<table align="center">
<tr>
<nav style="float:right;" >
<td>
<a href="adminprofile.php" style="color:white;">
  &nbsp; Profile Page   &nbsp; |
</a>
</td>
<td>
<a href="editCompany.php" style="color:white;">
   &nbsp;Edit company info  &nbsp;|
</a>
</td>
<td>
<a href="addDept.php" style="color:white;">
   &nbsp;Edit Departments &nbsp;  |
</a>
</td>
<td>
<a href="addPositions.php" style="color:white;">
   &nbsp;Edit Positions  &nbsp; |
</a>
</td>
<td>
<a href="addQualifications.php" style="color:white;">
   &nbsp;Edit Qualifications &nbsp; |
</a>
</td>
<td>
<a href="addOffices.php" style="color:white;">
   &nbsp;Edit Offices &nbsp; |
</a>
</td>
<td>
<a href="addLangs.php" style="color:white;">
   &nbsp;Edit Languages &nbsp; |
</a>
</td>

<td>
<a href="addSkills.php" style="color:white;">
   &nbsp;Edit Skills &nbsp; |
</a>
</td>

<td>
<a href="logout.php" style="color:white;">
   &nbsp;Logout 
</a>
</td>
</nav>
</tr>
</table>

<hr />

<p style="text-align:center">
<img src="image.php" style="width:95%;height:65%;"/>
</p>
</body>
</html>