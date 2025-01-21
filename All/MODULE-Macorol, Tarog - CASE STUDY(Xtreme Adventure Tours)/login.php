<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "booking_system";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function sanitizeInput($input) {
    global $conn;
    return mysqli_real_escape_string($conn, trim($input));
}

function displayErrorMessage($errorCode) {
    switch ($errorCode) {
        case "invalid":
            return "Invalid credentials. Please try again.";
        default:
            return "An unexpected error occurred.";
    }
}

$errorMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = sanitizeInput($_POST["username"]);
    $password = sanitizeInput($_POST["password"]);

    
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        header("Location: adminpage.php");
        exit();
    } else {
        $errorMessage = displayErrorMessage("invalid");
    }
}
$conn->close();
?>
