<?php
require_once("includes/config.php");

if (!empty($_POST["emailid"])) {
    $email = $_POST["emailid"];
    if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        echo "error : You did not enter a valid email.";
    } else {
        $query = "SELECT count(*) FROM userRegistration WHERE email=?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('s', $email);
        $stmt->execute(); 
        $stmt->bind_result($count); 
        $stmt->fetch(); 
        $stmt->close(); 

        if ($count > 0) {
            echo "<span style='color:red'> Email already exists.</span>";
        } else {
            echo "<span style='color:green'> Email available for registration.</span>";
        }
    }
}

if (!empty($_POST["oldpassword"])) {
    $pass = $_POST["oldpassword"];
    $query = "SELECT password FROM userRegistration WHERE password=?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('s', $pass);
    $stmt->execute(); 
    $stmt->bind_result($fetched_password); 
    $stmt->fetch(); 
    $stmt->close(); 

    if ($fetched_password == $pass) {
        echo "<span style='color:green'> Password matched.</span>";
    } else {
        echo "<span style='color:red'> Password not matched.</span>";
    }
}

if (!empty($_POST["roomno"])) {
    $roomno = $_POST["roomno"];
    $query = "SELECT count(*) FROM registration WHERE roomno=?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('i', $roomno);
    $stmt->execute(); 
    $stmt->bind_result($count); 
    $stmt->fetch(); 
    $stmt->close(); 

    if ($count > 0) {
        echo "<span style='color:red'>$count. Seats already full.</span>";
    } else {
        echo "<span style='color:green'>All seats are available.</span>";
    }
}
?>
