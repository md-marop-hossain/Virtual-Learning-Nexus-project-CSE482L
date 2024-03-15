<?php
// Database connection parameters
$db_host = "localhost"; // Hostname where the database is located
$db_user = "root"; // Username for accessing the database
$db_password = ""; // Password for the database user
$db_name = "ims_db"; // Name of the database to connect to

// Create a new MySQLi connection object
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check if the connection was successful
if($conn->connect_error) {
    // If connection fails, output an error message and terminate the script
    die("Connection failed: " . $conn->connect_error);
} 
// else {
//     // If connection is successful (optional)
//     echo "Connected successfully";
// }
?>