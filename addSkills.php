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
  var x = document.getElementById('skilltable');

  var row = document.createElement("tr");

  var cell0 = document.createElement("td");
  var cell1 = document.createElement("td");
  var cell2 = document.createElement("td");

  var input1 = document.createElement("input");
  var input2 = document.createElement("input");
  var txt = document.createTextNode("");

  input1.setAttribute("type","text");
  input2.setAttribute("type","text");

  input1.setAttribute("name","skillID" + i );
  input2.setAttribute("name","skillDesc" + i );

  cell0.appendChild( input1 );
  cell1.appendChild( input2 );
  cell2.appendChild( txt );

  row.appendChild( cell0 );
  row.appendChild( cell1 );
  row.appendChild( cell2 );

  x.appendChild( row );

  i++;
}  

function validateAddForm()
{
  var valid = 1;
  for( j = 1; j < i; j++ )
    {
      var tab = document.getElementById("skilltable").rows[ j ];
      var cells = tab.cells;

      var skillId = document.forms['form']["skillID" + j ].value;
      var skillDesc = document.forms['form']['skillDesc' + j ].value;
      
      var numericExpression = /^[0-9]+$/;

      if( skillId == null || skillId == "" )
	{
	  if( skillDesc == null || skillDesc == "" )
	    {
	      cells[2].innerHTML = "";
	    }
	  else
	    {
	      cells[2].innerHTML = "<p style=\"color:red\">Please enter skill id</p>";
	      valid = 0;
	    }
	}
      else if( skillDesc == null || skillDesc == "" )
	{
	  cells[2].innerHTML = "<p style=\"color:red\">Please enter skill description</p>";
	  valid = 0;
	}
      else if( !skillId.match(numericExpression) )
	{
	  cells[2].innerHTML = "<p style=\"color:red\">Please enter a valid skill id</p>";
	  valid = 0;
	}
      else
	{
	  cells[2].innerHTML = "";
	}
    }
  
  if( valid == 0 )
    return false;
  else
    return true;
}


function validateDelForm()
{
  var skillId = document.forms['delForm']['delID'].value;
  var numericExpression = /^[0-9]+$/;
  var errorLabel = document.getElementById("delError");

  if( skillId == null || skillId == "" )
    {
      errorLabel.innerHTML = "";
      return false;
    }
  else if( !skillId.match(numericExpression) )
    {
      errorLabel.innerHTML = "Please enter a valid skill ID";
      return false;
    }
  else
    {
      errorLabel.innerHTML = "";
      return true;
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
$res = mysql_query( $query, $con );
$row = mysql_fetch_array( $res );
echo $row["Fname"]."@HRMS";
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
color:white;
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
Edit Skills
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


$res = mysql_query( $retrieveAllSkills );
if( $res )
  {
    $flag = 0;
    
    if( $row = mysql_fetch_array( $res ) )
      {
	$flag = 1;
	echo "<h2>Existing Skills</h2>";
	echo "<table id=\"existLang\" cellpadding=\"10\" >";
	echo "<th>Skill ID</th>";
	echo "<th>Skill Description</th>";
      }
    do
      {
	echo "<tr><td>".$row["SkillID"]."</td><td>".$row["SkillDesc"]."</td></tr>";
      }
    while( $row = mysql_fetch_array( $res ) );
    
    if( $flag == 1 )
      echo "</table><br/><hr/>";
  }
?>

<h2>
Add Skills
</h2>

<form onsubmit="return validateAddForm();" action="addSkills.php" method="post" name="form">
<table id="skilltable" cellpadding="5">
<th>
Skill ID
</th>

<th>
Skill Description
</th>

<tr>
<td>
<input type="text" name="skillID1" maxlength="30" />
</td>
<td>
<input type="text" name="skillDesc1" maxlength="30" />
</td>
<td>
</td>
</tr>
</table>

<br/>
<input type="submit" name="submit" value="Submit" style="width:10%"/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="hidden" name="action" />
<input type="button" value="Add more skills" style="align:right" name="addmore" onclick="addMore()"/>
</form>

<?php

if( isset( $_POST["action"] ) )
  {
    $j = 1;

    for( $j = 1; $j <= ( ( count($_POST) - 2 ) / 2 ); $j++ )
      {
	$skillID = "skillID".$j;
	$skillDesc = "skillDesc".$j;

	if( isset($_POST[$skillID] ) && $_POST[$skillDesc] != "" )
	  {	    
	    $id = $_POST[$skillID];
	    $id_options = array("options"=>
				array("min_range"=>1, "max_range"=>10000));
	    if( filter_var( $id, FILTER_VALIDATE_INT, $id_options ) )
	      {
		if( isset( $_POST[$skillDesc] ) && $_POST[$skillDesc] != "" )
		  {
		    $query = $retrieveSkillID.$_POST[$skillID]."'";
		    $res = mysql_query( $query );
		    if( $res )
		      {
			$row = mysql_fetch_array( $res );				    
			if( $row["SkillID"] != $_POST[$skillID] )
			  {
			    $query = "INSERT INTO SKILLS VALUES('".$_POST[$skillID]."','".$_POST[$skillDesc]."')";
			    $res = mysql_query( $query );
			    if( !$res )
			      {
				die ("<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Insert Skill:".mysql_error( $con )."\");}</script>");
			      }
			  }
		      }
		  }
	      }
	  }
      }
  }
?>

<br />
<hr />

<h2>
Delete Skill
</h2>

<form onsubmit="return validateDelForm();" action="addSkills.php" name="delForm" method="post" >
<label color="white">  
Enter Skill ID to be deleted:
</label>
<br/>
<input type="hidden" name="action2" />
<input type="text" name="delID" />
<label id="delError" style="color:red">
</label>
<br/>
<br/>
<input type="submit" name="submit" value="Delete Skills" />
</form>

<?php

  if( isset( $_POST["action2"] ) )
    {
      $id = $_POST["delID"];
      $id_options = array("options"=>
			  array("min_range"=>1, "max_range"=>10000));
      if( filter_var( $id, FILTER_VALIDATE_INT, $id_options ) )
	{
	  $query = $retrieveSkillID.$id."'";
	  $res = mysql_query( $query );
	  if( $res )
	    {
	      $row = mysql_fetch_array( $res );
	      if( $row["SkillID"] == $id )
		{
		  $query = $deleteSkill.$id."'";
		  $res = mysql_query( $query );
		  if( !$res )
		    {
		      echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Error in deleting Skill :".mysql_error()."\");}</script>";
		    }
		  else
		    {
		      echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Skill deleted.\");}</script>";
		    }
		}
	    }		  
	}
      else
	{
	  echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Enter a valid Skill ID.\");}</script>";	  
	}
    }
?>
</html>
</body>