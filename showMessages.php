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

<style>
h1
{
font-size:300%;
color:red;
text-align:center;
}

body
{
background-color:black;
color:white;
}

label
{
color:white;
}

td
{
color:white;
font-size:130%;
}

</style>
</head>

<body>

<img src="hrms.php" height = "15%" width="15%" style="float:left"/>

<h1>
HR MANAGEMENT SYSTEM
</h1>

<nav style="float:right;" >

<a href=

<?php
  if( $_SESSION["id"] == 0 )
    {
      echo "\"supAdminProfile.php\"";
    }
else
  {
    echo "\"adminprofile.php\"";
  }

?>

style="color:white">
Profile page
</a>

<a href="logout.php" style="color:white;">
| Logout 
</a>

</nav>

<br />
<hr/>

<h2 style="color:white">
Inbox
<?php
$query = $retrieveUnReadMsgCount;
$res = mysql_query( $query, $con );
if( $res )
  {
    $row = mysql_fetch_array( $res );
    echo "(".$row[0].")</h2>";
    $res = mysql_query( $retrieveMessages );
    if( $res )
      {
	echo "<table>";
	$i = 1;
	echo "<form action=\"showMessages.php\" method=\"post\" >";
	while( $row = mysql_fetch_array( $res ) )
	  {	
	    $subject = $row["Subject"];
	    $id = $row["ID"];
	    $query = $retrieveNameAndEmail.$id."'";
	    $res2 = mysql_query( $query );
	    $row2 = mysql_fetch_array( $res2 );
      
	    $name = $row2["Fname"]." ".$row2["Mname"]." ".$row2["Lname"];
	    $formname = "form".$id;

	    echo "<form name=\"".$formname."\" action=\"showMessages.php\" method=\"post\">";
	    $read = "Read";
	    if( $row["ReadOrNot"] == 0 )
	      {	    
		$read = "Unread";
	      }
	    echo "<table>";
	    echo "<tr><td><strong><label>Status</label>:</strong></td><td>".$read."</td></tr>";
	    echo "<tr><td><strong><label>Sender</label>:</strong></td><td>".$name."</td></tr>";
	    echo "<tr><td><strong><label>Sender's Employee ID</label>:</strong></td><td>".$id."</td></tr>";
	    echo "<tr><td><strong><label>Subject</label>:</strong></td><td>".$subject."</td></tr>";
	    echo "<tr><td><strong><label>Sent at</label>:</strong></td><td>".$row["Ts"]."</td></tr>";
	    echo "<tr><td><strong><label>Message</label>:</strong></td></tr>";
	    echo "<tr><td colspan=\"2\">".$row["Message"]."</td></tr>";
	    echo "<tr><td colspan=\"2\"><a style=\"color:white\" href=\"mailto:".$row2["Email"]."?Subject=Re:".$subject."\">Reply</a></td></tr>";	
	    echo "<tr><td>Mark as unread</td><td><input type=\"radio\" name=\"readStatus".$row["MessageID"]."\" value=\"0\"/></td>";
	    echo "<td>Mark as read</td><td><input type=\"radio\" name=\"readStatus".$row["MessageID"]."\" value=\"1\"/></td></tr>";
	    echo "<input type=\"hidden\" name=\"action".$row["MessageID"]."\"/>";
	    echo "<tr><td>Delete</td><td><input type=\"checkbox\" name=\"delete".$row["MessageID"]."\"/></td></tr>";
	    echo "</table>";
	    echo "<hr />";
	    $i++;
	  }
	echo "</table>";
      }
}
?>

</form>
</body>
</html>

<?php
$query = $retrieveMessageIDS;
$res = mysql_query( $query, $con );
if( $res )
  {
    while( $row = mysql_fetch_array( $res ) )
      {
	$key = "action".$row["MessageID"];
	if( isset( $_POST[ $key ] ) )
	  {
	    $key2 = "readStatus".$row["MessageID"];
	    $read = $_POST[ $key2 ];
	    $query2 = "UPDATE EMPMESSAGES SET ReadOrNot='".$read."' WHERE MessageID='".$row["MessageID"]."'";
	    $res2 = mysql_query( $query2 );
	    if( !$res2 )
	      {
		die ("<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Error in updating EMPMESSAGES : ".mysql_error()."\");}</script>");
	      }
	    
	    $delete = $_POST["delete".$row["MessageID"] ];
	    $delete = strtoupper( $delete );
	    if( $delete == "ON" )
	      {
		$query3 = "DELETE FROM EMPMESSAGES WHERE MessageID='".$row["MessageID"]."'";
		$res3 = mysql_query( $query3 );
		if( !$res3 )
		  {
		    die ("<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Error in deleting message : ".mysql_error()."\");}</script>");
		  }
	      }
	  }
	//	if( isset( $_

      }
  }

?>