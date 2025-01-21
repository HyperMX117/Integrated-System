<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hostel_booking";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function fetchAvailableRooms($conn) {
    $sql = "SELECT RoomID, RoomNumber FROM Room WHERE OccupancyStatus = 'Vacant'";
    $result = $conn->query($sql);

    if (!$result) {
        die("Error fetching available rooms: " . $conn->error);
    }

    return $result->fetch_all(MYSQLI_ASSOC);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $studentID = mysqli_real_escape_string($conn, $_POST["student_id"]);
    $studentName = mysqli_real_escape_string($conn, $_POST["student_name"]);
    $contactNumber = mysqli_real_escape_string($conn, $_POST["contact_number"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $emergencyContact = mysqli_real_escape_string($conn, $_POST["emergency_contact"]);
    $selectedRoom = mysqli_real_escape_string($conn, $_POST["selected_room"]);

    $sqlInsertStudent = $conn->prepare("INSERT INTO Student (StudentID, Name, ContactNumber, Email, EmergencyContact) VALUES (?, ?, ?, ?, ?)");
    $sqlInsertStudent->bind_param("issss", $studentID, $studentName, $contactNumber, $email, $emergencyContact);
    $sqlInsertStudent->execute();
    $sqlInsertStudent->close();

    $sqlCheckRoom = $conn->prepare("SELECT RoomID FROM Room WHERE RoomID = ?");
    $sqlCheckRoom->bind_param("s", $selectedRoom);
    $sqlCheckRoom->execute();
    $resultCheckRoom = $sqlCheckRoom->get_result();

    if ($resultCheckRoom->num_rows == 0) {
        die("Error: Room with RoomID $selectedRoom does not exist.");
    }

    $sqlCheckRoom->close();


    $sqlUpdateRoom = "UPDATE Room SET OccupancyStatus = 'Admitted' WHERE RoomID = ?";
    $stmtUpdateRoom = $conn->prepare($sqlUpdateRoom);
    $stmtUpdateRoom->bind_param("s", $selectedRoom);
    $stmtUpdateRoom->execute();
    $stmtUpdateRoom->close();

    $sqlInsertAdmission = $conn->prepare("INSERT INTO Admissions (StudentID, RoomID, AdmissionDate, Status) VALUES (?, ?, CURDATE(), 'Admitted')");
    $sqlInsertAdmission->bind_param("ss", $studentID, $selectedRoom);
    $sqlInsertAdmission->execute();
    $sqlInsertAdmission->close();

    $message = "Form submitted successfully!";
} else {  
    $csrfToken = $_SESSION['csrf_token'] = uniqid();
    $availableRooms = fetchAvailableRooms($conn);
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hostel Management - Admissions</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.8) 0%, rgba(255, 255, 255, 0.5) 100%);
        }

        .admissions {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: url('images/bck.jpg'); 
            background-size: cover;
            backdrop-filter: blur(10px);
        }

        form {
            width: 300px;
            padding: 20px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            backdrop-filter: blur(5px);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        label {
            display: block;
            margin: 10px 0 5px;
            color: #fff;
        }

        input, select {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: none;
            border-radius: 5px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<div class="admissions">
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="hidden" name="csrf_token" value="<?php echo $csrfToken; ?>">

        <label for="student_id">Student ID:</label>
        <input type="text" name="student_id" required>

        <label for="student_name">Student Name:</label>
        <input type="text" name="student_name" required>

        <label for="contact_number">Contact Number:</label>
        <input type="text" name="contact_number" required>

        <label for="email">Email:</label>
        <input type="email" name="email" required>

        <label for="emergency_contact">Emergency Contact:</label>
        <input type="text" name="emergency_contact" required>

        <label for="selected_room">Select Room:</label>
        <select name="selected_room" required>
            <?php
            $availableRooms = fetchAvailableRooms($conn);

            foreach ($availableRooms as $room) {
                echo '<option value="' . $room['RoomID'] . '">' . $room['RoomNumber'] . '</option>';
            }
            ?>
        </select>

        <button type="submit">Admit Student</button>

        <?php if (isset($message)) : ?>
            <p><?php echo $message; ?></p>
        <?php endif; ?>
        <?php if (!empty($conn->error)) : ?>
            <p>Error: <?php echo $conn->error; ?></p>
        <?php endif; ?>
    </form>
</div>


<?php
$conn->close();
?>