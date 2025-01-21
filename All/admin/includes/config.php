<?php
// Database connection details
$dbuser = "root";
$dbpass = "";
$host = "localhost";
$db = "integrateddb";

// Create a new connection to the database using MySQLi
$mysqli = new mysqli($host, $dbuser, $dbpass, $db);

// Check if the connection was successful
if ($mysqli->connect_error) {
    // Output error and terminate the script
    die("Connection failed: " . $mysqli->connect_error);
}

// Optionally, set the character set for the connection
if (!$mysqli->set_charset("utf8")) {
    // Output error if setting the charset fails
    die("Error loading character set utf8: " . $mysqli->error);
}
?>
