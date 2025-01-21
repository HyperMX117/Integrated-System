<?php
// db_config.php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "palenzueladb";

//Optionally define a function to return the connection parameters as an array
function getDbConfig() {
    return [
        'servername' => "localhost",
        'username' => "root",
        'password' => "",
        'dbname' => "palenzueladb"
    ];
}
?>