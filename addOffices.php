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
  var x = document.getElementById('offtable');
  
  var newRow = document.createElement("tr");

  var cell0 = document.createElement("td");
  var cell1 = document.createElement("td");
  var cell2 = document.createElement("td");
  var cell3 = document.createElement("td");
  var cell4 = document.createElement("td");

  var inputOffId = document.createElement("input");
  var inputOffLocation = document.createElement("input");
  var inputOffPhone = document.createElement("input");
  var inputOffFax = document.createElement("input");
  var textNode = document.createTextNode("");

  inputOffId.setAttribute("id", "officeID" + i );
  inputOffLocation.setAttribute("id", "offLocation" + i );
  inputOffPhone.setAttribute("id", "phoneNo" + i );
  inputOffFax.setAttribute("id", "fax" + i );

  inputOffId.setAttribute("name", "officeID" + i );
  inputOffLocation.setAttribute("name", "offLocation" + i );
  inputOffPhone.setAttribute("name", "phoneNo" + i );
  inputOffFax.setAttribute("name", "fax" + i );
  
  cell0.appendChild( inputOffId );
  cell1.appendChild( inputOffLocation );
  cell2.appendChild( inputOffPhone );
  cell3.appendChild( inputOffFax );
  cell4.appendChild( textNode );

  newRow.appendChild( cell0 );
  newRow.appendChild( cell1 );
  newRow.appendChild( cell2 );
  newRow.appendChild( cell3 );
  newRow.appendChild( cell4 );
  
  x.appendChild( newRow );

  i++;
}  


function validateAddForm()
{
  var valid = 1;
  for( j = 1; j < i; j++ )
    {
      var tab = document.getElementById("offtable").rows[ j ];
      var cells = tab.cells;

      var offId = document.forms['form']["officeID" + j ].value;
      var offLocation = document.forms['form']['offLocation' + j ].value;
      var offPhone = document.forms['form']['phoneNo' + j ].value;
      var offFax = document.forms['form']['fax' + j ].value;      

      var numericExpression = /^[0-9]+$/;
      var phoneExpression = /^[0-9]{6,}$/;
      var faxExpression = /^[0-9]{10}$/;

      if( offId == null || offId == "" )
	{
	  if( offLocation == null || offLocation == "" )
	    {
	      if( offPhone == null || offPhone == "" )
		{		  
		  if( offFax == null || offFax == "" )
		    {
		      cells[4].innerHTML = "";		      
		      continue;
		    }
		  else
		    {
		      cells[4].innerHTML = "<p style=\"color:red\">Please enter a office id, location and phone number.</p>";
		      valid = 0;
		      continue;		
		    }
		}	  
	      else
		{
		  cells[4].innerHTML = "<p style=\"color:red\">Please enter a office id & location</p>";
		  valid = 0;
		  continue;		
		}
	    }
	  else
	    {
	      cells[4].innerHTML = "<p style=\"color:red\">Please enter office id</p>";
	      valid = 0;
	      continue;
	    }
	}
      else if( !offId.match(numericExpression) )
	{
	  cells[4].innerHTML = "<p style=\"color:red\">Please enter a valid office id</p>";
	  valid = 0;
	  continue;	  
	}
      else if( offLocation == null || offLocation == "" )
	{
	  cells[4].innerHTML = "<p style=\"color:red\">Please enter a office location</p>";
	  valid = 0;
	}
      else if( offPhone == null || offPhone == "" )
	{
	  cells[4].innerHTML = "<p style=\"color:red\">Please enter phone number</p>";
	  valid = 0;
	}
      else if( !offPhone.match(phoneExpression))
	{
	  cells[4].innerHTML = "<p style=\"color:red\">Please enter a valid phone number</p>";
	  valid = 0;	  
	}
      else if( offFax == null || offFax == "" )
	{
	  cells[4].innerHTML = "<p style=\"color:red\">Please enter fax number</p>";
	  valid = 0;
	}
      else if( !offFax.match(faxExpression))
	{
	  cells[4].innerHTML = "<p style=\"color:red\">Please enter a valid fax number</p>";
	  valid = 0;	  
	}
      else
	{
	  cells[4].innerHTML = "";	  
	}
    }
  
  if( valid == 0 )
    {
      return false;
    }
  else
    {
      return true;
    }
}










