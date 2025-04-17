<?php
// Start or resume the session
session_start();

// Destroy the user session
session_destroy();

// Redirect the user to the login page
header("Location: ../content/signin.php"); 
exit;
?>
