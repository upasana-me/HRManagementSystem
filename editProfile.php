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

//echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"in display profile.\");}</script>";

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

langS = 12;
langW = 11;

function addMoreLangW()
{
  var ddlist = document.getElementById("empLangID");
  var row = document.getElementById('empPersonal').insertRow(langW);

  //  var row = document.createElement("tr");
  var cell0 = document.createElement("td");  
  var cell1 = document.createElement("td");
  var cell2 = document.createElement("td");

  var sel = ddlist.cloneNode( true );
  sel.setAttribute("name","empLangW" + empLangWNo );
  
  cell2.appendChild( sel );

  row.appendChild( cell0 );
  row.appendChild( cell1 );
  row.appendChild( cell2 );

  langW++;
  langS++;
  empLangWNo++;  
}

function addMoreLangS()
{
  var ddlist = document.getElementById("empLangID");
  var row = document.getElementById('empPersonal').insertRow(langS);

  var cell0 = document.createElement("td");
  var cell1 = document.createElement("td");
  var cell2 = document.createElement("td");

  var sel = ddlist.cloneNode( true );
  sel.setAttribute("name","empLangS" + empLangSNo );
  
  cell2.appendChild( sel );

  row.appendChild( cell0 );
  row.appendChild( cell1 );
  row.appendChild( cell2 );

  langS++;
  empLangSNo++;  
}

function addMoreQuals()
{
  var x = document.getElementById("empQualTab");

  var row = document.createElement("tr");

  var cell0 = document.createElement("td");
  var cell1 = document.createElement("td");
  var cell2 = document.createElement("td");
  var cell3 = document.createElement("td");
  var cell4 = document.createElement("td");
  var cell5 = document.createElement("td");

  var squal = document.getElementById("empQual1");
  var syear = document.getElementById("qualYr1");
  
  var input0 = document.createTextNode( empQualNo );
  var input1 = squal.cloneNode("true");
  var input2 = syear.cloneNode("true");
  var input3 = document.createElement("textarea");
  var input4 = document.createElement("textarea");
  var input5 = document.createElement("label");

  input1.setAttribute("name","qual" + empQualNo );
  input2.setAttribute("name","passYr" + empQualNo );
  input3.setAttribute("name","institute" + empQualNo );
  input4.setAttribute("name","board" + empQualNo );
  input5.setAttribute("id","qualError" + empQualNo );
  
  input1.setAttribute("id","empQual" + empQualNo );
  input2.setAttribute("id","qualYr" + empQualNo );

  input3.setAttribute("rows","5" );
  input4.setAttribute("rows","5" );

  input5.style.color = "red";

  input3.setAttribute("cols","35" );
  input4.setAttribute("cols","35" );

  cell0.appendChild( input0 );
  cell1.appendChild( input1 );
  cell2.appendChild( input2 );
  cell3.appendChild( input3 );
  cell4.appendChild( input4 );
  cell5.appendChild( input5 );

  row.appendChild( cell0 );
  row.appendChild( cell1 );
  row.appendChild( cell2 );
  row.appendChild( cell3 );
  row.appendChild( cell4 );
  row.appendChild( cell5 );

  x.appendChild( row );

  empQualNo++;
}


function addMoreAchv()
{
  var x = document.getElementById("empAchTab");

  var row = document.createElement("tr");

  var cell0 = document.createElement("td");
  var cell1 = document.createElement("td");
  var cell2 = document.createElement("td");
  var cell3 = document.createElement("td");

  cell1.setAttribute("colspan","3");

  var i = empAchNo - 1;
  var syear = document.getElementById("empAchYrList" + i);
  
  var input0 = document.createTextNode( empAchNo );
  var input1 = document.createElement("input");
  var input2 = syear.cloneNode("true");
  var input3 = document.createElement("label");

  input1.setAttribute("type","text");
  input2.setAttribute("id", "empAchYrList" + empAchNo );

  input1.setAttribute("name","empAch" + empAchNo );
  input2.setAttribute("name","empAchYr" + empAchNo );
  input3.setAttribute("id","achError" + empAchNo );
  
  input1.style.width = "100%";
  input3.style.color = "red";

  cell0.appendChild( input0 );
  cell1.appendChild( input1 );
  cell2.appendChild( input2 );
  cell3.appendChild( input3 );

  row.appendChild( cell0 );
  row.appendChild( cell1 );
  row.appendChild( cell2 );
  row.appendChild( cell3 );

  x.appendChild( row );

  empAchNo++;  
}

function addMoreSkills()
{
  var x = document.getElementById("empSkillTab");

  var row = document.createElement("tr");

  var cell0 = document.createElement("td");
  var cell1 = document.createElement("td");
  var cell2 = document.createElement("td");

  //  cell1.setAttribute("colspan","3");

  var skill = document.getElementById("empSkillList");
  
  var input0 = document.createTextNode( empSkillNo );
  var input1 = skill.cloneNode("true");
  var input2 = document.createElement("label");

  input1.setAttribute("name","empSkill" + empSkillNo );
  input2.setAttribute("id","skillError" + empSkillNo );
  
  cell0.appendChild( input0 );
  cell1.appendChild( input1 );
  cell2.appendChild( input2 );

  row.appendChild( cell0 );
  row.appendChild( cell1 );
  row.appendChild( cell2 );

  x.appendChild( row );

  empSkillNo++;  

}

