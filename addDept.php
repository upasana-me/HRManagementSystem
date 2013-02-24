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

<script type="text/javascript">

  i = 2;

function addMore()
{
  var x = document.getElementById('deptable');
  
  var newRow = document.createElement("tr");
  newRow.setAttribute("id","depRow" + i );

  var cell0 = document.createElement("td");
  var cell1 = document.createElement("td");
  var cell2 = document.createElement("td");
  var cell3 = document.createElement("td");

  var inputDeptId = document.createElement("input");
  var inputDeptName = document.createElement("input");
  var inputDeptLocation = document.createElement("input");
  var textNode = document.createTextNode("");

  inputDeptId.setAttribute("id", "deptID" + i );
  inputDeptName.setAttribute("id", "deptName" + i );
  inputDeptLocation.setAttribute("id", "deptLocation" + i );

  inputDeptId.setAttribute("name", "deptID" + i );
  inputDeptName.setAttribute("name", "deptName" + i );
  inputDeptLocation.setAttribute("name", "deptLocation" + i );
  
  cell0.appendChild( inputDeptId );
  cell1.appendChild( inputDeptName );
  cell2.appendChild( inputDeptLocation );
  cell3.appendChild( textNode );

  newRow.appendChild( cell0 );
  newRow.appendChild( cell1 );
  newRow.appendChild( cell2 );
  newRow.appendChild( cell3 );
  
  x.appendChild( newRow );

  i++;
}  

function validateAddForm()
{
  var valid = 1;
  for( j = 1; j < i; j++ )
    {
      var tab = document.getElementById("deptable").rows[ j ];
      var cells = tab.cells;

      var deptId = document.forms['form']["deptID" + j ].value;
      var deptName = document.forms['form']['deptName' + j ].value;
      var deptLocation = document.forms['form']['deptLocation' + j ].value;
      
      var numericExpression = /^[0-9]+$/;

      if( deptId == null || deptId == "" )
	{
	  if( deptName == null || deptName == "" )
	    {
	      if( deptLocation == null || deptLocation == "" )
		{		  
		  cells[3].innerHTML = "";
		  continue;
		}	  
	      else
		{
		  cells[3].innerHTML = "<p style=\"color:red\">Please enter a valid department location</p>";
		  valid = 0;
		  continue;		
		}
	    }
	  else
	    {
	      cells[3].innerHTML = "<p style=\"color:red\">Please enter a valid department name</p>";
	      valid = 0;
	      continue;
	    }
	}
      else if( !deptId.match(numericExpression) )
	{
	  cells[3].innerHTML = "<p style=\"color:red\">Please enter a valid department id</p>";
	  valid = 0;
	  continue;	  
	}
      else
	{
	  cells[3].innerHTML = "";
	}
    }
  
  if( valid == 0 )
    return false;
  else
    return true;
}

function validateDelForm()
{
  var deptId = document.forms['delForm']['delID'].value;
  var numericExpression = /^[0-9]+$/;
  var errorLabel = document.getElementById("delError");

  if( deptId == null || deptId == "")
    {
      errorLabel.innerHTML = "";      
      return false;
    }
  else if( !deptId.match(numericExpression) )
    {
      errorLabel.innerHTML = "Please enter a valid department ID";
      return false;
    }
  else
    {
      errorLabel.innerHTML = "";
      return true;
    }
}

function validateChngByID()
{
  var deptId = document.forms['chngByID']['chngID'].value;
  var deptLoc = document.forms['chngByID']['newLocID'].value;
  var numericExpression = /^[0-9]+$/;
  var errorLabelId = document.getElementById("delChngByIDError");
  var errorLabelLoc = document.getElementById('delChngByIDLocError');

  if( deptId == "" || deptId == null )
    {
      if( deptLoc == "" || deptLoc == null )
	{
	  errorLabelId.innerHTML = "";
	  errorLabelLoc.innerHTML = "";	      
	  return false;	  	  
	}
      else
	{
	  errorLabelLoc.innerHTML = "";	      	  
	  errorLabelId.innerHTML = "Please enter department ID";	  
	  return false;
	}
    }
  else 
    {
      if( !deptId.match( numericExpression ) )
	{
	  errorLabelId.innerHTML = "Please enter a valid department ID";
	  errorLabelLoc.innerHTML = "";	  
	  return false;
	}
      
      if( deptLoc == null || deptLoc == "" )
	{
	  errorLabelId.innerHTML = "";
	  errorLabelLoc.innerHTML = "Please enter a valid location";
	  return false;
	}
      else
	{
	  errorLabelId.innerHTML = "";
	  errorLabelLoc.innerHTML = "";	
	  return true;
	}
    }
}

