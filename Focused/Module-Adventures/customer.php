<?php
include 'db.php';

if(isset($_POST['delete_id'])) {
    $deleteId = $_POST['delete_id'];
    
    $deleteQuery = "DELETE FROM bookings WHERE id = $deleteId";
    $conn->query($deleteQuery);
}

$query = "SELECT * FROM bookings";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Information</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background: url('images/back2.jpg') center/cover no-repeat;
        }

        h2 {
            color: #2C3E50;
        }

        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        th, td {
            border: 1px solid #BDC3C7;
            text-align: left;
            padding: 12px;
        }

        th {
            background-color: #3498DB;
            color: #ECF0F1;
        }

        tr:nth-child(even) {
            background-color: #ECF0F1;
        }

        tr:hover {
            background-color: #D6EAF8;
        }
    </style>
</head>
<body>
    <div>
        <h2>Customer Information</h2>
        <form method="post">
        <table>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Region</th>
                <th>Province</th>
                <th>City</th>
                <th>Street Address</th>
                <th>Tour</th>
                <th>Tour Length</th>
                <th>People</th>
                <th>Preferred Date</th>
                <th>Action</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['first_name'] . "</td>";
                    echo "<td>" . $row['last_name'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['region'] . "</td>";
                    echo "<td>" . $row['province'] . "</td>";
                    echo "<td>" . $row['city'] . "</td>";
                    echo "<td>" . $row['street_address'] . "</td>";
                    echo "<td>" . $row['tour'] . "</td>";
                    echo "<td>" . $row['tour_length'] . "</td>";
                    echo "<td>" . $row['people'] . "</td>";
                    echo "<td>" . $row['preferred_date'] . "</td>";
                    echo "<td><button type='submit' name='delete_id' value='" . $row['id'] . "'>Delete</button></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='13'>No bookings found</td></tr>";
            }
            ?>
        </table>
        </form>
    </div>
</body>
</html>