function addMoreDep()
{
  var x = document.getElementById("empDepTab");

  var row = document.createElement("tr");

  var cell0 = document.createElement("td");
  var cell1 = document.createElement("td");
  var cell2 = document.createElement("td");
  var cell3 = document.createElement("td");
  var cell4 = document.createElement("td");
  var cell5 = document.createElement("td");
  var cell6 = document.createElement("td");

  var i = empDepNo - 1;

  var smonth = document.getElementById("dmonthId" + i);
  var sday = document.getElementById("ddayId" + i);
  var syear = document.getElementById("dyearId" + i);
  var srelation = document.getElementById("drelation");

  var input0 = document.createTextNode( empDepNo );
  var input1 = document.createElement("input");
  var input2 = document.createElement("input");
  var input3 = document.createElement("input");
  var input4a = smonth.cloneNode("true");
  var input4b = sday.cloneNode("true");
  var input4c = syear.cloneNode("true");
  var input5 = srelation.cloneNode("true");
  var input6 = document.createElement("label");

  input1.setAttribute("type","text");
  input2.setAttribute("type","text");
  input3.setAttribute("type","text");

  input1.setAttribute("name","dFname" + empDepNo );
  input2.setAttribute("name","dMname" + empDepNo );
  input3.setAttribute("name","dLname" + empDepNo );
  input4a.setAttribute("name","dmonth" + empDepNo );
  input4b.setAttribute("name","dday" + empDepNo );
  input4c.setAttribute("name","dyear" + empDepNo );
  input5.setAttribute("name","drelation" + empDepNo );

  input4a.setAttribute("id","dmonthId" + empDepNo );
  input4b.setAttribute("id","ddayId" + empDepNo );
  input4c.setAttribute("id","dyearId" + empDepNo );
  input5.setAttribute("id","drelation" + empDepNo );  
  input6.setAttribute("id","depError" + empDepNo );
  
  input6.style.color = "red";

  cell0.appendChild( input0 );
  cell1.appendChild( input1 );
  cell2.appendChild( input2 );
  cell3.appendChild( input3 );
  cell4.appendChild( input4a );
  cell4.appendChild( input4b );
  cell4.appendChild( input4c );
  cell5.appendChild( input5 );
  cell6.appendChild( input6 );

  row.appendChild( cell0 );
  row.appendChild( cell1 );
  row.appendChild( cell2 );
  row.appendChild( cell3 );
  row.appendChild( cell4 );
  row.appendChild( cell5 );
  row.appendChild( cell6 );

  x.appendChild( row );

  empDepNo++;
}

