<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// connect.php (Example file where you connect to the DB)
require_once 'db_config.php'; // Adjust path if needed
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function generateRandomCode($length = 6) {
    return strtoupper(bin2hex(random_bytes($length)));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    $code = generateRandomCode();

    $sql = "UPDATE users SET reset_code = '$code' WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result) {
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; 
            $mail->SMTPAuth = true;
            $mail->Username = 'edishanleetenorio03@gmail.com';
            $mail->Password = 'mzua ivem kujf lvnf';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('edishanleetenorio03@gmail.com', 'PowerPuff');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Password Reset Code';
            $mail->Body = 'Your password reset code is: ' . $code;

            $mail->send();
            echo 'Email sent successfully';

            header("Location: resetpage.php");
            exit();
        } catch (Exception $e) {
            echo 'Email could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
    } else {
        echo 'Error updating the database';
    }
}

$conn->close();
?>
