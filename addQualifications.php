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
  var x = document.getElementById('qualtable');
  
  var newRow = document.createElement("tr");
  newRow.setAttribute("id","depRow" + i );

  var cell0 = document.createElement("td");
  var cell1 = document.createElement("td");
  var cell2 = document.createElement("td");

  var inputQualId = document.createElement("input");
  var inputQualDesc = document.createElement("input");
  var textNode = document.createTextNode("");

  inputQualId.setAttribute("id", "qualID" + i );
  inputQualDesc.setAttribute("id", "qualDesc" + i );

  inputQualId.setAttribute("name", "qualID" + i );
  inputQualDesc.setAttribute("name", "qualDesc" + i );
  
  cell0.appendChild( inputQualId );
  cell1.appendChild( inputQualDesc );
  cell2.appendChild( textNode );

  newRow.appendChild( cell0 );
  newRow.appendChild( cell1 );
  newRow.appendChild( cell2 );
  
  x.appendChild( newRow );

  i++;
}  


function validateAddForm()
{
  var valid = 1;
  for( j = 1; j < i; j++ )
    {
      var tab = document.getElementById("qualtable").rows[ j ];
      var cells = tab.cells;

      var qualId = document.forms['form']["qualID" + j ].value;
      var qualDesc = document.forms['form']['qualDesc' + j ].value;
      
      var numericExpression = /^[0-9]+$/;

      if( qualId == null || qualId == "" )
	{
	  if( qualDesc == null || qualDesc == "" )
	    {
	      cells[2].innerHTML = "";
	    }
	  else
	    {
	      cells[2].innerHTML = "<p style=\"color:red\">Please enter a valid qualification description</p>";
	      valid = 0;
	    }
	}
      else if( qualDesc == null || qualDesc == "" )
	{
	  cells[2].innerHTML = "<p style=\"color:red\">Please enter a valid qualification description</p>";
	  valid = 0;
	}
      else if( !qualId.match(numericExpression) )
	{
	  cells[2].innerHTML = "<p style=\"color:red\">Please enter a valid qualification id</p>";
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
  var qualId = document.forms['delForm']['delID'].value;
  var numericExpression = /^[0-9]+$/;
  var errorLabel = document.getElementById("delError");

  if( qualId == null || qualId == "")
    {
      errorLabel.innerHTML = "";      
      return false;
    }
  else if( !qualId.match(numericExpression) )
    {
      errorLabel.innerHTML = "Please enter a valid qualification ID";
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
Edit Qualifications
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
	$res = mysql_query( $retrieveAllQual );
	if( $res )
	  {
	    $flag = 0;
	    if( $row = mysql_fetch_array( $res ) )
	      {
		$flag = 1;
		echo "<h2><u>Existing Qualifications</u></h2>";
		echo "<table id=\"existPos\" cellpadding=\"10\" >";
		echo "<th>Qualification ID</th>";
		echo "<th>Qualification Description</th>";
	      }

	    do
	      {
		echo "<tr><td>".$row["QualID"]."</td><td>".$row["QualDesc"]."</td></tr>";
	      }
	    while( $row = mysql_fetch_array( $res ) );
	    
	    if( $flag == 1 )
	      echo "</table><br/><hr/>";
	  }
	else
	  {
	   
	  }
      }
  }
?>

<h2>
<u>
Add Qualifications
</u>
</h2>

<form action="addQualifications.php" onsubmit="return validateAddForm();" method="post" name="form">
<table id="qualtable" cellpadding="5">
<th>
Qualification ID
</th>

<th>
Qualification Description
</th>

<tr>
<td>
<input type="text" name="qualID1" maxlength="30" />
</td>
<td>
<input type="text" name="qualDesc1" maxlength="30" />
</td>
<td>
</td>
</tr>
</table>

<br/>
<input type="submit" name="submit" value="Submit" style="width:10%"/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="hidden" name="action" />
<input type="button" value="Add more qualifications" style="align:right" name="addmore" onclick="addMore()"/>
</form>

<?php

if( isset( $_POST["action"] ) )
  {
    $j = 1;

    for( $j = 1; $j <= ( ( count($_POST) - 2 ) / 2 ); $j++ )
      {
	$qualID= "qualID".$j;
	$qualDesc = "qualDesc".$j;

	if( isset($_POST[$qualID] ) && $_POST[$qualID] != "" )
	  {	    
	    $id = $_POST[$qualID];
	    $id_options = array("options"=>
				array("min_range"=>1, "max_range"=>256));
	    if( filter_var( $id, FILTER_VALIDATE_INT, $id_options ) )
	      {
		if( isset( $_POST[$qualDesc] ) && $_POST[$qualDesc] != "" )
		  {
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
				$query = $retrieveQualID.$_POST[$qualID]."'";
				$res = mysql_query( $query );
				if( $res )
				  {
				    $row = mysql_fetch_array( $res );
				    if( $row["QualID"] != $_POST[$qualID] )
				      {
					$query = "INSERT INTO QUALIFICATION VALUES('".$_POST[$qualID]."','".$_POST[$qualDesc]."')";
					$res = mysql_query( $query );
					if( !$res )
					  {
					    die ("<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Insert qualification:".mysql_error( $con )."\");}</script>");
					  }
				      }
				  }
			      }
			  }
			mysql_close();
		  }
	      }
	  }
      }
}

?>

<br />
<hr />

<h2><u>
Delete Qualification
</u></h2>

<form action="addQualifications.php" onsubmit="return validateDelForm();" name="delForm" method="post" >
<label color="white">  
Enter Qualification ID to be deleted:
</label>
<br/>
<input type="hidden" name="action2" />
<input type="text" name="delID" />
<label id="delError" style="color:red">
</label>
<br/>
<br/>
<input type="submit" name="submit" value="Delete Qualification" />
</form>

<?php

  if( isset( $_POST["action2"] ) )
    {

      $id = $_POST["delID"];
      $id_options = array("options"=>
			  array("min_range"=>1, "max_range"=>256));
      if( filter_var( $id, FILTER_VALIDATE_INT, $id_options ) )
	{
	  
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
		  $query = $retrieveQualID.$id."'";
		  $res = mysql_query( $query );
		  if( $res )
		    {
		      $row = mysql_fetch_array( $res );
		      if( $row["QualID"] == $id )
			{
			  $query = $deleteQual.$id."'";
			  $res = mysql_query( $query );
			  if( !$res )
			    {
			      echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Error in deleting qualification :".mysql_error()."\");}</script>";
			    }
			  else
			    {
			      echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Qualification deleted.\");}</script>";
			    }
			}
		    }		  
		}
	      
	    }
	}
    }
?>






</html>
</body>