function validateForm()
{
  var valid = 1;
  
  //  alert( "In validate form");
  
  var x = document.getElementById("fnameId");
  var cell = x.cells;  
  var fname = document.forms['addEmpForm']['firstname'].value;
  if( fname == null || fname == ""  )
    {
      var txt = "<label style=\"color:red\">Invalid first name</label>";
      cell[2].innerHTML = txt;
      valid = 0;
    }
  else
    {
      cell[2].innerHTML = "";
    }

  var x = document.getElementById("resAddId");
  var cell = x.cells;
  var resAddress = document.forms['addEmpForm']['resAddress'].value;
  if( resAddress == null || resAddress == "" )
    {
      cell[2].innerHTML = "<p style=\"color:red\">Please enter employee's residential address</p>";
      valid = 0;
    }
  else
    {
      cell[2].innerHTML = "";
    }

  var x = document.getElementById("permAddId");
  var cell = x.cells;
  var permAddress = document.forms['addEmpForm']['permAddress'].value;
  if( permAddress == null || permAddress == "" )
    {
      cell[2].innerHTML = "<p style=\"color:red\">Please enter employee's permanent address</p>";
      valid = 0;
    }
  else
    {
      cell[2].innerHTML = "";
    }

  var x = document.getElementById("mobNoId");
  var cell = x.cells;
  var phoneNumber = document.forms['addEmpForm']['mobNo'].value;
  var patt = /^(\d){10}$/;
  if( phoneNumber == null || phoneNumber == "" ) 
    {
      var txt = "<label style=\"color:red\">Invalid mobile number</label>";
      cell[2].innerHTML = txt;
      valid = 0;
    }
  else if( !patt.test( phoneNumber ) )
    {
      cell[2].innerHTML = "<p style=\"color:red;\">Invalid mobile number</p>";
      valid = 0;
    }
  else
    {
      cell[2].innerHTML = "";
    }

  var x = document.getElementById("emailId");
  var cell = x.cells;
  var email = document.forms['addEmpForm']['email'].value;
  var atpos;
  var dotpos;
  if( !( email == null || email == "" ) )
    {
      var atpos = email.indexOf("@");
      var dotpos = email.lastIndexOf(".");
    }

  if( email == null || email == "" )
    {
      cell[2].innerHTML = "<p style=\"color:red\">Please enter an email id</p>";
      valid = 0;
    }
  else if( atpos < 1 || dotpos < atpos+2 || dotpos+2 >= email.length )
    {
      cell[2].innerHTML = "<p style=\"color:red\">Invalid email id</p>";
      valid = 0;
    }
  else
    {
      cell[2].innerHTML = "";      
    }
  

  for( i = empQualStart; i < empQualNo; i++ )
    {
      qualIDTab = "qualIDTab";
      qualIDTab = qualIDTab.concat( i );
      var errorLabel = document.getElementById("qualError" + i );

      var empQual = "empQual";
      empQual = empQual.concat( i );

      var degree = document.getElementById( empQual ).selectedIndex;      
      if( degree != 0 )
	{
	  var qualYr = "qualYr";
	  qualYr = qualYr.concat( i );
	  var yr = document.getElementById( qualYr ).selectedIndex;
	  if( yr != 0 )
	    {
	      var institute = "institute";
	      institute = institute.concat( i );
	      var inst = document.forms['addEmpForm'][ institute ].value;
	      if( inst == null || inst == "" )
		{
		  errorLabel.innerHTML = "Please enter institute";
		  valid = 0;
		}
	      else 		
		{
		  var board = "board";
		  board = board.concat( i );
		  var boardName = document.forms['addEmpForm'][ board ].value;
		  if( boardName == "" || boardName == null )
		    {
		      errorLabel.innerHTML = "Invalid board/university";
		      valid = 0;
		    }
		  else
		    {
		      errorLabel.innerHTML = "";
		    }
		}
	    }
	  else
	    {
	      errorLabel.innerHTML = "Invalid year";
	      valid = 0;
	    }
	}

    }


  for( i = empAchStart; i < empAchNo; i++ )
    {
      var ach = document.forms["addEmpForm"]["empAch" + i].value;
      var yr = document.getElementById("empAchYrList" + i ).selectedIndex;
      var errorLabel = document.getElementById("achError" + i );

      if( ach == null || ach == "" )
	{
	  if( yr == 0 )
	    {
	      errorLabel.innerHTML = "";
	      continue;	      
	    }
	  else
	    {
	      errorLabel.innerHTML = "Please enter achievement";
	      valid = 0;
	    }
	}
      else if( yr == 0 )
	{
	  errorLabel.innerHTML = "Please choose an year for the entered achievement";
	  valid = 0;
	}
      else
	{
	  errorLabel.innerHTML = "";
	}
    }

  for( i = empDepStart; i < empDepNo; i++ )
    {
      var dFname = "dFname";
      var dFname = dFname.concat( i );

      var dMname = "dMname";
      var dMname = dMname.concat( i );

      var dLname = "dLname";
      var dLname = dLname.concat( i );
      
      var depFname = document.forms["addEmpForm"][dFname].value;
      var depMname = document.forms["addEmpForm"][dMname].value;
      var depLname = document.forms["addEmpForm"][dLname].value;

      var depError = "depError";
      depError = depError.concat( i );

      var errorLabel = document.getElementById( depError );

      var dmonthId = "dmonthId";
      dmonthId = dmonthId.concat( i );

      var ddayId = "ddayId";
      ddayId = ddayId.concat( i );

      var dyearId = "dyearId";
      dyearId = dyearId.concat( i );

      var depdobmonth = document.getElementById( dmonthId ).selectedIndex + 1;
      var depdobday = document.getElementById( ddayId ).selectedIndex + 1;
      var depdobyear = document.getElementById( dyearId ).selectedIndex + 1940;

      if( depFname == "" || depFname == null )
	{
	  if( depMname == "" || depMname == null )
	    {
	      if( depLname == "" || depLname == null )
		{
		  errorLabel.innerHTML = "";
		  continue; 
		}	      
	      else
		{
		  errorLabel.innerHTML = "Please enter first name";
		  valid = 0;
		}
	    }
	  else
	    {
	      errorLabel.innerHTML = "Please enter first name";
	      valid = 0;
	    }
	}
      else
	{
	  if( !isValidDate( depdobday, depdobmonth, depdobyear ) )	    
	    {
	      errorLabel.innerHTML = "Invalid date of birth";
	      valid = 0;
	    }
	  else
	    {
	      errorLabel.innerHTML = "";
	    }
	}
    }


  var x = document.getElementById("salaryId");
  var cell = x.cells;
  var salary = document.forms['addEmpForm']['salary'].value;
  var numericExpression = /^[0-9]+$/;
  if( salary == null || salary == "" )
    {
      cell[2].innerHTML = "<p style=\"color:red\">Please enter employee's salary</p>";
      valid = 0;
    }
  else if( !salary.match(numericExpression) ) 
    {
      cell[2].innerHTML = "<p style=\"color:red\">Please enter a valid salary amount</p>";
      valid = 0;
    }
  else
    {
      cell[2].innerHTML = "";
    }

  if( valid == 0 )
    return false;
  else    
    return true;
}

