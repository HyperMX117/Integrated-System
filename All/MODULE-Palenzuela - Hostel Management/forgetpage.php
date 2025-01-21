<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Hostel Management</title>
    <link rel="shortcut icon" href="images/logopower.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lapis:wght@400&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-family: 'Lato', 'Lapis', Helvetica, Arial, Lucida, sans-serif;
        }

        body {
            background-image: url('images/bck.jpg');
            background-position: center;
            background-size: cover;
            background-attachment: fixed;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: white;
            margin: 0;
        }

        .forget_password {
            max-width: 500px;
            width: 100%;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            padding: 20px;
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin: auto;
            text-align: center;
            color: black;
            display: flex;
            justify-content: center;
            flex-direction: column;
            gap: 10px;
        }

        form {
            padding: 20px 0;
            width: 100%;
            display: flex;
            flex-direction: column;
        }

        input {
            width: 100%;
            outline: none;
            padding: 10px;
            border: 1px solid white;
            background: rgba(255, 255, 255, 0.2);
            margin-top: 5px;
            margin-bottom: 10px;
            border-radius: 5px;
        }

        label {
            max-width: 120px;
            width: 100%;
            text-align: left;
            padding-top: 10px;
        }

        button {
            padding: 10px;
            background-color: rgba(255, 255, 255, 0.2);
            border: 1px solid white;
            color: white;
            transition: all 300ms;
            cursor: pointer;
        }

        button:hover {
            background-color: white;
            color: black;
        }
    </style>
</head>

<body>
    <div class="forget_password">
        <h2>Forget Password</h2>
        <form action="forget_password.php" method="post">
            <label for="email">Email Address</label>
            <input type="email" name="email" id="email" required>
            <button type="submit">Get Code</button>
        </form>
    </div>
</body>

</html>