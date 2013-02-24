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
  }

if( isset($_POST["action2"] ) )
  {
	//echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Action2 set.\");}</script>";
	
    $fname = $_POST["firstname"];
    //echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"fname".$fname."\");}</script>";
    if( $fname != $_SESSION["preFname"] )
      {
	$query = "UPDATE EMPLOYEE SET Fname='".$fname."' WHERE EmployeeID='".$_SESSION["ID"]."'";
	//echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"query".$query."\");}</script>";
	$res = mysql_query( $query );
	if( !$res )
	  {
	    die("<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Error in updating first name.\");}</script>");
	  }
      }
	
    //    echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"fname :".$fname."\");}</script>";
	
    $mname = $_POST["middlename"];
    //echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"mname :".$mname."\");}</script>";
    if( $mname != $_SESSION["preMname"] )
      {
	$query = "UPDATE EMPLOYEE SET Mname='".$mname."' WHERE EmployeeID='".$_SESSION["ID"]."'";
	//echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"query".$query."\");}</script>";
	$res = mysql_query( $query );
	if( !$res )
	  {
	    die("<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Error in updating middle name.\");}</script>");
	  }
      }
	
    //    echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"mname :".$mname."\");}</script>";
    
    $lname = $_POST["lastname"];
    if( $lname != $_SESSION["preLname"] )
      {
	$query = "UPDATE EMPLOYEE SET Lname='".$lname."' WHERE EmployeeID='".$_SESSION["ID"]."'";
	//echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"query".$query."\");}</script>";
	$res = mysql_query( $query );
	if( !$res )
	  {
	    die("<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Error in updating last name.\");}</script>");
	  }
      }
	//    //echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"lname :".$lname."\");}</script>";

    $resAddress = $_POST["resAddress"];
    //echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"resAddress :".$resAddress."\");}</script>";
    if( $_SESSION["preResAddress"] != $resAddress )
      {
	$query = "UPDATE EMPLOYEE SET ResAddress='".$resAddress."' WHERE EmployeeID='".$_SESSION["ID"]."'";
	//echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"query".$query."\");}</script>";
	$res = mysql_query( $query );
	if( !$res )
	  {
	    die("<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Error in updating residential address.\");}</script>");
	  }
      }
	
    $permAddress = $_POST["permAddress"];
    //echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"permAddress :".$permAddress."\");}</script>";
    if( $_SESSION["prePermAddress"] != $permAddress )
      {
	$query = "UPDATE EMPLOYEE SET PermAddress='".$permAddress."' WHERE EmployeeID='".$_SESSION["ID"]."'";
	//echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"query".$query."\");}</script>";
	$res = mysql_query( $query );
	if( !$res )
	  {
	    die("<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Error in updating permanent address.\");}</script>");
	  }
      }
	
    $mobNo = $_POST["mobNo"];
    //echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"mobNo :".$mobNo."\");}</script>";
    if( $_SESSION["preMobNo"] != $mobNo )
      {
	$query = "UPDATE EMPLOYEE SET MobileNumber='".$mobNo."' WHERE EmployeeID='".$_SESSION["ID"]."'";
	//echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"query".$query."\");}</script>";
	$res = mysql_query( $query );
	if( !$res )
	  {
	    die("<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Error in updating mobile number.\");}</script>");
	  }
      }
	    
    $email = $_POST["email"];
    if( $_SESSION["preEmail"] != $email )
      {
	$query = "UPDATE EMPLOYEE SET Email='".$email."' WHERE EmployeeID='".$_SESSION["ID"]."'";
	//echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"query".$query."\");}</script>";
	$res = mysql_query( $query );
	if( !$res )
	  {
	    die("<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Error in updating email.\");}</script>");
	  }
      }
    //echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"email :".$email."\");}</script>";
	
    $mstatus = $_POST["mStatus"];
    if( $mstatus != "...")
      {
	$query = "UPDATE EMPLOYEE SET mstatus='".$mstatus."' WHERE EmployeeID='".$_SESSION["ID"]."'";
	//echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"query".$query."\");}</script>";
	$res = mysql_query( $query );
	if( !$res )
	  {
	    die("<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Error in updating marital status.\");}</script>");
	  }
      }
	
    //echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"mstatus :".$mstatus."\");}</script>";
    
    //echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"fname :".$fname."\nmname : ".$mname."\nlname : ".$lname."\ndobmonth:".$dobmonth."\ndobday:".$dobday."\ndobyear:".$dobyear."\ndob :".$dob."\n\");}</script>";
    
    //echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"$post[passport]".$_POST["empPassport"]."\");}</script>";
	
    $passport = 0;
    if( isset( $_POST["empPassport"] ) || $_POST["empPassport"] != $_SESSION["prePassport"] )
      {
	$pass = $_POST["empPassport"];
	$pass = strtoupper( $pass );
	$query = "";
	if( $pass == "ON" )
	  $query = "UPDATE EMPLOYEE SET Passport='1' WHERE EmployeeID='".$_SESSION["ID"]."'";
	else
	  $query = "UPDATE EMPLOYEE SET Passport='0' WHERE EmployeeID='".$_SESSION["ID"]."'";
	//echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"query".$query."\");}</script>";
	$res = mysql_query( $query );	    
	if( !$res )
	  {
	    die("<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Error in updating passport:".mysql_error()."\");}</script>");
	  }
      }
	
    $dlicense = 0;
    //echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"$post[passport]".$_POST["empDrivingL"]."\");}</script>";
    if( isset( $_POST["empDrivingL"] ) || $_POST["empDrivingL"] != $_SESSION["preDl"] )
      {
	$dl = $_POST["empDrivingL"];
	$dl = strtoupper( $dl );
	$query = "";
	if( $dl == "ON" )
	  $query = "UPDATE EMPLOYEE SET DrivingLicense='1' WHERE EmployeeID='".$_SESSION["ID"]."'";
	else
	  $query = "UPDATE EMPLOYEE SET DrivingLicense='0' WHERE EmployeeID='".$_SESSION["ID"]."'";
	
	//echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"query".$query."\");}</script>";
	$res = mysql_query( $query );
	if( !$res )
	  {
	    die("<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Error in updating passport:".mysql_error()."\");}</script>");
	  }
      }
	
    $empDep = $_POST["empDep"];
    if( $empDep != $_SESSION["preDept"] )
      {
	$query = $retrieveDeptIDByName.$empDep."'";
	//echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"query".$query."\");}</script>";
	$res = mysql_query( $query );
	if( $res )
	  {
	    $row = mysql_fetch_array( $res );
	    if( $row["DeptID"] != "" )
	      {
		$query = "UPDATE EMPLOYEE SET DeptID='".$row["DeptID"]."' WHERE EmployeeID='".$_SESSION["ID"]."'";
		//echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"query".$query."\");}</script>";
		$res = mysql_query( $query );
		if( !$res )
		  {
		    die("<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Error in updating department:".mysql_error()."\");}</script>");
		  }
	      }
	  }		
      }

    if( isset( $_POST["manager"] ) || $_SESSION["preManager"] != $_POST["manager"] )
      {
	$manager = $_POST["manager"];
	$manager = strtoupper( $manager );
	if( $manager == "ON" )
	  {
	    $isManager = 1;
	    $manageDep = $_POST["managerDept"];	
	    $query = $retrieveDeptIDByName.$manageDep."'";
	    //echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"query".$query."\");}</script>";
	    $res = mysql_query( $query );
	    if( $res )
	      {
		$row = mysql_fetch_array( $res );
		echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"row[DeptID] = ".$row["DeptID"]."\");}</script>";
		$query1 = "SELECT * FROM MANAGERS WHERE DeptID='".$row["DeptID"]."'";
		echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"query1 = ".$query1."\");}</script>";
		$res1 = mysql_query( $query1 );
		if( $res1 )
		  {
		    $row1 = mysql_fetch_array( $res1 );
		    echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"row1[DeptID] = ".$row1["DeptID"]."\");}</script>";
		    if( $row1["DeptID"] == "" )
		      {
			$query2 = "INSERT INTO MANAGERS VALUES('".$row["DeptID"]."','".$_SESSION["ID"]."')";
			echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"query2 = ".$query2."\");}</script>";
			//echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"query".$query."\");}</script>";
			$res2 = mysql_query( $query2 );
			if( !$res2 )
			  {
			    die("<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Error in inserting manager:".mysql_error()."\");}</script>");
			  }
		      }
		    else
		      {
			echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Department ".$manageDep." already have a manager.\");}</script>";
		      }
		  }
	      }
	  }
	else
	  {
	    $query = "DELETE FROM MANAGERS WHERE ManagerID='".$_SESSION["ID"]."'";
	    //echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"query".$query."\");}</script>";
	    $res = mysql_query( $query );
	    if( !$res )
	      {
		die("<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Error in deleting manager:".mysql_error()."\");}</script>");
	      }
	  }
      }  

    $position = $_POST["empPos"];
    if( $_SESSION["prePos"] != $position )
      {
	$query = $retrievePosIDByDesc.$position."'";
	//echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"query".$query."\");}</script>";
	$res = mysql_query( $query );
	if( $res )
	  {
	    $row = mysql_fetch_array( $res );
	    $query = "UPDATE EMPLOYEE SET PositionID='".$row["PositionID"]."' WHERE EmployeeID='".$_SESSION["ID"]."'";
	    //echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"query".$query."\");}</script>";
	    $res = mysql_query( $query );
	    if( !$res )
	      {
		die("<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Error in updating position :".mysql_error()."\");}</script>");
	      }
	  }
      }
	
    $officeId = intval( $_POST["empOffice"] );
    //echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"officeId :".$officeId."\");}</script>";
    if( $officeId != $_SESSION["preOffId"] )
      {
	$query = "UPDATE EMPLOYEE SET OfficeID='".$officeId."' WHERE EmployeeID='".$_SESSION["ID"]."'";
	//echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"query".$query."\");}</script>";
	$res = mysql_query( $query );
	if( !$res )
	  {
	    die("<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Error in updating office :".mysql_error()."\");}</script>");
	  }
      }
    
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
	    $query = "UPDATE EMPLOYEE SET SupervisorID='".$supervisorId."' WHERE EmployeeID='".$_SESSION["ID"]."'";
	    $res = mysql_query( $query );
	    if( !$res )
	      {
		die("<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Error in updating supervisor ".mysql_error()."\");}</script>");
	      }
	  }
	else
	  {
	    $query = "UPDATE EMPLOYEE SET SupervisorID='' WHERE EmployeeID='".$_SESSION["ID"]."'";
	    $res = mysql_query( $query );
	    if( !$res )
	      {
		die("<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Error in updating supervisor ".mysql_error()."\");}</script>");		
	      }
	  }
      }

    $salary = $_POST["salary"];
    if( $salary != $_SESSION["preSalary"] )
      {
	$query = "UPDATE EMPLOYEE SET Salary='".$salary."' WHERE EmployeeID='".$_SESSION["ID"]."'";
	//echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"query".$query."\");}</script>";
	$res = mysql_query( $query );
	if( !$res )
	  {
	    die("<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Error in updating salary ".mysql_error()."\");}</script>");
	  }
      }
    
    //echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"salary :".$salary."\");}</script>";
    
    $lcount = 0;
    if( $_POST["lcount"] != "" )
      $lcount = $_POST["lcount"];
    
    if( $lcount != $_SESSION["preLeaveCount"] )
      {
	$query = "UPDATE EMPLOYEE SET Leaves='".$lcount."' WHERE EmployeeID='".$_SESSION["ID"]."'";
	//echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"query".$query."\");}</script>";
	$res = mysql_query( $query );
	if( !$res )
	  {
	    die("<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Error in updating leaves ".mysql_error()."\");}</script>");
	  }
      }
	
    //echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"lcount :".$lcount."\");}</script>";
	
    $promCount = $_POST["promCount"];
    if( $promCount != $_SESSION["prePromCount"] )
      {
	$query = "UPDATE EMPLOYEE SET Promotions='".$promCount."' WHERE EmployeeID='".$_SESSION["ID"]."'";
	//echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"query".$query."\");}</script>";
	$res = mysql_query( $query );
	if( !$res )
	  {
	    die("<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Error in updating promotions ".mysql_error()."\");}</script>");
	  }
      }
    //echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"promCount :".$promCount."\");}</script>";
	
    $access = 0;
    if( isset( $_POST["accessGiven"] ) )
      {
	$accessGiven = $_POST["accessGiven"];
	$accessGiven = strtoupper( $accessGiven );
	//echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"accessGiven :".$accessGiven."\");}</script>";
	
	$query = "";
	if( $accessGiven == "ON" )
	  {
	    $query = "UPDATE USERS SET Access='1' WHERE ID='".$_SESSION["ID"]."'";
	  }
	else
	  {
	    $query = "UPDATE USERS SET Access='0' WHERE ID='".$_SESSION["ID"]."'";	    
	  }
	
	//echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"query".$query."\");}</script>";
	$res = mysql_query( $query );
	if( !$res )
	  {
	    die ("<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"Error in updating Access :".mysql_error()."\");}</script>");
	  }
      }
    //echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"access :".$access."\");}</script>";
	
    $langW = array();
    $langWLen = 0;
    
    for( $i = $_SESSION["langWCount"], $j = 1; $i < count( $_POST ); $i++, $j++ )
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
	
    for( $i = $_SESSION["langSCount"], $j = 1; $i < count( $_POST ); $i++, $j++ )
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

    $quals = array();
    $qualYr = array();
    $institute = array();
    $board = array();
    $qualLen = 0;
	
    /*
      echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"before keys().\");}</script>";
      
      $keys = array_keys( $_POST );
      $txt = "";
	  
      for( $i = 0; $i < count( $_POST ); $i++ )
      {
      echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"keys[ = ".$i."]= ".$keys[ $i ]."\");}</script>";
      $txt = $txt."\n"."keys[ ".$i."] = ".$keys[ $i ]."\n";
      if( $i % 5 == 0 )
      {
      echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"txt = ".$txt."\");}</script>";
      $txt = "";
      }
      }
    */
    
    for( $i = $_SESSION["empQualCount"], $j = 1; $i < count( $_POST ); $i++, $j++ )
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
		//echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"quals[ ".($qualLen - 1)." ] = ".$quals[ $qualLen - 1 ]."\");}</script>";
		//echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"qualYr[ ".($qualLen - 1)." ] = ".$qualYr[ $qualLen - 1 ]."\");}</script>";
		//echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"board[ ".($qualLen - 1)." ] = ".$board[ $qualLen - 1 ]."\");}</script>";
		//echo"<script type=\"text/javascript\">try { throw \"err\" } catch(err) { alert(\"institute[ ".( $qualLen - 1)." ] = ".$institute[ $qualLen - 1 ]."\");}</script>";  
	      }	    
	  }	
      }
	    
    $achs = array();
    $achYr = array();
    $achLen = 0;
    
    for( $i = $_SESSION["empAchCount"], $j = 1; $i < count( $_POST ); $i++, $j++ )
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
    
    for( $i = $_SESSION["empSkillCount"], $j = 1; $i < count( $_POST ); $i++, $j++ )
      {	
	$key = "empSkill".$j;
	if( array_key_exists( $key, $_POST ) )
	  {
	    if( $_POST[ $key ] != "..." )
	      {	      
		$skill[ $skillLen ] = $_POST[ $key ];
		$skillLen++;
		//echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"skill[ ".( $skillLen - 1)." ] = ".$skill[ $skillLen - 1 ]."\");}</script>";
	      }	    
	  }	
      }

    $dFname = array();
    $dMname = array();
    $dLname = array();
    $dDob = array();
    $dRelation = array();
    $depLen = 0;
	
    for( $i = $_SESSION["empDepCount"], $j = 1; $i < count( $_POST ); $i++, $j++ )
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


    $isManager = 0;
    $manager = "";
    $manageDep = "";    
    
    
    //echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"manageDep :".$manageDep."\");}</script>";
	
    //echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"position :".$position."\");}</script>";

    //echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"supervisorId :".$supervisorId."\");}</script>";
    
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
		
		$query = $retrieveLangWID.$langID."'";
		$res = mysql_query( $query );
		if( $res )
		  {
		    $row = mysql_fetch_array( $res );
		    if( $row["LangID"] != $langID )
		      {
			$query = "INSERT INTO LANGKNOWNW VALUES('".$empId."','".$langID."')";		    
			//		echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"query :".$query."\");}</script>";
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
		
		$query = $retrieveLangSID.$langID."'";
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
		$query = $retrieveQualIDDegree.$qualID."'";
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
	$_SESSION["ID"] = "";
	if( $res )
	  {
	    $row = mysql_fetch_array( $res );
	    if( $row["MAX(AchievementID)"] == "" || $row["MAX(AchievementID)"] == 0 )
	      {
		$_SESSION["ID"] = 1;
	      }
	    else
	      {
		$_SESSION["ID"] = $row["MAX(AchievementID)"] + 1;
	      }
	  }
	
	$query = "INSERT INTO ACHIEVEMENTS VALUES('".$empId."','".$_SESSION["ID"]."','".$achs[$i]."','".$achYr[$i]."')";		    
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
		$query = $retrieveSkillID.$qualID."'";
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
			    //echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"error in inserting skill :".mysql_error()."\");}</script>";
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
	$_SESSION["ID"] = "";
	if( $res )
	  {
	    $row = mysql_fetch_array( $res );
	    if( $row["MAX(DependentID)"] == "" || $row["MAX(DependentID)"] == 0 )
	      {
		$_SESSION["ID"] = 1;
	      }
	    else
	      {
		$_SESSION["ID"] = $row["MAX(DependentID)"] + 1;
	      }
	  }

	$query = "INSERT INTO DEPENDENTS VALUES('".$empId."','".$_SESSION["ID"]."','".$dFname[$i]."','".$dMname[$i]."','".$dLname[$i]."','".$dDob[$i]."','".$dRelation[$i]."')";		    
	//		echo "<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"query :".$query."\");}</script>";
	$res = mysql_query( $query );
	if( !$res )
	  {			
	    die("<script type=\"text/javascript\"> try { throw \"err\" } catch(err) { alert(\"error in inserting dependents :".mysql_error()."\");}</script>");
	  }			
      }
    
    header("Location: viewEmployees.php");
  }
?>