function validateDelForm()
{
  var offId = document.forms['delForm']['delID'].value;
  var numericExpression = /^[0-9]+$/;
  var errorLabel = document.getElementById("delError");

  if( offId == null || offId == "")
    {
      errorLabel.innerHTML = "";      
      return false;
    }
  else if( !offId.match(numericExpression) )
    {
      errorLabel.innerHTML = "Please enter a valid office ID";
      return false;
    }
  else
    {
      errorLabel.innerHTML = "";
      return true;
    }
}

function validateChngLoc()
{
  var offId = document.forms['chngLoc']['chngID'].value;
  var offLoc = document.forms['chngLoc']['newLoc'].value;
  var numericExpression = /^[0-9]+$/;
  var errorLabelId = document.getElementById("chngLocIDError");
  var errorLabelLoc = document.getElementById('chngLocLocError');

  if( offId == "" || offId == null )
    {
      if( offLoc == "" || offLoc == null )
	{
	  errorLabelId.innerHTML = "";
	  errorLabelLoc.innerHTML = "";	      
	  return false;	  	  
	}
      else
	{
	  errorLabelLoc.innerHTML = "";	      	  
	  errorLabelId.innerHTML = "Please enter office ID";	  
	  return false;
	}
    }
  else 
    {
      if( !offId.match( numericExpression ) )
	{
	  alert( errorLabelLoc );
	  errorLabelId.innerHTML = "Please enter a valid office ID";
	  errorLabelLoc.innerHTML = "";	  
	  return false;
	}
      
      if( offLoc == null || offLoc == "" )
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

function validateChngPhn()
{
  var offId = document.forms['chngPhone']['chngID2'].value;
  var newPhone = document.forms['chngPhone']['newPhone'].value;
  var numericExpression = /^[0-9]+$/;
  var numericExpression2 = /^[0-9]{6,10}$/;
  var errorLabelId = document.getElementById("chngPhnIdError");
  var errorLabelPhn = document.getElementById('chngPhnPhnError');

  if( offId == "" || offId == null )
    {
      if( newPhone == "" || newPhone == null )
	{
	  errorLabelId.innerHTML = "";
	  errorLabelPhn.innerHTML = "";	      
	  return false;	  	  
	}
      else
	{
	  errorLabelPhn.innerHTML = "";	      	  
	  errorLabelId.innerHTML = "Please enter office ID";	  
	  return false;
	}
    }
  else if( !offId.match( numericExpression ) )
    {
      errorLabelId.innerHTML = "Please enter a valid office ID";
      errorLabelPhn.innerHTML = "";	  
      return false;
    }      
  else if( newPhone == null || newPhone == "" )
    {
      errorLabelId.innerHTML = "";
      errorLabelPhn.innerHTML = "Please enter phone number";
      return false;
    }
  else if( !newPhone.match( numericExpression2 ))
    {
      errorLabelId.innerHTML = "";
      errorLabelPhn.innerHTML = "Please enter a valid phone number";	
      return false;
    }
  else
    {
      errorLabelId.innerHTML = "";
      errorLabelPhn.innerHTML = "";	
      return true;
    }
}

function validateChngFax()
{
  var offId = document.forms['chngFax']['chngID3'].value;
  var newFax = document.forms['chngFax']['newFax'].value;
  var numericExpression = /^[0-9]+$/;
  var numericExpression2 = /^[0-9]{10}$/;
  var errorLabelId = document.getElementById("chngFaxIdError");
  var errorLabelFax = document.getElementById('chngFaxFaxError');

  if( offId == "" || offId == null )
    {
      if( newFax == "" || newFax == null )
	{
	  errorLabelId.innerHTML = "";
	  errorLabelFax.innerHTML = "";	      
	  return false;	  	  
	}
      else
	{
	  errorLabelFax.innerHTML = "";	      	  
	  errorLabelId.innerHTML = "Please enter office ID";	  
	  return false;
	}
    }
  else if( !offId.match( numericExpression ) )
    {
      errorLabelId.innerHTML = "Please enter a valid office ID";
      errorLabelFax.innerHTML = "";	  
      return false;
    }      
  else if( newFax == null || newFax == "" )
    {
      errorLabelId.innerHTML = "";
      errorLabelFax.innerHTML = "Please enter fax number";
      return false;
    }
  else if( !newFax.match( numericExpression2 ))
    {
      errorLabelId.innerHTML = "";
      errorLabelFax.innerHTML = "Please enter a valid fax number";	
      return false;
    }
  else
    {
      errorLabelId.innerHTML = "";
      errorLabelFax.innerHTML = "";	
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
Edit Offices
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

$res = mysql_query( $retrieveAllOff );
if( $res )
  {
    $flag = 0;

    if( $row = mysql_fetch_array( $res ) )
      {
	$flag = 1;
	echo "<h2>Existing Offices</h2>";
	echo "<table id=\"existDep\" cellpadding=\"10\" >";	    
	echo "<th>Office ID</th>";
	echo "<th>Location</th>";
	echo "<th>Phone Number</th>";
	echo "<th>FAX</th>";
      }
    do
      {
	echo "<tr><td>".$row["OfficeID"]."</td><td>".$row["Location"]."</td><td>".$row["PhoneNumber"]."</td><td>".$row["Fax"]."</td></tr>";
      }
    while( $row = mysql_fetch_array( $res ) );
    
    if( $flag == 1 )
      {
	echo "</table><br/><hr/>";
      }
  }
?>

<h2>
Add Offices
</h2>

<form onsubmit="return validateAddForm();" action="addOffices.php" method="post" name="form">
<table id="offtable" cellpadding="10">
<th>
Office ID
</th>

<th>
Location
</th>

&nbsp;
&nbsp;

<th>
Phone Number
</th>

<th>
Fax
</th>

<tr>
<td>
<input type="text" name="officeID1" maxlength="30" />
</td>
<td>
<input type="text" name="offLocation1" maxlength="30" />
</td>
<td>
<input type="text" name="phoneNo1" maxlength="20" />
</td>
<td>
<input type="text" name="fax1" maxlength="20"/>
</td>
<td>
</td>
</tr>
</table>

<br/>
<input type="submit" name="submit" value="Submit" style="width:10%"/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="hidden" name="action" />
<input type="button" value="Add more offices" style="align:right" name="addmore" onclick="addMore()"/>

</form>


<?php

if( isset( $_POST["action"] ) )
  {
    for( $j = 1; $j <= ( ( count($_POST) - 2 ) / 3 ); $j++ )
      {
	$officeID = "officeID".$j;
	$offLocation = "offLocation".$j;
	$phoneNo = "phoneNo".$j;
	$fax = "fax".$j;
      
	if( isset($_POST[$officeID] ) && $_POST[$officeID] != "" )
	  {	    
	    if( isset( $_POST[$offLocation] ) && $_POST[$offLocation] != "" )
	      {
		if( isset( $_POST[$phoneNo] ) && $_POST[$phoneNo] != "" )
		  {
		    if( isset( $_POST[$fax] ) && $_POST[$fax] != "" )
		      { 
			$query = $retrieveOffID.$_POST[$officeID]."'";
			$res = mysql_query( $query );
			if( $res )
			  {
			    $row = mysql_fetch_array( $res );
			    if( $row["OfficeID"] != $_POST[$officeID] )
			      {
				$query = "INSERT INTO OFFICES VALUES('".$_POST[$officeID]."','".$_POST[$offLocation]."','".$_POST[$phoneNo]."','".$_POST[$fax]."')";
				$res = mysql_query( $query );
				if( !$res )
				  {
				    die ("<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Insert Office:".mysql_error( $con )."\");}</script>");
				  }					
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
Delete Office
</h2>

<form action="addOffices.php" onsubmit="return validateDelForm();" name="delForm" method="post" >
<label color="white">  
Enter Office ID to be deleted:
</label>
<br/>
<input type="hidden" name="action2" />
<input type="text" name="delID" />
<label style="color:red" id="delError">
</label>
<br/>
<br/>
<input type="submit" name="submit" value="Delete Office" />
</form>

<?php

  if( isset( $_POST["action2"] ) )
    {

      $id = $_POST["delID"];
      $id_options = array("options"=>
			  array("min_range"=>1, "max_range"=>256));
      if( filter_var( $id, FILTER_VALIDATE_INT, $id_optios ) )
	{	  
	  $query = $retrieveOffID.$id."'";
	  $res = mysql_query( $query );
	  if( $res )
	    {
	      $row = mysql_fetch_array( $res );
	      if( $row["OfficeID"] == $id )
		{
		  $query = $deleteOffice.$id."'";
		  $res = mysql_query( $query );
		  if( !$res )
		    {
		      echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Error in deleting office :".mysql_error()."\");}</script>";
		    }
		  else
		    {
		      echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Office deleted.\");}</script>";
		    }
		}
	    }		  
	} 
      else
	{
	  echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Enter a valid Office ID.\");}</script>";	  
	}
    }
?>




<br />
<hr />

<h2>
Change Office Location
</h2>

<form action="addOffices.php" onsubmit="return validateChngLoc();" method="post" name="chngLoc">
<table>
<tr>
<td style="color:white;">
<strong>
Office ID
</strong>
</td>
<td>
<input type="text" name="chngID" />
<label style="color:red" id="chngLocIDError">
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
<input type="text" name="newLoc" />
<input type="hidden" name="action3" />
<label style="color:red" id="chngLocLocError">
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


<?php

  if( isset($_POST["action3"] ) )
    {
      $id = $_POST["chngID"];
      $id_options = array("options"=>
			  array("min_range"=>1, "max_range"=>10000));
      if( filter_var( $id, FILTER_VALIDATE_INT, $id_optios ) )
	{
	  if( isset( $_POST["newLoc"] ) && $_POST["newLoc"] != "")
	    {
	      $query = $retrieveOffLocID.$id."'";
	      $res = mysql_query( $query );
	      if( $res )
		{
		  $row = mysql_fetch_array( $res );
		  
		  if( $row["OfficeID"] == $_POST["chngID"] )
		    {
		      if( $row["Location"] != $_POST["newLoc"] )
			{
			  $query = "UPDATE OFFICES SET Location='".$_POST["newLoc"]."' WHERE OfficeID='".$id."'";
			  $res = mysql_query( $query );
			  if( !$res )
			    {
			      die ("<script type=\"text/javascript\">try{throw \"err\" }catch(err){alert(\"Error in updating office' location :".mysql_error()."\");}</script>");
			    }
			  else
			    {
			      echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Location updated successfully.\");}</script>";
			    }
			}
		    }
		  else
		    {
		      echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Office ID doesn't exist.\");}</script>";
		    }
		}
	      else
		{
		  die ("<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Error in updating location :".mysql_error()."\");}</script>");
		}
	    }
	}
    }
?>

<br/>
<hr/>

<h2>
Change Office Phone Number
</h2>


<form onsubmit="return validateChngPhn();" action="addOffices.php" method="post" name="chngPhone">
<table>
<tr>
<td style="color:white;" >
<strong>
Office ID
</strong>
</td>
<td>
<input type="text" name="chngID2" />
<label style="color:red" id="chngPhnIdError">
</label>
</td>
</tr>
<tr>
<td style="white:color">
<strong>
New phone number
</strong>
</td>
<td>
<input type="text" name="newPhone"/>
<label style="color:red" id="chngPhnPhnError">
</label>
<input type="hidden" name="action4" />
</td>
</tr>
<tr>
<td>
<input type="submit" name="ChngPhone2" value="Change Phone number"/ >
</td>
</tr>
</table>
</form>

<?php
  
  if( isset($_POST["action4"]) )
    {
	if( isset($_POST["chngID2"] ) && $_POST["chngID2"] != "" )
	  {	    
	    $id = $_POST["chngID2"];
	    $id_options = array("options"=>
				array("min_range"=>1, "max_range"=>10000));
	    if( filter_var( $id, FILTER_VALIDATE_INT, $id_optios ) )
	      {
		if( isset( $_POST["newPhone"] ) && $_POST["newPhone"] != "" && preg_match("/^(\d){6,}$/", $_POST["newPhone"]) )
		  {
		    $query = $retrieveOffIDPhone.$_POST["chngID2"]."'";
		    //				    var_dump($query);
		    $res = mysql_query( $query );
		    //				    var_dump($res);
		    if( $res )
		      {
			$row = mysql_fetch_array( $res );
			//					var_dump($row["OfficeID"]);
			if( $row["OfficeID"] == $_POST["chngID2"] )
			  {
			    if( $row["PhoneNumber"] != $_POST["newPhone"] )
			      {
				$query = "UPDATE OFFICES SET PhoneNumber='".$_POST["newPhone"]."' WHERE OfficeID='".$id."'";
				$res = mysql_query( $query );
				if( !$res )
				  {
				    die ("<script type=\"text/javascript\">try{throw \"err\"}catch(err){alert(\"Updating phone number:".mysql_error( $con )."\");}</script>");
				  }
				else
				  {
				    echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Phone number updated successfully.\" );}</script>";	  
				  }
			      }
			  }
			else
			  {
			    echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Office ID doesn't exists.\" );}</script>";	  
			  }
		      }
		    else
		      {
			die ("<script type=\"text/javascript\">try{throw \"err\"}catch(err){alert(\"Updating phone number:".mysql_error( $con )."\");}</script>");
		      }
		  }
	      }
	  }
    }
?>


<br/>
<hr/>

<h2>
Change Office FAX
</h2>

<form onsubmit="return validateChngFax();" action="addOffices.php" method="post" name="chngFax">
<table>
<tr>
<td style="color:white;" >
<strong>
Office ID
</strong>
</td>
<td>
<input type="text" name="chngID3" />
<label id="chngFaxIdError" style="color:red" >
</label>
</td>
</tr>
<tr>
<td style="white:color">
<strong>
New FAX
</strong>
</td>
<td>
<input type="text" name="newFax"/>
<label id="chngFaxFaxError" style="color:red" >
</label>
<input type="hidden" name="action5" />
</td>
</tr>
<tr>
<td>
<input type="submit" name="ChngFax2" value="Change FAX"/ >
</td>
</tr>
</table>
</form>

<?php
  if( isset($_POST["action5"]) )
    {
	if( isset($_POST["chngID3"] ) && $_POST["chngID3"] != "" )
	  {	    
	    $id = $_POST["chngID3"];
	    $id_options = array("options"=>
				array("min_range"=>1, "max_range"=>10000));
	    if( filter_var( $id, FILTER_VALIDATE_INT, $id_optios ) )
	      {
		if( isset( $_POST["newFax"] ) && $_POST["newFax"] != "" && preg_match("/^(\d){10}$/", $_POST["newFax"]) )
		  {
		    $query = $retrieveOffIDFax.$_POST["chngID3"]."'";
		    //				    var_dump($query);
		    $res = mysql_query( $query );
		    //				    var_dump($res);
		    if( $res )
		      {
			$row = mysql_fetch_array( $res );
			//					var_dump($row["OfficeID"]);
			if( $row["OfficeID"] == $_POST["chngID3"] )
			  {
			    if( $row["Fax"] != $_POST["newFax"] )
			      {
				$query = "UPDATE OFFICES SET Fax='".$_POST["newFax"]."' WHERE OfficeID='".$id."'";
				$res = mysql_query( $query );
				if( !$res )
				  {
				    die ("<script type=\"text/javascript\">try{throw \"err\"}catch(err){alert(\"Updating FAX:".mysql_error( $con )."\");}</script>");
				  }
				else
				  {
				    echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"FAX updated successfully.\" );}</script>";	  
				  }
			      }
			  }
			else
			  {
			    echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Office ID doesn't exists.\" );}</script>";	  
			  }
		      }
		    else
		      {
			die ("<script type=\"text/javascript\">try{throw \"err\"}catch(err){alert(\"Updating FAX:".mysql_error( $con )."\");}</script>");
		      }
		  }
	      }
	  }
    }


?>



</html>
</body>