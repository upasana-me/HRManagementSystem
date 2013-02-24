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
Delete Employee!
</h1>

<br />

<p style="align:right">
<table style="float:right">
<nav style="float:right" >
<tr>
<td>
<a href="adminprofile.php" style="color:white">
  Profile Page  |
</a>
</td>
<td>
<a href="logout.php" style="color:white">
  Logout
</a>
</td>
</nav>
</tr>
</table>
</p>

<br />
<hr />

<form action="deleteEmployee.php" method="post" name="deleteEmpForm" >
<label style="color:white">
Select employee to be deleted
</label>
<br />
<br />
<select name="selectedEmployee">

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
	echo "<option>...</option>";
	while( $row = mysql_fetch_array( $res ) )
	  {
	    echo "<option>".$row["EmployeeID"]." / ".$row["Fname"]." ".$row["Mname"]." ".$row["Lname"]."</option>";
	  }
      }
  }


?>

</select>
<br />
<br />
<input type="hidden" name="action" />
<input type="submit" value="Delete Employee" / >

</form>

<?php
  if( isset($_POST["action"] ) )
    {
      $emp = $_POST["selectedEmployee"];
      $empId = intval( $emp );

      $query = $deleteEmpFromEmployee.$empId."'";
      $res = mysql_query( $query );
      if( !$res )
	{
	  die ("<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Error in deleting Employee :".mysql_error()."\");}</script>");   
	}
      
      $query = $deleteEmpFromUsers.$empId."'";
      $res = mysql_query( $query );
      if( !$res )
	{
	  die ("<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Error in deleting Users :".mysql_error()."\");}</script>");   
	}

      echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Employee deleted successfully.\");}</script>";

    }


function deleteSubordinates( $empId )
{
  include("config.php");

  echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"In delete supervisor.\");}</script>";

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
      $query = $retrieveSupervisorID.$empId."'";
      $res = mysql_query( $query );
      if( !$res )
	{
	  $row = mysql_fetch_array( $res );
	  if( $row["SupervisorID"] != 0 || $row["SupervisorID"] != "")
	    {	    
	      deleteSupervisors( $empId );
	    }
	  else
	    {
	      $query = $deleteEmpFromAchs.$empId."'";
	      echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"query :".$query."\");}</script>";
	      $res = mysql_query( $query );
	      if( !$res )
		{
		  die ("<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Error in deleting achievements :".mysql_error()."\");}</script>");   
		}

	      $query = $deleteEmpFromSkillSet.$empId."'";
	      echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"query :".$query."\");}</script>";
	      $res = mysql_query( $query );
	      if( !$res )
		{
		  die ("<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Error in deleting skills :".mysql_error()."\");}</script>");   
		}

	      $query = $deleteEmpFromDegrees.$empId."'";
	      $res = mysql_query( $query );
	      if( !$res )
		{
		  die ("<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Error in deleting degrees :".mysql_error()."\");}</script>");   
		}

	      $query = $deleteEmpFromDep.$empId."'";
	      echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"query :".$query."\");}</script>";
	      $res = mysql_query( $query );
	      if( !$res )
		{
		  die ("<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Error in deleting dependents :".mysql_error()."\");}</script>");   
		}

	      $query = $deleteEmpFromManagers.$empId."'";
	      $res = mysql_query( $query );
	      if( !$res )
		{
		  die ("<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Error in deleting manager :".mysql_error()."\");}</script>");   
		}

	      $query = $deleteEmpFromLangKnownW.$empId."'";
	      $res = mysql_query( $query );
	      if( !$res )
		{
		  die ("<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Error in deleting langknownW :".mysql_error()."\");}</script>");   
		}
	      
	      $query = $deleteEmpFromLangKnownS.$empId."'";
	      $res = mysql_query( $query );
	      if( !$res )
		{
		  die ("<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Error in deleting langknownS :".mysql_error()."\");}</script>");   
		}

	      $query = $deleteEmpFromEmpMessages.$empId."'";
	      $res = mysql_query( $query );
	      if( !$res )
		{
		  die ("<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Error in deleting EmpMessages :".mysql_error()."\");}</script>");   
		}

	      $query = $deleteEmpFromEmployee.$empId."'";
	      $res = mysql_query( $query );
	      if( !$res )
		{
		  die ("<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Error in deleting Employee :".mysql_error()."\");}</script>");   
		}
	    }
	}
    }
  mysql_close();
}
?>

</body>
</html>