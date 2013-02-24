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

  <a href="viewEmployees.php" style="color:white">
View Employees Page |
</a>

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
	   $id = "";
if( isset( $_GET["action"] ) )
  {
    $id = $_GET["action"];
  }
?>


<table border="0">
<th align="left">
<u>
Personal Information:
</u>
</th>

<tr>
<td>
</td>
</tr>

<tr>
<td>
</td>
</tr>

<tr>
<td>
</td>
</tr>

<tr>
<td>
</td>
</tr>

<tr>
<td>
</td>
</tr>

<tr>
<td>
</td>
</tr>

<tr>
<td>
</td>
</tr>

<tr>
<td>
</td>
</tr>

<tr>
<td>
</td>
</tr>

<tr>
<td>
<strong>
Name
</strong>
</td>
<td>

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

$query = $retrieveName.mysql_real_escape_string( $id )."'";
$res = mysql_query( $query, $con );
$row = mysql_fetch_array( $res );
$name = $row["Fname"]." ".$row['Mname']." ".$row['Lname'];
echo $name;
?>
</td>
</tr>

<tr>
<td>
<strong>
Date of Birth
</strong>
</td>
<td>
<?php
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
    echo $dob;
  }
?>
</td>
</tr>


<tr>
<td>
<strong>
Gender
</strong>
</td>
<td>
<?php
$query = $retrieveGender.mysql_real_escape_string( $id )."'";
$res = mysql_query( $query, $con );
if( $res )
  {
    $row = mysql_fetch_array( $res );
    echo $row["Gender"];
  }
else
  {
    die ("<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Error in retrieving gender : ".mysql_error()."\");}</script>");
  }
?>

</td>
</tr>

<tr>
<td>
<strong>
Residential Address
</strong>
</td>
<td>

<?php
$query = $retrieveResAddress.mysql_real_escape_string( $id )."'";
$res = mysql_query( $query, $con );
if( $res )
  {
    $row = mysql_fetch_array( $res );
    echo $row['ResAddress'];
  }
?>

</td>
</tr>

<tr>
<td>
<strong>
Permanent Address
</strong>
</td>
<td>
<?php
$query = $retrievePermAddress.mysql_real_escape_string( $id )."'";
$res = mysql_query( $query, $con );
if( $res )
  {
    $row = mysql_fetch_array( $res );
    echo $row['PermAddress'];
  }
?>
</td>
</tr>


<tr>
<td>
<strong>
Mobile Number
</strong>
</td>
<td>

<?php
$query = $retrieveConNumber.mysql_real_escape_string( $id )."'";
$res = mysql_query( $query, $con );
if( $res )
  {
    $row = mysql_fetch_array( $res );
    echo $row['MobileNumber'];
  }
?>
</td>
</tr>

<tr>
<td>
<strong>
E-mail ID
</strong>
</td>
<td>
<?php
$query = $retrieveEmail.mysql_real_escape_string( $id )."'";
$res = mysql_query( $query, $con );
if( $res )
  {
    $row = mysql_fetch_array( $res );
    echo $row['Email'];
  }
?>
</td>
</tr>

<tr>
<td>
<strong>
Marital Status
</strong>
</td>
<td>
<?php
$query = $retrieveMStatus.mysql_real_escape_string( $id )."'";
$res = mysql_query( $query, $con );
if( $res )
  {
    $row = mysql_fetch_array( $res );
    echo $row["MStatus"];
  }
else
  {
    die ("<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Error in retrieving marital status : ".mysql_error()."\");}</script>");
  }
?>

</td>
</tr>

