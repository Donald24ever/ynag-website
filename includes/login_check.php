<?php
session_start();
//echo $_SESSION["user_id"].'.....'. $_SESSION["user_password"].'.....'. $_SESSION["user_username"]; exit();
include_once("db.php");
if(isset($_SESSION["user_id"])&& isset($_SESSION["user_password"]) && isset($_SESSION["user_username"])){
	$user_id = preg_replace('#[^0-9]i#', '', $_SESSION['user_id']);
	$user_username = preg_replace('#[^A-Za-z0-9@._-]#i', '', $_SESSION['user_username']);
	$user_password = preg_replace('#[^A-Za-z0-9]#i', '', $_SESSION['user_password']);
	
$sql = "SELECT first_name,last_name FROM users WHERE id='$user_id' AND user_name='$user_username' AND password='$user_password' LIMIT 1";
$user_query = mysqli_query($con, $sql) or die(mysqli_error($con));
$numrows=mysqli_num_rows($user_query);
if($numrows<1){header('location: logout.php'); exit();}
	// Fetch the user row from the query above
while ($row = mysqli_fetch_array($user_query)) {
		$userFirstname = $row[0];
		$userLastname = $row[1];		
}		
	}
	else{header('location: logout.php'); exit();}
	

?>