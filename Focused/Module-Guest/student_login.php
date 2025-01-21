<?php
session_start();

if (isset($_SESSION['student_id'])) {
    header("Location: student_dashboard.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once '../includes/config.php';

    if (!$mysqli) {
        die("Database connection failed.");
    }

    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!empty($email) && !empty($password)) {
        // Simplified query with no security measures
        $query = "SELECT id, password FROM userregistration WHERE email = '$email'";
        $result = $mysqli->query($query);

        if ($result && $result->num_rows === 1) {
            $row = $result->fetch_assoc();

            if ($password == $row['password']) { // Plain-text password comparison
                $studentID = $row['id'];

                // Set the session variables required for check_login.php
                $_SESSION['id'] = $studentID; // Set this to work with check_login.php
                $_SESSION['student_id'] = $studentID;

                // Optionally, you can add the name as well for better user experience
                $studentQuery = "SELECT firstName, lastName FROM userregistration WHERE id = $studentID";
                $studentResult = $mysqli->query($studentQuery);
                if ($studentRow = $studentResult->fetch_assoc()) {
                    $_SESSION['student_name'] = $studentRow['firstName'] . ' ' . $studentRow['lastName'];
                }

                // Redirect to the student dashboard
                header("Location: student_dashboard.php");
                exit();
            } else {
                $error_message = "Invalid password.";
            }
        } else {
            $error_message = "Invalid email.";
        }
    } else {
        $error_message = "Email and password are required.";
    }

    $mysqli->close();
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
            <p><?php echo $error_message; ?></p>
        <?php endif; ?>
        <form method="POST" action="">
            <label for="email">Email:</label>
            <input type="text" name="email" id="email" required>

            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>

            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
