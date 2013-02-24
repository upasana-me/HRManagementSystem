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
?>
</title>

<script type="text/javascript">


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
color:white;
}

h3
{
color:white;
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
  Employees Profiles!
</h1>

<br />

<p style="align:right">
<nav style="float:right" >


<a href="adminprofile.php" style="color:white">
  Profile Page &nbsp; |
</a>

<a href="logout.php" style="color:white">
	   &nbsp; Logout
</a>
</nav>
</p>

<br />
<hr />

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
else
  {
    $query = $retrieveAllEmpIDNames;
    $res = mysql_query( $query );
    if( $res )
      {
	while( $row = mysql_fetch_array( $res ) )
	  {		    
	    echo "<table>";
	    echo "<form method=\"get\" action=\"displayPro.php\" >";
	    echo "<tr><td colspan=\"2\"><strong>Employee ID:</strong></td><td>".$row["EmployeeID"]."</td></tr>";
	    echo "<tr><td colspan=\"2\"><strong>First name:</strong></td><td>".$row["Fname"]."</td></tr>";
	    echo "<tr><td colspan=\"2\"><strong>Middle name:</strong></td><td> ".$row["Mname"]."</td></tr>";
	    echo "<tr><td colspan=\"2\"><strong>Last name:</strong></td><td>".$row["Lname"]."</td></tr>";

	    echo "<tr><td><input type=\"hidden\" name=\"action\" value=\"".$row["EmployeeID"]."\" /></td></tr>";

	    echo "<tr><td><button type=\"submit\">View Full Profile</button></td>";
	    echo "<td><button type=\"submit\" style=\"width:150%\" formaction=\"editProfile.php?action".$row["EmployeeID"]."=".$row["EmployeeID"]."\">Edit Profile</td></tr>";
	    echo "</form>";
	    echo "</table>";
	    echo "<hr/>";
	  }
      }
  }
?>

</body>
</html>