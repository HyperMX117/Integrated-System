<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hostel Management - Room Management</title>
    <style>
        body {
            background: url("images/Day1.webp") center/cover no-repeat fixed;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .room-management {
            background: rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 800px;
            width: 100%;
            text-align: center;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
        }

        button:hover {
            background-color: #45a049;
        }

        .error {
            color: red;
            margin-top: 10px;
        }

        .room-image {
            max-width: 100px;
            max-height: 100px;
            display: block;
            margin: 0 auto;
            border-radius: 50%;
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        select,
        input[type="file"] {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
        }
    </style>
</head>

<body>

    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "hostel_booking";

    $conn = new mysqli($servername, $username, $password, $dbname);

    $errors = [];

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_room"])) {
        $newRoomNumber = mysqli_real_escape_string($conn, $_POST["new_room_number"]);
        $newCapacity = mysqli_real_escape_string($conn, $_POST["new_capacity"]);

        if (empty($newRoomNumber) || empty($newCapacity)) {
            $errors[] = "Room Number and Capacity are required.";
        } else {
            $sqlAddRoom = "INSERT INTO Room (RoomNumber, Capacity, OccupancyStatus) VALUES ('$newRoomNumber', $newCapacity, 'Vacant')";
            if (!$conn->query($sqlAddRoom)) {
                $errors[] = "Error adding room: " . $conn->error;
            }
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_room"])) {
        $roomIdToDelete = mysqli_real_escape_string($conn, $_POST["room_id_to_delete"]);

        // Validate input
        if (empty($roomIdToDelete)) {
            $errors[] = "Room ID to delete is required.";
        } else {
            $sqlDeleteRoom = "DELETE FROM Room WHERE RoomID = '$roomIdToDelete'";
            if (!$conn->query($sqlDeleteRoom)) {
                $errors[] = "Error deleting room: " . $conn->error;
            }
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["room_status_update"])) {
        $roomIdToUpdate = mysqli_real_escape_string($conn, $_POST["room_id"]);
        $newStatus = mysqli_real_escape_string($conn, $_POST["new_status"]);
    
        // Update room status
        $sqlUpdateStatus = "UPDATE Room SET OccupancyStatus = '$newStatus' WHERE RoomID = '$roomIdToUpdate'";
        $conn->query($sqlUpdateStatus);
    
        // Upload new image if provided
        if (isset($_FILES["new_image"]) && $_FILES["new_image"]["size"] > 0) {
            $targetDirectory = "images/";
            $targetFileName = $roomIdToUpdate . "_" . basename($_FILES["new_image"]["name"]);
            $targetFilePath = $targetDirectory . $targetFileName;
    
            $check = getimagesize($_FILES["new_image"]["tmp_name"]);
            if ($check !== false) {
                move_uploaded_file($_FILES["new_image"]["tmp_name"], $targetFilePath);
            } else {
                $errors[] = "File is not an image.";
            }
        }
    }
    ?>
    <div class="room-management">
        <h2>Room Management</h2>

        <?php
        if (!empty($errors)) {
            echo '<div class="error">';
            foreach ($errors as $error) {
                echo '<p>' . $error . '</p>';
            }
            echo '</div>';
        }
        ?>

        <div>
            <h3>Add a Room</h3>
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <label for="new_room_number">Room Number:</label>
                <input type="text" name="new_room_number" required>

                <label for="new_capacity">Capacity:</label>
                <input type="number" name="new_capacity" required>

                <button type="submit" name="add_room">Add Room</button>
            </form>
        </div>

        <div>
            <h3>Delete a Room</h3>
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <label for="room_id_to_delete">Room ID to Delete:</label>
                <input type="text" name="room_id_to_delete" required>

                <button type="submit" name="delete_room">Delete Room</button>
            </form>
        </div>

        <h3>Existing Rooms</h3>

<table>
    <thead>
        <tr>
            <th>Room Number</th>
            <th>Capacity</th>
            <th>Occupancy Status</th>
            <th>Image</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sqlRooms = "SELECT * FROM Room";
        $resultRooms = $conn->query($sqlRooms);

        while ($rowRoom = $resultRooms->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $rowRoom['RoomNumber'] . '</td>';
            echo '<td>' . $rowRoom['Capacity'] . '</td>';
            echo '<td>' . $rowRoom['OccupancyStatus'] . '</td>';
            echo '<td>';

            $imageName = $rowRoom['RoomID'] . "_" . basename($rowRoom['ImageURL']);
            $imagePath = 'images/' . $imageName;

            if (file_exists($imagePath)) {
                echo '<img src="' . $imagePath . '" alt="Room Image" class="room-image">';
            } else {
                echo 'No Image';
            }
            echo '</td>';
            echo '<td>';
            echo '<form method="POST" action="' . $_SERVER['PHP_SELF'] . '" enctype="multipart/form-data">';
            echo '<input type="hidden" name="room_id" value="' . $rowRoom['RoomID'] . '">';
            echo '<select name="new_status">';
            echo '<option value="Vacant" ' . ($rowRoom['OccupancyStatus'] == 'Vacant' ? 'selected' : '') . '>Vacant</option>';
            echo '<option value="Occupied" ' . ($rowRoom['OccupancyStatus'] == 'Occupied' ? 'selected' : '') . '>Occupied</option>';
            echo '</select>';
            echo '<label for="new_image">Select new image:</label>';
            echo '<input type="file" name="new_image">';
            echo '<button type="submit" name="room_status_update">Update</button>';
            echo '</form>';
            echo '</td>';
            echo '</tr>';
        }
                ?>
            </tbody>
        </table>
    </div>


</body>

</html>