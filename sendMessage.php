<?php
session_start();
if( !isset($_SESSION["id"]) || !isset($_SESSION["login"]) || $_SESSION["login"] != "true" )
  {
    header("Location: login.php");
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
HRMS Employee Login
</h1>

<h2>
Welcome 
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

$query = $retrieveFname.mysql_real_escape_string( $_SESSION['id'] )."'";
$res = mysql_query( $query, $con );
$row = mysql_fetch_array( $res );
echo $row["Fname"]."!";
mysql_close( $con );
?>
</h2>

<p style="align:right">

<table style="float:right">
<tr>
<nav style="float:right" >
<td>
<a href="profilepage.php" style="color:white" onclick="">
  Profile Page |
</a>
</td>
<td>
<a href="logout.php" style="color:white" onclick="">
  Logout
</a>
</td>
</nav>
</td>
</tr>
</table>
</p>
<br/>

<hr />

<br/>
<form name="form" style="float:left" method="post" action="sendMessage.php">
Subject:
<br />
<input type="text" name="subject" style="width:100%" >
<br />
Your message:
<br />
<textarea name="message" rows="20" cols="80">
</textarea>

<br/>
<table style="align:left;float:left"
<tr>
<td>
<input type="hidden" name="submitted" >
<input type="submit" style="" value="Send message" name="sendMessage">
</td>
<td>
</td>
</tr>
</table>
</form>

<?php
  include("config.php");

  if( isset( $_POST["submitted"] ) )
    {
      $subject = $_POST["subject"];
      $message = $_POST["message"];
      
      $id = $_SESSION["id"];

      $con = mysql_connect( $db_server, $db_username, $db_password );
      if( !$con )
	{
	  die ("<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Error in connecting to database :".mysql_error()."\");}</script>");	  
	}
      else
	{
	  $res = mysql_select_db( $db_name, $con );

	  if( !$res )
	    {
	      die ("Unable to connect to database,".mysql_error( $con ));
	    }

	  if( $_SESSION["sent"] != "true" )
	    {
	      $query = "INSERT INTO EMPMESSAGES(Message, Subject, ID, ReadOrNot) VALUES('".$message."','".$subject."',".$id.",0)";
	      //	  echo "<font color=\"red\">";	  
	      //	  var_dump($query);
	      //	  echo "</font>";
	      $res = mysql_query( $query );
	      if( !$res )
		{
		  echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Error in inserting message:".mysql_error( $con )."\");}</script>";	  
		}
	      
	      mysql_close( $con );
	      $_SESSION["sent"] = "true";	      
	    }
	  unset($_SESSION["sent"]);
	  header("Location: profilepage.php");
	}
    }

?>


</body>
</html>

