<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "palenzuelaDB";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function executeQuery($conn, $sql, $errorMsg)
{
    $result = $conn->query($sql);

    if (!$result) {
        die($errorMsg . $conn->error);
    }

    return $result;
}
$sqlTotalStudents = "SELECT COUNT(*) as total_students FROM Student";
$sqlTotalRooms = "SELECT COUNT(*) as total_rooms FROM Room";
$sqlAdmittedStudents = "SELECT COUNT(*) as admitted_students FROM Admissions WHERE Status = 'Admitted'";
$sqlOccupancyRate = "SELECT COUNT(*) as occupied_rooms FROM Admissions WHERE Status = 'Admitted'";

$resultTotalStudents = executeQuery($conn, $sqlTotalStudents, "Error fetching total students: ");
$resultTotalRooms = executeQuery($conn, $sqlTotalRooms, "Error fetching total rooms: ");
$resultAdmittedStudents = executeQuery($conn, $sqlAdmittedStudents, "Error fetching admitted students: ");
$resultOccupancyRate = executeQuery($conn, $sqlOccupancyRate, "Error fetching occupancy rate: ");

$rowTotalStudents = $resultTotalStudents->fetch_assoc();
if ($rowTotalStudents === null) {
    die("Error: No data fetched for total students.");
}
$totalStudents = $rowTotalStudents['total_students'];
$resultTotalStudents->free();  

$rowTotalRooms = $resultTotalRooms->fetch_assoc();
if ($rowTotalRooms === null) {
    die("Error: No data fetched for total rooms.");
}
$totalRooms = $rowTotalRooms['total_rooms'];
$resultTotalRooms->free();  

$rowAdmittedStudents = $resultAdmittedStudents->fetch_assoc();
if ($rowAdmittedStudents === null) {
    die("Error: No data fetched for admitted students.");
}
$admittedStudents = $rowAdmittedStudents['admitted_students'];
$resultAdmittedStudents->free();  

$rowOccupancyRate = $resultOccupancyRate->fetch_assoc();
if ($rowOccupancyRate === null) {
    die("Error: No data fetched for occupancy rate.");
}
$occupiedRooms = $rowOccupancyRate['occupied_rooms'];
$occupancyRate = ($occupiedRooms / $totalRooms) * 100;
$resultOccupancyRate->free();  

$sqlAdmittedStudentsDetails = "SELECT Student.StudentID, Student.Name, Student.ContactNumber, Student.Email, Room.RoomNumber
    FROM Admissions
    INNER JOIN Student ON Admissions.StudentID = Student.StudentID
    INNER JOIN Room ON Admissions.RoomID = Room.RoomID
    WHERE Admissions.Status = 'Admitted'";
$resultAdmittedStudentsDetails = executeQuery($conn, $sqlAdmittedStudentsDetails, "Error fetching admitted students' details: ");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hostel Management Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            height: 100vh;
            padding: 0;
            background: url("images/bck.jpg") center/cover no-repeat;
            background-size: cover;
        }

        .dashboard {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
        }

        .overview {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .card {
            flex: 1;
            padding: 15px;
            background-color: #e0e0e0;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            margin-right: 10px;
        }

        .rating-chart {
            font-size: 24px;
            color: #333;
            display: flex;
            align-items: center;
        }

        .rating-chart .filled-stars {
            color: #ffc107;
        }

        .notifications {
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <div class="dashboard">
        <h2>Hostel Management Dashboard</h2>

        <div class="overview">
            <div class="card">
                <h3>Total Students</h3>
                <p><?php echo $totalStudents; ?></p>
            </div>
            <div class="card">
                <h3>Total Rooms</h3>
                <p><?php echo $totalRooms; ?></p>
            </div>
            <div class="card">
                <h3>Admitted Students</h3>
                <p><?php echo $admittedStudents; ?></p>
            </div>
            <div class="card">
                <h3>Occupancy Rate</h3>
                <div class="rating-chart">
                    <?php
                    $filledStars = round($occupancyRate / 20);
                    $emptyStars = 5 - $filledStars;

                    for ($i = 0; $i < $filledStars; $i++) {
                        echo '<span class="filled-stars">&#9733;</span>';
                    }

                    for ($i = 0; $i < $emptyStars; $i++) {
                        echo '<span>&#9733;</span>';
                    }
                    ?>
                </div>
                <p><?php echo number_format($occupancyRate, 2) . '%'; ?></p>
            </div>
        </div>

        <h3>Admitted Students Details</h3>
        <table>
            <tr>
                <th>Student ID</th>
                <th>Name</th>
                <th>Contact Number</th>
                <th>Email</th>
                <th>Room Number</th>
            </tr>
            <?php
            while ($row = $resultAdmittedStudentsDetails->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['StudentID'] . "</td>";
                echo "<td>" . $row['Name'] . "</td>";
                echo "<td>" . $row['ContactNumber'] . "</td>";
                echo "<td>" . $row['Email'] . "</td>";
                echo "<td>" . $row['RoomNumber'] . "</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>

</body>

</html>
