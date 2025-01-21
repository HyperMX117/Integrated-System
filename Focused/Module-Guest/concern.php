<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hostel_booking";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["send_message"])) {
    $senderId = $_POST["sender_id"];
    $receiverId = $_POST["receiver_id"];
    $messageText = $_POST["message_text"];

    $sqlInsertMessage = "INSERT INTO Messages (SenderId, ReceiverId, MessageText, Timestamp)
                         VALUES (?, ?, ?, NOW())";
    $stmtInsertMessage = $conn->prepare($sqlInsertMessage);
    $stmtInsertMessage->bind_param("iis", $senderId, $receiverId, $messageText);

    if ($stmtInsertMessage->execute()) {
    } else {
        echo "Error sending message: " . $stmtInsertMessage->error;
    }

    $stmtInsertMessage->close();
}

$sqlUsers = "SELECT StudentID, Name FROM Student";
$resultUsers = $conn->query($sqlUsers);

$sqlMessages = "SELECT m.MessageID, m.SenderId, m.ReceiverId, m.MessageText, m.Timestamp, s.Name as SenderName
                FROM Messages m
                JOIN Student s ON m.SenderId = s.StudentID
                ORDER BY m.Timestamp DESC";
$resultMessages = $conn->query($sqlMessages);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hostel Management - Communication</title>
    <style>
        body {
            background: url("images/Day1.webp") center/cover no-repeat fixed;
            height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Arial', sans-serif;
        }

        .communication {
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 600px;
        }

        .messages {
            margin-top: 20px;
        }

        .message {
            border: 2px solid #ddd;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 8px;
            background-color: #fff;
        }

        .message strong {
            color: #3498db;
        }

        .message p {
            margin: 10px 0;
        }

        .message small {
            color: #777;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        select, textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }

        button {
            background-color: #3498db;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #2980b9;
        }

        p.no-messages {
            color: #777;
        }
    </style>
</head>
<body>

<div class="communication">
    <h2>Communication</h2>

    <div class="messages">
        <?php
        if ($resultMessages->num_rows > 0) {
            while ($rowMessage = $resultMessages->fetch_assoc()) {
                echo '<div class="message">';
                echo '<strong>' . $rowMessage['SenderName'] . '</strong>';
                echo '<p>' . $rowMessage['MessageText'] . '</p>';
                echo '<small>' . $rowMessage['Timestamp'] . '</small>';
                echo '</div>';
            }
        } else {
            echo '<p>No messages available.</p>';
        }
        ?>
    </div>

    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="sender_id">Sender:</label>
        <select name="sender_id" required>
            <?php
            while ($rowUser = $resultUsers->fetch_assoc()) {
                echo '<option value="' . $rowUser['StudentID'] . '">' . $rowUser['Name'] . '</option>';
            }
            ?>
        </select>

        <label for="receiver_id">Receiver:</label>
        <select name="receiver_id" required>
            <?php
            $resultUsers->data_seek(0); 
            while ($rowUser = $resultUsers->fetch_assoc()) {
                echo '<option value="' . $rowUser['StudentID'] . '">' . $rowUser['Name'] . '</option>';
            }
            ?>
        </select>

        <label for="message_text">Message:</label>
        <textarea name="message_text" rows="4" required></textarea>

        <button type="submit" name="send_message">Send Message</button>
    </form>
</div>

</body>
</html>
