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

<head>

<script type="text/javascript">

langS = 12;
langW = 11;
empLangWNo = 2;

function addMoreLangW()
{
  var ddlist = document.getElementById("empLangID");
  var row = document.getElementById('empPersonal').insertRow(langW);

  //  var row = document.createElement("tr");
  
  var cell1 = document.createElement("td");
  var cell2 = document.createElement("td");

  var sel = ddlist.cloneNode( true );
  sel.setAttribute("name","empLangW" + empLangWNo );
  
  cell2.appendChild( sel );

  row.appendChild( cell1 );
  row.appendChild( cell2 );

  langW++;
  langS++;
  empLangWNo++;  
}

empLangSNo = 2;

function addMoreLangS()
{
  var ddlist = document.getElementById("empLangID");
  var row = document.getElementById('empPersonal').insertRow(langS);

  var cell1 = document.createElement("td");
  var cell2 = document.createElement("td");

  var sel = ddlist.cloneNode( true );
  sel.setAttribute("name","empLangS" + empLangSNo );
  
  cell2.appendChild( sel );

  row.appendChild( cell1 );
  row.appendChild( cell2 );

  langS++;
  empLangSNo++;  
}

empQualNo = 6;

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

empAchNo = 6;

function addMoreAchv()
{
  var x = document.getElementById("empAchTab");

  var row = document.createElement("tr");

  var cell0 = document.createElement("td");
  var cell1 = document.createElement("td");
  var cell2 = document.createElement("td");
  var cell3 = document.createElement("td");

  cell1.setAttribute("colspan","3");

  var syear = document.getElementById("empAchYrList1");
  
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

empSkillNo = 6;

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

empDepNo = 6;

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

  var smonth = document.getElementById("dmonthId1");
  var sday = document.getElementById("ddayId1");
  var syear = document.getElementById("dyearId1");
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

  var x = document.getElementById("dobIdTab");
  var cell = x.cells;
  var dobmonth = document.getElementById('dobmonthId').selectedIndex + 1;
  var dobday = document.getElementById("dobdayId").selectedIndex + 1;
  var dobyear = document.getElementById("dobyearId").selectedIndex + 1940;
  if( !isValidDate( dobday, dobmonth,dobyear ) )
    {
      cell[2].innerHTML = "<p style=\"color:red\">Invalid date of birth</p>";
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
  

  for( i = 1; i < empQualNo; i++ )
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


  for( i = 1; i < empAchNo; i++ )
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

  for( i = 1; i < empDepNo; i++ )
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

  var x = document.getElementById("empIdTab");
  var cell = x.cells;
  var empid = document.forms['addEmpForm']['empid'].value;
  var numericExpression = /^[0-9]+$/;
  if( empid == null || empid == "" )
    {
      cell[2].innerHTML = "<p style=\"color:red\">Please enter employee id</p>";
      valid = 0;
    }
  else if( !empid.match(numericExpression) ) 
    {
      cell[2].innerHTML = "<p style=\"color:red\">Invalid employee id</p>";
      valid = 0;
    }
  else
    {
      cell[2].innerHTML = "";
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

  //  alert("valid = " + valid );
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
Add New Employee!
</h1>

<br />

<p style="align:right">

<table style="float:right">
<tr>
<nav style="float:right" >
<td>
<a href="adminprofile.php" style="color:white">
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

<form onsubmit="return validateForm();" action="addEmployee.php" name="addEmpForm" method="post" >
<table id="empPersonal">

<tr id="fnameId" >
<td>
First Name
</td>
<td>
<input type="text" name="firstname" />
</td>
<td>
</td>
</tr>

<tr>
<td>
Middle Name
</td>
<td>
<input type="text" name="middlename" />
</td>
</tr>

<tr>
<td>
Last Name
</td>
<td>
<input type="text" name="lastname" />
</td>
</tr>

<tr id="dobIdTab">
<td>
Date of Birth
</td>

<td>
<select id="dobmonthId" name="dobmonth">	
<?php

  $months = array("January","February","March","April","May","June","July","August","September","October","November","December");

for( $i = 1; $i < 13; $i++ )
{
  echo "<option value=\"".$i."\">".$months[$i-1];
}

?>

</select>
<select id="dobdayId" name="dobday">	
<?php
for( $i = 1; $i < 32; $i++ )
{
  echo "<option value=\"".$i."\">".$i;
}

?>

</select>
<select id="dobyearId" name="dobyear">
<?php
for( $i = 1940; $i < 2050; $i++ )
{
  echo "<option value=\"".$i."\">".$i;
}

?>

</select>

</td>
<td>
</td>
</tr>

<tr>
<td>
Gender
</td>
<td>

<select name="gender">
<option>
Female
</option>
<option>
Male
</option>  
</select>
</td>
</tr>

<tr id="resAddId" >
<td>
Residential Address
</td>
<td>
<textarea name="resAddress" rows="5" cols="30">
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
<textarea name="permAddress" rows="5" cols="30">
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
<input type="number" name="mobNo" />
</td>
<td>
</td>
</tr>

<tr id="emailId">
<td>
E-mail ID
</td>
<td>
<input type="text" name="email" />
</td>
<td>
</td>
</tr>

<tr>
<td>
Marital Status
</td>
<td>
<select name="mStatus">
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
<select id="empLangID" name="empLangW1">

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
<select name="empLangS1">
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
<input type="checkbox" id="empPassport" name="empPassport" />
</td>
</tr>

<tr>
<td>
Having Driving License
</td>
<td>
<input type="checkbox" id="empDrivingL" name="empDrivingL" />
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

  for( $qualsNo = 1; $qualsNo <=5 ; $qualsNo++ )
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

  for( $i = 1; $i <= 5; $i++ )
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

  for( $i = 1; $i <= 5; $i++ )
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
	      
    }
echo "</select></td><td><label style=\"color:red\" id=\"skillError".$i."\"></label></td></tr>";
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

  for( $dep = 1; $dep <= 5; $dep++ )
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
<input type="text" name="empid" />
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
<input type="checkbox" id="manager" name="manager"/> 
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
	echo "<option>".$row["DeptName"]."</option>";		
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
<input type="checkbox" id="haveSupervisor" name="haveSupervisor" />
</td>
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
<input type="text" name="salary" />
</td>
<td>
</td>
</tr>

<tr>
<td>
Leaves Count
</td>
<td>
<input type="text" name="lcount" />
</td>
</tr>

<tr>
<td>
Promotions Count
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

<select name="dhmonth">	

<?php

  $months = array("January","February","March","April","May","June","July","August","September","October","November","December");
for( $i = 1; $i < 13; $i++ )
{
  echo "<option value=\"".$i."\">".$months[$i-1];
}

?>

</select>
<select name="dhday">	

<?php
for( $i = 1; $i <= 31; $i++ )
{
  echo "<option value=\"".$i."\">".$i;
}

?>

</select>
<select name="dhyear">

<?php
for( $i = 1940; $i <= 2050; $i++ )
{
  echo "<option value=\"".$i."\">".$i;
}

?>

</select>

</td>

<tr>
<td>
Grant write access
</td>
<td>
<input type="checkbox" id="accessGiven" name="accessGiven" title="check this, if you want to give write access to the employee" />
</td>
</table>

</br>

<hr>

<input type="hidden" name="action" />
<input type="submit" name="submit" value="Add Employee" style="align:center" />
</form>

<br>
<br>
<br>

</body>
</html>


<?php
  include("config.php");
if( isset($_POST["action"] ) )
  {
    //echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Action set.\");}</script>";

    $fname = $_POST["firstname"];
    //    echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"fname :".$fname."\");}</script>";

    $mname = $_POST["middlename"];
    //    echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"mname :".$mname."\");}</script>";

    $lname = $_POST["lastname"];
    //    //echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"lname :".$lname."\");}</script>";

    $dobmonth = $_POST["dobmonth"];
    //echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"dobmonth :".$dobmonth."\");}</script>";

    $dobday = $_POST["dobday"];
    //echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"dobday :".$dobday."\");}</script>";

    $dobyear = $_POST["dobyear"];
    //echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"dobyear :".$dobyear."\");}</script>";

    $dob = $dobyear."-".$dobmonth."-".$dobday;
    //echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"dob :".$dob."\");}</script>";

    $gender = $_POST["gender"];
    //echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"gender :".$gender."\");}</script>";

    $resAddress = $_POST["resAddress"];
    //echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"resAddress :".$resAddress."\");}</script>";

    $permAddress = $_POST["permAddress"];
    //echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"permAddress :".$permAddress."\");}</script>";
    
    $mobNo = $_POST["mobNo"];
    //echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"mobNo :".$mobNo."\");}</script>";

    $email = $_POST["email"];
    //echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"email :".$email."\");}</script>";
    
    $mstatus = $_POST["mStatus"];
    //echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"mstatus :".$mstatus."\");}</script>";

    //echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"fname :".$fname."\nmname : ".$mname."\nlname : ".$lname."\ndobmonth:".$dobmonth."\ndobday:".$dobday."\ndobyear:".$dobyear."\ndob :".$dob."\n\");}</script>";

    $langW = array();
    $langWLen = 0;

    for( $i = 0, $j = 1; $i < count( $_POST ); $i++, $j++ )
      {	
	$key = "empLangW".$j;
	if( array_key_exists( $key, $_POST ) )
	  {
	    if( $_POST[ $key ] != "..." )
	      {	      
		//		$lang = $_POST[ $key ];
		$langW[ $langWLen ] = $_POST[ $key ];
		$langWLen++;
		//echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\" POST[:".$key."] = ".$_POST[ $key ]."\");}</script>";
		//echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\" :".$langW[ $langWLen - 1 ]."\");}</script>";
	      }	    
	  }	
      }

    $langS = array();
    $langSLen = 0;

    for( $i = 0, $j = 1; $i < count( $_POST ); $i++, $j++ )
      {
	$key = "empLangS".$j;
	if( array_key_exists( $key, $_POST ) )
	  {
	    if( $_POST[ $key ] != "..." )
	      {	      
		$langS[ $langSLen ] = $_POST[ $key ];
		$langSLen++;
		//echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\" langS[".($langSLen - 1 )."] = ".$langS[ $langSLen - 1 ]."\");}</script>";
	      }	    
	  }	
      }

    $passport = 0;
    if( isset( $_POST["empPassport"] ) )
      {
	$pass = $_POST["empPassport"];
	$pass = strtoupper( $pass );
	if( $pass == "ON" )
	  {
	    $passport = 1;
	  }
      }

    $dlicense = 0;
    if( isset( $_POST["empDrivingL"] ))
      {
	$dl = $_POST["empDrivingL"];
	$dl = strtoupper( $dl );
	if( $dl == "ON" )
	  {
	    $dlicense = 1;
	  }
      }

    $quals = array();
    $qualYr = array();
    $institute = array();
    $board = array();
    $qualLen = 0;

    for( $i = 0, $j = 1; $i < count( $_POST ); $i++, $j++ )
      {
	$key = "qual".$j;
	if( array_key_exists( $key, $_POST ) )
	  {
	    if( $_POST[ $key ] != "..." )
	      {	      
		$quals[ $qualLen ] = $_POST[ $key ];

		$key = "passYr".$j;
		//echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"key = ".$key."\");}</script>";
		if( array_key_exists( $key, $_POST ) )
		  {
		    //echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"POST[ ".$key." ] = ".$_POST[ $key ]."\");}</script>";
		    if( $_POST[ $key ] != "..." )
		      {
			$qualYr[ $qualLen ] = $_POST[ $key ];
		      }
		  }


		$key = "institute".$j;
		if( array_key_exists( $key, $_POST ) )
		  {
		    if( $_POST[ $key ] != "" )
		      {
			$institute[ $qualLen ] = $_POST[ $key ];
		      }
		  }

		$key = "board".$j;
		if( array_key_exists( $key, $_POST ) )
		  {
		    if( $_POST[ $key ] != "" )
		      {
			$board[ $qualLen ] = $_POST[ $key ];
			$qualLen++;
		      }
		  }
	      }	    
	  }	
      }

    $achs = array();
    $achYr = array();
    $achLen = 0;

    for( $i = 0, $j = 1; $i < count( $_POST ); $i++, $j++ )
      {
	$key = "empAch".$j;
	if( array_key_exists( $key, $_POST ) )
	  {
	    if( $_POST[ $key ] != "" )
	      {	      
		$achs[ $achLen ] = $_POST[ $key ];
	      }	    
	  }	

	$key = "empAchYr".$j;
	if( array_key_exists( $key, $_POST ) )
	  {
	    if( $_POST[ $key ] != "..." )
	      {
		$achYr[ $achLen ] = $_POST[ $key ];
		$achLen++;
		//		echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"achs[ ".($achLen - 1)." ] = ".$achs[ $achLen - 1 ]."\");}</script>";
		//		echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"achYr[ ".( $achLen - 1)." ] = ".$achYr[ $achLen - 1 ]."\");}</script>";
	      }
	  }
      }

    $skill = array();
    $skillLen = 0;

    for( $i = 0, $j = 1; $i < count( $_POST ); $i++, $j++ )
      {	
	$key = "empSkill".$j;
	if( array_key_exists( $key, $_POST ) )
	  {
	    if( $_POST[ $key ] != "..." )
	      {	      
		$skill[ $skillLen ] = $_POST[ $key ];
		$skillLen++;
		//		echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"skill[ ".( $skillLen - 1)." ] = ".$skill[ $skillLen - 1 ]."\");}</script>";
	      }	    
	  }	
      }

    $dFname = array();
    $dMname = array();
    $dLname = array();
    $dDob = array();
    $dRelation = array();
    $depLen = 0;

    for( $i = 0, $j = 1; $i < count( $_POST ); $i++, $j++ )
      {
	$key = "dFname".$j;
	if( array_key_exists( $key, $_POST ) )
	  {
	    if( $_POST[ $key ] != "" )
	      {	      
		$dFname[ $depLen ] = $_POST[ $key ];
	      }	    
	    else
	      continue;
	  }	

	$key = "dMname".$j;
	if( array_key_exists( $key, $_POST ) )
	  {
	    if( $_POST[ $key ] != "" )
	      {
		$dMname[ $depLen ] = $_POST[ $key ];
	      }
	  }

	$key = "dLname".$j;
	if( array_key_exists( $key, $_POST ) )
	  {
	    if( $_POST[ $key ] != "" )
	      {
		$dLname[ $depLen ] = $_POST[ $key ];
	      }
	  }

	$key = "dmonth".$j;
	$month = "";
	$year = "";
	$day = "";

	if( array_key_exists( $key, $_POST ) )
	  {
	    if( $_POST[ $key ] != "" )
	      {
		$month = $_POST[ $key ];
	      }
	  }

	$key = "dday".$j;
	if( array_key_exists( $key, $_POST ) )
	  {
	    if( $_POST[ $key ] != "" )
	      {
		$day = $_POST[ $key ];
	      }
	  }

	$key = "dyear".$j;
	if( array_key_exists( $key, $_POST ) )
	  {
	    if( $_POST[ $key ] != "" )
	      {
		$year = $_POST[ $key ];
		$dDob[ $depLen ] = $year."-".$month."-".$day;
	      }
	  }
	
	$key = "drelation".$j;
	if( array_key_exists( $key, $_POST ) )
	  {
	    if( $_POST[ $key ] != "..." )
	      {
		$dRelation[ $depLen ] = $_POST[ $key ];
		$depLen++;

		//echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"dFname[ ".($depLen - 1)." ] = ".$dFname[ $depLen - 1 ]."\");}</script>";
		//echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"dMname[ ".($depLen - 1)." ] = ".$dMname[ $depLen - 1 ]."\");}</script>";
		//echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"dLname[ ".($depLen - 1)." ] = ".$dLname[ $depLen - 1 ]."\");}</script>";
		//echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"dDob[ ".( $depLen - 1)." ] = ".$dDob[ $depLen - 1 ]."\");}</script>";
		//echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"dRelation[ ".( $depLen - 1)." ] = ".$dRelation[ $depLen - 1 ]."\");}</script>";
	      }
	  }
      }

    $empId = $_POST["empid"];
    //echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"empid :".$empId."\");}</script>";

    $empDep = $_POST["empDep"];
    //echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"empDep :".$empDep."\");}</script>";

    $isManager = 0;
    $manager = "";
    $manageDep = "";    
    //echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"manager :".$manager."\");}</script>";

    if( isset( $_POST["manager"] ) )
      {
	$manager = $_POST["manager"];
	$manager = strtoupper( $manager );
	if( $manager == "ON" )
	  {
	    $isManager = 1;
	    $manageDep = $_POST["managerDept"];	
	  }
      }
    //echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"manageDep :".$manageDep."\");}</script>";

    $position = $_POST["empPos"];
    //echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"position :".$position."\");}</script>";

    $officeId = intval( $_POST["empOffice"] );
    //echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"officeId :".$officeId."\");}</script>";

    $supervisorId = "";    
    $haveSupervisor = "";
    if( isset($_POST["haveSupervisor"] ) )
      {
	$haveSupervisor = $_POST["haveSupervisor"];
	$haveSupervisor = strtoupper( $haveSupervisor );
    //echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"haveSupervisor :".$haveSupervisor."\");}</script>";

	if( $haveSupervisor == "ON" )
	  {
	    $supervisorId = intval( $_POST["supervisor"] );
	  }
      }
    //echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"supervisorId :".$supervisorId."\");}</script>";

    $salary = $_POST["salary"];
    //echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"salary :".$salary."\");}</script>";

    $lcount = 0;
    if( $_POST["lcount"] != "" )
      $lcount = $_POST["lcount"];
    
    //echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"lcount :".$lcount."\");}</script>";

    $promCount = $_POST["promCount"];
    //echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"promCount :".$promCount."\");}</script>";

    $dhmonth = $_POST["dhmonth"];
    //echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"dhmonth :".$dhmonth."\");}</script>";

    $dhday = $_POST["dhday"];
    //echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"dhday :".$dhday."\");}</script>";

    $dhyear = $_POST["dhyear"];
    //echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"dhyear :".$dhyear."\");}</script>";

    $hireDate = $dhyear."-".$dhmonth."-".$dhday;
    //echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"hireDate :".$hireDate."\");}</script>";

    $access = 0;
    if( isset( $_POST["accessGiven"] ) )
      {
	$accessGiven = $_POST["accessGiven"];
	$accessGiven = strtoupper( $accessGiven );
    //echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"accessGiven :".$accessGiven."\");}</script>";

	if( $accessGiven == "ON" )
	  {
	    $access = 1;
	  }
      }
    //echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"access :".$access."\");}</script>";

    $query = $retrievePosIDByDesc.$position."'";
    $posID = "";
    //echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"query :".$query."\");}</script>";

    $res = mysql_query( $query );
    if( $res )
      {
	if( $row = mysql_fetch_array( $res ) )
	  {
	    $posID = $row["PositionID"];
	    //echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"posID :".$posID."\");}</script>";		    
	  }
      }
    else
      {
	die ("<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Error in retrieving positionID:".mysql_error()."\");}</script>");
      }

    $query = $retrieveDeptIDByName.$empDep."'";
    $deptID = "";
    //echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"query :".$query."\");}</script>";
    
    $res = mysql_query( $query );
    if( $res )
      {
	if( $row = mysql_fetch_array( $res ) )
	  {
	    $deptID = $row["DeptID"];
	    //echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"deptID :".$deptID."\");}</script>";		    
	  }
      }
    else
      {
	die ("<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Error in retrieving department ID:".mysql_error()."\");}</script>");
      }
    
    $query = $retrieveEmpID.$empId."'";
    $res = mysql_query( $query );
    //echo"<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"query :".$query."\");}</script>";    
    if( !$res )
      {
	die("<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"error in inserting employee :".mysql_error()."\");}</script>");
      }
    else
      {
	$row = mysql_fetch_array( $res );
	if( $row["EmployeeID"] != $empId )
	  {	    
	    if( $supervisorId == "" && $haveSupervisor != "ON" )
	      {
		$query = "INSERT INTO EMPLOYEE(EmployeeID,Fname,Mname,Lname,DOB,MStatus,ResAddress,PermAddress,Gender,Email,MobileNumber,PositionID,DeptID,Salary,Leaves,Promotions,OfficeID,Passport,DrivingLicense,HireDate) VALUES('";

		$query = $query.$empId."','".$fname."','".$mname."','".$lname."','".$dob."','".$mstatus."','".$resAddress."','".$permAddress."','".$gender."','".$email."','".$mobNo."','".$posID."','".$deptID."','".$salary."','".$lcount."','".$promCount."','".$officeId."','".$passport."','".$dlicense."','".$hireDate."')";

		//echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"query :".$query."\");}</script>";
	      }
	    else
	      {
		$query = "INSERT INTO EMPLOYEE VALUES('";
		
		$query = $query.$empId."','".$fname."','".$mname."','".$lname."','".$dob."','".$mstatus."','".$resAddress."','".$permAddress."','".$gender."','".$email."','".$mobNo."','".$posID."','".$deptID."','".$supervisorId."','".$salary."','".$lcount."','".$promCount."','".$officeId."','".$passport."','".$dlicense."','".$hireDate."')";

		//echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"query :".$query."\");}</script>";
	      }

	    $res = mysql_query( $query );
	    if( !$res )
	      {
		//echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"error in inserting employee :".mysql_error()."\");}</script>";
	      }
	    
	    for( $i = 0; $i < $langWLen; $i++ )
	      {
		$query = $retrieveLangIDByName.$langW[$i]."'";
		//		echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"query :".$query."\");}</script>";
		$res = mysql_query( $query );
		$langID = "";
		if( !$res )
		  {			
		    die("<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"error in inserting langknowW :".mysql_error()."\");}</script>");
		  }
		else
		  {
		    if( $row = mysql_fetch_array( $res ) )
		      {
			$langID = $row["LangID"];
			
			$query = $retrieveLangWID.$empId."'";
			$res = mysql_query( $query );
			if( $res )
			  {
			    $row = mysql_fetch_array( $res );
			    if( $row["LangID"] != $langID )
			      {
				$query = "INSERT INTO LANGKNOWNW VALUES('".$empId."','".$langID."')";		    
				//				echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"query :".$query."\");}</script>";
				$res = mysql_query( $query );
				if( !$res )
				  {			
				    die("<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"error in inserting langknowW :".mysql_error()."\");}</script>");
				  }
			      }
			  }
		      }
		    else
		      {
			die("<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"error in inserting langknowW :".mysql_error()."\");}</script>");
		      }
		  }			
	      }

	    for( $i = 0; $i < $langSLen; $i++ )
	      {
		$query = $retrieveLangIDByName.$langS[$i]."'";
		//		echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"query :".$query."\");}</script>";
		$res = mysql_query( $query );
		$langID = "";
		if( !$res )
		  {			
		    die("<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"error in inserting langknowS :".mysql_error()."\");}</script>");
		  }
		else
		  {
		    if( $row = mysql_fetch_array( $res ) )
		      {
			$langID = $row["LangID"];
			
			$query = $retrieveLangSID.$empId."'";
			$res = mysql_query( $query );
			if( $res )
			  {
			    $row = mysql_fetch_array( $res );
			    if( $row["LangID"] != $langID )
			      {
				$query = "INSERT INTO LANGKNOWNS VALUES('".$empId."','".$langID."')";		    
				//		echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"query :".$query."\");}</script>";
				$res = mysql_query( $query );
				if( !$res )
				  {			
				    die("<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"error in inserting langknowW :".mysql_error()."\");}</script>");
				  }
			      }
			  }
			else
			  {
			    die("<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"error in inserting langknowS :".mysql_error()."\");}</script>");
			  }
		      }			    
		  }		    
	      }

	    for( $i = 0; $i < $qualLen; $i++ )
	      {
		$query = $retrieveQualIDByDesc.$quals[$i]."'";
		//		echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"query :".$query."\");}</script>";
		$res = mysql_query( $query );
		$qualID = "";
		if( !$res )
		  {			
		    die ("<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"error in inserting degree :".mysql_error()."\");}</script>");
		  }
		else
		  {
		    if( $row = mysql_fetch_array( $res ) )
		      {
			$qualID = $row["QualID"];
			$query = $retrieveQualIDDegree.$empId."'";
			$res = mysql_query( $query );
			if( $res )
			  {
			    $row = mysql_fetch_array( $res );
			    if( $row["QualID"] != $qualID )
			      {
				$query = "INSERT INTO DEGREES VALUES('".$empId."','".$qualID."','".$qualYr[$i]."','".$institute[$i]."','".$board[$i]."')";		    
				//		echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"query :".$query."\");}</script>";
				$res = mysql_query( $query );
				if( !$res )
				  {			
				    die("<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"error in inserting degree :".mysql_error()."\");}</script>");
				  }
			      }
			  }
		      }
		    else
		      {
			die("<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"error in inserting degree :".mysql_error()."\");}</script>");
		      }
		  }			
	      }

	    for( $i = 0; $i < $achLen; $i++ )
	      {					
		$query = $retrieveMaxAchID.$empId."'";
		$res = mysql_query( $query );
		$id = "";
		if( $res )
		  {
		    $row = mysql_fetch_array( $res );
		    if( $row["MAX(AchievementID)"] == "" || $row["MAX(AchievementID)"] == 0 )
		      {
			$id = 1;
		      }
		    else
		      {
			$id = $row["MAX(AchievementID)"] + 1;
		      }
		  }

		$query = "INSERT INTO ACHIEVEMENTS VALUES('".$empId."','".$id."','".$achs[$i]."','".$achYr[$i]."')";		    
		//		echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"query :".$query."\");}</script>";
		$res = mysql_query( $query );
		if( !$res )
		  {			
		    die("<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"error in inserting achievements :".mysql_error()."\");}</script>");
		  }
	      }
	    
	    for( $i = 0; $i < $skillLen; $i++ )
	      {		    
		$query = $retrieveSkillIDByDesc.$skill[$i]."'";
		//echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"query :".$query."\");}</script>";
		$res = mysql_query( $query );
		$skillID = "";
		if( !$res )
		  {			
		    die ("<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"error in inserting degree :".mysql_error()."\");}</script>");
		  }
		else
		  {
		    if( $row = mysql_fetch_array( $res ) )
		      {
			$skillID = $row["SkillID"];
			$query = $retrieveSkillIDFromSS.$empId."'";
			$res = mysql_query( $query );
			if( $res )
			  {
			    $row = mysql_fetch_array( $res );
			    if( $row["SkillID"] != $skillID )
			      {
				$query = "INSERT INTO SKILLSET VALUES('".$empId."','".$skillID."')";		    
				//echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"query :".$query."\");}</script>";
				$res = mysql_query( $query );
				if( !$res )
				  {			
				    die( "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"error in inserting skill :".mysql_error()."\");}</script>");
				  }
			      }
			  }
		      }
		    else
		      {
			die("<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"error in inserting degree :".mysql_error()."\");}</script>");
		      }
		  }
	      }

	    for( $i = 0; $i < $depLen; $i++ )
	      {
		$query = $retrieveMaxDepID.$empId."'";
		$res = mysql_query( $query );
		$id = "";
		if( $res )
		  {
		    $row = mysql_fetch_array( $res );
		    if( $row["MAX(DependentID)"] == "" || $row["MAX(DependentID)"] == 0 )
		      {
			$id = 1;
		      }
		    else
		      {
			$id = $row["MAX(DependentID)"] + 1;
		      }
		  }
		
		$query = "INSERT INTO DEPENDENTS VALUES('".$empId."','".$id."','".$dFname[$i]."','".$dMname[$i]."','".$dLname[$i]."','".$dDob[$i]."','".$dRelation[$i]."')";		    
		//		echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"query :".$query."\");}</script>";
		$res = mysql_query( $query );
		if( !$res )
		  {			
		    die("<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"error in inserting dependents :".mysql_error()."\");}</script>");
		  }			
	      }
		    
	    if( $isManager == 1 )
	      {
		$query = $retrieveDeptIDByName.$manageDep."'";
		$res = mysql_query( $query );
		if( $res )
		  {
		    $row = mysql_fetch_array( $res );
		    $query = "INSERT INTO MANAGERS VALUES('".$row["DeptID"]."','".$empId."')";
		    $res = mysql_query( $query );
		    if( !$res )
		      {
			die("<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"error in inserting manager :".mysql_error()."\");}</script>");
		      }
		  }
	      }
	    
	    //echo"<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"before myslq_close :\");}</script>";		    
	    mysql_close();
	    registerUser($fname, $empId, $access );

	    $subject = "Your account details";
	    $text = "Username :".$fname.$empId."\nPassword: ".$fname.$empId."\n";
	    mail( $email, $subject, $text, "From : administrator@HRMS");
	    echo"<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Employee added successfully.\");}</script>";		    		    
	  }
      }
  }
function registerUser( $username, $empId, $access )
{
  //echo"<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"In register user\");}</script>";		    
  include("config.php");

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
	    die ("<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Error in selecting database :".mysql_error()."\");}</script>");
	  }
	else
	  {
	    $username = $username.$empId;
	    $password = $username;

	    $salt = hash('sha256', uniqid(mt_rand(), true) . 'something random' . strtolower($username));
	    $hash = $salt . $password;
 
	    for ( $i = 0; $i < 100000; $i ++ )
	      {
		$hash = hash('sha256', $hash);
	      }
 
	    $hash = $salt . $hash;
 
	    $query = "INSERT INTO USERS VALUES('".$username."','".$empId."','".$hash."','".$access."')";
	    //echo"<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"query =".$query."\");}</script>";		    
	    $res = mysql_query( $query );
	    if( !$res )
	      {
		die("<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Insert admin".mysql_error( $con )."\");}</script>");			      
	      }
	    mysql_close();
	  }
      }
}
?>

