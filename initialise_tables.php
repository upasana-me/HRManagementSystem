<?php

include_once "connection.php";
include_once "create_table_queries.php";
include_once "queries.php";

echo "$con<br/>";
$res = mysql_query( $showTables, $con );
echo "$res<br/>";
if( !$res )
  {
    die ("Error in Show tables:".mysql_error( $con )."<br/>");	  
  }

$row = mysql_fetch_array( $res );

$result = $row[0];
$result = strtoupper($result);

if( $result != "EMPLOYEE" )	
  {
    $res = mysql_query( $createPositions, $con );
    if( !$res )
      {
	die ("Erro in creating Positions:".mysql_error( $con )."<br/>");
      }

    $res = mysql_query( $createDepartment, $con );
    if( !$res )
      {
	die("Error in creating Department:".mysql_error( $con )."<br/>");
      }
	    
    $res = mysql_query( $createQualification, $con );
    if( !$res )
      {
	die("Error in creating Qualification:".mysql_error( $con )."<br />");
      }
	      
    $res = mysql_query( $createCompany, $con );
    if( !$res )
      {
	die("Error in creatinf Company:".mysql_error( $con )."<br />");
      }
	    
    $res = mysql_query( $createOffices, $con );
    if( !$res )
      {
	die("Error in creating Offices:".mysql_error( $con )."<br/>");
      }
    
    $res = mysql_query( $createLanguages, $con );
    if( !$res )
      {
	die("Error in creating Languages:".mysql_error( $con )."<br/>");
      }

    $res = mysql_query( $createSkills, $con );
    if( !$res )
      {
	die("Error in creating Skills:".mysql_error( $con )."<br/>");
      }

    $res = mysql_query( $createEmployee, $con );
    if( !$res )
      {
	die("Error in creating Employee:".mysql_error( $con )."<br/>");
      }
    
    $res = mysql_query( $createAchievements, $con );
    if( !$res )
      {
	die("Error in creating Achievements:".mysql_error( $con )."<br/>");
      }
	  
    $res = mysql_query( $createDegrees, $con );
    if( !$res )
      {
	die("Error in creating Degrees:".mysql_error( $con )."<br/>");
      }
    
    $res = mysql_query( $createManagers, $con );
    if( !$res )
      {
	die("Error in creating Managers:".mysql_error( $con )."<br/>");
      }
 
    $res = mysql_query( $createDependents, $con );
    if( !$res )
      {
	die("Error in creating Dependents:".mysql_error( $con )."<br/>");
      }

    $res = mysql_query( $createLangKnownW, $con );
    if( !$res )
      {
	die("Error in creating LangKnownW :".mysql_error( $con )."<br/>");
      }

    $res = mysql_query( $createLangKnownS, $con );
    if( !$res )
      {
	die("Error in creating LangKnownS:".mysql_error( $con )."<br/>");
      }

    $res = mysql_query( $createSkillSet, $con );
    if( !$res )
      {
	die("Error in creating SkillSet:".mysql_error( $con )."<br/>");
      }

    $res = mysql_query( $createUsers, $con );
    if( !$res )
      {
	die("Error in creating Users".mysql_error( $con )."<br/>");		
      }

    $res = mysql_query( $createEmpMessages, $con );
    if( !$res )
      {
	die("Error in creating EmpMessages:".mysql_error( $con )."<br/>");		
      }

    create_1st_user();
  }

function create_1st_user()
{
  include "connection.php";
  $username = "admins";
  $password = "letmelogin";

  echo "username = $username, password = $password\n";
  $salt = hash('sha256', uniqid(mt_rand(), true) . 'something random' . strtolower($username));
 
  $hash = $salt . $password;
 
  for ( $i = 0; $i < 100000; $i ++ )
    {
      $hash = hash('sha256', $hash);
    }
 
  $hash = $salt . $hash;
 
  $query = "INSERT INTO USERS VALUES('".$username."','0','".$hash."','1');";
  echo "<br/>$query<br/>";

  $res1 = mysql_query( $query, $res );
  if( !$res1 )
    {
      die("Error in Insert admin:".mysql_error( $con )."<br/>");
    }
}      

?>