function isValidDate(Day,Mn,Yr)
{
  var DateVal = Mn + "/" + Day + "/" + Yr;
  var dt = new Date(DateVal);

  if(dt.getDate()!=Day)
    {
      return(false);
    }
  else if(dt.getMonth()!=Mn-1)
    {
      return(false);
    }
  else if(dt.getFullYear()!=Yr)
    {
      return(false);
    }
  
  return(true);
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
Edit Employee Profile!
</h1>

<br />

<p style="align:right">

<table style="float:right">
<tr>
<nav style="float:right" >
<td>

  <a href="viewEmployees.php" style="color:white">
View Employees Page |
</a>

</td>
<td>

<a style="color:white" 
<?php
  if( isset($_SESSION["sup"]) && $_SESSION["sup"] == 1 )
    {
      echo "href=\"supAdminProfile.php\"";
    }
else
  {
    echo "href=\"adminprofile.php\"";
  }

?>

>
  Profile Page  |


</a>
</td>
<td>
<a href="addPrerequisites.php" style="color:white">
   Edit Information &nbsp |
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

<label style="color:white;font-size:200%">
<u>
<strong>
Personal Information:
</strong>
</u>
</label>

<form onsubmit="return validateForm();" action="processEdit.php" name="addEmpForm" method="post" >
<table id="empPersonal">

<?php 

$id = "";
if( isset( $_GET["action"] ) )
  {
    $id = $_GET["action"];
    $_SESSION["ID"] = $id;
  }
else
  {
    header("Location: viewEmployees.php");
  }
?>


<?php
$_SESSION["preFname"] = "";
$_SESSION["preMname"] = "";
$_SESSION["preLname"] = "";
$dob = "";
$gender = "";
$_SESSION["preResAddress"] = "";
$_SESSION["prePermAddress"] = "";
$_SESSION["preMobNo"] = "";
$_SESSION["preEmail"] = "";
$_SESSION["preMstatus"] = "";
$_SESSION["langWCount"] = "";
$_SESSION["langSCount"] = "";
$_SESSION["qualCount"] = "";
$achCount = "";
$skillCount = "";
$depCount = "";

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
    $query = $retrieveName.$id."'";
    $res = mysql_query( $query );
    if( $res )
      {
	$row = mysql_fetch_array( $res );
	$preFname = $row["Fname"];
	$_SESSION["preMname"] = $row["Mname"];
	$_SESSION["preLname"] = $row["Lname"];

      }

    $query = $retrieveDOB.mysql_real_escape_string( $id )."'";
    $res = mysql_query( $query, $con );
    if( $res )
      {
	$row = mysql_fetch_array( $res );
	$dob = $row['DOB'];
	$year = ""; 
	$day = "";
	$month = "";

	$token = strtok( $dob, "-");
	if( $token != false )
	  {
	    $year = $token;
	  }
	$token = strtok("-");
	if( $token != false )
	  {
	    $month = $token;
	  }
	$token = strtok("-");
	if( $token != false )
	  {
	    $day = $token;
	  }
	
	$dob = $day."-".$month."-".$year;
      }

    $query = $retrieveGender.mysql_real_escape_string( $id )."'";
    $res = mysql_query( $query, $con );
    if( $res )
      {
	$row = mysql_fetch_array( $res );
	$gender = $row["Gender"];
      }

    $query = $retrieveResAddress.mysql_real_escape_string( $id )."'";
    $res = mysql_query( $query, $con );
    if( $res )
      {
	$row = mysql_fetch_array( $res );
	$_SESSION["preResAddress"] = $row['ResAddress'];
      }

    $query = $retrievePermAddress.mysql_real_escape_string( $id )."'";
    $res = mysql_query( $query, $con );
    if( $res )
      {
	$row = mysql_fetch_array( $res );
	$_SESSION["prePermAddress"] = $row['PermAddress'];
      }

    $query = $retrieveConNumber.mysql_real_escape_string( $id )."'";
    $res = mysql_query( $query, $con );
    if( $res )
      {
	$row = mysql_fetch_array( $res );
	$_SESSION["preMobNo"] = $row['MobileNumber'];
      }

    $query = $retrieveEmail.mysql_real_escape_string( $id )."'";
    $res = mysql_query( $query, $con );
    if( $res )
      {
	$row = mysql_fetch_array( $res );
	$_SESSION["preEmail"] = $row['Email'];
      }

    $query = $retrieveMStatus.mysql_real_escape_string( $id )."'";
    $res = mysql_query( $query, $con );
    if( $res )
      {
	$row = mysql_fetch_array( $res );
	$_SESSION["preMstatus"] = $row["MStatus"];
      }
    

  }

?>

<tr id="fnameId" >
<td>
First Name
</td>
<td>
<input type="text" name="firstname" value="<?php echo $preFname;?>" />
</td>
<td>
</td>
</tr>

<tr>
<td>
Middle Name
</td>
<td>
<input type="text" name="middlename" value="<?php echo $_SESSION["preMname"]; ?>"/>
</td>
</tr>

<tr>
<td>
Last Name
</td>
<td>
<input type="text" name="lastname" value="<?php echo $_SESSION["preLname"]; ?>"/>
</td>
</tr>

<tr id="dobIdTab">
<td>
Date of Birth
</td>

<td>
<?php
  echo $dob;
?>

</td>

<td>
</td>
</tr>

<tr>
<td>
Gender
</td>
<td>
<?php
echo $gender;
?>

</td>
</tr>

<tr id="resAddId" >
<td>
Residential Address
</td>
<td>
<textarea name="resAddress" rows="5" cols="30">
<?php echo $_SESSION["preResAddress"]; ?>
</textarea>
</td>
<td>
</td>
</tr>

<tr id="permAddId" >
<td>
Permanent Address
</td>
<td>
<textarea name="permAddress" rows="5" cols="30" >
<?php echo $_SESSION["prePermAddress"]; ?>
</textarea>
<td>
</td>
</td>
</tr>

<tr id="mobNoId" >
<td>
Mobile Number
</td>
<td>
<input type="number" name="mobNo" value="<?php echo $_SESSION["preMobNo"]; ?>"/>
</td>
<td>
</td>
</tr>

<tr id="emailId">
<td>
E-mail ID
</td>
<td>
<input type="text" name="email" value="<?php echo $_SESSION["preEmail"]?>"/>
</td>
<td>
</td>
</tr>

<tr>
<td>
Marital Status
</td>
<td>
  <?php echo $_SESSION["preMstatus"]; ?>
</td>
<td>
<select name="mStatus">
<option>
...
</option>  
<option>
Unmarried
</option>  
<option>
Married
</option>  
</select>
</td>
</tr>

<tr id="empLangWRow">
<td>
  Languages Known (Written)
</td>
<td>
<?php
$query = $retrieveAllLangW.mysql_real_escape_string( $id )."'";
//echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"query: ".$query."\");}</script>";
$res = mysql_query( $query, $con );
$i = 1;
if( $res )
  {
    while( $row = mysql_fetch_array( $res ) )
      {
	//echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"in while loop \");}</script>";
	$query = $retrieveLangNameByID.$row["LangID"]."'";
	$res2 = mysql_query( $query );
	
	if( $res2 )
	  {
	    //echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"row: ".$row."\");}</script>";
	    $row2 = mysql_fetch_array( $res2 );
	    if( $i == 1 )
	      {
		echo $row2["LangName"];
	      }
	    else
	      {
		echo ", ";
		echo $row2["LangName"];
	      }
	    $i++;
	  }
      }
  }
