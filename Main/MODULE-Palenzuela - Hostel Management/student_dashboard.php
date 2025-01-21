<?php
session_start();

if (!isset($_SESSION['student_id'])) {
    header("Location: login.php");
    exit();
}

$student_id = $_SESSION['student_id'];
$student_name = $_SESSION['student_name'];

// connect.php (Example file where you connect to the DB)
require_once 'db_config.php'; // Adjust path if needed
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sqlStudentDetails = "SELECT * FROM Student WHERE StudentID = $student_id";
$resultStudentDetails = $conn->query($sqlStudentDetails);
$studentDetails = $resultStudentDetails->fetch_assoc();

$sqlPayments = "SELECT * FROM Payments WHERE StudentID = $student_id";
$resultPayments = $conn->query($sqlPayments);

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome, <?php echo $student_name; ?></title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f3f3f3;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: url("images/bck.jpg") center/cover no-repeat;
        }

        div {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 600px;
            width: 100%;
            margin: 20px;
        }

        h2,
        h3 {
            color: #3498db;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            margin-bottom: 20px;
        }

        th,
        td {
            padding: 15px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #3498db;
            color: #fff;
        }

        p {
            margin: 10px 0;
            color: #333333;
        }

        a {
            color: #3498db;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div>
        <h2>Welcome, <?php echo $student_name; ?>!</h2>

        <h3>Personal Overview</h3>
        <p><strong>Name:</strong> <?php echo $studentDetails['Name']; ?></p>
        <p><strong>Contact Number:</strong> <?php echo $studentDetails['ContactNumber']; ?></p>
        <p><strong>Email:</strong> <?php echo $studentDetails['Email']; ?></p>
        <p><strong>Emergency Contact:</strong> <?php echo $studentDetails['EmergencyContact']; ?></p>

        <h3>Payment Details</h3>
        <?php if ($resultPayments->num_rows > 0) : ?>
            <table>
                <tr>
                    <th>Payment ID</th>
                    <th>Amount</th>
                    <th>Payment Date</th>
                </tr>
                <?php while ($row = $resultPayments->fetch_assoc()) : ?>
                    <tr>
                        <td><?php echo $row['PaymentID']; ?></td>
                        <td>$<?php echo $row['Amount']; ?></td>
                        <td><?php echo $row['PaymentDate']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else : ?>
            <p>No payment records found.</p>
        <?php endif; ?>

        <p><a href="logout.php">Logout</a></p>
    </div>

</body>

</html>