<br />
<tr>
<td>
<strong>
Langauges known (Written)
</strong>
</td>
<td>
<?php
$query = $retrieveAllLangW.mysql_real_escape_string( $id )."'";
//echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"query: ".$query."\");}</script>";
$res = mysql_query( $query, $con );
if( $res )
  {
    $i = 1;
    while( $row = mysql_fetch_array( $res ) )
      {
	//	echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"in while loop \");}</script>";
	$query = $retrieveLangNameByID.$row["LangID"]."'";
	$res2 = mysql_query( $query );
	
	if( $res2 )
	  {
	    //	    echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"row: ".$row."\");}</script>";
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
?>


<br />
<tr>
<td>
<strong>
Langauges known (Spoken)
</strong>
</td>
<td>
<?php
$query = $retrieveAllLangS.mysql_real_escape_string( $id )."'";
//echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"query: ".$query."\");}</script>";
$res = mysql_query( $query, $con );
if( $res )
  {
    $i = 1;
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
?>

<tr>
<td>
<strong>
Having passport
</strong>
</td>
<td>

<?php
$query = $retrievePassport.mysql_real_escape_string( $id )."'";
$res = mysql_query( $query );
if( $res )
  {
    $row = mysql_fetch_array( $res );
    if( $row["Passport"] == 1 )
      {
	echo "Yes";
      }
    else
      {
	echo "No";
      }
  }
?>

</td>
</tr>

<tr>
<td>
<strong>
Having driving license
</strong>
</td>
<td>

<?php
$query = $retrieveDrivingLicense.mysql_real_escape_string( $id )."'";
$res = mysql_query( $query );
if( $res )
  {
    $row = mysql_fetch_array( $res );
    if( $row["DrivingLicense"] == 1 )
      {
	echo "Yes";
      }
    else
      {
	echo "No";
      }
  }
?>

</td>
</tr>

</table>
<br/>

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
$i = 1;
    
while( $row = mysql_fetch_array( $res ) )
  {
    echo "<tr><td>".$i."</td><td>";
    $query2 = $retrieveQualDescByID.$row["QualID"]."'";
    //echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"query2 : ".$query2."\");}</script>";
    $res2 = mysql_query( $query2 );
    if( $res2 )
      {
	$row2 = mysql_fetch_array( $res2 );
	echo $row2["QualDesc"]."</td><td>".$row["Yr"]."</td><td>".$row["Institute"]."</td><td>".$row["Board"]."</td></tr>";
      }
    $i++;
  }
?>

</table>


<label style="color:white;font-size:150%">
<u>
<strong>
Achievements
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
Achievement
</strong>
</td>

<td>
<strong>
Year
</strong>
</td>

</tr>

<?php
  $query = $retrieveAchsByID.mysql_real_escape_string( $id )."'";
//echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"query : ".$query."\");}</script>";
$res = mysql_query( $query );
    
while( $row = mysql_fetch_array( $res ) )
  {
    echo "<tr><td>".$row["AchievementID"]."</td><td>".$row["Achievement"]."</td><td>".$row["Yr"]."</td></tr>";
  }

?>

</table>


<label style="color:white;font-size:150%">
<u>
<strong>
Skills
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
Skill
</strong>
</td>

</tr>

<?php
  $query = $retrieveSkillFromSkillSet.mysql_real_escape_string( $id )."'";
//echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"query : ".$query."\");}</script>";
$res = mysql_query( $query );
$i = 1;
    
while( $row = mysql_fetch_array( $res ) )
  {
    echo "<tr><td>".$i."</td><td>";
    $query2 = $retrieveSkillDescByID.$row["SkillID"]."'";
    //echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"query2 : ".$query2."\");}</script>";
    $res2 = mysql_query( $query2 );
    if( $res2 )
      {
	$row2 = mysql_fetch_array( $res2 );
	echo $row2["SkillDesc"]."</td></tr>";
      }
    $i++;
  }
?>

</table>

<label style="color:white;font-size:150%">
<u>
<strong>
Dependents Information
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
Name
</strong>
</td>

<td>
<strong>
Date Of Birth
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
$res = mysql_query( $query, $con );
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
	echo "<tr><td>".$row["DependentID"]."</td><td>".$name."</td><td>".$dob."</td><td>".$row["Relation"]."</td></tr>";    
      }
  }
?>

</table>
<hr />


<table border="0">

<th style="align:left">
<u>
Work Details:
</u>
</th>

<tr>
<td>
</td>
</tr>

<tr>
<td>
</td>
</tr>

<tr>
<td>
</td>
</tr>

<tr>
<td>
</td>
</tr>

<tr>
<td>
</td>
</tr>

<tr>
<td>
</td>
</tr>

<tr>
<td>
</td>
</tr>

<tr>
<td>
</td>
</tr>

<tr>
<td>
<strong>
Employee ID
</strong>
</td>
<td>
<?php
  echo $_GET["action"];
?>
</td>
</tr>

<tr>
<td>
<strong>
Department
</strong>
</td>
<td>

<?php
$query = $retrieveDept.mysql_real_escape_string( $id )."')";
if( $res = mysql_query( $query ) )
  {
    $row = mysql_fetch_array( $res );
    echo $row["DeptName"];
  }
?>


<tr>
<td>
<strong>
Manager of Department
</strong>
</td>
<td>

<?php
$query = $retrieveDeptManaged.mysql_real_escape_string( $id )."'";
//echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"query :".$query."\");}</script>";
if( $res = mysql_query( $query ) )
  {
    $row = mysql_fetch_array( $res );
    if( $row["DeptID"] != "" )
      {
	$query = $retrieveDeptNameByID.$row["DeptID"]."'";
	//echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"query :".$query."\");}</script>";

	$res = mysql_query( $query );
	if( $res )
	  {
	    $row = mysql_fetch_array( $res );
	    echo $row["DeptName"];
	  }
      }
  }
?>


</td>
</tr>

<tr>
<td>
<strong>
Position
</strong>
</td>
<td>

<?php
$query = $retrievePos.mysql_real_escape_string( $id )."')";
if( $res = mysql_query( $query, $con ) )
  {
    $row = mysql_fetch_array( $res );
    echo $row["PosDesc"];
  }
?>
</td>
</tr>

<tr>
<td>
<strong>
Supervisor
<strong>
</td>
<td>
<?php
$query = $retrieveSupervisor.mysql_real_escape_string( $id )."')";
if( $res = mysql_query( $query, $con ) )
  {
    $row = mysql_fetch_array( $res );
    if( $row["Fname"] != "" )
    {
      $name = $row["Fname"]." ".$row["Mname"]." ".$row["Lname"];
      echo $name;
    }
  }
?>

</td>
</tr>

<tr>
<td>
<strong>
Office Location
</strong>
</td>

<?php

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
	echo "<td>".$row2["Location"]."</td>";
      }
  }
