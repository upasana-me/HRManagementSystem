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
color:red;
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
color:white;
}

</style>
</head>

<body>
<img src="hrms.php" height="15%" width="15%" style="float:left;" />

<h1>
Edit Company details
</h1>

<br/>
<br/>
<br/>

<nav style="float:right;" >

<a href="adminprofile.php" style="color:white;">
	  &nbsp; Profile page |
</a>

<a href="addPrerequisites.php" style="color:white;">
	  &nbsp; Add pre-requisites |
</a>

<a href="logout.php" style="color:white;">
  &nbsp;Logout &nbsp;
</a>

</nav>

<br />
<hr />

<?php

$con = mysql_connect( $db_server, $db_username, $db_password );
if ( !$con )
  {       
    die ("<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Error in connecting to database :".mysql_error()."\");}</script>");
  }
else
  {
    $res = mysql_select_db("human_resource",$con);
    if( ! $res )
      {
	die ("Unable to connect to database,".mysql_error( $con ));
      }
    else
      {
	$res = mysql_query( $retrieveCompName );
	if( $res )
	  {
	    if( $row = mysql_fetch_array( $res ) )
	      {
		echo "<label color=\"white\"><strong>";
		echo "Present name of the company :</strong>".$row["CompanyName"]."</label><br/><hr/>";
	      }
	  }
      }
  }
?>

<form action="editCompany.php" method="post" name="form">
<label>
<strong>
Company name:
</strong>
</label>
<br/>
<input type="text" name="companyName" maxlength="30" style="align:left;width:50%" />
<br/>
<?php
  if(isset($_POST["action"]) )
    {
      $companyName = $_POST["companyName"];
	      
      if( $companyName != "")
	{
	  $query = $insertCompName.$companyName."')";
	  $con = mysql_connect( $db_server, $db_username, $db_password );
	  if ( !$con )
	    {       
	      echo "Error in mysql_connect : ".mysql_error()."\n";
	    }
	  $res = mysql_select_db( $db_name, $con );
	  if( !$res )
	    {
	      echo "Error in mysql_select_db : ".mysql_error()."\n";
	    }

	  $res = mysql_query( $deleteCompName );
	  if( !$res )
	    {
	      echo "Unable to delete company's name:".mysql_error()."\n";
	      mysql_close();
	    }
		  
	  $res = mysql_query( $query );
	  if( !$res )
	    {
	      echo "Unable to insert company's name:".mysql_error()."\n";
	      mysql_close();
	    }
	  else
	    {
	      mysql_close();		  
	    }
	}
      else
	{
	  echo "Please enter a valid Company name.";
	}
    }
?>
<input type="hidden" name="action" />
<br/>
<input type="Submit" value="Submit" name="submit"/> 
<input type="Reset" name="Reset"/>
</form>
</body>
</html>