function validateChngByName()
{
  var deptName = document.forms['chngByName']['chngName'].value;
  var deptLoc = document.forms['chngByName']['newLocName'].value;
  var errorLabelId = document.getElementById("ChngByNameIdError");
  var errorLabelLoc = document.getElementById('ChngByNameLocError');

  if( deptName == "" || deptName == null )
    {
      if( deptLoc == "" || deptLoc == null )
	{
	  errorLabelId.innerHTML = "";
	  errorLabelLoc.innerHTML = "";	      
	  return false;	  	  
	}
      else
	{
	  errorLabelLoc.innerHTML = "";	      	  
	  errorLabelId.innerHTML = "Please enter department name";	  
	  return false;
	}
    }
  else 
    {
      if( deptLoc == null || deptLoc == "" )
	{
	  alert( errorLabelId );
	  errorLabelId.innerHTML = "";
	  errorLabelLoc.innerHTML = "Please enter a valid location";
	  return false;
	}
      else
	{
	  errorLabelId.innerHTML = "";
	  errorLabelLoc.innerHTML = "";	
	  return true;
	}
    }
}

</script>

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
if( $res = mysql_query( $query, $con ) )
  {
    $row = mysql_fetch_array( $res );
    echo $row["Fname"]."@HRMS";
  }
?>
</title>



<style>

