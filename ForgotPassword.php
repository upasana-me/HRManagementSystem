<?php
session_start();

if( isset( $_SESSION["id"] ) )
  {
    if(isset($_SESSION["login"]) && $_SESSION["login"]=="true" && $_SESSION["access"] == 0 )
      {
	header("Location: profilepage.php");
      }
    else if( isset( $_SESSION["sup"] ) && $_SESSION["sup"] == 1 && isset($_SESSION["login"]) && $_SESSION["login"]=="true" && $_SESSION["access"] == 1 )
      {
	header("Location: supAdminProfile.php");
      }
    else if( isset($_SESSION["login"]) && $_SESSION["login"]=="true" && $_SESSION["access"] == 1 )
      {
	header("Location: adminprofile.php");
      }
  }
?>

<html>
<head>
<style>
body
{
background-color:black ;
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
form
{
color:white;
font-size:100%;
}
p
{
color:white;
font-size:150%;
}
h1
{
font-size:200%;
color:RED;
text-align:center;
}
h2
{
font-size:200%;
color:RED;
text-align:center;
}
</style>
</head>
<body>
<img src="hrms.php" height="15%" width="15%" style="float:left;" />
<h1>
HUMAN RESOURCE MANAGEMENT SYSTEM
</h1>

<h2>
Retrieve Your Password
</h2>

<br/>
<hr />
<br/>
<h3 style="color:white" align="center">
<u>Enter the following information:</u>
</h3>
<table border="0" align="center">
<form action="ForgotPassword.php" method="post" name="form">

<tr>
<td>
</td>
<td>
</td>
</tr>
<tr>
<td>
</td>
<td>
</td>
</tr>
<tr>
<td>
</td>
<td>
</td>
</tr>
<tr>
<td>First Name</td>
<td><input type="text" name="firstname" style="width:99%">
<br />
</td>
</tr>
<tr>
<td>
</td>
<td>
</td>
</tr>
<tr>
<td>
</td>
<td>
</td>
</tr>
<tr>
<td>Employee ID</td>
<td><input type="text" name="empID" style="width:99%">
<br />
</td>
</tr>
<tr>
<td>
</td>
<td>
</td>
</tr>
<tr>
<td>
</td>
<td>
</td>
</tr>
<tr>
<td>Date of Birth</td>

<td><select name="month">	<option value="1">January	<option value="2">February	<option value="3">March	<option value="4">April	<option value="5">May	<option value="6">June	<option value="7">July	<option value="8">August	<option value="9">September	<option value="10">October	<option value="11">November	<option value="12">December</select><select name="day">	<option value="1">1	<option value="2">2	<option value="3">3	<option value="4">4	<option value="5">5	<option value="6">6	<option value="7">7	<option value="8">8	<option value="9">9	<option value="10">10	<option value="11">11	<option value="12">12	<option value="13">13	<option value="14">14	<option value="15">15	<option value="16">16	<option value="17">17	<option value="18">18	<option value="19">19	<option value="20">20	<option value="21">21	<option value="22">22	<option value="23">23	<option value="24">24	<option value="25">25	<option value="26">26	<option value="27">27	<option value="28">28	<option value="29">29	<option value="30">30	<option value="31">31
</select>
<select name="year">	

<?php 
  for( $i = 1940; $i <= 2050; $i++ )
    echo "<option>".$i."</option>";

?>

</select>

<br />
</td>
</tr>
<tr>
<td>
</td>
<td>
</td>
</tr>
<tr>
<td>
</td>
<td>
</td>
</tr>
<tr>
<td>
</td>
<td>
</td>
</tr>
<tr>
<td>
</td>
<td>
</td>
</tr>
<tr>
<td>
</td>
<td>
</td>
</tr>
<tr>
<td>
</td>
<td>
<input type="hidden" name="action" />
<input type="submit" value="Submit">
</td>
</tr>
</form>
</table>
</body>
</html>

<?php

  if( isset( $_POST["action"] ) )
    {
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
	      die ("Unable to connect to database,".mysql_error( $con ));
	    }
	  else
	    {
	      $fname = $_POST["firstname"];
	      $empID = $_POST["empID"];
	      $month = $_POST["month"];
	      $day = $_POST["day"];
	      $year = $_POST["year"];

	      $date = $year."-".$month."-".$day;

	      $query = "SELECT Email FROM EMPLOYEE WHERE EmployeeID='".$empID."' && Fname='".$fname."' && DOB='".$date."'";

	      if( $fname == "" || $empID = "" )
		{
		  die ("<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Please fill all three fields.\");}</script>");
		}

	      $res = mysql_query( $query );
	      if( $res )
		{
		  sendMail( $email, $empID );
		  echo ("<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Your password has been sent on the email id provided by you to the company.\");}</script>");
		}
	      else
		{
		  echo ("<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Information do not match!\");}</script>");
		}
	    }
	}
    }

function sendMail( $email, $ID )
{
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
	      die ("Unable to connect to database,".mysql_error( $con ));
	    }
	  else
	    {
	      $query = "SELECT Username FROM USERS WHERE ID='".$ID."'";
	      $res = mysql_query( $query );
	      if( $res )
		{	
		  $row = mysql_fetch_array( $res );
		  
		  $password = $row["Username"].$ID;
		  $username = $row["Username"];

		  $salt = hash('sha256', uniqid(mt_rand(), true) . 'something random' . strtolower($username));
		  
		  $hash = $salt . $password;
 
		  for ( $i = 0; $i < 100000; $i ++ )
		    {
		      $hash = hash('sha256', $hash);
		    }
 
		  $hash = $salt . $hash;
		  
		  $query = "UPDATE USERS SET Password='".$hash."'";

		  $res = mysql_query( $query );
		  if( !$res )
		    {
		      echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Insert admin".mysql_error( $con )."\");}</script>";			      
		    }

		    $subject = "Your account details";
		    $text = "Username :".$username."\nPassword: ".$password."\n";
		    mail( $email, $subject, $text, "From : administrator@HRMS");		  
		}
	    }
	}
}

?>