?>

</tr>

<tr>
<td>
<strong>
Salary
</strong>
</td>
<td>

<?php
$query = $retrieveSalary.mysql_real_escape_string( $id )."'";
if( $res = mysql_query( $query, $con ) )
  {
    $row = mysql_fetch_array( $res );
    echo $row["Salary"];
  }
?>
</td>
</tr>

<tr>
<td>
<strong>
Leaves Count
</strong>
</td>
<td>

<?php
$query = $retrieveLeaves.mysql_real_escape_string( $id )."'";
if( $res = mysql_query( $query, $con ) )
  {
    $row = mysql_fetch_array( $res );
    echo $row["Leaves"];
  }
?>
</td>
</tr>

<tr>
<td>
<strong>
Promotions Count
</strong>
</td>
<td>

<?php
$query = $retrievePromotions.mysql_real_escape_string( $id )."'";
if( $res = mysql_query( $query, $con ) )
  {
    $row = mysql_fetch_array( $res );
    echo $row["Promotions"];
  }
?>


</td>
</tr>

<tr>
<td>
<strong>
Date of Hiring
</strong>
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
<td>
<?php
$query = $retrieveAccessByID.$id."'";
if( $res = mysql_query( $query ) )
  {
    $row = mysql_fetch_array( $res );
    if( $row["Access"] == 1 )
      echo "Read/Write access";
    else
      echo "Read Only access";     
  }
?>
</td>
</tr>
</tr>

</table>

</body>
</html>
