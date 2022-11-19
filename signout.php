<?php
//Signout page

session_start(); 
$_SESSION = array(); //Unsetting Session

header("Location: login.php"); 
?>