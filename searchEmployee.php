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
  Search Employee!
</h1>

<br />

<p style="align:right">
<nav style="float:right" >

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

<table>
<form name="searchForm" id="searchFormID" method="post" action="searchEmployee.php">

<tr>
<td>
<label style="color:white">
Search options
</label>
</td>

<td>
<select id="searchOptions" name="searchBy" onchange="makeElements()">


<?php
		    $searchOpt = array( 
				       "First name", 
				       "Langauges Known (Written)", 
				       "Languages Known (Spoken)",
				       "Having passport",
				       "Having driving license",
				       "Educational qualification",
				       "Skills",
				       "Employee ID", 
				       "Department", 
				       "Position", 
				       "Office Location",
				       "Salary Less than",
				       "Salary equal to",
				       "Salary greater than",
				       "Leaves less than",
				       "Leaves equal to",
				       "Leaves greater than",
				       "Hired before date (yyyy-mm-dd)",
				       "Hired on date (yyyy-mm-dd)",
				       "Hired after date (yyyy-mm-dd)",				       
				       "Employee with maximum number of leaves",
					);

for( $i = 0; $i < count( $searchOpt ); $i++ )
  {
    echo "<option value=\"".$i."\">".$searchOpt[ $i ]."</option>";
  }

?>
</td>

<td id="useLater">
<input type="text" name="secondField" />
</td>
<td>
<input type="hidden" name="startSearch" />
<input type="submit" value="Go!" />
</td>
</tr>
</form>
</table>

