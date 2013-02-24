<?php
session_start();
if(isset($_SESSION['login']) && $_SESSION['login']=="true")
{
  $fh = fopen("authorisedpage1.php","r");
  if( !$fh )
    {
      echo "<script type=\"text/javascript\">try { throw \"err\";} catch(err) { alert(\"".$fh."\");}";
    }
  $file=file_get_contents("authorisedpage1.php");
  echo $file;
  //  header("Location: authorisedpage1.php");
}
else
  header("Location: login.php");
?>
