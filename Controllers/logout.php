<?php
//Used with permission from https://www.tutorialrepublic.com/php-tutorial/php-mysql-login-system.php
	//https://www.tutorialrepublic.com/terms-of-use.php
// Initialize the session
session_start();
 
// Unset all of the session variables
$_SESSION = array();
 
// Destroy the session.
session_destroy();
 
// Redirect to login page
header("location: login.php");
exit;
?>