<?php
session_start();
unset($_SESSION["id"]);
$_SESSION["login"] = "false";
$expire = time() - 3600;
setcookie("id","",$expire );
setcookie("access","",$expire);
setcookie("login","false",$expire);
setcookie("sup","false",$expire);
unset($_COOKIE["id"]);
unset($_COOKIE["access"]);
unset($_COOKIE["login"]);
unset($_COOKIE["sup"]);
session_destroy();
header("Location: login.php");
?>