else
  {
    die ("<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Error in retrieving marital status : ".mysql_error()."\");}</script>");
  }
$_SESSION["langWCount"] = $i;
echo "<script type=\"text/javascript\"> var empLangWNo = ".$i.";</script>";
echo "<script type=\"text/javascript\"> var empLangWStart = ".$i.";</script>";

?>
</td>


<td>
<select id="empLangID" name="empLangW<?php echo $_SESSION["langWCount"]; ?>" >

<?php

  $query = $retrieveLangName;
$res = mysql_query( $query );
if( $res )
  {
    echo "<option selected=\"selected\">...</option>";
    while( $row = mysql_fetch_array( $res ) )
      {
	echo "<option>".$row["LangName"]."</option>";
      }
  }
?>

</select>
</td>
<td>
<input type="button" name="addLangW" onclick="addMoreLangW();" value="Add More Languages" />
</td>
</tr>

<tr>
<td>
  Languages Known (Spoken)
</td>
<td>
<?php
$query = $retrieveAllLangS.mysql_real_escape_string( $id )."'";
//echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"query: ".$query."\");}</script>";
$i = 1;
$res = mysql_query( $query, $con );
if( $res )
  {
    while( $row = mysql_fetch_array( $res ) )
      {
	//echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"in while loop \");}</script>";
	$query = $retrieveLangNameByID.$row["LangID"]."'";
	$res2 = mysql_query( $query );
	
	if( $res2 )
	  {
	    //echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"row: ".$row."\");}</script>";
	    $row2 = mysql_fetch_array( $res2 );
	    if( $i == 1 )
	      {
		echo $row2["LangName"];
	      }
	    else
	      {
		echo ", ";
		echo $row2["LangName"];
	      }
	    $i++;
	  }
      }
  }
else
  {
    die ("<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Error in retrieving marital status : ".mysql_error()."\");}</script>");
  }
$_SESSION["langSCount"] = $i;
echo "<script type=\"text/javascript\"> empLangSNo = ".$i.";</script>";
echo "<script type=\"text/javascript\"> var empLangSStart = ".$i.";</script>";


?>
</td>

<td>
<select name="empLangS <?php echo $_SESSION["langSCount"]; ?>">
<?php

  $query = $retrieveLangName;
$res = mysql_query( $query );
if( $res )
  {
    echo "<option selected=\"selected\">...</option>";
    while( $row = mysql_fetch_array( $res ) )
      {
	echo "<option>".$row["LangName"]."</option>";
      }
  }

?>
</select>
</td>
<td>
<input type="button" name="addLangS" onclick="addMoreLangS();" value="Add More Languages" />
</td>
</tr>

<tr>
<td>
Having passport
</td>
<td>
<input type="checkbox" id="empPassport" name="empPassport" 
<?php
$query = $retrievePassport.mysql_real_escape_string( $id )."'";
$res = mysql_query( $query );
$_SESSION["prePassport"] = "OFF";
if( $res )
  {
    $row = mysql_fetch_array( $res );
    if( $row["Passport"] == 1 )
      {
	$_SESSION["prePassport"] = "ON";
	echo "checked=\"checked\"";
      }
  }
?>
/>
</td>
</tr>

<tr>
<td>
Having Driving License
</td>
<td>
<input type="checkbox" id="empDrivingL" name="empDrivingL"

<?php
  $_SESSION["preDl"] = "OFF";
$query = $retrieveDrivingLicense.mysql_real_escape_string( $id )."'";
$res = mysql_query( $query );
if( $res )
  {
    $row = mysql_fetch_array( $res );
    if( $row["DrivingLicense"] == 1 )
      {
	$_SESSION["preDl"] = "ON";
	echo "checked=\"checked\"";
      }
  }
?>
 />
</td>
</tr>

</table>

<br />

<label style="color:white;font-size:150%">
<u>
<strong>
  Educational Qualification:
</strong>
</u>
</label>

<table id="empQualTab" cellpadding="10">

<tr id="qualIDTab">

<td>
<strong>
S No.
</strong>
</td>

<td>
<strong>
  Degree Name
</strong>
</td>

<td>
<strong>
Year
</strong>
</td>

<td>
<strong>
Institute Attended
</strong>
</td>

<td>
<strong>
Board/University
</strong>
</td>

<td>
</td>

</tr>

<?php


  $query = $retrieveAllDegreeByID.mysql_real_escape_string( $id )."'";
//echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"query : ".$query."\");}</script>";
$res = mysql_query( $query );
$k = 1;
    
while( $row = mysql_fetch_array( $res ) )
  {
    echo "<tr><td>".$k."</td><td>";
    $query2 = $retrieveQualDescByID.$row["QualID"]."'";
    //echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"query2 : ".$query2."\");}</script>";
    $res2 = mysql_query( $query2 );
    if( $res2 )
      {
	$row2 = mysql_fetch_array( $res2 );
	echo $row2["QualDesc"]."</td><td>".$row["Yr"]."</td><td>".$row["Institute"]."</td><td>".$row["Board"]."</td></tr>";
      }
    $k++;
  }

$_SESSION["empQualCount"] = $k;
$qualsNo = "";

