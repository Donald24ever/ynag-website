<?php
session_start();
//set session data to an empty array
$_SESSION = array();

//Destroy the session variables
session_destroy();
header('location: login.php');exit();
?>