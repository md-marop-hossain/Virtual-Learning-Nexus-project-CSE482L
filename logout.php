<?php
// Start the session to work with session variables
session_start();

// Destroy all data associated with the current session
session_destroy();

// Redirect the user to the index.php page using JavaScript
echo "<script> location.href='index.php'; </script>";
?>