h1
{
font-size:200%;
color:RED;
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

h2
{
color:white;
}

</style>
</head>

<body>
<img src="hrms.php" height="15%" width="15%" style="float:left;" />

<h1>
Edit Departments
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


$res = mysql_query( $retrieveAllDept );
if( $res )
  {
    $flag = 0;
    if( $row = mysql_fetch_array( $res ) )
      {
	$flag = 1;
	echo "<h2>Existing Departments</h2>";
	echo "<table id=\"existDep\" cellpadding=\"10\" >";	    
	echo "<th>Department ID</th>";
	echo "<th>Department Name</th>";
	echo "<th>Location</th>";
      }
	    
    do
      {
	echo "<tr><td>".$row["DeptID"]."</td><td>".$row["DeptName"]."</td><td>".$row["Location"]."</td></tr>";
      }
    while( $row = mysql_fetch_array( $res ) );
    
    if( $flag == 1 )
      echo "</table><br/><hr/>";
  }


?>

<h2>
Add Departments
</h2>


<?php
echo "<form action=\"addDept.php\" method=\"post\" onsubmit=\"return validateAddForm();\" name=\"form\">
<table id=\"deptable\" cellpadding=\"10\">
<th>
Department ID
</th>

<th>
Department name
</th>

&nbsp;
&nbsp;

<th>
Location
</th>
";

$deptID = "deptID";
$deptName = "deptName";
$deptLocation = "deptLocation";
$i = 1;

echo "<tr>";
echo "<td><input type=\"text\" name=\"".$deptID.$i."\" maxlength=\"30\" /></td>";
echo "<td><input type=\"text\" name=\"".$deptName.$i."\" maxlength=\"30\" /></td>";
echo "<td id=\"last\"><input type=\"text\" name=\"".$deptLocation.$i."\" maxlength=\"30\" /></td>";
echo "<td></td></tr>";
echo "</table>";

echo "<br/>";
echo "<input type=\"submit\" name=\"submit\" value=\"Submit\" style=\"width:10%\"/>";
echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
echo "<input type=\"hidden\" name=\"action\" />";
echo "<input type=\"button\" value=\"Add more departments\" style=\"align:right\" name=\"addmore\" onclick=\"addMore()\"/>";
echo "</form>";

if( isset( $_POST["action"] ) )
  {
    $j = 1;

    for( $j = 1; $j <= ( ( count($_POST) - 2 ) / 3 ); $j++ )
      {
	$deptID = "deptID".$j;
	$deptName = "deptName".$j;
	$deptLocation = "deptLocation".$j;

	if( isset($_POST[$deptID] ) && $_POST[$deptID] != "" )
	  {	    
	    $id = $_POST[$deptID];
	    $id_options = array("options"=>
				array("min_range"=>0, "max_range"=>10000));
	    if( filter_var( $id, FILTER_VALIDATE_INT, $id_options ) )
	      {
		if( isset( $_POST[$deptName] ) && $_POST[$deptName] != "" )
		  {
		    if( isset( $_POST[$deptLocation] ) && $_POST[$deptLocation] != "" )
		      {
			$query = $retrieveDeptID.$_POST[$deptID]."'";
			$res = mysql_query( $query );
			if( $res )
			  {
			    $row = mysql_fetch_array( $res );
			    if( $row["DeptID"] != $_POST[$deptID] )
			      {
				$query = "INSERT INTO DEPARTMENT VALUES('".$_POST[$deptID]."','".$_POST[$deptName]."','".$_POST[$deptLocation]."')";
				$res = mysql_query( $query );
				if( !$res )
				  {
				    die ("<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Insert Department:".mysql_error( $con )."\");}</script>");
				  }					
			      }
			  }
		      }
		  }
	      }
	    else
	      {
		//			echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Please enter a valid department location.\" );}</script>";
	      }
	  }
	else
	  {
	    //		    echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Please enter a valid department name.\" );}</script>";
	  }	    
      }
    if( $_POST[$deptName] != "")
      {
	//		echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Please enter a valid department ID.\" );}</script>";
      }
  }
?>

<br />
<hr />

<h2>
Delete Departments
</h2>

<form action="addDept.php" name="delForm" method="post" onsubmit="return validateDelForm();">
<label color="white">  
Enter Department ID to be deleted:
</label>
<br/>
<input type="hidden" name="action2" />
<input type="text" name="delID" />
<label style="color:red" id="delError">
</label>
<br/>
<br/>
<input type="submit" name="submit" value="Delete Department" />
</form>

<?php

  if( isset( $_POST["action2"] ) )
    {

      $id = $_POST["delID"];
      $id_options = array("options"=>
			  array("min_range"=>1, "max_range"=>10000));
      if( filter_var( $id, FILTER_VALIDATE_INT, $id_options ) )
	{
	  
	  $query = $retrieveDeptID.$id."'";
	  $res = mysql_query( $query );
	  if( $res )
	    {
	      $row = mysql_fetch_array( $res );
	      if( $row["DeptID"] == $id )
		{
		  $query = $deleteDept.$id."'";
		  $res = mysql_query( $query );
		  if( !$res )
		    {
		      echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Error in deleting department :".mysql_error()."\");}</script>";
		    }
		  else
		    {
		      echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Department deleted.\");}</script>";
		    }
		}
	    }		  
	}      
    }
?>

<br />
<hr />

<h2>
Change Department Location:
</h2>

<form action="addDept.php" onsubmit="return validateChngByID();" method="post" name="chngByID">
<table>
<tr>
<td style="color:white;">
<strong>
Department ID
</strong>
</td>
<td>
<input type="text" name="chngID" />
<label id="delChngByIDError" style="color:red">
</label>
</td>
</tr>
<tr>
<td style="color:white;">
<strong>
New Location
</strong>
</td>
<td>
<input type="text" name="newLocID" />
<input type="hidden" name="action3" />
<label id="delChngByIDLocError" style="color:red">
</label>
</td>
</tr>
<tr>
<td>
<input type="submit" name="ChngLoc" value="Change Location"/ >
</td>
</tr>
</table>
</form>

<form action="addDept.php" onsubmit="return validateChngByName();" method="post" name="chngByName">
<table>
<tr>
<td style="color:white;" >
<strong>
Department Name
</strong>
</td>
<td>
<input type="text" name="chngName" />
<label id="ChngByNameIdError" style="color:red">
</label>
</td>
</tr>
<tr>
<td style="white:color">
<strong>
New Location
</strong>
</td>
<td>
<input type="text" name="newLocName"/>
<input type="hidden" name="action4" />
<label id="ChngByNameLocError" style="color:red">
</label>
</td>
</tr>
<tr>
<td>
<input type="submit" name="ChngLoc2" value="Change Location"/ >
</td>
</tr>
</table>
</form>

<?php

  if( isset($_POST["action3"] ) )
    {
      $id = $_POST["chngID"];
      $id_options = array("options"=>
			  array("min_range"=>1, "max_range"=>10000));
      if( filter_var( $id, FILTER_VALIDATE_INT, $id_options ) )
	{
	  if( isset( $_POST["newLocID"] ) && $_POST["newLocID"] != "")
	    {
	      $query = $retrieveDeptLocID.$id."'";
	      $res = mysql_query( $query );
	      if( $res )
		{
		  $row = mysql_fetch_array( $res );
		  
		  if( $row["DeptID"] == $_POST["chngID"] )
		    {
		      if( $row["Location"] != $_POST["newLocID"] )
			{
			  $query = "UPDATE DEPARTMENT SET Location='".$_POST["newLocID"]."' WHERE DeptID='".$id."'";
			  $res = mysql_query( $query );
			  if( !$res )
			    {
			      die ("<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Error in updating location :".mysql_error()."\");}</script>");
			    }
			  else
			    {
			      echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Location updated successfully.\");}</script>";
			    }
			}
		    }
		  else
		    {
		      echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Department ID doesn't exist.\");}</script>";
		    }
		}
	      else
		{
		  die ("<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Error in updating location :".mysql_error()."\");}</script>");
		}
	    }
	}
    }

if( isset($_POST["action4"]) )
  {
    if( isset($_POST["chngName"] ) && $_POST["chngName"] != "" )
      {
	$name = $_POST["chngName"];

	if( isset( $_POST["newLocName"] ) && $_POST["newLocName"] != "")
	  {
	    $query = $retrieveDeptLocName.$name."'";
	    $res = mysql_query( $query );
	    if( $res )
	      {
		$row = mysql_fetch_array( $res );
		
		if( $row["DeptName"] == $_POST["chngName"] )
		  {
		    if( $row["Location"] != $_POST["newLocName"] )
		      {
			$query = "UPDATE DEPARTMENT SET Location='".$_POST["newLocName"]."' WHERE DeptName='".$name."'";
			$res = mysql_query( $query );
			if( !$res )
			  {
			    die ("<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Error in updating location :".mysql_error()."\");}</script>");
			  }
			else
			  {
			    echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Location updated successfully.\");}</script>";
			  }
		      }
		  }
		else
		  {
		    echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Department doesn't exist.\");}</script>";
		  }
	      }
	    else
	      {
		die ("<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Error in updating location :".mysql_error()."\");}</script>");
	      }
	  }
      }
    mysql_close();
  }

?>

</html>
</body>