for( $qualsNo = $k; $qualsNo <= $k + 5 ; $qualsNo++ )
  {
    echo "<tr id=\"qualIDTab".$qualsNo."\" ><td>".$qualsNo."</td><td>";
    
    $query = $retrieveQualDesc;
    $res = mysql_query( $query );
    echo "<select id=\"empQual".$qualsNo."\" name=\"qual".$qualsNo."\">";
    
    if( $res )
      {
	$i = 0;
	echo "<option selected=\"selected\">...</option>";
	while( $row = mysql_fetch_array( $res ) )
	  {
	    echo "<option>".$row["QualDesc"]."</option>";
	    $i++;
	  }
      }
    echo "</select>";
    echo "</td><td><select id=\"qualYr".$qualsNo."\" name=\"passYr".$qualsNo."\">";
    echo "<option selected=\"selected\">...</option>";
    for( $i = 1940; $i <= 2050; $i++ )
      {
	echo "<option>".$i."</option>";
      }
    echo "</select></td>";
    echo "<td>";
    echo "<textarea rows=\"5\" cols=\"35\" name=\"institute".$qualsNo."\"></textarea></td>";
    echo "<td>";
    echo "<textarea rows=\"5\" cols=\"35\" name=\"board".$qualsNo."\"></textarea>";
    echo "</td><td><label style=\"color:red\" id=\"qualError".$qualsNo."\"></label></td></tr>";
  }

echo "<script type=\"text/javascript\"> empQualNo = ".$qualsNo.";</script>";
echo "<script type=\"text/javascript\"> empQualStart = ".$qualsNo.";</script>";

?>

</table>
<input type="button" value="Add More Qualifications" name="addMoreQual" onclick="addMoreQuals();" />

<br />
<br />

<label style="font-size:150%;color:white;">
<u>
<strong>
Achievements
</strong>
</u>
</label>

<table id="empAchTab" cellpadding="10">
<tr>

<td>
Serial No
</td>

<td >
Achievement
</td>

<td style="color:black">
Redundant column
</td>

<td style="color:black">
Redundant column
</td>

<td>
Year
</td>

<?php

  $query = $retrieveAchsByID.mysql_real_escape_string( $id )."'";
//echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"query : ".$query."\");}</script>";
$res = mysql_query( $query );
$k = 1;
    
while( $row = mysql_fetch_array( $res ) )
  {
    echo "<tr><td>".$row["AchievementID"]."</td><td colspan=\"3\">".$row["Achievement"]."</td><td>".$row["Yr"]."</td></tr>";
    $k++;
  }

$_SESSION["empAchCount"] = $k;

$i = "";
for( $i = $k; $i <= $k + 5; $i++ )
  {
    echo "<tr><td>".$i."</td>";
    echo "<td colspan=\"3\">";
    echo "<input style=\"width:100%\" type=\"text\" name=\"empAch".$i."\"/></td>";
    echo "<td><select id=\"empAchYrList".$i."\" name=\"empAchYr".$i."\">";
    echo "<option selected=\"selected\">...</option>";
    for( $yr = 1940; $yr <= 2050; $yr++ )
      {
	echo "<option>".$yr."</option>";
      }
    echo "</select></td><td><label id=\"achError".$i."\" style=\"color:red\"></label></td></tr>";      
  }
echo "<script type=\"text/javascript\"> empAchNo = ".$i.";</script>";
echo "<script type=\"text/javascript\"> empAchStart = ".$i.";</script>";
?>

</table>
<br />
<input type="button" name="addMoreAch" value="Add More Achievements" onclick="addMoreAchv()" />

<br />
<br />

<label style="font-size:150%;color:white;">
<u>
<strong>
Skills 
</strong>
</u>
</label>

<table id="empSkillTab" cellpadding="10">

<tr>

<td>
Serial No.
</td>

<td>
Skill
</td>

<td style="color:black">
Redundant Column
</td>

<td style="color:black">
Redundant Column
</td>

<?php

  $query = $retrieveSkillFromSkillSet.mysql_real_escape_string( $id )."'";
//echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"query : ".$query."\");}</script>";
$res = mysql_query( $query );
$k = 1;
    
while( $row = mysql_fetch_array( $res ) )
  {
    echo "<tr><td>".$k."</td><td>";
    $query2 = $retrieveSkillDescByID.$row["SkillID"]."'";
    //echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"query2 : ".$query2."\");}</script>";
    $res2 = mysql_query( $query2 );
    if( $res2 )
      {
	$row2 = mysql_fetch_array( $res2 );
	echo $row2["SkillDesc"]."</td></tr>";
      }
    $k++;
  }
$_SESSION["empSkillCount"] = $k;

  for( $i = $k; $i <= $k + 5; $i++ )
    {
      echo "<tr><td>".$i."</td><td>";
      echo "<select id=\"empSkillList\" name=\"empSkill".$i."\">";
      echo "<option>...</option>";
      
      $query = $retrieveSkillDesc;
      $res = mysql_query( $query );
      if( $res )
	{
	  while( $row = mysql_fetch_array( $res ) )
	    {
	      echo "<option>".$row["SkillDesc"]."</option>";
	    }
	}
      echo "</select></td><td><label style=\"color:red\" id=\"skillError".$i."\"></label></td></tr>";
    }
echo "<script type=\"text/javascript\"> empSkillNo = ".$i.";</script>";
echo "<script type=\"text/javascript\"> empSkillStart = ".$i.";</script>";
?>

</table>

<input type="button" onclick="addMoreSkills();" name="addEmpSkill" value="Add more skills" />

<br />
<br />

<label style="font-size:150%;color:white;">
<u>
<strong>
Dependents Information
</strong>
</u>
</label>

<table id="empDepTab" cellpadding="10">

<tr>

<td>
<strong>
S. No
</strong>
</td>

<td>
<strong>
First Name
</strong>
</td>
<td>
<strong>
Middle Name
</strong>
</td>

<td>
<strong>
Last Name
</strong>
</td>

<td>
<strong>
Date of Birth
</strong>
</td>

<td>
<strong>
Relation
</strong>
</td>

</tr>

