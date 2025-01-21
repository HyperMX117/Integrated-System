<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'booking_system';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$firstName = isset($_POST['name']) ? $_POST['name'] : '';
$lastName = isset($_POST['lastName']) ? $_POST['lastName'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$region = isset($_POST['region']) ? $_POST['region'] : '';
$province = isset($_POST['province']) ? $_POST['province'] : '';
$city = isset($_POST['city']) ? $_POST['city'] : '';
$streetAddress = isset($_POST['streetAddress']) ? $_POST['streetAddress'] : '';
$tour = isset($_POST['tour']) ? $_POST['tour'] : '';
$tourLength = isset($_POST['tour-length']) ? $_POST['tour-length'] : '';
$people = isset($_POST['people']) ? $_POST['people'] : '';
$date = isset($_POST['date']) ? $_POST['date'] : '';

$tourOptions = getTourOptions();
if ($tour && $tourLength && array_key_exists($tour, $tourOptions) && array_key_exists($tourLength, $tourOptions[$tour])) {
    $selectedTourData = $tourOptions[$tour][$tourLength];
    $totalPrice = $selectedTourData['price'] * $people;
} else {
    $totalPrice = 0;
}

$sql = "INSERT INTO bookings (first_name, last_name, email, region, province, city, street_address, tour, tour_length, people, preferred_date, total_price) 
        VALUES ('$firstName', '$lastName', '$email', '$region', '$province', '$city', '$streetAddress', '$tour', '$tourLength', '$people', '$date', '$totalPrice')";

if ($conn->query($sql) === TRUE) {
    $message = "Booking successful!";
    
    $booking_receipt = generate_booking_receipt($firstName, $lastName, $email, $region, $province, $city, $streetAddress, $tour, $tourLength, $people, $date, $totalPrice);

    send_booking_confirmation_email($email, $booking_receipt);

    header("Location: thankyou.php");
    exit();
} else {
    $message = "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

function generate_booking_receipt($firstName, $lastName, $email, $region, $province, $city, $streetAddress, $tour, $tourLength, $people, $date, $totalPrice) {
    $receipt = "Booking Details:\n";
    $receipt .= "Name: $firstName $lastName\n";
    $receipt .= "Email: $email\n";
    $receipt .= "Region: $region\n";
    $receipt .= "Province: $province\n";
    $receipt .= "City: $city\n";
    $receipt .= "Street Address: $streetAddress\n";
    $receipt .= "Tour: $tour\n";
    $receipt .= "Tour Length: $tourLength\n";
    $receipt .= "People: $people\n";
    $receipt .= "Preferred Date: $date\n";
    $receipt .= "Total Price: $totalPrice\n";
    
    return $receipt;
}

function send_booking_confirmation_email($to, $receipt) {
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; 
        $mail->SMTPAuth   = true;
        $mail->Username   = 'macoroljamaica0702@gmail.com';    
        $mail->Password   = 'mlqx suwd hkwj wglj';
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        $mail->setFrom('macoroljamaica0702@gmail.com', 'Xtreme Adventure  Tours');
        $mail->addAddress($to);

        $mail->isHTML(false); 
        $mail->Subject = 'Booking Confirmation';
        $mail->Body    = "Thank you for your booking!\n\n" . $receipt;

        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

function getTourOptions() {
    return array(
        "class1-2" => array("3days" => array("price" => 100, "code" => "3WW12"), "5days" => array("price" => 145, "code" => "5WW12")),
        "class3-4" => array("3days" => array("price" => 125, "code" => "3WW34"), "5days" => array("price" => 175, "code" => "5WW34")),
        "kayaking/camping" => array("3days" => array("price" => 70, "code" => "3KC"), "5days" => array("price" => 95, "code" => "5KC")),
        "hiking/camping" => array("3days" => array("price" => 50, "code" => "3HC"), "5days" => array("price" => 70, "code" => "5HC"))
    );
}
?>
