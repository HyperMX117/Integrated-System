<?php
// connect.php (Example file where you connect to the DB)
require_once 'db_config.php'; // Adjust path if needed
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $code = $_POST['code'];
    $newPassword = $_POST['new_password'];

    $sql = "SELECT * FROM users WHERE email = '$email' AND reset_code = '$code'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $sqlUpdate = "UPDATE users SET password = '$newPassword', reset_code = NULL WHERE email = '$email'";
        $resultUpdate = $conn->query($sqlUpdate);

        if ($resultUpdate) {
            echo 'Password reset successfully';

            header("Location: index.php");
            exit();
        } else {
            echo 'Error updating the database';
        }
    } else {
        echo 'Invalid reset code';
    }
}

$conn->close();
?>