<?php
$query = $retrieveDependents.mysql_real_escape_string( $id )."'";
$res = mysql_query( $query );
$k = 1;
if( $res )
  {
    while( $row = mysql_fetch_array( $res ) )
      {	
	$name = $row['Fname']." ".$row['Mname']." ".$row['Lname'];

	$dob = $row['DOB'];
	$year = ""; 
	$day = "";
	$month = "";

	$token = strtok( $dob, "-");
	if( $token != false )
	  {
	    $year = $token;
	  }
	$token = strtok("-");
	if( $token != false )
	  {
	    $month = $token;
	  }
	$token = strtok("-");
	if( $token != false )
	  {
	    $day = $token;
	  }

	$dob = $day."-".$month."-".$year;
	echo "<tr><td>".$row["DependentID"]."</td><td>".$row["Fname"]."</td><td>".$row["Mname"]."</td><td>".$row["Lname"]."</td><td>".$dob."</td><td>".$row["Relation"]."</td></tr>";    
	$k++;
      }
  }

$_SESSION["empDepCount"] = $k;

  for( $dep = $k; $dep <= $k + 5; $dep++ )
    {
      echo "<tr id=\"depIdTab".$dep."\"><td>".$dep."</td><td><input type=\"text\" name=\"dFname".$dep."\"/><td><input type=\"text\" name=\"dMname".$dep."\"/></td><td><input type=\"text\" name=\"dLname".$dep."\"/></td>";

      echo "<td><select id=\"dmonthId".$dep."\" name=\"dmonth".$dep."\">";	

      $months = array("January","February","March","April","May","June","July","August","September","October","November","December");

      for( $i = 1; $i < 13; $i++ )
	{
	  echo "<option value=\"".$i."\">".$months[$i-1]."</option>";
	}

      echo "</select><select id=\"ddayId".$dep."\" name=\"dday".$dep."\">";

      for( $i = 1; $i <= 31; $i++ )
	{
	  echo "<option>".$i."</option>";
	}

      echo "</select><select id=\"dyearId".$dep."\" name=\"dyear".$dep."\">";
      for( $i = 1940; $i < 2050; $i++ )
	{
	  echo "<option>".$i."</option>";
	}

      echo "</select><td>";
      echo "<select id=\"drelation\" name=\"drelation".$dep."\">";
      $relations = array("Mother","Father","Son","Daughter","Brother", "Sister", "Wife","Husband","Grandfather","Grandmother","Grandson","Grand daughter","Uncle","Aunt");
      
      for( $i = 0; $i < count( $relations ); $i++ )
	{
	  echo "<option>".$relations[ $i ]."</option>";
	}
      echo "</select></td><td><label style=\"color:red\" id=\"depError".$dep."\"></label></td></tr>";
    }
echo "<script type=\"text/javascript\"> empDepNo = ".$dep.";</script>";
echo "<script type=\"text/javascript\"> empDepStart = ".$k.";</script>";
?>

</table>

<input type="button" onclick="addMoreDep()" value="Add More Dependents" name="addMoreD" />

<br />
<br/>
<hr/>

<h2>
<u>
Work Details
</u>
</h2>

<table>

<tr id="empIdTab">
<td>
<label>
Employee ID
</label>
</td>
<td>
  <?php echo $id; ?>
</td>
<td>
</td>
</tr>

<tr>
<td>
<label>
Department
</label>
</td>
<td>
<?php
$_SESSION["preDept"] = "";
$query = $retrieveDept.mysql_real_escape_string( $id )."')";
if( $res = mysql_query( $query, $con ) )
  {
    $row = mysql_fetch_array( $res );
    $_SESSION["preDept"] = $row["DeptName"];
    echo $row["DeptName"];
  }
?>
</td>
<td>
<select name="empDep">
<?php
  $query = $retrieveDeptName;
$res = mysql_query( $query );
if( $res )
  {
    while( $row = mysql_fetch_array( $res ) )
      {
	echo "<option>".$row["DeptName"]."</option>";
      }
  }
?>

</select>

</td>
</tr>

<tr>
<td>
<label>
Manager
</label>
</td>
<td>
<input type="checkbox" id="manager" name="manager"

<?php
  $query = $retrieveDeptManaged.$id."'";
$manageDeptID = "";
$manageDept = "";
if( $res = mysql_query( $query ) )
  {
    if( $row = mysql_fetch_array( $res ) )
      {
	if( $row["DeptID"] != "" )
	  {
	    $_SESSION["preManager" ] ="ON";
	    
	    $manageDeptID = $row["DeptID"];
	    echo "checked=\"checked\"/>";
	    $query = $retrieveDeptNameByID.$manageDeptID."'";
	    if( $res = mysql_query( $query ) )
	      {
		$row = mysql_fetch_array( $res );
		if( $row["DeptName"] != "" )
		  {
		    $manageDept = $row["DeptName"];
		  }
	      }
	    
	  }
	else
	  {
	    $_SESSION["preManager"] = "OFF";
	    echo "/>";
	  }
      }
  }

?>

</td>
<td>
<label>
In Department:
</label>

<select name="managerDept">

<?php

  $query = $retrieveDeptName;
$res = mysql_query( $query );
if( $res )
  {
    while( $row = mysql_fetch_array( $res ) )
      {
	if( $row["DeptName"] == $manageDept )
	  {
	    echo "<option selected=\"selected\">".$row["DeptName"]."</option>";		
	  }
	else
	  {
	    echo "<option>".$row["DeptName"]."</option>";		
	  }
      }
  }

?>


</select>

</td>
</tr>

<tr>
<td>
Position
</td>
<td>
<?php
$_SESSION["prePos"] = "";
$query = $retrievePos.mysql_real_escape_string( $id )."')";
if( $res = mysql_query( $query, $con ) )
  {
    $row = mysql_fetch_array( $res );
    $_SESSION["prePos"] = $row["PosDesc"];
    echo $row["PosDesc"];
  }
