<?php
session_start();

if (isset($_SESSION['student_id'])) {
    header("Location: student_dashboard.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once '../includes/config.php';

    // $conn = new mysqli($servername, $username, $password, $dbname);
    // if ($conn->connect_error) {
    //     die("Connection failed: " . $conn->connect_error);
    // }

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Simplified query
    $sql = "SELECT UserID, StudentID, Password FROM student_users WHERE Username = '$username'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows === 1) {
        $row = $result->fetch_assoc();

        if ($password == $row['Password']) { // Simplified password check
            $studentID = $row['StudentID'];

            $studentSql = "SELECT Name FROM Student WHERE StudentID = '$studentID'";
            $studentResult = $conn->query($studentSql);
            $studentRow = $studentResult->fetch_assoc();

            // Set session variables
            $_SESSION['student_id'] = $studentID;
            $_SESSION['user_id'] = $row['UserID'];
            $_SESSION['student_name'] = $studentRow['Name'];

            header("Location: student_dashboard.php");
            exit();
        } else {
            $error_message = "Invalid username or password.";
        }
    } else {
        $error_message = "Invalid username or password.";
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Hostel Management</title>
    <link rel="shortcut icon" href="images/logopower.png" type="image/x-icon">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7f7f7;
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
            max-width: 400px;
            width: 100%;
            margin: 20px;
        }

        h2 {
            color: #3498db;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label {
            margin-bottom: 10px;
            color: #333333;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        button {
            background-color: #3498db;
            color: #ffffff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #2980b9;
        }

        p {
            color: #e74c3c;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div>
        <h2>Student Login</h2>
        <?php if (isset($error_message)) : ?>
            <p><?php echo htmlspecialchars($error_message); ?></p>
        <?php endif; ?>
        <form method="POST" action="">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required>

            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>

            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
