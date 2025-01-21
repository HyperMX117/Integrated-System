<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You for Booking</title>
    <link rel="shortcut icon" href="images/logo.png" type="image/x-icon">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to bottom, rgba(255, 255, 255, 0.9) 0%, rgba(255, 255, 255, 0.7) 50%, rgba(255, 255, 255, 0.5) 100%), url('images/back2.jpg') center/cover no-repeat;
            color: #333;
            text-align: center;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        h1 {
            color: #4CAF50;
            margin-bottom: 20px;
        }

        p {
            font-size: 18px;
            line-height: 1.6;
            color: #333;
        }

        .back-button {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .back-button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <h1>Thank You for Booking with Us!</h1>
    <p>Your booking was successful. We appreciate your business and look forward to serving you.</p>
    
    <a href="booking.php" class="back-button">Back to Booking</a>

</body>

</html>
