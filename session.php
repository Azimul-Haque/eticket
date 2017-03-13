<charset="utf-8">
<?php
session_start();
require("config.php");
if(isset($_SESSION["username"])){
    $username = $_SESSION["username"];
	$email = $_SESSION["email"];
	$role = $_SESSION["role"];
	$flag = "true";
	//echo "session is working!";
}else{
	$flag = "false";
	//echo "session not working!";
}

//echo "Username: from the session! [will be ommited soon...]";
//echo $Name;
?>