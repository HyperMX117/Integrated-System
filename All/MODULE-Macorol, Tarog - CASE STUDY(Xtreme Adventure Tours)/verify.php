<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: url('images/back2.jpg') center/cover no-repeat; 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        h2 {
            color: #fff;
            text-align: center;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);
        }

        form {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            padding: 20px;
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #fff;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 16px;
            border: none;
            border-radius: 5px;
            background: rgba(255, 255, 255, 0.5);
            color: #333;
        }

        button {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 5px;
            background: #3498db;
            color: #fff;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button:hover {
            background: #2980b9;
        }
    </style>
</head>
<body>
    <h2>Enter Verification Code</h2>
    <form action="verify_process.php" method="post">
        <label for="verification_code">Verification Code</label>
        <input type="text" name="verification_code" id="verification_code" required>
        <button type="submit">Verify</button>
    </form>
</body>
</html>