<?php
  if( isset( $_POST["startSearch"] ) )
    {
      $selected = $_POST["searchBy"];
      $secondField = "";
      if( isset( $_POST["secondField"] ) )
	{
	  $secondField = $_POST["secondField"];
	}
//      echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"selected : ".$selected."\");}</script>";

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

      echo "<br /><hr/>";

      switch( $selected )
	{
	case 0:
	$query = $retrieveEmpByFirstName.$secondField."'";
	//	echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"query : ".$query."\");}</script>";
	$res = mysql_query( $query );
	if( $res )
	  {
	    $i = 1;
	    while( $row = mysql_fetch_array( $res ) )
	      {
		echo "<table>";
		echo "<form method=\"get\" action=\"displayPro.php\" >";
		echo "<tr><td colspan=\"2\"><strong>Employee ID:</strong></td><td>".$row["EmployeeID"]."</td></tr>";
		echo "<tr><td colspan=\"2\"><strong>First name:</strong></td><td>".$row["Fname"]."</td></tr>";
		echo "<tr><td colspan=\"2\"><strong>Middle name:</strong></td><td> ".$row["Mname"]."</td></tr>";
		echo "<tr><td colspan=\"2\"><strong>Last name:</strong></td><td>".$row["Lname"]."</td></tr>";
		
		echo "<tr><td><input type=\"hidden\" name=\"action\" value=\"".$row["EmployeeID"]."\" /></td></tr>";
		
		echo "<tr><td><button type=\"submit\">View Full Profile</button></td>";
		echo "<td><button type=\"submit\" style=\"width:150%\" formaction=\"editProfile.php\">Edit Profile</button></td></tr>";
		echo "</form>";
		echo "</table>";
		echo "<hr/>";
		$i++;
	      }
	    if( $i == 1 )
	      {		  
		echo "<label style=\"color:white\">No results found!</label>";
	      }
	  }
	break;
	case 1:
	$query = $retrieveLangIDByName.$secondField."'";
	//	echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"query : ".$query."\");}</script>";
	$res = mysql_query( $query );
	if( $res )
	  {
	    if( $row = mysql_fetch_array( $res ) )
	      {
		$query2 = $retrieveEmpByLangKnownW.$row["LangID"]."'";
		//		echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"query2 : ".$query2."\");}</script>";
		$res2 = mysql_query( $query2 );
		if( $res2 )
		  {
		    $i = 1;
		    while( $row2 = mysql_fetch_array( $res2 ) )
		      {			
			//echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"row[EmployeeID] : ".$row2["EmployeeID"]."\");}</script>";
			$query3 = $retrieveName.$row2["EmployeeID"]."'";
			//echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"query3 : ".$query3."\");}</script>";
			$res3 = mysql_query( $query3 );
			if( $res3 )
			  {
			    $row3 = mysql_fetch_array( $res3 );
			    //echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"row3[Fname] : ".$row3["Fname"]."\");}</script>";

			    echo "<table>";
			    echo "<form method=\"get\" action=\"displayPro.php\" >";
			    echo "<tr><td colspan=\"2\"><strong>Employee ID:</strong></td><td>".$row2["EmployeeID"]."</td></tr>";
			    echo "<tr><td colspan=\"2\"><strong>First name:</strong></td><td>".$row3["Fname"]."</td></tr>";
			    echo "<tr><td colspan=\"2\"><strong>Middle name:</strong></td><td> ".$row3["Mname"]."</td></tr>";
			    echo "<tr><td colspan=\"2\"><strong>Last name:</strong></td><td>".$row3["Lname"]."</td></tr>";
			    
			    echo "<tr><td><input type=\"hidden\" name=\"action\" value=\"".$row2["EmployeeID"]."\" /></td></tr>";
			    
			    echo "<tr><td><button type=\"submit\">View Full Profile</button></td>";
			    echo "<td><button type=\"submit\" style=\"width:150%\" formaction=\"editProfile.php\">";
			    echo "Edit Profile</button></td></tr>";
			    echo "</form>";
			    echo "</table>";
			    echo "<hr/>";				
			  }
			$i++;
		      }		    
		    if( $i == 1 )
		      {
			echo "<label style=\"color:white\">No results found!</label>";
		      }
		  }

	      }
	  }
	else
	  {
	    echo "<label style=\"color:white\">No results found!</label>";
	  }
	break;
	case 2:
	$query = $retrieveLangIDByName.$secondField."'";
	//echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"query : ".$query."\");}</script>";
	$res = mysql_query( $query );
	if( $res )
	  {
	    if( $row = mysql_fetch_array( $res ) )
	      {
		$query2 = $retrieveEmpByLangKnownS.$row["LangID"]."'";
		//echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"query2 : ".$query2."\");}</script>";
		$res2 = mysql_query( $query2 );
		if( $res2 )
		  {
		    $i = 1;
		    while( $row2 = mysql_fetch_array( $res2 ) )
		      {
			$query3 = $retrieveName.$row2["EmployeeID"]."'";
			//echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"query3 : ".$query3."\");}</script>";
			$res3 = mysql_query( $query3 );
			if( $res3 )
			  {
			    $row3 = mysql_fetch_array( $res3 );
			    echo "<table>";
			    echo "<form method=\"get\" action=\"displayPro.php\" >";
			    echo "<tr><td colspan=\"2\"><strong>Employee ID:</strong></td><td>".$row2["EmployeeID"]."</td></tr>";
			    echo "<tr><td colspan=\"2\"><strong>First name:</strong></td><td>".$row3["Fname"]."</td></tr>";
			    echo "<tr><td colspan=\"2\"><strong>Middle name:</strong></td><td> ".$row3["Mname"]."</td></tr>";
			    echo "<tr><td colspan=\"2\"><strong>Last name:</strong></td><td>".$row3["Lname"]."</td></tr>";
			    
			    echo "<tr><td><input type=\"hidden\" name=\"action\" value=\"".$row2["EmployeeID"]."\" /></td></tr>";
			    
			    echo "<tr><td><button type=\"submit\">View Full Profile</button></td>";
			    echo "<td><button type=\"submit\" style=\"width:150%\" formaction=\"editProfile.php\">";
			    echo "Edit Profile</button></td></tr>";
			    echo "</form>";
			    echo "</table>";
			    echo "<hr/>";				
			  }
			$i++;
		      }		    
		    if( $i == 1 )
		      {
			echo "<label style=\"color:white\">No results found!</label>";
		      }
		  }

	      }
	  }
	else
	  {
	    echo "<label style=\"color:white\">No results found!</label>";
	  }
	break;
	case 3:
	$query = $retrieveEmpHavingPassport;
	$res = mysql_query( $query );
	if( $res )
	  {
	    $i = 1;
	    while( $row = mysql_fetch_array( $res ) )
	      {
		echo "<table>";
		echo "<form method=\"get\" action=\"displayPro.php\" >";
		echo "<tr><td colspan=\"2\"><strong>Employee ID:</strong></td><td>".$row["EmployeeID"]."</td></tr>";
		echo "<tr><td colspan=\"2\"><strong>First name:</strong></td><td>".$row["Fname"]."</td></tr>";
		echo "<tr><td colspan=\"2\"><strong>Middle name:</strong></td><td> ".$row["Mname"]."</td></tr>";
		echo "<tr><td colspan=\"2\"><strong>Last name:</strong></td><td>".$row["Lname"]."</td></tr>";
		
		echo "<tr><td><input type=\"hidden\" name=\"action\" value=\"".$row["EmployeeID"]."\" /></td></tr>";
		
		echo "<tr><td><button type=\"submit\">View Full Profile</button></td>";
		echo "<td><button type=\"submit\" style=\"width:150%\" formaction=\"editProfile.php\">Edit Profile</button></td></tr>";
		echo "</form>";
		echo "</table>";
		echo "<hr/>";
		$i++;
	      }
	    if( $i == 1 )
	      {		  
		echo "<label style=\"color:white\">No results found!</label>";
	      }
	  }
	break;
	case 4:
	$query = $retrieveEmpHavingDL;
	$res = mysql_query( $query );
	if( $res )
	  {
	    $i = 1;
	    while( $row = mysql_fetch_array( $res ) )
	      {
		echo "<table>";
		echo "<form method=\"get\" action=\"displayPro.php\" >";
		echo "<tr><td colspan=\"2\"><strong>Employee ID:</strong></td><td>".$row["EmployeeID"]."</td></tr>";
		echo "<tr><td colspan=\"2\"><strong>First name:</strong></td><td>".$row["Fname"]."</td></tr>";
		echo "<tr><td colspan=\"2\"><strong>Middle name:</strong></td><td> ".$row["Mname"]."</td></tr>";
		echo "<tr><td colspan=\"2\"><strong>Last name:</strong></td><td>".$row["Lname"]."</td></tr>";
		
		echo "<tr><td><input type=\"hidden\" name=\"action\" value=\"".$row["EmployeeID"]."\" /></td></tr>";
		
		echo "<tr><td><button type=\"submit\">View Full Profile</button></td>";
		echo "<td><button type=\"submit\" style=\"width:150%\" formaction=\"editProfile.php\">";
		echo "Edit Profile</button></td></tr>";
		echo "</form>";
		echo "</table>";
		echo "<hr/>";
		$i++;
	      }
	    if( $i == 1 )
	      {		  
		echo "<label style=\"color:white\">No results found!</label>";
	      }
	  }
	break;
	case 5:
	$query = $retrieveQualIDByDesc.$secondField."'";
	//echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"query : ".$query."\");}</script>";
	$res = mysql_query( $query );
	if( $res )
	  {
	    if( $row = mysql_fetch_array( $res ) )
	      {
		if( $row["QualID"] != "" )
		  {
		    $query2 = $retrieveEmpIDByQualID.$row["QualID"]."'";
		    //echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"query2 : ".$query2."\");}</script>";
		    $res2 = mysql_query( $query2 );
		    if( $res2 )
		      {
			$i = 1;
			while( $row2 = mysql_fetch_array( $res2 ) )
			  {
			    $query3 = $retrieveName.$row2["EmployeeID"]."'";
			    //echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"query3 : ".$query3."\");}</script>";
			    $res3 = mysql_query( $query3 );
			    if( $res3 )
			      {
				$row3 = mysql_fetch_array( $res3 );
				echo "<table>";
				echo "<form method=\"get\" action=\"displayPro.php\" >";
				echo "<tr><td colspan=\"2\"><strong>Employee ID:</strong></td><td>".$row2["EmployeeID"]."</td></tr>";
				echo "<tr><td colspan=\"2\"><strong>First name:</strong></td><td>".$row3["Fname"]."</td></tr>";
				echo "<tr><td colspan=\"2\"><strong>Middle name:</strong></td><td> ".$row3["Mname"]."</td></tr>";
				echo "<tr><td colspan=\"2\"><strong>Last name:</strong></td><td>".$row3["Lname"]."</td></tr>";
			    
				echo "<tr><td><input type=\"hidden\" name=\"action\" value=\"".$row2["EmployeeID"]."\" /></td></tr>";
				
				echo "<tr><td><button type=\"submit\">View Full Profile</button></td>";
				echo "<td><button type=\"submit\" style=\"width:150%\" formaction=\"editProfile.php\">";
				echo "Edit Profile</button></td></tr>";
				echo "</form>";
				echo "</table>";
				echo "<hr/>";				
			      }
			    $i++;
			  }		    
			if( $i == 1 )
			  {
			    echo "<label style=\"color:white\">No results found!</label>";
			  }
		      }
		  }
		else
		  {
		    echo "<label style=\"color:white\">No results found!</label>";
		  }
	      }
	  }
	break;
	case 6:
	$query = $retrieveSkillIDByDesc.$secondField."'";
	$res = mysql_query( $query );
	if( $res )
	  {
	    $row = mysql_fetch_array( $res );
	    if( $row["SkillID"] != "")
	      {
		$query2 = $retrieveEmpIDBySkillID.$row["SkillID"]."'";
		$res2 = mysql_query( $query2 );
		$i = 1;
		if( $res2 )
		  {
		    $j = 1;
		    while( $row2 = mysql_fetch_array( $res2 ) )
		      {
			$query3 = $retrieveName.$row2["EmployeeID"]."'";
			//echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"query3 : ".$query3."\");}</script>";
			$res3 = mysql_query( $query3 );
			if( $res3 )
			  {
			    $row3 = mysql_fetch_array( $res3 );
			    echo "<table>";
			    echo "<form method=\"get\" action=\"displayPro.php\" >";
			    echo "<tr><td colspan=\"2\"><strong>Employee ID:</strong></td><td>".$row2["EmployeeID"]."</td></tr>";
			    echo "<tr><td colspan=\"2\"><strong>First name:</strong></td><td>".$row3["Fname"]."</td></tr>";
			    echo "<tr><td colspan=\"2\"><strong>Middle name:</strong></td><td> ".$row3["Mname"]."</td></tr>";
			    echo "<tr><td colspan=\"2\"><strong>Last name:</strong></td><td>".$row3["Lname"]."</td></tr>";			    
			    echo "<tr><td><input type=\"hidden\" name=\"action\" value=\"".$row2["EmployeeID"]."\" /></td></tr>";				
			    echo "<tr><td><button type=\"submit\">View Full Profile</button></td>";
			    echo "<td><button type=\"submit\" style=\"width:150%\" formaction=\"editProfile.php\">";
			    echo "Edit Profile</button></td></tr>";
			    echo "</form>";
			    echo "</table>";
			    echo "<hr/>";				
			  }
			$i++;
		      }		    
		  }
		if( $i == 1 )
		  {
		    echo "<label style=\"color:white\">No results found!</label>";
		  }		    		
	      }
	  }
	else
	  {
	    echo "<label style=\"color:white\">No results found!</label>";
	  }
	break;
	case 7:
	$query = $retrieveName.$secondField."'";
	$res = mysql_query( $query );
	if( $res )
	  {
	    $row = mysql_fetch_array( $res );
	    if( $row["Fname"] != "" )
	      {
		echo "<table>";
		echo "<form method=\"get\" action=\"displayPro.php\" >";
		echo "<tr><td colspan=\"2\"><strong>Employee ID:</strong></td><td>".$secondField."</td></tr>";
		echo "<tr><td colspan=\"2\"><strong>First name:</strong></td><td>".$row["Fname"]."</td></tr>";
		echo "<tr><td colspan=\"2\"><strong>Middle name:</strong></td><td> ".$row["Mname"]."</td></tr>";
		echo "<tr><td colspan=\"2\"><strong>Last name:</strong></td><td>".$row["Lname"]."</td></tr>";			    
		echo "<tr><td><input type=\"hidden\" name=\"action\" value=\"".$secondField."\" /></td></tr>";				
		echo "<tr><td><button type=\"submit\">View Full Profile</button></td>";
		echo "<td><button type=\"submit\" style=\"width:150%\" formaction=\"editProfile.php\">";
		echo "Edit Profile</button></td></tr>";
		echo "</form>";
		echo "</table>";
		echo "<hr/>";						
	      }
	    else
	      {
		echo "<label style=\"color:white\">No results found!</label>";
	      }
	  }
	break;
	case 8:
	  $query = $retrieveDeptIDByName.$secondField."'";
	  $res = mysql_query( $query );
	  if( $res )
	    {
	      $row = mysql_fetch_array( $res );
	      if( $row["DeptID"] != "" )
		{
		  $query2 = $retrieveEmpByDeptID.$row["DeptID"]."'";
		  $res2 = mysql_query( $query2 );
		  if( $res2 )
		    {
		      $i = 1;
		      while( $row2 = mysql_fetch_array( $res2 ) )
			{
			  echo "<table>";
			  echo "<form method=\"get\" action=\"displayPro.php\" >";
			  echo "<tr><td colspan=\"2\"><strong>Employee ID:</strong></td><td>".$row2["EmployeeID"]."</td></tr>";
			  echo "<tr><td colspan=\"2\"><strong>First name:</strong></td><td>".$row2["Fname"]."</td></tr>";
			  echo "<tr><td colspan=\"2\"><strong>Middle name:</strong></td><td> ".$row2["Mname"]."</td></tr>";
			  echo "<tr><td colspan=\"2\"><strong>Last name:</strong></td><td>".$row2["Lname"]."</td></tr>";			    
			  echo "<tr><td><input type=\"hidden\" name=\"action\" value=\"".$row2["EmployeeID"]."\" /></td></tr>";				
			  echo "<tr><td><button type=\"submit\">View Full Profile</button></td>";
			  echo "<td><button type=\"submit\" style=\"width:150%\" formaction=\"editProfile.php\">";
			  echo "Edit Profile</button></td></tr>";
			  echo "</form>";
			  echo "</table>";
			  echo "<hr/>";						
			  $i++;
			}
		      if( $i == 1 )
			{
			  echo "<label style=\"color:white\">No results found!</label>";
			}				      
		    }
		}
	      else
		{
		  echo "<label style=\"color:white\">No results found!</label>";
		}		
	    }
	  break;
	case 9:
	  $query = $retrievePosIDByDesc.$secondField."'";
	  $res = mysql_query( $query );
	  if( $res )
	    {
	      $row = mysql_fetch_array( $res );
	      if( $row["PositionID"] != "" )
		{
		  $query2 = $retrieveEmpByPosID.$row["PositionID"]."'";
		  $res2 = mysql_query( $query2 );
		  if( $res2 )
		    {
		      $i = 1;
		      while( $row2 = mysql_fetch_array( $res2 ) )
			{
			  echo "<table>";
			  echo "<form method=\"get\" action=\"displayPro.php\" >";
			  echo "<tr><td colspan=\"2\"><strong>Employee ID:</strong></td><td>".$row2["EmployeeID"]."</td></tr>";
			  echo "<tr><td colspan=\"2\"><strong>First name:</strong></td><td>".$row2["Fname"]."</td></tr>";
			  echo "<tr><td colspan=\"2\"><strong>Middle name:</strong></td><td> ".$row2["Mname"]."</td></tr>";
			  echo "<tr><td colspan=\"2\"><strong>Last name:</strong></td><td>".$row2["Lname"]."</td></tr>";			    
			  echo "<tr><td><input type=\"hidden\" name=\"action\" value=\"".$row2["EmployeeID"]."\" /></td></tr>";				
			  echo "<tr><td><button type=\"submit\">View Full Profile</button></td>";
			  echo "<td><button type=\"submit\" style=\"width:150%\" formaction=\"editProfile.php\">";
			  echo "Edit Profile</button></td></tr>";
			  echo "</form>";
			  echo "</table>";
			  echo "<hr/>";						
			  $i++;
			}
		      if( $i == 1 )
			{
			  echo "<label style=\"color:white\">No results found!</label>";
			}				      		      
		    }
		}
	      else
		{
		  echo "<label style=\"color:white\">No results found!</label>";
		}
	    }
	  break;
	case 10:
	  $query = $retrieveOffIDByLoc.$secondField."'";
	  //echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"query : ".$query."\");}</script>";
	  $res = mysql_query( $query );
	  if( $res )
	    {
	      $row = mysql_fetch_array( $res );
	      if( $row["OfficeID"] != "" )
		{
		  $query2 = $retrieveEmpByOffID.$row["OfficeID"]."'";
		  //echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"query2 : ".$query2."\");}</script>";
		  $res2 = mysql_query( $query2 );
		  if( $res2 )
		    {
		      $i = 1;
		      while( $row2 = mysql_fetch_array( $res2 ) )
			{
			  echo "<table>";
			  echo "<form method=\"get\" action=\"displayPro.php\" >";
			  echo "<tr><td colspan=\"2\"><strong>Employee ID:</strong></td><td>".$row2["EmployeeID"]."</td></tr>";
			  echo "<tr><td colspan=\"2\"><strong>First name:</strong></td><td>".$row2["Fname"]."</td></tr>";
			  echo "<tr><td colspan=\"2\"><strong>Middle name:</strong></td><td> ".$row2["Mname"]."</td></tr>";
			  echo "<tr><td colspan=\"2\"><strong>Last name:</strong></td><td>".$row2["Lname"]."</td></tr>";			    
			  echo "<tr><td><input type=\"hidden\" name=\"action\" value=\"".$row2["EmployeeID"]."\" /></td></tr>";				
			  echo "<tr><td><button type=\"submit\">View Full Profile</button></td>";
			  echo "<td><button type=\"submit\" style=\"width:150%\" formaction=\"editProfile.php\">";
			  echo "Edit Profile</button></td></tr>";
			  echo "</form>";
			  echo "</table>";
			  echo "<hr/>";						
			  $i++;
			}
		      if( $i == 1 )
			{
			  echo "<label style=\"color:white\">No results found!</label>";
			}				      
		    }
		}
	      else
		{
		  echo "<label style=\"color:white\">No results found!</label>";
		}
		
	    }
	  break; 
	case 11:
	  $query = $retrieveEmpBySalaryLt.$secondField."'";
	  $res = mysql_query( $query );
	  if( $res )
	    {
	      $i = 1;
	      while( $row = mysql_fetch_array( $res ) )
		{
		  echo "<table>";
		  echo "<form method=\"get\" action=\"displayPro.php\" >";
		  echo "<tr><td colspan=\"2\"><strong>Employee ID:</strong></td><td>".$row["EmployeeID"]."</td></tr>";
		  echo "<tr><td colspan=\"2\"><strong>First name:</strong></td><td>".$row["Fname"]."</td></tr>";
		  echo "<tr><td colspan=\"2\"><strong>Middle name:</strong></td><td> ".$row["Mname"]."</td></tr>";
		  echo "<tr><td colspan=\"2\"><strong>Last name:</strong></td><td>".$row["Lname"]."</td></tr>";			    
		  echo "<tr><td><input type=\"hidden\" name=\"action\" value=\"".$row["EmployeeID"]."\" /></td></tr>";				
		  echo "<tr><td><button type=\"submit\">View Full Profile</button></td>";
		  echo "<td><button type=\"submit\" style=\"width:150%\" formaction=\"editProfile.php\">";
		  echo "Edit Profile</button></td></tr>";
		  echo "</form>";
		  echo "</table>";
		  echo "<hr/>";						
		  $i++;
		}
	      if( $i == 1 )
		{
		  echo "<label style=\"color:white\">No results found!</label>";
		}				      
	    }
	  else
	    {
	      echo "<label style=\"color:white\">No results found!</label>";
	    }
	  break;
	case 12:
	  $query = $retrieveEmpBySalaryEq.$secondField."'";
	  $res = mysql_query( $query );
	  if( $res )
	    {
	      $i = 1;
	      while( $row = mysql_fetch_array( $res ) )
		{
		  echo "<table>";
		  echo "<form method=\"get\" action=\"displayPro.php\" >";
		  echo "<tr><td colspan=\"2\"><strong>Employee ID:</strong></td><td>".$row["EmployeeID"]."</td></tr>";
		  echo "<tr><td colspan=\"2\"><strong>First name:</strong></td><td>".$row["Fname"]."</td></tr>";
		  echo "<tr><td colspan=\"2\"><strong>Middle name:</strong></td><td> ".$row["Mname"]."</td></tr>";
		  echo "<tr><td colspan=\"2\"><strong>Last name:</strong></td><td>".$row["Lname"]."</td></tr>";			    
		  echo "<tr><td><input type=\"hidden\" name=\"action\" value=\"".$row["EmployeeID"]."\" /></td></tr>";				
		  echo "<tr><td><button type=\"submit\">View Full Profile</button></td>";
		  echo "<td><button type=\"submit\" style=\"width:150%\" formaction=\"editProfile.php\">";
		  echo "Edit Profile</button></td></tr>";
		  echo "</form>";
		  echo "</table>";
		  echo "<hr/>";						
		  $i++;
		}
	      if( $i == 1 )
		{
		  echo "<label style=\"color:white\">No results found!</label>";
		}				      
	    }
	  else
	    {
	      echo "<label style=\"color:white\">No results found!</label>";
	    }
	  break;
	case 13:
	  $query = $retrieveEmpBySalaryGt.$secondField."'";
	  $res = mysql_query( $query );
	  if( $res )
	    {
	      $i = 1;
	      while( $row = mysql_fetch_array( $res ) )
		{
		  echo "<table>";
		  echo "<form method=\"get\" action=\"displayPro.php\" >";
		  echo "<tr><td colspan=\"2\"><strong>Employee ID:</strong></td><td>".$row["EmployeeID"]."</td></tr>";
		  echo "<tr><td colspan=\"2\"><strong>First name:</strong></td><td>".$row["Fname"]."</td></tr>";
		  echo "<tr><td colspan=\"2\"><strong>Middle name:</strong></td><td> ".$row["Mname"]."</td></tr>";
		  echo "<tr><td colspan=\"2\"><strong>Last name:</strong></td><td>".$row["Lname"]."</td></tr>";			    
		  echo "<tr><td><input type=\"hidden\" name=\"action\" value=\"".$row["EmployeeID"]."\" /></td></tr>";				
		  echo "<tr><td><button type=\"submit\">View Full Profile</button></td>";
		  echo "<td><button type=\"submit\" style=\"width:150%\" formaction=\"editProfile.php\">";
		  echo "Edit Profile</button></td></tr>";
		  echo "</form>";
		  echo "</table>";
		  echo "<hr/>";						
		  $i++;
		}
	      if( $i == 1 )
		{
		  echo "<label style=\"color:white\">No results found!</label>";
		}				      
	    }
	  else
	    {
	      echo "<label style=\"color:white\">No results found!</label>";
	    }
	  break;
	case 14:
	  $query = $retrieveEmpByLeavesLt.$secondField."'";
	  $res = mysql_query( $query );
	  if( $res )
	    {
	      $i = 1;
	      while( $row = mysql_fetch_array( $res ) )
		{
		  echo "<table>";
		  echo "<form method=\"get\" action=\"displayPro.php\" >";
		  echo "<tr><td colspan=\"2\"><strong>Employee ID:</strong></td><td>".$row["EmployeeID"]."</td></tr>";
		  echo "<tr><td colspan=\"2\"><strong>First name:</strong></td><td>".$row["Fname"]."</td></tr>";
		  echo "<tr><td colspan=\"2\"><strong>Middle name:</strong></td><td> ".$row["Mname"]."</td></tr>";
		  echo "<tr><td colspan=\"2\"><strong>Last name:</strong></td><td>".$row["Lname"]."</td></tr>";			    
		  echo "<tr><td><input type=\"hidden\" name=\"action\" value=\"".$row["EmployeeID"]."\" /></td></tr>";				
		  echo "<tr><td><button type=\"submit\">View Full Profile</button></td>";
		  echo "<td><button type=\"submit\" style=\"width:150%\" formaction=\"editProfile.php\">";
		  echo "Edit Profile</button></td></tr>";
		  echo "</form>";
		  echo "</table>";
		  echo "<hr/>";						
		  $i++;
		}
	      if( $i == 1 )
		{
		  echo "<label style=\"color:white\">No results found!</label>";
		}				      
	    }
	  else
	    {
	      echo "<label style=\"color:white\">No results found!</label>";
	    }
	  break;
	case 15:
	  $query = $retrieveEmpByLeavesEq.$secondField."'";
	  $res = mysql_query( $query );
	  if( $res )
	    {
	      $i = 1;
	      while( $row = mysql_fetch_array( $res ) )
		{
		  echo "<table>";
		  echo "<form method=\"get\" action=\"displayPro.php\" >";
		  echo "<tr><td colspan=\"2\"><strong>Employee ID:</strong></td><td>".$row["EmployeeID"]."</td></tr>";
		  echo "<tr><td colspan=\"2\"><strong>First name:</strong></td><td>".$row["Fname"]."</td></tr>";
		  echo "<tr><td colspan=\"2\"><strong>Middle name:</strong></td><td> ".$row["Mname"]."</td></tr>";
		  echo "<tr><td colspan=\"2\"><strong>Last name:</strong></td><td>".$row["Lname"]."</td></tr>";			    
		  echo "<tr><td><input type=\"hidden\" name=\"action\" value=\"".$row["EmployeeID"]."\" /></td></tr>";				
		  echo "<tr><td><button type=\"submit\">View Full Profile</button></td>";
		  echo "<td><button type=\"submit\" style=\"width:150%\" formaction=\"editProfile.php\">";
		  echo "Edit Profile</button></td></tr>";
		  echo "</form>";
		  echo "</table>";
		  echo "<hr/>";						
		  $i++;
		}
	      if( $i == 1 )
		{
		  echo "<label style=\"color:white\">No results found!</label>";
		}				      
	    }
	  else
	    {
	      echo "<label style=\"color:white\">No results found!</label>";
	    }
	  break;
	case 16:
	  $query = $retrieveEmpByLeavesGt.$secondField."'";
	  $res = mysql_query( $query );
	  if( $res )
	    {
	      $i = 1;
	      while( $row = mysql_fetch_array( $res ) )
		{
		  echo "<table>";
		  echo "<form method=\"get\" action=\"displayPro.php\" >";
		  echo "<tr><td colspan=\"2\"><strong>Employee ID:</strong></td><td>".$row["EmployeeID"]."</td></tr>";
		  echo "<tr><td colspan=\"2\"><strong>First name:</strong></td><td>".$row["Fname"]."</td></tr>";
		  echo "<tr><td colspan=\"2\"><strong>Middle name:</strong></td><td> ".$row["Mname"]."</td></tr>";
		  echo "<tr><td colspan=\"2\"><strong>Last name:</strong></td><td>".$row["Lname"]."</td></tr>";			    
		  echo "<tr><td><input type=\"hidden\" name=\"action\" value=\"".$row["EmployeeID"]."\" /></td></tr>";				
		  echo "<tr><td><button type=\"submit\">View Full Profile</button></td>";
		  echo "<td><button type=\"submit\" style=\"width:150%\" formaction=\"editProfile.php\">";
		  echo "Edit Profile</button></td></tr>";
		  echo "</form>";
		  echo "</table>";
		  echo "<hr/>";						
		  $i++;
		}
	      if( $i == 1 )
		{
		  echo "<label style=\"color:white\">No results found!</label>";
		}				      
	    }
	  else
	    {
	      echo "<label style=\"color:white\">No results found!</label>";
	    }
	  break;
	case 17:
	  $query = $retrieveEmpByHireDateLt.$secondField."'";
	  $res = mysql_query( $query );
	  if( $res )
	    {
	      $i = 1;
	      while( $row = mysql_fetch_array( $res ) )
		{
		  echo "<table>";
		  echo "<form method=\"get\" action=\"displayPro.php\" >";
		  echo "<tr><td colspan=\"2\"><strong>Employee ID:</strong></td><td>".$row["EmployeeID"]."</td></tr>";
		  echo "<tr><td colspan=\"2\"><strong>First name:</strong></td><td>".$row["Fname"]."</td></tr>";
		  echo "<tr><td colspan=\"2\"><strong>Middle name:</strong></td><td> ".$row["Mname"]."</td></tr>";
		  echo "<tr><td colspan=\"2\"><strong>Last name:</strong></td><td>".$row["Lname"]."</td></tr>";			    
		  echo "<tr><td><input type=\"hidden\" name=\"action\" value=\"".$row["EmployeeID"]."\" /></td></tr>";				
		  echo "<tr><td><button type=\"submit\">View Full Profile</button></td>";
		  echo "<td><button type=\"submit\" style=\"width:150%\" formaction=\"editProfile.php\">";
		  echo "Edit Profile</button></td></tr>";
		  echo "</form>";
		  echo "</table>";
		  echo "<hr/>";						
		  $i++;
		}
	      if( $i == 1 )
		{
		  echo "<label style=\"color:white\">No results found!</label>";
		}				      
	    }
	  else
	    {
	      echo "<label style=\"color:white\">No results found!</label>";
	    }
	  break;
	case 18:
	  $query = $retrieveEmpByHireDateEq.$secondField."'";
	  $res = mysql_query( $query );
	  if( $res )
	    {
	      $i = 1;
	      while( $row = mysql_fetch_array( $res ) )
		{
		  echo "<table>";
		  echo "<form method=\"get\" action=\"displayPro.php\" >";
		  echo "<tr><td colspan=\"2\"><strong>Employee ID:</strong></td><td>".$row["EmployeeID"]."</td></tr>";
		  echo "<tr><td colspan=\"2\"><strong>First name:</strong></td><td>".$row["Fname"]."</td></tr>";
		  echo "<tr><td colspan=\"2\"><strong>Middle name:</strong></td><td> ".$row["Mname"]."</td></tr>";
		  echo "<tr><td colspan=\"2\"><strong>Last name:</strong></td><td>".$row["Lname"]."</td></tr>";			    
		  echo "<tr><td><input type=\"hidden\" name=\"action\" value=\"".$row["EmployeeID"]."\" /></td></tr>";				
		  echo "<tr><td><button type=\"submit\">View Full Profile</button></td>";
		  echo "<td><button type=\"submit\" style=\"width:150%\" formaction=\"editProfile.php\">";
		  echo "Edit Profile</button></td></tr>";
		  echo "</form>";
		  echo "</table>";
		  echo "<hr/>";						
		  $i++;
		}
	      if( $i == 1 )
		{
		  echo "<label style=\"color:white\">No results found!</label>";
		}				      
	    }
	  else
	    {
	      echo "<label style=\"color:white\">No results found!</label>";
	    }
	  break;
	case 19:
	  $query = $retrieveEmpByHireDateGt.$secondField."'";
	  $res = mysql_query( $query );
	  if( $res )
	    {
	      $i = 1;
	      while( $row = mysql_fetch_array( $res ) )
		{
		  echo "<table>";
		  echo "<form method=\"get\" action=\"displayPro.php\" >";
		  echo "<tr><td colspan=\"2\"><strong>Employee ID:</strong></td><td>".$row["EmployeeID"]."</td></tr>";
		  echo "<tr><td colspan=\"2\"><strong>First name:</strong></td><td>".$row["Fname"]."</td></tr>";
		  echo "<tr><td colspan=\"2\"><strong>Middle name:</strong></td><td> ".$row["Mname"]."</td></tr>";
		  echo "<tr><td colspan=\"2\"><strong>Last name:</strong></td><td>".$row["Lname"]."</td></tr>";			    
		  echo "<tr><td><input type=\"hidden\" name=\"action\" value=\"".$row["EmployeeID"]."\" /></td></tr>";				
		  echo "<tr><td><button type=\"submit\">View Full Profile</button></td>";
		  echo "<td><button type=\"submit\" style=\"width:150%\" formaction=\"editProfile.php\">";
		  echo "Edit Profile</button></td></tr>";
		  echo "</form>";
		  echo "</table>";
		  echo "<hr/>";						
		  $i++;
		}
	      if( $i == 1 )
		{
		  echo "<label style=\"color:white\">No results found!</label>";
		}				      
	    }
	  else
	    {
	      echo "<label style=\"color:white\">No results found!</label>";
	    }
	  break;
	case 20:
	  $query = $retrieveEmpMaxLeaves;
	  $res = mysql_query( $query );
	  if( $res )
	    {
	      $i = 1;
	      while( $row = mysql_fetch_array( $res ) )
		{
		  echo "<table>";
		  echo "<form method=\"get\" action=\"displayPro.php\" >";
		  echo "<tr><td colspan=\"2\"><strong>Employee ID:</strong></td><td>".$row["EmployeeID"]."</td></tr>";
		  echo "<tr><td colspan=\"2\"><strong>First name:</strong></td><td>".$row["Fname"]."</td></tr>";
		  echo "<tr><td colspan=\"2\"><strong>Middle name:</strong></td><td> ".$row["Mname"]."</td></tr>";
		  echo "<tr><td colspan=\"2\"><strong>Last name:</strong></td><td>".$row["Lname"]."</td></tr>";
		  echo "<tr><td colspan=\"2\"><strong>Number of leaves</strong></td><td>".$row["Leaves"]."</td></tr>";
		  echo "<tr><td><input type=\"hidden\" name=\"action\" value=\"".$row["EmployeeID"]."\" /></td></tr>";				
		  echo "<tr><td><button type=\"submit\">View Full Profile</button></td>";
		  echo "<td><button type=\"submit\" style=\"width:150%\" formaction=\"editProfile.php\">";
		  echo "Edit Profile</button></td></tr>";
		  echo "</form>";
		  echo "</table>";
		  echo "<hr/>";						
		  $i++;
		}
	      if( $i == 1 )
		{
		  echo "<label style=\"color:white\">No results found!</label>";
		}				      
	    }
	  else
	    {
	      echo "<label style=\"color:white\">No results found!</label>";
	    }
	  break;
	default:
	break;
	}	
    }      
?>
</body>
</html>