?>
</td>

<td>
<select name="empPos">

<?php

  $query = $retrievePosDesc;
$res = mysql_query( $query );
if( $res )
  {
    while( $row = mysql_fetch_array( $res ) )
      {
	echo "<option>".$row["PosDesc"]."</option>";		
      }
  }
?>

<tr>
<td>
Office ID / Location
</td>

<?php
$_SESSION["preOffId"] = "";
$query = $retrieveOfficeID.mysql_real_escape_string( $id )."'";
//echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"query : ".$query."\");}</script>";
$res = mysql_query( $query );
if( $res )
  {
    $row = mysql_fetch_array( $res );
    //echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"row[OfficeId] : ".$row["OfficeID"]."\");}</script>";    
    $query2 = $retrieveOffLocID.$row["OfficeID"]."'";
    //echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"query2 : ".$query2."\");}</script>";
    $res2 = mysql_query( $query2 );
    if( $res2 )
      {
	$row2 = mysql_fetch_array( $res2 );
	$preOffID = $row["OfficeID"];
	echo "<td>".$row["OfficeID"]." / ".$row2["Location"]."</td>";
      }
  }
?>



<td>
<select name="empOffice">

<?php

  $query = $retrieveOffIDLoc;
$res = mysql_query( $query );
if( $res )
  {
    while( $row = mysql_fetch_array( $res ) )
      {
	echo "<option>".$row["OfficeID"]." / ".$row["Location"]."</option>";		
      }    
  }
?>

</select>
</td>
</tr>

<tr>
<td>
Supervisor ID / Name
</td>
<td>
<input type="checkbox" id="haveSupervisor" name="haveSupervisor" 
<?php
$query = $retrieveSupervisor.mysql_real_escape_string( $id )."')";
if( $res = mysql_query( $query, $con ) )
  {
    $row = mysql_fetch_array( $res );
    if( $row["Fname"] != "" )
    {
      echo "checked=\"checked\"/>";
      echo "</td>td>".$name."</td>";
    }
    else
      {
	echo "/></td>";
      }
  }
?>

<td>
<select name="supervisor">

<?php
  $query = $retrieveEmpIDNames;
$res = mysql_query( $query );
if( $res )
  {
    while( $row = mysql_fetch_array( $res ) )
      {
	$name = $row["Fname"]." ".$row["Mname"]." ".$row["Lname"];
	echo "<option>".$row["EmployeeID"]." / ".$name."</option>";
      }
  }
?>

</select>
</td>
</tr>

<tr id="salaryId">
<td>
Salary
</td>
<td>
<?php
  $_SESSION["preSalary"] = "";
$_SESSION["preLeaveCount"] = "";
$query = $retrieveSalary.mysql_real_escape_string( $id )."'";
if( $res = mysql_query( $query, $con ) )
  {
    $row = mysql_fetch_array( $res );
    $_SESSION["preSalary"] = $row["Salary"];
  }
$query = $retrieveLeaves.mysql_real_escape_string( $id )."'";
if( $res = mysql_query( $query, $con ) )
  {
    $row = mysql_fetch_array( $res );
    $_SESSION["preLeaveCount"] = $row["Leaves"];
  }

?>
<input type="text" name="salary" value="<?php echo $_SESSION["preSalary"]; ?>" />
</td>
<td>
</td>
</tr>

<tr>
<td>
Leaves Count
</td>
<td>
<input type="text" name="lcount" value="<?php echo $_SESSION["preLeaveCount"]; ?> " />
</td>
</tr>

<tr>
<td>
Promotions Count
</td>
<td>
<?php
  $_SESSION["prePromCount"] = "";
$query = $retrievePromotions.mysql_real_escape_string( $id )."'";
if( $res = mysql_query( $query, $con ) )
  {
    $row = mysql_fetch_array( $res );
    $_SESSION["prePromCount"] = $row["Promotions"];
    echo $row["Promotions"];
  }
?>
</td>
<td>
<select name="promCount"> 

<?php
  for( $i = 0; $i <= 10; $i++ )
    {
      echo "<option>".$i."</option>";
    }

?>

</select>
</td>
</tr>

<tr>
<td>
Date of Hiring
</td>
<td>
<?php
$query = $retrieveHireDate.mysql_real_escape_string( $id )."'";
if( $res = mysql_query( $query, $con ) )
  {
    $row = mysql_fetch_array( $res );
    $hd = $row['HireDate'];
    $year = ""; 
    $day = "";
    $month = "";

    $token = strtok( $hd, "-");
    if( $token != false )
      {
	$year = $token;
      }
    $token = strtok("-");
    if( $token != false )
      {
	$month = $token;
      }
    $token = strtok("-");
    if( $token != false )
      {
	$day = $token;
      }

    $hd = $day."-".$month."-".$year;
    echo $hd;
  }
?>


</td>


<tr>
<td>
<strong>
Access rights
</strong>
</td>
<?php
$query = $retrieveAccessByID.$id."'";
$preAccess = 0;
if( $res = mysql_query( $query ) )
  {
    $row = mysql_fetch_array( $res );
    if( $row["Access"] == 1 )
      {
	$preAccess = 1;
      }
  }
?>
<td>
<input type="checkbox" id="accessGiven" name="accessGiven" title="check this, if you want to give write access to the employee" 
<?php
  if( $preAccess == 1 )
    echo "checked=\"checked\"";
?>
/>
</td>
</table>

</br>

<hr>

<input type="hidden" name="action2" />
<input type="submit" name="submit" value="Save changes" style="align:center" />
</form>

<br>
<br>
<br>

</body>
</html>
