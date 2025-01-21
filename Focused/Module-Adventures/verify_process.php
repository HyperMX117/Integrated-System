<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $enteredCode = $_POST["verification_code"];
    $expectedCode = $_SESSION["verification_code"];

    if ($enteredCode == $expectedCode) {

        $userData = $_SESSION["user_data"];

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "booking_system";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $fname = $userData['fname'];
        $lname = $userData['lname'];
        $username = $userData['username'];
        $email = $userData['email'];
        $password = $userData['password'];

        $sql = "INSERT INTO users (fname, lname, username, email, password) VALUES ('$fname', '$lname', '$username', '$email', '$password')";

        if ($conn->query($sql) === TRUE) {
            echo "Registration successful!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        session_unset();
        session_destroy();
    } else {
        echo "Verification failed!";
    }
} else {
    echo "Invalid request method!";
}
?>
