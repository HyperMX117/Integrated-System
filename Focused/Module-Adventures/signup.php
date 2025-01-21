<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "booking_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $verificationCode = generateVerificationCode();
    sendVerificationEmail($email, $verificationCode);

    session_start();
    $_SESSION["verification_code"] = $verificationCode;
    $_SESSION["user_data"] = array(
        'fname' => $fname,
        'lname' => $lname,
        'username' => $username,
        'email' => $email,
        'password' => $password,
    );

    echo '<script>window.location.href = "verify.php";</script>';
    exit();
}

function generateVerificationCode() {
    return mt_rand(100000, 999999);
}

function sendVerificationEmail($email, $verificationCode) {
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; 
        $mail->SMTPAuth   = true;
        $mail->Username   = 'edishanleetenorio03@gmail.com';
        $mail->Password   = 'mzua ivem kujf lvnf';
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        $mail->setFrom('edishanleetenorio03@gmail.com', 'Xtreme Adventure Tours');
        $mail->addAddress($email); 
        $mail->isHTML(true);
        $mail->Subject = 'Xtreme Adventure Tours - Email Verification';
        $mail->Body    = 'Your verification code: ' . $verificationCode;

        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
