<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hostel Management - Student Interface</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: url("images/Day1.webp") center/cover no-repeat fixed;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .student-interface {
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 600px;
        }

        h2 {
            text-align: center;
            color: #3498db;
        }

        .section-links {
            margin-top: 20px;
            display: flex;
            justify-content: space-around;
        }

        .section-link {
            text-decoration: none;
            color: #3498db;
            padding: 10px;
            border: 2px solid #3498db;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .section-link:hover {
            background-color: #3498db;
            color: #fff;
        }

        .iframe-container {
            margin-top: 20px;
            border: 2px solid #3498db;
            border-radius: 5px;
            overflow: hidden;
        }

        iframe {
            width: 100%;
            height: 400px;
            border: none;
        }
    </style>
</head>
<body>

<div class="student-interface">
    <h2>Welcome to Hostel Management</h2>

    <div class="section-links">
        <a href="messages.html" class="section-link" target="iframe-container">Messages</a>
        <a href="client-roomdetails.php" class="section-link" target="iframe-container">Room Details</a>
        <a href="fee-payment.html" class="section-link" target="iframe-container">Fee Payment</a>
    </div>

    <div class="iframe-container">
        <iframe name="iframe-container" id="iframe-container" src="messages.html"></iframe>
    </div>
</div>

</body>
</html>
